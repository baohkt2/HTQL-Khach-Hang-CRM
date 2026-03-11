<?php
/**
 * AdvancedReport - Main List/Builder View
 * 
 * Shows report builder UI and saved reports list.
 * URL: index.php?module=AdvancedReport&view=List
 */
class AdvancedReport_List_View extends Vtiger_Index_View {

    public function requiresPermission(\Vtiger_Request $request) {
        return [];
    }

    public function checkPermission(Vtiger_Request $request) {
        $currentUser = Users_Record_Model::getCurrentUserModel();
        if (!$currentUser || !$currentUser->getId()) {
            throw new AppException(vtranslate('LBL_PERMISSION_DENIED'));
        }
    }

    public function preProcess(Vtiger_Request $request, $display = true) {
        parent::preProcess($request, $display);
    }

    public function process(Vtiger_Request $request) {
        $viewer = $this->getViewer($request);
        $moduleName = $request->getModule();

        // Get current user
        $currentUser = Users_Record_Model::getCurrentUserModel();

        // Load campaigns list for filter dropdown
        $db = PearDatabase::getInstance();
        $campaignsResult = $db->pquery(
            "SELECT c.campaignid, c.campaignname, c.campaignstatus 
             FROM vtiger_campaign c 
             INNER JOIN vtiger_crmentity ce ON ce.crmid = c.campaignid AND ce.deleted = 0
             ORDER BY c.campaignname ASC",
            []
        );
        $campaigns = [];
        for ($i = 0; $i < $db->num_rows($campaignsResult); $i++) {
            $campaigns[] = $db->fetchByAssoc($campaignsResult, $i);
        }

        // Load saved report configs
        require_once 'modules/AdvancedReport/models/QueryBuilder.php';
        require_once 'modules/AdvancedReport/models/ReportEngine.php';
        $engine = new AdvancedReport_ReportEngine_Model();
        $savedConfigs = $engine->listReportConfigs();

        $viewer->assign('MODULE', $moduleName);
        $viewer->assign('CAMPAIGNS', $campaigns);
        $viewer->assign('SAVED_CONFIGS', $savedConfigs);
        $viewer->assign('CURRENT_USER', $currentUser);
        $viewer->assign('MODULE_NAME', $moduleName);

        $viewer->view('List.tpl', $moduleName);
    }

    public function getHeaderScripts(Vtiger_Request $request) {
        $headerScriptInstances = parent::getHeaderScripts($request);
        $moduleName = $request->getModule();
        $jsFileNames = [
            "modules.$moduleName.resources.AdvancedReport",
        ];
        $jsScriptInstances = $this->checkAndConvertJsScripts($jsFileNames);
        return array_merge($headerScriptInstances, $jsScriptInstances);
    }
}
