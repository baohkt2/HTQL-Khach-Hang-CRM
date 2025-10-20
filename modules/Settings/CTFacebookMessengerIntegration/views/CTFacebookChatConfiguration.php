<?php
/* * *******************************************************************************
* The content of this file is subject to the CRMTiger Pro license.
* ("License"); You may not use this file except in compliance with the License
* The Initial Developer of the Original Code is vTiger
* The Modified Code of the Original Code owned by https://crmtiger.com/
* Portions created by CRMTiger.com are Copyright(C) CRMTiger.com
* All Rights Reserved.
* ****************************************************************************** */
class Settings_CTFacebookMessengerIntegration_CTFacebookChatConfiguration_View extends Settings_Vtiger_Index_View {
	function __construct() {
		parent::__construct();
		$this->exposeMethod('addFacebookPagesPopup');
		$this->exposeMethod('saveFacebookPageConfig');
		$this->exposeMethod('deleteFacebookPageConfig');
		$this->exposeMethod('changeStatusFacebookPageConfig');
		$this->exposeMethod('checkFacebookPageConfigValidation');
		$this->exposeMethod('logoutFacebook');
		$this->exposeMethod('syncFacebookPages');
		$this->exposeMethod('addNewFBFieldPopup');
		$this->exposeMethod('getModuleFields');
		$this->exposeMethod('saveFBField');
		$this->exposeMethod('getActiveFacebookPages');
	}//end of function	

	function process(Vtiger_Request $request) {
		$mode = $request->get('mode');
		if(!empty($mode)) {
			$this->invokeExposedMethod($mode, $request);
			return;
		}
	}//end of function	

