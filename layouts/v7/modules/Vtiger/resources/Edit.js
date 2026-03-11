/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

Vtiger_Index_Js(
  "Vtiger_Edit_Js",
  {
    file: false,

    editInstance: false,

    recordPresaveEvent: "Pre.Record.Save",

    preReferencePopUpOpenEvent: "Vtiger.Referece.Popup.Pre",

    postReferencePopUpOpenEvent: "Vtiger.Referece.Popup.Post",

    referenceSelectionEvent: "Vtiger.Reference.Selection",

    postReferenceSelectionEvent: "Vtiger.PostReference.Selection",

    postReferenceQuickCreateSave: "Vtiger.PostReference.QuickCreateSave",

    refrenceMultiSelectionEvent: "Vtiger.MultiReference.Selection",

    postReferenceQuickCreateSaveEvent: "Vtiger.PostReferenceQuickCreate.Save",

    popupSelectionEvent: "Vtiger.Reference.Popup.Selection",

    referenceDeSelectionEvent: "Vtiger.Reference.Deselection",

    /**
     * Function to get Instance by name
     * @params moduleName:-- Name of the module to create instance
     */
    getInstanceByModuleName: function (moduleName) {
      if (typeof moduleName == "undefined") {
        moduleName = app.getModuleName();
      }
      var parentModule = app.getParentModuleName();
      if (parentModule == "Settings") {
        var moduleClassName = parentModule + "_" + moduleName + "_Edit_Js";
        if (typeof window[moduleClassName] == "undefined") {
          moduleClassName = moduleName + "_Edit_Js";
        }
        var fallbackClassName = parentModule + "_Vtiger_Edit_Js";
        if (typeof window[fallbackClassName] == "undefined") {
          fallbackClassName = "Vtiger_Edit_Js";
        }
      } else {
        moduleClassName = moduleName + "_Edit_Js";
        fallbackClassName = "Vtiger_Edit_Js";
      }
      if (typeof window[moduleClassName] != "undefined") {
        var instance = new window[moduleClassName]();
      } else {
        var instance = new window[fallbackClassName]();
      }
      return instance;
    },

    getInstance: function () {
      if (Vtiger_Edit_Js.editInstance == false) {
        var instance = Vtiger_Edit_Js.getInstanceByModuleName();
        Vtiger_Edit_Js.editInstance = instance;
        return instance;
      }
      return Vtiger_Edit_Js.editInstance;
    },
  },
  {
    editViewContainer: false,
    formValidatorInstance: false,

    getEditViewContainer: function () {
      if (this.editViewContainer === false) {
        this.editViewContainer = jQuery(".editViewPageDiv");
      }
      return this.editViewContainer;
    },
    setEditViewContainer: function (container) {
      this.editViewContainer = container;
    },

    formElement: false,

    getForm: function () {
      if (this.formElement === false) {
        this.formElement = jQuery("#EditView");
      }
      return this.formElement;
    },
    _moduleName: false,

    getModuleName: function () {
      if (this._moduleName != false) {
        return this._moduleName;
      }
      return app.module();
    },

    setModuleName: function (module) {
      this._moduleName = module;
      return this;
    },

    /**
     * Function which will give you all details of the selected record
     * @params - an Array of values like {'record' : recordId, 'source_module' : searchModule, 'selectedName' : selectedRecordName}
     */
    getRecordDetails: function (params) {
      var aDeferred = jQuery.Deferred();
      var url =
        "index.php?module=" +
        app.getModuleName() +
        "&action=GetData&record=" +
        params["record"] +
        "&source_module=" +
        params["source_module"];
      app.request.get({ url: url }).then(
        function (error, data) {
          if (error == null) {
            aDeferred.resolve(data);
          } else {
            //aDeferred.reject(data['message']);
          }
        },
        function (error) {
          aDeferred.reject();
        },
      );
      return aDeferred.promise();
    },

    /**
     * Function to Validate and Save Event
     * @returns {undefined}
     */
    registerValidation: function () {
      var editViewForm = this.getForm();
      this.formValidatorInstance = editViewForm.vtValidate({
        submitHandler: function () {
          var e = jQuery.Event(Vtiger_Edit_Js.recordPresaveEvent);
          app.event.trigger(e);
          if (e.isDefaultPrevented()) {
            return false;
          }
          window.onbeforeunload = null;
          editViewForm.find(".saveButton").attr("disabled", true);
          return true;
        },
      });
    },

    /**
     * Function which will register event to prevent form submission on pressing on enter
     * @params - container <jQuery> - element in which auto complete fields needs to be searched
     */
    registerPreventingEnterSubmitEvent: function (container) {
      container.on("keypress", function (e) {
        //Stop the submit when enter is pressed in the form
        var currentElement = jQuery(e.target);
        if (e.which == 13 && !currentElement.is("textarea")) {
          e.preventDefault();
        }
      });
    },

    /**
     * Function to register event for setting up picklistdependency
     * for a module if exist on change of picklist value
     */
    registerEventForPicklistDependencySetup: function (container) {
      var picklistDependcyElemnt = jQuery(
        '[name="picklistDependency"]',
        container,
      );
      if (picklistDependcyElemnt.length <= 0) {
        return;
      }
      var picklistDependencyMapping = JSON.parse(picklistDependcyElemnt.val());

      var sourcePicklists = Object.keys(picklistDependencyMapping);
      if (sourcePicklists.length <= 0) {
        return;
      }

      var sourcePickListNames = "";
      for (var i = 0; i < sourcePicklists.length; i++) {
        if (i != sourcePicklists.length - 1)
          sourcePickListNames += '[name="' + sourcePicklists[i] + '"],';
        else sourcePickListNames += '[name="' + sourcePicklists[i] + '"]';
      }
      var sourcePickListElements = container.find(sourcePickListNames);

      sourcePickListElements.on("change", function (e) {
        var currentElement = jQuery(e.currentTarget);
        var sourcePicklistname = currentElement.attr("name");
        var configuredDependencyObject =
          picklistDependencyMapping[sourcePicklistname];
        var selectedValue = currentElement.val();
        var targetObjectForSelectedSourceValue =
          configuredDependencyObject[selectedValue];
        var picklistmap = configuredDependencyObject["__DEFAULT__"];

        if (typeof targetObjectForSelectedSourceValue == "undefined") {
          targetObjectForSelectedSourceValue = picklistmap;
        }

        jQuery.each(
          picklistmap,
          function (targetPickListName, targetPickListValues) {
            var targetPickListMap =
              targetObjectForSelectedSourceValue[targetPickListName];
            if (typeof targetPickListMap == "undefined") {
              targetPickListMap = targetPickListValues;
            }
            var targetPickList = jQuery(
              '[name="' + targetPickListName + '"]',
              container,
            );
            if (targetPickList.length <= 0) {
              return;
            }

            var listOfAvailableOptions =
              targetPickList.data("availableOptions");
            if (typeof listOfAvailableOptions == "undefined") {
              listOfAvailableOptions = jQuery("option", targetPickList);
              targetPickList.data("available-options", listOfAvailableOptions);
            }

            var targetOptions = new jQuery();
            var optionSelector = [];
            optionSelector.push("");
            for (var i = 0; i < targetPickListMap.length; i++) {
              optionSelector.push(targetPickListMap[i]);
            }
            jQuery.each(listOfAvailableOptions, function (i, e) {
              var picklistValue = jQuery(e).val();
              if (jQuery.inArray(picklistValue, optionSelector) != -1) {
                targetOptions = targetOptions.add(jQuery(e));
              }
            });
            var targetPickListSelectedValue = "";
            var targetPickListSelectedValue = targetOptions
              .filter("[selected]")
              .val();
            if (targetPickListMap.length == 1) {
              var targetPickListSelectedValue = targetPickListMap[0]; // to automatically select picklist if only one picklistmap is present.
            }
            if (
              (targetPickListName == "group_id" ||
                targetPickListName == "assigned_user_id") &&
              jQuery("[name=" + sourcePicklistname + "]").val() == ""
            ) {
              return false;
            }
            targetPickList
              .html(targetOptions)
              .val(targetPickListSelectedValue)
              .trigger("change");
          },
        );
      });

      //To Trigger the change on load
      sourcePickListElements.trigger("change");
    },

    /**
     * Function to restrict phone fields to digits only (0-9).
     * Leading zeros (e.g. Vietnamese numbers starting with 0) are preserved.
     * Uses 'input' event to also catch paste and drag-drop.
     */
    registerPhoneFieldFilter: function (form) {
      form.on("input", ".phoneField", function () {
        var input = jQuery(this);
        var val = input.val();
        // Keep only digit characters 0-9
        var filtered = val.replace(/[^0-9]/g, "");
        if (val !== filtered) {
          input.val(filtered);
        }
      });
    },

    /**
     * === Phone Validation (Phase 2) ===
     * Validate số điện thoại khi lưu record:
     * 1. Kiểm tra độ dài dựa trên data-phone-limit (VD: "10" hoặc "8-11")
     * 2. Kiểm tra 3 chữ số đầu có nằm trong danh sách đầu số VN hợp lệ
     *
     * Danh sách đầu số sim di động Việt Nam (3 chữ số đầu):
     * - Viettel:     032,033,034,035,036,037,038,039,086,096,097,098
     * - Vinaphone:   081,082,083,084,085,088,091,094
     * - MobiFone:    070,076,077,078,079,089,090,093
     * - Vietnamobile: 056,058,092
     * - Gmobile:     059,099
     * - Itelecom:    087
     */
    registerPhoneValidation: function (form) {
      // Danh sách đầu số sim di động Việt Nam (3 chữ số đầu)
      var VN_PHONE_PREFIXES = [
        // Viettel
        "032",
        "033",
        "034",
        "035",
        "036",
        "037",
        "038",
        "039",
        "086",
        "096",
        "097",
        "098",
        // Vinaphone
        "081",
        "082",
        "083",
        "084",
        "085",
        "088",
        "091",
        "094",
        // MobiFone
        "070",
        "076",
        "077",
        "078",
        "079",
        "089",
        "090",
        "093",
        // Vietnamobile
        "056",
        "058",
        "092",
        // Gmobile
        "059",
        "099",
        // Itelecom
        "087",
      ];

      // Lắng nghe sự kiện Pre.Record.Save để validate trước khi lưu
      app.event.on(Vtiger_Edit_Js.recordPresaveEvent, function (e) {
        var phoneFields = form.find("input.phoneField[data-phone-limit]");

        phoneFields.each(function () {
          var input = jQuery(this);
          var value = input.val().trim();

          // Bỏ qua nếu trường rỗng (trường không bắt buộc)
          if (value === "") {
            return; // continue to next field
          }

          var phoneLimit = input.data("phone-limit");
          if (!phoneLimit) return;

          var limitStr = String(phoneLimit);
          var minLen, maxLen;

          // Parse limit: "10" => min=max=10, "8-11" => min=8, max=11
          if (limitStr.indexOf("-") !== -1) {
            var parts = limitStr.split("-");
            minLen = parseInt(parts[0], 10);
            maxLen = parseInt(parts[1], 10);
          } else {
            minLen = maxLen = parseInt(limitStr, 10);
          }

          // === Kiểm tra 1: Độ dài số điện thoại ===
          if (value.length < minLen || value.length > maxLen) {
            var labelElement = input
              .closest(".fieldValue, td.fieldValue, .editViewContents")
              .prev(".fieldLabel, td.fieldLabel");
            var fieldLabel =
              labelElement.text().replace(/\*/g, "").trim() ||
              input.attr("name");

            var errorMsg;
            if (minLen === maxLen) {
              // VD: "Số điện thoại [tên trường] phải có đúng 10 chữ số"
              errorMsg =
                'Số điện thoại "' +
                fieldLabel.trim() +
                '" phải có đúng ' +
                minLen +
                " chữ số (hiện tại: " +
                value.length +
                ")";
            } else {
              // VD: "Số điện thoại [tên trường] phải có từ 8 đến 11 chữ số"
              errorMsg =
                'Số điện thoại "' +
                fieldLabel.trim() +
                '" phải có từ ' +
                minLen +
                " đến " +
                maxLen +
                " chữ số (hiện tại: " +
                value.length +
                ")";
            }

            app.helper.showErrorNotification({ message: errorMsg });
            input.addClass("error").focus();
            e.preventDefault(); // Ngăn lưu record
            return false; // break each loop
          }

          // === Kiểm tra 2: Đầu số Việt Nam (3 chữ số đầu) ===
          if (value.length >= 3) {
            var prefix = value.substring(0, 3);
            if (jQuery.inArray(prefix, VN_PHONE_PREFIXES) === -1) {
              var labelElement = input
                .closest(".fieldValue, td.fieldValue, .editViewContents")
                .prev(".fieldLabel, td.fieldLabel");
              var fieldLabel =
                labelElement.text().replace(/\*/g, "").trim() ||
                input.attr("name");

              var errorMsg =
                'Số điện thoại "' +
                fieldLabel.trim() +
                '" có đầu số "' +
                prefix +
                '" không hợp lệ. Vui lòng nhập đầu số di động Việt Nam hợp lệ.';

              app.helper.showErrorNotification({ message: errorMsg });
              input.addClass("error").focus();
              e.preventDefault(); // Ngăn lưu record
              return false; // break each loop
            }
          }

          // Xóa class error nếu đã validate pass
          input.removeClass("error");
        });
      });
    },

    /**
     * === Age Validation (Phase 2) ===
     * Validate ràng buộc tuổi cho các trường ngày tháng có data-age-limit.
     * Ví dụ: thỏa 18 tuổi = ngày sinh phải trước ngày hôm nay ít nhất 18 năm.
     */
    registerAgeValidation: function (form) {
      app.event.on(Vtiger_Edit_Js.recordPresaveEvent, function (e) {
        var dateFields = form.find("input.dateField[data-age-limit]");

        dateFields.each(function () {
          var input = jQuery(this);
          var value = input.val().trim();

          // Bỏ qua nếu trống (trường không bắt buộc)
          if (value === "") {
            return;
          }

          var ageLimit = parseInt(input.data("age-limit"), 10);
          if (!ageLimit || ageLimit <= 0) return;

          // Đọc định dạng ngày của user (dd-mm-yyyy, mm-dd-yyyy, yyyy-mm-dd)
          var dateFormat = input.data("date-format") || "dd-mm-yyyy";
          var parts = value.split(/[-\/\.]/);
          var day, month, year;

          if (dateFormat.indexOf("yyyy") === 0) {
            // yyyy-mm-dd
            year = parseInt(parts[0], 10);
            month = parseInt(parts[1], 10) - 1;
            day = parseInt(parts[2], 10);
          } else if (dateFormat.indexOf("mm") === 0) {
            // mm-dd-yyyy
            month = parseInt(parts[0], 10) - 1;
            day = parseInt(parts[1], 10);
            year = parseInt(parts[2], 10);
          } else {
            // dd-mm-yyyy (default)
            day = parseInt(parts[0], 10);
            month = parseInt(parts[1], 10) - 1;
            year = parseInt(parts[2], 10);
          }

          if (isNaN(day) || isNaN(month) || isNaN(year)) return;

          var dob = new Date(year, month, day);
          var today = new Date();

          // Tính tuổi đúng: so sánh theo ngày/tháng trong năm
          var age = today.getFullYear() - dob.getFullYear();
          var monthDiff = today.getMonth() - dob.getMonth();
          if (
            monthDiff < 0 ||
            (monthDiff === 0 && today.getDate() < dob.getDate())
          ) {
            age--;
          }

          if (age < ageLimit) {
            var labelElement = input
              .closest(".fieldValue, td.fieldValue, .editViewContents")
              .prev(".fieldLabel, td.fieldLabel");
            var fieldLabel =
              labelElement.text().replace(/\*/g, "").trim() ||
              input.attr("name");

            var errorMsg =
              'Trường "' +
              fieldLabel.trim() +
              '" phải đạt tối thiểu ' +
              ageLimit +
              " tuổi (tuổi hiện tại: " +
              age +
              " tuổi)";

            app.helper.showErrorNotification({ message: errorMsg });
            input.addClass("error").focus();
            e.preventDefault();
            return false;
          }

          input.removeClass("error");
        });
      });
    },

    registerImageChangeEvent: function () {
      var formElement = this.getForm();
      formElement.find('input[name="imagename[]"]').on("change", function () {
        var deleteImageElement = jQuery(this)
          .closest("td.fieldValue")
          .find(".imageDelete");
        if (deleteImageElement.length) deleteImageElement.trigger("click");
      });
    },

    /**
     * Function to register event for image delete
     */
    registerEventForImageDelete: function () {
      var formElement = this.getForm();
      formElement.find(".imageDelete").on("click", function (e) {
        var element = jQuery(e.currentTarget);
        var imageId = element.closest("div").find("img").data().imageId;
        var parentTd = element.closest("td");
        var imageUploadElement = parentTd.find('[name="imagename[]"]');
        element.closest("div").remove();

        if (formElement.find("[name=imageid]").length !== 0) {
          var imageIdValue = JSON.parse(
            formElement.find("[name=imageid]").val(),
          );
          imageIdValue.push(imageId);
          formElement.find("[name=imageid]").val(JSON.stringify(imageIdValue));
        } else {
          var imageIdJson = [];
          imageIdJson.push(imageId);
          formElement.append(
            '<input type="hidden" name="imgDeleted" value="true" />',
          );
          formElement.append(
            '<input type="hidden" name="imageid" value="' +
              JSON.stringify(imageIdJson) +
              '" />',
          );
        }

        if (
          formElement.find(".imageDelete").length === 0 &&
          imageUploadElement.attr("data-rule-required") == "true"
        ) {
          imageUploadElement.removeClass("ignore-validation");
        }
      });
    },

    registerFileElementChangeEvent: function (container) {
      var thisInstance = this;
      container.on(
        "change",
        'input[name="imagename[]"],input[name="sentdocument"]',
        function (e) {
          if (e.target.type == "text") return false;
          var moduleName = jQuery('[name="module"]').val();
          if (moduleName == "Products") return false;
          Vtiger_Edit_Js.file = e.target.files[0];
          var element = container.find(
            '[name="imagename[]"],input[name="sentdocument"]',
          );
          //ignore all other types than file
          if (element.attr("type") != "file") {
            return;
          }
          var uploadFileSizeHolder = element
            .closest(".fileUploadContainer")
            .find(".uploadedFileSize");
          var fileSize = e.target.files[0].size;
          var fileName = e.target.files[0].name;
          var maxFileSize = thisInstance.getMaxiumFileUploadingSize(container);
          if (fileSize > maxFileSize) {
            alert(app.vtranslate("JS_EXCEEDS_MAX_UPLOAD_SIZE"));
            element.val("");
            uploadFileSizeHolder.text("");
          } else {
            if (container.length > 1) {
              jQuery("div.fieldsContainer")
                .find("form#I_form")
                .find('input[name="filename"]')
                .css("width", "80px");
              jQuery("div.fieldsContainer")
                .find("form#W_form")
                .find('input[name="filename"]')
                .css("width", "80px");
            } else {
              container.find('input[name="filename"]').css("width", "80px");
            }
            uploadFileSizeHolder.text(
              fileName +
                " " +
                thisInstance.convertFileSizeInToDisplayFormat(fileSize),
            );
          }

          jQuery(e.currentTarget).addClass("ignore-validation");
        },
      );
    },

    /**
     * Function to register Basic Events
     * @returns {undefined}
     */
    registerBasicEvents: function (form) {
      app.event.on("post.editView.load", function (event, container) {});
      this.registerEventForPicklistDependencySetup(form);
      this.registerFileElementChangeEvent(form);
      this.registerAutoCompleteFields(form);
      this.registerClearReferenceSelectionEvent(form);
      this.registerReferenceCreate(form);
      this.referenceModulePopupRegisterEvent(form);
      this.registerPhoneFieldFilter(form);
      this.registerPhoneValidation(form);
      this.registerAgeValidation(form);
      this.registerPostReferenceEvent(this.getEditViewContainer());
    },
    proceedRegisterEvents: function () {
      if (jQuery(".recordEditView").length > 0) {
        return true;
      } else {
        return false;
      }
    },

    registerPageLeaveEvents: function () {
      app.helper.registerLeavePageWithoutSubmit(this.getForm());
      app.helper.registerModalDismissWithoutSubmit(this.getForm());
    },

    registerEvents: function (callParent) {
      //donot call parent if registering Events from overlay.
      if (callParent != false) {
        this._super();
      }
      var editViewContainer = this.getEditViewContainer();
      this.registerPreventingEnterSubmitEvent(editViewContainer);
      this.registerBasicEvents(this.getForm());
      this.registerEventForImageDelete();
      this.registerImageChangeEvent();
      this.registerValidation();
      app.event.trigger("post.editView.load", editViewContainer);
      this.registerPageLeaveEvents();
    },
  },
);
