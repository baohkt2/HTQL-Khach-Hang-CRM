<?php
/**
 * PDFMaker2 — PDF Renderer
 * Uses the existing mPDF library from PDFMaker to render HTML to PDF.
 */
class PDFMaker2_PDFRenderer_Model {

    /**
     * Render a template for a specific record and output as PDF download.
     *
     * @param int $templateId Template ID
     * @param int $recordId CRM record ID
     * @param string $moduleName Source module
     * @param string $outputMode 'download' (default), 'inline', 'string' (return binary)
     * @return string|void PDF binary if outputMode='string', otherwise outputs and exits
     */
    public static function render($templateId, $recordId, $moduleName, $outputMode = 'download') {
        // Load template
        $template = PDFMaker2_Record_Model::getInstanceById($templateId);
        if (!$template) {
            throw new Exception("Template not found: $templateId");
        }

        // Resolve variables
        $resolver = new PDFMaker2_FieldResolver_Model();
        $bodyHtml = $resolver->resolveVariables($template->get('body'), $recordId, $moduleName);
        $headerHtml = $resolver->resolveVariables($template->get('header') ?: '', $recordId, $moduleName);
        $footerHtml = $resolver->resolveVariables($template->get('footer') ?: '', $recordId, $moduleName);

        // Setup mPDF
        $mpdfPath = 'modules/PDFMaker/resources/mpdf/mpdf.php';
        if (!file_exists($mpdfPath)) {
            throw new Exception("mPDF library not found at: $mpdfPath");
        }
        require_once $mpdfPath;

        $format = $template->get('format') ?: 'A4';
        $orientation = $template->get('orientation') ?: 'portrait';

        $orientCode = ($orientation == 'landscape') ? 'L' : 'P';

        // Handle custom format (e.g. "210;297")
        if (strpos($format, ';') !== false) {
            $dims = explode(';', $format);
            $format = [(float)$dims[0], (float)$dims[1]];
        } elseif ($orientation == 'landscape') {
            $format .= '-L';
        }

        $mpdf = new mPDF(
            'utf-8',
            $format,
            0,
            'timesnewroman',
            $template->get('margin_left') ?: 10,
            $template->get('margin_right') ?: 10,
            $template->get('margin_top') ?: 10,
            $template->get('margin_bottom') ?: 10,
            9,
            9,
            $orientCode
        );

        $mpdf->SetDisplayMode('fullpage');
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = false;
        $mpdf->useSubstitutions = true;

        if (!empty($headerHtml)) {
            @$mpdf->SetHTMLHeader($headerHtml);
        }
        if (!empty($footerHtml)) {
            @$mpdf->SetHTMLFooter($footerHtml);
        }

        @$mpdf->WriteHTML($bodyHtml);

        // Generate filename
        $filename = self::generateFilename($template->get('template_name'), $recordId, $moduleName);

        switch ($outputMode) {
            case 'inline':
                $mpdf->Output($filename, 'I');
                exit;
            case 'string':
                return $mpdf->Output($filename, 'S');
            case 'download':
            default:
                $mpdf->Output($filename, 'D');
                exit;
        }
    }

    /**
     * Generate PDF files for multiple records and return as ZIP.
     *
     * @param int $templateId
     * @param array $recordIds
     * @param string $moduleName
     * @return string Path to ZIP file
     */
    public static function renderBatch($templateId, array $recordIds, $moduleName) {
        set_time_limit(300);
        ini_set('memory_limit', '512M');

        $template = PDFMaker2_Record_Model::getInstanceById($templateId);
        if (!$template) {
            throw new Exception("Template not found: $templateId");
        }

        $zipDir = 'cache/pdfmaker2/zip';
        $pdfDir = 'cache/pdfmaker2/pdf';
        if (!is_dir($zipDir)) mkdir($zipDir, 0755, true);
        if (!is_dir($pdfDir)) mkdir($pdfDir, 0755, true);

        $rawTemplateName = html_entity_decode($template->get('template_name'), ENT_QUOTES, 'UTF-8');
        $zipFileName = preg_replace('/[^a-zA-Z0-9_\-\.\x{00C0}-\x{024F}\x{1E00}-\x{1EFF} ]/u', '', $rawTemplateName);
        if (empty($zipFileName)) $zipFileName = 'export';
        $zipFileName .= '_' . date('Y-m-d_His') . '.zip';
        $zipFilePath = $zipDir . '/' . $zipFileName;

        $zip = new ZipArchive();
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            throw new Exception("Cannot create ZIP file");
        }

