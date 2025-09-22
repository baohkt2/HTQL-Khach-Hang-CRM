<?php
/**
 * ====================================================================
 * CHECK SCHEDULED WORKFLOWS API
 * ====================================================================
 * 
 * API endpoint để kiểm tra có scheduled workflows không
 */

// Chặn truy cập trực tiếp không hợp lệ
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    !strpos($_SERVER['HTTP_REFERER'], $_SERVER['SERVER_NAME'])) {
    http_response_code(403);
    die('Access denied');
}

require_once 'config.inc.php';
require_once 'include/database/PearDatabase.php';

header('Content-Type: application/json');
header('Cache-Control: no-cache, must-revalidate');

try {
    $adb = PearDatabase::getInstance();
    
    // Kiểm tra scheduled workflows (execution_condition = 6)
    $query = "SELECT COUNT(*) as count FROM com_vtiger_workflows 
              WHERE execution_condition = 6 AND status = 1";
    
    $result = $adb->query($query);
    $row = $adb->fetchByAssoc($result);
    
    $scheduledCount = intval($row['count']);
    
    // Kiểm tra có tasks đang chờ trong queue không
    $queueQuery = "SELECT COUNT(*) as queue_count FROM com_vtiger_workflowtask_queue";
    $queueResult = $adb->query($queueQuery);
    $queueRow = $adb->fetchByAssoc($queueResult);
    
    $queueCount = intval($queueRow['queue_count']);
    
    // Lấy thông tin chi tiết về workflows
    $detailQuery = "SELECT w.summary, w.module_name, w.test 
                    FROM com_vtiger_workflows w 
                    WHERE w.execution_condition = 6 AND w.status = 1 
                    LIMIT 10";
    
    $detailResult = $adb->query($detailQuery);
    $workflows = [];
    
    while ($detailRow = $adb->fetchByAssoc($detailResult)) {
        $workflows[] = [
            'summary' => $detailRow['summary'],
            'module' => $detailRow['module_name'],
            'test' => $detailRow['test']
        ];
    }
    
    $response = [
        'success' => true,
        'hasScheduledWorkflows' => $scheduledCount > 0,
        'count' => $scheduledCount,
        'queueCount' => $queueCount,
        'workflows' => $workflows,
        'message' => $scheduledCount > 0 ? 
            "Found {$scheduledCount} scheduled workflow(s)" : 
            "No scheduled workflows found",
        'recommendations' => []
    ];
    
    // Thêm recommendations
    if ($scheduledCount > 0) {
        $response['recommendations'][] = 'Auto cron should be enabled';
        
        if ($queueCount > 0) {
            $response['recommendations'][] = "There are {$queueCount} tasks in queue waiting for execution";
        }
    } else {
        $response['recommendations'][] = 'No auto cron needed - no scheduled workflows';
    }
    
    echo json_encode($response, JSON_PRETTY_PRINT);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage(),
        'hasScheduledWorkflows' => false,
        'count' => 0
    ]);
}
?>