<?php
/*+***********************************************************************************
 * CUSC: "Mã khách hàng" (cf_1994) từ "Khóa học quan tâm" (cf_2030).
 * Lưu ý: vtiger_field.displaytype = 2 khiến CRMEntity không ghi field xuống DB — dùng 1 + readonly.
 *************************************************************************************/

require_once 'include/events/VTEventHandler.inc';
require_once 'include/events/VTEntityData.inc';

class ContactCustomerCodeHandler extends VTEventHandler {

	const FIELD_CUSTOMER_CODE = 'cf_1994';
	const FIELD_INTERESTED_COURSE = 'cf_2030';

	public function handleEvent($eventName, $entityData) {
		if ($eventName !== 'vtiger.entity.beforesave' || !$entityData) {
			return;
		}
		if ($entityData->getModuleName() !== 'Contacts') {
			return;
		}
		ContactCustomerCodeLogic::applyToEntityData($entityData);
	}
}

/**
 * Logic dùng chung cho handler và backfill CLI.
 */
class ContactCustomerCodeLogic {

	/**
	 * @param VTEntityData $entityData
	 */
	public static function applyToEntityData($entityData) {
		$courseRaw = $entityData->get(ContactCustomerCodeHandler::FIELD_INTERESTED_COURSE);

		$recordId = $entityData->getId();
		$isNew = $entityData->isNew() || empty($recordId);

		$dbRow = null;
		if (!$isNew) {
			$dbRow = self::fetchContactscfRow((int) $recordId);
		}

		$ajaxField = isset($_REQUEST['field']) ? $_REQUEST['field'] : '';
		$isAjaxCourseEdit =
			isset($_REQUEST['action']) && $_REQUEST['action'] === 'SaveAjax'
			&& $ajaxField === ContactCustomerCodeHandler::FIELD_INTERESTED_COURSE;

		/*
		 * SaveAjax gán null cho field không có trong request — khôi phục cf_2030 từ DB.
		 * Chuỗi rỗng '' = user xóa khóa học (không fallback).
		 */
		if (!$isNew && !$isAjaxCourseEdit && $courseRaw === null && $dbRow && trim((string) $dbRow['cf_2030']) !== '') {
			$courseRaw = $dbRow['cf_2030'];
		}

		$course = self::normalizeCourseValue($courseRaw);

		$dbCourse = '';
		$dbCode = '';
		if ($dbRow) {
			$dbCourse = self::normalizeCourseValue(isset($dbRow['cf_2030']) ? $dbRow['cf_2030'] : '');
			$dbCode = isset($dbRow['cf_1994']) ? trim((string) $dbRow['cf_1994']) : '';
		}

		if ($course === '') {
			if (!$isNew) {
				$entityData->set(ContactCustomerCodeHandler::FIELD_CUSTOMER_CODE, '');
			}
			return;
		}

		$courseChanged = $isNew || ($dbCourse !== $course);
		$existingInForm = trim((string) $entityData->get(ContactCustomerCodeHandler::FIELD_CUSTOMER_CODE));
		$existingCode = $existingInForm !== '' ? $existingInForm : $dbCode;

		if (!$courseChanged && $existingCode !== '') {
			return;
		}

		$categoryDigit = self::mapCourseToCategoryDigit($course);
		if ($categoryDigit === null) {
			if ($courseChanged) {
				$entityData->set(ContactCustomerCodeHandler::FIELD_CUSTOMER_CODE, '');
			}
			return;
		}

		$year2 = (int) date('y');
		$seq = self::allocateNextSequence($year2, $categoryDigit);
		if ($seq <= 0 || $seq > 99999) {
			return;
		}

		$code = sprintf('%02d%d%05d', $year2, $categoryDigit, $seq);
		$entityData->set(ContactCustomerCodeHandler::FIELD_CUSTOMER_CODE, $code);
	}

