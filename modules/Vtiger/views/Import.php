<?php

/* +***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 * *********************************************************************************** */

class Vtiger_Import_View extends Vtiger_Index_View {

	function __construct() {
		parent::__construct();
		$this->exposeMethod('continueImport');
		$this->exposeMethod('uploadAndParse');
		$this->exposeMethod('importBasicStep');
		$this->exposeMethod('import');
		$this->exposeMethod('undoImport');
		$this->exposeMethod('lastImportedRecords');
		$this->exposeMethod('deleteMap');
		$this->exposeMethod('clearCorruptedData');
		$this->exposeMethod('cancelImport');
		$this->exposeMethod('checkImportStatus');
		$this->exposeMethod('updateSavedMapping');
		$this->exposeMethod('getImportProgress');
	}

	public function requiresPermission(Vtiger_Request $request){
		$permissions = parent::requiresPermission($request);
		
		$permissions[] = array('module_parameter' => 'module', 'action' => 'Import');
		return $permissions;
	}

	function process(Vtiger_Request $request) {
		global $VTIGER_BULK_SAVE_MODE;
		$previousBulkSaveMode = $VTIGER_BULK_SAVE_MODE;
		$VTIGER_BULK_SAVE_MODE = true;

		$mode = $request->getMode();
		if(!empty($mode)) {
			// Added to check the status of import
			if($mode == 'continueImport' || $mode == 'uploadAndParse' || $mode == 'importBasicStep') {
				$this->checkImportStatus($request);
			}
			if($mode == 'landing') {
				$this->importLandingPage($request);
			} else {
				$this->invokeExposedMethod($mode, $request);
			}
		} else {
			$this->checkImportStatus($request);
			$this->importBasicStep($request);
		}

		$VTIGER_BULK_SAVE_MODE = $previousBulkSaveMode;
	}

	/**
	 * Function to get the list of Script models to be included
	 * @param Vtiger_Request $request
	 * @return <Array> - List of Vtiger_JsScript_Model instances
	 */
	function getHeaderScripts(Vtiger_Request $request) {
		$headerScriptInstances = parent::getHeaderScripts($request);

		$jsFileNames = array(
			'modules.Import.resources.Import'
		);

		$moduleName = $request->getModule();
		if (in_array($moduleName, getInventoryModules())) {
			$moduleEditFile = 'modules.'.$moduleName.'.resources.Edit';
			unset($headerScriptInstances[$moduleEditFile]);

			$jsFileNames = array(
				'modules.Inventory.resources.Edit',
				'modules.'.$moduleName.'.resources.Edit',
				'modules.Import.resources.Import'
			);
		}

		$jsScriptInstances = $this->checkAndConvertJsScripts($jsFileNames);
		$headerScriptInstances = array_merge($headerScriptInstances, $jsScriptInstances);
		return $headerScriptInstances;
	}

	function getUnsupportedDuplicateHandlingModules(){
		$inventory = getInventoryModules();
		return array_merge(array('PriceBooks', 'Users'), $inventory);
	}

	//vtiger7
	function importLandingPage(Vtiger_Request $request) {
		$viewer = $this->getViewer($request);
		$moduleName = $request->getModule();
		$viewer->assign('FOR_MODULE', $moduleName);
		$viewer->assign('MODULE', 'Import');
		return $viewer->view('ImportLandingPage.tpl', 'Import');
	}

