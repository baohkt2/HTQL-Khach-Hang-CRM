<?php

require_once __DIR__ . '/perf_test_bootstrap.php';

$db = openPerfMysqli();
$datasetSizes = array(1000, 10000, 100000);

$beforeSql = "SELECT SQL_NO_CACHE a.accountid, a.accountname
FROM vtiger_account a IGNORE INDEX (idx_account_accountname, idx_account_parentid_accountname)
INNER JOIN vtiger_crmentity ce IGNORE INDEX (idx_crmentity_deleted_modified_crmid)
    ON ce.crmid = a.accountid
WHERE ce.deleted = 0
ORDER BY ce.modifiedtime DESC
LIMIT 1000";

$afterSql = "SELECT SQL_NO_CACHE a.accountid, a.accountname
FROM vtiger_account a
INNER JOIN vtiger_crmentity ce
    ON ce.crmid = a.accountid
WHERE ce.deleted = 0
ORDER BY ce.modifiedtime DESC
LIMIT 1000";

runPerfScenario(
    $db,
    'Accounts list join + modifiedtime sort',
    $beforeSql,
    $afterSql,
    $datasetSizes
);
