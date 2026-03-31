{*<!--
/*********************************************************************************
** The contents of this file are subject to the vtiger CRM Public License Version 1.0
* ("License"); You may not use this file except in compliance with the License
* The Original Code is:  vtiger CRM Open Source
* The Initial Developer of the Original Code is vtiger.
* Portions created by vtiger are Copyright (C) vtiger.
* All Rights Reserved.
*
********************************************************************************/
-->*}
{strip}
<div id="toggleButton" class="toggleButton" title="{vtranslate('LBL_LEFT_PANEL_SHOW_HIDE', 'Vtiger')}">
	<i id="tButtonImage" class="{if $LEFTPANELHIDE neq '1'}icon-chevron-right {else} icon-chevron-left{/if}"></i>
</div>&nbsp
    <div style="padding-left: 15px;">
        <form id="exportForm" class="form-horizontal row-fluid" method="post" action="index.php">
            <input type="hidden" name="module" value="{$MODULE}" />
            <input type="hidden" name="source_module" value="{$SOURCE_MODULE}" />
            <input type="hidden" name="action" value="ExportData" />
            <input type="hidden" name="viewname" value="{$VIEWID}" />
            <input type="hidden" name="selected_ids" value={ZEND_JSON::encode($SELECTED_IDS)}>
            <input type="hidden" name="excluded_ids" value={ZEND_JSON::encode($EXCLUDED_IDS)}>
            <input type="hidden" id="page" name="page" value="{$PAGE}" />
            <input type="hidden" name="search_key" value= "{$SEARCH_KEY}" />
            <input type="hidden" name="operator" value="{$OPERATOR}" />
            <input type="hidden" name="search_value" value="{$ALPHABET_VALUE}" />
            <input type="hidden" name="search_params" value='{ZEND_JSON::encode($SEARCH_PARAMS)}' />
            <input type="hidden" id="exportProgressPreparingLabel" value="{vtranslate('JS_EXPORT_PROGRESS_PREPARING', $MODULE)}" />
            <input type="hidden" id="exportProgressCompletedLabel" value="{vtranslate('JS_EXPORT_PROGRESS_COMPLETED', $MODULE)}" />
            
            <div class="row-fluid">
                <div class="span">&nbsp;</div>
                <div class="span8">
                    <h4>{vtranslate('LBL_EXPORT_RECORDS',$MODULE)}</h4>
                    <div class="well exportContents marginLeftZero">
                        <div class="row-fluid" style="height:30px">
                            <div class="span6 textAlignRight row-fluid">
                                <div class="span8"><strong>{vtranslate('LBL_EXPORT_FIELDS', 'Vtiger')}</strong>&nbsp;</div>
                            </div>
                        </div>
                        <div class="row-fluid" style="height:30px">
                            <div class="span6 textAlignRight row-fluid">
                                <div class="span8">{vtranslate('LBL_EXPORT_FIELDS_BASED_ON_LIST', 'Vtiger')}&nbsp;</div>
                                <div class="span3"><input type="radio" name="export_fields_mode" value="list" checked="checked" /></div>
                            </div>
                        </div>
                        <div class="row-fluid" style="height:30px">
                            <div class="span6 textAlignRight row-fluid">
                                <div class="span8">{vtranslate('LBL_EXPORT_FIELDS_ALL_COLUMNS', 'Vtiger')}&nbsp;</div>
                                <div class="span3"><input type="radio" name="export_fields_mode" value="all" /></div>
                            </div>
                        </div>
                        <div class="row-fluid" style="height:30px">
                            <div class="span6 textAlignRight row-fluid">
                                <div class="span8">{vtranslate('LBL_EXPORT_ROW_NUMBER', 'Vtiger')}&nbsp;</div>
                                <div class="span3"><input type="checkbox" name="export_row_number" value="1" /></div>
                            </div>
                        </div>
                        <br>
                        <div class="row-fluid">
                            <div class="row-fluid" style="height:30px">
                                <div class="span6 textAlignRight row-fluid">
                                    <div class="span8">{vtranslate('LBL_EXPORT_SELECTED_RECORDS',$MODULE)}&nbsp;</div>
                                    <div class="span3"><input type="radio" name="mode" value="ExportSelectedRecords" {if !empty($SELECTED_IDS)} checked="checked" {else} disabled="disabled"{/if}/></div>
                                </div>
                            {if empty($SELECTED_IDS)}&nbsp; <span class="redColor">{vtranslate('LBL_NO_RECORD_SELECTED',$MODULE)}</span>{/if}
                        </div>
                        <div class="row-fluid" style="height:30px">
                            <div class="span6 textAlignRight row-fluid">
                                <div class="span8">{vtranslate('LBL_EXPORT_DATA_IN_CURRENT_PAGE',$MODULE)}&nbsp;</div>
                                <div class="span3"><input type="radio" name="mode" value="ExportCurrentPage" /></div>
                            </div>
                        </div>
                        <div class="row-fluid" style="height:30px">
                            <div class="span6 textAlignRight row-fluid">
                                <div class="span8">{vtranslate('LBL_EXPORT_ALL_DATA',$MODULE)}&nbsp;</div>
                                <div class="span3"><input type="radio"  name="mode" value="ExportAllData"  {if empty($SELECTED_IDS)} checked="checked" {/if} /></div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="textAlignCenter">
                        <button class="btn btn-success" type="submit"><strong>{vtranslate($MODULE, $MODULE)}&nbsp;{vtranslate($SOURCE_MODULE, $MODULE)}</strong></button>
                        <a class="cancelLink" type="reset" onclick='window.history.back()'>{vtranslate('LBL_CANCEL', $MODULE)}</a>
                        <div class="js-export-progress-widget hide" style="margin-top:12px;">
                            <div class="progress" style="margin-bottom:8px;">
                                <div class="bar js-export-progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="width:0%;">0%</div>
                            </div>
                            <div class="js-export-progress-label muted" style="font-size:12px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
{literal}
<script type="text/javascript">
jQuery(function() {
    var exportForm = jQuery('#exportForm');
    if(!exportForm.length) {
        return;
    }

    var preparingLabel = jQuery.trim(exportForm.find('#exportProgressPreparingLabel').val()) || app.vtranslate('JS_EXPORT_PROGRESS_PREPARING');
    var completedLabel = jQuery.trim(exportForm.find('#exportProgressCompletedLabel').val()) || app.vtranslate('JS_EXPORT_PROGRESS_COMPLETED');

    var updateProgress = function(widget, progress, label) {
        var percentage = parseInt(progress, 10);
        if(isNaN(percentage)) {
            percentage = 0;
        }
        percentage = Math.max(0, Math.min(100, percentage));

        widget.find('.js-export-progress-bar')
            .css('width', percentage + '%')
            .attr('aria-valuenow', percentage)
            .text(percentage + '%');
        widget.find('.js-export-progress-label').text(label || '');
    };

    exportForm.off('submit.exportTracking').on('submit.exportTracking', function(event) {
        if(exportForm.data('exportTrackingInProgress')) {
            event.preventDefault();
            return false;
        }

        event.preventDefault();
        var widget = exportForm.find('.js-export-progress-widget');
        var submitButton = exportForm.find('button[type="submit"]');
        var cancelLink = exportForm.find('.cancelLink');
        var frameName = 'exportDownloadFrame_' + new Date().getTime();
        var frame = jQuery('<iframe />', {
            name: frameName,
            style: 'display:none;'
        });
        var progressValue = 3;
        var completed = false;
        var exportToken = 'exp_' + new Date().getTime() + '_' + Math.floor(Math.random() * 1000000);
        var cookieName = 'cusc_export_done_' + exportToken;

        var tokenInput = exportForm.find('input[name="export_tracking_token"]');
        if(!tokenInput.length) {
            tokenInput = jQuery('<input type="hidden" name="export_tracking_token" />');
            exportForm.append(tokenInput);
        }
        tokenInput.val(exportToken);

        document.cookie = cookieName + '=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/';

        var cleanup = function() {
            window.clearInterval(progressInterval);
            window.clearInterval(cookiePollInterval);
            window.clearTimeout(progressTimeout);
            window.setTimeout(function() {
                exportForm.removeData('exportTrackingInProgress');
                exportForm.removeAttr('target');
                submitButton.removeAttr('disabled');
                cancelLink.removeClass('hide');
                widget.addClass('hide');
                frame.remove();
                document.cookie = cookieName + '=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/';
            }, 650);
        };

        exportForm.data('exportTrackingInProgress', true);
        submitButton.attr('disabled', 'disabled');
        cancelLink.addClass('hide');
        widget.removeClass('hide');
        updateProgress(widget, progressValue, preparingLabel);

        exportForm.attr('target', frameName);
        jQuery('body').append(frame);

        var progressInterval = window.setInterval(function() {
            if(completed) {
                return;
            }

            progressValue = Math.min(92, progressValue + Math.max(1, Math.floor((92 - progressValue) / 6)));
            updateProgress(widget, progressValue, preparingLabel);
        }, 350);

        var progressTimeout = window.setTimeout(function() {
            if(completed) {
                return;
            }

            completed = true;
            updateProgress(widget, 100, completedLabel);
            cleanup();
        }, 120000);

        var cookiePollInterval = window.setInterval(function() {
            if(completed) {
                return;
            }

            if(document.cookie.indexOf(cookieName + '=1') !== -1) {
                completed = true;
                updateProgress(widget, 100, completedLabel);
                cleanup();
            }
        }, 250);

        frame.one('load', function() {
            if(completed) {
                return;
            }

            completed = true;
            updateProgress(widget, 100, completedLabel);
            cleanup();
        });

        exportForm[0].submit();
        return false;
    });
});
</script>
{/literal}
{/strip}
