<?php
/**
 * Backup full database to database/ directory.
 *
 * Naming rule:
 * - First backup of day:   DB_NAME_bk_ddmmyy.tar.gz
 * - Second+ backup of day: DB_NAME_bk_ddmmyy_2.tar.gz, _3.tar.gz, ...
 */

chdir(dirname(__FILE__) . '/..');
require_once __DIR__ . '/../env.loader.php';

function resolveBackupBaseName($backupDir, $dbName, $dateTag) {
    $baseName = $dbName . '_bk_' . $dateTag;
    $pattern = '/^' . preg_quote($baseName, '/') . '(?:_(\d+))?(?:\.tar\.gz)?$/';

    $maxSequence = 0;
    $hasBaseFile = false;

    $files = scandir($backupDir);
    if ($files === false) {
        return false;
    }

    foreach ($files as $fileName) {
        if ($fileName === '.' || $fileName === '..') {
            continue;
        }

        if (!preg_match($pattern, $fileName, $matches)) {
            continue;
        }

        if (!empty($matches[1])) {
            $maxSequence = max($maxSequence, (int) $matches[1]);
        } else {
            $hasBaseFile = true;
            $maxSequence = max($maxSequence, 1);
        }
    }

    if (!$hasBaseFile && $maxSequence === 0) {
        return $baseName;
    }

    return $baseName . '_' . ($maxSequence + 1);
}

function isWindowsPlatform() {
    return strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
}

function resolveFromPath($binaryName) {
    if (isWindowsPlatform()) {
        $output = @shell_exec('where ' . escapeshellarg($binaryName) . ' 2>NUL');
    } else {
        $output = @shell_exec('command -v ' . escapeshellarg($binaryName) . ' 2>/dev/null');
    }

    if (!is_string($output) || trim($output) === '') {
        return '';
    }

    $lines = preg_split('/\r\n|\r|\n/', trim($output));
    return isset($lines[0]) ? trim($lines[0]) : '';
}

function findMysqldumpBinary() {
    $customPath = trim((string) env('MYSQLDUMP_PATH', ''));
    if ($customPath !== '' && file_exists($customPath)) {
        return $customPath;
    }

    // Try PATH first.
    $fromPath = resolveFromPath('mysqldump');
    if ($fromPath !== '') {
        return $fromPath;
    }

    // MariaDB alternative binary name (common on Ubuntu/Debian).
    $fromPathMaria = resolveFromPath('mariadb-dump');
    if ($fromPathMaria !== '') {
        return $fromPathMaria;
    }

    $candidates = array(
        // Windows common installs.
        'C:\\xampp\\mysql\\bin\\mysqldump.exe',
        'C:\\Program Files\\MySQL\\MySQL Server 8.0\\bin\\mysqldump.exe',
        'C:\\Program Files\\MariaDB 10.4\\bin\\mysqldump.exe',
        // Ubuntu / Linux common installs.
        '/usr/bin/mysqldump',
        '/usr/local/bin/mysqldump',
        '/usr/bin/mariadb-dump',
        '/usr/local/bin/mariadb-dump',
    );

    foreach ($candidates as $candidate) {
        if (file_exists($candidate)) {
            return $candidate;
        }
    }

    return '';
}

function findTarBinary() {
    $fromPath = resolveFromPath('tar');
    if ($fromPath !== '') {
        return $fromPath;
    }

    $candidates = array(
        '/usr/bin/tar',
        '/bin/tar',
        'C:\\Windows\\System32\\tar.exe',
    );

    foreach ($candidates as $candidate) {
        if (file_exists($candidate)) {
            return $candidate;
        }
    }

    return '';
}

function compressToTarGz($sourceFilePath, $targetArchivePath, &$errorMessage) {
    $errorMessage = '';

    // Primary method: PharData (works on both Windows and Ubuntu when phar extension is enabled).
    if (class_exists('PharData')) {
        try {
            $tarPath = preg_replace('/\.gz$/', '', $targetArchivePath);

            if (file_exists($tarPath)) {
                @unlink($tarPath);
            }
            if (file_exists($targetArchivePath)) {
                @unlink($targetArchivePath);
            }

            $tar = new PharData($tarPath);
            $tar->addFile($sourceFilePath, basename($sourceFilePath));
            $tar->compress(Phar::GZ);
            unset($tar);

            if (file_exists($tarPath)) {
                @unlink($tarPath);
            }

            if (file_exists($targetArchivePath)) {
                return true;
            }

            $errorMessage = 'PharData compression finished but target archive was not created.';
        } catch (Throwable $e) {
            $errorMessage = 'PharData compression failed: ' . $e->getMessage();
        }
    }

    // Fallback method: external tar command.
    $tarBinary = findTarBinary();
    if ($tarBinary === '') {
        if ($errorMessage === '') {
            $errorMessage = 'Cannot find tar binary for fallback compression.';
        }
        return false;
    }

    $workDir = dirname($sourceFilePath);
    $sourceFileName = basename($sourceFilePath);
    $archiveName = basename($targetArchivePath);

    $descriptorSpec = array(
        0 => array('pipe', 'r'),
        1 => array('pipe', 'w'),
        2 => array('pipe', 'w'),
    );

    $command = array(
        $tarBinary,
        '-czf',
        $archiveName,
        $sourceFileName,
    );

    $proc = proc_open($command, $descriptorSpec, $pipes, $workDir, null, array('bypass_shell' => true));
    if (!is_resource($proc)) {
        $errorMessage = 'Failed to start tar process.';
        return false;
    }

    fclose($pipes[0]);
    $stdout = stream_get_contents($pipes[1]);
    fclose($pipes[1]);
    $stderr = stream_get_contents($pipes[2]);
    fclose($pipes[2]);

    $exitCode = proc_close($proc);
    if ($exitCode !== 0 || !file_exists($targetArchivePath)) {
        $details = trim($stderr . "\n" . $stdout);
        $errorMessage = 'tar compression failed' . ($details !== '' ? ': ' . $details : '.');
        return false;
    }

    return true;
}

