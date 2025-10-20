<?php
/*+**********************************************************************************
* The content of this file is subject to the CRMTiger Pro license.
* ("License"); You may not use this file except in compliance with the License
* The Initial Developer of the Original Code is vTiger
* The Modified Code of the Original Code owned by https://crmtiger.com/
* Portions created by CRMTiger.com are Copyright(C) CRMTiger.com
* All Rights Reserved.
************************************************************************************/
class CTChatLog_Module_Model extends Vtiger_Module_Model {
	/**
	 * Function to get the ListView Component Name
	 * @return string
	 */
	public function getDefaultViewName() {
		return 'ChatBox';
	}

	/**
	 * Function to get the url for list view of the module
	 * @return <string> - url
	 */
	public function getDefaultUrl() {
		return 'index.php?module='.$this->get('name').'&view='.$this->getDefaultViewName().'&mode=allChats';
	}
}