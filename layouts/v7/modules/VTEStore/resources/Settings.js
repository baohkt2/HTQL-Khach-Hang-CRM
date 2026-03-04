/* ********************************************************************************
 * The content of this file is subject to the VTiger Premium ("License");
 * You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is VTExperts.com
 * Portions created by VTExperts.com. are Copyright(C) VTExperts.com.
 * All Rights Reserved.
 * ****************************************************************************** */

Vtiger.Class("VTEStore_Settings_Js",{
    editInstance:false,
    getInstance: function(){
        if(VTEStore_Settings_Js.editInstance == false){
            var instance = new VTEStore_Settings_Js();
            VTEStore_Settings_Js.editInstance = instance;
            return instance;
        }
        return VTEStore_Settings_Js.editInstance;
    }
},{

    registerEventsForVTEStore: function (container) {
        var thisInstance = this;
        // Search Extension BEGIN
        //Submit search form when enter key press
        var searchExtension = document.getElementById("searchExtension");
        if(searchExtension != undefined && searchExtension != null && searchExtension != ''){
            searchExtension.addEventListener("keypress", function(event) {
                if (event.key === "Enter") {
                    event.preventDefault();
                    document.getElementById("btnSearchExtension").click();
                }
            });
        }
        jQuery(container).on('click', '#btnSearchExtension', function (e) {
            app.helper.showProgress();;
            var keyword = jQuery("#searchExtension").val();
            var categories = jQuery("#selectedCagetories").val();
            var params = {
                'module': app.getModuleName(),
                'parent': app.getParentModuleName(),
                'view': 'Settings',
                'mode': 'searchExtension',
                'keyword': keyword,
                'categories': categories
            };
                    
            app.request.post({'data':params}).then(
                function(err,data){
                    if(err === null) {
                        app.helper.hideProgress();
                        jQuery('#extensionContainer').html(data);
                        var search_key =jQuery('#search_key').val();
                        var searchmode =jQuery('#searchmode').val();
                        if(searchmode==1){
                            jQuery('#reset_search_value').html(app.vtranslate('JS_FILTER')+': '+search_key+' <u><a href="index.php?module=VTEStore&parent=Settings&view=Settings&reset=1">('+app.vtranslate('JS_CLICK_TO_RESET_THE_SEARCH')+')</a></u>');
                        }
						vtestoreRegisterTooltip();
                    }else{
                        app.helper.hideProgress();
                    }
                }
            );
        });
        // Search Extension END

        // Login, Create Account BEGIN
        // Login BEGIN
        jQuery(container).find('#logintoVTEStore').unbind('click');
        jQuery(container).on('click', '#logintoVTEStore', function (e) {
            // app.helper.hideModal();
            app.helper.showProgress();
            var loginAccountModal = jQuery(container).find('.loginAccount').clone(true, true);
            loginAccountModal.removeClass('hide');

            var modal_jQuery = app.helper.showModal(loginAccountModal[0].outerHTML, {'width': '400px', 'cb': function (data) {
                app.helper.hideProgress();
                var form = data.find('.loginForm');
                var params = app.validationEngineOptions;
                params.submitHandler = function (frm) {
                    var formData = $(frm).serializeFormData();
                    var savePassword = $(frm).find('input[name="savePassword"]:checked').length;
                    if (savePassword) {
                        formData["savePassword"] = 1;
                    } else {
                        formData["savePassword"] = 0;
                    }
                    app.helper.showProgress();

                    app.request.post({'data':formData}).then(
                        function(err,data){
                            app.helper.hideProgress();
                            if(err === null) {
                                //error: 0 is success, 1 is generall error, 2 is vtiger_url difference, 3 account is stop
                                if (data.error == '0'){
                                    var params = {
                                        message: data.message + '\n'+app.vtranslate('JS_PLEASE_WAIT'),
                                    };
                                    app.helper.showSuccessNotification(params);
                                    location.reload();
                                } else if (data.error == '1' || data.error == '3'){
                                    var params = {
                                        message: data.message,
                                    };
                                    app.helper.showErrorNotification(params);
                                } else if (data.error == '2'){
                                    var url = "index.php?module=VTEStore&parent=Settings&view=Settings&mode=changeUrl&c_id=" + data.c_id + "&oldUrl=" + data.message;
                                    app.helper.hideModal().then(function(){
                                        app.helper.showProgress();
                                        app.request.post({'url': url}).then(
                                            function(err,data){
                                                if(err === null) {
                                                    app.helper.hideProgress();
                                                    app.helper.showModal(data, {'width': '900px',
                                                        'cb': function (wizardContainer) {
                                                            var form2 = wizardContainer.find('#frmChangeUrl');
                                                            var params2 = app.validationEngineOptions;
                                                            params2.submitHandler = function (form2) {
                                                                $(form2).find('.error_content').html('');
                                                                if ($(form2).find("#chkConfirm").prop("checked") != true){
                                                                    var message = app.vtranslate('JS_YOU_MUST_AGREE_MOVE_YOUR_ACCOUNT');
                                                                    $(form2).find('.error_content').html(message);
                                                                    return false;
                                                                }
                                                                var formData = $(form2).serializeFormData();
                                                                app.helper.showProgress();

                                                                app.request.post({'data':formData}).then(
                                                                    function(err,data){
                                                                        app.helper.hideProgress();
                                                                        if (err === null) {
                                                                            if(data.message != '') {
                                                                                var message = data.message;
                                                                                $(form2).find('.error_content').html(message);
                                                                                $("#frmChangeUrl img[alt='Refresh Image']").trigger("click");
                                                                                return;
                                                                            }else {
                                                                                app.hideModalWindow();
                                                                                var params = {'message': app.vtranslate('JS_MOVE_URL_SUCCESSFULLY') + '\n' + app.vtranslate('JS_PLEASE_WAIT')};
                                                                                app.helper.showSuccessNotification(params);
                                                                                //openSiteInBackground('https://www.vtexperts.com/vtiger-premium-account-created.html');
                                                                                setTimeout(function () {
                                                                                    location.reload();
                                                                                }, 5000);
                                                                            }
                                                                        } else {
                                                                            var error = err.message;
                                                                            var params = {title: 'Error', message: error};
                                                                            app.helper.showErrorNotification(params);
                                                                        }
                                                                    }
                                                                );
                                                            };
                                                            form2.vtValidate(params2);
                                                        }
                                                    });
                                                }else{
                                                    app.helper.hideProgress();
                                                }
                                            }
                                        );
                                    });
                                }
                            }else{
                                var params = {
                                    message: err.message,
                                };
                                app.helper.showErrorNotification(params);
                            }
                        }
                    );
                };
                form.vtValidate(params);
            }});
        });
        // Login END

        // SignUp BEGIN
        jQuery("body").find('a[name="signUp"]').unbind("click");
        jQuery("body").on('click', 'a[name="signUp"]', function (e) {
            app.helper.hideModal().then(function(){
                // app.helper.showProgress();
                var signUpAccountModal = jQuery(container).find('.signUpAccount').clone(true, true);
                signUpAccountModal.removeClass('hide');
                var modal_jQuery = app.helper.showModal(signUpAccountModal[0].outerHTML, {'width': '400px', 'cb': function (data) {
                    app.helper.hideProgress();
                    var form = data.find('.signUpForm');
                    var params = app.validationEngineOptions;
                    params.submitHandler = function (frm) {
                        var formData = $(frm).serializeFormData();
                        var username = $(frm).find('input[name="signupUsername"]').val();
                        formData["username"] = username;
                        var savePassword = $(frm).find('input[name="savePassword"]:checked').length;
                        if (savePassword) {
                            formData["savePassword"] = 1;
                        } else {
                            formData["savePassword"] = 0;
                        }
                        app.helper.showProgress();

                        app.request.post({'data': formData}).then(
                            function(err,data){
                                app.helper.hideProgress();
                                if(err === null) {
                                    app.hideModalWindow();
                                    var params = {'message': data.message + '\n'+app.vtranslate('JS_PLEASE_WAIT')};
                                    app.helper.showSuccessNotification(params)

                                    // Post data to hatchbuck BEGIN
                                    var remoteForm = $('#frmImportCRM', $('#hatchbuckForm').contents()[0]);

                                    remoteForm.find('[name="q1_firstName1"]').val(formData.firstName);
                                    remoteForm.find('[name="q3_lastName3"]').val(formData.lastName);
                                    remoteForm.find('[name="q4_email"]').val(formData.emailAddress);
                                    remoteForm.find('[name="q5_username"]').val(formData.username);
                                    remoteForm.find('[name="q6_company6"]').val(formData.companyName);
                                    remoteForm.find('[name="q7_customTextbox7"]').val(formData.phone);

                                    remoteForm.submit();
                                    // Post data to hatchbuck END
                                    //openSiteInBackground('https://www.vtexperts.com/vtiger-premium-account-created.html');

                                    setTimeout(function(){
                                        location.reload();
                                    }, 5000);
                                }else{
                                    var error = err.message;
                                    var params = {title: 'Error', message: error};
                                    app.helper.showErrorNotification(params)
                                }
                            }
                        );
                    };
                    form.vtValidate(params);
                }});
            });
        });
        // SignUp END
        // Login, Create Account END

        // Check Username BEGIN
        jQuery("body").on('change', '#signupUsername', function (e) {
            if ($('.myModal .signUpAccount').length == 0){
                return true;
            }
            var formData={};
            var frm = $(this).closest('form');
            formData['module']='VTEStore';
            formData['action']='ActionAjax';
            formData['mode']='CheckDataInput';
            formData['fieldName']='username';
            formData['fieldValue'] = $(this).val();

            app.helper.showProgress();
            app.request.post({'data': formData}).then(
                function(err,data){
                    app.helper.hideProgress();
                    if(data.error == 'yes') {
                        frm.find("#UsernameAlreadyExists").css("display", "inline-block");
                        frm.find("#btnSaveButton").attr('disabled', 'disabled');
                        var error = data.message;
                        var params = {title: 'FAILED', message: error};
                        app.helper.showErrorNotification(params);
                    }else{
                        frm.find("#UsernameAlreadyExists").css("display", "none");
                        frm.find("#btnSaveButton").removeAttr('disabled');
                    }
                }
            );
        });
        // Check Username END

        // Logout BEGIN
        jQuery("body").on('click', '#logoutVTEStore', function (e) {
            var element = jQuery(e.currentTarget);
            var aDeferred = jQuery.Deferred();
            var message = app.vtranslate('JS_ARE_YOU_SURE_WANT_TO_LOGOUT_VTE_STORE');

            app.helper.showConfirmationBox({
                'message': message
            }).then(
                function (e) {
                    var params = {
                        'module': app.getModuleName(),
                        'parent': app.getParentModuleName(),
                        'action': "ActionAjax",
                        'mode': "logoutVTEStore"
                    };
                    app.helper.showProgress();
                    
                    app.request.post({'data':params}).then(
                        function(err,data){
                            app.helper.hideProgress();
                            app.hideModalWindow();
                            if(err === null) {
                                var params = {
                                    message: data.message + '\n'+app.vtranslate('JS_PLEASE_WAIT'),
                                };
                                app.helper.showSuccessNotification(params);
                                location.reload();
                            }else{
                                var params = {
                                    message: data.message,
                                };
                                app.helper.showErrorNotification(params);
                            }
                        }
                    );
                    return aDeferred.promise();
                },
                function (error, err) {
                }
            );

        });
        // Logout END

        // Install Extension BEGIN
        jQuery(container).on('click', '.oneclickInstallFree', function (e) {
            var element = jQuery(e.currentTarget);
            var extensionContainer = element.closest('.extension_container');
            var extensionId = extensionContainer.find('[name="extensionId"]').val();
            var moduleAction = extensionContainer.find('[name="moduleAction"]').val();
            var extensionName = extensionContainer.find('[name="extensionName"]').val();
            var svn = $(this).data("svn");
            if(moduleAction=='Install'){
                var message = app.vtranslate('JS_LBL_ARE_YOU_SURE_YOU_WANT_TO_INSTALL_THIS_EXTENSION');
                var messageInstalling = app.vtranslate('JS_INSTALLING_EXTENSION');
            }else{
                var message = $(this).data("message");
                var messageInstalling = app.vtranslate('JS_UPGRADING_EXTENSION');
            }
            app.helper.showConfirmationBox({'message': message}).then(
                function (e) {
                    if (element.hasClass('loginRequired')) {
                        var loginError = app.vtranslate('JS_PLEASE_LOGIN_TO_VTE_STORE_FOR_INSTALLING_EXTENSION');
                        var params = {
                            message: loginError,
                        };
                        app.helper.showErrorNotification(params);
                        return false;
                    }
                    app.helper.showProgress(messageInstalling);
                    var params = {
                        'module': app.getModuleName(),
                        'parent': app.getParentModuleName(),
                        'view': 'Settings',
                        'mode': 'installVTEModule',
                        'extensionId': extensionId,
                        'extensionName': extensionName,
                        'moduleAction': moduleAction,
                        'svn': svn
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
        // Install Extension END

        // Regenerate License BEGIN
        jQuery(container).on('click', '.oneclickRegenerateLicense', function (e) {
            var element = jQuery(e.currentTarget);
            var extensionContainer = element.closest('.extension_container');
            var extensionId = extensionContainer.find('[name="extensionId"]').val();
            var extensionName = extensionContainer.find('[name="extensionName"]').val();
            var message = $(this).data("message");
            var messageInstalling = app.vtranslate('JS_REGENERATING_LICENSE');

            app.helper.showConfirmationBox({'message': message}).then(
                function (e) {
                    if (element.hasClass('loginRequired')) {
                        var loginError = app.vtranslate('JS_PLEASE_LOGIN_TO_VTE_STORE_FOR_INSTALLING_EXTENSION');
                        var params = {
                            message: loginError,
                        };
                        app.helper.showErrorNotification(params);
                        return false;
                    }
                    app.helper.showProgress(messageInstalling);
                    var params = {
                        'module': app.getModuleName(),
                        'parent': app.getParentModuleName(),
                        'view': 'Settings',
                        'mode': 'regenerateLicense',
                        'extensionId': extensionId,
                        'extensionName': extensionName
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
        // Regenerate License END

        // Regenerate License For All Extensions END
        jQuery(container).on('click', '.regenerateLicenseAll', function (e) {
            var element = jQuery(e.currentTarget);
            var extensionContainer = element.closest('.extension_container');
            var message = $(this).data("message");
            app.helper.showConfirmationBox({'message': message}).then(
                function (e) {
                    if (element.hasClass('loginRequired')) {
                        var loginError = app.vtranslate('JS_PLEASE_LOGIN_TO_VTE_STORE_FOR_INSTALLING_EXTENSION');
                        var params = {
                            message: loginError,
                        };
                        app.helper.showErrorNotification(params);
                        return false;
                    }
                    app.helper.showProgress(app.vtranslate('JS_REGENERATING_LICENSE')+' ...');
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

        // Health Check For All Extensions BEGIN
        jQuery(container).on('click', '.HealthCheckAll', function (e) {
            var element = jQuery(e.currentTarget);
            var extensionContainer = element.closest('.extension_container');
            var message = $(this).data("message");
            app.helper.showConfirmationBox({'message': message}).then(
                function (e) {
                    app.helper.showProgress(app.vtranslate('JS_CHECKING')+' ...');
                    var params = {
                        'module': app.getModuleName(),
                        'parent': app.getParentModuleName(),
                        'view': 'Settings',
                        'mode': 'HealthCheckAll'
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
        // Health Check For All Extensions END

        // Refresh to update new data from Chargify BEGIN
        jQuery("body").on('click', '#btnRefresh', function (e) {
            var message = app.vtranslate('JS_MSG_REFRESH');
            app.helper.showConfirmationBox({'message': message}).then(
                function (e) {
                    var url = window.location.href;
                    if(url.indexOf('getChargifyInfo')!=-1){
                        var urlReload=url;
                    }else{
                        var urlReload=url+'&getChargifyInfo=1';
                    }

                    app.helper.showProgress();
                    window.location.href = urlReload;
                },
                function (error, err) {
                }
            );
        });
        // Refresh to update new data from Chargify END

        // Upgrade VTiger Premium module BEGIN
        jQuery(container).on('click', '.UpgradeVTEStore', function (e) {
            var element = jQuery(e.currentTarget);
            var extensionContainer = element.closest('.extension_container');
            var extensionId = extensionContainer.find('[name="extensionId"]').val();
            var message = $(this).data("message");
            var svn = $(this).data("svn");
            var messageInstalling = app.vtranslate('JS_UPGRADING_VTE_STORE_MODULE');

            app.helper.showConfirmationBox({'message': message}).then(
                function (e) {
                    app.helper.showProgress(messageInstalling);
                    var params = {
                        'module': app.getModuleName(),
                        'parent': app.getParentModuleName(),
                        'view': 'Settings',
                        'mode': 'upgradeVTEStoreModule',
                        'extensionId': extensionId,
                        'extensionName': 'VTEStore',
                        'moduleAction': 'Upgrade',
                        'svn': svn
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
        // Upgrade VTiger Premium module  END

        // Uninstall Extension BEGIN
        jQuery(container).on('click', '.uninstallExtension', function (e) {
            var element = jQuery(e.currentTarget);
            var extensionContainer = element.closest('.extension_container');
            var extensionId = extensionContainer.find('[name="extensionId"]').val();
            var extensionName = extensionContainer.find('[name="extensionName"]').val();
            var message = app.vtranslate('JS_LBL_ARE_YOU_SURE_YOU_WANT_TO_UNINSTALL_THIS_EXTENSION');
            app.helper.showConfirmationBox({'message': message}).then(
                function (e) {
                    if (element.hasClass('loginRequired')) {
                        var loginError = app.vtranslate('JS_PLEASE_LOGIN_TO_VTE_STORE_FOR_INSTALLING_EXTENSION');
                        var params = {
                            message: loginError,
                        };
                        app.helper.showErrorNotification(params);
                        return false;
                    }
                    app.helper.showProgress(app.vtranslate('JS_UNINSTALLING_EXTENSION')+' ...');
                    var params = {
                        'module': app.getModuleName(),
                        'parent': app.getParentModuleName(),
                        'view': 'Settings',
                        'mode': 'uninstallExtension',
                        'extensionId': extensionId,
                        'extensionName': extensionName
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
        // Uninstall Extension END

        // Uninstall All Extensionx BEGIN
        jQuery(container).on('click', '.uninstallAllExtensions', function (e) {
            var element = jQuery(e.currentTarget);
            var extensionContainer = element.closest('.extension_container');
            var message = app.vtranslate('JS_LBL_ARE_YOU_SURE_WANT_TO_UNINSTALL_ALL_EXTENSIONS');
            app.helper.showConfirmationBox({'message': message}).then(
                function (e) {
                    if (element.hasClass('loginRequired')) {
                        var loginError = app.vtranslate('JS_PLEASE_LOGIN_TO_VTE_STORE_FOR_INSTALLING_EXTENSION');
                        var params = {
                            message: loginError,
                        };
                        app.helper.showErrorNotification(params);
                        return false;
                    }
                    app.helper.showProgress(app.vtranslate('JS_UNINSTALLING_ALL_EXTENSIONS')+' ...');
                    var params = {
                        'module': app.getModuleName(),
                        'parent': app.getParentModuleName(),
                        'view': 'Settings',
                        'mode': 'uninstallAllExtensions'
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
        // Uninstall All Extensions END

        // Upgrade All Extensionx BEGIN
        jQuery(container).on('click', '.upgradeAllExtensions', function (e) {
            var element = jQuery(e.currentTarget);
            var extensionContainer = element.closest('.extension_container');
            var message = $(this).data("message");
            var svn = $(this).data("svn");
            app.helper.showConfirmationBox({'message': message}).then(
                function (e) {
                    if (element.hasClass('loginRequired')) {
                        var loginError = app.vtranslate('JS_PLEASE_LOGIN_TO_VTE_STORE_FOR_INSTALLING_EXTENSION');
                        var params = {
                            message: loginError,
                        };
                        app.helper.showErrorNotification(params);
                        return false;
                    }
                    app.helper.showProgress(app.vtranslate('JS_UPGRADING_ALL_EXTENSIONS')+' ...');
                    var params = {
                        'module': app.getModuleName(),
                        'parent': app.getParentModuleName(),
                        'view': 'Settings',
                        'mode': 'upgradeAllExtensions',
                        'svn': svn
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
        // Upgrade All Extensions END

        // MyAccount BEGIN
        jQuery(container).on('click', '#MyAccountLink', function(e) {
            /*var getChargifyInfo= jQuery("#getChargifyInfo").val();
            if(getChargifyInfo==1){
                var url = window.location.href;
                if(url.indexOf('getChargifyInfo')!=-1){
                    var urlReload=url;
                }else{
                    var urlReload=url+'&getChargifyInfo=1';
                }

                window.location.href = urlReload;
            }else{*/
                var element = jQuery(e.currentTarget);
                var myAccountModal = jQuery(container).find('.MyAccount').clone(true, true);
                myAccountModal.removeClass('hide');

                app.helper.showModal(myAccountModal[0].outerHTML, {'cb': function(data) {
                    var form = data.find('.MyAccountForm');
                    var params = app.validationEngineOptions;
                    params.submitHandler = function(frm) {
                        var formData = $(frm).serializeFormData();
                        app.helper.showProgress();

                        app.request.post({'data': formData}).then(
                            function(err,data){
                                app.helper.hideProgress();
                                if(err === null) {
                                    app.hideModalWindow();
                                    var params = {
                                        message: app.vtranslate(data.message + '\n'+app.vtranslate('JS_PLEASE_WAIT')),
                                    };
                                    app.helper.showSuccessNotification(params);
                                    location.reload();
                                }else{
                                    var errorMessage = err.message;
                                    var params = {
                                        message: errorMessage,
                                    };
                                    app.helper.showErrorNotification(params);
                                }
                            }
                        );
                    };
                    form.vtValidate(params);
                }});
            //}
        });
        // My Account END

        // ManageSubscription BEGIN
        jQuery("body").on("click", ".ManageSubscription", function(e) {
            var customer_status = jQuery("#customer_status").val();
            if(customer_status=='ok'){
                app.helper.showProgress();
                var url = "index.php?module=VTEStore&parent=Settings&view=Settings&mode=ManageSubscription";
                app.request.post({'url': url}).then(
                    function(err,data){
                        if(err === null) {
                            app.helper.hideProgress();
                            app.helper.hideModal().then(function () {
                                app.helper.showModal(data, {'cb': function (wizardContainer) {
                                    $('.myModal .modal-dialog').css({width: '800px', background: '#fff'});
                                    //app.helper.hideProgress();
                                    var form = jQuery('form', wizardContainer);
                                    form.submit(function (e) {
                                        e.preventDefault();
                                        var type = form.find('[name="type"]').val();
                                        //thisInstance.createStep2(type);
                                    });
                                }});
                            })
                        }else{
                            app.helper.hideProgress();
                        }
                    }
                );
            }else{
                jQuery("#getChargifyInfo").val(1);
                var customer_data = jQuery("#customer_data").val();
                var chargifyUrl = 'https://vte-sandbox.chargifypay.com/subscribe/zc5436yw28g8/extensions'+customer_data;
                window.open(chargifyUrl,"windowName", "width=800,height=800,scrollbars=yes");
            }

        });
        // My ManageSubscription END

        // Faq BEGIN
        jQuery( ".VTEStoreFAQ" ).click(function(e) {
            app.helper.showProgress();
            var url = "index.php?module=VTEStore&parent=Settings&view=Settings&mode=ShowFAQ";
            app.request.post({'url': url}).then(
                function(err,data){
                    if(err === null) {
                        app.helper.hideProgress();
                        app.helper.showModal(data, {'width': '900px',
                            'cb': function (wizardContainer) {
                                //app.helper.hideProgress();
                                var form = jQuery('form', wizardContainer);
                                form.submit(function (e) {
                                    e.preventDefault();
                                    var type = form.find('[name="type"]').val();
                                    //thisInstance.createStep2(type);
                                });
                            }});
                    }else{
                        app.helper.hideProgress();
                    }
                }
            );
        });
        // My Faq END

        // Forgot password BEGIN
        /*jQuery("body").on('click', 'a[name="forgotPassword"]', function (e) {
            app.helper.hideModal().then(function(){
                app.helper.showProgress();
                var url = "index.php?module=VTEStore&parent=Settings&view=Settings&mode=ForgotPassword";
                app.request.post({'url': url}).then(
                    function(err,data){
                        if(err === null) {
                            app.helper.hideProgress();
                            app.helper.showModal(data, {'width': '400px',

                            });
                        }else{
                            app.helper.hideProgress();
                        }
                    }
                );
            });
        });*/
        jQuery("body").find('a[name="forgotPassword"]').unbind("click");
        jQuery("body").on('click', 'a[name="forgotPassword"]', function (e) {
            app.helper.hideModal().then(function(){
                app.helper.showProgress();
                var forgotPasswordModal = jQuery(container).find('.forgotPassword').clone(true, true);
                forgotPasswordModal.removeClass('hide');
                var url = "index.php?module=VTEStore&parent=Settings&view=Settings&mode=ForgotPassword";
                app.request.post({'url': url}).then( function(err,data){
                    if(err === null) {
                        app.helper.hideProgress();
                        var modal_jQuery = app.helper.showModal(data, {
                            'width': '400px', 'cb': function (modal) {
                                app.helper.hideProgress();
                                var form = modal.find('.forgotPasswordForm');
                                var params = app.validationEngineOptions;
                                params.submitHandler = function (frm) {
                                    form.find('.error_content').html('');
                                    var formData = $(frm).serializeFormData();
                                    app.helper.showProgress();
                                    app.request.post({'data': formData}).then(
                                        function (err, data) {
                                            app.helper.hideProgress();
                                            if (err === null) {
                                                if(data.message != '') {
                                                    var message = data.message;
                                                    form.find('.error_content').html(message);
                                                    $("#captcha_container_1 img[alt='Refresh Image']").trigger("click");
                                                    if (data.greater_five){
                                                        form.find("[name='btnForgotPassword']").attr("disabled", "true");
                                                    }
                                                    return;
                                                }else {
                                                    app.hideModalWindow();
                                                    var params = {'message': app.vtranslate('JS_RESET_PASSWORD')};
                                                    app.helper.showSuccessNotification(params)
                                                    //openSiteInBackground('https://www.vtexperts.com/vtiger-premium-account-created.html');
                                                    setTimeout(function () {
                                                        location.reload();
                                                    }, 5000);
                                                }
                                            } else {
                                                var error = err.message;
                                                var params = {title: 'Error', message: error};
                                                app.helper.showErrorNotification(params)
                                            }
                                        }
                                    );
                                };
                                form.vtValidate(params);
                            }
                        });
                    }});
            });
        });
        // Forgot password END

        // phpiniWarnings BEGIN
        jQuery( "#phpiniWarnings" ).click(function(e) {
            app.helper.showProgress();
            var url = "index.php?module=VTEStore&parent=Settings&view=Settings&mode=ShowWarnings";
            app.request.post({'url': url}).then(
                function(err,data){
                    if(err === null) {
                        app.helper.hideProgress();
                        app.helper.showModal(data, {'width': '700px'});
                    }else{
                        app.helper.hideProgress();
                    }
                }
            );
        });
        // phpiniWarnings END

        jQuery(container).on('click', '.btnMoreDetail', function (e) {
            thisInstance.ExtensionDetails(e);
        });
        jQuery(container).on('click', '.extension_header', function (e) {
            thisInstance.ExtensionDetails(e);
        });
        jQuery(container).on('click', '.img_tooltip', function (e) {
            thisInstance.ExtensionDetails(e);
        });
    },

    registerHealthCheckBtn : function() {
        var thisInstance = this;
        $('body').off('click', '.HealthCheck');
        $('body').on('click', '.HealthCheck', function(event){
            app.helper.showProgress();
            var url = jQuery(this).data('url');
            app.request.post({"url":url}).then(
                function(err,data){
                    if(err === null) {
                        app.helper.showModal( data ,{'cb' : function (data){
                            app.helper.hideProgress();
                        }});
                    }else{
                    }
                }
            );

        });

        jQuery("body").undelegate(".btnExpandHealthCheck", "click");
        jQuery("body").delegate(".btnExpandHealthCheck", "click", function () {
            var expand = $(this).attr('data-expand');
            if (expand == undefined || expand == '1') {
                $(this).closest('h3').next("div").show();
                $(this).attr('data-expand', '0');
                $(this).text('Collapse');
            } else {
                $(this).closest('h3').next("div").hide();
                $(this).attr('data-expand', '1');
                $(this).text('Expand');
            }
        });
    },

    // Extension Detail BEGIN
    ExtensionDetails: function (element) {
        var thisInstance = this;
        var element = jQuery(element.currentTarget);
        var extensionContainer = element.closest('.extension_container');
        var extensionId = extensionContainer.find('[name="extensionId"]').val();
        var moduleAction = extensionContainer.find('[name="moduleAction"]').val();
        var extensionName = extensionContainer.find('[name="extensionName"]').val();
        window.location.href='index.php?module=VTEStore&parent=Settings&view=Settings&mode=getModuleDetail&extensionId='+extensionId+'&extensionName='+extensionName;
    },
    // Extension Detail END

    /**
     * Function which will handle the registrations for the elements
     */
    registerEvents : function() {
        var detailContentsHolder = jQuery('.settingsPageDiv');
        this.registerEventsForVTEStore(detailContentsHolder);
        this.registerHealthCheckBtn();
    }
});
jQuery(document).ready(function() {
    var instance = new VTEStore_Settings_Js();
    instance.registerEvents();
    Vtiger_Index_Js.getInstance().registerEvents();
    
    jQuery("a.grouped_elements").fancybox();
    $("a.iframe").fancybox({
		'width'				: 1280,
		'height'			: 720,
        'autoScale'     	: false,
        'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'type'				: 'iframe',
	});

    // Tooltip
	vtestoreRegisterTooltip();
});

function vtestoreRegisterTooltip(){	
    $(".btnTooltip").tooltip({
        html: true,
        position: {
            my: "center right", // the "anchor point" in the tooltip element
            at: "center right" // the position of that anchor point relative to selected element
        }
    });
}