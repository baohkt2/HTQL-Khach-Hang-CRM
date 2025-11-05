{*<!--
/* ********************************************************************************
* The content of this file is subject to the VTE_MODULE_LBL ("License");
* You may not use this file except in compliance with the License
* The Initial Developer of the Original Code is VTExperts.com
* Portions created by VTExperts.com. are Copyright(C) VTExperts.com.
* All Rights Reserved.
* ****************************************************************************** */
-->*}
<div class="container-fluid">
    <div class="widget_header row-fluid">
        <div class="span5">
            <h3>
            <a href="index.php?module=VTEStore&parent=Settings&view=Settings&reset=1">{vtranslate('MODULE_LBL', 'VTEStore')}</a>
            >> {vtranslate('Auto Create Premium Account', 'VTEStore')}
            </h3>
        </div>
    </div>
    <hr>
    <div class="clearfix"></div>
    <div class="summaryWidgetContainer" id="VTEStore_settings">
        <div class="container-fluid" id="importModules">
            <div class="row-fluid">
                <table>
                    <tr>
                        <td>
                            {vtranslate('Enter password to', 'VTEStore')} <input type="password" id="clone_password" Name="clone_password" class="span7" style="height: 15px;width:150px;" autocomplete='off'/>&nbsp;
                            <button id="CloneCreatePremiumAccount" class="btn btn-primary" style="height: 28px; margin-bottom: 7px">{vtranslate('Create Premium Account for New Instance', 'VTEStore')}</button>
                            <button id="CloneRegenerateLicenses" class="btn btn-success" style="height: 28px; margin-bottom: 7px">{vtranslate('Regenerate Licenses for New Instance', 'VTEStore')}</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                    </tr>
                </table>
                <br>
            </div>
        </div>
    </div>
</div>
{literal}
<script>
    jQuery('body').on('click','#CloneCreatePremiumAccount',function(){
        var url = 'index.php?module=VTEStore&parent=Settings&view=Clone';
        var progressIndicatorElement = jQuery.progressIndicator();
        var ClonePassword=jQuery('#clone_password').val();
        var actionParams = {
            "type":"POST",
            "url":url,
            "dataType":"html",
            "data" : {'mode':'CreatePremiumAccount','ClonePassword':ClonePassword}
        };
        AppConnector.request(actionParams).then(
            function(data) {
                progressIndicatorElement.progressIndicator({'mode' : 'hide'});
                if(data) {
                    var params = {type: 'success', text: data};
                    Settings_Vtiger_Index_Js.showMessage(params);
                }
            }
        );
    });

    // Regenerate License For All Extensions END
    jQuery('body').on('click', '#CloneRegenerateLicenses', function (e) {
        Vtiger_Helper_Js.showConfirmationBox({'message': 'Are you sure want to regenerate license for all extensions?'}).then(
                function (e) {
                    var progressIndicatorElement = jQuery.progressIndicator({
                        'position': 'html',
                        'blockInfo': {
                            'enabled': true
                        },
                        'message': app.vtranslate('Regenerating license')+' ...'
                    });
                    var params = {
                        'module': app.getModuleName(),
                        'parent': app.getParentModuleName(),
                        'view': 'Settings',
                        'mode': 'regenerateLicenseAll'
                    };

                    AppConnector.request(params).then(
                            function (data) {
                                progressIndicatorElement.progressIndicator({'mode': 'hide'});
                                var modalData = {
                                    data: data,
                                    css: {'width': '50%', 'height': 'auto'}
                                };
                                app.showModalWindow(modalData);
                            },
                            function (error) {
                                progressIndicatorElement.progressIndicator({'mode': 'hide'});
                            }
                    );
                },
                function (error, err) {
                }
        );
    });
    // Regenerate License For All Extensions END
</script>
{/literal}