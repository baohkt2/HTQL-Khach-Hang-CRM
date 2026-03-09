<?php
/**
 * Settings_PDFMaker2_List_View
 * Proper Settings-routed wrapper so vtiger Loader finds this before the generic Settings_Vtiger fallback.
 */
class Settings_PDFMaker2_List_View extends Settings_Vtiger_Index_View {

    public function preProcess(Vtiger_Request $request, $display = true) {
        parent::preProcess($request, $display);
    }

    public function process(Vtiger_Request $request) {
        $viewer = $this->getViewer($request);

        $page = $request->get('page') ?: 1;
        $data = PDFMaker2_Record_Model::getAll($page);

        $viewer->assign('TEMPLATES', $data['records']);
        $viewer->assign('TOTAL_COUNT', $data['total']);
        $viewer->assign('PAGE', $page);
        $viewer->assign('MODULE', 'PDFMaker2');
        $viewer->assign('QUALIFIED_MODULE', 'Settings:PDFMaker2');

        $viewer->view('List.tpl', 'PDFMaker2');
    }

    public function getHeaderScripts(Vtiger_Request $request) {
        $headerScriptInstances = parent::getHeaderScripts($request);
        $jsFileNames = array(
            '~layouts/'.Vtiger_Viewer::getDefaultLayoutName().'/modules/PDFMaker2/resources/List.js'
        );
        $jsScriptInstances = $this->checkAndConvertJsScripts($jsFileNames);
        return array_merge($headerScriptInstances, $jsScriptInstances);
    }
}
