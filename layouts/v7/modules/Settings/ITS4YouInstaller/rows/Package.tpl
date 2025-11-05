{*/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouInstaller license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */*}
{assign var=MODULE_MODEL value=$EXTENSION->get('moduleModel')}
{assign var=MODULE_NAME value=$EXTENSION->get('name')}
<tr>
    <td>
        <a {if $MODULE_MODEL && $MODULE_MODEL->isActive()}href="{$MODULE_MODEL->getDefaultUrl()}" target="_blank" {else} href="#{$MODULE_NAME}" {/if}>{vtranslate($EXTENSION->get('label'), $QUALIFIED_MODULE)}</a>
    </td>
    <td class="validateVersion">{$EXTENSION->getVersion()}</td>
    <td class="updateTime" title="{$EXTENSION->getUpdateTimeRaw()}">{$EXTENSION->getUpdateTime()}</td>
    <td>{$EXTENSION->get('pkgVersion')}</td>
    <td>
        <span class="extension_container">
            {if $EXTENSION->isVtigerCompatible()}
                <input type="hidden" name="extensionName" value="{$EXTENSION->get('name')}"/>
                <input type="hidden" name="extensionUrl" value="{$EXTENSION->get('downloadURL')}"/>
                <input type="hidden" name="extensionId" value="{$EXTENSION->get('id')}"/>
                <input type="hidden" name="extensionType" value="Package"/>
                <input type="hidden" name="moduleMode" value="showChangelog"/>
                {if !$EXTENSION->isAlreadyExists()}
                    <input type="hidden" name="moduleAction" value="Install"/>
                    <button class="showChangeLog btn btn-primary {if $IS_AUTH}authenticated {else} loginRequired{/if}">
                        {vtranslate('LBL_INSTALL', $QUALIFIED_MODULE)}
                    </button>
                {elseif $EXTENSION->isUpgradableMulti()}
                    <input type="hidden" name="moduleAction" value="Upgrade"/>
                    <input type="hidden" name="moduleMessage" value="{$EXTENSION->getUpdateMessage()}"/>
                    <button class="showChangeLog isUpdateBtn btn btn-success margin0px {if $IS_AUTH}authenticated {else} loginRequired{/if}">
                        {vtranslate('LBL_UPDATE', $QUALIFIED_MODULE)}
                    </button>
                {/if}
            {/if}
        </span>
        {if $MODULE_MODEL}
            {assign var=SETTINGS_LINKS value=$MODULE_MODEL->getSettingLinks()}
            {if (count($SETTINGS_LINKS) > 0)}
                <span class="btn-group pull-right {if !$MODULE_MODEL->isActive()}hide{/if}">
                    <button class="btn btn-default btn dropdown-toggle unpin hiden " data-toggle="dropdown">
                        {vtranslate('LBL_SETTINGS', $QUALIFIED_MODULE)}&nbsp;<i class="caret"></i>
                    </button>
                    <ul class="dropdown-menu pull-right dropdownfields">
                        {foreach item=SETTINGS_LINK from=$SETTINGS_LINKS}
                            <li>
                                <a target="_blank" {if stripos($SETTINGS_LINK['linkurl'], 'javascript:') === 0}onclick='{$SETTINGS_LINK['linkurl']|substr:strlen("javascript:")}'{else}href='{$SETTINGS_LINK['linkurl']}'{/if}>
                                    {vtranslate($SETTINGS_LINK['linklabel'], $MODULE_NAME, vtranslate("SINGLE_$MODULE_NAME", $MODULE_NAME))}
                                </a>
                            </li>
                        {/foreach}
                    </ul>
                </span>
            {/if}
        {/if}
        <span class="pull-right">
            {if $EXTENSION->get('website') neq ""}
                <button class="btn installExtension addButton" style="margin-right:5px;" data-url="{$EXTENSION->get('website')}">{vtranslate('LBL_MORE_DETAILS', $QUALIFIED_MODULE)}</button>
            {/if}
        </span>
    </td>
</tr>