/**
 * PDFMaker2 — List View JS
 * Handles delete confirmation and row click navigation.
 */
jQuery.Class("PDFMaker2_List_Js", {}, {
    init: function () {
        this.registerEvents();
    },

    registerEvents: function () {
        this.registerDeleteAction();
        this.registerRowClick();
    },

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
                    parent: 'Settings',
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
                window.location.href = 'index.php?module=PDFMaker2&parent=Settings&view=Edit&templateid=' + id;
            }
        });
    }
});

jQuery(document).ready(function () {
    var instance = new PDFMaker2_List_Js();
});
