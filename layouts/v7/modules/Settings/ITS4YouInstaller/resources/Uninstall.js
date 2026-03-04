/*******************************************************************************
 * The content of this file is subject to the ITS4YouInstaller license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 ***************************************************************************** */

Settings_Vtiger_Index_Js("Settings_ITS4YouInstaller_Uninstall_Js", {}, {
    uninstall: function () {
        var sourceModule = $('#sourceModule').val(),
            message = app.vtranslate('JS_UNINSTALL_CONFIRM');

        app.helper.showConfirmationBox({message: message}).then(function () {
            var url = 'index.php?module=ITS4YouInstaller&parent=Settings&action=Uninstall&sourceModule=' + sourceModule;

            app.request.post({url: url}).then( function (err, data) {
                if (err === null) {
                    if (data.success === true) {
                        window.location.href = "index.php";
                    }
                }
            });
        });
    },
    registerActions: function () {
        var thisInstance = this;

        jQuery('#ITS4YouUninstall_btn').click(function (e) {
            thisInstance.uninstall();
        });
    },
    init: function () {
        this._super();
        this.registerActions();
    }
});