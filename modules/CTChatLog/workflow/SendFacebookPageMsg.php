<?php
/*+**********************************************************************************
* The content of this file is subject to the CRMTiger Pro license.
* ("License"); You may not use this file except in compliance with the License
* The Initial Developer of the Original Code is vTiger
* The Modified Code of the Original Code owned by https://crmtiger.com/
* Portions created by CRMTiger.com are Copyright(C) CRMTiger.com
* All Rights Reserved.
************************************************************************************/
require_once('modules/com_vtiger_workflow/VTEntityCache.inc');
require_once('modules/com_vtiger_workflow/VTWorkflowUtils.php');
require_once('modules/com_vtiger_workflow/VTSimpleTemplate.inc');
require_once('modules/CTChatLog/CTChatLog.php');

class SendFacebookPageMsg extends VTTask {
	public $executeImmediately = true; 
	
	public function getFieldNames(){
		return array('content');
	}
	
	public function doTask($entity){
		global $adb, $current_user,$log;
		$util = new VTWorkflowUtils();
		$admin = $util->adminUser();
		$ws_id = $entity->getId();
		$entityCache = new VTEntityCache($admin);
		$ct = new VTSimpleTemplate($this->content);
		$content = $ct->render($entityCache, $ws_id);
		$relatedCRMid = substr($ws_id, stripos($ws_id, 'x')+1);
		$relatedIdsArray[] = $relatedCRMid;
		$relatedid = $entity->id;
		
		$relatedModule = $entity->getModuleName();
		$moduleWsEntityId = '';
		$getModuleEntity = $adb->pquery("SELECT id FROM vtiger_ws_entity WHERE name = ? ",array($relatedModule));
		if($adb->num_rows($getModuleEntity) > 0){
			$moduleWsEntityId = $adb->query_result($getModuleEntity, 0, 'id');
		}//end of if

		foreach($relatedIdsArray as $key => $recordId){
			$checkContactExistInLog = $adb->pquery("SELECT sender_id FROM vtiger_ctchatlogdetails WHERE module_record_id = ? ",array($recordId));
			
			if($moduleWsEntityId != ''){
				$moduleRecordId = $moduleWsEntityId."x".$recordId;
				$content = $ct->render($entityCache, $moduleRecordId);

				if($adb->num_rows($checkContactExistInLog) > 0){
					$senderId = $adb->query_result($checkContactExistInLog, 0, 'sender_id');
					$facebookPageId = $this->summary;

					CTChatLog::sendFacebookMessageFromWorkFlow(strip_tags($content), $senderId, $facebookPageId, $relatedModule, $current_user->id, $recordId);
				}
			}//end of if
		}//end of foreach
		$util->revertUser();	
	}
}
?>
