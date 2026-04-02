/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

Vtiger_List_Js('Contacts_List_Js', {
	triggerMarkAssignment: function (massActionUrl) {
		var listInstance = window.app.controller();
		var listSelectParams = listInstance.getListSelectAllParams();
		if (!listSelectParams) {
			listInstance.noRecordSelectedAlert();
			return;
		}

		app.helper.showProgress();
		app.request.get({ url: massActionUrl, data: listSelectParams }).then(function (error, data) {
			app.helper.hideProgress();
			if (error || !data) {
				app.helper.showErrorNotification({
					message: (error && error.message) ? error.message : (error || app.vtranslate('JS_ERROR'))
				});
				return;
			}

			app.helper.showModal(data, {
				cb: function () {
					var markAssignmentForm = jQuery('#markAssignment');
					markAssignmentForm.vtValidate({
						submitHandler: function (form) {
							listInstance.markAssignmentSave(jQuery(form));
							return false;
						}
					});
				}
			});
		});
	}
}, {
	markAssignmentSave: function (form) {
		var listInstance = window.app.controller();
		var listSelectParams = listInstance.getListSelectAllParams(false);
		if (!listSelectParams) {
			listInstance.noRecordSelectedAlert();
			return;
		}

		var formData = form.serializeFormData();
		var data = jQuery.extend(formData, listSelectParams);
		app.helper.showProgress();
		app.request.post({ data: data }).then(function (error, response) {
			app.helper.hideProgress();
			if (error) {
				app.event.trigger('post.save.failed', error);
				app.helper.showErrorNotification({
					message: (error && error.message) ? error.message : (error || app.vtranslate('JS_ERROR'))
				});
				return;
			}

			jQuery('.vt-notification').remove();
			app.helper.hideModal();
			listInstance.loadListViewRecords().then(function () {
				listInstance.clearList();
				app.helper.showSuccessNotification({
					message: (response && response.message) ? response.message : app.vtranslate('JS_MASS_EDIT_SUCCESSFUL')
				});
			});
		});
	},

	registerEvents: function () {
		this._super();
	}
});
