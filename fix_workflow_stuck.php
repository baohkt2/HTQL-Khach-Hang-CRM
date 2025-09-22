<?php
/*+**********************************************************************************
 * WORKFLOW CRON TASK FIXER
 * 
 * File: fix_workflow_stuck.php
 * Mục đích: Fix workflow cron task bị stuck trong trạng thái running
 ************************************************************************************/

require_once 'config.inc.php';
require_once 'vtlib/Vtiger/Cron.php';

echo "=== WORKFLOW CRON TASK FIXER ===\n\n";

// Get Workflow cron task
$workflowCron = Vtiger_Cron::getInstance('Workflow');

if (!$workflowCron) {
    echo "❌ Workflow cron task không tìm thấy!\n";
    exit(1);
}

echo "Workflow Cron Task Status:\n";
echo "- Name: " . $workflowCron->getName() . "\n";
echo "- Status: " . $workflowCron->getStatus() . "\n";
echo "- Is Running: " . ($workflowCron->isRunning() ? "YES" : "NO") . "\n";
echo "- Last Start: " . date('Y-m-d H:i:s', $workflowCron->getLastStart()) . "\n";
echo "- Last End: " . date('Y-m-d H:i:s', $workflowCron->getLastEnd()) . "\n";
echo "- Frequency: " . $workflowCron->getFrequency() . " seconds\n";

// Check if task is stuck
$lastStart = $workflowCron->getLastStart();
$lastEnd = $workflowCron->getLastEnd();
$currentTime = time();

echo "\nAnalysis:\n";
echo "- Last Start Time: " . date('Y-m-d H:i:s', $lastStart) . "\n";
echo "- Last End Time: " . date('Y-m-d H:i:s', $lastEnd) . "\n";
echo "- Current Time: " . date('Y-m-d H:i:s', $currentTime) . "\n";
echo "- Running Duration: " . round(($currentTime - $lastStart) / 3600, 2) . " hours\n";

if ($workflowCron->isRunning()) {
    $runningDuration = $currentTime - $lastStart;
    
    if ($runningDuration > 3600) { // Running for more than 1 hour
        echo "\n🔴 PROBLEM DETECTED:\n";
        echo "   Workflow has been running for " . round($runningDuration / 3600, 2) . " hours\n";
        echo "   This indicates the task is stuck!\n";
        
        echo "\n🔧 FIXING...\n";
        
        // Force reset the status
        $db = PearDatabase::getInstance();
        
        // Reset status to finished/ready
        $query = "UPDATE vtiger_cron_task SET status = ? WHERE id = ?";
        $params = array(Vtiger_Cron::$STATUS_ENABLED, $workflowCron->getId());
        
        $result = $db->pquery($query, $params);
        
        if ($result) {
            echo "✅ Workflow cron task status reset to ENABLED\n";
            
            // Also update lastend to current time
            $updateEndQuery = "UPDATE vtiger_cron_task SET lastend = ? WHERE id = ?";
            $updateEndParams = array($currentTime, $workflowCron->getId());
            
            $db->pquery($updateEndQuery, $updateEndParams);
            echo "✅ Last end time updated to current time\n";
            
            // Test if workflow can run now
            echo "\n🧪 TESTING WORKFLOW...\n";
            
            // Reload cron task
            $workflowCronReloaded = Vtiger_Cron::getInstance('Workflow');
            
            echo "- New Status: " . $workflowCronReloaded->getStatus() . "\n";
            echo "- Is Running: " . ($workflowCronReloaded->isRunning() ? "YES" : "NO") . "\n";
            echo "- Is Runnable: " . ($workflowCronReloaded->isRunnable() ? "YES" : "NO") . "\n";
            
            if ($workflowCronReloaded->isRunnable()) {
                echo "\n🎉 SUCCESS! Workflow is now ready to run!\n";
                echo "\nYou can now test by running:\n";
                echo "php vtigercron.php service=Workflow\n";
            } else {
                echo "\n⚠️  Workflow is still not runnable. Check frequency settings.\n";
                
                $nextRunTime = $workflowCronReloaded->getLastEnd() + $workflowCronReloaded->getFrequency();
                echo "Next scheduled run: " . date('Y-m-d H:i:s', $nextRunTime) . "\n";
                echo "Time until next run: " . round(($nextRunTime - $currentTime) / 60, 2) . " minutes\n";
            }
            
        } else {
            echo "❌ Failed to reset workflow cron task status\n";
        }
        
    } else {
        echo "\n🟡 Workflow is running but for less than 1 hour.\n";
        echo "   This might be normal. Wait a bit longer or force reset if needed.\n";
    }
} else {
    echo "\n🟢 Workflow is not currently running.\n";
    
    if ($workflowCron->isRunnable()) {
        echo "✅ Workflow is ready to run!\n";
    } else {
        $nextRunTime = $workflowCron->getLastEnd() + $workflowCron->getFrequency();
        echo "⏰ Next run scheduled for: " . date('Y-m-d H:i:s', $nextRunTime) . "\n";
        echo "   Time until next run: " . round(($nextRunTime - $currentTime) / 60, 2) . " minutes\n";
    }
}

// Show all cron tasks status for reference
echo "\n=== ALL CRON TASKS STATUS ===\n";


foreach ($allCronTasks as $cronTask) {
    $status = "UNKNOWN";
    switch ($cronTask->getStatus()) {
        case Vtiger_Cron::$STATUS_DISABLED:
            $status = "DISABLED";
            break;
        case Vtiger_Cron::$STATUS_ENABLED:
            $status = "ENABLED";
            break;
        case Vtiger_Cron::$STATUS_RUNNING:
            $status = "RUNNING";
            break;
        case Vtiger_Cron::$STATUS_COMPLETED:
            $status = "COMPLETED";
            break;
        case Vtiger_Cron::$STATUS_ERROR:
            $status = "ERROR";
            break;
    }
    
    $lastRun = $cronTask->getLastEnd() ? date('Y-m-d H:i:s', $cronTask->getLastEnd()) : 'Never';
    
    echo sprintf("%-20s | %-10s | %-8s | %s\n", 
        $cronTask->getName(), 
        $status,
        ($cronTask->isRunnable() ? 'Ready' : 'Wait'),
        $lastRun
    );
}

echo "\n=== RECOMMENDATIONS ===\n";
echo "1. If Workflow was stuck, it should now be fixed\n";
echo "2. Test by running: php vtigercron.php service=Workflow\n";
echo "3. Check workflow executions in Settings > Workflows\n";
echo "4. Monitor cron logs for any recurring issues\n";

?>