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
</div>
<div class="modalContents">
    <div class="modal-dialog basicCreateView">
        <div class='modal-content'>
            <form id="importValuesToRoleForm" name="importValuesToRoleForm"  class="form-horizontal" method="post" action="index.php" enctype="multipart/form-data">
                <input type="hidden" name="module" value="{$MODULE}" />
                <input type="hidden" name="parent" value="Settings" />
                <input type="hidden" name="source_module" value="{$SELECTED_MODULE_NAME}" />
                <input type="hidden" name="action" value="IndexAjax" />
		            <input type="hidden" name="mode" value="importValuesToRole" />
                <input type="hidden" name="picklistName" value="{$SELECTED_PICKLIST_FIELDMODEL->get('name')}" />
                <input type="hidden" name="pickListValues" value='{Vtiger_Util_Helper::toSafeHTML(ZEND_JSON::encode($SELECTED_PICKLISTFIELD_ALL_VALUES))}' />
                {assign var=HEADER_TITLE value={vtranslate('LBL_IMPORT_ITEM_TO', 'ITS4YouPicklistImport')}|cat:" "|cat:{vtranslate($SELECTED_PICKLIST_FIELDMODEL->get('label'),$SELECTED_MODULE_NAME)}}
                {include file="ModalHeader.tpl"|vtemplate_path:$MODULE TITLE=$HEADER_TITLE}
                <div class="modal-body">
                    <div class="form-group">
                     <div class="control-label col-sm-3 col-xs-3">{vtranslate('LBL_ITEM_VALUE',$QUALIFIED_MODULE)}&nbsp;<span class="redColor">*</span></div>
                     <div class="controls col-sm-3 col-xs-3"><input type="file" name="import_file" id="import_file" onchange="ImportJs.checkFileType()"/></div>
                       {*<!--  <div class="controls col-sm-3 col-xs-3"><input style="min-width: 220px;" name="newValue" class="form-control select2" data-rule-required="true"/></div> --!>*}
                    </div>
                    <!--{if $SELECTED_PICKLIST_FIELDMODEL->isRoleBased()}
                        <div class="form-group">	
                            <div class="control-label col-sm-3 col-xs-3">{vtranslate('LBL_ASSIGN_TO_ROLE',$QUALIFIED_MODULE)}</div>
                            <div class="controls col-sm-3 col-xs-3">
                                <select class="rolesList form-control" name="rolesSelected[]" multiple style="min-width: 220px" data-placeholder="{vtranslate('LBL_CHOOSE_ROLES',$QUALIFIED_MODULE)}">
                                    <option value="all" selected>{vtranslate('LBL_ALL_ROLES',$QUALIFIED_MODULE)}</option>
                                    {foreach from=$ROLES_LIST item=ROLE}
                                        <option value="{$ROLE->get('roleid')}">{$ROLE->get('rolename')}</option>
                                    {/foreach}
                                </select>	
                            </div>
                        </div>
                    {/if}     --!>
                    {if $SELECTED_PICKLIST_FIELDMODEL->isRoleBased()}
				<div class="form-group">	
					<div class="control-label col-sm-3 col-xs-3">{vtranslate('LBL_ASSIGN_TO_ROLE',$QUALIFIED_MODULE)}<span class="redColor">*</span></div>
					<div class="controls">
						<select class="rolesList select2" id="rolesSelected" name="rolesSelected[]" multiple style="min-width: 220px" data-placeholder="{vtranslate('LBL_CHOOSE_ROLES',$QUALIFIED_MODULE)}">
							<option value="all" selected>{vtranslate('LBL_ALL_ROLES',$QUALIFIED_MODULE)}</option>
							{foreach from=$ROLES_LIST item=ROLE}
								<option value="{$ROLE->get('roleid')}">{$ROLE->get('rolename')}</option>
							{/foreach}
						</select>	
					</div>
				</div>
			{/if}
                </div>
                {include file='ModalFooter.tpl'|@vtemplate_path:$qualifiedName}
            </form>
        </div>
    </div>
</div>
{/strip}
