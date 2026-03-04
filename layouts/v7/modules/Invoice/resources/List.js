/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

Inventory_List_Js(
  "Invoice_List_Js",
  {
    triggerExportPDFFiles: function () {
      console.log("triggerExportPDFFiles called");
      var thisInstance = Vtiger_List_Js.getInstance();
      console.log("thisInstance:", thisInstance);

      // Get IDs as objects first, then convert
      var selectedIdsObj = thisInstance.readSelectedIds(false);
      var excludedIdsObj = thisInstance.readExcludedIds(false);
      console.log(
        "selectedIdsObj:",
        selectedIdsObj,
        "excludedIdsObj:",
        excludedIdsObj
      );

      // Convert to arrays properly
      var selectedIds = [];
      var excludedIds = [];

      // Check if selectedIdsObj is array or object
      if (Array.isArray(selectedIdsObj)) {
        selectedIds = selectedIdsObj;
      } else if (selectedIdsObj && typeof selectedIdsObj === "object") {
        selectedIds = Object.keys(selectedIdsObj);
      }

      // Check if excludedIdsObj is array or object
      if (Array.isArray(excludedIdsObj)) {
        excludedIds = excludedIdsObj;
      } else if (excludedIdsObj && typeof excludedIdsObj === "object") {
        excludedIds = Object.keys(excludedIdsObj);
      }

      console.log(
        "selectedIds array (corrected):",
        selectedIds,
        "excludedIds array (corrected):",
        excludedIds
      );

      if (selectedIds.length == 0 && excludedIds.length == 0) {
        var message = app.vtranslate("JS_PLEASE_SELECT_ONE_RECORD");
        app.helper.showAlertBox({ message: message });
        return;
      }

      // Show confirmation dialog
      var message = app.vtranslate("JS_EXPORT_PDF_FILES_CONFIRMATION");
      if (selectedIds.length > 0) {
        message += " (" + selectedIds.length + " records)";
      } else {
        message += " (All visible records)";
      }

      app.helper
        .showConfirmationBox({
          message: message,
        })
        .then(
          function (e) {
            // Close confirmation dialog immediately
            jQuery(".modal.fade.in").modal("hide");
            jQuery(".modal-backdrop").remove();

            // Console log các link download PDF của từng record
            console.log("=== PDF DOWNLOAD LINKS FOR SELECTED RECORDS ===");
            console.log(
              "Base URL: " + window.location.origin + window.location.pathname
            );

            if (selectedIds.length > 0) {
              console.log("Selected Records Count: " + selectedIds.length);
              selectedIds.forEach(function (recordId, index) {
                // Correct PDFMaker download link format
                var singlePdfLink =
                  window.location.origin +
                  window.location.pathname +
                  "?module=PDFMaker&action=IndexAjax&mode=getPreviewContent&source_module=Invoice&language=en_us&record=" +
                  recordId +
                  "&generate_type=attachment";
                var detailViewLink =
                  window.location.origin +
                  window.location.pathname +
                  "?module=Invoice&view=Detail&record=" +
                  recordId;

                console.log("--- Record " + (index + 1) + " ---");
                console.log("  Record ID: " + recordId);
                console.log("  PDF Download Link (PDFMaker): " + singlePdfLink);
                console.log("  Detail View Link: " + detailViewLink);
              });

              // Bulk export still uses our custom action
              var bulkPdfLink =
                window.location.origin +
                window.location.pathname +
                "?module=Invoice&action=ExportPDFFiles&selected_ids=" +
                selectedIds.join(",");
              console.log("--- Bulk Export Link ---");
              console.log("  Bulk PDF Download (Custom): " + bulkPdfLink);
            } else {
              console.log("Mode: Export ALL visible records");
              console.log(
                "Excluded Records: " +
                  (excludedIds.length > 0 ? excludedIds.join(",") : "None")
              );
              var allRecordsLink =
                window.location.origin +
                window.location.pathname +
                "?module=Invoice&action=ExportPDFFiles&excluded_ids=" +
                excludedIds.join(",");
              console.log("All Records PDF Link: " + allRecordsLink);
            }
            console.log("=== END PDF DOWNLOAD LINKS ===");

            // Show loading message
            var progressIndicatorElement = jQuery.progressIndicator({
              message:
                app.vtranslate("JS_EXPORTING_PDF_FILES") +
                " - Creating ZIP file...",
              position: "html",
              blockInfo: {
                enabled: true,
              },
            });

            console.log("=== CREATING ZIP FILE WITH ALL PDFs ===");
            console.log("Selected Records for ZIP:", selectedIds);

            // Prepare form data for ZIP export
            var form = jQuery('<form method="POST" action="index.php">');
            form.append(
              '<input type="hidden" name="module" value="' +
                app.getModuleName() +
                '">'
            );
            form.append(
              '<input type="hidden" name="action" value="ExportPDFFiles">'
            );
            form.append(
              '<input type="hidden" name="selected_ids" value="' +
                selectedIds.join(",") +
                '">'
            );
            form.append(
              '<input type="hidden" name="excluded_ids" value="' +
                excludedIds.join(",") +
                '">'
            );

            // Add search parameters if any
            var searchParams = thisInstance.getListSearchParams();
            if (searchParams && Object.keys(searchParams).length > 0) {
              form.append(
                '<input type="hidden" name="search_params" value=\'' +
                  JSON.stringify(searchParams) +
                  "'>"
              );
            }

            // Create iframe for ZIP download
            var iframe = jQuery('<iframe style="display:none;">');
            iframe.attr("name", "zipDownloadFrame");
            form.attr("target", "zipDownloadFrame");

            jQuery("body").append(iframe);
            jQuery("body").append(form);

            // Handle iframe load event to hide progress indicator
            iframe.on("load", function () {
              console.log("=== IFRAME LOADED - Backend response received ===");
              console.log(
                "Iframe content URL:",
                iframe[0].contentWindow
                  ? iframe[0].contentWindow.location.href
                  : "No access to iframe content"
              );

              setTimeout(function () {
                progressIndicatorElement.progressIndicator({ mode: "hide" });
                form.remove();
                iframe.remove();
                console.log("=== ZIP FILE DOWNLOAD COMPLETED ===");
              }, 3000);
            });

            // Debug: Log the form data being submitted
            console.log("=== ZIP EXPORT FORM DATA ===");
            console.log("Action: ExportPDFFiles");
            console.log("Selected IDs: " + selectedIds.join(","));
            console.log("Form Target: zipDownloadFrame");

            // Generate and log the ZIP download link
            var zipDownloadUrl =
              window.location.origin +
              window.location.pathname +
              "?module=Invoice&action=ExportPDFFiles&selected_ids=" +
              selectedIds.join(",");
            if (excludedIds.length > 0) {
              zipDownloadUrl += "&excluded_ids=" + excludedIds.join(",");
            }

            // Main console log with requested format
            console.log("Call Zip Link: " + zipDownloadUrl);

            console.log("=== ZIP DOWNLOAD LINK ===");
            console.log("Direct ZIP Download URL: " + zipDownloadUrl);
            console.log(
              "You can copy this link to download the ZIP file directly"
            );
            console.log("=== END ZIP DOWNLOAD LINK ===");

            console.log("=== CALLING ZIP CREATION IN BACKGROUND ===");

            // Add create_only parameter to URL for background creation
            var zipCreationUrl = zipDownloadUrl + "&create_only=false";
            console.log("ZIP Creation URL: " + zipCreationUrl);

            // Call ZIP creation in background using AJAX
            setTimeout(function () {
              console.log("Making AJAX call to create ZIP file...");

              jQuery.ajax({
                url: zipCreationUrl,
                type: "GET",
                dataType: "json", // Expecting JSON response
                success: function (response, status, xhr) {
                  console.log("=== ZIP CREATION SUCCESS ===");
                  console.log("Response:", response);

                  // Hide progress indicator
                  progressIndicatorElement.progressIndicator({ mode: "hide" });

                  if (response.success && response.zip_download_url) {
                    // Log the download link as requested
                    console.log(
                      "ZIP_DOWNLOAD_LINK: " + response.zip_download_url
                    );

                    console.log("=== ZIP FILE READY FOR DOWNLOAD ===");
                    console.log(
                      "Automatically downloading ZIP file: " +
                        response.zip_download_url
                    );

                    // Automatically download the ZIP file
                    setTimeout(function () {
                      console.log("=== STARTING AUTOMATIC DOWNLOAD ===");

                      // Use direct navigation method - most reliable for file downloads
                      console.log("Direct navigation to download ZIP file...");
                      window.location.href = response.zip_download_url;
                      console.log("Download initiated!");

                      // If create_only is false, call cleanup after download delay
                      if (response.create_only === false) {
                        console.log("=== SCHEDULING ZIP FILE CLEANUP ===");
                        setTimeout(function () {
                          // Call cleanup endpoint to remove ZIP file
                          var cleanupUrl =
                            window.location.origin +
                            window.location.pathname +
                            "?module=Invoice&action=CleanupZipFile&zip_file=" +
                            encodeURIComponent(response.zip_file_path);

                          console.log("Calling cleanup URL: " + cleanupUrl);

                          jQuery.ajax({
                            url: cleanupUrl,
                            type: "GET",
                            success: function (cleanupResponse) {
                              console.log(
                                "ZIP file cleanup successful:",
                                cleanupResponse
                              );
                            },
                            error: function (xhr, status, error) {
                              console.log("ZIP file cleanup failed:", error);
                            },
                          });
                        }, 3000); // Wait 3 seconds for download to complete
                      }
                    }, 500);
                  } else {
                    console.log("ERROR: Invalid response format");
                    console.log("Response:", response);

                    // Fallback to direct navigation
                    console.log("Falling back to direct navigation...");
                    window.location.href = zipDownloadUrl;
                  }

                  // Cleanup
                  form.remove();
                  iframe.remove();
                  console.log("=== ZIP FILE PROCESS COMPLETED ===");
                },
                error: function (xhr, status, error) {
                  console.log("=== ZIP CREATION ERROR ===");
                  console.log("Status:", status);
                  console.log("Error:", error);
                  console.log("Response:", xhr.responseText);

                  // Hide progress indicator
                  progressIndicatorElement.progressIndicator({ mode: "hide" });

                  // Try to parse error response
                  try {
                    var errorResponse = JSON.parse(xhr.responseText);
                    if (errorResponse.error) {
                      app.helper.showAlertBox({
                        message:
                          "Error creating ZIP file: " + errorResponse.error,
                        type: "error",
                      });
                    }
                  } catch (e) {
                    // Fallback to direct navigation if JSON parsing fails
                    console.log("Falling back to direct navigation...");
                    window.location.href = zipDownloadUrl;
                  }

                  // Cleanup
                  form.remove();
                  iframe.remove();
                },
                timeout: 60000, // 60 seconds timeout for ZIP creation
              });
            }, 500);
          },
          function (error) {
            // User clicked "No" or cancelled - close dialog
            jQuery(".modal.fade.in").modal("hide");
            jQuery(".modal-backdrop").remove();
            console.log("Export cancelled by user");
          }
        );
    },
  },
  {
    registerEvents: function () {
      this._super();
      this.registerExportPDFFilesEvent();
    },

    registerExportPDFFilesEvent: function () {
      var thisInstance = this;

      // Make the function globally accessible
      window.Invoice_List_Js = Invoice_List_Js;

      // Register the event for mass action links
      var container = this.getListViewContainer();
      container.on("click", 'a[href*="triggerExportPDFFiles"]', function (e) {
        e.preventDefault();
        Invoice_List_Js.triggerExportPDFFiles();
      });

      // Also handle clicks on the dropdown menu
      jQuery(document).on(
        "click",
        'a[data-url*="triggerExportPDFFiles"]',
        function (e) {
          e.preventDefault();
          Invoice_List_Js.triggerExportPDFFiles();
        }
      );

      // Handle direct JavaScript calls
      jQuery(document).on(
        "click",
        'a[onclick*="triggerExportPDFFiles"]',
        function (e) {
          e.preventDefault();
          Invoice_List_Js.triggerExportPDFFiles();
        }
      );
    },
  }
);
