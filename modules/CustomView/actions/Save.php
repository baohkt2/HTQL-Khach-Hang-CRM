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
		$response = new Vtiger_Response();

		$selectedCvIds = $this->parseSelectedCvIds($request->get('selected_cvids'));
		$isMassEdit = ($request->get('mass_edit') == '1' && php7_count($selectedCvIds) > 0);

		if ($isMassEdit) {
			$this->processMassSave($request, $moduleName, $sourceModuleName, $moduleModel, $response, $selectedCvIds);
			return;
		}

		$shareTasks = $this->prepareShareDataOnRequest($request);
		$result = $this->saveSingleCustomView($request, $moduleName, $sourceModuleName, $moduleModel, $shareTasks);
		if ($result['success']) {
			$response->setResult(array('id' => $result['id'], 'listviewurl' => $result['listviewurl']));
		} else {
			$response->setError($result['error']);
		}
		$response->emit();
	}

	private function processMassSave(Vtiger_Request $request, $moduleName, $sourceModuleName, $moduleModel, Vtiger_Response $response, $selectedCvIds) {
		$quickFilterList = $this->normalizeAdvancedFilter($request->get('quickfilterlist'));

		$updatedIds = array();
		$firstUpdatedId = null;
		foreach ($selectedCvIds as $targetCvId) {
			$targetCvId = (int)$targetCvId;

			$targetModel = CustomView_Record_Model::getInstanceById($targetCvId);
			if (!$targetModel || !$targetModel->isEditable()) {
				continue;
			}
			$targetModule = $targetModel->getModule();
			if (!$targetModule || $targetModule->getName() !== $sourceModuleName) {
				continue;
			}

			$this->saveQuickFilterByCvId($targetCvId, $quickFilterList);
			$listViewSessionKey = $sourceModuleName.'_'.$targetCvId;
			Vtiger_ListView_Model::deleteParamsSession($listViewSessionKey, 'list_headers');
			$updatedIds[] = $targetCvId;
			if ($firstUpdatedId === null) {
				$firstUpdatedId = $targetCvId;
			}
		}

		if ($firstUpdatedId === null) {
			$response->setError(vtranslate('LBL_PERMISSION_DENIED'));
			$response->emit();
			return;
		}

		$response->setResult(array(
			'id' => $firstUpdatedId,
			'listviewurl' => $moduleModel->getListViewUrl().'&viewname='.$firstUpdatedId,
			'updated_ids' => $updatedIds,
		));
		$response->emit();
	}

	private function prepareShareDataOnRequest(Vtiger_Request $request) {
		$shareTasksProvided = $request->has('share_tasks');
		$shareTasks = $this->normalizeShareTasks($request->get('share_tasks'));

		$shareListEnabled = ($request->get('sharelist') == '1');
		if (!empty($shareTasks)) {
			$shareListEnabled = true;
		}
		$request->set('sharelist', $shareListEnabled ? '1' : '0');

		if ($shareListEnabled) {
			$allMembers = array();
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

			$shareState = $this->buildSharedStateFromMembers($allMembers);
			$request->set('status', $shareState['status']);
			$request->set('members', $shareState['members']);
		} else {
			$request->set('status', CustomView_Record_Model::CV_STATUS_PRIVATE);
			$request->set('members', array());
		}

		return $shareTasks;
	}

	private function saveSingleCustomView(Vtiger_Request $request, $moduleName, $sourceModuleName, $moduleModel, $shareTasks) {
		$customViewModel = $this->getCVModelFromRequest($request);
		if (!empty($request->get('record')) && !$customViewModel->isEditable()) {
			return array('success' => false, 'error' => vtranslate('LBL_PERMISSION_DENIED'));
		}

		if ($customViewModel->checkDuplicate()) {
			return array('success' => false, 'error' => vtranslate('LBL_CUSTOM_VIEW_NAME_DUPLICATES_EXIST', $moduleName));
		}

		$isNew = empty($request->get('record'));
		$customViewModel->save();
		$cvId = $customViewModel->getId();
		$customViewModel->saveShareTasks($shareTasks);
		if ($this->hasQuickFilterPayload($request)) {
			$quickFilterList = $this->normalizeAdvancedFilter($request->get('quickfilterlist'));
			$this->saveQuickFilterByCvId($cvId, $quickFilterList);
		}

		$columnsList = $request->get('columnslist');
		$columnsCount = is_array($columnsList) ? php7_count($columnsList) : 0;
		$historyDetails = array(
			'viewname' => $request->get('viewname'),
			'columns_count' => $columnsCount,
		);

		if (!empty($shareTasks)) {
			$shareInfo = array();
			foreach ($shareTasks as $task) {
				$taskMembers = isset($task['members']) ? $task['members'] : array();
				$taskDesc = isset($task['task_description']) ? $task['task_description'] : '';
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

		$actionType = $isNew ? 'created' : 'updated';
		$customViewModel->logHistory($actionType, json_encode($historyDetails));

		$listViewSessionKey = $sourceModuleName.'_'.$cvId;
		Vtiger_ListView_Model::deleteParamsSession($listViewSessionKey, 'list_headers');

		return array(
			'success' => true,
			'id' => $cvId,
			'listviewurl' => $moduleModel->getListViewUrl().'&viewname='.$cvId,
		);
	}

	private function hasQuickFilterPayload(Vtiger_Request $request) {
		if (!$request->has('quickfilterlist')) {
			return false;
		}

		$rawPayload = $request->getRaw('quickfilterlist', null);
		if ($rawPayload === null) {
			return false;
		}

		if (is_string($rawPayload) && trim($rawPayload) === '') {
			return false;
		}

		return true;
	}

	private function saveQuickFilterByCvId($cvId, $quickFilterList) {
		$db = PearDatabase::getInstance();
		$cvId = (int)$cvId;
		if ($cvId <= 0) {
			return;
		}

		$db->pquery('DELETE FROM vtiger_cvadvfilter WHERE cvid = ? AND groupid IN (3,4)', array($cvId));
		$db->pquery('DELETE FROM vtiger_cvadvfilter_grouping WHERE cvid = ? AND groupid IN (3,4)', array($cvId));
		$columnIndexSeed = $this->getNextColumnIndexForCv($cvId);

		$hasQuickOrGroup = !empty($quickFilterList[2]['columns']) && is_array($quickFilterList[2]['columns']);
		$groupMap = array(1 => 3, 2 => 4);
		foreach ($groupMap as $sourceGroupId => $targetGroupId) {
			if (empty($quickFilterList[$sourceGroupId]['columns']) || !is_array($quickFilterList[$sourceGroupId]['columns'])) {
				continue;
			}

			$columns = array_values($quickFilterList[$sourceGroupId]['columns']);
			if (php7_count($columns) <= 0) {
				continue;
			}

			$groupCondition = isset($quickFilterList[$sourceGroupId]['condition']) ? $quickFilterList[$sourceGroupId]['condition'] : '';
			if ($sourceGroupId == 1) {
				$groupCondition = $hasQuickOrGroup ? 'and' : '';
			} else if ($sourceGroupId == 2) {
				$groupCondition = '';
			}

			$db->pquery(
				'INSERT INTO vtiger_cvadvfilter_grouping(groupid,cvid,group_condition,condition_expression) VALUES (?,?,?,?)',
				array($targetGroupId, $cvId, $groupCondition, '')
			);

			$columnCount = php7_count($columns);
			foreach ($columns as $columnIndex => $columnCondition) {
				$columnName = isset($columnCondition['columnname']) ? $columnCondition['columnname'] : '';
				$comparator = isset($columnCondition['comparator']) ? $columnCondition['comparator'] : '';
				$value = isset($columnCondition['value']) ? $columnCondition['value'] : '';
				$columnConditionValue = isset($columnCondition['column_condition']) ? $columnCondition['column_condition'] : '';

				if ($columnName === '' || $comparator === '') {
					continue;
				}

				if ($columnIndex === ($columnCount - 1)) {
					$columnConditionValue = '';
				}
				$value = $this->normalizeQuickFilterValueForDb($columnName, $comparator, $value);

				$db->pquery(
					'INSERT INTO vtiger_cvadvfilter(cvid,columnindex,columnname,comparator,value,groupid,column_condition) VALUES (?,?,?,?,?,?,?)',
					array($cvId, $columnIndexSeed, $columnName, $comparator, $value, $targetGroupId, $columnConditionValue)
				);
				$columnIndexSeed++;
			}
		}

		Vtiger_Cache::set('advftCriteria', $cvId, null);
	}

	private function getNextColumnIndexForCv($cvId) {
		$db = PearDatabase::getInstance();
		$result = $db->pquery('SELECT MAX(columnindex) AS max_index FROM vtiger_cvadvfilter WHERE cvid = ?', array((int)$cvId));
		$maxIndex = ($result && $db->num_rows($result) > 0) ? $db->query_result($result, 0, 'max_index') : null;
		if ($maxIndex === null || $maxIndex === '') {
			return 0;
		}

		return ((int)$maxIndex) + 1;
	}

	private function normalizeQuickFilterValueForDb($columnName, $comparator, $value) {
		if (is_array($value)) {
			$value = implode(',', $value);
		}
		if (!is_string($value) || $value === '' || $columnName === '') {
			return $value;
		}

		$columnParts = explode(':', $columnName);
		$fieldTypeCode = isset($columnParts[4]) ? $columnParts[4] : '';
		$specialDateConditions = Vtiger_Functions::getSpecialDateTimeCondtions();
		if (($fieldTypeCode === 'D' || $fieldTypeCode === 'T' || $fieldTypeCode === 'DT') && !in_array($comparator, $specialDateConditions)) {
			$tempValues = explode(',', $value);
			$convertedValues = array();
			foreach ($tempValues as $index => $tempValue) {
				$tempValue = trim($tempValue);
				if ($tempValue === '') {
					$convertedValues[$index] = '';
					continue;
				}

				if ($fieldTypeCode === 'D') {
					if (isset($columnParts[0], $columnParts[1]) && $columnParts[0] === 'vtiger_activity' && $columnParts[1] === 'due_date') {
						$dateParts = explode(' ', $tempValue);
						$tempValue = $dateParts[0];
					}
					$convertedValues[$index] = DateTimeField::convertToDBFormat($tempValue);
				} elseif ($fieldTypeCode === 'DT') {
					if ($comparator === 'bw' || $comparator === 'custom') {
						$dateParts = explode(' ', $tempValue);
						if (empty($dateParts[1])) {
							$tempValue = ($index === 0) ? ($tempValue . ' 00:00:00') : ($tempValue . ' 23:59:59');
						}
					}
					$date = new DateTimeField($tempValue);
					$convertedValues[$index] = $date->getDBInsertDateTimeValue();
				} else {
					$date = new DateTimeField($tempValue);
					$convertedValues[$index] = $date->getDBInsertTimeValue();
				}
			}

			return implode(',', $convertedValues);
		}

		return $value;
	}

	private function parseSelectedCvIds($selectedCvIdsRaw) {
		$ids = array();
		if (empty($selectedCvIdsRaw)) {
			return $ids;
		}

		if (is_array($selectedCvIdsRaw)) {
			$tokens = $selectedCvIdsRaw;
		} else {
			$tokens = explode(',', (string)$selectedCvIdsRaw);
		}

		foreach ($tokens as $token) {
			$id = (int)trim($token);
			if ($id > 0 && !in_array($id, $ids, true)) {
				$ids[] = $id;
			}
		}

		return $ids;
	}

	private function normalizeAdvancedFilter($advFilterRaw) {
		if (is_string($advFilterRaw) && $advFilterRaw !== '') {
			$decoded = json_decode(html_entity_decode($advFilterRaw, ENT_QUOTES, 'UTF-8'), true);
			if (is_array($decoded)) {
				$advFilterRaw = $decoded;
			}
		}
		if (!is_array($advFilterRaw)) {
			return array();
		}

		$normalized = array();
		foreach ($advFilterRaw as $groupIndex => $groupInfo) {
			if (!is_array($groupInfo)) {
				continue;
			}
			$columns = isset($groupInfo['columns']) && is_array($groupInfo['columns']) ? $groupInfo['columns'] : array();
			$normalized[$groupIndex] = array(
				'condition' => isset($groupInfo['condition']) ? $groupInfo['condition'] : 'and',
				'columns' => array_values($columns),
			);
		}

		return $normalized;
	}

	private function extractAddedAdvancedConditions($originalAdv, $incomingAdv) {
		$originalMap = array();
		foreach ($originalAdv as $group) {
			if (empty($group['columns']) || !is_array($group['columns'])) {
				continue;
			}
			foreach ($group['columns'] as $column) {
				$originalMap[$this->getAdvancedConditionSignature($column)] = true;
			}
		}

		$added = array();
		foreach ($incomingAdv as $group) {
			if (empty($group['columns']) || !is_array($group['columns'])) {
				continue;
			}
			foreach ($group['columns'] as $column) {
				$signature = $this->getAdvancedConditionSignature($column);
				if (!isset($originalMap[$signature])) {
					$added[] = array(
						'columnname' => isset($column['columnname']) ? $column['columnname'] : '',
						'comparator' => isset($column['comparator']) ? $column['comparator'] : '',
						'value' => isset($column['value']) ? $column['value'] : '',
						'column_condition' => 'and',
					);
					$originalMap[$signature] = true;
				}
			}
		}

		return $added;
	}

	private function appendAddedConditionsToFilter($targetAdv, $addedConditions) {
		if (empty($addedConditions)) {
			return $targetAdv;
		}

		if (!isset($targetAdv[1]) || !is_array($targetAdv[1])) {
			$targetAdv[1] = array('condition' => 'and', 'columns' => array());
		}
		if (!isset($targetAdv[1]['columns']) || !is_array($targetAdv[1]['columns'])) {
			$targetAdv[1]['columns'] = array();
		}

		$existing = array();
		foreach ($targetAdv as $group) {
			if (empty($group['columns']) || !is_array($group['columns'])) {
				continue;
			}
			foreach ($group['columns'] as $column) {
				$existing[$this->getAdvancedConditionSignature($column)] = true;
			}
		}

		foreach ($addedConditions as $column) {
			$signature = $this->getAdvancedConditionSignature($column);
			if (isset($existing[$signature])) {
				continue;
			}
			$column['column_condition'] = 'and';
			$targetAdv[1]['columns'][] = $column;
			$existing[$signature] = true;
		}

		$targetAdv[1]['columns'] = array_values($targetAdv[1]['columns']);
		if (!isset($targetAdv[2])) {
			$targetAdv[2] = array('condition' => '', 'columns' => array());
		}

		return $targetAdv;
	}

	private function getAdvancedConditionSignature($column) {
		$columnName = isset($column['columnname']) ? $column['columnname'] : '';
		$comparator = isset($column['comparator']) ? $column['comparator'] : '';
		$value = isset($column['value']) ? $column['value'] : '';
		if (is_array($value)) {
			$value = json_encode($value);
		}
		return $columnName.'|'.$comparator.'|'.(string)$value;
	}

	private function extractAddedShareTasks($originalTasks, $incomingTasks) {
		$existing = array();
		foreach ($originalTasks as $task) {
			$existing[$this->getShareTaskSignature($task)] = true;
		}

		$added = array();
		foreach ($incomingTasks as $task) {
			$signature = $this->getShareTaskSignature($task);
			if (!isset($existing[$signature])) {
				$added[] = $task;
				$existing[$signature] = true;
			}
		}

		return $added;
	}

	private function mergeShareTasksAdditive($targetTasks, $addedTasks) {
		if (empty($addedTasks)) {
			return $targetTasks;
		}

		$map = array();
		foreach ($targetTasks as $task) {
			$map[$this->getShareTaskSignature($task)] = $task;
		}
		foreach ($addedTasks as $task) {
			$map[$this->getShareTaskSignature($task)] = $task;
		}

		return array_values($map);
	}

	private function getShareTaskSignature($task) {
		$members = isset($task['members']) ? $this->normalizeMembersList($task['members']) : array();
		sort($members);
		$description = isset($task['task_description']) ? trim((string)$task['task_description']) : '';
		return implode(',', $members).'|'.$description;
	}

	private function collectMemberIdsFromShareTasks($shareTasks) {
		$members = array();
		foreach ($shareTasks as $task) {
			$taskMembers = isset($task['members']) ? $this->normalizeMembersList($task['members']) : array();
			foreach ($taskMembers as $memberId) {
				if (!in_array($memberId, $members, true)) {
					$members[] = $memberId;
				}
			}
		}

		return $members;
	}

	private function buildSharedStateFromMembers($members) {
		$members = $this->normalizeMembersList($members);
		$hasAllUsers = in_array('All::Users', $members, true);
		if ($hasAllUsers) {
			$members = array('All::Users');
		}

		return array(
			'status' => $hasAllUsers ? CustomView_Record_Model::CV_STATUS_PUBLIC : CustomView_Record_Model::CV_STATUS_PRIVATE,
			'members' => $members,
		);
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
