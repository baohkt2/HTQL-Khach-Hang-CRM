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
	protected static $normalizedUserToIdMap = null;
	protected static $compactUserToIdMap = null;

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
	protected static function normalizeUserKey($value) {
		$value = trim((string) $value);
		if ($value === '') {
			return '';
		}
		$value = preg_replace('/\s+/u', ' ', $value);
		if (function_exists('mb_strtolower')) {
			return (string) mb_strtolower($value, 'UTF-8');
		}
		return (string) strtolower($value);
	}

	protected static function compactUserKey($value) {
		$value = self::normalizeUserKey($value);
		if ($value === '') {
			return '';
		}
		if (function_exists('iconv')) {
			$translit = @iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $value);
			if ($translit !== false) {
				$value = strtolower((string) $translit);
			}
		}
		$value = preg_replace('/[^a-z0-9]+/', '', $value);
		return trim((string) $value);
	}

	protected function ensureUserLookupMap() {
		if (self::$normalizedUserToIdMap !== null) {
			return;
		}

		self::$normalizedUserToIdMap = array();
		self::$compactUserToIdMap = array();
		$db = PearDatabase::getInstance();
		$result = $db->pquery(
			"SELECT id, user_name, first_name, last_name
			   FROM vtiger_users
			  WHERE id > 0
			  ORDER BY deleted ASC, (status='Active') DESC, id ASC",
			array()
		);

		for ($i = 0; $i < $db->num_rows($result); $i++) {
			$id = (int) $db->query_result($result, $i, 'id');
			$userName = trim((string) $db->query_result($result, $i, 'user_name'));
			$firstName = trim((string) $db->query_result($result, $i, 'first_name'));
			$lastName = trim((string) $db->query_result($result, $i, 'last_name'));

			$candidates = array(
				$userName,
				$firstName,
				$lastName,
				trim($firstName . ' ' . $lastName),
				trim($lastName . ' ' . $firstName),
			);

			foreach ($candidates as $candidate) {
				$key = self::normalizeUserKey($candidate);
				if ($key === '') {
					continue;
				}
				if (!isset(self::$normalizedUserToIdMap[$key])) {
					self::$normalizedUserToIdMap[$key] = $id;
				}

				$compactKey = self::compactUserKey($candidate);
				if ($compactKey !== '' && !isset(self::$compactUserToIdMap[$compactKey])) {
					self::$compactUserToIdMap[$compactKey] = $id;
				}
			}
		}
	}

	protected function resolveUserId($userRaw) {
		$userRaw = trim((string) $userRaw);
		if ($userRaw === '' || $userRaw === '0') {
			return 0;
		}
		if (ctype_digit($userRaw)) {
			return (int) $userRaw;
		}

		$lookupKey = self::normalizeUserKey($userRaw);
		if ($lookupKey === '') {
			return 0;
		}
		if (isset(self::$userNameToIdCache[$lookupKey])) {
			return (int) self::$userNameToIdCache[$lookupKey];
		}

		$this->ensureUserLookupMap();
		if (isset(self::$normalizedUserToIdMap[$lookupKey])) {
			$id = (int) self::$normalizedUserToIdMap[$lookupKey];
			self::$userNameToIdCache[$lookupKey] = $id;
			return $id;
		}

		$compactKey = self::compactUserKey($userRaw);
		if ($compactKey !== '') {
			if (isset(self::$compactUserToIdMap[$compactKey])) {
				$id = (int) self::$compactUserToIdMap[$compactKey];
				self::$userNameToIdCache[$lookupKey] = $id;
				return $id;
			}

			// light typo tolerance (e.g. nhttthao -> nhtthao)
			$bestId = 0;
			$bestDistance = 999;
			foreach (self::$compactUserToIdMap as $candidateKey => $candidateId) {
				if ($candidateKey === '' || abs(strlen($candidateKey) - strlen($compactKey)) > 1) {
					continue;
				}
				$distance = levenshtein($compactKey, $candidateKey);
				if ($distance < $bestDistance) {
					$bestDistance = $distance;
					$bestId = (int) $candidateId;
				}
			}
			if ($bestId > 0 && $bestDistance <= 1) {
				self::$userNameToIdCache[$lookupKey] = $bestId;
				return $bestId;
			}
		}

		$db = PearDatabase::getInstance();
		$r = $db->pquery(
			"SELECT id
			   FROM vtiger_users
			  WHERE id > 0
			    AND (
					user_name = ?
					OR TRIM(COALESCE(last_name,'')) = ?
					OR TRIM(COALESCE(first_name,'')) = ?
					OR TRIM(CONCAT(COALESCE(first_name,''), ' ', COALESCE(last_name,''))) = ?
					OR TRIM(CONCAT(COALESCE(last_name,''), ' ', COALESCE(first_name,''))) = ?
				)
			  ORDER BY deleted ASC, (status='Active') DESC, id ASC
			  LIMIT 1",
			array($userRaw, $userRaw, $userRaw, $userRaw, $userRaw)
		);
		$id = 0;
		if ($r && $db->num_rows($r) > 0) {
			$id = (int) $db->query_result($r, 0, 'id');
		}
		self::$userNameToIdCache[$lookupKey] = $id;
		return $id;
	}
}

