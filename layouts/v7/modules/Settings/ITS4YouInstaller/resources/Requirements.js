/** @var Settings_ITS4YouInstaller_Requirements_Js */
Settings_Vtiger_Index_Js('Settings_ITS4YouInstaller_Requirements_Js', {}, {
    registerEvents: function () {
        this._super();
        this.registerSourceModuleChange();
    },
    registerSourceModuleChange: function () {
        $('#source_module').on('change', function () {
            window.location.href = $('#source_module').select2('val');
        });
    },
});