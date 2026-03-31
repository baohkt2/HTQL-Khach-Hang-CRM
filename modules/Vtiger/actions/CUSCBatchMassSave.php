<?php
/*+***********************************************************************************
 * CUSC performance override: mass edit batching with transaction-per-chunk.
 *************************************************************************************/

class Vtiger_CUSCBatchMassSave_Action extends Vtiger_MassSave_Action {
	const DEFAULT_BATCH_SIZE = 200;
	const MAX_BATCH_SIZE = 500;
	const DEFAULT_PROGRESS_BATCH_SIZE = 80;
	const MAX_PROGRESS_BATCH_SIZE = 200;
	const OWNER_FAST_PATH_DEFAULT_BATCH_SIZE = 800;
	const OWNER_FAST_PATH_MAX_BATCH_SIZE = 2000;
	const METRICS_LOG_FILE = 'logs/perf_masssave_chunks.log';

	public function process(Vtiger_Request $request) {
		$mode = $request->getMode();
		if (in_array($mode, array('startMassEditProgress', 'processMassEditProgress', 'cancelMassEditProgress'))) {
			parent::process($request);
			return;
		}

		$response = new Vtiger_Response();
		try {
			$moduleName = $request->getModule();
			$recordIds = $this->getRecordsListFromRequest($request);
			if (empty($recordIds) || !is_array($recordIds)) {
				$response->setError(vtranslate('LBL_NO_RECORD_SELECTED', $moduleName));
				$response->emit();
				return;
			}

			$recordIds = array_values(array_unique(array_map('intval', $recordIds)));
			$batchSize = $this->resolveBatchSize($request);
			$db = PearDatabase::getInstance();

			$allRecordSave = true;
			$metrics = array();
			$totalRecords = php7_count($recordIds);

			vglobal('VTIGER_TIMESTAMP_NO_CHANGE_MODE', $request->get('_timeStampNoChangeMode', false));

			for ($offset = 0, $batchNo = 1; $offset < $totalRecords; $offset += $batchSize, $batchNo++) {
				$batchStart = microtime(true);
				$batchRecordIds = array_slice($recordIds, $offset, $batchSize);
				$batchSuccess = 0;
				$batchFailed = 0;

				$db->startTransaction();
				foreach ($batchRecordIds as $recordId) {
					try {
						$recordModel = $this->getUpdatedRecord($request, $recordId);
						$recordModel = $this->prepareRecordModelForMassSave($recordModel, $request);
						if ($this->saveMassEditedRecord($moduleName, $recordId, $recordModel)) {
							$batchSuccess++;
						} else {
							$batchFailed++;
							$allRecordSave = false;
						}
					} catch (Exception $recordException) {
						$batchFailed++;
						$allRecordSave = false;
					}
				}

				$hasFailedTransaction = $db->hasFailedTransaction();
				$db->completeTransaction();
				if ($hasFailedTransaction) {
					$batchFailed += $batchSuccess;
					$batchSuccess = 0;
					$allRecordSave = false;
				}

				$elapsed = microtime(true) - $batchStart;
				$metrics[] = sprintf(
					'module=%s batch=%d offset=%d size=%d success=%d failed=%d elapsed=%.6f',
					$moduleName,
					$batchNo,
					$offset,
					php7_count($batchRecordIds),
					$batchSuccess,
					$batchFailed,
					$elapsed
				);
			}

			$this->logBatchMetrics($metrics);
			$response->setResult($allRecordSave);
		} catch (DuplicateException $e) {
			$response->setError($e->getMessage(), $e->getDuplicationMessage(), $e->getMessage());
		} catch (Exception $e) {
			$response->setError($e->getMessage());
		}

		vglobal('VTIGER_TIMESTAMP_NO_CHANGE_MODE', false);
		$response->emit();
	}

	protected function startMassEditProgress(Vtiger_Request $request) {
		$moduleName = $request->getModule();
		$moduleModel = Vtiger_Module_Model::getInstance($moduleName);
		$fieldValues = is_object($moduleModel) ? $this->getMassEditFieldValuesFromRequest($request, $moduleModel) : array();
		$batchSize = $this->resolveProgressBatchSize($request, $moduleName, $fieldValues);
		$request->set('batch_limit', $batchSize);

		parent::startMassEditProgress($request);
	}

