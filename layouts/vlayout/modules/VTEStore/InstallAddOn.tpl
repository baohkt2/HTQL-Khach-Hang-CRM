{*<!--
* 
* Copyright (C) www.vtiger.com. All rights reserved.
* @license Proprietary
*
-->*}
{strip}
<div class='modelContainer'>
	<div class="modal-header contentsBackground">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="{if $ERROR=='0'}Vtiger_Helper_Js.showMessage(app.vtranslate('JS_PLEASE_WAIT'));location.reload();{/if}">&times;</button>
        <h3 style="color:green;">{$EXTENSION_NAME}</h3>
	</div>
        <div class="modal-body" id="installationLog">
            <table style="width: 100%">
                <tr><td style="text-align: center"><h4>{vtranslate('Integration Add-on', 'VTEStore')}</h4></td></tr>
                <tr><td>{vtranslate('Integration Add-on description', 'VTEStore')}</td></tr>
                <tr><td style="text-align: center;height: 40px;"><a href="https://www.vtexperts.com/integration-addon-vtiger-extension-pack/" target="_blank" style="color: #428bca;"><u>{vtranslate('Integration Add-ons link', 'VTEStore')}</u></a></td></tr>
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
{/strip}
{literal}
    <script>
        function InstallAuthNetAddOn () {
            var params = {};
            params['module'] = 'ANCustomers';
            params['action'] = 'Install';
            params['mode'] = 'DownloadAuthnetLib';
            params['parent'] = 'Settings';
            var progressIndicatorElement = jQuery.progressIndicator({
                'position' : 'html',
                'blockInfo' : {
                    'enabled' : true
                }
            });
            AppConnector.request(params).then(
                    function (data) {
                        progressIndicatorElement.progressIndicator({'mode': 'hide'});
                        var n_params = {
                            title : app.vtranslate('JS_MESSAGE'),
                            text: app.vtranslate(app.vtranslate('Success')),
                            animation: 'show',
                            type: 'info'
                        };
                        Vtiger_Helper_Js.showPnotify(n_params);
                        window.location.reload();
                    },
                    function (error) {
                        progressIndicatorElement.progressIndicator({'mode': 'hide'});
                        var n_params = {
                            title : app.vtranslate('JS_MESSAGE'),
                            text: app.vtranslate(error),
                            animation: 'show',
                            type: 'error'
                        };
                        Vtiger_Helper_Js.showPnotify(n_params);
                    }
            );
        }

        function InstallVTEQBOAddOn () {
            var params = {};
            params['module'] = 'VTEQBO';
            params['action'] = 'SaveAjax';
            params['mode'] = 'downloadSDK';
            var progressIndicatorElement = jQuery.progressIndicator({
                'position' : 'html',
                'blockInfo' : {
                    'enabled' : true
                }
            });
            AppConnector.request(params).then(
                    function (data) {
                        progressIndicatorElement.progressIndicator({'mode': 'hide'});
                        var n_params = {
                            title : app.vtranslate('JS_MESSAGE'),
                            text: app.vtranslate(app.vtranslate('Success')),
                            animation: 'show',
                            type: 'info'
                        };
                        Vtiger_Helper_Js.showPnotify(n_params);
                        window.location.reload();
                    },
                    function (error) {
                        progressIndicatorElement.progressIndicator({'mode': 'hide'});
                        var n_params = {
                            title : app.vtranslate('JS_MESSAGE'),
                            text: app.vtranslate(error),
                            animation: 'show',
                            type: 'error'
                        };
                        Vtiger_Helper_Js.showPnotify(n_params);
                    }
            );
        }
    </script>
{/literal}