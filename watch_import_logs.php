<?php
// Monitor Apache error log for Import_Data_Action messages
$logFile = 'C:/xampp/apache/logs/error.log';

echo "=== Monitoring Import Logs ===\n";
echo "Import a contact now and watch for logs...\n\n";

if (!file_exists($logFile)) {
    echo "Error: Log file not found at $logFile\n";
    exit(1);
}

// Get current log size
$lastSize = filesize($logFile);
$startTime = time();

echo "Ready. Import single_test.csv now...\n";
echo "Watching for Import_Data_Action logs...\n\n";

while (true) {
    clearstatcache();
    $currentSize = filesize($logFile);
    
    if ($currentSize > $lastSize) {
        // Read new content
        $handle = fopen($logFile, 'r');
        fseek($handle, $lastSize);
        
        $newLogs = false;
        while (($line = fgets($handle)) !== false) {
            if (strpos($line, 'Import_Data_Action') !== false) {
                echo ">>> " . trim($line) . "\n";
                $newLogs = true;
            }
        }
        
        if ($newLogs) {
            echo "\n";
        }
        
        fclose($handle);
        $lastSize = $currentSize;
    }
    
    $elapsed = time() - $startTime;
    if ($elapsed > 120) { // 2 minutes timeout
        echo "\nTimeout reached. Stopping monitor.\n";
        break;
    }
    
    usleep(500000); // 0.5 second
}
?>