<?php

/***********************************************************************************
 * The content of this file is subject to the ITS4YouPicklistImport license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 ************************************************************************************/

class Settings_ITS4YouPicklistImport_IndexAjax_View extends Settings_Vtiger_IndexAjax_View {

    function __construct() {
        parent::__construct();
        $this->exposeMethod('showImportValuesToRoleView');
    }

    public function process(Vtiger_Request $request) {
        $mode = $request->get('mode');
        if($this->isMethodExposed($mode)) {
            $this->invokeExposedMethod($mode, $request);
        }
    }

	 /**
     * Function which will assign existing values to the roles
     * @param Vtiger_Request $request
     */
    public function showImportValuesToRoleView(Vtiger_Request $request) {
		$sourceModule = $request->get('source_module');
        $pickFieldId = $request->get('pickListFieldId');
        $fieldModel = Settings_Picklist_Field_Model::getInstance($pickFieldId);

		$moduleName = $request->getModule();
        $qualifiedName = $request->getModule(false);

        $selectedFieldAllPickListValues = Vtiger_Util_Helper::getPickListValues($fieldModel->getName());
		$selectedFieldAllPickListValues =  array_map('Vtiger_Util_Helper::toSafeHTML', $selectedFieldAllPickListValues);
        $viewer = $this->getViewer($request);
        $viewer->assign('SELECTED_PICKLIST_FIELDMODEL',$fieldModel);
		$viewer->assign('SELECTED_MODULE_NAME',$sourceModule);
		$viewer->assign('MODULE',$moduleName);
		$viewer->assign('QUALIFIED_MODULE',$qualifiedName);
        $viewer->assign('ROLES_LIST', Settings_Roles_Record_Model::getAll());
        $viewer->assign('SELECTED_PICKLISTFIELD_ALL_VALUES',$selectedFieldAllPickListValues);
        $viewer->view('ImportValuesToRole.tpl',$qualifiedName);
	}
}