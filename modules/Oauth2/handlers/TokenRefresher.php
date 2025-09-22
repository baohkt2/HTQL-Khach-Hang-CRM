<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/

require_once "include/utils/encryption.php";
require_once "modules/Oauth2/Config.php";

class Oauth2_TokenRefresher_Handler {

    public function refreshAll() {
        $cfgfile = "oauth2callback/config.oauth2.php";
        if (!file_exists($cfgfile)) {
            return;
        }

        $cfgdata = require_once $cfgfile;
        $config = Oauth2_Config::loadConfig($cfgdata);

        $now = time();
        $this->refreshOutgoingServer($config, $now);
        $this->refreshMailConverter($config, $now);
        $this->refreshMailManager($config, $now);
    }

    protected function refreshOutgoingServer($config, $expiredon) {
        $db = PearDatabase::getInstance();
        $rs = $db->pquery("SELECT * FROM vtiger_systems where server_type=? AND smtp_auth_type = ? AND smtp_auth_expireson <=?", 
            array('email', 'XOAUTH2', $expiredon));
        if ($db->num_rows($rs)) {
            $record = $db->fetch_array($rs);
            $tokens = json_decode(Vtiger_Functions::fromProtectedText(decode_html($record['server_password'])), true);
            if (isset($tokens['refresh_token'])) {
                $svc = null;
                if (stripos($record["server"], "smtp.gmail.com") !== false) {
                    $svc = "Google";
                } else {
                    return;
                }

                try {
                    $cfg = $config->getProviderConfig($svc);
                    $provider = new \League\OAuth2\Client\Provider\GenericProvider($cfg);
                    
                    $access_token = $provider->getAccessToken('refresh_token', [
                        'refresh_token' => $tokens['refresh_token']
                    ]);

                    $tokens['access_token'] = $access_token->getToken();

                    $newexpireson = $access_token->getExpires();
                    $newpassword = Vtiger_Functions::toProtectedText(json_encode($tokens));

                    $db->pquery("UPDATE vtiger_systems SET password=?, auth_expireson=? WHERE id=?", 
                        array($newpassword, $newexpireson, $record['id']));

                    echo sprintf("Updated Token for OutgoingServer #%d [%s]\n", $record["id"], $record["server_username"]);
                } catch(Exception $e) {
                    echo sprintf("Failed to get access token for OutgoingServer #%d [%s]\n", $record["scannerid"], $record["server_username"]);
                    echo $e->getMessage(). "\n";
                }
            }
        }
    }

    protected function refreshMailConverter($config, $expiredon) {
        $db = PearDatabase::getInstance();
        $rs = $db->pquery("SELECT * FROM vtiger_mailscanner WHERE isvalid=1 AND auth_type=? AND auth_expireson <=?", 
            array('XOAUTH2', $expiredon));
        while ($record = $db->fetch_array($rs)) {
            $e = new Encryption();
		    $tokens = json_decode($e->decrypt(decode_html($record['password'])), true);
            if (isset($tokens['refresh_token'])) {
                $svc = null;
                switch($record["server"]) {
                    case "imap.gmail.com": $svc = "Google"; break;
                    default: continue;
                }
                try {
                    $cfg = $config->getProviderConfig($svc);
                    $provider = new \League\OAuth2\Client\Provider\GenericProvider($cfg);
                    
                    $access_token = $provider->getAccessToken('refresh_token', [
                        'refresh_token' => $tokens['refresh_token']
                    ]);

                    $tokens['access_token'] = $access_token->getToken();

                    $newexpireson = $access_token->getExpires();
                    $newpassword = $e->encrypt(json_encode($tokens));

                    $db->pquery("UPDATE vtiger_mailscanner SET password=?, auth_expireson=? WHERE scannerid=?", 
                        array($newpassword, $newexpireson, $record['scannerid']));

                    echo sprintf("Updated Token for MailConverter #%d [%s]\n", $record["scannerid"], $record["username"]);
                } catch(Exception $e) {
                    echo sprintf("Failed to get access token for MailConverter #%d [%s]\n", $record["scannerid"], $record["username"]);
                    echo $e->getMessage(). "\n";
                }
            }
        }
    }

    protected function refreshMailManager($config, $expiredon) {
        $db = PearDatabase::getInstance();
        $rs = $db->pquery("SELECT * FROM vtiger_mail_accounts WHERE status=1 AND auth_type=? AND auth_expireson <=?", 
            array('XOAUTH2', $expiredon));
        while ($record = $db->fetch_array($rs)) {
            $e = new Encryption();
		    $tokens = json_decode($e->decrypt(decode_html($record['mail_password'])), true);
            if (isset($tokens['refresh_token'])) {
                $svc = null;
                switch($record["mail_servername"]) {
                    case "imap.gmail.com": $svc = "Google"; break;
                    default: continue;
                }
                try {
                    $cfg = $config->getProviderConfig($svc);
                    $provider = new \League\OAuth2\Client\Provider\GenericProvider($cfg);
                    
                    $access_token = $provider->getAccessToken('refresh_token', [
                        'refresh_token' => $tokens['refresh_token']
                    ]);

                    $tokens['access_token'] = $access_token->getToken();

                    $newexpireson = $access_token->getExpires();
                    $newpassword = $e->encrypt(json_encode($tokens));

                    $db->pquery("UPDATE vtiger_mail_accounts SET mail_password=?, auth_expireson=? WHERE mail_username=? and account_id=? and user_id=?", 
                        array($newpassword, $newexpireson, $record['mail_username'], $record["account_id"], $record["user_id"]));

                    echo sprintf("Updated Token for MailManager #%d [%s]\n", $record["account_id"], $record["mail_username"]);
                } catch(Exception $e) {
                    echo sprintf("Failed to get access token for MailManager #%d [%s]\n", $record["account_id"], $record["mail_username"]);
                    echo $e->getMessage(). "\n";
                }
            }
        }
    }
}
