<?php
/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouInstaller license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

include_once dirname(__FILE__) . '/../../ExtensionStore/libraries/LoaderSuggest.php';

class Settings_ITS4YouInstaller_Extensions_View extends Settings_Vtiger_Index_View
{

    public $shopLink = 'https://www.its4you.sk/en/vtiger-shop';
    private $registrationStatus;
    private $passwordStatus;
    private $customerProfile;

    /**
     * Settings_ITS4YouInstaller_Extensions_View constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->exposeMethod('oneClickInstall');
        $this->exposeMethod('showChangelog');
    }

    /**
     * @param Vtiger_Request $request
     * @return bool|void
     * @throws AppException
     */

    public function checkPermission(Vtiger_Request $request)
    {
        $currentUserModel = Users_Record_Model::getCurrentUserModel();
        if (!$currentUserModel->isAdminUser() || !vtlib_isModuleActive('ITS4YouInstaller')) {
            throw new AppException(vtranslate('LBL_PERMISSION_DENIED', 'Vtiger'));
        }
    }

    /**
     * @param Vtiger_Request $request
     * @param bool $display
     * @return bool|void
     * @throws Exception
     */
    public function preProcess(Vtiger_Request $request, $display = true)
    {
        parent::preProcess($request, false);

        $viewer = $this->getViewer($request);
        $viewer->assign('REQUIREMENTS', Settings_ITS4YouInstaller_Requirements_Model::getInstance());
        $viewer->assign('MODULE_MODEL', Vtiger_Module_Model::getInstance($request->getModule()));
        $viewer->assign('CURRENT_USER_MODEL', Users_Record_Model::getCurrentUserModel());
        $modelInstance = $this->getModelInstance();
        $registrationStatus = $modelInstance->checkRegistration();

        if ($registrationStatus) {
            $userName = $modelInstance->getRegisteredUser();
            $pwdStatus = $modelInstance->passwordStatus();
            $viewer->assign('USER_NAME', $userName);
            $viewer->assign('PASSWORD_STATUS', $pwdStatus);
        }

        $viewer->assign('APP_IMAGE_MAP', array(
            'MARKETING' => 'fa-users',
            'SALES' => 'fa-dot-circle-o',
            'SUPPORT' => 'fa-life-ring',
            'INVENTORY' => 'vicon-inventory',
            'PROJECT' => 'fa-briefcase',
            'TOOLS' => 'fa-wrench',
        ));

        if ($display) {
            $this->preProcessDisplay($request);
        }
    }

    /**
     * @param Vtiger_Request $request
     * @throws Exception
     */
    public function process(Vtiger_Request $request)
    {
        $timeCheck[] = date('H:i:s');
        $mode = $request->getMode();

        if (!empty($mode)) {
            $this->invokeExposedMethod($mode, $request);
            return;
        }

        $viewer = $this->getViewer($request);
        $qualifiedModuleName = $request->getModule(false);
        $modelInstance = $this->getModelInstance();
        $registrationStatus = $modelInstance->checkRegistration();
        $pwdStatus = false;

        if ($registrationStatus) {
            $userName = $modelInstance->getRegisteredUser();
            $pwdStatus = $modelInstance->passwordStatus();

            if (!$pwdStatus) {
                $sessionIdentifier = $modelInstance->getSessionIdentifier();
                $pwd = $_SESSION[$sessionIdentifier . '_password'];
                if (!empty($pwd)) {
                    $pwdStatus = true;
                }
            }
            $viewer->assign('USER_NAME', $userName);

            if ($pwdStatus) {
                $profile = $modelInstance->getProfile();

                if (isset($profile['errorCode']) && !empty($profile['errorCode'])) {
                    $viewer->assign('ERROR_MESSAGES', [$profile['message'], 'LBL_LOG_OUT_IN',]);
                }

                $viewer->assign('CUSTOMER_PROFILE', $profile);
            }
        }

        $viewer->assign('EXTENSION_MODEL', $modelInstance);
        $viewer->assign('REGISTRATION_STATUS', $registrationStatus);
        $viewer->assign('PASSWORD_STATUS', $pwdStatus);
        $viewer->assign('IS_PRO', true);
        $viewer->assign('QUALIFIED_MODULE', $qualifiedModuleName);
        $viewer->assign('SHOP_LINK', $this->getShopLink());
        $viewer->assign('LICENSES_LIST', $modelInstance->getActiveLicenses());
        $viewer->assign('IS_HOSTING_LICENSE', Settings_ITS4YouInstaller_License_Model::hasHostingLicense());
        $viewer->assign('HOSTING_MODEL', $modelInstance->getHostingModel());

        $services = $modelInstance->getListingsGroupBy('type');

        $viewer->assign('PACKAGES_LIST', $modelInstance->sortExtensionsByKey($services['Package'], 'price'));
        $viewer->assign('EXTENSIONS_LIST', $services['Extension']);
        $viewer->assign('LANGUAGES_LIST', $services['LanguagePack']);
        $viewer->assign('ALL_LANGUAGES', Vtiger_Language_Handler::getAllLanguages());
        $viewer->assign('EMPTY_LICENSES', Settings_ITS4YouInstaller_License_Model::getEmptyLicenses());

        $viewer->view('Index.tpl', $qualifiedModuleName);

	    $modelInstance->updateExtensionsAlerts();
    }


