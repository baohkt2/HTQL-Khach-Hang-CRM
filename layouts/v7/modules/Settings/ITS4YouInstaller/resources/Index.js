/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouInstaller license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */
/** @var Settings_ITS4YouInstaller_Extensions_Js */
Settings_Vtiger_Index_Js("Settings_ITS4YouInstaller_Extensions_Js", {
    showPopover : function(e) {
        let ele = jQuery(e),
            options = {
                placement : ele.data('position'),
                trigger   : 'hover'
            };

        ele.popover(options);
    }
}, {
    showAlert: function(message, success = true) {

        let type = success ? 'success' : 'error',
            params = {
            type: type,
            title: app.vtranslate(message),
        };

        Vtiger_Helper_Js.showPnotify(params)
    },
    getImportModuleIndexParams: function() {
        return {
            'module': app.getModuleName(),
            'parent': app.getParentModuleName(),
            'view': 'Extensions'
        };
    },
    getImportModuleStepView: function (params) {
        const aDeferred = jQuery.Deferred();

        app.helper.showProgress();
        app.request.post({data: params}).then(function (error, data) {
            app.helper.hideProgress();

            if (error) {
                aDeferred.reject(error);
            }

            aDeferred.resolve(data);
        });

        return aDeferred.promise();
    },
    getContainer : function() {
        return jQuery('.contentsDiv');
    },
    registerEventsForInstaller: function(container) {
        this.registerInstallExtension(container);
        this.registerRenewBuyButtons(container);
        this.registerLogOutInstaller();
        this.registerLogIntoInstaller(container);
        this.registerOneClickInstall(container);
        this.registerInstallLoader(container);
        this.registerShowChangeLog(container);
        this.registerOneClickInstallFree(container);
        this.registerModuleSearch(container);
        this.registerRequirementsAlert(container);
    },
    registerRequirementsAlert: function () {
        let requirementsAlert = $('.requirements-alert');

        if (requirementsAlert.is('.btn-danger')) {
            app.helper.showConfirmationBox({
                title: app.vtranslate('JS_REQUIREMENTS'),
                message: app.vtranslate('JS_REQUIREMENTS_MESSAGE'),
                buttons: {
                    confirm: {
                        label: app.vtranslate('JS_REQUIREMENTS_YES'),
                        className: 'btn-danger'
                    },
                    cancel: {
                        label: app.vtranslate('JS_REQUIREMENTS_NO'),
                        className: 'btn-default'
                    },
                },
            }).then(function () {
                requirementsAlert.trigger('click');
            });
        }
    },
    registerModuleSearch: function (container) {
        const modules = $('.extensionsTable tbody tr');

        $.each(modules, function () {
            $(this).attr('module-label', $(this).find('td:first a').text().toLowerCase());
        });

        container.on('keydown', '.searchModule', function () {
            let value = $(this).val();

            if (value) {
                modules.addClass('hide');
                modules.filter('[module-label*="' + value.toLowerCase() + '"]').removeClass('hide');
            } else {
                modules.removeClass('hide');
            }
        });
    },
    registerOneClickInstallFree: function(container) {
        const element = $(container);

        element.off('click', '.oneclickInstallFree');
        element.on('click', '.oneclickInstallFree', function() {
            app.helper.showErrorNotification({
                message: app.vtranslate('JS_CLEAR_CACHE')
            }, {
                'delay': 10000,
            });
        });
    },
    registerInstallExtension: function (container) {
        const self = this;

        jQuery(container).find('.installExtension, .installPaidExtension').on('click', function (e) {
            self.installExtension(e);
        });
    },
    registerRenewBuyButtons: function(container) {
        jQuery(container).find('.renewButton, .buyButton').on('click',function(e){
            const element = jQuery(e.currentTarget),
                url = element.data('url');

            window.open(url);
        });
    },
    registerInstallLoader: function (container) {
        jQuery(container).on('click', '#installLoader', function () {
            let extensionLoaderModal = jQuery(container).find('.extensionLoader').clone(true, true);
            extensionLoaderModal.removeClass('hide');

            app.showModalWindow(extensionLoaderModal);
        });
    },
    registerLogOutInstaller: function () {
        jQuery('#logoutInstaller').off().on('click', function () {
            app.helper.showConfirmationBox({message: '<b>' + app.vtranslate('JS_ARE_YOU_SURE_LOGOUT') + '?</b>'}).then(function () {
                let params = {
                    'module': app.getModuleName(),
                    'parent': app.getParentModuleName(),
                    'action': 'Basic',
                    'mode': 'logoutITS4YouInstaller'
                };

                app.helper.showProgress();
                app.request.post({data: params}).then(function (error, data) {
                    if (!error) {
                        app.helper.hideProgress();
                        app.helper.showSuccessNotification({"message": data.message});

                        location.reload();
                    }
                });
            });
        });

    },
    registerLogIntoInstaller: function(container) {
        const self = this;

        jQuery('#logintoInstaller, .logintoInstaller').off().on('click', function() {
            app.helper.showErrorNotification({message: app.vtranslate('JS_LOGIN_WITH_ACCOUNT')});
        });
    },
    getExtensionParams: function (element) {
        const extensionContainer = element.closest('.extension_container'),
            extensionId = extensionContainer.find('[name="extensionId"]').val(),
            extensionType = extensionContainer.find('[name="extensionType"]').val(),
            extensionName = extensionContainer.find('[name="extensionName"]').val(),
            moduleAction = extensionContainer.find('[name="moduleAction"]').val(),
            moduleMode = extensionContainer.find('[name="moduleMode"]').val(),
            moduleMessage = extensionContainer.find('[name="moduleMessage"]').val();

        return {
            'module': app.getModuleName(),
            'parent': app.getParentModuleName(),
            'view': 'Extensions',
            'mode': moduleMode,
            'extensionId': extensionId,
            'moduleAction': moduleAction,
            'moduleMessage': moduleMessage,
            'extensionName': extensionName,
            'extensionType': extensionType,
        };
    },
    registerShowChangeLog: function (container) {
        const self = this;

        jQuery(container).off('click', '.showChangeLog');
        jQuery(container).on('click', '.showChangeLog', function (e) {
            const element = jQuery(e.currentTarget),
                params = self.getExtensionParams(element);

            if (params['moduleMessage']) {
                app.helper.showErrorNotification({message: params['moduleMessage'], showDuration: 10000});
                return;
            }

            self.getImportModuleStepView(params).then(function (data) {
                let modalData = {
                    cb: function (data) {
                        self.registerOneClickInstall(data);
                    }
                };

                app.helper.showModal(data, modalData);
            });
        });
    },
    registerOneClickInstall: function (container) {
        const self = this,
            containerElement = jQuery(container);

        containerElement.off('click', '.oneClickInstall');
        containerElement.on('click', '.oneClickInstall', function (e) {
            const element = jQuery(e.currentTarget),
                extensionContainer = element.closest('.extension_container'),
                params = self.getExtensionParams(element);

            app.helper.hideModal();

            if (element.hasClass('loginRequired')) {
                let loginError = app.vtranslate('JS_PLEASE_LOGIN_TO_MARKETPLACE_FOR_INSTALLING_EXTENSION');
                app.helper.showErrorNotification({"message": loginError});
                return false;
            }

            let question = element.hasClass('isUpdateBtn') ? 'JS_ARE_YOU_SURE_UPGRADE' : 'JS_ARE_YOU_SURE_INSTALL';

            app.helper.showConfirmationBox({message: '<b>' + app.vtranslate(question) + '?</b>'}).then(function () {

                self.getImportModuleStepView(params).then(function (installationLogData) {
                    let callBackFunction = function (data) {
                        let installationStatus = jQuery(data).find('[name="installationStatus"]').val();

                        if ('success' === installationStatus) {
                            self.changeButtonToInstalled(params['extensionName'])
                        }
                    };

                    app.helper.showModal(installationLogData, {
                        cb: callBackFunction
                    });
                });
            });
        });
    },
    changeButtonToInstalled: function (module) {
        $('.installedModuleRow#' + module + ' .extension_container').html('<span class="alert alert-info">' + app.vtranslate('JS_INSTALLED') + '</span>')
    },
    registerLoginModalTabEvents : function(form) {
        let modalContent = form.find('.modal-content');
        let tabElements = modalContent.find('.nav.nav-pills , .nav.nav-tabs').find('a');

        let loginModalTabOnHide = function(tabElement) {
            let container = form.find('#' + tabElement.attr('data-target'));
            container.addClass('hide');
        };

        let loginModalTabOnShow = function(tabElement) {
            let tabName = tabElement.attr('data-target');
            let container = form.find('#' + tabName);
            container.removeClass('hide');
            modalContent.data('actual-tab', tabName);
        };

        tabElements.on('shown.bs.tab', function(e) {
            let previousTab = jQuery(e.relatedTarget);
            let currentTab = jQuery(e.currentTarget);

            loginModalTabOnHide(previousTab);
            loginModalTabOnShow(currentTab);
        });

        loginModalTabOnHide(tabElements.closest('li').filter(':not(.active)').find('a'));
    },
    installExtension: function(e) {
        const element = jQuery(e.currentTarget),
            url = element.data('url');

        if(url){
            window.open(url);
        }
    },
    registerExtensionTabs : function(container) {
        const self = this;

        container.on('click', '.extensionTab', function(e){
            let element = jQuery(e.currentTarget),
                params = {
                    'module': app.getModuleName(),
                    'parent': app.getParentModuleName(),
                    'view': 'Extensions',
                    'mode': 'getExtensionByType',
                    'type': element.data('type')
            };

            app.helper.showProgress();
            app.request.post({data: params}).then(
                function(error, data) {
                    jQuery('.extensionTab').removeClass('active').removeClass('btn-primary');
                    element.addClass('active').addClass('btn-primary');
                    app.helper.hideProgress();
                    jQuery('#extensionContainer').html(data);
                    self.registerEventForIndexView();
                }
            );
        });    
    },
    registerIframeTabs: function (container) {
        container.on('click', '.customerPortalBtn', function () {
            let heightContainer = jQuery('#extensionContainer').height();
            jQuery('#customerPortalIframe').height(heightContainer - 50);
        });
    },
    getTrial: function(trial) {
        let self = this,
            params = {
                module: app.getModuleName(),
                parent: app.getParentModuleName(),
                action: 'Trial',
                mode: 'getTrial',
                trial: trial,
            };

        app.helper.showProgress();
        app.request.post({data: params}).then(function(error, data) {
            app.helper.hideProgress();
            if(!error) {
                if(data.success && data.license) {

                    let params = {
                        module: app.getModuleName(),
                        parent: 'Settings',
                        view: 'ActivateLicense',
                        mode: 'activate',
                        license: data.license,
                    };

                    self.showActivateLicense(params);
                } else {
                    self.showAlert(data.message, data.success);
                }
            }
        });
    },
    trialButtonActions: function() {
        let self = this;

        jQuery('.trialButton').on('click', function() {
            let button = jQuery(this),
                data = button.data(),
                trial = parseInt(data['trial']);

            if(trial > 0) {
                self.getTrial(trial, button);
            }
        });
    },
    registerEventsForTrial() {
        this.trialButtonActions();
    },
    showActivateLicense(params) {
        const self = this;

        app.helper.hideModal();
        app.helper.showProgress();
        app.request.post({data: params}).then(function (error, data) {
            if (!error) {
                app.helper.hideProgress();
                app.helper.showModal(data, {
                    cb: function () {
                        self.activateLicense();
                    }
                });
            }
        });
    },
    activateLicense() {
        jQuery('#activateLicense').on('submit', function(e) {
            e.preventDefault();
            let form = jQuery(this),
                formData = form.serializeFormData(),
                license = formData['licensekey'],
                params = {
                    module: app.getModuleName(),
                    license: license,
                    action: 'License',
                    parent: 'Settings',
                    mode: 'activate',
                };

            if('' !== license) {
                app.helper.showProgress();
                app.request.post({data: params}).then(function(error, data) {
                    app.helper.hideProgress();
                     if(!error) {
                         let message = {
                             message: data['message'],
                         };

                         if(true === data['success']) {
                             app.helper.showSuccessNotification(message);
                         } else {
                             app.helper.showErrorNotification(message);
                         }

                         app.helper.hideModal();

                         location.reload();
                     }
                });
            } else {
                jQuery('#licensekey').addClass('input-error');
            }
        });
    },
    activateButton() {
        let self = this;
        jQuery('.activateButton').on('click', function() {
            let params = {
                    module: app.getModuleName(),
                    parent: 'Settings',
                    view: 'ActivateLicense',
                    mode: 'activate',
                };

            self.showActivateLicense(params);
        });
    },
    registerActivateLicenses() {
        this.activateButton();
        this.activateLicense();
    },
    registerLicensesActions() {
        jQuery('.actionLicenses').on('click', function() {
            let button = jQuery(this),
                btnData = button.data(),
                message = 'JS_DEACTIVATE_LICENSES_QUESTION';

            if(btnData.mode === 'update') {
                message = 'JS_UPDATE_LICENSES_QUESTION';
            }

            if(btnData.license) {
                app.helper.showConfirmationBox({message: app.vtranslate(message)}).then(function() {
                    let mode = btnData.mode,
	                    params = {
                            module: app.getModuleName(),
                            parent: 'Settings',
                            action: 'License',
                            mode: mode,
                            license: btnData.license
                        };

                    button.attr('disable', 'disabled');
                    app.helper.showProgress();
                    app.request.post({data: params}).then(function(error, data) {
                        app.helper.hideProgress();
                        if(!error) {
                            let message = '';

                            if(data.message) {
                                message = data.message;
                            }

                            if(data.success) {
                                app.helper.showSuccessNotification({message: message});

                                if(mode === 'deactivate') {
                                    button.parents('tr').hide();
                                    $('tr.parent' + data.license).hide();
                                }
                            } else {
                                app.helper.showErrorNotification({message: message})
                            }
                        }
                    });
                });
            }
        });
    },
    registerUpdateLicenses: function() {
        let self = this;

        jQuery('.updateButton').on('click', function() {
            let button = jQuery(this),
                message = app.vtranslate('JS_LICENSE_UPDATE_QUESTION'),
                params = {
                    module: app.getModuleName(),
                    parent: 'Settings',
                    action: 'License',
                    mode: 'update',
                };

            app.helper.showConfirmationBox({message: message}).then(function() {
                button.attr('disabled', 'disabled');

                app.helper.showProgress();
                app.request.post({data: params}).then(function(error, data) {
                    app.helper.hideProgress();
                    if(!error) {
                        if(data.message) {
                            self.showAlert(data.message);
                        }
                        button.removeAttr('disabled');
                        location.reload();
                    }
                });
            });
        });
    },
    registerLicensesColors: function() {
        jQuery('.licenseColors').on('click', function() {
            const id = jQuery(this).attr('href');

            jQuery(id)
                .animate({backgroundColor: '#FFEEEE'}, 1000)
                .animate({backgroundColor: '#ffffff'}, 10000);
        });
    },
    registerEvents: function() {
        const container = jQuery('.contentsDiv');
        this._super();
        this.registerEventsForInstaller(container);
        this.registerExtensionTabs(container);
        this.registerIframeTabs(container);
        this.registerEventsForTrial();
        this.registerActivateLicenses();
        this.registerUpdateLicenses();
        this.registerLicensesActions();
        this.registerLicensesColors();
    }
});