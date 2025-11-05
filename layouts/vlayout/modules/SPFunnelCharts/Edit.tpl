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
    <div id="spWidgetReport" class="reportContents">
        <form class="form-horizontal recordEditView" method="post" action="index.php">
            <input type="hidden" name="module" value="{$MODULE}" />
            <input type="hidden" name="action" value="Save" >
            <input type="hidden" name="isDuplicate" value="{$IS_DUPLICATE}" />
            <input type="hidden" name="record" value="{$RECORD_ID}" />
            <div class="well contentsBackground">
                <div class="row-fluid padding1per">
                    <span class="span3">{vtranslate('LBL_FUNNEL_NAME', $MODULE)}<span class="redColor">*</span></span>
                    <span class="span7">
                        <input class="span6" data-validation-engine='validate[required]' type="text" name="name" value="{$MODEL->get('name')}"/>
                    </span>
                </div>
                <div class="row-fluid padding1per">
                    <span class="span3">{vtranslate('LBL_FUNNEL_REPORTS', $MODULE)}<span class="redColor">*</span></span>
                    {assign var=SELECTED_REPORT_IDS value=array()}
                    <select data-placeholder="{vtranslate('LBL_SELECT_REPORTS', $MODULE)}" id="reportsListSelectElement" class="select2 span4" multiple="" data-validation-engine="validate[required]">
                        {foreach key=REPORT_SEQUENCE item=DETAIL_REPORT_MODEL from=$SELECTED_REPORTS}
                            {array_push($SELECTED_REPORT_IDS, $DETAIL_REPORT_MODEL->getId())}
                        {/foreach}

                        {foreach item=DETAIL_REPORT_MODEL from=$ALL_REPORTS}
                            {assign var=CURRENT_REPORT_ID value=$DETAIL_REPORT_MODEL->getId()}
                            <option value="{$CURRENT_REPORT_ID}" {if in_array($CURRENT_REPORT_ID, $SELECTED_REPORT_IDS)} selected {/if}>
                            {vtranslate($DETAIL_REPORT_MODEL->getName(), $MODULE)}
                            </option>
                        {/foreach}
                    </select>
                </div>
                <div class="row-fluid padding1per">
                    <span class="span3">{vtranslate('LBL_DESCRIPTION', $MODULE)}</span>
                    <span class="span7">
                        <textarea class="span6" type="text" name="description">{$MODEL->get('description')}</textarea>
                    </span>
                </div>
            </div>
            <div class="pull-right">
                <button id="saveSpWidgetReport" class="btn btn-success"><strong>{vtranslate('LBL_SAVE', $MODULE)}</strong></button>
                <button class="btn btn-danger" onclick="window.history.back();">{vtranslate('LBL_CANCEL', $MODULE)}</button>
            </div>
            
            <input type="hidden" name="report_ids" value='' />
            <input type="hidden" name="topReportsIdsList" value='{ZEND_JSON::encode($SELECTED_REPORT_IDS)}' />
            <input type="hidden" id="reportsPlotDependencies" name="reportsPlotDependencies" value='{ZEND_JSON::encode($REPORTS_PLOT_DEPENDENCIES)}' />
        </form>
    </div>
{/strip}