<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Contacts_TransferOwnership_Action extends Accounts_TransferOwnership_Action {
	const PROGRESS_JOBS_SESSION_KEY = 'CONTACTS_TRANSFER_OWNERSHIP_PROGRESS_JOBS';
	const DEFAULT_PROGRESS_BATCH_LIMIT = 300;
	const MAX_PROGRESS_BATCH_LIMIT = 2000;
	const OWNER_ONLY_DEFAULT_BATCH_LIMIT = 1000;
	const OWNER_ONLY_MAX_BATCH_LIMIT = 2000;
	const PRIMARY_OWNER_FIELD_NAME = 'assigned_user_id';
	const SECONDARY_OWNER_FIELD_NAME = 'assigned_to_2';
	const SECONDARY_OWNER_COLUMN_NAME = 'cf_2134';

	public function checkPermission(Vtiger_Request $request) {
		$mode = $request->getMode();
		if ($mode === 'startTransferProgress') {
			Vtiger_Action_Controller::checkPermission($request);
			if (!Users_Privileges_Model::isPermitted($request->getModule(), 'EditView')) {
				throw new AppException(vtranslate('LBL_PERMISSION_DENIED'));
			}

			$recordIds = $this->getRecordIds($request);
			if (empty($recordIds)) {
				throw new AppException(vtranslate('LBL_NO_RECORD_SELECTED', $request->getModule()));
			}

			return true;
		}

		if (in_array($mode, array('processTransferProgress', 'cancelTransferProgress'))) {
			Vtiger_Action_Controller::checkPermission($request);
			if (!Users_Privileges_Model::isPermitted($request->getModule(), 'EditView')) {
				throw new AppException(vtranslate('LBL_PERMISSION_DENIED'));
			}
			return true;
		}

		return parent::checkPermission($request);
	}

	public function process(Vtiger_Request $request) {
		$mode = $request->getMode();
		if ($mode === 'startTransferProgress') {
			$this->startTransferProgress($request);
			return;
		}
		if ($mode === 'processTransferProgress') {
			$this->processTransferProgress($request);
			return;
		}
		if ($mode === 'cancelTransferProgress') {
			$this->cancelTransferProgress($request);
			return;
		}

		parent::process($request);
	}

	protected function startTransferProgress(Vtiger_Request $request) {
		$response = new Vtiger_Response();
		try {
			$moduleName = $request->getModule();
			$transferOwnerId = (int) $request->get('transferOwnerId');
			$transferFieldName = $this->resolveTransferFieldName($request->get('transferField'));
			if ($transferOwnerId <= 0) {
				$response->setError(vtranslate('LBL_INVALID_DATA'));
				$response->emit();
				return;
			}

			$recordIds = !empty($this->transferRecordIds) ? $this->transferRecordIds : $this->getRecordIds($request);
			$recordIds = array_values(array_unique(array_map('intval', $recordIds)));
			if (empty($recordIds)) {
				$response->setError(vtranslate('LBL_NO_RECORD_SELECTED', $moduleName));
				$response->emit();
				return;
			}

			$relatedModules = $request->get('related_modules');
			$hasRelatedModules = !empty($relatedModules) && is_array($relatedModules);
			if ($transferFieldName !== self::PRIMARY_OWNER_FIELD_NAME) {
				$hasRelatedModules = false;
			}
			$batchLimit = $this->resolveProgressBatchLimit($request, $hasRelatedModules);

			$jobId = uniqid('transfer_owner_', true);
			$jobData = array(
				'module' => $moduleName,
				'transfer_owner_id' => $transferOwnerId,
				'transfer_field' => $transferFieldName,
				'record_ids' => $recordIds,
				'total' => php7_count($recordIds),
				'processed' => 0,
				'successful' => 0,
				'failed' => 0,
				'completed' => false,
				'cancelled' => false,
				'batch_limit' => $batchLimit,
				'has_related_modules' => $hasRelatedModules,
				'updated_at' => time(),
				'errors' => array(),
			);

			$jobs = $this->getTransferProgressJobs();
			$jobs[$jobId] = $jobData;
			$this->setTransferProgressJobs($jobs);

			$response->setResult($this->buildTransferProgressPayload($jobId, $jobData, vtranslate('JS_MASS_EDIT_PROGRESS_STARTED', 'Vtiger')));
		} catch (Exception $e) {
			$response->setError($e->getMessage());
		}

		$response->emit();
	}

	protected function processTransferProgress(Vtiger_Request $request) {
		$response = new Vtiger_Response();
		$jobId = $request->get('job_id');
		$jobs = $this->getTransferProgressJobs();

		if (empty($jobId) || empty($jobs[$jobId])) {
			$response->setError(vtranslate('JS_MASS_EDIT_PROGRESS_JOB_NOT_FOUND', 'Vtiger'));
			$response->emit();
			return;
		}

		$jobData = $jobs[$jobId];
		if (!empty($jobData['completed'])) {
			$response->setResult($this->buildTransferProgressPayload($jobId, $jobData));
			$response->emit();
			return;
		}

		$offset = (int) $jobData['processed'];
		$batchLimit = (int) $jobData['batch_limit'];
		$recordBatch = array_slice($jobData['record_ids'], $offset, $batchLimit);

		try {
			if ($this->canUseOwnerOnlyFastPath($jobData)) {
				$this->processOwnerOnlyFastBatch($recordBatch, $jobData);
			} elseif ($this->canUseSecondaryOwnerFastPath($jobData)) {
				$this->processSecondaryOwnerFastBatch($recordBatch, $jobData);
			} else {
				$this->processStandardTransferBatch($recordBatch, $jobData);
			}

			$jobData['processed'] += php7_count($recordBatch);
			$jobData['updated_at'] = time();

			if ((int) $jobData['processed'] >= (int) $jobData['total']) {
				$jobData['completed'] = true;
				$payload = $this->buildTransferProgressPayload($jobId, $jobData, vtranslate('JS_MASS_EDIT_PROGRESS_COMPLETED', 'Vtiger'));
			} else {
				$payload = $this->buildTransferProgressPayload($jobId, $jobData);
			}

			$jobs[$jobId] = $jobData;
			$this->setTransferProgressJobs($jobs);
			$response->setResult($payload);
		} catch (Exception $e) {
			$response->setError($e->getMessage());
		}

		$response->emit();
	}

	protected function cancelTransferProgress(Vtiger_Request $request) {
		$response = new Vtiger_Response();
		$jobId = $request->get('job_id');
		$jobs = $this->getTransferProgressJobs();

		if (empty($jobId) || empty($jobs[$jobId])) {
			$response->setError(vtranslate('JS_MASS_EDIT_PROGRESS_JOB_NOT_FOUND', 'Vtiger'));
			$response->emit();
			return;
		}

		$jobData = $jobs[$jobId];
		$jobData['completed'] = true;
		$jobData['cancelled'] = true;
		$jobData['updated_at'] = time();
		$jobs[$jobId] = $jobData;
		$this->setTransferProgressJobs($jobs);

		$response->setResult($this->buildTransferProgressPayload($jobId, $jobData, vtranslate('JS_MASS_EDIT_PROGRESS_CANCELLED', 'Vtiger')));
		$response->emit();
	}

	protected function resolveProgressBatchLimit(Vtiger_Request $request, $hasRelatedModules) {
		$batchLimit = (int) $request->get('batch_limit');
		if ($batchLimit <= 0) {
			return $hasRelatedModules ? self::DEFAULT_PROGRESS_BATCH_LIMIT : self::OWNER_ONLY_DEFAULT_BATCH_LIMIT;
		}

		$maxBatchLimit = $hasRelatedModules ? self::MAX_PROGRESS_BATCH_LIMIT : self::OWNER_ONLY_MAX_BATCH_LIMIT;
		return min($batchLimit, $maxBatchLimit);
	}

	protected function canUseOwnerOnlyFastPath(array $jobData) {
		return empty($jobData['has_related_modules'])
			&& strcasecmp((string) $jobData['module'], 'Contacts') === 0
			&& $this->getTransferFieldNameFromJobData($jobData) === self::PRIMARY_OWNER_FIELD_NAME
			&& (int) $jobData['transfer_owner_id'] > 0;
	}

	protected function canUseSecondaryOwnerFastPath(array $jobData) {
		return empty($jobData['has_related_modules'])
			&& strcasecmp((string) $jobData['module'], 'Contacts') === 0
			&& $this->getTransferFieldNameFromJobData($jobData) === self::SECONDARY_OWNER_FIELD_NAME
			&& (int) $jobData['transfer_owner_id'] > 0;
	}

	protected function processStandardTransferBatch(array $recordBatch, array &$jobData) {
		if (empty($recordBatch)) {
			return;
		}

		$_REQUEST['ajxaction'] = 'DETAILVIEW';
		$newOwnerId = (int) $jobData['transfer_owner_id'];
		$transferFieldName = $this->getTransferFieldNameFromJobData($jobData);
		foreach ($recordBatch as $recordId) {
			$recordId = (int) $recordId;
			$recordModule = getSalesEntityType($recordId);
			if ($transferFieldName === self::SECONDARY_OWNER_FIELD_NAME && strcasecmp((string) $recordModule, 'Contacts') !== 0) {
				$jobData['failed']++;
				$jobData['errors'][] = vtranslate('JS_MASS_EDIT_PROGRESS_SAVE_SKIPPED', 'Vtiger') . ' #' . $recordId;
				continue;
			}
			if (empty($recordModule) || !Users_Privileges_Model::isPermitted($recordModule, 'Save', $recordId)) {
				$jobData['failed']++;
				$jobData['errors'][] = vtranslate('JS_MASS_EDIT_PROGRESS_SAVE_SKIPPED', 'Vtiger') . ' #' . $recordId;
				continue;
			}

			try {
				$recordModel = Vtiger_Record_Model::getInstanceById($recordId, $recordModule);
				$recordModel->set($transferFieldName, $newOwnerId);
				$recordModel->set('mode', 'edit');
				$recordModel->save();
				$jobData['successful']++;
			} catch (Exception $e) {
				$jobData['failed']++;
				$jobData['errors'][] = vtranslate('JS_MASS_EDIT_PROGRESS_RECORD_FAILED', 'Vtiger') . ' #' . $recordId . ': ' . $e->getMessage();
			}
		}
	}

	protected function processOwnerOnlyFastBatch(array $recordBatch, array &$jobData) {
		if (empty($recordBatch)) {
			return;
		}

		$newOwnerId = (int) $jobData['transfer_owner_id'];
		$ownerMap = $this->getOwnerMapForRecords($recordBatch);
		$eligibleRecordIds = array();
		$updateRecordIds = array();

		foreach ($recordBatch as $recordId) {
			$recordId = (int) $recordId;
			if (!isset($ownerMap[$recordId])) {
				$jobData['failed']++;
				$jobData['errors'][] = vtranslate('JS_MASS_EDIT_PROGRESS_RECORD_FAILED', 'Vtiger') . ' #' . $recordId . ': missing entity row';
				continue;
			}

			if (!Users_Privileges_Model::isPermitted('Contacts', 'Save', $recordId)) {
				$jobData['failed']++;
				$jobData['errors'][] = vtranslate('JS_MASS_EDIT_PROGRESS_SAVE_SKIPPED', 'Vtiger') . ' #' . $recordId;
				continue;
			}

			$eligibleRecordIds[] = $recordId;
			if ((int) $ownerMap[$recordId] !== $newOwnerId) {
				$updateRecordIds[] = $recordId;
			}
		}

		if (!empty($updateRecordIds)) {
			$db = PearDatabase::getInstance();
			try {
				$db->startTransaction();
				$this->updateRecordOwnerByChunks($db, $updateRecordIds, $newOwnerId);
				$hasFailedTransaction = $db->hasFailedTransaction();
				$db->completeTransaction();

				if ($hasFailedTransaction) {
					throw new Exception(vtranslate('JS_MASS_EDIT_PROGRESS_RECORD_FAILED', 'Vtiger') . ': DB transaction failed');
				}
			} catch (Exception $e) {
				$jobData['failed'] += php7_count($eligibleRecordIds);
				$jobData['errors'][] = $e->getMessage();
				return;
			}
		}

		$jobData['successful'] += php7_count($eligibleRecordIds);
	}

	protected function processSecondaryOwnerFastBatch(array $recordBatch, array &$jobData) {
		if (empty($recordBatch)) {
			return;
		}

		$newOwnerId = (int) $jobData['transfer_owner_id'];
		$ownerMap = $this->getSecondaryOwnerMapForRecords($recordBatch);
		$eligibleRecordIds = array();
		$updateRecordIds = array();

		foreach ($recordBatch as $recordId) {
			$recordId = (int) $recordId;
			if (!isset($ownerMap[$recordId])) {
				$jobData['failed']++;
				$jobData['errors'][] = vtranslate('JS_MASS_EDIT_PROGRESS_RECORD_FAILED', 'Vtiger') . ' #' . $recordId . ': missing contact custom field row';
				continue;
			}

			if (!Users_Privileges_Model::isPermitted('Contacts', 'Save', $recordId)) {
				$jobData['failed']++;
				$jobData['errors'][] = vtranslate('JS_MASS_EDIT_PROGRESS_SAVE_SKIPPED', 'Vtiger') . ' #' . $recordId;
				continue;
			}

			$eligibleRecordIds[] = $recordId;
			if ((int) $ownerMap[$recordId] !== $newOwnerId) {
				$updateRecordIds[] = $recordId;
			}
		}

		if (!empty($updateRecordIds)) {
			$db = PearDatabase::getInstance();
			try {
				$db->startTransaction();
				$this->updateSecondaryOwnerByChunks($db, $updateRecordIds, $newOwnerId);
				$hasFailedTransaction = $db->hasFailedTransaction();
				$db->completeTransaction();

				if ($hasFailedTransaction) {
					throw new Exception(vtranslate('JS_MASS_EDIT_PROGRESS_RECORD_FAILED', 'Vtiger') . ': DB transaction failed');
				}
			} catch (Exception $e) {
				$jobData['failed'] += php7_count($eligibleRecordIds);
				$jobData['errors'][] = $e->getMessage();
				return;
			}
		}

		$jobData['successful'] += php7_count($eligibleRecordIds);
	}

	protected function getOwnerMapForRecords(array $recordIds) {
		$recordIds = array_values(array_unique(array_map('intval', $recordIds)));
		if (empty($recordIds)) {
			return array();
		}

		$db = PearDatabase::getInstance();
		$query = 'SELECT crmid, smownerid FROM vtiger_crmentity WHERE crmid IN (' . generateQuestionMarks($recordIds) . ')';
		$result = $db->pquery($query, $recordIds);

		$ownerMap = array();
		for ($i = 0; $i < $db->num_rows($result); $i++) {
			$recordId = (int) $db->query_result($result, $i, 'crmid');
			$ownerMap[$recordId] = (int) $db->query_result($result, $i, 'smownerid');
		}

		return $ownerMap;
	}

	protected function getSecondaryOwnerMapForRecords(array $recordIds) {
		$recordIds = array_values(array_unique(array_map('intval', $recordIds)));
		if (empty($recordIds)) {
			return array();
		}

		$db = PearDatabase::getInstance();
		$query = 'SELECT vtiger_contactdetails.contactid AS contactid, vtiger_contactscf.' . self::SECONDARY_OWNER_COLUMN_NAME . ' AS secondary_owner '
			. 'FROM vtiger_contactdetails '
			. 'LEFT JOIN vtiger_contactscf ON vtiger_contactdetails.contactid = vtiger_contactscf.contactid '
			. 'WHERE vtiger_contactdetails.contactid IN (' . generateQuestionMarks($recordIds) . ')';
		$result = $db->pquery($query, $recordIds);

		$ownerMap = array();
		for ($i = 0; $i < $db->num_rows($result); $i++) {
			$recordId = (int) $db->query_result($result, $i, 'contactid');
			$ownerMap[$recordId] = (int) $db->query_result($result, $i, 'secondary_owner');
		}

		return $ownerMap;
	}

	protected function updateRecordOwnerByChunks($db, array $recordIds, $newOwnerId) {
		$recordIdChunks = array_chunk($recordIds, self::OWNER_ONLY_DEFAULT_BATCH_LIMIT);
		$modifiedBy = $this->getCurrentUserIdForMassUpdate();
		$modifiedTime = date('Y-m-d H:i:s');

		foreach ($recordIdChunks as $recordIdChunk) {
			$recordIdChunk = array_values(array_unique(array_map('intval', $recordIdChunk)));
			if (empty($recordIdChunk)) {
				continue;
			}

			$placeholders = generateQuestionMarks($recordIdChunk);
			$updateSql = 'UPDATE vtiger_crmentity SET smownerid=?, modifiedtime=?, modifiedby=? WHERE crmid IN (' . $placeholders . ')';
			$params = array_merge(array($newOwnerId, $modifiedTime, $modifiedBy), $recordIdChunk);
			$db->pquery($updateSql, $params);
		}
	}

	protected function updateSecondaryOwnerByChunks($db, array $recordIds, $newOwnerId) {
		$recordIdChunks = array_chunk($recordIds, self::OWNER_ONLY_DEFAULT_BATCH_LIMIT);
		$modifiedBy = $this->getCurrentUserIdForMassUpdate();
		$modifiedTime = date('Y-m-d H:i:s');

		foreach ($recordIdChunks as $recordIdChunk) {
			$recordIdChunk = array_values(array_unique(array_map('intval', $recordIdChunk)));
			if (empty($recordIdChunk)) {
				continue;
			}

			$placeholders = generateQuestionMarks($recordIdChunk);
			$updateSecondaryOwnerSql = 'UPDATE vtiger_contactscf SET ' . self::SECONDARY_OWNER_COLUMN_NAME . '=? WHERE contactid IN (' . $placeholders . ')';
			$updateSecondaryOwnerParams = array_merge(array($newOwnerId), $recordIdChunk);
			$db->pquery($updateSecondaryOwnerSql, $updateSecondaryOwnerParams);

			$updateAuditSql = 'UPDATE vtiger_crmentity SET modifiedtime=?, modifiedby=? WHERE crmid IN (' . $placeholders . ')';
			$updateAuditParams = array_merge(array($modifiedTime, $modifiedBy), $recordIdChunk);
			$db->pquery($updateAuditSql, $updateAuditParams);
		}
	}

	public function getRecordIds(Vtiger_Request $request) {
		if ($this->resolveTransferFieldName($request->get('transferField')) === self::SECONDARY_OWNER_FIELD_NAME) {
			$record = $request->get('record');
			if (!empty($record)) {
				return array((int) $record);
			}

			return $this->getBaseModuleRecordIds($request);
		}

		return parent::getRecordIds($request);
	}

	protected function getCurrentUserIdForMassUpdate() {
		$currentUser = vglobal('current_user');
		if (is_object($currentUser) && isset($currentUser->id) && (int) $currentUser->id > 0) {
			return (int) $currentUser->id;
		}

		return 1;
	}

	protected function getTransferFieldNameFromJobData(array $jobData) {
		if (!empty($jobData['transfer_field'])) {
			return $this->resolveTransferFieldName($jobData['transfer_field']);
		}

		return self::PRIMARY_OWNER_FIELD_NAME;
	}

	protected function resolveTransferFieldName($transferField) {
		if ($transferField === self::SECONDARY_OWNER_FIELD_NAME) {
			return self::SECONDARY_OWNER_FIELD_NAME;
		}

		return self::PRIMARY_OWNER_FIELD_NAME;
	}

	protected function getTransferProgressJobs() {
		if (!isset($_SESSION[self::PROGRESS_JOBS_SESSION_KEY]) || !is_array($_SESSION[self::PROGRESS_JOBS_SESSION_KEY])) {
			$_SESSION[self::PROGRESS_JOBS_SESSION_KEY] = array();
		}

		return $_SESSION[self::PROGRESS_JOBS_SESSION_KEY];
	}

	protected function setTransferProgressJobs($jobs) {
		$_SESSION[self::PROGRESS_JOBS_SESSION_KEY] = $jobs;
	}

	protected function buildTransferProgressPayload($jobId, array $jobData, $message = '') {
		$total = (int) $jobData['total'];
		$processed = (int) $jobData['processed'];
		$percentage = ($total > 0) ? (int) floor(($processed / $total) * 100) : 100;
		if ($percentage > 100) {
			$percentage = 100;
		}

		$payload = array(
			'job_id' => $jobId,
			'total' => $total,
			'processed' => $processed,
			'successful' => (int) $jobData['successful'],
			'failed' => (int) $jobData['failed'],
			'percentage' => $percentage,
			'completed' => !empty($jobData['completed']),
			'cancelled' => !empty($jobData['cancelled']),
			'message' => $message,
		);

		if (!empty($jobData['errors'])) {
			$payload['last_error'] = $jobData['errors'][php7_count($jobData['errors']) - 1];
		}

		return $payload;
	}
}
