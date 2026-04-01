<?php
/*+***********************************************************************************
 * CUSC: Auto-generate "Mã khách hàng" (cf_1994) from "Khóa học quan tâm" (cf_2030).
 * Format: YY + C + NNNNN (8 digits) e.g. 26000001 = year 2026, category 0 (Dài hạn), seq 1.
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
		$this->assignCustomerCodeIfNeeded($entityData);
	}

	/**
	 * @param VTEntityData $entityData
	 */
	protected function assignCustomerCodeIfNeeded($entityData) {
		$courseRaw = $entityData->get(self::FIELD_INTERESTED_COURSE);
		$course = $this->normalizeCourseValue($courseRaw);
		if ($course === '') {
			return;
		}

		$existing = trim((string) $entityData->get(self::FIELD_CUSTOMER_CODE));
		if ($existing !== '') {
			return;
		}

		$categoryDigit = $this->mapCourseToCategoryDigit($course);
		if ($categoryDigit === null) {
			return;
		}

		$year2 = (int) date('y');
		$seq = $this->allocateNextSequence($year2, $categoryDigit);
		if ($seq <= 0 || $seq > 99999) {
			return;
		}

		$code = sprintf('%02d%d%05d', $year2, $categoryDigit, $seq);
		$entityData->set(self::FIELD_CUSTOMER_CODE, $code);
	}

	protected function normalizeCourseValue($raw) {
		if ($raw === null || $raw === '') {
			return '';
		}
		$s = decode_html((string) $raw);
		$s = trim(preg_replace('/\s+/u', ' ', $s));
		return $s;
	}

	/**
	 * @return int|null 0 Dài hạn, 1 Aptech, 2 Arena, 3 ACNPRO
	 */
	protected function mapCourseToCategoryDigit($course) {
		$lower = mb_strtolower($course, 'UTF-8');

		if (preg_match('/\bacn\s*pro\b/ui', $course) || preg_match('/^acnpro$/ui', trim($course))) {
			return 3;
		}
		if (mb_stripos($course, 'acnpro', 0, 'UTF-8') !== false) {
			return 3;
		}

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

	protected function allocateNextSequence($year2, $categoryDigit) {
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
