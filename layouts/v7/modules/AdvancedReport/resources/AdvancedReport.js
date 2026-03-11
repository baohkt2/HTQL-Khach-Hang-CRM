/**
 * AdvancedReport - Frontend Controller
 * Handles UI interactions, AJAX calls, and report preview/export
 */
Vtiger.Class('AdvancedReport_List_Js', {}, {

    currentReportConfig: null,
    currentReportResult: null,

    init: function() {
    },

    registerEvents: function() {
        var self = this;

        // Report type change
        jQuery('#reportType').on('change', function() { self.onReportTypeChange(); });

        // Generate report
        jQuery('#btnGenerateReport').on('click', function() { self.generateReport(); });

        // Export to Excel
        jQuery('#btnExportExcel').on('click', function() { self.exportReport(); });

        // Save config
        jQuery('#btnSaveConfig').on('click', function() { self.showSaveModal(); });
        jQuery('#btnDoSaveConfig').on('click', function() { self.saveConfig(); });

        // Create new template
        jQuery('#btnNewTemplate').on('click', function() { self.showNewTemplateModal(); });
        jQuery('#btnDoCreateTemplate').on('click', function() { self.createTemplate(); });

        // Saved configs actions (delegated)
        jQuery(document).on('click', '.btnLoadConfig', function() {
            self.loadConfig(jQuery(this).data('id'));
        });
        jQuery(document).on('click', '.btnRunSavedConfig', function() {
            self.runSavedConfig(jQuery(this).data('id'));
        });
        jQuery(document).on('click', '.btnDeleteConfig', function() {
            self.deleteConfig(jQuery(this).data('id'));
        });
        jQuery(document).on('click', '.btnEditConfig', function() {
            self.editConfig(jQuery(this).data('id'));
        });

        // Initialize select2
        jQuery('.select2').each(function() {
            jQuery(this).select2({width: '100%'});
        });

        // Template modal: report type toggle
        jQuery('#tplReportType').on('change', function() { self.onTemplateTypeChange(); });
    },

    onReportTypeChange: function() {
        var type = jQuery('#reportType').val();
        var campaignTypes = ['campaign_contact_stats', 'campaign_account_breakdown', 'campaign_followup_stats'];

        jQuery('#campaignFilterGroup, #dateFilterGroup, #dateToGroup').toggle(campaignTypes.indexOf(type) !== -1);
        jQuery('#followupOptions').toggle(type === 'campaign_followup_stats');
        jQuery('#customQueryGroup').toggle(type === 'custom');

        var hasType = type !== '';
        jQuery('#btnGenerateReport').prop('disabled', !hasType);
        jQuery('#btnExportExcel, #btnSaveConfig').prop('disabled', !hasType);
    },

    buildReportConfig: function() {
        var type = jQuery('#reportType').val();
        var config = { report_type: type };

        if (type !== 'custom') {
            var campaignIds = jQuery('#campaignFilter').val();
            if (campaignIds && campaignIds.length) {
                config.campaign_id = campaignIds;
            }
            var dateFrom = jQuery('#dateFrom').val();
            if (dateFrom) config.date_from = dateFrom;
            var dateTo = jQuery('#dateTo').val();
            if (dateTo) config.date_to = dateTo;

            if (type === 'campaign_followup_stats') {
                config.max_followup = parseInt(jQuery('#maxFollowup').val()) || 3;
                var actTypes = jQuery('#activityTypes').val();
                if (actTypes && actTypes.length) {
                    config.activity_types = actTypes;
                }
            }
        } else {
            var raw = jQuery('#customQueryConfig').val();
            if (!raw || !raw.trim()) {
                app.helper.showErrorNotification({message: 'Vui lòng nhập cấu hình JSON'});
                return null;
            }
            try {
                var customConfig = JSON.parse(raw);
                config = jQuery.extend(config, customConfig);
            } catch (e) {
                app.helper.showErrorNotification({message: 'JSON không hợp lệ: ' + e.message});
                return null;
            }
        }

        this.currentReportConfig = config;
        return config;
    },

    generateReport: function() {
        var self = this;
        var config = this.buildReportConfig();
        if (!config) return;

        jQuery('#reportLoading').removeClass('hide');
        jQuery('#btnGenerateReport').prop('disabled', true);

        var params = {
            module: 'AdvancedReport',
            action: 'Generate',
            report_config: JSON.stringify(config)
        };

        app.request.post({data: params}).then(function(err, data) {
            jQuery('#reportLoading').addClass('hide');
            jQuery('#btnGenerateReport').prop('disabled', false);

            if (err || !data || !data.success) {
                app.helper.showErrorNotification({
                    message: (err ? err : (data ? data.error : 'Có lỗi xảy ra'))
                });
                return;
            }

            self.currentReportResult = data;
            self.renderPreview(data);
            jQuery('#exportOptionsPanel').show();

            app.helper.showSuccessNotification({
                message: 'Đã tạo báo cáo: ' + data.meta.total_rows + ' dòng'
            });
        });
    },

    renderPreview: function(result) {
        var self = this;
        var $head = jQuery('#reportPreviewHead');
        var $body = jQuery('#reportPreviewBody');
        var $foot = jQuery('#reportPreviewFoot');
        var $groupSelect = jQuery('#exportGroupField');
        var headers = result.headers;
        var data = result.data;
        var summary = result.summary || {};

        $head.empty();
        $body.empty();
        $foot.empty();
        $groupSelect.empty().append('<option value="">-- Không --</option>');

        // Headers
        var headerRow = '<tr>';
        var headerKeys = Object.keys(headers);
        headerKeys.forEach(function(key) {
            headerRow += '<th>' + self.escapeHtml(headers[key]) + '</th>';
            $groupSelect.append('<option value="' + key + '">' + self.escapeHtml(headers[key]) + '</option>');
        });
        headerRow += '</tr>';
        $head.html(headerRow);

        // Data rows
        var bodyHtml = '';
        data.forEach(function(row) {
            bodyHtml += '<tr>';
            headerKeys.forEach(function(key) {
                bodyHtml += '<td>' + self.escapeHtml(row[key] || '') + '</td>';
            });
            bodyHtml += '</tr>';
        });
        $body.html(bodyHtml);

        // Summary
        if (Object.keys(summary).length > 0) {
            var footRow = '<tr class="warning"><th>TỔNG CỘNG</th>';
            headerKeys.slice(1).forEach(function(key) {
                var val = summary[key] !== undefined ? summary[key] : '';
                footRow += '<th>' + val + '</th>';
            });
            footRow += '</tr>';
            $foot.html(footRow);
        }

        jQuery('#previewRowCount').text(data.length + ' dòng');
        jQuery('#reportPreviewPanel').show();
    },

    exportReport: function() {
        var config = this.currentReportConfig || this.buildReportConfig();
        if (!config) return;

        var params = {
            module: 'AdvancedReport',
            action: 'Export',
            report_config: JSON.stringify(config),
            export_title: jQuery('#exportTitle').val(),
            export_subtitle: jQuery('#exportSubtitle').val(),
            export_format: jQuery('#exportFormat').val(),
            filename: jQuery('#exportFilename').val(),
            group_field: jQuery('#exportGroupField').val(),
            show_summary: jQuery('#exportShowSummary').is(':checked') ? '1' : '0'
        };

        window.location.href = 'index.php?' + jQuery.param(params);
    },

    showSaveModal: function() {
        jQuery('#saveConfigId').val('');
        jQuery('#saveConfigName').val('');
        jQuery('#saveConfigDescription').val('');
        jQuery('#saveConfigModal').modal('show');
    },

    saveConfig: function() {
        var self = this;
        var name = jQuery('#saveConfigName').val();
        if (!name) {
            app.helper.showErrorNotification({message: 'Vui lòng nhập tên báo cáo'});
            return;
        }

        var config = this.buildReportConfig();
        if (!config) return;

        var params = {
            module: 'AdvancedReport',
            action: 'SaveConfig',
            mode: 'save',
            name: name,
            description: jQuery('#saveConfigDescription').val(),
            config: JSON.stringify(config),
            config_id: jQuery('#saveConfigId').val()
        };

        app.request.post({data: params}).then(function(err, data) {
            jQuery('#saveConfigModal').modal('hide');
            if (err || !data || !data.success) {
                app.helper.showErrorNotification({message: (err ? err : 'Lỗi lưu cấu hình')});
                return;
            }
            app.helper.showSuccessNotification({message: 'Đã lưu cấu hình báo cáo'});
            window.location.reload();
        });
    },

    loadConfig: function(configId) {
        var self = this;
        var params = {
            module: 'AdvancedReport',
            action: 'SaveConfig',
            mode: 'load',
            config_id: configId
        };

        app.request.post({data: params}).then(function(err, data) {
            if (err || !data || !data.success) {
                app.helper.showErrorNotification({message: 'Lỗi tải cấu hình'});
                return;
            }
            var saved = data.config;
            var config = saved.config || {};

            jQuery('#reportType').val(config.report_type || 'custom').trigger('change');

            if (config.campaign_id) {
                jQuery('#campaignFilter').val(config.campaign_id).trigger('change');
            }
            if (config.date_from) jQuery('#dateFrom').val(config.date_from);
            if (config.date_to) jQuery('#dateTo').val(config.date_to);
            if (config.max_followup) jQuery('#maxFollowup').val(config.max_followup);

            if (config.report_type === 'custom') {
                jQuery('#customQueryConfig').val(JSON.stringify(config, null, 2));
            }

            jQuery('#saveConfigId').val(saved.id);
            app.helper.showSuccessNotification({message: 'Đã tải cấu hình: ' + saved.name});
        });
    },

    editConfig: function(configId) {
        var self = this;
        var params = {
            module: 'AdvancedReport',
            action: 'SaveConfig',
            mode: 'load',
            config_id: configId
        };

        app.request.post({data: params}).then(function(err, data) {
            if (err || !data || !data.success) {
                app.helper.showErrorNotification({message: 'Lỗi tải cấu hình'});
                return;
            }
            var saved = data.config;

            // Pre-fill save modal for editing
            jQuery('#saveConfigId').val(saved.id);
            jQuery('#saveConfigName').val(saved.name || '');
            jQuery('#saveConfigDescription').val(saved.description || '');

            // Also load into the form
            var config = saved.config || {};
            jQuery('#reportType').val(config.report_type || 'custom').trigger('change');
            if (config.campaign_id) {
                jQuery('#campaignFilter').val(config.campaign_id).trigger('change');
            }
            if (config.report_type === 'custom') {
                jQuery('#customQueryConfig').val(JSON.stringify(config, null, 2));
            }

            jQuery('#saveConfigModal').modal('show');
        });
    },

    runSavedConfig: function(configId) {
        var self = this;
        jQuery('#reportLoading').removeClass('hide');

        var params = {
            module: 'AdvancedReport',
            action: 'Generate',
            mode: 'saved',
            config_id: configId
        };

        app.request.post({data: params}).then(function(err, data) {
            jQuery('#reportLoading').addClass('hide');

            if (err || !data || !data.success) {
                app.helper.showErrorNotification({
                    message: (err ? err : (data ? data.error : 'Có lỗi xảy ra'))
                });
                return;
            }

            self.currentReportResult = data;
            self.renderPreview(data);
            jQuery('#exportOptionsPanel').show();
            jQuery('#reportPreviewPanel').show();

            app.helper.showSuccessNotification({
                message: 'Đã tạo báo cáo: ' + data.meta.total_rows + ' dòng'
            });
        });
    },

    deleteConfig: function(configId) {
        if (!confirm('Bạn có chắc chắn muốn xóa cấu hình này?')) return;

        var params = {
            module: 'AdvancedReport',
            action: 'SaveConfig',
            mode: 'delete',
            config_id: configId
        };

        app.request.post({data: params}).then(function(err, data) {
            if (err || !data || !data.success) {
                app.helper.showErrorNotification({message: 'Lỗi xóa cấu hình'});
                return;
            }
            app.helper.showSuccessNotification({message: 'Đã xóa cấu hình'});
            jQuery('tr[data-config-id="' + configId + '"]').fadeOut(300, function() {
                jQuery(this).remove();
            });
        });
    },

    // ── New Template Creation ──

    showNewTemplateModal: function() {
        jQuery('#tplName').val('');
        jQuery('#tplDescription').val('');
        jQuery('#tplReportType').val('campaign_contact_stats');
        this.onTemplateTypeChange();
        jQuery('#tplConfigJson').val('');
        jQuery('#createTemplateModal').modal('show');
    },

    onTemplateTypeChange: function() {
        var type = jQuery('#tplReportType').val();
        jQuery('#tplCustomConfigGroup').toggle(type === 'custom');

        // Provide sample JSON for custom type
        if (type === 'custom' && !jQuery('#tplConfigJson').val()) {
            var sample = {
                "primary_module": "Campaigns",
                "select_fields": ["campaignname", "campaignstatus"],
                "related_modules": [{
                    "module": "Contacts",
                    "relation": "campaign_contact",
                    "fields": ["firstname", "lastname"],
                    "aggregates": [{"field": "contactid", "function": "COUNT", "alias": "total", "distinct": true}]
                }],
                "filters": [],
                "group_by": ["campaignname", "campaignstatus"],
                "order_by": [{"field": "campaignname", "direction": "ASC"}]
            };
            jQuery('#tplConfigJson').val(JSON.stringify(sample, null, 2));
        }
    },

    createTemplate: function() {
        var self = this;
        var name = jQuery('#tplName').val();
        if (!name) {
            app.helper.showErrorNotification({message: 'Vui lòng nhập tên mẫu báo cáo'});
            return;
        }

        var type = jQuery('#tplReportType').val();
        var config = { report_type: type };

        if (type === 'custom') {
            var raw = jQuery('#tplConfigJson').val();
            if (raw && raw.trim()) {
                try {
                    var parsed = JSON.parse(raw);
                    config = jQuery.extend(config, parsed);
                } catch (e) {
                    app.helper.showErrorNotification({message: 'JSON không hợp lệ: ' + e.message});
                    return;
                }
            }
        }

        var params = {
            module: 'AdvancedReport',
            action: 'SaveConfig',
            mode: 'save',
            name: name,
            description: jQuery('#tplDescription').val(),
            config: JSON.stringify(config)
        };

        app.request.post({data: params}).then(function(err, data) {
            jQuery('#createTemplateModal').modal('hide');
            if (err || !data || !data.success) {
                app.helper.showErrorNotification({message: (err ? err : 'Lỗi tạo mẫu báo cáo')});
                return;
            }
            app.helper.showSuccessNotification({message: 'Đã tạo mẫu báo cáo mới'});
            window.location.reload();
        });
    },

    escapeHtml: function(text) {
        if (text === null || text === undefined) return '';
        var div = document.createElement('div');
        div.appendChild(document.createTextNode(String(text)));
        return div.innerHTML;
    }
});
