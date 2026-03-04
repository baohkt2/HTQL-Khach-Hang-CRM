<?php
// Check workflow details
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'vtiger';

try {
    $mysqli = new mysqli($host, $username, $password, $database);
    
    if ($mysqli->connect_error) {
        die('Connection failed: ' . $mysqli->connect_error);
    }
    
    echo "=== Detailed Workflow Analysis ===\n\n";
    
    // Get detailed workflow info
    $workflowQuery = "
        SELECT 
            w.workflow_id,
            w.workflowname,
            w.module_name,
            w.execution_condition,
            w.status,
            t.task_id,
            t.summary,
            t.task
        FROM com_vtiger_workflows w 
        LEFT JOIN com_vtiger_workflowtasks t ON w.workflow_id = t.workflow_id
        WHERE w.module_name = 'Contacts' 
        AND w.status = 1
        ORDER BY w.workflow_id
    ";
    
    $result = $mysqli->query($workflowQuery);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Workflow ID: {$row['workflow_id']}\n";
            echo "Name: {$row['workflowname']}\n";
            echo "Module: {$row['module_name']}\n";
            echo "Execution Condition: {$row['execution_condition']} ";
            
            switch ($row['execution_condition']) {
                case 1: echo "(ON_FIRST_SAVE)\n"; break;
                case 2: echo "(ONCE)\n"; break;
                case 3: echo "(ON_EVERY_SAVE)\n"; break;
                case 4: echo "(ON_MODIFY)\n"; break;
                case 5: echo "(ON_DELETE)\n"; break;
                case 6: echo "(ON_SCHEDULE)\n"; break;
                default: echo "(UNKNOWN)\n"; break;
            }
            
            echo "Status: " . ($row['status'] ? 'Active' : 'Inactive') . "\n";
            
            if ($row['task_id']) {
                echo "Task ID: {$row['task_id']}\n";
                echo "Task Summary: {$row['summary']}\n";
                
                // Parse task details
                if ($row['task']) {
                    $taskData = unserialize($row['task']);
                    if ($taskData && is_object($taskData)) {
                        echo "Task Type: " . get_class($taskData) . "\n";
                        if (property_exists($taskData, 'field_value_mapping')) {
                            echo "Field Mappings: " . $taskData->field_value_mapping . "\n";
                        }
                    }
                }
            }
            
            echo str_repeat("-", 70) . "\n\n";
        }
    } else {
        echo "No active workflows found for Contacts module!\n";
    }
    
    // Check if VTWorkflowEventHandler is registered
    echo "=== Event Handler Check ===\n";
    $handlerQuery = "SELECT * FROM vtiger_eventhandlers WHERE handler_class LIKE '%Workflow%'";
    $result = $mysqli->query($handlerQuery);
    
    while ($row = $result->fetch_assoc()) {
        echo "Handler: {$row['handler_class']}\n";
        echo "Event: {$row['event_name']}\n";
        echo "Path: {$row['handler_path']}\n";
        echo "Active: " . ($row['is_active'] ? 'Yes' : 'No') . "\n";
        echo "---\n";
    }
    
    $mysqli->close();
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>