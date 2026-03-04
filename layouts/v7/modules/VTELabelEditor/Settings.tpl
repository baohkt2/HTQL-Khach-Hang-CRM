{*+***********************************************************************************
* The contents of this file are subject to the vtiger CRM Public License Version 1.0
* ("License"); You may not use this file except in compliance with the License
* The Original Code is: vtiger CRM Open Source
* The Initial Developer of the Original Code is vtiger.
* Portions created by vtiger are Copyright (C) vtiger.
* All Rights Reserved.
*************************************************************************************}
{strip}
    {*SLA Policy Details*}
    <style>
        .label-editor-info{
            border: 1px solid rgb(217, 217, 217);
            border-left: #52a9cd solid 4px;
            max-height: 245px;
            height: 245px;
        }

        .label-editor-info > .label-info{
            color: #52a9cd;
            background-color: white !important;
        }

        .label-editor-info > .content-info{
            resize: none;
            border: none;
            width: 100%;
            color: #9b9997;
            max-height: 140px;
            height: 140px;
        }
    </style>
    <div class="editViewPageDiv">
        <div class="col-sm-12 col-xs-12" id="EditView">
            <div class="editViewHeader">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-lg-pull-0">
                        <h4>{vtranslate('MODULE_LBL',{$QUALIFIED_MODULE})}</h4>
                    </div>
                    <div class="col-lg-6 col-md-6 col-lg-pull-0">
                        <button id="restore_from_backup" class="pull-right btn btn-default">{vtranslate('Restore from Backup',{$QUALIFIED_MODULE})}</button>
                    </div>
                </div>
            </div>
            <hr style="margin-top: 0px !important;">
            <div class="editViewBody">
                <div class="editViewContents">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <div class="row">
                                <div class="col-sm-7 col-xs-7 form-horizontal">
                                    <div class="form-group">
                                        <label for="module_lang" class="col-sm-4">
                                            <span>{vtranslate('Select Language',{$QUALIFIED_MODULE})}</span>
                                        </label>
                                        <div class="setting-field col-sm-8">
                                            <select class="inputElement select2" id="module_lang" name="module_lang">
                                                {foreach key=KEY item=LANGUAGE_LABEL from=$LANGUAGES}
                                                    <option value="{$KEY}" {if $CURRENT_LANGUAGE == $KEY}selected{/if}>{$LANGUAGE_LABEL}</option>
                                                {/foreach}
                                            </select>
                                            <div style="margin-top: 10px;" id="lang_dir">{$CURRENT_LANGUAGE_DIR}&nbsp;&nbsp;&nbsp;&nbsp;<b style="color: {if $CURRENT_LANGUAGE_DIR_PERMISSIONS == 'OK'}green{else}red{/if}">(Permissions - {$CURRENT_LANGUAGE_DIR_PERMISSIONS})</b></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="lang_files" class="col-sm-4">
                                            <span>{vtranslate('Select Module/File',{$QUALIFIED_MODULE})}</span>
                                        </label>
                                        <div class="setting-field col-sm-8">
                                            <select class="inputElement select2" id="lang_files" name="lang_files">
                                                <option value="">{vtranslate('LBL_SELECT_OPTION',{$QUALIFIED_MODULE})}</option>
                                                {foreach key=KEY item=FILE_NAME from=$MODULES_FILES_LIST}
                                                    <option value="{$FILE_NAME}">{$FILE_NAME}</option>
                                                {/foreach}
                                            </select>
                                            <div style="margin-top: 10px;" id="file_info"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="module_lang" class="col-sm-4">
                                            <span>{vtranslate('Search',{$QUALIFIED_MODULE})}</span>
                                        </label>
                                        <div class="setting-field col-sm-8">
                                            <div class="row">
                                                <div class="setting-field col-sm-10">
                                                    <input type="text" class="inputElement" name="search_lang_value" id="search_lang_value" required/>
                                                </div>
                                                <div class="setting-field col-sm-2">
                                                    <button class="btn btn-default" id="search_lang"><i class="fa fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5 col-xs-5 label-editor-info">
                                    <div class="label-info">
                                        <h5>
                                            <span class="glyphicon glyphicon-info-sign"></span> Info
                                        </h5>
                                    </div>
                                    <span>{vtranslate('LBL_INFO_DESCRIPTION',{$QUALIFIED_MODULE})}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="editViewHeader">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-lg-pull-0">
                        <h4>{vtranslate('Available Labels',{$QUALIFIED_MODULE})}</h4>
                    </div>
                </div>
            </div>
            <hr style="margin-top: 0px !important;">
            <div id="fields_result" style="margin-bottom: 15px;">

            </div>
        </div>
    </div>
{/strip}