<?php
/*+***********************************************************************************
 * CUSC performance override: chunked CSV export without loading all rows into memory.
 *************************************************************************************/

class Vtiger_CUSCChunkedExport_Action extends Vtiger_ExportData_Action {
	const DEFAULT_CHUNK_SIZE = 500;
	const MAX_CHUNK_SIZE = 2000;
	const METRICS_LOG_FILE = 'logs/perf_export_chunks.log';

	protected $moduleFieldInstances = array();
	protected $accessibleFields = array();

	public function ExportData(Vtiger_Request $request) {
		$exportFormat = $request->get('export_format');
		if (in_array($exportFormat, array('xls', 'xlsx'))) {
			parent::ExportData($request);
			return;
		}

		$moduleName = $request->get('source_module');
		if (empty($moduleName)) {
			$moduleName = $request->getModule();
			$request->set('source_module', $moduleName);
		}

		$this->initializeParentExportContext($moduleName);
		$query = $this->getExportQuery($request);

		// Keep native behavior for already paginated queries.
		if (preg_match('/\\blimit\\b/i', $query)) {
			parent::ExportData($request);
			return;
		}

		$headers = $this->getHeaders();
		$addRowNumber = $request->get('export_row_number') === '1';
		if ($addRowNumber) {
			array_unshift($headers, 'STT');
		}

		$chunkSize = $this->resolveChunkSize($request);
		$db = PearDatabase::getInstance();
		$rowOrderMapper = $this->buildParentRowOrderMapper();
		$offset = 0;
		$rowNumber = 1;
		$chunkNumber = 0;
		$metrics = array();

		$fp = $this->openCsvOutput($request, $moduleName, $headers);

		while (true) {
			$chunkNumber++;
			$chunkStartedAt = microtime(true);
			$chunkQuery = $query . ' LIMIT ' . (int) $offset . ',' . (int) $chunkSize;
			$result = $db->pquery($chunkQuery, array());
			$rowCount = $db->num_rows($result);

			if ($rowCount <= 0) {
				break;
			}

			for ($i = 0; $i < $rowCount; $i++) {
				$sanitizedRow = $this->sanitizeValues($db->fetchByAssoc($result, $i));
				$orderedRow = $rowOrderMapper($sanitizedRow);
				if ($addRowNumber) {
					array_unshift($orderedRow, $rowNumber++);
				}
				fputcsv($fp, Vtiger_Functions::sanitizeForCSVExport($orderedRow));
			}

			$elapsed = microtime(true) - $chunkStartedAt;
			$metrics[] = sprintf(
				'module=%s chunk=%d offset=%d rows=%d elapsed=%.6f',
				$moduleName,
				$chunkNumber,
				$offset,
				$rowCount,
				$elapsed
			);

			$offset += $chunkSize;
			if ($rowCount < $chunkSize) {
				break;
			}

			if (function_exists('ob_flush')) {
				@ob_flush();
			}
			flush();
		}

		fclose($fp);
		$this->logChunkMetrics($metrics);
	}

	protected function resolveChunkSize(Vtiger_Request $request) {
		$chunkSize = (int) $request->get('chunk_size');
		if ($chunkSize <= 0) {
			$chunkSize = self::DEFAULT_CHUNK_SIZE;
		}
		return min($chunkSize, self::MAX_CHUNK_SIZE);
	}

	protected function initializeParentExportContext($moduleName) {
		$initializer = Closure::bind(function ($moduleName) {
			$this->moduleInstance = Vtiger_Module_Model::getInstance($moduleName);
			$this->moduleFieldInstances = $this->moduleFieldInstances($moduleName);
			$this->focus = CRMEntity::getInstance($moduleName);
		}, $this, 'Vtiger_ExportData_Action');

		$initializer($moduleName);
	}

	protected function buildParentRowOrderMapper() {
		return function ($row) {
			return $this->invokeParentPrivateMethod('getRowValuesInHeaderOrder', array($row));
		};
	}

	protected function getParentExportFileName(Vtiger_Request $request, $moduleName) {
		return (string) $this->invokeParentPrivateMethod('getExportFileName', array($request, $moduleName));
	}

	protected function invokeParentPrivateMethod($methodName, array $arguments = array()) {
		$method = new ReflectionMethod('Vtiger_ExportData_Action', $methodName);
		$method->setAccessible(true);
		return $method->invokeArgs($this, $arguments);
	}

	protected function openCsvOutput(Vtiger_Request $request, $moduleName, array $headers) {
		$fileName = $this->getParentExportFileName($request, $moduleName);
		$exportType = $this->getExportContentType($request);
		$this->sendExportCompletionCookie($request);

		header("Content-Disposition:attachment;filename=$fileName.csv");
		header("Content-Type:$exportType;charset=UTF-8");
		header('Expires: Mon, 31 Dec 2000 00:00:00 GMT');
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
		header('Cache-Control: post-check=0, pre-check=0', false);

		if (ob_get_length()) {
			ob_clean();
		}

		$fp = fopen('php://output', 'a+');
		fputcsv($fp, Vtiger_Functions::sanitizeForCSVExport($headers));
		return $fp;
	}

	protected function logChunkMetrics(array $metrics) {
		if (empty($metrics)) {
			return;
		}

		$logPath = self::METRICS_LOG_FILE;
		$lines = array();
		$timestamp = date('Y-m-d H:i:s');
		foreach ($metrics as $metric) {
			$lines[] = '[' . $timestamp . '] ' . $metric;
		}
		$payload = implode(PHP_EOL, $lines) . PHP_EOL;
		@file_put_contents($logPath, $payload, FILE_APPEND | LOCK_EX);
	}
}
