<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Vtiger_MassSave_Action extends Vtiger_Mass_Action {

	const PROGRESS_JOBS_SESSION_KEY = 'VTIGER_MASS_EDIT_PROGRESS_JOBS';
	const PROGRESS_JOBS_BASE_DIR = 'storage/mass_edit_jobs';
	const DEFAULT_BATCH_LIMIT = 100;
	const MAX_BATCH_LIMIT = 200;

	public function requiresPermission(\Vtiger_Request $request) {
		$permissions = parent::requiresPermission($request);
		$permissions[] = array('module_parameter' => 'module', 'action' => 'EditView');
		return $permissions;
	}
	
	public function process(Vtiger_Request $request) {
		$mode = $request->getMode();
		if (in_array($mode, array('startMassEditProgress', 'processMassEditProgress', 'cancelMassEditProgress'))) {
			$this->closeSessionLockIfNeeded();
		}
		if ($mode === 'startMassEditProgress') {
			$this->startMassEditProgress($request);
			return;
		}
		if ($mode === 'processMassEditProgress') {
			$this->processMassEditProgress($request);
			return;
		}
		if ($mode === 'cancelMassEditProgress') {
			$this->cancelMassEditProgress($request);
			return;
		}

		$response = new Vtiger_Response();
		try {
			vglobal('VTIGER_TIMESTAMP_NO_CHANGE_MODE', $request->get('_timeStampNoChangeMode',false));
			$moduleName = $request->getModule();
			$recordModels = $this->getRecordModelsFromRequest($request);
			$allRecordSave= true;
			foreach($recordModels as $recordId => $recordModel) {
				if(!$this->saveMassEditedRecord($moduleName, $recordId, $recordModel)) {
					$allRecordSave= false;
				}
			}
			vglobal('VTIGER_TIMESTAMP_NO_CHANGE_MODE', false);
			if($allRecordSave) {
				$response->setResult(true);
			} else {
			   $response->setResult(false);
			}
		} catch (DuplicateException $e) {
			$response->setError($e->getMessage(), $e->getDuplicationMessage(), $e->getMessage());
		} catch (Exception $e) {
			$response->setError($e->getMessage());
		}
		$response->emit();
	}

	/**
	 * Function to get the updated record models
	 * @param Vtiger_Request $request
	 * @return array of Vtiger_Record_Model
	 */
	protected function getRecordModelsFromRequest(Vtiger_Request $request) {
		$recordIds = $this->getRecordsListFromRequest($request);
		$recordModels = array();
		if (empty($recordIds) || !is_array($recordIds)) {
			return $recordModels;
		}

		foreach($recordIds as $recordId) {
			$recordModel = $this->getUpdatedRecord($request, $recordId);
			$recordModels[$recordId] = $this->prepareRecordModelForMassSave($recordModel, $request);
		}
		
		return $recordModels;
	}
	
	protected function getUpdatedRecord(Vtiger_Request $request, $recordId) {
		$recordModel = Vtiger_Record_Model::getInstanceById($recordId);
		$recordModel->set('mode', 'edit');
		$fieldModelList = $recordModel->getModule()->getFields();
		if (!is_array($fieldModelList)) {
			return $recordModel;
		}
		
		foreach ($fieldModelList as $fieldName => $fieldModel) {
			if ($request->has($fieldName)) {
				$fieldValue = $request->get($fieldName, null);
				$fieldDataType = $fieldModel->getFieldDataType();
				if($fieldDataType == 'time'){
					$fieldValue = Vtiger_Time_UIType::getTimeValueWithSeconds($fieldValue);
				}
				
				if (!is_array($fieldValue)) {
					$fieldValue = trim($fieldValue);
				}
				$recordModel->set($fieldName, $fieldValue);
			}
		}
		return $recordModel;
	}

	protected function prepareRecordModelForMassSave(Vtiger_Record_Model $recordModel, Vtiger_Request $request = null) {
		return $recordModel;
	}

	protected function saveMassEditedRecord($moduleName, $recordId, Vtiger_Record_Model $recordModel) {
		if (!Users_Privileges_Model::isPermitted($moduleName, 'Save', $recordId)) {
			return false;
		}

		$recordModel->save();
		return true;
	}

	protected function startMassEditProgress(Vtiger_Request $request) {
		$response = new Vtiger_Response();
		try {
			$moduleName = $request->getModule();
			$moduleModel = Vtiger_Module_Model::getInstance($moduleName);
			$currentUser = Users_Record_Model::getCurrentUserModel();
			$recordIds = $this->getRecordsListFromRequest($request);

			if (empty($recordIds)) {
				$response->setError(vtranslate('LBL_NO_RECORD_SELECTED', $moduleName));
				$response->emit();
				return;
			}

			$recordIds = array_values(array_unique($recordIds));
			$fieldValues = $this->getMassEditFieldValuesFromRequest($request, $moduleModel);
			if (empty($fieldValues)) {
				$response->setError(vtranslate('NONE_OF_THE_FIELD_VALUES_ARE_CHANGED_IN_MASS_EDIT', $moduleName));
				$response->emit();
				return;
			}

			$batchLimit = (int) $request->get('batch_limit');
			if ($batchLimit <= 0) {
				$batchLimit = self::DEFAULT_BATCH_LIMIT;
			}
			$batchLimit = min($batchLimit, self::MAX_BATCH_LIMIT);

			$jobId = uniqid('mass_edit_', true);
			$jobData = array(
				'module' => $moduleName,
				'user_id' => (int) $currentUser->getId(),
				'record_ids' => $recordIds,
				'field_values' => $fieldValues,
				'total' => php7_count($recordIds),
				'processed' => 0,
				'successful' => 0,
				'failed' => 0,
				'completed' => false,
				'cancelled' => false,
				'cancel_requested' => false,
				'batch_limit' => $batchLimit,
				'timestamp_no_change_mode' => $request->get('_timeStampNoChangeMode', false),
				'undo_file' => $this->createUndoFilePath($jobId),
				'updated_at' => time(),
				'errors' => array(),
			);
			$this->saveMassEditProgressJob($jobId, $jobData);

			$response->setResult($this->buildMassEditProgressPayload($jobId, $jobData, vtranslate('JS_MASS_EDIT_PROGRESS_STARTED', 'Vtiger')));
		} catch (Exception $e) {
			$response->setError($e->getMessage());
		}

		$response->emit();
	}

	protected function processMassEditProgress(Vtiger_Request $request) {
		$response = new Vtiger_Response();
		$jobId = $this->sanitizeMassEditProgressJobId($request->get('job_id'));
		if (empty($jobId)) {
			$response->setError(vtranslate('JS_MASS_EDIT_PROGRESS_JOB_NOT_FOUND', 'Vtiger'));
			$response->emit();
			return;
		}

		$thisInstance = $this;
		$result = $this->withMassEditJobLock($jobId, function() use ($thisInstance, $jobId, $request) {
			$jobData = $thisInstance->loadMassEditProgressJobForCurrentUser($jobId);
			if (!$jobData) {
				return array('error' => vtranslate('JS_MASS_EDIT_PROGRESS_JOB_NOT_FOUND', 'Vtiger'));
			}

			if (!empty($jobData['completed'])) {
				return array('payload' => $thisInstance->buildMassEditProgressPayload($jobId, $jobData));
			}

			vglobal('VTIGER_TIMESTAMP_NO_CHANGE_MODE', $jobData['timestamp_no_change_mode']);
			try {
				$moduleName = $jobData['module'];
				$offset = (int) $jobData['processed'];
				$batchLimit = (int) $jobData['batch_limit'];
				$recordBatch = array_slice($jobData['record_ids'], $offset, $batchLimit);

				foreach ($recordBatch as $recordId) {
					try {
						$recordModel = Vtiger_Record_Model::getInstanceById($recordId, $moduleName);
						$originalValues = $thisInstance->collectOriginalFieldValues($recordModel, $jobData['field_values']);
						$recordModel = $thisInstance->applyMassEditFieldValuesToRecord($recordModel, $jobData['field_values']);
						$recordModel = $thisInstance->prepareRecordModelForMassSave($recordModel, $request);

						if ($thisInstance->saveMassEditedRecord($moduleName, $recordId, $recordModel)) {
							$thisInstance->appendUndoSnapshot($jobData['undo_file'], $recordId, $originalValues);
							$jobData['successful']++;
						} else {
							$jobData['failed']++;
							$jobData['errors'][] = vtranslate('JS_MASS_EDIT_PROGRESS_SAVE_SKIPPED', 'Vtiger') . ' #' . $recordId;
						}
					} catch (Exception $recordException) {
						$jobData['failed']++;
						$jobData['errors'][] = vtranslate('JS_MASS_EDIT_PROGRESS_RECORD_FAILED', 'Vtiger') . ' #' . $recordId . ': ' . $recordException->getMessage();
					}

					$jobData['processed']++;
				}

				$jobData['updated_at'] = time();
				if ((int) $jobData['processed'] >= (int) $jobData['total']) {
					$jobData['completed'] = true;
					$thisInstance->cleanupUndoFile($jobData);
					$payload = $thisInstance->buildMassEditProgressPayload($jobId, $jobData, vtranslate('JS_MASS_EDIT_PROGRESS_COMPLETED', 'Vtiger'));
				} else {
					$payload = $thisInstance->buildMassEditProgressPayload($jobId, $jobData);
				}

				$thisInstance->saveMassEditProgressJob($jobId, $jobData);
				return array('payload' => $payload);
			} catch (Exception $e) {
				return array('error' => $e->getMessage());
			} finally {
				vglobal('VTIGER_TIMESTAMP_NO_CHANGE_MODE', false);
			}
		});

		if (!empty($result['error'])) {
			$response->setError($result['error']);
		} else {
			$response->setResult($result['payload']);
		}
		$response->emit();
	}

	protected function cancelMassEditProgress(Vtiger_Request $request) {
		$response = new Vtiger_Response();
		$jobId = $this->sanitizeMassEditProgressJobId($request->get('job_id'));
		if (empty($jobId)) {
			$response->setError(vtranslate('JS_MASS_EDIT_PROGRESS_JOB_NOT_FOUND', 'Vtiger'));
			$response->emit();
			return;
		}

		$thisInstance = $this;
		$result = $this->withMassEditJobLock($jobId, function() use ($thisInstance, $jobId) {
			$jobData = $thisInstance->loadMassEditProgressJobForCurrentUser($jobId);
			if (!$jobData) {
				return array('error' => vtranslate('JS_MASS_EDIT_PROGRESS_JOB_NOT_FOUND', 'Vtiger'));
			}

			if (!empty($jobData['completed'])) {
				return array('payload' => $thisInstance->buildMassEditProgressPayload($jobId, $jobData));
			}

			vglobal('VTIGER_TIMESTAMP_NO_CHANGE_MODE', $jobData['timestamp_no_change_mode']);
			try {
				$rollbackStats = $thisInstance->rollbackMassEditProgressJob($jobData);
				$jobData['completed'] = true;
				$jobData['cancelled'] = true;
				$jobData['cancel_requested'] = true;
				$jobData['updated_at'] = time();
				$jobData['rollback_successful'] = $rollbackStats['successful'];
				$jobData['rollback_failed'] = $rollbackStats['failed'];

				if (!empty($rollbackStats['errors'])) {
					$jobData['errors'] = array_merge($jobData['errors'], $rollbackStats['errors']);
				}

				$thisInstance->cleanupUndoFile($jobData);
				$thisInstance->saveMassEditProgressJob($jobId, $jobData);
				return array('payload' => $thisInstance->buildMassEditProgressPayload($jobId, $jobData, vtranslate('JS_MASS_EDIT_PROGRESS_CANCELLED', 'Vtiger')));
			} catch (Exception $e) {
				return array('error' => $e->getMessage());
			} finally {
				vglobal('VTIGER_TIMESTAMP_NO_CHANGE_MODE', false);
			}
		});

		if (!empty($result['error'])) {
			$response->setError($result['error']);
		} else {
			$response->setResult($result['payload']);
		}
		$response->emit();
	}

	protected function getMassEditProgressJobs() {
		return array();
	}

	protected function setMassEditProgressJobs($jobs) {
		return;
	}

	protected function closeSessionLockIfNeeded() {
		if (function_exists('session_status') && session_status() === PHP_SESSION_ACTIVE) {
			session_write_close();
		}
	}

	protected function sanitizeMassEditProgressJobId($jobId) {
		return preg_replace('/[^A-Za-z0-9_\-\.]/', '', (string) $jobId);
	}

	protected function getMassEditProgressBaseDirectory() {
		$rootDirectory = rtrim((string) vglobal('root_directory'), '/');
		if ($rootDirectory === '') {
			$rootDirectory = rtrim(getcwd(), '/');
		}

		$baseDirectory = $rootDirectory . '/' . self::PROGRESS_JOBS_BASE_DIR;
		if (!is_dir($baseDirectory)) {
			@mkdir($baseDirectory, 0755, true);
		}

		return $baseDirectory;
	}

	protected function getMassEditProgressJobFilePath($jobId) {
		$safeJobId = $this->sanitizeMassEditProgressJobId($jobId);
		return $this->getMassEditProgressBaseDirectory() . '/' . $safeJobId . '.json';
	}

	protected function getMassEditProgressLockFilePath($jobId) {
		$safeJobId = $this->sanitizeMassEditProgressJobId($jobId);
		return $this->getMassEditProgressBaseDirectory() . '/' . $safeJobId . '.lock';
	}

	protected function saveMassEditProgressJob($jobId, array $jobData) {
		$jobFilePath = $this->getMassEditProgressJobFilePath($jobId);
		file_put_contents($jobFilePath, Zend_Json::encode($jobData));
	}

	protected function loadMassEditProgressJob($jobId) {
		$jobFilePath = $this->getMassEditProgressJobFilePath($jobId);
		if (!is_file($jobFilePath)) {
			return null;
		}

		$rawData = @file_get_contents($jobFilePath);
		if ($rawData === false || $rawData === '') {
			return null;
		}

		$jobData = Zend_Json::decode($rawData);
		if (!is_array($jobData)) {
			return null;
		}

		return $jobData;
	}

	protected function loadMassEditProgressJobForCurrentUser($jobId) {
		$jobData = $this->loadMassEditProgressJob($jobId);
		if (!$jobData) {
			return null;
		}

		$currentUser = Users_Record_Model::getCurrentUserModel();
		if ((int) $jobData['user_id'] !== (int) $currentUser->getId()) {
			return null;
		}

		return $jobData;
	}

	protected function withMassEditJobLock($jobId, $callback) {
		$lockFilePath = $this->getMassEditProgressLockFilePath($jobId);
		$lockHandle = @fopen($lockFilePath, 'c');
		if (!$lockHandle) {
			return call_user_func($callback);
		}

		$result = null;
		if (@flock($lockHandle, LOCK_EX)) {
			$result = call_user_func($callback);
			@flock($lockHandle, LOCK_UN);
		} else {
			$result = call_user_func($callback);
		}

		@fclose($lockHandle);
		return $result;
	}

	protected function getMassEditFieldValuesFromRequest(Vtiger_Request $request, $moduleModel) {
		if (!is_object($moduleModel) || !method_exists($moduleModel, 'getFields')) {
			return array();
		}

		$fieldValues = array();
		$fieldModelList = $moduleModel->getFields();
		if (!is_array($fieldModelList)) {
			return $fieldValues;
		}

		foreach ($fieldModelList as $fieldName => $fieldModel) {
			if (!$request->has($fieldName)) {
				continue;
			}

			$fieldValue = $request->get($fieldName, null);
			$fieldDataType = $fieldModel->getFieldDataType();
			if ($fieldDataType == 'time') {
				$fieldValue = Vtiger_Time_UIType::getTimeValueWithSeconds($fieldValue);
			}

			if (!is_array($fieldValue)) {
				$fieldValue = trim($fieldValue);
			}

			$fieldValues[$fieldName] = $fieldValue;
		}

		return $fieldValues;
	}

	protected function collectOriginalFieldValues($recordModel, $fieldValues) {
		$originalValues = array();
		foreach ($fieldValues as $fieldName => $fieldValue) {
			$originalValues[$fieldName] = $recordModel->get($fieldName);
		}

		return $originalValues;
	}

	protected function applyMassEditFieldValuesToRecord($recordModel, $fieldValues) {
		$recordModel->set('mode', 'edit');
		foreach ($fieldValues as $fieldName => $fieldValue) {
			$recordModel->set($fieldName, $fieldValue);
		}

		return $recordModel;
	}

	protected function createUndoFilePath($jobId) {
		$rootDirectory = vglobal('root_directory');
		$tmpDir = vglobal('tmp_dir');
		if (empty($tmpDir)) {
			$tmpDir = 'cache/';
		}
		if (substr($tmpDir, -1) !== '/' && substr($tmpDir, -1) !== '\\') {
			$tmpDir .= '/';
		}

		$baseDirectory = $rootDirectory . $tmpDir;
		if (!is_dir($baseDirectory)) {
			$baseDirectory = $rootDirectory . 'cache/';
		}

		$tempFile = tempnam($baseDirectory, 'mse_');
		if ($tempFile === false) {
			throw new Exception(vtranslate('JS_MASS_EDIT_PROGRESS_FILE_ERROR', 'Vtiger'));
		}

		return $tempFile;
	}

	protected function appendUndoSnapshot($undoFilePath, $recordId, $fieldValues) {
		$handle = fopen($undoFilePath, 'a');
		if ($handle === false) {
			throw new Exception(vtranslate('JS_MASS_EDIT_PROGRESS_FILE_ERROR', 'Vtiger'));
		}

		fwrite($handle, json_encode(array('record_id' => $recordId, 'field_values' => $fieldValues)) . PHP_EOL);
		fclose($handle);
	}

	protected function rollbackMassEditProgressJob($jobData) {
		$successful = 0;
		$failed = 0;
		$errors = array();

		if (empty($jobData['undo_file']) || !is_file($jobData['undo_file'])) {
			return array('successful' => $successful, 'failed' => $failed, 'errors' => $errors);
		}

		$handle = fopen($jobData['undo_file'], 'r');
		if ($handle === false) {
			return array('successful' => $successful, 'failed' => $failed, 'errors' => $errors);
		}

		while (($line = fgets($handle)) !== false) {
			$line = trim($line);
			if (empty($line)) {
				continue;
			}

			$snapshot = json_decode($line, true);
			if (!is_array($snapshot) || empty($snapshot['record_id'])) {
				continue;
			}

			$recordId = $snapshot['record_id'];
			$fieldValues = isset($snapshot['field_values']) && is_array($snapshot['field_values']) ? $snapshot['field_values'] : array();
			try {
				$recordModel = Vtiger_Record_Model::getInstanceById($recordId, $jobData['module']);
				$recordModel->set('mode', 'edit');
				foreach ($fieldValues as $fieldName => $fieldValue) {
					$recordModel->set($fieldName, $fieldValue);
				}

				if ($this->saveMassEditedRecord($jobData['module'], $recordId, $recordModel)) {
					$successful++;
				} else {
					$failed++;
					$errors[] = vtranslate('JS_MASS_EDIT_PROGRESS_ROLLBACK_FAILED', 'Vtiger') . ' #' . $recordId;
				}
			} catch (Exception $rollbackException) {
				$failed++;
				$errors[] = vtranslate('JS_MASS_EDIT_PROGRESS_ROLLBACK_FAILED', 'Vtiger') . ' #' . $recordId . ': ' . $rollbackException->getMessage();
			}
		}

		fclose($handle);

		return array('successful' => $successful, 'failed' => $failed, 'errors' => $errors);
	}

	protected function cleanupUndoFile($jobData) {
		if (!empty($jobData['undo_file']) && is_file($jobData['undo_file'])) {
			@unlink($jobData['undo_file']);
		}
	}

	protected function buildMassEditProgressPayload($jobId, $jobData, $message = '') {
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

		if (!empty($jobData['rollback_successful']) || !empty($jobData['rollback_failed'])) {
			$payload['rollback_successful'] = isset($jobData['rollback_successful']) ? (int) $jobData['rollback_successful'] : 0;
			$payload['rollback_failed'] = isset($jobData['rollback_failed']) ? (int) $jobData['rollback_failed'] : 0;
		}

		if (!empty($jobData['errors'])) {
			$payload['last_error'] = $jobData['errors'][php7_count($jobData['errors']) - 1];
		}

		return $payload;
	}
}
