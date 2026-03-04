{*+**********************************************************************************
 * The content of this file is subject to the ITS4YouKanbanView license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
************************************************************************************}

{include file="modules/Vtiger/partials/Topbar.tpl"}

<div class="container-fluid app-nav">
    <div class="row">
        {include file="partials/SidebarHeader.tpl"|vtemplate_path:$MODULE SELECTED_MENU_CATEGORY=$SOURCE_MODULE_MENU_PARENT}
        {include file="ModuleHeader.tpl"|vtemplate_path:$MODULE}
    </div>
</div>
</nav>
<div id='overlayPageContent' class='fade modal overlayPageContent content-area overlay-container-60' tabindex='-1' role='dialog' aria-hidden='true'>
    <div class="data">
    </div>
    <div class="modal-dialog">
    </div>
</div>
<div class="main-container main-container-{$SOURCE_MODULE_NAME}">
    {assign var=LEFTPANELHIDE value=$CURRENT_USER_MODEL->get('leftpanelhide')}
    <div id="modnavigator" class="module-nav">
        <div class="hidden-xs hidden-sm mod-switcher-container">
            {include file="partials/Menubar.tpl"|vtemplate_path:$MODULE}
        </div>
        <div id="sidebar-essentials" class="sidebar-essentials {if $LEFTPANELHIDE eq '1'} hide {/if}">
            {include file="partials/SidebarEssentials.tpl"|vtemplate_path:$MODULE}
        </div>
    </div>
    <div class="listViewPageDiv content-area-chart" id="kanbanListViewContent">
        <div class="main-container detailViewContainer clearfix" id="taskManagementContainer" style="min-height: 768px">
            <input type="hidden" name="source_module_name" id="source_module_name" value="{$SOURCE_MODULE_NAME}">
            <input type="hidden" name="source_field_name" id="source_field_name" value="{$SOURCE_MODULE_NAME}">
            <input type="hidden" name="custom_view_id" id="custom_view_id" value="{$DEFAULT_CUSTOM_VIEW_ID}">
            <div class="listViewPageDiv content-area {if $LEFTPANELHIDE eq '1'} full-width {/if}" id="listViewContent">
                <br>
                {include file="QuickFilter.tpl"|vtemplate_path:$MODULE}
