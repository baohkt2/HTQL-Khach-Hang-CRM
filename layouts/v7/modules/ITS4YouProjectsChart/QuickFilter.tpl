{*<!--
/*+***********************************************************************************
 * The content of this file is subject to the ITS4YouProjectsChart license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
*************************************************************************************/
-->*}
{strip}
    <div class="quickFilter">
        <span>{vtranslate('LBL_QUICK_FILTERS', $MODULE)}:</span>
        <select name="assignedUserFilter" multiple class="select2" id="assignedUserFilter" style="width: 70%; max-width: 400px; min-width: 300px">
            <optgroup label="{vtranslate('LBL_USERS')}">
                {foreach item=VALUE from=$SOURCE_ASSIGNED_USERS['users']}
                    <option value="{$VALUE}">{$VALUE}</option>
                {/foreach}
            </optgroup>
            <optgroup label="{vtranslate('LBL_GROUPS')}">
                {foreach item=VALUE from=$SOURCE_ASSIGNED_USERS['groups']}
                    <option value="{$VALUE}">{$VALUE}</option>
                {/foreach}
            </optgroup>
        </select>
        &nbsp;
        <select name="statusFilter" multiple class="select2" id="statusFilter" style="width: 70%; max-width: 400px; min-width: 300px">
            {foreach item=VALUE from=$SOURCE_STATUS}
                <option value="{$VALUE}">{vtranslate($VALUE, $PROJECT_MODULE)}</option>
            {/foreach}
        </select>
        <div class="pull-right" style="margin-right: 5px;">
                <span style="margin: 2px;">
                    <button class="btn textual zoomOut" title="zoom out">
                        <span class="teamworkIcon">)</span>
                    </button>
                </span>
            <span style="margin: 2px;">
                    <button class="btn textual zoomIn" title="zoom in">
                        <span class="teamworkIcon">(</span>
                    </button>
                </span>
            <span style="margin: 2px;">
                    <a href="index.php?module={$MODULE}&view=ExportChart&record={$PARENT_ID}" target="_blank" class="btn reportActions btn-default">
                        {vtranslate('LBL_REPORT_PRINT', 'Reports')}
                    </a>
                </span>
        </div>
    </div>
{/strip}