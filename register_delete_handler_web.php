<!DOCTYPE html>
<html>
<head>
    <title>Register ON_DELETE Workflow Handler</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .success { color: green; font-weight: bold; }
        .error { color: red; font-weight: bold; }
        .info { color: blue; }
        pre { background: #f4f4f4; padding: 10px; border: 1px solid #ddd; }
    </style>
</head>
<body>
    <h1>Register ON_DELETE Workflow Handler</h1>
    
    <?php
    // Include Vtiger config
    require_once('config.inc.php');
    require_once('include/database/PearDatabase.php');
    
    global $adb;
    
    echo "<h2>Step 1: Check current event handlers</h2>";
    $query = "SELECT * FROM vtiger_eventhandlers WHERE event_name = 'vtiger.entity.afterdelete'";
    $result = $adb->query($query);
    
    echo "<pre>";
    echo "Found " . $adb->num_rows($result) . " handler(s) for afterdelete event\n";
    while ($row = $adb->fetchByAssoc($result)) {
        print_r($row);
    }
    echo "</pre>";
    
    echo "<h2>Step 2: Register VTDeleteEventHandler</h2>";
    
    // Check if already registered
    $checkQuery = "SELECT * FROM vtiger_eventhandlers WHERE event_name = 'vtiger.entity.afterdelete' AND handler_class = 'VTDeleteEventHandler'";
    $checkResult = $adb->query($checkQuery);
    
    if ($adb->num_rows($checkResult) > 0) {
        echo "<p class='info'>✓ Handler already registered!</p>";
    } else {
        // Insert handler
        $insertQuery = "INSERT INTO vtiger_eventhandlers (event_name, handler_path, handler_class, cond, is_active) 
                       VALUES ('vtiger.entity.afterdelete', 'modules/com_vtiger_workflow/VTDeleteEventHandler.inc', 'VTDeleteEventHandler', '', 1)";
        
        $insertResult = $adb->query($insertQuery);
        
        if ($insertResult) {
            echo "<p class='success'>✓ Successfully registered VTDeleteEventHandler!</p>";
        } else {
            echo "<p class='error'>✗ Failed to register handler</p>";
        }
    }
    
    echo "<h2>Step 3: Verify workflows</h2>";
    $workflowQuery = "SELECT workflow_id, workflowname, module_name, execution_condition, status 
                     FROM com_vtiger_workflows 
                     WHERE execution_condition = 5";
    $workflowResult = $adb->query($workflowQuery);
    
    echo "<pre>";
    echo "Found " . $adb->num_rows($workflowResult) . " workflow(s) with ON_DELETE trigger\n";
    while ($row = $adb->fetchByAssoc($workflowResult)) {
        print_r($row);
    }
    echo "</pre>";
    
    echo "<h2>Step 4: Test file syntax</h2>";
    $handlerFile = 'modules/com_vtiger_workflow/VTDeleteEventHandler.inc';
    if (file_exists($handlerFile)) {
        echo "<p class='success'>✓ Handler file exists: $handlerFile</p>";
        
        // Try to include it to check for syntax errors
        try {
            require_once($handlerFile);
            echo "<p class='success'>✓ Handler file loaded successfully - no syntax errors</p>";
        } catch (Exception $e) {
            echo "<p class='error'>✗ Handler file has errors: " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p class='error'>✗ Handler file NOT found: $handlerFile</p>";
    }
    
    echo "<h2>Summary</h2>";
    echo "<p>ON_DELETE workflow functionality is now configured.</p>";
    echo "<p><strong>Next steps:</strong></p>";
    echo "<ol>";
    echo "<li>Make sure your workflow 'Trừ 1' has execution_condition = 5 in the database</li>";
    echo "<li>Make sure the workflow status = 1 (active)</li>";
    echo "<li>Try deleting a contact and check if workflow executes</li>";
    echo "</ol>";
    ?>
    
</body>
</html>
