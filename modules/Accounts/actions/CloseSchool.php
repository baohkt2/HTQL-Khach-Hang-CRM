<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Accounts_CloseSchool_Action extends Vtiger_Action_Controller {

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
		ob_start();
		$response = new Vtiger_Response();

		try {
			$recordId = (int) $request->get('record');
			$moduleName = $request->getModule();
			$oldRecordModel = Vtiger_Record_Model::getInstanceById($recordId, $moduleName);
			$moduleModel = $oldRecordModel->getModule();

			$rawInheritFields = $request->get('inherit_fields');
			if (!is_array($rawInheritFields)) {
				$rawInheritFields = array();
			}

			$allowedInheritableFields = $this->getAllowedInheritableFieldNames($moduleModel);
			$mandatoryFields = $this->getMandatoryInheritableFieldNames($moduleModel);
			$selectedFields = array_values(array_intersect($rawInheritFields, $allowedInheritableFields));
			$fieldsToCopy = array_unique(array_merge($selectedFields, $mandatoryFields, array('assigned_user_id')));

			$originalName = trim((string) $oldRecordModel->get('accountname'));
			$baseName = $this->extractBaseSchoolName($originalName);
			if ($baseName === '') {
				throw new AppException(vtranslate('LBL_RECORD_NOT_FOUND', $moduleName));
			}

			$currentYear = date('Y');
			$closedName = $this->buildUniqueClosedName($baseName, $currentYear, $recordId);

			$oldRecordModel->set('mode', 'edit');
			$oldRecordModel->set('accountname', $closedName);
			$oldRecordModel->set('cf_2127', 'Đóng');
			$oldRecordModel->save();

			$newRecordModel = Vtiger_Record_Model::getCleanInstance($moduleName);
			$newRecordModel->set('accountname', $baseName);

			$currentUserModel = Users_Record_Model::getCurrentUserModel();
			$ownerId = $oldRecordModel->get('assigned_user_id');
			if (empty($ownerId)) {
				$ownerId = $currentUserModel->getId();
			}
			$newRecordModel->set('assigned_user_id', $ownerId);

			foreach ($fieldsToCopy as $fieldName) {
				if (in_array($fieldName, array('accountname', 'cf_2127', 'cf_2090'), true)) {
					continue;
				}
				$newRecordModel->set($fieldName, $oldRecordModel->get($fieldName));
			}

			// Student linkage/count must be reset on the new school.
			$newRecordModel->set('cf_2090', '');
			$newRecordModel->set('cf_2127', 'Mở');
			$newRecordModel->save();

			$response->setResult(array(
				'success' => true,
				'newRecordId' => $newRecordModel->getId(),
				'oldRecordId' => $recordId,
				'newRecordName' => $baseName,
				'closedRecordName' => $closedName,
			));
		} catch (Exception $e) {
			$response->setError($e->getCode(), $e->getMessage());
		}

		if (ob_get_length()) {
			ob_clean();
		}
		$response->emit();
		ob_end_flush();
	}

	protected function getAllowedInheritableFieldNames(Vtiger_Module_Model $moduleModel) {
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

		$fieldNames = array();
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

			$fieldNames[] = $fieldName;
		}

		return $fieldNames;
	}

	protected function getMandatoryInheritableFieldNames(Vtiger_Module_Model $moduleModel) {
		$fieldModels = $moduleModel->getFields();
		$allowedFieldNames = array_flip($this->getAllowedInheritableFieldNames($moduleModel));
		$mandatoryFieldNames = array();
		foreach ($fieldModels as $fieldModel) {
			$fieldName = $fieldModel->getName();
			if (!isset($allowedFieldNames[$fieldName])) {
				continue;
			}
			if ($fieldModel->isMandatory()) {
				$mandatoryFieldNames[] = $fieldName;
			}
		}
		return $mandatoryFieldNames;
	}

	protected function extractBaseSchoolName($accountName) {
		$cleanName = preg_replace('/\s*-\s*\[\d{4}\]\s*$/u', '', $accountName);
		return trim($cleanName);
	}

	protected function buildUniqueClosedName($baseName, $year, $currentRecordId) {
		$baseClosedName = $baseName . ' - [' . $year . ']';
		$candidateName = $baseClosedName;
		$counter = 2;

		while ($this->isAccountNameUsed($candidateName, $currentRecordId)) {
			$candidateName = $baseClosedName . ' (' . $counter . ')';
			$counter++;
		}

		return $candidateName;
	}

	protected function isAccountNameUsed($accountName, $excludeRecordId) {
		$db = PearDatabase::getInstance();
		$result = $db->pquery(
			' SELECT vtiger_account.accountid
			  FROM vtiger_account
			  INNER JOIN vtiger_crmentity ON vtiger_crmentity.crmid = vtiger_account.accountid
			  WHERE vtiger_crmentity.deleted = 0 AND vtiger_account.accountname = ? AND vtiger_account.accountid != ? ',
			array($accountName, $excludeRecordId)
		);
		return ($db->num_rows($result) > 0);
	}

	public function validateRequest(Vtiger_Request $request) {
		$request->validateWriteAccess();
	}
}
