{*<!--
* 
* Copyright (C) www.vtiger.com. All rights reserved.
* @license Proprietary
*
-->*}
{strip}
<div class='modal-dialog modal-lg'>
    <div class="modal-content">
        <div class="modal-header contentsBackground">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="{if $ERROR=='0'}{literal}app.helper.showSuccessNotification({message: app.vtranslate('JS_PLEASE_WAIT')});location.reload();{/literal}{/if}">
                <span aria-hidden="true" class='fa fa-close'></span>
            </button>
            <h4 style="color:white;">{$EXTENSION_NAME}</h4>
        </div>
            <div class="modal-body" id="installationLog" style="padding-left: 100px;padding-right: 100px">
                <table style="width: 100%">
                    <tr><td style="text-align: center"><h4>{vtranslate('Integration Add-on', 'VTEStore')}</h4></td></tr>
                    <tr><td>{vtranslate('Integration Add-on description', 'VTEStore')}</td></tr>
                    <tr><td style="text-align: center;height: 40px"><a href="https://www.vtexperts.com/integration-addon-vtiger-extension-pack/" target="_blank" style="color: #428bca;"><u>{vtranslate('Integration Add-ons link', 'VTEStore')}</u></a></td></tr>
                    <tr><td>{vtranslate('Integration Add-ons click', 'VTEStore')}</td></tr>
                </table>
            </div>
        <div class="modal-footer">
            <span class="pull-right">
                {if $EXT_NAME=='VTEAuthnet'}
                    <button class="btn btn-success" id="InstallAddOn" onclick="InstallAuthNetAddOn();">{vtranslate('LBL_INSTALL', 'VTEStore')}</button>
                {elseif $EXT_NAME=='VTEQBO'}
                    <button class="btn btn-success" id="InstallAddOn" onclick="InstallVTEQBOAddOn();">{vtranslate('LBL_INSTALL', 'VTEStore')}</button>
                {/if}
                <a href="javascript:void();" class="cancelLink" id="importCompleted" onclick="app.hideModalWindow();{if $ERROR=='0' || $ERROR=='2'}{literal}app.helper.showSuccessNotification({message: app.vtranslate('JS_PLEASE_WAIT')});location.reload();{/literal}{/if}">{vtranslate('LBL_CANCEL', 'VTEStore')}</a>
            </span>
        </div>
    </div>
</div>
{/strip}
{literal}
<script>
    function InstallAuthNetAddOn() {
        var params = {};
        params['module'] = 'ANCustomers';
        params['action'] = 'Install';
        params['mode'] = 'DownloadAuthnetLib';
        params['parent'] = 'Settings';
        app.helper.showProgress();
        app.request.post({'data' : params}).then(
            function(err,data){
                if(err === null) {
//                    app.helper.showInfoMessage({'message': app.vtranslate('Success')});
                    app.helper.hideProgress();
                    app.helper.showAlertBox({message:'Updated module VTEAuthnet'});
                    setTimeout(function(){
                        window.location.reload();
                    }, 5000);

                }else{
                    app.helper.hideProgress();
                    app.helper.showErrorNotification({'message': err});
                }
            }
        );
    }
    function InstallVTEQBOAddOn() {
        var params = {};
        params['module'] = 'VTEQBO';
        params['action'] = 'SaveAjax';
        params['mode'] = 'downloadSDK';
        app.helper.showProgress();
        app.request.post({'data' : params}).then(
            function(err,data){
                if(err === null) {
//                    app.helper.showInfoMessage({'message': app.vtranslate('Success')});
                    app.helper.hideProgress();
                    app.helper.showAlertBox({message:'Updated module VTEQBO'});
                    setTimeout(function(){
                        window.location.reload();
                    }, 5000);
                }else{
                    app.helper.hideProgress();
                    app.helper.showErrorNotification({'message': err});
                }
            }
        );
    }
</script>
{/literal}