        $resolver = new PDFMaker2_FieldResolver_Model();

        // Setup mPDF base config
        $mpdfPath = 'modules/PDFMaker/resources/mpdf/mpdf.php';
        require_once $mpdfPath;

        foreach ($recordIds as $recordId) {
            try {
                $bodyHtml = $resolver->resolveVariables($template->get('body'), $recordId, $moduleName);
                $headerHtml = $resolver->resolveVariables($template->get('header') ?: '', $recordId, $moduleName);
                $footerHtml = $resolver->resolveVariables($template->get('footer') ?: '', $recordId, $moduleName);

                $format = $template->get('format') ?: 'A4';
                $orientation = $template->get('orientation') ?: 'portrait';
                $orientCode = ($orientation == 'landscape') ? 'L' : 'P';

                if (strpos($format, ';') !== false) {
                    $dims = explode(';', $format);
                    $format = [(float)$dims[0], (float)$dims[1]];
                } elseif ($orientation == 'landscape') {
                    $format .= '-L';
                }

                $mpdf = new mPDF('utf-8', $format, 0, 'timesnewroman',
                    $template->get('margin_left') ?: 10,
                    $template->get('margin_right') ?: 10,
                    $template->get('margin_top') ?: 10,
                    $template->get('margin_bottom') ?: 10,
                    9,
                    9,
                    $orientCode
                );
                $mpdf->autoScriptToLang = true;
                $mpdf->autoLangToFont = false;
                $mpdf->useSubstitutions = true;

                if (!empty($headerHtml)) @$mpdf->SetHTMLHeader($headerHtml);
                if (!empty($footerHtml)) @$mpdf->SetHTMLFooter($footerHtml);
                @$mpdf->WriteHTML($bodyHtml);

                $pdfFilename = self::generateFilename($template->get('template_name'), $recordId, $moduleName);
                $pdfPath = $pdfDir . '/' . $pdfFilename;
                $mpdf->Output($pdfPath, 'F');

                $zip->addFile($pdfPath, $pdfFilename);
            } catch (Exception $e) {
                error_log("PDFMaker2: Error generating PDF for record $recordId: " . $e->getMessage());
            }
        }

        $zip->close();

        // Clean up individual PDFs
        array_map('unlink', glob($pdfDir . '/*.pdf'));

        return $zipFilePath;
    }

    /**
     * Generate a clean filename for the PDF.
     */
    private static function generateFilename($templateName, $recordId, $moduleName) {
        $db = PearDatabase::getInstance();
        $tabId = getTabId($moduleName);

        // Try to get the record's identifier field (uitype 4 = number field)
        $result = $db->pquery("SELECT fieldname FROM vtiger_field WHERE uitype = ? AND tabid = ?", [4, $tabId]);
        $entityName = '';
        if ($db->num_rows($result) > 0) {
            $fieldname = $db->query_result($result, 0, 'fieldname');
            $focus = CRMEntity::getInstance($moduleName);
            $focus->retrieve_entity_info($recordId, $moduleName);
            $entityName = $focus->column_fields[$fieldname] ?? '';
        }

        if (empty($entityName)) {
            $names = getEntityName($moduleName, [$recordId]);
            $entityName = $names[$recordId] ?? "record_$recordId";
        }

        $cleanName = preg_replace('/[^a-zA-Z0-9_\-\.\x{00C0}-\x{024F}\x{1E00}-\x{1EFF} ]/u', '', html_entity_decode($entityName, ENT_QUOTES, 'UTF-8'));
        $cleanTemplate = preg_replace('/[^a-zA-Z0-9_\-\.\x{00C0}-\x{024F}\x{1E00}-\x{1EFF} ]/u', '', html_entity_decode($templateName, ENT_QUOTES, 'UTF-8'));

        return $cleanTemplate . ' - ' . $cleanName . '.pdf';
    }
}
