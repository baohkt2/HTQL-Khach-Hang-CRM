{*+**********************************************************************************
* The contents of this file are subject to the vtiger CRM Public License Version 1.1
* ("License"); You may not use this file except in compliance with the License
* The Original Code is: vtiger CRM Open Source
* The Initial Developer of the Original Code is vtiger.
* Portions created by vtiger are Copyright (C) vtiger.
* All Rights Reserved.
************************************************************************************}
{strip}
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" id="backupExportForm" name="backupExportForm" method="post" action="index.php">
                <input type="hidden" name="module" value="Vtiger" />
                <input type="hidden" name="action" value="BackupExport" />
                <input type="hidden" name="mode" value="start" />
                <input type="hidden" name="source_module" value="{$SOURCE_MODULE}" />

                {assign var=HEADER_TITLE value={vtranslate('LBL_BACKUP_EXPORT_TITLE', 'Vtiger')|cat:' - '|cat:$SOURCE_MODULE_LABEL}}
                {include file="ModalHeader.tpl"|vtemplate_path:'Vtiger' TITLE=$HEADER_TITLE}

                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-lg-4 control-label">{vtranslate('LBL_BACKUP_EXPORT_FILTER_TYPE', 'Vtiger')}</label>
                        <div class="col-lg-7" style="padding-top: 6px;">
                            <label style="display:block; font-weight: normal; margin-bottom: 6px;">
                                <input type="radio" name="filter_type" value="all" checked />
                                {vtranslate('LBL_BACKUP_EXPORT_FILTER_ALL', 'Vtiger')}
                            </label>
                            <label style="display:block; font-weight: normal;">
                                <input type="radio" name="filter_type" value="created_time_range" />
                                {vtranslate('LBL_BACKUP_EXPORT_FILTER_CREATED_TIME', 'Vtiger')}
                            </label>
                        </div>
                    </div>

                    <div class="js-backup-date-range hide">
                        <div class="form-group">
                            <label class="col-lg-4 control-label" for="backup_from_date">{vtranslate('LBL_BACKUP_EXPORT_FROM_DATE', 'Vtiger')}</label>
                            <div class="col-lg-7">
                                <input id="backup_from_date" type="date" name="from_date" class="inputElement form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label" for="backup_to_date">{vtranslate('LBL_BACKUP_EXPORT_TO_DATE', 'Vtiger')}</label>
                            <div class="col-lg-7">
                                <input id="backup_to_date" type="date" name="to_date" class="inputElement form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info" style="margin-bottom: 0;">
                        {vtranslate('LBL_BACKUP_EXPORT_WAIT_MESSAGE', 'Vtiger')}
                    </div>
                </div>

                {assign var=BUTTON_NAME value={vtranslate('LBL_BACKUP_EXPORT_ACTION', 'Vtiger')}}
                {include file='ModalFooter.tpl'|@vtemplate_path:'Vtiger' BUTTON_NAME=$BUTTON_NAME}
            </form>
        </div>
    </div>
{/strip}
