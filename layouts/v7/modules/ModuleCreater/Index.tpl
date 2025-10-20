{*<!--
/* * *******************************************************************************
 * The content of this file is subject to the CRMTiger Pro license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is https://crmtiger.com/
 * Portions created by CRMTiger.com are Copyright(C) CRMTiger.com
 * All Rights Reserved.
 * ****************************************************************************** */
-->*}

{* modules/Settings/LayoutEditor/views/Index.php *}

{strip}
{include file="modules/Vtiger/partials/Topbar.tpl"}

<div class="container-fluid app-nav">
    <div class="row">
        {include file="partials/SidebarHeader.tpl"|vtemplate_path:$MODULE}
		{include file="ModuleHeader.tpl"|vtemplate_path:$MODULE}
    </div>
</div>
<div class="main-container main-container-ModuleCreater">
<div id="modnavigator" class="module-nav editViewModNavigator">
            <div class="hidden-xs hidden-sm mod-switcher-container">
                {include file="modules/Vtiger/partials/Menubar.tpl"}
            </div>
</div>

	<div class="container-fluid" id="layoutEditorContainer">
	
		<input id="selectedModuleName" type="hidden" value="{$SELECTED_MODULE_NAME}" />
		<input type="hidden" id="selectedModuleLabel" value="{vtranslate($SELECTED_MODULE_NAME,$SELECTED_MODULE_NAME)}" />
		<input type="hidden" id="token" name="token" value="{$smarty.request.token}" />
		<input type="hidden" id="current_module" name="current_module" value="{$TKSMODULE}" />
		<div class="widget_header row">
			<label class="col-sm-2 textAlignCenter" style="padding-top: 8px;">
				{vtranslate('LBL_ADD_FIELD_TO', $QUALIFIED_MODULE)}&nbsp;{$TKSMODULE}
			</label>
			<!--<div class="col-sm-6">
				<select class="select2 col-sm-6" name="layoutEditorModules">
					<option value=''>{vtranslate('LBL_SELECT_OPTION', $QUALIFIED_MODULE)}</option>
					{*foreach item=MODULE_NAME from=$SUPPORTED_MODULES*}
						<option value="{$MODULE_NAME}" {if $MODULE_NAME eq $SELECTED_MODULE_NAME} selected {/if}>
							{* Calendar needs to be shown as TODO so we are translating using Layout editor specific translations*}
							{if $MODULE_NAME eq 'Calendar'}
								{vtranslate($MODULE_NAME, $QUALIFIED_MODULE)}
							{else}
								{vtranslate($MODULE_NAME, $MODULE_NAME)}
							{/if}
						</option>
					{*/foreach*}
				</select>
			</div>-->
		</div>
		<span class="pull-right">
		<button class="btn btn-success hide download" type="button" id="download" 
						data-container="body" data-toggle="popover" data-placement="left" data-content="{vtranslate('LBL_CLICK_DOWNLOAD', $MODULE)}">
						<i class="icon-download"></i>&nbsp;&nbsp;<strong>{vtranslate('LBL_DOWNLOAD', $MODULE)}</strong>
					</button>
		<!--<button class="btn btn-success hide import" type="button" id="import"
						data-container="body" data-toggle="popover" data-placement="left" data-content="{vtranslate('LBL_CLICK_INSTALL', $MODULE)}">
						<strong>{vtranslate('LBL_INSTALL', $MODULE)}</strong>
					</button>			-->
		</span>	
		{if $USER_MODEL->get('is_admin') eq 'on'}
				<span class="btn-group pull-right">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<button class="btn dropdown-toggle" href="#" data-toggle="dropdown">
							<i class="icon-wrench" alt="{vtranslate('LBL_SETTINGS', $MODULE)}" title="{vtranslate('LBL_SETTINGS', $MODULE)}"></i>&nbsp;&nbsp;
							<i class="caret"></i>
						</button>
						<ul class="dropdown-menu">
							<li><a href='{$UNINSTALLURL}'>{vtranslate('LBL_UNINSTALL_MODULE_BUILDER', $MODULE)}</a></li>
						</ul>
				</span>
		{/if}
				
		<br>
		<br>
		{if $SELECTED_MODULE_NAME}
				
			<div class="contents tabbable" style="margin-left: 40px !important;overflow-y:scroll;height:500px">
				<ul class="nav nav-tabs layoutTabs massEditTabs">
					<li class="active detailviewTab"><a data-toggle="tab" href="#detailViewLayout"><strong>{vtranslate('LBL_DETAILVIEW_LAYOUT', $QUALIFIED_MODULE)}</strong></a></li>
					<li class="relatedListTab"><a data-toggle="tab" href="#relatedTabOrder"><strong>{vtranslate('LBL_RELATION_SHIPS', $QUALIFIED_MODULE)}</strong></a></li>
				</ul>
				<div class="tab-content layoutContent themeTableColor overflowVisible" >
					<div class="tab-pane active ibbb" id="detailViewLayout">
						{include file=vtemplate_path('FieldsList.tpl',$QUALIFIED_MODULE)}
					</div>
					</div>
					<div class="tab-pane active" id="relatedTabOrder">
					<div class="clear relatedListContainer"></div>
						<!--class="relatedTabModulesList"-->
					</div>
				</div>
							<form class="tks_modulevalidatetks" name="tks_moduleentityvalidate" id="tks_moduleentityvalidate" novalidate="novalidate" method="post">

				<div class='modal-overlay-footer clearfix'>
						<div class="row clearfix">
							<div class='textAlignCenter col-lg-12 col-md-12 col-sm-12 '>
							<input type="hidden" name="module" value="{$MODULE}" />
				<input type="hidden" name="action" value="BuildModule" />
				<input type="hidden" name="mode" value="saveModule" />
				<input type="hidden" id="noofblocks" name="noofblocks" value="1" />
				<input type="hidden" id="tkssequence" name="tkssequence" value="" />
				<input type="hidden" id="token" name="token" value="{$smarty.request.token}" />
				<input type="hidden" id="selectedModuleName" name="selectedModuleName" value="{$MODULE_LABEL}" />
								<button type='submit' id='tks_moduleentityvalidate' class='btn btn-success saveButton' data-content='Click to build the module & zip' >{vtranslate('LBL_SAVE', $MODULE)}</button>&nbsp;&nbsp;
								<a class='cancelLink' href="javascript:history.back()" type="reset">{vtranslate('LBL_CANCEL', $MODULE)}</a>
							</div>
						</div>
					</div>
					</form>
			</div>
			
			
			
			
		{/if}
	</div>

	{if $FIELDS_INFO neq '[]'}
		<script type="text/javascript">
			var uimeta = (function () {
				var fieldInfo = {$FIELDS_INFO};
				var newFieldInfo = {$NEW_FIELDS_INFO};
				return {
					field: {
						get: function (name, property) {
							if (name && property === undefined) {
								return fieldInfo[name];
							}
							if (name && property) {
								return fieldInfo[name][property]
							}
						},
						isMandatory: function (name) {
							if (fieldInfo[name]) {
								return fieldInfo[name].mandatory;
							}
							return false;
						},
						getType: function (name) {
							if (fieldInfo[name]) {
								return fieldInfo[name].type
							}
							return false;
						},
						getNewFieldInfo: function () {
							if (newFieldInfo['newfieldinfo']) {
								return newFieldInfo['newfieldinfo']
							}
							return false;
						}
					}
				};
			})();
		</script>
	{/if}

	{if !$REQUEST_INSTANCE->isAjax()}
		<script type="text/javascript">
			{literal}
				jQuery(document).ready(function () {
					var instance = new ModuleCreater_LayoutEditor_Js();
					instance.registerEvents();
				});
			{/literal}
		</script>
	{/if}
	
{/strip}