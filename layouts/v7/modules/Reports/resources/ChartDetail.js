/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/

Reports_Detail_Js(
  "Reports_ChartDetail_Js",
  {
    /**
     * Function used to display message when there is no data from the server
     */
    displayNoDataMessage: function () {
      $("#chartcontent")
        .html("<div>" + app.vtranslate("JS_NO_CHART_DATA_AVAILABLE") + "</div>")
        .css({ "text-align": "center", position: "relative", top: "100px" });
    },

    /**
     * Function returns if there is no data from the server
     */
    isEmptyData: function () {
      var jsonData = jQuery("input[name=data]").val();
      var data = JSON.parse(jsonData);
      var values = data["values"];
      if (jsonData == "" || values == "") {
        return true;
      }
      return false;
    },
  },
  {
    /**
     * Function returns instance of the chart type
     */
    getInstance: function () {
      var chartType = jQuery("input[name=charttype]").val();
      var chartClassName = chartType
        .toLowerCase()
        .replace(/\b[a-z]/g, function (letter) {
          return letter.toUpperCase();
        });
      var chartClass = window["Report_" + chartClassName + "_Js"];

      var instance = false;
      if (typeof chartClass != "undefined") instance = new chartClass();
      return instance;
    },

    registerSaveOrGenerateReportEvent: function () {
      var thisInstance = this;
      jQuery(".generateReportChart").on("click", function (e) {
        var advFilterCondition = thisInstance.calculateValues();
        var recordId = thisInstance.getRecordId();
        var currentMode = jQuery(e.currentTarget).data("mode");
        var groupByField = jQuery("#groupbyfield").val();
        var dataField = jQuery("#datafields").val();
        if (dataField == null || dataField == "") {
          vtUtils.showValidationMessage(
            jQuery("#datafields").parent().find(".select2-choices"),
            app.vtranslate("JS_REQUIRED_FIELD")
          );
          return false;
        } else {
          vtUtils.hideValidationMessage(
            jQuery("#datafields").parent().find(".select2-choices")
          );
        }

        if (groupByField == null || groupByField == "") {
          vtUtils.showValidationMessage(
            jQuery("#groupbyfield").parent().find(".select2-container"),
            app.vtranslate("JS_REQUIRED_FIELD")
          );
          return false;
        } else {
          vtUtils.hideValidationMessage(
            jQuery("#groupbyfield").parent().find(".select2-container")
          );
        }

        var postData = {
          advanced_filter: advFilterCondition,
          record: recordId,
          view: "ChartSaveAjax",
          module: app.getModuleName(),
          mode: currentMode,
          charttype: jQuery("input[name=charttype]").val(),
          groupbyfield: groupByField,
          datafields: dataField,
        };

        var reportChartContents = thisInstance
          .getContentHolder()
          .find("#reportContentsDiv");
        app.helper.showProgress();
        e.preventDefault();
        app.request.post({ data: postData }).then(function (error, data) {
          app.helper.hideProgress();
          reportChartContents.html(data);
          thisInstance.registerEventForChartGeneration();
          jQuery(".reportActionButtons").addClass("hide");
        });
      });
    },

    registerEventForChartGeneration: function () {
      var thisInstance = this;
      try {
        thisInstance.getInstance(); // instantiate the object and calls init function
        jQuery("#chartcontent").trigger(Vtiger_Widget_Js.widgetPostLoadEvent);
      } catch (error) {
        Reports_ChartDetail_Js.displayNoDataMessage();
        return;
      }
    },

    registerExportChartEvent: function () {
      jQuery("#exportChartBtn")
        .off("click")
        .on("click", function () {
          // Wait a bit to ensure chart is fully rendered
          setTimeout(function () {
            var chartContainer = jQuery("#chartcontent");

            if (chartContainer.length > 0) {
              // Get chart title
              var jsonData = jQuery("input[name=data]").val();
              var data = JSON.parse(jsonData);
              var chartTitle = (data["title"] || "Chart").replace(
                /[^a-zA-Z0-9]/g,
                "_"
              );

              // Use html2canvas library or manual approach
              // First, try manual canvas approach
              var canvases = chartContainer.find("canvas");

              if (canvases.length > 0) {
                // Get the chart container dimensions
                var containerWidth = chartContainer.outerWidth();
                var containerHeight = chartContainer.outerHeight();

                // Create a new canvas with container size
                var exportCanvas = document.createElement("canvas");
                exportCanvas.width = containerWidth * 2; // Higher resolution
                exportCanvas.height = containerHeight * 2;
                var exportCtx = exportCanvas.getContext("2d");

                // Scale for higher resolution
                exportCtx.scale(2, 2);

                // Set white background
                exportCtx.fillStyle = "white";
                exportCtx.fillRect(0, 0, containerWidth, containerHeight);

                // Draw title if exists
                var titleElement = chartContainer.find(".jqplot-title");
                if (titleElement.length > 0) {
                  var titleText = titleElement.text();
                  if (titleText) {
                    exportCtx.fillStyle = "#333";
                    exportCtx.font = "bold 16px Arial";
                    exportCtx.textAlign = "center";
                    exportCtx.fillText(titleText, containerWidth / 2, 25);
                  }
                }

                // Get canvas position relative to container
                var firstCanvas = canvases[0];
                var canvasOffset = jQuery(firstCanvas).position();

                // Draw all canvas layers
                canvases.each(function (index, canvas) {
                  if (canvas.width > 0 && canvas.height > 0) {
                    try {
                      var canvasPos = jQuery(canvas).position();
                      exportCtx.drawImage(
                        canvas,
                        canvasPos.left,
                        canvasPos.top
                      );
                    } catch (e) {
                      console.log(
                        "Could not draw canvas layer " + index + ":",
                        e
                      );
                    }
                  }
                });

                // Draw data labels on pie chart - get positions from existing jqplot labels
                var dataLabels = chartContainer.find(".jqplot-data-label");
                if (dataLabels.length > 0) {
                  exportCtx.font = "bold 14px Arial";
                  exportCtx.textAlign = "center";
                  exportCtx.fillStyle = "white";
                  exportCtx.strokeStyle = "rgba(0,0,0,0.8)";
                  exportCtx.lineWidth = 2;

                  dataLabels.each(function (index, label) {
                    var $label = jQuery(label);
                    var labelPos = $label.position();
                    var labelText = $label.text();

                    // Add % if not present
                    if (labelText && !labelText.includes("%")) {
                      labelText = labelText + "%";
                    }

                    if (labelText && labelPos) {
                      var labelX = labelPos.left + $label.width() / 2;
                      var labelY = labelPos.top + $label.height() / 2 + 5; // Adjust for text baseline

                      // Draw label with stroke for visibility
                      exportCtx.strokeText(labelText, labelX, labelY);
                      exportCtx.fillText(labelText, labelX, labelY);
                    }
                  });
                }

                // Draw legend manually with proper colors
                var legendTable = chartContainer.find(".jqplot-table-legend");
                if (legendTable.length > 0) {
                  var legendPos = legendTable.position();
                  var legendItems = legendTable.find("tr");

                  // Move legend closer to chart
                  var adjustedLegendLeft = Math.max(
                    legendPos.left - 100,
                    containerWidth * 0.6
                  );

                  // Define pie chart colors (jqPlot default colors)
                  var pieColors = [
                    "#4bb2c5",
                    "#EAA228",
                    "#c5b47f",
                    "#579575",
                    "#839557",
                    "#958c12",
                    "#953579",
                    "#4b5de4",
                    "#d8b83f",
                    "#ff5800",
                  ];

                  exportCtx.font = "12px Arial";
                  exportCtx.textAlign = "left";

                  legendItems.each(function (index, row) {
                    var rowY = legendPos.top + index * 20 + 15;

                    // Draw color box with correct pie slice color
                    var colorToUse = pieColors[index % pieColors.length];
                    exportCtx.fillStyle = colorToUse;
                    exportCtx.fillRect(adjustedLegendLeft, rowY - 8, 12, 12);

                    // Draw border around color box
                    exportCtx.strokeStyle = "#333";
                    exportCtx.lineWidth = 1;
                    exportCtx.strokeRect(adjustedLegendLeft, rowY - 8, 12, 12);

                    // Draw text
                    var labelText = jQuery(row)
                      .find(".jqplot-table-legend-label")
                      .text();
                    if (labelText) {
                      exportCtx.fillStyle = "#333";
                      exportCtx.fillText(
                        labelText,
                        adjustedLegendLeft + 18,
                        rowY
                      );
                    }
                  });
                }

                // Create download link
                var link = document.createElement("a");
                link.download =
                  chartTitle + "_" + new Date().getTime() + ".png";
                link.href = exportCanvas.toDataURL("image/png", 1.0);

                // Trigger download
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);

                // Show success message
                app.helper.showSuccessNotification({
                  message: "Chart with title and legend exported successfully!",
                });
              } else {
                app.helper.showErrorNotification({
                  message: "No chart canvas found to export!",
                });
              }
            } else {
              app.helper.showErrorNotification({
                message: "Chart container not found!",
              });
            }
          }, 1200); // Wait a bit longer for everything to render
        });
    },

    savePinToDashBoard: function (customParams) {
      var element = jQuery("button.pinToDashboard");
      var recordId = this.getRecordId();
      var primarymodule = jQuery('input[name="primary_module"]').val();
      var widgetTitle = "ChartReportWidget_" + primarymodule + "_" + recordId;
      var params = {
        module: "Reports",
        action: "ChartActions",
        mode: "pinChartToDashboard",
        reportid: recordId,
        title: widgetTitle,
      };
      params = jQuery.extend(params, customParams);
      app.request.post({ data: params }).then(function (error, data) {
        if (data.duplicate) {
          var params = {
            message: app.vtranslate(
              "JS_CHART_ALREADY_PINNED_TO_DASHBOARD",
              "Reports"
            ),
          };
          app.helper.showSuccessNotification(params);
        } else {
          var message = app.vtranslate(
            "JS_CHART_PINNED_TO_DASHBOARD",
            "Reports"
          );
          app.helper.showSuccessNotification({ message: message });
          element.find("i").removeClass("vicon-pin");
          element.find("i").addClass("vicon-unpin");
          element.removeClass("dropdown-toggle").removeAttr("data-toggle");
          element.attr(
            "title",
            app.vtranslate("JSLBL_UNPIN_CHART_FROM_DASHBOARD")
          );
        }
      });
    },

    registerEventForPinChartToDashboard: function () {
      var thisInstance = this;
      jQuery("button.pinToDashboard").on("click", function (e) {
        var element = jQuery(e.currentTarget);
        var recordId = thisInstance.getRecordId();
        var pinned = element.find("i").hasClass("vicon-pin");
        if (pinned) {
          if (element.is("[data-toggle]")) {
            return;
          } else {
            thisInstance.savePinToDashBoard();
          }
        } else {
          var params = {
            module: "Reports",
            action: "ChartActions",
            mode: "unpinChartFromDashboard",
            reportid: recordId,
          };
          app.request.post({ data: params }).then(function (error, data) {
            if (data.unpinned) {
              var message = app.vtranslate(
                "JS_CHART_REMOVED_FROM_DASHBOARD",
                "Reports"
              );
              app.helper.showSuccessNotification({ message: message });
              element.find("i").removeClass("vicon-unpin");
              element.find("i").addClass("vicon-pin");
              if (element.data("dashboardTabCount") > 1) {
                element
                  .addClass("dropdown-toggle")
                  .attr("data-toggle", "dropdown");
              }
              element.attr(
                "title",
                app.vtranslate("JSLBL_PIN_CHART_TO_DASHBOARD")
              );
            }
          });
        }
      });

      jQuery("button.pinToDashboard")
        .closest(".btn-group")
        .find(".dashBoardTab")
        .on("click", function (e) {
          var dashBoardTabId = jQuery(e.currentTarget).data("tabId");
          thisInstance.savePinToDashBoard({ dashBoardTabId: dashBoardTabId });
        });
    },

    registerEvents: function () {
      this._super();
      this.registerEventForChartGeneration();
      Reports_ChartEdit3_Js.registerFieldForChosen();
      Reports_ChartEdit3_Js.initSelectValues();
      this.registerEventForPinChartToDashboard();
      var chartEditInstance = new Reports_ChartEdit3_Js();
      chartEditInstance.lineItemCalculationLimit();
    },
  }
);

