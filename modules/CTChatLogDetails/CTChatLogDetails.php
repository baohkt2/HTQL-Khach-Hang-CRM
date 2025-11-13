<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/

include_once 'modules/Vtiger/CRMEntity.php';

class CTChatLogDetails extends Vtiger_CRMEntity {
	var $table_name = 'vtiger_ctchatlogdetails';
	var $table_index= 'ctchatlogdetailsid';

	/**
	 * Mandatory table for supporting custom fields.
	 */
	var $customFieldTable = Array('vtiger_ctchatlogdetailscf', 'ctchatlogdetailsid');

	/**
	 * Mandatory for Saving, Include tables related to this module.
	 */
	var $tab_name = Array('vtiger_crmentity', 'vtiger_ctchatlogdetails', 'vtiger_ctchatlogdetailscf');

	/**
	 * Mandatory for Saving, Include tablename and tablekey columnname here.
	 */
	var $tab_name_index = Array(
		'vtiger_crmentity' => 'crmid',
		'vtiger_ctchatlogdetails' => 'ctchatlogdetailsid',
		'vtiger_ctchatlogdetailscf'=>'ctchatlogdetailsid');

	/**
	 * Mandatory for Listing (Related listview)
	 */
	var $list_fields = Array (
		/* Format: Field Label => Array(tablename, columnname) */
		// tablename should not have prefix 'vtiger_'
		'Chat Log Details No' => Array('ctchatlogdetails', 'chat_log_details_no'),
		'Assigned To' => Array('crmentity','smownerid')
	);
	var $list_fields_name = Array (
		/* Format: Field Label => fieldname */
		'Chat Log Details No' => 'chat_log_details_no',
		'Assigned To' => 'assigned_user_id',
	);

	// Make the field link to detail view
	var $list_link_field = 'chat_log_details_no';

	// For Popup listview and UI type support
	var $search_fields = Array(
		/* Format: Field Label => Array(tablename, columnname) */
		// tablename should not have prefix 'vtiger_'
		'Chat Log Details No' => Array('ctchatlogdetails', 'chat_log_details_no'),
		'Assigned To' => Array('vtiger_crmentity','assigned_user_id'),
	);
	var $search_fields_name = Array (
		/* Format: Field Label => fieldname */
		'Chat Log Details No' => 'chat_log_details_no',
		'Assigned To' => 'assigned_user_id',
	);

	// For Popup window record selection
	var $popup_fields = Array ('chat_log_details_no');

	// For Alphabetical search
	var $def_basicsearch_col = 'chat_log_details_no';

	// Column value to use on detail view record text display
	var $def_detailview_recname = 'chat_log_details_no';

	// Used when enabling/disabling the mandatory fields for the module.
	// Refers to vtiger_field.fieldname values.
	var $mandatory_fields = Array();

	var $default_order_by = 'chat_log_details_no';
	var $default_sort_order='ASC';

	/**
	* Invoked when special actions are performed on the module.
	* @param String Module name
	* @param String Event Type
	*/
	function vtlib_handler($moduleName, $eventType) {
		global $adb;
 		if($eventType == 'module.postinstall') {
			// TODO Handle actions after this module is installed.
			self::addFbQuotedField();
		} else if($eventType == 'module.disabled') {
			// TODO Handle actions before this module is being uninstalled.
		} else if($eventType == 'module.preuninstall') {
			// TODO Handle actions when this module is about to be deleted.
		} else if($eventType == 'module.preupdate') {
			// TODO Handle actions before this module is updated.
		} else if($eventType == 'module.postupdate') {
			// TODO Handle actions after this module is updated.
			self::addFbQuotedField();
		}
 	}

 	static function addFbQuotedField(){
        global $adb;
        $checkChatLogTableExist = $adb->pquery("SHOW TABLES LIKE 'vtiger_ctchatlogdetails'", array());
        $chatLogTableNumRows = $adb->num_rows($checkChatLogTableExist);
        
        if($chatLogTableNumRows > 0){
            $checkFbQuotedColumnExist = $adb->pquery("SHOW COLUMNS FROM vtiger_ctchatlogdetails LIKE 'fb_quoted_message'", array());

            if($adb->num_rows($checkFbQuotedColumnExist) == 0){
                $addFbQuotedColumn = $adb->pquery("ALTER TABLE vtiger_ctchatlogdetails ADD fb_quoted_message longtext NULL AFTER notification_tone", array());
            }//end of if
        }//end of if
    }//end of function
}