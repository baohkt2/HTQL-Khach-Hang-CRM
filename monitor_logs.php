<?php
// Clear old logs and show recent ones
$logFile = 'C:/xampp/apache/logs/error.log';

echo "=== Clearing old logs and monitoring new ones ===\n";

// Get current size
$currentSize = filesize($logFile);
echo "Current log size: " . number_format($currentSize) . " bytes\n";
echo "Monitoring from this point...\n\n";

// Monitor for new entries
$lastSize = $currentSize;
$startTime = time();

echo "Waiting for new log entries (import a contact now)...\n";
echo "Press Ctrl+C to stop\n\n";

while (true) {
    clearstatcache();
    $newSize = filesize($logFile);
    
    if ($newSize > $lastSize) {
        // New content added
        $handle = fopen($logFile, 'r');
        fseek($handle, $lastSize);
        
        echo "=== NEW LOG ENTRIES ===\n";
        while (($line = fgets($handle)) !== false) {
            if (strpos($line, 'VTBatch') !== false || 
                strpos($line, 'Import_Data_Action') !== false ||
                strpos($line, 'batchevent') !== false) {
                echo ">>> " . trim($line) . "\n";
            }
        }
        fclose($handle);
        echo "========================\n\n";
        
        $lastSize = $newSize;
    }
    
    // Show elapsed time
    $elapsed = time() - $startTime;
    echo "\rWaiting... (" . $elapsed . "s)";
    
    sleep(1);
    
    // Stop after 60 seconds
    if ($elapsed > 60) {
        echo "\nTimeout reached. Stopping monitor.\n";
        break;
    }
}
?>