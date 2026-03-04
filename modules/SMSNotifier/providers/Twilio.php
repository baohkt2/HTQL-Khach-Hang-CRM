<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 * C:\xampp\htdocs\cusc\modules\SMSNotifier\providers
 ************************************************************************************/

class SMSNotifier_Twilio_Provider implements SMSNotifier_ISMSProvider_Model {

	private $userName;
	private $password;
	private $parameters = array();

	// Sửa endpoint theo API mới
	private $SERVICE_URI = 'https://api.twilio.com/2010-04-01/Accounts/{sid}/Messages.json';

	private static $REQUIRED_PARAMETERS = array(
		array('name'=>'AccountSID','label'=>'Account SID','type'=>'text'),
		array('name'=>'AuthToken','label'=>'Auth Token','type'=>'text'),
		array('name'=>'From','label'=>'From','type'=>'text')
	);

	public function getName() {
		return 'Twilio';
	}

	public function getRequiredParams() {
		return self::$REQUIRED_PARAMETERS;
	}

	public function getServiceURL($type = false) {
		$accountSID = $this->getParameter('AccountSID');
		$this->SERVICE_URI = str_replace('{sid}', $accountSID, $this->SERVICE_URI);
		return $this->SERVICE_URI;
	}

	public function setAuthParameters($userName, $password) {
		$this->userName = $userName;
		$this->password = $password;
	}

	public function setParameter($key, $value) {
		$this->parameters[$key] = $value;
	}

	public function getParameter($key, $defaultValue = false) {
		if(isset($this->parameters[$key])) {
			return $this->parameters[$key];
		}
		return $defaultValue;
	}

	protected function prepareParameters() {
		foreach (self::$REQUIRED_PARAMETERS as $key=>$fieldInfo) {
			$params[$fieldInfo['name']] = $this->getParameter($fieldInfo['name']);
		}
		return $params;
	}

	/**
	 * Gửi tin nhắn SMS qua Twilio
	 */
	public function send($message, $toNumbers) {
		if(!is_array($toNumbers)) {
			$toNumbers = array($toNumbers);
		}

		$params = $this->prepareParameters();
		$httpClient = new Vtiger_Net_Client($this->getServiceURL());
		$httpClient->setHeaders(array(
			'Authorization' => 'Basic '.base64_encode($params['AccountSID'].':'.$params['AuthToken'])
		));

		$results = array();

		foreach($toNumbers as $toNumber) {
			$response = $httpClient->doPost(array(
				'From' => $params['From'],
				'To'   => $toNumber,
				'Body' => $message
			));

			$jsonObject = json_decode($response, true);
			$result = array();

			if (isset($jsonObject['sid'])) {
				$result['id'] = $jsonObject['sid'];
				$status = $jsonObject['status'];
				$result['status'] = $status;
				$result['to'] = $jsonObject['to'];

				switch($status) {
					case 'queued':
					case 'sending':
						$status = self::MSG_STATUS_PROCESSING;
						break;
					case 'sent':
						$status = self::MSG_STATUS_DISPATCHED;
						break;
					case 'delivered':
						$status = self::MSG_STATUS_DELIVERED;
						break;
					default:
						$status = self::MSG_STATUS_FAILED;
						break;
				}
				$results[] = $result;
			} else {
				$result['error'] = true;
				$result['statusmessage'] = isset($jsonObject['message']) ? $jsonObject['message'] : 'Unknown error';
				$result['to'] = $toNumber;
				$results[] = $result;
			}
		}

		return $results;
	}

	/**
	 * Truy vấn trạng thái tin nhắn
	 */
	public function query($messageId) {
		$params = $this->prepareParameters();

		$url = 'https://api.twilio.com/2010-04-01/Accounts/'.$params['AccountSID'].'/Messages/'.$messageId.'.json';
		$httpClient = new Vtiger_Net_Client($url);
		$httpClient->setHeaders(array(
			'Authorization' => 'Basic '.base64_encode($params['AccountSID'].':'.$params['AuthToken'])
		));

		$response = $httpClient->doGet(array());
		$jsonObject = json_decode($response, true);

		$result = array();
		$result['error'] = false;

		if (isset($jsonObject['status'])) {
			$status = $jsonObject['status'];

			switch($status) {
				case 'queued':
				case 'sending':
					$status = self::MSG_STATUS_PROCESSING;
					$result['needlookup'] = 1;
					break;
				case 'sent':
					$status = self::MSG_STATUS_DISPATCHED;
					$result['needlookup'] = 1;
					break;
				case 'delivered':
					$status = self::MSG_STATUS_DELIVERED;
					$result['needlookup'] = 0;
					break;
				default:
					$status = self::MSG_STATUS_FAILED;
					$result['needlookup'] = 1;
					break;
			}

			$result['status'] = $status;
			$result['statusmessage'] = $status;
		} else {
			$result['error'] = true;
			$result['statusmessage'] = 'Invalid response from Twilio API';
		}

		return $result;
	}

	function getProviderEditFieldTemplateName() {
		return 'Twilio.tpl';
	}
}
?>
