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
    <div class="col-sm-12 col-xs-12 ">
        {assign var=LEFTPANELHIDE value=$CURRENT_USER_MODEL->get('leftpanelhide')}
        <div class="essentials-toggle" title="{vtranslate('LBL_LEFT_PANEL_SHOW_HIDE', 'Vtiger')}">
            <span class="essentials-toggle-marker fa {if $LEFTPANELHIDE eq '1'}fa-chevron-right{else}fa-chevron-left{/if} cursorPointer"></span>
        </div>
        <style>
            {foreach from=$PROJECTS['tasks'] item=PROJECT key=INTKEY}
            {ITS4YouProjectsChart_Record_Model::getGanttNumberCss($PROJECT.project_no, $PROJECT.color)}
            {ITS4YouProjectsChart_Record_Model::getGanttSvgNumberCss($PROJECT.project_no, $PROJECT.color)}
            {/foreach}
        </style>
        <div class="datacontent">
            {include file="Datacontent.tpl"|vtemplate_path:$MODULE}
        </div>
    </div>
{/strip}