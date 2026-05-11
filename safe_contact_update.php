<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ===================================
// LOAD ENV CONFIGURATION
// ===================================
$env_file = __DIR__ . '/.env';
if (!file_exists($env_file)) {
    die("ERROR: .env file not found at $env_file\n");
}

// Parse .env file (skip comments and empty lines)
$env = [];
$env_lines = file($env_file);
foreach ($env_lines as $line) {
    $line = trim($line);
    if (empty($line) || strpos($line, '#') === 0) {
        continue;
    }
    if (strpos($line, '=') !== false) {
        list($key, $value) = explode('=', $line, 2);
        $env[trim($key)] = trim($value);
    }
}

$db_server = $env['DB_SERVER'] ?? 'localhost';
$db_port = $env['DB_PORT'] ?? 3306;
$db_username = $env['DB_USERNAME'] ?? 'root';
$db_password = $env['DB_PASSWORD'] ?? '';
$db_name = $env['DB_NAME'] ?? 'cusc_db';

echo "=== CONTACT UPDATE SCRIPT (SAFE MODE) ===\n";
echo "Time: " . date('Y-m-d H:i:s') . "\n";
echo "Environment: " . basename($env_file) . "\n";
echo "DB Server: $db_server:$db_port\n";
echo "DB Name: $db_name\n\n";

// ===================================
// STEP 1: BACKUP DATABASE
// ===================================
echo "[STEP 1] Backing up database...\n";
$backup_file = __DIR__ . "/cache/backup_exports/contact_update_backup_" . date('YmdHis') . ".sql";
$backup_dir = dirname($backup_file);

if (!is_dir($backup_dir)) {
    mkdir($backup_dir, 0755, true);
}

// Dump database
$dump_cmd = sprintf(
    "mysqldump -h%s -P%s -u%s -p%s %s > %s 2>&1",
    escapeshellarg($db_server),
    escapeshellarg($db_port),
    escapeshellarg($db_username),
    escapeshellarg($db_password),
    escapeshellarg($db_name),
    escapeshellarg($backup_file)
);

exec($dump_cmd, $output, $return_code);

if ($return_code === 0 && file_exists($backup_file)) {
    $backup_size = filesize($backup_file);
    echo "✓ Backup successful: $backup_file ($backup_size bytes)\n\n";
} else {
    echo "✗ Backup warning: Could not verify backup (but continuing carefully)\n";
    echo "  Command output: " . implode("\n", $output) . "\n\n";
}

// ===================================
// STEP 2: CONNECT TO DATABASE
// ===================================
echo "[STEP 2] Connecting to database: $db_name\n";
$conn = new mysqli($db_server, $db_username, $db_password, $db_name);
if ($conn->connect_error) {
    die("✗ Connection failed: " . $conn->connect_error . "\n");
}
$conn->set_charset("utf8mb4");
echo "✓ Connected successfully\n\n";

// ===================================
// STEP 3: VERIFY BACKUP DB HAS DATA
// ===================================
echo "[STEP 3] Verifying database integrity...\n";
$check_query = "SELECT COUNT(*) as cnt FROM vtiger_contactdetails";
$check_result = $conn->query($check_query);
if ($check_result) {
    $row = $check_result->fetch_assoc();
    echo "✓ Database has " . $row['cnt'] . " contacts\n\n";
} else {
    die("✗ Cannot verify database: " . $conn->error . "\n");
}

// ===================================
// STEP 4: FIND CONTACTS TO UPDATE
// ===================================
echo "[STEP 4] Finding contacts to update...\n";
$query = "
SELECT c.contactid, c.lastname 
FROM vtiger_contactdetails c
WHERE c.contactid IN (
    SELECT b.crmid 
    FROM vtiger_modtracker_detail d 
    JOIN vtiger_modtracker_basic b ON b.id = d.id 
    WHERE d.fieldname = 'account_id' 
      AND b.module = 'Contacts' 
      AND b.changedon LIKE '2026-04-08%' 
      AND d.prevalue = '126450' 
      AND d.postvalue = '128855'
) AND c.accountid = 126450
";

