<?php

/* +***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 * *********************************************************************************** */
//required for auto detecting file endings for files create in mac
if (version_compare(PHP_VERSION, '8.1.0') <= 0) {
	ini_set("auto_detect_line_endings", true);
}

class Import_Utils_Helper {

	static $AUTO_MERGE_NONE = 0;
	static $AUTO_MERGE_IGNORE = 1;
	static $AUTO_MERGE_OVERWRITE = 2;
	static $AUTO_MERGE_MERGEFIELDS = 3;
	static $CONTACT_IMPORT_RETENTION_DAYS = 7;

	static $supportedFileEncoding = array('UTF-8'=>'UTF-8', 'ISO-8859-1'=>'ISO-8859-1');
	static $supportedDelimiters = array(','=>'comma', ';'=>'semicolon', '|'=> 'Pipe', '^'=>'Caret');
	static $supportedFileExtensions = array('csv','vcf','xls','xlsx');

	public static function getSupportedFileExtensions() {
		return self::$supportedFileExtensions;
	}

	public static function getSupportedFileEncoding() {
		return self::$supportedFileEncoding;
	}

	public static function getSupportedDelimiters() {
		return self::$supportedDelimiters;
	}

	public static function getAutoMergeTypes($moduleName) {
		$mergeTypes = array(self::$AUTO_MERGE_IGNORE => 'Skip');
		if (Users_Privileges_Model::isPermitted($moduleName, 'EditView')) {
			$mergeTypes[self::$AUTO_MERGE_OVERWRITE]		= 'Overwrite';
			$mergeTypes[self::$AUTO_MERGE_MERGEFIELDS]	= 'Merge';
		}
		return $mergeTypes;
	}

	public static function getMaxUploadSize() {
		global $upload_maxsize;
		return $upload_maxsize;
	}

	public static function getImportDirectory() {
		global $import_dir;
		$importDir = dirname(__FILE__). '/../../../'.$import_dir;
		return $importDir;
	}

	public static function getImportFilePath($user) {
		$importDirectory = self::getImportDirectory();
		return $importDirectory. "IMPORT_".$user->id;
	}


	public static function getFileReaderInfo($type) {
		$configReader = new Import_Config_Model();
		$importTypeConfig = $configReader->get('importTypes');
		if(isset($importTypeConfig[$type])) {
			return $importTypeConfig[$type];
		}
		return null;
	}

	public static function getFileReader($request, $user) {
		$fileReaderInfo = self::getFileReaderInfo($request->get('type'));
		if(!empty($fileReaderInfo)) {
			require_once $fileReaderInfo['classpath'];
			$fileReader = new $fileReaderInfo['reader'] ($request, $user);
		} else {
			$fileReader = null;
		}
		return $fileReader;
	}

	public static function getDbTableName($user) {
		$configReader = new Import_Config_Model();
		$userImportTablePrefix = $configReader->get('userImportTablePrefix');

		$tableName = $userImportTablePrefix;
		if(method_exists($user, 'getId')){
			$tableName .= $user->getId();
		} else {
			$tableName .= $user->id;
		}
		return $tableName;
	}

	public static function showErrorPage($errorMessage, $errorDetails=false, $customActions=false) {
		$viewer = new Vtiger_Viewer();

		$viewer->assign('ERROR_MESSAGE', $errorMessage);
		$viewer->assign('ERROR_DETAILS', $errorDetails);
		$viewer->assign('CUSTOM_ACTIONS', $customActions);
		$viewer->assign('MODULE','Import');

		$viewer->view('ImportError.tpl', 'Import');
	}

	public static function showImportLockedError($lockInfo) {
		$moduleName = getTabModuleName($lockInfo['tabid']);
		$userName = getUserFullName($lockInfo['userid']);
		$errorMessage = sprintf("%s is importing %s. Please try after some time.",$userName, $moduleName);
		self::showErrorPage($errorMessage);
	}

