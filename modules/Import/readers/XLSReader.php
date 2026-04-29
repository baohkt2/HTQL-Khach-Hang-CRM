<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

require_once 'libraries/PHPExcel/PHPExcel.php';

class Import_XLSReader_Reader extends Import_FileReader_Reader {

	/**
	 * Parsed sheet data cache (array of rows, each row is an array of cell values).
	 */
	private $sheetData = null;

	/**
	 * Load and cache all rows from the uploaded Excel file.
	 */
	protected function loadSheetData() {
		if ($this->sheetData !== null) {
			return $this->sheetData;
		}

		$filePath = Import_Utils_Helper::getImportFilePath($this->user);

		if (!file_exists($filePath)) {
			$this->sheetData = array();
			return $this->sheetData;
		}

		try {
			$objPHPExcel = PHPExcel_IOFactory::load($filePath);
		} catch (\Throwable $e) {
			error_log("XLSReader: Failed to load file $filePath: " . $e->getMessage());
			$this->sheetData = array();
			return $this->sheetData;
		}

		$sheet = $objPHPExcel->getActiveSheet();
		$highestRow    = $sheet->getHighestRow();
		$highestColumn = $sheet->getHighestColumn();
		$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

		$rows = array();
		for ($row = 1; $row <= $highestRow; $row++) {
			$rowData = array();
			for ($col = 0; $col < $highestColumnIndex; $col++) {
				$cell = $sheet->getCellByColumnAndRow($col, $row);
				$value = '';
				if ($cell !== null) {
					$dataType = $cell->getDataType();
					if ($dataType === PHPExcel_Cell_DataType::TYPE_NUMERIC
						&& PHPExcel_Shared_Date::isDateTime($cell)) {
						$value = PHPExcel_Style_NumberFormat::toFormattedString(
							$cell->getCalculatedValue(),
							'YYYY-MM-DD'
						);
					} else {
						$value = (string) $cell->getCalculatedValue();
					}
				}
				$rowData[] = trim($value);
			}
			// Skip entirely-empty rows
			if (count(array_filter($rowData, function($v) { return $v !== ''; })) > 0) {
				$rows[] = $rowData;
			}
		}

		$this->sheetData = $rows;
		return $this->sheetData;
	}

	/**
	 * Helper to combine header keys with values, handling duplicate column names.
	 */
	public function arrayCombine($keys, $values) {
		$combine = array();
		$dup     = array();
		for ($i = 0; $i < count($keys); $i++) {
			$key = $keys[$i];
			if (array_key_exists($key, $combine)) {
				if (!isset($dup[$key])) $dup[$key] = 1;
				$key = $key . '(' . (++$dup[$keys[$i]]) . ')';
			}
			$combine[$key] = isset($values[$i]) ? $values[$i] : '';
		}
		return $combine;
	}

	/**
	 * Returns the first row of data (used during field-mapping step).
	 */
	public function getFirstRowData($hasHeader = true) {
		$rows = $this->loadSheetData();

		if (empty($rows)) {
			return false;
		}

		if ($hasHeader) {
			$headers = isset($rows[0]) ? $rows[0] : array();
			$dataRow = isset($rows[1]) ? $rows[1] : array();

			$hCount = count($headers);
			$dCount = count($dataRow);
			if ($hCount > $dCount) {
				$dataRow = array_merge($dataRow, array_fill($dCount, $hCount - $dCount, ''));
			} elseif ($dCount > $hCount) {
				$dataRow = array_slice($dataRow, 0, $hCount);
			}

			return $this->arrayCombine($headers, $dataRow);
		} else {
			return isset($rows[0]) ? $rows[0] : false;
		}
	}

