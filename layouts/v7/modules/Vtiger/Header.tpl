{*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************}
{strip}
<!DOCTYPE html>
<html>
	<head>
		<title>{vtranslate($PAGETITLE, $QUALIFIED_MODULE)}</title>
        <link rel="SHORTCUT ICON" href="layouts/v7/skins/images/favicon.ico">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

		<link type='text/css' rel='stylesheet' href='{vresource_url("libraries/bootstrap-legacy/css/bootstrap-responsive.min.css")}'> {* .row-fluid... *}
		<link type='text/css' rel='stylesheet' href='{vresource_url("layouts/v7/lib/todc/css/bootstrap.min.css")}'>
		<link type='text/css' rel='stylesheet' href='{vresource_url("layouts/v7/lib/todc/css/docs.min.css")}'>
		<link type='text/css' rel='stylesheet' href='{vresource_url("layouts/v7/lib/todc/css/todc-bootstrap.min.css")}'>
		<link type='text/css' rel='stylesheet' href='{vresource_url("layouts/v7/lib/font-awesome/css/font-awesome.min.css")}'>
        <link type='text/css' rel='stylesheet' href='{vresource_url("layouts/v7/lib/jquery/select2/select2.css")}'>
        <link type='text/css' rel='stylesheet' href='{vresource_url("layouts/v7/lib/select2-bootstrap/select2-bootstrap.css")}'>
        <link type='text/css' rel='stylesheet' href='{vresource_url("libraries/bootstrap/js/eternicode-bootstrap-datepicker/css/datepicker3.css")}'>
        <link type='text/css' rel='stylesheet' href='{vresource_url("layouts/v7/lib/jquery/jquery-ui-1.12.0.custom/jquery-ui.css")}'>
        <link type='text/css' rel='stylesheet' href='{vresource_url("layouts/v7/lib/vt-icons/style.css")}'>
        <link type='text/css' rel='stylesheet' href='{vresource_url("layouts/v7/lib/animate/animate.min.css")}'>
        <link type='text/css' rel='stylesheet' href='{vresource_url("layouts/v7/lib/jquery/malihu-custom-scrollbar/jquery.mCustomScrollbar.css")}'>
        <link type='text/css' rel='stylesheet' href='{vresource_url("layouts/v7/lib/jquery/jquery.qtip.custom/jquery.qtip.css")}'>
        <link type='text/css' rel='stylesheet' href='{vresource_url("layouts/v7/lib/jquery/daterangepicker/daterangepicker.css")}'>
        
        <input type="hidden" id="inventoryModules" value={ZEND_JSON::encode($INVENTORY_MODULES)}>
        {if isset($SELECTED_MENU_CATEGORY)}
        {assign var=V7_THEME_PATH value=Vtiger_Theme::getv7AppStylePath($SELECTED_MENU_CATEGORY)}
        {/if}
        {if strpos($V7_THEME_PATH,".less")!== false}
            <link type="text/css" rel="stylesheet/less" href="{vresource_url($V7_THEME_PATH)}" media="screen" />
        {else}
            <link type="text/css" rel="stylesheet" href="{vresource_url($V7_THEME_PATH)}" media="screen" />
        {/if}
        
        {foreach key=index item=cssModel from=$STYLES}
			<link type="text/css" rel="{$cssModel->getRel()}" href="{vresource_url($cssModel->getHref())}" media="{$cssModel->getMedia()}" />
		{/foreach}

		{* For making pages - print friendly *}
		<style type="text/css">
            @media print {
            .noprint { display:none; }
		}
		</style>
		<script type="text/javascript">var __pageCreationTime = (new Date()).getTime();</script>
		<script src="{vresource_url('layouts/v7/lib/jquery/jquery.min.js')}"></script>
		<script src="{vresource_url('layouts/v7/lib/jquery/jquery-migrate-1.4.1.js')}"></script>
		<script type="text/javascript">
			var _META = { 'module': "{$MODULE}", view: "{$VIEW}", 'parent': "{$PARENT_MODULE}", 'notifier':"{$NOTIFIER_URL}", 'app':"{if isset($SELECTED_MENU_CATEGORY)} {$SELECTED_MENU_CATEGORY}{/if}" };
            {if $EXTENSION_MODULE}
                var _EXTENSIONMETA = { 'module': "{$EXTENSION_MODULE}", view: "{$EXTENSION_VIEW}"};
            {/if}
            var _USERMETA;
            {if $CURRENT_USER_MODEL}
               _USERMETA =  { 'id' : "{$CURRENT_USER_MODEL->get('id')}", 'menustatus' : "{$CURRENT_USER_MODEL->get('leftpanelhide')}", 
                              'currency' : "{decode_html($USER_CURRENCY_SYMBOL)}", 'currencySymbolPlacement' : "{$CURRENT_USER_MODEL->get('currency_symbol_placement')}",
                          'currencyGroupingPattern' : "{$CURRENT_USER_MODEL->get('currency_grouping_pattern')}", 'truncateTrailingZeros' : "{$CURRENT_USER_MODEL->get('truncate_trailing_zeros')}",'userlabel':"{($CURRENT_USER_MODEL->get('userlabel'))|escape:html}",};
            {/if}
		</script>
	
