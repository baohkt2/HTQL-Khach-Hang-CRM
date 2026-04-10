<?php
/**
 * Backup full database to database/ directory.
 *
 * Naming rule:
 * - First backup of day:   DB_NAME_bk_ddmmyy
 * - Second+ backup of day: DB_NAME_bk_ddmmyy_2, _3, ...
 */

chdir(dirname(__FILE__) . '/..');
require_once __DIR__ . '/../env.loader.php';

function resolveBackupFilePath($backupDir, $dbName, $dateTag) {
    $baseName = $dbName . '_bk_' . $dateTag;
    $pattern = '/^' . preg_quote($baseName, '/') . '(?:_(\d+))?$/';

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
        return $backupDir . DIRECTORY_SEPARATOR . $baseName;
    }

    return $backupDir . DIRECTORY_SEPARATOR . $baseName . '_' . ($maxSequence + 1);
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
$backupFilePath = resolveBackupFilePath($backupDir, $dbName, $dateTag);

if ($backupFilePath === false) {
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
    '--routines',
    '--events',
    '--triggers',
    '--single-transaction',
    '--quick',
    '--skip-lock-tables',
);

if ($dbPass !== '') {
    $command[] = '--password=' . $dbPass;
}

$command[] = $dbName;

$descriptorspec = array(
    0 => array('pipe', 'r'),
    1 => array('file', $backupFilePath, 'w'),
    2 => array('pipe', 'w'),
);

$process = proc_open($command, $descriptorspec, $pipes, dirname(__DIR__), null, array('bypass_shell' => true));

if (!is_resource($process)) {
    fwrite(STDERR, "ERROR: Failed to start mysqldump process\n");
    exit(1);
}

fclose($pipes[0]);
$stderr = stream_get_contents($pipes[2]);
fclose($pipes[2]);

$exitCode = proc_close($process);

if ($exitCode !== 0) {
    if (file_exists($backupFilePath)) {
        @unlink($backupFilePath);
    }
    fwrite(STDERR, "ERROR: Backup failed (exit code {$exitCode})\n");
    if (!empty($stderr)) {
        fwrite(STDERR, $stderr . "\n");
    }
    exit($exitCode);
}

$fileSize = file_exists($backupFilePath) ? filesize($backupFilePath) : 0;
echo "Backup success: {$backupFilePath}\n";
echo "Size: {$fileSize} bytes\n";

exit(0);
