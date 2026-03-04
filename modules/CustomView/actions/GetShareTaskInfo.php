<?php
/*+***********************************************************************************
 * Custom action to get share task info for a given custom view
 * Returns who shared the list and task description for the current user
 *************************************************************************************/

class CustomView_GetShareTaskInfo_Action extends Vtiger_Action_Controller {

	function checkPermission(Vtiger_Request $request) {
		return;
	}

	public function process(Vtiger_Request $request) {
		$cvId = $request->get('cvid');
		$currentUserId = Users_Record_Model::getCurrentUserModel()->getId();

		$response = new Vtiger_Response();

		if (empty($cvId)) {
			$response->setResult(array('success' => false, 'message' => 'Missing cvid'));
			$response->emit();
			return;
		}

		$db = PearDatabase::getInstance();

		// Get the custom view owner info
		$cvSql = 'SELECT userid, viewname FROM vtiger_customview WHERE cvid = ?';
		$cvResult = $db->pquery($cvSql, array($cvId));
		if ($db->num_rows($cvResult) == 0) {
			$response->setResult(array('success' => false, 'message' => 'Custom view not found'));
			$response->emit();
			return;
		}

		$ownerId = $db->query_result($cvResult, 0, 'userid');
		$viewName = $db->query_result($cvResult, 0, 'viewname');

		// Get owner name
		$ownerName = getUserFullName($ownerId);

		// Get share tasks for this custom view
		$taskSql = 'SELECT members, task_description FROM vtiger_cv_share_tasks WHERE cvid = ? ORDER BY id ASC';
		$taskResult = $db->pquery($taskSql, array($cvId));
		$noOfRows = $db->num_rows($taskResult);

		$tasksForCurrentUser = array();
		$currentUserQualifiedId = 'Users:' . $currentUserId;

		for ($i = 0; $i < $noOfRows; $i++) {
			$membersJson = $db->query_result($taskResult, $i, 'members');
			$membersJson = html_entity_decode($membersJson, ENT_QUOTES, 'UTF-8');
			$membersArray = json_decode($membersJson, true);
			if (!is_array($membersArray)) {
				$membersArray = array();
			}

			$taskDescription = $db->query_result($taskResult, $i, 'task_description');
			$taskDescription = html_entity_decode($taskDescription, ENT_QUOTES, 'UTF-8');

			// Check if current user is in this task's members
			$isForCurrentUser = false;
			foreach ($membersArray as $memberId) {
				$memberId = html_entity_decode($memberId, ENT_QUOTES, 'UTF-8');
				if ($memberId == $currentUserQualifiedId || $memberId == 'All::Users') {
					$isForCurrentUser = true;
					break;
				}
				// Also check for group membership or role membership
				$idComponents = Settings_Groups_Member_Model::getIdComponentsFromQualifiedId($memberId);
				if ($idComponents && php7_count($idComponents) == 2) {
					$memberType = $idComponents[0];
					if ($memberType == 'Groups') {
						// Check if user belongs to this group
						$groupId = $idComponents[1];
						$groupSql = 'SELECT 1 FROM vtiger_users2group WHERE groupid = ? AND userid = ?';
						$groupResult = $db->pquery($groupSql, array($groupId, $currentUserId));
						if ($db->num_rows($groupResult) > 0) {
							$isForCurrentUser = true;
							break;
						}
					}
				}
			}

			if ($isForCurrentUser) {
				// Resolve all member names for display
				$memberNames = array();
				foreach ($membersArray as $mId) {
					$mId = html_entity_decode($mId, ENT_QUOTES, 'UTF-8');
					$idComp = Settings_Groups_Member_Model::getIdComponentsFromQualifiedId($mId);
					if ($idComp && php7_count($idComp) == 2) {
						$mType = $idComp[0];
						$mIdNum = $idComp[1];
						if ($mType == 'Users') {
							$memberNames[] = getUserFullName($mIdNum);
						} else if ($mType == 'Groups') {
							$grpModel = Settings_Groups_Record_Model::getInstance($mIdNum);
							if ($grpModel) {
								$memberNames[] = $grpModel->getName();
							}
						} else {
							$memberNames[] = $mId;
						}
					}
				}

				$tasksForCurrentUser[] = array(
					'members' => implode(', ', $memberNames),
					'task_description' => $taskDescription,
				);
			}
		}

		$response->setResult(array(
			'success' => true,
			'owner' => $ownerName,
			'viewname' => html_entity_decode($viewName, ENT_QUOTES, 'UTF-8'),
			'tasks' => $tasksForCurrentUser,
		));
		$response->emit();
	}
}