	public function addFacebookPagesPopup(Vtiger_Request $request){
		require 'modules/CTFacebookMessengerIntegration/Facebook/config.php';
		global $adb, $current_user, $site_URL;

		$userId = $current_user->id;
		$currentDateTime = date('Y-m-d H:i:s');
		$moduleName = $request->getModule();
		$recordId = $request->get('recordId');
		$qualifiedModuleName = $request->getModule(false);
		$viewer = $this->getViewer($request);
		$graphAPIEndPoint = $facebookAppConfig['graphAPIEndPoint'];

		$getChatAccessTokenData =  Settings_CTFacebookMessengerIntegration_Record_Model::getCTFacebookMessengerIntegrationData("ct_chat_chattype ctc 
          INNER JOIN ct_chat_token ctt ON ctc.chat_type_id = ctt.chat_type_id", array('ctc.*, ctt.*'), array('ctc.platform' => 'Facebook Messenger'));
        $numRows = $adb->num_rows($getChatAccessTokenData);

        if($numRows > 0){
        	$accessToken = $adb->query_result($getChatAccessTokenData, 0, 'access_token');
   			$chatTypeId = $adb->query_result($getChatAccessTokenData, 0, 'chat_type_id');
   			$expiresIn = $adb->query_result($getChatAccessTokenData, 0, 'expires_in');
   			$dateModified = $adb->query_result($getChatAccessTokenData, 0, 'date_modified');
   			if($expiresIn != 0 && $expiresIn != ''){
   				$expiredDate = date('Y-m-d H:i:s', strtotime($dateModified) + (int)$expiresIn);
	   			if(strtotime($expiredDate) < strtotime($currentDateTime)){
		   			//get new access token and update 
		            $replaceAccessTokenURL = $graphAPIEndPoint.'oauth/access_token?grant_type=fb_exchange_token&client_id='.$facebookAppConfig['appId'].'&client_secret='.$facebookAppConfig['appSecret'].'&fb_exchange_token='.$accessToken;

		            $replacedAccessToken = Settings_CTFacebookMessengerIntegration_Record_Model::callFacebookMessengerAPI($replaceAccessTokenURL,'GET');
		            $accessToken = $replacedAccessToken['access_token'];
		            $expiresIn = $replacedAccessToken['expires_in'];
		            if(isset($replacedAccessToken['access_token']) && !empty($replacedAccessToken['access_token'])){
		            	$adb->pquery("UPDATE ct_chat_token SET access_token = ?, modified_by = ?, date_modified = ?, expires_in = ? WHERE chat_type_id = ?",array($replacedAccessToken['access_token'], $userId, $currentDateTime, $expiresIn, $chatTypeId));
		            }
		        }
	        }
		}

		//get facebook pages
		$getFacebookPagesData = Settings_CTFacebookMessengerIntegration_Record_Model::getCTFacebookMessengerIntegrationData("ct_chat_sync_facebook_pages", array('facebook_pages'), array('chat_type_id' => $chatTypeId));
        $numRows = $adb->num_rows($getFacebookPagesData);

        $getFacebookPageEndPoint = $graphAPIEndPoint."me/accounts?access_token=".$accessToken;
        $facebookAllPageList = Settings_CTFacebookMessengerIntegration_Record_Model::getFacebookPages($getFacebookPageEndPoint);

        $facebookPageDetailsArray = array();
   		foreach ($facebookAllPageList as $key => $value) {
        	$facebookPageDetailsArray[$value['pageId']] = $value['pageName'];
        	
    		//Subscribe Page
    		$subscribedPage = $graphAPIEndPoint.$value['pageId']."/subscribed_apps?subscribed_fields=messages,message_reactions&access_token=".$value['accessToken'];	
        	$subscribePageData = Settings_CTFacebookMessengerIntegration_Record_Model::callFacebookMessengerAPI($subscribedPage,'POST');
        	
        	$dynamicUrl = $site_URL.'getReceivedFacebookMessages.php';
        	$facebookLicenseKey = Settings_CTFacebookMessengerIntegration_License_View::getLicenseKey();
        	$pageSubscribeData = json_encode(array('url' => $dynamicUrl, 'pageId' => $value['pageId'], 'status' => 'active', 'Licensekey' => $facebookLicenseKey));

    		$curlURL = 'https://notify.crmtiger.com/Facebook/SubscribeFacebook';
			$ch = curl_init();
			$curlOpts = array (
				CURLOPT_URL => $curlURL,
				CURLOPT_RETURNTRANSFER => TRUE,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POST => 1,
				CURLOPT_POSTFIELDS => $pageSubscribeData,
				CURLOPT_HTTPHEADER => array (
			    	'Content-type: application/json'
				)
			);

			foreach ($curlOpts as $index => $value) {
			    curl_setopt($ch, $index, $value);
			}//end of foreach
			$curlResponse = curl_exec($ch);
			curl_close($ch);
        }//end of foreach

        if($numRows > 0){
			$facebookPageList = $adb->query_result($getFacebookPagesData, 0, 'facebook_pages');
        }else{
        	$adb->pquery("INSERT INTO ct_chat_sync_facebook_pages (chat_type_id, facebook_pages, created_by, modified_by, date_created, date_modified, active) VALUES (?, ?, ?, ?, ?, ?, ?)",array($chatTypeId, json_encode($facebookPageDetailsArray), $userId, $userId, $currentDateTime, $currentDateTime, '1'));

        	$getFacebookPagesData = Settings_CTFacebookMessengerIntegration_Record_Model::getCTFacebookMessengerIntegrationData("ct_chat_sync_facebook_pages", array('facebook_pages'), array('chat_type_id' => $chatTypeId));
        	$numRows = $adb->num_rows($getFacebookPagesData);
        	if($numRows > 0){
	            $facebookPageList = $adb->query_result($getFacebookPagesData, 0, 'facebook_pages');
	        }//end of if
        }//end of else

        $facebookPageList = json_decode(html_entity_decode($facebookPageList));
        $facebookPageConfigData = array();
        if($recordId != ''){
        	$getFacebookPageConfigData = Settings_CTFacebookMessengerIntegration_Record_Model::getCTFacebookMessengerIntegrationData('ct_chat_facebook_messenger_page_configuration', array('*'), $whereData=array('facebook_messenger_config_id' => $recordId));

        	$facebookPageId = $adb->query_result($getFacebookPageConfigData, 0, 'facebook_page_id');
        	$allowUsersGroups = json_decode(html_entity_decode($adb->query_result($getFacebookPageConfigData, 0, 'allow_users_groups')));
        	$active = $adb->query_result($getFacebookPageConfigData, 0, 'active');
        	$facebookPageConfigData = array('facebookPageId' => $facebookPageId, 'allowUsersGroups' => $allowUsersGroups, 'active' => $active);
        }//end of if

        $viewer->assign('CHATTYPEID', $chatTypeId);
		$viewer->assign('MODULE', $qualifiedModuleName);
		$viewer->assign("FACEBOOK_PAGE_LIST", $facebookPageList);
		$viewer->assign('USER_MODEL', Users_Record_Model::getCurrentUserModel());
		$viewer->assign("FACEBOOK_PAGE_DATA", $facebookPageConfigData);
		$viewer->assign("RECORD_ID",$recordId);
		
		echo $viewer->view('AddFacebookPagesPopup.tpl', $qualifiedModuleName, true);
	}//end of function	

	public function saveFacebookPageConfig(Vtiger_Request $request){
		global $adb, $current_user;
		
		$userId = $current_user->id;
        $currentDateTime = date('Y-m-d H:i:s');
		$qualifiedModuleName = $request->getModule(false);
		
		$requestData = $request->get('formData');
		$decodedString = urldecode($requestData);
		parse_str($decodedString, $formData);
		$allowUsersGroups = json_encode($formData['facebookUsersGroups']);

		//for active checkbox
		$formData['facebookConfigActive'] = isset($formData['facebookConfigActive']) ? 1 : 0;
		$chatTypeId = $formData['chatTypeId'];

		if($formData['recordId'] != ''){
			$adb->pquery("UPDATE ct_chat_facebook_messenger_page_configuration SET allow_users_groups = ?, active = ?, modified_by = ?, date_modified = ?  WHERE facebook_messenger_config_id = ? ",array($allowUsersGroups, $formData['facebookConfigActive'], $userId, $currentDateTime, $formData['recordId']));
		}else{
			$adb->pquery("INSERT INTO ct_chat_facebook_messenger_page_configuration(chat_type_id,facebook_page_id,allow_users_groups,created_by,modified_by,date_created,date_modified,active) VALUES(?,?,?,?,?,?,?,?)", array($chatTypeId, $formData['pageId'], $allowUsersGroups, $userId, $userId, $currentDateTime, $currentDateTime, $formData['facebookConfigActive']));
		}//end of else

		$facebookIntegrationConfigData =array();
		$getFacebookPagesData =  Settings_CTFacebookMessengerIntegration_Record_Model::getCTFacebookMessengerIntegrationData("ct_chat_sync_facebook_pages", array('facebook_pages'), array('chat_type_id' => $chatTypeId));
        $numRows = $adb->num_rows($getFacebookPagesData);

        if($numRows > 0){
       		$facebookPageList = $adb->query_result($getFacebookPagesData, 0, 'facebook_pages');
       		$allFacebookPageData = json_decode(html_entity_decode($facebookPageList), true);

			$getCTFacebookPagesData = Settings_CTFacebookMessengerIntegration_Record_Model::getCTFacebookMessengerIntegrationData('ct_chat_facebook_messenger_page_configuration', array('*'), $whereData=array());
			$facebookConfigRows = $adb->num_rows($getCTFacebookPagesData);

			if($facebookConfigRows > 0){
	            $currentUserModel = Users_Record_Model::getCurrentUserModel();
	            $userList = $currentUserModel->getAccessibleUsers();
	            $groupsList = $currentUserModel->getAccessibleGroups();

	            for ($i=0; $i < $facebookConfigRows; $i++) {                 
	                $facebookPageId = $adb->query_result($getCTFacebookPagesData, $i, 'facebook_page_id');
	                $configId = $adb->query_result($getCTFacebookPagesData, $i, 'facebook_messenger_config_id');
	                
	                if(isset($allFacebookPageData) && array_key_exists($facebookPageId, $allFacebookPageData)){
	                    $facebookPageName = $allFacebookPageData[$facebookPageId];
	                }//end of if

	                $active = $adb->query_result($getCTFacebookPagesData, $i, 'active');
	                $allowUsersGroupsArray = json_decode(html_entity_decode($adb->query_result($getCTFacebookPagesData, $i, 'allow_users_groups')));
	                $userGroupNames = '';
	                
	                foreach ($allowUsersGroupsArray as $key => $value) {
	                    if(array_key_exists($value, $userList)){
	                        $userGroupNames .= $userList[$value];
	                    }//end of if
	                    if(array_key_exists($value, $groupsList)){
	                        $userGroupNames .= $groupsList[$value];
	                    }//end of if
	                    if($userGroupNames != ''){
	                        $userGroupNames .= '<br>';
	                    }//end of if
	                }//end of foreach
	                
	                $facebookIntegrationConfigData[] = array('configId' => $configId,'active' => $active,'facebookPageName' => $facebookPageName, 'userGroupNames' => $userGroupNames);
	            }//end of for
			}//end of if
		}//end of if

		$pageHtml = '';
		if(!empty($facebookIntegrationConfigData)){
			foreach ($facebookIntegrationConfigData as $key => $pageData) {
				if($pageData['active'] == '1'){
                    $statusActive = 'Active';
                }else{
                    $statusActive = 'Inactive';
                }//end of else

				$pageHtml .= '<tr><td>'.$pageData['facebookPageName'].'</td><td>'.$pageData['userGroupNames'].'</td><td>'.$statusActive.'</td><td><a class="editFacebookPageConfig" data-id="'.$pageData['configId'].'"><i class="fa fa-pencil" title="'.vtranslate('LBL_EDIT', $qualifiedModuleName).'"></i></a>&nbsp;&nbsp<span class="deleteFacebookPageConfig" data-id="'.$pageData['configId'].'"><i class="fa fa-trash" title="'.vtranslate('LBL_DELETE', $qualifiedModuleName).'"></i></span>&nbsp;&nbsp</td></tr>';
			}//end of foreach
		}//end of if
		
		$response = new Vtiger_Response();
        $response->setResult(array('pageHtml' => $pageHtml));
        $response->emit();
	}//end of function	

	public function deleteFacebookPageConfig(Vtiger_Request $request){
		global $adb;

		$recordId = $request->get('recordId');
		$adb->pquery("DELETE FROM ct_chat_facebook_messenger_page_configuration WHERE facebook_messenger_config_id = ?", array($recordId));
	}//end of function	

	public function changeStatusFacebookPageConfig(Vtiger_Request $request){
		global $adb;
		$recordId = $request->get('recordId');
		
		if($request->get('status') == 'on'){
			$status = '1';			
		}else{
			$status = '0';
		}

		$adb->pquery("UPDATE ct_chat_facebook_messenger_page_configuration SET active = ? WHERE  facebook_messenger_config_id = ? ",array($status, $recordId));
	}//end of function	

	public function checkFacebookPageConfigValidation(Vtiger_Request $request){
		global $adb;
		$facebookPageId = $request->get('pageId');
		$getFacebookPageConfigData = Settings_CTFacebookMessengerIntegration_Record_Model::getCTFacebookMessengerIntegrationData('ct_chat_facebook_messenger_page_configuration', array('*'), $whereData=array('facebook_page_id' => $facebookPageId));

		$pageId = $adb->query_result($getFacebookPageConfigData, 0, 'facebook_page_id');
        echo $pageId;
	}//end of function	

	public function logoutFacebook(Vtiger_Request $request){
		global $adb;
		$adb->pquery("TRUNCATE TABLE ct_chat_facebook_messenger_page_configuration");
		$adb->pquery("TRUNCATE TABLE ct_chat_token");
		$adb->pquery("TRUNCATE TABLE ct_chat_field_mapping");			
		$adb->pquery("TRUNCATE TABLE ct_chat_general_settings");
		$adb->pquery("TRUNCATE TABLE ct_chat_sync_facebook_pages");

		$loadUrl = 'index.php?module=CTFacebookMessengerIntegration&parent=Settings&view=CTFacebookMessengerIntegrationList';
        $response = new Vtiger_Response();
        $response->setResult(array('redirectURL' => $loadUrl));
        $response->emit();
	}//end of function

	public function syncFacebookPages(Vtiger_Request $request){
		global $adb, $current_user, $site_URL;
		require 'modules/CTFacebookMessengerIntegration/Facebook/config.php';

		$userId = $current_user->id;
        $currentDateTime = date('Y-m-d H:i:s');

		//get access token data
		$getChatAccessTokenData =  Settings_CTFacebookMessengerIntegration_Record_Model::getCTFacebookMessengerIntegrationData("ct_chat_chattype ctc 
          INNER JOIN ct_chat_token ctt ON ctc.chat_type_id = ctt.chat_type_id", array('ctc.*, ctt.*'), array('ctc.platform' => 'Facebook Messenger'));
        $numRows = $adb->num_rows($getChatAccessTokenData);
        
        $graphAPIEndPoint = $facebookAppConfig['graphAPIEndPoint'];

		if($numRows > 0){
   			$accessToken = $adb->query_result($getChatAccessTokenData, 0, 'access_token');
   			$chatTypeId = $adb->query_result($getChatAccessTokenData, 0, 'chat_type_id');
   			$expiresIn = $adb->query_result($getChatAccessTokenData, 0, 'expires_in');
   			$dateModified = $adb->query_result($getChatAccessTokenData, 0, 'date_modified');
   			if($expiresIn != 0){
   				$expiredDate = date('Y-m-d H:i:s', strtotime($dateModified) + $expiresIn);
	   			if(strtotime($expiredDate) < strtotime($currentDateTime)){
		   			//get new access token and update 
		            $replaceAccessTokenURL = $graphAPIEndPoint.'oauth/access_token?grant_type=fb_exchange_token&client_id='.$facebookAppConfig['appId'].'&client_secret='.$facebookAppConfig['appSecret'].'&fb_exchange_token='.$accessToken;

		            $replacedAccessToken = Settings_CTFacebookMessengerIntegration_Record_Model::callFacebookMessengerAPI($replaceAccessTokenURL,'GET');
		            $accessToken = $replacedAccessToken['access_token'];
		            if(isset($replacedAccessToken['access_token']) && !empty($replacedAccessToken['access_token'])){
		            	$adb->pquery("UPDATE ct_chat_token SET access_token = ?, modified_by = ?, date_modified = ?, expires_in = ? WHERE chat_type_id = ?",array($replacedAccessToken['access_token'], $userId, $currentDateTime, $expiresIn, $chatTypeId));
		            }
		        }
	        }
   		}

   		//get facebook pages
        $getFacebookPageEndPoint = $graphAPIEndPoint."me/accounts?access_token=".$accessToken;
        $facebookPageList = Settings_CTFacebookMessengerIntegration_Record_Model::getFacebookPages($getFacebookPageEndPoint);
        
        foreach ($facebookPageList as $key => $value) {
        	$facebookPageDetailsArray[$value['pageId']] = $value['pageName'];

    		//Subscribe Page
    		$subscribedPage = $graphAPIEndPoint.$value['pageId']."/subscribed_apps?subscribed_fields=messages&access_token=".$value['accessToken'];	
        	$subscribePageData = Settings_CTFacebookMessengerIntegration_Record_Model::callFacebookMessengerAPI($subscribedPage,'POST');

        	$dynamicUrl = $site_URL.'getReceivedFacebookMessages.php';
        	$facebookLicenseKey = Settings_CTFacebookMessengerIntegration_License_View::getLicenseKey();
        	$pageSubscribeData = json_encode(array('url' => $dynamicUrl, 'pageId' => $value['pageId'], 'status' => 'active', 'Licensekey' => $facebookLicenseKey));

    		$curlURL = 'https://notify.crmtiger.com/Facebook/SubscribeFacebook';
			$ch = curl_init();
			$curlOpts = array (
				CURLOPT_URL => $curlURL,
				CURLOPT_RETURNTRANSFER => TRUE,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POST => 1,
				CURLOPT_POSTFIELDS => $pageSubscribeData,
				CURLOPT_HTTPHEADER => array (
			    	'Content-type: application/json'
				)
			);

			foreach ($curlOpts as $index => $value) {
			    curl_setopt($ch, $index, $value);
			}//end of foreach
			$curlResponse = curl_exec($ch);
			curl_close($ch);
        }

        $getFacebookPagesData = Settings_CTFacebookMessengerIntegration_Record_Model::getCTFacebookMessengerIntegrationData("ct_chat_sync_facebook_pages", array('facebook_pages'), array('chat_type_id' => $chatTypeId));
        $numRows = $adb->num_rows($getFacebookPagesData);

        if($numRows > 0){
        	$adb->pquery("UPDATE ct_chat_sync_facebook_pages SET facebook_pages = ?, modified_by = ?, date_modified = ?  WHERE chat_type_id = ?", array(json_encode($facebookPageDetailsArray),$userId,$currentDateTime,$chatTypeId));
        }else{
        	$adb->pquery("INSERT INTO ct_chat_sync_facebook_pages (chat_type_id, facebook_pages, created_by, modified_by, date_created, date_modified, active) VALUES (?, ?, ?, ?, ?, ?, ?)",array($chatTypeId, json_encode($facebookPageDetailsArray), $userId, $userId, $currentDateTime, $currentDateTime, '1'));	
        }
        
        $response = new Vtiger_Response();
        $response->setResult(array('facebookPageList' => $facebookPageDetailsArray));
        $response->emit();
	}//end of function	

	public function addNewFBFieldPopup(Vtiger_Request $request){
		global $adb;
		$moduleName = $request->getModule();
		$qualifiedModuleName = $request->getModule(false);

		$allModules = Vtiger_Menu_Model::getAll(true);
		$allowFacebookModules = array();
		foreach ($allModules as $key => $value) {
			$allowFacebookModules[$key] = $key;			
		} 

		unset($allowFacebookModules['EmailTemplates']);
		unset($allowFacebookModules['CTChatLog']);
		unset($allowFacebookModules['CTChatLogDetails']);
		unset($allowFacebookModules['RecycleBin']);
		
		$viewer = $this->getViewer($request);
		$viewer->assign('QUALIFIED_MODULE',$qualifiedModuleName);
		$viewer->assign('ALLOW_FACEBOOK_MODULES',$allowFacebookModules);
		echo $viewer->view('AddNewFBFieldPopup.tpl', $qualifiedModuleName, true);
	}//end of function	

	public function getModuleFields(Vtiger_Request $request){
		global $adb;
		$moduleName = $request->getModule();
		$select_module = $request->get('select_module');
		$tabid = getTabid($select_module);

		$getModuleFields = Settings_CTFacebookMessengerIntegration_Record_Model::getCTFacebookMessengerIntegrationData("ct_chat_field_mapping", array('*'), array('module' => $select_module));
		$rows = $adb->num_rows($getModuleFields);

        if($rows > 0){
        	$active = $adb->query_result($getModuleFields, 0, 'active');
            $field = $adb->query_result($getModuleFields, 0, 'field');

            $allwModules = array('active' => $active, 'field' => $field, 'rows' => $rows);
        }
		
		$moduleModel = Vtiger_Module_Model::getInstance($select_module);
		$fields = $moduleModel->getFields();

		$fieldsData = '';
		foreach ($fields as $key => $value) {
			$fieldlabel = $value->label;
			$fieldname = $value->name;
			if($fieldname == $field){
				$fieldsData .= '<option value="'.$value->name.'" selected>'.vtranslate($value->label, $select_module).'</option>';
			}else{
				$fieldsData .= '<option value="'.$value->name.'">'.vtranslate($value->label, $select_module).'</option>';
			}
		}

		$response = new Vtiger_Response();
		$response->setResult(array('picklist' => $fieldsData, 'active' => $active, 'rows' => $rows));
		$response->emit();
	}//end of function	

	public function saveFBField(Vtiger_Request $request){
		global $adb,$current_user;
		$moduleName = $request->getModule();
		$qualifiedModuleName = $request->getModule(false);
		$select_module = $request->get('select_module');
		$facebookActive = $request->get('facebookActive');

		$tabId = getTabid($select_module);
		$relatedTabId = getTabid('CTChatLog');
		if($facebookActive == 1){
			$getFaceBookTabs = $adb->pquery("SELECT * FROM `vtiger_relatedlists` WHERE tabid = ? AND related_tabid = ?",array($tabId,$relatedTabId));
			if($adb->num_rows($getFaceBookTabs) == 0){
				$CTChatLogModule = Vtiger_Module::getInstance('CTChatLog');
				$label = 'Facebook Messenger History';
				$contactsmodule = Vtiger_Module::getInstance($select_module);
				$contactsmodule->setrelatedlist($CTChatLogModule, $label, array(), 'get_dependents_list');
			}
			if($adb->num_rows($getFaceBookTabs) > 0){
				$adb->pquery("UPDATE `vtiger_relatedlists` SET `presence` = '0' WHERE tabid = ? AND related_tabid = ?",array($tabId,$relatedTabId));
			}
		}
		if($facebookActive == 0){
			$getFaceBookTabsName = $adb->pquery("SELECT * FROM `vtiger_relatedlists` WHERE tabid = ? AND related_tabid = ?",array($tabId,$relatedTabId));
			if($adb->num_rows($getFaceBookTabsName) > 0){
				$adb->pquery("UPDATE `vtiger_relatedlists` SET `presence` = '1' WHERE tabid = ? AND related_tabid = ?",array($tabId,$relatedTabId));
			}	
		}

		//get access token data
		$getChatAccessTokenData =  Settings_CTFacebookMessengerIntegration_Record_Model::getCTFacebookMessengerIntegrationData("ct_chat_chattype ctc 
          INNER JOIN ct_chat_token ctt ON ctc.chat_type_id = ctt.chat_type_id", array('ctc.*, ctt.*'), array('ctc.platform' => 'Facebook Messenger'));
        $numRows = $adb->num_rows($getChatAccessTokenData);

		if($numRows > 0){
   			$chatTypeId = $adb->query_result($getChatAccessTokenData, 0, 'chat_type_id');
   		}

   		$userId = $current_user->id;
        $currentDateTime = date('Y-m-d H:i:s');

		$query = $adb->pquery("SELECT * FROM ct_chat_field_mapping WHERE module = ?", array($select_module));
		$row = $adb->num_rows($query);
		if($row == 1){
			$adb->pquery("DELETE FROM ct_chat_field_mapping WHERE module = ?", array($select_module));
		}
		$adb->pquery("INSERT INTO ct_chat_field_mapping(chat_type_id,module,field,created_by,modified_by,date_created,date_modified,active) VALUES (?,?,?,?,?,?,?,?)", array($chatTypeId,$select_module,'',$userId,$userId,$currentDateTime,$currentDateTime,$facebookActive));

		$allowmodules = Settings_CTFacebookMessengerIntegration_Record_Model::getAllowModules();

		$fbModuleHtml = '';
		if(!empty($allowmodules)){
			$fbModuleHtml .= '<thead><tr><th class="fieldLabel alignMiddle">'.vtranslate('LBL_MODULE', $qualifiedModuleName).'</th><th class="fieldLabel alignMiddle">'.vtranslate('LBL_ACTIVE', $qualifiedModuleName).'</th><th class="fieldLabel alignMiddle">'.vtranslate('LBL_ACTIONS', $qualifiedModuleName).'</th></tr></thead><tbody><input type="hidden" name="whatsappModuleRow" value="'.count($allowmodules).'">';

			foreach ($allowmodules as $allowModuleIndex => $allowModuleData) {
				if($allowModuleData['active'] == '1'){
                    $moduleActive = 'Active';
                }else{
                    $moduleActive = 'Inactive';
                }//end of else

				$fbModuleHtml .= '<tr><td>'.vtranslate($allowModuleIndex, $allowModuleIndex).'</td><td>'.$moduleActive.'</td><td class="fieldLabel alignMiddle" style="width:200px;"><a id="editFacebookModule" data-facebookmodulename="'.$allowModuleIndex.'" data-facebookmodulestatus="'.$allowModuleData['active'].'"><i class="fa fa-pencil" title="'.vtranslate('LBL_EDIT',$qualifiedModuleName).'"></i></a>&nbsp;&nbsp<a id="deletedFacebookModule" data-facebookmodulename="'.$allowModuleIndex.'"><i class="fa fa-trash" aria-hidden="true" title="'.vtranslate('LBL_DELETE',$qualifiedModuleName).'"></i></a>&nbsp;&nbsp</td></tr>';
				
			}//end of foreach
			$fbModuleHtml .= '</tbody>';
		}//end of if

		$response = new Vtiger_Response();
        $response->setResult(array('fbModuleHtml' => $fbModuleHtml));
        $response->emit();
	}//end of function

	public function getActiveFacebookPages(Vtiger_Request $request){
		global $adb;
		$getFacebookPageConfigData = Settings_CTFacebookMessengerIntegration_Record_Model::getCTFacebookMessengerIntegrationData('ct_chat_facebook_messenger_page_configuration', array('facebook_page_id'), $whereData=array('active' => 1));
		$numRows = $adb->num_rows($getFacebookPageConfigData);
		$facebookPageOptions = "<option value=''></option>";
		if($numRows > 0){
			$facebookPageData = $adb->pquery("SELECT * FROM ct_chat_sync_facebook_pages INNER JOIN ct_chat_chattype ON ct_chat_sync_facebook_pages.chat_type_id = ct_chat_chattype.chat_type_id  WHERE ct_chat_chattype.platform = 'Facebook Messenger'", array());
	        $facebookPageEncodedList = $adb->query_result($facebookPageData, 0, 'facebook_pages');
	        $facebookPageList = json_decode(html_entity_decode($facebookPageEncodedList), true);

	        for($i=0;$i<$numRows;$i++){
	        	$facebookPageId = $adb->query_result($getFacebookPageConfigData, $i, 'facebook_page_id');
	        	$facebookPageName = $facebookPageList[$facebookPageId];
	        	$facebookPageOptions .= "<option value='".$facebookPageId."'>".$facebookPageName."</option>";
	        }//end of for
		}//end of if

		echo $facebookPageOptions;
	}//end of function
}//end of class
?>