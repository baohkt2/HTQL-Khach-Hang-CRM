<?php
/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouProjectsChart license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

require_once 'modules/Webforms/model/WebformsModel.php';
require_once 'include/Webservices/DescribeObject.php';

class ITS4YouProjectsChart
{
    public $list_fields_name = [];
    public $list_fields = [];
    public $log;
    public $db;
    /**
     * [module, type, label, url, icon, sequence, handlerInfo]
     * @return array
     */
    public $registerCustomLinks = array(
        ['Project', 'HEADERSCRIPT', 'Projects Chart Js', 'layouts/$LAYOUT$/modules/ITS4YouProjectsChart/resources/ITS4YouProjectsChart_HS.js']
    );

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

    // Cache to speed up describe information store
    protected static $moduleDescribeCache = [];

    function __construct()
    {
        global $log, $currentModule;

        $this->db = PearDatabase::getInstance();
        $this->log = $log;
    }

    function vtlib_handler($moduleName, $eventType)
    {
        require_once('include/utils/utils.php');
        require_once('vtlib/Vtiger/Module.php');

        switch ($eventType) {
            case 'module.postinstall':
            case 'module.enabled':
                $this->addCustomLinks();
                break;
            case 'module.preuninstall':
            case 'module.disabled':
                $this->deleteCustomLinks();
                break;
            case 'module.postupdate':
            case 'module.preupdate':
                break;
        }
    }

    private static function getLinkLabel()
    {
        return 'Projects Chart';
    }

    private static function getModuleName()
    {
        return get_called_class();
    }

    private static function getUrl()
    {
        return sprintf(
            'index.php?module=%s&view=List&mode=showChart',
            self::getModuleName()
        );
    }

    private static function getProjectModuleName()
    {
        return 'Project';
    }

    private static function getHeaderLinkLabel()
    {
        return 'Projects Chart Js';
    }

    private static function getHeaderJsUrl()
    {
        return sprintf(
            'layouts/%s/modules/%s/resources/%s_HS.js',
            (string)Vtiger_Viewer::getDefaultLayoutName(),
            self::getModuleName(),
            self::getModuleName()
        );
    }

    public static function stringToColorCode($str)
    {
        $code = rand(0, 9) . dechex(crc32($str)) . rand(0, 9);
        $code = '#' . substr($code, 0, 6);

        return $code;
    }

    public function addCustomLinks()
    {
        $this->updateCustomLinks();
    }

    public function deleteCustomLinks()
    {
        $this->updateCustomLinks(false);
    }
}