function runMysqldumpToFile($command, $outputFilePath, &$stderrOutput, &$exitCode) {
    $stderrOutput = '';
    $exitCode = 1;

    $descriptorSpec = array(
        0 => array('pipe', 'r'),
        1 => array('file', $outputFilePath, 'w'),
        2 => array('pipe', 'w'),
    );

    $process = proc_open($command, $descriptorSpec, $pipes, dirname(__DIR__), null, array('bypass_shell' => true));
    if (!is_resource($process)) {
        $stderrOutput = 'Failed to start mysqldump process.';
        return false;
    }

    fclose($pipes[0]);
    $stderrOutput = stream_get_contents($pipes[2]);
    fclose($pipes[2]);

    $exitCode = proc_close($process);
    return $exitCode === 0;
}

function isPrivilegeRelatedDumpError($stderrOutput) {
    if (!is_string($stderrOutput) || trim($stderrOutput) === '') {
        return false;
    }

    return (bool) preg_match(
        '/insufficient privileges|access denied|command denied|need \(at least one of\) the .* privilege/i',
        $stderrOutput
    );
}

$dbHost = env('DB_SERVER', 'localhost');
$dbPort = (string) env('DB_PORT', '3306');
$dbUser = env('DB_USERNAME', 'root');
$dbPass = (string) env('DB_PASSWORD', '');
$dbName = env('DB_NAME', '');

if ($dbName === '') {
    fwrite(STDERR, "ERROR: DB_NAME is empty in .env\n");
    exit(1);
}

$backupDir = __DIR__;
$dateTag = date('dmy');
$backupBaseName = resolveBackupBaseName($backupDir, $dbName, $dateTag);
$backupArchivePath = $backupDir . DIRECTORY_SEPARATOR . $backupBaseName . '.tar.gz';
$tempSqlPath = $backupDir . DIRECTORY_SEPARATOR . $backupBaseName . '.sql';

if ($backupBaseName === false) {
    fwrite(STDERR, "ERROR: Cannot scan backup directory: {$backupDir}\n");
    exit(1);
}

$mysqldump = findMysqldumpBinary();

if ($mysqldump === '') {
    fwrite(STDERR, "ERROR: Cannot find mysqldump/mariadb-dump binary\n");
    fwrite(STDERR, "Hint: set MYSQLDUMP_PATH in .env (Windows example: C:\\\\xampp\\\\mysql\\\\bin\\\\mysqldump.exe)\n");
    exit(1);
}

$command = array(
    $mysqldump,
    '--host=' . $dbHost,
    '--port=' . $dbPort,
    '--user=' . $dbUser,
    '--default-character-set=utf8mb4',
    // Force full dump even if mysqldump defaults files contain no-data/no-create-info.
    '--skip-no-data',
    '--skip-no-create-info',
    '--single-transaction',
    '--quick',
    '--skip-lock-tables',
);

if ($dbPass !== '') {
    $command[] = '--password=' . $dbPass;
}

$dumpVariants = array(
    array(
        'extraOptions' => array('--routines', '--events', '--triggers'),
        'warning' => '',
    ),
    array(
        'extraOptions' => array('--triggers'),
        'warning' => 'WARNING: Backup completed without routines/events due to limited DB privileges.',
    ),
    array(
        'extraOptions' => array(),
        'warning' => 'WARNING: Backup completed without routines/events/triggers due to limited DB privileges.',
    ),
);

$dumpSucceeded = false;
$stderr = '';
$exitCode = 1;
$selectedWarning = '';

foreach ($dumpVariants as $index => $variant) {
    $variantCommand = array_merge($command, $variant['extraOptions'], array($dbName));
    $dumpSucceeded = runMysqldumpToFile($variantCommand, $tempSqlPath, $stderr, $exitCode);

    if ($dumpSucceeded) {
        $selectedWarning = $variant['warning'];
        break;
    }

    if (file_exists($tempSqlPath)) {
        @unlink($tempSqlPath);
    }

    $hasNextVariant = ($index < count($dumpVariants) - 1);
    if (!$hasNextVariant || !isPrivilegeRelatedDumpError($stderr)) {
        break;
    }
}

if (!$dumpSucceeded) {
    if (file_exists($tempSqlPath)) {
        @unlink($tempSqlPath);
    }
    fwrite(STDERR, "ERROR: Backup failed (exit code {$exitCode})\n");
    if (!empty($stderr)) {
        fwrite(STDERR, $stderr . "\n");
    }
    exit($exitCode);
}

if ($selectedWarning !== '') {
    fwrite(STDOUT, $selectedWarning . "\n");
}

$compressionError = '';
$compressed = compressToTarGz($tempSqlPath, $backupArchivePath, $compressionError);

if (file_exists($tempSqlPath)) {
    @unlink($tempSqlPath);
}

if (!$compressed) {
    if (file_exists($backupArchivePath)) {
        @unlink($backupArchivePath);
    }
    fwrite(STDERR, "ERROR: Failed to compress backup into tar.gz\n");
    if ($compressionError !== '') {
        fwrite(STDERR, $compressionError . "\n");
    }
    exit(1);
}

$fileSize = file_exists($backupArchivePath) ? filesize($backupArchivePath) : 0;
echo "Backup success: {$backupArchivePath}\n";
echo "Size: {$fileSize} bytes\n";

exit(0);
