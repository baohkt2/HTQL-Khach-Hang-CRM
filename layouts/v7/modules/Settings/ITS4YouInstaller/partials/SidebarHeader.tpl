{*/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouInstaller license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */*}
{assign var=APP_IMAGE_MAP value=[
'MARKETING' => 'fa-users',
'SALES'        => 'fa-dot-circle-o',
'SUPPORT'    => 'fa-life-ring',
'INVENTORY'    => 'vicon-inventory',
'PROJECT'    => 'fa-briefcase',
'TOOLS'        => 'fa-wrench'
]}

<div class="col-sm-12 col-xs-12 app-indicator-icon-container extensionstore app-MARKETING">
    <div class="row" title="{vtranslate('LBL_EXTENSION_STORE', 'Settings:$QUALIFIED_MODULE')}">
        <span class="app-indicator-icon cursorPointer fa fa-shopping-cart"></span>
    </div>
</div>

{include file="modules/Vtiger/partials/SidebarAppMenu.tpl"}
