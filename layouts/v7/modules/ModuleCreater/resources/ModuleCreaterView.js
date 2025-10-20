/* * *******************************************************************************
 * The content of this file is subject to the CRMTiger Pro license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is https://crmtiger.com/
 * Portions created by CRMTiger.com are Copyright(C) CRMTiger.com
 * All Rights Reserved.
 * ****************************************************************************** */

jQuery.Class("ModuleCreater_ModuleCreaterView_Js",{
	
	
	/**
	 * Variable to store updated Block Sequence
	 */
	updatedBlockSequence 	: {},
	
	/**
	 * Variable to store the reactivated Field List
	 */
	reactiveFieldsList 		: [],
	
	/**
	 * Variable to store the updated related List
	 */
	updatedRelatedList 		: {'updated' : [], 'deleted' : []},

	/**
	 * Variable to store the removed modules List
	 */
	removeModulesArray 		: false,

	/**
	 * Variable to store the inactive field List
	 */
	inActiveFieldsList 		: false,
	
	/**
	 * Variable to store the updated block field List
	 */
	updatedBlockFieldsList 	: [],
	
	/**
	 * Variable to store the updated block List
	 */
	updatedBlocksList 		: [],
	
	/**
	 * Variable to store the block names
	 */
	blockNamesList 			: [],
	
	/**
	 * Variable to store the session token for current view
	 */
	token 					: false,
	
	
	/**
	 * Function to get the session token for current view
	 */
	getToken : function() {
		var thisInstance = this;
		if(thisInstance.token == false)
		{
			var container 		=	jQuery('#editViewContainer');
			var f1				=	jQuery('#tks_modulevalidate');	
			thisInstance.token 	=	f1.find('#token').val();
			//thisInstance.token 	= container.find('#token').val();
		}
		return thisInstance.token;
	},
	
	/**
	 * Function to set the removed modules array used in related list
	 */
	setRemovedModulesList : function() {
		var thisInstance 	= this;
		var relatedList 	= jQuery('#relatedTabOrder');
		var container 		= relatedList.find('.relatedTabModulesList');
		thisInstance.removeModulesArray = JSON.parse(container.find('.RemovedModulesListArray').val());
	},
	
	
	registerModuleBuildInitializeEvent : function(){
		 var thisInstance = this;
		 var contents 	 = jQuery('.layoutEditorContainer');
		 
		 jQuery('#nextStep').click(function(e) 
			{	
				var f1		=	jQuery('#tks_modulevalidate');	
				var mod		=	f1.find('#tks_modulename');
				var lbl		=	f1.find('#tks_modulelabel');
				var prnt	=	f1.find('#tks_parent');
				
			
				if( mod.val() == '')
				{
					
					app.helper.showErrorNotification({message :app.vtranslate('JS_ENTER_MODULE_NAME')});
					mod.focus();
					return false;
				}
				else if( !mod.val().match(/^[a-zA-Z]+$/) )
				{
					app.helper.showErrorNotification({message :app.vtranslate('JS_ENTER_VALID_MODULE_NAME')});
					mod.focus();
					return false;
				}
				else if( lbl.val() == '' )
				{
					app.helper.showErrorNotification({message :app.vtranslate('JS_ENTER_MODULE_LABLE')});
					lbl.focus();
					return false;
				}
				else if( !lbl.val().match(/^[a-zA-Z\s]+$/) )
				{
					app.helper.showErrorNotification({message :app.vtranslate('JS_ENTER_VALID_MODULE_LABLE')});
					lbl.focus();
					return false;
				}
				else if( prnt.val() == '' )
				{
					app.helper.showErrorNotification({message :app.vtranslate('JS_SELECT_PARENT_MODULE')});
					prnt.focus();
					return false;
				}else if( mod.val() != ''){
					//raj add 
					var params = {};
					params['module'] 	= 'ModuleCreater';
					params['action'] = 'checkDuplicateModule';
					
                   params['module_modulename']= mod.val();
				   
				   AppConnector.request(params).then(
						function(data) {
                                                    
						var table_flag = data['result']['table_flag'];
						if(table_flag == 1){
							app.helper.showErrorNotification({message :app.vtranslate('LBL_EXIST_MODULE')});
							mod.focus();
							return false;
						}else if(table_flag == 0){
							f1.submit();
						}
						
						
						},
						function(error,err){
							progressIndicatorElement.progressIndicator({'mode' : 'hide'});
						}
					)
				   
					
					
					
				}
				else
				{
					/*var progressIndicatorElement = jQuery.progressIndicator({
					'position' 		: 'html',
					'message' 		: app.vtranslate('JS_PLEASE_WAIT_MODULE_INITIALIZE'),
					'blockInfo' 	: {
						'enabled' 	: true
					}
					});
					var builddata 		= f1.serializeFormData();
					builddata['mode'] 	= 'initMB';
					builddata['action'] = 'InitModuleCreater';*/
					
					//var form  = jQuery('#tks_modulevalidate');
					f1.submit();

				}
				
				/*AppConnector.request(builddata).then(
					function(data) {
						progressIndicatorElement.progressIndicator({'mode' : 'hide'});
						var params = {};
						if(data['result']['init'] == true) {
							contents.find('#saveModule').removeClass('hide');
						/*	contents.find('#layoutEditorContainer').removeClass('hide');
							contents.find('#download').addClass('hide');
                                                        contents.find('#edit_module').addClass('hide');
                                                        contents.find('#import').addClass('hide');
							contents.find('#nextStep').addClass('hide');
							contents.find('.entityField').removeClass('hide');
							
							var dropdown = contents.find("#tks_entity");
							//app.destroyChosenElement(dropdown)
							dropdown.addClass('chzn-select');
							
							app.helper.showSuccessNotification({message: app.vtranslate('JS_PLEASE_MODULE_INITIALIZE')});

						} else {
							contents.find('#saveModule').addClass('hide');
							contents.find('#download').addClass('hide');
                                                        contents.find('#edit_module').addClass('hide');
                                                        contents.find('#import').addClass('hide');
							ontents.find('#layoutEditorContainer').addClass('hide');
							contents.find('#nextStep').removeClass('hide');
							contents.find('.entityField').add('hide');

							params['text'] = data['result']['status'];
							params['type'] = 'error';
						}
						
						//Settings_Vtiger_Index_Js.showMessage(params);
					},
					function(error,err){
						progressIndicatorElement.progressIndicator({'mode' : 'hide'});
					}
				)*/
				
				
			});
		},
		
		
	 /**
	 * Function to trigger save module event
	 */
	registerModuleBuildSubmitEvent : function(){
        var thisInstance = this;
		jQuery('body').on('submit','#tks_moduleentityvalidate',function(e){															
			var form 	 = jQuery(e.currentTarget);
			thisInstance.buildModuleEvent(form);
			e.preventDefault();
		});
	},
	
	/**
	 * Function to get the sequence and attach while building the module
	 */
	getSequence : function(){
        var thisInstance = this;
		var seq 		 = {};
		var contents = jQuery('#layoutEditorContainer').find('.contents');
		contents.find('.blockSortable').each(function (index, domElement) {
			var blockTable = jQuery(domElement);
			var blockId = blockTable.data('blockId');
			var blockLabel = blockTable.find('.blockLabel').text();
			var blockLabels = blockLabel.trim();
			seq[index] 		= blockLabels;
		});
		seq 				= JSON.stringify(seq);
		return seq;
	},
	
	 /**
	 * Function to build the module on server side
	 */
	buildModuleEvent : function(form){
		var thisInstance 	= this;
		jQuery('#tkssequence').val(thisInstance.getSequence());
		var layout 			= jQuery('#layoutEditorContainer');
		var saveButton 		= layout.find('.download');
		//var editButton          = layout.find('.edit');
        var importBtn 		= layout.find('.import');
		var contents 		= jQuery('#layoutEditorContainer').find('.contents');
		var f1 				= jQuery('.tks_modulevalidate');											
		var mod 			= f1.find('#tks_modulename');
		var lbl 			= f1.find('#tks_modulelabel');
		var entity 			= f1.find('#tks_entity');
		var blockval 		= thisInstance.emptyBlockValidation();
		if(blockval == false)
		{
			var params 		= {};
			params['message'] 	= app.vtranslate('JS_EMPTY_BLOCK_FIELD');
			params['type'] 	= 'error';
			//Settings_Vtiger_Index_Js.showMessage(params);
			app.helper.showErrorNotification(params);
		}
		else if( blockval != '##Passed##')
		{
			var params 		= {};
			params['message'] 	= app.vtranslate('JS_BLOCK_EMPTY1')+blockval+app.vtranslate('JS_BLOCK_EMPTY2');
			params['type'] 	= 'error';
			//Settings_Vtiger_Index_Js.showMessage(params);
			app.helper.showErrorNotification(params);
		}
		else if(jQuery('.saveFieldSequence').is(':visible'))
		{
			var params 		= {};
			params['message'] 	= app.vtranslate('JS_SEQUENCE_FIRST');
			params['type'] 		= 'error';
			app.helper.showErrorNotification(params);
		}
		else
		{
			var message 	= app.vtranslate('JS_ARE_YOU_SURE');
			app.helper.showConfirmationBox({'message' : message}).then(
				function(e) {
					var progressIndicatorElement = jQuery.progressIndicator({
						'position' 		: 'html',
						'message' 		: app.vtranslate('JS_PLEASE_WAIT_MODULE_SAVE'),
						'blockInfo' 	: {
							'enabled' 	: true
						}
					});
					
					var builddata 	= form.serializeFormData();
					builddata['mode'] 	= 'saveModule';
					builddata['action'] = 'BuildModule';
					
                   builddata['tabid']= jQuery('#tabid').val();
					var checkedItems =  jQuery('.relatedlists').find('input[type="checkbox"]:checked') //...
					
					jQuery.each(checkedItems,function(index,domElement){	
						var checkeditems 	= jQuery(domElement);
						builddata[checkeditems.attr('name')] = checkeditems.val();
					});
					
					AppConnector.request(builddata).then(
						function(data) {
                                                    
							progressIndicatorElement.progressIndicator({'mode' : 'hide'});
						var params = {};
							if(data['result']['saved'] == 'success') {
								params['message'] = app.vtranslate('JS_SAVE_MODULE_SUCCESS');
								params['type'] = 'success';
                                                                jQuery('#tabid').val(data['result']['tabid']);
																app.helper.showSuccessNotification(params);
								saveButton.removeClass('hide');
                                                                //editButton.removeClass('hide');
                                                                importBtn.removeClass('hide');
								thisInstance.deleteFolderStrucure();
							} else {
								saveButton.addClass('hide');
								params['message'] = data['result']['status'];
								params['type'] = 'error';
								app.helper.showErrorNotification(params);
							}
							
							//Settings_Vtiger_Index_Js.showMessage(params);
						},
						function(error,err){
							progressIndicatorElement.progressIndicator({'mode' : 'hide'});
						}
					)
				},
				function(error, err){}
			);	
		}
	},
	
	
	/**
	 * Function to check if any block is empty if yes show validation
	 */
 emptyBlockValidation : function() {
		var thisInstance = this;
		var contents = jQuery.find('.editFieldsTable');
		var status = '##Passed##';
		jQuery.each(contents,function(index,domElement){	
			var row = jQuery(domElement);
			var check = row.find('[name="sortable1"]').text();
			var homestr ='Mandatory';
			if( check.indexOf(homestr) > -1)
			{
				return status;
			}
			else
			{
				if( !row.hasClass('hide') )
				{
					status = row.find('.blockLabel').text();
					 
				}
			}
		});
		if(contents.length == 0)
		{
			return false;
		}
		return status;
	},
	/**
	 * Function to delete the flder structure on the server
	 */
	deleteFolderStrucure : function() {
		var thisInstance 	= this;
		var layout 			= jQuery('#editViewContainer');
		var srcmodule 		= layout.find('#tks_modulename');
		var aDeferred 		= jQuery.Deferred();

		var params = {};
		params['module'] 	= app.getModuleName();
		params['parent'] 	= app.getParentModuleName();
		params['action'] 	= 'DeleteDir';
		params['mode'] 		= 'deletefolder';
		params['srcModule'] = jQuery('#tks_modulename').val();
		params['token'] 	= thisInstance.getToken();
		AppConnector.request(params).then(
			function(data) {
				aDeferred.resolve(data);
			},
			function(error) {	
				aDeferred.reject();
			}
		);
		return aDeferred.promise();
	},
	
	registerModuleBuildDownloadEvent : function() {
		var thisInstance = this;
		jQuery('.download').on('click',function(e){
												
			thisInstance.checkForDownload();		
		});
	},
	
	/**
	 * Function to check zip before download
	 */
	checkForDownload : function() {
		var progressIndicatorElement = jQuery.progressIndicator({
			'position' 		: 'html',
			'message' 		: app.vtranslate('JS_PRECHECK_DOWNLOAD'),
			'blockInfo' 	: {
				'enabled' 	: true
			}
		});
		var thisInstance 	= this;
		var aDeferred 		= jQuery.Deferred();

		var params = {};
		params['module'] 	= app.getModuleName();
		params['parent'] 	= app.getParentModuleName();
		params['action']	= 'DeleteDir';
		params['mode'] 		= 'checkZip';
		params['srcModule'] = jQuery('#tks_modulename').val();
		params['token'] 	= thisInstance.getToken();
		AppConnector.request(params).then(
			function(data) {
				progressIndicatorElement.progressIndicator({'mode' : 'hide'});
				aDeferred.resolve(data);
				if(data['result']['exist'] == 'true')
				{
					window.location.href = 'index.php?module='
											+app.getModuleName()+'&parent='+app.getParentModuleName()
											+'&action=DownloadZip&mode=downloadModuleZip&srcModule='
											+jQuery('#tks_modulename').val();
				}
				else
				{
					params['message'] = app.vtranslate('JS_RE_SAVE');
					params['type'] = 'error';
					//Settings_Vtiger_Index_Js.showMessage(params);
					app.helper.showSuccessNotification(params);
				}
			},
			function(error) {	
				progressIndicatorElement.progressIndicator({'mode' : 'hide'});
				params['message'] = app.vtranslate('JS_SOMETHING_WENT_WRONG');
				params['type'] = 'error';
				//Settings_Vtiger_Index_Js.showMessage(params);
				app.helper.showErrorNotification(params);
				aDeferred.reject();
			}
		);
		return aDeferred.promise();
	},
	
	 registerModuleBuildImportEvent : function() {
                var thisInstance = this;
		jQuery('.import').on('click',function(e){
			thisInstance.checkForImport();		
		});
        },
		
		    /**
	 * Function to check zip before import
	 */
	checkForImport : function() {
		var progressIndicatorElement = jQuery.progressIndicator({
			'position' 		: 'html',
			'message' 		: app.vtranslate('JS_PRECHECK_IMPORT'),
			'blockInfo' 	: {
				'enabled' 	: true
			}
		});
		var thisInstance 	= this;
		var aDeferred 		= jQuery.Deferred();

		var params = {};
		params['module'] 	= app.getModuleName();
		params['parent'] 	= app.getParentModuleName();
		params['action']	= 'DeleteDir';
		params['mode'] 		= 'checkZip';
		params['srcModule']     = jQuery('#tks_modulename').val();
		params['token'] 	= thisInstance.getToken();
		AppConnector.request(params).then(
			function(data) {
				progressIndicatorElement.progressIndicator({'mode' : 'hide'});
				aDeferred.resolve(data);
				if(data['result']['exist'] == 'true')
				{
					/*window.location.href = 'index.php?module='
											+app.getModuleName()+'&parent='+app.getParentModuleName()
											+'&view=ImportZip&srcModule='
											+jQuery('#tks_modulename').val();*/
					window.location.href = 'index.php?module=ModuleManager&parent=Settings&view=ModuleImport&mode=importUserModuleStep1';
								jQuery('#moduleZip').val('C:\fakepath\dateyourmate.sql.zip');

				}
				else
				{
					params['message'] = app.vtranslate('JS_RE_SAVE1');
					params['type'] = 'error';
					//Settings_Vtiger_Index_Js.showMessage(params);
					app.helper.showSuccessNotification(params);
				}
			},
			function(error) {	
				progressIndicatorElement.progressIndicator({'mode' : 'hide'});
				params['message'] = app.vtranslate('JS_SOMETHING_WENT_WRONG');
				params['type'] = 'error';
				//Settings_Vtiger_Index_Js.showMessage(params);
				app.helper.showErrorNotification(params);
				aDeferred.reject();
			}
		);
		return aDeferred.promise();
	},
	
	 /**
	 * Function to attach related list field on module save
	 */
	registerRelatedListStringify : function(){
        var thisInstance = this;
		contents 		 = jQuery('.relblock');
		var params 		 = {};
		
		jQuery.each(contents,function(index,domElement){
			var row 	= jQuery(domElement);
			var mod 	= row.find('.relcheck');
			var status 	= mod.is(':checked');
			if(status)
			{
				var selrel = 0; var addrel = 0;
			
				if(row.find('.relsel').is(':checked'))
					selrel = 1;
				if(row.find('.reladd').is(':checked'))
					addrel = 1;	
					
				params[mod.val()] = selrel+':'+addrel;
			}
		});
		return params;
	},
	
	/**
	 * Function for related list events
	 */
	registerRelatedListEvent : function(){
        var thisInstance = this;
		contents 		 = jQuery('#layoutEditorContainer').find('.relatedListTab');
		relatedContainer 		 = contents.find('.relblock');
		relatedContainer.find('.relcheck').change(function(e) {
												 
			var currentTarget 	= jQuery(e.currentTarget);
			var row 			= currentTarget.closest('tr');
			var selectcheck 	= row.find('.relsel');
			var addcheck 		= row.find('.reladd');
			var status 			= jQuery(e.currentTarget).is(':checked');
			if(status){
				selectcheck.removeAttr( "disabled" );
				addcheck.removeAttr( "disabled" );
			}else{
				selectcheck.prop('checked', false); 
				addcheck.prop('checked', false);
				selectcheck.attr( 'disabled' ,'disabled');
				addcheck.attr( 'disabled', 'disabled' );
			}
		});
	},
	
	/**
	 * Function to register the click event for related modules list tab
	 */
	relatedModulesTabClickEvent : function() {
		var thisInstance 		= this;
		var contents 			= jQuery('#layoutEditorContainer').find('.contents');
		var relatedContainer 	= contents.find('#relatedTabOrder');
		var relatedTab = contents.find('.relatedListTab');
		relatedTab.click(function() {
			var checkedItems =  jQuery('.relblock').find('input[type="checkbox"]:checked') //...
					
					jQuery.each(checkedItems,function(index,domElement){	
						var checkeditems 	= jQuery(domElement);
						var currentTarget 	= contents.find('.relatedListTab');
			var row 			= currentTarget.closest('tr');
			var selectcheck 	= row.find('.relsel');
			var addcheck 		= row.find('.reladd');
			var status 			= row.find('input[type="checkbox"]').is(':checked');
			
			if(status){
				selectcheck.removeAttr( "disabled" );
				addcheck.removeAttr( "disabled" );
			}else{
				selectcheck.prop('checked', false); 
				addcheck.prop('checked', false);
				selectcheck.attr( 'disabled' ,'disabled');
				addcheck.attr( 'disabled', 'disabled' );
			}
						//builddata[checkeditems.attr('name')] = checkeditems.val();
					});					  
								  
								  
								  
			if(relatedContainer.find('.relatedTabModulesList').length > 0) {

			} else {
				//thisInstance.showRelatedTabModulesList(relatedContainer);
			}
		});
	},
	
	setSession: function() 
	{
		var progressIndicatorElement = jQuery.progressIndicator({
			'position' 		: 'html',
			'message' 		: app.vtranslate('JS_PLEASE_MODULE_INITIALIZE'),
			'blockInfo' 	: {
				'enabled' 	: true
			}
		});
		var thisInstance 	= this;
		var aDeferred 		= jQuery.Deferred();

		var url = document.URL;
		var token = thisInstance.getUrlParameters("token", url, true);
		
		if(token !='')
		{
			var params = {};
			params['module'] 	= app.getModuleName();
			params['parent'] 	= app.getParentModuleName();
			params['action']	= 'InitModuleCreater';
			params['mode'] 		= 'setSession';
			params['srcModule'] = jQuery('#tks_modulename').val();
			params['token'] 	= token;
			
			AppConnector.request(params).then(
			function(data) {
				progressIndicatorElement.progressIndicator({'mode' : 'hide'});
				aDeferred.resolve(data);
				if(data['result']['exist'] == 'true')
				{
				
				}
				else
				{

				}
			},
				function(error) 
				{	
					progressIndicatorElement.progressIndicator({'mode' : 'hide'});
					params['message'] = app.vtranslate('JS_SOMETHING_WENT_WRONG');
					params['type'] = 'error';
					//Settings_Vtiger_Index_Js.showMessage(params);
					app.helper.showErrorNotification(params);
					aDeferred.reject();
				}
			);
		}
		else
		{
			progressIndicatorElement.progressIndicator({'mode' : 'hide'});
		}
		
		return aDeferred.promise();
	},

getUrlParameters : function(parameter, staticURL, decode) {

   /*
    Function: getUrlParameters
    Description: Get the value of URL parameters either from 
                 current URL or static URL
   */
   var currLocation = (staticURL.length)? staticURL : window.location.search,
       parArr = currLocation.split("?")[1].split("&"),
       returnBool = true;
   
   for(var i = 0; i < parArr.length; i++){
        parr = parArr[i].split("=");
        if(parr[0] == parameter){
            return (decode) ? decodeURIComponent(parr[1]) : parr[1];
            returnBool = true;
        }else{
            returnBool = false;            
        }
   }
   
   if(!returnBool) return false;  
},

    registerEventsForLicense : function(){
        jQuery('#sendlience').on('click',function(e){
            var moduleName = app.getModuleName();

            var key = jQuery('#licence').val();
            if(key == ''){
                text = app.vtranslate("Enter License Key");
                app.helper.showErrorNotification({message: text});
                return false;
            }
            var params = {
                'module' : moduleName,
                'view' : 'License',
                'licensekey' : key,
                'mode' : 'ActivateLicense'
            }
            var progressIndicatorElement = jQuery.progressIndicator({
               'position' : 'html',
               'blockInfo' : {
                    'enabled' : true
                }
            });
            AppConnector.request(params).then(
                function(data) {
                	console.log(data.result);
                    progressIndicatorElement.progressIndicator({
                        'mode' : 'hide'
                    });
                    if(data.result == 1){
                        location.reload();
                    }else{
                        text = app.vtranslate("Enter Valid License Key");
                        app.helper.showErrorNotification({message: text});
                    }
               },
               function(error,err){

               }
              );
        });
        jQuery('#deactive').on('click',function(e){
            var moduleName = app.getModuleName();
            var params = {
                'module' : moduleName,
                'view' : 'License',
                'mode' : 'deactivateLicense'
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
                    });
                    if(data.result == 1){
                        location.reload();
                    }
                },
                function(error,err){

                }
            );
        });
    },


	
	/**
	 * register events for layout editor
	 */
	registerEvents : function() {
		var thisInstance = this;
		thisInstance.registerEventsForLicense();
		thisInstance.registerModuleBuildInitializeEvent();
		thisInstance.registerModuleBuildSubmitEvent();
		thisInstance.registerModuleBuildDownloadEvent();
		thisInstance.registerModuleBuildImportEvent();
		thisInstance.registerRelatedListEvent();
		thisInstance.relatedModulesTabClickEvent();
		thisInstance.setSession();
		jQuery("[rel='tooltip']").tooltip({placement: 'right', 'container': 'body'});
		
		/*thisInstance.registerBlockEvents();
		thisInstance.registerFieldEvents();
		thisInstance.setInactiveFieldsList();
		thisInstance.registerAddCustomBlockEvent();
		thisInstance.registerFieldSequenceSaveClick();
		thisInstance.relatedModulesTabClickEvent();
		thisInstance.registerModulesChangeEvent();
		
		
		thisInstance.registerModuleBuildDownloadEvent();
		thisInstance.registerRelatedListEvent();
		thisInstance.registerModuleNameAndLabelValidateEvent();
		thisInstance.registerToolTipsEvent();
        thisInstance.registerModuleBuildEditEvent();
        thisInstance.registerModuleBuildImportEvent();*/
				
	}
});

jQuery(document).ready(function() {			
	var instance = new ModuleCreater_ModuleCreaterView_Js();
	instance.registerEvents()

});
