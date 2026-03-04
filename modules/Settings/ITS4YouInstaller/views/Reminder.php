<?php
/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouInstaller license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

class Settings_ITS4YouInstaller_Reminder_View extends Settings_Vtiger_Index_View
{

    public function checkPermission(Vtiger_Request $request)
    {
    }

    public function process(Vtiger_Request $request)
    {
        $currentUserModel = Users_Record_Model::getCurrentUserModel();

        if ($currentUserModel->isAdminUser()) {
            $qualifiedModule = $request->getModule(false);
            $moduleModel = Settings_Vtiger_Module_Model::getInstance($qualifiedModule);

            $viewer = $this->getViewer($request);
            $viewer->assign('QUALIFIED_MODULE', $qualifiedModule);
            $viewer->assign('MODULE_MODEL', $moduleModel);
            $viewer->assign('MODULE', $request->getModule());
            $viewer->assign('ALERTS', $moduleModel->getAlerts());
            $viewer->view('Reminder.tpl', $qualifiedModule);
        }
    }
}