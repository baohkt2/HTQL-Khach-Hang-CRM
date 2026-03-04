<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/
require_once('include/events/SqlResultIterator.inc');
require_once('VTWorkflowManager.inc');
require_once('VTEntityCache.inc');
require_once 'include/Webservices/Utils.php';
require_once("modules/Users/Users.php");
require_once("include/Webservices/VtigerCRMObject.php");
require_once("include/Webservices/VtigerCRMObjectMeta.php");
require_once("include/Webservices/DataTransform.php");
require_once("include/Webservices/WebServiceError.php");
require_once 'include/utils/utils.php';
require_once 'include/Webservices/ModuleTypes.php';
require_once('include/Webservices/Retrieve.php');
require_once('include/Webservices/Update.php');
require_once 'include/Webservices/WebserviceField.php';
require_once 'include/Webservices/EntityMeta.php';
require_once 'include/Webservices/VtigerWebserviceObject.php';
require_once('VTWorkflowUtils.php');

/**
 * VTDeleteEventHandler - Handles workflow execution when records are deleted
 */
class VTDeleteEventHandler extends VTEventHandler {
	
	/**
	 * Execute workflows with ON_DELETE execution condition
	 * @param $entityData A VTEntityData object representing the entity being deleted
	 */
	function handleEvent($eventName, $entityData) {
		$util = new VTWorkflowUtils();
		$user = $util->adminUser();
		global $adb;
		
		$entityCache = new VTEntityCache($user);
		
		$wsModuleName = $util->toWSModuleName($entityData);
		$wsId = vtws_getWebserviceEntityId($wsModuleName, $entityData->getId());
		$entityData = $entityCache->forId($wsId);
		
		// Get workflows for this module with ON_DELETE execution condition
		$wfs = new VTWorkflowManager($adb);
		$workflows = $wfs->getWorkflowsForModule($entityData->getModuleName());
		
		foreach ($workflows as $workflow) {
			if (!is_a($workflow, 'Workflow'))
				continue;
			
			// Only execute workflows with ON_DELETE execution condition
			if ($workflow->executionCondition == VTWorkflowManager::$ON_DELETE) {
				// Evaluate conditions and execute tasks
				if ($workflow->evaluate($entityCache, $entityData->getId())) {
					$workflow->performTasks($entityData);
				}
			}
		}
		
		$util->revertUser();
	}
}
?>
