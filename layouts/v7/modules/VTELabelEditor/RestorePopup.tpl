{*+***********************************************************************************
* The contents of this file are subject to the vtiger CRM Public License Version 1.0
* ("License"); You may not use this file except in compliance with the License
* The Original Code is: vtiger CRM Open Source
* The Initial Developer of the Original Code is vtiger.
* Portions created by vtiger are Copyright (C) vtiger.
* All Rights Reserved.
*************************************************************************************}
{strip}
    <div class="modal-dialog modal-lg" style="width: 600px;">
        <div class="modal-content">
            <div class="modal-header">
                <div class="clearfix">
                    <div class="pull-right " >
                        <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                            <span aria-hidden="true" class='fa fa-close'></span>
                        </button>
                    </div>
                    <h4 class="pull-left">
                        Restore from Backup
                    </h4>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-xs-12 form-horizontal">
                        <div class="form-group">
                            <label for="module_lang" class="col-sm-4">
                                <span>{vtranslate('Select Language',{$QUALIFIED_MODULE})}</span>
                            </label>
                            <div class="setting-field col-sm-8">
                                <select class="inputElement select2" id="backup_module_lang" name="backup_module_lang">
                                    <option value="">{vtranslate('LBL_SELECT_OPTION',{$QUALIFIED_MODULE})}</option>
                                    {foreach key=KEY item=LANGUAGE_LABEL from=$LANGUAGES}
                                        <option value="{$KEY}" >{$LANGUAGE_LABEL}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lang_files" class="col-sm-4">
                                <span>{vtranslate('Select Module/File',{$QUALIFIED_MODULE})}</span>
                            </label>
                            <div class="setting-field col-sm-8">
                                <select class="inputElement select2" id="backup_lang_files" name="backup_lang_files">
                                    <option value="">{vtranslate('LBL_SELECT_OPTION',{$QUALIFIED_MODULE})}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="submit_restore">Restore</button>
            </div>
        </div>
    </div>
{/strip}