<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/
include_once 'modules/Vtiger/CRMEntity.php';
class CTChatLog extends Vtiger_CRMEntity {
    var $table_name = 'vtiger_ctchatlog';
    var $table_index= 'ctchatlogid';
    /**
     * Mandatory table for supporting custom fields.
     */
    var $customFieldTable = Array('vtiger_ctchatlogcf', 'ctchatlogid');
    /**
     * Mandatory for Saving, Include tables related to this module.
     */
    var $tab_name = Array('vtiger_crmentity', 'vtiger_ctchatlog', 'vtiger_ctchatlogcf');
    /**
     * Mandatory for Saving, Include tablename and tablekey columnname here.
     */
    var $tab_name_index = Array(
        'vtiger_crmentity' => 'crmid',
        'vtiger_ctchatlog' => 'ctchatlogid',
        'vtiger_ctchatlogcf'=>'ctchatlogid');
    /**
     * Mandatory for Listing (Related listview)
     */
    var $list_fields = Array (
        /* Format: Field Label => Array(tablename, columnname) */
        // tablename should not have prefix 'vtiger_'
        'Chat Log No' => Array('ctchatlog', 'chat_log_no'),
        'Assigned To' => Array('crmentity','smownerid')
    );
    var $list_fields_name = Array (
        /* Format: Field Label => fieldname */
        'Chat Log No' => 'chat_log_no',
        'Assigned To' => 'assigned_user_id',
    );
    // Make the field link to detail view
    var $list_link_field = 'chat_log_no';
    // For Popup listview and UI type support
    var $search_fields = Array(
        /* Format: Field Label => Array(tablename, columnname) */
        // tablename should not have prefix 'vtiger_'
        'Chat Log No' => Array('ctchatlog', 'chat_log_no'),
        'Assigned To' => Array('vtiger_crmentity','assigned_user_id'),
    );
    var $search_fields_name = Array (
        /* Format: Field Label => fieldname */
        'Chat Log No' => 'chat_log_no',
        'Assigned To' => 'assigned_user_id',
    );
    // For Popup window record selection
    var $popup_fields = Array ('chat_log_no');
    // For Alphabetical search
    var $def_basicsearch_col = 'chat_log_no';
    // Column value to use on detail view record text display
    var $def_detailview_recname = 'chat_log_no';
    // Used when enabling/disabling the mandatory fields for the module.
    // Refers to vtiger_field.fieldname values.
    var $mandatory_fields = Array('assigned_user_id');
    var $default_order_by = 'chat_log_no';
    var $default_sort_order='ASC';
    /**
    * Invoked when special actions are performed on the module.
    * @param String Module name
    * @param String Event Type
    */
    function vtlib_handler($moduleName, $eventType) {
        global $adb;
        if($eventType == 'module.postinstall') {
            // TODO Handle actions after this module is installed.
            self::installTokenGenerateFile(); 
            self::insertChatType();
            self::addFbQuotedField();
            self::AddSendMessageWorkflow();
        } else if($eventType == 'module.disabled') {
            // TODO Handle actions before this module is being uninstalled.
        } else if($eventType == 'module.preuninstall') {
            self::installTokenGenerateFile(); 
            // TODO Handle actions when this module is about to be deleted.
        } else if($eventType == 'module.preupdate') {
            self::installTokenGenerateFile();
            self::insertChatType();
            self::AddSendMessageWorkflow();
            // TODO Handle actions before this module is updated.
        } else if($eventType == 'module.postupdate') {
            self::installTokenGenerateFile();
            self::insertChatType();
            self::addFbQuotedField();
            self::AddSendMessageWorkflow();
            // TODO Handle actions after this module is updated.
        }
    }

    static function addFbQuotedField(){
        global $adb;
        $checkChatLogTableExist = $adb->pquery("SHOW TABLES LIKE 'vtiger_ctchatlog'", array());
        $chatLogTableNumRows = $adb->num_rows($checkChatLogTableExist);
        
        if($chatLogTableNumRows > 0){
            $checkFbQuotedColumnExist = $adb->pquery("SHOW COLUMNS FROM vtiger_ctchatlog LIKE 'fb_quoted_message'", array());

            if($adb->num_rows($checkFbQuotedColumnExist) == 0){
                $addFbQuotedColumn = $adb->pquery("ALTER TABLE vtiger_ctchatlog ADD fb_quoted_message longtext NULL AFTER message_read_unread", array());
            }//end of if
        }//end of if
    }//end of function

