<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/
class Settings_LoginHistory_ListView_Model extends Settings_Vtiger_ListView_Model {

	private function getFilterValue($key) {
		$value = $this->get($key);
		if ($value === null && isset($_REQUEST[$key])) {
			$value = $_REQUEST[$key];
		}
		return $value;
	}

	private function isValidDateFilterValue($dateValue) {
		return is_string($dateValue) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $dateValue);
	}

	private function getFilterConditions($module, &$params) {
		$conditions = array();

		$searchKey = $this->getFilterValue('search_key');
		$searchValue = trim((string) $this->getFilterValue('search_value'));
		if ($searchKey === 'user_name' && $searchValue !== '') {
			$conditions[] = "$module->baseTable.$searchKey = ?";
			$params[] = Vtiger_Functions::realEscapeString($searchValue);
		}

		$dateStart = trim((string) $this->getFilterValue('date_start'));
		if ($this->isValidDateFilterValue($dateStart)) {
			$conditions[] = "$module->baseTable.login_time >= ?";
			$params[] = $dateStart . ' 00:00:00';
		}

		$dateEnd = trim((string) $this->getFilterValue('date_end'));
		if ($this->isValidDateFilterValue($dateEnd)) {
			$conditions[] = "$module->baseTable.login_time <= ?";
			$params[] = $dateEnd . ' 23:59:59';
		}

		return $conditions;
	}

	/**
	 * Funtion to get the Login history basic query
	 * @return type
	 */
    public function getBasicListQuery() {
        $db = PearDatabase::getInstance();
        $module = $this->getModule();
		$userNameSql = getSqlForNameInDisplayFormat(array('first_name'=>'vtiger_users.first_name', 'last_name' => 'vtiger_users.last_name'), 'Users');
		
		$query = "SELECT login_id, $userNameSql AS user_name, user_ip, logout_time, login_time, vtiger_loginhistory.status,
				CASE 
					WHEN vtiger_loginhistory.status = 'Signed in' THEN NULL
					WHEN vtiger_loginhistory.logout_time IS NULL OR vtiger_loginhistory.logout_time = '0000-00-00 00:00:00' THEN NULL
					ELSE TIMESTAMPDIFF(SECOND, vtiger_loginhistory.login_time, vtiger_loginhistory.logout_time)
				END AS session_duration
				FROM $module->baseTable 
				INNER JOIN vtiger_users ON vtiger_users.user_name = $module->baseTable.user_name";
		
        $params = array();
		$conditions = $this->getFilterConditions($module, $params);
		if (!empty($conditions)) {
			$query .= ' WHERE ' . implode(' AND ', $conditions);
		}
        $query .= " ORDER BY login_time DESC"; 
 	 return $db->convert2Sql($query, $params); 
    }

	public function getListViewLinks() {
		$links = array();
		$basicLinks = $this->getBasicLinks();
		
		foreach($basicLinks as $basicLink) {
			$links['LISTVIEWBASIC'][] = Vtiger_Link_Model::getInstanceFromValues($basicLink);
		}
		return $links;
	}

	public function getBasicLinks(){
		return array();
	}
	
	/** 
	 * Function which will get the list view count  
	 * @return - number of records 
	 */

	public function getListViewCount() {
		$db = PearDatabase::getInstance();

		$module = $this->getModule();
		$listQuery = "SELECT count(*) AS count FROM $module->baseTable INNER JOIN vtiger_users ON vtiger_users.user_name = $module->baseTable.user_name";

		$params = array();
		$conditions = $this->getFilterConditions($module, $params);
		if (!empty($conditions)) {
			$listQuery .= ' WHERE ' . implode(' AND ', $conditions);
		}

		$listResult = $db->pquery($listQuery, $params);
		return $db->query_result($listResult, 0, 'count');
	}
}
