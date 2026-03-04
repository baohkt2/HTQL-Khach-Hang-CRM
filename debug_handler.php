<?php
// Debug batch event handler
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'vtiger';

try {
    $mysqli = new mysqli($host, $username, $password, $database);
    
    if ($mysqli->connect_error) {
        die('Connection failed: ' . $mysqli->connect_error);
    }
    
    echo "=== Debug Batch Event Handler ===\n\n";
    
    // Check if our handler is properly registered
    echo "1. Event Handler Registration:\n";
    $handlerQuery = "SELECT * FROM vtiger_eventhandlers WHERE handler_class = 'VTBatchEventHandler'";
    $result = $mysqli->query($handlerQuery);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "✅ Handler registered:\n";
        echo "   - ID: {$row['eventhandler_id']}\n";
        echo "   - Event: {$row['event_name']}\n";
        echo "   - Path: {$row['handler_path']}\n";
        echo "   - Active: " . ($row['is_active'] ? 'Yes' : 'No') . "\n";
    } else {
        echo "❌ Handler NOT registered!\n";
    }
    
    // Check the actual workflow configuration
    echo "\n2. Workflow Configuration:\n";
    $workflowQuery = "SELECT w.*, t.task FROM com_vtiger_workflows w 
                      LEFT JOIN com_vtiger_workflowtasks t ON w.workflow_id = t.workflow_id
                      WHERE w.workflowname LIKE '%Mobile%' OR w.workflowname LIKE '%Vietnam%'";
    $result = $mysqli->query($workflowQuery);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Workflow ID: {$row['workflow_id']}\n";
            echo "Name: {$row['workflowname']}\n";
            echo "Module: {$row['module_name']}\n";
            echo "Condition: {$row['execution_condition']}\n";
            echo "Status: " . ($row['status'] ? 'Active' : 'Inactive') . "\n";
            if ($row['task']) {
                echo "Task: " . substr($row['task'], 0, 300) . "...\n";
            }
            echo str_repeat("-", 50) . "\n";
        }
    }
    
    // Check latest imported contacts
    echo "\n3. Latest Imported Contacts:\n";
    $contactQuery = "SELECT 
        c.contactid, 
        c.firstname, 
        c.lastname, 
        c.mobile,
        ccf.cf_1404 as mobile_networks,
        ce.createdtime
    FROM vtiger_crmentity ce
    JOIN vtiger_contactdetails c ON ce.crmid = c.contactid
    LEFT JOIN vtiger_contactscf ccf ON c.contactid = ccf.contactid
    WHERE ce.deleted = 0 
    AND c.mobile IS NOT NULL 
    AND c.mobile != ''
    ORDER BY ce.createdtime DESC 
    LIMIT 10";
    
    $result = $mysqli->query($contactQuery);
    
    if ($result->num_rows > 0) {
        printf("%-8s %-15s %-15s %-12s %-15s %-20s\n", "ID", "First Name", "Last Name", "Mobile", "Networks", "Created");
        echo str_repeat("-", 90) . "\n";
        
        while ($row = $result->fetch_assoc()) {
            printf("%-8s %-15s %-15s %-12s %-15s %-20s\n", 
                $row['contactid'], 
                substr($row['firstname'] ?: '', 0, 14), 
                substr($row['lastname'] ?: '', 0, 14), 
                $row['mobile'], 
                $row['mobile_networks'] ?: 'NULL',
                $row['createdtime']
            );
        }
    }
    
    $mysqli->close();
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>