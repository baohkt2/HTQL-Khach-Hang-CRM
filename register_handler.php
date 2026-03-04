<?php
// Simple script to register VTBatchEventHandler
// Run this from command line: php register_handler.php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include vtiger config and database
chdir(dirname(__FILE__));
include_once('config.inc.php');
include_once('include/database/PearDatabase.php');

// Get database connection
$adb = PearDatabase::getInstance();

echo "=== VTiger Batch Event Handler Registration ===\n";
echo "Database: " . $dbconfig['db_name'] . "@" . $dbconfig['db_server'] . "\n\n";

try {
    // Check if handler already exists
    $checkQuery = "SELECT * FROM vtiger_eventhandlers WHERE handler_class = 'VTBatchEventHandler'";
    $checkResult = $adb->pquery($checkQuery, array());
    
    if ($adb->num_rows($checkResult) > 0) {
        echo "❌ Handler already exists! Removing old registration...\n";
        $deleteQuery = "DELETE FROM vtiger_eventhandlers WHERE handler_class = 'VTBatchEventHandler'";
        $adb->pquery($deleteQuery, array());
        echo "✅ Old registration removed.\n\n";
    }
    
    // Register new handler
    echo "📝 Registering VTBatchEventHandler...\n";
    $insertQuery = "INSERT INTO vtiger_eventhandlers (event_name, handler_path, handler_class, cond, is_active) VALUES (?, ?, ?, ?, ?)";
    $insertParams = array(
        'vtiger.batchevent.save',
        'modules/com_vtiger_workflow/VTBatchEventHandler.inc',
        'VTBatchEventHandler',
        '',
        1
    );
    
    $adb->pquery($insertQuery, $insertParams);
    echo "✅ Handler registered successfully!\n\n";
    
    // Verify registration
    echo "🔍 Verifying registration...\n";
    $verifyResult = $adb->pquery($checkQuery, array());
    
    if ($adb->num_rows($verifyResult) > 0) {
        $row = $adb->fetchByAssoc($verifyResult);
        echo "✅ Registration verified:\n";
        echo "   - Event: " . $row['event_name'] . "\n";
        echo "   - Handler: " . $row['handler_class'] . "\n";
        echo "   - Path: " . $row['handler_path'] . "\n";
        echo "   - Active: " . ($row['is_active'] ? 'Yes' : 'No') . "\n\n";
    } else {
        echo "❌ Registration verification failed!\n\n";
    }
    
    // Show all event handlers
    echo "📋 All Event Handlers:\n";
    echo str_repeat("-", 80) . "\n";
    printf("%-5s %-30s %-25s %-6s\n", "ID", "Event", "Handler", "Active");
    echo str_repeat("-", 80) . "\n";
    
    $allQuery = "SELECT * FROM vtiger_eventhandlers ORDER BY event_name, handler_class";
    $allResult = $adb->pquery($allQuery, array());
    
    while ($row = $adb->fetchByAssoc($allResult)) {
        $marker = ($row['handler_class'] == 'VTBatchEventHandler') ? '👉' : '  ';
        printf("%s %-3s %-30s %-25s %-6s\n", 
            $marker,
            $row['eventhandler_id'], 
            substr($row['event_name'], 0, 29), 
            substr($row['handler_class'], 0, 24), 
            $row['is_active'] ? 'Yes' : 'No'
        );
    }
    
    echo "\n✨ Registration complete! Next steps:\n";
    echo "1. Restart Apache web server\n";
    echo "2. Test import with contact records containing mobile numbers\n";
    echo "3. Verify Mobile networks field is mapped correctly (034 → Viettel)\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
?>