<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

include_once 'vendor/autoload.php';
include_once 'vtlib/Vtiger/Module.php';
vimport('includes.runtime.EntryPoint');

if(isset($_REQUEST['type']) && isset($_REQUEST['key']) && $_REQUEST['type'] == 'logo'){
	$logoPath = 'test/logo/';
	$allowedLogoImageFormats = Settings_Vtiger_CompanyDetails_Model::$logoSupportedFormats;
	$fileName = vtlib_purify($_REQUEST['key']);
	$finalFilePath = $logoPath.$fileName;
	$extension = explode('.', $fileName);
	$imageFormat = strtolower($extension[1]);
	if (in_array($imageFormat, $allowedLogoImageFormats)) {
		checkFileAccess($finalFilePath);
		
		/* rebuild expected content-type */
		$contentType = "image/" . $extension[1];
		if (strtolower($extension[1]) == "svg") {
	        	$contentType = "image/svg+xml";
		}
		Vtiger_ShowFile_Helper::show($finalFilePath, $contentType);
	}
	return;
}

Vtiger_ShowFile_Helper::handle(vtlib_purify($_REQUEST['fid']), vtlib_purify($_REQUEST['key']));