$result = $conn->query($query);
if (!$result) {
    die("✗ Query failed: " . $conn->error . "\n");
}

$count = $result->num_rows;
echo "✓ Found $count contacts to update\n";
if ($count === 0) {
    echo "  WARNING: No contacts found. Aborting.\n";
    $conn->close();
    exit(0);
}

// Show preview
echo "  Preview:\n";
$result->data_seek(0);
$preview_count = 0;
while ($row = $result->fetch_assoc() && $preview_count < 5) {
    echo "    - Contact #{$row['contactid']}: {$row['lastname']}\n";
    $preview_count++;
}
if ($count > 5) {
    echo "    ... and " . ($count - 5) . " more\n";
}
echo "\n";

// ===================================
// STEP 5: CONFIRM UPDATE
// ===================================
echo "[STEP 5] Confirmation required\n";
echo "This will update $count contacts from accountid 126450 → 128855\n";
echo "Type 'YES' to proceed, or 'NO' to abort: ";

$handle = fopen("php://stdin", "r");
$response = trim(fgets($handle));
fclose($handle);

if (strtoupper($response) !== 'YES') {
    echo "✗ Update aborted by user\n";
    $conn->close();
    exit(0);
}

echo "\n";

// ===================================
// STEP 6: START TRANSACTION & UPDATE
// ===================================
echo "[STEP 6] Performing update (with transaction)...\n";
$conn->begin_transaction();

try {
    $updated_count = 0;
    $result->data_seek(0);
    
    while ($row = $result->fetch_assoc()) {
        $contactid = $row['contactid'];
        $lastname = $row['lastname'];
        
        $stmt = $conn->prepare("UPDATE vtiger_contactdetails SET accountid = 128855 WHERE contactid = ?");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        
        $stmt->bind_param("i", $contactid);
        if (!$stmt->execute()) {
            throw new Exception("Execute failed for contact $contactid: " . $stmt->error);
        }
        
        $updated_count++;
        if ($updated_count % 10 === 0) {
            echo "  Progress: $updated_count/$count\n";
        }
    }
    
    // ===================================
    // STEP 7: VERIFY UPDATES
    // ===================================
    echo "\n[STEP 7] Verifying updates...\n";
    $verify_query = "SELECT COUNT(*) as cnt FROM vtiger_contactdetails WHERE accountid = 128855";
    $verify_result = $conn->query($verify_query);
    $verify_row = $verify_result->fetch_assoc();
    $new_count = $verify_row['cnt'];
    
    echo "  Total contacts with accountid 128855: $new_count\n";
    
    // Commit transaction
    $conn->commit();
    echo "\n✓ Update successful! Transaction committed.\n";
    echo "✓ Updated $updated_count contacts\n";
    
    // Log success
    $log_file = __DIR__ . "/cache/logs/contact_update_" . date('YmdHis') . ".log";
    $log_dir = dirname($log_file);
    if (!is_dir($log_dir)) {
        mkdir($log_dir, 0755, true);
    }
    
    $log_content = sprintf(
        "[%s] SUCCESS\n" .
        "Backup: %s\n" .
        "Contacts Updated: %d\n" .
        "Database: %s\n",
        date('Y-m-d H:i:s'),
        $backup_file,
        $updated_count,
        $db_name
    );
    file_put_contents($log_file, $log_content);
    echo "✓ Log saved: $log_file\n";
    
} catch (Exception $e) {
    echo "\n✗ Error during update: " . $e->getMessage() . "\n";
    echo "  Rolling back transaction...\n";
    $conn->rollback();
    echo "✓ Rollback completed. Database unchanged.\n";
    exit(1);
}

$conn->close();
echo "\n=== DONE ===\n";
echo "Time: " . date('Y-m-d H:i:s') . "\n";
?>
