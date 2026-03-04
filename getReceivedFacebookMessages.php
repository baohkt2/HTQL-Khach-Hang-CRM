<?php
require 'vendor/autoload.php';
include_once 'include/Webservices/Relation.php';
include_once 'vtlib/Vtiger/Module.php';
include_once 'includes/main/WebUI.php';
require 'modules/CTFacebookMessengerIntegration/Facebook/config.php';

global $current_user, $adb, $root_directory, $log, $site_URL;
$current_user = Users::getActiveAdminUser();
$currentTime = date('Y-m-d H:i:s');
$userId = $current_user->id;
$timeStamp = strtotime($currentTime);

$responseData = file_get_contents("php://input");
$jsonDecodeData = (array)json_decode($responseData);

$messageText = array();
if(isset($jsonDecodeData['object']) && $jsonDecodeData['object'] == 'page'){
	$entryData = (array)$jsonDecodeData['entry'][0];
	$messagingData = (array)$entryData['messaging'][0];
	$senderData = (array)$messagingData['sender'];
	$senderId = $senderData['id'];

	$recipientData = (array)$messagingData['recipient'];
	$recipientId = $recipientData['id'];
	$timestamp = $messagingData['timestamp'];
	$timestampConvert = $timestamp / 1000; // Convert milliseconds to seconds
	$messageDateTime = date('Y-m-d H:i:s', $timestampConvert);

	$messageData = (array)$messagingData['message'];
	$messageId = $messageData['mid'];

	$replayToConversationId = $mainMessageBody = '';
	if($messageData['reply_to']){
		$replyTo = (array)$messageData['reply_to'];
		$replayToConversationId = $replyTo['mid'];
	}//end of if

	if($replayToConversationId != ''){
		$replyMessageTextQuery = Settings_CTFacebookMessengerIntegration_Record_Model::getCTFacebookMessengerIntegrationData('vtiger_ctchatlogdetails INNER JOIN vtiger_crmentity ON vtiger_ctchatlogdetails.ctchatlogdetailsid = vtiger_crmentity.crmid', array('*'), array('platform_unique_id' => $recipientId, 'conversation_id' => $replayToConversationId));

        $rows = $adb->num_rows($replyMessageTextQuery);
        if($rows){
            $mainMessageBody = $adb->query_result($replyMessageTextQuery, 0, 'message_body');
        }//end of if
	}//end of if

	if(isset($messageData['attachments'])){
		foreach($messageData['attachments'] as $aKey => $aValue){
			$payloadURL = $messageData['attachments'][$aKey]->payload->url;
			if (strpos($payloadURL, 'facebook.com') !== false) {
				$url = urldecode($payloadURL);

				if (strpos($url, '?') !== false) {
					$url = explode('?', $url);
					$url = $url[1];
				}

				if (strpos($url, '&') !== false) {
					$url = explode('&', $url);
					$url = $url[0];
				}

				if (strpos($url, '=') !== false) {
					$url = explode('=', $url);
					$url = $url[1];
				}

				$messageText[] = $url;
				$messageType = 'text';	
			}else{

				$filename = basename(parse_url($payloadURL, PHP_URL_PATH));
				$filename = rand().$filename;
				$facebookFileStoragePath = "/modules/CTChatLog/CTChatLogStorage/";
	            $year  = date('Y');
	            $month = date('F');
	            $day   = date('j');
	            $week  = '';
	            if (!is_dir($root_directory.$facebookFileStoragePath)) {
	                //create new folder
	                mkdir($root_directory.$facebookFileStoragePath);
	                chmod($root_directory.$facebookFileStoragePath, 0777);
	            }

	            if (!is_dir($root_directory.$facebookFileStoragePath . $year)) {
	                //create new folder
	                mkdir($root_directory.$facebookFileStoragePath . $year);
	                chmod($root_directory.$facebookFileStoragePath . $year, 0777);
	            }

	            if (!is_dir($root_directory.$facebookFileStoragePath . $year . "/" . $month)) {
	                //create new folder
	                mkdir($root_directory.$facebookFileStoragePath . "$year/$month/");
	                chmod($root_directory.$facebookFileStoragePath . "$year/$month/", 0777);
	            }

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

	            if (!is_dir($root_directory.$facebookFileStoragePath . $year . "/" . $month . "/" . $week)) {
	                //create new folder
	                mkdir($root_directory.$facebookFileStoragePath . "$year/$month/$week/");
	                chmod($root_directory.$facebookFileStoragePath . "$year/$month/$week/", 0777);
	            }

	            $documentpath = 'storage';
	            $filepath = 'storage/';

	            if (!is_dir($root_directory.$filepath . $year)) {
	                //create new folder
	                mkdir($root_directory.$filepath . $year);
	                chmod($root_directory.$filepath . $year, 0777);
	            }

	            if (!is_dir($root_directory.$filepath . $year . "/" . $month)) {
	                //create new folder
	                mkdir($root_directory.$filepath . "$year/$month");
	                chmod($root_directory.$filepath . "$year/$month", 0777);
	            }

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

	            if (!is_dir($root_directory.$filepath . $year . "/" . $month . "/" . $week)) {
	                //create new folder
	                mkdir($root_directory.$filepath . "$year/$month/$week");
	                chmod($root_directory.$filepath . "$year/$month/$week", 0777);
	            }

	            $target_file = $root_directory.$filepath.$year.'/'.$month.'/'.$week.'/';
	           	$copyFile = copy($payloadURL, $target_file.$filename);
	           	if($copyFile){
	                $Document = Vtiger_Record_Model::getCleanInstance('Documents');
	                $Document->set('mode', '');
	                $Document->set('assigned_user_id',$current_user->id);
	                $Document->set('folderid', 1);
	                $Document->set('filelocationtype', 'I');
	                $Document->set('filestatus',1);
	                $Document->set('filename',$filename);
	                $Document->save();
	                $documentid = $Document->getId();
	                $current_id = $adb->getUniqueID("vtiger_crmentity");

	                $sql1 = "insert into vtiger_crmentity (crmid,smcreatorid,smownerid,setype,description,createdtime,modifiedtime) values(?, ?, ?, ?, ?, ?, ?)";
	                $params1 = array($current_id, $current_user->id, 1, "Documents Attachment", '', $adb->formatDate($currentTime, true), $adb->formatDate($currentTime, true));
	                $adb->pquery($sql1, $params1);
	                rename($target_file.$filename,$target_file.$current_id.'_'.$filename);
	                chmod($target_file, 0777);

	                $sql2 = "insert into vtiger_attachments(attachmentsid, name, description, type, path) values(?, ?, ?, ?, ?)";
	                $params2 = array($current_id, $filename, '', '', $filepath.$year.'/'.$month.'/'.$week.'/');
	                $result = $adb->pquery($sql2, $params2);

	                $sql3 = 'insert into vtiger_seattachmentsrel values(?,?)';
	                $adb->pquery($sql3, array($documentid, $current_id));

	                $sql4 = 'insert into vtiger_senotesrel values(?,?)';
	                $adb->pquery($sql4, array($moduleRecordid, $documentid));
	            }

	            $fileURL = $site_URL.'/'.$filepath.$year.'/'.$month.'/'.$week.'/'.$current_id.'_'.$filename;
	            $oldfile = $root_directory.$filepath.$year.'/'.$month.'/'.$week.'/'.$current_id.'_'.$filename;
	            $filename = str_replace(' ', '', $filename);
	            $newfile = $root_directory.$facebookFileStoragePath . "$year/$month/$week/".$filename;
	            copy($oldfile, $newfile);
	            $newFilename = urlencode($filename);
	            $newFilename = str_replace('+','%20',$newFilename);
	            $newFilename = str_replace('_','%5F',$newFilename);
	            $newFilename = str_replace('.','%2E',$newFilename);
	            $newFilename = str_replace('-','%2D',$newFilename); 
	            $newfileURL = $site_URL.'/'.$facebookFileStoragePath . "$year/$month/$week/".$newFilename;
	           	$messageText[] = $newfileURL;
				$messageType = 'attachment';
			}
		}
	}else{
		if(isset($messageData['text'])){
			$messageText[] = $messageData['text'];
		}else if(isset($messageData['emoji'])){
			$messageText[] = $messageData['emoji'];
		}//end of else if
		$messageType = 'text';	
	}

	$moduleRecordId = $chatLogDetailsId = '';
	$checkFacebookPageConfigurationStatus = Settings_CTFacebookMessengerIntegration_Record_Model::getCTFacebookMessengerIntegrationData('ct_chat_facebook_messenger_page_configuration', array('facebook_page_id'), array('facebook_page_id' => $recipientId, 'active' => 1));
	$numRows = $adb->num_rows($checkFacebookPageConfigurationStatus);

	if($numRows > 0){
		$checkExistingSenderLogData = Settings_CTFacebookMessengerIntegration_Record_Model::getCTFacebookMessengerIntegrationData('vtiger_ctchatlogdetails INNER JOIN vtiger_crmentity ON vtiger_ctchatlogdetails.ctchatlogdetailsid = vtiger_crmentity.crmid', array('module_record_id, ctchatlogdetailsid'), array('sender_id' => $senderId, 'vtiger_crmentity.deleted' => 0));
		$logNumRows = $adb->num_rows($checkExistingSenderLogData);
		
		if($logNumRows > 0){
			$moduleRecordId = $adb->query_result($checkExistingSenderLogData, 0, 'module_record_id');
			$chatLogDetailsId = $adb->query_result($checkExistingSenderLogData, 0, 'ctchatlogdetailsid');
		}//end of if

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
		       		$expiredDate = date('Y-m-d H:i:s', strtotime($dateModified) + $expiresIn);
		   			if(strtotime($expiredDate) < strtotime($currentTime)){
			   			//get new access token and update 
			            $replaceAccessTokenURL = $graphAPIEndPoint.'oauth/access_token?grant_type=fb_exchange_token&client_id='.$facebookAppConfig['appId'].'&client_secret='.$facebookAppConfig['appSecret'].'&fb_exchange_token='.$accessToken;

			            $replacedAccessToken = Settings_CTFacebookMessengerIntegration_Record_Model::callFacebookMessengerAPI($replaceAccessTokenURL,'GET');
			            if(isset($replacedAccessToken['access_token']) && !empty($replacedAccessToken['access_token'])){
			            	$accessToken = $replacedAccessToken['access_token'];
			            	$expiresIn = $replacedAccessToken['expires_in'];
			            	$adb->pquery("UPDATE ct_chat_token SET access_token = ?, modified_by = ?, date_modified = ?, expires_in = ? WHERE chat_type_id = ?",array($accessToken, $userId, $currentTime, $expiresIn, $chatTypeId));
			            }
			        }
		        }
			
		       	$getFacebookPageEndPoint = $graphAPIEndPoint."me/accounts?access_token=".$accessToken;
        		$facebookPageList = Settings_CTFacebookMessengerIntegration_Record_Model::getFacebookPages($getFacebookPageEndPoint);

        		if(!empty($facebookPageList)){
        			foreach ($facebookPageList as $key => $value) {
        				if($value['pageId'] == $recipientId){
        					$pageAccessTokenData = array('access_token' => $value['accessToken'], 'id' => $value['pageId']);
        				}//end of if
        			}//end of foreach
        		}//end of if
		       	
		       	if(isset($pageAccessTokenData['access_token'])){
		       		$pageAccessToken = $pageAccessTokenData['access_token'];
		       		$senderDetailsURL = $graphAPIEndPoint.$senderId.'?access_token='.$pageAccessToken;
			       	$getSenderDetails = Settings_CTFacebookMessengerIntegration_Record_Model::callFacebookMessengerAPI($senderDetailsURL,'GET');
			       	$senderName = $getSenderDetails['first_name'].' '.$getSenderDetails['last_name'];

		       		$pageId = $pageAccessTokenData['id'];
		       		$getSenderData = $graphAPIEndPoint.$pageId.'/conversations?fields=senders&access_token='.$pageAccessToken;
		       		$getSenderDetailsData = Settings_CTFacebookMessengerIntegration_Record_Model::callFacebookMessengerAPI($getSenderData,'GET');

		       		$senderConversationData = array();
		       		if(!empty($getSenderDetailsData) && isset($getSenderDetailsData['data'])){
		       			$senderData = $getSenderDetailsData['data'];
		       			if(!empty($senderData)){
		       				foreach ($senderData as $index => $data) {
		       					if(isset($data['senders']['data']) && !empty($data['senders']['data'])){
		       						$senderPageData = $data['senders']['data'];
	       							$senderConversationData[$senderPageData[0]['id']] = $senderPageData[0]['name'];
		       					}//end of if
		       				}//end of foreach
		       			}//end of if
		       		}//end of if

		       		if(!empty($senderConversationData)){
	       				if(array_key_exists($senderId, $senderConversationData)){
	       					$currentSenderName = $senderConversationData[$senderId];
	       				}//end of if
		       		}//end of if

	       			if($senderName == " "){
		       			$senderName = $currentSenderName;
		       		}//end of if
		       		
			       	$profilePicURL = '';
			       	if(isset($getSenderDetails['profile_pic'])){
			       		$profilePicURL = $getSenderDetails['profile_pic'];
			       	}//end of if
			       	
			       	foreach($messageText as $mkey => $mValue){
			       		$chatLogRecordModel = Vtiger_Record_Model::getCleanInstance('CTChatLog');
			       		$chatLogRecordModel->set('mode', '');
				       	$chatLogRecordModel->set('chat_type_id',$chatTypeId);
						$chatLogRecordModel->set('platform_unique_id',$recipientId);
						$chatLogRecordModel->set('sender_name',$senderName);
			       		$chatLogRecordModel->set('sender_profile_pic_url',$profilePicURL);
			       		$chatLogRecordModel->set('conversation_id',$messageId);
			       		$chatLogRecordModel->set('message_type',$messageType);
			       		$chatLogRecordModel->set('message_body',json_encode($mValue));
			       		$chatLogRecordModel->set('type','Received');
			       		$chatLogRecordModel->set('api_response',$responseData);
			       		$chatLogRecordModel->set('message_datetime',$messageDateTime);
			       		$chatLogRecordModel->set('sender_id',$senderId);
			       		$chatLogRecordModel->set('module_record_id',$moduleRecordId);
			       		$chatLogRecordModel->set('assigned_user_id',$userId);
			       		$chatLogRecordModel->set('message_read_unread','Unread');
			       		$chatLogRecordModel->set('fb_quoted_message', $mainMessageBody);
			       		$chatLogRecordModel->save();
			       		$chatLogId = $chatLogRecordModel->getId();

			       		if($chatLogId){
			       			$checkExistingSenderLogData = Settings_CTFacebookMessengerIntegration_Record_Model::getCTFacebookMessengerIntegrationData('vtiger_ctchatlogdetails INNER JOIN vtiger_crmentity ON vtiger_ctchatlogdetails.ctchatlogdetailsid = vtiger_crmentity.crmid', array('module_record_id, ctchatlogdetailsid'), array('sender_id' => $senderId, 'vtiger_crmentity.deleted' => 0));
							$logNumRows = $adb->num_rows($checkExistingSenderLogData);
							
							if($logNumRows > 0){
								$moduleRecordId = $adb->query_result($checkExistingSenderLogData, 0, 'module_record_id');
								$chatLogDetailsId = $adb->query_result($checkExistingSenderLogData, 0, 'ctchatlogdetailsid');

			       				$chatLogDetailsRecordModel = Vtiger_Record_Model::getInstanceById($chatLogDetailsId, 'CTChatLogDetails');
			       				$chatLogDetailsRecordModel->set('mode', 'edit');
			       			}else{
			       				$chatLogDetailsRecordModel = Vtiger_Record_Model::getCleanInstance('CTChatLogDetails');
			       			}//end of else

		       				$chatLogDetailsRecordModel->set('chat_type_id',$chatTypeId);
							$chatLogDetailsRecordModel->set('platform_unique_id',$recipientId);
							$chatLogDetailsRecordModel->set('sender_name',$senderName);
				       		$chatLogDetailsRecordModel->set('sender_profile_pic_url',$profilePicURL);
				       		$chatLogDetailsRecordModel->set('conversation_id',$messageId);
				       		$chatLogDetailsRecordModel->set('message_type',$messageType);
				       		$chatLogDetailsRecordModel->set('message_body',json_encode($mValue));
				       		$chatLogDetailsRecordModel->set('type','Received');
				       		$chatLogDetailsRecordModel->set('api_response',$responseData);
				       		$chatLogDetailsRecordModel->set('message_datetime',$messageDateTime);
				       		$chatLogDetailsRecordModel->set('sender_id',$senderId);
				       		$chatLogDetailsRecordModel->set('module_record_id',$moduleRecordId);
				       		$chatLogDetailsRecordModel->set('assigned_user_id',$userId);
				       		$chatLogDetailsRecordModel->set('chat_log_id',$chatLogId);
				       		$chatLogDetailsRecordModel->set('message_read_unread','Unread');
				       		$chatLogDetailsRecordModel->set('notification_tone', '');
				       		$chatLogDetailsRecordModel->set('fb_quoted_message', $mainMessageBody);
				       		$chatLogDetailsRecordModel->save();
		       			}//end of if
			       	}
			   	}//end of if
		    }//end of if
		}//end of if
	}//end of if
}//end of if
?>
