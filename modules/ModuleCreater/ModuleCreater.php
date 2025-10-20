<?php
/*+*******************************************************************************
 * The content of this file is subject to the CRMTiger Pro license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is vTiger
 * The Modified Code of the Original Code owned by https://crmtiger.com/
 * Portions created by CRMTiger.com are Copyright(C) CRMTiger.com
 * All Rights Reserved.
  ***************************************************************************** */

class ModuleCreater {	
	
	/**
	* Invoked when special actions are performed on the module.
	* @param String Module name
	* @param String Event Type
	*/
	function vtlib_handler($moduleName, $eventType) {
		global $adb;
 		if($eventType == 'module.postinstall') {
			// TODO Handle actions after this module is installed.
			ModuleCreater::tks_makeDir();
			ModuleCreater::tks_copyImg();
			// ModuleCreater::CheckLicenseEnableOrNot();
			
		} else if($eventType == 'module.disabled') {
			// TODO Handle actions before this module is being uninstalled.
		} else if($eventType == 'module.preuninstall') {
			// TODO Handle actions when this module is about to be deleted.
		} else if($eventType == 'module.preupdate') {
				// ModuleCreater::CheckLicenseEnableOrNot();
			// TODO Handle actions before this module is updated.
		} else if($eventType == 'module.postupdate') {
			// TODO Handle actions after this module is updated.
			ModuleCreater::tks_makeDir();
			ModuleCreater::tks_copyImg();
		}
 	}

 	static function CheckLicenseEnableOrNot() {
        global $adb;
        $rs=$adb->pquery("SELECT `licensekey` FROM `vtiger_modulecreater_license`;",array());
        if($adb->num_rows($rs) > 0) {
            $adb->pquery("DELETE FROM `vtiger_modulecreater_license` WHERE 1",array());
        }
    }
	
	/**
	* Check if modules folder exsist in test/vtlib folder else create module folder
	*/
	function tks_makeDir()
	{
		global $log;
		$log->debug("Entering tks_makeDir() method ...");
		$dir = 'test/vtlib/modules';
		if ( !file_exists( $dir ) and !is_dir( $dir ) ) 
		{
			@mkdir( $dir );    
		}
		ModuleCreater::tks_cleanDir();
		$log->debug("Exiting tks_makeDir() method ...");
	}
	
	/**
	*copy the Module Builder Logo to the vtiger Default Images
	*/
	function tks_copyImg()
	{
		global $log;
		$log->debug("Entering tks_copyImg() method ...");
		@copy( 'modules/ModuleCreater/images/ModuleCreater.png','layouts/vlayout/skins/images/ModuleCreater.png');
		$log->debug("Exiting tks_copyImg() method ...");
	}
	
	/**
	*clean the modules directory if any data
	*/
	function tks_cleanDir()
	{
		global $log;
		$log->debug("Entering tks_cleanDir() method ...");
		$files = array();
		$files = glob('test/vtlib/modules/*');
		if(is_array($files) && !empty($files))
		{
			foreach($files as $file)
			{
		  		if(is_file($file))
					unlink($file);
			}
		}
		$log->debug("Exiting tks_cleanDir() method ...");
	}
}
?>