Vtiger_Pie_Widget_Js(
  "Report_Piechart_Js",
  {},
  {
    postInitializeCalls: function () {
      var thisInstance = this;
      var clickThrough = jQuery(
        "input[name=clickthrough]",
        this.getContainer()
      ).val();
      if (clickThrough != "") {
        thisInstance
          .getContainer()
          .off("vtchartClick")
          .on("vtchartClick", function (e, data) {
            if (data.url) thisInstance.openUrl(data.url);
          });
      }
    },

    loadChart: function () {
      var chartData = this.generateData();
      var chartOptions = {
        renderer: "pie",
        links: this.generateLinks(),
      };

      // Check if this is percentage data and add formatter
      var jsonData = jQuery("input[name=data]", this.getContainer()).val();
      var data = JSON.parse(jsonData);
      var dataTypes = data["data_type"] || [];

      if (dataTypes[0] === "percentage") {
        chartOptions.seriesDefaults = {
          rendererOptions: {
            showDataLabels: true,
            dataLabels: "value",
            dataLabelFormatString: "%.0f%%",
            dataLabelPositionFactor: 1.15,
            dataLabelThreshold: 1,
            sliceMargin: 2,
          },
        };
        chartOptions.legend = {
          show: true,
          location: "e",
        };
      }

      var plot = this.getPlotContainer(false).vtchart(chartData, chartOptions);

      // Add custom percentage formatting for data labels if this is percentage data
      if (dataTypes[0] === "percentage") {
        var thisInstance = this;
        setTimeout(function () {
          jQuery(".jqplot-data-label").each(function () {
            var text = jQuery(this).text();
            if (text && !text.includes("%") && !isNaN(parseFloat(text))) {
              jQuery(this).text(text + "%");
            }
          });
        }, 100);
      }
    },

    postLoadWidget: function () {
      if (!Reports_ChartDetail_Js.isEmptyData()) {
        this.loadChart();
        // Show export button after chart is loaded
        var thisInstance = this;
        setTimeout(function () {
          jQuery("#exportChartContainer").fadeIn(300);
          Reports_ChartDetail_Js.prototype.registerExportChartEvent();
        }, 800);
      } else {
        this.positionNoDataMsg();
      }
      this.postInitializeCalls();
      this.restrictContentDrag();
      var widgetContent = jQuery(
        ".dashboardWidgetContent",
        this.getContainer()
      );
      if (widgetContent.length) {
        if (!jQuery("input[name=clickthrough]", this.getContainer()).val()) {
          var adjustedHeight = this.getContainer().height() - 50;
          app.helper.showVerticalScroll(widgetContent, {
            height: adjustedHeight,
          });
        }
        widgetContent.css({ overflowY: "auto" });
      }
    },

    positionNoDataMsg: function () {
      Reports_ChartDetail_Js.displayNoDataMessage();
    },

    getPlotContainer: function (useCache) {
      if (typeof useCache == "undefined") {
        useCache = false;
      }
      if (this.plotContainer == false || !useCache) {
        var container = this.getContainer();
        this.plotContainer = jQuery('div[name="chartcontent"]', container);
      }
      return this.plotContainer;
    },

    init: function (parent) {
      if (parent) {
        this._super(parent);
      } else {
        this._super(jQuery("#reportContentsDiv"));
      }
    },

    generateData: function () {
      if (Reports_ChartDetail_Js.isEmptyData()) {
        Reports_ChartDetail_Js.displayNoDataMessage();
        return false;
      }

      var jsonData = jQuery("input[name=data]", this.getContainer()).val();
      var data = (this.data = JSON.parse(jsonData));
      var values = data["values"];
      var dataTypes = data["data_type"] || [];

      var chartData = [];
      for (var i in values) {
        chartData[i] = [];
        chartData[i].push(data["labels"][i]);

        // Check if this is percentage data and format accordingly
        var value = values[i];
        if (dataTypes[0] === "percentage") {
          // For pie chart, push the numeric value (jqplot will format it with %)
          chartData[i].push(value);
        } else {
          chartData[i].push(values[i]);
        }
      }
      return {
        chartData: chartData,
        labels: data["labels"],
        data_labels: data["data_labels"],
        data_type: data["data_type"],
        title: data["graph_label"],
      };
    },

    generateLinks: function () {
      var jData = jQuery("input[name=data]", this.getContainer()).val();
      var statData = JSON.parse(jData);
      var links = statData["links"];
      return links;
    },
  }
);

