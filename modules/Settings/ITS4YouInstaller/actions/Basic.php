<?php
/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouInstaller license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

class Settings_ITS4YouInstaller_Basic_Action extends Settings_Vtiger_IndexAjax_View
{

    protected $modelInstance;

    function __construct()
    {
        parent::__construct();
        $this->exposeMethod('registerAccount');
        $this->exposeMethod('getDateString');
        $this->exposeMethod('uninstallExtension');
        $this->exposeMethod('logoutITS4YouInstaller');
        $this->exposeMethod('registerKey');
        $this->exposeMethod('clearEmptyLicenses');
    }

    /**
     * @param Vtiger_Request $request
     */
    public function clearEmptyLicenses(Vtiger_Request $request)
    {
        $moduleModel = Vtiger_Module_Model::getInstance($request->getModule());

        Settings_ITS4YouInstaller_License_Model::deleteEmptyLicenses();

        header('location:' . $moduleModel->getDefaultUrl());
    }

    /**
     * @param Vtiger_Request $request
     *
     * @throws Exception
     */
    function process(Vtiger_Request $request)
    {
        $mode = $request->getMode();
        if (!empty($mode)) {
            echo $this->invokeExposedMethod($mode, $request);
            return;
        }
    }

    /**
     * @param Vtiger_Request $request
     *
     * @return bool|void
     */
    public function validateRequest(Vtiger_Request $request)
    {
        $request->validateWriteAccess();
    }

    /**
     * @param Vtiger_Request $request
     */
    protected function registerAccount(Vtiger_Request $request)
    {
        $options = array();
        $options['emailAddress'] = $request->get('emailAddress');
        $options['password'] = $request->get('password');
        $options['savePassword'] = true;

        $modelInstance = $this->getModelInstance();
        $profileInfo = $modelInstance->login($options);

        if($request->isAjax()) {
            $response = new Vtiger_Response();

            if ($profileInfo['success'] != 'true') {
                $response->setError('', $profileInfo['error']);
            } else {
                $result = array('success' => false, 'message' => vtranslate('LBL_LOGGED_IN', $request->getModule(false)));

                if (isset($profileInfo['result']['account'])) {
                    $result['success'] = true;
                }

                $response->setResult($result);
            }

            $response->emit();
        } else {
            ITS4YouInstaller_Module_Model::redirectByUrl('index.php?module=ITS4YouInstaller&parent=Settings&view=Extensions');
        }
    }

    protected function getModelInstance()
    {
        if (!isset($this->modelInstance)) {
            $this->modelInstance = Settings_ITS4YouInstaller_Extension_Model::getInstance();
        }
        return $this->modelInstance;
    }

    /**
     * @param $date
     *
     * @return string
     */
    protected function getDateString($date)
    {
        return Vtiger_Util_Helper::formatDateTimeIntoDayString($date);
    }

    /**
     * @param Vtiger_Request $request
     */
    protected function logoutITS4YouInstaller(Vtiger_Request $request)
    {
        $modelInstance = $this->getModelInstance();
        $modelInstance->logout();

        $response = new Vtiger_Response();
        $response->setResult(['success' => true, 'message' => vtranslate('LBL_LOGGED_OUT', $request->getModule(false))]);
        $response->emit();
    }

    /**
     * @param Vtiger_Request $request
     *
     * @throws Exception
     */
    protected function uninstallExtension(Vtiger_Request $request)
    {
        $extensionName = $request->get('extensionName');
        $extensionInstance = Settings_ITS4YouInstaller_Extension_Model::getModuleFromExtnName($extensionName);
        $extnType = $extensionInstance->get('extnType');
        $response = new Vtiger_Response();

        if ($extnType == 'module') {
            $extensionInstance->delete();
            //Remove extension files
            global $root_directory;
            $deletePaths = array();
            $pathToExtensionLayouts = $root_directory . "layouts/vlayout/modules/$extensionName";
            $layoutDirAccessible = isFileAccessible($pathToExtensionLayouts);
            if ($layoutDirAccessible) {
                $deletePaths['layouts'] = $pathToExtensionLayouts;
            }

            $pathToExtensionSettingsLayouts = $root_directory . "layouts/vlayout/modules/Settings/$extensionName";
            $layoutSettingsDirAccessible = isFileAccessible($pathToExtensionSettingsLayouts);
            if ($layoutSettingsDirAccessible) {
                $deletePaths['settingsLayouts'] = $pathToExtensionSettingsLayouts;
            }

            $pathToExtensionModule = $root_directory . "modules/$extensionName";
            $moduleDirAccessible = isFileAccessible($pathToExtensionModule);
            if ($moduleDirAccessible) {
                $deletePaths['modules'] = $pathToExtensionModule;
            }

            $pathToExtensionModuleSettings = $root_directory . "modules/Settings/$extensionName";
            $moduleSettingsDirAccessible = isFileAccessible($pathToExtensionModuleSettings);
            if ($moduleSettingsDirAccessible) {
                $deletePaths['settingsModules'] = $pathToExtensionModuleSettings;
            }

            foreach ($deletePaths as $dirName) {
                $this->deleteRecursively($dirName);
            }
            $response->setResult(array('success' => true, 'message' => 'extension deleted'));
        } else {
            if ($extnType == 'language') {
                $languageInstance = Settings_ITS4YouInstaller_Extension_Model::getLanguageInstance($extensionName);
                if ($languageInstance) {
                    $langPrefix = $languageInstance->get('prefix');
                    Vtiger_Language::deregister($langPrefix);
                    //remove files
                    $langDir = "languages/$langPrefix";
                    if (isFileAccessible($langDir)) {
                        $this->deleteRecursively($langDir);
                    }
                }
                $response->setResult(array('success' => true, 'message' => 'extension deleted'));
            } else {
                $response->setError('Error in deleting extension');
            }
        }
        $response->emit();
    }

    /**
     * @param $dirName
     *
     * @return bool
     */
    protected function deleteRecursively($dirName)
    {
        $files = array_diff(scandir($dirName), array('.', '..'));
        foreach ($files as $file) {
            (is_dir("$dirName/$file")) ? $this->deleteRecursively("$dirName/$file") : unlink("$dirName/$file");
            $afterDeletefiles = array_diff(scandir($dirName), array('.', '..'));
            if (count($afterDeletefiles) == 0) {
                rmdir($dirName);
            }
        }
        return true;
    }
}
