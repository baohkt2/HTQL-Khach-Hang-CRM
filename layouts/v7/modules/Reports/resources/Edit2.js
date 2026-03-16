/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/
if (typeof window.ReportsAdvancedMetricsBuilder === 'undefined') {
	window.ReportsAdvancedMetricsBuilder = {
		escapeHtml: function(value) {
			return jQuery('<div>').text(value || '').html();
		},

		getLabels: function(container) {
			var builder = jQuery('#advancedMetricsBuilder', container);
			return {
				key: builder.data('lblKey') || 'Key',
				label: builder.data('lblLabel') || 'Metric',
				type: builder.data('lblType') || 'Type',
				field: builder.data('lblField') || 'Field',
				conditionField: builder.data('lblConditionField') || 'Condition Field',
				comparator: builder.data('lblComparator') || 'Comparator',
				conditionValue: builder.data('lblConditionValue') || 'Value',
				numerator: builder.data('lblNumerator') || 'Numerator',
				denominator: builder.data('lblDenominator') || 'Denominator',
				expression: builder.data('lblExpression') || 'Expression',
				remove: builder.data('lblRemove') || 'Remove',
				metricType: builder.data('lblMetricType') || 'Metric Type'
			};
		},

		getComparators: function() {
			return [
				{ value: 'e', label: '=' },
				{ value: 'n', label: '!=' },
				{ value: 'y', label: 'is empty' },
				{ value: 'ny', label: "isn't empty" },
				{ value: 'c', label: 'contains' },
				{ value: 'k', label: 'not contains' },
				{ value: 's', label: 'starts with' },
				{ value: 'ew', label: 'ends with' },
				{ value: 'g', label: '>' },
				{ value: 'l', label: '<' }
			];
		},

		renderComparatorOptions: function(selectedValue) {
			var html = '';
			jQuery.each(this.getComparators(), function(index, item) {
				var selected = (item.value === selectedValue) ? ' selected="selected"' : '';
				html += '<option value="' + item.value + '"' + selected + '>' + item.label + '</option>';
			});
			return html;
		},

		normalizeMetric: function(metric) {
			metric = metric || {};
			var criteria = jQuery.isArray(metric.criteria) ? metric.criteria : [];
			var firstCriteria = criteria.length ? criteria[0] : {};
			return {
				key: metric.key || '',
				label: metric.label || '',
				type: (metric.type === 'COUNT_ALL' || metric.type === 'COUNT_WHERE') ? 'COUNT' : (metric.type || 'COUNT'),
				field: metric.field || '',
				conditionField: firstCriteria.columnname || '',
				conditionComparator: firstCriteria.comparator || 'e',
				conditionValue: firstCriteria.value || ''
			};
		},

		isRowEmpty: function(row) {
			return jQuery.trim(jQuery('.metricLabel', row).val()) === ''
				&& jQuery.trim(jQuery('.metricField', row).val()) === ''
				&& jQuery.trim(jQuery('.metricConditionField', row).val()) === ''
				&& jQuery.trim(jQuery('.metricConditionValue', row).val()) === '';
		},

		toggleTypeSections: function(row) {
			jQuery('.groupForCondition', row).show();
			this.toggleConditionValueInput(row);
		},

		toggleConditionValueInput: function(row) {
			var comparator = jQuery('.metricConditionComparator', row).val() || 'e';
			var valueInput = jQuery('.metricConditionValue', row);
			if (comparator === 'y' || comparator === 'ny') {
				valueInput.val('');
				valueInput.prop('disabled', true);
				valueInput.attr('placeholder', '');
			} else {
				valueInput.prop('disabled', false);
				valueInput.attr('placeholder', '');
			}
		},

		refreshDependencyOptions: function(container) {
			return;
		},

		addRow: function(container, metric) {
			var builder = jQuery('#advancedMetricsBuilder', container);
			var rowsContainer = jQuery('#advancedMetricsRows', container);
			if (!builder.length || !rowsContainer.length) {
				return;
			}

			var labels = this.getLabels(container);
			var data = this.normalizeMetric(metric);
			var fieldOptions = jQuery('#advancedMetricFieldPool', container).html() || '';
			var conditionFieldOptions = jQuery('#advancedMetricConditionFieldPool', container).html() || '';

			var rowHtml = '';
			rowHtml += '<div class="advancedMetricRow panel panel-default" style="padding:10px; margin-bottom:10px;">';
			rowHtml += '<div class="row">';
			rowHtml += '<div class="col-lg-3"><label>' + this.escapeHtml(labels.label) + '</label><input type="text" class="form-control metricLabel" value="' + this.escapeHtml(data.label) + '" /></div>';
			rowHtml += '<div class="col-lg-4 groupForField"><label>' + this.escapeHtml(labels.field) + '</label><select class="form-control metricField">' + fieldOptions + '</select></div>';
			rowHtml += '<div class="col-lg-3"><label>' + this.escapeHtml(labels.metricType) + '</label>';
			rowHtml += '<select class="form-control metricType">';
			rowHtml += '<option value="COUNT">COUNT</option>';
			rowHtml += '<option value="SUM">SUM</option>';
			rowHtml += '<option value="AVG">AVG</option>';
			rowHtml += '<option value="MIN">MIN</option>';
			rowHtml += '<option value="MAX">MAX</option>';
			rowHtml += '</select></div>';
			rowHtml += '<div class="col-lg-2" style="padding-top:22px;"><button type="button" class="btn btn-link text-danger removeMetricRow">' + this.escapeHtml(labels.remove) + '</button></div>';
			rowHtml += '</div>';

			rowHtml += '<div class="row groupForCondition" style="margin-top:8px;">';
			rowHtml += '<div class="col-lg-5"><label>' + this.escapeHtml(labels.conditionField) + '</label><select class="form-control metricConditionField">' + conditionFieldOptions + '</select></div>';
			rowHtml += '<div class="col-lg-2"><label>' + this.escapeHtml(labels.comparator) + '</label><select class="form-control metricConditionComparator">' + this.renderComparatorOptions(data.conditionComparator) + '</select></div>';
			rowHtml += '<div class="col-lg-5"><label>' + this.escapeHtml(labels.conditionValue) + '</label><input type="text" class="form-control metricConditionValue" value="' + this.escapeHtml(data.conditionValue) + '" /></div>';
			rowHtml += '</div>';

			rowHtml += '</div>';

			var row = jQuery(rowHtml);
			jQuery('.metricType', row).val(data.type || 'COUNT');
			jQuery('.metricField', row).val(data.field || '');
			jQuery('.metricConditionField', row).val(data.conditionField || '');
			rowsContainer.append(row);

			this.toggleTypeSections(row);
			this.refreshDependencyOptions(container);
		},

		readExistingMetrics: function(container) {
			var raw = jQuery.trim(jQuery('#advancedMetricsJson', container).val() || jQuery('#advanced_metrics', container).val() || '[]');
			if (raw === '') {
				return [];
			}
			try {
				var parsed = JSON.parse(raw);
				if (jQuery.isArray(parsed)) {
					return parsed;
				}
			} catch (e) {
				return [];
			}
			return [];
		},

		showError: function(message) {
			if (window.app && app.helper && app.helper.showErrorNotification) {
				app.helper.showErrorNotification({ message: message });
			} else {
				alert(message);
			}
		},

		collect: function(container, showErrors) {
			var metrics = [];
			var keys = {};
			var hasError = false;

			jQuery('.advancedMetricRow', container).each(function() {
				if (hasError) {
					return;
				}

				var row = jQuery(this);
				if (window.ReportsAdvancedMetricsBuilder.isRowEmpty(row)) {
					return;
				}

				var label = jQuery.trim(jQuery('.metricLabel', row).val());
				var type = jQuery.trim(jQuery('.metricType', row).val() || 'COUNT');
				var key = 'adv_col_' + (metrics.length + 1);
				var field = jQuery.trim(jQuery('.metricField', row).val());
				var labelFinal = label;
				if (labelFinal === '') {
					labelFinal = key;
				}
				var metric = {
					key: key,
					label: labelFinal,
					type: type
				};

				if (keys[labelFinal]) {
					if (showErrors) {
						window.ReportsAdvancedMetricsBuilder.showError('Column name must be unique: ' + labelFinal);
					}
					hasError = true;
					return;
				}
				keys[labelFinal] = true;

				if (type === 'SUM' || type === 'AVG' || type === 'MIN' || type === 'MAX') {
					metric.field = field;
					if (metric.field === '') {
						if (showErrors) {
							window.ReportsAdvancedMetricsBuilder.showError('Field is required for ' + type + '.');
						}
						hasError = true;
						return;
					}
				}

				if (type === 'COUNT') {
					metric.type = 'COUNT_ALL';
				}

				if (metric.type === 'COUNT_ALL' || type === 'SUM' || type === 'AVG' || type === 'MIN' || type === 'MAX') {
					var conditionField = jQuery.trim(jQuery('.metricConditionField', row).val());
					if (conditionField !== '') {
						if (metric.type === 'COUNT_ALL') {
							metric.type = 'COUNT_WHERE';
						}
						metric.criteria = [{
							columnname: conditionField,
							comparator: jQuery.trim(jQuery('.metricConditionComparator', row).val() || 'e'),
							value: jQuery.trim(jQuery('.metricConditionValue', row).val()),
							columncondition: ''
						}];
					}
				}

				metrics.push(metric);
			});

			if (hasError) {
				return false;
			}

			return metrics;
		},

		syncHiddenFields: function(container, showErrors) {
			var metrics = this.collect(container, showErrors);
			if (metrics === false) {
				return false;
			}
			var encoded = JSON.stringify(metrics);
			jQuery('#advancedMetricsJson', container).val(encoded);
			jQuery('#advanced_metrics', container).val(encoded);
			return true;
		},

		init: function(container) {
			var builder = jQuery('#advancedMetricsBuilder', container);
			if (!builder.length || builder.data('builderInit')) {
				return;
			}

			builder.data('builderInit', true);
			var thisBuilder = this;
			var existingMetrics = this.readExistingMetrics(container);

			if (existingMetrics.length) {
				jQuery.each(existingMetrics, function(index, metric) {
					thisBuilder.addRow(container, metric);
				});
			} else {
				thisBuilder.addRow(container, {});
			}

			builder.on('click', '.removeMetricRow', function() {
				jQuery(this).closest('.advancedMetricRow').remove();
				thisBuilder.refreshDependencyOptions(container);
				thisBuilder.syncHiddenFields(container, false);
			});

			builder.on('change', '.metricType', function() {
				thisBuilder.toggleTypeSections(jQuery(this).closest('.advancedMetricRow'));
				thisBuilder.syncHiddenFields(container, false);
			});

			builder.on('change', '.metricConditionComparator', function() {
				thisBuilder.toggleConditionValueInput(jQuery(this).closest('.advancedMetricRow'));
				thisBuilder.syncHiddenFields(container, false);
			});

			builder.on('keyup change', '.metricLabel, .metricField, .metricConditionField, .metricConditionComparator, .metricConditionValue', function() {
				thisBuilder.refreshDependencyOptions(container);
				thisBuilder.syncHiddenFields(container, false);
			});

			this.refreshDependencyOptions(container);
			this.syncHiddenFields(container, false);
		}
	};
}

