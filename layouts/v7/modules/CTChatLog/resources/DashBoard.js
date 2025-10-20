/* * *******************************************************************************
* The content of this file is subject to the CRMTiger Pro license.
* ("License"); You may not use this file except in compliance with the License
* The Initial Developer of the Original Code is vTiger
* The Modified Code of the Original Code owned by https://crmtiger.com/
* Portions created by CRMTiger.com are Copyright(C) CRMTiger.com
* All Rights Reserved.
* ****************************************************************************** */
Vtiger.Class("CTChatLog_DashBoard_Js",{
    registerAppTriggerEvent : function() {
        var view = app.view();
        jQuery('.app-menu').removeClass('hide');
        var toggleAppMenu = function(type) {
            var appMenu = jQuery('.app-menu');
            var appNav = jQuery('.app-nav');
            appMenu.appendTo('#page');
            appMenu.css({
                'top' : appNav.offset().top + appNav.height(),
                'left' : 0
            });
            if(typeof type === 'undefined') {
                type = appMenu.is(':hidden') ? 'show' : 'hide';
            }
            if(type == 'show') {
                appMenu.show(200, function() {});
            } else {
                appMenu.hide(200, function() {});
            }
        };

        jQuery('.app-trigger, .app-icon, .app-navigator').on('click',function(e){
            e.stopPropagation();
            toggleAppMenu();
        });

        jQuery('html').on('click', function() {
            toggleAppMenu('hide');
        });

        jQuery(document).keyup(function (e) {
            if (e.keyCode == 27) {
                if(!jQuery('.app-menu').is(':hidden')) {
                    toggleAppMenu('hide');
                }
            }
        });

        jQuery('.app-modules-dropdown-container').hover(function(e) {
            var dropdownContainer = jQuery(e.currentTarget);
            jQuery('.dropdown').removeClass('open');
            if(dropdownContainer.length) {
                if(dropdownContainer.hasClass('dropdown-compact')) {
                    dropdownContainer.find('.app-modules-dropdown').css('top', dropdownContainer.position().top - 8);
                } else {
                    dropdownContainer.find('.app-modules-dropdown').css('top', '');
                }
                dropdownContainer.addClass('open').find('.app-item').addClass('active-app-item');
            }
        }, function(e) {
            var dropdownContainer = jQuery(e.currentTarget);
            dropdownContainer.find('.app-item').removeClass('active-app-item');
            setTimeout(function() {
                if(dropdownContainer.find('.app-modules-dropdown').length && !dropdownContainer.find('.app-modules-dropdown').is(':hover') && !dropdownContainer.is(':hover')) {
                    dropdownContainer.removeClass('open');
                }
            }, 500);

        });

        jQuery('.app-item').on('click', function() {
            var url = jQuery(this).data('defaultUrl');
            if(url) {
                window.location.href = url;
            }
        });

        jQuery(window).resize(function() {
            jQuery(".app-modules-dropdown").mCustomScrollbar("destroy");
            app.helper.showVerticalScroll(jQuery(".app-modules-dropdown").not('.dropdown-modules-compact'), {
                setHeight: $(window).height(),
                autoExpandScrollbar: true
            });
            jQuery('.dropdown-modules-compact').each(function() {
                var element = jQuery(this);
                var heightPer = parseFloat(element.data('height'));
                app.helper.showVerticalScroll(element, {
                    setHeight: $(window).height()*heightPer - 3,
                    autoExpandScrollbar: true,
                    scrollbarPosition: 'outside'
                });
            });
        });
        app.helper.showVerticalScroll(jQuery(".app-modules-dropdown").not('.dropdown-modules-compact'), {
            setHeight: $(window).height(),
            autoExpandScrollbar: true,
            scrollbarPosition: 'outside'
        });
        jQuery('.dropdown-modules-compact').each(function() {
            var element = jQuery(this);
            var heightPer = parseFloat(element.data('height'));
            app.helper.showVerticalScroll(element, {
                setHeight: $(window).height()*heightPer - 3,
                autoExpandScrollbar: true,
                scrollbarPosition: 'outside'
            });
        });
    },

    registerEventsForGetFacebookMessageDataChangePeriod : function() {
        var thisInstance = this;
        jQuery('#reportData').on('change', function(e){
            var reportChart = jQuery('#activeMessageTab').val();
            thisInstance.getFacebookMessageData(reportChart);
        });
        
        jQuery('#facebookPage').on('change', function(e){
            var reportChart = jQuery('.reportChart').attr('data-selectTab');
            thisInstance.getFacebookMessageData(reportChart);
        });
    },

    registerEventsForGetFacebookMessageDataWithChart : function() {
        var thisInstance = this;
        var reportChart = jQuery('.reportChart').attr('data-selectTab');
        thisInstance.getFacebookMessageData(reportChart);
    },    

    getFacebookMessageData : function(reportChart) {
        var periodData = jQuery('#reportData').val();
        var facebookPage = jQuery('#facebookPage').val();

        var params = {
            'module' : 'CTChatLog',
            'view' : "DashBoard",
            'mode' : "getFacebookMessage",
            'periodData' : periodData,
            'facebookPage' : facebookPage,
        }
        app.helper.showProgress();
        AppConnector.request(params).then(
            function(data) {
                app.helper.hideProgress();
                var periodDataArray = jQuery.parseJSON(data.result['periodData']);
                var xAxisData = jQuery.parseJSON(data.result['getDataFromPeriodData']);

                var totalMessage = jQuery.parseJSON(data.result['totalMessage']);
                var totalMessageURL = data.result['totalMessageURL'];
                var totalSentMessage = jQuery.parseJSON(data.result['totalSentMessage']);
                var totalSentMessageURL = data.result['totalSentMessageURL'];
                var totalReceivedMessage = jQuery.parseJSON(data.result['totalReceivedMessage']);
                var totalReceivedMessageURL = data.result['totalReceivedMessageURL'];

                var totalFinishedChat = jQuery.parseJSON(data.result['totalFinishedChat']);
                var totalPendingChat = jQuery.parseJSON(data.result['totalPendingChat']);

                if(totalFinishedChat == null){
                    jQuery('.FinishedChat').text("0");
                    jQuery('.FinishedChatURL').attr('href', '');
                }else{
                    if(totalFinishedChat != 0 || totalFinishedChat != null || totalFinishedChat != ''){
                        jQuery('.FinishedChat').text(totalFinishedChat);
                        jQuery('.FinishedChatURL').attr('href', '');
                    }
                }

                if(totalPendingChat == null){
                    jQuery('.PendingChat').text("0");
                    jQuery('.PendingChatURL').attr('href', '');
                }else{
                    if(totalPendingChat != 0 || totalPendingChat != null){
                        jQuery('.PendingChat').text(totalPendingChat);
                        jQuery('.PendingChatURL').attr('href', '');
                    }
                }
                
                if(totalSentMessage == null){
                    jQuery('.SentMessage').text("0");
                    jQuery('.SentMessageURL').attr('href', totalSentMessageURL);
                }else{
                    if(totalSentMessage != 0 || totalSentMessage != null){
                        jQuery('.SentMessage').text(totalSentMessage);
                        jQuery('.SentMessageURL').attr('href', totalSentMessageURL);
                    }
                }

                if(totalReceivedMessage == null){
                    jQuery('.ReceivedMessage').text("0");
                    jQuery('.ReceivedMessageURL').attr('href', totalReceivedMessageURL);
                }else{
                    if(totalReceivedMessage != 0 || totalReceivedMessage != null){
                        jQuery('.ReceivedMessage').text(totalReceivedMessage);
                        jQuery('.ReceivedMessageURL').attr('href', totalReceivedMessageURL);
                    }
                }

                if(totalMessage == null){
                    jQuery('.TotalMessage').text("0");
                    jQuery('.TotalMessageURL').attr('href', totalMessageURL);
                }else{
                    if(totalMessage != 0 || totalMessage != null){
                        jQuery('.TotalMessage').text(totalMessage);
                        jQuery('.TotalMessageURL').attr('href', totalMessageURL);
                    }
                }

                yAxisData = [];
                $.each( xAxisData, function( key, value ) {
                    if(key == 'Sent'){
                        key = app.vtranslate('LBL_SENT')
                    }else{
                        key = app.vtranslate('LBL_READ')
                    }  
                    yAxisData.push({"name":key, "data":value.count})
                });
                
                Highcharts.chart('byfacebookMessage', {
                    chart: {
                        type: 'column',
                        backgroundColor: 'White',
                        polar: true
                    },
                    title: {
                        text: ''
                    },
                    subtitle: {
                        text: ''
                    },
                    xAxis: {
                        categories: periodDataArray,
                        crosshair: true
                    },
                    colors: ['#1ecd73', '#7cb5ec', '#556074', '#556074', '#4e5b7b', '#334774', '#8793b1', '#8793b1', '#9bafde', '#9bafde'],
                    yAxis: {
                        min: 0,
                        title: {
                            text: app.vtranslate('LBL_TEXT')
                        }
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0
                        },
                        series: {
                            cursor: 'pointer',
                            point: {
                                events: {
                                    click: function(e){
                                        var seriesName = e.point.series.name+' = '+e.point.y+' = '+e.point.category;
                                        var send = 'Send';
                                        if(e.point.category.length == 4){
                                            var date = '01-01-'+e.point.category+',12-31-'+e.point.category;    
                                        }else{
                                            var date = e.point.category+','+e.point.category;
                                        }
                                        
                                        //code to solve issue
                                        var url = 'index.php?module=CTChatLog&view=List&search_params=[[["createdtime","bw","'+date+'"]';
                                        if(e.point.series.name == 'Sent'){
                                            url += ',["type","e","Send"]';
                                        }else{
                                            url += ',["message_read_unread","e","Read"]';
                                        }

                                        if(facebookPage != ''){
                                            url += ',["platform_unique_id","e","'+facebookPage+'"]';
                                        }//end of if
                                        url += ']]';
                                        window.open(url, '_blank');
                                    }
                                }
                            }
                        },
                    },
                    legend: {
                        itemStyle: {
                            color: 'black',
                            fontWeight: 'bold'
                        }
                    },
                    series: yAxisData
                });
            }
        );
    },

    registerEventForQuickAccessDropdown: function(){
        $('#quickAccessDivDashboard').on('click', function(){
            console.log($(this).closest('div').parent('div').hasClass("open"));
            if($(this).closest('div').parent('div').hasClass("open")){
                $(this).closest('div').parent('div').removeClass("open");
            }else{
                $(this).closest('div').parent('div').addClass("open");
            }//end of else
        });
    },

    /**
     * Registered the events for this page
     */
    registerEvents : function(form) {
        jQuery('#appnav').addClass('hide');
        var thisInstance = this;

        var periodType = jQuery('input[name="periodData"]').val();
        jQuery('#reportData').val(periodType).trigger('change');
        
        thisInstance.registerEventsForGetFacebookMessageDataChangePeriod();
        thisInstance.registerEventsForGetFacebookMessageDataWithChart();
        thisInstance.registerEventForQuickAccessDropdown();
    }    
});

jQuery(document).ready(function(){
    var thisInstance = new CTChatLog_DashBoard_Js();
    thisInstance.registerEvents();
});
