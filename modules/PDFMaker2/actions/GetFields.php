<?php
/**
 * PDFMaker2 — GetFields Action (AJAX)
 * Returns fields for a given module, used by the template editor field picker.
 */
class PDFMaker2_GetFields_Action extends Vtiger_Action_Controller {

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
        $moduleName = $request->get('target_module');
        if (empty($moduleName)) {
            $response = new Vtiger_Response();
            $response->setResult(['success' => false, 'error' => 'No target_module specified']);
            $response->emit();
            return;
        }

        $resolver = new PDFMaker2_FieldResolver_Model();
        $blocks = $resolver->getFieldsForModule($moduleName);

        $response = new Vtiger_Response();
        $response->setResult([
            'success' => true,
            'module' => $moduleName,
            'blocks' => $blocks,
        ]);
        $response->emit();
    }
}
