<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Vtiger_DeleteCustomExportFormat_Action extends Vtiger_IndexAjax_View {

	public function requiresPermission(Vtiger_Request $request) {
		$permissions = array();
		$permissions[] = array('module_parameter' => 'source_module', 'action' => 'Export');
		return $permissions;
	}

	public function process(Vtiger_Request $request) {
		$response = new Vtiger_Response();

		try {
			$sourceModule = $request->get('source_module');
			$recordId = (int) $request->get('record');
			$isDeleted = Vtiger_CustomExportFormat_Model::deleteForCurrentUser($recordId, $sourceModule);

			if (!$isDeleted) {
				throw new Exception(vtranslate('LBL_RECORD_NOT_FOUND', 'Vtiger'));
			}

			$response->setResult(array(
				'success' => true,
				'message' => vtranslate('LBL_CUSTOM_EXPORT_FORMAT_DELETED', 'Vtiger'),
				'record' => $recordId,
			));
		} catch (Exception $exception) {
			$response->setError($exception->getMessage());
		}

		$response->emit();
	}
}