/* * *******************************************************************************
 * The content of this file is subject to the CRMTiger Pro license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is https://crmtiger.com/
 * Portions created by CRMTiger.com are Copyright(C) CRMTiger.com
 * All Rights Reserved.
 * ****************************************************************************** */
Vtiger.Class(
  "Settings_CTFacebookMessengerIntegration_CTFacebookMessengerIntegration_Js",
  {},
  {
    registerEventForLoginWithFacebook: function () {
      jQuery("#loginWithFacebook").on("click", function () {
        FB.login(
          function (response) {
            if (response.authResponse) {
              var name = "";
              var expiresIn = "";
              FB.api("/me", { fields: "name" }, function (responseData) {
                name = responseData.name;
                var accessToken = response.authResponse.accessToken;
                var expiresIn = response.authResponse.expiresIn;
                var params = {
                  module: app.getModuleName(),
                  parent: app.getParentModuleName(),
                  action: "CTFacebookMessengerSaveAccessToken",
                  accessToken: accessToken,
                  userName: name,
                  expiresIn: expiresIn,
                };

                AppConnector.request(params).then(function (data) {
                  if (data) {
                    window.location.href = data.result.redirectURL;
                  }
                });
              });
            }
          },
          {
            scope: [
              "public_profile",
              "pages_show_list",
              "pages_messaging",
              "pages_manage_metadata",
              "business_management",
            ],
          }
        );
      });
    },

    registerEventsForAddNewFacebookPages: function () {
      var thisInstance = this;
      jQuery("#addRecords").on("click", function (e) {
        thisInstance.openFacebookPageConfigPopup("");
      });
    },

    registerFacebookActiveCheckBoxEvent: function () {
      $("#facebookConfigActive").live("change", function () {
        if ($(this).is(":checked")) {
          $(this).val("1");
        } else {
          $(this).val("0");
        } //end of else
      }); //end of function
    },

    registerSaveFacebookPageConfigEvent: function () {
      $("#saveFacebookPageConfig").live("click", function () {
        var pageId = $("#pageId").val();
        var userGroupList = $("#facebookUsersGroups").val();
        var recordId = $("#recordId").val();
        if (pageId != "" && userGroupList != "" && userGroupList != null) {
          app.helper.showProgress();
          var formData = $("form#facebookPageConfig").serialize();
          var formDetails = encodeURIComponent(formData);
          var params = {
            module: app.getModuleName(),
            parent: app.getParentModuleName(),
            view: "CTFacebookChatConfiguration",
            mode: "saveFacebookPageConfig",
            formData: formDetails,
          };
          AppConnector.request(params).then(function (data) {
            app.helper.hideProgress();
            app.helper.hideModal();
            if (recordId != "") {
              app.helper.showSuccessNotification({
                message: app.vtranslate("LBL_FACEBOOK_CONFIG_PAGE_UPDATED"),
              });
            } else {
              app.helper.showSuccessNotification({
                message: app.vtranslate("LBL_FACEBOOK_CONFIG_PAGE_ADDED"),
              });
            } //end of else

            if (data.result.pageHtml != "") {
              $(".facebookPageData tbody").empty();
              $(".facebookPageData tbody").append(data.result.pageHtml);
            } //end of if
            //location.reload();
          });
        } else {
          app.helper.showErrorNotification({
            message: app.vtranslate("LBL_REQUIRED_FIELD_VALIDATION"),
          });
          return false;
        }
      }); //end of function
    },

    registerEditDeleteFacebookPageConfigEvent: function () {
      var thisInstance = this;
      $(".editFacebookPageConfig").live("click", function () {
        var recordId = $(this).attr("data-id");
        thisInstance.openFacebookPageConfigPopup(recordId);
      });

      $(".deleteFacebookPageConfig").live("click", function () {
        var recordId = $(this).attr("data-id");

        var deleteMessage = app.vtranslate("LBL_DELETE_CONFIRMATION_MESSAGE");
        app.helper
          .showConfirmationBox({ message: deleteMessage })
          .then(function (data) {
            var params = {
              module: app.getModuleName(),
              parent: app.getParentModuleName(),
              view: "CTFacebookChatConfiguration",
              mode: "deleteFacebookPageConfig",
              recordId: recordId,
            };
            AppConnector.request(params).then(function (response) {
              location.reload();
            });
          });
      });
    },

    openFacebookPageConfigPopup: function (recordId) {
      var params = {
        module: app.getModuleName(),
        parent: app.getParentModuleName(),
        view: "CTFacebookChatConfiguration",
        mode: "addFacebookPagesPopup",
        recordId: recordId,
      };

      app.helper.showProgress();
      AppConnector.request(params).then(function (data) {
        app.helper.hideProgress();
        app.showModalWindow(data, function (data) {
          if (recordId == "") {
            $("#facebookConfigActive").prop("checked", true);
          } //end of if
        });
      });
    },

    registerEventsForEnableConfigStatus: function () {
      jQuery("#enableConfigStatusSync").live(
        "switchChange.bootstrapSwitch",
        function (e) {
          var currentElement = jQuery(e.currentTarget);
          if (currentElement.val() == "on") {
            currentElement.attr("value", "off");
          } else {
            currentElement.attr("value", "on");
          }

          var params = {
            module: app.getModuleName(),
            parent: app.getParentModuleName(),
            view: "CTFacebookChatConfiguration",
            mode: "changeStatusFacebookPageConfig",
            recordId: currentElement.attr("data-id"),
            status: currentElement.val(),
          };

          AppConnector.request(params).then(function (data) {
            if (data) {
              if (currentElement.val() == "on") {
                app.helper.showSuccessNotification({
                  message: app.vtranslate("JS_FACEBOOK_CONFIG_STATUS_ENABLED"),
                });
              } else {
                app.helper.showSuccessNotification({
                  message: app.vtranslate("JS_FACEBOOK_CONFIG_STATUS_DISABLED"),
                });
              }
            }
          });
        }
      );
    },

    registerEventsForValidateFacebookPage: function () {
      $("#pageId").live("change", function () {
        var thisInstance = this;
        var currentPageId = $(this).val();

        var params = {
          module: app.getModuleName(),
          parent: app.getParentModuleName(),
          view: "CTFacebookChatConfiguration",
          mode: "checkFacebookPageConfigValidation",
          pageId: currentPageId,
        };

        AppConnector.request(params).then(function (response) {
          if (response.result.trim() != "") {
            $("#pageId").val("").trigger("change.select2");
            app.helper.showErrorNotification({
              message: app.vtranslate("LBL_DUPLICATE_FACEBOOK_PAGE"),
            });
          }
        });
      });
    },

    registerEventForLogoutWithFacebook: function () {
      jQuery("#logoutLink").on("click", function () {
        var params = {
          module: app.getModuleName(),
          parent: app.getParentModuleName(),
          view: "CTFacebookChatConfiguration",
          mode: "logoutFacebook",
        };

        AppConnector.request(params).then(function (data) {
          if (data) {
            window.location.href = data.result.redirectURL;
          }
        });
      });
    },

    registerEventForSyncFacebookPages: function () {
      jQuery("span#syncFBPages").live("click", function () {
        app.helper.showProgress();
        var params = {
          module: app.getModuleName(),
          parent: app.getParentModuleName(),
          view: "CTFacebookChatConfiguration",
          mode: "syncFacebookPages",
        };

        AppConnector.request(params).then(function (data) {
          app.helper.hideProgress();
          if (data.result.facebookPageList) {
            $("#pageId").empty();
            $("#pageId").append('<option value="">Select an Option</option>');
            $.each(data.result.facebookPageList, function (index, value) {
              $("#pageId").append(
                '<option value="' + index + '">' + value + "</option>"
              );
            });
            app.helper.showSuccessNotification({
              message: app.vtranslate("LBL_FACEBOOK_PAGES_SYNCED_SUCCESSFULLY"),
            });
          } else {
            app.helper.showErrorNotification({
              message: app.vtranslate("LBL_NO_PAGE_IN_FACEBOOK"),
            });
          }
        });
      });
    },

    registerSaveFacebookGeneralSettingsEvent: function () {
      $("#saveFacebookGeneralSetting").on("click", function () {
        app.helper.showProgress();
        var flag = 0;
        if (flag == 0) {
          var formData = $("form#generalSettingsForm").serialize();
          var params = {
            module: app.getModuleName(),
            parent: app.getParentModuleName(),
            view: "CTGeneralConfiguration",
            mode: "saveFacebookGeneralSettings",
            formData: formData,
          };
          AppConnector.request(params).then(function (data) {
            app.helper.hideProgress();
            if (data.result.existPageConfig == 0) {
              app.helper.showErrorNotification({
                message: app.vtranslate(
                  "LBL_PLEASE_CONFIGURE_ONE_FACEBOOK_PAGE"
                ),
              });
            } else if (data.result.existModuleConfig == 0) {
              app.helper.showErrorNotification({
                message: app.vtranslate("LBL_PLEASE_SELECT_FACEBOOK_MODULE"),
              });
            } else {
              window.location.href =
                "index.php?parent=Settings&module=CTFacebookMessengerIntegration&view=CTGeneralConfiguration";
            }
          });
        } //end of if
      }); //end of function
    },

    registerEventsForLicense: function () {
      jQuery("#saveLicense").on("click", function (e) {
        var moduleName = app.getModuleName();
        var currentDomain = window.location.origin;

        var key = $("#licence").val();
        if (key == "") {
          text = "Please Enter License Key";
          app.helper.showErrorNotification({ message: text });
          return false;
        }
        var licenseParams = {
          module: moduleName,
          parent: app.getParentModuleName(),
          view: "License",
          licensekey: key,
          mode: "ActivateLicense",
        };

        var progressIndicatorElement = jQuery.progressIndicator({
          position: "html",
          blockInfo: {
            enabled: true,
          },
        });
        AppConnector.request(licenseParams).then(
          function (data) {
            progressIndicatorElement.progressIndicator({
              mode: "hide",
            });
            if (data.result == 1) {
              location.reload();
            } else if (data.result == 2) {
              text =
                "This License key alredy activated for this Domain : " +
                currentDomain;
              app.helper.showErrorNotification({ message: text });
            } else {
              text = "Please Enter Valid License key!";
              app.helper.showErrorNotification({ message: text });
            }
          },
          function (error, err) {}
        );
      });
    },

    registerAppTriggerEvent: function () {
      var view = app.view();
      if (view != "SettingList" && view != "AddNew") {
        jQuery(".app-menu").removeClass("hide");
        var toggleAppMenu = function (type) {
          var appMenu = jQuery(".app-menu");
          var appNav = jQuery(".app-nav");
          appMenu.appendTo("#page");
          appMenu.css({
            top: appNav.offset().top + appNav.height(),
            left: 0,
          });
          if (typeof type === "undefined") {
            type = appMenu.is(":hidden") ? "show" : "hide";
          }
          if (type == "show") {
            appMenu.show(200, function () {});
          } else {
            appMenu.hide(200, function () {});
          }
        };

        jQuery(".app-trigger, .app-icon, .app-navigator").on(
          "click",
          function (e) {
            e.stopPropagation();
            toggleAppMenu();
          }
        );

        jQuery("html").on("click", function () {
          toggleAppMenu("hide");
        });

        jQuery(document).keyup(function (e) {
          if (e.keyCode == 27) {
            if (!jQuery(".app-menu").is(":hidden")) {
              toggleAppMenu("hide");
            }
          }
        });

        jQuery(".app-modules-dropdown-container").hover(
          function (e) {
            var dropdownContainer = jQuery(e.currentTarget);
            jQuery(".dropdown").removeClass("open");
            if (dropdownContainer.length) {
              if (dropdownContainer.hasClass("dropdown-compact")) {
                dropdownContainer
                  .find(".app-modules-dropdown")
                  .css("top", dropdownContainer.position().top - 8);
              } else {
                dropdownContainer.find(".app-modules-dropdown").css("top", "");
              }
              dropdownContainer
                .addClass("open")
                .find(".app-item")
                .addClass("active-app-item");
            }
          },
          function (e) {
            var dropdownContainer = jQuery(e.currentTarget);
            dropdownContainer.find(".app-item").removeClass("active-app-item");
            setTimeout(function () {
              if (
                dropdownContainer.find(".app-modules-dropdown").length &&
                !dropdownContainer.find(".app-modules-dropdown").is(":hover") &&
                !dropdownContainer.is(":hover")
              ) {
                dropdownContainer.removeClass("open");
              }
            }, 500);
          }
        );

        jQuery(".app-item").on("click", function () {
          var url = jQuery(this).data("defaultUrl");
          if (url) {
            window.location.href = url;
          }
        });

        jQuery(window).resize(function () {
          jQuery(".app-modules-dropdown").mCustomScrollbar("destroy");
          app.helper.showVerticalScroll(
            jQuery(".app-modules-dropdown").not(".dropdown-modules-compact"),
            {
              setHeight: $(window).height(),
              autoExpandScrollbar: true,
            }
          );
          jQuery(".dropdown-modules-compact").each(function () {
            var element = jQuery(this);
            var heightPer = parseFloat(element.data("height"));
            app.helper.showVerticalScroll(element, {
              setHeight: $(window).height() * heightPer - 3,
              autoExpandScrollbar: true,
              scrollbarPosition: "outside",
            });
          });
        });
        app.helper.showVerticalScroll(
          jQuery(".app-modules-dropdown").not(".dropdown-modules-compact"),
          {
            setHeight: $(window).height(),
            autoExpandScrollbar: true,
            scrollbarPosition: "outside",
          }
        );
        jQuery(".dropdown-modules-compact").each(function () {
          var element = jQuery(this);
          var heightPer = parseFloat(element.data("height"));
          app.helper.showVerticalScroll(element, {
            setHeight: $(window).height() * heightPer - 3,
            autoExpandScrollbar: true,
            scrollbarPosition: "outside",
          });
        });
      }
    },

    registerQuickCreateEvent: function () {
      var thisInstance = this;
      jQuery("#quickCreateModules").on(
        "click",
        ".quickCreateModule",
        function (e, params) {
          var quickCreateElem = jQuery(e.currentTarget);
          var quickCreateUrl = quickCreateElem.data("url");
          var quickCreateModuleName = quickCreateElem.data("name");
          if (typeof params === "undefined") {
            params = {};
          }
          if (typeof params.callbackFunction === "undefined") {
            params.callbackFunction = function (data, err) {
              //fix for Refresh list view after Quick create
              var parentModule = app.getModuleName();
              var viewname = app.view();
              if (
                (quickCreateModuleName == parentModule ||
                  (quickCreateModuleName == "Events" &&
                    parentModule == "Calendar")) &&
                viewname == "List"
              ) {
                var listinstance = app.controller();
                listinstance.loadListViewRecords();
              }
            };
          }
          app.helper.showProgress();
          thisInstance
            .getQuickCreateForm(quickCreateUrl, quickCreateModuleName, params)
            .then(function (data) {
              app.helper.hideProgress();
              var callbackparams = {
                cb: function (container) {
                  thisInstance.registerPostReferenceEvent(container);
                  app.event.trigger("post.QuickCreateForm.show", form);
                  app.helper.registerLeavePageWithoutSubmit(form);
                  app.helper.registerModalDismissWithoutSubmit(form);
                },
                backdrop: "static",
                keyboard: false,
              };

              app.helper.showModal(data, callbackparams);
              var form = jQuery('form[name="QuickCreate"]');
              var moduleName = form.find('[name="module"]').val();
              var Options = {
                scrollInertia: 200,
                autoHideScrollbar: true,
                setHeight:
                  jQuery(window).height() -
                  jQuery('form[name="QuickCreate"] .modal-body')
                    .find(".modal-header")
                    .height() -
                  jQuery('form[name="QuickCreate"] .modal-body')
                    .find(".modal-footer")
                    .height() -
                  135,
              };
              app.helper.showVerticalScroll(
                jQuery('form[name="QuickCreate"] .modal-body'),
                Options
              );

              var targetInstance = thisInstance;
              var moduleInstance =
                Vtiger_Edit_Js.getInstanceByModuleName(moduleName);
              if (typeof moduleInstance.quickCreateSave === "function") {
                targetInstance = moduleInstance;
                targetInstance.registerBasicEvents(form);
              }

              vtUtils.applyFieldElementsView(form);
              targetInstance.quickCreateSave(form, params);
            });
        }
      );
    },

    getQuickCreateForm: function (url, moduleName, params) {
      var aDeferred = jQuery.Deferred();
      var requestParams = app.convertUrlToDataParams(url);
      jQuery.extend(requestParams, params.data);
      app.request.post({ data: requestParams }).then(function (err, data) {
        aDeferred.resolve(data);
      });
      return aDeferred.promise();
    },

    registerPostReferenceEvent: function (container) {
      var thisInstance = this;
      container
        .find(".sourceField")
        .on(Vtiger_Edit_Js.postReferenceSelectionEvent, function (e, result) {
          var dataList = result.data;
          var element = jQuery(e.currentTarget);

          if (typeof element.data("autofill") != "undefined") {
            thisInstance.autoFillElement = element;
            if (typeof dataList.id == "undefined") {
              thisInstance.postRefrenceComplete(dataList, container);
            } else {
              thisInstance.postRefrenceSearch(dataList, container);
            }
          }
        });
    },

    registerPostQuickCreateEvent: function () {
      var thisInstance = this;
      app.event.on("post.QuickCreateForm.show", function (event, form) {
        form.find("#goToFullForm").on("click", function (e) {
          window.onbeforeunload = true;
          var form = jQuery(e.currentTarget).closest("form");
          var editViewUrl = jQuery(e.currentTarget).data("editViewUrl");
          if (typeof goToFullFormCallBack != "undefined") {
            goToFullFormCallBack(form);
          }
          thisInstance.quickCreateGoToFullForm(form, editViewUrl);
        });
      });
    },

    quickCreateGoToFullForm: function (form, editViewUrl) {
      var formData = form.serializeFormData();
      //As formData contains information about both view and action removed action and directed to view
      delete formData.module;
      delete formData.action;
      delete formData.picklistDependency;
      var formDataUrl = jQuery.param(formData);
      var completeUrl = editViewUrl + "&" + formDataUrl;
      window.location.href = completeUrl;
    },

    registerEventsForGetModulesField: function () {
      jQuery("#select_module").live("change", function (e) {
        var select_module = jQuery("#select_module").val();
        var moduleName = app.getModuleName();

        var params = {
          module: moduleName,
          parent: app.getParentModuleName(),
          view: "CTFacebookChatConfiguration",
          mode: "getModuleFields",
          select_module: select_module,
        };
        var progressIndicatorElement = jQuery.progressIndicator({
          position: "html",
          blockInfo: {
            enabled: true,
          },
        });
        AppConnector.request(params).then(function (data) {
          progressIndicatorElement.progressIndicator({
            mode: "hide",
          });

          jQuery("#field").val("");
          jQuery("#field").html(data.result["picklist"]);
          jQuery("#field").trigger("change");
          if (data.result["rows"] != 0) {
            if (data.result["active"] == 1) {
              $("#active").prop("checked", true);
              $("#active").val(1);
            } else {
              $("#active").prop("checked", false);
            }
          }
        });
      });

      jQuery("#editFacebookModule").live("click", function (e) {
        var currentTarget = jQuery(e.currentTarget);
        var moduleName = app.getModuleName();
        var params = {
          module: moduleName,
          parent: app.getParentModuleName(),
          view: "CTFacebookChatConfiguration",
          mode: "addNewFBFieldPopup",
        };

        var progressIndicatorElement = jQuery.progressIndicator({
          position: "html",
          blockInfo: {
            enabled: true,
          },
        });

        AppConnector.request(params).then(function (data) {
          progressIndicatorElement.progressIndicator({
            mode: "hide",
          });
          app.showModalWindow(data, function (data) {
            setTimeout(function () {
              var facebookModuleName = currentTarget.data("facebookmodulename");
              jQuery("#select_module").val(facebookModuleName);
              jQuery("#select_module").trigger("change");
            }, 1000);
          });
        });
      });

      jQuery(".addNewFBField").on("click", function (e) {
        var moduleName = app.getModuleName();
        var params = {
          module: moduleName,
          parent: app.getParentModuleName(),
          view: "CTFacebookChatConfiguration",
          mode: "addNewFBFieldPopup",
        };

        AppConnector.request(params).then(function (data) {
          app.showModalWindow(data, function (data) {
            //console.log(data);
            $("#active").prop("checked", true);
          });
        });
      });

      jQuery("#submitbutton").live("click", function (e) {
        var moduleName = app.getModuleName();
        var select_module = jQuery("#select_module").val();
        if (select_module == "") {
          var params = {
            title: app.vtranslate("LBL_JS_SELECT_MODULE"),
            text: app.vtranslate("LBL_JS_SELECT_MODULE"),
            animation: "show",
            type: "error",
          };
          Vtiger_Helper_Js.showPnotify(params);
          return false;
        }

        if ($("#active").is(":checked")) {
          var facebookActive = "1";
        } else {
          var facebookActive = "0";
        }

        var params = {
          module: moduleName,
          parent: app.getParentModuleName(),
          view: "CTFacebookChatConfiguration",
          mode: "saveFBField",
          select_module: select_module,
          facebookActive: facebookActive,
        };

        app.helper.showProgress();
        AppConnector.request(params).then(function (data) {
          app.helper.hideProgress();
          location.reload();
        });
      });

      jQuery('input[name="active"]').click(function () {
        if (jQuery(this).prop("checked") == true) {
          jQuery("#active").val(1);
        } else if (jQuery(this).prop("checked") == false) {
          jQuery("#active").val(0);
        }
      });
    },

    registerEvents: function () {
      if (jQuery("input[name='enableConfigStatusSync']").length) {
        jQuery("input[name='enableConfigStatusSync']").bootstrapSwitch();
      }
      this.registerQuickCreateEvent();
      this.registerAppTriggerEvent();
      this.registerEventForLoginWithFacebook();
      this.registerFacebookActiveCheckBoxEvent();
      this.registerEventsForAddNewFacebookPages();
      this.registerSaveFacebookPageConfigEvent();
      this.registerEditDeleteFacebookPageConfigEvent();
      this.registerEventsForEnableConfigStatus();
      this.registerEventsForValidateFacebookPage();
      this.registerEventForLogoutWithFacebook();
      this.registerEventForSyncFacebookPages();
      this.registerSaveFacebookGeneralSettingsEvent();
      this.registerEventsForLicense();
      this.registerEventsForGetModulesField();
    },
  }
);

jQuery(document).ready(function () {
  // Force reload - Updated Oct 31, 2025
  var instance =
    new Settings_CTFacebookMessengerIntegration_CTFacebookMessengerIntegration_Js();
  instance.registerEvents();
  jQuery.getScript(
    "https://connect.facebook.net/en_US/sdk.js?v=" + Date.now(),
    function () {
      FB.init({
        appId: "2172701849919651",
        autoLogAppEvents: true,
        xfbml: true,
        version: "v19.0",
      });
    }
  );

  $("#facebookGeneralSettingActive").prop("checked", true);

  jQuery("#deletedFacebookModule").live("click", function (e) {
    var currentTarget = jQuery(e.currentTarget);
    var facebookModuleName = currentTarget.data("facebookmodulename");
    var moduleName = app.getModuleName();
    var params = {
      module: moduleName,
      parent: app.getParentModuleName(),
      action: "deleteWModule",
      dmodule: facebookModuleName,
    };
    var message1 = app.vtranslate("DELETEMODULE");
    app.helper.showConfirmationBox({ message: message1 }).then(function (data) {
      app.helper.showProgress();
      app.request.post({ data: params }).then(function (err, response) {
        app.helper.hideProgress();
        location.reload();
      });
    });
  });
});
