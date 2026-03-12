<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/

class CustomView_SaveAjax_Action extends CustomView_Save_Action {

	function __construct() {
		parent::__construct();
		$this->exposeMethod('updateColumns');
		$this->exposeMethod('toggleFixedColumn');
	}

	public function process(Vtiger_Request $request) {
		$response = new Vtiger_Response();
		$cvId = $request->get('record');
		if (!$cvId) {
			$response->setError('Filter Not specified');
			$response->emit();
			return;
		}

		$mode = $request->get('mode');
		if(!empty($mode)) {
			$this->invokeExposedMethod($mode, $request);
			return;
		}

		$customViewModel = CustomView_Record_Model::getInstanceById($cvId);
		$customViewModel->set('setdefault',$request->get('setdefault'));
		$customViewModel->save(true);
		$response->setResult(array('id'=>$cvId,'isdefault'=>$customViewModel->get('setdefault')));
		$response->emit();
	}


	/**
	 * Function to updated selected Custom view columns
	 * @param Vtiger_Request $request
	 */
	 public function updateColumns(Vtiger_Request $request) {
		$cvid = $request->get('record');
		$customViewModel = CustomView_Record_Model::getInstanceById($cvid);
		$response = new Vtiger_Response();
		if ($customViewModel) {
			$selectedColumns = $request->get('columnslist');
			$fixedColumns = $request->get('fixedcolumns');
			$customViewModel->deleteSelectedFields();
			$customViewModel->saveSelectedFields($selectedColumns, $fixedColumns);
			/**
			 * We are setting list_headers in session when we manage columns.
			 * we should clear this from session in order to apply view
			 */
			$listViewSessionKey = $customViewModel->getModule()->getName().'_'.$cvid;
			Vtiger_ListView_Model::deleteParamsSession($listViewSessionKey,'list_headers');
			$response->setResult(array('message'=>vtranslate('List columns saved successfully',$request->getModule()), 'listviewurl'=>$customViewModel->getModule()->getListViewUrl().'&viewname='.$cvid));
		} else {
			$response->setError(vtranslate('Filter does not exist',$request->getModule()));
		}
		$response->emit();
	}

	/**
	 * Toggle fixed state for a single column in a custom view
	 */
	public function toggleFixedColumn(Vtiger_Request $request) {
		$cvid = $request->get('record');
		$fieldName = $request->get('fieldname');
		$isFixed = (int)$request->get('is_fixed');
		$response = new Vtiger_Response();

		if (empty($cvid) || empty($fieldName)) {
			$response->setError('Missing required parameters');
			$response->emit();
			return;
		}

		$db = PearDatabase::getInstance();

		// Find the column matching this field name
		$result = $db->pquery("SELECT columnname FROM vtiger_cvcolumnlist WHERE cvid = ?", [$cvid]);
		$matchedColumn = null;
		while ($row = $db->fetchByAssoc($result)) {
			$colName = $row['columnname'];
			$parts = explode(':', $colName);
			// Match by field name part (3rd segment in vtiger column format: table:column:fieldname:module:uitype)
			if (count($parts) >= 3 && $parts[2] === $fieldName) {
				$matchedColumn = $colName;
				break;
			}
			// Also match the full column name directly
			if ($colName === $fieldName) {
				$matchedColumn = $colName;
				break;
			}
		}

		if ($matchedColumn) {
			$db->pquery(
				"UPDATE vtiger_cvcolumnlist SET is_fixed = ? WHERE cvid = ? AND columnname = ?",
				[$isFixed, $cvid, $matchedColumn]
			);
			$response->setResult(['success' => true]);
		} else {
			$response->setError('Column not found: ' . $fieldName);
		}
		$response->emit();
	}
}