	protected function processMassEditProgress(Vtiger_Request $request) {
		$jobId = $request->get('job_id');
		$jobs = $this->getMassEditProgressJobs();

		if (empty($jobId) || empty($jobs[$jobId])) {
			parent::processMassEditProgress($request);
			return;
		}

		$jobData = $jobs[$jobId];
		$moduleName = $jobData['module'];
		$fieldValues = isset($jobData['field_values']) && is_array($jobData['field_values']) ? $jobData['field_values'] : array();
		if (!$this->canUseAssignedUserFastPath($moduleName, $fieldValues)) {
			parent::processMassEditProgress($request);
			return;
		}

		$response = new Vtiger_Response();
		if (!empty($jobData['completed'])) {
			$response->setResult($this->buildMassEditProgressPayload($jobId, $jobData));
			$response->emit();
			return;
		}

		$offset = (int) $jobData['processed'];
		$batchLimit = (int) $jobData['batch_limit'];
		if ($batchLimit <= 0) {
			$batchLimit = self::OWNER_FAST_PATH_DEFAULT_BATCH_SIZE;
		}
		$batchLimit = min($batchLimit, self::OWNER_FAST_PATH_MAX_BATCH_SIZE);
		$recordBatch = array_slice($jobData['record_ids'], $offset, $batchLimit);

		$batchStartedAt = microtime(true);
		$successfulBefore = (int) $jobData['successful'];
		$failedBefore = (int) $jobData['failed'];

		try {
			vglobal('VTIGER_TIMESTAMP_NO_CHANGE_MODE', $jobData['timestamp_no_change_mode']);
			$this->processAssignedUserFastBatch($moduleName, $recordBatch, $jobData);
			$jobData['processed'] += php7_count($recordBatch);
			$jobData['updated_at'] = time();

			if ((int) $jobData['processed'] >= (int) $jobData['total']) {
				$jobData['completed'] = true;
				$this->cleanupUndoFile($jobData);
				$payload = $this->buildMassEditProgressPayload($jobId, $jobData, vtranslate('JS_MASS_EDIT_PROGRESS_COMPLETED', 'Vtiger'));
			} else {
				$payload = $this->buildMassEditProgressPayload($jobId, $jobData);
			}

			$jobs[$jobId] = $jobData;
			$this->setMassEditProgressJobs($jobs);
			$response->setResult($payload);
		} catch (Exception $e) {
			$response->setError($e->getMessage());
		}

		vglobal('VTIGER_TIMESTAMP_NO_CHANGE_MODE', false);
		$this->logBatchMetrics(array(sprintf(
			'module=%s mode=progress-fast-owner job=%s offset=%d size=%d success=%d failed=%d elapsed=%.6f',
			$moduleName,
			$jobId,
			$offset,
			php7_count($recordBatch),
			max(0, (int) $jobData['successful'] - $successfulBefore),
			max(0, (int) $jobData['failed'] - $failedBefore),
			microtime(true) - $batchStartedAt
		)));
		$response->emit();
	}

	protected function resolveProgressBatchSize(Vtiger_Request $request, $moduleName, array $fieldValues) {
		$requestedBatchSize = (int) $request->get('batch_limit');
		$isFastPath = $this->canUseAssignedUserFastPath($moduleName, $fieldValues);

		if ($requestedBatchSize <= 0) {
			return $isFastPath ? self::OWNER_FAST_PATH_DEFAULT_BATCH_SIZE : self::DEFAULT_PROGRESS_BATCH_SIZE;
		}

		$maxBatchSize = $isFastPath ? self::OWNER_FAST_PATH_MAX_BATCH_SIZE : self::MAX_PROGRESS_BATCH_SIZE;
		return min($requestedBatchSize, $maxBatchSize);
	}

	protected function canUseAssignedUserFastPath($moduleName, array $fieldValues) {
		if (strcasecmp((string) $moduleName, 'Contacts') !== 0) {
			return false;
		}

		if (php7_count($fieldValues) !== 1 || !array_key_exists('assigned_user_id', $fieldValues)) {
			return false;
		}

		$newOwnerId = (int) $fieldValues['assigned_user_id'];
		return $newOwnerId > 0;
	}

