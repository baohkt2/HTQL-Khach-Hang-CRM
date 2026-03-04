{*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************}
{* modules/Vtiger/views/Popup.php *}

{strip}
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        {include file="ModalHeader.tpl"|vtemplate_path:$MODULE TITLE={vtranslate($MODULE,$MODULE)}}
        <div class="modal-body">
            <div id="popupPageContainer" class="contentsDiv col-sm-12">
                <input type="hidden" id="parentModule" value="{$SOURCE_MODULE}"/>
                <input type="hidden" id="module" value="{$MODULE}"/>
                <input type="hidden" id="parent" value="{$PARENT_MODULE}"/>
                <input type="hidden" id="sourceRecord" {if isset($SOURCE_RECORD)} value="{$SOURCE_RECORD}" {/if}/>
                <input type="hidden" id="sourceField" {if isset($SOURCE_FIELD)} value="{$SOURCE_FIELD}" {/if}/>
                <input type="hidden" id="url" {if isset($GETURL)} value="{$GETURL}" {/if}/>
                <input type="hidden" id="multi_select" {if isset($MULTI_SELECT)} value="{$MULTI_SELECT}" {/if}/>
                <input type="hidden" id="currencyId" {if isset($CURRENCY_ID)} value="{$CURRENCY_ID}" {/if}/>
                <input type="hidden" id="relatedParentModule" {if isset($RELATED_PARENT_MODULE)} value="{$RELATED_PARENT_MODULE}" {/if}/>
                <input type="hidden" id="relatedParentId" {if isset($RELATED_PARENT_ID)} value="{$RELATED_PARENT_ID}" {/if}/>
                <input type="hidden" id="view" name="view" value="{$VIEW}"/>
                <input type="hidden" id="relationId" {if isset($RELATION_ID)} value="{$RELATION_ID}" {/if}/>
                <input type="hidden" id="selectedIds" name="selectedIds">
                {if !empty($POPUP_CLASS_NAME)}
                    <input type="hidden" id="popUpClassName" value="{$POPUP_CLASS_NAME}"/>
                {/if}
                <div id="popupContents" class="">
                    {include file='PopupContents.tpl'|vtemplate_path:$MODULE_NAME}
                </div>
            </div>
        </div>
    </div>
</div>
{/strip}
