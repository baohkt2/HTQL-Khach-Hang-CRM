<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Contacts_MassActionAjax_View extends Vtiger_MassActionAjax_View {

	function __construct() {
		parent::__construct();
		$this->exposeMethod('markAssignment');
	}

	public function requiresPermission(Vtiger_Request $request) {
		$permissions = parent::requiresPermission($request);
		if ($request->getMode() === 'markAssignment') {
			$permissions[] = array('module_parameter' => 'module', 'action' => 'EditView');
		}
		return $permissions;
	}

	public function markAssignment(Vtiger_Request $request) {
		$module = $request->getModule();
		$viewer = $this->getViewer($request);
		$viewer->assign('MODULE', $module);
		$viewer->view('MarkAssignmentForm.tpl', $module);
	}
}
