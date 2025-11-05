/*+**********************************************************************************
 * Advanced Funnel Charts by SalesPlatform
 * Copyright (C) 2011-2016 SalesPlatform Ltd
 * All Rights Reserved.
 * This extension is licensed to be used within one instance of Vtiger CRM.
 * Source code or binaries may not be redistributed unless expressly permitted by SalesPlatform Ltd.
 * If you have any questions or comments, please email: extensions@salesplatform.ru
 ************************************************************************************/

Vtiger_Edit_Js("SPFunnelCharts_Edit_Js",{},{
    
    container : false,
    funnelReportsListSelectElement : false,
    reportsPlotDependencies : false,
    
    init : function() {
		var statusToProceed = this.proceedRegisterEvents();
		if(!statusToProceed){
			return;
		}
		this.setContainer($('#spWidgetReport'));
        this.reportsPlotDependencies = JSON.parse($("#reportsPlotDependencies").val());
	},

    
    /**
	 * Function to get the container which holds all the reports elements
	 * @return jQuery object
	 */
	getContainer : function() {
		return this.container;
	},

    /**
     * Function to set the reports container
     * @params : element - which represents the reports container
     * @return : current instance
     */
    setContainer : function(element) {
        this.container = element;
        return this;
	},
    
    getForm : function() {
        return $('form', this.getContainer());
    },
    
    /**
     * Return select reports ui element object
     */
    getFunnelReportsListSelectElement : function() {
        if(this.funnelReportsListSelectElement === false) {
            this.funnelReportsListSelectElement = $('#reportsListSelectElement');
        }
        return this.funnelReportsListSelectElement;
    },
    
    /**
     * Makes sorting select of funnel reports
     */
    makeReportsListSortable : function() {
        var selectElement = this.getFunnelReportsListSelectElement();
        var select2Element = app.getSelect2ElementFromSelect(selectElement);

        /* The sorting is only available when Select2 is attached to a hidden input field */
        var select2ChoiceElement = select2Element.find('ul.select2-choices');
        select2ChoiceElement.sortable({
            containment: select2ChoiceElement
        });
    },
    
    /**
     * Function which will arrange the selected element choices in order
     */
    arrangeSelectChoicesInOrder : function() {
        var thisInstance = this;
        var container = this.getContainer();
        var selectElement = this.getFunnelReportsListSelectElement();
        var select2Element = app.getSelect2ElementFromSelect(selectElement);
        var choicesContainer = select2Element.find('ul.select2-choices');
        var choicesList = choicesContainer.find('li.select2-search-choice');
        var selectedOptions = selectElement.find('option:selected');
        var selectedOrder = JSON.parse($('input[name="topReportsIdsList"]', container).val());
        
        for(var index=selectedOrder.length ; index > 0 ; index--) {
            var selectedValue = selectedOrder[index-1];
            var option = selectedOptions.filter('[value="'+selectedValue+'"]');
            choicesList.each(function(choiceListIndex,element){
                var liElement = $(element);
                if(liElement.find('div').html() == option.html()){
                    
                    /* Dynamic add control option on which main field report can be ploted */
                    var plotByControlElement = thisInstance.createPlotByControlElement(selectedValue);
                    liElement.append(plotByControlElement);
                    choicesContainer.prepend(liElement);
                    return false;
                }
            });
        }
    },
    
    /**
     * Creates picklist for funnel step
     * 
     * @returns {jQuery}
     */
    createPlotByControlElement : function(reportId) {
        
        /* Get current report info about dependency */
        var plotDependency = this.reportsPlotDependencies[reportId];
        var selectedDependency = plotDependency.selectedPlotType;
        var selectableDependencies = plotDependency.selectablePlotTypes;
        
        /* Create picklist values with selected */
        var optionsHtml = '';
        for(var dependencyIndex = 0; dependencyIndex < selectableDependencies.length; dependencyIndex++) {
            var dependency = selectableDependencies[dependencyIndex];
            var selectedOption = selectedDependency === dependency[0] ? ' selected' : '';
            optionsHtml += '<option value="' + dependency[0] + '"' + selectedOption + '>' + dependency[1] + '</option>';
        }
        
        return $(
            '<div class="plotControl" style="margin: 5px 0px; text-align: center;">' + 
                '<b>' + app.vtranslate('JS_PLOT_BY') + '&nbsp;&nbsp;</b>' + 
                '<select name="reports_plot_by[' + reportId + ']">' + optionsHtml + '</select>' + 
            '</div>'
        );
    },
    
    /**
     * Function which will get the selected columns with order preserved
     * @return : array of selected values in order
     */
    getSelectedColumns : function() {
        var selectElement = this.getFunnelReportsListSelectElement();
        var select2Element = app.getSelect2ElementFromSelect(selectElement);

        var selectedValuesByOrder = {};
        var selectedOptions = selectElement.find('option:selected');
        var orderedSelect2Options = select2Element.find('li.select2-search-choice').find('div');
        var i = 1;
        orderedSelect2Options.each(function(index,element){
            var chosenOption = $(element);
            selectedOptions.each(function(optionIndex, domOption){
                var option = $(domOption);
                if(option.html() == chosenOption.html()) {
                    selectedValuesByOrder[i++] = option.val();
                    return false;
                }
            });
        });

        return selectedValuesByOrder;
    },
    
    
    /*
     * Function to register the click event for next button
     */
    registerSaveEvent : function(form) {
        var thisInstance = this;
        $("#saveSpWidgetReport").click(function(e) {
            e.preventDefault();
            if (form.validationEngine('validate')) {
                
                /* Save order of funnel modules elements ans serialaze form */
                jQuery('input[name="report_ids"]', form).val(JSON.stringify(thisInstance.getSelectedColumns()));
                var formData = form.serializeFormData();
                var moduleName = app.getModuleName();
                var params = {
                    module : moduleName,
                    action : "CheckDuplicate",
                    funnel_name : $.trim(formData.funnel_name),
                    record : formData.record,
                    isDuplicate : formData.isDuplicate
                };

                /* Send check request */
                var progressIndicatorElement = $.progressIndicator({
                    position : 'html',
                    blockInfo : {
                        enabled : true
                    }
                });
                AppConnector.request(params).then(
                    function(data) {
                        var response = data.result;
                        var result = response.success;

                        /* Vtiger CheckDuplicate Report returns true if report exists */
                        if(result == true) {
                            progressIndicatorElement.progressIndicator({
                                mode : 'hide'
                            });
                            var notification = {
                                title: app.vtranslate('JS_DUPLICATE_RECORD'),
                                text: response['message']
                            };
                            Vtiger_Helper_Js.showPnotify(notification);
                        } else {
                            form.submit();
                        }
                    },
                    function(error,err){
                        progressIndicatorElement.progressIndicator({
                            mode : 'hide'
                        });
                        var notification = {
                            title: app.vtranslate('JS_ERROR'),
                            text: app.vtranslate('JS_ERROR_SEND_SAVE_FUNNEL_REQUEST')
                        };
                        Vtiger_Helper_Js.showPnotify(notification);
                    }
                ); 
            }      
        });
        
    },
    
    addFormValidation : function(form) {
        var opts = app.validationEngineOptions;
        opts['onValidationComplete'] = function(form,valid) {
            return valid;
        };
        opts['promptPosition'] = "bottomRight";
        form.validationEngine(opts);
    },
    
    onReportSelection : function() {
        var thisInstance = this;
        var selectElement = this.getFunnelReportsListSelectElement();
        selectElement.on('change', function() {
            var selectedValues = $(this).val();
            if(selectedValues != null) {
               var selectElement = thisInstance.getFunnelReportsListSelectElement();
                var select2Element = app.getSelect2ElementFromSelect(selectElement);
                var choicesContainer = select2Element.find('ul.select2-choices');
                var choicesList = choicesContainer.find('li.select2-search-choice');
                var selectedOptions = selectElement.find('option:selected');

                /* Add control UI to selected report */
                for(var index=0; index < selectedValues.length; index++) {
                    var selectedValue = selectedValues[index];
                    var option = selectedOptions.filter('[value="'+ selectedValue + '"]');
                    choicesList.each(function(choiceListIndex, element){
                        var liElement = $(element);
                        if(liElement.find('div').html() == option.html()) {

                            /* If no control UI on element - add it */
                            var children = liElement.children('.plotControl');
                            if(children.length === 0) {
                                var plotByControlElement = thisInstance.createPlotByControlElement(selectedValue);
                                liElement.append(plotByControlElement);
                            }
                            return false;
                        }
                    });
                } 
            }
        });
    },
    
    registerEvents : function(){
        var form = this.getForm();
        this.addFormValidation(form);
        this.registerSaveEvent(form);
        this.arrangeSelectChoicesInOrder();
        this.makeReportsListSortable();
        this.onReportSelection();
    }
});