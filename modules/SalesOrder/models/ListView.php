<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class SalesOrder_ListView_Model extends Inventory_ListView_Model {

    /**
     * Function to get the list view mass actions for the module
     * @param <Array> $linkParams
     * @return <Array> - Associative array of Link type to List of  Vtiger_Link_Model instances for Mass Actions
     */
    public function getListViewMassActions($linkParams) {
        error_log("SalesOrder_ListView_Model::getListViewMassActions called. Export permission: " . (Users_Privileges_Model::isPermitted('SalesOrder', 'Export') ? 'true' : 'false'));
        
        // Get parent mass actions first
        $links = parent::getListViewMassActions($linkParams);
        
        $moduleModel = $this->getModule();
        $exportPermission = Users_Privileges_Model::isPermitted($moduleModel->getName(), 'Export');
        
        if($exportPermission) {
            $exportPDFLink = array(
                'linktype' => 'LISTVIEWMASSACTION',
                'linklabel' => 'Export PDF Files',
                'linkurl' => 'javascript:SalesOrder_List_Js.triggerExportPDFFiles()',
                'linkicon' => 'fa fa-file-pdf-o'
            );
            
            $links['LISTVIEWMASSACTION'][] = Vtiger_Link_Model::getInstanceFromValues($exportPDFLink);
            error_log("Export PDF Files link added to mass actions");
        }
        
        return $links;
    }

    /**
     * Alternative method - override getListViewLinks to add mass action
     */
    public function getListViewLinks($linkParams) {
        error_log("SalesOrder_ListView_Model::getListViewLinks called");
        $links = parent::getListViewLinks($linkParams);
        
        $moduleModel = $this->getModule();
        $exportPermission = Users_Privileges_Model::isPermitted($moduleModel->getName(), 'Export');
        
        if($exportPermission) {
            $exportPDFLink = array(
                'linktype' => 'LISTVIEWMASSACTION',
                'linklabel' => 'Export PDF Files',
                'linkurl' => 'javascript:SalesOrder_List_Js.triggerExportPDFFiles()',
                'linkicon' => 'fa fa-file-pdf-o'
            );
            
            if (!isset($links['LISTVIEWMASSACTION'])) {
                $links['LISTVIEWMASSACTION'] = array();
            }
            $links['LISTVIEWMASSACTION'][] = Vtiger_Link_Model::getInstanceFromValues($exportPDFLink);
            error_log("Export PDF Files link added to mass actions via getListViewLinks");
        }
        
        return $links;
    }
}