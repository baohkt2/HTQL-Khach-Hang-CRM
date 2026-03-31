<?php

require_once __DIR__ . '/perf_test_bootstrap.php';

$db = openPerfMysqli();
$datasetSizes = array(1000, 10000, 100000);

$beforeSql = "SELECT SQL_NO_CACHE potentialid, potentialname, sales_stage, closingdate
FROM vtiger_potential IGNORE INDEX (idx_potential_related_stage_close, idx_potential_name_stage)
WHERE related_to IS NOT NULL
  AND sales_stage IS NOT NULL
ORDER BY closingdate DESC
LIMIT 1000";

$afterSql = "SELECT SQL_NO_CACHE potentialid, potentialname, sales_stage, closingdate
FROM vtiger_potential
WHERE related_to IS NOT NULL
  AND sales_stage IS NOT NULL
ORDER BY closingdate DESC
LIMIT 1000";

runPerfScenario(
    $db,
    'Potential related/stage close-date sort',
    $beforeSql,
    $afterSql,
    $datasetSizes
);
