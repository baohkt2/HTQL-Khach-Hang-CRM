<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/
require_once "modules/Oauth2/Config.php";

class Oauth2_Usercallback_Callbacks {

    protected static function ensureLogin($requireAdmin=false) {
        if (!isset($_SESSION['authenticated_user_id']) || empty($_SESSION['authenticated_user_id'])) {
            static::redirectToCRM();
            return;
        } else {
            global $current_user;
            $current_user = CRMEntity::getInstance('Users');
            $current_user->retrieveCurrentUserInfoFromFile($_SESSION['authenticated_user_id']);

            if ($requireAdmin) {
                if (!filter_var($current_user->is_admin, FILTER_VALIDATE_BOOLEAN)) {
                    static::redirectToCRM();
                    return;
                }
            }
        }
    }

    protected static function redirectToCRM() {
        global $site_URL;
        header (sprintf("Location: %s/index.php", trim($site_URL, '/')));
        exit;
    }

    public static function handleRequest($config, $req) {
        if (isset($req["error"]) && !empty($req["error"])) {
            echo htmlspecialchars($_REQUEST['error'], ENT_QUOTES, 'UTF-8');
            exit;
        }

        session_start();
        
        // Ensure Right User.
        // callback is done against externally service. Successfully login does not mean rights to change CRM state.
        // Example: Non-admin should not be able alter unexpected system configuration
        // with direct visit to the oauth2callback when auth is for specifically CRM admin only.
        $authfor = (isset($req['authfor'])) ? $req['authfor'] : (isset($_SESSION['oauth2for']) ? $_SESSION['oauth2for'] : "");
        switch($authfor) {
            case "OutgoingServer":
                static::ensureLogin(true);
                break;
            case "MailConverter":
                static::ensureLogin(true);
                break;
            case "MailManager":
                static::ensureLogin();
                break;
            default:
                static::ensureLogin(true);
                break;
        }

        $authsvc = (isset($req['authservice'])) ? $req['authservice'] : (isset($_SESSION['oauth2svc']) ? $_SESSION['oauth2svc'] : "");
        $authcfg = $config->getProviderConfig($authsvc);
        if (!$authcfg) {
            echo "Unknown service provider";
            exit;
        }
        
        if (empty($authcfg["clientId"]) || empty($authcfg["clientSecret"])) {
            echo "Please setup configuration.";
            exit;
        }

        $provider = new \League\OAuth2\Client\Provider\GenericProvider($authcfg);

        if (!isset($req['code'])) {
            // step 1
            $authurl = $provider->getAuthorizationUrl(['access_type' => 'offline',  
                'prompt' => 'consent']); /* this will force login each-time so refresh-token is obtained */
            $_SESSION['oauth2state'] = $provider->getState();
            $_SESSION['oauth2for'] = isset($req['authfor']) ? $req['authfor'] : "";
            $_SESSION['oauth2svc'] = isset($req['authservice']) ? $req['authservice'] : "";

            // For Google oAuth (prompt is used instead of approval_prompt) which otherwise
            // will end up with bad-request due to conflict.
            $authurl = str_replace("approval_prompt=auto", "", $authurl);

            header ("Location: $authurl");
            exit;
        } else if (isset($req['state']) && isset($_SESSION['oauth2state']) && $req['state'] != $_SESSION['oauth2state']) {
            // something wrong
            unset($_SESSION['oauth2state']);
            echo ("Invalid state");
            exit;
        } else {
            // state is good, use code
            try {

                $accessToken = $provider->getAccessToken(
                    "authorization_code", ["code" => $req["code"]]
                );

                // We have an access token, which we may use in authenticated
                // requests against the service provider's API.
                $accessTokenValue = $accessToken->getToken();
                $refreshTokenValue = $accessToken->getRefreshToken();
                $accessTokenExpiresOn = $accessToken->getExpires();
               
                $resourceOwner = $provider->getResourceOwner($accessToken);
                $userinfo = $resourceOwner ? $resourceOwner->toArray() : null;

                $oauth2for = isset($_SESSION['oauth2for']) ? $_SESSION['oauth2for'] : "";
                $oauth2svc = isset($_SESSION['oauth2svc']) ? $_SESSION['oauth2svc'] : "";

                if ($userinfo["email"] && $userinfo["email_verified"]) {
                    $tokens = array("access_token" => $accessTokenValue, "refresh_token" => $refreshTokenValue);
                    static::updateTokensFor($config, $oauth2for, $oauth2svc, $userinfo, $tokens, $accessTokenExpiresOn);
                }


                unset($_SESSION['oauth2for']);
                unset($_SESSION['oauth2state']);
                unset($_SESSION['oauth2svc']);

                global $site_URL;
                $crmBaseUrl = trim($site_URL, '/');

                switch ($oauth2for) {
                    case "OutgoingServer":
                        header("Location: {$crmBaseUrl}/index.php?parent=Settings&module=Vtiger&view=OutgoingServerDetail");
                        break;
                    case "MailConverter":
                        header("Location: {$crmBaseUrl}/index.php?parent=Settings&module=MailConverter&view=List");
                        break;
                    case "MailManager":
                        header("Location: {$crmBaseUrl}/index.php?module=MailManager&view=List");
                        break;
                }

            } catch(Exception $e) {
                unset($_SESSION['oauth2for']);
                unset($_SESSION['oauth2state']);
                unset($_SESSION['oauth2svc']);

                header('Content-type: text/plain');
                echo $e->getMessage();
                echo $e->getTraceAsString();
                exit;
            }
        }
    }

