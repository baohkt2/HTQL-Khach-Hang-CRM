<?php
/***********************************************************************************
 * The content of this file is subject to the ITS4YouPicklistImport license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 ************************************************************************************/

class ITS4YouPicklistImport_Module_Model extends Vtiger_Module_Model
{

    public function isExportable()
    {
        return false;
    }

    public function getDefaultUrl()
    {
        return 'index.php?parent=Settings&module=Picklist&view=Index';
    }

    public static $mobileIcon = 'import';

    public function getSettingLinks()
    {
        $currentUserModel = Users_Record_Model::getCurrentUserModel();
        $settingsLinks = [];

        if ($currentUserModel->isAdminUser()) {
            $settingsLinks[] = array(
                'linktype' => 'LISTVIEWSETTING',
                'linklabel' => 'LBL_INTEGRATION',
                'linkurl' => $this->getDefaultUrl(),
            );
            $settingsLinks[] = array(
                'linktype' => 'LISTVIEWSETTING',
                'linklabel' => 'LBL_MODULE_REQUIREMENTS',
                'linkurl' => 'index.php?module=ITS4YouInstaller&parent=Settings&view=Requirements&mode=Module&sourceModule=ITS4YouPicklistImport',
            );
            $settingsLinks[] = array(
                'linktype' => 'LISTVIEWSETTING',
                'linklabel' => 'LBL_LICENSE',
                'linkurl' => 'index.php?module=ITS4YouInstaller&view=License&parent=Settings&sourceModule=ITS4YouPicklistImport',
            );
            $settingsLinks[] = array(
                'linktype' => 'LISTVIEWSETTING',
                'linklabel' => 'LBL_UPGRADE',
                'linkurl' => 'index.php?module=ModuleManager&parent=Settings&view=ModuleImport&mode=importUserModuleStep1',
            );
            $settingsLinks[] = array(
                'linktype' => 'LISTVIEWSETTING',
                'linklabel' => 'LBL_UNINSTALL',
                'linkurl' => 'index.php?module=ITS4YouInstaller&view=Uninstall&parent=Settings&sourceModule=ITS4YouPicklistImport',
            );
        }

        return $settingsLinks;
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
