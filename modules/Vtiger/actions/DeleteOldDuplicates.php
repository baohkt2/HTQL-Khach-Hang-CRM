<?php
/*+***********************************************************************************
 * Delete old duplicate records, keeping only the newest (highest ID) per group.
 ************************************************************************************/

class Vtiger_DeleteOldDuplicates_Action extends Vtiger_Mass_Action {

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

		$fields = $request->get('fields');
		$ignoreEmpty = $request->get('ignoreEmpty');
		$ignoreEmptyValue = false;
		if ($ignoreEmpty == 'on' || $ignoreEmpty == 'true' || $ignoreEmpty == '1') {
			$ignoreEmptyValue = true;
		}

		$dataModelInstance = Vtiger_FindDuplicate_Model::getInstance($moduleName);
		$dataModelInstance->set('fields', $fields);
		$dataModelInstance->set('ignoreEmpty', $ignoreEmptyValue);

		// Get ALL duplicate records (no paging)
		$allRecordIds = $this->getAllDuplicateRecordIds($dataModelInstance, $moduleName, $fields, $ignoreEmptyValue);

		// Group records and determine which to delete (all except newest per group)
		$recordsToDelete = $this->getOldDuplicateIds($dataModelInstance, $moduleName, $fields, $ignoreEmptyValue);

		// Delete
		global $VTIGER_BULK_SAVE_MODE;
		$previousBulkSaveMode = $VTIGER_BULK_SAVE_MODE;
		$VTIGER_BULK_SAVE_MODE = true;

		if (function_exists('set_time_limit')) {
			@set_time_limit(0);
		}

		$deletedCount = 0;
		$failedCount = 0;
		foreach ($recordsToDelete as $recordId) {
			try {
				if (Users_Privileges_Model::isPermitted($moduleName, 'Delete', $recordId)) {
					$recordModel = Vtiger_Record_Model::getInstanceById($recordId, $moduleModel);
					$recordModel->delete();
					$deletedCount++;
				}
			} catch (\Throwable $e) {
				$failedCount++;
				$logFile = 'logs/delete_old_duplicates_error.log';
				$timestamp = date('Y-m-d H:i:s');
				$msg = "[$timestamp] DeleteOldDuplicates FAIL record=$recordId module=$moduleName: "
					 . $e->getMessage() . " in " . $e->getFile() . ":" . $e->getLine() . "\n";
				file_put_contents($logFile, $msg, FILE_APPEND);
			}
		}

		$VTIGER_BULK_SAVE_MODE = $previousBulkSaveMode;

		$response = new Vtiger_Response();
		$response->setResult(array(
			'module' => $moduleName,
			'deleted' => $deletedCount,
			'failed' => $failedCount,
			'total' => count($recordsToDelete),
		));
		$response->emit();
	}

	/**
	 * Get IDs of old duplicate records to delete (keeping newest per group).
	 */
	private function getOldDuplicateIds($dataModelInstance, $moduleName, $fields, $ignoreEmptyValue) {
		$db = PearDatabase::getInstance();
		$moduleModel = Vtiger_Module_Model::getInstance($moduleName);
		$fieldModels = $moduleModel->getFields();
		$tableColumns = array();
		$requiredTables = array();
		$columnTypes = array();

		if (is_array($fields)) {
			foreach ($fields as $fieldName) {
				$fieldModel = $fieldModels[$fieldName];
				$tableColumns[] = $fieldModel->get('table') . '.' . $fieldModel->get('column');
				$requiredTables[] = $fieldModel->get('table');
				$columnTypes[$fieldModel->get('table') . '.' . $fieldModel->get('column')] = $fieldModel->getFieldDataType();
			}
		}

		$focus = CRMEntity::getInstance($moduleName);
		$query = $focus->getQueryForDuplicates($moduleName, $tableColumns, '', $ignoreEmptyValue, $requiredTables, $columnTypes);
		$result = $db->pquery($query, array());
		$rows = $db->num_rows($result);

		// Group records by their duplicate field values
		$groups = array();
		for ($i = 0; $i < $rows; $i++) {
			$row = $db->raw_query_result_rowdata($result, $i);
			$row = array_filter($row, function($k) { return !is_numeric($k); }, ARRAY_FILTER_USE_KEY);

			// Build group key from non-recordid fields
			$keyParts = array();
			foreach ($row as $field => $value) {
				if ($field !== 'recordid') {
					$keyParts[] = mb_strtolower(trim((string)$value));
				}
			}
			$groupKey = implode('|||', $keyParts);
			$groups[$groupKey][] = (int)$row['recordid'];
		}

		// For each group, keep the newest (highest ID), mark others for deletion
		$toDelete = array();
		foreach ($groups as $groupKey => $ids) {
			if (count($ids) < 2) continue;
			sort($ids, SORT_NUMERIC);
			// Remove last (newest/highest ID) — keep it
			array_pop($ids);
			// Rest are old duplicates to delete
			$toDelete = array_merge($toDelete, $ids);
		}

		return $toDelete;
	}
}
