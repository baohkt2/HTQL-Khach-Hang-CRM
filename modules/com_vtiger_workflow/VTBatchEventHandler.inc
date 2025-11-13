<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/

require_once('modules/com_vtiger_workflow/VTEventHandler.inc');

/**
 * VTBatchEventHandler - Handler for batch events like import
 * This enables workflows to be triggered during import operations
 */
class VTBatchEventHandler extends VTEventHandler {

	/**
	 * Handle batch events and trigger workflows for each entity
	 * @param string $eventName The event name (e.g., 'vtiger.batchevent.save')
	 * @param array $entityDataArray Array of VTEntityData objects
	 */
	function handleEvent($eventName, $entityDataArray) {
		error_log("VTBatchEventHandler: handleEvent called with event: $eventName");
		error_log("VTBatchEventHandler: entityDataArray type: " . gettype($entityDataArray));
		
		if ($eventName !== 'vtiger.batchevent.save' || !is_array($entityDataArray)) {
			error_log("VTBatchEventHandler: Event name or data type mismatch. Returning.");
			return;
		}

		error_log("VTBatchEventHandler: Processing " . count($entityDataArray) . " entities");
		
		$util = new VTWorkflowUtils();
		$user = $util->adminUser();
		global $adb;

		$entityCache = new VTEntityCache($user);

		// Process each entity in the batch
		foreach ($entityDataArray as $index => $entityData) {
			if (!is_a($entityData, 'VTEntityData')) {
				error_log("VTBatchEventHandler: Entity at index $index is not VTEntityData: " . gettype($entityData));
				continue;
			}

			error_log("VTBatchEventHandler: Processing entity " . $entityData->getId() . " (" . $entityData->getModuleName() . ")");

			try {
				$this->processEntityWorkflows($entityData, $entityCache, $user, $adb);
			} catch (Exception $e) {
				// Log error but continue processing other entities
				error_log("VTBatchEventHandler: Error processing entity " . $entityData->getId() . ": " . $e->getMessage());
			}
		}

		$util->revertUser();
	}

	/**
	 * Process workflows for a single entity
	 * @param VTEntityData $entityData The entity data
	 * @param VTEntityCache $entityCache Entity cache instance
	 * @param Users $user Admin user
	 * @param PearDatabase $adb Database instance
	 */
	private function processEntityWorkflows($entityData, $entityCache, $user, $adb) {
		error_log("VTBatchEventHandler: processEntityWorkflows called for " . $entityData->getId());
		
		$wsModuleName = (new VTWorkflowUtils())->toWSModuleName($entityData);
		$wsId = vtws_getWebserviceEntityId($wsModuleName, $entityData->getId());
		$cachedEntityData = $entityCache->forId($wsId);

		error_log("VTBatchEventHandler: Module: $wsModuleName, WS ID: $wsId");

		// Get workflows for this module
		$wfs = new VTWorkflowManager($adb);
		$workflows = $wfs->getWorkflowsForModule($cachedEntityData->getModuleName());

		error_log("VTBatchEventHandler: Found " . count($workflows) . " workflows for module " . $cachedEntityData->getModuleName());

		foreach ($workflows as $workflow) {
			if (!is_a($workflow, 'Workflow')) {
				continue;
			}

			error_log("VTBatchEventHandler: Checking workflow " . $workflow->id . " (" . $workflow->description . ") with condition " . $workflow->executionCondition);

			// For imports, we treat records as "new" and trigger workflows that would fire on creation
			$shouldEvaluate = false;
			
			switch ($workflow->executionCondition) {
				case VTWorkflowManager::$ON_FIRST_SAVE:
				case VTWorkflowManager::$ON_EVERY_SAVE:
					$shouldEvaluate = true;
					error_log("VTBatchEventHandler: Workflow " . $workflow->id . " will be evaluated (ON_FIRST_SAVE/ON_EVERY_SAVE)");
					break;
				case VTWorkflowManager::$ONCE:
					// Check if workflow was already executed for this record
					$entityId = vtws_getIdComponents($cachedEntityData->getId())[1];
					if (!$workflow->isCompletedForRecord($entityId)) {
						$shouldEvaluate = true;
						error_log("VTBatchEventHandler: Workflow " . $workflow->id . " will be evaluated (ONCE - not completed)");
					} else {
						error_log("VTBatchEventHandler: Workflow " . $workflow->id . " skipped (ONCE - already completed)");
					}
					break;
				case VTWorkflowManager::$ON_MODIFY:
					// For imports, we don't trigger modify workflows as these are treated as new records
					$shouldEvaluate = false;
					error_log("VTBatchEventHandler: Workflow " . $workflow->id . " skipped (ON_MODIFY not applicable for imports)");
					break;
				default:
					$shouldEvaluate = false;
					error_log("VTBatchEventHandler: Workflow " . $workflow->id . " skipped (unknown condition: " . $workflow->executionCondition . ")");
					break;
			}

			if ($shouldEvaluate) {
				try {
					error_log("VTBatchEventHandler: Evaluating workflow " . $workflow->id . " for entity " . $cachedEntityData->getId());
					
					if ($workflow->evaluate($entityCache, $cachedEntityData->getId())) {
						error_log("VTBatchEventHandler: Workflow " . $workflow->id . " conditions met. Executing tasks...");
						$workflow->performTasks($cachedEntityData);
						error_log("VTBatchEventHandler: Workflow " . $workflow->id . " tasks completed");
						
						// For ONCE workflows, mark as completed
						if ($workflow->executionCondition == VTWorkflowManager::$ONCE) {
							$entityId = vtws_getIdComponents($cachedEntityData->getId())[1];
							$workflow->markAsCompletedForRecord($entityId);
							error_log("VTBatchEventHandler: Workflow " . $workflow->id . " marked as completed for record " . $entityId);
						}
					} else {
						error_log("VTBatchEventHandler: Workflow " . $workflow->id . " conditions NOT met");
					}
				} catch (Exception $e) {
					error_log("VTBatchEventHandler: Error executing workflow " . $workflow->id . " for entity " . $entityData->getId() . ": " . $e->getMessage());
				}
			}
		}
	}
}
?>