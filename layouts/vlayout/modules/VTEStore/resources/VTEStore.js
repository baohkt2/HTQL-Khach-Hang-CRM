jQuery(document).ready(function () {
    if(app.getParentModuleName()=='Settings') {
        // Get and show Extensions on VTiger Premium Panel
        var url = "index.php?module=VTEStore&action=ActionAjax&mode=getModuleInstalled&parent=Settings";
        var actionParams = {
            "type":"POST",
            "url":url,
            "dataType":"json",
            "data" : {}
        };
        AppConnector.request(actionParams).then(
            function(data) {
                if(data) {
                    var VTEExtensions = data.result.VTEExtensions;
                    var OtherSetting = data.result.OtherSetting;

                    // Change label Vtiger Premium to Premium on left panel
                    if(OtherSetting.use_custom_header==1){
                        var VTEStoreBlock=jQuery("#Settings_sideBar_Extension_Pack").hide();
                        var parent=jQuery(VTEStoreBlock).closest('div');
                        parent.parent().hide();

                        jQuery('h5.widgetTextOverflowEllipsis').each(function( index ) {
                            if(jQuery(this).text()=='VTiger Premium'){
                                jQuery(this).text('Premium');
                            }
                        });
                    }

                    // Hide all our extensions link on other setting panel
                    jQuery('a[class="span9 menuItemLabel"]').each(function( index ) {
                        if(OtherSetting.use_custom_header==1 && jQuery(this).text()=='VTiger Premium'){
                            jQuery(this).text('Premium');
                        }
                        if(VTEExtensions.indexOf(jQuery(this).text())!==-1){
                            var parent=jQuery(this).closest('div');
                            parent.parent().remove();
                        }
                    });

                    // Fill data to VTiger Premium panel
                    var VTEStoreBlock=jQuery("#Settings_sideBar_Extension_Pack");
                    VTEStoreBlock.html(data.result.html);
                    VTEStoreBlock.toggleClass( "in" );
                }
            }
        );

        // Hide "License & Upgrade", "Uninstall" for all our extension
        jQuery('ul[class="dropdown-menu pull-right"] li').each(function( index ) {
            if(jQuery(this).text()=='License & Upgrade' || jQuery(this).text()=='Uninstall' || jQuery(this).text()=='uninstall')
                this.remove();
        });

        var url = window.location.href;
        if(url.indexOf('&parent=Settings&view=Upgrade')!=-1 || (url.indexOf('&parent=Settings')!=-1 && url.indexOf('&view=Upgrade')!=-1)){
            alert('Access Denied');
            jQuery('[name="btnRelease"]').prop('disabled', true);
            jQuery('[name="btnUpgrade"]').prop('disabled', true);
            window.location.href='index.php?module=VTEStore&parent=Settings&view=Settings&reset=1';
        }

    }

    // Fix issue header broken
    var vtversion=getVtigerVersion();
    if(vtversion!='6.0.0'){
        $(".menuBar").children(".span9").css("width","60%");
        $(".menuBar").children(".span3").css("width","40%");
    }


    function getVtigerVersion(){
        var version = '';
        var scripts = document.getElementsByTagName("script")
        for (var i = 0; i < scripts.length; ++i) {
            var src = scripts[i].src;
            if(src.indexOf('.js?v=')>-1){
                var versionTmp = src.split('js?v=');
                version = versionTmp[1];
                break;
            }else if(src.indexOf('.js?&v=')>-1){
                var versionTmp = src.split('.js?&v=');
                version = versionTmp[1];
                break;
            }
        }
        return version;
    }

    addVTPremiumIcon();
    function addVTPremiumIcon(){
        var url = "index.php?module=VTEStore&action=ActionAjax&mode=getDataForVTPremiumIcon";
        var actionParams = {
            "type":"POST",
            "url":url,
            "dataType":"json",
            "data" : {}
        };
        AppConnector.request(actionParams).then(
            function(data) {
                if(data) {
                    var VTPremiumHeader = data.result.VTPremiumHeader;
                    if(VTPremiumHeader.showHeaderIcon==1){
                        var addLiTag=0;
                        if(VTPremiumHeader.version=='1.0.0'){
                            var bgColor='fff';
                            var msg='Extension Pack installation has not been completed.';
                            var btn='<button class="btn btn-warning" style="margin-right:5px;" onclick="location.href=\'index.php?module=VTEStore&parent=Settings&view=Settings\'">Complete Install</button>';
                            addLiTag=1;
                        }else if(VTPremiumHeader.customerid==''){
                            var bgColor='fff';
                            var msg='Extension Pack has been installed. Please login/create an account to get started.';
                            var btn='<button class="btn btn-success" style="margin-right:5px;" onclick="location.href=\'index.php?module=VTEStore&parent=Settings&view=Settings\'">Login/Create Account</button>';
                            addLiTag=1;
                        }else if(VTPremiumHeader.customerid>0 && VTPremiumHeader.customer_status=='no_subscription'){
                            var bgColor='fff';
                        var msg='Your trial will expire in '+VTPremiumHeader.remain_date+' days. Make sure to try out all the extensions! If you have questions on need help email us at <br> <a style="padding: 0px; width: 100%; text-align: center; display: inline-block; font-weight: bold; background-color: inherit!important; color: #333!important;" href="mailto: help@vtexperts.com" target="_blank">help@vtexperts.com</a><br> or initiate chat on website <a style="padding: 0px; display: initial;" href="https://www.vtexperts.com" target="_blank">vtexperts.com</a>';
                            var btn='<button class="btn btn-success" style="margin-right:5px;" onclick="location.href=\'index.php?module=VTEStore&parent=Settings&view=Settings\'">Go to Extension List</button>';
                            addLiTag=1;
                        }else if(VTPremiumHeader.customerid>0 && VTPremiumHeader.customer_status=='trial_expired'){
                            var bgColor='ff9966';
                            var msg='Your trial has expired. Please sign up in order to continue using premium extensions. If you would like us to extend your trial,please email us at <br><a style="padding: 0px; width: 100%; text-align: center; display: inline-block; font-weight: bold;background-color: inherit!important; color: #333!important;" href="mailto: help@vtexperts.com" target="_blank">help@vtexperts.com</a>';
                            var btn='<button class="btn btn-success" style="margin-right:5px;" onclick="location.href=\'index.php?module=VTEStore&parent=Settings&view=Settings\'">Signup</button>';
                            addLiTag=1;
                        }

                        var VTPremiumIcon = '<span class="dropdown span settingIcons">';
                        if(addLiTag==1){
                            VTPremiumIcon += '<a class="dropdown-toggle" data-toggle="dropdown" href="#">';
                            VTPremiumIcon +='<img style="width:25px; height:20px; border-radius: 50%; background-color: #'+bgColor+'" src="layouts/vlayout/modules/VTEStore/resources/images/VTPremiumIcon.png" >';
                            VTPremiumIcon +='</a>';
                            VTPremiumIcon +='<ul class="dropdown-menu pull-right" style="width: 400px;">';
                            VTPremiumIcon +='<li style="padding: 5px 20px 5px 10px;">'+msg+'</li>';
                            VTPremiumIcon +='<li class="divider"></li>';
                            VTPremiumIcon +='<li style="text-align: center">'+btn+'</li>';
                            VTPremiumIcon +='</ul>';
                        }else{
                            var bgColor='fff';
                            VTPremiumIcon += '<a href="index.php?module=VTEStore&parent=Settings&view=Settings">';
                            VTPremiumIcon +='<img style="width:25px; height:20px; border-radius: 50%; background-color: #'+bgColor+'" src="layouts/vlayout/modules/VTEStore/resources/images/VTPremiumIcon.png" >';
                            VTPremiumIcon +='</a>';
                        }
                        VTPremiumIcon +='</span>';

                        if(vtversion=='6.0.0'){
                            var headerIcons = document.getElementById('headerLinks');
                        }else{
                            var headerIcons = document.getElementById('headerLinksBig');
                        }
                        if (headerIcons){
                            headerIcons.innerHTML = VTPremiumIcon + headerIcons.innerHTML ;
                        }
                        Vtiger_Index_Js.changeSkin();
                    }
                }
            }
        );
    }

    jQuery('body').on('click','.user_ids_invalid',function(){
        var url = jQuery(this).data('url');
        var progressIndicatorElement = jQuery.progressIndicator();
        var actionParams = {
            "type":"POST",
            "url":url,
            "dataType":"html",
            "data" : {}
        };
        AppConnector.request(actionParams).then(
            function(data) {
                progressIndicatorElement.progressIndicator({'mode' : 'hide'});
                if(data) {
                    var new_url = 'index.php?module=VTEStore&parent=Settings&view=Settings&mode=ShowWarnings';
                    showWarnings(new_url);
                }
            }
        );
    });
    jQuery('body').on('click','.user_ids_invalid_role',function(){
        var url = jQuery(this).data('url');
        var progressIndicatorElement = jQuery.progressIndicator();
        var actionParams = {
            "type":"POST",
            "url":url,
            "dataType":"html",
            "data" : {}
        };
        AppConnector.request(actionParams).then(
            function(data) {
                progressIndicatorElement.progressIndicator({'mode' : 'hide'});
                if(data) {
                    var new_url = 'index.php?module=VTEStore&parent=Settings&view=Settings&mode=ShowWarnings';
                    showWarnings(new_url);
                }
            }
        );
    });
    jQuery('body').on('click','.user_ids_missing_file',function(){
        var url = jQuery(this).data('url');
        var progressIndicatorElement = jQuery.progressIndicator();
        var actionParams = {
            "type":"POST",
            "url":url,
            "dataType":"html",
            "data" : {}
        };
        AppConnector.request(actionParams).then(
            function(data) {
                progressIndicatorElement.progressIndicator({'mode' : 'hide'});
                if(data) {
                    var new_url = 'index.php?module=VTEStore&parent=Settings&view=Settings&mode=ShowWarnings';
                    showWarnings(new_url);
                }
            }
        );
    });
    function showWarnings(url) {
        var thisInstance = this;
        var progressIndicatorElement = jQuery.progressIndicator();
        var actionParams = {
            "type":"POST",
            "url":url,
            "dataType":"html",
            "data" : {}
        };
        AppConnector.request(actionParams).then(
            function(data) {
                progressIndicatorElement.progressIndicator({'mode' : 'hide'});
                if(data) {
                    app.showModalWindow(data, function(data){
                        if(typeof callBackFunction == 'function'){
                            callBackFunction(data);
                        }
                    }, {'width':'950px'});
                    var params = {
                        text: 'Fixed!',
                        animation: 'show',
                        type: 'success'
                    };
                    Vtiger_Helper_Js.showPnotify(params);
                }
            }
        );
    }
});