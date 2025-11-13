<?php
session_start();

// Chỉ chấp nhận phương thức POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
    exit;
}

// Kiểm tra dữ liệu gửi lên
if (isset($_POST['access_token']) && !empty($_POST['access_token'])) {
    $_SESSION['fb_access_token'] = $_POST['access_token'];

    // Gửi phản hồi JSON
    header('Content-Type: application/json');
    echo json_encode(['status' => 'success', 'message' => 'Token saved']);
} else {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'No token received']);
}