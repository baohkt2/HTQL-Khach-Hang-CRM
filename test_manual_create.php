<?php
// Test workflow by creating a contact manually via webservice

error_reporting(E_ALL);
ini_set('display_errors', 1);

chdir(dirname(__FILE__));
include_once('config.inc.php');
include_once('include/database/PearDatabase.php');
include_once('include/Webservices/Create.php');
include_once('modules/Users/Users.php');

echo "=== Testing Workflow Manually ===\n";

try {
    // Get admin user
    $adminUser = new Users();
    $adminUser->retrieveCurrentUserInfoFromFile(1); // Admin user ID = 1
    
    echo "User: " . $adminUser->user_name . "\n";
    
    // Test contact data
    $contactData = array(
        'firstname' => 'Test',
        'lastname' => 'Manual User',
        'mobile' => '0341234999',
        'email' => 'testmanual@example.com'
    );
    
    echo "Creating contact with mobile: " . $contactData['mobile'] . "\n";
    
    // Create contact via webservice
    $result = vtws_create('Contacts', $contactData, $adminUser);
    
    echo "Contact created with ID: " . $result['id'] . "\n";
    
    // Get the record ID
    $idComponents = vtws_getIdComponents($result['id']);
    $recordId = $idComponents[1];
    
    echo "Record ID: " . $recordId . "\n";
    
    // Check if Mobile networks field was populated
    $adb = PearDatabase::getInstance();
    $checkQuery = "SELECT cf_1404 FROM vtiger_contactscf WHERE contactid = ?";
    $checkResult = $adb->pquery($checkQuery, array($recordId));
    
    if ($adb->num_rows($checkResult) > 0) {
        $mobileNetworks = $adb->query_result($checkResult, 0, 'cf_1404');
        echo "Mobile networks field: " . ($mobileNetworks ?: 'NULL') . "\n";
        
        if ($mobileNetworks) {
            echo "✅ Workflow working! Mobile networks mapped to: $mobileNetworks\n";
        } else {
            echo "❌ Workflow NOT working! Mobile networks field is empty\n";
        }
    } else {
        echo "❌ No custom field record found\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>