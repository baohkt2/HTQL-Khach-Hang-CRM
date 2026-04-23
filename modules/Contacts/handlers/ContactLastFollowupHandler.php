<?php
/*+***********************************************************************************
 * CUSC: Maintain last follow-up fields on Contacts for reporting performance.
 * Fields:
 * - last_follow_user (user id)
 * - last_follow_date (date)
 *
 * Strategy:
 * - On Contacts aftersave, compute latest follow-up among blocks 1..10 plus Facebook/Zalo follow blocks
 * - Sync Contacts status (cf_2050) only when latest source is follow 1..10 (has follow status field)
 * - Update vtiger_contactscf only when values change
 *************************************************************************************/

require_once 'include/events/VTEventHandler.inc';
require_once 'include/events/VTEntityData.inc';
require_once 'data/VTEntityDelta.php';
require_once 'modules/Accounts/handlers/AccountContactNetworkEmailStatsHandler.php';

class ContactLastFollowupHandler extends VTEventHandler {

	protected static $lastFollowUserColumn = null;
	protected static $lastFollowDateColumn = null;
	protected static $contactStatusColumn = 'status';
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
			// facebook follow blocks (no follow status field)
			'cf_1770','cf_1774','cf_2024',
			'cf_1790','cf_1792','cf_2026',
			// zalo follow blocks (no follow status field)
			'cf_1754','cf_1756','cf_2014',
			'cf_2002','cf_2004','cf_2016',
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
		$statusCol = self::$contactStatusColumn;

