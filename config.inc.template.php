<?php
/*********************************************************************************
 * CUSC CRM - Configuration File Template
 * 
 * Copy file này thành config.inc.php và cấu hình file .env
 * KHÔNG chỉnh sửa trực tiếp file này cho production
 ********************************************************************************/

// Load environment variables
require_once('env.loader.php');

// Adjust error_reporting favourable to deployment.
if (env('DEBUG_MODE', false)) {
    ini_set('display_errors', 'on');
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT);
} else {
    version_compare(PHP_VERSION, '5.5.0') <= 0 
        ? error_reporting(E_WARNING & ~E_NOTICE & ~E_DEPRECATED & E_ERROR) 
        : error_reporting(E_WARNING & ~E_NOTICE & ~E_DEPRECATED & E_ERROR & ~E_STRICT);
}

include('vtigerversion.php');

// Memory limit
ini_set('memory_limit', '8096M');

// Display settings
$CALENDAR_DISPLAY = 'true';
$USE_RTE = 'true';

// Helpdesk support configuration (from .env)
$HELPDESK_SUPPORT_EMAIL_ID = env('HELPDESK_SUPPORT_EMAIL', 'support@example.com');
$HELPDESK_SUPPORT_NAME = env('HELPDESK_SUPPORT_NAME', 'CUSC Support');
$HELPDESK_SUPPORT_EMAIL_REPLY_ID = $HELPDESK_SUPPORT_EMAIL_ID;

/* Database configuration (from .env) */
$dbconfig['db_server'] = env('DB_SERVER', 'localhost');
$dbconfig['db_port'] = ':' . env('DB_PORT', '3306');
$dbconfig['db_username'] = env('DB_USERNAME', 'root');
$dbconfig['db_password'] = env('DB_PASSWORD', '');
$dbconfig['db_name'] = env('DB_NAME', 'cusc_db');
$dbconfig['db_type'] = env('DB_TYPE', 'mysqli');
$dbconfig['db_status'] = 'true';

$dbconfig['db_hostname'] = $dbconfig['db_server'] . $dbconfig['db_port'];
$dbconfig['log_sql'] = false;

// Database connection options
$dbconfigoption['persistent'] = true;
$dbconfigoption['autofree'] = false;
$dbconfigoption['debug'] = 0;
$dbconfigoption['seqname_format'] = '%s_seq';
$dbconfigoption['portability'] = 0;
$dbconfigoption['ssl'] = false;

$host_name = $dbconfig['db_hostname'];

// Site URL (from .env)
$site_URL = env('SITE_URL', 'http://localhost/cusc/');

// Portal URL
$PORTAL_URL = $site_URL . '/customerportal';

// Root directory (from .env)
$root_directory = env('ROOT_DIRECTORY', __DIR__ . '/');

// Cache directories
$cache_dir = 'cache/';
$tmp_dir = 'cache/images/';
$import_dir = 'cache/import/';
$upload_dir = 'cache/upload/';

// Upload settings
$upload_maxsize = 301457280; // 30MB
$allow_exports = 'all';
$upload_badext = array(
    'php', 'php3', 'php4', 'php5', 'pl', 'cgi', 'py', 'asp', 'cfm', 
    'js', 'vbs', 'html', 'htm', 'exe', 'bin', 'bat', 'sh', 'dll', 
    'phps', 'phtml', 'xhtml', 'rb', 'msi', 'jsp', 'shtml', 'sth', 
    'shtm', 'htaccess', 'phar'
);

// List view settings
$list_max_entries_per_page = '100';
$history_max_viewed = '100';

// Default settings
$default_action = 'index';
$default_theme = 'softed';

// Login form defaults (from .env - should be empty for production)
$default_user_name = env('DEFAULT_USER_NAME', '');
$default_password = env('DEFAULT_PASSWORD', '');
$create_default_user = false;

// Currency and locale
$currency_name = 'USA, Dollars';
$default_charset = 'UTF-8';
$default_language = 'en_us';

// Display settings
$display_empty_home_blocks = false;
$disable_stats_tracking = false;

// Application unique key (from .env - REQUIRED for security)
$application_unique_key = env('APPLICATION_UNIQUE_KEY', '');
if (empty($application_unique_key)) {
    // Fallback for development only - MUST set in .env for production
    $application_unique_key = md5(__DIR__ . 'cusc_default_key');
}

// List view settings
$listview_max_textlength = 100;
$php_max_execution_time = 6000;

// Timezone (from .env)
$default_timezone = env('DEFAULT_TIMEZONE', 'Asia/Ho_Chi_Minh');
if (isset($default_timezone) && function_exists('date_default_timezone_set')) {
    @date_default_timezone_set($default_timezone);
}

// Layout
$default_layout = 'v7';
$maxListFieldsSelectionSize = '100';

// Gmail IMAP Proxy (from .env)
$GMAIL_IMAP_PROXY = [
    'host' => env('GMAIL_IMAP_HOST', 'localhost'),
    'port' => (int) env('GMAIL_IMAP_PORT', 993),
    'ssl' => env('GMAIL_IMAP_SSL', true)
];

$MINIMUM_CRON_FREQUENCY = 1;

include_once 'config.security.php';
?>
