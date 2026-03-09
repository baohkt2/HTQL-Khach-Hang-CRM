<?php
/**
 * PDFMaker2 — List View (Tools app context)
 * Displays all PDF templates in a management table.
 */
class PDFMaker2_List_View extends Vtiger_Index_View {

    public function requiresPermission(Vtiger_Request $request) {
        // Non-entity module – skip default DetailView permission check
        return [];
    }

    public function preProcessTplName(Vtiger_Request $request) {
        return 'ListViewPreProcess.tpl';
    }

    public function postProcess(Vtiger_Request $request) {
        $viewer = $this->getViewer($request);
        $viewer->view('ListViewPostProcess.tpl', $request->getModule());
        parent::postProcess($request);
    }

    public function process(Vtiger_Request $request) {
        $viewer = $this->getViewer($request);

        $page = $request->get('page') ?: 1;
        $data = PDFMaker2_Record_Model::getAll($page);

        $viewer->assign('TEMPLATES', $data['records']);
        $viewer->assign('TOTAL_COUNT', $data['total']);
        $viewer->assign('PAGE', $page);
        $viewer->assign('MODULE', 'PDFMaker2');
        $viewer->assign('QUALIFIED_MODULE', 'PDFMaker2');

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