	public static function showImportTableBlockedError($moduleName, $user) {

		$errorMessage = vtranslate('ERR_UNIMPORTED_RECORDS_EXIST', 'Import');
		$customActions = array('LBL_CLEAR_DATA' => "location.href='index.php?module={$moduleName}&view=Import&mode=clearCorruptedData'");

		self::showErrorPage($errorMessage, '', $customActions);
	}

	public static function isUserImportBlocked($user) {
		$adb = PearDatabase::getInstance();
		$tableName = self::getDbTableName($user);

		if(Vtiger_Utils::CheckTable($tableName)) {
			$result = $adb->pquery('SELECT 1 FROM '.$tableName.' WHERE status = ?',  array(Import_Data_Action::$IMPORT_RECORD_NONE));
			if($adb->num_rows($result) > 0) {
				return true;
			}
		}
		return false;
	}

	public static function clearUserImportInfo($user) {
		$adb = PearDatabase::getInstance();
		$tableName = self::getDbTableName($user);

		$adb->pquery('DROP TABLE IF EXISTS '.$tableName, array());
		Import_Lock_Action::unLock($user);
		Import_Queue_Action::removeForUser($user);
	}

	public static function getAssignedToUserList($module) {
		$current_user = Users_Record_Model::getCurrentUserModel();
		$cache = Vtiger_Cache::getInstance();
		if($cache->getUserList($module,$current_user->id)){
			return $cache->getUserList($module,$current_user->id);
		} else {
			$userList = get_user_array(FALSE, "Active", $current_user->id);
			$cache->setUserList($module,$userList,$current_user->id);
			return $userList;
		}
	}

	public static function getAssignedToGroupList($module) {
		$current_user = Users_Record_Model::getCurrentUserModel();
		$cache = Vtiger_Cache::getInstance();
		if($cache->getGroupList($module,$current_user->id)){
			return $cache->getGroupList($module,$current_user->id);
		} else {
			$groupList = get_group_array(FALSE, "Active", $current_user->id);
			$cache->setGroupList($module,$groupList,$current_user->id);
			return $groupList;
		}
	}

	public static function hasAssignPrivilege($moduleName, $assignToUserId) {
		$assignableUsersList = self::getAssignedToUserList($moduleName);
		if(array_key_exists($assignToUserId, $assignableUsersList)) {
			return true;
		}
		$assignableGroupsList = self::getAssignedToGroupList($moduleName);
		if(array_key_exists($assignToUserId, $assignableGroupsList)) {
			return true;
		}
		return false;
	}

	public static function validateFileUpload($request) {
		$current_user = Users_Record_Model::getCurrentUserModel();
		self::ensureImportTrackingId($request);

		$uploadMaxSize = self::getMaxUploadSize();
		$importDirectory = self::getImportDirectory();
		$temporaryFileName = self::getImportFilePath($current_user);

		if($_FILES['import_file']['error']) {
			$request->set('error_message', self::fileUploadErrorMessage($_FILES['import_file']['error']));
			return false;
		}
		if(!is_uploaded_file($_FILES['import_file']['tmp_name'])) {
			$request->set('error_message', vtranslate('LBL_FILE_UPLOAD_FAILED', 'Import'));
			return false;
		}
		if ($_FILES['import_file']['size'] > $uploadMaxSize) {
			$request->set('error_message', vtranslate('LBL_IMPORT_ERROR_LARGE_FILE', 'Import').
												 $uploadMaxSize.' '.vtranslate('LBL_IMPORT_CHANGE_UPLOAD_SIZE', 'Import'));
			return false;
		}
		if(!is_writable($importDirectory)) {
			$request->set('error_message', vtranslate('LBL_IMPORT_DIRECTORY_NOT_WRITABLE', 'Import'));
			return false;
		}

		$type = $request->get('type');
		if ($type == "ics" || $type == "vcf" || $type == "xls" || $type == "xlsx") {
			$fileCopied = move_uploaded_file($_FILES['import_file']['tmp_name'], $temporaryFileName);
		} else {
			$fileCopied = self::neutralizeAndMoveFile($_FILES['import_file']['tmp_name'], $temporaryFileName, $request->get('delimiter'));
		}
		if(!$fileCopied) {
			$request->set('error_message', vtranslate('LBL_IMPORT_FILE_COPY_FAILED', 'Import'));
			return false;
		}

		self::archiveContactImportFile($request, $current_user, $temporaryFileName);

		$fileReader = Import_Utils_Helper::getFileReader($request, $current_user);

		if($fileReader == null) {
			$request->set('error_message', vtranslate('LBL_INVALID_FILE', 'Import'));
			return false;
		}

		$hasHeader = $fileReader->hasHeader();
		$firstRow = $fileReader->getFirstRowData($hasHeader);
		if($firstRow === false) {
			$request->set('error_message', vtranslate('LBL_NO_ROWS_FOUND', 'Import'));
			return false;
		}
		return true;
	}