	/**
	 * Override createTable to use InnoDB with ROW_FORMAT=DYNAMIC.
	 * Excel files often have many columns (100+), which can exceed the
	 * MyISAM 65535-byte row size limit. InnoDB DYNAMIC stores overflow
	 * data off-page, avoiding this limitation.
	 */
	public function createTable() {
		$db = PearDatabase::getInstance();

		$tableName = Import_Utils_Helper::getDbTableName($this->user);
		$fieldMapping = $this->request->get('field_mapping');

		// Ensure field_mapping is an array
		if (!is_array($fieldMapping)) {
			$fieldMapping = Zend_Json::decode($fieldMapping);
		}

		$moduleFields = $this->moduleModel->getFields();
		$moduleImportableFields = $this->moduleModel->getAdditionalImportFields();
		$moduleFields = array_merge($moduleFields, $moduleImportableFields);

		$columnsListQuery = 'id INT PRIMARY KEY AUTO_INCREMENT, status INT DEFAULT 0, recordid INT';
		foreach ($fieldMapping as $fieldName => $index) {
			// Use TEXT for all staging columns to bypass MySQL's 65535 byte row size limit
			// which is easily exceeded when importing 100+ columns
			$columnsListQuery .= ', ' . $fieldName . ' TEXT';
		}

		// Use InnoDB with DYNAMIC row format to handle many columns
		$createTableQuery = 'CREATE TABLE ' . $tableName . ' (' . $columnsListQuery . ') ENGINE=InnoDB ROW_FORMAT=DYNAMIC';
		$result = $db->pquery($createTableQuery, array());
		if (!$result) {
			$this->status = 'failed';
			$this->errorMessage = 'ERR_CREATE_TABLE_FAILED';
			return false;
		}
		return true;
	}

	/**
	 * Read all data rows and insert them into the import staging table.
	 */
	public function read() {
		$status = $this->createTable();
		if (!$status) {
			return false;
		}

		$rows = $this->loadSheetData();

		$fieldMapping = $this->request->get('field_mapping');
		// Ensure field_mapping is an array (decode JSON string if needed)
		if (!is_array($fieldMapping)) {
			$fieldMapping = Zend_Json::decode($fieldMapping);
		}

		$dateFields = array();
		$moduleFields = $this->moduleModel->getFields();
		$moduleImportableFields = $this->moduleModel->getAdditionalImportFields();
		$moduleFields = array_merge($moduleFields, $moduleImportableFields);
		foreach ($moduleFields as $fieldName => $fieldModel) {
			$dataType = $fieldModel->getFieldDataType();
			if ($dataType == 'date' || $dataType == 'datetime') {
				$dateFields[$fieldName] = $dataType;
			}
		}

		$hasHeader = $this->hasHeader();
		$startRow  = $hasHeader ? 1 : 0;

		for ($i = $startRow; $i < count($rows); $i++) {
			$data           = $rows[$i];
			$mappedData     = array();
			$allValuesEmpty = true;

			foreach ($fieldMapping as $fieldName => $index) {
				$fieldValue = isset($data[$index]) ? $data[$index] : '';

				// Handle Excel Serial Dates if target field is a date/datetime field
				if (isset($dateFields[$fieldName]) && is_numeric($fieldValue) && $fieldValue !== '') {
					// Check if it's likely a serial date (numeric and doesn't contain date separators)
					if (strpos($fieldValue, '-') === false && strpos($fieldValue, '/') === false) {
						try {
							$timestamp = PHPExcel_Shared_Date::ExcelToPHP($fieldValue);
							if ($dateFields[$fieldName] == 'datetime') {
								$fieldValue = date('m/d/Y H:i:s', $timestamp);
							} else {
								$fieldValue = date('m/d/Y', $timestamp);
							}
						} catch (\Throwable $e) {
							// Fallback to original value if conversion fails
						}
					}
				}

				$mappedData[$fieldName] = $fieldValue;
				if ($fieldValue !== '') {
					$allValuesEmpty = false;
				}
			}

			if ($allValuesEmpty) {
				continue;
			}

			$fieldNames  = array_keys($mappedData);
			$fieldValues = array_values($mappedData);
			$this->addRecordToDB($fieldNames, $fieldValues);
		}
	}
}
?>
