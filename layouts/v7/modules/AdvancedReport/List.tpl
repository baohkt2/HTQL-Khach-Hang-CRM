{strip}
{* AdvancedReport - Main List/Builder Template *}
<div class="container-fluid" id="advancedReportContainer">
    <div class="row">
        <div class="col-lg-12">
            <h3>
                <i class="fa fa-bar-chart"></i> {vtranslate('LBL_ADVANCED_REPORT', $MODULE_NAME)}
                <small class="text-muted"> - {vtranslate('LBL_DYNAMIC_REPORT_BUILDER', $MODULE_NAME)}</small>
            </h3>
            <hr/>
        </div>
    </div>

    {* ── Report Type Selection ── *}
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <i class="fa fa-cog"></i> {vtranslate('LBL_REPORT_CONFIG', $MODULE_NAME)}
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{vtranslate('LBL_REPORT_TYPE', $MODULE_NAME)}</label>
                                <select id="reportType" class="form-control select2">
                                    <option value="">{vtranslate('LBL_SELECT_REPORT_TYPE', $MODULE_NAME)}</option>
                                    <optgroup label="{vtranslate('LBL_CAMPAIGN_REPORTS', $MODULE_NAME)}">
                                        <option value="campaign_contact_stats">{vtranslate('LBL_CAMPAIGN_CONTACT_STATS', $MODULE_NAME)}</option>
                                        <option value="campaign_account_breakdown">{vtranslate('LBL_CAMPAIGN_ACCOUNT_BREAKDOWN', $MODULE_NAME)}</option>
                                        <option value="campaign_followup_stats">{vtranslate('LBL_CAMPAIGN_FOLLOWUP_STATS', $MODULE_NAME)}</option>
                                    </optgroup>
                                    <optgroup label="{vtranslate('LBL_EXPORT_REPORTS', $MODULE_NAME)}">
                                        <option value="organization_group_export">{vtranslate('LBL_ORGANIZATION_GROUP_EXPORT', $MODULE_NAME)}</option>
                                    </optgroup>
                                    <optgroup label="{vtranslate('LBL_CUSTOM', $MODULE_NAME)}">
                                        <option value="custom">{vtranslate('LBL_CUSTOM_QUERY', $MODULE_NAME)}</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4" id="campaignFilterGroup" style="display:none">
                            <div class="form-group">
                                <label>{vtranslate('LBL_CAMPAIGN', $MODULE_NAME)}</label>
                                <select id="campaignFilter" class="form-control select2" multiple>
                                    {foreach from=$CAMPAIGNS item=campaign}
                                    <option value="{$campaign.campaignid}">{$campaign.campaignname|escape:'html'} ({$campaign.campaignstatus|escape:'html'})</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2" id="dateFilterGroup" style="display:none">
                            <div class="form-group">
                                <label>{vtranslate('LBL_DATE_FROM', $MODULE_NAME)}</label>
                                <input type="date" id="dateFrom" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-2" id="dateToGroup" style="display:none">
                            <div class="form-group">
                                <label>{vtranslate('LBL_DATE_TO', $MODULE_NAME)}</label>
                                <input type="date" id="dateTo" class="form-control" />
                            </div>
                        </div>
                    </div>

                    {* Follow-up specific *}
                    <div class="row" id="followupOptions" style="display:none">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{vtranslate('LBL_MAX_FOLLOWUP', $MODULE_NAME)}</label>
                                <select id="maxFollowup" class="form-control">
                                    <option value="3">3</option>
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{vtranslate('LBL_ACTIVITY_TYPES', $MODULE_NAME)}</label>
                                <select id="activityTypes" class="form-control select2" multiple>
                                    <option value="Call" selected>Call</option>
                                    <option value="Emails" selected>Email</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {* Custom query builder (JSON) *}
                    <div class="row" id="customQueryGroup" style="display:none">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{vtranslate('LBL_QUERY_CONFIG_JSON', $MODULE_NAME)}</label>
                                <textarea id="customQueryConfig" class="form-control" rows="8" placeholder='{"literal_json": "example"}'></textarea>
                                <p class="help-block">{vtranslate('LBL_QUERY_CONFIG_HELP', $MODULE_NAME)}</p>
                            </div>
                        </div>
                    </div>

                    {* Action buttons *}
                    <div class="row">
                        <div class="col-md-12">
                            <button id="btnGenerateReport" class="btn btn-primary" disabled>
                                <i class="fa fa-play"></i> {vtranslate('LBL_GENERATE', $MODULE_NAME)}
                            </button>
                            <button id="btnExportExcel" class="btn btn-success" disabled>
                                <i class="fa fa-file-excel-o"></i> {vtranslate('LBL_EXPORT_EXCEL', $MODULE_NAME)}
                            </button>
                            <button id="btnSaveConfig" class="btn btn-info" disabled>
                                <i class="fa fa-save"></i> {vtranslate('LBL_SAVE_CONFIG', $MODULE_NAME)}
                            </button>
                            <span id="reportLoading" class="hide">
                                <i class="fa fa-spinner fa-spin"></i> {vtranslate('LBL_LOADING', $MODULE_NAME)}...
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {* ── Export Options ── *}
    <div class="row" id="exportOptionsPanel" style="display:none">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <i class="fa fa-file-excel-o"></i> {vtranslate('LBL_EXPORT_OPTIONS', $MODULE_NAME)}
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{vtranslate('LBL_EXPORT_TITLE', $MODULE_NAME)}</label>
                                <input type="text" id="exportTitle" class="form-control" placeholder="{vtranslate('LBL_EXPORT_TITLE_PLACEHOLDER', $MODULE_NAME)}" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{vtranslate('LBL_EXPORT_SUBTITLE', $MODULE_NAME)}</label>
                                <input type="text" id="exportSubtitle" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>{vtranslate('LBL_FORMAT', $MODULE_NAME)}</label>
                                <select id="exportFormat" class="form-control">
                                    <option value="xlsx">Excel 2007+ (XLSX)</option>
                                    <option value="xls">Excel 97-2003 (XLS)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>{vtranslate('LBL_FILENAME', $MODULE_NAME)}</label>
                                <input type="text" id="exportFilename" class="form-control" placeholder="BaoCao" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{vtranslate('LBL_GROUP_FIELD', $MODULE_NAME)}</label>
                                <select id="exportGroupField" class="form-control">
                                    <option value="">{vtranslate('LBL_NONE', $MODULE_NAME)}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="exportShowSummary" checked /> {vtranslate('LBL_SHOW_SUMMARY', $MODULE_NAME)}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {* ── Report Preview ── *}
    <div class="row" id="reportPreviewPanel" style="display:none">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <i class="fa fa-table"></i> {vtranslate('LBL_PREVIEW', $MODULE_NAME)}
                        <span id="previewRowCount" class="badge pull-right"></span>
                    </h4>
                </div>
                <div class="panel-body" style="overflow-x: auto;">
                    <table class="table table-bordered table-striped table-condensed" id="reportPreviewTable">
                        <thead id="reportPreviewHead"></thead>
                        <tbody id="reportPreviewBody"></tbody>
                        <tfoot id="reportPreviewFoot"></tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {* ── Saved Configs ── *}
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <i class="fa fa-bookmark"></i> {vtranslate('LBL_SAVED_REPORTS', $MODULE_NAME)}
                    </h4>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{vtranslate('LBL_NAME', $MODULE_NAME)}</th>
                                <th>{vtranslate('LBL_DESCRIPTION', $MODULE_NAME)}</th>
                                <th>{vtranslate('LBL_TYPE', $MODULE_NAME)}</th>
                                <th>{vtranslate('LBL_MODIFIED', $MODULE_NAME)}</th>
                                <th>{vtranslate('LBL_ACTIONS', $MODULE_NAME)}</th>
                            </tr>
                        </thead>
                        <tbody id="savedConfigsList">
                            {foreach from=$SAVED_CONFIGS item=config name=configLoop}
                            <tr data-config-id="{$config.id}">
                                <td>{$smarty.foreach.configLoop.iteration}</td>
                                <td>{$config.name|escape:'html'}</td>
                                <td>{$config.description|escape:'html'}</td>
                                <td><span class="label label-info">{$config.report_type|escape:'html'}</span></td>
                                <td>{$config.modified_time}</td>
                                <td>
                                    <button class="btn btn-xs btn-primary btnLoadConfig" data-id="{$config.id}" title="{vtranslate('LBL_LOAD', $MODULE_NAME)}">
                                        <i class="fa fa-folder-open"></i>
                                    </button>
                                    <button class="btn btn-xs btn-success btnRunSavedConfig" data-id="{$config.id}" title="{vtranslate('LBL_RUN', $MODULE_NAME)}">
                                        <i class="fa fa-play"></i>
                                    </button>
                                    <button class="btn btn-xs btn-danger btnDeleteConfig" data-id="{$config.id}" title="{vtranslate('LBL_DELETE', $MODULE_NAME)}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            {foreachelse}
                            <tr>
                                <td colspan="6" class="text-center text-muted">{vtranslate('LBL_NO_SAVED_REPORTS', $MODULE_NAME)}</td>
                            </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{* ── Save Config Modal ── *}
<div class="modal fade" id="saveConfigModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{vtranslate('LBL_SAVE_REPORT_CONFIG', $MODULE_NAME)}</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>{vtranslate('LBL_NAME', $MODULE_NAME)} *</label>
                    <input type="text" id="saveConfigName" class="form-control" required />
                </div>
                <div class="form-group">
                    <label>{vtranslate('LBL_DESCRIPTION', $MODULE_NAME)}</label>
                    <textarea id="saveConfigDescription" class="form-control" rows="3"></textarea>
                </div>
                <input type="hidden" id="saveConfigId" value="" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{vtranslate('LBL_CANCEL', $MODULE_NAME)}</button>
                <button type="button" class="btn btn-primary" id="btnDoSaveConfig">{vtranslate('LBL_SAVE', $MODULE_NAME)}</button>
            </div>
        </div>
    </div>
</div>
{/strip}