	public static function shouldTrackDetailedImport($moduleName) {
		return $moduleName === 'Contacts';
	}

	public static function ensureImportTrackingId($request) {
		if(!$request) {
			return '';
		}

		$trackingId = self::sanitizeTrackingId($request->get('import_tracking_id'));
		if(empty($trackingId)) {
			$trackingId = self::generateImportTrackingId();
		}
		$request->set('import_tracking_id', $trackingId);
		return $trackingId;
	}

	public static function sanitizeTrackingId($trackingId) {
		$trackingId = preg_replace('/[^A-Za-z0-9._-]/', '', (string) $trackingId);
		return substr($trackingId, 0, 120);
	}

	public static function generateImportTrackingId() {
		return 'imp_'.date('Ymd_His').'_'.substr(md5(uniqid('', true)), 0, 10);
	}

	public static function logImportStepOneConfig($request, $user) {
		$moduleName = $request->getModule();
		if(!self::shouldTrackDetailedImport($moduleName)) {
			return;
		}

		$fileInfo = isset($_FILES['import_file']) ? $_FILES['import_file'] : array();
		$fileName = isset($fileInfo['name']) ? self::normalizeUploadedFileName($fileInfo['name']) : '';
		$sizeBytes = isset($fileInfo['size']) ? intval($fileInfo['size']) : 0;
		$fileType = strtolower((string) $request->get('type'));
		if($fileType === '' && $fileName !== '') {
			$fileType = strtolower((string) pathinfo($fileName, PATHINFO_EXTENSION));
		}

		$uploadChannel = $fileType;
		if($fileType === 'xls' || $fileType === 'xlsx') {
			$uploadChannel = 'excel';
		}

		$payload = array(
			'file_name' => $fileName,
			'file_extension' => $fileType,
			'upload_channel' => $uploadChannel,
			'file_size_bytes' => $sizeBytes,
			'has_header_checked' => !empty($request->get('has_header')) ? 1 : 0,
			'delimiter' => (string) $request->get('delimiter'),
			'file_encoding' => (string) $request->get('file_encoding'),
			'lineitem_currency' => (string) $request->get('lineitem_currency')
		);

		self::appendImportTrackingEntry($request, $user, 'step1_upload_file', $payload);
	}

	public static function logImportStepTwoConfig($request, $user) {
		$moduleName = $request->getModule();
		if(!self::shouldTrackDetailedImport($moduleName)) {
			return;
		}

		$mergeFields = self::decodeJsonToArray($request->get('merge_fields'));
		$mergeFieldApis = self::normalizeFieldNameList($mergeFields);
		$mergeFieldLabels = self::translateFieldNames($moduleName, $mergeFieldApis);
		$autoMerge = intval($request->get('auto_merge'));
		$mergeType = intval($request->get('merge_type'));
		$isDuplicateHandlingSkipped = ($autoMerge !== 1);

		$payload = array(
			'duplicate_handling_skipped' => $isDuplicateHandlingSkipped ? 1 : 0,
			'auto_merge' => $autoMerge,
			'merge_type' => $mergeType,
			'merge_type_label' => self::resolveMergeTypeLabel($mergeType),
			'match_fields_api' => $mergeFieldApis,
			'match_fields_labels' => $mergeFieldLabels
		);

		self::appendImportTrackingEntry($request, $user, 'step2_duplicate_handling', $payload);
	}