if (typeof window.ReportsAdvancedMetricsBuilderGlobalBindDone === 'undefined') {
	window.ReportsAdvancedMetricsBuilderGlobalBindDone = true;
	jQuery(document).on('click', '#addAdvancedMetricRow', function(e) {
		e.preventDefault();
		if (!window.ReportsAdvancedMetricsBuilder) {
			return false;
		}
		var container = jQuery(this).closest('form');
		window.ReportsAdvancedMetricsBuilder.init(container);
		window.ReportsAdvancedMetricsBuilder.addRow(container, {});
		window.ReportsAdvancedMetricsBuilder.syncHiddenFields(container, false);
		return false;
	});
}

Reports_Edit_Js("Reports_Edit2_Js",{},{

	step2Container : false,

	//This will contain the reports multi select element
	reportsColumnsList : false,

	//This will contain the selected fields element
	selectedFields : false,

	init : function() {
		this.initialize();
	},
	
	/**
	 * Function to get the container which holds all the report elements
	 * @return jQuery object
	 */
	getContainer : function() {
		return this.step2Container;
	},

	/**
	 * Function to set the report step2 container
	 * @params : element - which represents the report step2 container
	 * @return : current instance
	 */
	setContainer : function(element) {
		this.step2Container = element;
		return this;
	},

	/**
	 * Function to get the multi select element
	 * @return : jQuery object of reports multi select element
	 */
	getReportsColumnsList : function() {
		if(this.reportsColumnsList == false) {
			this.reportsColumnsList = jQuery('#reportsColumnsList');
		}
		return this.reportsColumnsList;
	},

	/**
	 * Function to get the selected fields
	 * @return : jQuery object of selected fields
	 */
	getSelectedFields : function() {
		if(this.selectedFields == false) {
			this.selectedFields = jQuery('#selected_fields');
		}
		return this.selectedFields;
	},

	/**
	 * Function  to intialize the reports step2
	 */
	initialize : function(container) {
		if(typeof container == 'undefined') {
			container = jQuery('#report_step2');
		}

		if(container.is('#report_step2')) {
			this.setContainer(container);
		}else{
			this.setContainer(jQuery('#report_step2'));
		}
	},
	
	/*
	 * Function to validate special cases in the form
	 * returns result
	 */
	isFormValidate : function(){
		var thisInstance = this;
		var selectElement = this.getReportsColumnsList();
		var select2Element = vtUtils.showSelect2ElementView(selectElement);
		var result = Vtiger_MultiSelect_Validator_Js.invokeValidation(selectElement);
		if(result != true){
			select2Element.validationEngine('showPrompt', result , 'error','bottomLeft',true);
			var form = thisInstance.getContainer();
			app.formAlignmentAfterValidation(form);
			return false;
		}

		if (window.ReportsAdvancedMetricsBuilder) {
			if (!window.ReportsAdvancedMetricsBuilder.syncHiddenFields(this.getContainer(), true)) {
				return false;
			}
		}

		select2Element.validationEngine('hide');
		return true;
	},
	
	/*
	 * Fucntion to perform all the requires calculation before submit
	 */
	calculateValues : function(){
		var container = this.getContainer();
		//Handled select fields values
		var selectedFields = this.getSelectedColumns();
		this.getSelectedFields().val(JSON.stringify(selectedFields));

		//handled selected sort fields
		var selectedSortOrderFields = new Array();
		var selectedSortFieldsRows = jQuery('.sortFieldRow',container);
		jQuery.each(selectedSortFieldsRows,function(index,element){
			var currentElement = jQuery(element);
			var field = currentElement.find('select.selectedSortFields').val();
			var order = currentElement.find('.sortOrder').filter(':checked').val();
			//TODO: need to handle sort type for Reports
			var type = currentElement.find('.sortType').val();
			selectedSortOrderFields.push([field,order,type]);
		});
		jQuery('#selected_sort_fields').val(JSON.stringify(selectedSortOrderFields));

		//handled Selected Calculation fields

		var selectedCalculationFields = {};
		var calculationFieldsTable = jQuery('.CalculationFields',container);
		var calculationFieldRows = calculationFieldsTable.find('.calculationFieldRow');
		var indexValue = 0;
		jQuery.each(calculationFieldRows,function(index,element){
			var calculationTypes = jQuery(element).find('.calculationType:checked');
			jQuery.each(calculationTypes,function(index,element){
				selectedCalculationFields[indexValue] = jQuery(element).val();
				indexValue++;
			});
		});
		jQuery('#calculation_fields').val(JSON.stringify(selectedCalculationFields));

		if (window.ReportsAdvancedMetricsBuilder) {
			window.ReportsAdvancedMetricsBuilder.syncHiddenFields(container, false);
		}
	},
	
	submit : function(){
		var aDeferred = jQuery.Deferred();
		this.calculateValues();
		var form = this.getContainer();
		var formData = form.serializeFormData();
		app.helper.showProgress();
		app.request.post({data:formData}).then(function(error,data) {
			form.hide();
			app.helper.hideProgress();
			aDeferred.resolve(data);
		},
		function(error,err){

		});
		return aDeferred.promise();	
	},

	/**
	 * Function which will register the select2 elements for columns selection
	 */
	registerSelect2ElementForReportColumns : function() {
		var selectElement = this.getReportsColumnsList();
		vtUtils.showSelect2ElementView(selectElement,{maximumSelectionSize: 25});
	},

	/**
	 * Function which will get the selected columns with order preserved
	 * @return : array of selected values in order
	 */
	getSelectedColumns : function() {
		var columnListSelectElement = this.getReportsColumnsList();
		var select2Element = jQuery('#s2id_reportsColumnsList');
		var selectedValuesByOrder = new Array();
		var selectedOptions = columnListSelectElement.find('option:selected');

		var orderedSelect2Options = select2Element.find('li.select2-search-choice').find('div');
		orderedSelect2Options.each(function(index,element){
			var chosenOption = jQuery(element);
			var choiceElement = chosenOption.closest('.select2-search-choice');
			var choiceValue = choiceElement.data('select2Data').id;
			selectedOptions.each(function(optionIndex, domOption){
				var option = jQuery(domOption);
				if(option.val() == choiceValue) {
					selectedValuesByOrder.push(option.val());
					return false;
				}
			});
		});
		return selectedValuesByOrder;
	},

	/**
	 * Function which will arrange the select2 element choices in order
	 */
	arrangeSelectChoicesInOrder : function() {
		var selectElement = this.getReportsColumnsList();
		var chosenElement = app.getSelect2ElementFromSelect(selectElement);
		var choicesContainer = chosenElement.find('ul.select2-choices');
		var choicesList = choicesContainer.find('li.select2-search-choice');

		//var coulmnListSelectElement = Vtiger_CustomView_Js.getColumnSelectElement();
		var selectedOptions = selectElement.find('option:selected');
		var selectedOrder = JSON.parse(this.getSelectedFields().val());
		var selectedOrderKeys = [];
		for(var key in selectedOrder) {
			if(selectedOrder.hasOwnProperty(key)){
				selectedOrderKeys.push(key);
			}
		}
		for(var index=selectedOrderKeys.length ; index > 0 ; index--) {
			var selectedValue = selectedOrder[selectedOrderKeys[index-1]];
			//We should consider value as string 
			var colonEscapedValue = selectedValue.replace(":", "\\:");
			var option = selectedOptions.filter('[value="'+colonEscapedValue+'"]'); 
			choicesList.each(function(choiceListIndex,element){
				var liElement = jQuery(element);
				if(liElement.find('div').html() == option.html()){
					choicesContainer.prepend(liElement);
					return false;
				}
			});
		}
	},

	/**
	 * Function to regiser the event to make the columns list sortable
	 */
	makeColumnListSortable : function() {
		var select2Element = jQuery('#s2id_reportsColumnsList');
		//TODO : peform the selection operation in context this might break if you have multi select element in advance filter
		//The sorting is only available when Select2 is attached to a hidden input field.
		var chozenChoiceElement = select2Element.find('ul.select2-choices');
		chozenChoiceElement.sortable({
                containment: chozenChoiceElement,
                start: function() {},
                update: function() {}
            });
	},

	/**
	 * Function is used to limit the calculation for line item fields and inventory module fields.
	 * only one of these fields can be used at a time
	 */
	registerLineItemCalculationLimit : function() {
		var thisInstance = this;
		var primaryModule = jQuery('input[name="primary_module"]').val();
        var inventoryModules = ['Invoice', 'Quotes', 'PurchaseOrder', 'SalesOrder'];
        // To limit the calculation fields if secondary module contains inventoryModule
        var secodaryModules = jQuery('input[name="secondary_modules"]').val();
        var secondaryIsInventory = false;
		inventoryModules.forEach(function(entry){
           if(secodaryModules.indexOf(entry) != -1){
               secondaryIsInventory = true;
           } 
        });
		if(jQuery.inArray(primaryModule, inventoryModules) !== -1 || secondaryIsInventory) {
			jQuery('.CalculationFields').on('change', 'input[type="checkbox"]', function(e) {
				var element = jQuery(e.currentTarget);
				var value = element.val();
				var reg = new RegExp(/cb:vtiger_inventoryproductrel*/);
				var attr = element.is(':checked');
				var moduleCalculationFields = jQuery('.CalculationFields input[type="checkbox"]').not('[value^="cb:vtiger_inventoryproductrel"]');
				var lineItemCalculationFields = jQuery('.CalculationFields').find('[value^="cb:vtiger_inventoryproductrel"]');
				if(reg.test(value)) {	// line item field selected
					if(attr) {	// disable all the other checkboxes
						moduleCalculationFields.attr('checked',false).attr('disabled',true);
					} else {
						var otherLineItemFieldsCheckedLength = lineItemCalculationFields.filter(':checked').length;
						if(otherLineItemFieldsCheckedLength == 0) moduleCalculationFields.attr('disabled',false);
						else moduleCalculationFields.attr('checked',false).attr('disabled',true);
					}
				} else {		// some other field is selected
					if(attr) {
						lineItemCalculationFields.attr('checked',false).attr('disabled',true)
					} else {
						var moduleCalculationFieldLength = moduleCalculationFields.filter(':checked').length
						if(moduleCalculationFieldLength == 0) lineItemCalculationFields.attr('disabled', false);
						else lineItemCalculationFields.attr('disabled', true).attr('checked',false);
					}
				}
				thisInstance.displayLineItemFieldLimitationMessage();
			});
		}
	},
	
	displayLineItemFieldLimitationMessage : function() {
		var message = app.vtranslate('JS_CALCULATION_LINE_ITEM_FIELDS_SELECTION_LIMITATION');
		if(jQuery('#calculationLimitationMessage').length == 0) {
			jQuery('.CalculationFields').parent().append('<div id="calculationLimitationMessage" class="alert alert-info">'+message+'</div>');
		} else {
			jQuery('#calculationLimitationMessage').html(message);
		}
	},

	registerLineItemCalculationLimitOnLoad : function() {
		var moduleCalculationFields = jQuery('.CalculationFields input[type="checkbox"]').not('[value^="cb:vtiger_inventoryproductrel"]');
		var lineItemFields = jQuery('.CalculationFields').find('[value^="cb:vtiger_inventoryproductrel"]');
		if(moduleCalculationFields.filter(':checked').length != 0) {
			lineItemFields.attr('checked', false).attr('disabled', true);
			this.displayLineItemFieldLimitationMessage();
		} else if(lineItemFields.filter(':checked').length != 0) {
			moduleCalculationFields.attr('checked', false).attr('disabled', true);
			this.displayLineItemFieldLimitationMessage();
		}
	},

	registerEvents : function(){
		var container = this.getContainer();
		//If the container is reloading, containers cache should be reset
		this.reportsColumnsList = false;
		this.selectedFields = false;
		this.registerLineItemCalculationLimit();
		this.registerLineItemCalculationLimitOnLoad();
		vtUtils.applyFieldElementsView(container);
		this.registerSelect2ElementForReportColumns();
                this.arrangeSelectChoicesInOrder();
                this.makeColumnListSortable();
		if (window.ReportsAdvancedMetricsBuilder) {
			window.ReportsAdvancedMetricsBuilder.init(container);
		}
	}
});


