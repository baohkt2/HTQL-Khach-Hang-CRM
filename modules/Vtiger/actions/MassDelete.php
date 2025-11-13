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
		
		// DEBUG: Log how many records to delete
		error_log("MassDelete: Attempting to delete " . count($recordIds) . " records");
		error_log("MassDelete: Record IDs: " . implode(", ", $recordIds));
		error_log("MassDelete: Is array? " . (is_array($recordIds) ? "YES" : "NO"));
		
		$cvId = $request->get('viewname');
		$deletedCount = 0;
		
		$db = PearDatabase::getInstance();
		
		error_log("MassDelete: Starting foreach loop");
		
		try {
			foreach($recordIds as $index => $recordId) {
				error_log("MassDelete: ========== Processing record $index: ID=$recordId ==========");
				
				// Check if record is already deleted
				error_log("MassDelete: Checking if record $recordId is already deleted");
				$result = $db->pquery("SELECT deleted FROM vtiger_crmentity WHERE crmid = ?", array($recordId));
				error_log("MassDelete: Query executed, num_rows=" . $db->num_rows($result));
				
				if ($db->num_rows($result) > 0) {
					$deleted = $db->query_result($result, 0, 'deleted');
					error_log("MassDelete: Record $recordId has deleted flag = $deleted");
					
					if ($deleted == 1) {
						error_log("MassDelete: *** SKIPPING record ID $recordId - already deleted ***");
						continue;
					}
				}
				
				error_log("MassDelete: Record $recordId is active, proceeding with delete");
				
				if(Users_Privileges_Model::isPermitted($moduleName, 'Delete', $recordId)) {
					error_log("MassDelete: Permission granted for record ID: " . $recordId);
					
					$recordModel = Vtiger_Record_Model::getInstanceById($recordId, $moduleModel);
					error_log("MassDelete: Got record model for ID: " . $recordId);
					
					error_log("MassDelete: Calling delete() method for record ID: " . $recordId);
					$recordModel->delete();
					error_log("MassDelete: Successfully deleted record ID: " . $recordId);
					
					deleteRecordFromDetailViewNavigationRecords($recordId, $cvId, $moduleName);
					error_log("MassDelete: Removed from navigation records: " . $recordId);
					
					$deletedCount++;
					error_log("MassDelete: deletedCount is now: " . $deletedCount);
				} else {
					error_log("MassDelete: *** NO PERMISSION to delete record ID: " . $recordId . " ***");
				}
				
				error_log("MassDelete: ========== Finished processing record $index ==========");
			}
		} catch (Exception $e) {
			error_log("MassDelete: !!!!! EXCEPTION CAUGHT !!!!!");
			error_log("MassDelete: Exception message: " . $e->getMessage());
			error_log("MassDelete: Stack trace: " . $e->getTraceAsString());
		}
		
		error_log("MassDelete: Total deleted: " . $deletedCount . " out of " . count($recordIds));
		
		$response = new Vtiger_Response();
		$response->setResult(array('viewname'=>$cvId, 'module'=>$moduleName));
		$response->emit();
	}
}
