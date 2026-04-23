<?php
/*+***********************************************************************************
 * CUSC batch handler: refresh Accounts telecom/email counters after Contacts batch save.
 *************************************************************************************/

require_once 'include/events/VTEventHandler.inc';
require_once 'modules/Accounts/handlers/AccountContactNetworkEmailStatsHandler.php';

class ContactAccountNetworkEmailStatsBatchHandler extends VTEventHandler {

    public function handleEvent($eventName, $entityDatas) {
        if ($eventName !== 'vtiger.batchevent.save' || !is_array($entityDatas)) {
            return;
        }

        $accountIds = array();

        foreach ($entityDatas as $entityData) {
            if (!is_object($entityData) || !method_exists($entityData, 'getModuleName')) {
                continue;
            }

            if ($entityData->getModuleName() !== 'Contacts') {
                continue;
            }

            $accountId = (int) $entityData->get('account_id');
            if ($accountId <= 0) {
                $contactId = (int) $entityData->getId();
                if ($contactId > 0) {
                    $accountId = $this->findAccountIdByContactId($contactId);
                }
            }

            if ($accountId > 0) {
                $accountIds[$accountId] = $accountId;
            }
        }

        if (!empty($accountIds)) {
            AccountContactNetworkEmailStatsHandler::refreshAccounts(array_values($accountIds));
        }
    }

    protected function findAccountIdByContactId($contactId) {
        $contactId = (int) $contactId;
        if ($contactId <= 0) {
            return 0;
        }

        $db = PearDatabase::getInstance();
        $result = $db->pquery(
            'SELECT accountid FROM vtiger_contactdetails WHERE contactid = ?',
            array($contactId)
        );

        if (!$result || $db->num_rows($result) === 0) {
            return 0;
        }

        return (int) $db->query_result($result, 0, 'accountid');
    }
}
