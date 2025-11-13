<?php
/*+**********************************************************************************
* The content of this file is subject to the CRMTiger Pro license.
* ("License"); You may not use this file except in compliance with the License
* The Initial Developer of the Original Code is vTiger
* The Modified Code of the Original Code owned by https://crmtiger.com/
* Portions created by CRMTiger.com are Copyright(C) CRMTiger.com
* All Rights Reserved.
************************************************************************************/
class CTChatLog_Comments_View extends Vtiger_IndexAjax_View {
	function __construct() {
		$this->exposeMethod('commentsPopup');
		$this->exposeMethod('saveComments');
	}//end of function

	function commentsPopup(Vtiger_Request $request) {
		$moduleName = $request->getModule();
		$viewer = $this->getViewer($request);
		$viewer->assign('MODULE',$moduleName);
		echo $viewer->view('CommentsPopup.tpl', $moduleName, true);
	}//end of function
	
	function saveComments(Vtiger_Request $request) {
		global $adb, $current_user;
		$moduleName = $request->getModule();
		$userId = $current_user->id;
		$recordId = $request->get('recordId');
		$dateFilter = $request->get('dateFilter');
		if($dateFilter == "today"){
			$startdate = date("Y-m-d");
			$enddate = date("Y-m-d");
		}else if($dateFilter == "yesterday"){
			$startdate = date('Y-m-d',strtotime( "yesterday" ));
			$enddate = date('Y-m-d',strtotime( "yesterday" ));
		}else if($dateFilter == "this_week"){
			$saturday = strtotime("last sunday");
			$saturday = date('w', $saturday)==date('w') ? $saturday+7*86400 : $saturday;
			$friday = strtotime(date("Y-m-d",$saturday)." +6 days");

			$startdate = date("Y-m-d",$saturday);
			$enddate = date("Y-m-d",$friday);
		}else if($dateFilter == "last_week"){
			$saturday = strtotime("-1 week last sunday");
			$friday = strtotime(date("Y-m-d",$saturday)." +6 days");
			
			$startdate = date("Y-m-d",$saturday);
			$enddate = date("Y-m-d",$friday);
		}else if($dateFilter == "this_month"){
			$startdate = date('Y-m-d',strtotime("first day of this month"));
			$enddate = date('Y-m-d',strtotime("last day of this month"));
			
		}else if($dateFilter == "last_month"){
			$startdate = date("Y-m-d", strtotime("first day of last month"));
            $enddate = date("Y-m-d", strtotime("last day of last month"));
		}else{
			$customdate = explode(',', $request->get('customDate'));
			$startdate = DateTimeField::convertToDBFormat($customdate[0]);
			$enddate = DateTimeField::convertToDBFormat($customdate[1]);
		}
		$getFacebookRecords = CTChatLog_Record_Model::getFacebookMessageRecordQuery($startdate, $enddate);
		$query = $adb->pquery($getFacebookRecords, array($recordId));
		$numrows = $adb->num_rows($query);
		
		$commententry = $request->get('commentEntry');
		if($commententry == "single"){
			$multipleComment = '';
			for($i=0; $i < $numrows; $i++){
				$multipleComment .= '['.$adb->query_result($query, $i, 'createdtime').'] '.$adb->query_result($query, $i, 'sender_name').' : '.json_decode(html_entity_decode($adb->query_result($query, $i, 'message_body')))."\n";
			}
			$recordModel = Vtiger_Record_Model::getCleanInstance("ModComments");
			$recordModel->set('mode', '');
			$recordModel->set('commentcontent', $multipleComment);
			$recordModel->set('assigned_user_id', $userId);
			$recordModel->set('related_to', $recordId);
			$recordModel->set('userid', $userId);
			if($multipleComment != ''){
				$recordModel->save();
			}
		}else{
			for($i=0; $i < $numrows; $i++){
				$messageBody = '['.$adb->query_result($query, $i, 'createdtime').'] '.$adb->query_result($query, $i, 'sender_name').' : '.json_decode(html_entity_decode($adb->query_result($query, $i, 'message_body')));
				$relatedTo = $adb->query_result($query, $i, 'module_record_id');
				
				$recordModel = Vtiger_Record_Model::getCleanInstance("ModComments");
				$recordModel->set('mode', '');
				$recordModel->set('commentcontent', $messageBody);
				$recordModel->set('assigned_user_id', $userId);
				$recordModel->set('related_to', $relatedTo);
				$recordModel->set('userid', $userId);
				if($messageBody != ''){
				   $recordModel->save();
				}//end of if
			}//end of for
		}//end of else
	}//end of function
}//end of class
?>