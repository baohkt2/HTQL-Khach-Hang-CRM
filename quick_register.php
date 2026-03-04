<?php
// Quick handler registration using direct MySQL connection

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'vtiger';

try {
    $mysqli = new mysqli($host, $username, $password, $database);
    
    if ($mysqli->connect_error) {
        die('Connection failed: ' . $mysqli->connect_error);
    }
    
    echo "Connected to database successfully\n";
    
    // Check existing handler
    $checkQuery = "SELECT * FROM vtiger_eventhandlers WHERE handler_class = 'VTBatchEventHandler'";
    $result = $mysqli->query($checkQuery);
    
    if ($result->num_rows > 0) {
        echo "Handler already exists. Removing...\n";
        $mysqli->query("DELETE FROM vtiger_eventhandlers WHERE handler_class = 'VTBatchEventHandler'");
    }
    
    // Insert new handler
    $insertQuery = "INSERT INTO vtiger_eventhandlers (event_name, handler_path, handler_class, cond, is_active) VALUES (?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($insertQuery);
    $event_name = 'vtiger.batchevent.save';
    $handler_path = 'modules/com_vtiger_workflow/VTBatchEventHandler.inc';
    $handler_class = 'VTBatchEventHandler';
    $cond = '';
    $is_active = 1;
    
    $stmt->bind_param('ssssi', $event_name, $handler_path, $handler_class, $cond, $is_active);
    
    if ($stmt->execute()) {
        echo "Handler registered successfully!\n";
        
        // Verify
        $result = $mysqli->query($checkQuery);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "Verification successful:\n";
            echo "- ID: " . $row['eventhandler_id'] . "\n";
            echo "- Event: " . $row['event_name'] . "\n";
            echo "- Handler: " . $row['handler_class'] . "\n";
            echo "- Active: " . ($row['is_active'] ? 'Yes' : 'No') . "\n";
        }
    } else {
        echo "Error: " . $stmt->error . "\n";
    }
    
    $mysqli->close();
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>