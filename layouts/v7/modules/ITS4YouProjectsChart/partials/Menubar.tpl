{*/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouProjectsChart license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */*}

{if $MENU_STRUCTURE}
    {assign var="topMenus" value=$MENU_STRUCTURE->getTop()}
    {assign var="moreMenus" value=$MENU_STRUCTURE->getMore()}
    <div id="modules-menu" class="modules-menu">
        {foreach key=moduleName item=moduleModel from=$SOURCE_MODULE_MENU}
            {assign var='translatedModuleLabel' value=vtranslate($moduleModel->get('label'),$moduleName )}
            <ul title="{$translatedModuleLabel}" class="module-qtip">
                <li {if $SOURCE_MODULE_NAME eq $moduleName}class="active" {else}class=""{/if}>
                    <a href="{$moduleModel->getDefaultUrl()}&app={$SOURCE_MODULE_MENU_PARENT}" style="border-color: {$DEFAULT_COLOR}">
                        {$moduleModel->getModuleIcon()}
                        <span>{$translatedModuleLabel}</span>
                    </a>
                </li>
            </ul>
        {/foreach}
    </div>
{/if}
