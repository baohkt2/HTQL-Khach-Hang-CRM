<?php
/**
 * Workflow Diagnostic Script
 * Identifies why workflows don't trigger on record save
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: text/html; charset=utf-8');

chdir(dirname(__FILE__));
require_once 'config.inc.php';
require_once 'include/database/PearDatabase.php';

$adb = PearDatabase::getInstance();

echo "<h1>🔧 Workflow Diagnostic Report</h1>";
echo "<pre>";

// ============================================================
// CHECK 1: Event Handler Registration
// ============================================================
echo "\n=== CHECK 1: Event Handler Registration ===\n";
$result = $adb->pquery("SELECT * FROM vtiger_eventhandlers ORDER BY eventhandler_id", array());
$rows = $adb->num_rows($result);
echo "Total event handlers: $rows\n\n";

$criticalHandlers = array(
    'VTEntityDelta_beforesave' => false,
    'VTEntityDelta_aftersave' => false,
    'VTWorkflowEventHandler' => false,
);

for ($i = 0; $i < $rows; $i++) {
    $id = $adb->query_result($result, $i, 'eventhandler_id');
    $event = $adb->query_result($result, $i, 'event_name');
    $class = $adb->query_result($result, $i, 'handler_class');
    $path = $adb->query_result($result, $i, 'handler_path');
    $active = $adb->query_result($result, $i, 'is_active');
    $depOn = $adb->query_result($result, $i, 'dependent_on');
    
    $status = $active ? '✅ ACTIVE' : '❌ INACTIVE';
    
    if ($class == 'VTEntityDelta' && $event == 'vtiger.entity.beforesave') {
        $criticalHandlers['VTEntityDelta_beforesave'] = array('active' => $active, 'path' => $path);
    }
    if ($class == 'VTEntityDelta' && $event == 'vtiger.entity.aftersave') {
        $criticalHandlers['VTEntityDelta_aftersave'] = array('active' => $active, 'path' => $path);
    }
    if ($class == 'VTWorkflowEventHandler' && $event == 'vtiger.entity.aftersave') {
        $criticalHandlers['VTWorkflowEventHandler'] = array('active' => $active, 'path' => $path, 'dependent_on' => $depOn);
    }
    
    if (in_array($class, array('VTEntityDelta', 'VTWorkflowEventHandler'))) {
        echo "  [$id] $status | $event | $class | path=$path | depends=$depOn\n";
        
        // Check if handler file exists
        if (!file_exists($path)) {
            echo "     ⚠️ CRITICAL: Handler file NOT FOUND at: $path\n";
        }
    }
}

echo "\n--- Critical Handler Summary ---\n";
foreach ($criticalHandlers as $name => $info) {
    if ($info === false) {
        echo "  ❌ $name: NOT REGISTERED!\n";
    } else {
        $activeStr = $info['active'] ? 'ACTIVE' : 'INACTIVE';
        echo "  " . ($info['active'] ? '✅' : '❌') . " $name: $activeStr (path: {$info['path']})\n";
    }
}

// Check dependency order
if ($criticalHandlers['VTWorkflowEventHandler'] !== false) {
    $depOn = $criticalHandlers['VTWorkflowEventHandler']['dependent_on'];
    $deps = json_decode($depOn, true);
    if (is_array($deps) && in_array('VTEntityDelta', $deps)) {
        echo "  ✅ VTWorkflowEventHandler correctly depends on VTEntityDelta\n";
    } else {
        echo "  ⚠️ VTWorkflowEventHandler dependency: $depOn (expected [\"VTEntityDelta\"])\n";
    }
}

// ============================================================
// CHECK 2: Workflow definitions
// ============================================================
echo "\n\n=== CHECK 2: Active Workflows ===\n";
$result = $adb->pquery("SELECT workflow_id, module_name, summary, test, execution_condition, status, workflowname 
    FROM com_vtiger_workflows ORDER BY module_name, workflow_id", array());
$rows = $adb->num_rows($result);

$activeCount = 0;
$inactiveCount = 0;
$moduleWorkflows = array();

for ($i = 0; $i < $rows; $i++) {
    $wfId = $adb->query_result($result, $i, 'workflow_id');
    $module = $adb->query_result($result, $i, 'module_name');
    $summary = $adb->query_result($result, $i, 'summary');
    $test = $adb->query_result($result, $i, 'test');
    $execCond = $adb->query_result($result, $i, 'execution_condition');
    $status = $adb->query_result($result, $i, 'status');
    $name = $adb->query_result($result, $i, 'workflowname');
    
    $execLabels = array(1=>'ON_FIRST_SAVE', 2=>'ONCE', 3=>'ON_EVERY_SAVE', 4=>'ON_MODIFY', 5=>'ON_DELETE', 6=>'ON_SCHEDULE', 7=>'MANUAL');
    $execLabel = isset($execLabels[$execCond]) ? $execLabels[$execCond] : "UNKNOWN($execCond)";
    
    if ($status == 1) {
        $activeCount++;
        $moduleWorkflows[$module][] = array('id' => $wfId, 'name' => $name ?: $summary, 'exec' => $execLabel, 'test' => $test);
    } else {
        $inactiveCount++;
    }
}

echo "Total workflows: $rows (Active: $activeCount, Inactive: $inactiveCount)\n\n";

foreach ($moduleWorkflows as $module => $wfs) {
    echo "  📦 $module (" . count($wfs) . " active):\n";
    foreach ($wfs as $wf) {
        echo "    [#{$wf['id']}] {$wf['exec']} - {$wf['name']}\n";
        
        // Validate condition field names
        if (!empty($wf['test']) && $wf['test'] != '[]') {
            $conditions = json_decode(html_entity_decode($wf['test']), true);
            if (is_array($conditions)) {
                foreach ($conditions as $cond) {
                    if (!empty($cond['fieldname']) && $cond['fieldname'] != '_VT_add_comment') {
                        // Check if field exists in vtiger_field
                        preg_match('/(\w+) : \((\w+)\) (\w+)/', $cond['fieldname'], $matches);
                        if (count($matches) > 0) {
                            $checkField = $matches[3];
                        } else {
                            $checkField = $cond['fieldname'];
                        }
                        
                        $tabid = getTabid($module);
                        if ($tabid) {
                            $fldResult = $adb->pquery("SELECT fieldname FROM vtiger_field WHERE tabid=? AND fieldname=? AND presence IN (0,2)", array($tabid, $checkField));
                            if ($adb->num_rows($fldResult) == 0) {
                                echo "      ⚠️ FIELD NOT FOUND: '$checkField' (condition will FAIL)\n";
                            }
                        }
                    }
                }
            }
        }
    }
}

// ============================================================
// CHECK 3: Workflow Tasks
// ============================================================
echo "\n\n=== CHECK 3: Workflow Tasks ===\n";
$result = $adb->pquery("SELECT t.task_id, t.workflow_id, t.summary, t.task 
    FROM com_vtiger_workflowtasks t 
    INNER JOIN com_vtiger_workflows w ON t.workflow_id = w.workflow_id 
    WHERE w.status = 1 ORDER BY t.workflow_id", array());
$rows = $adb->num_rows($result);
echo "Active workflow tasks: $rows\n";

$inactiveTasks = 0;
for ($i = 0; $i < $rows; $i++) {
    $taskData = $adb->query_result($result, $i, 'task');
    $task = @unserialize($taskData);
    if ($task && isset($task->active) && !$task->active) {
        $inactiveTasks++;
    }
}
echo "Inactive tasks (within active workflows): $inactiveTasks\n";

// ============================================================
// CHECK 4: BulkSaveMode
// ============================================================
echo "\n\n=== CHECK 4: BulkSaveMode Check ===\n";
require_once 'data/CRMEntity.php';
$bulkMode = CRMEntity::isBulkSaveMode();
echo "BulkSaveMode: " . ($bulkMode ? '❌ ON (workflows will be SKIPPED!)' : '✅ OFF (normal)') . "\n";

// ============================================================
// CHECK 5: Module presence
// ============================================================
echo "\n\n=== CHECK 5: Module Presence (vtiger_tab) ===\n";
$modules = array_keys($moduleWorkflows);
foreach ($modules as $mod) {
    $tabResult = $adb->pquery("SELECT tabid, presence FROM vtiger_tab WHERE name = ?", array($mod));
    if ($adb->num_rows($tabResult) > 0) {
        $presence = $adb->query_result($tabResult, 0, 'presence');
        $presenceOk = in_array($presence, array(0, 2));
        echo "  " . ($presenceOk ? '✅' : '❌') . " $mod: presence=$presence\n";
    } else {
        echo "  ❌ $mod: NOT FOUND in vtiger_tab!\n";
    }
}

// ============================================================
// CHECK 6: Webservice entity mapping
// ============================================================
echo "\n\n=== CHECK 6: Webservice Entity Mapping ===\n";
$result = $adb->pquery("SELECT name, handler_path, handler_class FROM vtiger_ws_entity WHERE ismodule=1 LIMIT 5", array());
if ($adb->num_rows($result) > 0) {
    echo "  ✅ Webservice entity mapping exists\n";
} else {
    echo "  ❌ No webservice entity mappings found!\n";
}

// ============================================================
// CHECK 7: VTEntityCache - check if entity can be loaded
// ============================================================
echo "\n\n=== CHECK 7: Entity Cache Test ===\n";
try {
    require_once 'modules/com_vtiger_workflow/VTEntityCache.inc';
    require_once 'modules/com_vtiger_workflow/VTWorkflowUtils.php';
    
    $util = new VTWorkflowUtils();
    $adminUser = $util->adminUser();
    
    if ($adminUser && $adminUser->id) {
        echo "  ✅ Admin user loaded: ID={$adminUser->id}, Name={$adminUser->user_name}\n";
    } else {
        echo "  ❌ Failed to load admin user - workflows CANNOT execute!\n";
    }
    
    $util->revertUser();
} catch (Exception $e) {
    echo "  ❌ Error: " . $e->getMessage() . "\n";
}

// ============================================================
// CHECK 8: Error in workflow conditions (field name mismatch after DB rename)
// ============================================================
echo "\n\n=== CHECK 8: Field Name Mismatch Analysis ===\n";
echo "(Checking if workflow conditions reference old cf_xxx field names)\n\n";

$result = $adb->pquery("SELECT workflow_id, module_name, summary, test, workflowname 
    FROM com_vtiger_workflows WHERE status=1 AND test IS NOT NULL AND test != '' AND test != '[]'", array());
$rows = $adb->num_rows($result);
$mismatchCount = 0;

for ($i = 0; $i < $rows; $i++) {
    $wfId = $adb->query_result($result, $i, 'workflow_id');
    $module = $adb->query_result($result, $i, 'module_name');
    $name = $adb->query_result($result, $i, 'workflowname') ?: $adb->query_result($result, $i, 'summary');
    $test = $adb->query_result($result, $i, 'test');
    
    $conditions = json_decode(html_entity_decode($test), true);
    if (!is_array($conditions)) continue;
    
    $tabid = getTabid($module);
    if (!$tabid) continue;
    
    foreach ($conditions as $cond) {
        if (empty($cond['fieldname'])) continue;
        
        $fieldname = $cond['fieldname'];
        // Skip special fields
        if ($fieldname == '_VT_add_comment') continue;
        
        // Handle reference fields
        preg_match('/(\w+) : \((\w+)\) (\w+)/', $fieldname, $matches);
        if (count($matches) > 0) {
            $checkField = $matches[3];
            $refModule = $matches[2];
            $refTabid = getTabid($refModule);
            if ($refTabid) {
                $fldResult = $adb->pquery("SELECT fieldname FROM vtiger_field WHERE tabid=? AND fieldname=? AND presence IN (0,2)", array($refTabid, $checkField));
                if ($adb->num_rows($fldResult) == 0) {
                    echo "  ❌ WF#$wfId ($module) '$name': ref field '$fieldname' -> '$checkField' NOT FOUND in $refModule\n";
                    $mismatchCount++;
                }
            }
        } else {
            $fldResult = $adb->pquery("SELECT fieldname FROM vtiger_field WHERE tabid=? AND fieldname=? AND presence IN (0,2)", array($tabid, $fieldname));
            if ($adb->num_rows($fldResult) == 0) {
                echo "  ❌ WF#$wfId ($module) '$name': field '$fieldname' NOT FOUND\n";
                $mismatchCount++;
            }
        }
    }
}

if ($mismatchCount == 0) {
    echo "  ✅ All workflow condition fields are valid\n";
} else {
    echo "\n  ⚠️ Total field mismatches: $mismatchCount\n";
    echo "  These workflows will SILENTLY FAIL because conditions reference non-existent fields!\n";
}

// ============================================================
// CHECK 9: Task field references
// ============================================================
echo "\n\n=== CHECK 9: Task Field References ===\n";
$result = $adb->pquery("SELECT t.task_id, t.workflow_id, t.task, w.module_name, w.workflowname 
    FROM com_vtiger_workflowtasks t 
    INNER JOIN com_vtiger_workflows w ON t.workflow_id = w.workflow_id 
    WHERE w.status = 1", array());
$rows = $adb->num_rows($result);
$taskIssues = 0;

for ($i = 0; $i < $rows; $i++) {
    $taskData = $adb->query_result($result, $i, 'task');
    $task = @unserialize($taskData);
    if (!$task) {
        $wfId = $adb->query_result($result, $i, 'workflow_id');
        $taskId = $adb->query_result($result, $i, 'task_id');
        echo "  ❌ Task#$taskId (WF#$wfId): Failed to unserialize - task data is CORRUPT\n";
        $taskIssues++;
    }
}

if ($taskIssues == 0) {
    echo "  ✅ All tasks can be unserialized successfully\n";
} else {
    echo "\n  ⚠️ $taskIssues tasks have corrupt data and will cause errors!\n";
}

// ============================================================
// SUMMARY
// ============================================================
echo "\n\n" . str_repeat('=', 60) . "\n";
echo "DIAGNOSTIC SUMMARY\n";
echo str_repeat('=', 60) . "\n\n";

$issues = array();

// Check critical handlers
if ($criticalHandlers['VTEntityDelta_beforesave'] === false || !$criticalHandlers['VTEntityDelta_beforesave']['active']) {
    $issues[] = "VTEntityDelta (beforesave) is missing or inactive";
}
if ($criticalHandlers['VTEntityDelta_aftersave'] === false || !$criticalHandlers['VTEntityDelta_aftersave']['active']) {
    $issues[] = "VTEntityDelta (aftersave) is missing or inactive";
}
if ($criticalHandlers['VTWorkflowEventHandler'] === false || !$criticalHandlers['VTWorkflowEventHandler']['active']) {
    $issues[] = "VTWorkflowEventHandler is missing or inactive - NO workflows will trigger!";
}
if ($bulkMode) {
    $issues[] = "BulkSaveMode is ON - workflows are being skipped";
}
if ($mismatchCount > 0) {
    $issues[] = "$mismatchCount workflow conditions reference non-existent fields (likely after DB column rename)";
}
if ($taskIssues > 0) {
    $issues[] = "$taskIssues workflow tasks have corrupt serialized data";
}

if (empty($issues)) {
    echo "✅ No critical issues found in workflow infrastructure.\n";
    echo "If workflows still don't trigger, possible causes:\n";
    echo "  1. Workflow conditions evaluate to FALSE for the data being saved\n";
    echo "  2. Exception/error during task execution is silently caught\n";
    echo "  3. The save path bypasses CRMEntity::save() (e.g., direct SQL updates)\n";
    echo "  4. Custom code calling \$_REQUEST['module'] save differently\n";
} else {
    echo "❌ ISSUES FOUND (" . count($issues) . "):\n\n";
    foreach ($issues as $idx => $issue) {
        echo "  " . ($idx + 1) . ". $issue\n";
    }
}

echo "\n</pre>";
?>
