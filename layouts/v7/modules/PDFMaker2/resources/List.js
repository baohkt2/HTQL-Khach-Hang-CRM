/**
 * PDFMaker2 — List View JS
 * Handles delete confirmation and row click navigation.
 */
Vtiger_List_Js("PDFMaker2_List_Js", {}, {

    registerDeleteAction: function () {
        jQuery('.deleteTemplate').on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var templateId = jQuery(this).data('id');

            app.helper.showConfirmationBox({
                message: app.vtranslate('JS_DELETE_CONFIRMATION')
            }).then(function () {
                var params = {
                    module: 'PDFMaker2',
                    action: 'Delete',
                    templateid: templateId
                };

                app.helper.showProgress();
                app.request.post({ data: params }).then(function (err, data) {
                    app.helper.hideProgress();
                    if (err === null) {
                        // Remove row
                        jQuery('tr[data-id="' + templateId + '"]').fadeOut(300, function () {
                            jQuery(this).remove();
                        });
                        app.helper.showSuccessNotification({ message: 'Template deleted.' });
                    } else {
                        app.helper.showErrorNotification({ message: 'Delete failed.' });
                    }
                });
            });
        });
    },

    registerRowClick: function () {
        jQuery('.listViewEntries td:not(:last-child)').on('click', function () {
            var row = jQuery(this).closest('tr');
            var id = row.data('id');
            if (id) {
                window.location.href = 'index.php?module=PDFMaker2&view=Edit&templateid=' + id;
            }
        });
    },

    registerEvents: function () {
        this._super();
        this.registerDeleteAction();
        this.registerRowClick();
    }
});
