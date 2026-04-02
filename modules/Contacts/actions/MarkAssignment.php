<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Contacts_MarkAssignment_Action extends Vtiger_Mass_Action {
	const ASSIGNMENT_FIELD_NAME = 'cf_2133';
	const ASSIGNMENT_FIELD_LABEL_HEX = 'c490c3a3207068c3a26e2063c3b46e67';
	const ASSIGNMENT_TABLE_NAME = 'vtiger_contactscf';
	const DEFAULT_BATCH_LIMIT = 1000;
	const MAX_BATCH_LIMIT = 2000;

	public function process(Vtiger_Request $request) {
		$response = new Vtiger_Response();

		try {
			$moduleName = $request->getModule();
			$markValue = $this->resolveMarkValue($request->get('assignment_mode'));
			if ($markValue === null) {
				$response->setError(vtranslate('LBL_INVALID_DATA', $moduleName));
				$response->emit();
				return;
			}

			$recordIds = $this->getRecordsListFromRequest($request);
			if (empty($recordIds) || !is_array($recordIds)) {
				$response->setError(vtranslate('LBL_NO_RECORD_SELECTED', $moduleName));
				$response->emit();
				return;
			}

			$recordIds = array_values(array_unique(array_map('intval', $recordIds)));
			$recordIds = array_filter($recordIds, function($recordId) {
				return $recordId > 0;
			});
			if (empty($recordIds)) {
				$response->setError(vtranslate('LBL_NO_RECORD_SELECTED', $moduleName));
				$response->emit();
				return;
			}

			$columnName = $this->resolveAssignmentColumnName();
			if (empty($columnName)) {
				$response->setError(vtranslate('LBL_OPERATION_NOT_SUPPORTED', $moduleName));
				$response->emit();
				return;
			}

			$batchLimit = $this->resolveBatchLimit($request);
			$result = $this->updateAssignmentInFastPath($recordIds, (int) $markValue, $columnName, $batchLimit);

			$successMessageKey = ((int) $markValue === 1)
				? 'LBL_MARK_ASSIGNMENT_MARKED_SUCCESS'
				: 'LBL_MARK_ASSIGNMENT_UNMARKED_SUCCESS';

			$response->setResult(array(
				'success' => true,
				'updated' => (int) $result['updated'],
				'skipped' => (int) $result['skipped'],
				'failed' => (int) $result['failed'],
				'message' => vtranslate($successMessageKey, $moduleName),
			));
		} catch (Exception $e) {
			$response->setError($e->getMessage());
		}

		$response->emit();
	}

	protected function resolveMarkValue($assignmentMode) {
		$assignmentMode = strtolower(trim((string) $assignmentMode));
		if (in_array($assignmentMode, array('mark', '1', 'true'), true)) {
			return 1;
		}
		if (in_array($assignmentMode, array('unmark', '0', 'false'), true)) {
			return 0;
		}
		return null;
	}

	protected function resolveAssignmentColumnName() {
		$db = PearDatabase::getInstance();
		$query = 'SELECT columnname FROM vtiger_field '
			. 'WHERE tabid = ? AND tablename = ? AND uitype = 56 '
			. 'AND (fieldname = ? OR LOWER(HEX(fieldlabel)) = ?) '
			. 'ORDER BY CASE WHEN fieldname = ? THEN 0 ELSE 1 END, fieldid DESC LIMIT 1';
		$result = $db->pquery($query, array(
			getTabid('Contacts'),
			self::ASSIGNMENT_TABLE_NAME,
			self::ASSIGNMENT_FIELD_NAME,
			self::ASSIGNMENT_FIELD_LABEL_HEX,
			self::ASSIGNMENT_FIELD_NAME,
		));
		if ($result && $db->num_rows($result) > 0) {
			$columnName = (string) $db->query_result($result, 0, 'columnname');
			if ($this->isValidAssignmentColumnName($columnName)) {
				return $columnName;
			}
		}

		$tableColumns = $db->getColumnNames(self::ASSIGNMENT_TABLE_NAME);
		if (in_array(self::ASSIGNMENT_FIELD_NAME, $tableColumns, true) && $this->isValidAssignmentColumnName(self::ASSIGNMENT_FIELD_NAME)) {
			return self::ASSIGNMENT_FIELD_NAME;
		}

		return null;
	}

	protected function isValidAssignmentColumnName($columnName) {
		return (bool) preg_match('/^cf_[0-9]+$/', (string) $columnName);
	}

	protected function resolveBatchLimit(Vtiger_Request $request) {
		$batchLimit = (int) $request->get('batch_limit');
		if ($batchLimit <= 0) {
			return self::DEFAULT_BATCH_LIMIT;
		}
		return min($batchLimit, self::MAX_BATCH_LIMIT);
	}

	protected function updateAssignmentInFastPath(array $recordIds, $markValue, $columnName, $batchLimit) {
		$result = array(
			'updated' => 0,
			'skipped' => 0,
			'failed' => 0,
		);
		$eligibleRecordIds = array();

		foreach ($recordIds as $recordId) {
			$recordId = (int) $recordId;
			if (!Users_Privileges_Model::isPermitted('Contacts', 'Save', $recordId)) {
				$result['skipped']++;
				continue;
			}
			$eligibleRecordIds[] = $recordId;
		}

		if (empty($eligibleRecordIds)) {
			return $result;
		}

		$db = PearDatabase::getInstance();
		try {
			$db->startTransaction();
			$this->updateAssignmentByChunks($db, $eligibleRecordIds, $markValue, $columnName, $batchLimit);
			$hasFailedTransaction = $db->hasFailedTransaction();
			$db->completeTransaction();

			if ($hasFailedTransaction) {
				throw new Exception(vtranslate('JS_MASS_EDIT_PROGRESS_RECORD_FAILED', 'Vtiger') . ': DB transaction failed');
			}

			$result['updated'] = php7_count($eligibleRecordIds);
		} catch (Exception $e) {
			$result['failed'] += php7_count($eligibleRecordIds);
		}

		return $result;
	}

	protected function updateAssignmentByChunks($db, array $recordIds, $markValue, $columnName, $batchLimit) {
		$recordIdChunks = array_chunk($recordIds, $batchLimit);
		$modifiedBy = $this->getCurrentUserIdForMassUpdate();
		$modifiedTime = date('Y-m-d H:i:s');

		foreach ($recordIdChunks as $recordIdChunk) {
			$recordIdChunk = array_values(array_unique(array_map('intval', $recordIdChunk)));
			if (empty($recordIdChunk)) {
				continue;
			}

			$placeholders = generateQuestionMarks($recordIdChunk);
			$updateCustomSql = 'UPDATE ' . self::ASSIGNMENT_TABLE_NAME . ' SET ' . $columnName . '=? WHERE contactid IN (' . $placeholders . ')';
			$updateCustomParams = array_merge(array($markValue), $recordIdChunk);
			$db->pquery($updateCustomSql, $updateCustomParams);

			$updateAuditSql = 'UPDATE vtiger_crmentity SET modifiedtime=?, modifiedby=? WHERE crmid IN (' . $placeholders . ')';
			$updateAuditParams = array_merge(array($modifiedTime, $modifiedBy), $recordIdChunk);
			$db->pquery($updateAuditSql, $updateAuditParams);
		}
	}

	protected function getCurrentUserIdForMassUpdate() {
		$currentUser = vglobal('current_user');
		if (is_object($currentUser) && isset($currentUser->id) && (int) $currentUser->id > 0) {
			return (int) $currentUser->id;
		}
		return 1;
	}
}
