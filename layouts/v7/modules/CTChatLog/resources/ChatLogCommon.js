jQuery.Class("ChatLogCommon_Js",{
    _SearchIntiatedEventName : 'VT_SEARCH_INTIATED',

    registerEventsForSendNewFacebookMsgOnSelectRecord : function() {
        //send attachment
        jQuery('#filename').live('change', function(e){
            var tabid = jQuery('.tabid').val();
            msgbody = jQuery('.facebookb #writemsg').val();
            var file = $('#filename').prop('files')[0];
            
            $('.facebookb #writemsg').focus();
            $('.facebookb #writemsg').val(file.name);
        });

        var clickCount = 0;
        $('body').append('<input type="hidden" id="clickcount" value="'+clickCount+'">');
        thisInstanceFB = this;
        jQuery('.facebookb #sendfacebookmsg').on('click', function(e){
            var count = $('#clickcount').val();
            
            if(count == 0){
                clickCount++;
                $('#clickcount').val(clickCount);
                thisInstanceFB.sendFacebookMessages();
            }//end of if
        });

        $("#writemsg").live('keypress',function(event) {
            if (event.which === 13 && !event.shiftKey) {
                var count = $('#clickcount').val();
            
                if(count == 0){
                    clickCount++;
                    $('#clickcount').val(clickCount);
                    if($(this).hasClass('sendMsgPopup')){
                        thisInstanceFB.sendMessagesIndivisualFacebook();
                    }else{
                        thisInstanceFB.sendFacebookMessages();
                    }
                }//end of if
            }
        });
    },

    sendFacebookMessages: function(){
        var allowImageTypeExt = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'];
        thisInstance = this;
        var msgbody = jQuery('.facebookb #writemsg').val();
        if(msgbody.trim() == ''){
            app.helper.showErrorNotification({title: 'Error', message: app.vtranslate('LBL_PLEASE_ENTER_MESSAGE')});
            jQuery('.facebookb #writemsg').val('');
            return false;
        }//end of if

        //Add attachment
        var file = $('#filename').prop('files')[0];

        var maxFileSize = 25 * 1024 * 1024; // 25 MB

        if(file === undefined){
            var filename = '';
        }else{
            var reader = new FileReader();
            reader.addEventListener('load', function() {
                var res = reader.result;
                jQuery('[name="selectfile_data"]').val(res);
            });

            reader.readAsDataURL(file);
            var filename = file.name;
            var filetype = file.type;
            
            var fileSize = file.size;
            if (fileSize > maxFileSize) {
                alert("Failed To Upload Files: The File that you have selected is too large. The Maximum Size is 25 MB.");
                jQuery('#writemsg, #filename, [name="selectfile_data"]').val('');
                msgbody = '';
                return false;
            }
        }

        var facebookModule = $('#facebookModule').val();
        var senderId = jQuery('#sender_id').val();
        var senderName = jQuery('#sender_name').val();
        var moduleRecordId = jQuery('#module_recordid').val();
        var facebookPageId = jQuery('#facebookPageId').val();
        
        if(msgbody != ''){
            setTimeout(function(){
                var base64imagedata = jQuery('[name="selectfile_data"]').val();
                var storageURL = jQuery('#facebookstorageurl').val();
                if(filetype){
                    if(filetype.indexOf('image') > -1){
                        if(jQuery.inArray(filetype, allowImageTypeExt) != -1){
                            var newtag = '<image src="'+base64imagedata+'" style="height: 60px;" style="cursor: pointer;" draggable="false">';
                            var newFilename = filename;
                        }else{
                            app.helper.showErrorNotification({title: 'Error', message: app.vtranslate('Selected file type is not supported. Supported file type is png, jpg & jpeg.')});
                            jQuery('#writemsg, #filename, [name="selectfile_data"]').val('');
                            msgbody = '';
                            $('body').find('#clickcount').val('0');
                            return false;
                        }
                    }else if(filetype.indexOf('pdf') > -1){
                        var newMessageTag = storageURL+'/'+filename;
                        var newtag = '<a href="'+newMessageTag+'" target="_black" draggable="false"><img src="layouts/v7/modules/CTChatLog/image/pdficon.png" style="cursor: pointer;" draggable="false"></a>';
                        var newFilename = filename;
                    }else if(filetype.indexOf('application/vnd.ms-excel') > -1 || filetype.indexOf('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') > -1){
                        var newMessageTag = storageURL+'/'+filename;
                        var newtag = '<a href="'+newMessageTag+'" target="_black"><img src="layouts/v7/modules/CTChatLog/image/excelicon.png" style="cursor: pointer;"></a>';
                        var newFilename = filename;
                    }else if(filetype.indexOf('application/msword') > -1){
                        var newMessageTag = storageURL+'/'+filename;
                        var newtag = '<a href="'+newMessageTag+'" target="_black"><img src="layouts/v7/modules/CTChatLog/image/wordicon.jpg" style="cursor: pointer;"></a>';
                        var newFilename = filename;
                    }else if(filetype.indexOf('application/vnd.openxmlformats-officedocument.presentationml.presentation') > -1 || filetype.indexOf('application/vnd.openxmlformats-officedocument.wordprocessingml.document') > -1){
                        var newMessageTag = storageURL+'/'+filename;
                        var newtag = '<a href="'+newMessageTag+'" target="_black"><img src="layouts/v7/modules/CTChatLog/image/fileicon.png" style="cursor: pointer;"></a>';
                        var newFilename = filename;
                    }else if(filetype.indexOf('video/mp4') > -1){
                        var newMessageTag = storageURL+'/'+filename;
                        var newtag = '<video width="250" height="170" controls>' +'   <source src="'+newMessageTag+'" type="video/mp4">' +'   Your browser does not support the video tag.' +'</video>';
                    }else if (filetype.indexOf('text/csv') > -1) {
                        var newMessageTag = storageURL + '/' + filename;
                        var newtag = '<a href="' + newMessageTag + '" target="_blank"><img src="layouts/v7/modules/CTChatLog/image/fileicon.png" style="cursor: pointer;"></a>';
                        var newFilename = filename;
                    }else{
                        var msgurl = storageURL+'/'+msgbody;
                        var newtag = '<a href="'+msgurl+'" target="_black"><img src="layouts/v7/modules/CTChatLog/image/fileicon.png"></a>';
                        var newFilename = filename;
                    }
                }           
                var escapeEl = document.createElement('textarea');
                escapeEl.innerHTML = msgbody;
                var newtag = thisInstance.replaceBody(escapeEl.innerHTML);

                jQuery('[name="selectfile_data"]').val('');
                var params = {
                    'module' : 'CTChatLog',
                    'view' : "ChatBox",
                    'mode' : "sendMsgOnFacebook",
                    'senderId' : senderId,
                    'msgbody' : msgbody,
                    'moduleRecordId' : moduleRecordId,
                    'facebookModule' : facebookModule,
                    'facebookPageId': facebookPageId,
                    'senderName': senderName,
                    'base64imagedata' : base64imagedata,
                    'filename' : filename,
                    'filetype' : filetype,
                }
                app.helper.showProgress();
                AppConnector.request(params).then(
                    function(data) {
                        app.helper.hideProgress();
                        var msgHistory = jQuery('.chatDiv');
                        jQuery('#replyMessageId, #replymessageText, .facebookb #writemsg').val('');
                        jQuery('.chatDiv').animate({scrollTop: jQuery('.chatDiv')[0].scrollHeight}, 0);
                        jQuery('.reply-input, .closeReplybutton').addClass('hide');
                        jQuery('.facebookb #writemsg').removeAttr("disabled");
                        var facebookModule = jQuery('#facebookModule').val();
                        if(facebookModule){
                            var thisNewInstance = new CTChatLog_CTChatLog_Js();
                            thisNewInstance.registerEventForGetFacebookLogModuleData(facebookModule);
                        }
                    }
                );
            }, 500);
        }//end of if
    },

    replaceBody : function(str, is_xhtml){
        if (typeof str === 'undefined' || str === null) {
        return '';
        }
        var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
        return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
    },

     /* task management popup open issue */
    registerEventForTaskManagement : function(){
        var globalNav = jQuery('.global-nav');
        globalNav.on("click",".taskManagement",function(e){
            if(jQuery("#taskManagementContainer").length > 0){
                app.helper.hidePageOverlay();
                return false;
            }
            
            let callURL = new URLSearchParams(document.location.search.substring(1));
            let name = callURL.get("module"); // is the string "Jonathan" 
            if(name == 'Billing'){
                return false;
            }

            var params = {
                'module' : 'Calendar',
                'view' : 'TaskManagement',
                'mode' : 'showManagementView'
            }
            app.helper.showProgress();
            app.request.post({"data":params}).then(function(err,data){
                if(err === null){
                    app.helper.loadPageOverlay(data,{'ignoreScroll' : true,'backdrop': 'static'}).then(function(){
                        app.helper.hideProgress();
                        $('#overlayPage').find('.data').css('height','100vh');

                        var taskManagementPageOffset = jQuery('.taskManagement').offset();
                        $('#overlayPage').find(".arrow").css("left",taskManagementPageOffset.left+13);
                        $('#overlayPage').find(".arrow").addClass("show");

                        vtUtils.showSelect2ElementView($('#overlayPage .data-header').find('select[name="assigned_user_id"]'),{placeholder:"User : All"});
                        vtUtils.showSelect2ElementView($('#overlayPage .data-header').find('select[name="taskstatus"]'),{placeholder:"Status : All"});
                        var js = new Vtiger_TaskManagement_Js();
                        js.registerEvents();
                    });
                }else{
                    app.helper.showErrorNotification({"message":err});
                }
            });
        });
    },

    registerEventsForFacebookChatPopup : function() { 
        jQuery('#facebookIcon').live('click', function(e){
            var moduleName = app.getModuleName();
            var facebookPopup = true;
            var recordId = jQuery('#recordId').val();
            var senderId = jQuery('#senderId').val();
            
            if(senderId == ''){
                app.helper.showErrorNotification({title: 'Error', message: 'Sender Id is Blank'});
                return false;
            }//end of if

            var params = {
                'module' : 'CTChatLog',
                'view' : "FacebookChatPopup",
                'mode' : "chatPopup",
                'sourceModuleName' : moduleName,
                'recordId' : recordId
            }
            var progressIndicatorElement = jQuery.progressIndicator({
                'position' : 'html',
                'blockInfo' : {
                    'enabled' : true
                }
            });
            AppConnector.request(params).then(
                function(data) {
                    progressIndicatorElement.progressIndicator({
                        'mode' : 'hide'
                    })
                    app.showModalWindow(data, function(data){
                        setTimeout(function(){ 
                            jQuery(".conversation-container").animate({ scrollTop: jQuery('.conversation-container').prop("scrollHeight")}, 0);
                        }, 1000);
                    });
                    $('.modal-backdrop').hide();
                }
            );
        });

        jQuery('#fbNotifyb #facebook').live('click', function(e){
            var moduleName = app.getModuleName();
            var currentTarget = jQuery(e.currentTarget);
            var recordId = currentTarget.data('recordid');
            var moduleName = currentTarget.data('setype');

            var params = {
                'module' : 'CTChatLog',
                'view' : "FacebookChatPopup",
                'mode' : "chatPopup",
                'sourceModuleName' : moduleName,
                'recordId' : recordId
            }
            var progressIndicatorElement = jQuery.progressIndicator({
                'position' : 'html',
                'blockInfo' : {
                    'enabled' : true
                }
            });
            AppConnector.request(params).then(
                function(data) {
                    progressIndicatorElement.progressIndicator({
                        'mode' : 'hide'
                    })
                    app.showModalWindow(data, function(data){
                        setTimeout(function(){ 
                            jQuery(".conversation-container").animate({ scrollTop: jQuery('.conversation-container').prop("scrollHeight")}, 0);
                        }, 1000);
                    });
                    $('.modal-backdrop').hide();
                }
            );
        });
    },

    registerEventsForSendNewMsg : function() {
        var clickCount = 0;
        if($('body').find('#clickcount').length){
            $('body').find('#clickcount').val(clickCount);
        }else{
            $('body').append('<input type="hidden" id="clickcount" value="'+clickCount+'">');
        }//end of else
        var thisInstance = this;
        jQuery('.facebookb .msg_send_btnb').live('click', function(e){
            var count = $('#clickcount').val();
            
            if(count == 0){
                clickCount++;
                $('#clickcount').val(clickCount);
                thisInstance.sendMessagesIndivisualFacebook();
            }//end of if
        });
    },

    sendMessagesIndivisualFacebook : function() {
        var allowImageTypeExt = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'];
        var thisInstance = this;
        var msgbody = jQuery('.sendMsgPopup').val();
        var senderId = jQuery('#sender_id').val();
        var senderName = jQuery('#sender_name').val();
        var moduleRecordId = jQuery('#module_recordid').val();
        var facebookPageId = jQuery('#facebookPageId').val();
        var facebookPageName = jQuery('#facebookPageName').val();
        var moduleName = app.getModuleName();

        if(msgbody.trim() == ''){
            app.helper.showErrorNotification({title: 'Error', message: 'Please enter your Message.'});
            return false;
        }

        //Add attachment
        var file = $('#filename').prop('files')[0];

        var maxFileSize = 25 * 1024 * 1024; // 25 MB

        if(file === undefined){
            var filename = '';
        }else{
            var reader = new FileReader();
            reader.addEventListener('load', function() {
                var res = reader.result;
                jQuery('[name="selectfile_data"]').val(res);
            });

            reader.readAsDataURL(file);
            var filename = file.name;
            var filetype = file.type;
            
            var fileSize = file.size;
            if (fileSize > maxFileSize) {
                alert("Failed To Upload Files: The File that you have selected is too large. The Maximum Size is 25 MB.");
                jQuery('#writemsg, #filename, [name="selectfile_data"]').val('');
                msgbody = '';
                return false;
            }

            if(filetype.indexOf('image') > -1){
                if(jQuery.inArray(filetype, allowImageTypeExt) == -1){
                    app.helper.showErrorNotification({title: 'Error', message: app.vtranslate('Selected file type is not supported. Supported file type is png, jpg & jpeg.')});
                    jQuery('#writemsg, #filename, [name="selectfile_data"]').val('');
                    msgbody = '';
                    $('body').find('#clickcount').val('0');
                    return false;
                }//end of if
            }//end of if
        }

        var currentdatetime = jQuery('#currentdatetime').val();
        var currentusername = jQuery('#currentusername').val();

        setTimeout(function(){
            var base64imagedata = jQuery('[name="selectfile_data"]').val();
            var storageURL = jQuery('#facebookstorageurl').val();
            var msg_history = jQuery('#ap');
            jQuery('.sendMsgPopup, #filename, [name="selectfile_data"]').val('');
            
            var params = {
                'module' : 'CTChatLog',
                'view' : "FacebookChatPopup",
                'mode' : "sentFacebookMsg",
                'facebookPageId' : facebookPageId,
                'msgbody' : msgbody,
                'module_recordid' : moduleRecordId,
                'senderId' : senderId,
                'senderName' : senderName,
                'base64imagedata' : base64imagedata,
                'filename' : filename,
                'filetype' : filetype
            }

            AppConnector.request(params).then(
                function(data) {
                    if(data.result != ''){
                        if(filetype){
                            fileName = data.result.fileName;
                            if(filetype.indexOf('image') > -1){
                                var newtag = '<image src="'+base64imagedata+'" style="height: 60px;" style="cursor: pointer;" draggable="false">';
                            }else if(filetype.indexOf('pdf') > -1){
                                var newMessageTag = storageURL+'/'+fileName;
                                var newtag = '<a href="'+newMessageTag+'" target="_black" draggable="false"><img src="layouts/v7/modules/CTChatLog/image/pdficon.png" style="cursor: pointer;" draggable="false"></a>';
                            }else if(filetype.indexOf('application/vnd.ms-excel') > -1 || filetype.indexOf('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') > -1){
                                var newMessageTag = storageURL+'/'+fileName;
                                var newtag = '<a href="'+newMessageTag+'" target="_black"><img src="layouts/v7/modules/CTChatLog/image/excelicon.png" style="cursor: pointer;"></a>';
                            }else if(filetype.indexOf('application/msword') > -1){
                                var newMessageTag = storageURL+'/'+fileName;
                                var newtag = '<a href="'+newMessageTag+'" target="_black"><img src="layouts/v7/modules/CTChatLog/image/wordicon.jpg" style="cursor: pointer;"></a>';
                            }else if(filetype.indexOf('application/vnd.openxmlformats-officedocument.presentationml.presentation') > -1 || filetype.indexOf('application/vnd.openxmlformats-officedocument.wordprocessingml.document') > -1){
                                var newMessageTag = storageURL+'/'+fileName;
                                var newtag = '<a href="'+newMessageTag+'" target="_black"><img src="layouts/v7/modules/CTChatLog/image/fileicon.png" style="cursor: pointer;"></a>';
                            }else if(filetype.indexOf('video/mp4') > -1){
                                var newMessageTag = storageURL+'/'+fileName;
                                var newtag = '<video width="250" height="170" controls>' +'   <source src="'+newMessageTag+'" type="video/mp4">' +'   Your browser does not support the video tag.' +'</video>';
                            }else if (filetype.indexOf('text/csv') > -1) {
                                var newMessageTag = storageURL + '/' + fileName;
                                var newtag = '<a href="' + newMessageTag + '" target="_blank"><img src="layouts/v7/modules/CTChatLog/image/fileicon.png" style="cursor: pointer;"></a>';
                                var newFilename = fileName;
                            }else{
                                var msgurl = storageURL+'/'+msgbody;
                                var newtag = '<a href="'+msgurl+'" target="_black"><img src="layouts/v7/modules/CTChatLog/image/fileicon.png"></a>';
                            }
                        }else{
                            var escapeEl = document.createElement('textarea');
                            escapeEl.innerHTML = msgbody;
                            var newtag = thisInstance.replaceBody(escapeEl.innerHTML);

                            //code to solve issue : 12638
                            var urlPattern = /^(https?:\/\/)?([\da-z.-]+)\.([a-z.]{2,6})([\/\w .-]*)*\/?$/;
                            if(urlPattern.test(newtag) == true){
                                newtag = '<a href="' + newtag + '" target="_blank" draggable="false"><u>' + newtag + '</u></a>';
                            }
                        }

                        message = '<div class="message sent">' +
                        '    <p>'+newtag+'</p><br>' +
                        '    <span class="metadata">' +
                        '        <span class="time"><b>'+facebookPageName+' - '+currentdatetime+'</span>' +
                        '        <img src="layouts/v7/modules/CTChatLog/image/unread.png" style="width: 14px;"/>' +
                        '    </span>' +
                        '</div>';

                        msg_history.append(message);
                        jQuery(".conversation-container").animate({ scrollTop: jQuery('.conversation-container').prop("scrollHeight")}, 0);
                        $('body').find('#clickcount').val('0');
                        thisInstance.registerEventForGetUnreadMessage();
                    }
                }
            );
        }, 500);
    },

    //Add Comment
    registerEventsForComments : function() {
        jQuery('#commentsdatefb').live("click", function(e) {
            var popupInstance = Vtiger_Popup_Js.getInstance();
            var params = {
                'module' : 'CTChatLog',
                'view' : "Comments",
                'mode' : "commentsPopup"
            }
            popupInstance.showPopup(params,Vtiger_Edit_Js.popupSelectionEvent,function() {
                jQuery('#savecommentsfb').on("click", function(e) {
                    var recordId = jQuery('#module_recordid').val();
                    var dateFilter = jQuery('#datefilter').val();
                    if(dateFilter == ''){
                        app.helper.showErrorNotification({title: 'Error', message: app.vtranslate('Please select the date')});
                        return false;
                    }

                    var commentEntry = jQuery("input[name='commententry']:checked").val();
                    if(commentEntry == undefined){
                        app.helper.showErrorNotification({title: 'Error', message: app.vtranslate('Please select any one Option')});
                        return false;   
                    }
                    
                    var customDate = jQuery('#customdate').val();
                    if(dateFilter == 'custom' && customDate == ''){
                        app.helper.showErrorNotification({title: 'Error', message: app.vtranslate('Please Select Custom Date')});
                        return false;
                    }//end of if

                    var params = {
                        'module' : 'CTChatLog',
                        'view' : "Comments",
                        'mode' : "saveComments",
                        'recordId' : recordId,
                        'dateFilter' : dateFilter,
                        'customDate' : customDate,
                        'commentEntry' : commentEntry
                    }
                    app.helper.showProgress();
                    AppConnector.request(params).then(
                        function(data) {
                        app.helper.hideProgress();
                        app.helper.hidePopup();
                        app.helper.showSuccessNotification({'title': 'Success', 'message': app.vtranslate('Comments Added Successfully')});
                    });
                });
            });
        });

        jQuery('#datefilter').live("change", function(e) {
            var datefilter = jQuery('#datefilter').val();
            if(datefilter == "custom"){
                jQuery('.customdateblock').removeClass('hide');
            }else{
                jQuery('.customdateblock').addClass('hide');
            }
        });

        jQuery('#modulefields').live("change", function(e) {
            var modulefields = jQuery('#modulefields').val();
            var oldtext = jQuery('#message').val();
            var newtext = oldtext+' '+modulefields;
            jQuery('#message').val(newtext);
        });
    },

    registerEventForShowNewMessages : function(){
        var thisInstance = this;
        jQuery('.facebookb .showNewMessages1').live("click", function() {
            if(jQuery("#fbNotifyb").css("display") == 'none' || jQuery("#fbNotifyb").css("display") == undefined){
                if($('.facebookb > a').attr('aria-expanded') == 'true'){
                    var displayCss= 'display:none';
                }else{
                    var displayCss= 'display:block';
                }
            }else{
                if($('.facebookb > a').attr('aria-expanded') == 'true'){
                    var displayCss= 'display:none';
                }else{
                    var displayCss= 'display:block';
                }
            }

            jQuery('#messageunread').val(0);
            jQuery('.counterMsgs').addClass('hide');
            var params = {
                'module' : 'CTChatLog',
                'view' : "ChatBox",
                'mode' : "getFacebookIcon",
                'sourceModule' : app.getModuleName()
            }
            AppConnector.request(params).then(
                function(data) {
                    var rtlStyle = 'float: left !important;';
                    
                    if(data.result['unread_count'] != 0){
                        var unreadcount = '<span class="counterMsgs" style="background: #e21c1c;color: #fff;font-size: 10px;border-radius: 50px;padding: 3px 7px;position: relative;top: -10px;left: -10px;">'+data.result['unread_count']+'</span>';
                    }else{
                        var unreadcount = '<span class="counterMsgs hide" style="background: #e21c1c;color: #fff;font-size: 10px;border-radius: 50px;padding: 3px 7px;position: relative;top: -10px;left: -10px;"></span>';
                    }

                    if($('#fbNotifyb').length > 0){
                        $('#fbNotifyb').remove();
                    }

                    var notificationLabel = app.vtranslate('Notifications');
                    var showAllNotificationLabel = app.vtranslate('Show All Notifications');

                    if(data.result['themeView'] == 'RTL'){
                        if(data.result['isAdmin'] == 'on'){
                            var settingIcon = '<a class="settingFBTab"  href="index.php?module=CTFacebookMessengerIntegration&parent=Settings&view=CTGeneralConfiguration" style="display: inline-block;clear: none !important;padding: 0 4px;width: auto !important;padding: 0 4px;background: transparent !important;" title="Facebook Messenger Setting"><img src="layouts/v7/modules/CTChatLog/image/settings_green.png" class="" style="width: 20px;height: 20px;cursor: pointer;"/></a>';
                        }else{
                            var settingIcon = '';
                        }

                        var VTPremiumIcon = ['',
                                                '<ul class="dropdown-menu" id="fbNotifyb" style="width: 300px;'+displayCss+'">',
                                                    '<li class="boxHead" style="background: #fff;color: #333;padding: 5px 10px;width: 100%;display: inline-block;float: left;border-bottom: 1px solid rgb(44 59 73 / 15%);"> <span style="display: inline-block;float: right;font-size: 14px;font-weight: 700;">'+notificationLabel+'</span>',
                                                        '<div class="notifyIcons" style="display: inline-block;float: left;text-align: right !important;">',

                                                        '<a class="allMessageTab hide" href="index.php?module=CTChatLog&view=ChatBox&mode=allChats" style="display: inline-block;clear: none !important;float: right !important;width: auto !important;padding: 0 4px;background: transparent !important;"><img src="layouts/v7/modules/CTChatLog/image/listing_green.png" class="" style="width: 20px;height: 20px;cursor: pointer;"/></a>',

                                                        '<span id="readFacebookMessage" tooltip="Mark all notification as read" class="" style="display: inline-block;clear: none !important;width: auto !important;padding: 0 4px;background: transparent !important;"><img src="layouts/v7/modules/CTChatLog/image/readmessage.png" class="" style="width: 20px;height: 20px;cursor: pointer;"/></span>',
                                                         '<a class="DashBoardTab" href="index.php?module=CTChatLog&view=DashBoard&mode=moduleDashBoard&analytics=1" style="display: inline-block;clear: none !important;width: auto !important;padding: 0 4px;background: transparent !important;" title="Analytics"><img src="layouts/v7/modules/CTChatLog/image/fb_analytics.png" class="" style="width: 20px;height: 20px;cursor: pointer;"/></a>',
                                                        ''+settingIcon+'</div>',

                                                        '</li>',
                                                    ''+data.result['notificationHTML']+'',
                                                    '<li style="width: 100%;display: inline-block;float: left;border-bottom: 1px solid rgb(44 59 73 / 15%);">',
                                                        '<a href="index.php?module=CTChatLog&view=ChatBox&mode=allChats" class="center allMessageTab" style="padding: 10px 10px !important;color: #333 !important;float: right;direction: rtl;width: 100%;text-align: center;"><b style="font-size: 14px; !important;margin: 54px;">'+showAllNotificationLabel+' <img src="layouts/v7/modules/CTChatLog/image/listing_green.png" class="" style="width: 20px;height: 20px;cursor: pointer;margin: 0px 0px 0px 100px;"></b>',
                                                        '</a>',
                                                '</ul>',
                                            ''].join('');

                    }else{
                        if(data.result['isAdmin'] == 'on'){
                            var settingIcon = '<a class="settingFBTab"  href="index.php?module=CTFacebookMessengerIntegration&parent=Settings&view=CTGeneralConfiguration" style="display: inline-block;clear: none !important;float: left !important;padding: 0 4px;width: auto !important;padding: 0 4px;background: transparent !important;" title="Facebook Messenger Setting"><img src="layouts/v7/modules/CTChatLog/image/settings_green.png" class="" style="width: 20px;height: 20px;cursor: pointer;"/></a>';
                        }else{
                            var settingIcon = '';
                        }

                        var VTPremiumIcon = ['',
                                                    '<ul class="dropdown-menu" id="fbNotifyb" style="width: 300px;'+displayCss+'">',
                                                        '<li class="boxHead" style="background: #fff;color: #333;padding: 5px 10px;width: 100%;display: inline-block;float: left;border-bottom: 1px solid rgb(44 59 73 / 15%);"> <span style="display: inline-block;float: left;width: 30%;font-size: 14px; font-weight: 700;">'+notificationLabel+'</span>',
                                                            '<div class="notifyIcons" style="display: inline-block;float: right;text-align: right !important;">',

                                                            '<span id="readFacebookMessage" tooltip="Mark all notification as read" class="" style="display: inline-block;clear: none !important;float: left !important;width: auto !important;padding: 0 4px;background: transparent !important;"><img src="layouts/v7/modules/CTChatLog/image/readmessage.png" class="" style="width: 20px;height: 20px;cursor: pointer;"/></span>',

                                                            '<a class="allMessageTab hide" href="index.php?module=CTChatLog&view=ChatBox&mode=allChats" style="display: inline-block;clear: none !important;float: left !important;width: auto !important;padding: 0 4px;background: transparent !important;"><img src="layouts/v7/modules/CTChatLog/image/listing_green.png" class="" style="width: 20px;height: 20px;cursor: pointer;"/></a>',
                                                            '<a class="settingFBTab" href="index.php?module=CTChatLog&view=DashBoard&mode=moduleDashBoard&analytics=1" style="display: inline-block;clear: none !important;float: left !important;width: auto !important;width: auto !important;padding: 0 4px;background: transparent !important;" title="Analytics"><img src="layouts/v7/modules/CTChatLog/image/fb_analytics.png" class="" style="width: 20px;height: 20px;cursor: pointer;"/></a>',
                                                            ''+settingIcon+'</div>',

                                                            '</li>',
                                                        ''+data.result['notificationHTML']+'',
                                                        '<li style="width: 100%;display: inline-block;float: left;border-bottom: 1px solid rgb(44 59 73 / 15%);">',
                                                            '<a class="showAllMessages" href="index.php?module=CTChatLog&view=ChatBox&mode=allChats" class="center" style="padding: 10px 10px !important;color: #333 !important;"><b style="font-size: 14px;margin: 54px; !important;">'+showAllNotificationLabel+'</b> <img src="layouts/v7/modules/CTChatLog/image/listing_green.png" class="" style="width: 20px;height: 20px;cursor: pointer;margin: 0px 0px 0px -50px;">',
                                                            '</a>',
                                                    '</ul>',
                                                ''].join('');
                    }
                    var headerIcons = $('#navbar ul.nav.navbar-nav .facebookb .showNewMessages1');
                    headerIcons.after('');
                    headerIcons.after(VTPremiumIcon);
                }
            );
        });

        jQuery('.showAllMessages, .allMessageTab').live('click', function(){
            var redirectURL = 'index.php?module=CTChatLog&view=ChatBox&mode=allChats';
            window.location(redirectURL);
        });

         jQuery('.settingFBTab').live('click', function(){
            var redirectURL = 'index.php?module=CTFacebookMessengerIntegration&parent=Settings&view=CTGeneralConfiguration';
            window.location(redirectURL);
        });
    },

    //Edit Repord On Whatsapp Popup
    registerEventForEditRecordInPopup : function() {
        jQuery('.editModuleField').live("click", function(e) {
            var popupInstance = Vtiger_Popup_Js.getInstance();
            var currentTarget = jQuery(e.currentTarget);
            var sourceModuleName = jQuery("#module_name").val();
            var moduleRecordId = jQuery("#module_recordid").val();
            var msgBody = currentTarget.prev('.received').find('p').text();
            
            if(msgBody == ''){
                var msgBody = currentTarget.attr('data-messagebody');
            }

            var params = {
                'module' : 'CTChatLog',
                'view' : "QuickCreateRecord",
                'mode' : "editRecordWithSelectBody",
                'sourceModuleName' : sourceModuleName,
                'moduleRecordId' : moduleRecordId,
                'msgBody' : msgBody
            }
            
            popupInstance.showPopup(params,Vtiger_Edit_Js.popupSelectionEvent,function() {
                jQuery('.modal-backdrop').css({'z-index':'auto'});
                jQuery('#saveEditRecord').on("click", function(e) {
                    var fieldname = jQuery("#fieldname").val();
                    if(fieldname == ''){
                        app.helper.showErrorNotification({'title': 'Error', 'message': 'Please Select a Field'});
                        return false;
                    }//end of if
                    
                    var params = {
                        'module' : 'CTChatLog',
                        'view' : "QuickCreateRecord",
                        'mode' : "saveEditRecordWithSelectBody",
                        'sourceModuleName' : sourceModuleName,
                        'moduleRecordId' : moduleRecordId,
                        'msgBody' : msgBody,
                        'fieldname' : fieldname
                    }
                    app.helper.showProgress();
                    AppConnector.request(params).then(
                        function(data) {
                        app.helper.hideProgress();
                        app.helper.hidePopup();
                        app.helper.showSuccessNotification({'title': 'Success', 'message': 'Record is edit successfully.'});
                    });
                });

            });
        });
    },

    //Function for Get Unread Message on Chat
    registerEventForGetUnreadMessage : function(){
        var recordId = jQuery('#module_recordid').val();
        if(recordId == ''){
            var recordId = jQuery('#sender_id').val();
        }

        if(recordId != undefined && recordId != ''){
            var params = {
                'module' : 'CTChatLog',
                'view' : "ChatBox",
                'mode' : "getNewUnreadMessages",
                'recordId' : recordId,
                'individulMessage' : 1
            }
            AppConnector.request(params).then(
                function(data) {
                    if(data.result['rows'] != 0){
                        var msg_history = jQuery('#ap');
                        msg_history.append(data.result['facebookMessageHTML']);
                        var propdata = jQuery('.conversation-container').prop("scrollHeight");
                        jQuery(".conversation-container").animate({ scrollTop: propdata + 100}, 0);
                        $('body').find('#clickcount').val('0');
                    }
                }
            );
        }
    },

    registerEventForReadFacebookMessage : function () {
        jQuery('#readFacebookMessage').live('click',function(e){
            var message = 'Are you sure to Read all Facebook Unread messages?'
            app.helper.showConfirmationBox({'message' : message}).then(function(data) {
                var params = {
                    'module' : 'CTChatLog',
                    'view' : "ChatBox",
                    'mode' : "readAllFacebookMessages",
                }
                AppConnector.request(params).then(
                    function(data) {
                        app.helper.showSuccessNotification({'title': 'Success', 'message': 'All messages are read successfully'});
                        location.reload();
                    }
                );
            });
        });
    },

    registerEventsForLicense : function(){
        if(app.getViewName() !== 'CTFacebookMessengerIntegrationList'){
            var currentDomain = window.location.origin;

            jQuery('#saveLicense').on('click',function(e){
                var moduleName = 'CTFacebookMessengerIntegration';
                var licenseKey = $('#licence').val();

                if(licenseKey.trim() == ''){
                    text = 'Please Enter License Key';
                    app.helper.showErrorNotification({message: text});
                    return false;
                }//end of if

                var progressIndicatorElement = jQuery.progressIndicator({
                   'position' : 'html',
                   'blockInfo' : {
                        'enabled' : true
                    }
                });

                var licenseParams = {
                    'module' : moduleName,
                    'parent': app.getParentModuleName(),
                    'view' : 'License',
                    'licensekey' : licenseKey,
                    'mode' : 'ActivateLicense'
                }
            
                AppConnector.request(licenseParams).then(
                    function(data) {
                        progressIndicatorElement.progressIndicator({
                            'mode' : 'hide'
                        });
                        var msg = data.result.msg;
                        var code = data.result.code;

                        if(code === 100 || code === 101){
                            var params = {
                                title : app.vtranslate(msg),
                                text: msg,
                                animation: 'show',
                                type: 'error'
                            };
                            Vtiger_Helper_Js.showPnotify(params);   
                        }else if(code === 103){
                            another_domain = data.result.domain;
                            license_key = data.result.license_key;

                            var params = {
                                'module' : moduleName,
                                'parent': app.getParentModuleName(),
                                'view' : 'License',
                                'licensekey' : license_key,
                                'domain' : another_domain,
                                'mode' : 'deactivateLicense'
                            }

                            var message1 = app.vtranslate('Your License key is already registered with')+'"'+another_domain+'" ,'+app.vtranslate('Are you Sure Want to Deactivate from there and Activate to current Instance ?');
                            app.helper.showConfirmationBox({'message' : message1}).then(function(data) {
                                var progressIndicatorElement2 = jQuery.progressIndicator({
                                    'position' : 'html',
                                    'blockInfo' : {
                                        'enabled' : true
                                    }
                                });
                                app.request.post({data: params}).then(function(err, response) {
                                    if(response){
                                        var params2 = {
                                            'module' : moduleName,
                                            'parent': app.getParentModuleName(),
                                            'view' : 'License',
                                            'licensekey' : license_key,
                                            'mode' : 'ActivateLicense'
                                        }

                                        AppConnector.request(params2).then(function(data2) {
                                            progressIndicatorElement2.progressIndicator({'mode' : 'hide'});
                                            var message = data2.result.msg;
                                            var resultCode = data2.result.code;

                                            if(resultCode === 100 || resultCode === 101 || resultCode === 103){
                                                var pparams = {
                                                    title : app.vtranslate('Something went wrong'),
                                                    text: app.vtranslate('Something went wrong'),
                                                    animation: 'show',
                                                    type: 'error'
                                                };
                                                Vtiger_Helper_Js.showPnotify(pparams);
                                            }else{
                                                var params = {
                                                    title : app.vtranslate(message),
                                                    text: message,
                                                    animation: 'show',
                                                    type: 'info'
                                                };
                                                Vtiger_Helper_Js.showMessage(params);
                                                window.location.href = 'index.php?module=CTWhatsAppExt&parent=Settings&view=Dashboard';
                                            }//end of else
                                        });
                                    }//end of if
                                });
                            }); 
                        }else{
                            var params = {
                                title : app.vtranslate(msg),
                                text: msg,
                                animation: 'show',
                                type: 'info'
                            };
                            Vtiger_Helper_Js.showMessage(params);
                            location.reload();
                        }//end of else
                    },
                   function(error,err){
                
                   }
                );
            });
        }
    },

    registerEventForCopyText : function(){
        jQuery('.copyMessageBody').live('click',function(e){
            var element = jQuery(e.currentTarget);
            var copymessage = element.attr('data-copymessage');
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(copymessage).select();
            document.execCommand("copy");
            $temp.remove();
        });
    }, 

    registerEvents : function(form) {
        var thisInstance = this;
        thisInstance.registerEventsForSendNewFacebookMsgOnSelectRecord();
        thisInstance.registerEventForTaskManagement();
        thisInstance.registerEventsForFacebookChatPopup();
        thisInstance.registerEventsForSendNewMsg();
        thisInstance.registerEventsForComments();
        thisInstance.registerEventForShowNewMessages();
        thisInstance.registerEventForEditRecordInPopup();
        thisInstance.registerEventForGetUnreadMessage();
        thisInstance.registerEventForReadFacebookMessage();
        thisInstance.registerEventsForLicense();
        thisInstance.registerEventForCopyText();
    }
});

