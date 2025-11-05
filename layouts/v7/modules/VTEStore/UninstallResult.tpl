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
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="{if $ERROR!='yes'}{literal}app.helper.showSuccessNotification({message: app.vtranslate('JS_PLEASE_WAIT')});location.reload();{/literal}{/if}">
                <span aria-hidden="true" class='fa fa-close'></span>
            </button>
            <h4 style="color: white;">{$EXTENSION_NAME}</h4>
        </div>
        <div class="modal-body" id="installationLog">
            <div class="row-fluid" {if $ERROR=='yes'}style="color:red;"{/if}><span class="font-x-x-large">{$MESSAGE}</span></div>
        </div>
        <div class="modal-footer">
            <span class="pull-right">
                <button class="btn btn-success" id="importCompleted" onclick="app.hideModalWindow();{if $ERROR!='yes'}{literal}app.helper.showSuccessNotification({message: app.vtranslate('JS_PLEASE_WAIT')});location.reload();{/literal}{/if}">{vtranslate('LBL_OK', 'VTEStore')}</button>
            </span>
        </div>
    </div>
</div>
{/strip}