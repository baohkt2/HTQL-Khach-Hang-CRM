<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Testing mPDF v8 Integration</h2>";

// Test 1: Check if autoload exists
if (file_exists("vendor/autoload.php")) {
    echo "<p style='color:green;'>✓ vendor/autoload.php exists</p>";
    require_once("vendor/autoload.php");
} else {
    die("<p style='color:red;'>✗ vendor/autoload.php NOT FOUND</p>");
}

// Test 2: Check if Mpdf class is available
if (class_exists('Mpdf\Mpdf')) {
    echo "<p style='color:green;'>✓ Mpdf\\Mpdf class is available</p>";
} else {
    die("<p style='color:red;'>✗ Mpdf\\Mpdf class NOT FOUND</p>");
}

// Test 3: Try to create a simple PDF
try {
    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'orientation' => 'P'
    ]);
    echo "<p style='color:green;'>✓ mPDF instance created successfully</p>";
    
    $mpdf->WriteHTML('<h1>Test PDF</h1><p>This is a test PDF generated with mPDF v8</p>');
    echo "<p style='color:green;'>✓ HTML written to PDF</p>";
    
    $pdfContent = $mpdf->Output('', 'S');
    echo "<p style='color:green;'>✓ PDF generated successfully (" . strlen($pdfContent) . " bytes)</p>";
    
    echo "<p><a href='?download=1'>Download Test PDF</a></p>";
    
    if (isset($_GET['download']) && $_GET['download'] == '1') {
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="test.pdf"');
        echo $pdfContent;
        exit;
    }
    
} catch (Exception $e) {
    echo "<p style='color:red;'>✗ Error: " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}

// Test 4: Test the custom JavaScript class
echo "<hr><h3>Testing ITS4You_PDFMaker_JavaScript class</h3>";
try {
    require_once("modules/PDFMaker/resources/pdfjs.php");
    echo "<p style='color:green;'>✓ pdfjs.php loaded</p>";
    
    if (class_exists('ITS4You_PDFMaker_JavaScript')) {
        echo "<p style='color:green;'>✓ ITS4You_PDFMaker_JavaScript class exists</p>";
        
        // Test new-style constructor (array config)
        $config = [
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'P',
            'margin_left' => 15,
            'margin_right' => 15,
            'margin_top' => 16,
            'margin_bottom' => 16,
        ];
        
        $mpdf2 = new ITS4You_PDFMaker_JavaScript($config);
        echo "<p style='color:green;'>✓ ITS4You_PDFMaker_JavaScript instance created with array config</p>";
        
        $mpdf2->WriteHTML('<h1>Test PDF with JavaScript Support</h1><p>This PDF has auto-print functionality</p>');
        $mpdf2->AutoPrint();
        
        $pdfContent2 = $mpdf2->Output('', 'S');
        echo "<p style='color:green;'>✓ PDF with JavaScript generated successfully (" . strlen($pdfContent2) . " bytes)</p>";
        
    } else {
        echo "<p style='color:red;'>✗ ITS4You_PDFMaker_JavaScript class NOT FOUND</p>";
    }
    
} catch (Exception $e) {
    echo "<p style='color:red;'>✗ Error: " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}

echo "<hr><p>All tests completed!</p>";
?>