    static function insertChatType(){
        global $adb;
        $currentDate = date('Y-m-d H:i:s');
        $adb->pquery("INSERT INTO `ct_chat_chattype`(`chat_type_id`, `platform`, `created_by`, `modified_by`, `date_created`, `date_modified`, `active`) VALUES ('1', 'Facebook Messenger', '1', '1', '".$currentDate."', '".$currentDate."', '1')",array()); 
    }//end of function

    static function installTokenGenerateFile() {
        global $adb;
        $fileArr =array('getReceivedFacebookMessages');
        foreach ($fileArr as $key => $filename) {
            $dest1 = $filename.".php";
            $source1 = "modules/CTChatLog/".$filename.".php";
            chmod($source1, 0777);
            if (file_exists($source1)) {
                copy($source1, $dest1);
                chmod($dest1, 0777);
            }//end of if
        }//end of foreach
    }//end of function

    static function AddSendMessageWorkflow(){
        include_once 'modules/com_vtiger_workflow/VTTaskManager.inc';
        
        global $adb;
        $name = 'SendFacebookPageMsg';
        $incDestinationFile = "modules/com_vtiger_workflow/tasks/".$name.".inc";
        $incSourceFile = "modules/CTChatLog/workflow/".$name.".inc";

        $incFileExist = false;
        if (file_exists($incDestinationFile)) {
            $incFileExist = true;
        } else {
            if(copy($incSourceFile, $incDestinationFile)) {
                $incFileExist = true;
            }//end of if
        }//end of else

        if($incFileExist){
            $getFbWorkflowTaskType = "SELECT * FROM com_vtiger_workflow_tasktypes WHERE tasktypename = ?";
            $getFbWorkflowTaskTypeResult = $adb->pquery($getFbWorkflowTaskType, array('SendFacebookPageMsg'));

            if ($adb->num_rows($getFbWorkflowTaskTypeResult) == 0) {
                $taskType = array("name" => "SendFacebookPageMsg", "label"=>"Send Message on Facebook", "classname" => "SendFacebookPageMsg", "classpath" => "modules/CTChatLog/workflow/SendFacebookPageMsg.inc", "templatepath"=>"modules/CTChatLog/taskforms/SendFacebookPageMsg.tpl", "modules" => array('include' => array(), 'exclude'=>array()), "sourcemodule" => 'CTChatLog');
                VTTaskType::registerTaskType($taskType);
            }//end of if
        }//end of if
    }//end of function

