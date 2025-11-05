/* ********************************************************************************
 * The content of this file is subject to the VTE_MODULE_LBL ("License");
 * You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is VTExperts.com
 * Portions created by VTExperts.com. are Copyright(C) VTExperts.com.
 * All Rights Reserved.
 * ****************************************************************************** */
jQuery.Class("VTE_MODULE_NAME_Upgrade_Js",{

},{
    registerEventForUpgradeButton: function () {
        jQuery('button[name="btnUpgrade"]').on('click', function (e) {
            var progressIndicatorElement = jQuery.progressIndicator({
                'message' : 'Upgrading...',
                'position' : 'html',
                'blockInfo' : {
                    'enabled' : true
                }
            });
            var params = {};
            params['module'] = app.getModuleName();
            params['action'] = 'Upgrade';
            params['mode'] = 'upgradeModule';

            AppConnector.request(params).then(
                function (data) {
                    progressIndicatorElement.progressIndicator({'mode': 'hide'});
                    if (data.success) {
                        var params = {};
                        params['text'] = 'Module Upgraded';
                        Settings_Vtiger_Index_Js.showMessage(params);
                    }
                },
                function (error) {
                    progressIndicatorElement.progressIndicator({'mode': 'hide'});
                }
            );
        });
    },

    registerEventForReleaseButton: function () {
        jQuery('button[name="btnRelease"]').on('click', function (e) {
            var progressIndicatorElement = jQuery.progressIndicator({
                'message' : 'Release license...',
                'position' : 'html',
                'blockInfo' : {
                    'enabled' : true
                }
            });
            var params = {};
            params['module'] = app.getModuleName();
            params['action'] = 'Upgrade';
            params['mode'] = 'releaseLicense';

            AppConnector.request(params).then(
                function (data) {
                    progressIndicatorElement.progressIndicator({'mode': 'hide'});
                    if (data.success) {
                        var params = {};
                        params['text'] = 'License Released';
                        Settings_Vtiger_Index_Js.showMessage(params);
                        document.location.href="index.php?module=VTE_MODULE_NAME&parent=Settings&view=Settings&mode=step2";
                    }
                },
                function (error) {
                    progressIndicatorElement.progressIndicator({'mode': 'hide'});
                }
            );
        });
    },

    registerEvents: function(){
        this.registerEventForUpgradeButton();
        this.registerEventForReleaseButton();
    }
});