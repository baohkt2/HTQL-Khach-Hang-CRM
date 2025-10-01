<?php
/**
 * ====================================================================
 * GET APPLICATION UNIQUE KEY API
 * ====================================================================
 * 
 * API endpoint để lấy application_unique_key cho JavaScript
 */

// Chặn truy cập trực tiếp không hợp lệ
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    !strpos($_SERVER['HTTP_REFERER'], $_SERVER['SERVER_NAME'])) {
    http_response_code(403);
    die('Access denied');
}

require_once 'config.inc.php';

header('Content-Type: application/json');
header('Cache-Control: no-cache, must-revalidate');

try {
    // Kiểm tra user có đăng nhập không
    session_start();
    
    $response = array();
    
    if (isset($_SESSION["authenticated_user_id"]) && 
        isset($_SESSION["app_unique_key"]) && 
        $_SESSION["app_unique_key"] == $application_unique_key) {
        
        // User đã đăng nhập, trả về key
        $response['success'] = true;
        $response['app_unique_key'] = $application_unique_key;
        $response['message'] = 'Key obtained successfully';
        
    } elseif (isset($application_unique_key)) {
        
        // Chưa đăng nhập nhưng có thể lấy key (tùy chọn bảo mật)
        $response['success'] = true;
        $response['app_unique_key'] = $application_unique_key;
        $response['message'] = 'Key obtained (public access)';
        
    } else {
        
        // Không có key
        $response['success'] = false;
        $response['message'] = 'Application unique key not found';
        
    }
    
    echo json_encode($response);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Internal server error: ' . $e->getMessage()
    ]);
}
?>