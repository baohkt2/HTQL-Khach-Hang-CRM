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

class VTDeletedWorkflowEntity {
	private $data;
	private $moduleName;

	public function __construct($data, $moduleName) {
		$this->data = $data;
		$this->moduleName = $moduleName;
	}

	public function getData() {
		return $this->data;
	}

	public function getId() {
		return isset($this->data['id']) ? $this->data['id'] : null;
	}

	public function getModuleName() {
		return $this->moduleName;
	}

	public function get($fieldName) {
		return isset($this->data[$fieldName]) ? $this->data[$fieldName] : null;
	}

	public function set($fieldName, $value) {
		$this->data[$fieldName] = $value;
	}

	public function isNew() {
		return false;
	}
}

/**
 * VTDeleteEventHandler - Handles workflow execution when records are deleted
 */
class VTDeleteEventHandler extends VTEventHandler {
	private function logDebug($message) {
		$logFile = 'logs/delete_workflow_debug.log';
		$timestamp = date('Y-m-d H:i:s');
		file_put_contents($logFile, '[' . $timestamp . '] ' . $message . PHP_EOL, FILE_APPEND);
	}
	
	/**
	 * Execute workflows with ON_DELETE execution condition
	 * @param $entityData A VTEntityData object representing the entity being deleted
	 */
	function handleEvent($eventName, $entityData) {
		$util = new VTWorkflowUtils();
		$user = $util->adminUser();
		global $adb;
		
		$entityCache = new VTEntityCache($user);
		$deletedEntity = null;

		try {
			$wsModuleName = $util->toWSModuleName($entityData);
			$this->logDebug('Event=' . $eventName . ' record=' . $entityData->getId() . ' module=' . $wsModuleName);
			$moduleHandler = vtws_getModuleHandlerFromName($wsModuleName, $user);
			$sanitizedData = DataTransform::filterAndSanitize($entityData->getData(), $moduleHandler->getMeta());
			$deletedEntity = new VTDeletedWorkflowEntity($sanitizedData, $wsModuleName);
			VTEntityCache::setCachedEntity($deletedEntity->getId(), $deletedEntity);
		
			// Get workflows for this module with ON_DELETE execution condition
			$wfs = new VTWorkflowManager($adb);
			$workflows = $wfs->getWorkflowsForModule($deletedEntity->getModuleName());
			$this->logDebug('Loaded ' . count($workflows) . ' workflows for module=' . $deletedEntity->getModuleName() . ' wsid=' . $deletedEntity->getId());
		
			foreach ($workflows as $workflow) {
				if (!is_a($workflow, 'Workflow')) {
					continue;
				}
				
				if ($workflow->executionCondition == VTWorkflowManager::$ON_DELETE) {
					$matched = $workflow->evaluate($entityCache, $deletedEntity->getId());
					$this->logDebug('Workflow ' . $workflow->id . ' matched=' . ($matched ? 'true' : 'false'));
					if ($matched) {
						$workflow->performTasks($deletedEntity);
						$this->logDebug('Workflow ' . $workflow->id . ' tasks executed');
					}
				}
			}
		} catch (Exception $e) {
			$this->logDebug('Error record=' . $entityData->getId() . ' message=' . $e->getMessage());
			error_log('VTDeleteEventHandler failed for record ' . $entityData->getId() . ': ' . $e->getMessage());
		} finally {
			if ($deletedEntity && $deletedEntity->getId()) {
				VTEntityCache::unsetCachedEntity($deletedEntity->getId());
			}
			$util->revertUser();
		}
	}
}
?>
