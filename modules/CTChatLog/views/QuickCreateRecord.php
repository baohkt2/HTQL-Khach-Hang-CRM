<?php
/*+**********************************************************************************
* The content of this file is subject to the CRMTiger Pro license.
* ("License"); You may not use this file except in compliance with the License
* The Initial Developer of the Original Code is vTiger
* The Modified Code of the Original Code owned by https://crmtiger.com/
* Portions created by CRMTiger.com are Copyright(C) CRMTiger.com
* All Rights Reserved.
************************************************************************************/
header('Content-Type: text/html; charset=utf-8');
class CTChatLog_QuickCreateRecord_View extends Vtiger_IndexAjax_View {
	function __construct() {
		$this->exposeMethod('editRecordWithSelectBody');
		$this->exposeMethod('saveEditRecordWithSelectBody');
		$this->exposeMethod('editRecord');
		$this->exposeMethod('saveRecord');
		$this->exposeMethod('assignRecordPopup');
		$this->exposeMethod('getModulesRecord');
		$this->exposeMethod('saveAssignRecord');
		$this->exposeMethod('searchModuleRecord');
	}

	function checkPermission(Vtiger_Request $request) {
		return true;
	}

	function editRecordWithSelectBody(Vtiger_Request $request){
		global $adb;
		$moduleName = $request->getModule();
		$viewer = $this->getViewer($request);
		$sourceModuleName = $request->get('sourceModuleName');
		$moduleRecordId = $request->get('moduleRecordId');
		
		if($sourceModuleName == ""){
			$sourceModuleName = CTChatLog_Record_Model::getSeType($moduleRecordId);
		}//end of if
		$tabid = getTabid($sourceModuleName);

		$moduleModel = Vtiger_Module_Model::getInstance($sourceModuleName);
		$fields = $moduleModel->getFields();
		$fieldsArray = array();
		foreach ($fields as $key => $value) {
			$fieldlabel = $value->label;
			$fieldname = $value->name;
			$fieldsArray[] = array('fieldlabel' => $fieldlabel, 'fieldname' => $fieldname);
		}

		$viewer->assign('MODULE', $moduleName);
		$viewer->assign('ALLFIELDS', $fieldsArray);
		$viewer->assign('SOURCEMODULENAME', $sourceModuleName);
		echo $viewer->view('EditRecordWithSelectBodyPopup.tpl', $moduleName, true);
	}

	function saveEditRecordWithSelectBody(Vtiger_Request $request){
		$moduleName = $request->getModule();
		$sourceModuleName = $request->get('sourceModuleName');
		$fieldName = $request->get('fieldname');
		$moduleRecordId = $request->get('moduleRecordId');
		$msgBody = $request->get('msgBody');

		if($sourceModuleName == ""){
			$sourceModuleName = CTChatLog_Record_Model::getSeType($moduleRecordId);
		}
		
		$recordModel = Vtiger_Record_Model::getInstanceById($moduleRecordId, $sourceModuleName);
		$recordModel->set($fieldName, $msgBody);
		$recordModel->set('mode', 'edit');
		$recordModel->save();
		$recordId = $recordModel->getId();
		echo $recordId;
	}

	function editRecord(Vtiger_Request $request){
		$moduleName = $request->getModule();
		$moduleRecordId = $request->get('moduleRecordId');

		$sourceModuleName = CTChatLog_Record_Model::getSeType($moduleRecordId);
		$tabid = getTabid($sourceModuleName);
		$recordModel = Vtiger_Record_Model::getInstanceById($moduleRecordId, $sourceModuleName);
		$assignTo = $recordModel->get('assigned_user_id');

		$getModuleFields = CTChatLog_Record_Model::getModulefields($tabid, $sourceModuleName, $moduleRecordId);

		$viewer = $this->getViewer($request);
		$viewer->assign('MODULE', $moduleName);
		$viewer->assign('SOURCEMODULENAME', $sourceModuleName);
		$viewer->assign('MODUELFIELDS', $getModuleFields);
		$viewer->assign('USER_MODEL', Users_Record_Model::getCurrentUserModel());
		$viewer->assign('ASSIGNTO', $assignTo);
		echo $viewer->view('EditRecordPopup.tpl', $moduleName, true);
	}

