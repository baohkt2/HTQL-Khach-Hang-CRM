<?php
/*+***********************************************************************************
 * CUSC: Maintain last follow-up fields on Contacts for reporting performance.
 * Fields:
 * - last_follow_user (user id)
 * - last_follow_date (date)
 *
 * Strategy:
 * - On Contacts aftersave, compute latest follow-up among blocks 1..10
 * - Update vtiger_contactscf only when values change
 *************************************************************************************/

require_once 'include/events/VTEventHandler.inc';
require_once 'include/events/VTEntityData.inc';
require_once 'data/VTEntityDelta.php';

class ContactLastFollowupHandler extends VTEventHandler {

	protected static $lastFollowUserColumn = null;
	protected static $lastFollowDateColumn = null;
	protected static $userNameToIdCache = array();

	public function handleEvent($eventName, $entityData) {
		if ($eventName !== 'vtiger.entity.aftersave' || !$entityData) {
			return;
		}
		if ($entityData->getModuleName() !== 'Contacts') {
			return;
		}

		$recordId = (int) $entityData->getId();
		if ($recordId <= 0) {
			return;
		}

		/*
		 * Tracking must be reliable.
		 * VTEntityDelta ordering/availability can vary across save paths (Save, SaveAjax, workflows),
		 * so we recompute every time. recomputeAndPersist() is O(1) per save (one SELECT, one UPDATE if changed).
		 */
		$this->recomputeAndPersist($recordId);
	}

	protected function resolveLastFollowColumns() {
		if (self::$lastFollowUserColumn !== null && self::$lastFollowDateColumn !== null) {
			return;
		}
		$db = PearDatabase::getInstance();
		$r = $db->pquery(
			"SELECT fieldname, columnname FROM vtiger_field WHERE tabid = (SELECT tabid FROM vtiger_tab WHERE name='Contacts') AND fieldname IN (?,?)",
			array('last_follow_user', 'last_follow_date')
		);
		$userCol = '';
		$dateCol = '';
		for ($i = 0; $i < $db->num_rows($r); $i++) {
			$fn = (string) $db->query_result($r, $i, 'fieldname');
			$cn = (string) $db->query_result($r, $i, 'columnname');
			if ($fn === 'last_follow_user') $userCol = $cn;
			if ($fn === 'last_follow_date') $dateCol = $cn;
		}
		self::$lastFollowUserColumn = $userCol ?: 'last_follow_user';
		self::$lastFollowDateColumn = $dateCol ?: 'last_follow_date';
	}

	protected function didAnyFollowupFieldChange($recordId) {
		$delta = new VTEntityDelta();

		$fields = array(
			// user/date/status triples (1..10)
			'cf_1772','cf_1776','cf_1780',
			'cf_1796','cf_1800','cf_1802',
			'cf_1808','cf_1810','cf_1812',
			'cf_1818','cf_1820','cf_1822',
			'cf_1828','cf_1830','cf_1832',
			'cf_1838','cf_1840','cf_1842',
			'cf_1848','cf_1850','cf_1852',
			'cf_1858','cf_1860','cf_1862',
			'cf_1868','cf_1870','cf_1872',
			'cf_1878','cf_1880','cf_1882',
		);

		foreach ($fields as $fieldName) {
			if ($delta->hasChanged('Contacts', (int)$recordId, $fieldName)) {
				return true;
			}
		}
		return false;
	}

	public function recomputeAndPersist($contactId) {
		$db = PearDatabase::getInstance();
		$this->resolveLastFollowColumns();
		$userCol = self::$lastFollowUserColumn;
		$dateCol = self::$lastFollowDateColumn;

		$result = $db->pquery(
			'SELECT
				cf_1772, cf_1776, cf_1780,
				cf_1796, cf_1800, cf_1802,
				cf_1808, cf_1810, cf_1812,
				cf_1818, cf_1820, cf_1822,
				cf_1828, cf_1830, cf_1832,
				cf_1838, cf_1840, cf_1842,
				cf_1848, cf_1850, cf_1852,
				cf_1858, cf_1860, cf_1862,
				cf_1868, cf_1870, cf_1872,
				cf_1878, cf_1880, cf_1882,
				' . $userCol . ' AS last_follow_user, ' . $dateCol . ' AS last_follow_date
			 FROM vtiger_contactscf
			 WHERE contactid = ?',
			array((int) $contactId)
		);
		if (!$result || $db->num_rows($result) === 0) {
			return false;
		}

		$row = $db->fetchByAssoc($result);

		$bestDate = '';
		$bestUser = 0;

		$triples = array(
			array('cf_1772','cf_1776','cf_1780'),
			array('cf_1796','cf_1800','cf_1802'),
			array('cf_1808','cf_1810','cf_1812'),
			array('cf_1818','cf_1820','cf_1822'),
			array('cf_1828','cf_1830','cf_1832'),
			array('cf_1838','cf_1840','cf_1842'),
			array('cf_1848','cf_1850','cf_1852'),
			array('cf_1858','cf_1860','cf_1862'),
			array('cf_1868','cf_1870','cf_1872'),
			array('cf_1878','cf_1880','cf_1882'),
		);

		foreach ($triples as $t) {
			$userRaw = isset($row[$t[0]]) ? trim((string) $row[$t[0]]) : '';
			$userVal = $this->resolveUserId($userRaw);
			$dateVal = isset($row[$t[1]]) ? trim((string) $row[$t[1]]) : '';
			$statusVal = isset($row[$t[2]]) ? trim((string) $row[$t[2]]) : '';

			// A follow-up is considered valid for "last follow" if it has user + date + status
			if ($userVal <= 0 || $dateVal === '' || $dateVal === '0000-00-00' || $statusVal === '') {
				continue;
			}

			// Dates stored as YYYY-MM-DD, lexical compare works
			if ($bestDate === '' || $dateVal > $bestDate) {
				$bestDate = $dateVal;
				$bestUser = $userVal;
			}
		}

		$oldUser = isset($row['last_follow_user']) ? (int) $row['last_follow_user'] : 0;
		$oldDate = isset($row['last_follow_date']) ? trim((string) $row['last_follow_date']) : '';

		if ($oldUser === $bestUser && $oldDate === $bestDate) {
			return false;
		}

		$updateResult = $db->pquery(
			'UPDATE vtiger_contactscf SET ' . $userCol . ' = ?, ' . $dateCol . ' = ? WHERE contactid = ?',
			array($bestUser > 0 ? $bestUser : null, $bestDate !== '' ? $bestDate : null, (int) $contactId)
		);

		return (bool) $updateResult;
	}

	/**
	 * Follow-up user fields (cf_1772,...) are stored as text in this CRM (e.g. user_name).
	 * Convert to vtiger_users.id for stable reporting/indexing.
	 */
	protected function resolveUserId($userRaw) {
		$userRaw = trim((string) $userRaw);
		if ($userRaw === '' || $userRaw === '0') {
			return 0;
		}
		if (ctype_digit($userRaw)) {
			return (int) $userRaw;
		}
		if (isset(self::$userNameToIdCache[$userRaw])) {
			return (int) self::$userNameToIdCache[$userRaw];
		}
		$db = PearDatabase::getInstance();
		$r = $db->pquery(
			"SELECT id FROM vtiger_users WHERE deleted = 0 AND user_name = ? LIMIT 1",
			array($userRaw)
		);
		$id = 0;
		if ($r && $db->num_rows($r) > 0) {
			$id = (int) $db->query_result($r, 0, 'id');
		}
		self::$userNameToIdCache[$userRaw] = $id;
		return $id;
	}
}

