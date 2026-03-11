{*+**********************************************************************************
* The contents of this file are subject to the vtiger CRM Public License Version 1.1
* ("License"); You may not use this file except in compliance with the License
* The Original Code is:  vtiger CRM Open Source
* The Initial Developer of the Original Code is vtiger.
* Portions created by vtiger are Copyright (C) vtiger.
* All Rights Reserved.
************************************************************************************}
{* modules/Vtiger/views/Import.php *}

{* START YOUR IMPLEMENTATION FROM BELOW. Use {debug} for information *}

<div class='fc-overlay-modal modal-content'>
    <div class="overlayHeader">
        {assign var=TITLE value="{'LBL_IMPORT'|@vtranslate:$MODULE} {$FOR_MODULE|@vtranslate:$FOR_MODULE}"}
        {include file="ModalHeader.tpl"|vtemplate_path:$MODULE TITLE=$TITLE}
    </div>
    <div class="importview-content">
        <form action="index.php" enctype="multipart/form-data" method="POST" name="importAdvanced" id = "importAdvanced">
            <input type="hidden" name="module" value="{$FOR_MODULE}" />
            <input type="hidden" name="view" value="Import" />
            <input type="hidden" name="mode" value="import" />
            <input type="hidden" name="type" value="{$USER_INPUT->get('type')}" />
            <input type="hidden" name="has_header" value='{$HAS_HEADER}' />
            <input type="hidden" name="file_encoding" value='{$USER_INPUT->get('file_encoding')}' />
            <input type="hidden" name="delimiter" value='{$USER_INPUT->get('delimiter')}' />
                <div id="importJsTranslations" class="hide"
                    data-import-label="{Vtiger_Util_Helper::toSafeHTML(vtranslate('LBL_IMPORT', $MODULE))}"
                    data-running-label="{Vtiger_Util_Helper::toSafeHTML(vtranslate('LBL_RUNNING', $MODULE))}"
                    data-created-label="{Vtiger_Util_Helper::toSafeHTML(vtranslate('LBL_CREATED', $MODULE))}"
                    data-updated-label="{Vtiger_Util_Helper::toSafeHTML(vtranslate('LBL_UPDATED', $MODULE))}"
                    data-skipped-label="{Vtiger_Util_Helper::toSafeHTML(vtranslate('LBL_SKIPPED', $MODULE))}"
                    data-failed-label="{Vtiger_Util_Helper::toSafeHTML(vtranslate('LBL_FAILED', $MODULE))}"
                    data-cancel-import-label="{Vtiger_Util_Helper::toSafeHTML(vtranslate('LBL_CANCEL_IMPORT', $MODULE))}"
                    data-finish-label="{Vtiger_Util_Helper::toSafeHTML(vtranslate('LBL_FINISH_BUTTON_LABEL', $MODULE))}"
                    data-import-more-label="{Vtiger_Util_Helper::toSafeHTML(vtranslate('LBL_IMPORT_MORE', $MODULE))}"
                    data-import-success-label="{Vtiger_Util_Helper::toSafeHTML(vtranslate('LBL_IMPORT_SUCCESS', $MODULE))}"
                    data-auto-close-label="{Vtiger_Util_Helper::toSafeHTML(vtranslate('LBL_AUTO_CLOSE_IN', $MODULE))}"
                    data-error-label="{Vtiger_Util_Helper::toSafeHTML(vtranslate('LBL_ERROR', $MODULE))}"
                    data-records-label="{Vtiger_Util_Helper::toSafeHTML(vtranslate('records', $MODULE))}"
                    data-speed-label="{Vtiger_Util_Helper::toSafeHTML(vtranslate('Speed', $MODULE))}"
                    data-eta-label="{Vtiger_Util_Helper::toSafeHTML(vtranslate('ETA', $MODULE))}"
                    data-elapsed-label="{Vtiger_Util_Helper::toSafeHTML(vtranslate('Elapsed', $MODULE))}"
                    data-calculating-label="{Vtiger_Util_Helper::toSafeHTML(vtranslate('calculating', $MODULE))}"
                    data-almost-done-label="{Vtiger_Util_Helper::toSafeHTML(vtranslate('almost done', $MODULE))}"
                    data-completed-label="{Vtiger_Util_Helper::toSafeHTML(vtranslate('Completed', $MODULE))}"
                    data-cancelling-label="{Vtiger_Util_Helper::toSafeHTML(vtranslate('Cancelling', $MODULE))}"
                    data-import-completed-message="{Vtiger_Util_Helper::toSafeHTML(vtranslate('Import Completed.', $MODULE))}"
                    data-import-cancelled-message="{Vtiger_Util_Helper::toSafeHTML(vtranslate('Import Cancelled.', $MODULE))}"
                    data-import-id-not-ready-message="{Vtiger_Util_Helper::toSafeHTML(vtranslate('LBL_IMPORT_ID_NOT_READY', $MODULE))}"></div>

            <div class='modal-body'>
				{assign var=LABELS value=[]}
                {if isset($FORMAT) && $FORMAT eq 'vcf'}
                    {$LABELS["step1"] = 'LBL_UPLOAD_VCF'}
                {else if isset($FORMAT) && $FORMAT eq 'ics'}
					{$LABELS["step1"] = 'LBL_UPLOAD_ICS'}
				{else}
                    {$LABELS["step1"] = 'LBL_UPLOAD_CSV'}
                {/if}

                {if isset($DUPLICATE_HANDLING_NOT_SUPPORTED) eq 'true'}
                    {$LABELS["step3"] = 'LBL_FIELD_MAPPING'}
                {else}
                    {$LABELS["step2"] = 'LBL_DUPLICATE_HANDLING'}
                    {$LABELS["step3"] = 'LBL_FIELD_MAPPING'}
                {/if}
                {include file="BreadCrumbs.tpl"|vtemplate_path:$MODULE BREADCRUMB_ID='navigation_links'
                         ACTIVESTEP=3 BREADCRUMB_LABELS=$LABELS MODULE=$MODULE}
                <div class = "importBlockContainer">
                    <table class = "table table-borderless">
                        {if isset($ERROR_MESSAGE) && $ERROR_MESSAGE neq ''}
                            <tr>
                                <td align="left">
                                    {$ERROR_MESSAGE}
                                </td>
                            </tr>
                        {/if}
                        <tr>
                            <td>
                                {include file='ImportStepThree.tpl'|@vtemplate_path:'Import'}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class='modal-overlay-footer border1px clearfix'>
                <div class="row clearfix">
                        <div class='textAlignCenter col-lg-12 col-md-12 col-sm-12 '>
                        <button type="button" name="import" id="importButton" class="btn btn-success btn-lg" onclick="return Vtiger_Import_Js.sanitizeAndSubmit()"
                                >{'LBL_IMPORT_BUTTON_LABEL'|@vtranslate:$MODULE}</button>
                        &nbsp;&nbsp;&nbsp;<a class='cancelLink' data-dismiss="modal" href="#">{vtranslate('LBL_CANCEL', $MODULE)}</a></div>
                </div>
            </div>
        </form>
    </div>
</div>
