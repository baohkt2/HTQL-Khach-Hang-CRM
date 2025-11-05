<?php
/*********************************************************************************
 * Vtiger CRM Config for XAMPP (Windows)
 ********************************************************************************/

// Adjust error_reporting favourable to deployment.
version_compare(PHP_VERSION, '5.5.0') <= 0
    ? error_reporting(E_WARNING & ~E_NOTICE & ~E_DEPRECATED & E_ERROR)
    : error_reporting(E_WARNING & ~E_NOTICE & ~E_DEPRECATED  & E_ERROR & ~E_STRICT);

include('vtigerversion.php');

// Increase memory for PHP
ini_set('memory_limit','2048M');

// Enable calendar & RTE
$CALENDAR_DISPLAY = 'true';
$USE_RTE = 'true';

$log4phpDebug = 'true';

// Helpdesk support
$HELPDESK_SUPPORT_EMAIL_ID = 'support@example.com';
$HELPDESK_SUPPORT_NAME = 'Vtiger Support';
$HELPDESK_SUPPORT_EMAIL_REPLY_ID = $HELPDESK_SUPPORT_EMAIL_ID;

/* Database configuration */
$dbconfig['db_server']   = 'localhost';      // XAMPP chạy MySQL trên localhost
$dbconfig['db_port']     = ':3306';          // cổng mặc định MySQL
$dbconfig['db_username'] = 'root';           // user mặc định của XAMPP
$dbconfig['db_password'] = '';               // để trống nếu chưa set password
$dbconfig['db_name']     = 'vtiger';  // đổi thành tên database bạn import
$dbconfig['db_type']     = 'mysqli';
$dbconfig['db_status']   = 'true';

// Compose hostname for db
$dbconfig['db_hostname'] = $dbconfig['db_server'].$dbconfig['db_port'];

// SQL log
$dbconfig['log_sql'] = false;

// DB options
$dbconfigoption['persistent'] = true;
$dbconfigoption['autofree'] = false;
$dbconfigoption['debug'] = 0;
$dbconfigoption['seqname_format'] = '%s_seq';
$dbconfigoption['portability'] = 0;
$dbconfigoption['ssl'] = false;

$host_name = $dbconfig['db_hostname'];

// Site URL (đường dẫn khi truy cập qua trình duyệt)

// $site_URL = 'http://localhost/vtigercrm';
$site_URL = 'http://22cfa3799017.ngrok-free.app/vtigercrm';
// Customer portal URL
$PORTAL_URL = $site_URL.'/customerportal';

// Root directory trên Windows (chú ý dùng / thay vì \)
$root_directory = 'C:/xampp/htdocs/vtigercrm/';

// Cache / tmp / upload dirs
$cache_dir = 'cache/';
$tmp_dir = 'cache/images/';
$import_dir = 'cache/import/';
$upload_dir = 'cache/upload/';
$upload_maxsize = 31457280; // 3MB

// Export rules
$allow_exports = 'all'; 

// Disallowed extensions
$upload_badext = array(
    'php','php3','php4','php5','pl','cgi','py','asp','cfm','js','vbs',
    'html','htm','exe','bin','bat','sh','dll','phps','phtml','xhtml',
    'rb','msi','jsp','shtml','sth','shtm','htaccess','phar'
);

// UI configs
$list_max_entries_per_page = '40';
$history_max_viewed = '5';
$default_action = 'index';
$default_theme = 'softed';

// Default user credentials (leave empty)
$default_user_name = 'admin';
$default_password = 'admin';
$create_default_user = true;

// Localization
$currency_name = 'Vietnam, Dong';
$default_charset = 'UTF-8';
$default_language = 'en_us';
$display_empty_home_blocks = false;
$disable_stats_tracking = false;

// Application key (có thể để nguyên hoặc regenerate)
$application_unique_key = '40709172e88b8f6c672bc88408891a3b';

// Misc
$listview_max_textlength = '40';
$php_max_execution_time = 600;
$default_timezone = 'UTC';

// Set default timezone
if(isset($default_timezone) && function_exists('date_default_timezone_set')) {
    @date_default_timezone_set($default_timezone);
}

// Default layout
$default_layout = 'v7';
$maxListFieldsSelectionSize ='40';

include_once 'config.security.php';
?>
