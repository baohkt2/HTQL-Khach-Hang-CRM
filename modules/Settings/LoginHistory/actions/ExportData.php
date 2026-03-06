<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Settings_LoginHistory_ExportData_Action extends Settings_Vtiger_Basic_Action {
    
    public function requiresPermission(\Vtiger_Request $request) {
		$permissions = parent::requiresPermission($request);
		return $permissions;
	}

    public function validateRequest(Vtiger_Request $request) {
        $request->validateReadAccess();
    }

    public function process(Vtiger_Request $request) {
        $qualifiedModuleName = $request->getModule(false);
        $moduleName = $request->getModule();
        
        $listViewModel = Settings_Vtiger_ListView_Model::getInstance($qualifiedModuleName);
        
        $searchField = 'user_name';
        $value = $request->get('user_name');
        
        if(!empty($searchField) && !empty($value)) {
            $listViewModel->set('search_key', $searchField);
            $listViewModel->set('search_value', $value);
        }

        $dateStart = $request->get('date_start');
        $dateEnd = $request->get('date_end');
        if (!empty($dateStart)) {
            $listViewModel->set('date_start', $dateStart);
        }
        if (!empty($dateEnd)) {
            $listViewModel->set('date_end', $dateEnd);
        }

        $listQuery = $listViewModel->getBasicListQuery();
        
        $db = PearDatabase::getInstance();
        $result = $db->pquery($listQuery, array());
        
        $listViewHeaders = $listViewModel->getListViewHeaders();
        
        $translatedHeaders = array();
        foreach($listViewHeaders as $name => $fieldModel) {
            $translatedHeaders[] = vtranslate($fieldModel->get('label'), $qualifiedModuleName);
        }
        
        $entries = array();
        for ($i = 0; $i < $db->num_rows($result); $i++) {
            $row = $db->query_result_rowdata($result, $i);
            $recordModel = new Settings_LoginHistory_Record_Model();
            foreach($row as $key => $value) {
                $recordModel->set($key, $value);
            }
            
            $entry = array();
            foreach($listViewHeaders as $name => $fieldModel) {
                $entry[] = $recordModel->getDisplayValue($name);
            }
            $entries[] = $entry;
        }
        
        $this->output($request, $translatedHeaders, $entries);
    }
    
    function output($request, $headers, $entries) {
		$moduleName = $request->getModule();
		$fileName = str_replace(' ','_',decode_html(vtranslate($moduleName, $moduleName)));
		$fileName = str_replace(',', '_', $fileName);
        
        require_once("libraries/PHPExcel/PHPExcel.php");

		$workbook = new PHPExcel();
		$worksheet = $workbook->setActiveSheetIndex(0);
        
        $header_styles = array(
			'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'E1E0F7')),
            'font' => array('bold' => true)
		);

        // Print Headers
        $colCount = 0;
        foreach($headers as $header) {
            $worksheet->setCellValueExplicitByColumnAndRow($colCount, 1, decode_html($header), PHPExcel_Cell_DataType::TYPE_STRING);
            $worksheet->getStyleByColumnAndRow($colCount, 1)->applyFromArray($header_styles);
            $colCount++;
        }

        // Print Entries
        $rowCount = 2;
        foreach($entries as $row) {
            $colCount = 0;
            foreach($row as $value) {
                $worksheet->setCellValueExplicitByColumnAndRow($colCount, $rowCount, decode_html($value), PHPExcel_Cell_DataType::TYPE_STRING);
                $colCount++;
            }
            $rowCount++;
        }

		header("Content-Disposition:attachment;filename=$fileName.xls");
		header("Content-Type:application/vnd.ms-excel;charset=UTF-8");
		header("Expires: Mon, 31 Dec 2000 00:00:00 GMT" );
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT" );
		header("Cache-Control: post-check=0, pre-check=0", false );

		ob_clean();
        
        $workbookWriter = PHPExcel_IOFactory::createWriter($workbook, 'Excel5');
		$workbookWriter->save('php://output');
	}
}
