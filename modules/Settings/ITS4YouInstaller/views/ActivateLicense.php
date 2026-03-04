<?php
/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouInstaller license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

class Settings_ITS4YouInstaller_ActivateLicense_View extends Settings_Vtiger_IndexAjax_View
{

    public function process(Vtiger_Request $request)
    {
        $this->activateLicense($request);
    }

    public function activateLicense(Vtiger_Request $request)
    {
        $moduleName = $request->getModule();
        $qualifiedModule = $request->getModule(false);

        $viewer = $this->getViewer($request);
        $viewer->assign('MODULE', $moduleName);
        $viewer->assign('QUALIFIED_MODULE', $qualifiedModule);
        $viewer->assign("URL", vglobal("site_URL"));

        $company_details = Vtiger_CompanyDetails_Model::getInstanceById();
        $viewer->assign("COMPANY_DETAILS", $company_details);

        $step = 1;
        $current_step = 1;
        $total_steps = 1;

        $viewer->assign("STEP", $step);
        $viewer->assign("CURRENT_STEP", $current_step);
        $viewer->assign("TOTAL_STEPS", $total_steps);
        $viewer->assign("LICENSE_KEY", $request->get('license'));

        $viewer->view('ActivateLicense.tpl', 'Settings:ITS4YouInstaller');
    }

    function getHeaderScripts(Vtiger_Request $request)
    {
        $headerScriptInstances = parent::getHeaderScripts($request);
        $moduleName = $request->getModule();

        $jsFileNames = [
            'modules.Vtiger.resources.Vtiger',
            'modules.Vtiger.resources.List',
            'modules.Settings.' . $moduleName . '.resources.License',
        ];

        $jsScriptInstances = $this->checkAndConvertJsScripts($jsFileNames);
        $headerScriptInstances = array_merge($headerScriptInstances, $jsScriptInstances);

        return $headerScriptInstances;
    }
}