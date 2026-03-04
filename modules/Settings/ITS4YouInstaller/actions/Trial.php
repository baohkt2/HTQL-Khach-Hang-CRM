<?php
/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouInstaller license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

include_once 'vtlib/Vtiger/Net/Client.php';

class Settings_ITS4YouInstaller_Trial_Action extends Settings_Vtiger_Index_Action
{

    function __construct()
    {
        parent::__construct();
        $this->exposeMethod('getTrial');
    }

    public function process(Vtiger_Request $request)
    {
        $mode = $request->getMode();
        /*$this->getTrial($request);
        exit;*/

        if ($mode) {
            echo $this->invokeExposedMethod($mode, $request);
            return;
        }
    }

    public function getTrial(Vtiger_Request $request)
    {
        $qualified_module = $request->getModule(false);
        $success = false;
        $message = 'LBL_TRIAL_FAILED';
        $licenses = array();

        $extensionModel = Settings_ITS4YouInstaller_Extension_Model::getInstance();
        $trial = $extensionModel->getTrial($request->get('trial'));

        if (!empty($trial)) {
            $result = $trial['response'];
            $success = $result['success'];
            $message = $result['message'];
            $licenses = $result['licenses'];

            if ($success === true) {
                $message = 'LBL_TRIAL_SUCCESS';
            }
        }

        $result = array(
            'success' => $success,
            'message' => vtranslate($message, $qualified_module),
            'license' => $licenses,
        );

        $response = new Vtiger_Response();
        $response->setResult($result);
        $response->emit();
    }
}