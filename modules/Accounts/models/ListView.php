<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Accounts_ListView_Model extends Vtiger_ListView_Model {

	/**
	 * Function to get the list of Mass actions for the module
	 * @param <Array> $linkParams
	 * @return <Array> - Associative array of Link type to List of  Vtiger_Link_Model instances for Mass Actions
	 */
	public function getListViewMassActions($linkParams) {
		$massActionLinks = parent::getListViewMassActions($linkParams);

		$currentUserModel = Users_Privileges_Model::getCurrentUserPrivilegesModel();
		$emailModuleModel = Vtiger_Module_Model::getInstance('Emails');

		if($currentUserModel->hasModulePermission($emailModuleModel->getId())) {
			$massActionLink = array(
				'linktype' => 'LISTVIEWMASSACTION',
				'linklabel' => 'LBL_SEND_EMAIL',
				'linkurl' => 'javascript:Vtiger_List_Js.triggerSendEmail("index.php?module='.$this->getModule()->getName().'&view=MassActionAjax&mode=showComposeEmailForm&step=step1","Emails");',
				'linkicon' => ''
			);
			$massActionLinks['LISTVIEWMASSACTION'][] = Vtiger_Link_Model::getInstanceFromValues($massActionLink);
		}

		$SMSNotifierModuleModel = Vtiger_Module_Model::getInstance('SMSNotifier');
		if(!empty($SMSNotifierModuleModel) && $currentUserModel->hasModulePermission($SMSNotifierModuleModel->getId())) {
			$massActionLink = array(
				'linktype' => 'LISTVIEWMASSACTION',
				'linklabel' => 'LBL_SEND_SMS',
				'linkurl' => 'javascript:Vtiger_List_Js.triggerSendSms("index.php?module='.$this->getModule()->getName().'&view=MassActionAjax&mode=showSendSMSForm","SMSNotifier");',
				'linkicon' => ''
			);
			$massActionLinks['LISTVIEWMASSACTION'][] = Vtiger_Link_Model::getInstanceFromValues($massActionLink);
		}
		
		$moduleModel = $this->getModule();
		if($currentUserModel->hasModuleActionPermission($moduleModel->getId(), 'EditView')) {
			$massActionLink = array(
				'linktype' => 'LISTVIEWMASSACTION',
				'linklabel' => 'LBL_TRANSFER_OWNERSHIP',
				'linkurl' => 'javascript:Vtiger_List_Js.triggerTransferOwnership("index.php?module='.$moduleModel->getName().'&view=MassActionAjax&mode=transferOwnership")',
				'linkicon' => ''
			);
			$massActionLinks['LISTVIEWMASSACTION'][] = Vtiger_Link_Model::getInstanceFromValues($massActionLink);
		}

		return $massActionLinks;
	}
	
	/**
	 * Function to get the list of listview links for the module
	 * @param <Array> $linkParams
	 * @return <Array> - Associate array of Link Type to List of Vtiger_Link_Model instances
	 */
	function getListViewLinks($linkParams) {
		$links = parent::getListViewLinks($linkParams);

		$index=0;
		foreach($links['LISTVIEWBASIC'] as $link) {
			if($link->linklabel == 'Send SMS') {
				unset($links['LISTVIEWBASIC'][$index]);
			}
			$index++;
		}
		return $links;
	}

	/**
	 * Function to get list view entries with contacts count
	 * @param <Vtiger_Paging_Model> $pagingModel
	 * @return <Array> - Associative array of record id mapped to Vtiger_Record_Model instance.
	 */
	public function getListViewEntries($pagingModel) {
		$db = PearDatabase::getInstance();
		
		// Get the standard list view entries first
		$listViewRecordModels = parent::getListViewEntries($pagingModel);
		
		// Get all account IDs from the current page
		$accountIds = array_keys($listViewRecordModels);
		
		if (!empty($accountIds)) {
			// Query to get contact counts for each account
			$accountIdsString = implode(',', array_map('intval', $accountIds));
			$countQuery = "SELECT vtiger_account.accountid, COUNT(DISTINCT vtiger_contactdetails.contactid) as contact_count
						   FROM vtiger_account
						   LEFT JOIN vtiger_contactdetails ON vtiger_contactdetails.accountid = vtiger_account.accountid
						   LEFT JOIN vtiger_crmentity ON vtiger_crmentity.crmid = vtiger_contactdetails.contactid
						   WHERE vtiger_account.accountid IN ($accountIdsString)
						   AND (vtiger_crmentity.deleted = 0 OR vtiger_crmentity.deleted IS NULL)
						   GROUP BY vtiger_account.accountid";
			
			$countResult = $db->pquery($countQuery, array());
			$contactCounts = array();
			
			while ($row = $db->fetchByAssoc($countResult)) {
				$contactCounts[$row['accountid']] = $row['contact_count'];
			}
			
			// Add contact count to each record model
			foreach ($listViewRecordModels as $accountId => $recordModel) {
				$contactCount = isset($contactCounts[$accountId]) ? $contactCounts[$accountId] : 0;
				$recordModel->set('contacts_count', $contactCount);
			}
		}
		
		return $listViewRecordModels;
	}
}