<?php
// Test import process directly
require_once 'vtlib/Vtiger/Module.php';

// Initialize the environment
chdir(dirname(__FILE__));
global $current_user, $adb;

// Mock user and database
$current_user = new stdClass();
$current_user->id = 1;
$current_user->is_admin = 'on';

require_once 'include/utils/utils.php';
require_once 'modules/Import/views/Main.php';

// Create a request
$_REQUEST['module'] = 'Contacts';
$_REQUEST['src_module'] = 'Contacts';
$_REQUEST['field_mapping'] = json_encode(array(
    'firstname' => 'firstname',
    'lastname' => 'lastname', 
    'mobile' => 'mobile'
));
$_REQUEST['has_header'] = 1;
$_REQUEST['merge_type'] = 0;

$request = new Vtiger_Request($_REQUEST);

echo "Starting import test...\n";

// Try to trigger import
try {
    Import_Main_View::import($request, $current_user);
    echo "Import completed successfully\n";
} catch (Exception $e) {
    echo "Import failed: " . $e->getMessage() . "\n";
}
?>