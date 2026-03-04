<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Vtiger_Phone_UIType extends Vtiger_Base_UIType {

	/**
	 * Function to get the Template name for the current UI Type object
	 * @return <String> - Template Name
	 */
	public function getTemplateName() {
		return 'uitypes/Phone.tpl';
	}

    /**
	 * Function to get the Detailview template name for the current UI Type Object 
	 * @return <String> - Template Name
	 */
	public function getDetailViewTemplateName() {
		return 'uitypes/PhoneDetailView.tpl';
	}

	/**
	 * Lấy giới hạn độ dài số điện thoại từ typeofdata
	 * typeofdata format: V~O~PHONE~10 hoặc V~O~PHONE~8-11
	 * @return <String|null> - giới hạn (VD: "10" hoặc "8-11"), null nếu không có
	 */
	public function getPhoneLimit() {
		$fieldModel = $this->get('field');
		if ($fieldModel) {
			$typeofdata = $fieldModel->get('typeofdata');
			if ($typeofdata) {
				$parts = explode('~', $typeofdata);
				// Format: V~O~PHONE~{limit}
				if (count($parts) >= 4 && $parts[2] === 'PHONE') {
					return $parts[3]; // VD: "10" hoặc "8-11"
				}
			}
		}
		return null;
	}
}