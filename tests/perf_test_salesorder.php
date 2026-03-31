<?php

require_once __DIR__ . '/perf_test_bootstrap.php';

$db = openPerfMysqli();
$datasetSizes = array(1000, 10000, 100000);

$beforeSql = "SELECT SQL_NO_CACHE salesorderid, subject, sostatus, duedate
FROM vtiger_salesorder IGNORE INDEX (idx_salesorder_account_status_due, idx_salesorder_potential_status)
WHERE accountid IS NOT NULL
  AND sostatus IS NOT NULL
ORDER BY duedate DESC
LIMIT 1000";

$afterSql = "SELECT SQL_NO_CACHE salesorderid, subject, sostatus, duedate
FROM vtiger_salesorder
WHERE accountid IS NOT NULL
  AND sostatus IS NOT NULL
ORDER BY duedate DESC
LIMIT 1000";

runPerfScenario(
    $db,
    'SalesOrder account/status due-date sort',
    $beforeSql,
    $afterSql,
    $datasetSizes
);
