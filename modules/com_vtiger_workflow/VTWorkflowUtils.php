<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/

//A collection of util functions for the workflow module

class VTWorkflowUtils {
	static $userStack;
	static $loggedInUser;

	public static function decodeUnicodeEscapes($value) {
		if (is_array($value)) {
			foreach ($value as $key => $item) {
				$value[$key] = self::decodeUnicodeEscapes($item);
			}
			return $value;
		}

		if (!is_string($value) || strpos($value, '\\u') === false) {
			return $value;
		}

		$value = preg_replace_callback(
			'/\\\\u(d[89ab][0-9a-f]{2})\\\\u(d[cdef][0-9a-f]{2})/i',
			array(__CLASS__, 'decodeUnicodeSurrogatePair'),
			$value
		);

		$value = preg_replace_callback(
			'/\\\\u([0-9a-f]{4})/i',
			array(__CLASS__, 'decodeUnicodeCodePoint'),
			$value
		);

		return self::normalizeVietnameseUnicode($value);
	}

	public static function normalizeVietnameseUnicode($value) {
		if (!is_string($value) || strpos($value, "\xCC") === false && strpos($value, "\xE1") === false && strpos($value, "\xC3") === false && strpos($value, "\xC6") === false && strpos($value, "\xC4") === false) {
			return $value;
		}

		$baseNormalizationMap = array(
			"a\u{0306}" => 'ă', "A\u{0306}" => 'Ă',
			"a\u{0302}" => 'â', "A\u{0302}" => 'Â',
			"e\u{0302}" => 'ê', "E\u{0302}" => 'Ê',
			"o\u{0302}" => 'ô', "O\u{0302}" => 'Ô',
			"o\u{031B}" => 'ơ', "O\u{031B}" => 'Ơ',
			"u\u{031B}" => 'ư', "U\u{031B}" => 'Ư',
		);

		$toneNormalizationMap = array(
			"a\u{0300}" => 'à', "a\u{0301}" => 'á', "a\u{0309}" => 'ả', "a\u{0303}" => 'ã', "a\u{0323}" => 'ạ',
			"A\u{0300}" => 'À', "A\u{0301}" => 'Á', "A\u{0309}" => 'Ả', "A\u{0303}" => 'Ã', "A\u{0323}" => 'Ạ',
			"ă\u{0300}" => 'ằ', "ă\u{0301}" => 'ắ', "ă\u{0309}" => 'ẳ', "ă\u{0303}" => 'ẵ', "ă\u{0323}" => 'ặ',
			"Ă\u{0300}" => 'Ằ', "Ă\u{0301}" => 'Ắ', "Ă\u{0309}" => 'Ẳ', "Ă\u{0303}" => 'Ẵ', "Ă\u{0323}" => 'Ặ',
			"â\u{0300}" => 'ầ', "â\u{0301}" => 'ấ', "â\u{0309}" => 'ẩ', "â\u{0303}" => 'ẫ', "â\u{0323}" => 'ậ',
			"Â\u{0300}" => 'Ầ', "Â\u{0301}" => 'Ấ', "Â\u{0309}" => 'Ẩ', "Â\u{0303}" => 'Ẫ', "Â\u{0323}" => 'Ậ',
			"e\u{0300}" => 'è', "e\u{0301}" => 'é', "e\u{0309}" => 'ẻ', "e\u{0303}" => 'ẽ', "e\u{0323}" => 'ẹ',
			"E\u{0300}" => 'È', "E\u{0301}" => 'É', "E\u{0309}" => 'Ẻ', "E\u{0303}" => 'Ẽ', "E\u{0323}" => 'Ẹ',
			"ê\u{0300}" => 'ề', "ê\u{0301}" => 'ế', "ê\u{0309}" => 'ể', "ê\u{0303}" => 'ễ', "ê\u{0323}" => 'ệ',
			"Ê\u{0300}" => 'Ề', "Ê\u{0301}" => 'Ế', "Ê\u{0309}" => 'Ể', "Ê\u{0303}" => 'Ễ', "Ê\u{0323}" => 'Ệ',
			"i\u{0300}" => 'ì', "i\u{0301}" => 'í', "i\u{0309}" => 'ỉ', "i\u{0303}" => 'ĩ', "i\u{0323}" => 'ị',
			"I\u{0300}" => 'Ì', "I\u{0301}" => 'Í', "I\u{0309}" => 'Ỉ', "I\u{0303}" => 'Ĩ', "I\u{0323}" => 'Ị',
			"o\u{0300}" => 'ò', "o\u{0301}" => 'ó', "o\u{0309}" => 'ỏ', "o\u{0303}" => 'õ', "o\u{0323}" => 'ọ',
			"O\u{0300}" => 'Ò', "O\u{0301}" => 'Ó', "O\u{0309}" => 'Ỏ', "O\u{0303}" => 'Õ', "O\u{0323}" => 'Ọ',
			"ô\u{0300}" => 'ồ', "ô\u{0301}" => 'ố', "ô\u{0309}" => 'ổ', "ô\u{0303}" => 'ỗ', "ô\u{0323}" => 'ộ',
			"Ô\u{0300}" => 'Ồ', "Ô\u{0301}" => 'Ố', "Ô\u{0309}" => 'Ổ', "Ô\u{0303}" => 'Ỗ', "Ô\u{0323}" => 'Ộ',
			"ơ\u{0300}" => 'ờ', "ơ\u{0301}" => 'ớ', "ơ\u{0309}" => 'ở', "ơ\u{0303}" => 'ỡ', "ơ\u{0323}" => 'ợ',
			"Ơ\u{0300}" => 'Ờ', "Ơ\u{0301}" => 'Ớ', "Ơ\u{0309}" => 'Ở', "Ơ\u{0303}" => 'Ỡ', "Ơ\u{0323}" => 'Ợ',
			"u\u{0300}" => 'ù', "u\u{0301}" => 'ú', "u\u{0309}" => 'ủ', "u\u{0303}" => 'ũ', "u\u{0323}" => 'ụ',
			"U\u{0300}" => 'Ù', "U\u{0301}" => 'Ú', "U\u{0309}" => 'Ủ', "U\u{0303}" => 'Ũ', "U\u{0323}" => 'Ụ',
			"ư\u{0300}" => 'ừ', "ư\u{0301}" => 'ứ', "ư\u{0309}" => 'ử', "ư\u{0303}" => 'ữ', "ư\u{0323}" => 'ự',
			"Ư\u{0300}" => 'Ừ', "Ư\u{0301}" => 'Ứ', "Ư\u{0309}" => 'Ử', "Ư\u{0303}" => 'Ữ', "Ư\u{0323}" => 'Ự',
			"y\u{0300}" => 'ỳ', "y\u{0301}" => 'ý', "y\u{0309}" => 'ỷ', "y\u{0303}" => 'ỹ', "y\u{0323}" => 'ỵ',
			"Y\u{0300}" => 'Ỳ', "Y\u{0301}" => 'Ý', "Y\u{0309}" => 'Ỷ', "Y\u{0303}" => 'Ỹ', "Y\u{0323}" => 'Ỵ',
		);

		$value = strtr($value, $baseNormalizationMap);
		return strtr($value, $toneNormalizationMap);
	}