	function importBasicStep(Vtiger_Request $request) {
			$viewer = $this->getViewer($request);
		$moduleName = $request->getModule();

		$moduleModel = Vtiger_Module_Model::getInstance($moduleName);
		$moduleMeta = $moduleModel->getModuleMeta();

		$supportedFileTypes = Import_Utils_Helper::getSupportedFileExtensions();
		if ($moduleName == 'Calendar') {
			$supportedFileTypes[] = 'ics';
		}

		$viewer->assign('FOR_MODULE', $moduleName);
		$viewer->assign('MODULE', 'Import');
		$viewer->assign('SUPPORTED_FILE_TYPES', $supportedFileTypes);
		$viewer->assign('SUPPORTED_FILE_ENCODING', Import_Utils_Helper::getSupportedFileEncoding());
		$viewer->assign('SUPPORTED_DELIMITERS', Import_Utils_Helper::getSupportedDelimiters());
		$viewer->assign('AUTO_MERGE_TYPES', Import_Utils_Helper::getAutoMergeTypes($moduleName));

		//Duplicate records handling not supported for inventory moduels
		$duplicateHandlingNotSupportedModules = $this->getUnsupportedDuplicateHandlingModules();
		if(in_array($moduleName, $duplicateHandlingNotSupportedModules)){
			$viewer->assign('DUPLICATE_HANDLING_NOT_SUPPORTED', true);
		}
		//End

		$fileFormat = $request->get('fileFormat');
		if (!$fileFormat || !in_array($fileFormat, $supportedFileTypes)) {
			$fileFormat = 'csv';
		} else {
			$fileFormat = strtolower($fileFormat);
		}

		$viewer->assign('AVAILABLE_FIELDS', $moduleMeta->getMergableFields());
		$viewer->assign('ENTITY_FIELDS', $moduleMeta->getEntityFields());
		$viewer->assign('ERROR_MESSAGE', $request->get('error_message'));
		$viewer->assign('IMPORT_UPLOAD_SIZE_MB', Vtiger_Util_Helper::getMaxUploadSize());
		$viewer->assign('IMPORT_UPLOAD_SIZE', Vtiger_Util_Helper::getMaxUploadSizeInBytes());

		if(in_array($moduleName, Vtiger_Functions::getLineItemFieldModules())){
			$viewer->assign('MULTI_CURRENCY',true);
			$viewer->assign('CURRENCIES', getAllCurrencies());
		}

		$viewer->assign('FORMAT', $fileFormat);
		return $viewer->view('ImportBasicStep.tpl', 'Import');
	}

	function uploadAndParse(Vtiger_Request $request) {
		$viewer = $this->getViewer($request);
		$moduleName = $request->getModule();
		$duplicateHandlingNotSupportedModules = $this->getUnsupportedDuplicateHandlingModules();
		if(in_array($moduleName, $duplicateHandlingNotSupportedModules)){
			$viewer->assign('DUPLICATE_HANDLING_NOT_SUPPORTED', true);
		}
		try{
			$this->initializeMappingParameters($request);
			return $viewer->view('ImportAdvanced.tpl', 'Import');
		} catch(\Throwable $e) {
			error_log("Import uploadAndParse error: " . $e->getMessage() . " in " . $e->getFile() . ":" . $e->getLine());
			$this->importBasicStep($request);
		}
	}

