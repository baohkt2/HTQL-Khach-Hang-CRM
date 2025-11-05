/*+**********************************************************************************
 * Advanced Funnel Charts by SalesPlatform
 * Copyright (C) 2011-2016 SalesPlatform Ltd
 * All Rights Reserved.
 * This extension is licensed to be used within one instance of Vtiger CRM.
 * Source code or binaries may not be redistributed unless expressly permitted by SalesPlatform Ltd.
 * If you have any questions or comments, please email: extensions@salesplatform.ru
 ************************************************************************************/

Vtiger_Widget_Js('Vtiger_Spfunnelcharts_Widget_Js', {},{
    
    spFunnelPostLoadEvent : 'Vtiget.Dashboard.SPFunnelLoaded',
    stepsPopupInfo : [],
    stepsDetailURL : [],
    
    init : function (container) {
        this._super(container);
        this.registerWidgetPostLoadNotificate();
	},
    
    registerWidgetPostLoadNotificate : function() {
        var thisInstance = this;
        $(document).on(this.spFunnelPostLoadEvent, function(e) {
            if(!thisInstance.isEmptyData()) {
                thisInstance.loadChart();
            }
		});
    },
    
    postLoadWidget: function() {
        this._super();
        var thisInstance = this;
        
        /* No hide overflow for popup */
        var container = this.getContainer();
        $(".slimScrollDiv", container).css('overflow', 'visible');
        $(".dashboardWidgetContent", container).css('overflow', 'visible');
        
        container.on("mousemove", function(event) {
            $('#funnel_popup').offset({ 
                top: event.clientY - $('#funnel_popup').height() - 25, 
                left: event.clientX - $('#funnel_popup').width()/2
            });
        });
        
        container.on("jqplotDataHighlight", function(evt, seriesIndex, pointIndex, neighbor) {
            $('#funnel_popup', thisInstance.getContainer()).remove();
            $('.jqplot-event-canvas', thisInstance.getContainer()).css( 'cursor', 'pointer' );
            var displayDataElements = $('.jqplot-data-label', thisInstance.getContainer());
            var bindedPopupElement = $(displayDataElements[pointIndex]).find("#funnel_popup");
            if(thisInstance.stepsPopupInfo[pointIndex] !== '' && bindedPopupElement.length === 0) {
                var popupElement = $('<div id="funnel_popup">' + thisInstance.stepsPopupInfo[pointIndex] + '</div>');
                popupElement.css({ 
                    position: 'absolute', 
                    'z-index': '1000',      //no transparency hack
                    float: 'right',
                    width: '100%',
                    'min-width' : '300px',
                    background: '#fff',
                    border: '2px solid #c0c0c0',
                    margin: '0 44% 0 0',
                    padding: '2px 4px'
                });

                $(displayDataElements[pointIndex]).append(popupElement); 
            }   
        });
        
        container.on("jqplotDataUnhighlight", function(evt, seriesIndex, pointIndex, neighbor) {
            $('.jqplot-event-canvas', thisInstance.getContainer()).css( 'cursor', 'auto' );
            $('#funnel_popup', thisInstance.getContainer()).remove();
        });
        
        container.on('jqplotDataClick', function(ev, gridpos, datapos, neighbor, plot) {
            window.location.href = thisInstance.stepsDetailURL[datapos];
        });
        
        $(document).trigger(this.spFunnelPostLoadEvent);
    },
    
    loadChart : function() {
        this.stepsPopupInfo = [];
        this.stepsDetailURL = [];
        var data = JSON.parse(this.getContainer().find('.widgetData').val());
        var labels = [];
        var dataInfo = [];
        for(var stepIndex = 0; stepIndex < data.length; stepIndex++) {
            var stepData = data[stepIndex];
            labels[stepIndex] = stepData.label;
            dataInfo[stepIndex] = stepData.count;
            
            /* Get info for popups */
            var popupInfo = '';
            for(var summaryEntityIndex = 0; summaryEntityIndex < stepData.summary.length; summaryEntityIndex++) {
                var summaryEntity = stepData.summary[summaryEntityIndex];
                popupInfo += '<div><strong>' + summaryEntity.calculationFieldName + ':</strong> ' + summaryEntity.value + '</div>';
            }
            this.stepsPopupInfo[stepIndex] = popupInfo;
            this.stepsDetailURL[stepIndex] = stepData.detail;
        }
               
        /* Display */
        this.getPlotContainer(false).jqplot([dataInfo],  {
            seriesDefaults: {
                renderer: $.jqplot.FunnelRenderer,
                rendererOptions:{
                    sectionMargin: 12,
                    widthRatio: 0.1,
                    showDataLabels:true,
                    dataLabelThreshold: 0,
                    dataLabels: 'value',
                    sort: false
                }
            },
            legend: {
                show: true,
                location: 'ne',
                placement: 'outside',
                labels:labels,
                xoffset:20
            }
        });
    }
});