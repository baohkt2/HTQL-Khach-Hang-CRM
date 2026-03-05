<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Vtiger_MassDelete_Action extends Vtiger_Mass_Action {

	public function requiresPermission(\Vtiger_Request $request) {
		$permissions = parent::requiresPermission($request);
		$permissions[] = array('module_parameter' => 'module', 'action' => 'Delete');
		return $permissions;
	}
	
	function preProcess(Vtiger_Request $request) {
		return true;
	}

	function postProcess(Vtiger_Request $request) {
		return true;
	}

	public function process(Vtiger_Request $request) {
		$moduleName = $request->getModule();
		$moduleModel = Vtiger_Module_Model::getInstance($moduleName);

		if($request->get('selected_ids') == 'all' && $request->get('mode') == 'FindDuplicates') {
			$recordIds = Vtiger_FindDuplicate_Model::getMassDeleteRecords($request);
		} else {
			$recordIds = $this->getRecordsListFromRequest($request);
		}

		$cvId = $request->get('viewname');

		// Use bulk save mode to skip per-record event handlers (beforedelete/afterdelete)
		// This dramatically speeds up mass deletion and prevents timeouts
		global $VTIGER_BULK_SAVE_MODE;
		$previousBulkSaveMode = $VTIGER_BULK_SAVE_MODE;
		$VTIGER_BULK_SAVE_MODE = true;

		// Extend time limit for large batch deletions
		if (function_exists('set_time_limit')) {
			@set_time_limit(0);
		}

		foreach($recordIds as $recordId) {
			try {
				if(Users_Privileges_Model::isPermitted($moduleName, 'Delete', $recordId)) {
					$recordModel = Vtiger_Record_Model::getInstanceById($recordId, $moduleModel);
					$recordModel->delete();
					deleteRecordFromDetailViewNavigationRecords($recordId, $cvId, $moduleName);
				}
			} catch (\Throwable $e) {
				// Log and continue with next record
				$logFile = 'logs/mass_delete_error.log';
				$timestamp = date('Y-m-d H:i:s');
				$msg = "[$timestamp] MassDelete FAIL record=$recordId module=$moduleName: "
					 . $e->getMessage() . " in " . $e->getFile() . ":" . $e->getLine() . "\n";
				file_put_contents($logFile, $msg, FILE_APPEND);
			}
		}

		$VTIGER_BULK_SAVE_MODE = $previousBulkSaveMode;

		$response = new Vtiger_Response();
		$response->setResult(array('viewname'=>$cvId, 'module'=>$moduleName));
		$response->emit();
	}
}
