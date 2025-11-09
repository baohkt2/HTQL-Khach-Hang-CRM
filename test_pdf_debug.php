<?php
// Debug script to check PDFMaker configuration
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "Starting debug...<br>";

// Bootstrap VtigerCRM
chdir(__DIR__);

try {
    require_once 'include/database/PearDatabase.php';
    global $adb;
    $adb = PearDatabase::getInstance();
    echo "Database connected<br>";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "<br>";
    die();
}

echo "<h2>PDFMaker Debug Information</h2>";

// Check if PDFMaker module exists
$result = $adb->pquery("SELECT * FROM vtiger_tab WHERE name=?", array('PDFMaker'));
if ($adb->num_rows($result) > 0) {
    echo "<p style='color:green;'>✓ PDFMaker module is installed</p>";
} else {
    echo "<p style='color:red;'>✗ PDFMaker module is NOT installed</p>";
}

// Check for templates
echo "<h3>Available Templates:</h3>";
$result = $adb->pquery("SELECT templateid, description, module FROM vtiger_pdfmaker ORDER BY module", array());
$num_rows = $adb->num_rows($result);

if ($num_rows > 0) {
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>Template ID</th><th>Description</th><th>Module</th></tr>";
    for ($i = 0; $i < $num_rows; $i++) {
        $templateid = $adb->query_result($result, $i, 'templateid');
        $description = $adb->query_result($result, $i, 'description');
        $module = $adb->query_result($result, $i, 'module');
        echo "<tr><td>$templateid</td><td>$description</td><td>$module</td></tr>";
    }
    echo "</table>";
} else {
    echo "<p style='color:red;'>✗ No templates found in vtiger_pdfmaker table</p>";
}

// Check template settings
echo "<h3>Template Settings:</h3>";
$result = $adb->pquery("SELECT * FROM vtiger_pdfmaker_settings", array());
$num_rows = $adb->num_rows($result);
echo "<p>Found $num_rows template settings</p>";

// Check mPDF availability
echo "<h3>mPDF Library Check:</h3>";
if (file_exists("vendor/autoload.php")) {
    require_once("vendor/autoload.php");
    echo "<p style='color:green;'>✓ Composer autoload found</p>";
    
    if (class_exists('Mpdf\Mpdf')) {
        echo "<p style='color:green;'>✓ Mpdf\\Mpdf class is available</p>";
        
        try {
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8']);
            echo "<p style='color:green;'>✓ mPDF instance created successfully</p>";
        } catch (Exception $e) {
            echo "<p style='color:red;'>✗ Error creating mPDF: " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p style='color:red;'>✗ Mpdf\\Mpdf class NOT found</p>";
    }
} else {
    echo "<p style='color:red;'>✗ Composer autoload NOT found</p>";
}

// Check if PDFMaker files exist
echo "<h3>PDFMaker Files Check:</h3>";
$files = array(
    'modules/PDFMaker/PDFMaker.php',
    'modules/PDFMaker/models/PDFMaker.php',
    'modules/PDFMaker/models/checkGenerate.php',
    'modules/PDFMaker/models/PDFContent.php',
    'modules/PDFMaker/resources/pdfjs.php',
);

foreach ($files as $file) {
    if (file_exists($file)) {
        echo "<p style='color:green;'>✓ $file</p>";
    } else {
        echo "<p style='color:red;'>✗ $file NOT FOUND</p>";
    }
}

echo "<h3>Database Tables Check:</h3>";
$tables = array('vtiger_pdfmaker', 'vtiger_pdfmaker_settings', 'vtiger_pdfmaker_ignorepicklistvalues');
foreach ($tables as $table) {
    $result = $adb->pquery("SHOW TABLES LIKE ?", array($table));
    if ($adb->num_rows($result) > 0) {
        echo "<p style='color:green;'>✓ Table $table exists</p>";
    } else {
        echo "<p style='color:red;'>✗ Table $table NOT FOUND</p>";
    }
}
?>
