<?php
/* * *******************************************************************************
* The content of this file is subject to the CRMTiger Pro license.
* ("License"); You may not use this file except in compliance with the License
* The Initial Developer of the Original Code is https://crmtiger.com/
* Portions created by CRMTiger.com are Copyright(C) CRMTiger.com
* All Rights Reserved.
* ****************************************************************************** */
class Settings_CTFacebookMessengerIntegration_CTFacebookMessengerSaveAccessToken_Action extends Settings_Vtiger_Basic_Action {

    public function process(Vtiger_Request $request) {
        global $adb, $current_user;
        
        $accessToken = $request->get('accessToken');
        $userName = $request->get('userName');
        $expiresIn = $request->get('expiresIn');
        $userId = $current_user->id;
        $currentDateTime = date('Y-m-d H:i:s');

        require 'modules/CTFacebookMessengerIntegration/Facebook/config.php';

        $graphAPIEndPoint = $facebookAppConfig['graphAPIEndPoint'];
        $replaceAccessTokenURL = $graphAPIEndPoint.'oauth/access_token?grant_type=fb_exchange_token&client_id='.$facebookAppConfig['appId'].'&client_secret='.$facebookAppConfig['appSecret'].'&fb_exchange_token='.$accessToken;

        $replacedAccessToken = Settings_CTFacebookMessengerIntegration_Record_Model::callFacebookMessengerAPI($replaceAccessTokenURL,'GET');

        if(isset($replacedAccessToken['access_token'])){
            $accessToken = $replacedAccessToken['access_token'];
            $expiresIn = $replacedAccessToken['expires_in'];
        }

        $getChatAccessTokenData = Settings_CTFacebookMessengerIntegration_Record_Model::getCTFacebookMessengerIntegrationData("ct_chat_chattype ctc 
          INNER JOIN ct_chat_token ctt ON ctc.chat_type_id = ctt.chat_type_id", array('ctc.*, ctt.*'), array('ctc.platform' => 'Facebook Messenger'));
        $numRows = $adb->num_rows($getChatAccessTokenData);

        if($numRows > 0){
            $adb->pquery("UPDATE ct_chat_token ctt INNER JOIN ct_chat_chattype ctc ON ctt.chat_type_id = ctc.chat_type_id SET access_token = ?, ctt.modified_by = ?, ctt.date_modified = ?, ctt.expires_in = ? WHERE ctc.platform = ?",array($accessToken, $userId, $currentDateTime, 'Facebook Messenger', $expiresIn));
        }else{
            $adb->pquery("INSERT INTO ct_chat_token (chat_type_id, access_token, username, created_by, modified_by, date_created, date_modified, active, expires_in) SELECT chat_type_id, ?, ?, ?, ?, ?, ?, ?, ? FROM ct_chat_chattype WHERE platform = 'Facebook Messenger'", array($accessToken, $userName, $userId, $userId, $currentDateTime, $currentDateTime, '1', $expiresIn));
        }        
        $response = new Vtiger_Response();
        $response->setResult(array('redirectURL' => 'index.php?module=CTFacebookMessengerIntegration&parent=Settings&view=CTGeneralConfiguration'));
        $response->emit();
    }
}
?>