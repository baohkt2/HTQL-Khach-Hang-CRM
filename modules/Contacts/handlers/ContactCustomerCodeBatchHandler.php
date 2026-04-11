<?php
/*+***********************************************************************************
 * CUSC: Backfill customer code for Contacts in batch save flows (import/bulk).
 * Triggered by vtiger.batchevent.save where regular beforesave events are disabled.
 *************************************************************************************/

require_once 'include/events/VTEventHandler.inc';
require_once 'include/events/VTEntityData.inc';
require_once 'modules/Contacts/handlers/ContactCustomerCodeHandler.php';

class ContactCustomerCodeBatchHandler extends VTEventHandler {

	public function handleEvent($eventName, $entityDatas) {
		if ($eventName !== 'vtiger.batchevent.save' || !is_array($entityDatas)) {
			return;
		}

		foreach ($entityDatas as $entityData) {
			if (!is_object($entityData) || !method_exists($entityData, 'getModuleName')) {
				continue;
			}
			if ($entityData->getModuleName() !== 'Contacts') {
				continue;
			}

			$contactId = (int) $entityData->getId();
			if ($contactId <= 0) {
				continue;
			}

			ContactCustomerCodeLogic::generateAndSaveIfMissingForContactId($contactId);
		}
	}
}
