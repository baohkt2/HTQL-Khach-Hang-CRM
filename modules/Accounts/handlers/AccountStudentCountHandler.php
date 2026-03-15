<?php
/*+***********************************************************************************
 * CUSC custom handler: synchronize student count on Accounts when Contacts change.
 *************************************************************************************/

require_once 'include/events/VTEventHandler.inc';
require_once 'data/VTEntityDelta.php';

class AccountStudentCountHandler extends VTEventHandler {

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
                $this->refreshAccountStudentCount($accountId);
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

        // VTEntityDelta is already registered globally; this reads old account value safely.
        $delta = new VTEntityDelta();
        $oldValue = $delta->getOldValue('Contacts', $recordId, 'account_id');
        if ($oldValue !== null && $oldValue !== '') {
            $oldAccountId = (int) $oldValue;
        }

        if ($entityData->isNew()) {
            if ($newAccountId > 0) {
                $this->refreshAccountStudentCount($newAccountId);
            }
            return;
        }

        if ($oldAccountId !== $newAccountId) {
            if ($oldAccountId > 0) {
                $this->refreshAccountStudentCount($oldAccountId);
            }
            if ($newAccountId > 0) {
                $this->refreshAccountStudentCount($newAccountId);
            }
        }
    }

    protected function refreshAccountStudentCount($accountId) {
        $accountId = (int) $accountId;
        if ($accountId <= 0) {
            return;
        }

        $db = PearDatabase::getInstance();

        $countResult = $db->pquery(
            'SELECT COUNT(*) AS total_students
             FROM vtiger_contactdetails
             INNER JOIN vtiger_crmentity ON vtiger_crmentity.crmid = vtiger_contactdetails.contactid
             WHERE vtiger_contactdetails.accountid = ? AND vtiger_crmentity.deleted = 0',
            [$accountId]
        );

        $totalStudents = 0;
        if ($countResult && $db->num_rows($countResult) > 0) {
            $totalStudents = (int) $db->query_result($countResult, 0, 'total_students');
        }

        $db->pquery(
            'INSERT INTO vtiger_accountscf (accountid, cf_2090) VALUES (?, ?)
             ON DUPLICATE KEY UPDATE cf_2090 = VALUES(cf_2090)',
            [$accountId, $totalStudents]
        );
    }
}
