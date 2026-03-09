<?php
/**
 * PDFMaker2 — GeneratePDF Action
 * Generates a PDF for a single record using the specified template.
 */
class PDFMaker2_GeneratePDF_Action extends Vtiger_Action_Controller {

    public function requiresPermission(Vtiger_Request $request) {
        return [];
    }

    public function checkPermission(Vtiger_Request $request) {
        // Any logged-in user can export PDF
        $currentUser = Users_Record_Model::getCurrentUserModel();
        if (!$currentUser || !$currentUser->getId()) {
            throw new AppException(vtranslate('LBL_PERMISSION_DENIED', 'Vtiger'));
        }
    }

    public function process(Vtiger_Request $request) {
        $templateId = $request->get('templateid');
        $recordId = $request->get('record');
        $sourceModule = $request->get('source_module');
        $outputMode = $request->get('output_mode') ?: 'download';

        if (empty($templateId) || empty($recordId) || empty($sourceModule)) {
            header('HTTP/1.1 400 Bad Request');
            echo 'Missing required parameters: templateid, record, source_module';
            return;
        }

        // Validate output mode
        if (!in_array($outputMode, ['download', 'inline'])) {
            $outputMode = 'download';
        }

        try {
            PDFMaker2_PDFRenderer_Model::render($templateId, $recordId, $sourceModule, $outputMode);
        } catch (Exception $e) {
            header('HTTP/1.1 500 Internal Server Error');
            echo 'PDF Generation Error: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
        }
    }
}
