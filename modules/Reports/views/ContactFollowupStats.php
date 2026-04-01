<?php
/*+***********************************************************************************
 * CUSC custom report: Báo cáo thống kê theo dõi liên hệ
 * - Counts follow-up blocks 1..10 on Contacts (vtiger_contactscf)
 * - Groups by user and status with date range filter
 * - Dynamic status columns from picklist table (vtiger_cf_1780)
 *************************************************************************************/

class Reports_ContactFollowupStats_View extends Vtiger_Index_View {

	public function requiresPermission(Vtiger_Request $request) {
		$permissions = parent::requiresPermission($request);
		$permissions[] = array('module_parameter' => 'module', 'action' => 'ListView');
		return $permissions;
	}

	public function process(Vtiger_Request $request) {
		$mode = $request->get('mode');
		if ($mode === 'ExportCSV' || $mode === 'ExportXLS') {
			$this->export($request, $mode);
			return;
		}

		$viewer = $this->getViewer($request);
		$viewer->assign('MODULE', $request->getModule());

		$from = trim((string) $request->get('from', ''));
		$to = trim((string) $request->get('to', ''));
		$userId = trim((string) $request->get('user_id', ''));

		$viewer->assign('FILTER_FROM', $from);
		$viewer->assign('FILTER_TO', $to);
		$viewer->assign('FILTER_USER_ID', $userId);

		$users = $this->getActiveUsers();
		$viewer->assign('USERS', $users);

		$statuses = $this->getFollowupStatuses();
		$viewer->assign('STATUSES', $statuses);

		$error = '';
		$rows = array();
		$totalsRow = array();

		if ($from === '' || $to === '') {
			$error = 'Vui lòng chọn khoảng thời gian (Từ ngày/Đến ngày).';
		} else if (!$this->isValidDate($from) || !$this->isValidDate($to)) {
			$error = 'Định dạng ngày không hợp lệ. Vui lòng dùng YYYY-MM-DD.';
		} else {
			list($rows, $totalsRow) = $this->getStats($from, $to, $userId, $statuses, $users);
		}

		$viewer->assign('ERROR', $error);
		$viewer->assign('ROWS', $rows);
		$viewer->assign('TOTALS', $totalsRow);

		$viewer->view('ContactFollowupStats.tpl', $request->getModule());
	}

	protected function isValidDate($value) {
		return preg_match('/^\d{4}-\d{2}-\d{2}$/', (string) $value) === 1;
	}

	protected function getFollowupFieldTriples() {
		// n => [userField, dateField, statusField]
		return array(
			1 => array('cf_1772', 'cf_1776', 'cf_1780'),
			2 => array('cf_1796', 'cf_1800', 'cf_1802'),
			3 => array('cf_1808', 'cf_1810', 'cf_1812'),
			4 => array('cf_1818', 'cf_1820', 'cf_1822'),
			5 => array('cf_1828', 'cf_1830', 'cf_1832'),
			6 => array('cf_1838', 'cf_1840', 'cf_1842'),
			7 => array('cf_1848', 'cf_1850', 'cf_1852'),
			8 => array('cf_1858', 'cf_1860', 'cf_1862'),
			9 => array('cf_1868', 'cf_1870', 'cf_1872'),
			10 => array('cf_1878', 'cf_1880', 'cf_1882'),
		);
	}

	protected function getFollowupStatuses() {
		$db = PearDatabase::getInstance();
		$values = array();

		// Use the picklist of block 1 as the master list (all blocks share the same picklist).
		$result = $db->pquery(
			'SELECT cf_1780 AS value, sortorderid, presence FROM vtiger_cf_1780 ORDER BY sortorderid',
			array()
		);
		for ($i = 0; $i < $db->num_rows($result); $i++) {
			$value = decode_html((string) $db->query_result($result, $i, 'value'));
			$presence = (int) $db->query_result($result, $i, 'presence');
			if ($presence === 1 && $value !== '') {
				$values[] = $value;
			}
		}

		// Fallback: if picklist table is empty, build from existing data.
		if (empty($values)) {
			$dataResult = $db->pquery(
				'SELECT DISTINCT cf_1780 AS value FROM vtiger_contactscf WHERE cf_1780 IS NOT NULL AND TRIM(cf_1780) != \'\' ORDER BY cf_1780',
				array()
			);
			for ($i = 0; $i < $db->num_rows($dataResult); $i++) {
				$values[] = decode_html((string) $db->query_result($dataResult, $i, 'value'));
			}
		}

		return $values;
	}