    protected static function updateTokensFor($config, $oauth2for, $oauth2svc, $userinfo, $tokens, $expireson) {
        $db = PearDatabase::getInstance();

        if ($oauth2for == "OutgoingServer") {
            $checkRs = $db->pquery("select 1 from vtiger_systems where server_type = ? limit 1", array("email"));

            $server = "";
            $port = "";
            if (strcasecmp($oauth2svc, "Google") === 0) {
                $port = 465;
                $server = "ssl://smtp.gmail.com:$port";
            }
            
            if ($db->num_rows($checkRs)) {
                $db->pquery("update vtiger_systems set server = ?, server_port = ?, server_username = ?, server_password = ?, smtp_auth = ?, smtp_auth_type = ?, smtp_auth_expireson = ? where server_type = ?",
                    array(
                        $server,
                        $port,
                        $userinfo["email"],
                        Vtiger_Functions::toProtectedText(json_encode($tokens)),
                        1,
                        "XOAUTH2",
                        $expireson,
                        "email"
                    )
                );
            } else {
                $db->pquery("insert into vtiger_systems (id, server, server_port, server_username, server_password, smtp_auth, smtp_auth_type, smtp_auth_expireson, server_type) values (?, ?, ?, ?, ?, ?, ?, ?, ?)",
                    array(
                        $db->getUniqueID("vtiger_systems"),
                        $server,
                        $port,
                        $userinfo["email"],
                        Vtiger_Functions::toProtectedText(json_encode($tokens)),
                        1,
                        "XOAUTH2",
                        $expireson,
                        "email"
                    )
                );
            }
        } else if ($oauth2for == "MailConverter") {
            require_once "modules/Settings/MailConverter/handlers/MailScannerInfo.php";

            $server = strcasecmp($oauth2svc, "Google") === 0? "imap.gmail.com" : "";
            $proxy  = $server && isset($config["Proxies"]) && isset($config["Proxies"][$server])? $config["Proxies"][$server] : "";

            $scanner = new Vtiger_MailScannerInfo(sprintf("%f",microtime(true)));
            $scanner->scannername = $server;
            $scanner->server = $server;
            $scanner->protocol = "imap4";
            $scanner->authtype = "XOAUTH2";
            $scanner->authexpireson = $expireson;
            $scanner->mailproxy = $proxy;
            $scanner->username = $userinfo["email"];
            $scanner->password = json_encode($tokens);
            $scanner->ssltype  = "ssl";
            $scanner->sslmethod = "validate-cert";
            $scanner->isvalid = 1;

            $oldscanner = new Vtiger_MailScannerInfo($scanner->scannername, true);
            $oldscanner->update($scanner);


        } else if ($oauth2for == "MailManager") {

            require_once "modules/MailManager/models/Mailbox.php";

            $server = strcasecmp($oauth2svc, "Google") === 0? "imap.gmail.com" : "";
            $proxy  = $server && isset($config["Proxies"]) && isset($config["Proxies"][$server])? $config["Proxies"][$server] : "";

            if ($server) {
                $mailbox = MailManager_Mailbox_Model::activeInstance();
                $mailbox->setUsername($userinfo["email"]);
                $mailbox->setServer($server);
                $mailbox->setPassword(json_encode($tokens));
                $mailbox->setAuthType("XOAUTH2");
                $mailbox->setAuthExpiresOn($expireson);
                $mailbox->setProtocol("IMAP4");
                $mailbox->setFolder("INBOX");
                $mailbox->setCertValidate(false);
                $mailbox->setSSLType("SSL");
                if ($proxy) $mailbox->setMailProxy($proxy);
                $mailbox->save();
            }
        }
    }

}
