<?php
/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouInstaller license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

include_once dirname(__FILE__) . '/../../ExtensionStore/libraries/NetClient.php';

class Settings_ITS4YouInstaller_ExtnStore_Connector
{

    /**
     * @var
     */
    protected $url;
    /**
     * @var
     */
    protected $auth;
    /**
     * @var string
     */
    protected $user_table = 'its4you_installer_user';
    /**
     * @var string
     */
    protected $identifier_name = 'its4you_installer';
    /**
     * @var array
     */
    protected $customerLicenseData = array();

    /**
     * Settings_ITS4YouInstaller_ExtnStore_Connector constructor.
     * @param $url
     */
    protected function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * @param $url
     * @return mixed
     */
    public static function getInstance($url)
    {
        static $singletons = null;
        if ($singletons === null) {
            $singletons = array();
        }
        if (!isset($singletons[$url])) {
            $singletons[$url] = new self($url);
        }
        return $singletons[$url];
    }

    /**
     * @return string
     */
    public function getSessionIdentifier()
    {
        return $this->identifier_name;
    }

    /**
     * @return string
     */
    public function getExtensionTable()
    {
        return $this->user_table;
    }

    /**
     * @param string $type
     * @param string $function
     * @param string $field
     * @return array
     */
    public function getMaxCreatedOn($type = 'Extension', $function = '', $field = '')
    {
        $q = array('type' => $type);
        try {
            $response = $this->api('/app/listings/v7', 'GET', $q ? array('q' => Zend_Json::encode($q), 'fn' => $function, 'max' => $field) : null, false);
            return array('success' => true, 'response' => $response);
        } catch (Exception $ex) {
            return array('success' => false, 'error' => $ex->getMessage());
        }
    }

    /**
     * @param $uri
     * @param $method
     * @param $params
     * @param $auth
     * @return array|null
     * @throws Exception
     */
    protected function api($uri, $method, $params, $auth)
    {
        if ($auth) {
            try {
                $this->initializeAuth();
            } catch (Exception $ex) {
                return array('success' => 'false', 'error' => $ex->getMessage());
            }
        }

        $fn = ($method == "GET" || $method == "DLD") ? "doGet" : "doPost";
        if ($method == "PUT") {
            $fn = "doPut";
        }
        $client = $this->getNetClientInstance($method, $uri);
        if ($auth && $this->auth) {
            $authParams = $this->prepareAuthParams($this->auth['username'], $this->auth['password']);
            $client->setAuthorization($authParams['username'], $authParams['password']);
        }

        $content = $client->$fn($params);
        $response = $content['response'];
        $status = $content['status'];

        if (($status != 200)) {
            throw new Exception(isset($content['errorMessage']) ? $content['errorMessage'] : $response);
        }

        if ($method == "DLD") {
            return $response;
        } else {
            $response = preg_replace('/[\000-\031\200-\377]/', '', $response);
            $json = Zend_Json::decode($response);

            if ($json) {
                if ($json['success']) {
                    $json_result = $json['result'];
                    if (in_array($json_result, ['vterr', 'supperr']) || $json['result'] == 'false') {
                        $error = vtranslate('LBL_UNAUTHORIZED', 'Settings:ExtensionStore');
                        throw new Exception($error);
                    }
                    return $json_result;
                } else {
                    throw new Exception($json['error']['message']);
                }
            }
        }
        return null;
    }

    /**
     * @return array|mixed|null
     * @throws Exception
     */
    protected function initializeAuth()
    {
        $db = PearDatabase::getInstance();

        if (!$this->auth) {
            $authResult = $db->pquery('SELECT * FROM ' . $this->user_table, array());
            if ($db->num_rows($authResult)) {
                $this->auth = $db->fetch_array($authResult);
                if (isset($this->auth['deleted']) && $this->auth['deleted'] == 1) {
                    $this->auth = null;
                }
            }
            if (empty($this->auth['password'])) {
                $this->auth['password'] = isset($_SESSION[$this->identifier_name . '_password']) ? $_SESSION[$this->identifier_name . '_password'] : null;
            }
            if (empty($this->auth['username'])) {
                $this->auth['username'] = isset($_SESSION[$this->identifier_name . '_username']) ? $_SESSION[$this->identifier_name . '_username'] : null;
            }
            if (empty($this->auth['password']) && (empty($this->auth['username']))) {
                throw new Exception(vtranslate('LBL_USERNAME_AND_PASSWORD_REQUIRED_FOR_AUTHENTICATION'));
            }
        }

        return $this->auth;
    }