	protected function getActiveUsers() {
		$db = PearDatabase::getInstance();
		$users = array();
		$result = $db->pquery(
			"SELECT id, user_name, first_name, last_name FROM vtiger_users WHERE deleted = 0 AND status = 'Active' ORDER BY first_name, last_name, user_name",
			array()
		);
		for ($i = 0; $i < $db->num_rows($result); $i++) {
			$id = (int) $db->query_result($result, $i, 'id');
			$first = trim(decode_html((string) $db->query_result($result, $i, 'first_name')));
			$last = trim(decode_html((string) $db->query_result($result, $i, 'last_name')));
			$userName = trim(decode_html((string) $db->query_result($result, $i, 'user_name')));
			$label = trim($last . ' ' . $first);
			if ($label === '') {
				$label = $userName;
			}
			$users[$id] = $label;
		}
		return $users;
	}

	protected function getStats($from, $to, $userId, array $statuses, array $users) {
		$db = PearDatabase::getInstance();
		$triples = $this->getFollowupFieldTriples();

		$unionParts = array();
		foreach ($triples as $n => $fields) {
			list($userField, $dateField, $statusField) = $fields;
			$unionParts[] =
				"SELECT scf.contactid AS contactid,
				        scf.{$userField} AS follow_user,
				        scf.{$dateField} AS follow_date,
				        scf.{$statusField} AS follow_status
				   FROM vtiger_contactscf scf";
		}
		$unionSql = implode("\nUNION ALL\n", $unionParts);

		$sql = "SELECT CAST(f.follow_user AS UNSIGNED) AS user_id,
				       f.follow_status AS status,
				       COUNT(*) AS total
				  FROM (
					{$unionSql}
				  ) f
				  INNER JOIN vtiger_crmentity ce ON ce.crmid = f.contactid AND ce.deleted = 0 AND ce.setype = 'Contacts'
				 WHERE f.follow_user IS NOT NULL
				   AND TRIM(f.follow_user) != ''
				   AND f.follow_user != '0'
				   AND f.follow_date IS NOT NULL
				   AND f.follow_date >= ?
				   AND f.follow_date <= ?
				   AND f.follow_status IS NOT NULL
				   AND TRIM(f.follow_status) != ''";

		$params = array($from, $to);
		if ($userId !== '') {
			$sql .= " AND CAST(f.follow_user AS UNSIGNED) = ?";
			$params[] = (int) $userId;
		}

		$sql .= " GROUP BY CAST(f.follow_user AS UNSIGNED), f.follow_status";

		$result = $db->pquery($sql, $params);

		// Initialize row structure
		$rowsByUser = array();
		$totals = array('user_label' => 'Tổng', 'total' => 0, 'statuses' => array());
		foreach ($statuses as $st) {
			$totals['statuses'][$st] = 0;
		}

		for ($i = 0; $i < $db->num_rows($result); $i++) {
			$uid = (int) $db->query_result($result, $i, 'user_id');
			$statusRaw = (string) $db->query_result($result, $i, 'status');
			$status = decode_html($statusRaw);
			$count = (int) $db->query_result($result, $i, 'total');
			if ($uid <= 0) {
				continue;
			}

			if (!isset($rowsByUser[$uid])) {
				$rowsByUser[$uid] = array(
					'user_id' => $uid,
					'user_label' => isset($users[$uid]) ? $users[$uid] : ('User #' . $uid),
					'total' => 0,
					'statuses' => array(),
				);
				foreach ($statuses as $st) {
					$rowsByUser[$uid]['statuses'][$st] = 0;
				}
			}

			$rowsByUser[$uid]['total'] += $count;
			if (isset($rowsByUser[$uid]['statuses'][$status])) {
				$rowsByUser[$uid]['statuses'][$status] += $count;
			} else {
				// Status not in picklist (legacy) -> add dynamically to the end
				$rowsByUser[$uid]['statuses'][$status] = $count;
				if (!isset($totals['statuses'][$status])) {
					$totals['statuses'][$status] = 0;
				}
			}

			$totals['total'] += $count;
			$totals['statuses'][$status] = (int) $totals['statuses'][$status] + $count;
		}

		// Sort users by total desc
		$rows = array_values($rowsByUser);
		usort($rows, function ($a, $b) {
			$ta = (int) $a['total'];
			$tb = (int) $b['total'];
			if ($ta === $tb) return strcmp((string)$a['user_label'], (string)$b['user_label']);
			return ($ta < $tb) ? 1 : -1;
		});

		return array($rows, $totals);
	}

