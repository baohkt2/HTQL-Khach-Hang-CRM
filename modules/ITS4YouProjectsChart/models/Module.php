<?php
/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouProjectsChart license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

class ITS4YouProjectsChart_Module_Model extends Vtiger_Module_Model
{
    public static $mobileIcon = 'chart-bar';
    private $sourceModule;

    private static function getModuleName()
    {
        $parts = explode('_', get_called_class());

        return $parts[0];
    }

    public static function getButtonUrl()
    {
        return sprintf(
            'index.php?module=%s&view=List&mode=showChart',
            self::getModuleName()
        );
    }

    /**
     * Function to get the ListView Component Name
     * @return string
     */
    public function getListViewName()
    {
        return 'Chart';
    }

    /**
     * @param Vtiger_Request $request
     */
    public function initializeCustomView(Vtiger_Request $request)
    {
        if ($request->isEmpty('viewname') && isset($_SERVER['HTTP_REFERER'])) {
            preg_match('/viewname=(?<viewName>[0-9]+)/', $_SERVER['HTTP_REFERER'], $matches);

            if (isset($matches['viewName']) && !empty($matches['viewName'])) {
                $request->set('viewname', $matches['viewName']);
            }
        }
    }

    /**
     * @var string
     */
    public $defaultColor = '#EF5E29';

    /**
     * @var array
     */
    public $defaultColors = [
        'SALES' => '#3CB878',
        'MARKETING' => '#EF5E29',
        'OTHER' => '#56ccc8',
        'SUPPORT' => '#6297C3',
        'INVENTORY' => '#F1C40F',
        'PROJECT' => '#8E44AD',
        'TOOLS' => '#EF5E29',
    ];

    /**
     * @param object|string $parent
     */
    public function initializeDefaultColor($parent)
    {
        if (is_object($parent)) {
            $parent = $this->getParentFromObject($parent);
        }

        $this->setDefaultColor($this->defaultColors[$parent]);
    }

    /**
     * @param string $value
     */
    public function setDefaultColor($value)
    {
        $this->defaultColor = $value;
    }

    /**
     * @return string
     */
    public function getDefaultColor()
    {
        return $this->defaultColor;
    }

    /**
     * @param object $moduleModel
     *
     * @return string
     */
    public function getParentFromObject($moduleModel)
    {
        $parent = 'MARKETING';

        if (method_exists($moduleModel, 'getAppName')) {
            foreach ($moduleModel->getAppName() as $parentVal => $id) {
                if (!empty($parentVal)) {
                    $parent = $parentVal;
                    break;
                }
            }
        }

        return $parent;
    }

    public function getSettingLinks()
    {
        $settingsLinks = [];
        $currentUserModel = Users_Record_Model::getCurrentUserModel();
        $moduleName = $this->getName();

        if ($currentUserModel->isAdminUser()) {
            $settingsLinks[] = [
                'linktype' => 'LISTVIEWSETTING',
                'linklabel' => 'LBL_PROJECTS',
                'linkurl' => 'index.php?module=Project&view=List',
            ];

            $settingsLinks[] = [
                'linktype' => 'LISTVIEWSETTING',
                'linklabel' => 'LBL_MODULE_REQUIREMENTS',
                'linkurl' => 'index.php?module=ITS4YouInstaller&parent=Settings&view=Requirements&mode=Module&sourceModule=ITS4YouProjectsChart',
            ];

            $settingsLinks[] = [
                'linktype' => 'LISTVIEWSETTING',
                'linklabel' => 'LBL_LICENSE',
                'linkurl' => 'index.php?module=ITS4YouInstaller&view=License&parent=Settings&sourceModule=ITS4YouProjectsChart',
            ];

            $settingsLinks[] = [
                'linktype' => 'LISTVIEWSETTING',
                'linklabel' => 'LBL_UPGRADE',
                'linkurl' => 'index.php?module=ModuleManager&parent=Settings&view=ModuleImport&mode=importUserModuleStep1',
            ];
            $settingsLinks[] = [
                'linktype' => 'LISTVIEWSETTING',
                'linklabel' => 'LBL_UNINSTALL',
                'linkurl' => 'index.php?module=ITS4YouInstaller&view=Uninstall&parent=Settings&sourceModule=ITS4YouProjectsChart',
            ];
        }

        return $settingsLinks;
    }

    /**
     * @param Vtiger_Request $request
     *
     * @return int
     */
    public function getCustomViewId(Vtiger_Request $request)
    {
        $cvId = $request->get('viewname');

        if (empty($cvId)) {
            $customView = new CustomView();
            $cvId = $customView->getViewIdByName('All', $request->get('sourceModule'));
        }

        return (int)$cvId;
    }

    /**
     * @param string $moduleName
     * @param int $customViewId
     *
     * @return string
     */
    public function getViewUrl($moduleName, $customViewId = 0)
    {
        $url = parent::getDefaultUrl() . '&sourceModule=' . $moduleName;

        if ($customViewId) {
            $url .= '&viewname=' . $customViewId;
        }

        return $url;
    }

    /**
     * @param string $sourceModule
     *
     * @return array
     */
    public function getAssignedUsers($sourceModule)
    {
        $currentUser = Users_Record_Model::getCurrentUserModel();

        return [
            'users' => $currentUser->getAccessibleUsersForModule($sourceModule),
            'groups' => $currentUser->getAccessibleGroupForModule($sourceModule),
        ];
    }

    /**
     * @param string $value
     */
    public function setSourceModule($value)
    {
        $this->sourceModule = $value;
    }

    /**
     * @return string
     */
    public function getSourceModule()
    {
        return $this->sourceModule;
    }

    /**
     * @param array $data
     *
     * @return Vtiger_Link_Model
     */
    public function getLinkModel($data)
    {
        $sourceModule = $this->getSourceModule();
        $data['linklabel'] = sprintf(vtranslate($data['linklabel'], $sourceModule), vtranslate($sourceModule, $sourceModule));

        return Vtiger_Link_Model::getInstanceFromValues($data);
    }

    public function getDatabaseTables()
    {
        return [];
    }

    public function getPicklistFields()
    {
        return [];
    }
}
