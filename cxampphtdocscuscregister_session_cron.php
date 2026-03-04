<?php
// Script to register the session expiration cron job in Vtiger
chdir(dirname(__FILE__));
require_once 'includes/main/WebUI.php';
require_once 'vtlib/Vtiger/Cron.php';

$cronName = 'UpdateExpiredSessions';
$cronHandler = 'cron/UpdateExpiredSessions.php';
$cronFrequency = 300; // 5 minutes in seconds
$cronModule = 'Users';
$cronDescription = 'Auto Update Logout Time for Expired Sessions';

// Check if it already exists
$adb = PearDatabase::getInstance();
$result = $adb->pquery("SELECT 1 FROM vtiger_cron_task WHERE name=?", array($cronName));

if ($adb->num_rows($result) > 0) {
    echo "Cron job '{$cronName}' is already registered.\n";
    
    // Update it just in case
    Vtiger_Cron::querySilent('UPDATE vtiger_cron_task SET handler_file=?, frequency=?, module=?, description=? WHERE name=?',
        array($cronHandler, $cronFrequency, $cronModule, $cronDescription, $cronName)
    );
    echo "Updated existing cron job properties.\n";
} else {
    // Register new
    Vtiger_Cron::register($cronName, $cronHandler, $cronFrequency, $cronModule, 1, 0, $cronDescription);
    echo "Successfully registered cron job '{$cronName}'.\n";
}
echo "Done.\n";
?>
