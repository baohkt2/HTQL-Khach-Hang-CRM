<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Inventory_MassSave_Action extends Vtiger_MassSave_Action {

	public function process(Vtiger_Request $request) {
		$mode = $request->getMode();
		if (in_array($mode, array('startMassEditProgress', 'processMassEditProgress', 'cancelMassEditProgress'))) {
			parent::process($request);
			return;
		}

		$response = new Vtiger_Response();
		try {
			vglobal('VTIGER_TIMESTAMP_NO_CHANGE_MODE', $request->get('_timeStampNoChangeMode',false));
			$moduleName = $request->getModule();
			$recordModels = $this->getRecordModelsFromRequest($request);
			foreach($recordModels as $recordId => $recordModel) {
				if(Users_Privileges_Model::isPermitted($moduleName, 'Save', $recordId)) {
					//Inventory line items getting wiped out
					$_REQUEST['ajxaction'] = 'DETAILVIEW';
					$recordModel->save();
				}
			}
			vglobal('VTIGER_TIMESTAMP_NO_CHANGE_MODE', false);
			$response->setResult(true);
		} catch (DuplicateException $e) {
			$response->setError($e->getMessage(), $e->getDuplicationMessage(), $e->getMessage());
		} catch (Exception $e) {
			$response->setError($e->getMessage());
		}
		$response->emit();
	}

	protected function saveMassEditedRecord($moduleName, $recordId, Vtiger_Record_Model $recordModel) {
		if (!Users_Privileges_Model::isPermitted($moduleName, 'Save', $recordId)) {
			return false;
		}

		// Prevent inventory line items from being reset on mass edit save.
		$_REQUEST['ajxaction'] = 'DETAILVIEW';
		$recordModel->save();
		return true;
	}
}
