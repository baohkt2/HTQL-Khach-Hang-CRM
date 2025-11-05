{*<!--
/*+**********************************************************************************
 * Advanced Funnel Charts by SalesPlatform
 * Copyright (C) 2011-2016 SalesPlatform Ltd
 * All Rights Reserved.
 * This extension is licensed to be used within one instance of Vtiger CRM.
 * Source code or binaries may not be redistributed unless expressly permitted by SalesPlatform Ltd.
 * If you have any questions or comments, please email: extensions@salesplatform.ru
 ************************************************************************************/
-->*}
{strip}
<div class="row-fluid alignCenter" style="margin: 10px 0px 0px 20px;" >
    <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td width="30%">
                    <a href="javascript:void(0);" name="drefresh" data-url="{$WIDGET->getURL()}&content=data">
                        <button type="button" class="btn pull-left">
                            <i class="icon-refresh" hspace="2" border="0" align="absmiddle"></i>
                            &nbsp;
                            <strong>{vtranslate('LBL_REFRESH_FUNNEL', $MODULE_NAME)}</strong>
                        </button>
                    </a>
                </td>
                <td width="70%">
                    <b>{vtranslate('LBL_ASSIGNED_USER', $MODULE_NAME)}</b>
                    &nbsp;
                    <select class="widgetFilter" id="assigned_user_id" name="assigned_user_id" style="width:170px; margin-bottom:0px">
                        <option value="{$DEFAULT_ASSIGNED_USER_FILTER}" selected>{vtranslate('LBL_ALL')}</option>
                        <option value="{$CURRENTUSER->getId()}" >{vtranslate('LBL_MINE')}</option>
                        {assign var=ALL_ACTIVEUSER_LIST value=$CURRENTUSER->getAccessibleUsers()}
                        {if count($ALL_ACTIVEUSER_LIST) gt 1}
                            <optgroup label="{vtranslate('LBL_USERS')}">
                                {foreach key=OWNER_ID item=OWNER_NAME from=$ALL_ACTIVEUSER_LIST}
                                    {if $OWNER_ID neq {$CURRENTUSER->getId()}}
                                        <option value="{$OWNER_ID}">{$OWNER_NAME}</option>
                                    {/if}
                                {/foreach}
                            </optgroup>
                        {/if}
                        {assign var=ALL_ACTIVEGROUP_LIST value=$CURRENTUSER->getAccessibleGroups()}
                        {if !empty($ALL_ACTIVEGROUP_LIST)}
                            <optgroup label="{vtranslate('LBL_GROUPS')}">
                                {foreach key=OWNER_ID item=OWNER_NAME from=$ALL_ACTIVEGROUP_LIST}
                                    <option value="{$OWNER_ID}">{$OWNER_NAME}</option>
                                {/foreach}
                            </optgroup>
                        {/if}
                    </select>
                </td>
            </tr>
            <tr>
                <td class="refresh" colspan="4" style="position: absolute; margin-top: 300px; z-index: 1; text-align: center; width: 100%;">
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="dashboardWidgetContent">
    {include file="dashboards/SalesFunnelBigWidgetContents.tpl"|@vtemplate_path:$MODULE_NAME}
</div>
{/strip}