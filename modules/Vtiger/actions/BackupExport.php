<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Vtiger_BackupExport_Action extends Vtiger_Action_Controller {

	const CACHE_EXPORT_DIRECTORY = 'cache/backup_exports';
	const JOB_DIRECTORY = 'storage/async_exports/jobs';
	const CHUNK_SIZE = 1000;
	const AUTO_DELETE_BACKUP_FILE = false;
	const CLEANUP_INTERVAL_SECONDS = 604800;
	const CLEANUP_RETENTION_SECONDS = 604800;
	const CLEANUP_STATE_FILE = 'storage/async_exports/backup_cleanup_state.json';

	public function requiresPermission(Vtiger_Request $request) {
		$permissions = parent::requiresPermission($request);
		$permissions[] = array('module_parameter' => 'source_module', 'action' => 'Export');
		return $permissions;
	}

	public function process(Vtiger_Request $request) {
		$response = new Vtiger_Response();
		$jobData = null;

		try {
			$sourceModule = $this->getSupportedSourceModule($request);
			$currentUser = Users_Record_Model::getCurrentUserModel();
			$userEmail = $this->getUserEmailAddress($currentUser);
			if (empty($userEmail)) {
				throw new Exception(vtranslate('JS_BACKUP_EXPORT_USER_EMAIL_REQUIRED', 'Vtiger'));
			}

			$filterData = $this->getFilterDataFromRequest($request);
			$jobData = $this->buildJobData($sourceModule, $currentUser, $userEmail, $filterData);
			$this->writeJobState($jobData, 'queued');

			$response->setResult(array(
				'success' => true,
				'job_id' => $jobData['job_id'],
				'message' => vtranslate('JS_BACKUP_EXPORT_REQUEST_ACCEPTED', 'Vtiger'),
			));
		} catch (Exception $exception) {
			$response->setError($exception->getMessage());
			$response->emit();
			return;
		}

		$response->emit();
		$dispatched = $this->dispatchBackupJobToBackground($jobData['job_id']);
		if (!$dispatched) {
			$this->detachRequestAndContinue();
			$this->executeBackupJob($jobData);
			$this->runBackupCacheCleanupIfDue();
		}
	}

	public function processQueuedJobById($jobId) {
		$safeJobId = $this->sanitizeJobId($jobId);
		if ($safeJobId === '') {
			return false;
		}

		$jobData = $this->loadJobDataById($safeJobId);
		if (empty($jobData) || !is_array($jobData)) {
			return false;
		}

		$this->setRuntimeUserFromJob($jobData);
		$this->executeBackupJob($jobData);
		$this->runBackupCacheCleanupIfDue();
		return true;
	}

	protected function getSupportedSourceModule(Vtiger_Request $request) {
		$sourceModule = trim((string) $request->get('source_module'));
		if (!in_array($sourceModule, array('Contacts', 'Accounts'), true)) {
			throw new Exception(vtranslate('LBL_PERMISSION_DENIED'));
		}
		return $sourceModule;
	}

	protected function getFilterDataFromRequest(Vtiger_Request $request) {
		$filterType = trim((string) $request->get('filter_type'));
		if ($filterType === '') {
			$filterType = 'all';
		}

		if ($filterType !== 'all' && $filterType !== 'created_time_range') {
			throw new Exception(vtranslate('JS_BACKUP_EXPORT_INVALID_FILTER', 'Vtiger'));
		}

		$filterData = array(
			'filter_type' => $filterType,
			'from_date' => '',
			'to_date' => '',
			'from_datetime' => '',
			'to_datetime' => '',
		);

		if ($filterType === 'created_time_range') {
			$fromDate = trim((string) $request->get('from_date'));
			$toDate = trim((string) $request->get('to_date'));

			if ($fromDate === '' || $toDate === '') {
				throw new Exception(vtranslate('JS_BACKUP_EXPORT_DATE_REQUIRED', 'Vtiger'));
			}

			$fromTimestamp = strtotime($fromDate . ' 00:00:00');
			$toTimestamp = strtotime($toDate . ' 23:59:59');
			if ($fromTimestamp === false || $toTimestamp === false) {
				throw new Exception(vtranslate('JS_BACKUP_EXPORT_INVALID_DATE', 'Vtiger'));
			}
			if ($fromTimestamp > $toTimestamp) {
				throw new Exception(vtranslate('JS_BACKUP_EXPORT_INVALID_DATE_RANGE', 'Vtiger'));
			}

			$filterData['from_date'] = date('Y-m-d', $fromTimestamp);
			$filterData['to_date'] = date('Y-m-d', $toTimestamp);
			$filterData['from_datetime'] = date('Y-m-d H:i:s', $fromTimestamp);
			$filterData['to_datetime'] = date('Y-m-d H:i:s', $toTimestamp);
		}

		return $filterData;
	}

	protected function buildJobData($sourceModule, Users_Record_Model $currentUser, $userEmail, array $filterData) {
		$timestamp = date('YmdHis');
		$randomSuffix = substr(md5(uniqid('backup', true)), 0, 12);
		$jobId = 'backup_' . $timestamp . '_' . $randomSuffix;
		$fileName = $sourceModule . '_Backup_' . $timestamp . '_' . $randomSuffix . '.xlsx';
		$relativeFilePath = self::CACHE_EXPORT_DIRECTORY . '/' . $fileName;

		$jobData = array(
			'job_id' => $jobId,
			'source_module' => $sourceModule,
			'user_id' => (int) $currentUser->getId(),
			'user_name' => (string) $currentUser->get('user_name'),
			'user_email' => $userEmail,
			'file_name' => $fileName,
			'relative_file_path' => $relativeFilePath,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
			'filter' => $filterData,
			'status' => 'queued',
			'error_message' => '',
		);

		return $jobData;
	}

	protected function sanitizeJobId($jobId) {
		return preg_replace('/[^A-Za-z0-9_\-]/', '', (string) $jobId);
	}

	protected function getJobFileAbsolutePath(array $jobData) {
		$rootDirectory = rtrim((string) vglobal('root_directory'), '/');
		if ($rootDirectory === '') {
			$rootDirectory = rtrim(getcwd(), '/');
		}
		return $rootDirectory . '/' . self::JOB_DIRECTORY . '/' . $jobData['job_id'] . '.json';
	}

	protected function getJobFileAbsolutePathById($jobId) {
		$rootDirectory = rtrim((string) vglobal('root_directory'), '/');
		if ($rootDirectory === '') {
			$rootDirectory = rtrim(getcwd(), '/');
		}

		return $rootDirectory . '/' . self::JOB_DIRECTORY . '/' . $this->sanitizeJobId($jobId) . '.json';
	}

	protected function getBackupFileAbsolutePath(array $jobData) {
		$rootDirectory = rtrim((string) vglobal('root_directory'), '/');
		if ($rootDirectory === '') {
			$rootDirectory = rtrim(getcwd(), '/');
		}
		return $rootDirectory . '/' . ltrim($jobData['relative_file_path'], '/');
	}

	protected function ensureDirectory($absoluteDirectoryPath) {
		if (!is_dir($absoluteDirectoryPath)) {
			@mkdir($absoluteDirectoryPath, 0755, true);
		}
	}

	protected function writeJobState(array $jobData, $status, $errorMessage = '') {
		$jobData['status'] = $status;
		$jobData['updated_at'] = date('Y-m-d H:i:s');
		$jobData['error_message'] = $errorMessage;

		$jobFilePath = $this->getJobFileAbsolutePath($jobData);
		$this->ensureDirectory(dirname($jobFilePath));
		@file_put_contents($jobFilePath, Zend_Json::encode($jobData));
	}

	protected function loadJobDataById($jobId) {
		$jobFilePath = $this->getJobFileAbsolutePathById($jobId);
		if (!is_file($jobFilePath)) {
			return array();
		}

		$raw = @file_get_contents($jobFilePath);
		if ($raw === false || trim($raw) === '') {
			return array();
		}

		$decoded = Zend_Json::decode($raw);
		return is_array($decoded) ? $decoded : array();
	}

	protected function setRuntimeUserFromJob(array $jobData) {
		$userId = isset($jobData['user_id']) ? (int) $jobData['user_id'] : 0;
		if ($userId <= 0) {
			return;
		}

		global $current_user;
		$current_user = CRMEntity::getInstance('Users');
		$current_user->retrieveCurrentUserInfoFromFile($userId);
	}

	protected function dispatchBackupJobToBackground($jobId) {
		$safeJobId = $this->sanitizeJobId($jobId);
		if ($safeJobId === '') {
			return false;
		}

		$rootDirectory = rtrim((string) vglobal('root_directory'), '/');
		if ($rootDirectory === '') {
			$rootDirectory = rtrim(getcwd(), '/');
		}

		$workerScript = $rootDirectory . '/cron/run_backup_export_job.php';
		if (!is_file($workerScript)) {
			return false;
		}

		$phpBinary = defined('PHP_BINARY') && PHP_BINARY ? PHP_BINARY : 'php';
		$command = escapeshellarg($phpBinary) . ' ' . escapeshellarg($workerScript) . ' ' . escapeshellarg($safeJobId) . ' > /dev/null 2>&1 &';

		if (function_exists('exec')) {
			@exec($command);
			return true;
		}

		if (function_exists('popen')) {
			$handle = @popen($command, 'r');
			if (is_resource($handle)) {
				@pclose($handle);
				return true;
			}
		}

		return false;
	}

	protected function runBackupCacheCleanupIfDue() {
		$stateFile = $this->getCleanupStateFileAbsolutePath();
		$this->ensureDirectory(dirname($stateFile));

		$lockFile = $stateFile . '.lock';
		$lockHandle = @fopen($lockFile, 'c');
		if (!$lockHandle) {
			return;
		}

		if (!@flock($lockHandle, LOCK_EX)) {
			@fclose($lockHandle);
			return;
		}

		$now = time();
		$lastRun = $this->getCleanupLastRunTimestamp($stateFile);
		if ($lastRun > 0 && ($now - $lastRun) < self::CLEANUP_INTERVAL_SECONDS) {
			@flock($lockHandle, LOCK_UN);
			@fclose($lockHandle);
			return;
		}

		$expiredBefore = $now - self::CLEANUP_RETENTION_SECONDS;
		$deletedFiles = $this->deleteExpiredBackupFiles($expiredBefore);

		$cleanupState = array(
			'last_run' => $now,
			'last_run_at' => date('Y-m-d H:i:s', $now),
			'deleted_files' => $deletedFiles,
		);
		@file_put_contents($stateFile, Zend_Json::encode($cleanupState));

		@flock($lockHandle, LOCK_UN);
		@fclose($lockHandle);
	}

	protected function getCleanupStateFileAbsolutePath() {
		$rootDirectory = rtrim((string) vglobal('root_directory'), '/');
		if ($rootDirectory === '') {
			$rootDirectory = rtrim(getcwd(), '/');
		}

		return $rootDirectory . '/' . self::CLEANUP_STATE_FILE;
	}

	protected function getCleanupLastRunTimestamp($stateFile) {
		if (!is_file($stateFile)) {
			return 0;
		}

		$rawState = @file_get_contents($stateFile);
		if ($rawState === false || trim($rawState) === '') {
			return 0;
		}

		$decodedState = Zend_Json::decode($rawState);
		if (!is_array($decodedState) || !isset($decodedState['last_run'])) {
			return 0;
		}

		return (int) $decodedState['last_run'];
	}

	protected function deleteExpiredBackupFiles($expiredBeforeTimestamp) {
		$rootDirectory = rtrim((string) vglobal('root_directory'), '/');
		if ($rootDirectory === '') {
			$rootDirectory = rtrim(getcwd(), '/');
		}

		$backupDirectory = $rootDirectory . '/' . self::CACHE_EXPORT_DIRECTORY;
		if (!is_dir($backupDirectory)) {
			return 0;
		}

		$files = glob($backupDirectory . '/*');
		if ($files === false || empty($files)) {
			return 0;
		}

		$deletedFiles = 0;
		foreach ($files as $filePath) {
			if (!is_file($filePath)) {
				continue;
			}

			$fileModifiedTime = @filemtime($filePath);
			if ($fileModifiedTime === false || $fileModifiedTime > $expiredBeforeTimestamp) {
				continue;
			}

			if (@unlink($filePath)) {
				$deletedFiles++;
			}
		}

		return $deletedFiles;
	}

	protected function detachRequestAndContinue() {
		ignore_user_abort(true);
		@set_time_limit(0);

		if (function_exists('session_status') && session_status() === PHP_SESSION_ACTIVE) {
			@session_write_close();
		}

		if (function_exists('fastcgi_finish_request')) {
			@fastcgi_finish_request();
			return;
		}

		@ob_end_flush();
		@flush();
	}

	protected function executeBackupJob(array $jobData) {
		$backupFilePath = $this->getBackupFileAbsolutePath($jobData);
		$this->ensureDirectory(dirname($backupFilePath));

		$this->writeJobState($jobData, 'processing');
		try {
			$queryContext = $this->buildExportQueryContext($jobData['source_module'], $jobData['filter']);
			$this->writeBackupFile($backupFilePath, $queryContext);
			$this->sendBackupEmail($jobData, $backupFilePath);
			$this->writeJobState($jobData, 'completed');
		} catch (Exception $exception) {
			$this->writeJobState($jobData, 'failed', $exception->getMessage());
		}

		if (self::AUTO_DELETE_BACKUP_FILE && is_file($backupFilePath)) {
			@unlink($backupFilePath);
		}
	}

	protected function buildExportQueryContext($sourceModule, array $filterData) {
		$currentUser = Users_Record_Model::getCurrentUserModel();
		$moduleModel = Vtiger_Module_Model::getInstance($sourceModule);
		if (!$moduleModel) {
			throw new Exception(vtranslate('JS_BACKUP_EXPORT_MODULE_NOT_FOUND', 'Vtiger'));
		}

		$queryGenerator = new EnhancedQueryGenerator($sourceModule, $currentUser);
		// Backup export should be stable and independent from user's custom view filters.
		// We only apply explicit backup filters from popup (all / created time range).

		$fieldDescriptors = $this->getExportFieldDescriptors($moduleModel);
		$fieldDescriptors = $this->filterFieldDescriptorsForQuery($fieldDescriptors, $queryGenerator, $moduleModel);
		if (empty($fieldDescriptors)) {
			throw new Exception('No exportable fields found for module ' . $sourceModule);
		}

		$fieldNames = array();
		foreach ($fieldDescriptors as $descriptor) {
			$fieldNames[] = $descriptor['name'];
		}
		$fieldNames = array_values(array_unique($fieldNames));
		$queryGenerator->setFields($fieldNames);

		if ($filterData['filter_type'] === 'created_time_range') {
			$queryGenerator->addCondition('createdtime', array(
				$filterData['from_datetime'],
				$filterData['to_datetime']
			), 'BETWEEN');
		}

		$query = $queryGenerator->getQuery();
		$queryParams = array();

		return array(
			'query' => $query,
			'query_params' => $queryParams,
			'field_descriptors' => $fieldDescriptors,
			'source_module' => $sourceModule,
		);
	}

	protected function getExportFieldDescriptors(Vtiger_Module_Model $moduleModel) {
		$fieldDescriptors = array();
		$moduleName = $moduleModel->getName();
		$moduleFields = $moduleModel->getFields();
		$presenceValues = array(0, 1, 2);

		foreach ($moduleFields as $fieldName => $fieldModel) {
			$tableName = $fieldModel->get('table');
			$columnName = $fieldModel->get('column');
			if (empty($tableName) || empty($columnName)) {
				continue;
			}

			$displayType = (string) $fieldModel->get('displaytype');
			if ($displayType === '6') {
				continue;
			}

			$presence = (int) $fieldModel->get('presence');
			if (!in_array($presence, $presenceValues, true)) {
				continue;
			}

			$fieldDescriptors[] = array(
				'name' => $fieldName,
				'table' => $tableName,
				'column' => $columnName,
				'label' => decode_html(vtranslate($fieldModel->get('label'), $moduleName)),
			);
		}

		return $fieldDescriptors;
	}

	protected function filterFieldDescriptorsForQuery(array $fieldDescriptors, EnhancedQueryGenerator $queryGenerator, Vtiger_Module_Model $moduleModel) {
		$tableIndexList = $queryGenerator->getTableIndexList();
		$baseTable = (string) $moduleModel->get('basetable');
		$safeDescriptors = array();

		foreach ($fieldDescriptors as $descriptor) {
			$tableName = isset($descriptor['table']) ? (string) $descriptor['table'] : '';
			if ($tableName === '') {
				continue;
			}

			if ($tableName === $baseTable || $tableName === 'vtiger_crmentity' || isset($tableIndexList[$tableName])) {
				$safeDescriptors[] = $descriptor;
			}
		}

		return $safeDescriptors;
	}

	protected function writeBackupFile($backupFilePath, array $queryContext) {
		require_once 'libraries/PHPExcel/PHPExcel.php';

		if (class_exists('PHPExcel_CachedObjectStorageFactory') && class_exists('PHPExcel_Settings')) {
			@PHPExcel_Settings::setCacheStorageMethod(PHPExcel_CachedObjectStorageFactory::cache_to_discISAM);
		}

		$workbook = new PHPExcel();
		$sheet = $workbook->setActiveSheetIndex(0);
		$sheet->setTitle(substr($queryContext['source_module'], 0, 31));

		$headerStyle = array(
			'font' => array('bold' => true),
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => 'E7EEF9'),
			),
		);

		$columnIndex = 0;
		foreach ($queryContext['field_descriptors'] as $descriptor) {
			$sheet->setCellValueExplicitByColumnAndRow(
				$columnIndex,
				1,
				$descriptor['label'],
				PHPExcel_Cell_DataType::TYPE_STRING
			);
			$sheet->getStyleByColumnAndRow($columnIndex, 1)->applyFromArray($headerStyle);
			$columnIndex++;
		}

		$db = PearDatabase::getInstance();
		$rowIndex = 2;
		$offset = 0;

		while (true) {
			$chunkQuery = $queryContext['query'] . ' LIMIT ' . (int) $offset . ', ' . (int) self::CHUNK_SIZE;
			$result = $db->pquery($chunkQuery, $queryContext['query_params']);
			if ($result === false) {
				throw new Exception('Backup export query failed: ' . $this->getDatabaseErrorMessage($db));
			}

			$rowCount = $db->num_rows($result);
			if ($rowCount <= 0) {
				break;
			}

			for ($i = 0; $i < $rowCount; $i++) {
				$rowData = $db->fetchByAssoc($result, $i);
				$normalizedRow = array();
				if (is_array($rowData)) {
					foreach ($rowData as $key => $value) {
						$normalizedRow[strtolower($key)] = $value;
					}
				}

				$columnIndex = 0;
				foreach ($queryContext['field_descriptors'] as $descriptor) {
					$cellValue = $this->resolveRowValue($normalizedRow, $descriptor);
					$sheet->setCellValueExplicitByColumnAndRow(
						$columnIndex,
						$rowIndex,
						$cellValue,
						PHPExcel_Cell_DataType::TYPE_STRING
					);
					$columnIndex++;
				}
				$rowIndex++;
			}

			$offset += self::CHUNK_SIZE;
			if ($rowCount < self::CHUNK_SIZE) {
				break;
			}
		}

		$writer = PHPExcel_IOFactory::createWriter($workbook, 'Excel2007');
		$writer->setPreCalculateFormulas(false);
		$writer->save($backupFilePath);
	}

	protected function resolveRowValue(array $normalizedRow, array $descriptor) {
		$columnKey = strtolower($descriptor['column']);
		$fieldKey = strtolower($descriptor['name']);

		$value = '';
		if (array_key_exists($columnKey, $normalizedRow)) {
			$value = $normalizedRow[$columnKey];
		} elseif (array_key_exists($fieldKey, $normalizedRow)) {
			$value = $normalizedRow[$fieldKey];
		}

		if (is_array($value)) {
			$value = implode(', ', $value);
		}
		if ($value === null) {
			$value = '';
		}

		return decode_html((string) $value);
	}

	protected function sendBackupEmail(array $jobData, $backupFilePath) {
		require_once 'vtlib/Vtiger/Mailer.php';

		$moduleLabel = vtranslate($jobData['source_module'], $jobData['source_module']);
		$mailSubject = vtranslate('LBL_BACKUP_EXPORT_EMAIL_SUBJECT', 'Vtiger') . ' - ' . $moduleLabel;
		$mailBody = vtranslate('LBL_BACKUP_EXPORT_EMAIL_BODY', 'Vtiger');
		$mailBody .= '<br><br><strong>' . vtranslate('LBL_MODULE', 'Vtiger') . ':</strong> ' . $moduleLabel;
		if ($jobData['filter']['filter_type'] === 'created_time_range') {
			$mailBody .= '<br><strong>' . vtranslate('LBL_BACKUP_EXPORT_EMAIL_FILTER', 'Vtiger') . ':</strong> ';
			$mailBody .= $jobData['filter']['from_date'] . ' - ' . $jobData['filter']['to_date'];
		} else {
			$mailBody .= '<br><strong>' . vtranslate('LBL_BACKUP_EXPORT_EMAIL_FILTER', 'Vtiger') . ':</strong> ';
			$mailBody .= vtranslate('LBL_BACKUP_EXPORT_FILTER_ALL', 'Vtiger');
		}

		$mailer = new Vtiger_Mailer();
		$mailer->AddAddress($jobData['user_email'], $this->getDisplayNameForEmail($jobData['user_name']));
		$mailer->Subject = decode_html($mailSubject);
		$mailer->Body = decode_html($mailBody);
		$mailer->ContentType = 'text/html';
		$mailer->AddAttachment($backupFilePath, basename($backupFilePath));

		$mailSendStatus = $mailer->Send(true);
		if (!$mailSendStatus) {
			throw new Exception(vtranslate('JS_BACKUP_EXPORT_EMAIL_SEND_FAILED', 'Vtiger'));
		}
	}

	protected function getDisplayNameForEmail($userName) {
		$displayName = trim((string) $userName);
		if ($displayName !== '') {
			return $displayName;
		}
		return 'User';
	}

	protected function getUserEmailAddress(Users_Record_Model $currentUser) {
		$email = trim((string) $currentUser->get('email1'));
		if ($email === '') {
			$email = trim((string) $currentUser->get('email2'));
		}
		if ($email === '') {
			$email = trim((string) $currentUser->get('secondaryemail'));
		}
		return $email;
	}

	protected function getDatabaseErrorMessage(PearDatabase $db) {
		if (isset($db->database) && method_exists($db->database, 'ErrorMsg')) {
			$errorMessage = trim((string) $db->database->ErrorMsg());
			if ($errorMessage !== '') {
				return $errorMessage;
			}
		}

		return 'Unknown SQL error';
	}
}
