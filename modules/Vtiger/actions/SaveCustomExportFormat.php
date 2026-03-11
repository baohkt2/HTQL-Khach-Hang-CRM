<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Vtiger_SaveCustomExportFormat_Action extends Vtiger_IndexAjax_View {

	public function requiresPermission(Vtiger_Request $request) {
		$permissions = array();
		$permissions[] = array('module_parameter' => 'source_module', 'action' => 'Export');
		return $permissions;
	}

	public function process(Vtiger_Request $request) {
		$response = new Vtiger_Response();

		try {
			$sourceModule = $request->get('source_module');
			$savedFormat = Vtiger_CustomExportFormat_Model::saveForCurrentUser($sourceModule, array(
				'selected_format_id' => $request->get('selected_format_id'),
				'format_name' => $request->get('format_name'),
				'filename' => $request->get('filename'),
				'export_title' => $request->get('export_title'),
				'columnslist' => $request->get('columnslist'),
				'advfilterlist' => $request->get('advfilterlist'),
			));

			$response->setResult(array(
				'success' => true,
				'message' => vtranslate('LBL_CUSTOM_EXPORT_FORMAT_SAVED', 'Vtiger'),
				'format' => $savedFormat,
			));
		} catch (Exception $exception) {
			$response->setError($exception->getMessage());
		}

		$response->emit();
	}
}