	public static function logImportStepThreeConfig($request, $user) {
		$moduleName = $request->getModule();
		if(!self::shouldTrackDetailedImport($moduleName)) {
			return;
		}

		$fieldMapping = self::decodeJsonToArray($request->get('field_mapping'));
		$defaultValues = self::decodeJsonToArray($request->get('default_values'));
		$mergeFields = self::decodeJsonToArray($request->get('merge_fields'));
		$mappingDetails = self::buildFieldMappingDetails($request, $user, $moduleName, $fieldMapping, $defaultValues);
		$mappedFieldApis = array_values(array_map('strval', array_keys($fieldMapping)));
		$mappedFieldLabels = self::translateFieldNames($moduleName, $mappedFieldApis);
		$defaultFieldApis = array_values(array_map('strval', array_keys($defaultValues)));
		$defaultFieldLabels = self::translateFieldNames($moduleName, $defaultFieldApis);

		$payload = array(
			'file_type' => strtolower((string) $request->get('type')),
			'has_header_checked' => !empty($request->get('has_header')) ? 1 : 0,
			'delimiter' => (string) $request->get('delimiter'),
			'file_encoding' => (string) $request->get('file_encoding'),
			'merge_type' => intval($request->get('merge_type')),
			'merge_fields' => $mergeFields,
			'mapped_fields_count' => php7_count($fieldMapping),
			'mapped_fields_api' => $mappedFieldApis,
			'mapped_fields_labels' => $mappedFieldLabels,
			'mapping_details' => $mappingDetails,
			'default_values_count' => php7_count($defaultValues),
			'default_value_fields_api' => $defaultFieldApis,
			'default_value_fields_labels' => $defaultFieldLabels,
			'save_map' => !empty($request->get('save_map')) ? 1 : 0,
			'save_map_as' => (string) $request->get('save_map_as'),
			'lineitem_currency' => (string) $request->get('lineitem_currency')
		);

		self::appendImportTrackingEntry($request, $user, 'step3_field_mapping', $payload);
	}

	public static function logImportStepError($request, $user, $step, $errorMessage) {
		$moduleName = $request->getModule();
		if(!self::shouldTrackDetailedImport($moduleName)) {
			return;
		}

		$payload = array(
			'error' => (string) $errorMessage
		);
		self::appendImportTrackingEntry($request, $user, $step, $payload, 'error');
	}

	public static function appendImportTrackingEntry($request, $user, $step, $payload = array(), $level = 'info') {
		$moduleName = $request->getModule();
		if(!self::shouldTrackDetailedImport($moduleName)) {
			return;
		}

		$trackingId = self::ensureImportTrackingId($request);

		$logData = array(
			'timestamp' => date('Y-m-d H:i:s'),
			'event' => 'import_step_tracking',
			'level' => $level,
			'step' => $step,
			'tracking_id' => $trackingId,
			'module' => $moduleName,
			'user_id' => self::getImportUserId($user),
			'username' => self::getImportUserName($user),
			'mode' => (string) $request->getMode(),
			'payload' => $payload
		);

		self::appendImportHistoryLog($logData);
	}

