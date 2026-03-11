<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Vtiger_CustomExportFormat_Model {

	const TABLE_NAME = 'vtiger_custom_export_formats';

	public static function getAllByModuleForCurrentUser($moduleName) {
		$currentUserId = Users_Record_Model::getCurrentUserModel()->getId();
		return self::getAllByUserAndModule($currentUserId, $moduleName);
	}

	public static function getAllByUserAndModule($userId, $moduleName) {
		self::ensureTable();
		$db = PearDatabase::getInstance();
		$result = $db->pquery(
			'SELECT * FROM '.self::TABLE_NAME.' WHERE userid = ? AND module_name = ? ORDER BY format_name ASC, id ASC',
			array((int) $userId, $moduleName)
		);

		$formats = array();
		for ($index = 0; $index < $db->num_rows($result); $index++) {
			$formats[] = self::normalizeRow($db->fetchByAssoc($result, $index));
		}

		return $formats;
	}

	public static function saveForCurrentUser($moduleName, $data) {
		$currentUserId = Users_Record_Model::getCurrentUserModel()->getId();
		return self::saveForUserAndModule($currentUserId, $moduleName, $data);
	}

	public static function deleteForCurrentUser($recordId, $moduleName) {
		$currentUserId = Users_Record_Model::getCurrentUserModel()->getId();
		return self::deleteForUserAndModule($recordId, $currentUserId, $moduleName);
	}

	public static function saveForUserAndModule($userId, $moduleName, $data) {
		self::ensureTable();
		$db = PearDatabase::getInstance();

		$formatName = trim((string) $data['format_name']);
		if ($formatName === '') {
			throw new Exception(vtranslate('LBL_CUSTOM_EXPORT_FORMAT_NAME_REQUIRED', 'Vtiger'));
		}

		$columnsList = self::decodeJsonValue($data['columnslist']);
		if (!is_array($columnsList) || empty($columnsList)) {
			throw new Exception(vtranslate('JS_PLEASE_SELECT_ATLEAST_ONE_OPTION', 'Vtiger'));
		}

		$advanceFilterList = self::decodeJsonValue($data['advfilterlist']);
		if (!is_array($advanceFilterList)) {
			$advanceFilterList = array();
		}

		$recordId = (int) $data['selected_format_id'];
		$filename = self::sanitizeText($data['filename'], 150);
		$exportTitle = self::sanitizeText($data['export_title'], 255);
		$columnsJson = Zend_Json::encode(array_values($columnsList));
		$filtersJson = Zend_Json::encode($advanceFilterList);
		$currentDateTime = date('Y-m-d H:i:s');

		$recordById = ($recordId > 0) ? self::getRawById($recordId, $userId, $moduleName) : false;
		$recordByName = self::getRawByName($formatName, $userId, $moduleName);

		if ($recordById && $recordByName && (int) $recordById['id'] !== (int) $recordByName['id']) {
			throw new Exception(vtranslate('LBL_CUSTOM_EXPORT_FORMAT_EXISTS', 'Vtiger'));
		}

		$recordToSave = $recordById ? $recordById : $recordByName;
		if ($recordToSave) {
			$db->pquery(
				'UPDATE '.self::TABLE_NAME.' SET format_name = ?, filename = ?, export_title = ?, columnslist = ?, advfilterlist = ?, modifiedtime = ? WHERE id = ? AND userid = ? AND module_name = ?',
				array($formatName, $filename, $exportTitle, $columnsJson, $filtersJson, $currentDateTime, (int) $recordToSave['id'], (int) $userId, $moduleName)
			);
			$recordId = (int) $recordToSave['id'];
		} else {
			$db->pquery(
				'INSERT INTO '.self::TABLE_NAME.' (userid, module_name, format_name, filename, export_title, columnslist, advfilterlist, createdtime, modifiedtime) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)',
				array((int) $userId, $moduleName, $formatName, $filename, $exportTitle, $columnsJson, $filtersJson, $currentDateTime, $currentDateTime)
			);
			$recordId = (int) $db->getLastInsertID();
		}

		return self::normalizeRow(self::getRawById($recordId, $userId, $moduleName));
	}

	public static function deleteForUserAndModule($recordId, $userId, $moduleName) {
		self::ensureTable();
		$db = PearDatabase::getInstance();
		$record = self::getRawById($recordId, $userId, $moduleName);
		if (!$record) {
			return false;
		}

		$db->pquery(
			'DELETE FROM '.self::TABLE_NAME.' WHERE id = ? AND userid = ? AND module_name = ?',
			array((int) $recordId, (int) $userId, $moduleName)
		);

		return true;
	}

	public static function decodeJsonValue($value) {
		if (empty($value) || is_array($value)) {
			return $value;
		}

		if (!is_string($value)) {
			return array();
		}

		$decodedValue = Zend_Json::decode(html_entity_decode($value));
		return is_array($decodedValue) ? $decodedValue : array();
	}

	protected static function ensureTable() {
		static $tableReady = false;
		if ($tableReady) {
			return;
		}

		$db = PearDatabase::getInstance();
		$db->pquery(
			'CREATE TABLE IF NOT EXISTS '.self::TABLE_NAME.' (
				id INT(19) NOT NULL AUTO_INCREMENT,
				userid INT(19) NOT NULL,
				module_name VARCHAR(100) NOT NULL,
				format_name VARCHAR(150) NOT NULL,
				filename VARCHAR(150) DEFAULT NULL,
				export_title VARCHAR(255) DEFAULT NULL,
				columnslist MEDIUMTEXT NOT NULL,
				advfilterlist MEDIUMTEXT NULL,
				createdtime DATETIME NOT NULL,
				modifiedtime DATETIME NOT NULL,
				PRIMARY KEY (id),
				UNIQUE KEY uniq_custom_export_format (userid, module_name, format_name),
				KEY idx_custom_export_user_module (userid, module_name)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8',
			array()
		);

		$tableReady = true;
	}

	protected static function getRawById($recordId, $userId, $moduleName) {
		$db = PearDatabase::getInstance();
		$result = $db->pquery(
			'SELECT * FROM '.self::TABLE_NAME.' WHERE id = ? AND userid = ? AND module_name = ?',
			array((int) $recordId, (int) $userId, $moduleName)
		);

		if ($db->num_rows($result) === 0) {
			return false;
		}

		return $db->fetchByAssoc($result, 0);
	}

	protected static function getRawByName($formatName, $userId, $moduleName) {
		$db = PearDatabase::getInstance();
		$result = $db->pquery(
			'SELECT * FROM '.self::TABLE_NAME.' WHERE userid = ? AND module_name = ? AND format_name = ?',
			array((int) $userId, $moduleName, $formatName)
		);

		if ($db->num_rows($result) === 0) {
			return false;
		}

		return $db->fetchByAssoc($result, 0);
	}

	protected static function normalizeRow($row) {
		if (!$row) {
			return array();
		}

		return array(
			'id' => (int) $row['id'],
			'userid' => (int) $row['userid'],
			'module_name' => $row['module_name'],
			'format_name' => decode_html($row['format_name']),
			'filename' => decode_html($row['filename']),
			'export_title' => decode_html($row['export_title']),
			'columnslist' => self::decodeJsonValue($row['columnslist']),
			'advfilterlist' => self::decodeJsonValue($row['advfilterlist']),
			'createdtime' => $row['createdtime'],
			'modifiedtime' => $row['modifiedtime'],
		);
	}

	protected static function sanitizeText($value, $maxLength) {
		$value = trim((string) $value);
		if ($value === '') {
			return '';
		}

		return substr($value, 0, $maxLength);
	}
}