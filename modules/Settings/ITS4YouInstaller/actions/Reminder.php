<?php
/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouInstaller license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

class Settings_ITS4YouInstaller_Reminder_Action extends Settings_Vtiger_Index_Action
{
    function __construct()
    {
        parent::__construct();
        $this->exposeMethod('UpdateStatus');
    }

    public function UpdateStatus(Vtiger_Request $request)
    {
        $qualifiedModule = $request->getModule(false);
        $moduleModel = Settings_Vtiger_Module_Model::getInstance($qualifiedModule);

        $alerts = $moduleModel->getAlerts();

        foreach ($alerts as $alert) {
            $moduleModel->updateAlert($alert['alert']);
        }

        $response = new Vtiger_Response();
        $response->setResult(array('success' => true));
        $response->emit();
    }
}