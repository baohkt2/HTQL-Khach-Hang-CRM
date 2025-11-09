<?php
/***********************************************************************************
 * The content of this file is subject to the ITS4YouPicklistImport license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 ************************************************************************************/

class ITS4YouPicklistImport
{
    protected static $moduleDescribeCache = array();
    public $LBL_SETTINGS_NAME = 'Picklist Import 4 You';
    public $LBL_MODULE_NAME = 'Picklist Import 4 You';
    public $list_fields_name = [];

    // Cache to speed up describe information store
    public $list_fields = [];
    /**
     * [module, type, label, url, icon, sequence, handlerInfo]
     * @return array
     */
    public $registerCustomLinks = array(
        ['ITS4YouPicklistImport', 'HEADERSCRIPT', 'ITS4YouPicklistImportActionsJS', 'layouts/$LAYOUT$/modules/ITS4YouPicklistImport/resources/ITS4YouPicklistImportActions.js']
    );

    public function __construct()
    {
        global $log, $currentModule;

        $this->db = PearDatabase::getInstance();
        $this->log = $log;
    }

    public static function checkAdminAccess($user)
    {
    }

    public static function getModuleDescribe($module)
    {
    }

    public static function getFieldInfo($module, $fieldname)
    {
    }

    public static function getFieldInfos($module)
    {
    }

    public function vtlib_handler($moduleName, $eventType)
    {
        switch ($eventType) {
            case 'module.postinstall':
            case 'module.enabled':
            case 'module.postupdate':
                $this->addCustomLinks();
                break;
            case 'module.disabled':
            case 'module.preuninstall':
            case 'module.preupdate':
                $this->deleteCustomLinks();
                break;
        }
    }

    public function addCustomLinks()
    {
        $this->updateCustomLinks();
    }

    /**
     * @param bool $register
     */
    public function updateCustomLinks($register = true)
    {
        foreach ($this->registerCustomLinks as $customLink) {
            list($moduleName, $type, $label, $url, $icon, $sequence, $handler) = array_pad($customLink, 7, null);
            $module = Vtiger_Module::getInstance($moduleName);
            $url = str_replace('$LAYOUT$', Vtiger_Viewer::getDefaultLayoutName(), $url);

            if ($module) {
                $module->deleteLink($type, $label);

                if ($register) {
                    $module->addLink($type, $label, $url, $icon, $sequence, $handler);
                }
            }
        }
    }

    public function deleteCustomLinks()
    {
        $this->updateCustomLinks(false);
    }
}