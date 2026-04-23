<?php
/*+***********************************************************************************
 * CUSC custom handler: synchronize Accounts telecom/email counters from linked Contacts.
 * Updated fields on vtiger_accountscf:
 * - cf_2142: Viettel
 * - cf_2144: Vinaphone
 * - cf_2146: Mobifone
 * - cf_2148: Gmobile
 * - cf_2156: valid contact email count
 *************************************************************************************/

require_once 'include/events/VTEventHandler.inc';
require_once 'data/VTEntityDelta.php';

class AccountContactNetworkEmailStatsHandler extends VTEventHandler {

    const DEFAULT_CONTACT_EMAIL = 'example@gmail.com';

    public function handleEvent($eventName, $entityData) {
        if (!$entityData || $entityData->getModuleName() !== 'Contacts') {
            return;
        }

        if ($eventName === 'vtiger.entity.aftersave') {
            $this->handleAfterSave($entityData);
            return;
        }

        if ($eventName === 'vtiger.entity.afterdelete' || $eventName === 'vtiger.entity.afterrestore') {
            $accountId = (int) $entityData->get('account_id');
            if ($accountId > 0) {
                self::refreshAccountStatistics($accountId);
            }
        }
    }

    protected function handleAfterSave($entityData) {
        $recordId = (int) $entityData->getId();
        if ($recordId <= 0) {
            return;
        }

        $newAccountId = (int) $entityData->get('account_id');
        $oldAccountId = 0;

        $delta = new VTEntityDelta();
        $oldValue = $delta->getOldValue('Contacts', $recordId, 'account_id');
        if ($oldValue !== null && $oldValue !== '') {
            $oldAccountId = (int) $oldValue;
        }

        if ($entityData->isNew()) {
            if ($newAccountId > 0) {
                self::refreshAccountStatistics($newAccountId);
            }
            return;
        }

        if ($oldAccountId !== $newAccountId) {
            if ($oldAccountId > 0) {
                self::refreshAccountStatistics($oldAccountId);
            }
            if ($newAccountId > 0) {
                self::refreshAccountStatistics($newAccountId);
            }
            return;
        }

        if ($newAccountId > 0) {
            self::refreshAccountStatistics($newAccountId);
        }
    }

    public static function refreshAccounts(array $accountIds) {
        if (empty($accountIds)) {
            return;
        }

        $uniqueIds = array();
        foreach ($accountIds as $accountId) {
            $accountId = (int) $accountId;
            if ($accountId > 0) {
                $uniqueIds[$accountId] = true;
            }
        }

        foreach (array_keys($uniqueIds) as $accountId) {
            self::refreshAccountStatistics((int) $accountId);
        }
    }

    public static function refreshAccountStatistics($accountId) {
        $accountId = (int) $accountId;
        if ($accountId <= 0) {
            return;
        }

        $db = PearDatabase::getInstance();

        $statsResult = $db->pquery(
            "SELECT
                SUM(CASE WHEN LOWER(REPLACE(TRIM(IFNULL(ccf.mobile_networks, '')), ' ', '')) IN ('viettel') THEN 1 ELSE 0 END) AS viettel_count,
                SUM(CASE WHEN LOWER(REPLACE(TRIM(IFNULL(ccf.mobile_networks, '')), ' ', '')) IN ('vinaphone', 'vinafone', 'vina') THEN 1 ELSE 0 END) AS vinaphone_count,
                SUM(CASE WHEN LOWER(REPLACE(TRIM(IFNULL(ccf.mobile_networks, '')), ' ', '')) IN ('mobifone', 'mobiphone', 'mobi', 'mobi-phone') THEN 1 ELSE 0 END) AS mobifone_count,
                SUM(CASE WHEN LOWER(REPLACE(TRIM(IFNULL(ccf.mobile_networks, '')), ' ', '')) IN ('gmobile', 'g-mobile') THEN 1 ELSE 0 END) AS gmobile_count,
                SUM(CASE WHEN TRIM(IFNULL(cd.email, '')) <> '' AND LOWER(TRIM(cd.email)) <> ? THEN 1 ELSE 0 END) AS valid_email_count
             FROM vtiger_contactdetails cd
             INNER JOIN vtiger_crmentity ce ON ce.crmid = cd.contactid
             LEFT JOIN vtiger_contactscf ccf ON ccf.contactid = cd.contactid
             WHERE cd.accountid = ? AND ce.deleted = 0",
            array(self::DEFAULT_CONTACT_EMAIL, $accountId)
        );

        $viettel = 0;
        $vinaphone = 0;
        $mobifone = 0;
        $gmobile = 0;
        $emailCount = 0;

        if ($statsResult && $db->num_rows($statsResult) > 0) {
            $viettel = (int) $db->query_result($statsResult, 0, 'viettel_count');
            $vinaphone = (int) $db->query_result($statsResult, 0, 'vinaphone_count');
            $mobifone = (int) $db->query_result($statsResult, 0, 'mobifone_count');
            $gmobile = (int) $db->query_result($statsResult, 0, 'gmobile_count');
            $emailCount = (int) $db->query_result($statsResult, 0, 'valid_email_count');
        }

        $db->pquery(
            'INSERT INTO vtiger_accountscf (accountid, cf_2142, cf_2144, cf_2146, cf_2148, cf_2156)
             VALUES (?, ?, ?, ?, ?, ?)
             ON DUPLICATE KEY UPDATE
                cf_2142 = VALUES(cf_2142),
                cf_2144 = VALUES(cf_2144),
                cf_2146 = VALUES(cf_2146),
                cf_2148 = VALUES(cf_2148),
                cf_2156 = VALUES(cf_2156)',
            array($accountId, $viettel, $vinaphone, $mobifone, $gmobile, $emailCount)
        );
    }
}
