<?php
/*+**********************************************************************************
 * This script registers the VTDeleteEventHandler for vtiger.entity.afterdelete event
 * Run this file once to enable ON_DELETE workflow functionality
 * 
 * Usage: php register_delete_workflow_handler.php
 ************************************************************************************/

require_once('vtlib/Vtiger/Module.php');
require_once('include/events/include.inc');

global $adb;

echo "Registering VTDeleteEventHandler for vtiger.entity.afterdelete event...\n";

$em = new VTEventsManager($adb);

// Check if handler already exists
$checkQuery = "SELECT * FROM vtiger_eventhandlers WHERE event_name = 'vtiger.entity.afterdelete' AND handler_class = 'VTDeleteEventHandler'";
$result = $adb->query($checkQuery);

if ($adb->num_rows($result) > 0) {
    echo "Handler already registered!\n";
} else {
    // Register the handler
    $em->registerHandler(
        'vtiger.entity.afterdelete', 
        'modules/com_vtiger_workflow/VTDeleteEventHandler.inc', 
        'VTDeleteEventHandler'
    );
    echo "Successfully registered VTDeleteEventHandler!\n";
}

echo "\nON_DELETE workflow feature is now enabled.\n";
echo "You can now create workflows that trigger when records are deleted.\n";

?>
