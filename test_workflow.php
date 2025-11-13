<?php
// Test workflow functionality by creating a contact manually

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'vtiger';

try {
    $mysqli = new mysqli($host, $username, $password, $database);
    
    if ($mysqli->connect_error) {
        die('Connection failed: ' . $mysqli->connect_error);
    }
    
    echo "=== Testing Workflow Functionality ===\n\n";
    
    // First, let's see what happens with a test contact via direct API
    echo "1. Current contacts with mobile networks data:\n";
    $contactQuery = "SELECT 
        c.contactid, 
        c.firstname, 
        c.lastname, 
        c.mobile,
        ccf.cf_1404 as mobile_networks
    FROM vtiger_crmentity ce
    JOIN vtiger_contactdetails c ON ce.crmid = c.contactid
    LEFT JOIN vtiger_contactscf ccf ON c.contactid = ccf.contactid
    WHERE ce.deleted = 0 
    AND c.mobile IS NOT NULL 
    AND c.mobile != ''
    ORDER BY ce.modifiedtime DESC 
    LIMIT 10";
    
    $result = $mysqli->query($contactQuery);
    
    if ($result->num_rows > 0) {
        printf("%-8s %-15s %-15s %-12s %-15s\n", "ID", "First Name", "Last Name", "Mobile", "Networks");
        echo str_repeat("-", 70) . "\n";
        
        while ($row = $result->fetch_assoc()) {
            printf("%-8s %-15s %-15s %-12s %-15s\n", 
                $row['contactid'], 
                substr($row['firstname'], 0, 14), 
                substr($row['lastname'], 0, 14), 
                $row['mobile'], 
                $row['mobile_networks'] ?: 'NULL'
            );
        }
    } else {
        echo "No contacts with mobile numbers found.\n";
    }
    
    echo "\n2. Checking workflow task details:\n";
    $taskQuery = "SELECT 
        wf.workflow_id,
        wf.workflowname,
        wf.execution_condition,
        wft.task_id,
        wft.summary,
        wft.task
    FROM com_vtiger_workflows wf
    JOIN com_vtiger_workflowtasks wft ON wf.workflow_id = wft.workflow_id
    WHERE wf.module_name = 'Contacts' 
    AND wf.workflowname LIKE '%Mobile%'
    AND wf.status = 1";
    
    $result = $mysqli->query($taskQuery);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Workflow: {$row['workflowname']} (ID: {$row['workflow_id']})\n";
            echo "Task: {$row['summary']}\n";
            echo "Task Details: " . substr($row['task'], 0, 200) . "...\n";
            echo str_repeat("-", 50) . "\n";
        }
    }
    
    echo "\n3. Testing import detection:\n";
    echo "Ready to test import functionality.\n";
    echo "Next step: Import test_contacts.csv through VTiger interface\n";
    echo "Expected: Mobile networks field should be automatically populated\n";
    echo "- 034 numbers should map to 'Viettel'\n";
    echo "- 084 numbers should map to appropriate carrier\n";
    echo "- 096 numbers should map to appropriate carrier\n";
    
    $mysqli->close();
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>