	public static function appendImportHistoryLog($logData) {
		$logFilePath = dirname(__FILE__).'/../../../logs/contact_import_history.log';
		$jsonLine = @json_encode($logData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
		if($jsonLine === false) {
			$jsonLine = json_encode(array(
				'timestamp' => date('Y-m-d H:i:s'),
				'event' => 'import_tracking_log_failed',
				'error' => 'json_encode_failed'
			));
		}
		@file_put_contents($logFilePath, $jsonLine."\n", FILE_APPEND | LOCK_EX);
	}

	public static function decodeJsonToArray($value) {
		if(is_array($value)) {
			return $value;
		}
		if(!is_string($value) || trim($value) === '') {
			return array();
		}

		$decoded = json_decode($value, true);
		if(is_array($decoded)) {
			return $decoded;
		}

		return array();
	}

	public static function normalizeFieldNameList($fields) {
		$result = array();
		if(!is_array($fields)) {
			return $result;
		}

		foreach($fields as $key => $value) {
			if(is_string($key) && !is_numeric($key)) {
				$result[] = $key;
				continue;
			}

			if(is_string($value) && $value !== '') {
				$result[] = $value;
			}
		}

		$result = array_values(array_unique($result));
		return $result;
	}

	public static function translateFieldNames($moduleName, $fieldNames) {
		$labels = array();
		if(empty($fieldNames)) {
			return $labels;
		}

		$moduleModel = Vtiger_Module_Model::getInstance($moduleName);
		foreach($fieldNames as $fieldName) {
			$labels[$fieldName] = self::resolveFieldLabel($moduleName, $moduleModel, $fieldName);
		}

		return $labels;
	}

	public static function resolveFieldLabel($moduleName, $moduleModel, $fieldName) {
		if(!$moduleModel) {
			return $fieldName;
		}

		$fieldModel = Vtiger_Field_Model::getInstance($fieldName, $moduleModel);
		if($fieldModel && method_exists($fieldModel, 'getFieldLabelKey')) {
			$labelKey = $fieldModel->getFieldLabelKey();
			if(!empty($labelKey)) {
				return vtranslate($labelKey, $moduleName);
			}
		}

		return $fieldName;
	}

	public static function resolveMergeTypeLabel($mergeType) {
		switch(intval($mergeType)) {
			case 0:
				return 'No Duplicate Handling';
			case 1:
				return 'Skip';
			case 2:
				return 'Overwrite';
			case 3:
				return 'Merge';
			default:
				return 'Unknown';
		}
	}

	public static function buildFieldMappingDetails($request, $user, $moduleName, $fieldMapping, $defaultValues) {
		$details = array();
		if(empty($fieldMapping) || !is_array($fieldMapping)) {
			return $details;
		}

		list($sourceColumns, $sourceSamples) = self::readImportSourceColumns($request, $user, $fieldMapping);
		$moduleModel = Vtiger_Module_Model::getInstance($moduleName);

		foreach($fieldMapping as $crmField => $sourceIndexRaw) {
			$sourceIndex = intval($sourceIndexRaw);
			$sourceColumnName = isset($sourceColumns[$sourceIndex]) ? $sourceColumns[$sourceIndex] : 'Column '.($sourceIndex + 1);
			$sourceSampleValue = isset($sourceSamples[$sourceIndex]) ? $sourceSamples[$sourceIndex] : '';
			$fieldLabel = self::resolveFieldLabel($moduleName, $moduleModel, $crmField);
			$defaultValue = array_key_exists($crmField, $defaultValues) ? $defaultValues[$crmField] : '';

			$details[] = array(
				'crm_field_api' => $crmField,
				'crm_field_label' => $fieldLabel,
				'source_column_index' => $sourceIndex,
				'source_column_name' => $sourceColumnName,
				'source_sample' => $sourceSampleValue,
				'default_value' => $defaultValue
			);
		}

		return $details;
	}

	public static function readImportSourceColumns($request, $user, $fieldMapping) {
		$sourceColumns = array();
		$sourceSamples = array();
		$hasHeader = !empty($request->get('has_header'));

		$fileReader = self::getFileReader($request, $user);
		if($fileReader) {
			$firstRow = $fileReader->getFirstRowData($hasHeader);
			if($firstRow !== false && is_array($firstRow)) {
				if($hasHeader) {
					$sourceColumns = array_values(array_map('strval', array_keys($firstRow)));
					$sourceSamples = array_values(array_map('strval', array_values($firstRow)));
				} else {
					$sourceSamples = array_values(array_map('strval', array_values($firstRow)));
					for($i = 0; $i < php7_count($sourceSamples); $i++) {
						$sourceColumns[$i] = 'Column '.($i + 1);
					}
				}
			}
		}

		if(empty($sourceColumns)) {
			$maxIndex = -1;
			foreach($fieldMapping as $sourceIndexRaw) {
				$sourceIndex = intval($sourceIndexRaw);
				if($sourceIndex > $maxIndex) {
					$maxIndex = $sourceIndex;
				}
			}

			for($i = 0; $i <= $maxIndex; $i++) {
				$sourceColumns[$i] = 'Column '.($i + 1);
				if(!isset($sourceSamples[$i])) {
					$sourceSamples[$i] = '';
				}
			}
		}

		return array($sourceColumns, $sourceSamples);
	}

	/**
	 * Keep a per-import file copy for Contacts and purge archived files older than retention period.
	 * This is best-effort and should not block import flow.
	 */
	public static function archiveContactImportFile($request, $user, $temporaryFileName) {
		if($request->getModule() !== 'Contacts') {
			return;
		}

		if(empty($temporaryFileName) || !is_readable($temporaryFileName)) {
			return;
		}

		$importDirectory = self::getImportDirectory();
		if(!is_dir($importDirectory) || !is_writable($importDirectory)) {
			return;
		}

		self::cleanupArchivedContactImportFiles($importDirectory, self::$CONTACT_IMPORT_RETENTION_DAYS);

		$originalName = isset($_FILES['import_file']['name']) ? self::normalizeUploadedFileName($_FILES['import_file']['name']) : 'contacts_import.csv';
		$extension = strtolower((string) pathinfo($originalName, PATHINFO_EXTENSION));
		$extension = preg_replace('/[^A-Za-z0-9]/', '', $extension);
		$baseName = pathinfo($originalName, PATHINFO_FILENAME);

		if(empty($baseName)) {
			$baseName = 'contacts_import';
		}

		$baseName = self::sanitizeFileNamePart($baseName);
		$userName = self::sanitizeFileNamePart(self::getImportUserName($user));
		$timestamp = date('Ymd_His');

		$archiveFileName = $baseName.'_'.$userName.'_'.$timestamp;
		if(!empty($extension)) {
			$archiveFileName .= '.'.$extension;
		}

		$archiveFilePath = rtrim($importDirectory, '/\\').DIRECTORY_SEPARATOR.$archiveFileName;
		if(@copy($temporaryFileName, $archiveFilePath)) {
			self::appendContactImportHistory($request, $user, $originalName, $archiveFileName, $archiveFilePath);
		} else {
			error_log('Import contacts archive copy failed: '.$archiveFilePath);
		}
	}

	public static function cleanupArchivedContactImportFiles($importDirectory, $retentionDays) {
		$maxAgeSeconds = intval($retentionDays) * 86400;
		if($maxAgeSeconds <= 0) {
			return;
		}

		$expireTime = time() - $maxAgeSeconds;
		$entries = @scandir($importDirectory);
		if($entries === false) {
			return;
		}

		foreach($entries as $entry) {
			if($entry === '.' || $entry === '..') {
				continue;
			}

			$entryPath = rtrim($importDirectory, '/\\').DIRECTORY_SEPARATOR.$entry;
			if(!is_file($entryPath)) {
				continue;
			}

			if(strpos($entry, 'IMPORT_') === 0) {
				continue;
			}

			// Only clean archived files created by this feature.
			if(!preg_match('/.+_.+_\d{8}_\d{6}(\.[A-Za-z0-9]+)?$/', $entry)) {
				continue;
			}

			$mtime = @filemtime($entryPath);
			if($mtime !== false && $mtime < $expireTime) {
				@unlink($entryPath);
			}
		}
	}

	public static function appendContactImportHistory($request, $user, $originalFileName, $archiveFileName, $archiveFilePath) {
		$trackingId = self::ensureImportTrackingId($request);
		$logData = array(
			'timestamp' => date('Y-m-d H:i:s'),
			'event' => 'import_file_archived',
			'module' => 'Contacts',
			'tracking_id' => $trackingId,
			'user_id' => self::getImportUserId($user),
			'username' => self::getImportUserName($user),
			'source_file' => $originalFileName,
			'archived_file' => $archiveFileName,
			'archived_path' => $archiveFilePath,
			'size_bytes' => @filesize($archiveFilePath)
		);

		self::appendImportHistoryLog($logData);
	}

	public static function normalizeUploadedFileName($fileName) {
		$fileName = (string) $fileName;
		$fileName = str_replace(array("\0", "\r", "\n"), '', $fileName);
		$fileName = basename(str_replace('\\', '/', $fileName));

		if($fileName === '') {
			return 'contacts_import.csv';
		}

		if(function_exists('mb_check_encoding') && !mb_check_encoding($fileName, 'UTF-8')) {
			$encodings = array('Windows-1258', 'CP1258', 'CP1252', 'ISO-8859-1');
			foreach($encodings as $encoding) {
				if(function_exists('iconv')) {
					$converted = @iconv($encoding, 'UTF-8//IGNORE', $fileName);
					if($converted !== false && $converted !== '') {
						$fileName = $converted;
						break;
					}
				}
			}
		}

		return $fileName;
	}

	public static function getImportUserName($user) {
		if(is_object($user) && method_exists($user, 'get')) {
			$userName = $user->get('user_name');
			if(!empty($userName)) {
				return $userName;
			}
		}

		if(is_object($user) && isset($user->user_name) && !empty($user->user_name)) {
			return $user->user_name;
		}

		return 'user_'.self::getImportUserId($user);
	}

	public static function getImportUserId($user) {
		if(is_object($user) && method_exists($user, 'getId')) {
			$userId = $user->getId();
			if(!empty($userId)) {
				return $userId;
			}
		}

		if(is_object($user) && isset($user->id) && !empty($user->id)) {
			return $user->id;
		}

		return 'unknown';
	}

	public static function sanitizeFileNamePart($value) {
		$value = self::normalizeUploadedFileName((string) $value);

		if(class_exists('Normalizer')) {
			$normalizedValue = @Normalizer::normalize($value, Normalizer::FORM_D);
			if($normalizedValue !== false && $normalizedValue !== null) {
				$value = preg_replace('/\p{Mn}+/u', '', $normalizedValue);
			}
		}

		$value = str_replace(array('đ', 'Đ'), array('d', 'D'), $value);
		if(function_exists('iconv')) {
			$transliterated = @iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $value);
			if($transliterated !== false && $transliterated !== '') {
				$value = $transliterated;
			}
		}

		$value = preg_replace('/[^A-Za-z0-9._-]/', '_', (string) $value);
		$value = trim($value, '._-');
		if($value === '') {
			return 'import';
		}
		return $value;
	}

	/**
	 * To remove carriage return(\r) in end of every line and make the file neutral
	 * @param type $uploadedFileName
	 * @param type $temporaryFileName
	 * @return boolean
	 */
	public static function neutralizeAndMoveFile($uploadedFileName, $temporaryFileName, $delimiter = ','){
		$file_read = fopen($uploadedFileName,'r');
		$file_write = fopen($temporaryFileName,'w+');
		while($data = fgetcsv($file_read, 0, $delimiter)){
			fputcsv($file_write, $data, $delimiter);
		}
		fclose($file_read);
		fclose($file_write);
		return true;
	}

	static function fileUploadErrorMessage($error_code) {
		switch ($error_code) {
			case 1	:	$errorMessage = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
			case 2	:	$errorMessage = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
			case 3	:	$errorMessage = 'The uploaded file was only partially uploaded';
			case 4	:	$errorMessage = 'No file was uploaded';
			case 6	:	$errorMessage = 'Missing a temporary folder';
			case 7	:	$errorMessage = 'Failed to write file to disk';
			case 8	:	$errorMessage = 'File upload stopped by extension';
			default	:	$errorMessage = 'Unknown upload error';
		}
		return $errorMessage;
	}
}
