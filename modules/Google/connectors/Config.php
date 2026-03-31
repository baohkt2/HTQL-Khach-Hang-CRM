<?php
/* +**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 * ***********************************************************************************/

if (!function_exists('env')) {
	require_once dirname(__FILE__) . '/../../../env.loader.php';
}

Class Google_Config_Connector {
	static $clientId = '';
	static $clientSecret = '';

	static function getRedirectUrl() {
		global $site_URL;
		return $site_URL.'/index.php?module=Google&view=Authenticate&service=Google';
	}
}

Google_Config_Connector::$clientId = env('GOOGLE_CLIENT_ID', '');
Google_Config_Connector::$clientSecret = env('GOOGLE_CLIENT_SECRET', '');