{* OAuth2 Notification System *}
<script>
{literal}
// OAuth2 Status Check System
function checkOAuth2Status() {
    fetch("index.php?module=Settings&parent=Settings&action=CheckOAuth2Status")
        .then(response => response.json())
        .then(data => {
            if (data.status === "invalid" && !sessionStorage.getItem("oauth2_dismissed_" + data.username)) {
                showOAuth2Notification(data);
            }
        })
        .catch(error => console.log("OAuth2 check failed"));
}

function showOAuth2Notification(data) {
    var existingNotif = document.querySelector(".oauth2-expired-notification");
    if (existingNotif) existingNotif.remove();
    
    var notification = document.createElement("div");
    notification.className = "oauth2-expired-notification";
    notification.innerHTML = `
        <div style="position: fixed; top: 0; left: 0; right: 0; z-index: 10000; background: #d9534f; color: white; padding: 10px; text-align: center; font-size: 14px;">
            <strong>Gmail OAuth2 Expired:</strong> Email functionality requires reconnection. 
            <a href="index.php?module=Vtiger&parent=Settings&view=OutgoingServerEdit" style="color: #fff; text-decoration: underline; margin: 0 10px;">Reconnect Now</a>
            <button onclick="dismissOAuth2Notification('" + data.username + "')" style="background: transparent; border: 1px solid #fff; color: #fff; padding: 2px 8px; cursor: pointer;">×</button>
        </div>
    `;
    
    document.body.insertBefore(notification, document.body.firstChild);
    document.body.style.paddingTop = "50px";
}

function dismissOAuth2Notification(username) {
    sessionStorage.setItem("oauth2_dismissed_" + username, "true");
    var notification = document.querySelector(".oauth2-expired-notification");
    if (notification) {
        notification.remove();
        document.body.style.paddingTop = "";
    }
}

// Check OAuth2 status on page load and every 10 minutes
document.addEventListener("DOMContentLoaded", function() {
    checkOAuth2Status();
    setInterval(checkOAuth2Status, 600000);
});
{/literal}
</script>
</head>
	 {assign var=CURRENT_USER_MODEL value=Users_Record_Model::getCurrentUserModel()}
	<body data-skinpath="{Vtiger_Theme::getBaseThemePath()}" data-language="{$LANGUAGE}" data-user-decimalseparator="{$CURRENT_USER_MODEL->get('currency_decimal_separator')}" data-user-dateformat="{$CURRENT_USER_MODEL->get('date_format')}"
          data-user-groupingseparator="{$CURRENT_USER_MODEL->get('currency_grouping_separator')}" data-user-numberofdecimals="{$CURRENT_USER_MODEL->get('no_of_currency_decimals')}" data-user-hourformat="{$CURRENT_USER_MODEL->get('hour_format')}"
          data-user-calendar-reminder-interval="{$CURRENT_USER_MODEL->getCurrentUserActivityReminderInSeconds()}">
            <input type="hidden" id="start_day" value="{$CURRENT_USER_MODEL->get('dayoftheweek')}" /> 
		<div id="page">
            <div id="pjaxContainer" class="hide noprint"></div>
            <div id="messageBar" class="hide"></div>
