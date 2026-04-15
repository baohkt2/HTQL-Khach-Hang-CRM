<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Reports_Detail_View extends Vtiger_Index_View {

	protected $reportData;
	protected $calculationFields;
	protected $advancedCalculationFields;
	protected $count;

	public function requiresPermission(\Vtiger_Request $request) {
		$permissions = parent::requiresPermission($request);
		$permissions[] = array('module_parameter' => 'module', 'action' => 'DetailView', 'record_parameter' => 'record');
		return $permissions;
	}
	
	public function checkPermission(Vtiger_Request $request) {
		parent::checkPermission($request);
		$record = $request->get('record');
		$reportModel = Reports_Record_Model::getCleanInstance($record);
		$currentUserPriviligesModel = Users_Privileges_Model::getCurrentUserPrivilegesModel();

		$owner = $reportModel->get('owner');
		$sharingType = $reportModel->get('sharingtype');

		$isRecordShared = true;
		if(($currentUserPriviligesModel->id != $owner) && $sharingType == "Private"){
			$isRecordShared = $reportModel->isRecordHasViewAccess($sharingType);
		}
		if(!$isRecordShared) {
			throw new AppException(vtranslate('LBL_PERMISSION_DENIED'));
		}
		return true;
	}

	const REPORT_LIMIT = 500;

	function preProcess(Vtiger_Request $request, $display=true) {
		$viewer = $this->getViewer($request);
		$moduleName = $request->getModule();
		$recordId = $request->get('record');
		$detailViewModel = Reports_DetailView_Model::getInstance($moduleName, $recordId);
		$reportModel = $detailViewModel->getRecord();
		$viewer->assign('REPORT_NAME', $reportModel->getName());
		parent::preProcess($request);

		$page = $request->get('page');
		$reportModel->setModule('Reports');

		$pagingModel = new Vtiger_Paging_Model();
		$pagingModel->set('page', $page);
		$pagingModel->set('limit', self::REPORT_LIMIT);

		$reportData = $reportModel->getReportData($pagingModel);
		$this->reportData = isset($reportData['data']) ? $reportData['data'] : '';
		$this->calculationFields = $reportModel->getReportCalulationData();
		$this->advancedCalculationFields = $reportModel->getAdvancedCalculationData();

		$this->count = $reportData['count'];

		$primaryModule = $reportModel->getPrimaryModule();
		$secondaryModules = $reportModel->getSecondaryModules();
        $modulesList = array($primaryModule);
        if(!empty($secondaryModules)){
            if(stripos($secondaryModules, ':') >= 0){
                $secmodules = explode(':', $secondaryModules);
                $modulesList = array_merge($modulesList, $secmodules);
            }else{
                array_push($modulesList, $secondaryModules);
            }
        }
		$currentUser = Users_Record_Model::getCurrentUserModel();
		$userPrivilegesModel = Users_Privileges_Model::getInstanceById($currentUser->getId());
        foreach ($modulesList as $checkModule) {
            $moduleInstance = Vtiger_Module_Model::getInstance($checkModule);
            $permission = $userPrivilegesModel->hasModulePermission($moduleInstance->getId());
            if(!$permission) {
                $viewer->assign('MODULE', $primaryModule);
                $viewer->assign('MESSAGE', vtranslate('LBL_PERMISSION_DENIED'));
                $viewer->view('OperationNotPermitted.tpl', $primaryModule);
                exit;
            }
        }

		$detailViewLinks = $detailViewModel->getDetailViewLinks();

		// Advanced filter conditions
		$viewer->assign('SELECTED_ADVANCED_FILTER_FIELDS', $reportModel->transformToNewAdvancedFilter());
		$viewer->assign('PRIMARY_MODULE', $primaryModule);

		$recordStructureInstance = Vtiger_RecordStructure_Model::getInstanceFromRecordModel($reportModel);
		$primaryModuleRecordStructure = $recordStructureInstance->getPrimaryModuleRecordStructure();
		$secondaryModuleRecordStructures = $recordStructureInstance->getSecondaryModuleRecordStructure();

		//TODO : We need to remove "update_log" field from "HelpDesk" module in New Look
		// after removing old look we need to remove this field from crm
		if($primaryModule == 'HelpDesk'){
			foreach($primaryModuleRecordStructure as $blockLabel => $blockFields){
				foreach($blockFields as $field => $object){
					if($field == 'update_log'){
						unset($primaryModuleRecordStructure[$blockLabel][$field]);
					}
				}
			}
		}
		if(!empty($secondaryModuleRecordStructures)){
			foreach($secondaryModuleRecordStructures as $module => $structure){
				if($module == 'HelpDesk'){
					foreach($structure as $blockLabel => $blockFields){
						foreach($blockFields as $field => $object){
							if($field == 'update_log'){
								unset($secondaryModuleRecordStructures[$module][$blockLabel][$field]);
							}
						}
					}
				}
			}
		}
		// End

		$viewer->assign('PRIMARY_MODULE_RECORD_STRUCTURE', $primaryModuleRecordStructure);
		$viewer->assign('SECONDARY_MODULE_RECORD_STRUCTURES', $secondaryModuleRecordStructures);

		$secondaryModuleIsCalendar = strpos($secondaryModules, 'Calendar');
		if(($primaryModule == 'Calendar') || ($secondaryModuleIsCalendar !== FALSE)){
			$advanceFilterOpsByFieldType = Calendar_Field_Model::getAdvancedFilterOpsByFieldType();
		} else{
			$advanceFilterOpsByFieldType = Vtiger_Field_Model::getAdvancedFilterOpsByFieldType();
		}
		$viewer->assign('ADVANCED_FILTER_OPTIONS', Vtiger_Field_Model::getAdvancedFilterOptions());
		$viewer->assign('ADVANCED_FILTER_OPTIONS_BY_TYPE', $advanceFilterOpsByFieldType);
		$dateFilters = Vtiger_Field_Model::getDateFilterTypes();
		foreach($dateFilters as $comparatorKey => $comparatorInfo) {
			$comparatorInfo['startdate'] = DateTimeField::convertToUserFormat($comparatorInfo['startdate']);
			$comparatorInfo['enddate'] = DateTimeField::convertToUserFormat($comparatorInfo['enddate']);
			if (isset($module)) {
				$comparatorInfo['label'] = vtranslate($comparatorInfo['label'],$module);
			}
			$dateFilters[$comparatorKey] = $comparatorInfo;
		}
		$viewer->assign('DATE_FILTERS', $dateFilters);
		$viewer->assign('LINEITEM_FIELD_IN_CALCULATION', $reportModel->showLineItemFieldsInFilter(false));
		$viewer->assign('DETAILVIEW_LINKS', $detailViewLinks);
		$viewer->assign('DETAILVIEW_ACTIONS', $detailViewModel->getDetailViewActions());
		$viewer->assign('REPORT_MODEL', $reportModel);
		$viewer->assign('RECORD_ID', $recordId);
		$viewer->assign('COUNT',$this->count);
		$viewer->assign('REPORT_LIMIT',self::REPORT_LIMIT);
		$viewer->assign('MODULE', $moduleName);
		$viewer->view('ReportHeader.tpl', $moduleName);
	}

	function process(Vtiger_Request $request) {
		$recordId = $request->get('record');
		if (!empty($recordId)) {
			$reportModel = Reports_Record_Model::getInstanceById($recordId);
			$reportModel->setModule('Reports');
			if ($reportModel->get('reporttype') === 'cusc_followup_stats') {
				$mode = $request->get('mode');
				if ($mode === 'ExportCSV' || $mode === 'ExportXLS') {
					$this->exportCuscFollowupStats($request, $mode);
					return;
				}
			}
		}

		$mode = $request->getMode();
		if(!empty($mode)) {
			$this->invokeExposedMethod($mode, $request);
			return;
		}
		echo $this->getReport($request);
	}

	function getReport(Vtiger_Request $request) {
		$viewer = $this->getViewer($request);
		$moduleName = $request->getModule();

		$record = $request->get('record');
		$page = $request->get('page');

		// CUSC custom report: render custom UI regardless of default report data.
		if (!empty($record)) {
			$reportModel = Reports_Record_Model::getInstanceById($record);
			$reportModel->setModule('Reports');
			if ($reportModel->get('reporttype') === 'cusc_followup_stats') {
				$this->renderCuscFollowupStats($request, $reportModel);
				return;
			}
		}

		$data = $this->reportData;
		$calculation = $this->calculationFields;
		$advancedCalculation = $this->advancedCalculationFields;

		$pagingModel = new Vtiger_Paging_Model();
		$pagingModel->set('page', $page);
		$pagingModel->set('limit', self::REPORT_LIMIT+1);

		if(empty($data)){
			$reportModel = Reports_Record_Model::getInstanceById($record);
			$reportModel->setModule('Reports');
			$reportType = $reportModel->get('reporttype');

			$reportData = $reportModel->getReportData($pagingModel);
			$data = isset($reportData['data']) ? $reportData['data'] : '';
			$this->count = $reportData['count'];
			$calculation = $reportModel->getReportCalulationData();
			$advancedCalculation = $reportModel->getAdvancedCalculationData();
		}

		$viewer->assign('CALCULATION_FIELDS',$calculation);
		$viewer->assign('ADVANCED_CALCULATION_FIELDS',$advancedCalculation);
		$viewer->assign('DATA', $data);
		$viewer->assign('RECORD_ID', $record);
		$viewer->assign('PAGING_MODEL', $pagingModel);
		$viewer->assign('COUNT', $this->count);
		$viewer->assign('MODULE', $moduleName);
		$viewer->assign('REPORT_RUN_INSTANCE', ReportRun::getInstance($record));
		if (php7_count($data) > self::REPORT_LIMIT) {
			$viewer->assign('LIMIT_EXCEEDED', true);
		}

		$viewer->view('ReportContents.tpl', $moduleName);
	}

	/**
	 * Optimized follow-up stats report (CUSC custom).
	 */
	protected function getCuscFollowupStatuses() {
		$db = PearDatabase::getInstance();
		$values = array();
		$seen = array();
		$result = $db->pquery(
			'SELECT cf_2050 AS value, sortorderid, presence FROM vtiger_cf_2050 ORDER BY sortorderid',
			array()
		);
		for ($i = 0; $i < $db->num_rows($result); $i++) {
			$value = decode_html((string) $db->query_result($result, $i, 'value'));
			$presence = (int) $db->query_result($result, $i, 'presence');
			if ($presence === 1 && $value !== '') {
				if (!isset($seen[$value])) {
					$values[] = $value;
					$seen[$value] = true;
				}
			}
		}
		return $values;
	}

	protected function getCuscActiveUsers() {
		$db = PearDatabase::getInstance();
		$users = array();
		$result = $db->pquery(
			"SELECT id, user_name, first_name, last_name FROM vtiger_users WHERE deleted = 0 AND status = 'Active' ORDER BY first_name, last_name, user_name",
			array()
		);
		for ($i = 0; $i < $db->num_rows($result); $i++) {
			$id = (int) $db->query_result($result, $i, 'id');
			$first = trim(decode_html((string) $db->query_result($result, $i, 'first_name')));
			$last = trim(decode_html((string) $db->query_result($result, $i, 'last_name')));
			$userName = trim(decode_html((string) $db->query_result($result, $i, 'user_name')));
			$label = trim($last . ' ' . $first);
			if ($label === '') $label = $userName;
			$users[$id] = $label;
		}
		return $users;
	}

	protected function isValidDateYmd($value) {
		return preg_match('/^\d{4}-\d{2}-\d{2}$/', (string) $value) === 1;
	}

	protected function getCuscFollowupStats($from, $to, $userId, array $statuses, array $users) {
		$db = PearDatabase::getInstance();

		$colsRes = $db->pquery(
			"SELECT fieldname, columnname FROM vtiger_field WHERE tabid = (SELECT tabid FROM vtiger_tab WHERE name='Contacts') AND fieldname IN (?,?)",
			array('last_follow_user', 'last_follow_date')
		);
		$lastUserCol = '';
		$lastDateCol = '';
		for ($i = 0; $i < $db->num_rows($colsRes); $i++) {
			$fn = (string) $db->query_result($colsRes, $i, 'fieldname');
			$cn = (string) $db->query_result($colsRes, $i, 'columnname');
			if ($fn === 'last_follow_user') $lastUserCol = $cn;
			if ($fn === 'last_follow_date') $lastDateCol = $cn;
		}
		if ($lastUserCol === '' || $lastDateCol === '') {
			// Safety fallback (should not happen)
			$lastUserCol = 'last_follow_user';
			$lastDateCol = 'last_follow_date';
		}

		$sql = "SELECT CAST(scf.{$lastUserCol} AS UNSIGNED) AS user_id,
				       scf.status AS status,
				       COUNT(*) AS total
				  FROM vtiger_contactscf scf
				  INNER JOIN vtiger_crmentity ce ON ce.crmid = scf.contactid AND ce.deleted = 0 AND ce.setype = 'Contacts'
				 WHERE scf.{$lastUserCol} IS NOT NULL
				   AND TRIM(scf.{$lastUserCol}) != ''
				   AND scf.{$lastUserCol} != '0'
				   AND scf.{$lastDateCol} IS NOT NULL
				   AND scf.{$lastDateCol} != '0000-00-00'
				   AND scf.{$lastDateCol} >= ?
				   AND scf.{$lastDateCol} <= ?
				   AND scf.status IS NOT NULL
				   AND TRIM(scf.status) != ''";
		$params = array($from, $to);
		if ($userId !== '') {
			$sql .= " AND CAST(scf.{$lastUserCol} AS UNSIGNED) = ?";
			$params[] = (int) $userId;
		}
		$sql .= " GROUP BY CAST(scf.{$lastUserCol} AS UNSIGNED), scf.status";

		$result = $db->pquery($sql, $params);

		$rowsByUser = array();
		$totals = array('user_label' => 'Tổng', 'total' => 0, 'statuses' => array());
		foreach ($statuses as $st) $totals['statuses'][$st] = 0;

		for ($i = 0; $i < $db->num_rows($result); $i++) {
			$uid = (int) $db->query_result($result, $i, 'user_id');
			$status = decode_html((string) $db->query_result($result, $i, 'status'));
			$count = (int) $db->query_result($result, $i, 'total');
			if ($uid <= 0) continue;

			if (!isset($rowsByUser[$uid])) {
				$rowsByUser[$uid] = array(
					'user_id' => $uid,
					'user_label' => isset($users[$uid]) ? $users[$uid] : ('User #' . $uid),
					'total' => 0,
					'statuses' => array(),
				);
				foreach ($statuses as $st) $rowsByUser[$uid]['statuses'][$st] = 0;
			}

			$rowsByUser[$uid]['total'] += $count;
			if (isset($rowsByUser[$uid]['statuses'][$status])) {
				$rowsByUser[$uid]['statuses'][$status] += $count;
			} else {
				$rowsByUser[$uid]['statuses'][$status] = $count;
				if (!isset($totals['statuses'][$status])) $totals['statuses'][$status] = 0;
			}

			$totals['total'] += $count;
			$totals['statuses'][$status] = (int)$totals['statuses'][$status] + $count;
		}

		$rows = array_values($rowsByUser);
		usort($rows, function ($a, $b) {
			$ta = (int)$a['total']; $tb = (int)$b['total'];
			if ($ta === $tb) return strcmp((string)$a['user_label'], (string)$b['user_label']);
			return ($ta < $tb) ? 1 : -1;
		});

		return array($rows, $totals);
	}

	protected function renderCuscFollowupStats(Vtiger_Request $request, $reportModel) {
		$viewer = $this->getViewer($request);
		$moduleName = $request->getModule();

		$from = trim((string) $request->get('from', ''));
		$to = trim((string) $request->get('to', ''));
		$userId = trim((string) $request->get('user_id', ''));

		$users = $this->getCuscActiveUsers();
		$statuses = $this->getCuscFollowupStatuses();

		$error = '';
		$rows = array();
		$totalsRow = array();
		if ($from === '' || $to === '') {
			$error = 'Vui lòng chọn khoảng thời gian (Từ ngày/Đến ngày).';
		} else if (!$this->isValidDateYmd($from) || !$this->isValidDateYmd($to)) {
			$error = 'Định dạng ngày không hợp lệ. Vui lòng dùng YYYY-MM-DD.';
		} else {
			list($rows, $totalsRow) = $this->getCuscFollowupStats($from, $to, $userId, $statuses, $users);
		}

		$viewer->assign('REPORT_MODEL', $reportModel);
		$viewer->assign('RECORD_ID', $request->get('record'));
		$viewer->assign('FILTER_FROM', $from);
		$viewer->assign('FILTER_TO', $to);
		$viewer->assign('FILTER_USER_ID', $userId);
		$viewer->assign('USERS', $users);
		$viewer->assign('STATUSES', $statuses);
		$viewer->assign('ERROR', $error);
		$viewer->assign('ROWS', $rows);
		$viewer->assign('TOTALS', $totalsRow);
		$viewer->assign('MODULE', $moduleName);

		$viewer->view('CuscFollowupStats.tpl', $moduleName);
	}

	protected function exportCuscFollowupStats(Vtiger_Request $request, $mode) {
		$from = trim((string) $request->get('from', ''));
		$to = trim((string) $request->get('to', ''));
		$userId = trim((string) $request->get('user_id', ''));

		if ($from === '' || $to === '' || !$this->isValidDateYmd($from) || !$this->isValidDateYmd($to)) {
			header('Content-Type: text/plain; charset=UTF-8');
			echo "Thiếu hoặc sai bộ lọc ngày (from/to).";
			return;
		}

		$users = $this->getCuscActiveUsers();
		$statuses = $this->getCuscFollowupStatuses();
		list($rows, $totalsRow) = $this->getCuscFollowupStats($from, $to, $userId, $statuses, $users);

		$filenameBase = 'bao-cao-theo-doi-lien-he_' . $from . '_' . $to;

		if ($mode === 'ExportCSV') {
			header('Content-Type: text/csv; charset=UTF-8');
			header('Content-Disposition: attachment; filename="' . $filenameBase . '.csv"');

			$out = fopen('php://output', 'w');
			fwrite($out, "\xEF\xBB\xBF");
			fputcsv($out, array_merge(array('Tài khoản', 'Tổng'), $statuses));
			foreach ($rows as $row) {
				$line = array($row['user_label'], (int)$row['total']);
				foreach ($statuses as $st) $line[] = isset($row['statuses'][$st]) ? (int)$row['statuses'][$st] : 0;
				fputcsv($out, $line);
			}
			$totalLine = array($totalsRow['user_label'], (int)$totalsRow['total']);
			foreach ($statuses as $st) $totalLine[] = isset($totalsRow['statuses'][$st]) ? (int)$totalsRow['statuses'][$st] : 0;
			fputcsv($out, $totalLine);
			fclose($out);
			return;
		}

		require_once 'libraries/PHPExcel/PHPExcel.php';

		$workbook = new PHPExcel();
		$worksheet = $workbook->setActiveSheetIndex(0);
		$worksheet->setTitle('Thong ke theo doi');

		$headers = array_merge(array('Tài khoản', 'Tổng'), $statuses);
		$headerStyle = array(
			'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'E1E0F7')),
			'font' => array('bold' => true),
		);
		$totalStyle = array('font' => array('bold' => true));

		$col = 0;
		foreach ($headers as $header) {
			$worksheet->setCellValueExplicitByColumnAndRow($col, 1, decode_html($header), PHPExcel_Cell_DataType::TYPE_STRING);
			$worksheet->getStyleByColumnAndRow($col, 1)->applyFromArray($headerStyle);
			$col++;
		}

		$rowIndex = 2;
		foreach ($rows as $row) {
			$col = 0;
			$worksheet->setCellValueExplicitByColumnAndRow($col++, $rowIndex, decode_html($row['user_label']), PHPExcel_Cell_DataType::TYPE_STRING);
			$worksheet->setCellValueByColumnAndRow($col++, $rowIndex, (int) $row['total']);
			foreach ($statuses as $st) {
				$worksheet->setCellValueByColumnAndRow($col++, $rowIndex, isset($row['statuses'][$st]) ? (int) $row['statuses'][$st] : 0);
			}
			$rowIndex++;
		}

		$col = 0;
		$worksheet->setCellValueExplicitByColumnAndRow($col++, $rowIndex, decode_html($totalsRow['user_label']), PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueByColumnAndRow($col++, $rowIndex, (int) $totalsRow['total']);
		foreach ($statuses as $st) {
			$worksheet->setCellValueByColumnAndRow($col++, $rowIndex, isset($totalsRow['statuses'][$st]) ? (int) $totalsRow['statuses'][$st] : 0);
		}
		$worksheet->getStyle("A{$rowIndex}:" . PHPExcel_Cell::stringFromColumnIndex(count($headers) - 1) . $rowIndex)->applyFromArray($totalStyle);

		for ($i = 0; $i < count($headers); $i++) {
			$worksheet->getColumnDimension(PHPExcel_Cell::stringFromColumnIndex($i))->setAutoSize(true);
		}

		if (!class_exists('ZipArchive')) {
			PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
		}

		header('Content-Disposition: attachment; filename="' . $filenameBase . '.xlsx"');
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=UTF-8');
		header('Expires: Mon, 31 Dec 2000 00:00:00 GMT');
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
		header('Cache-Control: post-check=0, pre-check=0', false);

		while (ob_get_level() > 0) {
			ob_end_clean();
		}

		$writer = PHPExcel_IOFactory::createWriter($workbook, 'Excel2007');
		$writer->save('php://output');
		return;
	}

	/**
	 * Function to get the list of Script models to be included
	 * @param Vtiger_Request $request
	 * @return <Array> - List of Vtiger_JsScript_Model instances
	 */
	function getHeaderScripts(Vtiger_Request $request) {
		$headerScriptInstances = parent::getHeaderScripts($request);
		$moduleName = $request->getModule();

		$jsFileNames = array(
			'modules.Vtiger.resources.Detail',
			"modules.$moduleName.resources.Detail"
		);

		$jsScriptInstances = $this->checkAndConvertJsScripts($jsFileNames);
		$headerScriptInstances = array_merge($headerScriptInstances, $jsScriptInstances);
		return $headerScriptInstances;
	}

}
