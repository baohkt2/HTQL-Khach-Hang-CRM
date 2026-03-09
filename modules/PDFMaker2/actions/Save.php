<?php
/**
 * PDFMaker2 — Save Action
 * Handles template creation and update.
 */
class PDFMaker2_Save_Action extends Vtiger_Action_Controller {

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

        $record = new PDFMaker2_Record_Model();
        if ($templateId) {
            $record = PDFMaker2_Record_Model::getInstanceById($templateId);
            if (!$record) {
                $record = new PDFMaker2_Record_Model();
            }
        }

        $record->set('templateid', $templateId ?: null);
        $record->set('template_name', $request->get('template_name'));
        $record->set('description', $request->get('description'));
        $record->set('body', $request->getRaw('body')); // HTML content, raw
        $record->set('header', $request->getRaw('header'));
        $record->set('footer', $request->getRaw('footer'));
        $record->set('format', $request->get('format'));
        $record->set('orientation', $request->get('orientation'));
        $record->set('margin_top', $request->get('margin_top'));
        $record->set('margin_bottom', $request->get('margin_bottom'));
        $record->set('margin_left', $request->get('margin_left'));
        $record->set('margin_right', $request->get('margin_right'));
        $record->set('target_modules', $request->get('target_modules'));

        $savedId = $record->save();

        // Redirect back to list
        header('Location: index.php?module=PDFMaker2&parent=Settings&view=List');
        exit;
    }
}
