<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Vtiger_ExportData_Action extends Vtiger_Mass_Action {

	var $moduleCall = false;
	public function requiresPermission(\Vtiger_Request $request) {
		$permissions = parent::requiresPermission($request);
		$permissions[] = array('module_parameter' => 'module', 'action' => 'Export');
        if (!empty($request->get('source_module'))) {
            $permissions[] = array('module_parameter' => 'source_module', 'action' => 'Export');
        }
		return $permissions;
	}

	/**
	 * Function is called by the controller
	 * @param Vtiger_Request $request
	 */
	function process(Vtiger_Request $request) {
		$this->ExportData($request);
	}

	private $moduleInstance;
	private $focus;
	private $exportFieldModels = array();

	/**
	 * Function exports the data based on the mode
	 * @param Vtiger_Request $request
	 */
	function ExportData(Vtiger_Request $request) {
		$db = PearDatabase::getInstance();
		$moduleName = $request->get('source_module');

		$this->moduleInstance = Vtiger_Module_Model::getInstance($moduleName);
		$this->moduleFieldInstances = $this->moduleFieldInstances($moduleName);
		$this->focus = CRMEntity::getInstance($moduleName);

		$query = $this->getExportQuery($request);
		$result = $db->pquery($query, array());

		$redirectedModules = array('Users', 'Calendar');
		if($request->getModule() != $moduleName && in_array($moduleName, $redirectedModules) && !$this->moduleCall){
			$handlerClass = Vtiger_Loader::getComponentClassName('Action', 'ExportData', $moduleName);
			$handler = new $handlerClass();
			$handler->ExportData($request);
			return;
		}
		$translatedHeaders = $this->getHeaders();
		$entries = array();
		for ($j = 0; $j < $db->num_rows($result); $j++) {
			$sanitizedRow = $this->sanitizeValues($db->fetchByAssoc($result, $j));
			$entries[] = $this->getRowValuesInHeaderOrder($sanitizedRow);
		}

		$this->output($request, $translatedHeaders, $entries);
	}

	public function getHeaders() {
		$headers = array();
		$this->exportFieldModels = array();
		//Query generator set this when generating the query
		if(!empty($this->accessibleFields)) {
			$accessiblePresenceValue = array(0,2);
			foreach($this->accessibleFields as $fieldName) {
				if (!isset($this->moduleFieldInstances[$fieldName])) {
					continue;
				}
				$fieldModel = $this->moduleFieldInstances[$fieldName];
				// Check added as querygenerator is not checking this for admin users
				$presence = $fieldModel->get('presence');
				if(in_array($presence, $accessiblePresenceValue) && $fieldModel->get('displaytype') != '6') {
					$headers[] = $fieldModel->get('label');
					$this->exportFieldModels[] = $fieldModel;
				}
			}
		} else {
			foreach($this->moduleFieldInstances as $field) {
				$headers[] = $field->get('label');
				$this->exportFieldModels[] = $field;
			}
		}

		$translatedHeaders = array();
		foreach($headers as $header) {
			$translatedHeaders[] = vtranslate(html_entity_decode($header, ENT_QUOTES), $this->moduleInstance->getName());
		}

		$translatedHeaders = array_map('decode_html', $translatedHeaders);
		return $translatedHeaders;
	}

	function getAdditionalQueryModules(){
		return array_merge(getInventoryModules(), array('Products', 'Services', 'PriceBooks'));
	}

	/**
	 * Function that generates Export Query based on the mode
	 * @param Vtiger_Request $request
	 * @return <String> export query
	 */
	function getExportQuery(Vtiger_Request $request) {
		$currentUser = Users_Record_Model::getCurrentUserModel();
		$mode = $request->getMode();
		$cvId = $request->get('viewname');
		$moduleName = $request->get('source_module');
		$exportFieldsMode = $request->get('export_fields_mode');
		$isCustomExport = (bool) $request->get('custom_export');

		$queryGenerator = new EnhancedQueryGenerator($moduleName, $currentUser);
		if (!$isCustomExport) {
			$queryGenerator->initForCustomViewById($cvId);
		}
		$fieldInstances = $this->moduleFieldInstances;

		$orderBy = $request->get('orderby');
		$orderByFieldModel = isset($fieldInstances[$orderBy]) ? $fieldInstances[$orderBy] : "";
		$sortOrder = $request->get('sortorder');

		if ($isCustomExport) {
			$customColumns = $this->decodeRequestArray($request->get('columnslist'));
			$customFieldNames = $this->getFieldNamesFromCustomViewColumns($customColumns);
			if (!empty($customFieldNames)) {
				$queryGenerator->setFields($customFieldNames);
			} else {
				$queryGenerator->setFields(array('id'));
			}

			$customFilterList = $this->decodeRequestArray($request->get('advfilterlist'));
			if (is_array($customFilterList) && php7_count($customFilterList) > 0) {
				$queryGenerator->parseAdvFilterList($customFilterList);
			}

			if ($orderBy && $orderByFieldModel) {
				if ($orderByFieldModel->getFieldDataType() == Vtiger_Field_Model::REFERENCE_TYPE || $orderByFieldModel->getFieldDataType() == Vtiger_Field_Model::OWNER_TYPE) {
					$queryGenerator->addWhereField($orderBy);
				}
			}
		} else if ($mode !== 'ExportAllData') {
			$operator = $request->get('operator');
			$searchKey = $request->get('search_key');
			$searchValue = $request->get('search_value');

			$tagParams = $request->get('tag_params');
			if (!$tagParams) {
				$tagParams = array();
			}

			$searchParams = $request->get('search_params');
			if (!$searchParams) {
				$searchParams = array();
			}

			$glue = '';
			if($searchParams && php7_count($queryGenerator->getWhereFields())) {
				$glue = QueryGenerator::$AND;
			}
			$searchParams = array_merge($searchParams, $tagParams);
			$searchParams = Vtiger_Util_Helper::transferListSearchParamsToFilterCondition($searchParams, $this->moduleInstance);
			$queryGenerator->parseAdvFilterList($searchParams, $glue);

			if($searchKey) {
				$queryGenerator->addUserSearchConditions(array('search_field' => $searchKey, 'search_text' => $searchValue, 'operator' => $operator));
			}

			if ($orderBy && $orderByFieldModel) {
				if ($orderByFieldModel->getFieldDataType() == Vtiger_Field_Model::REFERENCE_TYPE || $orderByFieldModel->getFieldDataType() == Vtiger_Field_Model::OWNER_TYPE) {
					$queryGenerator->addWhereField($orderBy);
				}
			}
		}

		/**
		 *  For Documents if we select any document folder and mass deleted it should delete documents related to that 
		 *  particular folder only
		 */
		if($moduleName == 'Documents'){
			$folderValue = $request->get('folder_value');
			if(!empty($folderValue)){
				 $queryGenerator->addCondition($request->get('folder_id'),$folderValue,'e');
			}
		}

		if (!$isCustomExport && $exportFieldsMode === 'all') {
			$allExportableFieldNames = $this->getAllExportableFieldNames();
			if (!empty($allExportableFieldNames)) {
				$queryGenerator->setFields($allExportableFieldNames);
			}
		}

		$query = $queryGenerator->getQuery();

		$additionalModules = $this->getAdditionalQueryModules();
		if(in_array($moduleName, $additionalModules)) {
			$query = $this->moduleInstance->getExportQuery($this->focus, $query);
		}

		$this->accessibleFields = $queryGenerator->getFields();

		switch($mode) {
			case 'ExportAllData'	:	if ($orderBy && $orderByFieldModel) {
											$query .= ' ORDER BY '.$queryGenerator->getOrderByColumn($orderBy).' '.$sortOrder;
										}
										break;

			case 'ExportCurrentPage' :	$pagingModel = new Vtiger_Paging_Model();
										$limit = $pagingModel->getPageLimit();

										$currentPage = $request->get('page');
										if(empty($currentPage)) $currentPage = 1;

										$currentPageStart = ($currentPage - 1) * $limit;
										if ($currentPageStart < 0) $currentPageStart = 0;

										if ($orderBy && $orderByFieldModel) {
											$query .= ' ORDER BY '.$queryGenerator->getOrderByColumn($orderBy).' '.$sortOrder;
										}
										$query .= ' LIMIT '.$currentPageStart.','.$limit;
										break;

			case 'ExportSelectedRecords' :	$idList = $this->getRecordsListFromRequest($request);
											$baseTable = $this->moduleInstance->get('basetable');
											$baseTableColumnId = $this->moduleInstance->get('basetableid');
											if(!empty($idList)) {
												if(!empty($baseTable) && !empty($baseTableColumnId)) {
													$idList = implode(',' , $idList);
													$query .= ' AND '.$baseTable.'.'.$baseTableColumnId.' IN ('.$idList.')';
												}
											} else {
												$query .= ' AND '.$baseTable.'.'.$baseTableColumnId.' NOT IN ('.implode(',',$request->get('excluded_ids')).')';
											}

											if ($orderBy && $orderByFieldModel) {
												$query .= ' ORDER BY '.$queryGenerator->getOrderByColumn($orderBy).' '.$sortOrder;
											}
											break;


			default :	break;
		}
		return $query;
	}

	/**
	 * Function returns the export type - This can be extended to support different file exports
	 * @param Vtiger_Request $request
	 * @return <String>
	 */
	function getExportContentType(Vtiger_Request $request) {
		$type = $request->get('export_type');
		if(empty($type)) {
			return 'text/csv';
		}
	}

	/**
	 * Function that create the exported file
	 * @param Vtiger_Request $request
	 * @param <Array> $headers - output file header
	 * @param <Array> $entries - outfput file data
	 */
	function output($request, $headers, $entries) {
		$moduleName = $request->get('source_module');
		$fileName = $this->getExportFileName($request, $moduleName);
		$currentUser = Users_Record_Model::getCurrentUserModel();
		
		$exportFormat = $request->get('export_format');

		if (in_array($exportFormat, array('xls', 'xlsx'))) {
			require_once("libraries/PHPExcel/PHPExcel.php");
	
			$workbook = new PHPExcel();
			$worksheet = $workbook->setActiveSheetIndex(0);
			$title = trim((string) $request->get('export_title'));
			$totalColumns = max(1, count($headers));
			
			$header_styles = array(
				'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'E1E0F7')),
				'font' => array('bold' => true)
			);
			$titleStyles = array(
				'font' => array('bold' => true, 'size' => 14),
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				),
			);

			$headerRow = 1;
			$dataRow = 2;
			if ($title !== '') {
				$headerRow = 2;
				$dataRow = 3;
				$worksheet->setCellValueExplicitByColumnAndRow(0, 1, decode_html($title), PHPExcel_Cell_DataType::TYPE_STRING);
				$lastTitleColumnIndex = max(0, count($headers) - 1);
				$worksheet->mergeCellsByColumnAndRow(0, 1, $lastTitleColumnIndex, 1);
				$worksheet->getStyleByColumnAndRow(0, 1)->applyFromArray($titleStyles);
				$worksheet->getRowDimension(1)->setRowHeight(24);
			}
	
			// Print Headers
			$colCount = 0;
			foreach($headers as $header) {
				$worksheet->setCellValueExplicitByColumnAndRow($colCount, $headerRow, decode_html($header), PHPExcel_Cell_DataType::TYPE_STRING);
				$worksheet->getStyleByColumnAndRow($colCount, $headerRow)->applyFromArray($header_styles);
				$colCount++;
			}
	
			// Print Entries
			$rowCount = $dataRow;
			foreach($entries as $row) {
				$colCount = 0;
				foreach($row as $value) {
					$worksheet->setCellValueExplicitByColumnAndRow($colCount, $rowCount, decode_html($value), PHPExcel_Cell_DataType::TYPE_STRING);
					$colCount++;
				}
				$rowCount++;
			}

			$footerStyles = array(
				'font' => array('bold' => true),
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					'wrap' => true,
				),
			);
			$footerRow = $rowCount + 2;
			$exportUserName = trim($currentUser->get('first_name').' '.$currentUser->get('last_name'));
			if ($exportUserName === '') {
				$exportUserName = trim((string) $currentUser->get('user_name'));
			}
			$field1Text = 'Ngày '.date('d/m/Y')."\nNGƯỜI LẬP\n\n\n\n".$exportUserName;
			$field2Text = "Ngày .../.../...\nBP ĐÀO TẠO\n\n\n\nTrương Xuân Việt";

			if ($totalColumns >= 5) {
				$field1StartColumn = 1;
				$field1EndColumn = 2;
				$field2StartColumn = $totalColumns - 3;
				$field2EndColumn = $totalColumns - 2;
			} else if ($totalColumns == 1) {
				$field1StartColumn = 0;
				$field1EndColumn = 0;
				$field2StartColumn = -1;
				$field2EndColumn = -1;
			} else {
				$field1StartColumn = 0;
				$field1EndColumn = 0;
				$field2StartColumn = ($totalColumns > 2) ? ($totalColumns - 2) : ($totalColumns - 1);
				$field2EndColumn = $field2StartColumn;
			}

			$worksheet->setCellValueExplicitByColumnAndRow($field1StartColumn, $footerRow, $field1Text, PHPExcel_Cell_DataType::TYPE_STRING);
			if ($field1EndColumn > $field1StartColumn) {
				$worksheet->mergeCellsByColumnAndRow($field1StartColumn, $footerRow, $field1EndColumn, $footerRow);
			}
			$worksheet->getStyleByColumnAndRow($field1StartColumn, $footerRow)->applyFromArray($footerStyles);
			$worksheet->getRowDimension($footerRow)->setRowHeight(110);

			if ($field2StartColumn >= 0) {
				$worksheet->setCellValueExplicitByColumnAndRow($field2StartColumn, $footerRow, $field2Text, PHPExcel_Cell_DataType::TYPE_STRING);
				if ($field2EndColumn > $field2StartColumn) {
					$worksheet->mergeCellsByColumnAndRow($field2StartColumn, $footerRow, $field2EndColumn, $footerRow);
				}
				$worksheet->getStyleByColumnAndRow($field2StartColumn, $footerRow)->applyFromArray($footerStyles);
			}

			if ($exportFormat === 'xlsx' && !class_exists('ZipArchive')) {
				PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
			}

			$extension = ($exportFormat === 'xlsx') ? 'xlsx' : 'xls';
			$contentType = ($exportFormat === 'xlsx')
				? 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
				: 'application/vnd.ms-excel';
			$writerType = ($exportFormat === 'xlsx') ? 'Excel2007' : 'Excel5';

			header("Content-Disposition:attachment;filename=$fileName.$extension");
			header("Content-Type:$contentType;charset=UTF-8");
			header("Expires: Mon, 31 Dec 2000 00:00:00 GMT" );
			header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT" );
			header("Cache-Control: post-check=0, pre-check=0", false );
	
			ob_clean();
			
			$workbookWriter = PHPExcel_IOFactory::createWriter($workbook, $writerType);
			$workbookWriter->save('php://output');
		} else {
			$exportType = $this->getExportContentType($request);
	
			header("Content-Disposition:attachment;filename=$fileName.csv");
			header("Content-Type:$exportType;charset=UTF-8");
			header("Expires: Mon, 31 Dec 2000 00:00:00 GMT" );
			header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT" );
			header("Cache-Control: post-check=0, pre-check=0", false );
	
			ob_clean();
			$fp = fopen("php://output", "a+");
			fputcsv($fp, Vtiger_Functions::sanitizeForCSVExport($headers));	
	
			foreach($entries as $row) {
				fputcsv($fp, Vtiger_Functions::sanitizeForCSVExport($row));
			}
		}
	}

	private $picklistValues;
	private $fieldArray;
	private $fieldDataTypeCache = array();
	/**
	 * this function takes in an array of values for an user and sanitizes it for export
	 * @param array $arr - the array of values
	 */
	function sanitizeValues($arr){
		$db = PearDatabase::getInstance();
		$currentUser = Users_Record_Model::getCurrentUserModel();
		$roleid = $currentUser->get('roleid');
		if(empty ($this->fieldArray)){
			$this->fieldArray = $this->moduleFieldInstances;
			foreach($this->fieldArray as $fieldName => $fieldObj){
				//In database we have same column name in two tables. - inventory modules only
				if($fieldObj->get('table') == 'vtiger_inventoryproductrel' && ($fieldName == 'discount_amount' || $fieldName == 'discount_percent')){
					$fieldName = 'item_'.$fieldName;
					$this->fieldArray[$fieldName] = $fieldObj;
				} else {
					$columnName = $fieldObj->get('column');
					$this->fieldArray[$columnName] = $fieldObj;
				}
			}
		}
		$moduleName = $this->moduleInstance->getName();
		foreach($arr as $fieldName=>&$value){
			if(isset($this->fieldArray[$fieldName])){
				$fieldInfo = $this->fieldArray[$fieldName];
			}else {
				unset($arr[$fieldName]);
				continue;
			}
			//Track if the value had quotes at beginning
			if (is_string($value)) {
				$beginsWithDoubleQuote = strpos($value, '"') === 0;
				$endsWithDoubleQuote = substr($value,-1) === '"'?1:0;
				$value = trim($value,"\"");
			}

			$uitype = $fieldInfo->get('uitype');
			$fieldname = $fieldInfo->get('name');

			if(!isset($this->fieldDataTypeCache[$fieldName])) {
				$this->fieldDataTypeCache[$fieldName] = $fieldInfo->getFieldDataType();
			}
			$type = $this->fieldDataTypeCache[$fieldName];

			//Restore double quote now.
			if ($beginsWithDoubleQuote) $value = "\"{$value}";
			if($endsWithDoubleQuote) $value = "{$value}\"";
			if($fieldname != 'hdnTaxType' && ($uitype == 15 || $uitype == 16 || $uitype == 33)){
				if(empty($this->picklistValues[$fieldname])){
					$this->picklistValues[$fieldname] = $this->fieldArray[$fieldname]->getPicklistValues();
				}
				// If the value being exported is accessible to current user
				// or the picklist is multiselect type.
				if($uitype == 33 || $uitype == 16 || array_key_exists($value,$this->picklistValues[$fieldname])){
					// NOTE: multipicklist (uitype=33) values will be concatenated with |# delim
					$value = trim($value);
				} else {
					$value = '';
				}
			} elseif($uitype == 52 || $type == 'owner') {
				$value = Vtiger_Util_Helper::getOwnerName($value);
			}elseif($type == 'reference'){
				$value = isset($value) && $value ? trim($value) :'';
				if(!empty($value)) {
					$parent_module = getSalesEntityType($value);
					$displayValueArray = getEntityName($parent_module, $value);
					if(!empty($displayValueArray)){
						foreach($displayValueArray as $k=>$v){
							$displayValue = $v;
						}
					}
					if(!empty($parent_module) && !empty($displayValue)){
						$value = $parent_module."::::".$displayValue;
					}else{
						$value = "";
					}
				} else {
					$value = '';
				}
			} elseif($uitype == 72 || $uitype == 71) {
                $value = CurrencyField::convertToUserFormat($value, null, true, true);
			} elseif($uitype == 7 && $fieldInfo->get('typeofdata') == 'N~O' || $uitype == 9){
				$value = decimalFormat($value);
			} elseif($type == 'date') {
				if ($value && $value != '0000-00-00') {
					$value = DateTimeField::convertToUserFormat($value);
				}
			} /**
			*  Handled Conversion of time as per custom field time format in exported file
			*/
			elseif($uitype == 14) {
			   $timeUIObj = new Vtiger_Time_UIType();
			   $value = $timeUIObj->getDisplayValue($value);
		   }elseif($type == 'datetime') {
				if ($moduleName == 'Calendar' && in_array($fieldName, array('date_start', 'due_date'))) {
					$timeField = 'time_start';
					if ($fieldName === 'due_date') {
						$timeField = 'time_end';
					}
					$value = $value.' '.$arr[$timeField];
				}
				if (trim($value) && $value != '0000-00-00 00:00:00') {
					$value = Vtiger_Datetime_UIType::getDisplayDateTimeValue($value);
				}
			}
			if($moduleName == 'Documents' && $fieldname == 'description'){
				$value = strip_tags($value);
				$value = str_replace('&nbsp;','',$value);
				array_push($new_arr,$value);
			}
		}
		return $arr;
	}

	private function getAllExportableFieldNames() {
		$allExportableFieldNames = array();
		$accessiblePresenceValue = array(0,2);

		foreach($this->moduleFieldInstances as $field) {
			$presence = $field->get('presence');
			if(in_array($presence, $accessiblePresenceValue) && $field->get('displaytype') != '6') {
				$allExportableFieldNames[] = $field->getName();
			}
		}

		return $allExportableFieldNames;
	}

	private function getRowValuesInHeaderOrder($row) {
		if (empty($this->exportFieldModels)) {
			return array_values($row);
		}

		$orderedRow = array();
		foreach ($this->exportFieldModels as $fieldModel) {
			$fieldName = $fieldModel->getName();
			$columnName = $fieldModel->get('column');

			if($fieldModel->get('table') == 'vtiger_inventoryproductrel' && ($fieldName == 'discount_amount' || $fieldName == 'discount_percent')) {
				$columnName = 'item_'.$fieldName;
			}

			if (array_key_exists($columnName, $row)) {
				$orderedRow[] = $row[$columnName];
			} elseif (array_key_exists($fieldName, $row)) {
				$orderedRow[] = $row[$fieldName];
			} else {
				$orderedRow[] = '';
			}
		}

		return $orderedRow;
	}

	public function moduleFieldInstances($moduleName) {
		$moduleFields = $this->moduleInstance->getFields();
		$recordStructureModel = Vtiger_RecordStructure_Model::getInstanceForModule($this->moduleInstance, Vtiger_RecordStructure_Model::RECORD_STRUCTURE_MODE_FILTER);
		$recordStructure = $recordStructureModel->getStructure();

		foreach ($recordStructure as $blockFields) {
			foreach ($blockFields as $fieldName => $fieldModel) {
				$moduleFields[$fieldName] = $fieldModel;
			}
		}

		if ($moduleName == 'Calendar') {
			$eventModuleModel = Vtiger_Module_Model::getInstance('Events');
			$eventRecordStructureModel = Vtiger_RecordStructure_Model::getInstanceForModule($eventModuleModel, Vtiger_RecordStructure_Model::RECORD_STRUCTURE_MODE_FILTER);
			$eventRecordStructure = $eventRecordStructureModel->getStructure();
			foreach ($eventRecordStructure as $blockFields) {
				foreach ($blockFields as $fieldName => $fieldModel) {
					$moduleFields[$fieldName] = $fieldModel;
				}
			}
		}

		return $moduleFields;
	}

	private function getFieldNamesFromCustomViewColumns($columnsList) {
		if (empty($columnsList)) {
			return array();
		}

		if (!is_array($columnsList)) {
			return array();
		}

		$fieldNames = array();
		foreach ($columnsList as $columnInfo) {
			$columnInfo = decode_html($columnInfo);
			$columnParts = explode(':', $columnInfo);
			if (empty($columnParts[2]) && $columnParts[1] == 'crmid' && $columnParts[0] == 'vtiger_crmentity') {
				$fieldName = 'id';
			} else {
				$fieldName = $columnParts[2];
			}

			if (isset($this->moduleFieldInstances[$fieldName])) {
				$fieldNames[] = $fieldName;
			}
		}

		return array_values(array_unique($fieldNames));
	}

	private function decodeRequestArray($value) {
		if (empty($value) || is_array($value)) {
			return $value;
		}

		if (!is_string($value)) {
			return array();
		}

		$decodedValue = Zend_Json::decode(html_entity_decode($value));
		return is_array($decodedValue) ? $decodedValue : array();
	}

	private function getExportFileName(Vtiger_Request $request, $moduleName) {
		$fileName = $request->get('filename');
		if (empty($fileName)) {
			$fileName = decode_html(vtranslate($moduleName, $moduleName));
		}

		$fileName = decode_html($fileName);
		$fileName = preg_replace('/\.(csv|xls|xlsx)$/i', '', $fileName);
		$fileName = preg_replace('/[^A-Za-z0-9 _.-]/', '_', $fileName);
		$fileName = preg_replace('/\s+/', '_', trim($fileName));
		$fileName = str_replace(',', '_', $fileName);

		if ($fileName === '') {
			$fileName = str_replace(' ', '_', decode_html(vtranslate($moduleName, $moduleName)));
		}

		return $fileName;
	}
}
