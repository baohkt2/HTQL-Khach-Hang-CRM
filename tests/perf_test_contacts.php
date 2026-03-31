<?php

require_once __DIR__ . '/perf_test_bootstrap.php';

$db = openPerfMysqli();
$datasetSizes = array(1000, 10000, 100000);

$beforeSql = "SELECT SQL_NO_CACHE contactid, firstname, lastname
FROM vtiger_contactdetails IGNORE INDEX (idx_contact_firstname_contactid)
WHERE firstname LIKE 'A%'
ORDER BY firstname
LIMIT 1000";

$afterSql = "SELECT SQL_NO_CACHE contactid, firstname, lastname
FROM vtiger_contactdetails
WHERE firstname LIKE 'A%'
ORDER BY firstname
LIMIT 1000";

runPerfScenario(
    $db,
    'Contacts firstname prefix search',
    $beforeSql,
    $afterSql,
    $datasetSizes
);