    /**
     * @param $method
     * @param $uri
     * @return Settings_ExtensionStore_NetClient
     */
    protected function getNetClientInstance($method, $uri)
    {

        $clientInstance = new Settings_ExtensionStore_NetClient($method == "DLD" ? $uri : ($this->url . $uri));
        return $clientInstance;
    }

    /**
     * @param $username
     * @param $password
     * @return array
     */
    protected function prepareAuthParams($username, $password)
    {
        return array(
            'username' => $username,
            'password' => urlencode(Zend_Json::encode(array('password' => $password)))
        );
    }

    /**
     * @param null $id
     * @param string $type
     * @return array
     */
    public function getListings($id = null, $type = 'Extension')
    {
        $q = array('type' => $type, 'vtiger_version' => Vtiger_Version::current(), 'application_key' => vglobal('application_unique_key'));

        if ($id) {
            $q['id'] = $id;
        }

        try {
            $response = $this->api('/app/listings/v22', 'GET', $q ? array('q' => Zend_Json::encode($q)) : null, false);

            return array('success' => true, 'response' => $response);
        } catch (Exception $ex) {
            return array('success' => false, 'error' => $ex->getMessage());
        }
    }

    /**
     * @param $config
     * @return array
     */
    public function getLicenses($config)
    {
        try {
            $q = array(
                'vtiger_version' => Vtiger_Version::current(),
                'application_key' => vglobal('application_unique_key'),
                'i' => $_SERVER["REMOTE_ADDR"],
            );
            $q = array_merge($q, (array)$config);
            $response = $this->api('/customer/licenses/list', 'GET', $q ? array('q' => Zend_Json::encode($q)) : null, true);

            return array('success' => true, 'response' => $response);
        } catch (Exception $ex) {
            return array('success' => false, 'error' => $ex->getMessage());
        }
    }

    /**
     * @param $params
     * @return array
     */
    public function getTrial($params)
    {
        try {
            $q = array(
                'v' => vglobal("vtiger_current_version"),
                'i' => $_SERVER["REMOTE_ADDR"],
            );
            $q = array_merge($q, (array)$params);
            $response = $this->api('/customer/license/generate', 'GET', $q ? array('q' => Zend_Json::encode($q)) : null, false);

            return array('success' => true, 'response' => $response);
        } catch (Exception $ex) {
            return array('success' => false, 'error' => $ex->getMessage());
        }
    }

    /**
     * @param null $id
     * @param string $type
     * @return array
     */
    public function getCustomerListings($id = null, $type = 'Extension')
    {
        $q = array('type' => $type, 'vtiger_version' => Vtiger_Version::current(), 'i' => $_SERVER["REMOTE_ADDR"], 'application_key' => vglobal('application_unique_key'));

        if ($id) {
            $q['id'] = $id;
        }

        try {
            $response = $this->api('/app/listings/v22', 'GET', $q ? array('q' => Zend_Json::encode($q)) : null, true);

            return array('success' => true, 'response' => $response);
        } catch (Exception $ex) {
            return array('success' => false, 'error' => $ex->getMessage());
        }
    }

    /**
     * @param $downloadurl
     * @return array
     */
    public function download($downloadurl)
    {
        try {
            $response = $this->api($downloadurl, 'DLD', null, true);

            return array('success' => true, 'response' => $response);
        } catch (Exception $ex) {
            return array('success' => false, 'error' => $ex->getMessage());
        }
    }

    /**
     * @return array|null
     */
    public function getProfile()
    {
        try {
            return $this->api('/customer/profile', 'GET', '', true);
        } catch (Exception $ex) {
            return array('success' => false, 'error' => $ex->getMessage());
        }
    }


    /**
     * @param $username
     * @param $password
     * @param $confirmPassword
     * @param $firstName
     * @param $lastName
     * @param $companyName
     * @return array
     */
    public function signUp($username, $password, $confirmPassword, $firstName, $lastName, $companyName)
    {
        $signupParams = $this->prepareSignUpParams($username, $password, $confirmPassword, $firstName, $lastName, $companyName);
        try {
            $this->auth = $this->api('/app/customer', 'POST', $signupParams, false);
            if ($this->auth) {
                $this->persistLogin($this->auth['email'], $this->auth['password'], $this->auth['account']);
            }
            return array('success' => true, 'result' => $this->auth);
        } catch (Exception $ex) {
            return array('success' => false, 'error' => $ex->getMessage());
        }
    }

