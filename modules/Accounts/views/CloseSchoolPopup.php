<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Accounts_CloseSchoolPopup_View extends Vtiger_IndexAjax_View {

	public function requiresPermission(\Vtiger_Request $request) {
		$permissions = parent::requiresPermission($request);
		$permissions[] = array('module_parameter' => 'module', 'action' => 'DetailView', 'record_parameter' => 'record');
		$permissions[] = array('module_parameter' => 'module', 'action' => 'EditView', 'record_parameter' => 'record');
		$permissions[] = array('module_parameter' => 'module', 'action' => 'CreateView');
		return $permissions;
	}

	public function checkPermission(Vtiger_Request $request) {
		return parent::checkPermission($request);
	}

	public function process(Vtiger_Request $request) {
		$recordId = (int) $request->get('record');
		$moduleName = $request->getModule();
		$recordModel = Vtiger_Record_Model::getInstanceById($recordId, $moduleName);

		$accountName = trim((string) $recordModel->get('accountname'));
		$baseName = $this->extractBaseSchoolName($accountName);
		$currentYear = date('Y');

		$viewer = $this->getViewer($request);
		$viewer->assign('MODULE', $moduleName);
		$viewer->assign('RECORD_ID', $recordId);
		$viewer->assign('ACCOUNT_NAME', $accountName);
		$viewer->assign('BASE_NAME', $baseName);
		$viewer->assign('CLOSED_NAME_PREVIEW', $baseName . ' - [' . $currentYear . ']');
		$viewer->assign('INHERITABLE_FIELDS', $this->getInheritableFieldInfo($recordModel));
		$viewer->view('CloseSchoolPopup.tpl', $moduleName);
	}

	protected function getInheritableFieldInfo(Vtiger_Record_Model $recordModel) {
		$moduleModel = $recordModel->getModule();
		$fieldModels = $moduleModel->getFields();
		$excludedFieldNames = array(
			'accountname',
			'cf_2127',
			'cf_2090',
			'createdtime',
			'modifiedtime',
			'modifiedby',
			'created_user_id',
			'record_id',
			'id',
		);

		$fieldInfoList = array();
		foreach ($fieldModels as $fieldModel) {
			$fieldName = $fieldModel->getName();
			if (in_array($fieldName, $excludedFieldNames, true)) {
				continue;
			}
			if (!$fieldModel->isViewable()) {
				continue;
			}

			$uiType = (int) $fieldModel->get('uitype');
			if (in_array($uiType, array(4, 70), true)) {
				continue;
			}

			$rawValue = $recordModel->get($fieldName);
			$displayValue = $fieldModel->getDisplayValue($rawValue, $recordModel->getId());
			if ($displayValue === '') {
				$displayValue = '-';
			}

			$fieldInfoList[] = array(
				'name' => $fieldName,
				'label' => vtranslate($fieldModel->get('label'), 'Accounts'),
				'displayValue' => $displayValue,
				'mandatory' => $fieldModel->isMandatory(),
			);
		}

		return $fieldInfoList;
	}

	protected function extractBaseSchoolName($accountName) {
		$cleanName = preg_replace('/\s*-\s*\[\d{4}\]\s*$/u', '', $accountName);
		return trim($cleanName);
	}
}