	protected function export(Vtiger_Request $request, $mode) {
		$from = trim((string) $request->get('from', ''));
		$to = trim((string) $request->get('to', ''));
		$userId = trim((string) $request->get('user_id', ''));

		if ($from === '' || $to === '' || !$this->isValidDate($from) || !$this->isValidDate($to)) {
			header('Content-Type: text/plain; charset=UTF-8');
			echo "Thiếu hoặc sai bộ lọc ngày (from/to).";
			return;
		}

		$users = $this->getActiveUsers();
		$statuses = $this->getFollowupStatuses();
		list($rows, $totalsRow) = $this->getStats($from, $to, $userId, $statuses, $users);

		$filenameBase = 'bao-cao-theo-doi-lien-he_' . $from . '_' . $to;

		if ($mode === 'ExportCSV') {
			header('Content-Type: text/csv; charset=UTF-8');
			header('Content-Disposition: attachment; filename="' . $filenameBase . '.csv"');

			$out = fopen('php://output', 'w');
			// UTF-8 BOM for Excel
			fwrite($out, "\xEF\xBB\xBF");

			$header = array_merge(array('Tài khoản', 'Tổng'), $statuses);
			fputcsv($out, $header);

			foreach ($rows as $row) {
				$line = array($row['user_label'], (int)$row['total']);
				foreach ($statuses as $st) {
					$line[] = isset($row['statuses'][$st]) ? (int)$row['statuses'][$st] : 0;
				}
				fputcsv($out, $line);
			}

			$totalLine = array($totalsRow['user_label'], (int)$totalsRow['total']);
			foreach ($statuses as $st) {
				$totalLine[] = isset($totalsRow['statuses'][$st]) ? (int)$totalsRow['statuses'][$st] : 0;
			}
			fputcsv($out, $totalLine);
			fclose($out);
			return;
		}

		require_once 'libraries/PHPExcel/PHPExcel.php';

		$workbook = new PHPExcel();
		$worksheet = $workbook->setActiveSheetIndex(0);
		$worksheet->setTitle('Thong ke theo doi');

		$headers = array_merge(array('Tài khoản', 'Tổng'), $statuses);
		$headerStyle = array(
			'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'E1E0F7')),
			'font' => array('bold' => true),
		);
		$totalStyle = array('font' => array('bold' => true));

		$col = 0;
		foreach ($headers as $header) {
			$worksheet->setCellValueExplicitByColumnAndRow($col, 1, decode_html($header), PHPExcel_Cell_DataType::TYPE_STRING);
			$worksheet->getStyleByColumnAndRow($col, 1)->applyFromArray($headerStyle);
			$col++;
		}

		$rowIndex = 2;
		foreach ($rows as $row) {
			$col = 0;
			$worksheet->setCellValueExplicitByColumnAndRow($col++, $rowIndex, decode_html($row['user_label']), PHPExcel_Cell_DataType::TYPE_STRING);
			$worksheet->setCellValueByColumnAndRow($col++, $rowIndex, (int) $row['total']);
			foreach ($statuses as $st) {
				$worksheet->setCellValueByColumnAndRow($col++, $rowIndex, isset($row['statuses'][$st]) ? (int) $row['statuses'][$st] : 0);
			}
			$rowIndex++;
		}

		$col = 0;
		$worksheet->setCellValueExplicitByColumnAndRow($col++, $rowIndex, decode_html($totalsRow['user_label']), PHPExcel_Cell_DataType::TYPE_STRING);
		$worksheet->setCellValueByColumnAndRow($col++, $rowIndex, (int) $totalsRow['total']);
		foreach ($statuses as $st) {
			$worksheet->setCellValueByColumnAndRow($col++, $rowIndex, isset($totalsRow['statuses'][$st]) ? (int) $totalsRow['statuses'][$st] : 0);
		}
		$worksheet->getStyle("A{$rowIndex}:" . PHPExcel_Cell::stringFromColumnIndex(count($headers) - 1) . $rowIndex)->applyFromArray($totalStyle);

		for ($i = 0; $i < count($headers); $i++) {
			$worksheet->getColumnDimension(PHPExcel_Cell::stringFromColumnIndex($i))->setAutoSize(true);
		}

		if (!class_exists('ZipArchive')) {
			PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
		}

		header('Content-Disposition: attachment; filename="' . $filenameBase . '.xlsx"');
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=UTF-8');
		header('Expires: Mon, 31 Dec 2000 00:00:00 GMT');
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
		header('Cache-Control: post-check=0, pre-check=0', false);

		while (ob_get_level() > 0) {
			ob_end_clean();
		}

		$writer = PHPExcel_IOFactory::createWriter($workbook, 'Excel2007');
		$writer->save('php://output');
		return;
	}
}

