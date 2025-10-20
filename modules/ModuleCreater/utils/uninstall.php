<?php
/*+*******************************************************************************
 * The content of this file is subject to the CRMTiger Pro license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is vTiger
 * The Modified Code of the Original Code owned by https://crmtiger.com/
 * Portions created by CRMTiger.com are Copyright(C) CRMTiger.com
 * All Rights Reserved.
  ***************************************************************************** */
// Switch the working directory to base
chdir(dirname(__FILE__) . '/../../..');
require_once('config.inc.php');

/*
 * Function to delete each file and directory in the folder recursively
 */
function delete_directory( $dir )
{
	require_once('config.inc.php');
	foreach(glob("{$dir}/*") as $file)
	{
		if(is_dir($file)) {
			delete_directory($file);
		} else {
			unlink($file);
		}
	}
	@rmdir($dir);
}

global $site_URL;
$backURL =  rtrim($site_URL, '/') . '/';
if($_SERVER['HTTP_REFERER'] == $backURL.'index.php?module=ModuleCreater&view=Uninstall&parent=Tools')
{

	delete_directory('layouts/vlayout/modules/ModuleCreater' ); // Not empty? Delete the files inside it

	if(file_exists('languages/en_us/ModuleCreater.php'))
		@unlink( 'languages/en_us/ModuleCreater.php' );
	if(file_exists('layouts/vlayout/skins/images/ModuleCreater.png'))
		@unlink( 'layouts/vlayout/skins/images/ModuleCreater.png' );	
	delete_directory('modules/ModuleCreater' ); // Not empty? Delete the files inside it

}
header("Location: $site_URL"."index.php?module=Users&parent=Settings&view=UserSetup");
?>