	function initializeMappingParameters(Vtiger_Request $request) {
		if(Import_Utils_Helper::validateFileUpload($request)) {
			$moduleName = $request->getModule();
			$user = Users_Record_Model::getCurrentUserModel();

			$fileReader = Import_Utils_Helper::getFileReader($request, $user);
			if($fileReader == null) {
				$request->set('error_message', vtranslate('LBL_INVALID_FILE', 'Import'));
				throw new Exception('103');
			}

			$hasHeader = $fileReader->hasHeader();
			$rowData = $fileReader->getFirstRowData($hasHeader);
			$moduleModel = Vtiger_Module_Model::getInstance($moduleName);

			$viewer = $this->getViewer($request);
			$autoMerge = $request->get('auto_merge');  
			if(!$autoMerge) {
				$request->set('merge_type', 0);
				$request->set('merge_fields', '');
			} else {
				$merge_fields = $request->get('merge_fields');
				$mergeCretieriaFields = array();
				if (is_array($merge_fields)) {
					foreach ($merge_fields as $value) {
						$fieldInstance = Vtiger_Field_Model::getInstance($value, $moduleModel);
						$fieldInfo = $fieldInstance->getFieldInfo();
						$mergeCretieriaFields[$value] = vtranslate($fieldInfo['label'], $moduleModel->getName());
					}
				}
				$viewer->assign('MERGE_FIELDS', Zend_Json::encode($mergeCretieriaFields));
			}

			$moduleMeta = $moduleModel->getModuleMeta();

			$mandatoryFields = $moduleMeta->getMandatoryFields($moduleName);
			$inventoryModules = getInventoryModules();
			if($moduleName == 'Calendar' && !array_key_exists('activitytype', $mandatoryFields)){
				$mandatoryFields['activitytype'] = vtranslate('Activity Type',$moduleName);
			} elseif (in_array($moduleName, $inventoryModules)) {
				if(array_key_exists('netprice', $mandatoryFields)) {
					unset($mandatoryFields['netprice']);
				}
			}

			$viewer->assign('DATE_FORMAT', $user->date_format);
			$viewer->assign('FOR_MODULE', $moduleName);
			$viewer->assign('MODULE', 'Import');

			$viewer->assign('HAS_HEADER', $hasHeader);
			$viewer->assign('ROW_1_DATA', $rowData);
			$viewer->assign('USER_INPUT', $request);

			$viewer->assign('AVAILABLE_FIELDS', $moduleMeta->getImportableFields($moduleName));
			$viewer->assign('ENCODED_MANDATORY_FIELDS', Zend_Json::encode($mandatoryFields));
			$viewer->assign('SAVED_MAPS', Import_Map_Model::getAllByModule($moduleName));
			$viewer->assign('USERS_LIST', Import_Utils_Helper::getAssignedToUserList($moduleName));
			$viewer->assign('GROUPS_LIST', Import_Utils_Helper::getAssignedToGroupList($moduleName));

			if(in_array($moduleName, Vtiger_Functions::getLineItemFieldModules())){
				$viewer->assign('LINEITEM_CURRENCY',$request->get('lineitem_currency'));
			}

			$mandatoryFields = array_keys($mandatoryFields);
			$viewer->assign('IMPORT_MANDATORY_FIELDS', $mandatoryFields);

		} else {
			throw new Exception('103');
		}
	}

	function import(Vtiger_Request $request) {
		$user = Users_Record_Model::getCurrentUserModel();
		Import_Main_View::import($request, $user);
	}

	function undoImport(Vtiger_Request $request) {
		$viewer = new Vtiger_Viewer();
		$db = PearDatabase::getInstance();

		$moduleName = $request->getModule();
		$ownerId = $request->get('foruser');

		$user = Users_Record_Model::getCurrentUserModel();
		$dbTableName = Import_Utils_Helper::getDbTableName($user);

		if(!$user->isAdminUser() && $user->id != $ownerId) {
			$viewer->assign('MESSAGE', vtranslate('LBL_PERMISSION_DENIED'));
			$viewer->view('OperationNotPermitted.tpl', 'Vtiger');
			exit;
		}
		$previousBulkSaveMode = $VTIGER_BULK_SAVE_MODE;
		$VTIGER_BULK_SAVE_MODE = true;
		$query = "SELECT recordid FROM $dbTableName WHERE status = ? AND recordid IS NOT NULL";
		//For inventory modules
		$inventoryModules = getInventoryModules();
		if(in_array($moduleName, $inventoryModules)){
			$query .=' GROUP BY subject';
		}
		//End
		$result = $db->pquery($query, array(Import_Data_Action::$IMPORT_RECORD_CREATED));
		$noOfRecords = $db->num_rows($result);
		$noOfRecordsDeleted = 0;
		$entityData = array();
		for($i=0; $i<$noOfRecords; $i++) {
			$recordId = $db->query_result($result, $i, 'recordid');
			if(isRecordExists($recordId) && isPermitted($moduleName, 'Delete', $recordId) == 'yes') {
				$recordModel = Vtiger_Record_Model::getCleanInstance($moduleName);
				$recordModel->setId($recordId);
				$recordModel->delete();
				$focus = $recordModel->getEntity();
				$focus->id = $recordId;
				$entityData[] = VTEntityData::fromCRMEntity($focus);
				$noOfRecordsDeleted++;
			}
		}
		$entity = new VTEventsManager($db);
		$entity->triggerEvent('vtiger.batchevent.delete',$entityData);
		$VTIGER_BULK_SAVE_MODE = $previousBulkSaveMode;
		$viewer->assign('FOR_MODULE', $moduleName);
		$viewer->assign('MODULE', 'Import');
		$viewer->assign('TOTAL_RECORDS', $noOfRecords);
		$viewer->assign('DELETED_RECORDS_COUNT', $noOfRecordsDeleted);
		$viewer->view('ImportUndoResult.tpl', 'Import');
	}