    static function sendFacebookMessageFromWorkFlow($msgBody, $senderId, $facebookPageId, $relatedModule, $currenUserID, $moduleRecordId){
        include('modules/CTFacebookMessengerIntegration/Facebook/config.php');
        global $adb, $site_URL, $PORTAL_URL;
        
        $currentTime = date("Y-m-d H:i:s");
        $getNumberImportant = CTChatLog_Record_Model::getImportantMessageDetail($senderId);
        
        $bodydata = str_replace('\r\n',' ',html_entity_decode($msgBody));
        $url = $site_URL."/index.php?module=".$relatedModule."&view=Detail&record=".$moduleRecordId;
        $url_html = $url;
        
        $recorIdName='id';
        if($relatedModule == 'HelpDesk') $recorIdName = 'ticketid';
        if($relatedModule == 'Faq') $recorIdName = 'faqid';
        if($relatedModule == 'Products') $recorIdName = 'productid';
        $portalDetailViewURL = $PORTAL_URL.'/index.php?module='.$relatedModule.'&action=index&'.$recorIdName.'='.$moduleRecordId.'&status=true';
        $textmessage = str_replace('CRM Detail View URL', $url_html, $msgBody);
        $textmessage = str_replace('Site Url', $site_URL, $textmessage);
        $textmessage = str_replace('Portal Url', $PORTAL_URL, $textmessage);
        $textmessage = str_replace('Portal Detail View URL', $portalDetailViewURL, $textmessage);
        $bodydata = str_replace('\r\n',' ',html_entity_decode($textmessage));
        $msgBody = getMergedDescription($bodydata,$moduleRecordId,$relatedModule);
        $sendMessageURL = $facebookAppConfig['graphAPIEndPoint'].$facebookPageId.'/messages';
        $sendPostFields = array('recipient' => array('id' => $senderId), 'message' => array('text' => $msgBody));
        $messageType = 'text';
        $pageAccessToken = '';
        $getChatTypeData = Settings_CTFacebookMessengerIntegration_Record_Model::getCTFacebookMessengerIntegrationData('ct_chat_chattype', array('chat_type_id'), array('platform' => 'Facebook Messenger'));
        $chatTypeRows = $adb->num_rows($getChatTypeData);
        
        if($chatTypeRows > 0){
            $chatTypeId = $adb->query_result($getChatTypeData, 0, 'chat_type_id');
            //get access token data
            $getChatAccessTokenData =  Settings_CTFacebookMessengerIntegration_Record_Model::getCTFacebookMessengerIntegrationData("ct_chat_token", array('access_token','expires_in','date_modified'), array('chat_type_id' => $chatTypeId));
            $accessTokenNumRows = $adb->num_rows($getChatAccessTokenData);
            if($accessTokenNumRows > 0){
                $accessToken = $adb->query_result($getChatAccessTokenData, 0, 'access_token');
                $expiresIn = $adb->query_result($getChatAccessTokenData, 0, 'expires_in');
                $dateModified = $adb->query_result($getChatAccessTokenData, 0, 'date_modified');
                $graphAPIEndPoint = $facebookAppConfig['graphAPIEndPoint'];
                if($expiresIn != 0 && $expiresIn != ''){
                    $expiredDate = date('Y-m-d H:i:s', strtotime($dateModified) + (int)$expiresIn);
                    if(strtotime($expiredDate) < strtotime($currentTime)){
                        //get new access token and update 
                        $replaceAccessTokenURL = $graphAPIEndPoint.'oauth/access_token?grant_type=fb_exchange_token&client_id='.$facebookAppConfig['appId'].'&client_secret='.$facebookAppConfig['appSecret'].'&fb_exchange_token='.$accessToken;
                        $replacedAccessToken = Settings_CTFacebookMessengerIntegration_Record_Model::callFacebookMessengerAPI($replaceAccessTokenURL,'GET');
                
                        if(isset($replacedAccessToken['access_token']) && !empty($replacedAccessToken['access_token'])){
                            $expiresIn = $replacedAccessToken['expires_in'];
                            $adb->pquery("UPDATE ct_chat_token SET access_token = ?, modified_by = ?, date_modified = ?, expires_in = ? WHERE chat_type_id = ?",array($accessToken, $currentUserID, $currentTime, $expiresIn, $chatTypeId));
                        }
                    }
                }
                $getFacebookPageEndPoint = $graphAPIEndPoint."me/accounts?access_token=".$accessToken;
                $facebookPageList = Settings_CTFacebookMessengerIntegration_Record_Model::getFacebookPages($getFacebookPageEndPoint);
                if(!empty($facebookPageList)){
                    foreach ($facebookPageList as $key => $value) {
                        if($value['pageId'] == $facebookPageId){
                            $pageAccessToken = $value['accessToken'];
                        }//end of if
                    }//end of foreach
                }//end of if
            }
        }
        if($pageAccessToken != ''){
            $sendMessageResponse = CTChatLog_Record_Model::callAPICURL($sendMessageURL, $sendPostFields, $pageAccessToken);
            $messageId = '';
            if(isset($sendMessageResponse['message_id'])){
                $messageId = $sendMessageResponse['message_id'];
            }
            if($moduleRecordId){
                $setype = CTChatLog_Record_Model::getSeType($moduleRecordId);
                $recordModel = Vtiger_Record_Model::getInstanceById($moduleRecordId, $setype);
                $displayName = $recordModel->get('label');
            }else{
                $displayName = $senderName;
            }//end of else
            $checkExistingSenderLogData = Settings_CTFacebookMessengerIntegration_Record_Model::getCTFacebookMessengerIntegrationData('vtiger_ctchatlogdetails INNER JOIN vtiger_crmentity ON vtiger_ctchatlogdetails.ctchatlogdetailsid = vtiger_crmentity.crmid', array('module_record_id, ctchatlogdetailsid', 'sender_name'), array('sender_id' => $senderId, 'vtiger_crmentity.deleted' => 0));
            $logNumRows = $adb->num_rows($checkExistingSenderLogData);
            if($logNumRows > 0){
                $moduleRecordId = $adb->query_result($checkExistingSenderLogData, 0, 'module_record_id');
                $chatLogDetailsId = $adb->query_result($checkExistingSenderLogData, 0, 'ctchatlogdetailsid');
                $senderName = $adb->query_result($checkExistingSenderLogData, 0, 'sender_name');
            }//end of if
            $chatLogRecordModel = Vtiger_Record_Model::getCleanInstance('CTChatLog');
            $chatLogRecordModel->set('chat_type_id',$chatTypeId);
            $chatLogRecordModel->set('platform_unique_id',$facebookPageId);
            $chatLogRecordModel->set('conversation_id',$messageId);
            $chatLogRecordModel->set('message_type',$messageType);
            $chatLogRecordModel->set('message_body',json_encode($msgBody));
            $chatLogRecordModel->set('type','Send');
            $chatLogRecordModel->set('api_request', json_encode($sendPostFields));
            $chatLogRecordModel->set('api_response',json_encode($sendMessageResponse));
            $chatLogRecordModel->set('message_datetime',$currentTime);
            $chatLogRecordModel->set('sender_id',$senderId);
            $chatLogRecordModel->set('module_record_id',$moduleRecordId);
            $chatLogRecordModel->set('assigned_user_id',$currentUserID);
            $chatLogRecordModel->set('message_important', $getNumberImportant);
            $chatLogRecordModel->set('message_read_unread', 'Unread');
            $chatLogRecordModel->set('sender_name', $senderName);
            $chatLogRecordModel->save();
            $chatLogId = $chatLogRecordModel->getId();
            if($chatLogId){
                if($logNumRows > 0){
                    $chatLogDetailsRecordModel = Vtiger_Record_Model::getInstanceById($chatLogDetailsId, 'CTChatLogDetails');
                    $chatLogDetailsRecordModel->set('mode', 'edit');
                }else{
                    $chatLogDetailsRecordModel = Vtiger_Record_Model::getCleanInstance('CTChatLogDetails');
                }//end of else
                $chatLogDetailsRecordModel->set('chat_type_id',$chatTypeId);
                $chatLogDetailsRecordModel->set('platform_unique_id',$facebookPageId);
                $chatLogDetailsRecordModel->set('conversation_id',$messageId);
                $chatLogDetailsRecordModel->set('message_type',$messageType);
                $chatLogDetailsRecordModel->set('message_body',json_encode($msgBody));
                $chatLogDetailsRecordModel->set('type','Send');
                $chatLogDetailsRecordModel->set('api_request', json_encode($sendPostFields));
                $chatLogDetailsRecordModel->set('api_response',json_encode($sendMessageResponse));
                $chatLogDetailsRecordModel->set('message_datetime',$currentTime);
                $chatLogDetailsRecordModel->set('sender_id',$senderId);
                $chatLogDetailsRecordModel->set('module_record_id',$moduleRecordId);
                $chatLogDetailsRecordModel->set('assigned_user_id',$currentUserID);
                $chatLogDetailsRecordModel->set('chat_log_id',$chatLogId);
                $chatLogDetailsRecordModel->set('message_important', $getNumberImportant);
                $chatLogDetailsRecordModel->set('message_read_unread', 'Unread');
                $chatLogDetailsRecordModel->set('sender_name', $senderName);
                $chatLogDetailsRecordModel->save();
            }//end of if
        }
    }
}