Vtiger_Barchat_Widget_Js(
  "Report_Verticalbarchart_Js",
  {},
  {
    postInitializeCalls: function () {
      var thisInstance = this;
      var clickThrough = jQuery(
        "input[name=clickthrough]",
        this.getContainer()
      ).val();
      if (clickThrough != "") {
        thisInstance
          .getContainer()
          .off("vtchartClick")
          .on("vtchartClick", function (e, data) {
            if (data.url) thisInstance.openUrl(data.url);
          });
      }
    },

    postLoadWidget: function () {
      if (!Reports_ChartDetail_Js.isEmptyData()) {
        this.loadChart();
      } else {
        this.positionNoDataMsg();
      }
      this.postInitializeCalls();
      this.restrictContentDrag();
      var widgetContent = jQuery(
        ".dashboardWidgetContent",
        this.getContainer()
      );
      if (widgetContent.length) {
        if (!jQuery("input[name=clickthrough]", this.getContainer()).val()) {
          var adjustedHeight = this.getContainer().height() - 50;
          app.helper.showVerticalScroll(widgetContent, {
            height: adjustedHeight,
          });
        }
        widgetContent.css({ height: widgetContent.height() - 100 });
      }
    },

    positionNoDataMsg: function () {
      Reports_ChartDetail_Js.displayNoDataMessage();
    },

    getPlotContainer: function (useCache) {
      if (typeof useCache == "undefined") {
        useCache = false;
      }
      if (this.plotContainer == false || !useCache) {
        var container = this.getContainer();
        this.plotContainer = jQuery('div[name="chartcontent"]', container);
      }
      return this.plotContainer;
    },

    init: function (parent) {
      if (parent) {
        this._super(parent);
      } else {
        this._super(jQuery("#reportContentsDiv"));
      }
    },

    generateChartData: function () {
      if (Reports_ChartDetail_Js.isEmptyData()) {
        Reports_ChartDetail_Js.displayNoDataMessage();
        return false;
      }

      var jsonData = jQuery("input[name=data]", this.getContainer()).val();
      var data = (this.data = JSON.parse(jsonData));
      var values = data["values"];

      var chartData = [];
      var yMaxValue = 0;

      if (data["type"] == "singleBar") {
        chartData[0] = [];
        for (var i in values) {
          var multiValue = values[i];
          for (var j in multiValue) {
            chartData[0].push(multiValue[j]);
            if (multiValue[j] > yMaxValue) yMaxValue = multiValue[j];
          }
        }
      } else {
        for (var i in values) {
          var multiValue = values[i];
          var info = [];
          for (var j in multiValue) {
            if (typeof chartData[j] != "undefined") {
              chartData[j].push(multiValue[j]);
            } else {
              chartData[j] = [];
              chartData[j].push(multiValue[j]);
            }
            if (multiValue[j] > yMaxValue) yMaxValue = multiValue[j];
          }
        }
      }
      yMaxValue = yMaxValue + yMaxValue * 0.15;

      return {
        chartData: chartData,
        yMaxValue: yMaxValue,
        labels: data["labels"],
        data_labels: data["data_labels"],
        data_type: data["data_type"],
        title: data["graph_label"],
      };
    },

    generateLinks: function () {
      var jData = jQuery("input[name=data]", this.getContainer()).val();
      var statData = JSON.parse(jData);
      var links = statData["links"];
      return links;
    },
  }
);

