<?php
// Check workflow configuration for Mobile networks mapping

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'vtiger';

try {
    $mysqli = new mysqli($host, $username, $password, $database);
    
    if ($mysqli->connect_error) {
        die('Connection failed: ' . $mysqli->connect_error);
    }
    
    echo "=== Workflow Configuration Check ===\n\n";
    
    // Check Contact workflows
    echo "1. Contact Workflows:\n";
    $workflowQuery = "SELECT workflow_id, workflowname, module_name, execution_condition, status FROM com_vtiger_workflows WHERE module_name = 'Contacts' AND status = 1";
    $result = $mysqli->query($workflowQuery);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $condition = '';
            switch ($row['execution_condition']) {
                case 1: $condition = 'ON_FIRST_SAVE'; break;
                case 2: $condition = 'ONCE'; break;
                case 3: $condition = 'ON_EVERY_SAVE'; break;
                case 4: $condition = 'ON_MODIFY'; break;
                case 5: $condition = 'ON_DELETE'; break;
                case 6: $condition = 'ON_SCHEDULE'; break;
                default: $condition = 'UNKNOWN'; break;
            }
            
            echo "   - ID: {$row['workflow_id']}, Name: {$row['workflowname']}, Condition: $condition\n";
            
            // Check tasks for this workflow
            $taskQuery = "SELECT task_id, summary FROM com_vtiger_workflowtasks WHERE workflow_id = {$row['workflow_id']}";
            $taskResult = $mysqli->query($taskQuery);
            
            if ($taskResult->num_rows > 0) {
                while ($taskRow = $taskResult->fetch_assoc()) {
                    echo "     * Task: {$taskRow['summary']}\n";
                }
            }
        }
    } else {
        echo "   No active Contact workflows found!\n";
    }
    
    echo "\n2. Event Handlers:\n";
    $handlerQuery = "SELECT * FROM vtiger_eventhandlers WHERE event_name LIKE '%save%' ORDER BY event_name";
    $result = $mysqli->query($handlerQuery);
    
    while ($row = $result->fetch_assoc()) {
        $marker = ($row['handler_class'] == 'VTBatchEventHandler') ? '👉' : '  ';
        echo "   {$marker} {$row['event_name']} -> {$row['handler_class']} (Active: " . ($row['is_active'] ? 'Yes' : 'No') . ")\n";
    }
    
    echo "\n3. Mobile networks field check:\n";
    $fieldQuery = "SELECT * FROM vtiger_field WHERE fieldname LIKE '%mobile%' OR fieldlabel LIKE '%Mobile%' OR fieldlabel LIKE '%networks%'";
    $result = $mysqli->query($fieldQuery);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "   - Field: {$row['fieldname']}, Label: {$row['fieldlabel']}, Table: {$row['tablename']}\n";
        }
    } else {
        echo "   No mobile/networks fields found!\n";
    }
    
    echo "\n4. Custom fields check:\n";
    $customFieldQuery = "SELECT * FROM vtiger_field WHERE fieldname LIKE 'cf_%' AND tabid = (SELECT tabid FROM vtiger_tab WHERE name = 'Contacts')";
    $result = $mysqli->query($customFieldQuery);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "   - Custom Field: {$row['fieldname']}, Label: {$row['fieldlabel']}\n";
        }
    }
    
    $mysqli->close();
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>