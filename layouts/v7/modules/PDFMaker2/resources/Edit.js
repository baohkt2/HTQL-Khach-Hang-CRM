/**
 * PDFMaker2 — Edit View JS
 * Handles CKEditor initialization, field picker interactions,
 * and AJAX loading of module fields when target modules change.
 */
Vtiger_Edit_Js("PDFMaker2_Edit_Js", {}, {
    editorInstances: {},

    registerEvents: function () {
        this._super();
        var self = this;
        this.initCKEditors();
        this.registerModuleChange();
        this.registerFieldPickerClick();
        this.registerFormValidation();

        // Initialize select2 for target modules
        jQuery('#targetModules').select2({
            placeholder: app.vtranslate('JS_SELECT_MODULES') || 'Select modules...'
        });
    },

    initCKEditors: function () {
        var self = this;
        var editorIds = ['pdfmaker2Header', 'pdfmaker2Body', 'pdfmaker2Footer'];
        var editorConfig = {
            toolbar: [
                { name: 'document', items: ['Source', '-', 'Preview', '-', 'Templates'] },
                { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'] },
                { name: 'editing', items: ['Find', 'Replace', '-', 'SelectAll'] },
                { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'] },
                '/',
                { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
                { name: 'links', items: ['Link', 'Unlink'] },
                { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar', 'PageBreak'] },
                '/',
                { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] },
                { name: 'colors', items: ['TextColor', 'BGColor'] },
                { name: 'tools', items: ['Maximize', 'ShowBlocks'] }
            ],
            extraPlugins: 'find,pagebreak,preview,div,showblocks,liststyle,tabletools,tableresize,templates',
            allowedContent: true,
            height: 150,
            removePlugins: 'elementspath',
            resize_enabled: true,
            font_names: 'Times New Roman/Times New Roman,serif;Arial/Arial,Helvetica,sans-serif;Courier New/Courier New,Courier,monospace;Georgia/Georgia,serif;Tahoma/Tahoma,Geneva,sans-serif;Verdana/Verdana,Geneva,sans-serif;Roboto/Roboto,sans-serif',
            font_defaultLabel: 'Times New Roman',
            fontSize_sizes: '8/8px;9/9px;10/10px;11/11px;12/12px;13/13px;14/14px;16/16px;18/18px;20/20px;22/22px;24/24px;26/26px;28/28px;36/36px;48/48px;72/72px',
            contentsCss: ['body { font-family: Times New Roman, serif; font-size: 13px; }']
        };

        editorIds.forEach(function (id) {
            var el = document.getElementById(id);
            if (el) {
                var config = jQuery.extend({}, editorConfig);
                if (id === 'pdfmaker2Body') {
                    config.height = 400;
                }
                if (typeof CKEDITOR !== 'undefined') {
                    self.editorInstances[id] = CKEDITOR.replace(id, config);
                }
            }
        });
    },

    registerModuleChange: function () {
        var self = this;
        jQuery('#targetModules').on('change', function () {
            var selectedModules = jQuery(this).val();
            if (selectedModules && selectedModules.length > 0) {
                self.loadFieldsForModule(selectedModules[0]);
            } else {
                jQuery('#fieldPickerContent').html(
                    '<p class="text-muted" id="fieldPickerEmpty">' +
                    (app.vtranslate('JS_SELECT_MODULE_FIRST') || 'Select a target module first to see available fields.') +
                    '</p>'
                );
            }
        });
    },

    loadFieldsForModule: function (moduleName) {
        var self = this;
        var params = {
            module: 'PDFMaker2',
            action: 'GetFields',
            target_module: moduleName
        };

        app.helper.showProgress();
        app.request.post({ data: params }).then(function (err, data) {
            app.helper.hideProgress();
            if (err === null && data && data.success) {
                self.renderFieldPicker(data.blocks, moduleName);
            } else {
                app.helper.showErrorNotification({ message: 'Failed to load fields.' });
            }
        });
    },

    renderFieldPicker: function (blocks, moduleName) {
        var html = '';
        html += '<p class="small text-info"><i class="fa fa-info-circle"></i> ' +
                'Fields for: <strong>' + moduleName + '</strong></p>';

        if (!blocks || blocks.length === 0) {
            html += '<p class="text-muted">No fields found.</p>';
        } else {
            for (var i = 0; i < blocks.length; i++) {
                var block = blocks[i];
                html += '<div class="fieldPickerBlock" style="margin-bottom:8px">';
                html += '<strong class="small" style="cursor:pointer;display:block;padding:4px;background:#f5f5f5;border-radius:3px" ' +
                        'onclick="jQuery(this).next(\'.fieldList\').toggle()">';
                html += '<i class="fa fa-caret-right"></i>&nbsp;' + block.label;
                html += '</strong>';
                html += '<div class="fieldList" style="display:none;padding-left:8px">';

                for (var j = 0; j < block.fields.length; j++) {
                    var field = block.fields[j];
                    html += '<div class="fieldPickerItem" style="padding:2px 0;cursor:pointer" data-variable="' + field.variable + '" ' +
                            'title="Click to insert ' + field.variable + '">';
                    html += '<code class="small">' + field.variable + '</code><br>';
                    html += '<span class="text-muted small">' + field.fieldlabel + '</span>';
                    html += '</div>';
                }

                html += '</div></div>';
            }
        }

        jQuery('#fieldPickerContent').html(html);
        // Rebind click events
        this.registerFieldPickerClick();
    },

    registerFieldPickerClick: function () {
        var self = this;
        jQuery('#fieldPickerContent').off('click', '.fieldPickerItem').on('click', '.fieldPickerItem', function () {
            var variable = jQuery(this).data('variable');
            if (variable) {
                self.insertVariableIntoEditor(variable);
            }
        });
    },

    insertVariableIntoEditor: function (variable) {
        // Insert into the focused/body editor
        var targetEditor = this.editorInstances['pdfmaker2Body'];
        if (targetEditor) {
            targetEditor.insertText(variable);
            app.helper.showSuccessNotification({ message: 'Inserted: ' + variable });
        }
    },

    registerFormValidation: function () {
        var self = this;
        jQuery('#pdfmaker2EditForm').on('submit', function (e) {
            // Sync CKEditor content to textareas
            for (var id in self.editorInstances) {
                if (self.editorInstances.hasOwnProperty(id) && self.editorInstances[id]) {
                    self.editorInstances[id].updateElement();
                }
            }

            var templateName = jQuery('input[name="template_name"]').val().trim();
            if (!templateName) {
                e.preventDefault();
                app.helper.showErrorNotification({ message: 'Template name is required.' });
                return false;
            }

            var targetModules = jQuery('#targetModules').val();
            if (!targetModules || targetModules.length === 0) {
                e.preventDefault();
                app.helper.showErrorNotification({ message: 'Select at least one target module.' });
                return false;
            }

            return true;
        });
    }
});
