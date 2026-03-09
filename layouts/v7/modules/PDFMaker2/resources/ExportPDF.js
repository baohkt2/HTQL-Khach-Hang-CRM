/**
 * PDFMaker2 — Global ExportPDF JS
 * Loaded via HEADERSCRIPT on all pages.
 * Adds "Export PDF" action button to Detail View and List View of all modules.
 */
jQuery.Class("PDFMaker2_ExportPDF_Js", {}, {
    init: function () {
        this.registerEvents();
    },

    registerEvents: function () {
        var currentView = app.view();
        var moduleName = app.getModuleName();

        // Skip non-entity views and PDFMaker2 itself
        if (!moduleName || moduleName === 'PDFMaker2' || moduleName === 'Users' || moduleName === 'Settings') {
            return;
        }

        if (currentView === 'Detail') {
            this.addDetailViewButton(moduleName, 0);
        } else if (currentView === 'List') {
            this.addListViewButton(moduleName, 0);
        }
    },

    /**
     * Add "Export PDF" to the detail view actions dropdown.
     */
    addDetailViewButton: function (moduleName, retryCount) {
        var self = this;

        // Cleanup legacy/fallback buttons rendered outside "More".
        this.cleanupExternalExportButtons();

        if (jQuery('.pdfmaker2ExportPDFAction').length > 0) {
            return;
        }

        // Find the btn-group container in the detail view
        var btnGroup = jQuery('.detailViewButtoncontainer .btn-group').first();
        if (btnGroup.length === 0) {
            if ((retryCount || 0) < 8) {
                setTimeout(function () {
                    self.addDetailViewButton(moduleName, (retryCount || 0) + 1);
                }, 300);
            }
            return;
        }

        // Try to find the existing "Xem thêm" (More) dropdown
        var moreDropdown = btnGroup.children('ul.dropdown-menu').first();

        // If no "More" dropdown exists, create it
        if (moreDropdown.length === 0) {
            var moreLabel = app.vtranslate('LBL_MORE');
            if (!moreLabel || moreLabel === 'LBL_MORE') {
                moreLabel = 'Xem thêm';
            }
            var moreBtn = jQuery(
                '<button class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);">' +
                moreLabel + '&nbsp;&nbsp;<i class="caret"></i>' +
                '</button>'
            );
            moreDropdown = jQuery('<ul class="dropdown-menu dropdown-menu-right"></ul>');
            // Insert before the pagination btn-group (if any), or append at end
            btnGroup.append(moreBtn);
            btnGroup.append(moreDropdown);
        }

        var menuItem = jQuery(
            '<li class="pdfmaker2-export-item">' +
            '<a href="javascript:void(0)" class="pdfmaker2ExportPDFAction">' +
            '<i class="fa fa-file-pdf-o"></i>&nbsp;Export PDF' +
            '</a></li>'
        );
        moreDropdown.append(menuItem);

        menuItem.find('.pdfmaker2ExportPDFAction').on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            self.showFeatureInDevelopmentPopup();
        });
    },

    cleanupExternalExportButtons: function () {
        // Remove PDFMaker v1 legacy button block
        jQuery('#PDFMakerContentDiv').remove();

        // Remove previous fallback button class.
        jQuery('.pdfmaker2ExportBtn').remove();

        // Remove any direct "Export PDF" button in detail action bar (outside More dropdown).
        jQuery('.detailViewButtoncontainer .btn-group').first().children('button, a').each(function () {
            var el = jQuery(this);
            if (el.hasClass('dropdown-toggle')) {
                return;
            }

            var label = jQuery.trim(el.text()).replace(/\s+/g, ' ');
            var title = jQuery.trim(el.attr('title') || '');
            if (label === 'Export PDF' || label === 'Export to PDF' || title === 'Export PDF' ||
                el.hasClass('selectPDFTemplates')) {
                el.remove();
            }
        });
    },

    cleanupListViewExternalExportButtons: function () {
        jQuery('.pdfmaker2MassExportBtn').remove();

        // Remove any direct Export PDF buttons rendered outside the list "More" dropdown.
        jQuery('#listview-actions .listViewActionsContainer > button, #listview-actions .listViewActionsContainer > a').each(function () {
            var el = jQuery(this);
            var label = jQuery.trim(el.text()).replace(/\s+/g, ' ');
            var title = jQuery.trim(el.attr('title') || '');

            if (label === 'Export PDF' || label === 'Export to PDF' || title === 'Export PDF') {
                el.remove();
            }
        });
    },

    /**
     * Add "Export PDF" into list view "More" dropdown.
     */
    addListViewButton: function (moduleName, retryCount) {
        var self = this;

        this.cleanupListViewExternalExportButtons();

        if (jQuery('.pdfmaker2MassExportAction').length > 0) {
            return;
        }

        var listActionsContainer = jQuery('#listview-actions .listViewActionsContainer').first();
        if (listActionsContainer.length === 0) {
            if ((retryCount || 0) < 8) {
                setTimeout(function () {
                    self.addListViewButton(moduleName, (retryCount || 0) + 1);
                }, 300);
            }
            return;
        }

        var massActionGroup = listActionsContainer.find('.listViewMassActions').first();
        if (massActionGroup.length === 0) {
            var moreLabel = app.vtranslate('LBL_MORE');
            if (!moreLabel || moreLabel === 'LBL_MORE') {
                moreLabel = 'Xem thêm';
            }

            massActionGroup = jQuery('<div class="btn-group listViewMassActions" role="group"></div>');
            massActionGroup.append(
                '<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">' +
                moreLabel + '&nbsp;<span class="caret"></span>' +
                '</button>'
            );
            massActionGroup.append('<ul class="dropdown-menu" role="menu"></ul>');
            listActionsContainer.append(massActionGroup);
        }

        var moreDropdown = massActionGroup.find('ul.dropdown-menu').first();
        if (moreDropdown.length === 0) {
            moreDropdown = jQuery('<ul class="dropdown-menu" role="menu"></ul>');
            massActionGroup.append(moreDropdown);
        }

        var menuItem = jQuery(
            '<li class="pdfmaker2MassExportItem hide">' +
            '<a href="javascript:void(0)" class="pdfmaker2MassExportAction" id="' + moduleName + '_listView_massAction_PDFMaker2ExportPDF">' +
            '<i class="fa fa-file-pdf-o"></i>&nbsp;Export PDF' +
            '</a>' +
            '</li>'
        );
        moreDropdown.append(menuItem);

        menuItem.find('.pdfmaker2MassExportAction').on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            self.showFeatureInDevelopmentPopup();
        });
    },

    showFeatureInDevelopmentPopup: function () {
        app.helper.showAlertBox({
            title: 'Thong bao',
            message: 'Tinh nang Export PDF dang duoc phat trien. Vui long quay lai sau.'
        });
    },

    /**
     * Get selected record IDs from list view checkboxes.
     */
    getSelectedRecordIds: function () {
        var ids = [];
        jQuery('.listViewEntriesCheckBox:checked, .listViewEntries input[type="checkbox"]:checked').each(function () {
            var val = jQuery(this).val() || jQuery(this).closest('tr').data('id');
            if (val) {
                ids.push(val);
            }
        });
        return ids;
    },

    /**
     * Show modal with template selector for exporting PDF.
     */
    showTemplateSelector: function (moduleName, recordIds, isMass) {
        var self = this;

        // Fetch available templates for this module
        var params = {
            module: 'PDFMaker2',
            view: 'GetTemplates',
            source_module: moduleName
        };

        app.helper.showProgress();
        app.request.get({ data: params }).then(function (err, data) {
            app.helper.hideProgress();

            if (err !== null || !data || !data.success) {
                app.helper.showErrorNotification({ message: 'Failed to load PDF templates.' });
                return;
            }

            var templates = data.templates;
            if (!templates || templates.length === 0) {
                app.helper.showAlertBox({
                    title: 'No Templates',
                    message: 'No PDF templates configured for module: ' + moduleName +
                             '. Please ask an administrator to create one in Settings > PDF Maker 2.'
                });
                return;
            }

            self.renderAndShowModal(templates, moduleName, recordIds, isMass);
        });
    },

    /**
     * Render the template selection modal.
     */
    renderAndShowModal: function (templates, moduleName, recordIds, isMass) {
        var self = this;

        var html = '<div class="modal-dialog modal-md">' +
            '<div class="modal-content">' +
            '<div class="modal-header">' +
            '<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>' +
            '<h4 class="modal-title"><i class="fa fa-file-pdf-o"></i>&nbsp;Export PDF (v2)</h4>' +
            '</div>' +
            '<div class="modal-body">';

        if (isMass) {
            html += '<p class="text-info"><i class="fa fa-info-circle"></i> ' +
                    recordIds.length + ' record(s) selected. PDFs will be downloaded as a ZIP file.</p>';
        }

        html += '<div class="form-group">' +
                '<label><strong>Select Template:</strong></label>' +
                '<select id="pdfmaker2TemplateSelect" class="inputElement form-control">';

        for (var i = 0; i < templates.length; i++) {
            var tpl = templates[i];
            var isDefault = tpl.is_default === '1' ? ' (Default)' : '';
            html += '<option value="' + tpl.templateid + '"' +
                    (tpl.is_default === '1' ? ' selected' : '') + '>' +
                    tpl.template_name + isDefault + '</option>';
        }

        html += '</select></div>' +
                '</div>' +
                '<div class="modal-footer">' +
                '<button type="button" class="btn btn-success" id="pdfmaker2ConfirmExport">' +
                '<i class="fa fa-download"></i>&nbsp;Download PDF</button>' +
                '&nbsp;<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>' +
                '</div></div></div>';

        app.helper.showModal(html, {
            cb: function (modalContainer) {
                modalContainer.find('#pdfmaker2ConfirmExport').on('click', function () {
                    var templateId = modalContainer.find('#pdfmaker2TemplateSelect').val();
                    if (!templateId) {
                        app.helper.showErrorNotification({ message: 'Please select a template.' });
                        return;
                    }

                    app.helper.hideModal();

                    if (isMass) {
                        self.executeMassExport(templateId, moduleName, recordIds);
                    } else {
                        self.executeSingleExport(templateId, moduleName, recordIds[0]);
                    }
                });
            }
        });
    },

    /**
     * Download PDF for a single record.
     */
    executeSingleExport: function (templateId, moduleName, recordId) {
        var url = 'index.php?module=PDFMaker2&action=GeneratePDF' +
                  '&templateid=' + encodeURIComponent(templateId) +
                  '&record=' + encodeURIComponent(recordId) +
                  '&source_module=' + encodeURIComponent(moduleName) +
                  '&output_mode=download';
        window.location.href = url;
    },

    /**
     * Download ZIP of PDFs for multiple records.
     */
    executeMassExport: function (templateId, moduleName, recordIds) {
        var url = 'index.php?module=PDFMaker2&action=MassExportPDF' +
                  '&templateid=' + encodeURIComponent(templateId) +
                  '&source_module=' + encodeURIComponent(moduleName) +
                  '&record_ids=' + encodeURIComponent(recordIds.join(','));
        window.location.href = url;
    }
});

// Auto-init on document ready
jQuery(document).ready(function () {
    new PDFMaker2_ExportPDF_Js();
});
