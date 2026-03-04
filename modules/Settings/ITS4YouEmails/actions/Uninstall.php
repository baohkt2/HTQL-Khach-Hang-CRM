<?php
/* ********************************************************************************
* The content of this file is subject to the ITS4YouEmails license.
* ("License"); You may not use this file except in compliance with the License
* The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
* Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
* All Rights Reserved.
* ****************************************************************************** */

class Settings_ITS4YouEmails_Uninstall_Action extends Settings_Vtiger_Basic_Action
{
    protected $moduleName;
    protected $moduleModel;

    /**
     * @param Vtiger_Request $request
     */
    public function process(Vtiger_Request $request)
    {
        $this->moduleName = $request->getModule();
        $this->moduleModel = Vtiger_Module_Model::getInstance($this->moduleName);

        if ($this->moduleModel) {
            $this->moduleModel->delete();

            $this->deleteTables();
            $this->deletePicklists();
            $this->deleteModuleFiles();
            $this->deleteLanguages();

            $result = array('success' => true);
        } else {
            $result = array('success' => false);
        }

        ob_clean();
        $response = new Vtiger_Response();
        $response->setResult($result);
        $response->emit();
    }

    public function deleteTables()
    {
        $adb = PearDatabase::getInstance();
        $adb->pquery('DELETE FROM vtiger_crmentity WHERE setype=?', array($this->moduleName));

        if (method_exists($this->moduleModel, 'getDatabaseTables')) {
            foreach ($this->moduleModel->getDatabaseTables() as $table) {
                $adb->pquery('DROP TABLE IF EXISTS ' . $table);
            }
        }
    }

    public function deletePicklists()
    {
        $adb = PearDatabase::getInstance();

        if (method_exists($this->moduleModel, 'getPicklistFields')) {
            foreach ($this->moduleModel->getPicklistFields() as $picklist) {
                $adb->pquery('DELETE FROM vtiger_picklist WHERE name=?', [$picklist]);
            }
        }
    }

    public function deleteModuleFiles()
    {
        $folders = [
            'modules/' . $this->moduleName,
            'modules/Settings/' . $this->moduleName,
            'layouts/vlayout/modules/' . $this->moduleName,
            'layouts/vlayout/modules/Settings/' . $this->moduleName,
            'layouts/v7/modules/' . $this->moduleName,
            'layouts/v7/modules/Settings/' . $this->moduleName,
        ];

        foreach ($folders as $folder) {
            @shell_exec('rm -r ' . $folder);

            if (is_dir($folder)) {
                $this->deleteFiles($folder);
            }
        }
    }

    /**
     * @param string $dir
     * @return bool
     */
    public function deleteFiles($dir)
    {
        $files = array_diff(scandir($dir), array('.', '..'));

        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? $this->deleteFiles("$dir/$file") : unlink("$dir/$file");
        }

        return rmdir($dir);
    }

    public function deleteLanguages()
    {
        $dirs = array_diff(scandir('languages/'), array('..', '.'));

        foreach ($dirs as $dir) {
            if (is_dir('languages/' . $dir)) {
                $languages = [
                    'languages/' . $dir . '/' . $this->moduleName . '.php',
                    'languages/' . $dir . '/Settings/' . $this->moduleName . '.php',
                ];

                foreach ($languages as $language) {
                    @shell_exec('rm -f ' . $language);

                    if (is_file($language)) {
                        unlink($language);
                    }
                }
            }
        }
    }
}