	function lastImportedRecords(Vtiger_Request $request) {
		$importList = new Import_List_View();
		$importList->process($request);
	}

	function deleteMap(Vtiger_Request $request) {
		Import_Main_View::deleteMap($request);
	}

	//TODO need to move it to an action
	function clearCorruptedData(Vtiger_Request $request) {
		$user = Users_Record_Model::getCurrentUserModel();
		Import_Utils_Helper::clearUserImportInfo($user);
		$this->importBasicStep($request);
	}

	function cancelImport(Vtiger_Request $request) {
		$importId = $request->get('import_id');
		$user = Users_Record_Model::getCurrentUserModel();

		$importInfo = Import_Queue_Action::getImportInfoById($importId);
		if($importInfo != null) {
			if($importInfo['user_id'] == $user->id || $user->isAdminUser()) {
				$importUser = Users_Record_Model::getInstanceById($importInfo['user_id'], 'Users');
				$importDataController = new Import_Data_Action($importInfo, $importUser);
				$importStatusCount = $importDataController->getImportStatusCount();
				$importDataController->finishImport();
				Import_Main_View::showResult($importInfo, $importStatusCount);
			}
		}
	}

	/**
	 * Lightweight JSON endpoint for polling import progress.
	 * Returns record counts from the import staging table without processing any records.
	 */
	function getImportProgress(Vtiger_Request $request) {
		// Clean all output buffers from preProcess (which outputs HTML headers)
		// so we can return pure JSON
		while (ob_get_level()) {
			ob_end_clean();
		}

		$moduleName = $request->getModule();
		$user = Users_Record_Model::getCurrentUserModel();
		$adb = PearDatabase::getInstance();

		$tableName = Import_Utils_Helper::getDbTableName($user);

		// Check if staging table exists
		if (!Vtiger_Utils::CheckTable($tableName)) {
			$response = new Vtiger_Response();
			$response->setResult(array(
				'status' => 'no_data',
				'total' => 0,
				'processed' => 0,
				'created' => 0,
				'updated' => 0,
				'skipped' => 0,
				'merged' => 0,
				'failed' => 0,
				'pending' => 0,
				'is_running' => false
			));
			$response->emit();
			exit;
		}

		$result = $adb->pquery(
			"SELECT
				COUNT(*) as total,
				SUM(CASE WHEN status != 0 THEN 1 ELSE 0 END) as processed,
				SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) as created,
				SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) as updated,
				SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) as skipped,
				SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) as merged,
				SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) as failed,
				SUM(CASE WHEN status = 0 THEN 1 ELSE 0 END) as pending
			FROM $tableName",
			array(
				Import_Data_Action::$IMPORT_RECORD_CREATED,
				Import_Data_Action::$IMPORT_RECORD_UPDATED,
				Import_Data_Action::$IMPORT_RECORD_SKIPPED,
				Import_Data_Action::$IMPORT_RECORD_MERGED,
				Import_Data_Action::$IMPORT_RECORD_FAILED
			)
		);

		$row = $adb->query_result_rowdata($result, 0);
		$total = (int)$row['total'];
		$processed = (int)($row['processed'] ?? 0);
		$created = (int)($row['created'] ?? 0);
		$updated = (int)($row['updated'] ?? 0);
		$skipped = (int)($row['skipped'] ?? 0);
		$merged = (int)($row['merged'] ?? 0);
		$failed = (int)($row['failed'] ?? 0);
		$pending = (int)($row['pending'] ?? 0);

		// Check if import is still actively running (lock exists)
		$lockInfo = Import_Lock_Action::isLockedForModule($moduleName);
		$isRunning = ($lockInfo != null);

		// Also check queue status
		$importInfo = Import_Queue_Action::getUserCurrentImportInfo($user);
		$importId = 0;
		if ($importInfo != null) {
			$importId = $importInfo['id'];
			// If import is in queue but no lock, it might be scheduled or finished
			if (!$isRunning && $importInfo['status'] == Import_Queue_Action::$IMPORT_STATUS_HALTED) {
				$isRunning = true; // Still processing (HALTED means in-between batches)
			}
		}

		// If every row is already processed, treat import as completed even if
		// lock/queue state has not been cleaned up yet.
		if ($total > 0 && $pending === 0 && $processed >= $total) {
			$isRunning = false;
		}

		$response = new Vtiger_Response();
		$response->setResult(array(
			'status' => 'ok',
			'total' => $total,
			'processed' => $processed,
			'created' => $created,
			'updated' => $updated,
			'skipped' => $skipped,
			'merged' => $merged,
			'failed' => $failed,
			'pending' => $pending,
			'is_running' => $isRunning,
			'import_id' => $importId
		));
		$response->emit();
		exit;
	}

	function checkImportStatus(Vtiger_Request $request) {
		$moduleName = $request->getModule();
		$user = Users_Record_Model::getCurrentUserModel();
		$mode = $request->getMode();

		// Auto-release stale locks (older than staleLockTimeout seconds)
		$this->cleanupStaleLocks($moduleName, $user);

		// Check if import on the module is locked
		$lockInfo = Import_Lock_Action::isLockedForModule($moduleName);
		if($lockInfo != null) {
			$lockedBy = $lockInfo['userid'];
			if($user->id != $lockedBy && !$user->isAdminUser()) {
				Import_Utils_Helper::showImportLockedError($lockInfo);
				exit;
			} else {
				if($mode == 'continueImport' && $user->id == $lockedBy) {
					$importController = new Import_Main_View($request, $user);
					$importController->triggerImport(true);
				} else {
					$importInfo = Import_Queue_Action::getImportInfoById($lockInfo['importid']);
					$lockOwner = $user;
					if($user->id != $lockedBy) {
						$lockOwner = Users_Record_Model::getInstanceById($lockInfo['userid'], 'Users');
					}
					Import_Main_View::showImportStatus($importInfo, $lockOwner);
				}
				exit;
			}
		}

		if(Import_Utils_Helper::isUserImportBlocked($user)) {
			$importInfo = Import_Queue_Action::getUserCurrentImportInfo($user);
			if($importInfo != null) {
				Import_Main_View::showImportStatus($importInfo, $user);
				exit;
			} else {
				Import_Utils_Helper::showImportTableBlockedError($moduleName, $user);
				exit;
			}
		}
		Import_Utils_Helper::clearUserImportInfo($user);
	}

	public function updateSavedMapping(Vtiger_Request $request) {
		Import_Main_View::updateMap($request);
	}

	/**
	 * Auto-release import locks that are older than the configured timeout.
	 * This prevents permanently stuck imports from blocking the module.
	 */
	protected function cleanupStaleLocks($moduleName, $user) {
		$adb = PearDatabase::getInstance();
		if (!Vtiger_Utils::CheckTable('vtiger_import_locks')) {
			return;
		}

		$configReader = new Import_Config_Model();
		$staleLockTimeout = $configReader->get('staleLockTimeout');
		if (empty($staleLockTimeout)) {
			$staleLockTimeout = 1800; // default 30 minutes
		}

		$tabId = getTabid($moduleName);
		$result = $adb->pquery(
			'SELECT * FROM vtiger_import_locks WHERE tabid = ? AND locked_since < DATE_SUB(NOW(), INTERVAL ? SECOND)',
			array($tabId, $staleLockTimeout)
		);

		if ($result && $adb->num_rows($result) > 0) {
			for ($i = 0; $i < $adb->num_rows($result); $i++) {
				$lockRow = $adb->query_result_rowdata($result, $i);
				$lockedUserId = $lockRow['userid'];
				$importId = $lockRow['importid'];

				// Clean up the stale lock, queue entry, and staging table
				$lockedUser = new Users();
				$lockedUser->id = $lockedUserId;
				Import_Utils_Helper::clearUserImportInfo($lockedUser);

				error_log("Import: Auto-released stale lock for module=$moduleName, userId=$lockedUserId, importId=$importId (locked_since={$lockRow['locked_since']})");
			}
		}
	}
}
