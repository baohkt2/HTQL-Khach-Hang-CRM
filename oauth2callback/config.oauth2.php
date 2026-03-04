<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/

return array(

    // Create project in https://console.cloud.google.com
    // Enable Oauth2 Web Client and update details below.
    "Google" => array(
        "clientId" => "1077298873984-cknfeqdcspf4alldfk4ukc29rut28sot.apps.googleusercontent.com",
        "clientSecret" => "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",
    ),

    // Setup XOAUTH2 Imap Proxy Service
    // https://code.vtiger.com/vtiger/vtigercrm/-/issues/1914
    // Update host:port details here.
    "Proxies" => array(
        "imap.gmail.com" => "127.0.0.1:3333"
    )
);
