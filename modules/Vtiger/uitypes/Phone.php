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
	 * Normalize phone value: if numeric and missing leading 0, prepend it.
	 *
	 * @param mixed $value
	 * @return string
	 */
	protected function normalizePhoneValue($value) {
		$value = trim((string) $value);
		if ($value === '') {
			return $value;
		}

		if (ctype_digit($value) && strpos($value, '0') !== 0) {
			$value = '0' . $value;
		}

		return $value;
	}

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
	 * Ensure phone value is normalized before save.
	 *
	 * @param mixed $value
	 * @return string
	 */
	public function getDBInsertValue($value) {
		return $this->normalizePhoneValue($value);
	}

	/**
	 * Ensure ajax save responses use normalized phone value.
	 *
	 * @param mixed $value
	 * @return string
	 */
	public function getUserRequestValue($value) {
		return $this->normalizePhoneValue($value);
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