<?php
// One-time migration script to create vtiger_cv_history table
chdir(__DIR__);
include_once 'config.inc.php';
include_once 'include/database/PearDatabase.php';

$db = PearDatabase::getInstance();

$sql = "CREATE TABLE IF NOT EXISTS vtiger_cv_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cvid INT NOT NULL,
    userid INT NOT NULL,
    action_type VARCHAR(20) NOT NULL,
    action_time DATETIME NOT NULL,
    details TEXT,
    FOREIGN KEY (cvid) REFERENCES vtiger_customview(cvid) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

$db->pquery($sql, array());
echo "Table vtiger_cv_history created successfully.\n";
?>
