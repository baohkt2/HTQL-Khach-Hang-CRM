<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Reports_SaveAjax_View extends Vtiger_IndexAjax_View {

	const DEFAULT_PAGE_LIMIT = 500;

	public function requiresPermission(\Vtiger_Request $request) {
		$permissions = parent::requiresPermission($request);
		$permissions[] = array('module_parameter' => 'module', 'action' => 'DetailView', 'record_parameter' => 'record');
		return $permissions;
	}

	public function process(Vtiger_Request $request) {
		$mode = $request->getMode();
		if ($mode !== 'save' && $mode !== 'generate') {
			$mode = 'generate';
		}

		$viewer = $this->getViewer($request);
		$moduleName = $request->getModule();

		$record = $request->get('record');
		$reportModel = Reports_Record_Model::getInstanceById($record);
		$reportModel->setModule('Reports');
		$reportModel->set('advancedFilter', $request->get('advanced_filter'));

		$page = intval($request->get('page'));
		if ($page < 1) {
			$page = 1;
		}

		$pagingModel = new Vtiger_Paging_Model();
		$pagingModel->set('page', $page);
		$pagingModel->set('limit', self::DEFAULT_PAGE_LIMIT);

		if ($mode === 'save') {
			if (!$reportModel->isEditableBySharing()) {
				throw new AppException(vtranslate('LBL_PERMISSION_DENIED'));
			}
			$reportModel->saveAdvancedFilters();
			$reportData = $reportModel->getReportData($pagingModel);
		} else {
			$reportData = $reportModel->generateData($pagingModel);
		}

		$data = isset($reportData['data']) ? $reportData['data'] : array();
		$count = isset($reportData['count']) ? intval($reportData['count']) : (is_array($data) ? php7_count($data) : 0);

		$calculation = $reportModel->generateCalculationData();
		$advancedCalculation = $reportModel->generateAdvancedCalculationData();

		$viewer->assign('PRIMARY_MODULE', $reportModel->getPrimaryModule());
		$viewer->assign('CALCULATION_FIELDS', $calculation);
		$viewer->assign('ADVANCED_CALCULATION_FIELDS', $advancedCalculation);
		$viewer->assign('DATA', $data);
		$viewer->assign('RECORD_ID', $record);
		$viewer->assign('PAGING_MODEL', $pagingModel);
		$viewer->assign('MODULE', $moduleName);
		$viewer->assign('NEW_COUNT', $count);
		$viewer->assign('REPORT_RUN_INSTANCE', ReportRun::getInstance($record));
		$viewer->assign('REPORT_MODEL', $reportModel);
		$viewer->view('ReportContents.tpl', $moduleName);
	}

	public function validateRequest(Vtiger_Request $request) {
		$request->validateWriteAccess();
	}
}