	protected function processAssignedUserFastBatch($moduleName, array $recordBatch, array &$jobData) {
		if (empty($recordBatch)) {
			return;
		}

		$recordBatch = array_values(array_unique(array_map('intval', $recordBatch)));
		$newOwnerId = (int) $jobData['field_values']['assigned_user_id'];
		$db = PearDatabase::getInstance();
		$oldOwnerMap = $this->getOwnerMapForRecords($recordBatch);

		$eligibleRecordIds = array();
		$updateRecordIds = array();
		foreach ($recordBatch as $recordId) {
			if (!isset($oldOwnerMap[$recordId])) {
				$jobData['failed']++;
				$jobData['errors'][] = vtranslate('JS_MASS_EDIT_PROGRESS_RECORD_FAILED', 'Vtiger') . ' #' . $recordId . ': missing entity row';
				continue;
			}

			if (!Users_Privileges_Model::isPermitted($moduleName, 'Save', $recordId)) {
				$jobData['failed']++;
				$jobData['errors'][] = vtranslate('JS_MASS_EDIT_PROGRESS_SAVE_SKIPPED', 'Vtiger') . ' #' . $recordId;
				continue;
			}

			$previousOwnerId = (int) $oldOwnerMap[$recordId];
			$this->appendUndoSnapshot($jobData['undo_file'], $recordId, array('assigned_user_id' => $previousOwnerId));
			$eligibleRecordIds[] = $recordId;
			if ($previousOwnerId !== $newOwnerId) {
				$updateRecordIds[] = $recordId;
			}
		}

		if (!empty($updateRecordIds)) {
			try {
				$db->startTransaction();
				$this->updateRecordOwnerByChunks($db, $updateRecordIds, $newOwnerId, !empty($jobData['timestamp_no_change_mode']));
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

	protected function updateRecordOwnerByChunks($db, array $recordIds, $newOwnerId, $skipTimestampUpdate) {
		$recordIdChunks = array_chunk($recordIds, self::OWNER_FAST_PATH_DEFAULT_BATCH_SIZE);
		$modifiedBy = $this->getCurrentUserIdForMassUpdate();
		$modifiedTime = date('Y-m-d H:i:s');

		foreach ($recordIdChunks as $recordIdChunk) {
			$recordIdChunk = array_values(array_unique(array_map('intval', $recordIdChunk)));
			if (empty($recordIdChunk)) {
				continue;
			}

			$placeholders = generateQuestionMarks($recordIdChunk);
			if ($skipTimestampUpdate) {
				$updateSql = 'UPDATE vtiger_crmentity SET smownerid=? WHERE crmid IN (' . $placeholders . ')';
				$params = array_merge(array($newOwnerId), $recordIdChunk);
			} else {
				$updateSql = 'UPDATE vtiger_crmentity SET smownerid=?, modifiedtime=?, modifiedby=? WHERE crmid IN (' . $placeholders . ')';
				$params = array_merge(array($newOwnerId, $modifiedTime, $modifiedBy), $recordIdChunk);
			}

			$db->pquery($updateSql, $params);
		}
	}

	protected function getCurrentUserIdForMassUpdate() {
		$currentUser = vglobal('current_user');
		if (is_object($currentUser) && isset($currentUser->id) && (int) $currentUser->id > 0) {
			return (int) $currentUser->id;
		}

		return 1;
	}

	protected function resolveBatchSize(Vtiger_Request $request) {
		$batchSize = (int) $request->get('batch_limit');
		if ($batchSize <= 0) {
			$batchSize = self::DEFAULT_BATCH_SIZE;
		}
		return min($batchSize, self::MAX_BATCH_SIZE);
	}

	protected function logBatchMetrics(array $metrics) {
		if (empty($metrics)) {
			return;
		}

		$timestamp = date('Y-m-d H:i:s');
		$lines = array();
		foreach ($metrics as $metric) {
			$lines[] = '[' . $timestamp . '] ' . $metric;
		}
		$payload = implode(PHP_EOL, $lines) . PHP_EOL;
		@file_put_contents(self::METRICS_LOG_FILE, $payload, FILE_APPEND | LOCK_EX);
	}
}