    /**
     * @param $username
     * @param $password
     * @param $confirmPassword
     * @param $firstName
     * @param $lastName
     * @param $companyName
     * @return array
     */
    protected function prepareSignUpParams($username, $password, $confirmPassword, $firstName, $lastName, $companyName)
    {
        return array(
            'email' => $username,
            'password' => $password,
            'confirmPassword' => $confirmPassword,
            'firstname' => $firstName,
            'lastname' => $lastName,
            'company' => $companyName
        );
    }

    /**
     * @param $userName
     * @param $password
     * @param $userId
     */
    protected function persistLogin($userName, $password, $userId)
    {
        $adb = PearDatabase::getInstance();
        $adb->pquery('DELETE FROM ' . $this->user_table, array());

        if (!empty($userName) && !empty($password) && !empty($userId)) {
            $adb->pquery('INSERT INTO ' . $this->user_table . '(userid, username,password,createdon) VALUES(?,?,?,?)', array($userId, $userName, $password, date('Y-m-d H:i:s')));
        }
    }

    /**
     * @param $userName
     * @param $password
     * @return array
     */
    public function login($userName, $password)
    {
        try {
            $_SESSION[$this->identifier_name . '_username'] = $userName;
            $_SESSION[$this->identifier_name . '_password'] = $password;

            $this->auth = $this->api('/customer/profile', 'GET', '', true);

            if ($this->auth) {
                $this->persistLogin($this->auth['email'], $this->auth['password'], $this->auth['account']);
            }

            return array('success' => true, 'result' => $this->auth);
        } catch (Exception $ex) {
            $_SESSION[$this->identifier_name . '_username'] = null;
            $_SESSION[$this->identifier_name . '_password'] = null;
            $exceptionMessage = $ex->getMessage();
            if (empty($exceptionMessage)) {
                $error = vtranslate('LBL_UNAUTHORIZED', 'Settings:ExtensionStore');
            } else {
                $error = $exceptionMessage;
            }

            return array('success' => false, 'error' => $error);
        }
    }

    /**
     * @param $customerId
     * @return array
     */
    public function getCustomerDetails($customerId)
    {
        try {
            $response = $this->api("/app/customer?id=$customerId", 'GET', '', true);
            return array('success' => true, 'result' => $response);
        } catch (Exception $ex) {
            return array('success' => false, 'error' => $ex->getMessage());
        }
    }

    /**
     * @param $module_name
     * @param $license_key
     * @return array
     */
    public function getCustomerLicenseData($module_name, $license_key)
    {
        $q = array('m' => $module_name, 'l' => $license_key, 'i' => $_SERVER["REMOTE_ADDR"], 'application_key' => vglobal('application_unique_key'));

        try {
            $response = $this->api('/customer/license', 'GET', $q ? array('q' => Zend_Json::encode($q)) : null, true);
            $result = array('success' => true, 'response' => $response);
            $this->customerLicenseData[$module_name][$license_key] = $result;
            return $result;
        } catch (Exception $ex) {
            return array('success' => false, 'error' => $ex->getMessage());
        }
    }

    /**
     * @return bool
     */
    protected function getPersistenceStatus()
    {
        $db = PearDatabase::getInstance();
        $result = $db->pquery('SELECT 1 FROM ' . $this->user_table, array());
        if ($db->num_rows($result)) {
            return true;
        }
        return false;
    }

    public function getChangeLog($data)
    {
        $q = array('m' => $data['moduleName'], 'cv' => $data['currentVersion'], 'uv' => $data['updateVersion']);

        try {
            $url = $data['url'] . '/app/changelog/v1?q=' . Zend_Json::encode($q);

            return $this->api($url, 'DLD', '', true);
        } catch (Exception $ex) {
            return array('success' => false, 'error' => $ex->getMessage());
        }
    }

    /**
     * @param array $data
     * @return array
     */
    public function getHostingInfo($data)
    {
        $q = array(
            'q' => Zend_Json::encode($data)
        );

        try {
            return $this->api('/app/hosting', 'GET', $q, true);
        } catch (Exception $ex) {
            return array('success' => false, 'error' => $ex->getMessage());
        }
    }

    /**
     * @param array $data
     * @return array
     */
    public function updateUsedCount($data)
    {
        $data = array('li' => $data['license_id'], 'uc' => $data['used_count'], 'uct' => $data['used_count_type']);
        $q = array(
            'q' => Zend_Json::encode($data)
        );

        try {
            return $this->api('/customer/license/update/v1/', 'GET', $q, true);
        } catch (Exception $ex) {
            return array('success' => false, 'error' => $ex->getMessage());
        }
    }
}
