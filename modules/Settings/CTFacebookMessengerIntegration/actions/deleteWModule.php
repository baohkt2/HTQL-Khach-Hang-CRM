<?php
/* * *******************************************************************************
* The content of this file is subject to the CRMTiger Pro license.
* ("License"); You may not use this file except in compliance with the License
* The Initial Developer of the Original Code is vTiger
* The Modified Code of the Original Code owned by https://crmtiger.com/
* Portions created by CRMTiger.com are Copyright(C) CRMTiger.com
* All Rights Reserved.
* ****************************************************************************** */
class Settings_CTFacebookMessengerIntegration_deleteWModule_Action extends Settings_Vtiger_Index_Action {
    public function process(Vtiger_Request $request) {
        global $adb;
        $moduleName = $request->getModule();
        $qualifiedName = $request->getModule(false);

        $deleteModule = $request->get('dmodule');
        $deleted = Settings_CTFacebookMessengerIntegration_Record_Model::deleteAllowModule($deleteModule);

        $tabId = getTabid($deleteModule);
        $relatedTabId = getTabid('CTChatLog');
        $getFaceBookTabs = $adb->pquery("SELECT * FROM `vtiger_relatedlists` WHERE tabid = ? AND related_tabid = ?",array($tabId,$relatedTabId));
        if($adb->num_rows($getFaceBookTabs) > 0){
            $adb->pquery("DELETE FROM `vtiger_relatedlists` WHERE tabid = ? AND related_tabid = ?",array($tabId,$relatedTabId));
        }

        echo $deleted;
    }
}
?>