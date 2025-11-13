<?php
/*+**********************************************************************************
* The content of this file is subject to the CRMTiger Pro license.
* ("License"); You may not use this file except in compliance with the License
* The Initial Developer of the Original Code is vTiger
* The Modified Code of the Original Code owned by https://crmtiger.com/
* Portions created by CRMTiger.com are Copyright(C) CRMTiger.com
* All Rights Reserved.
************************************************************************************/
class CTChatLog_FacebookChatPopup_View extends Vtiger_IndexAjax_View {
	function __construct() {
		$this->exposeMethod('chatPopup');
		$this->exposeMethod('sentFacebookMsg');
		$this->exposeMethod('allowAccessFacebook');
		$this->exposeMethod('checkNotificationCount');
	}//end of function

	function chatPopup(Vtiger_Request $request) { 
		global $adb, $site_URL, $current_user;

		$is_admin = $current_user->is_admin;
		$moduleName = $request->getModule();
		$currentDateTime = Vtiger_Util_Helper::convertDateTimeIntoUsersDisplayFormat(date("Y-m-d h:i:sA"));
		
		$recordId = $request->get('recordId');
		$sourceModuleName = $request->get('sourceModuleName');
		$viewer = $this->getViewer($request);
		$themeView = CTChatLog_Record_Model::getFacebookTheme();

		$currenUserID = $current_user->id;
        	$facebookPageId = $senderName = '';
        	$setype = CTChatLog_Record_Model::getSeType($recordId);
		if($setype){
			$recordModel = Vtiger_Record_Model::getInstanceById($recordId, $sourceModuleName);
			$fullName = $recordModel->get('label');

			//code to display profile picture
			$nameParts = explode(' ', $fullName);
			$initials = '';
			foreach ($nameParts as $part) {
                    if (CTChatLog_Record_Model::isArabic($part)) {
                        $initials .= mb_substr($part, 0, 2, 'UTF-8');
                    } else {
                        $nameString = strtoupper($part[0]) . '';
                        $initials .= substr($nameString, 0, 2);
                    }//end of else
               }
               $initials = trim($initials);
               $profileImage = $initials;
			
			$commentModuleEnable = CTChatLog_Record_Model::checkCommentModuleEnable($sourceModuleName);
			$facebookMessages = CTChatLog_Record_Model::getIndividualMessages($recordId);
			$senderId = $facebookMessages[0]['senderId'];
		}else{
			$facebookMessages = CTChatLog_Record_Model::getIndividualMessages($recordId);
			$senderId = $recordId;
			$recordId = '';
			if($facebookMessages[0]['senderName'] != ''){
				$fullName = $facebookMessages[0]['senderName'];
			}else{
				$fullName = $recordId;
			}

			//code to display profile picture
			$nameParts = explode(' ', $fullName);
			$initials = '';
			foreach ($nameParts as $part) {
                    if (CTChatLog_Record_Model::isArabic($part)) {
                        $initials .= mb_substr($part, 0, 2, 'UTF-8');
                    } else {
                        $nameString = strtoupper($part[0]) . '';
                        $initials .= substr($nameString, 0, 2);
                    }//end of else
               }
               $initials = trim($initials);
               $profileImage = $initials;			
		}
		
		$facebookPageId = $facebookMessages[0]['facebookPageId'];
		$senderName = $facebookMessages[0]['senderName'];
		
		$facebookAllPageList = CTChatLog_Record_Model::getAllConnectedUsersFacebookPage($currenUserID);
		$facebookPageName = $facebookAllPageList[$facebookPageId];

		$facebookFolderPath = "/modules/CTChatLog/CTChatLogStorage/";
		$year  = date('Y');
		$month = date('F');
		$day   = date('j');
		if ($day > 0 && $day <= 7)
			$week = 'week1';
		elseif ($day > 7 && $day <= 14)
			$week = 'week2';
		elseif ($day > 14 && $day <= 21)
			$week = 'week3';
		elseif ($day > 21 && $day <= 28)
			$week = 'week4';
		else
			$week = 'week5';
			
		$facebookStorage = $site_URL.$facebookFolderPath . "$year/$month/$week/";
		$viewer->assign('MODULE', $moduleName);
		$viewer->assign('ISADMIN', $is_admin);
		$viewer->assign('PROFILEIMAGE', $profileImage);
		$viewer->assign('FULLNAME', $fullName);
		$viewer->assign('COMMETNMODULE', $commentModuleEnable);
		$viewer->assign('FACEBOOKMESSAGES', $facebookMessages);
		$viewer->assign('SOURCEMODULE', $sourceModuleName);
		$viewer->assign('CURRENTDATETIME', $currentDateTime);
		$viewer->assign('CURRENUSERNAME', $current_user->first_name.' '.$current_user->last_name);
		$viewer->assign('SENDER_ID', $senderId);
		$viewer->assign('RECORDID', $recordId);
		$viewer->assign("FACEBOOK_PAGE_ID", $facebookPageId);
		$viewer->assign("FACEBOOK_PAGES_LIST",$facebookAllPageList);
		$viewer->assign("FACEBOOK_PAGE_NAME", $facebookPageName);
		$viewer->assign("SENDER_NAME", $senderName);
		$viewer->assign('FACEBOOK_STORAGE_URL', $facebookStorage);
		if($themeView == 'RTL'){
			echo $viewer->view('ChatPopupRTL.tpl', $moduleName, true);
		}else{
			echo $viewer->view('ChatPopup.tpl', $moduleName, true);
		}
	}//end of function

	function sentFacebookMsg(Vtiger_Request $request){
		$sendMessageData = CTChatLog_Record_Model::sendIndividulMessage($request);

		if($sendMessageData){
			$response = new Vtiger_Response();
			$response->setResult(array('sendMessage' => true, 'fileName' => $sendMessageData['newFilename']));
			$response->emit();
		}
	}

	function allowAccessFacebook(Vtiger_Request $request) {
		$allowToFacebookModule = CTChatLog_Record_Model::getAllowToFacebookModule($request);
		$iconActive = $allowToFacebookModule['iconActive'];
		$active = $allowToFacebookModule['active'];
		$senderId = $allowToFacebookModule['senderId'];
		$unreadmsg = $allowToFacebookModule['unreadmsg'];

		if($iconActive == 1 && $active == 1){
			$response = new Vtiger_Response();
			$response->setResult(array('iconActive'=> $iconActive,'active' => $active, 'senderId' => $senderId, 'unreadmsg' => $unreadmsg));
			$response->emit();
		}
	}//end of function

	function checkNotificationCount(Vtiger_Request $request) {
		global $adb, $current_user, $site_URL;
		$moduleName = $request->getModule();
		$facebookPageId = $request->get('facebookPageId');
		$senderId = $request->get('senderId');

		$notificationToneEnable = CTChatLog_Record_Model::getAllUnreadMessagesCount();
		$notificationTone = '';
		if($notificationToneEnable){
		 	$notificationTone = CTChatLog_Record_Model::getNotificationTone();
		}

        	$senderName = CTChatLog_Record_Model::getSenderNameBasedOnSenderId($senderId, $facebookPageId);
        	$response = new Vtiger_Response();
		$response->setResult(array('notificationTone'=> $site_URL.$notificationTone, 'senderName' => $senderName));
		$response->emit();
	}
}//end of class
?>