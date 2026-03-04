/* ********************************************************************************
 * The content of this file is subject to the Label Editor ("License");
 * You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is VTExperts.com
 * Portions created by VTExperts.com. are Copyright(C) VTExperts.com.
 * All Rights Reserved.
 * ****************************************************************************** */
Vtiger.Class("VTELabelEditor_Settings_Js",{
    instance:false,
    getInstance: function(){
        if(VTELabelEditor_Settings_Js.instance == false){
            var instance = new VTELabelEditor_Settings_Js();
            VTELabelEditor_Settings_Js.instance = instance;
            return instance;
        }
        return VTELabelEditor_Settings_Js.instance;
    }
},{
    /* For License page - Begin */
    init : function() {
        this.initiate();
    },
    /*
     * Function to initiate the step 1 instance
     */
    initiate : function(){
        var step=jQuery(".installationContents").find('.step').val();
        this.initiateStep(step);
        this.register_edit_label_event();
        this.register_save_new_label_event();
    },
    /*
     * Function to initiate all the operations for a step
     * @params step value
     */
    initiateStep : function(stepVal) {
        var step = 'step'+stepVal;
        this.activateHeader(step);
    },

    activateHeader : function(step) {
        var headersContainer = jQuery('.crumbs ');
        headersContainer.find('.active').removeClass('active');
        jQuery('#'+step,headersContainer).addClass('active');
    },

    registerActivateLicenseEvent : function() {
        var aDeferred = jQuery.Deferred();
        jQuery(".installationContents").find('[name="btnActivate"]').click(function() {
            var license_key=jQuery('#license_key');
            if(license_key.val()=='') {
                app.helper.showAlertBox({message:"License Key cannot be empty"});
                aDeferred.reject();
                return aDeferred.promise();
            }else{
                app.helper.showProgress();
                var params = {};
                params['module'] = app.getModuleName();
                params['action'] = 'Activate';
                params['mode'] = 'activate';
                params['license'] = license_key.val();

                app.request.post({data:params}).then(
                    function(err,data) {
                        app.helper.hideProgress();
                        if(err == null){
                            var message=data['message'];
                            if(message !='Valid License') {
                                app.helper.hideProgress();
                                app.helper.hideModal();
                                app.helper.showAlertNotification({'message':data['message']});
                            }else{
                                document.location.href="index.php?module=VTELabelEditor&parent=Settings&view=Settings&mode=step3";
                            }
                        }
                    },
                    function(error) {
                        app.helper.hideProgress();
                    }
                );
            }
        });
    },
    registerValidEvent: function () {
        jQuery(".installationContents").find('[name="btnFinish"]').click(function() {
            app.helper.showProgress();
            var data = {};
            data['module'] = 'VTELabelEditor';
            data['action'] = 'Activate';
            data['mode'] = 'valid';
            app.request.post({data:data}).then(
                function (err,data) {
                    if(err == null){
                        app.helper.hideProgress();
                        if (data) {
                            document.location.href = "index.php?module=VTELabelEditor&parent=Settings&view=Settings";
                        }
                    }
                }
            );
        });
    },
    /* For License page - End */
    lang_change:function(){
        var self = this;
        $('#module_lang').on('change',function(){
            var lang = $(this).val();
            var module = app.getModuleName();
            var params = {
                module : module,
                action : 'ActionAjax',
                mode : 'getLanguageFilesAjax',
                parent : 'Settings',
                lang : lang
            };
            AppConnector.request(params).then(function (data) {
                var result = data.result;
                var files = result.files;
                var picklistFieldValue = $('#lang_files');
                picklistFieldValue.siblings('div').find('.select2-chosen').html('Select an Option');
                var html = '<option selected="selected" value="">Select an Option</option>';
                if(files.length > 0){
                    files.forEach(function(item){
                        html += '<option value="'+item+'">'+item+'</option>';
                    });
                }
                picklistFieldValue.html(html);
                self.load_label();
            });
            // get lang dir and permission
            var data = {};
            data['module'] = 'VTELabelEditor';
            data['action'] = 'ActionAjax';
            data['mode'] = 'getLangDirAndPermission';
            data['parent'] = 'Settings';
            data['lang'] = lang;
            app.helper.showProgress();
            app.request.post({data:data}).then(
                function (err,data) {
                    if(err == null){
                        $('#lang_dir').html(data.lang_dir+'&nbsp;&nbsp;&nbsp;&nbsp;<b style="color: '+(data.permission == 'OK' ? 'green' : 'red')+'">(Permissions - ' +data.permission+')');
                        $('#file_info').html('');
                    }
                }
            );
        });
    },
    lang_files_change:function(){
        var self = this;
        $('#lang_files').on('change',function(){
            self.load_label();
            var file = $('#lang_files').val();
            var lang = $('#module_lang').val();
            // get file permission
            if(file.length > 0){
                var data = {};
                data['module'] = 'VTELabelEditor';
                data['action'] = 'ActionAjax';
                data['mode'] = 'getFilePermission';
                data['parent'] = 'Settings';
                data['lang'] = lang;
                data['file'] = file;
                app.helper.showProgress();
                app.request.post({data:data}).then(
                    function (err,data) {
                        if(err == null){
                            $('#file_info').html('<input type="hidden" value="'+data.permission+'" id="file_permission"/>'+data.file_info+'&nbsp;&nbsp;&nbsp;&nbsp;<b style="color: '+(data.permission == 'OK' ? 'green' : 'red')+'">(Permissions - ' +data.permission+')</b>');
                        }
                    }
                );
            }
            else{
                $('#file_info').html('');
            }
        });
    },
    load_label:function(){
        var self = this;
        var file = $('#lang_files').val();
        if(file.length > 0){
            var lang = $('#module_lang').val();
            var module = app.getModuleName();
            var data = {};
            data['module'] = 'VTELabelEditor';
            data['action'] = 'ActionAjax';
            data['mode'] = 'getFieldsInFile';
            data['parent'] = 'Settings';
            data['file'] = file;
            data['lang'] = lang;
            app.helper.showProgress();
            app.request.post({data:data}).then(
                function (err,data) {
                    if(err == null){
                        app.helper.hideProgress();
                        if (data) {
                            $('#fields_result').html(data);
                            self.register_add_label_event();
                        }
                    }
                }
            );
        }
        else{
            app.helper.showProgress();
            $('#fields_result').html('');
            $('#file_info').html('');
            app.helper.hideProgress();
        }
    },
    register_edit_label_event:function(){
        $("#fields_result").on('click','.edit_label',function(){
            var row = $(this).closest('.lang_element');
            row.find('.new_value').removeClass('hide');
            row.find('.new_value').focus();
            row.find('.save_new_label').removeClass('hide');
            row.find('.cancel_save_new_label').removeClass('hide');
            row.find('.more_cancel_save_new_label ').removeClass('hide');
            row.find('.current_value').hide();
            $(this).hide();
            $('.edit_label').hide();
        });
        $("#fields_result").on('click','.cancel_save_new_label',function(){
            var row = $(this).closest('.lang_element');
            row.find('.new_value').addClass('hide');
            row.find('.save_new_label').addClass('hide');
            row.find('.edit_label').show();
            $(this).addClass('hide');
            row.find('.current_value').show();
            $('.edit_label').show();
        });
    },
    register_add_label_event:function(){
        $("#add_label").on('click',function(){
            var last_row = $("#fields_result").find('table.table').find('tr:last');
            var row_new = last_row.clone();
            last_row.after(row_new);
            row_new.removeClass('hide');
            $(this).hide();
        });
        $("#fields_result").on('click','.more_cancel_save_new_label',function(){
            var row = $(this).closest('.lang_element');
            row.remove();
            $("#add_label").show();
        });
    },
    register_save_new_label_event:function(){
        var self = this;
        $("#fields_result").on('click','.save_new_label',function(){
            var file_permission = $('#file_permission').val();
            if(file_permission == 'OK'){
                var row = $(this).closest('.lang_element');
                var new_value = row.find('.new_value').val();
                var file_patch = $(this).data('file_patch');
                var type = $(this).data('type');
                var old_value = $(this).data('old_value');
                var is_new =  $(this).data('is_new');
                var key = $(this).data('key');
                if(key == ''){
                    var new_key = $(this).closest('.lang_element').find('input.key_new_label');
                    if (new_key.length == 0){
                        app.helper.showAlertNotification({message:'Key value can not be empty!'});
                        $(this).focus();
                        return false;
                    }
                    else key = new_key.val();
                }
                var check_new_value = new_value.replace(/\s\s+/g, 'f');
                if(new_value != '' && check_new_value != 'f'){
                    var data = {};
                    data['module'] = 'VTELabelEditor';
                    data['action'] = 'ActionAjax';
                    data['mode'] = 'changeLabel';
                    data['parent'] = 'Settings';
                    data['new_value'] = new_value;
                    data['file_patch'] = file_patch;
                    data['type'] = type;
                    data['old_value'] = old_value;
                    data['key'] = key;
                    app.helper.showProgress();
                    app.request.post({data:data}).then(
                        function (err,data) {
                            if(err == null){
                                if (data) {
                                    app.helper.showSuccessNotification({message:'Label was saved.'});
                                    if(is_new == 1){
                                        setTimeout(function(){
                                            app.helper.hideProgress();
                                            self.load_label();
                                        },2500);
                                    }else{
                                        app.helper.hideProgress();
                                        row.find('.current_value').html(new_value).show();
                                        row.find('.new_value').val(new_value).addClass('hide');
                                        row.find('.save_new_label').addClass('hide');
                                        row.find('.cancel_save_new_label').addClass('hide');
                                        $('.edit_label').show();
                                    }
                                }
                            }
                        }
                    );
                }
                else{
                    app.helper.showAlertNotification({message:'New value can not be empty!'});
                }
            }else{
                app.helper.showAlertNotification({message:'File permissions are incorrect. You can not update file until the permissions have been corrected. The file must be web writable.'});
            }

        });
    },
    search_lang_value:function(){
        $('#search_lang').on('click',function(){
            var search_lang_value = $('#search_lang_value').val();
            var lang = $('#module_lang').val();
            if(search_lang_value != ''){
                var data = {};
                data['module'] = 'VTELabelEditor';
                data['action'] = 'ActionAjax';
                data['mode'] = 'searchLangValue';
                data['parent'] = 'Settings';
                data['search_lang_value'] = search_lang_value;
                data['lang'] = lang;
                app.helper.showProgress();
                app.request.post({data:data}).then(
                    function (err,data) {
                        if(err == null){
                            app.helper.hideProgress();
                            app.helper.showModal(data);
                        }
                    }
                );
            }else{
                app.helper.showAlertNotification({message:'Search value can not be empty!'});
            }
        })
    },
    open_restore_from_backup_modal:function(){
        var self = this;
        var data = {};
        data['module'] = 'VTELabelEditor';
        data['action'] = 'ActionAjax';
        data['mode'] = 'get_backup_modal';
        app.helper.showProgress();
        app.request.post({data:data}).then(
            function (err,data) {
                if(err == null){
                    app.helper.hideProgress();
                    app.helper.showModal(data);
                    self.register_backup_module_lang_change_event();
                    self.register_submit_restore_event();
                }
            }
        );
    },
    register_backup_module_lang_change_event:function(){
        $('#backup_module_lang').on('change',function(){
            var lang = $(this).val();
            var module = app.getModuleName();
            var params = {
                module : module,
                action : 'ActionAjax',
                mode : 'getBackupFilesAjax',
                parent : 'Settings',
                lang : lang
            };
            AppConnector.request(params).then(function (data) {
                var result = data.result;
                var files = result.files;
                var picklistFieldValue = $('#backup_lang_files');
                picklistFieldValue.siblings('div').find('.select2-chosen').html('Select an Option');
                var html = '<option selected="selected" value="">Select an Option</option>';
                if(files.length > 0){
                    files.forEach(function(item){
                        html += '<option value="'+item+'">'+item+'</option>';
                    });
                }
                picklistFieldValue.html(html);
            });
        });
    },
    register_submit_restore_event:function(){
        var self = this;
        $('#submit_restore').on('click',function(){
            var lang = $('#backup_module_lang').val();
            var file = $('#backup_lang_files').val();
            var data = {};
            data['module'] = 'VTELabelEditor';
            data['action'] = 'ActionAjax';
            data['mode'] = 'Restore_Backup';
            data['file'] = file;
            data['lang'] = lang;
            app.helper.showProgress();
            app.request.post({data:data}).then(
                function (err,data) {
                    if(err == null){
                        app.helper.hideProgress();
                        if (data) {
                            app.helper.hideModal();
                            if(data.restore == 'OK'){
                                app.helper.showSuccessNotification({message:'Restore success'});
                            }else{
                                app.helper.showErrorMessage({message:'Restore error'});
                            }
                        }
                    }
                }
            );
        });
    },
    restore_from_backup:function(){
        var self = this;
        $('#restore_from_backup').on('click',function(){
            self.open_restore_from_backup_modal();
        });
    },
    registerEvents: function(){
        /* For License page - Begin */
        this.registerActivateLicenseEvent();
        this.registerValidEvent();
        /* For License page - End */
        this.lang_change();
        this.lang_files_change();
        this.search_lang_value();
        this.restore_from_backup();
    }
});
jQuery(document).ready(function() {
    var instance = new VTELabelEditor_Settings_Js();
    instance.registerEvents();
    Vtiger_Index_Js.getInstance().registerEvents();
});