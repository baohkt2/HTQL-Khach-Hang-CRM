<?php
/**
 * Settings_PDFMaker2_Edit_View
 * Proper Settings-routed wrapper for template creation/editing.
 */
class Settings_PDFMaker2_Edit_View extends Settings_Vtiger_Index_View {

    public function process(Vtiger_Request $request) {
        $viewer = $this->getViewer($request);
        $templateId = $request->get('templateid');

        $templateData = null;
        if ($templateId) {
            $templateData = PDFMaker2_Record_Model::getInstanceById($templateId);
        }

        // Get all entity modules for target module selector
        $fieldResolver = new PDFMaker2_FieldResolver_Model();
        $modules = $fieldResolver->getEntityModules();

        // If editing, get the fields for the first assigned module
        $moduleFields = [];
        if ($templateData) {
            $assignedModules = $templateData->get('assigned_modules');
            if (!empty($assignedModules)) {
                $firstModule = $assignedModules[0]['module_name'];
                $moduleFields = $fieldResolver->getFieldsForModule($firstModule);
            }
        }

        $viewer->assign('TEMPLATE_DATA', $templateData);
        $viewer->assign('ENTITY_MODULES', $modules);
        $viewer->assign('MODULE_FIELDS', $moduleFields);
        $viewer->assign('MODULE', 'PDFMaker2');
        $viewer->assign('QUALIFIED_MODULE', 'Settings:PDFMaker2');

        $viewer->view('Edit.tpl', 'PDFMaker2');
    }

    public function getHeaderScripts(Vtiger_Request $request) {
        $headerScriptInstances = parent::getHeaderScripts($request);
        $jsFileNames = array(
            '~layouts/'.Vtiger_Viewer::getDefaultLayoutName().'/modules/PDFMaker2/resources/Edit.js'
        );
        $jsScriptInstances = $this->checkAndConvertJsScripts($jsFileNames);
        return array_merge($headerScriptInstances, $jsScriptInstances);
    }
}
