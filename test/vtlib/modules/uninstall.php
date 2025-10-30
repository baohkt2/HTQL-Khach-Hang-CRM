<?php
/***********************************************************************************************
** The contents of this file are subject to the Vtiger Docusign License Version 1.0
 * ( "License" ); You may not use this file except in compliance with the License
 * The Original Code is:  Technokrafts Labs Pvt Ltd
 * The Initial Developer of the Original Code is Technokrafts Labs Pvt Ltd.
 * Portions created by Technokrafts Labs Pvt Ltd are Copyright ( C ) Technokrafts Labs Pvt Ltd.
 * All Rights Reserved.
**
*************************************************************************************************/
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
if($_SERVER['HTTP_REFERER'] == $backURL.'index.php?module=ModuleBuilder&view=Uninstall&parent=Tools')
{

	delete_directory('layouts/vlayout/modules/ModuleBuilder' ); // Not empty? Delete the files inside it

	if(file_exists('languages/en_us/ModuleBuilder.php'))
		@unlink( 'languages/en_us/ModuleBuilder.php' );
	if(file_exists('layouts/vlayout/skins/images/ModuleBuilder.png'))
		@unlink( 'layouts/vlayout/skins/images/ModuleBuilder.png' );	
	delete_directory('modules/ModuleBuilder' ); // Not empty? Delete the files inside it

}
header("Location: $site_URL"."index.php?module=Users&parent=Settings&view=UserSetup");
?>