	public static function decodeUnicodeCodePoint($matches) {
		return html_entity_decode('&#' . hexdec($matches[1]) . ';', ENT_NOQUOTES, 'UTF-8');
	}

	public static function decodeUnicodeSurrogatePair($matches) {
		$high = hexdec($matches[1]);
		$low = hexdec($matches[2]);
		$codePoint = (($high - 0xD800) << 10) + ($low - 0xDC00) + 0x10000;

		return html_entity_decode('&#' . $codePoint . ';', ENT_NOQUOTES, 'UTF-8');
	}

	function __construct() {
		global $current_user;
		if(empty(self::$userStack)) {
			self::$userStack = array();
		}
	}

	/**
	 * Check whether the given identifier is valid.
	 */
	function validIdentifier($identifier) {
		if (is_string($identifier)) {
			return preg_match("/^[a-zA-Z][a-zA-Z_0-9]+$/", $identifier);
		} else {
			return false;
		}
	}

	/**
	 * Push the admin user on to the user stack
	 * and make it the $current_user
	 *
	 */
	function adminUser() {
        $user = Users::getActiveAdminUser();
		global $current_user;
		if (empty(self::$userStack) || php7_count(self::$userStack) == 0) {
			self::$loggedInUser = $current_user;
		}
		array_push(self::$userStack, $current_user);
		$current_user = $user;
		return $user;
	}

	/**
	 * Push the logged in user on the user stack
	 * and make it the $current_user
	 */
	function loggedInUser() {
		$user = self::$loggedInUser;
		global $current_user;
		array_push(self::$userStack, $current_user);
		$current_user = $user;
		return $user;
	}

	/**
	 * Revert to the previous use on the user stack
	 */
	function revertUser() {
		global $current_user;
		if (php7_count(self::$userStack) != 0) {
			$current_user = array_pop(self::$userStack);
		} else {
			$current_user = null;
		}
		return $current_user;
	}

	/**
	 * Get the current user
	 */
	function currentUser() {
		return $current_user;
	}

	/**
	 * The the webservice entity type of an EntityData object
	 */
	function toWSModuleName($entityData) {
		$moduleName = $entityData->getModuleName();
		if ($moduleName == 'Activity') {
			$arr = array('Task' => 'Calendar', 'Emails' => 'Emails');
			$moduleName = $arr[getActivityType($entityData->getId())];
			if ($moduleName == null) {
				$moduleName = 'Events';
			}
		}
		return $moduleName;
	}

	/**
	 * Insert redirection script
	 */
	function redirectTo($to, $message) {
?>
		<script type="text/javascript" charset="utf-8">
			window.location="<?php echo $to ?>";
		</script>
		<a href="<?php echo $to ?>"><?php echo $message ?></a>
<?php
	}

	/**
	 * Check if the current user is admin
	 */
	function checkAdminAccess() {
		global $current_user;
		return strtolower($current_user->is_admin) === 'on';
	}

	/* function to check if the module has workflow
	 * @params :: $modulename - name of the module
	 */

	public static function checkModuleWorkflow($modulename) {
		$result = true;
		if (in_array($modulename, array('Emails', 'Faq', 'PBXManager', 'Users')) || !getTabid($modulename)) {
			$result = false;
		}
		return $result;
	}

	function vtGetModules($adb) {
		$modules_not_supported = array('Emails', 'PBXManager');
		$sql = "select distinct vtiger_field.tabid, name
			from vtiger_field
			inner join vtiger_tab
				on vtiger_field.tabid=vtiger_tab.tabid
			where vtiger_tab.name not in(" . generateQuestionMarks($modules_not_supported) . ") and vtiger_tab.isentitytype=1 and vtiger_tab.presence in (0,2) ";
		$it = new SqlResultIterator($adb, $adb->pquery($sql, array($modules_not_supported)));
		$modules = array();
		foreach ($it as $row) {
			$modules[] = $row->name;
		}
		return $modules;
	}
}