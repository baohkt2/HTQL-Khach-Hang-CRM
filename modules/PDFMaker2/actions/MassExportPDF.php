<?php
/**
 * PDFMaker2 — MassExportPDF Action
 * Generates PDFs for multiple selected records and downloads as ZIP.
 */
class PDFMaker2_MassExportPDF_Action extends Vtiger_Action_Controller {

    public function requiresPermission(Vtiger_Request $request) {
        return [];
    }

    public function checkPermission(Vtiger_Request $request) {
        $currentUser = Users_Record_Model::getCurrentUserModel();
        if (!$currentUser || !$currentUser->getId()) {
            throw new AppException(vtranslate('LBL_PERMISSION_DENIED', 'Vtiger'));
        }
    }

    public function process(Vtiger_Request $request) {
        $templateId = $request->get('templateid');
        $sourceModule = $request->get('source_module');
        $recordIdsRaw = $request->get('record_ids');

        if (empty($templateId) || empty($sourceModule) || empty($recordIdsRaw)) {
            header('HTTP/1.1 400 Bad Request');
            echo 'Missing required parameters: templateid, source_module, record_ids';
            return;
        }

        // Parse record IDs
        if (is_string($recordIdsRaw)) {
            $recordIds = array_filter(array_map('intval', explode(',', $recordIdsRaw)));
        } else {
            $recordIds = array_filter(array_map('intval', (array)$recordIdsRaw));
        }

        if (empty($recordIds)) {
            header('HTTP/1.1 400 Bad Request');
            echo 'No valid record IDs provided';
            return;
        }

        // Limit batch size
        if (count($recordIds) > 200) {
            $recordIds = array_slice($recordIds, 0, 200);
        }

        try {
            $zipFilePath = PDFMaker2_PDFRenderer_Model::renderBatch($templateId, $recordIds, $sourceModule);

            if (!file_exists($zipFilePath)) {
                throw new Exception('ZIP file was not created');
            }

            $zipFileName = basename($zipFilePath);
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="' . rawurlencode($zipFileName) . '"; filename*=UTF-8\'\'' . rawurlencode($zipFileName));
            header('Content-Length: ' . filesize($zipFilePath));
            header('Cache-Control: no-cache, must-revalidate');
            readfile($zipFilePath);

            // Cleanup
            @unlink($zipFilePath);
            exit;
        } catch (Exception $e) {
            header('HTTP/1.1 500 Internal Server Error');
            echo 'Mass PDF Export Error: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
        }
    }
}
