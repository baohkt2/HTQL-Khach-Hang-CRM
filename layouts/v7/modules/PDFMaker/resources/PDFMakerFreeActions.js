/********************************************************************************
 * The content of this file is subject to the PDF Maker Free license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ******************************************************************************/
jQuery.Class("PDFMaker_FreeActions_Js",{
    templatesElements : {},
    controlModal : function(container) {
        var aDeferred = jQuery.Deferred();
        if (container.find('.modal-content').length > 0) {
            app.helper.hideModal().then(
                function () {
                    aDeferred.resolve();
                }
            );
        } else {
            aDeferred.resolve();
        }
        return aDeferred.promise();
    },
    getPDFSelectLanguage: function(container) {
        return container.find('#template_language').val();
    },
    getPDFSelectedTemplate: function(container) {
        var select = container.find('#pdf_template_select');
        return select.length ? select.val() : '';
    },
    getDefaultParams: function(viewtype,pdflanguage) {

        var params = {
            module: 'PDFMaker',
            source_module : app.getModuleName(),
            formodule : app.getModuleName(),
            view: viewtype,
            record : app.getRecordId()
        };

        if (pdflanguage != '') {
            params['language'] = pdflanguage;
        }

        return params;
    },
    getModalNewHeight: function (modalContainer){
        return jQuery(window).height() - modalContainer.find('.modal-header').height() - modalContainer.find('.modal-footer').height() - 100;
    },
    setMaxModalHeight : function (modalContainer,modaltype){

        var new_height = this.getModalNewHeight(modalContainer);

        var params1 = {
            setHeight:new_height+'px'
        };

        app.helper.showVerticalScroll(modalContainer.find('.modal-body'), params1);

        if (modaltype == 'iframe'){
            var params2 = {
                setHeight:(new_height-35)+'px'
            };
            app.helper.showVerticalScroll(modalContainer.find(modaltype), params2);
        }
    },
    checkIfAny: function (modalContainer){

        var j = 0;
        var LineItemCheckboxes = modalContainer.find('.LineItemCheckbox');
        jQuery.each(LineItemCheckboxes,function(i,e) {
            if (jQuery(e).is(":checked")) {
                j++;
            }
        });
        var settingscheckboxes_el = modalContainer.find('.settingsCheckbox');
        if (j == 0){
            settingscheckboxes_el.removeAttr('checked');
            settingscheckboxes_el.attr( "disabled" ,"disabled" );
        } else {
            settingscheckboxes_el.removeAttr('disabled');
        }

    },
    showPDFMakerModal : function (modetype) {
        var self = this;
        var params = {
            module: 'PDFMaker',
            return_id:  app.getRecordId(),
            view: 'IndexAjax',
            mode: modetype
        };

        app.helper.showProgress();
        app.request.get({data:params}).then(function(err,response){

            app.helper.hideProgress();
            app.helper.showModal(response, {
                'cb' : function(modalContainer) {
                    if (modetype == "PDFBreakline") {
                        modalContainer.find('.LineItemCheckbox').on('click', function(){
                            self.checkIfAny(modalContainer);
                        });
                    }

                    modalContainer.find('#js-save-button').on('click', function(){
                        PDFMaker_FreeActions_Js.savePDFMakerModal(modalContainer, modetype);
                    });
                }
            });
        });

    },
    savePDFMakerModal: function (modalContainer,modetype) {
        var form = modalContainer.find('#Save' + modetype + 'Form');
        var params = form.serializeFormData();
        app.helper.hideModal();
        app.helper.showProgress();

        app.request.post({"data":params}).then(function (err) {
            if (err == null) {
                app.helper.hideProgress();
                app.helper.showSuccessNotification({"message":''});
            } else {
                app.helper.showErrorNotification({"message":''});
            }
        });
    },
    controlPDFSelectInput : function(container,element) {
        var fieldVal = element.val();
        if (fieldVal === null) {
            container.find('.btn-success').attr('disabled', 'disabled');
            container.find('.PDFMakerTemplateAction').hide();
        } else {
            container.find('.btn-success').removeAttr('disabled');
            container.find('.PDFMakerTemplateAction').show();
        }
    },
    registerPDFSelectInput : function(container) {
        var self = this;

        jQuery("#use_common_template",container).change(function(){
            var element = jQuery(this);

            self.controlPDFSelectInput(container,element);
        });
    },
    showPDFPreviewModal: function (pdflanguage) {
        var self = this;

        var params = this.getDefaultParams('IndexAjax',pdflanguage);
        params['mode'] = 'getPreview';

        app.helper.showProgress();
        app.request.get({data: params}).then(function(err, data) {

            app.helper.showModal(data, {
                'cb' : function(modalContainer) {
                    self.registerPDFPreviewActionsButtons(modalContainer,pdflanguage);
                    self.setMaxModalHeight(modalContainer,'iframe');
                }
            });

            app.helper.hideProgress();
        });
    },
    registerPDFPreviewActionsButtons: function (modalContainer){

        modalContainer.find('.downloadButton').on('click', function(e){
            window.location.href = jQuery(e.currentTarget).data('desc');
        });

        modalContainer.find('.printButton').on('click', function(){
            var PDF = document.getElementById("PDFMakerPreviewContent");
            PDF.focus();
            PDF.contentWindow.print();
        });
    },

    registerPDFActionsButtons: function (container){

        var self = this;

        container.find('.PDFMakerDownloadPDF').on('click', function(){
            var pdflanguage = self.getPDFSelectLanguage(container);
            var templateid = self.getPDFSelectedTemplate(container);

            var params = self.getDefaultParams('',pdflanguage);
            params["action"]  = 'CreatePDFFromTemplate';
            if (templateid) {
                params["templateid"] = templateid;
            }
            var paramsUrl = jQuery.param(params);
            window.location.href = "index.php?" + paramsUrl;

        });

        container.find('.PDFModalPreview').on('click', function(){
            var pdflanguage = self.getPDFSelectLanguage(container);
            self.controlModal(container).then(function() {
                self.showPDFPreviewModal(pdflanguage);
            });
        });

        container.find('.exportListPDF').on('click', function(){
            var form = container.find('#exportListPDFMakerForm');
            form.submit();
        });

        container.find('.showPDFBreakline').on('click', function(){
            self.showPDFMakerModal('PDFBreakline');
        });

        container.find('.showProductImages').on('click', function(){
            self.showPDFMakerModal('ProductImages');
        });

    }

},{

    registerEvents: function (){
        var self = this;
        var recordId = app.getRecordId();
        var view = app.view();

        var params = {
            module: 'PDFMaker',
            source_module : app.getModuleName(),
            view : 'GetPDFActions',
            record: recordId,
            mode : 'getButtons'
        };

        var detailViewButtonContainerDiv = jQuery('.detailview-header');

        app.request.post({'data' : params}).then(
            function(err,response) {
                
                if(err === null){
                    if (response != ""){
                        var moreDropdown = jQuery('.detailViewButtoncontainer .btn-group .dropdown-menu.dropdown-menu-right').first();
                        if (moreDropdown.length > 0 && moreDropdown.find('.pdfmakerLegacyExportAction').length === 0) {
                            var menuItem = jQuery(
                                '<li class="pdfmakerLegacyExportAction">' +
                                '<a href="javascript:void(0)">Export PDF</a>' +
                                '</li>'
                            );
                            moreDropdown.append(menuItem);

                            menuItem.find('a').on('click', function (e) {
                                e.preventDefault();
                                e.stopPropagation();
                                app.helper.showAlertBox({
                                    title: 'Thong bao',
                                    message: 'Tinh nang Export PDF dang duoc phat trien. Vui long quay lai sau.'
                                });
                            });
                        }
                    }
                }
            }
        );
    }
});

jQuery(document).ready(function(){
	if(jQuery.inArray( app.getModuleName(), [ 'Invoice','Quotes','SalesOrder','PurchaseOrder' ] ) !== -1){
        var instance = new PDFMaker_FreeActions_Js();
        instance.registerEvents();
    }
});

