<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Reports_DetailAjax_Action extends Vtiger_BasicAjax_Action {

	public function __construct() {
		parent::__construct();
		$this->exposeMethod('getRecordsCount');
	}

	public function requiresPermission(\Vtiger_Request $request) {
		$permissions = parent::requiresPermission($request);
		$permissions[] = array('module_parameter' => 'module', 'action' => 'DetailView', 'record_parameter' => 'record');
		return $permissions;
	}

	public function process(Vtiger_Request $request) {
		$mode = $request->getMode();
		if (!empty($mode)) {
			$this->invokeExposedMethod($mode, $request);
			return;
		}
	}

	/**
	 * Function to get records count from current runtime filter conditions.
	 * @param <Vtiger_Request> $request
	 * @return <Number>
	 */
	public function getRecordsCount(Vtiger_Request $request) {
		$record = $request->get('record');
		$reportModel = Reports_Record_Model::getInstanceById($record);
		$reportModel->setModule('Reports');
		$reportModel->set('advancedFilter', $request->get('advanced_filter'));

		$advFilterSql = $reportModel->getAdvancedFilterSQL();
		if (!$advFilterSql) {
			$advFilterSql = true;
		}

		$query = $reportModel->getReportSQL($advFilterSql, 'PDF');
		$countQuery = $reportModel->generateCountQuery($query);
		$count = intval($reportModel->getReportsCount($countQuery));

		$response = new Vtiger_Response();
		$response->setResult($count);
		$response->emit();
	}
}