Report_Verticalbarchart_Js(
  "Report_Horizontalbarchart_Js",
  {},
  {
    generateChartData: function () {
      if (Reports_ChartDetail_Js.isEmptyData()) {
        Reports_ChartDetail_Js.displayNoDataMessage();
        return false;
      }
      var jsonData = jQuery("input[name=data]", this.getContainer()).val();
      var data = (this.data = JSON.parse(jsonData));
      var values = data["values"];

      var chartData = [];
      var yMaxValue = 0;

      if (data["type"] == "singleBar") {
        for (var i in values) {
          var multiValue = values[i];
          chartData[i] = [];
          for (var j in multiValue) {
            chartData[i].push(multiValue[j]);
            chartData[i].push(parseInt(i) + 1);
            if (multiValue[j] > yMaxValue) {
              yMaxValue = multiValue[j];
            }
          }
        }
        chartData = [chartData];
      } else {
        chartData = [];
        for (var i in values) {
          var multiValue = values[i];
          for (var j in multiValue) {
            if (typeof chartData[j] != "undefined") {
              chartData[j][i] = [];
              chartData[j][i].push(multiValue[j]);
              chartData[j][i].push(parseInt(i) + 1);
            } else {
              chartData[j] = [];
              chartData[j][i] = [];
              chartData[j][i].push(multiValue[j]);
              chartData[j][i].push(parseInt(i) + 1);
            }

            if (multiValue[j] > yMaxValue) {
              yMaxValue = multiValue[j];
            }
          }
        }
      }
      yMaxValue = yMaxValue + yMaxValue * 0.15;

      return {
        chartData: chartData,
        yMaxValue: yMaxValue,
        labels: data["labels"],
        data_labels: data["data_labels"],
        data_type: data["data_type"],
        title: data["graph_label"],
      };
    },

    loadChart: function () {
      var data = this.generateChartData();
      var chartOptions = {
        renderer: "bar",
      };
      if (this.data["links"]) chartOptions.links = this.data["links"];

      // Check if this is percentage data and add formatter
      var dataTypes = this.data["data_type"] || [];
      if (dataTypes[0] === "percentage") {
        chartOptions.formatString = "%.2f%%";
      }

      this.getPlotContainer().vtchart(data, chartOptions);
      jQuery("table.jqplot-table-legend").css("width", "95px");
    },
  }
);

