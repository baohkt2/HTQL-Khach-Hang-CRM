{*<!--
/*********************************************************************************
  ** The contents of this file are subject to the vtiger CRM Public License Version 1.0
   * ("License"); You may not use this file except in compliance with the License
   * The Original Code is: vtiger CRM Open Source
   * The Initial Developer of the Original Code is vtiger.
   * Portions created by vtiger are Copyright (C) vtiger.
   * All Rights Reserved.
  *
 ********************************************************************************/
-->*}
{strip}
{assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
{assign var="FIELD_INFO" value=$FIELD_MODEL->getFieldInfo()}
{if (!$FIELD_NAME)}
  {assign var="FIELD_NAME" value=$FIELD_MODEL->getFieldName()}
{/if}
{* === Phone Limit: đọc giới hạn độ dài từ typeofdata ===
   typeofdata format: V~O~PHONE~10 hoặc V~O~PHONE~8-11
   Nếu có, thêm data-phone-limit vào input để JS validate
*}
{assign var="TYPEOFDATA" value=$FIELD_MODEL->get('typeofdata')}
{assign var="PHONE_LIMIT" value=""}
{if $TYPEOFDATA}
  {assign var="TOD_PARTS" value="~"|explode:$TYPEOFDATA}
  {if count($TOD_PARTS) >= 4 && $TOD_PARTS[2] == 'PHONE'}
    {assign var="PHONE_LIMIT" value=$TOD_PARTS[3]}
  {/if}
{/if}
<input id="{$MODULE}_editView_fieldName_{$FIELD_NAME}" type="text" class="inputElement phoneField" name="{$FIELD_NAME}" data-type="phone"
value="{$FIELD_MODEL->get('fieldvalue')}" {if !empty($SPECIAL_VALIDATOR)}data-validator='{Zend_Json::encode($SPECIAL_VALIDATOR)}'{/if}
{if $FIELD_INFO["mandatory"] eq true} data-rule-required="true" {/if}
{if php7_count($FIELD_INFO['validator'])}
    data-specific-rules='{ZEND_JSON::encode($FIELD_INFO["validator"])}'
{/if}
{if $PHONE_LIMIT} data-phone-limit="{$PHONE_LIMIT}"{/if}
 />
{/strip}
