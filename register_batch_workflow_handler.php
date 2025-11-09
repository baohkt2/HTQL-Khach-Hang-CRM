<?php
/*+**********************************************************************************
 * Register Batch Event Handler for Workflows during Import
 * This script registers the VTBatchEventHandler to enable workflows during import
 ************************************************************************************/

include_once('vtlib/Vtiger/Module.php');
include_once('includes/main/WebUI.php');
include_once('include/events/include.inc');

global $adb;

echo "<h2>Registering Batch Event Handler for Workflows</h2>";

// Check if handler is already registered
$checkQuery = "SELECT * FROM vtiger_eventhandlers WHERE handler_class = ? AND event_name = ?";
$checkResult = $adb->pquery($checkQuery, array('VTBatchEventHandler', 'vtiger.batchevent.save'));

if ($adb->num_rows($checkResult) > 0) {
    echo "<p style='color: orange;'>⚠️ VTBatchEventHandler is already registered for vtiger.batchevent.save</p>";
    
    // Show current registration details
    $row = $adb->fetchByAssoc($checkResult);
    echo "<h3>Current Registration:</h3>";
    echo "<ul>";
    echo "<li><strong>Event Handler ID:</strong> " . $row['eventhandler_id'] . "</li>";
    echo "<li><strong>Event Name:</strong> " . $row['event_name'] . "</li>";
    echo "<li><strong>Handler Path:</strong> " . $row['handler_path'] . "</li>";
    echo "<li><strong>Handler Class:</strong> " . $row['handler_class'] . "</li>";
    echo "<li><strong>Active:</strong> " . ($row['is_active'] ? 'Yes' : 'No') . "</li>";
    echo "</ul>";
    
    // Option to re-register
    echo "<h3>Re-register Handler?</h3>";
    echo "<p>Click the button below to unregister and re-register the handler:</p>";
    if (isset($_GET['reregister']) && $_GET['reregister'] == 'true') {
        // Delete existing registration
        $deleteQuery = "DELETE FROM vtiger_eventhandlers WHERE handler_class = ? AND event_name = ?";
        $adb->pquery($deleteQuery, array('VTBatchEventHandler', 'vtiger.batchevent.save'));
        echo "<p style='color: blue;'>🔄 Existing registration removed. Proceeding with new registration...</p>";
    } else {
        echo "<a href='?reregister=true' style='background: #007cba; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Re-register Handler</a>";
        echo "<br><br>";
        goto skipRegistration;
    }
}

try {
    // Register the batch event handler
    $em = new VTEventsManager($adb);
    $em->registerHandler(
        'vtiger.batchevent.save',
        'modules/com_vtiger_workflow/VTBatchEventHandler.inc',
        'VTBatchEventHandler'
    );
    
    echo "<p style='color: green;'>✅ VTBatchEventHandler registered successfully!</p>";
    
    // Verify registration
    $verifyQuery = "SELECT * FROM vtiger_eventhandlers WHERE handler_class = ? AND event_name = ?";
    $verifyResult = $adb->pquery($verifyQuery, array('VTBatchEventHandler', 'vtiger.batchevent.save'));
    
    if ($adb->num_rows($verifyResult) > 0) {
        $row = $adb->fetchByAssoc($verifyResult);
        echo "<h3>Registration Verified:</h3>";
        echo "<ul>";
        echo "<li><strong>Event Handler ID:</strong> " . $row['eventhandler_id'] . "</li>";
        echo "<li><strong>Event Name:</strong> " . $row['event_name'] . "</li>";
        echo "<li><strong>Handler Path:</strong> " . $row['handler_path'] . "</li>";
        echo "<li><strong>Handler Class:</strong> " . $row['handler_class'] . "</li>";
        echo "<li><strong>Active:</strong> " . ($row['is_active'] ? 'Yes' : 'No') . "</li>";
        echo "</ul>";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Error registering handler: " . $e->getMessage() . "</p>";
}

skipRegistration:

echo "<h3>All Event Handlers:</h3>";
echo "<table border='1' cellpadding='5' cellspacing='0' style='border-collapse: collapse;'>";
echo "<tr style='background: #f5f5f5;'>";
echo "<th>ID</th><th>Event Name</th><th>Handler Class</th><th>Handler Path</th><th>Active</th>";
echo "</tr>";

$allHandlersQuery = "SELECT * FROM vtiger_eventhandlers ORDER BY event_name, handler_class";
$allHandlersResult = $adb->pquery($allHandlersQuery, array());

while ($row = $adb->fetchByAssoc($allHandlersResult)) {
    $style = '';
    if ($row['handler_class'] == 'VTBatchEventHandler') {
        $style = 'background: #e7f7e7;'; // Highlight our handler
    }
    echo "<tr style='$style'>";
    echo "<td>" . $row['eventhandler_id'] . "</td>";
    echo "<td>" . $row['event_name'] . "</td>";
    echo "<td>" . $row['handler_class'] . "</td>";
    echo "<td>" . $row['handler_path'] . "</td>";
    echo "<td>" . ($row['is_active'] ? 'Yes' : 'No') . "</td>";
    echo "</tr>";
}

echo "</table>";

echo "<h3>Next Steps:</h3>";
echo "<ol>";
echo "<li>Restart Apache web server to ensure the new handler is loaded</li>";
echo "<li>Test import functionality with contacts that have mobile phone numbers</li>";
echo "<li>Check that Mobile networks field is properly mapped (034 → Viettel, etc.)</li>";
echo "</ol>";

echo "<h3>Troubleshooting:</h3>";
echo "<ul>";
echo "<li>Check Apache error logs for any handler errors</li>";
echo "<li>Verify your workflow conditions and tasks are properly configured</li>";
echo "<li>Ensure Mobile networks field mapping workflows are active</li>";
echo "</ul>";

echo "<p><em>Handler registration completed at " . date('Y-m-d H:i:s') . "</em></p>";
?>