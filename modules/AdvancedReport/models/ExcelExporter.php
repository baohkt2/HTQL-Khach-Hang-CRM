<?php
/**
 * AdvancedReport - Excel Exporter
 * 
 * Dynamic Excel export engine that creates formatted workbooks
 * matching custom templates (titles, grouped data, merged cells, styling).
 * Supports the screenshot format and any custom layout.
 */
require_once 'libraries/PHPExcel/PHPExcel.php';

class AdvancedReport_ExcelExporter_Model {

    /** @var PHPExcel */
    private $workbook;
    
    /** @var PHPExcel_Worksheet */
    private $sheet;
    
    /** @var int Current row pointer (1-based) */
    private $currentRow = 1;

    /** @var array Default styles */
    private $styles = [];

    public function __construct() {
        $this->workbook = new PHPExcel();
        $this->sheet = $this->workbook->setActiveSheetIndex(0);
        $this->initDefaultStyles();
    }

    private function initDefaultStyles() {
        $this->styles = [
            'title' => [
                'font' => ['bold' => true, 'size' => 14, 'name' => 'Times New Roman'],
                'alignment' => [
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'wrap' => true,
                ],
            ],
            'subtitle' => [
                'font' => ['bold' => true, 'size' => 12, 'name' => 'Times New Roman'],
                'alignment' => [
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                ],
            ],
            'header' => [
                'font' => ['bold' => true, 'size' => 11, 'name' => 'Times New Roman'],
                'fill' => [
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => ['rgb' => 'D9E1F2'],
                ],
                'alignment' => [
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'wrap' => true,
                ],
                'borders' => [
                    'allborders' => [
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
            ],
            'data' => [
                'font' => ['size' => 11, 'name' => 'Times New Roman'],
                'alignment' => [
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'wrap' => true,
                ],
                'borders' => [
                    'allborders' => [
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
            ],
            'data_center' => [
                'font' => ['size' => 11, 'name' => 'Times New Roman'],
                'alignment' => [
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'wrap' => true,
                ],
                'borders' => [
                    'allborders' => [
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
            ],
            'data_number' => [
                'font' => ['size' => 11, 'name' => 'Times New Roman'],
                'alignment' => [
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                ],
                'borders' => [
                    'allborders' => [
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
            ],
            'summary' => [
                'font' => ['bold' => true, 'size' => 11, 'name' => 'Times New Roman'],
                'fill' => [
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => ['rgb' => 'FFF2CC'],
                ],
                'alignment' => [
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                ],
                'borders' => [
                    'allborders' => [
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
            ],
            'footer' => [
                'font' => ['bold' => true, 'size' => 11, 'name' => 'Times New Roman'],
                'alignment' => [
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'wrap' => true,
                ],
            ],
        ];
    }

    /**
     * Override or extend default styles
     * @param array $customStyles
     * @return self
     */
    public function setStyles(array $customStyles) {
        $this->styles = array_merge($this->styles, $customStyles);
        return $this;
    }

    /**
     * Export report data to Excel with full formatting
     * 
     * @param array $reportResult Output from ReportEngine::runReport()
     * @param array $exportConfig Export-specific configuration:
     *   - title: string - Main title text
     *   - subtitle: string - Subtitle text
     *   - sheet_name: string - Worksheet name
     *   - column_widths: array - [col_index => width]
     *   - column_types: array - [col_key => 'number'|'text'|'center']
     *   - group_field: string - Field name to group/merge rows by
     *   - show_summary: bool - Show totals row
     *   - footer_left: string - Left footer text
     *   - footer_right: string - Right footer text
     *   - custom_styles: array - Override styles
     *   - filename: string - Output filename
     *   - format: 'xlsx'|'xls'
     * @return string Path to generated file
     */
    public function export(array $reportResult, array $exportConfig = []) {
        $this->currentRow = 1;
        
        // Apply custom styles if provided
        if (!empty($exportConfig['custom_styles'])) {
            $this->setStyles($exportConfig['custom_styles']);
        }

        // Sheet name
        $sheetName = $exportConfig['sheet_name'] ?? 'Report';
        $sheetName = substr(preg_replace('/[\\\\\/\?\*\[\]]/', '', $sheetName), 0, 31);
        $this->sheet->setTitle($sheetName);

        $headers = $reportResult['headers'];
        $data = $reportResult['data'];
        $colCount = count($headers);
        $headerKeys = array_keys($headers);

        // ── Title block ────────────────────────────────────────────
        $title = $exportConfig['title'] ?? ($reportResult['title'] ?? '');
        $subtitle = $exportConfig['subtitle'] ?? ($reportResult['subtitle'] ?? '');
        
        if ($title) {
            $this->sheet->setCellValueExplicitByColumnAndRow(0, $this->currentRow, decode_html($title), PHPExcel_Cell_DataType::TYPE_STRING);
            if ($colCount > 1) {
                $this->sheet->mergeCellsByColumnAndRow(0, $this->currentRow, $colCount - 1, $this->currentRow);
            }
            $this->sheet->getStyleByColumnAndRow(0, $this->currentRow)->applyFromArray($this->styles['title']);
            $this->sheet->getRowDimension($this->currentRow)->setRowHeight(30);
            $this->currentRow++;
        }
        
        if ($subtitle) {
            $this->sheet->setCellValueExplicitByColumnAndRow(0, $this->currentRow, decode_html($subtitle), PHPExcel_Cell_DataType::TYPE_STRING);
            if ($colCount > 1) {
                $this->sheet->mergeCellsByColumnAndRow(0, $this->currentRow, $colCount - 1, $this->currentRow);
            }
            $this->sheet->getStyleByColumnAndRow(0, $this->currentRow)->applyFromArray($this->styles['subtitle']);
            $this->sheet->getRowDimension($this->currentRow)->setRowHeight(25);
            $this->currentRow++;
        }
        
        // Empty row after title
        if ($title || $subtitle) {
            $this->currentRow++;
        }

        // ── Headers ────────────────────────────────────────────────
        $headerRow = $this->currentRow;
        $colIdx = 0;
        foreach ($headers as $key => $label) {
            $this->sheet->setCellValueExplicitByColumnAndRow($colIdx, $headerRow, decode_html($label), PHPExcel_Cell_DataType::TYPE_STRING);
            $this->sheet->getStyleByColumnAndRow($colIdx, $headerRow)->applyFromArray($this->styles['header']);
            $colIdx++;
        }
        $this->sheet->getRowDimension($headerRow)->setRowHeight(28);
        $this->currentRow++;

        // ── Data rows ──────────────────────────────────────────────
        $groupField = $exportConfig['group_field'] ?? ($reportResult['group_field'] ?? null);
        $columnTypes = $exportConfig['column_types'] ?? [];
        $dataStartRow = $this->currentRow;
        
        foreach ($data as $row) {
            $colIdx = 0;
            foreach ($headerKeys as $key) {
                $value = $row[$key] ?? '';
                $type = $columnTypes[$key] ?? 'text';
                
                if ($type === 'number' && is_numeric($value)) {
                    $this->sheet->setCellValueExplicitByColumnAndRow($colIdx, $this->currentRow, (float)$value, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                    $this->sheet->getStyleByColumnAndRow($colIdx, $this->currentRow)->applyFromArray($this->styles['data_number']);
                } elseif ($type === 'center') {
                    $this->sheet->setCellValueExplicitByColumnAndRow($colIdx, $this->currentRow, decode_html($value), PHPExcel_Cell_DataType::TYPE_STRING);
                    $this->sheet->getStyleByColumnAndRow($colIdx, $this->currentRow)->applyFromArray($this->styles['data_center']);
                } else {
                    $this->sheet->setCellValueExplicitByColumnAndRow($colIdx, $this->currentRow, decode_html($value), PHPExcel_Cell_DataType::TYPE_STRING);
                    $this->sheet->getStyleByColumnAndRow($colIdx, $this->currentRow)->applyFromArray($this->styles['data']);
                }
                $colIdx++;
            }
            $this->currentRow++;
        }
        $dataEndRow = $this->currentRow - 1;

        // ── Group merge (merge cells for grouped field) ────────────
        if ($groupField && !empty($data)) {
            $groupColIdx = array_search($groupField, $headerKeys);
            if ($groupColIdx !== false) {
                $this->mergeGroupedCells($groupColIdx, $dataStartRow, $dataEndRow, $data, $headerKeys, $groupField);
            }
        }

        // ── Summary row ────────────────────────────────────────────
        $showSummary = $exportConfig['show_summary'] ?? !empty($reportResult['summary']);
        if ($showSummary && !empty($reportResult['summary'])) {
            $colIdx = 0;
            foreach ($headerKeys as $key) {
                $value = $reportResult['summary'][$key] ?? '';
                if ($colIdx === 0 && empty($value)) {
                    $value = 'TỔNG CỘNG';
                }
                
                if (is_numeric($value) && $value !== '') {
                    $this->sheet->setCellValueExplicitByColumnAndRow($colIdx, $this->currentRow, (float)$value, PHPExcel_Cell_DataType::TYPE_NUMERIC);
                } else {
                    $this->sheet->setCellValueExplicitByColumnAndRow($colIdx, $this->currentRow, decode_html($value), PHPExcel_Cell_DataType::TYPE_STRING);
                }
                $this->sheet->getStyleByColumnAndRow($colIdx, $this->currentRow)->applyFromArray($this->styles['summary']);
                $colIdx++;
            }
            $this->currentRow++;
        }

        // ── Column widths ──────────────────────────────────────────
        $columnWidths = $exportConfig['column_widths'] ?? [];
        for ($i = 0; $i < $colCount; $i++) {
            if (isset($columnWidths[$i])) {
                $this->sheet->getColumnDimensionByColumn($i)->setWidth($columnWidths[$i]);
            } else {
                // Auto-width with minimum
                $this->sheet->getColumnDimensionByColumn($i)->setAutoSize(true);
            }
        }

        // ── Footer (signature block) ──────────────────────────────
        $footerLeft = $exportConfig['footer_left'] ?? '';
        $footerRight = $exportConfig['footer_right'] ?? '';
        
        if ($footerLeft || $footerRight) {
            $this->currentRow += 2; // spacing
            
            if ($footerLeft) {
                $startCol = ($colCount >= 5) ? 1 : 0;
                $endCol = ($colCount >= 5) ? 2 : 0;
                $this->sheet->setCellValueExplicitByColumnAndRow($startCol, $this->currentRow, decode_html($footerLeft), PHPExcel_Cell_DataType::TYPE_STRING);
                if ($endCol > $startCol) {
                    $this->sheet->mergeCellsByColumnAndRow($startCol, $this->currentRow, $endCol, $this->currentRow);
                }
                $this->sheet->getStyleByColumnAndRow($startCol, $this->currentRow)->applyFromArray($this->styles['footer']);
                $this->sheet->getRowDimension($this->currentRow)->setRowHeight(110);
            }
            
            if ($footerRight && $colCount > 2) {
                $startCol = ($colCount >= 5) ? ($colCount - 3) : ($colCount - 1);
                $endCol = ($colCount >= 5) ? ($colCount - 2) : ($colCount - 1);
                $this->sheet->setCellValueExplicitByColumnAndRow($startCol, $this->currentRow, decode_html($footerRight), PHPExcel_Cell_DataType::TYPE_STRING);
                if ($endCol > $startCol) {
                    $this->sheet->mergeCellsByColumnAndRow($startCol, $this->currentRow, $endCol, $this->currentRow);
                }
                $this->sheet->getStyleByColumnAndRow($startCol, $this->currentRow)->applyFromArray($this->styles['footer']);
            }
        }

        // ── Page setup ─────────────────────────────────────────────
        $this->sheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $this->sheet->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
        $this->sheet->getPageSetup()->setFitToWidth(1);
        $this->sheet->getPageSetup()->setFitToHeight(0);

        // ── Save to file ───────────────────────────────────────────
        $format = $exportConfig['format'] ?? 'xlsx';
        $filename = $exportConfig['filename'] ?? ('AdvancedReport_' . date('Ymd_His'));
        $filename = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $filename);
        
        $extension = ($format === 'xlsx') ? 'xlsx' : 'xls';
        $writerType = ($format === 'xlsx') ? 'Excel2007' : 'Excel5';
        
        if ($format === 'xlsx' && !class_exists('ZipArchive')) {
            PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
        }
        
        $filePath = "cache/upload/{$filename}.{$extension}";
        // Resolve to project root (where index.php lives)
        $rootDir = realpath(dirname(__FILE__) . '/../../../');
        $fullPath = $rootDir . '/' . $filePath;
        
        $workbookWriter = PHPExcel_IOFactory::createWriter($this->workbook, $writerType);
        $workbookWriter->save($fullPath);
        
        return $fullPath;
    }

    /**
     * Stream the export directly to browser (download)
     */
    public function exportToStream(array $reportResult, array $exportConfig = []) {
        $format = $exportConfig['format'] ?? 'xlsx';
        $filename = $exportConfig['filename'] ?? ('AdvancedReport_' . date('Ymd_His'));
        $filename = preg_replace('/[^a-zA-Z0-9_\-\x{0080}-\x{FFFF}]/u', '_', $filename);
        
        // Generate the file first
        $tempConfig = array_merge($exportConfig, ['filename' => 'temp_' . uniqid()]);
        $filePath = $this->export($reportResult, $tempConfig);
        
        $extension = ($format === 'xlsx') ? 'xlsx' : 'xls';
        $contentType = ($format === 'xlsx')
            ? 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            : 'application/vnd.ms-excel';
        
        header("Content-Disposition: attachment; filename=\"{$filename}.{$extension}\"");
        header("Content-Type: $contentType; charset=UTF-8");
        header("Expires: Mon, 31 Dec 2000 00:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Content-Length: " . filesize($filePath));
        
        ob_clean();
        readfile($filePath);
        unlink($filePath); // cleanup temp file
    }

    /**
     * Merge cells vertically for grouped data
     */
    private function mergeGroupedCells($colIdx, $startRow, $endRow, $data, $headerKeys, $groupField) {
        $mergeStart = $startRow;
        $lastValue = null;
        
        for ($row = $startRow; $row <= $endRow; $row++) {
            $dataIdx = $row - $startRow;
            $currentValue = $data[$dataIdx][$groupField] ?? '';
            
            if ($lastValue !== null && $currentValue !== $lastValue) {
                // Merge previous group
                if ($row - 1 > $mergeStart) {
                    $this->sheet->mergeCellsByColumnAndRow($colIdx, $mergeStart, $colIdx, $row - 1);
                    $this->sheet->getStyleByColumnAndRow($colIdx, $mergeStart)->getAlignment()
                        ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                }
                $mergeStart = $row;
            }
            $lastValue = $currentValue;
        }
        
        // Merge last group
        if ($endRow > $mergeStart) {
            $this->sheet->mergeCellsByColumnAndRow($colIdx, $mergeStart, $colIdx, $endRow);
            $this->sheet->getStyleByColumnAndRow($colIdx, $mergeStart)->getAlignment()
                ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        }
    }

    /**
     * Add an additional worksheet
     */
    public function addSheet($name) {
        $sheet = $this->workbook->createSheet();
        $name = substr(preg_replace('/[\\\\\/\?\*\[\]]/', '', $name), 0, 31);
        $sheet->setTitle($name);
        $this->sheet = $sheet;
        $this->currentRow = 1;
        return $this;
    }

    /**
     * Get the workbook object for advanced customization
     */
    public function getWorkbook() {
        return $this->workbook;
    }

    /**
     * Get the active sheet for direct manipulation
     */
    public function getSheet() {
        return $this->sheet;
    }
}
