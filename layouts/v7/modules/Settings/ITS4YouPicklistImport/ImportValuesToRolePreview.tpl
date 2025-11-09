{*<!--
/***********************************************************************************
 * The content of this file is subject to the ITS4YouPicklistImport license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 ************************************************************************************/
-->*}
{strip}
<div class='modelContainer modal basicAssignValueToRoleView'>
	<div class="modal-header">
		<button data-dismiss="modal" class="close" title="{vtranslate('LBL_CLOSE')}">x</button>
		<h3>{vtranslate('LBL_IMPORT_VALUES_TO_ROLES', $QUALIFIED_MODULE)}</h3>
	</div>
	<form id="importValuesToRoleForm" name="importValuesToRoleForm"  class="form-horizontal" method="post" action="index.php">
		<input type="hidden" name="module" value="{$MODULE}" />
		<input type="hidden" name="parent" value="Settings" />
		<input type="hidden" name="source_module" value="{$SELECTED_MODULE_NAME}" />
		<input type="hidden" name="view" value="IndexAjax" />
		<input type="hidden" name="mode" value="showImportValuesToRolePreview" />
		<input type="hidden" name="picklistName" value="{$SELECTED_PICKLIST_FIELDMODEL->get('name')}" />
		<input type="hidden" name="pickListValues" value='{ZEND_JSON::encode($SELECTED_PICKLISTFIELD_ALL_VALUES)}' />
		<div class="modal-body tabbable">
			{$VALUES}
		</div>
		{include file='ModalFooter.tpl'|@vtemplate_path:$qualifiedName}
	</form>
</div>
{/strip}
