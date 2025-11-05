<?php
/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouInstaller license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

class Settings_ITS4YouInstaller_Requirements_View extends Settings_ITS4YouInstaller_Extensions_View
{
    public function __construct()
    {
        parent::__construct();

        $this->exposeMethod('Module');
        $this->exposeMethod('System');
    }

    /**
     * @param Vtiger_Request $request
     * @throws Exception
     */
    public function process(Vtiger_Request $request)
    {
        if (!$request->isEmpty('mode')) {
            $this->invokeExposedMethod($request->getMode(), $request);
            return;
        }

        $this->System($request);
    }

    public function preProcess(Vtiger_Request $request, $display = true)
    {
        parent::preProcess($request, $display);

        $qualifiedModule = $request->getModule(false);
        $requirementsTitle = 'Module' === $request->getMode() ? 'LBL_MODULE_REQUIREMENTS' : 'LBL_SYSTEM_REQUIREMENTS';

        $viewer = $this->getViewer($request);
        $viewer->assign('REQUIREMENTS_TITLE', $requirementsTitle);
        $viewer->assign('QUALIFIED_MODULE', $qualifiedModule);
        $viewer->assign('SOURCE_MODULES', Settings_ITS4YouInstaller_ModuleRequirements_Model::getSourceModules());
        $viewer->assign('SOURCE_MODULE_NAME', $request->get('sourceModule'));

        $viewer->view('RequirementsPreProcess.tpl', $qualifiedModule);
    }

    /**
     * @param Vtiger_Request $request
     */
    public function Module(Vtiger_Request $request)
    {
        $qualifiedModule = $request->getModule(false);
        $sourceModule = $request->get('sourceModule');
        $requirements = false;

        if(!empty($sourceModule)) {
            $requirements = Settings_ITS4YouInstaller_ModuleRequirements_Model::getInstance($sourceModule);
            $requirements->retrieveData();
        }

        $viewer = $this->getViewer($request);
        $viewer->assign('QUALIFIED_MODULE', $qualifiedModule);
        $viewer->assign('REQUIREMENTS', $requirements);
        $viewer->assign('REQUIREMENT_VALIDATIONS', $requirements->getValidations());

        $viewer->view('RequirementsModule.tpl', $qualifiedModule);
    }

    /**
     * @param Vtiger_Request $request
     */
    public function System(Vtiger_Request $request)
    {
        $qualifiedModule = $request->getModule(false);
        $requirements = Settings_ITS4YouInstaller_Requirements_Model::getInstance();

        $viewer = $this->getViewer($request);
        $viewer->assign('QUALIFIED_MODULE', $qualifiedModule);
        $viewer->assign('REQUIREMENTS', $requirements);
        $viewer->view('Requirements.tpl', $qualifiedModule);
    }

    /**
     * @param Vtiger_Request $request
     * @return array
     */
    public function getHeaderCss(Vtiger_Request $request)
    {
        $layout = Vtiger_Viewer::getDefaultLayoutName();
        $view = $request->get('view');
        $module = $request->getModule();
        $cssFileNames = array(
            '~/layouts/' . $layout . '/modules/Settings/' . $module . '/resources/' . $view . '.css',
        );

        return array_merge(parent::getHeaderCss($request), $this->checkAndConvertCssStyles($cssFileNames));
    }

    /**
     * @param Vtiger_Request $request
     * @return array
     */
    public function getHeaderScripts(Vtiger_Request $request)
    {
        $layout = Vtiger_Viewer::getDefaultLayoutName();
        $view = $request->get('view');
        $module = $request->getModule();
        $scriptFileNames = array(
            '~/layouts/' . $layout . '/modules/Settings/' . $module . '/resources/' . $view . '.js',
        );

        return array_merge(parent::getHeaderScripts($request), $this->checkAndConvertJsScripts($scriptFileNames));
    }
}