    /**
     * @return string
     */
    public function getShopLink()
    {
        return $this->shopLink;
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
            '~/layouts/' . $layout . '/skins/vtiger/style.less',
            '~/layouts/' . $layout . '/skins/marketing/style.css',
            '~/layouts/' . $layout . '/modules/Settings/ITS4YouInstaller/resources/Style.css',
        );
        $cssInstances = $this->checkAndConvertCssStyles($cssFileNames);

        return array_merge($headerCssInstances, $cssInstances);
    }

    /**
     * @throws Exception
     */
    protected function init()
    {
        $modelInstance = $this->getModelInstance();
        $this->registrationStatus = $modelInstance->checkRegistration();

        if ($this->registrationStatus) {
            $pwdStatus = $modelInstance->passwordStatus();
            if (!$pwdStatus) {
                $sessionIdentifier = $modelInstance->getSessionIdentifier();
                $pwd = $_SESSION[$sessionIdentifier . '_password'];
                if (!empty($pwd)) {
                    $pwdStatus = true;
                }
            }
            $this->passwordStatus = $pwdStatus;
        }

        if ($this->registrationStatus && $this->passwordStatus) {
            $customerProfile = $modelInstance->getProfile();

            if ($customerProfile['id']) {
                $this->customerProfile = $customerProfile;
            } else {
                $this->passwordStatus = false;
                exit;
            }
        }
    }

    /**
     * @return Settings_ITS4YouInstaller_Extension_Model
     * @throws Exception
     */
    protected function getModelInstance()
    {
        if (!isset($this->modelInstance)) {
            $this->modelInstance = Settings_ITS4YouInstaller_Extension_Model::getInstance();
        }

        return $this->modelInstance;
    }

    /**
     * @param Vtiger_Request $request
     * @return bool|string
     */

    protected function preProcessTplName(Vtiger_Request $request)
    {
        global $vtiger_current_version;

        if ((int)$vtiger_current_version == 6) {
            return 'IndexViewPreProcess.tpl';
        } else {
            return parent::preProcessTplName($request);
        }
    }

    /**
     * @throws Exception
     */
    public function showChangelog(Vtiger_Request $request) {
        $qualifiedModule = $request->getModule(false);

        $viewer = $this->getViewer($request);
        $viewer->assign('QUALIFIED_MODULE', $qualifiedModule);


        /** @var Settings_ITS4YouInstaller_Extension_Model $extension */
        $extension = Settings_ITS4YouInstaller_Extension_Model::getInstanceFromId($request->get('extensionId'));
        $changeLog = $extension->getChangeLog();

        $modelInstance = $this->getModelInstance();

        $viewer->assign('IS_AUTH', $modelInstance->isAuth());
        $viewer->assign('EXTENSION', $extension);
        $viewer->assign('EXTENSION_NAME', $request->get('extensionName'));
        $viewer->assign('EXTENSION_ID', $request->get('extensionId'));
        $viewer->assign('EXTENSION_URL', $request->get('extensionUrl'));
        $viewer->assign('EXTENSION_TYPE', $request->get('extensionType'));
        $viewer->assign('MODULE_ACTION', $request->get('moduleAction'));
        $viewer->assign('MODULE_CHANGES', $changeLog['changes']);

        $viewer->view('ChangeLog.tpl', $qualifiedModule);
    }

    /**
     * @param Vtiger_Request $request
     * @throws Exception
     */
    protected function oneClickInstall(Vtiger_Request $request)
    {
        $viewer = $this->getViewer($request);
        global $Vtiger_Utils_Log;
        $viewer->assign('VTIGER_UTILS_LOG', $Vtiger_Utils_Log);
        $Vtiger_Utils_Log = true;
        $upgradeError = true;
        $qualifiedModuleName = $request->getModule(false);
        $extensionId = $request->get('extensionId');
        $moduleAction = $request->get('moduleAction'); //Import/Upgrade
        $viewer->assign('MODULE_ACTION', $moduleAction);
        $errors = array();
        /** @var $extensionModel Settings_ITS4YouInstaller_Extension_Model */
        $extensionModel = $this->getModelInstance()->getExtensionFromListing($extensionId);
        $extensions = array();

        if('Package' === $request->get('extensionType')) {
            $extensionModels = $extensionModel->getMultiPackages();
        } else {
            $extensionModels = array($extensionModel);
        }

        foreach ($extensionModels as $extensionModel) {
            $extension = $extensionModel->validateExtension($moduleAction);

            if(!$extension) {
                array_push($extensions, $extensionModel);
            } else {
                array_push($errors, [
                    'success' => false,
                    'extension' => $extensionModel->getName(),
                    'message' => $extension,
                ]);
            }
        }

        $viewer->assign('ERRORS', $errors);
        $viewer->assign('EXTENSIONS', $extensions);
        $viewer->assign('QUALIFIED_MODULE', $qualifiedModuleName);
        $viewer->view('InstallationLog.tpl', $qualifiedModuleName);
    }
}