Report_Verticalbarchart_Js(
  "Report_Linechart_Js",
  {},
  {
    generateData: function () {
      if (Reports_ChartDetail_Js.isEmptyData()) {
        Reports_ChartDetail_Js.displayNoDataMessage();
        return false;
      }

      var jsonData = jQuery("input[name=data]", this.getContainer()).val();
      var data = (this.data = JSON.parse(jsonData));
      var values = data["values"];

      var chartData = [];
      var yMaxValue = 0;

      for (var i in values) {
        var value = values[i];
        for (var j in value) {
          if (typeof chartData[j] != "undefined") {
            chartData[j].push(value[j]);
          } else {
            chartData[j] = [];
            chartData[j].push(value[j]);
          }
        }
      }
      yMaxValue = yMaxValue + yMaxValue * 0.15;

      return {
        chartData: chartData,
        yMaxValue: yMaxValue,
        labels: data["labels"],
        data_labels: data["data_labels"],
        data_type: data["data_type"],
        title: data["graph_label"],
      };
    },
    loadChart: function () {
      var data = this.generateChartData();
      var chartOptions = {
        renderer: "horizontalbar",
      };
      if (this.data["links"]) chartOptions.links = this.data["links"];

      // Check if this is percentage data and add formatter
      var dataTypes = this.data["data_type"] || [];
      if (dataTypes[0] === "percentage") {
        chartOptions.formatString = "%.2f%%";
      }

      this.getPlotContainer().vtchart(data, chartOptions);
      jQuery("table.jqplot-table-legend").css("width", "95px");
    },
  }
);
