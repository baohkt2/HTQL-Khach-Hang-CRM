<?php
if (defined('VTIGER_UPGRADE')) {
    global $adb, $current_user;
    $db = PearDatabase::getInstance();

    // OutgoingServer
    $db->pquery("ALTER TABLE vtiger_systems ADD COLUMN smtp_auth_type VARCHAR(20) AFTER smtp_auth");
    $db->pquery("ALTER TABLE vtiger_systems ADD COLUMN smtp_auth_expireson LONG AFTER smtp_auth_type");

    // MailManager
    $db->pquery("ALTER TABLE vtiger_mail_accounts ADD COLUMN auth_type VARCHAR(20) AFTER mail_servername");
    $db->pquery("ALTER TABLE vtiger_mail_accounts ADD COLUMN auth_expireson LONG AFTER auth_type");
    $db->pquery("ALTER TABLE vtiger_mail_accounts ADD COLUMN mail_proxy VARCHAR(50) AFTER auth_expireson");

    // Register Cron for Oauth2
    require_once 'vtlib/Vtiger/Cron.php';
    Vtiger_Cron::register(
        "Oauth2TokenRefresher",
        "cron/modules/Oauth2/TokenRefresher.service",
        45 * 60, /* 45min - access_token expires usally in 3600 seconds = 1 hour */
        "Oauth2",
        1,
        0,
        "Recommended frequency for TokenRefresher is 45 mins"
    );

}
