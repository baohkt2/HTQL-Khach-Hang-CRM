<?php
/* * *******************************************************************************
* The content of this file is subject to the CRMTiger Pro license.
* ("License"); You may not use this file except in compliance with the License
* The Initial Developer of the Original Code is https://crmtiger.com/
* Portions created by CRMTiger.com are Copyright(C) CRMTiger.com
* All Rights Reserved.
* ****************************************************************************** */
class Settings_CTFacebookMessengerIntegration_CTGeneralConfiguration_View extends Settings_Vtiger_Index_View {
	function __construct() {
		parent::__construct();
		$this->exposeMethod('saveFacebookGeneralSettings');
	}//end of function	

    public function process(Vtiger_Request $request) {
    	global $adb, $current_user;
        $mode = $request->get('mode');
       	if(!empty($mode)) {
			$this->invokeExposedMethod($mode, $request);
			return;
		}

        $qualifiedModuleName = $request->getModule(false);
        $viewer = $this->getViewer($request);
        $recordId = '';
        $generalSettingsData = $facebookIntegrationConfigData =array();
        
        //get access token data
        $getChatAccessTokenData =  Settings_CTFacebookMessengerIntegration_Record_Model::getCTFacebookMessengerIntegrationData("ct_chat_chattype ctc 
          INNER JOIN ct_chat_token ctt ON ctc.chat_type_id = ctt.chat_type_id", array('ctc.*, ctt.*'), array('ctc.platform' => 'Facebook Messenger'));
    	$accessTokenNumRows = $adb->num_rows($getChatAccessTokenData);

    	if($accessTokenNumRows > 0){
	        $accessToken = $adb->query_result($getChatAccessTokenData, 0, 'access_token');
	        $userName = $adb->query_result($getChatAccessTokenData, 0, 'username');
	        $chatTypeId = $adb->query_result($getChatAccessTokenData, 0, 'chat_type_id');

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
	    }else{
	    	header('Location:index.php?parent=Settings&module=CTFacebookMessengerIntegration&view=CTFacebookMessengerIntegrationList');
	    }//end of else
			
		//get Facebook General Settings data
		$getFacebookGeneralSettingsData = Settings_CTFacebookMessengerIntegration_Record_Model::getCTFacebookMessengerIntegrationData("ct_chat_general_settings", array('*'), array('chat_type_id' => $chatTypeId));
		$numRows = $adb->num_rows($getFacebookGeneralSettingsData);

        if($numRows > 0){
        	$recordId = $adb->query_result($getFacebookGeneralSettingsData, 0, 'id');
        	$chatTypeId = $adb->query_result($getFacebookGeneralSettingsData, 0, 'chat_type_id');
        	$fieldNameValueString = $adb->query_result($getFacebookGeneralSettingsData, 0, 'fieldname_value');
        	$fieldNameValueArray = json_decode(html_entity_decode($fieldNameValueString));
        	$active = $adb->query_result($getFacebookGeneralSettingsData, 0, 'active');	
			$generalSettingsData = array('fieldNameValue' => (array)$fieldNameValueArray, 'active' => $active);
		}

		$themeHtml = '<option value="">'.vtranslate('LBL_SELECT_OPTION',$qualifiedModuleName).'</option>';
		if(!empty($generalSettingsData)){
			if($generalSettingsData['fieldNameValue']['themeView'] == 'RTL'){
				$themeHtml .= '<option value="RTL" selected>'.vtranslate('LBL_RIGHT_TO_LEFT_VIEW', $qualifiedModuleName).'</option><option value="LTR">'.vtranslate('LBL_LEFT_TO_RIGHT_VIEW', $qualifiedModuleName).'</option>';
				
			}else if($generalSettingsData['fieldNameValue']['themeView'] == 'LTR'){
				$themeHtml .= '<option value="LTR" selected>'.vtranslate('LBL_LEFT_TO_RIGHT_VIEW', $qualifiedModuleName).'</option><option value="RTL">'.vtranslate('LBL_RIGHT_TO_LEFT_VIEW', $qualifiedModuleName).'</option>';
			}//end of else if
		}else{
			$themeHtml .= '<option value="RTL">'.vtranslate('LBL_RIGHT_TO_LEFT_VIEW', $qualifiedModuleName).'</option><option value="LTR" selected>'.vtranslate('LBL_LEFT_TO_RIGHT_VIEW', $qualifiedModuleName).'</option>';
		}//end of if

		$allowmodules = Settings_CTFacebookMessengerIntegration_Record_Model::getAllowModules();
		
		$viewer->assign('ALLLOWMODULES', $allowmodules);
		$viewer->assign("USER_NAME", $userName);
		$viewer->assign("ACCESSTOKEN", $accessToken);
		$viewer->assign('FACEBOOK_INTEGRATION_CONFIG_DATA', $facebookIntegrationConfigData);
		$viewer->assign('GENERALSETTINGSDATA', $generalSettingsData);
		$viewer->assign('CHATTYPEID', $chatTypeId);
		$viewer->assign("RECORD_ID",$recordId);
		$viewer->assign('QUALIFIED_MODULE', $qualifiedModuleName);
		$viewer->assign('THEME_HTML', $themeHtml);

        $getLicenseData = Settings_CTFacebookMessengerIntegration_License_View::getLicenseData();
        $licenseStatus = $getLicenseData['status'];
        if ($licenseStatus == 0){
            $viewer->view('License.tpl', $qualifiedModuleName);
        }else if ($licenseStatus == 2) {
            echo "<h3>".$getLicenseData['message']."</h3>";
        } else {
            $viewer->view('CTFacebookGenerealConfigurationList.tpl', $qualifiedModuleName);
        }//end of else
    }//end of function
    
     public function saveFacebookGeneralSettings(Vtiger_Request $request){
		global $adb, $current_user;
		
		$userId = $current_user->id;
        $currentDateTime = date('Y-m-d H:i:s');
		$requestData = $request->get('formData');
		parse_str($requestData, $formData);
		
		$getCTFacebookPagesData = Settings_CTFacebookMessengerIntegration_Record_Model::getCTFacebookMessengerIntegrationData('ct_chat_facebook_messenger_page_configuration', array('*'), $whereData=array('active' => '1'));
        $facebookConfigRows = $adb->num_rows($getCTFacebookPagesData);

        if($facebookConfigRows > 0){
        	$getChatAccessTokenData =  Settings_CTFacebookMessengerIntegration_Record_Model::getCTFacebookMessengerIntegrationData("ct_chat_chattype ctc INNER JOIN ct_chat_token ctt ON ctc.chat_type_id = ctt.chat_type_id", array('ctc.*, ctt.*'), array('ctc.platform' => 'Facebook Messenger'));
        	$numRows = $adb->num_rows($getChatAccessTokenData);

			if($numRows > 0){
	   			$chatTypeId = $adb->query_result($getChatAccessTokenData, 0, 'chat_type_id');
	   		}
	   		$query = $adb->pquery("SELECT * FROM ct_chat_field_mapping WHERE chat_type_id = ? AND active = ?", array($chatTypeId,1));
			$row = $adb->num_rows($query);
			if($row > 0){
				$facebookGeneralSettingActive = isset($formData['facebookGeneralSettingActive']) ? 1 : 0;
				$autoResponder = isset($formData['autoResponder']) ? 1 : 0;
				$autoResponderText = isset($formData['autoResponderText']) ? $formData['autoResponderText'] : '';
				$chatTypeId = $formData['chatTypeId'];
				$notificationtone = $formData['notificationtone'];

				$fieldNameValueArray = array('themeView' => $formData['facebookWindowView'], 'autoResponder' => $autoResponder, 'autoResponderText' => $autoResponderText,'notificationtone' => $notificationtone);
				$fieldNameValue = json_encode($fieldNameValueArray);

				if(isset($formData['recordId']) && $formData['recordId'] != ''){
					$adb->pquery("UPDATE ct_chat_general_settings SET chat_type_id = ?, fieldname_value = ?, modified_by = ?, date_modified = ?, active = ? WHERE id = ? ",array($chatTypeId, $fieldNameValue, $userId, $currentDateTime, $facebookGeneralSettingActive, $formData['recordId']));
				}else{
					$adb->pquery("INSERT INTO ct_chat_general_settings(chat_type_id,fieldname_value,created_by,modified_by,date_created,date_modified,active) VALUES(?,?,?,?,?,?,?)", array($chatTypeId, $fieldNameValue, $userId, $userId, $currentDateTime, $currentDateTime,$facebookGeneralSettingActive));
				}//end of else
			}else{
				$response = new Vtiger_Response();
		        $response->setResult(array('existModuleConfig' => 0, 'existPageConfig' => 1));
		        $response->emit();
			}
        }else{
        	$response = new Vtiger_Response();
	        $response->setResult(array('existPageConfig' => 0, 'existModuleConfig' => 0));
	        $response->emit();
        }
    }//end of function	

	public function getHeaderCss(Vtiger_Request $request) {
        $headerCssInstances = parent::getHeaderCss($request);
        $cssFileNames = array(
            '~/layouts/v7/modules/Settings/CTFacebookMessengerIntegration/resources/CTFacebookMessengerIntegration.css'
        );
        $cssInstances = $this->checkAndConvertCssStyles($cssFileNames);
        $headerCssInstances = array_merge($headerCssInstances, $cssInstances);
        return $headerCssInstances;
    }//end of function	
}//end of class
?>