	function saveRecord(Vtiger_Request $request){
		global $adb;
		$moduleName = $request->getModule();
		$moduleRecordId = $request->get('moduleRecordId');
		$sourceModuleName = CTChatLog_Record_Model::getSeType($moduleRecordId);
		$serializedata = $request->get('serializedata');
		
		$recordModel = Vtiger_Record_Model::getInstanceById($moduleRecordId, $sourceModuleName);
		$recordModel->set('mode', 'edit');

		foreach($serializedata as $key => $value){
			if($key != '__vtrftk' && $key != 'relatedModule'){
				$recordModel->set($key, $value);
			}
		}
		$recordModel->save();

		$displayName = $recordModel->get('label');
	    $query = "UPDATE vtiger_ctchatlog SET sender_name = ? WHERE module_record_id = ?";
        $updateQuery = $adb->pquery($query, array($displayName, $moduleRecordId));

        $query = "UPDATE vtiger_ctchatlogdetails SET sender_name = ? WHERE module_record_id = ?";
        $updateQuery = $adb->pquery($query, array($displayName, $moduleRecordId));

		$recordid = $recordModel->getId();
		echo $recordid;
	}

	function assignRecordPopup(Vtiger_Request $request){
		global $adb;
		$moduleName = $request->getModule();
		$viewer = $this->getViewer($request);

		$sourceModuleName = $request->get('sourceModuleName');
		$senderId = $request->get('senderId');
		$tabid = getTabid($sourceModuleName);
		
		$viewer->assign('MODULE', $moduleName);
		$viewer->assign('SOURCEMODULENAME', $sourceModuleName);
		$viewer->assign('SENDER_ID', $senderId);
		echo $viewer->view('AssignRecordPopup.tpl', $moduleName, true);
	}

	function getModulesRecord(Vtiger_Request $request){
		global $adb, $current_user;
		$moduleName = $request->getModule();
		$viewer = $this->getViewer($request);
		$sourceModuleName = $request->get('sourceModuleName');

		$queryGenerator = new QueryGenerator($sourceModuleName, $current_user);
		$query = explode('SELECT', $queryGenerator->getQuery());
		$moduleQuery = 'SELECT * '.$query[1];
		
		$queryResult = $adb->pquery($moduleQuery);
		$rows = $adb->num_rows($queryResult);

		$recordName = array();
		$option = '';
		for ($i=0; $i < $rows; $i++) { 
			$crmid = $adb->query_result($queryResult, $i, 'crmid');
			$label = $adb->query_result($queryResult, $i, 'label');
			$option .= '<option value='."$crmid".'>'."$label".'</option>';
		}//end of for
		echo $option;
	}//end of function

	function saveAssignRecord(Vtiger_Request $request){
		CTChatLog_Record_Model::assignAllMessage($request);
	}//end of function

	function searchModuleRecord(Vtiger_Request $request){
		global $adb;
		$moduleName = $request->getModule();
		$sourceModule = $request->get('sourceModule');
		$moduleRecordSearch = $request->get('moduleRecordSearch');
		
		$query = $adb->pquery("SELECT * FROM vtiger_crmentity WHERE deleted = 0 AND setype = '$sourceModule' AND label LIKE '%".$moduleRecordSearch."%' LIMIT 0, 20", array());
		
		$rows = $adb->num_rows($query);
		$string = '';
		$string.= '<ul id="list_two">';
		for ($i=0; $i < $rows; $i++) { 
			$row['crmid'] = $adb->query_result($query,$i,'crmid');
			$row['label'] = $adb->query_result($query,$i,'label');
			$string.= '<li class="selectModuleRecord" data-moduleId="'.$row['crmid'].'" data-moduleLabel="'.$row['label'].'">'.$row['label'].'</li>';
		}//end of for
		$string.= '</ul>';

		echo $string;
	}//end of function
}//end of class
?>