jQuery(document).ready(function(){
    var thisInstance = new ChatLogCommon_Js();
    thisInstance.registerEvents();
    
    var fbLicensekey = '';
    var licenseParams = {
        'module' : 'CTFacebookMessengerIntegration',
        'parent' : 'Settings',
        'view' : 'License',
        'mode' : 'getLicenseKeyData'
    }
    AppConnector.request(licenseParams).then(
        function(data) {
            if(data.result != ''){
                fbLicensekey = data.result;
            }//end of if
        }//end of function
    );
    
    setInterval(function(){
        var facebookRelatedMessage = jQuery('#facebookRelatedMessage').val();
        if(facebookRelatedMessage != 1){
            var relatedModuleName = jQuery('.relatedModuleName').val();
            if(relatedModuleName == 'CTChatLog' && app.view() == 'Detail'){
                var recordId = jQuery('#recordId').val();
                var nextFacebookRelatedMessage = jQuery('#nextFacebookRelatedMessage').val();
                var params = {
                    'module' : 'CTChatLog',
                    'view' : "ChatBox",
                    'mode' : "getCTChatLogInRelatedTab",
                    'recordId' : recordId,
                    'sourceModule' : app.getModuleName(),
                    'nextFacebookRelatedMessage' : nextFacebookRelatedMessage
                }
                AppConnector.request(params).then(
                    function(data) {
                        jQuery('head').append('<link rel="stylesheet" type="text/css" href="layouts/v7/modules/CTChatLog/css/allChats.css">');
                        jQuery('.relatedViewActions').css('display', 'none');
                        jQuery('.relatedContents').html();
                        if(data.result['facebookMessages'] != ''){
                            jQuery('.relatedContents').html('<div class="chatDiv">'+data.result['facebookMessages']+'<div>');
                            jQuery('.replyMessageBody').css('display', 'none');
                            jQuery('.editModuleField').css('display', 'none');
                            jQuery('.chatDiv').css('max-height', '400px');
                            jQuery('.chatDiv').append('<input type="hidden" id="facebookRelatedMessage" value="1">');
                            jQuery('.chatDiv').append('<input type="hidden" id="nextFacebookRelatedMessage" value="5">');
                            jQuery('.chatDiv').animate({scrollTop: jQuery('.chatDiv')[0].scrollHeight}, 0);
                            jQuery('.chatDiv').after('<br><br><div><button class="btn btn-default nextFacebookRealtedRecord" style="float: inline-end;margin: 5px 10px 10px 0px;">More</button></div>');
                        }else{
                            jQuery('.relatedContents').html('<div class="chatDiv"><p style="text-align: center; margin: 10px;">No conversation Found</p><div>');
                        }//end of else
                    }
                );
            }
        }
    }, 2000);

    $(".nextFacebookRealtedRecord").live('click', function() {
        var recordId = jQuery('#recordId').val();
        var nextFacebookRelatedMessage = jQuery('#nextFacebookRelatedMessage').val();
        var nextRecord = parseInt(nextFacebookRelatedMessage) + parseInt(5);
        var params = {
            'module' : 'CTChatLog',
            'view' : "ChatBox",
            'mode' : "getCTChatLogInRelatedTab",
            'recordId' : recordId,
            'sourceModule' : app.getModuleName(),
            'nextFacebookRelatedMessage' : nextFacebookRelatedMessage
        }
        AppConnector.request(params).then(
            function(data) {
                var rows = data.result['rows'];
                var newMessageHTML = jQuery('.chatDiv').html()+data.result['facebookMessages'];
                jQuery('.chatDiv').html('');
                jQuery('.relatedContents').html('<div class="chatDiv">'+newMessageHTML+'<div>');
                jQuery('.replyMessageBody').css('display', 'none');
                jQuery('.editModuleField').css('display', 'none');
                jQuery('.chatDiv').css('max-height', '400px');
                jQuery('#nextFacebookRelatedMessage').val(nextRecord);
                jQuery('.chatDiv').animate({scrollTop: jQuery('.chatDiv')[0].scrollHeight}, 0);
                jQuery('.chatDiv').after('<br><br><div><button class="btn btn-default nextFacebookRealtedRecord" style="float: inline-end;margin: 5px 10px 10px 0px;">More</button></div>');
                if(data.result['facebookMessages'] == ''){
                    jQuery('.nextFacebookRealtedRecord').addClass('hide');
                }
            }
        );
    });

    if(app.view() == 'Detail'){
        setTimeout(function(){
            var moduleRecordId = jQuery('#recordId').val();
            var params = {
                'module' : 'CTChatLog',
                'view' : "FacebookChatPopup",
                'mode' : "allowAccessFacebook",
                'sourceModule' : app.getModuleName(),
                'recordId' : moduleRecordId
             }
            AppConnector.request(params).then(
                function(data) {
                    if(data.result['active'] == 1){
                        if(data.result['unreadmsg'] != 0){
                            var notificationCount = "<span style='border-radius: 18px; font: bold 10px Arial; padding: 1px 5px; background: red; margin: 2px 8px 4px -3px;color: white;' id='smscounts'>"+data.result['unreadmsg']+"</span>";
                        }else{
                            var notificationCount = "<span style='border-radius: 18px; font: bold 10px Arial; padding: 1px 5px; margin: 2px 8px 4px -3px;color: white;' id='smscounts'>"+data.result['unreadmsg']+"</span>";
                        }
                        if(data.result['senderId']){
                            var facebookIconData = "<div id='facebookIcon' style='margin: 0px 0px 16px 90px;'><input type='hidden' id='senderId' value='"+data.result['senderId']+"'><img src='layouts/v7/modules/CTChatLog/image/facebookIcon.png' style='height: 20px;cursor: pointer;margin: 1px -5px -23px 2px;'>"+notificationCount+"</div>";
                            jQuery('.recordBasicInfo').after(facebookIconData);
                        }
                    }
                }
            );
        }, 1500);
    }

    $("#page").click(function() {
        jQuery("#fbNotifyb").css("display", "none");
    });

    if(app.view() != 'ChatBox'){
        jQuery('#messageunread').val(0);
        jQuery('.counterMsgs').addClass('hide');
        var params = {
            'module' : 'CTChatLog',
            'view' : "ChatBox",
            'mode' : "getFacebookIcon",
            'sourceModule' : app.getModuleName()
        }
        AppConnector.request(params).then(
            function(data) {
                if(data.result != ''){
                    var rtlStyle = 'float: left !important;';
                    if(data.result['unread_count'] != 0){
                        var unreadcount = '<span class="counterMsgs" style="background: #e21c1c;color: #fff;font-size: 10px;border-radius: 50px;padding: 3px 7px;position: relative;top: -10px;left: -10px;">'+data.result['unread_count']+'</span>';
                    }else{
                        var unreadcount = '<span class="counterMsgs hide" style="background: #e21c1c;color: #fff;font-size: 10px;border-radius: 50px;padding: 3px 7px;position: relative;top: -10px;left: -10px;"></span>';
                    }

                    if(data.result['isAdmin'] == 'on'){
                        var settingIcon = '<a class=""  href="index.php?module=CTFacebookMessengerIntegration&parent=Settings&view=CTGeneralConfiguration" style="display: inline-block;clear: none !important;'+rtlStyle+'padding: 0 4px;width: auto !important;padding: 0 4px;background: transparent !important;" title="Facebook Messenger Setting"><img src="layouts/v7/modules/CTChatLog/image/settings_green.png" class="" style="width: 20px;height: 20px;cursor: pointer;"/></a>';
                    }else{
                        var settingIcon = '';
                    }
                    if($('.facebookb > .showNewMessages1').length > 0){
                        $('.facebookb > .showNewMessages1').closest('li').remove();
                    }
                    
                    //code to solve issue
                    setTimeout(function() {
                        if($('.showNewMessages1').length > 0){
                            $('.showTimelineMessage1').remove();
                        }  
                    }, 100);

                    if(data.result['chatAccessTokenNumRows'] == 0 || data.result['chatAccessTokenNumRows'] == null){
                        var facebookIcon = 'layouts/v7/modules/CTChatLog/image/facebookIconRed.png';
                    }else{
                        var facebookIcon = 'layouts/v7/modules/CTChatLog/image/facebookIcon.png';
                    }//end of else

                    var VTPremiumIcon = ['<li class="dropdown">',
                                                            '<div style=";" class="facebookb"><input type="hidden" name="messageunread" value="'+data.result['unread_count']+'" id="messageunread">','<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="padding: 8px 10px !important;">',
                                                                '<img class="showNewMessages1" src="'+facebookIcon+'" style="height: 22px;border-radius: 0 !important;margin: 2px 0px 0px 0px;">',
                                                                ''+unreadcount+'</a>',
                                                            '</div>',
                                                        '</li>'].join('');

                    var headerIcons = $('#navbar ul.nav.navbar-nav');
                    if (headerIcons.length > 0){
                        headerIcons.first().prepend(VTPremiumIcon);
                    }

                    $('.showNewMessages1').on('click', function(){
                        if(jQuery("#fbNotifyb").css("display") == 'none'){
                            $('#fbNotifyb').css('display','block');
                        }else{
                            $('#fbNotifyb').css('display','none');
                        }
                    });
                }
            }
        );
    }

    if(app.getModuleName() == 'CTChatLog'){
        setInterval(function(){
            if(app.view() == 'ChatBox'){
                var recordId = jQuery('#module_recordid').val();
                if(recordId == ''){
                    recordId = jQuery('#sender_id').val();
                }
                var lastMessageID = jQuery('.chatDiv div.bubble:last').data('chatlogid');
                var facebookPageId = jQuery('#facebookPageId').val();

                if(recordId != ''){
                    var params = {
                        'module' : 'CTChatLog',
                        'view' : "ChatBox",
                        'mode' : "getNewUnreadMessages",
                        'recordId' : recordId,
                        'lastMessageID' : lastMessageID,
                        'facebookPageId' : facebookPageId
                    }
                    AppConnector.request(params).then(
                        function(data) {
                            
                            if(data.result['rows'] != 0){
                                if(app.view() == 'ChatBox'){
                                    if(jQuery('.chatDiv').length != 0){
                                        jQuery('.chatDiv').append(data.result['facebookMessageHTML']);
                                        jQuery('.chatDiv').animate({scrollTop: jQuery('.chatDiv')[0].scrollHeight}, 0);
                                    }
                                }
                            }
                        }
                    );
                }
            }
        },3000);
    }

    setInterval(function(){
        var popupOpen = jQuery('#facebookPopupOpen').val();
        if(popupOpen == 'true'){
            var recordId = jQuery('#module_recordid').val();
            if(recordId == ''){
                var recordId = jQuery('#sender_id').val();
            }

            var facebookPageId = jQuery('#facebookPageId').val();
            
            if(recordId != undefined){
                var params = {
                    'module' : 'CTChatLog',
                    'view' : "ChatBox",
                    'mode' : "getNewUnreadMessages",
                    'recordId' : recordId,
                    'individulMessage' : 1,
                    'facebookPageId' : facebookPageId
                }
                AppConnector.request(params).then(
                    function(data) {
                        if(data.result['rows'] != 0){
                            var msg_history = jQuery('#ap');
                            msg_history.append(data.result['facebookMessageHTML']);
                            var propdata = jQuery('.conversation-container').prop("scrollHeight");
                            jQuery(".conversation-container").animate({ scrollTop: propdata + 100}, 0);
                        }
                    }
                );
            }
        }
    },3000);

    function blinker(){
        $('.new_messages').fadeOut(500);
        $('.new_messages').fadeIn(500);
    }

    setTimeout(function(){
        let socket;
        const wsUrl = 'wss://notify.crmtiger.com/ws/'+fbLicensekey;
        function connectWebSocket() {
            if (socket && socket.readyState !== WebSocket.CLOSED) {
                console.log('WebSocket is already connected or in the process of connecting.');
                return;
            }

            socket = new WebSocket(wsUrl);
            socket.onopen = function(event) {
                console.log('WebSocket connection opened');
                startPing();
            };

            socket.onmessage = function(event) {
                try {
                    var messageText = '';
                    const facebookData = JSON.parse(event.data);
                    
                    if(facebookData['object'] == 'page'){
                        if(facebookData.entry['0'].messaging['0'].message.text){
                            messageText = facebookData.entry['0'].messaging['0'].message.text;
                        }else if(facebookData.entry['0'].messaging['0'].message.attachments){
                            messageText = "Attachment";
                        }
                        
                        var messageTimestamp = facebookData.entry['0'].time;
                        var facebookPageId = facebookData.entry['0'].id;
                        var senderId = facebookData.entry['0'].messaging['0'].sender.id;                        

                        var params = {
                            'module' : 'CTChatLog',
                            'view' : "FacebookChatPopup",
                            'mode' : "checkNotificationCount",
                            'facebookPageId' : facebookPageId,
                            'senderId' : senderId
                        }

                        AppConnector.request(params).then(
                            function(data) {
                                var responseData = data.result;
                                if(responseData != ''){
                                    if(messageText != undefined){
                                        var senderName = responseData.senderName;
                                        facebookNotifyMe(messageText, messageTimestamp, senderName);
                                    }//end of if

                                    var notificationToneData = responseData.notificationTone;
                                    var trimmedResponse = notificationToneData.replace(/^\r\n/, '');
                                    
                                    if(trimmedResponse != '' && trimmedResponse != 'silent'){
                                        var audio = new Audio(trimmedResponse);
                                        var audioElement = $('#myAudio');
                                        var audioSrc = trimmedResponse;
                                       
                                        if (audioElement.length) {
                                            audioElement.attr('src', audioSrc);
                                        }else{
                                            audioElement = $('<audio>', {
                                                id: 'myAudio',
                                                src: audioSrc
                                            }).appendTo('body');
                                        }
                                        
                                        document.addEventListener('DOMContentLoaded', function() {
                                            var audio = document.getElementById('myAudio');
                                            audio.play().catch(function(error) {
                                                console.log('Audio play failed:', error);
                                            });
                                        });
                                    }
                                    //end code play audio

                                    var unreadCounts = jQuery('#messageunread').val();
                                    var totalUnreadCount = parseInt(unreadCounts) + 1;
                                    jQuery('.counterMsgs').removeClass('hide');
                                    jQuery('.counterMsgs').text(totalUnreadCount);
                                    jQuery('#messageunread').val(totalUnreadCount)
                                    jQuery('.counterMsgs').removeClass('hide');
                                    jQuery('.counterMsgs').text(totalUnreadCount);
                                    jQuery('.new_messages').addClass('counterMsg');
                                    if ($.isNumeric(totalUnreadCount)) {
                                       jQuery('.new_messages').text(totalUnreadCount);
                                    }//end of if                    
                                    setInterval(blinker,1000);  

                                    thisInstance.registerEventForGetUnreadMessage();

                                    if(app.view() == 'ChatBox'){
                                        var params = {
                                            'module' : 'CTChatLog',
                                            'view' : "ChatBox",
                                            'mode' : "getFacebookIcon",
                                            'sourceModule' : app.getModuleName()
                                        }
                                        AppConnector.request(params).then(
                                            function(data) {
                                                if(data.result != ""){
                                                    if(data.result['unread_count'] != 0){
                                                        var unreadcount = '<span class="counterMsgs" style="background: #e21c1c;color: #fff;font-size: 10px;border-radius: 50px;padding: 3px 7px;position: relative;top: -10px;left: -10px;">'+data.result['unread_count']+'</span>';
                                                    }else{
                                                        var unreadcount = '<span class="counterMsgs hide" style="background: #e21c1c;color: #fff;font-size: 10px;border-radius: 50px;padding: 3px 7px;position: relative;top: -10px;left: -10px;"></span>';
                                                    }
                                                    if(data.result['themeView'] == 'RTL'){
                                                        var rtlStyle = 'float: right !important;';
                                                    }else{
                                                        var rtlStyle = '';
                                                    }

                                                    if(data.result['isAdmin'] == 'on'){
                                                        var settingIcon = '<a class=""  href="index.php?module=CTFacebookMessengerIntegration&parent=Settings&view=CTGeneralConfiguration" style="display: inline-block;clear: none !important;'+rtlStyle+'padding: 0 4px;width: auto !important;padding: 0 4px;background: transparent !important;"><img src="layouts/v7/modules/CTChatLog/image/settings_green.png" class="" style="width: 20px;height: 20px;cursor: pointer;" title="Facebook Messenger Setting"/></a>';
                                                    }else{
                                                        var settingIcon = '';
                                                    }

                                                    if(data.result['chatAccessTokenNumRows'] == 0 || data.result['chatAccessTokenNumRows'] == null){
                                                        var facebookIcon = 'layouts/v7/modules/CTChatLog/image/facebookIconRed.png';
                                                    }else{
                                                        var facebookIcon = 'layouts/v7/modules/CTChatLog/image/facebookIcon.png';
                                                    }//end of else

                                                    if($('.showTimelineMessage1').length > 0){
                                                        $('.showTimelineMessage1').closest('li').remove();
                                                    }

                                                    var notificationLabel = app.vtranslate('Notifications');
                                                    var showAllNotificationLabel = app.vtranslate('Show All Notifications');
                                                    
                                                    if(data.result['themeView'] == 'RTL'){
                                                        var VTPremiumIcon = ['<li class="dropdown">',
                                                                                '<div style="" class="">','<input type="hidden" name="messageunread" value="'+data.result['unread_count']+'" id="messageunread">',
                                                                                    '<a href="#" class="dropdown-toggle showTimelineMessage1" data-toggle="dropdown" role="button" aria-expanded="false" style="padding: 0px 10px !important;">',
                                                                                    '<img  src="'+facebookIcon+'" style="height: 25px;border-radius: 0 !important;">',
                                                                                    ''+unreadcount+'</a>',
                                                                                    '<ul class="dropdown-menu" id="fbNotifyb" style="width: 300px;">',
                                                                                        '<li class="boxHead" style="background: #fff;color: #333;padding: 5px 10px;width: 100%;display: inline-block;float: left;border-bottom: 1px solid rgb(44 59 73 / 15%);"> <span style="display: inline-block;float: right;width: 30%;font-size: 14px; font-weight: 700;">'+notificationLabel+'</span>',
                                                                                            '<div class="notifyIcons" style="display: inline-block;float: left;text-align: right !important;">',
                                                                                            '<a class="hide" href="index.php?module=CTChatLog&view=ChatBox&mode=allChats" style="display: inline-block;clear: none !important;float: left !important;width: auto !important;padding: 0 4px;background: transparent !important;"><img src="layouts/v7/modules/CTChatLog/image/listing_green.png" class="" style="width: 20px;height: 20px;cursor: pointer;"/></a>',
                                                                                            '<span id="readFacebookMessage" tooltip="Mark all notification as read" class="" style="display: inline-block;clear: none !important;width: auto !important;padding: 0 4px;background: transparent !important;"><img src="layouts/v7/modules/CTChatLog/image/readmessage.png" class="" style="width: 20px;height: 20px;cursor: pointer;"/></span>',
                                                                                             '<a class="DashBoardTab" href="index.php?module=CTChatLog&view=DashBoard&mode=moduleDashBoard&analytics=1" style="display: inline-block;clear: none !important;width: auto !important;padding: 0 4px;background: transparent !important;" title="Analytics"><img src="layouts/v7/modules/CTChatLog/image/fb_analytics.png" class="" style="width: 20px;height: 20px;cursor: pointer;"/></a>',
                                                                                            ''+settingIcon+'</div>',

                                                                                            '</li>',
                                                                                        ''+data.result['notificationHTML']+'',
                                                                                        '<li style="width: 100%;display: inline-block;float: left;border-bottom: 1px solid rgb(44 59 73 / 15%);">',
                                                                                            '<a href="index.php?module=CTChatLog&view=ChatBox&mode=allChats" class="center" style="padding: 10px 10px !important;color: #333 !important;"><b style="font-size: 14px; !important;margin: 54px;">'+showAllNotificationLabel+'<img src="layouts/v7/modules/CTChatLog/image/listing_green.png" class="" style="width: 20px;height: 20px;cursor: pointer;margin: 0px 0px 0px -175px;"></b>',
                                                                                            '</a>',
                                                                                    '</ul>',

                                                                                '</div>',
                                                                            '</li>'].join('');
                                                    }else{
                                                        var VTPremiumIcon = ['<li class="dropdown">',
                                                                                '<div style="" class="">','<input type="hidden" name="messageunread" value="'+data.result['unread_count']+'" id="messageunread">',
                                                                                    '<a href="#" class="dropdown-toggle showTimelineMessage1" data-toggle="dropdown" role="button" aria-expanded="false" style="padding: 0px 10px !important;">',
                                                                                    '<img  src="'+facebookIcon+'" style="height: 25px;border-radius: 0 !important;">',
                                                                                    ''+unreadcount+'</a>',
                                                                                    '<ul class="dropdown-menu" id="fbNotifyb" style="width: 300px;">',
                                                                                        '<li class="boxHead" style="background: #fff;color: #333;padding: 5px 10px;width: 100%;display: inline-block;float: left;border-bottom: 1px solid rgb(44 59 73 / 15%);"> <span style="display: inline-block;float: left;width: 30%;font-size: 14px; font-weight: 700;">'+notificationLabel+'</span>',
                                                                                            '<div class="notifyIcons" style="display: inline-block;float: right;text-align: right !important;">',

                                                                                            '<a class="hide" href="index.php?module=CTChatLog&view=ChatBox&mode=allChats" style="display: inline-block;clear: none !important;float: left !important;width: auto !important;padding: 0 4px;background: transparent !important;"><img src="layouts/v7/modules/CTChatLog/image/listing_green.png" class="" style="width: 20px;height: 20px;cursor: pointer;"/></a>',

                                                                                            '<span id="readFacebookMessage" tooltip="Mark all notification as read" class="" style="display: inline-block;clear: none !important;width: auto !important;padding: 0 4px;background: transparent !important;float:left;"><img src="layouts/v7/modules/CTChatLog/image/readmessage.png" class="" style="width: 20px;height: 20px;cursor: pointer;"/></span>',

                                                                                            '<a class="DashBoardTab" href="index.php?module=CTChatLog&view=DashBoard&mode=moduleDashBoard&analytics=1" style="display: inline-block;clear: none !important;float: left !important;width: auto !important;width: auto !important;padding: 0 4px;background: transparent !important;" title="Analytics"><img src="layouts/v7/modules/CTChatLog/image/fb_analytics.png" class="" style="width: 20px;height: 20px;cursor: pointer;"/></a>',
                                                                                            
                                                                                            ''+settingIcon+'</div>',

                                                                                            '</li>',
                                                                                        ''+data.result['notificationHTML']+'',
                                                                                        '<li style="width: 100%;display: inline-block;float: left;border-bottom: 1px solid rgb(44 59 73 / 15%);">',
                                                                                            '<a href="index.php?module=CTChatLog&view=ChatBox&mode=allChats" class="center" style="padding: 10px 10px !important;color: #333 !important;"><b style="font-size: 14px; !important;margin: 54px;">'+showAllNotificationLabel+'</b><img src="layouts/v7/modules/CTChatLog/image/listing_green.png" class="" style="width: 20px;height: 20px;cursor: pointer;margin: 0px 0px 0px -50px;">',
                                                                                            '</a>',
                                                                                    '</ul>',

                                                                                '</div>',
                                                                            '</li>'].join('');
                                                    }

                                                    var headerIcons = $('#navbar ul.nav.navbar-nav');
                                                    if (headerIcons.length > 0){
                                                        headerIcons.first().prepend(VTPremiumIcon);
                                                    }
                                                }
                                            }
                                        );
                                        //for small listing
                                        var facebookModule = jQuery('#facebookModule').val();
                                        if(facebookModule){
                                            var thisNewInstance = new CTChatLog_CTChatLog_Js();
                                            thisNewInstance.registerEventForGetFacebookLogModuleData(facebookModule);
                                        }//end of if
                                    }
                                }//end of if

                            }//end of function
                        );
                    }
                } catch (e) {
                    // if parsing fails, treat as a regular message
                }
            };
        }

        function startPing() {
            pingInterval = setInterval(() => {
                if (socket.readyState === WebSocket.OPEN) {
                    const pingMessage = JSON.stringify({ type: 'ping' });
                    socket.send(pingMessage);
                }
            }, 30000); // send a ping every 30 seconds
        }

        connectWebSocket(); // automatically connect on page load
    }, 5000);
});


function facebookNotifyMe(messageText, messageTimestamp, senderName) {
    if (!window.Notification) {
        console.log('Browser does not support notifications.');
    } else {
        // check if permission is already granted
        if (Notification.permission === 'granted') {
            // show notification here
            var notify = new Notification(senderName, {
                body: messageText,
                icon: 'layouts/v7/modules/CTChatLog/image/facebookIcon.png',
            });
        } else {
            // request permission from user
            Notification.requestPermission().then(function (p) {
                if (p === 'granted') {
                    // show notification here
                    var notify = new Notification(senderName, {
                        body: messageText,
                        icon: 'layouts/v7/modules/CTChatLog/image/facebookIcon.png',
                    });
                } else {
                    console.log('User blocked notifications.');
                }
            }).catch(function (err) {
                console.error(err);
            });
        }//end of else
    }//end od else
}//end of function
