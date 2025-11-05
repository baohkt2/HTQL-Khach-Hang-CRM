{*<!--
* 
* Copyright (C) www.vtiger.com. All rights reserved.
* @license Proprietary
*
-->*}
{strip}
<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header contentsBackground">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <span aria-hidden="true" class='fa fa-close'></span>
            </button>
            <h4 style="color:white;">{vtranslate('LBL_REGENERATE_LICENSE', 'VTEStore')}</h4>
        </div>
            <div class="modal-body" id="installationLog">
                <div class="row-fluid">
                    <span class="font-x-x-large">{$MESSAGE}</span><br><br>
                </div>
            </div>
        <div class="modal-footer">
            <span class="pull-right">
                <button class="btn btn-success" id="importCompleted" onclick="app.hideModalWindow();">{vtranslate('LBL_OK', 'VTEStore')}</button>
            </span>
        </div>
    </div>
</div>
{/strip}