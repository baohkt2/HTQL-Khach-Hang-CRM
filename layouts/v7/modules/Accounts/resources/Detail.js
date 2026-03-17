/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

Vtiger_Detail_Js("Accounts_Detail_Js",{
	//It stores the Account Hierarchy response data
	accountHierarchyResponseCache : {},

	/*
	 * function to trigger Account Hierarchy action
	 * @param: Account Hierarchy Url.
	 */
	triggerAccountHierarchy : function(accountHierarchyUrl) {
		Accounts_Detail_Js.getAccountHierarchyResponseData(accountHierarchyUrl).then(
			function(data) {
				Accounts_Detail_Js.displayAccountHierarchyResponseData(data);
			}
		);

	},

	triggerCloseSchool : function(recordId) {
		var requestParams = {
			module: 'Accounts',
			view: 'CloseSchoolPopup',
			record: recordId
		};

		app.helper.showProgress();
		app.request.get({data: requestParams}).then(function(err, data) {
			app.helper.hideProgress();
			if (err !== null) {
				app.helper.showErrorNotification({message: app.vtranslate('JS_CLOSE_SCHOOL_FAILED')});
				return;
			}

			app.helper.showModal(data, {
				cb: function(modalContainer) {
					var form = modalContainer.find('form[name="closeSchoolForm"]');
					modalContainer.find('#selectAllCloseSchoolFields').on('change', function(e) {
						var checked = jQuery(e.currentTarget).is(':checked');
						form.find('.inheritFieldCheckbox').not(':disabled').prop('checked', checked);
					});

					form.on('submit', function(submitEvent) {
						submitEvent.preventDefault();
						var submitPayload = form.serializeFormData();
						app.helper.showConfirmationBox({message: app.vtranslate('JS_CLOSE_SCHOOL_CONFIRM')}).then(function() {
							app.helper.showProgress();
							app.request.post({data: submitPayload}).then(function(postErr, postData) {
								app.helper.hideProgress();
								if (postErr === 'parsererror') {
									window.location.reload();
									return;
								}
								var requestSucceeded = (postErr === null) && postData && (postData.success === true || typeof postData.result !== 'undefined');
								if (!requestSucceeded) {
									var errorMessage = app.vtranslate('JS_CLOSE_SCHOOL_FAILED');
									if (postErr && postErr.message) {
										errorMessage = postErr.message;
									} else if (postData && postData.error && postData.error.message) {
										errorMessage = postData.error.message;
									}
									app.helper.showErrorNotification({message: errorMessage});
									return;
								}

								app.helper.hideModal();
								app.helper.showSuccessNotification({message: app.vtranslate('JS_CLOSE_SCHOOL_SUCCESS')});
								if (postData.result && postData.result.newRecordId) {
									window.location.href = 'index.php?module=Accounts&view=Detail&record=' + postData.result.newRecordId;
								} else {
									window.location.reload();
								}
							});
						});
					});
				}
			});
		});
	},

	/*
	 * function to get the AccountHierarchy response data
	 */
	getAccountHierarchyResponseData : function(url) {
		var aDeferred = jQuery.Deferred();

		//Check in the cache
		if(!(jQuery.isEmptyObject(Accounts_Detail_Js.accountHierarchyResponseCache))) {
			aDeferred.resolve(Accounts_Detail_Js.accountHierarchyResponseCache);
		} else {
			app.request.get({"url":url}).then(
				function(err,data) {
					//store it in the cache, so that we dont do multiple request
					Accounts_Detail_Js.accountHierarchyResponseCache = data;
					aDeferred.resolve(Accounts_Detail_Js.accountHierarchyResponseCache);
				}
			);
		}
		return aDeferred.promise();
	},

	/*
	 * function to display the AccountHierarchy response data
	 */
	displayAccountHierarchyResponseData : function(data) {
		var callbackFunction = function(data) {
			if(jQuery('#hierarchyScroll').height() > 300){
				app.helper.showVerticalScroll(jQuery('#hierarchyScroll'), {
					setHeight: '300px',
					autoHideScrollbar: false,
				});
			}
		}
		app.helper.showModal(data,{"cb":callbackFunction});
	}
},{
	/**
	 * To handle related record delete confirmation message
	 */
	getDeleteMessageKey : function() {
		return 'LBL_RELATED_RECORD_DELETE_CONFIRMATION';
	},

	/**
	 * Function to register event for adding related record for module
	 */
	registerEventForAddingRelatedRecord : function(){
		var thisInstance = this;
		var detailViewContainer = thisInstance.getDetailViewContainer();
		detailViewContainer.on('click','[name="addButton"]',function(e){
			var element = jQuery(e.currentTarget);
			var relatedModuleName = element.attr('module');
			var quickCreateNode = jQuery('#quickCreateModules').find('[data-name="'+ relatedModuleName +'"]');
			if(quickCreateNode.length <= 0) {
				window.location.href = element.data('url');
				return;
			}

			var relatedController = thisInstance.getRelatedController(relatedModuleName);
			var postPopupViewController = function() {
				var instance = new Contacts_Edit_Js();
				var data = new Object;
				var container = jQuery("[name='QuickCreate']");
				data.source_module = app.getModuleName();
				data.record = thisInstance.getRecordId();
				data.selectedName = container.find("[name='account_id_display']").val();
				instance.referenceSelectionEventHandler(data,container);
			}
			if(relatedModuleName == 'Contacts'){
				   relatedController.addRelatedRecord(element , postPopupViewController);
			}else{
				   relatedController.addRelatedRecord(element);
			}

		})
	},

});