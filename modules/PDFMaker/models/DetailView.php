<?php

/* * *******************************************************************************
 * The content of this file is subject to the PDF Maker Free license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

class PDFMaker_DetailView_Model extends Vtiger_DetailView_Model {
	
	public function getDetailViewLinks($linkParams) {
		$linkTypes = array('DETAILVIEWBASIC','DETAILVIEW');
		$moduleModel = $this->getModule();
		$recordModel = $this->getRecord();

        $detailViewLink = array(
				'linktype' => 'DETAILVIEWBASIC',
				'linklabel' => 'LBL_EDIT',
				'linkurl' => $recordModel->getEditViewUrl(),
				'linkicon' => ''
        );

		$linkModelList = array();
    	$linkModelList['DETAILVIEWBASIC'][] = Vtiger_Link_Model::getInstanceFromValues($detailViewLink);

		$linkModelListDetails = Vtiger_Link_Model::getAllByType($moduleModel->getId(),$linkTypes,$linkParams);
		$detailViewBasiclinks = $linkModelListDetails['DETAILVIEWBASIC'];
		unset($linkModelListDetails['DETAILVIEWBASIC']);

		if(!empty($detailViewBasiclinks)) {
			foreach($detailViewBasiclinks as $linkModel) {
				$linkModelList['DETAILVIEW'][] = $linkModel;
			}
		}
		return $linkModelList;
	}

	public function getSideBarLinks($linkParams) {
		$linkTypes = array('SIDEBARLINK', 'SIDEBARWIDGET');
		$moduleLinks = $this->getModule()->getSideBarLinks($linkTypes);
		
		$listLinkTypes = array('DETAILVIEWSIDEBARLINK', 'DETAILVIEWSIDEBARWIDGET');
		$listLinks = Vtiger_Link_Model::getAllByType($this->getModule()->getId(), $listLinkTypes);
		
		if($listLinks['DETAILVIEWSIDEBARLINK']) {
			foreach($listLinks['DETAILVIEWSIDEBARLINK'] as $link) {
				$link->linkurl = $link->linkurl.'&record='.$this->getRecord()->getId().'&source_module='.$this->getModule()->getName();
				$moduleLinks['SIDEBARLINK'][] = $link;
			}
		}

		if($listLinks['DETAILVIEWSIDEBARWIDGET']) {
			foreach($listLinks['DETAILVIEWSIDEBARWIDGET'] as $link) {
				$link->linkurl = $link->linkurl.'&record='.$this->getRecord()->getId().'&source_module='.$this->getModule()->getName();
				$moduleLinks['SIDEBARWIDGET'][] = $link;
			}
		}
		
		return $moduleLinks;
	}
	
	public static function getInstance($moduleName,$recordId) {
		$modelClassName = Vtiger_Loader::getComponentClassName('Model', 'DetailView', $moduleName);
		$instance = new $modelClassName();

		$moduleModel = PDFMaker_Module_Model::getInstance($moduleName);
		$recordModel = PDFMaker_Record_Model::getInstanceById($recordId, $moduleName);
		
		return $instance->setModule($moduleModel)->setRecord($recordModel);
	}
}