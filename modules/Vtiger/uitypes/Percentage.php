<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Vtiger_Percentage_UIType extends Vtiger_Base_UIType {

	/**
	 * Function to get the Template name for the current UI Type object
	 * @return <String> - Template Name
	 */
	public function getTemplateName() {
		return 'uitypes/Percentage.tpl';
	}

	public function getDisplayValue($value, $record = false, $recordInstance = false) {
		$fldvalue = str_replace(",", ".", $value);
		$value = (is_numeric($fldvalue)) ? $fldvalue : null;
		return static::convertToUserFormat($value, null, true);
	}

	public static function convertToUserFormat($value, $user = null, $skipConversion = false, $skipFormatting = false) {
		
		if (empty($value)) {
            return $value;
        }
		if (empty($user)) {
            $user = Users_Record_Model::getCurrentUserModel();
        }
        $currencyField = new CurrencyField($value);
        $display_value = $currencyField->getDisplayValue($user, $skipConversion, $skipFormatting);
        return $display_value;
    }

	public function getEditViewDisplayValue($value) {
		return $this->getDisplayValue($value);
	}
	
	public function getDBInsertValue($value) {
		$value = CurrencyField::convertToDBFormat($value, null, true);
		return $value;
	}
}
