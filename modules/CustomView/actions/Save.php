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
	private static $allowedShareMemberTypes = array(
		Settings_Groups_Member_Model::MEMBER_TYPE_USERS,
		Settings_Groups_Member_Model::MEMBER_TYPE_GROUPS,
		Settings_Groups_Member_Model::MEMBER_TYPE_ROLES,
		Settings_Groups_Member_Model::MEMBER_TYPE_ROLE_AND_SUBORDINATES,
	);

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
		$shareTasksProvided = $request->has('share_tasks');
		$shareTasks = $this->normalizeShareTasks($request->get('share_tasks'));

		$shareListEnabled = ($request->get('sharelist') == '1');
		if (!empty($shareTasks)) {
			// Ensure sharelist flag is enabled when custom share tasks are provided.
			$shareListEnabled = true;
		}
		$request->set('sharelist', $shareListEnabled ? '1' : '0');

		if ($shareListEnabled) {
			// Collect all unique members from request payload and share task rows.
			$allMembers = array();

			// When share_tasks is posted (v7 UI), trust only that payload to avoid stale legacy members[] values.
			if (!$shareTasksProvided) {
				$allMembers = $this->normalizeMembersList($request->get('members'));
			}

			foreach ($shareTasks as &$task) {
				$taskMembers = $this->normalizeMembersList(isset($task['members']) ? $task['members'] : array());
				$task['members'] = $taskMembers;
				foreach ($taskMembers as $memberId) {
					if (!in_array($memberId, $allMembers, true)) {
						$allMembers[] = $memberId;
					}
				}
			}
			unset($task);

			$hasAllUsers = in_array('All::Users', $allMembers, true);
			if ($hasAllUsers) {
				// All users selection must be exclusive and implies public status.
				$allMembers = array('All::Users');
			}
			$request->set('status', $hasAllUsers ? CustomView_Record_Model::CV_STATUS_PUBLIC : CustomView_Record_Model::CV_STATUS_PRIVATE);
			$request->set('members', $allMembers);
		} else {
			// Share is disabled, ensure the list is no longer public/shared.
			$request->set('status', CustomView_Record_Model::CV_STATUS_PRIVATE);
			$request->set('members', array());
		}

		$customViewModel = $this->getCVModelFromRequest($request);
		$response = new Vtiger_Response();
		if (!empty($request->get('record')) && !$customViewModel->isEditable()) {
			$response->setError(vtranslate('LBL_PERMISSION_DENIED'));
			$response->emit();
			return;
		}
		
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

	private function normalizeShareTasks($shareTasksRaw) {
		$shareTasks = array();
		if (empty($shareTasksRaw)) {
			return $shareTasks;
		}

		if (is_array($shareTasksRaw)) {
			$shareTasks = $shareTasksRaw;
		} else if (is_string($shareTasksRaw)) {
			$decoded = json_decode(html_entity_decode($shareTasksRaw, ENT_QUOTES, 'UTF-8'), true);
			if (is_array($decoded)) {
				$shareTasks = $decoded;
			}
		}

		if (!is_array($shareTasks)) {
			return array();
		}

		$normalizedTasks = array();
		foreach ($shareTasks as $task) {
			if (!is_array($task)) {
				continue;
			}
			$normalizedTasks[] = array(
				'members' => $this->normalizeMembersList(isset($task['members']) ? $task['members'] : array()),
				'task_description' => isset($task['task_description']) ? html_entity_decode($task['task_description'], ENT_QUOTES, 'UTF-8') : '',
			);
		}

		return $normalizedTasks;
	}

	private function normalizeMembersList($membersRaw) {
		$members = array();
		$stack = array($membersRaw);

		while (!empty($stack)) {
			$current = array_pop($stack);
			if (is_array($current)) {
				foreach ($current as $item) {
					$stack[] = $item;
				}
				continue;
			}

			if (!is_string($current) && !is_numeric($current)) {
				continue;
			}

			$memberId = trim(html_entity_decode((string)$current, ENT_QUOTES, 'UTF-8'));
			if ($memberId === '') {
				continue;
			}

			if ($memberId === 'All::Users') {
				if (!in_array($memberId, $members, true)) {
					$members[] = $memberId;
				}
				continue;
			}

			$idComponents = Settings_Groups_Member_Model::getIdComponentsFromQualifiedId($memberId);
			if (!$idComponents || php7_count($idComponents) != 2) {
				continue;
			}

			$memberType = $idComponents[0];
			$memberRecordId = trim((string)$idComponents[1]);
			if ($memberRecordId === '' || !in_array($memberType, self::$allowedShareMemberTypes, true)) {
				continue;
			}

			$qualifiedId = Settings_Groups_Member_Model::getQualifiedId($memberType, $memberRecordId);
			if (!in_array($qualifiedId, $members, true)) {
				$members[] = $qualifiedId;
			}
		}

		return $members;
	}
    
    public function validateRequest(Vtiger_Request $request) {
        $request->validateWriteAccess();
    }
}
