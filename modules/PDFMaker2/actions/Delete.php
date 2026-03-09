<?php
/**
 * PDFMaker2 — Delete Action
 */
class PDFMaker2_Delete_Action extends Vtiger_Action_Controller {

    public function requiresPermission(Vtiger_Request $request) {
        return [];
    }

    public function checkPermission(Vtiger_Request $request) {
        $currentUser = Users_Record_Model::getCurrentUserModel();
        if (!$currentUser->isAdminUser()) {
            throw new AppException(vtranslate('LBL_PERMISSION_DENIED', 'Vtiger'));
        }
    }

    public function process(Vtiger_Request $request) {
        $templateId = $request->get('templateid');
        if ($templateId) {
            PDFMaker2_Record_Model::deleteById($templateId);
        }

        $response = new Vtiger_Response();
        $response->setResult(['success' => true]);
        $response->emit();
    }
}