	public static function generateAndSaveForContactId($contactId) {
		$contactId = (int) $contactId;
		if ($contactId <= 0) {
			return array('ok' => false, 'error' => 'invalid id');
		}

		$db = PearDatabase::getInstance();
		$row = self::fetchContactscfRow($contactId);
		if (!$row) {
			return array('ok' => false, 'error' => 'no row');
		}

		$course = self::normalizeCourseValue(isset($row['cf_2030']) ? $row['cf_2030'] : '');
		if ($course === '') {
			return array('ok' => false, 'skipped' => 'empty course');
		}

		$categoryDigit = self::mapCourseToCategoryDigit($course);
		if ($categoryDigit === null) {
			return array('ok' => false, 'skipped' => 'unmapped course');
		}

		$year2 = (int) date('y');
		$seq = self::allocateNextSequence($year2, $categoryDigit);
		if ($seq <= 0 || $seq > 99999) {
			return array('ok' => false, 'error' => 'sequence');
		}

		$code = sprintf('%02d%d%05d', $year2, $categoryDigit, $seq);
		$db->pquery(
			'UPDATE vtiger_contactscf SET cf_1994 = ? WHERE contactid = ?',
			array($code, $contactId)
		);

		return array('ok' => true, 'code' => $code, 'contactid' => $contactId);
	}

	protected static function fetchContactscfRow($contactId) {
		$db = PearDatabase::getInstance();
		$r = $db->pquery(
			'SELECT cf_2030, cf_1994 FROM vtiger_contactscf WHERE contactid = ?',
			array($contactId)
		);
		if ($r && $db->num_rows($r) > 0) {
			return $db->fetchByAssoc($r);
		}
		return null;
	}

	public static function normalizeCourseValue($raw) {
		if ($raw === null || $raw === '') {
			return '';
		}
		$s = decode_html((string) $raw);
		$s = trim(preg_replace('/\s+/u', ' ', strip_tags($s)));
		return $s;
	}

	/**
	 * @return int|null 0 Dài hạn, 1 Aptech, 2 Arena, 3 ACNPRO
	 */
	public static function mapCourseToCategoryDigit($course) {
		if ($course === '') {
			return null;
		}

		if (preg_match('/\bacn\s*pro\b/ui', $course) || preg_match('/^acnpro$/ui', trim($course))) {
			return 3;
		}
		if (mb_stripos($course, 'acnpro', 0, 'UTF-8') !== false) {
			return 3;
		}

		$lower = mb_strtolower($course, 'UTF-8');
		if ($lower === 'dài hạn') {
			return 0;
		}

		if (mb_stripos($course, 'aptech', 0, 'UTF-8') !== false) {
			return 1;
		}
		if (mb_stripos($course, 'cnpm', 0, 'UTF-8') !== false) {
			return 1;
		}

		if (mb_stripos($course, 'arena', 0, 'UTF-8') !== false) {
			return 2;
		}
		if (mb_stripos($course, 'mtđpt', 0, 'UTF-8') !== false || mb_stripos($course, 'mtdpt', 0, 'UTF-8') !== false) {
			return 2;
		}
		if (mb_stripos($course, 'hoạt hình', 0, 'UTF-8') !== false || mb_stripos($course, 'họat hình', 0, 'UTF-8') !== false) {
			return 2;
		}

		return null;
	}

	public static function allocateNextSequence($year2, $categoryDigit) {
		$db = PearDatabase::getInstance();
		$db->pquery(
			'INSERT INTO vtiger_cusc_contact_customer_code_seq (seq_year, category_digit, last_seq) VALUES (?, ?, 1)
			 ON DUPLICATE KEY UPDATE last_seq = LAST_INSERT_ID(last_seq + 1)',
			array($year2, $categoryDigit)
		);
		$r = $db->pquery('SELECT LAST_INSERT_ID() AS next_seq', array());
		$seq = 0;
		if ($r && $db->num_rows($r) > 0) {
			$seq = (int) $db->query_result($r, 0, 'next_seq');
		}
		if ($seq <= 0) {
			$r2 = $db->pquery(
				'SELECT last_seq FROM vtiger_cusc_contact_customer_code_seq WHERE seq_year = ? AND category_digit = ?',
				array($year2, $categoryDigit)
			);
			if ($r2 && $db->num_rows($r2) > 0) {
				$seq = (int) $db->query_result($r2, 0, 'last_seq');
			}
		}
		return $seq;
	}
}
