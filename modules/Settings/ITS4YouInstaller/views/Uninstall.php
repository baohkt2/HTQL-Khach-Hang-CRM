<?php
/*******************************************************************************
 * The content of this file is subject to the ITS4YouInstaller license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 ***************************************************************************** */

class Settings_ITS4YouInstaller_Uninstall_View extends Settings_Vtiger_Index_View
{

    /**
     * @param Vtiger_Request $request
     * @return string
     */
    public function getModuleName(Vtiger_Request $request) {
        if($request->isEmpty('sourceModule')) {
            throw new AppException(vtranslate('LBL_SELECT_SOURCE_MODULE', 'ITS4YouInstaller'));
        }

        $sourceModule = (string)$request->get('sourceModule');

        if(!ITS4YouInstaller_Module_Model::isModuleActive($sourceModule)) {
            throw new AppException(vtranslate('LBL_MODULE_NOT_ACTIVE_OR_DELETED', 'ITS4YouInstaller'));
        }

        return $sourceModule;
    }

    /**
     * @param Vtiger_Request $request
     * @param bool $display
     */
    public function preProcess(Vtiger_Request $request, $display = true)
    {
        $moduleName = $this->getModuleName($request);
        $moduleModel = Vtiger_Module_Model::getInstance($moduleName);
        $settingLinks = array();

        foreach ($moduleModel->getSettingLinks() as $settingsLink) {
            $settingsLink['linklabel'] = sprintf(vtranslate($settingsLink['linklabel'], $moduleName), vtranslate($moduleName, $moduleName));
            $settingLinks['LISTVIEWSETTING'][] = Vtiger_Link_Model::getInstanceFromValues($settingsLink);
        }

        $viewer = $this->getViewer($request);
        $viewer->assign('LISTVIEW_LINKS', $settingLinks);

        parent::preProcess($request, false);

        if (6 !== (int)Vtiger_Version::current() && $display) {
            $this->preProcessDisplay($request);
        }
    }

    public function process(Vtiger_Request $request)
    {
        $moduleName = $this->getModuleName($request);
        $qualifiedModule = 'Settings:ITS4YouInstaller';

        $viewer = $this->getViewer($request);
        $viewer->assign('MODULE', $moduleName);
        $viewer->assign('QUALIFIED_MODULE', $qualifiedModule);

        $versionClass = $moduleName . '_Version_Helper';
        $version = class_exists($versionClass) ? $versionClass::$version : 0;

        $viewer->assign('VERSION', $version);

        $viewer->view('Uninstall.tpl', $qualifiedModule);
    }

    public function getHeaderScripts(Vtiger_Request $request)
    {
        $headerScriptInstances = parent::getHeaderScripts($request);
        $moduleName = $request->getModule();

        unset($headerScriptInstances['modules.Vtiger.resources.Edit']);
        unset($headerScriptInstances["modules.Settings.Vtiger.resources.Edit"]);
        unset($headerScriptInstances['modules.Inventory.resources.Edit']);
        unset($headerScriptInstances["modules.$moduleName.resources.Edit"]);
        unset($headerScriptInstances["modules.Settings.$moduleName.resources.Edit"]);

        $jsFileNames = array(
            'modules.Settings.' . $moduleName . '.resources.Uninstall',
        );

        return array_merge($headerScriptInstances, $this->checkAndConvertJsScripts($jsFileNames));
    }

    /**
     * @param Vtiger_Request $request
     * @return array
     */
    public function getHeaderCss(Vtiger_Request $request)
    {
        $headerCssInstances = parent::getHeaderCss($request);
        $layout = Vtiger_Viewer::getDefaultLayoutName();
        $cssFileNames = array(
            '~/layouts/'.$layout.'/skins/marketing/style.css',
        );

        return array_merge($headerCssInstances, $this->checkAndConvertCssStyles($cssFileNames));
    }
}