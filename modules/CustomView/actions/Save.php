<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class CustomView_Save_Action extends Vtiger_Action_Controller {
	public function requiresPermission(\Vtiger_Request $request) {
		$permissions = parent::requiresPermission($request);
		$permissions[] = array('module_parameter' => 'source_module', 'action' => 'DetailView');
		return $permissions;
	}

	public function process(Vtiger_Request $request) {
		$moduleName = $request->get('module');
        $sourceModuleName = $request->get('source_module');
        $moduleModel = Vtiger_Module_Model::getInstance($sourceModuleName);

		// Extract all members from customized share_tasks and inject into Vtiger's standard "members"
		$shareTasksRaw = $request->get('share_tasks');
		$shareTasks = array();
		if (!empty($shareTasksRaw)) {
			if (is_array($shareTasksRaw)) {
				$shareTasks = $shareTasksRaw;
			} else if (is_string($shareTasksRaw)) {
				$shareTasks = json_decode($shareTasksRaw, true);
				if (!is_array($shareTasks)) {
					$shareTasks = array();
				}
			}
		}

		$shareListEnabled = ($request->get('sharelist') == '1');
		if (!empty($shareTasks)) {
			// Ensure sharelist flag is enabled when custom share tasks are provided.
			$shareListEnabled = true;
		}
		$request->set('sharelist', $shareListEnabled ? '1' : '0');

		if ($shareListEnabled) {
			// Collect all unique members from request payload and share task rows.
			$allMembers = array();

			$standardMembers = $request->get('members');
			if (is_string($standardMembers) && $standardMembers !== '') {
				$standardMembers = array($standardMembers);
			}
			if (!empty($standardMembers) && is_array($standardMembers)) {
				foreach ($standardMembers as $memberId) {
					$cleanMember = html_entity_decode($memberId, ENT_QUOTES, 'UTF-8');
					if (!in_array($cleanMember, $allMembers)) {
						$allMembers[] = $cleanMember;
					}
				}
			}

			foreach ($shareTasks as $task) {
				$taskMembers = isset($task['members']) ? $task['members'] : array();
				if (is_string($taskMembers)) {
					$taskMembers = json_decode(html_entity_decode($taskMembers, ENT_QUOTES, 'UTF-8'), true);
					if (!is_array($taskMembers)) {
						$taskMembers = array();
					}
				}
				if (is_array($taskMembers)) {
					foreach ($taskMembers as $memberId) {
						$cleanMember = html_entity_decode($memberId, ENT_QUOTES, 'UTF-8');
						if (!in_array($cleanMember, $allMembers)) {
							$allMembers[] = $cleanMember;
						}
					}
				}
			}

			$hasAllUsers = in_array('All::Users', $allMembers);
			$request->set('status', $hasAllUsers ? CustomView_Record_Model::CV_STATUS_PUBLIC : CustomView_Record_Model::CV_STATUS_PRIVATE);
			$request->set('members', $allMembers);
		} else {
			// Share is disabled, ensure the list is no longer public/shared.
			$request->set('status', CustomView_Record_Model::CV_STATUS_PRIVATE);
			$request->set('members', array());
		}

		$customViewModel = $this->getCVModelFromRequest($request);
		$response = new Vtiger_Response();
		
		if (!$customViewModel->checkDuplicate()) {
			$isNew = empty($request->get('record'));
			$customViewModel->save();
			$cvId = $customViewModel->getId();

			$customViewModel->saveShareTasks($shareTasks);

			// Build history details with share task info
			$historyDetails = array(
				'viewname' => $request->get('viewname'),
				'columns_count' => !empty($request->get('columnslist')) ? count($request->get('columnslist')) : 0,
			);

			// Add share tasks info to history
			if (!empty($shareTasks)) {
				$shareInfo = array();
				foreach ($shareTasks as $task) {
					$taskMembers = isset($task['members']) ? $task['members'] : array();
					$taskDesc = isset($task['task_description']) ? $task['task_description'] : '';
					
					// Resolve member names for history
					$memberNames = array();
					foreach ($taskMembers as $memberId) {
						$idComponents = Settings_Groups_Member_Model::getIdComponentsFromQualifiedId($memberId);
						if ($idComponents && php7_count($idComponents) == 2) {
							$memberType = $idComponents[0];
							$id = $idComponents[1];
							if ($memberType == Settings_Groups_Member_Model::MEMBER_TYPE_USERS) {
								$userModel = Users_Record_Model::getInstanceById($id, 'Users');
								$memberNames[] = $userModel->getName();
							} else if ($memberType == Settings_Groups_Member_Model::MEMBER_TYPE_GROUPS) {
								$groupModel = Settings_Groups_Record_Model::getInstance($id);
								$memberNames[] = $groupModel->getName();
							} else {
								$memberNames[] = $memberId;
							}
						}
					}
					$shareInfo[] = array(
						'members' => $memberNames,
						'task_description' => $taskDesc,
					);
				}
				$historyDetails['share_tasks'] = $shareInfo;
			}

			// Log history
			$actionType = $isNew ? 'created' : 'updated';
			$customViewModel->logHistory($actionType, json_encode($historyDetails));

            /**
             * We are setting list_headers in session when we manage columns.
             * we should clear this from session in order to apply view
             */
            $listViewSessionKey = $sourceModuleName.'_'.$cvId;
            Vtiger_ListView_Model::deleteParamsSession($listViewSessionKey,'list_headers');
			$response->setResult(array('id'=>$cvId, 'listviewurl'=>$moduleModel->getListViewUrl().'&viewname='.$cvId));
		} else {
			$response->setError(vtranslate('LBL_CUSTOM_VIEW_NAME_DUPLICATES_EXIST', $moduleName));
		}

		$response->emit();
	}

	/**
	 * Function to get the custom view model based on the request parameters
	 * @param Vtiger_Request $request
	 * @return CustomView_Record_Model or Module specific Record Model instance
	 */
	private function getCVModelFromRequest(Vtiger_Request $request) {
		$cvId = $request->get('record');

		if(!empty($cvId)) {
			$customViewModel = CustomView_Record_Model::getInstanceById($cvId);
		} else {
			$customViewModel = CustomView_Record_Model::getCleanInstance();
			$customViewModel->setModule($request->get('source_module'));
		}

		$customViewData = array(
					'cvid' => $cvId,
					'viewname' => $request->get('viewname'),
					'setdefault' => $request->get('setdefault'),
					'setmetrics' => $request->get('setmetrics'),
					'status' => $request->get('status')
		);
		$selectedColumnsList = $request->get('columnslist');
		if(!empty($selectedColumnsList)) {
			$customViewData['columnslist'] = $selectedColumnsList;
		}
		$stdFilterList = $request->get('stdfilterlist');
		if(!empty($stdFilterList)) {
			$customViewData['stdfilterlist'] = $stdFilterList;
		}
		$advFilterList = $request->get('advfilterlist');
		if(!empty($advFilterList)) {
			$customViewData['advfilterlist'] = $advFilterList;
		}
		$customViewData['sharelist'] = $request->get('sharelist') == '1' ? '1' : '0';
		$members = $request->get('members');
		if (is_string($members) && $members !== '') {
			$members = array($members);
		}
		if (!is_array($members)) {
			$members = array();
		}
		$customViewData['members'] = $members;
		return $customViewModel->setData($customViewData);
	}
    
    public function validateRequest(Vtiger_Request $request) {
        $request->validateWriteAccess();
    }
}