		$result = $db->pquery(
			'SELECT
				follow_user_zalo AS cf_1754, follow_date_zalo AS cf_1756,
				follow_user_zalo_2 AS cf_2002, follow_date_zalo_2 AS cf_2004,
				follow_result_zalo AS follow_result_zalo,
				follow_result_zalo_2 AS follow_result_zalo_2,
				follow_user_facebook_1 AS cf_1770, follow_date_facebook_1 AS cf_1774,
				follow_user_facebook_2 AS cf_1790, follow_date_facebook_2 AS cf_1792,
				followup_user_1 AS cf_1772, followup_date_1 AS cf_1776, followup_status_1 AS cf_1780,
				followup_user_2 AS cf_1796, followup_date_2 AS cf_1800, followup_status_2 AS cf_1802,
				followup_user_3 AS cf_1808, followup_date_3 AS cf_1810, followup_status_3 AS cf_1812,
				followup_user_4 AS cf_1818, followup_date_4 AS cf_1820, followup_status_4 AS cf_1822,
				followup_user_5 AS cf_1828, followup_date_5 AS cf_1830, followup_status_5 AS cf_1832,
				followup_user_6 AS cf_1838, followup_date_6 AS cf_1840, followup_status_6 AS cf_1842,
				followup_user_7 AS cf_1848, followup_date_7 AS cf_1850, followup_status_7 AS cf_1852,
				followup_user_8 AS cf_1858, followup_date_8 AS cf_1860, followup_status_8 AS cf_1862,
				followup_user_9 AS cf_1868, followup_date_9 AS cf_1870, followup_status_9 AS cf_1872,
				followup_user_10 AS cf_1878, followup_date_10 AS cf_1880, followup_status_10 AS cf_1882,
				cf_2162 AS followed_zalo,
				' . $userCol . ' AS last_follow_user, ' . $dateCol . ' AS last_follow_date,
				' . $statusCol . ' AS contact_status
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
		$bestStatus = '';
		$bestHasStatus = false;

		$sources = array(
			// Follow 1..10 (status must exist and can sync Contacts status)
			array('user' => 'cf_1772', 'date' => 'cf_1776', 'status' => 'cf_1780'),
			array('user' => 'cf_1796', 'date' => 'cf_1800', 'status' => 'cf_1802'),
			array('user' => 'cf_1808', 'date' => 'cf_1810', 'status' => 'cf_1812'),
			array('user' => 'cf_1818', 'date' => 'cf_1820', 'status' => 'cf_1822'),
			array('user' => 'cf_1828', 'date' => 'cf_1830', 'status' => 'cf_1832'),
			array('user' => 'cf_1838', 'date' => 'cf_1840', 'status' => 'cf_1842'),
			array('user' => 'cf_1848', 'date' => 'cf_1850', 'status' => 'cf_1852'),
			array('user' => 'cf_1858', 'date' => 'cf_1860', 'status' => 'cf_1862'),
			array('user' => 'cf_1868', 'date' => 'cf_1870', 'status' => 'cf_1872'),
			array('user' => 'cf_1878', 'date' => 'cf_1880', 'status' => 'cf_1882'),
			// Facebook and Zalo follows do not have follow-status field
			array('user' => 'cf_1770', 'date' => 'cf_1774'),
			array('user' => 'cf_1790', 'date' => 'cf_1792'),
			array('user' => 'cf_1754', 'date' => 'cf_1756'),
			array('user' => 'cf_2002', 'date' => 'cf_2004'),
		);

		foreach ($sources as $source) {
			$userRaw = isset($row[$source['user']]) ? trim((string) $row[$source['user']]) : '';
			$userVal = $this->resolveUserId($userRaw);
			$dateVal = isset($row[$source['date']]) ? trim((string) $row[$source['date']]) : '';

			if ($userVal <= 0 || $dateVal === '' || $dateVal === '0000-00-00') {
				continue;
			}

			$hasStatusField = isset($source['status']) && $source['status'] !== '';
			$statusVal = '';
			if ($hasStatusField) {
				$statusVal = isset($row[$source['status']]) ? trim((string) $row[$source['status']]) : '';

				// Follow 1..10 is valid only when status exists.
				if ($statusVal === '') {
					continue;
				}
			}

			// Dates stored as YYYY-MM-DD, lexical compare works
			if ($bestDate === '' || $dateVal > $bestDate) {
				$bestDate = $dateVal;
				$bestUser = $userVal;
				$bestStatus = $statusVal;
				$bestHasStatus = $hasStatusField;
			}
		}

		$oldUser = isset($row['last_follow_user']) ? (int) $row['last_follow_user'] : 0;
		$oldDate = isset($row['last_follow_date']) ? trim((string) $row['last_follow_date']) : '';
		$oldStatus = isset($row['contact_status']) ? trim((string) $row['contact_status']) : '';
		$oldFollowedZalo = isset($row['followed_zalo']) ? $this->toCheckboxValue($row['followed_zalo']) : 0;
		$newFollowedZalo = ($this->hasNonEmptyValue(isset($row['follow_result_zalo']) ? $row['follow_result_zalo'] : '') || $this->hasNonEmptyValue(isset($row['follow_result_zalo_2']) ? $row['follow_result_zalo_2'] : '')) ? 1 : 0;
		$needsFollowedZaloUpdate = ($oldFollowedZalo !== $newFollowedZalo);

		$needsLastFollowUpdate = true;

		if (!$bestHasStatus && $oldUser === $bestUser && $oldDate === $bestDate) {
			$needsLastFollowUpdate = false;
		}

		if ($bestHasStatus && $oldUser === $bestUser && $oldDate === $bestDate && $oldStatus === $bestStatus) {
			$needsLastFollowUpdate = false;
		}

		if (!$needsLastFollowUpdate && !$needsFollowedZaloUpdate) {
			return false;
		}

		if ($needsLastFollowUpdate && $bestHasStatus) {
			if ($needsFollowedZaloUpdate) {
				$updateResult = $db->pquery(
					'UPDATE vtiger_contactscf SET ' . $userCol . ' = ?, ' . $dateCol . ' = ?, ' . $statusCol . ' = ?, cf_2162 = ? WHERE contactid = ?',
					array($bestUser > 0 ? $bestUser : null, $bestDate !== '' ? $bestDate : null, $bestStatus !== '' ? $bestStatus : null, $newFollowedZalo, (int) $contactId)
				);
			} else {
				$updateResult = $db->pquery(
					'UPDATE vtiger_contactscf SET ' . $userCol . ' = ?, ' . $dateCol . ' = ?, ' . $statusCol . ' = ? WHERE contactid = ?',
					array($bestUser > 0 ? $bestUser : null, $bestDate !== '' ? $bestDate : null, $bestStatus !== '' ? $bestStatus : null, (int) $contactId)
				);
			}
		} else if ($needsLastFollowUpdate) {
			if ($needsFollowedZaloUpdate) {
				$updateResult = $db->pquery(
					'UPDATE vtiger_contactscf SET ' . $userCol . ' = ?, ' . $dateCol . ' = ?, cf_2162 = ? WHERE contactid = ?',
					array($bestUser > 0 ? $bestUser : null, $bestDate !== '' ? $bestDate : null, $newFollowedZalo, (int) $contactId)
				);
			} else {
				$updateResult = $db->pquery(
					'UPDATE vtiger_contactscf SET ' . $userCol . ' = ?, ' . $dateCol . ' = ? WHERE contactid = ?',
					array($bestUser > 0 ? $bestUser : null, $bestDate !== '' ? $bestDate : null, (int) $contactId)
				);
			}
		} else {
			$updateResult = $db->pquery(
				'UPDATE vtiger_contactscf SET cf_2162 = ? WHERE contactid = ?',
				array($newFollowedZalo, (int) $contactId)
			);
		}

		if ($updateResult && $needsFollowedZaloUpdate) {
			$this->refreshLinkedAccountStatistics($contactId);
		}

		return (bool) $updateResult;
	}

	protected function hasNonEmptyValue($value) {
		return trim((string) $value) !== '';
	}

	protected function toCheckboxValue($value) {
		return ((int) $value === 1) ? 1 : 0;
	}

	protected function refreshLinkedAccountStatistics($contactId) {
		$contactId = (int) $contactId;
		if ($contactId <= 0) {
			return;
		}

		$db = PearDatabase::getInstance();
		$result = $db->pquery(
			'SELECT accountid FROM vtiger_contactdetails WHERE contactid = ?',
			array($contactId)
		);

		if (!$result || $db->num_rows($result) === 0) {
			return;
		}

		$accountId = (int) $db->query_result($result, 0, 'accountid');
		if ($accountId <= 0) {
			return;
		}

		AccountContactNetworkEmailStatsHandler::refreshAccountStatistics($accountId);
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

