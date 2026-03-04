{*<!--
/*********************************************************************************
** The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
*
 ********************************************************************************/
-->*}
{strip}
<!DOCTYPE html>
<html>
	<head>
		<title>
			{vtranslate($PAGETITLE, $MODULE_NAME)}
		</title>
		<link REL="SHORTCUT ICON" HREF="layouts/vlayout/skins/images/favicon.ico">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" href="libraries/jquery/chosen/chosen.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="libraries/jquery/jquery-ui/css/custom-theme/jquery-ui-1.8.16.custom.css" type="text/css" media="screen" />

		<link rel="stylesheet" href="libraries/jquery/select2/select2.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="libraries/bootstrap/css/bootstrap.min.css" type="text/css" media="screen" />
                <link rel="stylesheet" href="libraries/bootstrap/css/jqueryBxslider.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="resources/styles.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="libraries/jquery/posabsolute-jQuery-Validation-Engine/css/validationEngine.jquery.css" />

		<link rel="stylesheet" href="libraries/jquery/select2/select2.css" />

		<link rel="stylesheet" href="libraries/guidersjs/guiders-1.2.6.css"/>
		<link rel="stylesheet" href="libraries/jquery/pnotify/jquery.pnotify.default.css"/>
		<link rel="stylesheet" href="libraries/jquery/pnotify/use for pines style icons/jquery.pnotify.default.icons.css"/>
		<link rel="stylesheet" media="screen" type="text/css" href="libraries/jquery/datepicker/css/datepicker.css" />
		{foreach key=index item=cssModel from=$STYLES}
                    <link rel="{$cssModel->getRel()}" href="{vresource_url($cssModel->getHref())}" type="{$cssModel->getType()}" media="{$cssModel->getMedia()}" />
		{/foreach}

		{* For making pages - print friendly *}
		<style type="text/css">
		@media print {
		.noprint { display:none; }
		}
		</style>

		{* This is needed as in some of the tpl we are using jQuery.ready *}
		<script type="text/javascript" src="libraries/jquery/jquery.min.js"></script>
		<!--[if IE]>
		<script type="text/javascript" src="libraries/html5shim/html5.js"></script>
		<script type="text/javascript" src="libraries/html5shim/respond.js"></script>
		<![endif]-->
		{* ends *}

		{* ADD <script> INCLUDES in JSResources.tpl - for better performance *}
	
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

	<body data-skinpath="{$SKIN_PATH}" data-language="{$LANGUAGE}">
		<div id="js_strings" class="hide noprint">{Zend_Json::encode($LANGUAGE_STRINGS)}</div>
		{assign var=CURRENT_USER_MODEL value=Users_Record_Model::getCurrentUserModel()}
		<input type="hidden" id="start_day" value="{$CURRENT_USER_MODEL->get('dayoftheweek')}" />
		<input type="hidden" id="row_type" value="{$CURRENT_USER_MODEL->get('rowheight')}" />
		<input type="hidden" id="current_user_id" value="{$CURRENT_USER_MODEL->get('id')}" />
		<div id="page">
			<!-- container which holds data temporarly for pjax calls -->
			<div id="pjaxContainer" class="hide noprint"></div>
{/strip}
