<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/

if (!file_exists("config.oauth2.php")) {
    echo "Please copy config.oauth2-sample.php to config.outh2.php and update";
    exit;
}

chdir(dirname(__FILE__). '/..');

require_once "vendor/autoload.php";
require_once "config.php";
require_once "includes/main/WebUI.php";
require_once "modules/Oauth2/callbacks/Usercallback.php";

(function() {
    $cfgdata = require_once __DIR__ . "/config.oauth2.php";
    Oauth2_Usercallback_Callbacks::handleRequest(Oauth2_Config::loadConfig($cfgdata), $_REQUEST);
})();
