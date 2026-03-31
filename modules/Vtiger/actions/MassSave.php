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
	const DEFAULT_BATCH_LIMIT = 100;
	const MAX_BATCH_LIMIT = 200;

	public function requiresPermission(\Vtiger_Request $request) {
		$permissions = parent::requiresPermission($request);
		$permissions[] = array('module_parameter' => 'module', 'action' => 'EditView');
		return $permissions;
	}
	
	public function process(Vtiger_Request $request) {
		$mode = $request->getMode();
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
				'record_ids' => $recordIds,
				'field_values' => $fieldValues,
				'total' => php7_count($recordIds),
				'processed' => 0,
				'successful' => 0,
				'failed' => 0,
				'completed' => false,
				'cancelled' => false,
				'batch_limit' => $batchLimit,
				'timestamp_no_change_mode' => $request->get('_timeStampNoChangeMode', false),
				'undo_file' => $this->createUndoFilePath($jobId),
				'updated_at' => time(),
				'errors' => array(),
			);

			$jobs = $this->getMassEditProgressJobs();
			$jobs[$jobId] = $jobData;
			$this->setMassEditProgressJobs($jobs);

			$response->setResult($this->buildMassEditProgressPayload($jobId, $jobData, vtranslate('JS_MASS_EDIT_PROGRESS_STARTED', 'Vtiger')));
		} catch (Exception $e) {
			$response->setError($e->getMessage());
		}

		$response->emit();
	}

	protected function processMassEditProgress(Vtiger_Request $request) {
		$response = new Vtiger_Response();
		$jobId = $request->get('job_id');
		$jobs = $this->getMassEditProgressJobs();

		if (empty($jobId) || empty($jobs[$jobId])) {
			$response->setError(vtranslate('JS_MASS_EDIT_PROGRESS_JOB_NOT_FOUND', 'Vtiger'));
			$response->emit();
			return;
		}

		$jobData = $jobs[$jobId];
		if (!empty($jobData['completed'])) {
			$response->setResult($this->buildMassEditProgressPayload($jobId, $jobData));
			$response->emit();
			return;
		}

		try {
			vglobal('VTIGER_TIMESTAMP_NO_CHANGE_MODE', $jobData['timestamp_no_change_mode']);
			$moduleName = $jobData['module'];
			$offset = (int) $jobData['processed'];
			$batchLimit = (int) $jobData['batch_limit'];
			$recordBatch = array_slice($jobData['record_ids'], $offset, $batchLimit);

			foreach ($recordBatch as $recordId) {
				try {
					$recordModel = Vtiger_Record_Model::getInstanceById($recordId, $moduleName);
					$originalValues = $this->collectOriginalFieldValues($recordModel, $jobData['field_values']);
					$recordModel = $this->applyMassEditFieldValuesToRecord($recordModel, $jobData['field_values']);
					$recordModel = $this->prepareRecordModelForMassSave($recordModel, $request);

					if ($this->saveMassEditedRecord($moduleName, $recordId, $recordModel)) {
						$this->appendUndoSnapshot($jobData['undo_file'], $recordId, $originalValues);
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
		$response->emit();
	}

	protected function cancelMassEditProgress(Vtiger_Request $request) {
		$response = new Vtiger_Response();
		$jobId = $request->get('job_id');
		$jobs = $this->getMassEditProgressJobs();

		if (empty($jobId) || empty($jobs[$jobId])) {
			$response->setError(vtranslate('JS_MASS_EDIT_PROGRESS_JOB_NOT_FOUND', 'Vtiger'));
			$response->emit();
			return;
		}

		$jobData = $jobs[$jobId];
		if (!empty($jobData['completed'])) {
			$response->setResult($this->buildMassEditProgressPayload($jobId, $jobData));
			$response->emit();
			return;
		}

		try {
			vglobal('VTIGER_TIMESTAMP_NO_CHANGE_MODE', $jobData['timestamp_no_change_mode']);
			$rollbackStats = $this->rollbackMassEditProgressJob($jobData);
			$jobData['completed'] = true;
			$jobData['cancelled'] = true;
			$jobData['updated_at'] = time();
			$jobData['rollback_successful'] = $rollbackStats['successful'];
			$jobData['rollback_failed'] = $rollbackStats['failed'];

			if (!empty($rollbackStats['errors'])) {
				$jobData['errors'] = array_merge($jobData['errors'], $rollbackStats['errors']);
			}

			$this->cleanupUndoFile($jobData);
			$jobs[$jobId] = $jobData;
			$this->setMassEditProgressJobs($jobs);

			$response->setResult($this->buildMassEditProgressPayload($jobId, $jobData, vtranslate('JS_MASS_EDIT_PROGRESS_CANCELLED', 'Vtiger')));
		} catch (Exception $e) {
			$response->setError($e->getMessage());
		}

		vglobal('VTIGER_TIMESTAMP_NO_CHANGE_MODE', false);
		$response->emit();
	}

	protected function getMassEditProgressJobs() {
		if (!isset($_SESSION[self::PROGRESS_JOBS_SESSION_KEY]) || !is_array($_SESSION[self::PROGRESS_JOBS_SESSION_KEY])) {
			$_SESSION[self::PROGRESS_JOBS_SESSION_KEY] = array();
		}

		return $_SESSION[self::PROGRESS_JOBS_SESSION_KEY];
	}

	protected function setMassEditProgressJobs($jobs) {
		$_SESSION[self::PROGRESS_JOBS_SESSION_KEY] = $jobs;
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
