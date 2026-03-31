<?php

require_once __DIR__ . '/perf_test_bootstrap.php';

$db = openPerfMysqli();
$datasetSizes = array(1000, 10000, 100000);

$beforeSql = "SELECT SQL_NO_CACHE act.activityid, act.subject
FROM vtiger_activity act IGNORE INDEX (idx_activity_semodule_status_date, idx_activity_semodule_eventstatus_date)
INNER JOIN vtiger_crmentity ce IGNORE INDEX (idx_crmentity_deleted_modified_crmid)
    ON ce.crmid = act.activityid
WHERE ce.deleted = 0
  AND act.semodule IS NOT NULL
  AND act.status IS NOT NULL
ORDER BY act.date_start DESC
LIMIT 1000";

$afterSql = "SELECT SQL_NO_CACHE act.activityid, act.subject
FROM vtiger_activity act
INNER JOIN vtiger_crmentity ce
    ON ce.crmid = act.activityid
WHERE ce.deleted = 0
  AND act.semodule IS NOT NULL
  AND act.status IS NOT NULL
ORDER BY act.date_start DESC
LIMIT 1000";

runPerfScenario(
    $db,
    'Activity filtered date sort',
    $beforeSql,
    $afterSql,
    $datasetSizes
);
