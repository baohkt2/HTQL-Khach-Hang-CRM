{* *********************************************************************************
 * The content of this file is subject to the ITS4YouInstaller license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ******************************************************************************* *}
{include file="modules/Vtiger/partials/Topbar.tpl"}

<div class="container-fluid app-nav">
	<div class="row">
		{include file="partials/SidebarHeader.tpl"|vtemplate_path:$QUALIFIED_MODULE}
		{include file="ModuleHeader.tpl"|vtemplate_path:$QUALIFIED_MODULE}
	</div>
</div>
</nav>
<div id='overlayPageContent' class='fade modal overlayPageContent content-area overlay-container-300' tabindex='-1' role='dialog' aria-hidden='true'>
	<div class="data">
	</div>
	<div class="modal-dialog">
	</div>
</div>
{if $FIELDS_INFO neq null}
	<script type="text/javascript">
		var uimeta = (function() {
			var fieldInfo  = {$FIELDS_INFO};
			return {
				field: {
					get: function(name, property) {
						if(name && property === undefined) {
							return fieldInfo[name];
						}
						if(name && property) {
							return fieldInfo[name][property]
						}
					},
					isMandatory : function(name){
						if(fieldInfo[name]) {
							return fieldInfo[name].mandatory;
						}
						return false;
					},
					getType : function(name){
						if(fieldInfo[name]) {
							return fieldInfo[name].type
						}
						return false;
					}
				},
			};
		})();
	</script>
{/if}
<div class="main-container clearfix">
	{assign var=LEFTPANELHIDE value=$USER_MODEL->get('leftpanelhide')}
	<div class="module-nav clearfix settingsNav" id="modnavigator">
		<div class="hidden-xs hidden-sm height100Per">
			{include file="modules/Settings/Vtiger/Sidebar.tpl"}
		</div>
	</div>
	<div class="settingsPageDiv content-area clearfix">

