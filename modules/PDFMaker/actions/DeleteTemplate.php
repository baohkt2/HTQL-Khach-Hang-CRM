<?php
/**
 * PDFMaker — DeleteTemplate Action
 * Soft-deletes a PDF template by setting deleted=1.
 */
class PDFMaker_DeleteTemplate_Action extends Vtiger_Action_Controller {

    public function checkPermission(Vtiger_Request $request) {
        $currentUser = Users_Record_Model::getCurrentUserModel();
        if (!$currentUser->isAdminUser()) {
            throw new AppException(vtranslate('LBL_PERMISSION_DENIED', 'Vtiger'));
        }
    }

    public function process(Vtiger_Request $request) {
        $templateid = $request->get('templateid');

        if (!empty($templateid)) {
            $adb = PearDatabase::getInstance();
            $adb->pquery("UPDATE vtiger_pdfmaker SET deleted = 1 WHERE templateid = ?", array($templateid));
        }

        $response = new Vtiger_Response();
        $response->setResult(array('success' => true));
        $response->emit();
    }
}
