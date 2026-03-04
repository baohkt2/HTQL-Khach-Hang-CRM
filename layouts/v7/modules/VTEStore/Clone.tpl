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
                            {vtranslate('Enter password to', 'VTEStore')} <input type="password" id="clone_password" Name="clone_password" style="width:150px;" autocomplete='off'/>&nbsp;
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

        app.helper.showProgress();
        var ClonePassword=jQuery('#clone_password').val();
        var url = 'index.php?module=VTEStore&parent=Settings&view=Clone&mode=CreatePremiumAccount&ClonePassword='+ClonePassword;
        app.request.post({'url': url}).then(
            function(err,data) {
                app.helper.hideProgress();
                if(data) {
                    app.helper.showSuccessNotification({'message':data});
                }
            }
        );
    });

    // Regenerate License For All Extensions END
    jQuery('body').on('click', '#CloneRegenerateLicenses', function (e) {
        app.helper.showConfirmationBox({'message': 'Are you sure want to regenerate license for all extensions?'}).then(
                function (e) {
                    app.helper.showProgress(app.vtranslate('Regenerating license')+' ...');
                    var params = {
                        'module': app.getModuleName(),
                        'parent': app.getParentModuleName(),
                        'view': 'Settings',
                        'mode': 'regenerateLicenseAll'
                    };

                    app.request.post({'data':params}).then(
                            function(err,data){
                                if(err === null) {
                                    app.helper.hideProgress();
                                    app.helper.showModal(data);
                                }else{
                                    app.helper.hideProgress();
                                }
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