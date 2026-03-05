/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/
if (typeof Vtiger_Import_Js == "undefined") {
  Vtiger_Import_Js = {
    triggerImportAction: function (url) {
      var params = Vtiger_Import_Js.getDefaultParams();
      //Only for contacts and Calendar show landing page.
      if (params.module != "Contacts" && params.module != "Calendar") {
        Vtiger_Import_Js.showImportActionStepOne();
        return false;
      }
      params["mode"] = "landing";
      app.helper.showProgress();
      app.request.get({ data: params }).then(function (err, data) {
        app.helper.loadPageContentOverlay(data).then(function () {
          app.helper.hideProgress();
          Vtiger_Import_Js.registerEvents();
        });
      });
      return false;
    },
    bactToStep1: function () {
      jQuery("#step2").removeClass("active");
      jQuery("#step1").addClass("active");
      jQuery("#uploadFileContainer").addClass("show");
      jQuery("#importStep2Conatiner").removeClass("show");
      jQuery("#importStep2Conatiner").addClass("hide");

      jQuery("#importStepOneButtonsDiv").removeClass("hide");
      jQuery("#importStepOneButtonsDiv").addClass("show");

      jQuery("#importStepTwoButtonsDiv").removeClass("show");
      jQuery("#importStepTwoButtonsDiv").addClass("hide");

      return false;
    },
    importActionStep2: function () {
      if (Vtiger_Import_Js.validateFilePath()) {
        jQuery("#uploadFileContainer").removeClass("show");
        jQuery("#uploadFileContainer").addClass("hide");

        jQuery("#step1").removeClass("active");
        jQuery("#step2").addClass("active");

        jQuery("#importStep2Conatiner").addClass("show");

        jQuery("#importStepTwoButtonsDiv").removeClass("hide");
        jQuery("#importStepTwoButtonsDiv").addClass("show");

        jQuery("#importStepOneButtonsDiv").removeClass("show");
        jQuery("#importStepOneButtonsDiv").addClass("hide");
      }
      return false;
    },
    uploadAndParse: function (auto_merge) {
      if (
        Vtiger_Import_Js.validateFilePath() &&
        Vtiger_Import_Js.validateMergeCriteria(auto_merge)
      ) {
        jQuery("#auto_merge").val(auto_merge);
        var form = jQuery("form[name='importBasic']");
        var data = new FormData(form[0]);
        var postParams = {
          data: data,
          contentType: false,
          processData: false,
        };
        app.helper.showProgress();
        app.request.post(postParams).then(function (err, response) {
          app.helper.loadPageContentOverlay(response);
          Vtiger_Import_Js.loadDefaultValueWidgetForMappedFields();
          app.helper.hideProgress();
        });
      }
      return false;
    },
    backToLandingPage: function () {
      Vtiger_Import_Js.triggerImportAction();
      return false;
    },
    sanitizeAndSubmit: function () {
      if (
        Vtiger_Import_Js.sanitizeFieldMapping() &&
        Vtiger_Import_Js.validateCustomMap()
      ) {
        var formData = jQuery("form[name='importAdvanced']").serialize();

        // Prevent any native form submission
        jQuery("form[name='importAdvanced']").on('submit', function(e) {
          e.preventDefault();
          return false;
        });

        // Show progress modal immediately (replaces the import form overlay)
        Vtiger_Import_Js.showImportProgressModal();

        // Start polling for progress updates after a short delay
        // to ensure the modal DOM is rendered first
        Vtiger_Import_Js._importStartTime = Date.now();
        Vtiger_Import_Js._lastProcessed = 0;
        Vtiger_Import_Js._importDone = false;

        // Delay AJAX + polling slightly so the progress modal renders first
        setTimeout(function() {
          Vtiger_Import_Js.startProgressPolling();

          // Submit the import - server sends early JSON response then
          // continues processing in background. We rely on polling
          // for progress/completion, NOT this AJAX response.
          app.request.post({ data: formData }).then(function (err, response) {
            // Early response received (import_started) or server returned result HTML.
            // If response has import_id, store it.
            if (!err && response && response.import_id) {
              Vtiger_Import_Js._importId = response.import_id;
            }
            // Don't stop polling here - let polling detect completion.
            // The server continues processing in the background.
          });
        }, 300);
      }
      return false;
    },

    /** Progress modal state */
    _progressTimer: null,
    _importStartTime: 0,
    _lastProcessed: 0,
    _importDone: false,
    _importId: 0,

    /** Auto-close countdown timer reference */
    _autoCloseTimer: null,

    /**
     * Build and display the import progress overlay modal
     */
    showImportProgressModal: function () {
      var moduleName = app.getModuleName();
      var moduleLabel = app.vtranslate(moduleName);
      var html =
        '<div class="fc-overlay-modal" id="importProgressOverlay">' +
        '<style>' +
        '  #importProgressOverlay .modal-content { position: relative; overflow: hidden; border: none; box-shadow: 0 8px 32px rgba(0,0,0,0.12); border-radius: 8px; }' +
        '  #importProgressOverlay .ip-header { padding: 18px 24px; border-bottom: 1px solid #eee; display: flex; align-items: center; justify-content: space-between; background: #fff; }' +
        '  #importProgressOverlay .ip-title { font-size: 16px; font-weight: 600; color: #222; margin: 0; display: flex; align-items: center; gap: 10px; }' +
        '  #importProgressOverlay .ip-title i { color: #1a73e8; }' +
        '  #importProgressOverlay .ip-badge { font-size: 11px; font-weight: 600; padding: 4px 12px; border-radius: 20px; display: inline-flex; align-items: center; gap: 5px; letter-spacing: 0.3px; text-transform: uppercase; }' +
        '  #importProgressOverlay .ip-badge-running { background: #fff3e0; color: #e65100; }' +
        '  #importProgressOverlay .ip-badge-done { background: #e8f5e9; color: #2e7d32; }' +
        '  #importProgressOverlay .ip-body { padding: 28px 24px 20px; background: #fff; }' +
        '  #importProgressOverlay .ip-progress-row { display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 10px; }' +
        '  #importProgressOverlay .ip-percent { font-size: 28px; font-weight: 700; color: #1a73e8; letter-spacing: -0.5px; }' +
        '  #importProgressOverlay .ip-percent.done { color: #2e7d32; }' +
        '  #importProgressOverlay .ip-count { font-size: 13px; color: #888; }' +
        '  #importProgressOverlay .ip-track { height: 8px; background: #e8eaed; border-radius: 4px; overflow: hidden; margin-bottom: 28px; }' +
        '  #importProgressOverlay .ip-fill { height: 100%; background: linear-gradient(90deg, #1a73e8, #4285f4); border-radius: 4px; transition: width 0.5s ease; width: 0%; }' +
        '  #importProgressOverlay .ip-fill.done { background: linear-gradient(90deg, #0d904f, #34a853); }' +
        '  #importProgressOverlay .ip-stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; margin-bottom: 24px; }' +
        '  #importProgressOverlay .ip-card { text-align: center; padding: 16px 8px; background: #fafbfc; border-radius: 10px; border: 1px solid #eef0f2; transition: border-color 0.3s; }' +
        '  #importProgressOverlay .ip-card:hover { border-color: #d0d5dd; }' +
        '  #importProgressOverlay .ip-val { font-size: 28px; font-weight: 700; line-height: 1.2; }' +
        '  #importProgressOverlay .ip-lbl { font-size: 10px; color: #999; text-transform: uppercase; letter-spacing: 0.8px; margin-top: 6px; font-weight: 500; }' +
        '  #importProgressOverlay .ip-meta { display: flex; justify-content: space-between; padding: 12px 16px; background: #f7f8fa; border-radius: 8px; border: 1px solid #eef0f2; font-size: 13px; color: #555; }' +
        '  #importProgressOverlay .ip-meta-item { display: flex; align-items: center; gap: 6px; }' +
        '  #importProgressOverlay .ip-meta-item i { color: #aaa; font-size: 13px; }' +
        '  #importProgressOverlay .ip-meta-item strong { color: #333; }' +
        '  #importProgressOverlay .ip-footer { padding: 16px 24px; border-top: 1px solid #eee; text-align: center; background: #fff; }' +
        '  #importProgressOverlay .ip-success { display: none; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(255,255,255,0.97); z-index: 10; flex-direction: column; align-items: center; justify-content: center; border-radius: 8px; }' +
        '  #importProgressOverlay .ip-success.show { display: flex; }' +
        '  #importProgressOverlay .ip-success-icon { width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #e8f5e9, #c8e6c9); display: flex; align-items: center; justify-content: center; margin-bottom: 20px; animation: ipPop 0.5s cubic-bezier(0.175,0.885,0.32,1.275); }' +
        '  #importProgressOverlay .ip-success-icon i { font-size: 40px; color: #2e7d32; }' +
        '  #importProgressOverlay .ip-success-title { font-size: 22px; font-weight: 700; color: #222; margin-bottom: 8px; }' +
        '  #importProgressOverlay .ip-success-summary { font-size: 14px; color: #666; margin-bottom: 24px; line-height: 1.6; }' +
        '  #importProgressOverlay .ip-success-actions { display: flex; gap: 10px; margin-bottom: 16px; }' +
        '  #importProgressOverlay .ip-btn { padding: 9px 24px; border-radius: 6px; font-size: 14px; font-weight: 500; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s; }' +
        '  #importProgressOverlay .ip-btn-primary { background: #1a73e8; color: #fff; }' +
        '  #importProgressOverlay .ip-btn-primary:hover { background: #1557b0; }' +
        '  #importProgressOverlay .ip-btn-ghost { background: transparent; color: #555; border: 1px solid #ddd; }' +
        '  #importProgressOverlay .ip-btn-ghost:hover { background: #f5f5f5; }' +
        '  #importProgressOverlay .ip-countdown { font-size: 12px; color: #aaa; }' +
        '  @keyframes ipPop { 0% { transform: scale(0); opacity: 0; } 60% { transform: scale(1.1); } 100% { transform: scale(1); opacity: 1; } }' +
        '</style>' +
        '<div class="modal-content">' +
        // Success overlay (hidden until complete)
        '  <div class="ip-success" id="ipSuccessOverlay">' +
        '    <div class="ip-success-icon"><i class="fa fa-check"></i></div>' +
        '    <div class="ip-success-title" id="ipSuccessTitle">' + app.vtranslate('LBL_IMPORT_SUCCESS') + '</div>' +
        '    <div class="ip-success-summary" id="ipSuccessSummary"></div>' +
        '    <div class="ip-success-actions">' +
        '      <button class="ip-btn ip-btn-primary" id="ipFinishBtn"><i class="fa fa-check"></i> ' + app.vtranslate('LBL_FINISH_BUTTON_LABEL') + '</button>' +
        '      <button class="ip-btn ip-btn-ghost" id="ipImportMoreBtn"><i class="fa fa-upload"></i> ' + app.vtranslate('LBL_IMPORT_MORE') + '</button>' +
        '    </div>' +
        '    <div class="ip-countdown" id="ipCountdown"></div>' +
        '  </div>' +
        // Header
        '  <div class="ip-header">' +
        '    <h4 class="ip-title"><i class="fa fa-cloud-upload"></i>' + app.vtranslate('LBL_IMPORT') + ' ' + moduleLabel + '</h4>' +
        '    <span class="ip-badge ip-badge-running" id="ipBadge"><i class="fa fa-circle-o-notch fa-spin"></i> ' + app.vtranslate('LBL_RUNNING') + '</span>' +
        '  </div>' +
        // Body
        '  <div class="ip-body">' +
        '    <div class="ip-progress-row">' +
        '      <span class="ip-percent" id="ipPercentText">0%</span>' +
        '      <span class="ip-count" id="ipCountText">0 / 0 ' + app.vtranslate('records') + '</span>' +
        '    </div>' +
        '    <div class="ip-track"><div class="ip-fill" id="ipProgressBar"></div></div>' +
        '    <div class="ip-stats">' +
        '      <div class="ip-card"><div class="ip-val" style="color:#2e7d32" id="ipCreated">0</div><div class="ip-lbl">' + app.vtranslate('LBL_CREATED') + '</div></div>' +
        '      <div class="ip-card"><div class="ip-val" style="color:#1565c0" id="ipUpdated">0</div><div class="ip-lbl">' + app.vtranslate('LBL_UPDATED') + '</div></div>' +
        '      <div class="ip-card"><div class="ip-val" style="color:#ef6c00" id="ipSkipped">0</div><div class="ip-lbl">' + app.vtranslate('LBL_SKIPPED') + '</div></div>' +
        '      <div class="ip-card"><div class="ip-val" style="color:#c62828" id="ipFailed">0</div><div class="ip-lbl">' + app.vtranslate('LBL_FAILED') + '</div></div>' +
        '    </div>' +
        '    <div class="ip-meta">' +
        '      <div class="ip-meta-item"><i class="fa fa-tachometer"></i><span>' + app.vtranslate('Speed') + ': <strong id="ipSpeed">--</strong> ' + app.vtranslate('records') + '/s</span></div>' +
        '      <div class="ip-meta-item"><i class="fa fa-clock-o"></i><span>' + app.vtranslate('ETA') + ': <strong id="ipEta">' + app.vtranslate('calculating') + '...</strong></span></div>' +
        '      <div class="ip-meta-item"><i class="fa fa-hourglass-half"></i><span>' + app.vtranslate('Elapsed') + ': <strong id="ipElapsed">0s</strong></span></div>' +
        '    </div>' +
        '  </div>' +
        // Footer
        '  <div class="ip-footer">' +
        '    <button id="ipCancelBtn" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp; ' + app.vtranslate('LBL_CANCEL_IMPORT') + '</button>' +
        '  </div>' +
        '</div>' +
        '</div>';

      app.helper.loadPageContentOverlay(html).then(function () {
        jQuery('#ipCancelBtn').on('click', function () {
          Vtiger_Import_Js.cancelImportFromProgress();
        });
      });
    },

    /**
     * Start polling the getImportProgress endpoint
     */
    startProgressPolling: function () {
      Vtiger_Import_Js.stopProgressPolling();
      // Poll every 1.5 seconds
      Vtiger_Import_Js._progressTimer = setInterval(function () {
        Vtiger_Import_Js.pollProgress();
      }, 1500);
    },

    /**
     * Stop the progress polling timer
     */
    stopProgressPolling: function () {
      if (Vtiger_Import_Js._progressTimer) {
        clearInterval(Vtiger_Import_Js._progressTimer);
        Vtiger_Import_Js._progressTimer = null;
      }
    },

    /**
     * Make a single progress poll request
     * @param {Function} callback - optional callback after UI update
     */
    /** Counter for consecutive poll errors */
    _pollErrorCount: 0,

    pollProgress: function (callback) {
      var params = {
        module: app.getModuleName(),
        view: "Import",
        mode: "getImportProgress",
      };
      app.request.get({ data: params }).then(function (err, data) {
        if (err || !data) {
          // Tolerate occasional poll errors (network glitch, etc.)
          Vtiger_Import_Js._pollErrorCount++;
          if (Vtiger_Import_Js._pollErrorCount > 20) {
            // Too many consecutive errors - stop polling
            Vtiger_Import_Js.stopProgressPolling();
            jQuery('#ipBadge')
              .removeClass('ip-badge-running')
              .addClass('ip-badge-done')
              .css('background', '#fbe9e7').css('color', '#c62828')
              .html('<i class="fa fa-exclamation-triangle"></i> ' + app.vtranslate('LBL_ERROR'));
          }
          if (typeof callback === "function") callback();
          return;
        }
        // Reset error counter on successful poll
        Vtiger_Import_Js._pollErrorCount = 0;

        // app.request auto-extracts 'result' from {success:true, result:{...}}
        if (data.import_id) {
          Vtiger_Import_Js._importId = data.import_id;
        }
        Vtiger_Import_Js.updateProgressUI(data);

        // Detect completion: all records processed AND server finished
        var total = data.total || 0;
        var pending = data.pending || 0;
        if (total > 0 && pending === 0 && !data.is_running && !Vtiger_Import_Js._importDone) {
          Vtiger_Import_Js._importDone = true;
          Vtiger_Import_Js.stopProgressPolling();
          // Show completion state in progress UI
          Vtiger_Import_Js.showImportComplete(data);
        }

        if (typeof callback === "function") callback();
      });
    },

    /**
     * Update the progress modal UI with polling data
     */
    updateProgressUI: function (data) {
      var total = data.total || 0;
      var processed = data.processed || 0;
      var percent = total > 0 ? Math.round((processed / total) * 100) : 0;

      if (Vtiger_Import_Js._importDone && total > 0) {
        percent = 100;
        processed = total - (data.pending || 0);
        if (processed > total) processed = total;
      }

      // Update progress bar
      jQuery('#ipProgressBar').css('width', percent + '%');
      if (percent >= 100) {
        jQuery('#ipProgressBar').addClass('done');
        jQuery('#ipPercentText').addClass('done');
      }

      jQuery('#ipPercentText').text(percent + '%');
      jQuery('#ipCountText').text(processed + ' / ' + total + ' ' + app.vtranslate('records'));

      // Stat cards
      jQuery('#ipCreated').text(data.created || 0);
      jQuery('#ipUpdated').text(data.updated || 0);
      jQuery('#ipSkipped').text(data.skipped || 0);
      jQuery('#ipFailed').text(data.failed || 0);

      // Speed & ETA
      var elapsed = (Date.now() - Vtiger_Import_Js._importStartTime) / 1000;
      jQuery('#ipElapsed').text(Vtiger_Import_Js.formatDuration(elapsed));

      if (elapsed > 2 && processed > 0) {
        var speed = processed / elapsed;
        jQuery('#ipSpeed').text(speed.toFixed(1));
        var remaining = total - processed;
        if (remaining > 0 && speed > 0) {
          jQuery('#ipEta').text(Vtiger_Import_Js.formatDuration(remaining / speed));
        } else {
          jQuery('#ipEta').text(app.vtranslate('almost done') + '...');
        }
      }

      // Badge status
      if (Vtiger_Import_Js._importDone || percent >= 100) {
        jQuery('#ipBadge')
          .removeClass('ip-badge-running')
          .addClass('ip-badge-done')
          .html('<i class="fa fa-check-circle"></i> ' + app.vtranslate('Completed'));
      }
    },

    /**
     * Show completion state: success overlay with auto-close countdown
     */
    showImportComplete: function (data) {
      // Final UI update
      var finalData = jQuery.extend({}, data, { pending: 0 });
      Vtiger_Import_Js._importDone = true;
      Vtiger_Import_Js.updateProgressUI(finalData);

      // Build summary text
      var created = data.created || 0;
      var updated = data.updated || 0;
      var skipped = data.skipped || 0;
      var failed = data.failed || 0;
      var total = data.total || 0;
      var elapsed = (Date.now() - Vtiger_Import_Js._importStartTime) / 1000;
      var summaryLines = [];
      summaryLines.push('<strong>' + total + '</strong> ' + app.vtranslate('records') + ' · ' + Vtiger_Import_Js.formatDuration(elapsed));
      var details = [];
      if (created > 0) details.push('<span style="color:#2e7d32">' + created + ' ' + app.vtranslate('LBL_CREATED').toLowerCase() + '</span>');
      if (updated > 0) details.push('<span style="color:#1565c0">' + updated + ' ' + app.vtranslate('LBL_UPDATED').toLowerCase() + '</span>');
      if (skipped > 0) details.push('<span style="color:#ef6c00">' + skipped + ' ' + app.vtranslate('LBL_SKIPPED').toLowerCase() + '</span>');
      if (failed > 0) details.push('<span style="color:#c62828">' + failed + ' ' + app.vtranslate('LBL_FAILED').toLowerCase() + '</span>');
      if (details.length > 0) summaryLines.push(details.join(' &middot; '));
      jQuery('#ipSuccessSummary').html(summaryLines.join('<br>'));

      // Show success overlay
      jQuery('#ipSuccessOverlay').addClass('show');

      // Toast notification
      app.helper.showSuccessNotification({
        message: app.vtranslate('Import Completed.')
      });

      // Bind action buttons
      jQuery('#ipFinishBtn').on('click', function () {
        Vtiger_Import_Js._clearAutoClose();
        app.helper.hidePageContentOverlay();
        Vtiger_Import_Js.loadListRecords();
      });
      jQuery('#ipImportMoreBtn').on('click', function () {
        Vtiger_Import_Js._clearAutoClose();
        Vtiger_Import_Js.showImportActionStepOne();
      });

      // Auto-close countdown (5 seconds)
      var seconds = 5;
      jQuery('#ipCountdown').text(app.vtranslate('LBL_AUTO_CLOSE_IN').replace('{s}', seconds));
      Vtiger_Import_Js._autoCloseTimer = setInterval(function () {
        seconds--;
        if (seconds <= 0) {
          Vtiger_Import_Js._clearAutoClose();
          app.helper.hidePageContentOverlay();
          Vtiger_Import_Js.loadListRecords();
        } else {
          jQuery('#ipCountdown').text(app.vtranslate('LBL_AUTO_CLOSE_IN').replace('{s}', seconds));
        }
      }, 1000);
    },

    /**
     * Clear the auto-close countdown timer
     */
    _clearAutoClose: function () {
      if (Vtiger_Import_Js._autoCloseTimer) {
        clearInterval(Vtiger_Import_Js._autoCloseTimer);
        Vtiger_Import_Js._autoCloseTimer = null;
      }
    },

    /**
     * Format seconds into human-readable duration (e.g., "1m 23s")
     */
    formatDuration: function (seconds) {
      seconds = Math.round(seconds);
      if (seconds < 60) return seconds + "s";
      var mins = Math.floor(seconds / 60);
      var secs = seconds % 60;
      if (mins < 60) return mins + "m " + (secs > 0 ? secs + "s" : "");
      var hours = Math.floor(mins / 60);
      mins = mins % 60;
      return hours + "h " + (mins > 0 ? mins + "m" : "");
    },

    /**
     * Cancel import from the progress modal
     */
    cancelImportFromProgress: function () {
      var importId = Vtiger_Import_Js._importId;
      if (!importId) {
        app.helper.showErrorNotification({
          message: "Import ID not available yet. Please wait a moment.",
        });
        return;
      }
      Vtiger_Import_Js.stopProgressPolling();
      jQuery("#ipCancelBtn")
        .prop("disabled", true)
        .html(
          '<i class="fa fa-spinner fa-spin"></i>&nbsp; ' +
            app.vtranslate("Cancelling") +
            "...",
        );
      jQuery('#ipBadge')
        .removeClass('ip-badge-running')
        .html('<i class="fa fa-spinner fa-spin"></i> ' + app.vtranslate('Cancelling') + '...');
      var params = {
        module: app.getModuleName(),
        view: "Import",
        mode: "cancelImport",
        import_id: importId,
      };
      app.request.get({ data: params }).then(function (err, data) {
        Vtiger_Import_Js._importDone = true;
        app.helper.loadPageContentOverlay(data).then(function () {
          app.helper.showSuccessNotification({
            message: app.vtranslate("Import Cancelled."),
          });
        });
      });
    },
    sanitizeFieldMapping: function () {
      var fieldsList = jQuery(".fieldIdentifier");

      var mappedFields = {};
      var errorMessage;
      var mappedDefaultValues = {};

      for (var i = 0; i < fieldsList.length; ++i) {
        var fieldElement = jQuery(fieldsList.get(i));
        var rowId = jQuery("[name=row_counter]", fieldElement).get(0).value;

        var selectedFieldElement = jQuery(
          "select option:selected",
          fieldElement,
        );
        var selectedFieldName = selectedFieldElement.val();
        var selectedFieldDefaultValueElement = jQuery(
          "#" + selectedFieldName + "_defaultvalue",
          fieldElement,
        );
        var defaultValue = "";
        if (selectedFieldDefaultValueElement.attr("type") == "checkbox") {
          defaultValue = selectedFieldDefaultValueElement.is(":checked");
        } else {
          defaultValue = selectedFieldDefaultValueElement.val();
        }
        if (selectedFieldName != "") {
          if (selectedFieldName in mappedFields) {
            errorMessage =
              app.vtranslate("JS_FIELD_MAPPED_MORE_THAN_ONCE") +
              " " +
              selectedFieldElement.data("label");
            app.helper.showErrorNotification({ message: errorMessage });
            return false;
          }
          mappedFields[selectedFieldName] = rowId - 1;
          if (defaultValue != "") {
            mappedDefaultValues[selectedFieldName] = defaultValue;
          }
        }
      }

      var mandatoryFields = JSON.parse(jQuery("#mandatory_fields").val());
      var moduleName = app.getModuleName();
      if (
        moduleName == "PurchaseOrder" ||
        moduleName == "Invoice" ||
        moduleName == "Quotes" ||
        moduleName == "SalesOrder"
      ) {
        mandatoryFields.hdnTaxType = app.vtranslate("Tax Type");
      }
      var missingMandatoryFields = [];
      for (var mandatoryFieldName in mandatoryFields) {
        if (mandatoryFieldName in mappedFields) {
          continue;
        } else {
          missingMandatoryFields.push(
            '"' + mandatoryFields[mandatoryFieldName] + '"',
          );
        }
      }
      if (missingMandatoryFields.length > 0) {
        errorMessage =
          app.vtranslate("JS_MAP_MANDATORY_FIELDS") +
          missingMandatoryFields.join(",");
        app.helper.showErrorNotification({ message: errorMessage });
        return false;
      }
      jQuery("#field_mapping").val(JSON.stringify(mappedFields));
      jQuery("#default_values").val(JSON.stringify(mappedDefaultValues));
      return true;
    },
    validateCustomMap: function () {
      var errorMessage;
      var saveMap = jQuery("#save_map").is(":checked");
      if (saveMap) {
        var mapName = jQuery("#save_map_as").val();
        if (jQuery.trim(mapName) == "") {
          errorMessage = app.vtranslate("JS_MAP_NAME_CAN_NOT_BE_EMPTY");
          app.helper.showErrorNotification({ message: errorMessage });
          return false;
        }
        var mapOptions = jQuery("#saved_maps option");
        for (var i = 0; i < mapOptions.length; ++i) {
          var mapOption = jQuery(mapOptions.get(i));
          if (mapOption.html() == mapName) {
            errorMessage = app.vtranslate("JS_MAP_NAME_ALREADY_EXISTS");
            app.helper.showErrorNotification({ message: errorMessage });
            return false;
          }
        }
      }
      return true;
    },
    getParamsFromURL: function (url) {
      var urlParams = url.slice(url.indexOf("?") + 1).split("&");
      var params = {};
      for (var i = 0; i < urlParams.length; i++) {
        var param = urlParams[i].split("=");
        params[param[0]] = param[1];
      }
      return params;
    },
    undoImport: function (url) {
      var params = Vtiger_Import_Js.getParamsFromURL(url);
      Vtiger_Import_Js.showOverLayModal(params);
    },
    loadSavedMap: function () {
      var selectedMapElement = jQuery("#saved_maps option:selected");
      var mapId = selectedMapElement.attr("id");
      var fieldsList = jQuery(".fieldIdentifier");
      var deleteMapContainer = jQuery("#delete_map_container");
      fieldsList.each(function (i, element) {
        var fieldElement = jQuery(element);
        jQuery("[name=mapped_fields]", fieldElement).val("");
      });
      if (mapId == -1) {
        deleteMapContainer.hide();
        return;
      }
      deleteMapContainer.show();
      var mappingString = selectedMapElement.val();
      if (mappingString == "") return;
      var mappingPairs = mappingString.split("&");
      var mapping = {};
      for (var i = 0; i < mappingPairs.length; ++i) {
        var mappingPair = mappingPairs[i].split("=");
        var header = mappingPair[0];
        header = header.replace(/\/eq\//g, "=");
        header = header.replace(/\/amp\//g, "&amp;");
        mapping[header] = mappingPair[1];
        mapping[i] =
          mappingPair[1]; /* To make Row based match when there is no header */
      }
      fieldsList.each(function (i, element) {
        var fieldElement = jQuery(element);
        var mappedFields = jQuery("[name=mapped_fields]", fieldElement);
        var rowId = jQuery("[name=row_counter]", fieldElement).get(0).value;
        var headerNameElement = jQuery("[name=header_name]", fieldElement).get(
          0,
        );
        var headerName = jQuery(headerNameElement).html();
        if (headerName in mapping) {
          mappedFields.select2("val", mapping[headerName]);
        } else if (rowId - 1 in mapping) {
          /* Row based match when there is no header - but saved map is loaded. */
          mappedFields.select2("val", mapping[rowId - 1]);
        }
        Vtiger_Import_Js.loadDefaultValueWidget(fieldElement.attr("id"));
      });
    },
    deleteMap: function (module) {
      if (confirm(app.vtranslate("LBL_DELETE_CONFIRMATION"))) {
        var selectedMapElement = jQuery("#saved_maps option:selected");
        var mapId = selectedMapElement.attr("id");

        var postData = {
          module: module,
          view: "Import",
          mode: "deleteMap",
          mapid: mapId,
        };

        app.request.post({ data: postData }).then(function (err, data) {
          jQuery("#savedMapsContainer").html(data);
          vtUtils.showSelect2ElementView(jQuery("#saved_maps"));
        });
      }
    },
    validateMergeCriteria: function (auto_merge) {
      if (auto_merge == 1) {
        var selectedOptions = jQuery("#selected_merge_fields option");
        if (selectedOptions.length == 0) {
          var errorMessage = app.vtranslate(
            "JS_PLEASE_SELECT_ONE_FIELD_FOR_MERGE",
          );
          app.helper.showErrorNotification({ message: errorMessage });
          return false;
        }
        Vtiger_Import_Js.convertOptionsToJSONArray(
          "#selected_merge_fields",
          "#merge_fields",
        );
      }
      return true;
    },
    //TODO move to a common file
    convertOptionsToJSONArray: function (objName, targetObjName) {
      var obj = jQuery(objName);
      var arr = [];
      if (typeof obj != "undefined" && obj[0] != "") {
        for (i = 0; i < obj[0].length; ++i) {
          arr.push(obj[0].options[i].value);
        }
      }
      if (targetObjName != "undefined") {
        var targetObj = $(targetObjName);
        if (typeof targetObj != "undefined") targetObj.val(JSON.stringify(arr));
      }
      return arr;
    },
    validateFilePath: function () {
      var importFile = jQuery("#import_file");
      var fileFormats = importFile.data("fileFormats");
      var filePath = importFile.val();
      if (jQuery.trim(filePath) == "") {
        var errorMessage = app.vtranslate("JS_IMPORT_FILE_CAN_NOT_BE_EMPTY");
        app.helper.showErrorNotification({ message: errorMessage });
        importFile.focus();
        return false;
      }
      if (!Vtiger_Import_Js.uploadFilter("import_file", fileFormats)) {
        return false;
      }
      if (!Vtiger_Import_Js.uploadFileSize("import_file")) {
        return false;
      }
      return true;
    },
    showPopup: function (url) {
      var params = Vtiger_Import_Js.getParamsFromURL(url);
      var popupInstance = Vtiger_Popup_Js.getInstance();
      popupInstance.showPopup(params);
      return false;
    },
    showLastImportedRecords: function (url) {
      this.showPopup(url);
    },
    showSkippedRecords: function (url) {
      this.showPopup(url);
    },
    showFailedImportRecords: function (url) {
      this.showPopup(url);
    },
    loadDefaultValueWidget: function (rowIdentifierId) {
      var affectedRow = jQuery("#" + rowIdentifierId);
      if (typeof affectedRow == "undefined" || affectedRow == null) return;
      var selectedFieldElement = jQuery(
        "[name=mapped_fields]",
        affectedRow,
      ).get(0);
      var selectedFieldName = jQuery(selectedFieldElement).val();
      var defaultValueContainer = jQuery(
        jQuery("[name=default_value_container]", affectedRow).get(0),
      );
      var allDefaultValuesContainer = jQuery("#defaultValuesElementsContainer");
      if (defaultValueContainer.children.length > 0) {
        var copyOfDefaultValueWidget = jQuery(
          ":first",
          defaultValueContainer,
        ).detach();
        copyOfDefaultValueWidget.appendTo(allDefaultValuesContainer);
      }
      selectedFieldName = app.helper.purifyContent(selectedFieldName);
      var selectedFieldDefValueContainer = jQuery(
        "#" + selectedFieldName + "_defaultvalue_container",
        allDefaultValuesContainer,
      );
      var defaultValueWidget = selectedFieldDefValueContainer.detach();
      defaultValueWidget.appendTo(defaultValueContainer);
    },
    loadDefaultValueWidgetForMappedFields: function () {
      var fieldsList = jQuery(".fieldIdentifier");
      fieldsList.each(function (i, element) {
        var fieldElement = jQuery(element);
        var mappedFieldName = jQuery(
          "[name=mapped_fields]",
          fieldElement,
        ).val();
        if (mappedFieldName != "") {
          Vtiger_Import_Js.loadDefaultValueWidget(fieldElement.attr("id"));
        }
      });
    },
    //TODO: move to a common file
    copySelectedOptions: function (source, destination) {
      var srcObj = jQuery(source);
      var destObj = jQuery(destination);

      if (typeof srcObj == "undefined" || typeof destObj == "undefined") return;

      for (i = 0; i < srcObj[0].length; i++) {
        if (srcObj[0].options[i].selected == true) {
          var rowFound = false;
          var existingObj = null;
          for (j = 0; j < destObj[0].length; j++) {
            if (destObj[0].options[j].value == srcObj[0].options[i].value) {
              rowFound = true;
              existingObj = destObj[0].options[j];
              break;
            }
          }

          if (rowFound != true) {
            var opt = $("<option selected>");
            opt.attr("value", srcObj[0].options[i].value);
            opt.text(srcObj[0].options[i].text);
            jQuery(destObj[0]).append(opt);
            srcObj[0].options[i].selected = false;
            rowFound = false;
          } else {
            if (existingObj != null) existingObj.selected = true;
          }
        }
      }
      return false;
    },
    //TODO move to a common file
    removeSelectedOptions: function (objName) {
      var obj = jQuery(objName);
      if (obj == null || typeof obj == "undefined") return;

      for (i = obj[0].options.length - 1; i >= 0; i--) {
        if (obj[0].options[i].selected == true) {
          obj[0].options[i] = null;
        }
      }
      return false;
    },
    checkFileType: function (e) {
      var filePath = jQuery("#import_file").val();
      if (filePath != "") {
        var fileExtension = filePath.split(".").pop();
        jQuery("#type").val(fileExtension);
        var fileName = e["target"]["files"][0]["name"];
        jQuery("#importFileDetails").text(fileName);
        Vtiger_Import_Js.handleFileTypeChange();
      } else {
        jQuery("#importFileDetails").text("");
      }
    },
    handleFileTypeChange: function () {
      var fileType = jQuery("#type").val();
      var delimiterContainer = jQuery("#delimiter_container");
      var hasHeaderContainer = jQuery("#has_header_container");
      var encodingContainer = jQuery("#file_encoding_container");
      if (fileType === "xls" || fileType === "xlsx") {
        delimiterContainer.hide();
        encodingContainer.hide();
        hasHeaderContainer.show();
      } else if (fileType !== "csv") {
        delimiterContainer.hide();
        hasHeaderContainer.hide();
      } else {
        delimiterContainer.show();
        hasHeaderContainer.show();
        encodingContainer.show();
      }
    },
    uploadFilter: function (elementId, allowedExtensions) {
      var obj = jQuery("#" + elementId);
      if (obj) {
        var filePath = obj.val();
        var fileParts = filePath.toLowerCase().split(".");
        var fileType = fileParts[fileParts.length - 1];
        var validExtensions = allowedExtensions.toLowerCase().split("|");

        if (validExtensions.indexOf(fileType) < 0) {
          var errorMessage =
            app.vtranslate("JS_SELECT_FILE_EXTENSION") + "\n" + validExtensions;
          app.helper.showErrorNotification({ message: errorMessage });
          obj.focus();
          return false;
        }
      }
      return true;
    },
    uploadFileSize: function (elementId) {
      var element = jQuery("#" + elementId);
      var importMaxUploadSize = element.closest("td").data("importUploadSize");
      var importMaxUploadSizeInMb = element
        .closest("td")
        .data("importUploadSizeMb");
      var uploadedFileSize = element.get(0).files[0].size;
      if (uploadedFileSize > importMaxUploadSize) {
        var errorMessage =
          app.vtranslate("JS_UPLOADED_FILE_SIZE_EXCEEDS") +
          " " +
          importMaxUploadSizeInMb +
          " MB." +
          app.vtranslate("JS_PLEASE_SPLIT_FILE_AND_IMPORT_AGAIN");
        app.helper.showErrorNotification({ message: errorMessage });
        return false;
      }
      return true;
    },
    showOverLayModal: function (params) {
      app.helper.showProgress();
      app.request.get({ data: params }).then(function (err, data) {
        app.helper.loadPageContentOverlay(data);
        app.helper.hideProgress();
      });
    },

    timer: 0,
    isReloadStatusPageStopped: false,
    scheduledImportRunning: function () {
      var form = jQuery("#importStatusForm");
      var data = new FormData(form[0]);
      var postParams = {
        data: data,
        contentType: false,
        processData: false,
      };
      app.request.post(postParams).then(function (err, response) {
        if (!Vtiger_Import_Js.isReloadStatusPageStopped) {
          app.helper.loadPageContentOverlay(response);
          if (jQuery("#scheduleImportStatus").length > 0) {
            if (!Vtiger_Import_Js.isReloadStatusPageStopped) {
              Vtiger_Import_Js.timer = setTimeout(
                Vtiger_Import_Js.scheduledImportRunning,
                3000,
              );
            }
          }
        }
      });
    },

    googleImportHandler: function () {
      var params = {
        module: "Google",
        view: "Setting",
        sourcemodule: app.getModuleName(),
        mode: "googleImport",
      };
      app.helper.showProgress();
      app.request.get({ data: params }).then(function (err, data) {
        app.helper.hideProgress();
        app.helper.hidePageContentOverlay().then(function () {
          app.helper.loadPageContentOverlay(data).then(function () {
            var container = jQuery(".googleSettings");
            var googleSettingInstance = new Google_Settings_Js();
            googleSettingInstance.registerSettingsEventsForContacts(container);

            Vtiger_Import_Js.registerAuthorizeButton(container);
            Vtiger_Import_Js.registerSyncNowButton(
              container,
              googleSettingInstance,
            );
          });
        });
      });
    },

    registerImportEvents: function () {
      var importContainer = jQuery("#landingPageDiv");
      importContainer.on("click", "#csvImport", function (e) {
        Vtiger_Import_Js.showImportActionStepOne();
      });

      importContainer.on("click", "#vcfImport", function (e) {
        Vtiger_Import_Js.showImportActionStepOne("vcf");
      });

      importContainer.on("click", "#icsImport", function (e) {
        Vtiger_Import_Js.showImportActionStepOne("ics");
      });

      importContainer.on("click", "#xlsImport", function (e) {
        Vtiger_Import_Js.showImportActionStepOne("xls");
      });

      importContainer.on("click", "#googleImport", function (e) {
        Vtiger_Import_Js.googleImportHandler(e);
      });
    },
    registerAuthorizeButton: function (container) {
      container.on("click", "#authorizeButton", function (e) {
        var element = jQuery(e.currentTarget);
        var url = element.data("url");
        var win = window.open(url, "", "height=600,width=600,channelmode=1");
        //http://stackoverflow.com/questions/1777864/how-to-run-function-of-parent-window-when-child-window-closes
        window.sync = function () {
          Vtiger_Import_Js.googleImportHandler();
        };
        window.startSync = function () {};
        win.onunload = function () {};
      });
    },
    registerSyncNowButton: function (container, googleSettingInstance) {
      container.find("#saveSettingsAndImport").on("click", function () {
        googleSettingInstance
          .validateFieldMappings(container)
          .then(function () {
            var form = jQuery("form[name='contactsyncsettings']");
            var fieldMapping =
              googleSettingInstance.packFieldmappingsForSubmit(container);
            form.find("#user_field_mapping").val(fieldMapping);
            var serializedFormData = form.serialize();
            app.helper.showProgress();
            app.request
              .post({ data: serializedFormData })
              .then(function (err, response) {
                app.helper.hideProgress();
                app.helper.hideModal();
                if (err) {
                  app.helper.showErrorNotification();
                } else {
                  var params = {
                    module: "Contacts",
                    view: "Extension",
                    extensionModule: "Google",
                    extensionView: "Index",
                    viewType: "modal",
                  };
                  app.helper.showProgress();
                  app.helper.hidePageContentOverlay().then(function () {
                    app.request
                      .get({ data: params })
                      .then(function (err, data) {
                        app.helper.hideProgress();
                        app.helper
                          .loadPageContentOverlay(data)
                          .then(function (overlayPageContent) {
                            var overlayContainer =
                              overlayPageContent.find(".data");
                            var extensionCommonJs =
                              new Vtiger_ExtensionCommon_Js();
                            extensionCommonJs.getListUrlParams = function () {
                              var params = {
                                module: app.getModuleName(),
                                view: "Extension",
                                extensionModule: "Google",
                                extensionView: "Index",
                                mode: "showLogs",
                                viewType: "modal",
                              };

                              return params;
                            };
                            extensionCommonJs.registerPaginationEvents(
                              overlayContainer,
                            );
                            extensionCommonJs.registerLogDetailClickEvent(
                              overlayContainer,
                            );
                          });
                      });
                  });
                }
              });
          });
      });
    },

    clearSheduledImportData: function () {
      var params = {};
      params["module"] = app.getModuleName();
      params["view"] = "Import";
      params["mode"] = "clearCorruptedData";
      Vtiger_Import_Js.showOverLayModal(params);
    },
    cancelImport: function (url) {
      var urlParams = url.slice(url.indexOf("?") + 1).split("&");
      var params = {};
      for (var i = 0; i < urlParams.length; i++) {
        var param = urlParams[i].split("=");
        params[param[0]] = param[1];
      }
      Vtiger_Import_Js.showOverLayModal(params);
    },
    scheduleImport: function (url) {
      var urlParams = url.slice(url.indexOf("?") + 1).split("&");
      var params = {};
      for (var i = 0; i < urlParams.length; i++) {
        var param = urlParams[i].split("=");
        params[param[0]] = param[1];
      }
      Vtiger_Import_Js.showOverLayModal(params);
    },
    showImportActionStepOne: function (format) {
      var params = Vtiger_Import_Js.getDefaultParams();
      params["mode"] = "importBasicStep";
      if (format == "vcf") {
        params["fileFormat"] = format;
      } else if (format == "ics") {
        params["fileFormat"] = format;
      } else if (format == "xls") {
        params["fileFormat"] = format;
      }
      app.helper.showProgress();
      app.request.get({ data: params }).then(function (err, data) {
        app.helper.loadPageContentOverlay(data);
        app.helper.hideProgress();
        if (jQuery("#scheduleImportStatus").length > 0) {
          app.event.one("post.overlayPageContent.hide", function (container) {
            clearTimeout(Vtiger_Import_Js.timer);
            Vtiger_Import_Js.isReloadStatusPageStopped = true;
          });

          Vtiger_Import_Js.isReloadStatusPageStopped = false;
          Vtiger_Import_Js.timer = setTimeout(
            Vtiger_Import_Js.scheduledImportRunning,
            5000,
          );
        }
      });
    },
    getDefaultParams: function () {
      var module = window.app.getModuleName();
      var url = "index.php?module=" + module + "&view=Import";
      var urlParams = url.slice(url.indexOf("?") + 1).split("&");

      var params = {};
      for (var i = 0; i < urlParams.length; i++) {
        var param = urlParams[i].split("=");
        params[param[0]] = param[1];
      }
      return params;
    },
    finishUndoOperation: function () {
      Vtiger_Import_Js.loadListRecords();
    },
    loadListRecords: function () {
      var listInstance;
      if (app.getModuleName() == "Users") {
        listInstance = new Settings_Users_List_Js();
      } else {
        listInstance = new Vtiger_List_Js();
      }

      var params = { page: "1" };
      listInstance.loadListViewRecords(params);
    },

    registerEvents: function () {
      Vtiger_Import_Js.registerImportEvents();
    },
  };
  jQuery(document).ready(function () {
    Vtiger_Import_Js.loadDefaultValueWidgetForMappedFields();
  });
}
