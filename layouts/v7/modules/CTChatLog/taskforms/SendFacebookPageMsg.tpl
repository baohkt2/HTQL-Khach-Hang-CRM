{*<!--
/*********************************************************************************
* The content of this file is subject to the CRMTiger Pro license.
* ("License"); You may not use this file except in compliance with the License
* The Initial Developer of the Original Code is vTiger
* The Modified Code of the Original Code owned by https://crmtiger.com/
* Portions created by CRMTiger.com are Copyright(C) CRMTiger.com
* All Rights Reserved.
********************************************************************************/
-->*}
{strip}
    <div class="row" style="margin-bottom: 70px;">
        <div class="col-lg-9">
             <div class="row form-group col-lg-12">
                <div class="col-lg-2" style="margin: 0px 3px 0px -12px;">{vtranslate('LBL_FROM_PAGE','Settings:CTChatLog')}</div>
                <div class="col-lg-3">
                    <select class="select2 sendmessagefacebookpagelist" id="sendmessagefacebookpagelist" style="width: 116%;" data-placeholder="{vtranslate('LBL_SELECT_OPTIONS',$QUALIFIED_MODULE)}">
                         <option value=""></option>
                    </select>  
                </div>
            </div>
            <div class="row form-group col-lg-12">
                <div class="col-lg-2" style="padding-left: 0px;">{vtranslate('LBL_GENERAL_FIELDS',$QUALIFIED_MODULE)}</div>
                <div class="col-lg-10">
                    <select style="width: 205px;margin-left: -9px;" id="generalfields" class="select2" data-placeholder={vtranslate('LBL_SELECT_OPTIONS',$QUALIFIED_MODULE)}>
                        <option></option>
                        {foreach from=$META_VARIABLES item=META_VARIABLE_KEY key=META_VARIABLE_VALUE}
                            <option value="{if strpos(strtolower($META_VARIABLE_VALUE), 'url') === false}${/if}{$META_VARIABLE_KEY}">{vtranslate($META_VARIABLE_VALUE,$QUALIFIED_MODULE)}</option>
                        {/foreach}  
                    </select>
                </div>  
            </div>
            <div class="row form-group col-lg-12">
                <div class="col-lg-2" style="margin: 0px 3px 0px -12px;">{vtranslate('LBL_ADD_FIELDS',$QUALIFIED_MODULE)}</div>
                <div class="col-lg-10">
                    <select class="select2 task-fields" id="modulefields" style="min-width: 150px;" data-placeholder="{vtranslate('LBL_SELECT_FIELDS', $QUALIFIED_MODULE)}">
                        <option></option>
                        {$ALL_FIELD_OPTIONS}
                    </select>   
                </div>
            </div>

            <div class="msgwithouttext row form-group col-lg-12" style="margin-left: -14px;">    
                <div class="col-lg-2" style="margin: 0px 3px 0px -12px;">{vtranslate('LBL_MESSAGES', 'Settings:CTChatLog')}</div>
                <div class="col-lg-10">
                    <textarea name="content" class="inputElement fields" style="height: 150px;width: 870px;">{$TASK_OBJECT->content}</textarea>
                </div>
            </div>
        </div>
    </div>
{/strip}

{literal}
    <script>
        $(document).ready(function(){
            //get active facebook pages
            var params = {
                'module' : 'CTFacebookMessengerIntegration',
                'parent': app.getParentModuleName(),
                'view' : "CTFacebookChatConfiguration", 
                'mode' : "getActiveFacebookPages"
            }
            AppConnector.request(params).then(function(data) {
                $('#sendmessagefacebookpagelist').html(data.result);
            });

            jQuery('input[name="summary"]').parent('div').parent('div').hide();
            var summary = jQuery('input[name="summary"]').val();
            if(summary){
                setTimeout(function(){
                    $('#sendmessagefacebookpagelist').val(summary).trigger('change.select2');
                    //jQuery('.sendmessagefacebookpagelist a span.select2-chosen').text(summary);
                }, 1000);
            }
            
            $('.sendmessagefacebookpagelist').on('change', function(e){
                setTimeout(function(){
                    var facebookPageName = jQuery(e.currentTarget).val();
                    jQuery('[name="summary"]').val(facebookPageName);
                }, 1000);
            });

            $("#generalfields, #modulefields").on('change', function(){
                var fieldVal = $(this).val();
                var oldtext = jQuery('textarea[name="content"]').val();
                var newtext = oldtext+' '+fieldVal;
                jQuery('textarea[name="content"]').val(newtext);
            });
        });
    </script>
{/literal}