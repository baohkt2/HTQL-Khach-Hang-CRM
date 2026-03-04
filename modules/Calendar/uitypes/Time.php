<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Calendar_Time_UIType extends Vtiger_Time_UIType {


	public function getEditViewDisplayValue($value) {
		if(!empty($value)) {
			return parent::getEditViewDisplayValue($value);
		}

		$specialTimeFields = array('time_start', 'time_end');

		$fieldInstance = $this->get('field')->getWebserviceFieldObject();
		$fieldName = $fieldInstance->getFieldName();

		if(!in_array($fieldName, $specialTimeFields)){
			return parent::getEditViewDisplayValue($value);
		}else{
			return $this->getDisplayTimeDifferenceValue($fieldName, $value);
		}
		
	}

	/**
	 * Function to get the calendar event call duration value in hour format
	 * @param type $fieldName
	 * @param type $value
	 * @return <Vtiger_Time_UIType> - getTimeValue 
	 */
	public function getDisplayTimeDifferenceValue($fieldName, $value){
		$userModel = Users_Privileges_Model::getCurrentUserModel();	
		$date = new DateTime(isset($value) ? $value: '');
		
		//No need to set the time zone as DateTimeField::getDisplayTime API is already doing this
		/*if(empty($value)) {
			$timeZone = $userModel->get('time_zone');
			$targetTimeZone = new DateTimeZone($timeZone);
			$date->setTimezone($targetTimeZone);
		}*/
		
		if ($fieldName == 'time_end' && empty($value)) {
			if ($userModel->get('defaultactivitytype') == 'Call') {
				$defaultCallDuration = $userModel->get('callduration');
			} else {
				$defaultCallDuration = $userModel->get('othereventduration');
			}
			$date->modify("+{$defaultCallDuration} minutes");
		}

		$dateTimeField = new DateTimeField($date->format('Y-m-d H:i:s'));
		$value = $dateTimeField->getDisplayTime();
		return $value;
	}
        
        /**
	 * Function to get the ModtrackerDisplay Value, for the current field type with given DB Insert Value
	 * @param <Object> $fieldName
	 * @param <Object> $value
	 * @param <Object> $recordModel
	 * @return $value
	 */
	public static function getModTrackerDisplayValue($fieldName,$value,$recordModel) {
		$userModel = Users_Privileges_Model::getCurrentUserModel();
		if(empty($value)){
			return '';
		}
		if($recordModel){
			$startDate = $recordModel->get('date_start');
			$endDate = $recordModel->get('due_date');
			if($fieldName == 'time_start') {
				//Added this check to show start time according to start date of calendar record
				//to avoid day light saving issue for -(UTC London) => UTC+1:00
				$dateTime = new DateTimeField($startDate.' '.$value);
				$value = $dateTime->getDisplayTime();
			}
			if($fieldName == 'time_end'){
				//Added this check to show end time according to end date of calendar record
				//to avoid day light saving issue for -(UTC London) => UTC+1:00
				$dateTime = new DateTimeField($endDate.' '.$value);
				$value = $dateTime->getDisplayTime();

			}
		}
		if($userModel->get('hour_format') == '12'){
			return Vtiger_Time_UIType::getTimeValueInAMorPM($value);
		}
		return $value;
	}

}