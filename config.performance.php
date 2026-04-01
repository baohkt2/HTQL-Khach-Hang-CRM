<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/
// Load env.loader.php if not already loaded (for standalone cron scripts)
if (!function_exists('env')) {
	@include_once(dirname(__FILE__) . '/env.loader.php');
}

/* Performance paramters can be configured to fine tune vtiger CRM runtime */
$PERFORMANCE_CONFIG = Array(
	// Enable Vtiger Log Level for debugging only if requried 
	'LOGLEVEL_DEBUG' => false,

	// Should the caller information be captured in SQL Logging?
	// It adds little overhead for performance but will be useful to debug
	'SQL_LOG_INCLUDE_CALLER' => false,

	// If database default charset is UTF-8, set this to true 
	// This avoids executing the SET NAMES SQL for each query!
	'DB_DEFAULT_CHARSET_UTF8' => true,

	// Turn-off default sorting in ListView, could eat up time as data grows
	'LISTVIEW_DEFAULT_SORTING' => false,

	// Compute list view record count while loading listview everytime.
	// Recommended value false
	'LISTVIEW_COMPUTE_PAGE_COUNT' => false,

	// Control DetailView Record Navigation
	'DETAILVIEW_RECORD_NAVIGATION' => true,

	// To control the Email Notifications being sent to the Owner
	'NOTIFY_OWNER_EMAILS' => true,		//By default it is set to true, if it is set to false, then notifications will not be sent
	// reduce number of ajax requests on home page, reduce this value if home page widget dont
	// show value.
	'HOME_PAGE_WIDGET_GROUP_SIZE' => 40,

	'SMARTY_CACHING' => true, 
  
  // Default PHP max_execution_time is typically 30s which is too low for bulk ops.
	'BULK_OPERATION_MAX_EXECUTION_TIME' => 300,
	
	// Maximum memory limit for bulk operations (e.g. '512M', '1024M')
	'BULK_OPERATION_MEMORY_LIMIT' => '4096M',

	// Session inactivity timeout (seconds) for Login History cleanup.
	// Sessions with no activity for longer than this will be marked 'Session expired'.
	// Read from .env SESSION_INACTIVITY_TIMEOUT, default: 1800 (30 minutes)
	'SESSION_INACTIVITY_TIMEOUT' => function_exists('env') ? (int) env('SESSION_INACTIVITY_TIMEOUT', 1800) : 1800,

	// PHP session garbage collection max lifetime (seconds).
	// Read from .env SESSION_GC_MAXLIFETIME, default: 1440 (24 minutes)
	'SESSION_GC_MAXLIFETIME' => function_exists('env') ? (int) env('SESSION_GC_MAXLIFETIME', 1440) : 1440,

	// Client-side heartbeat interval (seconds, exported as JS config).
	// Read from .env HEARTBEAT_INTERVAL, default: 300 (5 minutes)
	'HEARTBEAT_INTERVAL' => function_exists('env') ? (int) env('HEARTBEAT_INTERVAL', 300) : 300,

	// Client-side inactivity limit (seconds) after which heartbeat stops.
	// Read from .env CLIENT_INACTIVITY_LIMIT, default: 1800 (30 minutes)
	'CLIENT_INACTIVITY_LIMIT' => function_exists('env') ? (int) env('CLIENT_INACTIVITY_LIMIT', 1800) : 1800,
);
?>
