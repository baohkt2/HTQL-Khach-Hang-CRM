<?php
/**
 * SCRIPT DEBUG PDF CHO VTIGERCRM
 * Kiểm tra và sửa lỗi PDF export ra trang trắng
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<html><head><meta charset='UTF-8'><title>Debug PDF VtigerCRM</title></head><body>";
echo "<h1>🔍 Kiểm Tra Hệ Thống PDF</h1>";

// 1. Kiểm tra vendor/autoload.php
echo "<h2>1. Kiểm tra thư viện mPDF</h2>";
if (file_exists("vendor/autoload.php")) {
    require_once("vendor/autoload.php");
    echo "<p style='color:green;'>✅ vendor/autoload.php đã tồn tại</p>";
} else {
    echo "<p style='color:red;'>❌ KHÔNG TÌM THẤY vendor/autoload.php</p>";
    echo "<p>Cần chạy: <code>composer install</code></p>";
    die();
}

// 2. Kiểm tra class mPDF
if (class_exists('Mpdf\Mpdf')) {
    echo "<p style='color:green;'>✅ Class Mpdf\\Mpdf đã có sẵn</p>";
    
    try {
        $test = new \Mpdf\Mpdf(['mode' => 'utf-8']);
        echo "<p style='color:green;'>✅ Có thể tạo instance mPDF</p>";
    } catch (Exception $e) {
        echo "<p style='color:red;'>❌ Lỗi khi tạo mPDF: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p style='color:red;'>❌ Class Mpdf\\Mpdf KHÔNG tồn tại</p>";
}

// 3. Kiểm tra file pdfjs.php đã fix chưa
echo "<h2>2. Kiểm tra file pdfjs.php</h2>";
if (file_exists("modules/PDFMaker/resources/pdfjs.php")) {
    $content = file_get_contents("modules/PDFMaker/resources/pdfjs.php");
    
    if (strpos($content, 'use Mpdf\Mpdf;') !== false) {
        echo "<p style='color:green;'>✅ File pdfjs.php đã được cập nhật (có 'use Mpdf\\Mpdf;')</p>";
    } else {
        echo "<p style='color:red;'>❌ File pdfjs.php CHƯA được cập nhật</p>";
        echo "<p>Cần sửa file này để load mPDF v8.x</p>";
    }
    
    if (strpos($content, 'vendor/autoload.php') !== false) {
        echo "<p style='color:green;'>✅ File pdfjs.php đã load autoload</p>";
    } else {
        echo "<p style='color:orange;'>⚠️ File pdfjs.php chưa load vendor/autoload.php</p>";
    }
} else {
    echo "<p style='color:red;'>❌ Không tìm thấy file pdfjs.php</p>";
}

// 4. Kiểm tra database có template không
echo "<h2>3. Kiểm tra Templates trong Database</h2>";
try {
    require_once 'include/database/PearDatabase.php';
    global $adb;
    $adb = PearDatabase::getInstance();
    
    $result = $adb->pquery("SELECT templateid, description, module FROM vtiger_pdfmaker", array());
    $num_rows = $adb->num_rows($result);
    
    if ($num_rows > 0) {
        echo "<p style='color:green;'>✅ Tìm thấy $num_rows template(s)</p>";
        echo "<table border='1' cellpadding='5' style='border-collapse:collapse;'>";
        echo "<tr><th>Template ID</th><th>Mô tả</th><th>Module</th></tr>";
        for ($i = 0; $i < $num_rows; $i++) {
            echo "<tr>";
            echo "<td>" . $adb->query_result($result, $i, 'templateid') . "</td>";
            echo "<td>" . $adb->query_result($result, $i, 'description') . "</td>";
            echo "<td>" . $adb->query_result($result, $i, 'module') . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='color:red;'>❌ KHÔNG có template nào trong database</p>";
        echo "<p><strong>Giải pháp:</strong> Bạn cần tạo template trong PDFMaker module</p>";
        echo "<p>Vào: Menu > Tools > PDFMaker > New Template</p>";
    }
    
    // Kiểm tra template settings
    $result2 = $adb->pquery("SELECT COUNT(*) as cnt FROM vtiger_pdfmaker_settings", array());
    $cnt = $adb->query_result($result2, 0, 'cnt');
    if ($cnt > 0) {
        echo "<p style='color:green;'>✅ Có $cnt template setting(s)</p>";
    } else {
        echo "<p style='color:orange;'>⚠️ Chưa có template settings</p>";
    }
    
} catch (Exception $e) {
    echo "<p style='color:red;'>❌ Lỗi database: " . $e->getMessage() . "</p>";
}

// 5. Test tạo PDF đơn giản
echo "<h2>4. Test Tạo PDF Đơn Giản</h2>";
try {
    require_once("modules/PDFMaker/resources/pdfjs.php");
    
    $config = [
        'mode' => 'utf-8',
        'format' => 'A4',
        'orientation' => 'P'
    ];
    
    $mpdf = new ITS4You_PDFMaker_JavaScript($config);
    $mpdf->WriteHTML('<h1>Test PDF từ VtigerCRM</h1><p>Nếu bạn thấy file này thì PDF đã hoạt động!</p>');
    
    $pdfContent = $mpdf->Output('', 'S');
    
    if (strlen($pdfContent) > 1000) {
        echo "<p style='color:green;'>✅ Tạo PDF thành công! (" . number_format(strlen($pdfContent)) . " bytes)</p>";
        echo "<p><a href='?download_test=1' style='background:green;color:white;padding:10px;text-decoration:none;border-radius:5px;'>📥 Tải PDF Test</a></p>";
        
        if (isset($_GET['download_test'])) {
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="test-pdf-vtigercrm.pdf"');
            echo $pdfContent;
            exit;
        }
    } else {
        echo "<p style='color:red;'>❌ PDF quá nhỏ, có thể bị lỗi</p>";
    }
    
} catch (Exception $e) {
    echo "<p style='color:red;'>❌ Lỗi khi tạo PDF: " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<details><summary>Chi tiết lỗi</summary><pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre></details>";
}

// 6. Hướng dẫn
echo "<hr>";
echo "<h2>📋 Hướng Dẫn Sử Dụng</h2>";
echo "<ol>";
echo "<li><strong>Nếu tất cả đều ✅:</strong> Hệ thống đã sẵn sàng, hãy thử export PDF từ Invoice/Quote</li>";
echo "<li><strong>Nếu thiếu template:</strong> Vào PDFMaker module để tạo template mới</li>";
echo "<li><strong>Nếu có lỗi:</strong> Check file <code>PDF_FIX_SUMMARY.md</code> để xem chi tiết các fix đã làm</li>";
echo "</ol>";

echo "<h3>🔧 Các File Đã Được Sửa:</h3>";
echo "<ul>";
echo "<li><code>modules/PDFMaker/resources/pdfjs.php</code> - Load mPDF v8.x</li>";
echo "<li><code>modules/PDFMaker/models/PDFMaker.php</code> - Constructor mới</li>";
echo "<li><code>modules/PDFMaker/models/PDFContent.php</code> - Fix template retrieval</li>";
echo "</ul>";

echo "<p style='background:#f0f0f0;padding:15px;border-left:4px solid #2196F3;'>";
echo "<strong>Lưu ý:</strong> Nếu vẫn export ra blank page, có thể do:<br>";
echo "1. Chưa có template cho module đó<br>";
echo "2. Template bị lỗi HTML/CSS<br>";
echo "3. Thiếu dữ liệu trong record (Invoice/Quote rỗng)<br>";
echo "</p>";

echo "</body></html>";
?>
