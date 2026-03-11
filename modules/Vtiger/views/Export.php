<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Vtiger_Export_View extends Vtiger_Index_View {

	public function requiresPermission(\Vtiger_Request $request) {
		$permissions = parent::requiresPermission($request);
		$permissions[] = array('module_parameter' => 'module', 'action' => 'Export');
		
		return $permissions;
	}

	function process(Vtiger_Request $request) {
		$viewer = $this->getViewer($request);

		$source_module = $request->getModule();
		$isCustomExportView = ($request->get('view') === 'CustomExport');
		$viewId = $request->get('viewname');
		$selectedIds = $request->get('selected_ids');
		$excludedIds = $request->get('excluded_ids');
		$orderBy = $request->get('orderby');
		$sortOrder = $request->get('sortorder');
		$tagParams = $request->get('tag_params');
		$page = $request->get('page');

		$viewer->assign('SELECTED_IDS', $selectedIds);
		$viewer->assign('EXCLUDED_IDS', $excludedIds);
		$viewer->assign('VIEWID', $viewId);
		$viewer->assign('PAGE', $page);
		$viewer->assign('SOURCE_MODULE', $source_module);
		$viewer->assign('MODULE','Export');
		$viewer->assign('ORDER_BY', $orderBy);
		$viewer->assign('SORT_ORDER', $sortOrder);
		$viewer->assign('TAG_PARAMS', $tagParams);
		$viewer->assign('EXPORT_TITLE_LABEL', $isCustomExportView ? 'LBL_CUSTOM_EXPORT_RECORDS' : 'LBL_EXPORT_RECORDS');
		$viewer->assign('EXPORT_ACTION_LABEL', $isCustomExportView ? 'LBL_CUSTOM_EXPORT' : 'LBL_EXPORT');

         // for the option of selecting currency while exporting inventory module records
        if(in_array($source_module, Vtiger_Functions::getLineItemFieldModules())){
           $viewer->assign('MULTI_CURRENCY',true);
        }
        
        $searchKey = $request->get('search_key');
        $searchValue = $request->get('search_value');
		$operator = $request->get('operator');
        if(!empty($operator)) {
			$viewer->assign('OPERATOR',$operator);
			$viewer->assign('ALPHABET_VALUE',$searchValue);
            $viewer->assign('SEARCH_KEY',$searchKey);
		}
		$viewer->assign('SUPPORTED_FILE_TYPES', array('csv', 'ics'));
		$viewer->assign('SEARCH_PARAMS', $request->get('search_params'));

		if ($isCustomExportView) {
			$this->assignCustomExportViewerData($viewer, $source_module);
			$viewer->assign('TEMPLATE_NAME', 'CustomExport.tpl');
		} else {
			$viewer->assign('TEMPLATE_NAME', 'Export.tpl');
		}

		$viewer->view($viewer->getTemplateVars('TEMPLATE_NAME'), $source_module);
	}

	function getHeaderScripts(Vtiger_Request $request) {
		$headerScriptInstances = parent::getHeaderScripts($request);

		$moduleName = $request->getModule();
		if (in_array($moduleName, getInventoryModules())) {
			$moduleEditFile = 'modules.'.$moduleName.'.resources.Edit';
			unset($headerScriptInstances[$moduleEditFile]);

			$jsFileNames = array(
				'modules.Inventory.resources.Edit',
				'modules.'.$moduleName.'.resources.Edit',
			);
		}

		$jsScriptInstances = $this->checkAndConvertJsScripts($jsFileNames);
		$headerScriptInstances = array_merge($headerScriptInstances, $jsScriptInstances);
		return $headerScriptInstances;
	}

	protected function assignCustomExportViewerData($viewer, $sourceModule, $advanceCriteria = array()) {
		$moduleModel = Vtiger_Module_Model::getInstance($sourceModule);
		$recordStructureInstance = Vtiger_RecordStructure_Model::getInstanceForModule($moduleModel, Vtiger_RecordStructure_Model::RECORD_STRUCTURE_MODE_FILTER);
		$recordStructure = $recordStructureInstance->getStructure();

		if (in_array($sourceModule, getInventoryModules())) {
			$itemsBlock = 'LBL_ITEM_DETAILS';
			unset($recordStructure[$itemsBlock]);
		}

		$customViewModel = new CustomView_Record_Model();
		$customViewModel->setModule($sourceModule);

		if ($sourceModule == 'Calendar') {
			$advanceFilterOpsByFieldType = Calendar_Field_Model::getAdvancedFilterOpsByFieldType();
			$relatedModuleModel = Vtiger_Module_Model::getInstance('Events');
			$relatedRecordStructureInstance = Vtiger_RecordStructure_Model::getInstanceForModule($relatedModuleModel, Vtiger_RecordStructure_Model::RECORD_STRUCTURE_MODE_FILTER);
			$viewer->assign('EVENT_RECORD_STRUCTURE', $relatedRecordStructureInstance->getStructure());
		} else {
			$advanceFilterOpsByFieldType = Vtiger_Field_Model::getAdvancedFilterOpsByFieldType();
		}

		$dateFilters = Vtiger_Field_Model::getDateFilterTypes();
		foreach ($dateFilters as $comparatorKey => $comparatorInfo) {
			$comparatorInfo['startdate'] = DateTimeField::convertToUserFormat($comparatorInfo['startdate']);
			$comparatorInfo['enddate'] = DateTimeField::convertToUserFormat($comparatorInfo['enddate']);
			$comparatorInfo['label'] = vtranslate($comparatorInfo['label'], 'Vtiger');
			$dateFilters[$comparatorKey] = $comparatorInfo;
		}

		$viewer->assign('MODULE_MODEL', $moduleModel);
		$viewer->assign('CUSTOMVIEW_MODEL', $customViewModel);
		$viewer->assign('RECORD_STRUCTURE', $recordStructure);
		$viewer->assign('ADVANCE_CRITERIA', is_array($advanceCriteria) ? $advanceCriteria : array());
		$viewer->assign('ADVANCED_FILTER_OPTIONS', Vtiger_Field_Model::getAdvancedFilterOptions());
		$viewer->assign('ADVANCED_FILTER_OPTIONS_BY_TYPE', $advanceFilterOpsByFieldType);
		$viewer->assign('DATE_FILTERS', $dateFilters);
		$viewer->assign('SAVED_EXPORT_FORMATS', Vtiger_CustomExportFormat_Model::getAllByModuleForCurrentUser($sourceModule));
	}
}