<?php
/**
 * PDFMaker2 — GetTemplates View
 * AJAX endpoint: returns templates for a given source module (used by the Export PDF button).
 */
class PDFMaker2_GetTemplates_View extends Vtiger_BasicAjax_View {

    public function requiresPermission(Vtiger_Request $request) {
        return [];
    }

    public function checkPermission(Vtiger_Request $request) {
        $currentUser = Users_Record_Model::getCurrentUserModel();
        if (!$currentUser || !$currentUser->getId()) {
            throw new AppException(vtranslate('LBL_PERMISSION_DENIED', 'Vtiger'));
        }
        return true;
    }

    public function process(Vtiger_Request $request) {
        $sourceModule = $request->get('source_module');
        if (empty($sourceModule)) {
            echo json_encode(['success' => false, 'error' => 'No source_module specified']);
            return;
        }

        $templates = PDFMaker2_Record_Model::getTemplatesForModule($sourceModule);

        $response = new Vtiger_Response();
        $response->setResult([
            'success' => true,
            'templates' => $templates,
            'module' => $sourceModule
        ]);
        $response->emit();
    }
}
