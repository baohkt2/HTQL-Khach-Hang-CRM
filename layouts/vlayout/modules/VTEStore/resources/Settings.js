/* ********************************************************************************
 * The content of this file is subject to the VTiger Premium ("License");
 * You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is VTExperts.com
 * Portions created by VTExperts.com. are Copyright(C) VTExperts.com.
 * All Rights Reserved.
 * ****************************************************************************** */

jQuery.Class("VTEStore_Settings_Js",{
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
        jQuery(container).on('click', '#btnSearchExtension', function (e) {
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

            var progressIndicatorElement = jQuery.progressIndicator({
                'position': 'html','blockInfo': {'enabled': true}
            });
            AppConnector.request(params).then(
                function (data) {
                    jQuery('#extensionContainer').html(data);
                    progressIndicatorElement.progressIndicator({'mode': 'hide'});
                    var search_key =jQuery('#search_key').val();
                    var searchmode =jQuery('#searchmode').val();
                    if(searchmode==1){
                        jQuery('#reset_search_value').html(app.vtranslate('JS_FILTER')+': '+search_key+' <u><a href="index.php?module=VTEStore&parent=Settings&view=Settings&reset=1">('+app.vtranslate('JS_CLICK_TO_RESET_THE_SEARCH')+')</a></u>');
                    }
                },
                function (error) {
                    progressIndicatorElement.progressIndicator({'mode': 'hide'});
                }
            );
        });
        // Search Extension END

        // Login, Create Account BEGIN
        jQuery(container).on('click', '#logintoVTEStore', function (e) {
            var loginAccountModal = jQuery(container).find('.loginAccount').clone(true, true);
            loginAccountModal.removeClass('hide');
            var progressIndicatorElement = jQuery.progressIndicator();

            var callBackFunction = function (data) {
                jQuery(data).on('click', '[name="signUp"]', function (e) {
                    app.hideModalWindow();
                    var signUpAccountModal = jQuery(container).find('.signUpAccount').clone(true, true);
                    signUpAccountModal.removeClass('hide');

                    var callBackSignupFunction = function (data) {
                        var form = data.find('.signUpForm');
                        var params = app.getvalidationEngineOptions(true);
                        params.onValidationComplete = function (form, valid) {
                            if (valid) {
                                var formData = form.serializeFormData();
                                var savePassword = form.find('input[name="savePassword"]:checked').length;
                                if (savePassword) {
                                    formData["savePassword"] = 1;
                                } else {
                                    formData["savePassword"] = 0;
                                }
                                var progressIndicatorElement = jQuery.progressIndicator();

                                AppConnector.request(formData).then(
                                    function (data) {
                                        if (data.success) {
                                            progressIndicatorElement.progressIndicator({'mode': 'hide'});
                                            app.hideModalWindow();
                                            var params = {type: 'success', text: data.result.message + '\n'+app.vtranslate('JS_PLEASE_WAIT')};
                                            Settings_Vtiger_Index_Js.showMessage(params);

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
                                        } else {
                                            progressIndicatorElement.progressIndicator({'mode': 'hide'});
                                            app.hideModalWindow();
                                            var error = data['error']['message'];
                                            var params = {text: error, type: 'error'};
                                            Settings_Vtiger_Index_Js.showMessage(params);
                                        }
                                    }
                                );
                            }
                            return false;
                        };
                        form.validationEngine(params);
                    };
                    app.showModalWindow(signUpAccountModal, function (data) {
                        if (typeof callBackFunction == 'function') {
                            callBackSignupFunction(data);
                        }
                    }, {'width': '1000px'});
                });
                var form = data.find('.loginForm');
                var params = app.getvalidationEngineOptions(true);
                params.onValidationComplete = function (form, valid) {
                    if (valid) {
                        var formData = form.serializeFormData();
                        var savePassword = form.find('input[name="savePassword"]:checked').length;
                        if (savePassword) {
                            formData["savePassword"] = 1;
                        } else {
                            formData["savePassword"] = 0;
                        }
                        var progressIndicatorElement = jQuery.progressIndicator();
                        AppConnector.request(formData).then(
                            function (data) {
                                progressIndicatorElement.progressIndicator({'mode': 'hide'});
                                app.hideModalWindow();
                                if (data.success) {
                                    if (data.result.error == '0'){
                                        var params = {
                                            message: data.result.message + '\n'+app.vtranslate('JS_PLEASE_WAIT'),
                                        };
                                        var params = {type: 'success', text: data.result.message + '\n'+app.vtranslate('JS_PLEASE_WAIT')};
                                        Settings_Vtiger_Index_Js.showMessage(params);
                                        location.reload();
                                    } else if (data.result.error == '1' || data.result.error == '3'){
                                        var params = {type: 'error', text: data.result.message};
                                        Settings_Vtiger_Index_Js.showMessage(params);
                                    } else if (data.result.error == '2'){
                                        thisInstance.changeNewUrl(data.result.c_id, data.result.message);
                                    }
                                } else {
                                    var params = {type: 'error', text: data.error.message};
                                    Settings_Vtiger_Index_Js.showMessage(params);
                                }
                            }
                        );
                    }
                    return false;
                };
                form.validationEngine(params);
            }
            app.showModalWindow(loginAccountModal, function (data) {
                progressIndicatorElement.progressIndicator({'mode': 'hide'});
                if (typeof callBackFunction == 'function') {
                    callBackFunction(data);
                }
            }, {'width': '1000px'});

        });
        // Login, Create Account END

        // Logout BEGIN
        jQuery(container).on('click', '#logoutVTEStore', function (e) {
            var element = jQuery(e.currentTarget);
            var aDeferred = jQuery.Deferred();
            var message = app.vtranslate('JS_ARE_YOU_SURE_WANT_TO_LOGOUT_VTE_STORE');

            Vtiger_Helper_Js.showConfirmationBox({
                'message': message
            }).then(
                function (e) {
                    var params = {
                        'module': app.getModuleName(),
                        'parent': app.getParentModuleName(),
                        'action': "ActionAjax",
                        'mode': "logoutVTEStore"
                    };
                    var progressIndicatorElement = jQuery.progressIndicator({
                        'position': 'html','blockInfo': {'enabled': true}
                    });

                    AppConnector.request(params).then(
                        function (data) {
                            progressIndicatorElement.progressIndicator({'mode': 'hide'});
                            app.hideModalWindow();
                            if (data.success) {
                                var params = {type: 'success', text: data.result.message + '\n'+app.vtranslate('JS_PLEASE_WAIT')};
                                Settings_Vtiger_Index_Js.showMessage(params);
                                location.reload();
                            } else {
                                var params = {type: 'error', text: data.error.message};
                                Settings_Vtiger_Index_Js.showMessage(params);
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
            if(moduleAction=='Install'){
                var message = app.vtranslate('JS_LBL_ARE_YOU_SURE_YOU_WANT_TO_INSTALL_THIS_EXTENSION');
                var messageInstalling = app.vtranslate('JS_INSTALLING_EXTENSION');
            }else{
                var message = $(this).data("message");
                var messageInstalling = app.vtranslate('JS_UPGRADING_EXTENSION');
            }
            var svn = $(this).data("svn");
            Vtiger_Helper_Js.showConfirmationBox({'message': message}).then(
                function (e) {
                    if (element.hasClass('loginRequired')) {
                        var loginError = app.vtranslate('JS_PLEASE_LOGIN_TO_VTE_STORE_FOR_INSTALLING_EXTENSION');
                        var loginErrorParam = {text: loginError,'type': 'error'};
                        Settings_Vtiger_Index_Js.showMessage(loginErrorParam);
                        return false;
                    }
                    var progressIndicatorElement = jQuery.progressIndicator({
                        'position': 'html',
                        'blockInfo': {
                            'enabled': true
                        },
                        'message': messageInstalling
                    });
                    var params = {
                        'module': app.getModuleName(),
                        'parent': app.getParentModuleName(),
                        'view': 'Settings',
                        'mode': 'installVTEModule',
                        'extensionId': extensionId,
                        'extensionName': extensionName,
                        'moduleAction': moduleAction,
                        'svn': svn,
                    };

                    AppConnector.request(params).then(
                        function (data) {
                            progressIndicatorElement.progressIndicator({'mode': 'hide'});
                            var modalData = {
                                data: data,
                                css: {'width': '50%', 'height': 'auto'}
                            };
                            app.showModalWindow(modalData);
                        },
                        function (error) {
                            progressIndicatorElement.progressIndicator({'mode': 'hide'});
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

            Vtiger_Helper_Js.showConfirmationBox({'message': message}).then(
                function (e) {
                    if (element.hasClass('loginRequired')) {
                        var loginError = app.vtranslate('JS_PLEASE_LOGIN_TO_VTE_STORE_FOR_INSTALLING_EXTENSION');
                        var loginErrorParam = {text: loginError,'type': 'error'};
                        Settings_Vtiger_Index_Js.showMessage(loginErrorParam);
                        return false;
                    }
                    var progressIndicatorElement = jQuery.progressIndicator({
                        'position': 'html',
                        'blockInfo': {
                            'enabled': true
                        },
                        'message': messageInstalling
                    });
                    var params = {
                        'module': app.getModuleName(),
                        'parent': app.getParentModuleName(),
                        'view': 'Settings',
                        'mode': 'regenerateLicense',
                        'extensionId': extensionId,
                        'extensionName': extensionName
                    };

                    AppConnector.request(params).then(
                        function (data) {
                            progressIndicatorElement.progressIndicator({'mode': 'hide'});
                            var modalData = {
                                data: data,
                                css: {'width': '50%', 'height': 'auto'}
                            };
                            app.showModalWindow(modalData);
                        },
                        function (error) {
                            progressIndicatorElement.progressIndicator({'mode': 'hide'});
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
            Vtiger_Helper_Js.showConfirmationBox({'message': message}).then(
                function (e) {
                    if (element.hasClass('loginRequired')) {
                        var loginError = app.vtranslate('JS_PLEASE_LOGIN_TO_VTE_STORE_FOR_INSTALLING_EXTENSION');
                        var loginErrorParam = {text: loginError,'type': 'error'};
                        Settings_Vtiger_Index_Js.showMessage(loginErrorParam);
                        return false;
                    }
                    var progressIndicatorElement = jQuery.progressIndicator({
                        'position': 'html',
                        'blockInfo': {
                            'enabled': true
                        },
                        'message': app.vtranslate('JS_REGENERATING_LICENSE')+' ...'
                    });
                    var params = {
                        'module': app.getModuleName(),
                        'parent': app.getParentModuleName(),
                        'view': 'Settings',
                        'mode': 'regenerateLicenseAll'
                    };

                    AppConnector.request(params).then(
                        function (data) {
                            progressIndicatorElement.progressIndicator({'mode': 'hide'});
                            var modalData = {
                                data: data,
                                css: {'width': '50%', 'height': 'auto'}
                            };
                            app.showModalWindow(modalData);
                        },
                        function (error) {
                            progressIndicatorElement.progressIndicator({'mode': 'hide'});
                        }
                    );
                },
                function (error, err) {
                }
            );
        });
        // Regenerate License For All Extensions END

        // Refresh to update new data from Chargify BEGIN
        jQuery('body').delegate('#btnRefresh', 'click', function (e) {
            var message = app.vtranslate('JS_MSG_REFRESH');
            Vtiger_Helper_Js.showConfirmationBox({'message': message}).then(
                function (e) {
                    var url = window.location.href;
                    if(url.indexOf('getChargifyInfo')!=-1){
                        var urlReload=url;
                    }else{
                        var urlReload=url+'&getChargifyInfo=1';
                    }

                    var progressIndicatorElement = jQuery.progressIndicator();
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
            var svn = $(this).data("svn");
            var message = $(this).data("message");
            var messageInstalling = app.vtranslate('JS_UPGRADING_VTE_STORE_MODULE');

            Vtiger_Helper_Js.showConfirmationBox({'message': message}).then(
                function (e) {
                    var progressIndicatorElement = jQuery.progressIndicator({
                        'position': 'html',
                        'blockInfo': {
                            'enabled': true
                        },
                        'message': messageInstalling
                    });
                    var params = {
                        'module': app.getModuleName(),
                        'parent': app.getParentModuleName(),
                        'view': 'Settings',
                        'mode': 'upgradeVTEStoreModule',
                        'extensionId': extensionId,
                        'extensionName': 'VTEStore',
                        'moduleAction': 'Upgrade',
                        'svn': svn,
                    };

                    AppConnector.request(params).then(
                        function (data) {
                            progressIndicatorElement.progressIndicator({'mode': 'hide'});
                            var modalData = {
                                data: data,
                                css: {'width': '50%', 'height': 'auto'}
                            };
                            app.showModalWindow(modalData);
                        },
                        function (error) {
                            progressIndicatorElement.progressIndicator({'mode': 'hide'});
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
            Vtiger_Helper_Js.showConfirmationBox({'message': message}).then(
                function (e) {
                    if (element.hasClass('loginRequired')) {
                        var loginError = app.vtranslate('JS_PLEASE_LOGIN_TO_VTE_STORE_FOR_INSTALLING_EXTENSION');
                        var loginErrorParam = {text: loginError,'type': 'error'};
                        Settings_Vtiger_Index_Js.showMessage(loginErrorParam);
                        return false;
                    }
                    var progressIndicatorElement = jQuery.progressIndicator({
                        'position': 'html',
                        'blockInfo': {
                            'enabled': true
                        },
                        'message': app.vtranslate('JS_UNINSTALLING_EXTENSION')+' ...'
                    });
                    var params = {
                        'module': app.getModuleName(),
                        'parent': app.getParentModuleName(),
                        'view': 'Settings',
                        'mode': 'uninstallExtension',
                        'extensionId': extensionId,
                        'extensionName': extensionName
                    };

                    AppConnector.request(params).then(
                        function (data) {
                            progressIndicatorElement.progressIndicator({'mode': 'hide'});
                            var modalData = {
                                data: data,
                                css: {'width': '50%', 'height': 'auto'}
                            };
                            app.showModalWindow(modalData);
                        },
                        function (error) {
                            progressIndicatorElement.progressIndicator({'mode': 'hide'});
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
            Vtiger_Helper_Js.showConfirmationBox({'message': message}).then(
                function (e) {
                    if (element.hasClass('loginRequired')) {
                        var loginError = app.vtranslate('JS_PLEASE_LOGIN_TO_VTE_STORE_FOR_INSTALLING_EXTENSION');
                        var loginErrorParam = {text: loginError,'type': 'error'};
                        Settings_Vtiger_Index_Js.showMessage(loginErrorParam);
                        return false;
                    }
                    var progressIndicatorElement = jQuery.progressIndicator({
                        'position': 'html',
                        'blockInfo': {
                            'enabled': true
                        },
                        'message': app.vtranslate('JS_UNINSTALLING_ALL_EXTENSIONS')+' ...'
                    });
                    var params = {
                        'module': app.getModuleName(),
                        'parent': app.getParentModuleName(),
                        'view': 'Settings',
                        'mode': 'uninstallAllExtensions'
                    };

                    AppConnector.request(params).then(
                        function (data) {
                            progressIndicatorElement.progressIndicator({'mode': 'hide'});
                            var modalData = {
                                data: data,
                                css: {'width': '50%', 'height': 'auto'}
                            };
                            app.showModalWindow(modalData);
                        },
                        function (error) {
                            progressIndicatorElement.progressIndicator({'mode': 'hide'});
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
            var svn = $(this).data("svn");
            var message = $(this).data("message");
            Vtiger_Helper_Js.showConfirmationBox({'message': message}).then(
                function (e) {
                    if (element.hasClass('loginRequired')) {
                        var loginError = app.vtranslate('JS_PLEASE_LOGIN_TO_VTE_STORE_FOR_INSTALLING_EXTENSION');
                        var loginErrorParam = {text: loginError,'type': 'error'};
                        Settings_Vtiger_Index_Js.showMessage(loginErrorParam);
                        return false;
                    }
                    var progressIndicatorElement = jQuery.progressIndicator({
                        'position': 'html',
                        'blockInfo': {
                            'enabled': true
                        },
                        'message': app.vtranslate('JS_UPGRADING_ALL_EXTENSIONS')+' ...'
                    });
                    var params = {
                        'module': app.getModuleName(),
                        'parent': app.getParentModuleName(),
                        'view': 'Settings',
                        'mode': 'upgradeAllExtensions',
                        'svn': svn,
                    };

                    AppConnector.request(params).then(
                        function (data) {
                            progressIndicatorElement.progressIndicator({'mode': 'hide'});
                            var modalData = {
                                data: data,
                                css: {'width': '50%', 'height': 'auto'}
                            };
                            app.showModalWindow(modalData);
                        },
                        function (error) {
                            progressIndicatorElement.progressIndicator({'mode': 'hide'});
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

            var progressIndicatorElement = jQuery.progressIndicator();

            var getChargifyInfo= jQuery("#getChargifyInfo").val();
            /*if(getChargifyInfo==1){
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
                
                var callBackFunction = function(data) {
                    var form = data.find('.MyAccountForm');
                    var params = app.getvalidationEngineOptions(true);
                    params.onValidationComplete = function(form, valid) {
                        if (valid) {
                            var formData = form.serializeFormData();
                            var progressIndicatorElement = jQuery.progressIndicator();
                            AppConnector.request(formData).then(
                                function(data) {
                                    if (data.success) {
                                        var result = data.result;
                                        progressIndicatorElement.progressIndicator({'mode': 'hide'});
                                        app.hideModalWindow();
                                        Settings_Vtiger_Index_Js.showMessage({text:app.vtranslate(data.result.message + '\n'+app.vtranslate('JS_PLEASE_WAIT'))});
                                        location.reload();
                                    } else {
                                        progressIndicatorElement.progressIndicator({'mode': 'hide'});
                                        app.hideModalWindow();
                                        var errorMessage = data.error.message;
                                        var params = {
                                            type:'error',
                                            text: errorMessage,
                                            title : app.vtranslate(data.error.message)
                                        };
                                        Settings_Vtiger_Index_Js.showMessage(params);
                                    }
                                }
                            );
                        }
                        return false;
                    };
                    form.validationEngine(params);
                };
            //}



            app.showModalWindow(myAccountModal, function(data) {
                progressIndicatorElement.progressIndicator({'mode': 'hide'});
                if (typeof callBackFunction == 'function') {
                    callBackFunction(data);
                }
            }, {'width': '1000px'});
        });
        // My Account END

        // ManageSubscription BEGIN
        jQuery( ".ManageSubscription" ).click(function(e) {
            var customer_status = jQuery("#customer_status").val();
            if(customer_status=='ok'){
                var progressIndicatorElement = jQuery.progressIndicator({
                    'blockInfo': {
                        'enabled': true
                    },
                    'position': 'html'
                });
                app.showModalWindow(null, "index.php?module=VTEStore&parent=Settings&view=Settings&mode=ManageSubscription", function (wizardContainer) {
                    //progressIndicatorElement.progressIndicator({'mode': 'hide'});
                    var form = jQuery('form', wizardContainer);
                    form.submit(function (e) {
                        e.preventDefault();
                        var type = form.find('[name="type"]').val();
                        //thisInstance.createStep2(type);
                    });
                }, {'width': '800px'});
            }else{
                jQuery("#getChargifyInfo").val(1);
                var customer_data = jQuery("#customer_data").val();
                var chargifyUrl = 'https://vte-sandbox.chargify.com/subscribe/zc5436yw28g8/extensions'+customer_data;
                window.open(chargifyUrl,"windowName", "width=800,height=800,scrollbars=yes");
            }

        });
        // My ManageSubscription END

        // Faq BEGIN
        jQuery( ".VTEStoreFAQ" ).click(function(e) {
            var progressIndicatorElement = jQuery.progressIndicator({
                'blockInfo': {
                    'enabled': true
                },
                'position': 'html'
            });
            app.showModalWindow(null, "index.php?module=VTEStore&parent=Settings&view=Settings&mode=ShowFAQ", function (wizardContainer) {
                //progressIndicatorElement.progressIndicator({'mode': 'hide'});
                var form = jQuery('form', wizardContainer);
                form.submit(function (e) {
                    e.preventDefault();
                    var type = form.find('[name="type"]').val();
                    //thisInstance.createStep2(type);
                });
            }, {'width': '900px'});
        });
        // My Faq END

        // Forgot password BEGIN
        jQuery("body").find('a[name="forgotPassword"]').unbind("click");
        jQuery("body").on('click', 'a[name="forgotPassword"]', function (e) {
            app.hideModalWindow(function(){
                var progressIndicatorElement = jQuery.progressIndicator();
                var forgotPasswordModal = jQuery(container).find('.forgotPassword').clone(true, true);
                forgotPasswordModal.removeClass('hide');
                // var url = "index.php?module=VTEStore&parent=Settings&view=Settings&mode=ForgotPassword";
                var actionParams = {
                    module: 'VTEStore',
                    parent: 'Settings',
                    view: 'Settings',
                    mode: 'ForgotPassword'
                };
                AppConnector.request(actionParams).then(
                    function (data) {
                        progressIndicatorElement.progressIndicator({'mode': 'hide'});
                        app.showModalWindow(data, function (modal) {
                            var form = modal.find('.forgotPasswordForm');
                            var params = app.validationEngineOptions;
                            params.onValidationComplete = function(frm, valid){
                                if(valid){
                                    form.find('.error_content').html('');
                                    var formData = $(frm).serializeFormData();
                                    var progressIndicatorElement = jQuery.progressIndicator();
                                    
                                    AppConnector.request(formData).then(
                                        function (data) {
                                            progressIndicatorElement.progressIndicator({'mode': 'hide'});
                                            if(data.result.message != '') {
                                                var message = data.result.message;
                                                form.find('.error_content').html(message);
                                                $("#captcha_container_1 img[alt='Refresh Image']").trigger("click");
                                                if (data.result.greater_five){
                                                    form.find("[name='btnForgotPassword']").attr("disabled", "true");
                                                }
                                                return;
                                            }else {
                                                app.hideModalWindow();
                                                var params = {'text': app.vtranslate('JS_RESET_PASSWORD')};
                                                Vtiger_Helper_Js.showMessage(params);
                                                setTimeout(function () {
                                                    location.reload();
                                                }, 5000);
                                            }
                                        },
                                        function (error) {
                                            progressIndicatorElement.progressIndicator({'mode': 'hide'});
                                            var message = error.message;
                                            var params = {title: 'Error', message: message};
                                            app.helper.showErrorNotification(params)
                                        }
                                    );
                                }
                                return false;
                            };
                            form.validationEngine(params);
                        }, {'width': '572px'});
                    }
                );
            });
        });
        // Forgot password END

        // phpiniWarnings BEGIN
        jQuery( "#phpiniWarnings" ).click(function(e) {
            var progressIndicatorElement = jQuery.progressIndicator({
                'blockInfo': {
                    'enabled': true
                },
                'position': 'html'
            });
            app.showModalWindow(null, "index.php?module=VTEStore&parent=Settings&view=Settings&mode=ShowWarnings", function (wizardContainer) {}, {'width': '950px'});
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
    
    changeNewUrl: function(c_id, oldUrl){
        var params = {
            'module': "VTEStore",
            'parent': 'Settings',
            'view': 'Settings',
            'mode': 'changeUrl',
            'c_id': c_id,
            'oldUrl': oldUrl
        };

        var progressIndicatorElement = jQuery.progressIndicator();
        AppConnector.request(params).then(
            function(data){
                progressIndicatorElement.progressIndicator({'mode': 'hide'});
                app.showModalWindow({
                    data: data,
                    css: {'width': '700px', 'height': 'auto'},
                    'cb': function (wizardContainer) {
                        var form = wizardContainer.find('#frmChangeUrl');
                        var params = app.getvalidationEngineOptions(true);
                        params.onValidationComplete = function (form, valid) {
                            if (valid) {
                                $(form).find('.error_content').html('');
                                if ($(form).find("#chkConfirm").prop("checked") != true){
                                    var message = app.vtranslate('JS_YOU_MUST_AGREE_MOVE_YOUR_ACCOUNT');
                                    $(form).find('.error_content').html(message);
                                    return false;
                                }
                                var formData = $(form).serializeFormData();
                                var progressIndicatorElement = jQuery.progressIndicator();
                                AppConnector.request(formData).then(
                                    function(data){
                                        progressIndicatorElement.progressIndicator({'mode': 'hide'});
                                        if (data.success) {
                                            if(data.result.message != '') {
                                                var message = data.result.message;
                                                $(form).find('.error_content').html(message);
                                                $("#frmChangeUrl img[alt='Refresh Image']").trigger("click");
                                                return;
                                            }else {
                                                app.hideModalWindow();
                                                var params = {type: 'success', text: app.vtranslate('JS_MOVE_URL_SUCCESSFULLY') + '\n' + app.vtranslate('JS_PLEASE_WAIT')};
                                                Settings_Vtiger_Index_Js.showMessage(params);
                                                //openSiteInBackground('https://www.vtexperts.com/vtiger-premium-account-created.html');
                                                setTimeout(function () {
                                                    location.reload();
                                                }, 5000);
                                            }
                                        } else {
                                            var error = data.error.message;
                                            var params = {type: 'error', text: error};
                                            Settings_Vtiger_Index_Js.showMessage(params);
                                        }
                                    }
                                );
                            }
                            return false;
                        };
                        form.validationEngine(params);
                    }
                });
            }
        );
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
        var detailContentsHolder = jQuery('.contentsDiv');
        this.registerEventsForVTEStore(detailContentsHolder);
    }
});

jQuery(document).ready(function() {
    jQuery("a.grouped_elements").fancybox();
    $("a.iframe").fancybox({
		'width'				: 1280,
		'height'			: 720,
        'autoScale'     	: false,
        'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'type'				: 'iframe'
	});

    // Tooltip
    $(".btnTooltip").tooltip({
        placement: 'left'
    });
});