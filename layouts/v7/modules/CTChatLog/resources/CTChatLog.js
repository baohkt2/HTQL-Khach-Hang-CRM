/* * *******************************************************************************
* The content of this file is subject to the CRMTiger Pro license.
* ("License"); You may not use this file except in compliance with the License
* The Initial Developer of the Original Code is vTiger
* The Modified Code of the Original Code owned by https://crmtiger.com/
* Portions created by CRMTiger.com are Copyright(C) CRMTiger.com
* All Rights Reserved.
* ****************************************************************************** */
Vtiger.Class("CTChatLog_CTChatLog_Js",{
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

    registerGlobalSearch : function() {
        var thisInstance = this;
        jQuery('.search-link .keyword-input').on('keypress',function(e){
            if(e.which == 13) {
                var element = jQuery(e.currentTarget);
                var searchValue = element.val();
                var data = {};
                data['searchValue'] = searchValue;
                element.trigger(thisInstance._SearchIntiatedEventName,data);
            }
        });
    },

    registerPostQuickCreateEvent : function(){
        var thisInstance = this;

        app.event.on("post.QuickCreateForm.show",function(event,form){
            form.find('#goToFullForm').on('click', function(e) {
                window.onbeforeunload = true;
                var form = jQuery(e.currentTarget).closest('form');
                var editViewUrl = jQuery(e.currentTarget).data('editViewUrl');
                if (typeof goToFullFormCallBack != "undefined") {
                    goToFullFormCallBack(form);
                }
                thisInstance.quickCreateGoToFullForm(form, editViewUrl);
            });
        });
    },

    quickCreateGoToFullForm: function(form, editViewUrl) {
        var formData = form.serializeFormData();
        //As formData contains information about both view and action removed action and directed to view
        delete formData.module;
        delete formData.action;
        delete formData.picklistDependency;
        var formDataUrl = jQuery.param(formData);
        var completeUrl = editViewUrl + "&" + formDataUrl;
        window.location.href = completeUrl;
    },

    registerEventFacebookQuickCreateEvent : function (){
        var thisInstance = this;
        jQuery('body').on('click', '.quickCreateModule, .quickCreateTaskModule', function(e) {
            var quickCreateElem = jQuery(e.currentTarget);
            var senderId = jQuery('#sender_id').val();
            var moduleRecordId = jQuery('#module_recordid').val();
            var facebookModule = jQuery('#facebookModule').val();
            var quickCreateUrl = quickCreateElem.data('url');
            var quickCreateModuleName = quickCreateElem.data('name');
            var task = quickCreateElem.data('task');
            var chatLogId = quickCreateElem.data('chatlogid');
            if (typeof params === 'undefined') {
                params = {};
            }
            if (typeof params.callbackFunction === 'undefined') {
                params.callbackFunction = function(data, err) {
                    //fix for Refresh list view after Quick create
                    var parentModule=app.getModuleName();
                    var viewname=app.view();
                    if((quickCreateModuleName == parentModule) && (viewname=="List")){
                            var listinstance = app.controller();
                            listinstance.loadListViewRecords(); 
                    }
                };
            }
            app.helper.showProgress();
            
            thisInstance.getQuickCreateForm(quickCreateUrl,quickCreateModuleName,params).then(function(data){
                app.helper.hideProgress();
                var callbackparams = {
                    'cb' : function (container){
                        thisInstance.registerPostReferenceEvent(container);
                        app.event.trigger('post.QuickCreateForm.show',form);
                        app.helper.registerLeavePageWithoutSubmit(form);
                        app.helper.registerModalDismissWithoutSubmit(form);
                    },
                    backdrop : 'static',
                    keyboard : false
                    }

                app.helper.showModal(data, callbackparams);
                var form = jQuery('form[name="QuickCreate"]');
                var moduleName = form.find('[name="module"]').val();
                app.helper.showVerticalScroll(jQuery('form[name="QuickCreate"] .modal-body'), {'autoHideScrollbar': true});

                var targetInstance = thisInstance;
                var moduleInstance = Vtiger_Edit_Js.getInstanceByModuleName(moduleName);
                if(typeof(moduleInstance.quickCreateSave) === 'function'){
                    targetInstance = moduleInstance;
                    targetInstance.registerBasicEvents(form);
                }

                vtUtils.applyFieldElementsView(form);

                if(chatLogId){
                    thisInstance.quickCreateSave(form,params,moduleRecordId, senderId, task, chatLogId);
                    return false;
                }

                if(moduleRecordId == ''){
                    thisInstance.quickCreateSave(form,params,moduleRecordId, senderId, task, chatLogId);
                }else{
                    targetInstance.quickCreateSave(form,params);
                }
            });
        });
    },

    getQuickCreateForm: function(url, moduleName, params) {
        var aDeferred = jQuery.Deferred();
        var requestParams = app.convertUrlToDataParams(url);
        jQuery.extend(requestParams, params.data);
        app.request.post({data:requestParams}).then(function(err,data) {
            aDeferred.resolve(data);
        });
        return aDeferred.promise();
    },

    registerPostReferenceEvent : function(container) {
        var thisInstance = this;

        container.find('.sourceField').on(Vtiger_Edit_Js.postReferenceSelectionEvent,function(e,result){
            var dataList = result.data;
            var element = jQuery(e.currentTarget);

            if(typeof element.data('autofill') != 'undefined') {
                thisInstance.autoFillElement = element;
                if(typeof(dataList.id) == 'undefined'){
                    thisInstance.postRefrenceComplete(dataList, container);
                }else {
                    thisInstance.postRefrenceSearch(dataList, container);
                }
            }
        });
    },

    registerQuickcreateTabEvents : function(form) {
        var thisInstance = this;
        var tabElements = form.closest('.modal-content').find('.nav.nav-pills , .nav.nav-tabs').find('a');

        //This will remove the name attributes and assign it to data-element-name . We are doing this to avoid
        //Multiple element to send as in calendar
        var quickCreateTabOnHide = function(tabElement) {
            var container = jQuery(tabElement.attr('data-target'));

            container.find('[name]').each(function(index, element) {
                element = jQuery(element);
                element.attr('data-element-name', element.attr('name')).removeAttr('name');
            });
        };

        //This will add the name attributes and get value from data-element-name . We are doing this to avoid
        //Multiple element to send as in calendar
        var quickCreateTabOnShow = function(tabElement) {
            var container = jQuery(tabElement.attr('data-target'));

            container.find('[data-element-name]').each(function(index, element) {
                element = jQuery(element);
                element.attr('name', element.attr('data-element-name')).removeAttr('data-element-name');
            });
        };

        tabElements.on('shown.bs.tab', function(e) {
            var previousTab = jQuery(e.relatedTarget);
            var currentTab = jQuery(e.currentTarget);

            quickCreateTabOnHide(previousTab);
            quickCreateTabOnShow(currentTab);

            if(form.find('[name="module"]').val()=== 'Calendar') {
                var sourceModule = currentTab.data('source-module');
                form.find('[name="calendarModule"]').val(sourceModule);
                var moduleInstance = Vtiger_Edit_Js.getInstanceByModuleName('Calendar');
                moduleInstance.registerEventForPicklistDependencySetup(form);
            }
        });

        //remove name attributes for inactive tab elements
        quickCreateTabOnHide(tabElements.closest('li').filter(':not(.active)').find('a'));
    },

    quickCreateSave : function(form,invokeParams,moduleRecordId, senderId, task, chatLogId){
        var thisInstance = this;
        var params = {
            submitHandler: function(form) {
                // to Prevent submit if already submitted
                jQuery("button[name='saveButton']").attr("disabled","disabled");
                if(this.numberOfInvalids() > 0) {
                    return false;
                }
                var formData = jQuery(form).serialize();
                app.request.post({data:formData}).then(function(err,data){
                    app.helper.hideProgress();
                    if(err === null) {
                        jQuery('.vt-notification').remove();
                        app.event.trigger("post.QuickCreateForm.save",data,jQuery(form).serializeFormData());
                        app.helper.hideModal();
                        var message = typeof formData.record !== 'undefined' ? app.vtranslate('JS_RECORD_UPDATED'):app.vtranslate('JS_RECORD_CREATED');
                        app.helper.showSuccessNotification({"message":message},{delay:4000});
                        invokeParams.callbackFunction(data, err);
                        //To unregister onbefore unload event registered for quickcreate
                        window.onbeforeunload = null;
                    }else{
                        app.event.trigger('post.save.failed', err);
                        jQuery("button[name='saveButton']").removeAttr('disabled');
                    }
                    
                    if(moduleRecordId == ''){
                        if(data == undefined){
                            var message = 'Duplicate(s) detected!';
                            app.helper.showErrorNotification({"message":message});
                            jQuery("button[name='saveButton']").removeAttr('disabled');
                            return false;
                        }
                        if(data._recordId){
                            var params = {
                                'module' : 'CTChatLog',
                                'view' : "ChatBox",
                                'mode' : "updateMessageWithModuleRecordId",
                                'task' : task,
                                'senderId' : senderId,
                                'recordId' : data._recordId
                            }
                            app.helper.showProgress();
                            AppConnector.request(params).then(
                                function(data) {
                                    app.helper.hideProgress();
                                    var facebookModule = jQuery('#facebookModule').val();
                                    if(facebookModule){
                                        thisInstance.registerEventForGetFacebookLogModuleData(facebookModule);
                                    }
                                }
                            );
                        }
                    }
                    if(task == 'yes'){
                        if(data._recordId){
                            var params = {
                                'module' : 'CTChatLog',
                                'view' : "ChatBox",
                                'mode' : "updateMessageWithModuleRecordId",
                                'task' : task,
                                'senderId' : senderId,
                                'recordId' : data._recordId,
                                'chatLogId' : chatLogId
                            }
                            app.helper.showProgress();
                            AppConnector.request(params).then(
                                function(data) {
                                    app.helper.hideProgress();
                                    var facebookModule = jQuery('#facebookModule').val();
                                    if(facebookModule){
                                        thisInstance.registerEventForGetFacebookLogModuleData(facebookModule);
                                    }
                                }
                            );
                        }
                    }

                });
            },
            validationMeta: quickcreate_uimeta
        };
        form.vtValidate(params);
    },

    registerEventForSetWhatsappModule : function() {
        var thisInstance = this;
        jQuery('.facebookModules').live('click', function(e) {
            var start = jQuery('#perpagerecord').val();
            
            jQuery('#start').val(start);
            jQuery('.listViewPreviousPageButton').attr('disabled', true);
            var currentTarget = jQuery(e.currentTarget);
            var facebookModule = currentTarget.attr('data-selectModule');
            
            var currenOpenModule = jQuery('#facebookModule').val();
            jQuery('#'+currenOpenModule+'Msg').addClass("hide");
            
            jQuery('#replyMessageId').val('');
            jQuery('#replymessageText').val('');
            jQuery('.reply-input').addClass('hide');
            jQuery('.closeReplybutton').addClass('hide');

            jQuery('#facebookContactSerach').val('');
            jQuery('#facebookModule').val(facebookModule);
            
            if(facebookModule){
                thisInstance.registerEventForGetFacebookLogModuleData(facebookModule);
            }
        });
    },

    registerEventForGetFacebookLogModuleData : function(facebookLogModule) {
        var start = jQuery('#start').val();
        var end = jQuery('#perpagerecord').val();
        var searchValue = jQuery('#facebookContactSearch').val();

        var params = {
            'module' : 'CTChatLog',
            'view' : "ChatBox",
            'mode' : "getModulesData",
            'facebookLogModule' : facebookLogModule,
            'start' : start,
            'end' : end,
            'searchValue' : searchValue,
        }
        AppConnector.request(params).then(
            function(data) {
            app.helper.hideProgress();
            if(facebookLogModule == "NewMessages"){
                jQuery('.new_messages').text('');
                jQuery('.new_messages').removeClass('counterMsg');
                jQuery('#messageunread').val(0);
                jQuery('.counterMsgs').addClass('hide');
            }

            if(facebookLogModule == 'Important'){
                jQuery('#messageunread').val(0);                
                jQuery('.counterMsg.importantCount').addClass('hide');
            }//end of if
            
            if(data.result['allMessageshtml'] == ''){
                jQuery('.smallListing').html();
                var noRecords = '<div class="conversationDiv">' +
                                '    <div class="noRecords" style="margin-left: 108px;margin-top: 12px;">' +
                                '        <img src="layouts/v7/modules/CTChatLog/image/noRecords.png" style="width: 36px;margin-left: 20px;"/><br>' +
                                '        <span>'+app.vtranslate('JS_NORECORDFOUND')+'</span>' +
                                '    </div>' +
                                '</div>';
                jQuery('.smallListing').html(noRecords);

                jQuery('.norRecordData, .messageBlock').removeClass('hide');
                jQuery('.yesRecordData, .proDetailsDiv').addClass('hide');
            }else{
                jQuery('.proDetailsDiv, .conversationDiv').removeClass('hide');
                
                jQuery('.smallListing').html();
                jQuery('.smallListing').html(data.result['allMessageshtml']);
                jQuery('#'+facebookLogModule+'TotalRecord').val(data.result['rows']);
                var perPageRecord = jQuery('#perpagerecord').val();
                jQuery('.bydefaulOpenChat').trigger('click');
            }
            var start = jQuery('#start').val();
            var totalRecord = jQuery('#'+facebookLogModule+'TotalRecord').val();

            if(totalRecord == 0 || totalRecord == undefined){
                jQuery('.listViewNextPageButton').attr('disabled', true);
            }else{
                if(parseInt(totalRecord) < parseInt(start)){
                    jQuery('.listViewNextPageButton').attr('disabled', true);
                }else{
                    jQuery('.listViewNextPageButton').attr('disabled', false);
                }//end of else
            }//end of else
            $('body').find('#clickcount').val('0');
        });
    },

    registerEventForUpdateAssignToNumber: function(){
        var self = this;
        jQuery('.quickUpdateModule').live('click', function(e) {
            var currentTarget = jQuery(e.currentTarget);
            var sourceModuleName = currentTarget.attr('data-name');
            var senderId = jQuery('#sender_id').val();
            var params = {
                'module' : 'CTChatLog',
                'view' : "QuickCreateRecord",
                'mode' : "assignRecordPopup",
                'senderId' : senderId,
                'sourceModuleName' : sourceModuleName
            }
            app.helper.showProgress();
            AppConnector.request(params).then(
                function(data) {
                app.helper.hideProgress();
                app.showModalWindow(data, function(data){
                });
            });
        });
    },

    registerEventForShowChatMessages : function(){
        var thisInstance = this;
        let dd = '';
        if (typeof DropDown !== 'undefined') {
           dd = new DropDown( $('#dd') );
        }else{
            dd = '';
        }
        
        jQuery('.showChatMessages').live('click', function (e) {
            var currentTarget = jQuery(e.currentTarget);
            jQuery('.showChatMessages').css("background","#ffffff");
            currentTarget.css("background","#f6f6f6");
            var recordId = currentTarget.attr('data-recordid');
            var facebookPageId = currentTarget.attr('data-fbpageid');

            jQuery('#writemsg, #filename, [name="selectfile_data"]').val('');
            
            var facebookModule = jQuery('#facebookModule').val();
          
            var params = {
                'module' : 'CTChatLog',
                'view' : "ChatBox",
                'mode' : "getRecordMessageDetails",
                'recordId' : recordId,
                'facebookModule' : facebookModule,
                'facebookPageId' : facebookPageId
            }
            AppConnector.request(params).then(
                function(data) {
                    app.helper.hideProgress();
                    jQuery('.yesRecordData, .messageBlock').removeClass('hide');

                    var recordId = data.result['recordId'];
                    var label = data.result['label'];
                    var senderId = data.result['senderId'];
                    var facebookPageId = data.result['facebookPageId'];
                    var senderName = data.result['senderName'];
                    var profileImage = data.result['profileImage'];
                    var imagetag = data.result['imagetag'];
                    var facebookMessages = data.result['facebookMessages'];
                    var keyFieldsHTML = data.result['keyFieldsHTML'];
                    var totalSent = data.result['totalSent'];
                    var totalReceived = data.result['totalReceived'];
                    var recentComments = data.result['recentComments'];
                    var relatedModuleHTML = data.result['relatedModuleHTML'];
                    var messageImportant = data.result['messageImportant'];
                    var setype = data.result['setype'];
                    var commentModule = data.result['commentModule'];
                    var moduleIsEnable = data.result['moduleIsEnable'];
                    var modCommentsEnable = data.result['ModCommentsEnable'];
                    var permissionRecord = data.result['permissionRecord'];

                    var image = '<span><b>'+profileImage+'</b></span>';

                    //commented code to solve issue : 12646
                    if(label != ''){
                        $('#sender_name').val(label);
                    }else{
                        $('#sender_name').val(senderName);
                    }
                    
                    if(recordId){
                        jQuery('.importantMessages').removeClass('hide');
                        if(messageImportant == '1'){
                            jQuery('#messagesImportant').val(1);
                            jQuery('.importantMessages').find('img').attr('src', 'layouts/v7/modules/CTChatLog/image/favorites-added.png');
                        }else{
                            jQuery('#messagesImportant').val(0);
                            jQuery('.importantMessages').find('img').attr('src', 'layouts/v7/modules/CTChatLog/image/favorites.png');
                        }

                        var moduleURL = 'index.php?module='+setype+'&view=Detail&record='+recordId;
                        var moduleURLTag = '<a href="'+moduleURL+'" target="_blank" draggable="false"><i class="fa fa-eye"></i></a>';
                        jQuery('.closeBtn').html(moduleURLTag);
                        if(permissionRecord == 1){
                            jQuery('.editModuleRecord').removeClass('hide');
                        }else{
                            jQuery('.editModuleRecord').addClass('hide');
                        }
                        jQuery('#sender_id').val(recordId);
                        jQuery('.recordAssign').addClass('hide');
                    }else{
                        jQuery('.importantMessages').removeClass('hide');
                        if(messageImportant == '1'){
                            jQuery('#messagesImportant').val(1);
                            jQuery('.importantMessages').find('img').attr('src', 'layouts/v7/modules/CTChatLog/image/favorites-added.png');
                        }else{
                            jQuery('#messagesImportant').val(0);
                            jQuery('.importantMessages').find('img').attr('src', 'layouts/v7/modules/CTChatLog/image/favorites.png');
                        }
                        
                        jQuery('.closeBtn').html('');
                        jQuery('.editModuleRecord').addClass('hide');
                        jQuery('.recordAssign').addClass('hide');
                        jQuery('#sender_id').val(senderId);
                    }
                    jQuery('#module_recordid').val(recordId);
                    
                    if(recordId){
                        jQuery('.commentSection').removeClass('hide');
                    }else{
                        jQuery('.commentSection').addClass('hide');
                    }
                    jQuery('.recordData1').html(image);

                    $('#dd').removeClass('hide');
                    dd.setValueByFacebookPageId(facebookPageId);
                    jQuery('.adminSendMessage').addClass('hide');
                    jQuery('.personalInfo, .sender_id, .sendDiv').removeClass('hide');
                    jQuery('#sender_id').val(senderId);
                    jQuery('#facebookPageId').val(facebookPageId);

                    if(label != ''){
                        jQuery('.recordData2').html(label);
                    }else{
                        jQuery('.recordData2').html(data.result['senderName']);
                    }

                    if(moduleIsEnable == 1){
                        jQuery('.moduleDetailBlock').addClass('hide');
                    }else{
                        jQuery('.moduleDetailBlock').removeClass('hide');
                    }
                    jQuery('.manualtransfer, .loadHistoryButton').removeClass('hide');
                    
                    if(facebookMessages == '<div class="chatDiv"></div>'){
                        jQuery('.firstMessageText').removeClass('hide');
                        jQuery('.text-wrapper, .hidden-bar-wrapper, .emoji.emoji-button').addClass('hide');
                    }else{
                        jQuery('.firstMessageText').addClass('hide');
                        jQuery('.text-wrapper, .hidden-bar-wrapper, .emoji.emoji-button').removeClass('hide');
                    }

                    jQuery('.recordData3').html(facebookMessages);
                    $(".recordData3 .reply, .recordData3 .send").each(function() {
                        var content = $(this).html();
                        var formattedContent = content.replace(/\n/g, "<br>");
                        $(this).html(formattedContent);
                    });

                    jQuery('.personalInfo').html(keyFieldsHTML);
                    jQuery('.recordData8').html(totalSent);
                    jQuery('.recordData9').html(totalReceived);

                    if(modCommentsEnable == 0){
                        jQuery('.commentSection').addClass('hide');
                    }else{
                        if(commentModule == 1){ 
                            jQuery('.recordData10').html(recentComments);
                        }else{
                            jQuery('.commentSection').addClass('hide');
                        }
                    }
                    if(relatedModuleHTML){
                        jQuery('.relatedModules').html(relatedModuleHTML);
                    }else{
                        jQuery('.relatedModules').html('<b style="font-size: 13px;">'+app.vtranslate('JS_NORELATEDMODULE')+'<a href="index.php?module=CTFacebookMessengerIntegration&parent=Settings&view=CTGeneralConfiguration" style="color: blue;">'+app.vtranslate('JS_CLICKHERE')+'</a>'+app.vtranslate('JS_NORELATEDMODULE1')+'</b>');
                    }//end of else
                    if(data.result['toolTipMessage'] != ''){
                        $('.plusIcon').attr('title', data.result['toolTipMessage']);
                    }
                    if(jQuery('.chatDiv')[0]){
                        jQuery('.chatDiv').animate({scrollTop: jQuery('.chatDiv')[0].scrollHeight}, 0);
                    }

                    if(senderId == null){
                        $('.icons-wrapper').hide();
                    }
               }
            );
        });
    },

    //Function for Important Message
    registerEventForImportantMessage : function(){
        jQuery('.importantMessages').live('click', function (e) {
            var element = jQuery(e.currentTarget);
            var recordId = jQuery('#module_recordid').val();
            if(recordId == ''){
                recordId = jQuery('#sender_id').val();
            }
            var facebookPageId = jQuery('#facebookPageId').val();
            var countOfImpMessages = jQuery('.counterMsg').text();
            var messagesImportant = jQuery(this).children().val();

            var params = {
                'module' : 'CTChatLog',
                'view' : "ChatBox",
                'mode' : "importantMessage",
                'recordId' : recordId,
                'messagesImportant' : messagesImportant,
                'facebookPageId' : facebookPageId
            }
            app.helper.showProgress();
            AppConnector.request(params).then(
                function(data) {
                    app.helper.hideProgress();
                    element.find('img').attr('src', '');
                    if(messagesImportant == 1){
                        jQuery('#messagesImportant').val(0);
                        element.find('img').attr('src', 'layouts/v7/modules/CTChatLog/image/favorites.png');
                        app.helper.showSuccessNotification({title: 'Success', message: app.vtranslate('JS_UNIMPORTANT')});
                        countOfImpMessages--;
                    }else{
                        jQuery('#messagesImportant').val(1);
                        element.find('img').attr('src', 'layouts/v7/modules/CTChatLog/image/favorites-added.png');
                        app.helper.showSuccessNotification({title: 'Success', message: app.vtranslate('JS_IMPORTANT')});
                        countOfImpMessages++;
                    }

                    if(countOfImpMessages != 0){
                        if(jQuery('li.importantModule a > span.counterMsg').length == 0 ){
                            jQuery('li.importantModule a').append('<span class="counterMsg importantCount">'+countOfImpMessages+'<span>');
                            jQuery('.counterMsg.importantCount').removeClass('hide');
                        }else{
                            jQuery('.counterMsg.importantCount').removeClass('hide');
                            jQuery('.counterMsg.importantCount').text(countOfImpMessages);
                        }
                    }else{
                        jQuery('.counterMsg.importantCount').text(countOfImpMessages);
                        jQuery('.counterMsg.importantCount').addClass('hide');
                    }//end of else
                }
            );
        });
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

    registerAutoCompleteFields : function() {
        jQuery('#moduleRecordSearch').live('keyup', function (e) {
            var sourceModule = jQuery('#sourceModule').val();
            var moduleRecordSearch = jQuery('#moduleRecordSearch').val();
            if(moduleRecordSearch.length >= 3){
                $('#suggestionsList').removeClass('hide');
                var params = {
                    'module' : 'CTChatLog',
                    'view' : "QuickCreateRecord",
                    'mode' : "searchModuleRecord",
                    'sourceModule' : sourceModule,
                    'moduleRecordSearch' : moduleRecordSearch
                }
                app.helper.showProgress();
                AppConnector.request(params).then(
                    function(data) {
                    app.helper.hideProgress();
                    $('#suggestionsList').html(data.result);                
                });
            }else{
                $('#suggestionsList').addClass('hide');
            }
        });

        jQuery('.selectModuleRecord').live('click', function(e){
            var currentTarget = jQuery(e.currentTarget);
            var moduleId = currentTarget.attr('data-moduleid');
            var moduleLabel = currentTarget.attr('data-moduleLabel');
            $('#moduleRecordId').val(moduleId);
            $('#moduleRecordSearch').val(moduleLabel);
            $('#moduleRecordLabel').val(moduleLabel);
            $('#suggestionsList').addClass('hide');
        });

        var thisInstance = this;
        jQuery('#saveAssignRecord').live("click", function(e) {
            var moduleRecordLabel = jQuery('#moduleRecordLabel').val();
            var sourceModule = jQuery('#sourceModule').val();
            var moduleRecordSearch = jQuery('#moduleRecordSearch').val();
            var moduleRecordId = jQuery('#moduleRecordId').val();
            var senderId = jQuery('#senderId').val();
            
            var facebookPageId = jQuery('#facebookPageId').val();

            var params = {
                'module' : 'CTChatLog',
                'view' : "QuickCreateRecord",
                'mode' : "saveAssignRecord",
                'sourceModule' : sourceModule,
                'moduleRecordId' : moduleRecordId,
                'senderId' : senderId,
                'moduleRecordSearch' : moduleRecordSearch,
                'facebookPageId' : facebookPageId
            }
            app.helper.showProgress();
            AppConnector.request(params).then(
                function(data) {
                app.helper.hideProgress();
                app.helper.hideModal();
                app.helper.showSuccessNotification({'title': 'Success', 'message': 'All Facebook record assign to select record.'});
                setTimeout(function() {
                    jQuery('.nav-link').removeClass('active');
                    jQuery('.allMessagesModule .nav-link').addClass('active');
                    jQuery('#facebookModule').val('AllMessages');
                    thisInstance.registerEventForGetFacebookLogModuleData('AllMessages');
                    jQuery('.searchBox').val(moduleRecordLabel);
                    jQuery('[name="search"]').trigger('keyup');
                }, 2000);
            });
        });
    },

    registerRelatedRecordEditData: function(){
        var self = this;
        jQuery('.editModuleRecord').on('click', function(e) {
            var moduleRecordId = jQuery('#module_recordid').val();
            var params = {
                'module' : 'CTChatLog',
                'view' : "QuickCreateRecord",
                'mode' : "editRecord",
                'moduleRecordId' : moduleRecordId
            }
            app.helper.showProgress();
            AppConnector.request(params).then(
                function(data) {
                app.helper.hideProgress();
                app.showModalWindow(data, function(data){
                    jQuery('#saveModuleRecord').on("click", function(e) {
                        var serialize = jQuery('#newrecord').serializeFormData();
                        
                        var params = {
                            'module' : 'CTChatLog',
                            'view' : "QuickCreateRecord",
                            'mode' : "saveRecord",
                            'moduleRecordId' : moduleRecordId,
                            'serializedata' : serialize
                        }
                        app.helper.showProgress();
                        AppConnector.request(params).then(
                            function(data) {
                            app.helper.hideProgress();
                            app.helper.hideModal();
                            app.helper.showSuccessNotification({'title': 'Success', 'message': 'Record is save successfully.'});
                            var facebookModule =  jQuery('#facebookModule').val();
                            if(facebookModule){
                                self.registerEventForGetFacebookLogModuleData(facebookModule);
                            }
                        });
                    });
                });
            });
        });
    },

    //Function for Add new Comment
    registerEventForAddNewComment : function(){
        var thisInstance = this;
        jQuery('#saveComment').live("click", function() {
            var commentDescription = jQuery('#commentText').val();
            var commentText = commentDescription.trim();
            if(commentText == ''){
                app.helper.showErrorNotification({title: 'Error', message: app.vtranslate('LBL_COMMENTENTER')});
                return false;
            }
            var recordId = jQuery('#module_recordid').val();
            if(commentText != ''){
                var params = {
                    'module' : 'CTChatLog',
                    'view' : "ChatBox",
                    'mode' : "saveComments",
                    'commentText' : commentText,
                    'recordId' : recordId
                }
                app.helper.showProgress();
                AppConnector.request(params).then(
                    function(data) {
                        app.helper.hideProgress();
                        jQuery('#commentText').val('');
                        jQuery('.recordData10').html(data.result);
                    }
                );
            }
        });
    },

    registerEventForQuickAccessDropdown: function(){
        $('#quickAccessDiv').on('click', function(){
            $(this).closest('div').parent('div').removeClass('open');
        });
    },

    //Function for Search Record
    registerEventForSearchRecord : function(){
        var thisInstance = this;
        jQuery('body').on('keyup', '[name="search"]', function(e) {
            var value = jQuery(this).val();
            jQuery('#facebookContactSearch').val(value);
            var sourceModule = jQuery('#facebookModule').val();
            if(value.length == 0){
                thisInstance.registerEventForGetFacebookLogModuleData(sourceModule);
            }
            if(value.length >= 3){
                var start = jQuery('#start').val();
                var params = {
                    'module' : 'CTChatLog',
                    'view' : "ChatBox",
                    'mode' : "getSearchRecord",
                    'facebookLogModule' : sourceModule,
                    'searchValue' : value,
                    'start' : start
                }
                AppConnector.request(params).then(
                    function(data) {
                        jQuery('.smallListing').html();
                        if(data.result['allMessageshtml'] == ''){
                            var noRecords = '<div class="conversationDiv">' +
                                            '    <div class="noRecords" style="margin-left: 108px;margin-top: 12px;">' +
                                            '        <img src="layouts/v7/modules/CTChatLog/image/noRecords.png" style="width: 36px;margin-left: 20px;"/><br>' +
                                            '        <span>'+app.vtranslate('JS_NORECORDFOUND')+'</span>' +
                                            '    </div>' +
                                            '</div>';
                            jQuery('.smallListing').html(noRecords);
                        }else{
                            jQuery('.smallListing').html(data.result['allMessageshtml']);
                        }
                    }
                );
            }
        });
    },

    registerEventForNext : function(){
        var thisInstance = this;
        jQuery('.listViewNextPageButton').live('click', function (e) {
            var start = jQuery('#start').val();
            var perpagerecord = jQuery('#perpagerecord').val();
            var nextRecordCount = parseFloat(start) + parseFloat(perpagerecord);
            var start = jQuery('#start').val(nextRecordCount);
            var facebookModule = jQuery('#facebookModule').val();
            var totalRecord = jQuery('#'+facebookModule+'TotalRecord').val();

            thisInstance.registerEventForGetFacebookLogModuleData(facebookModule);
        });
    },

    registerEventForOtherModule : function() {
        var thisInstance = this;
        jQuery('.dropdawnModule').on('click', function(e) {
            var currentTarget = jQuery(e.currentTarget);
            var facebookModule = currentTarget.attr('data-modulename');
            var translateModulename = currentTarget.attr('data-translatemodulename');
            var count = currentTarget.attr('data-count');

            jQuery('.othermodule').removeClass('hide');
            jQuery('.othermodule').attr('data-selectModule',facebookModule);
            jQuery('.othermodule').attr('id',facebookModule+'TotalRecord');
            jQuery('.othermodule').attr('value',count);
            jQuery('.othermodule .nav-link').text(translateModulename);
            jQuery('.othermodule .nav-link').append(' <span class="counterMsg hide othermoduleCount">'+count+'</span>');
            
            var currenOpenModule = jQuery('#facebookModule').val();
            jQuery('#'+currenOpenModule+'Msg').addClass("hide");

            jQuery('.nav-link').removeClass('active');
            jQuery('.othermoduleopen').addClass('active');

            jQuery('#facebookModule').val(facebookModule);
            if(facebookModule){
                var start = jQuery('#perpagerecord').val();
                jQuery('#start').val(start);
                thisInstance.registerEventForGetFacebookLogModuleData(facebookModule);
            }
        });
    },

    registerEvents : function() {
        var thisInstance = this;
        var viewName = app.view();
        if(viewName != 'List'){
            this.registerAppTriggerEvent();
        }
        this.registerEventFacebookQuickCreateEvent();
        this.registerGlobalSearch();        
        this.registerPostQuickCreateEvent();
        this.registerEventForSetWhatsappModule();
        this.registerEventForGetFacebookLogModuleData();
        this.registerEventForShowChatMessages();
        this.registerEventForCopyText();
        this.registerEventForUpdateAssignToNumber();
        this.registerAutoCompleteFields();
        this.registerRelatedRecordEditData();
        this.registerEventForAddNewComment();
        this.registerEventForQuickAccessDropdown();
        this.registerEventForImportantMessage();
        this.registerEventForSearchRecord();
        this.registerEventForOtherModule();
        this.registerEventForNext();
    }
});

jQuery(document).ready(function(){
    var thisInstance = new CTChatLog_CTChatLog_Js();
    thisInstance.registerEvents();
    setTimeout(function() {
        jQuery('.allMessagesModule').on('click', function(e) {
            var currentTarget = jQuery(e.currentTarget);
            var facebookModule = currentTarget.attr('data-selectModule');
            var currenOpenModule = jQuery('#facebookModule').val();
            jQuery('#'+currenOpenModule+'Msg').addClass("hide");

            jQuery('#facebookModule').val(facebookModule);
            if(facebookModule){
                thisInstance.registerEventForGetFacebookLogModuleData(facebookModule);
            }
        });
        jQuery('.allMessagesModule').trigger('click');
    }, 2000);

    jQuery('#logoutFacebookQuickAccess').on('click', function(e) {
        var params = {
            'module' : 'CTFacebookMessengerIntegration',
            'parent': 'Settings',
            'view' : "CTFacebookChatConfiguration",
            'mode' : "logoutFacebook",
        }

        AppConnector.request(params).then(function(data) {
            if(data){
                window.location.href = data.result.redirectURL;
            }
        });
    });
    
    if(app.view() != 'DashBoard'){
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

                    var settingsPageTitle = app.vtranslate('LBL_SETTING_TITLE');
                    if(data.result['isAdmin'] == 'on'){
                        var settingIcon = '<a class=""  href="index.php?module=CTFacebookMessengerIntegration&parent=Settings&view=CTGeneralConfiguration" style="display: inline-block;clear: none !important;'+rtlStyle+'padding: 0 4px;width: auto !important;padding: 0 4px;background: transparent !important;"><img src="layouts/v7/modules/CTChatLog/image/settings_green.png" class="" style="width: 20px;height: 20px;cursor: pointer;" title="'+settingsPageTitle+'"/></a>';
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
                    var analyticsTitle = app.vtranslate('LBL_ANALYTICS_TITLE');
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
                                                             '<a class="DashBoardTab" href="index.php?module=CTChatLog&view=DashBoard&mode=moduleDashBoard&analytics=1" style="display: inline-block;clear: none !important;width: auto !important;padding: 0 4px;background: transparent !important;" title="'+analyticsTitle+'"><img src="layouts/v7/modules/CTChatLog/image/fb_analytics.png" class="" style="width: 20px;height: 20px;cursor: pointer;"/></a>',
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

                                                            '<a class="DashBoardTab" href="index.php?module=CTChatLog&view=DashBoard&mode=moduleDashBoard&analytics=1" style="display: inline-block;clear: none !important;float: left !important;width: auto !important;width: auto !important;padding: 0 4px;background: transparent !important;" title="'+analyticsTitle+'"><img src="layouts/v7/modules/CTChatLog/image/fb_analytics.png" class="" style="width: 20px;height: 20px;cursor: pointer;"/></a>',
                                                            
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
    }
});