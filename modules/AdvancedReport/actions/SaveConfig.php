<?php
/**
 * AdvancedReport - SaveConfig Action
 * 
 * CRUD operations for saved report configurations.
 * URL: index.php?module=AdvancedReport&action=SaveConfig
 */
class AdvancedReport_SaveConfig_Action extends Vtiger_Action_Controller {

    public function requiresPermission(\Vtiger_Request $request) {
        return array();
    }

    public function checkPermission(Vtiger_Request $request) {
        $currentUser = Users_Record_Model::getCurrentUserModel();
        if (!$currentUser || !$currentUser->getId()) {
            throw new AppException(vtranslate('LBL_PERMISSION_DENIED'));
        }
    }

    public function process(Vtiger_Request $request) {
        try {
            require_once 'modules/AdvancedReport/models/QueryBuilder.php';
            require_once 'modules/AdvancedReport/models/ReportEngine.php';

            $mode = $request->getMode();
            $engine = new AdvancedReport_ReportEngine_Model();

            switch ($mode) {
                case 'save':
                    $configJson = $request->get('config');
                    $config = json_decode($configJson, true);
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        throw new \InvalidArgumentException('Invalid config JSON');
                    }
                    $config['name'] = $request->get('name');
                    $config['description'] = $request->get('description') ?: '';
                    
                    $id = $request->get('config_id');
                    if ($id) {
                        $config['id'] = (int)$id;
                    }
                    
                    $savedId = $engine->saveReportConfig($config);
                    $response = new Vtiger_Response();
                    $response->setResult(['success' => true, 'id' => $savedId]);
                    $response->emit();
                    break;

                case 'delete':
                    $id = (int)$request->get('config_id');
                    $engine->deleteReportConfig($id);
                    $response = new Vtiger_Response();
                    $response->setResult(['success' => true]);
                    $response->emit();
                    break;

                case 'load':
                    $id = (int)$request->get('config_id');
                    $saved = $engine->loadReportConfig($id);
                    $response = new Vtiger_Response();
                    $response->setResult(['success' => true, 'config' => $saved]);
                    $response->emit();
                    break;

                case 'list':
                default:
                    $type = $request->get('report_type');
                    $list = $engine->listReportConfigs($type ?: null);
                    $response = new Vtiger_Response();
                    $response->setResult(['success' => true, 'configs' => $list]);
                    $response->emit();
                    break;
            }
        } catch (\Exception $e) {
            $response = new Vtiger_Response();
            $response->setError($e->getCode(), $e->getMessage());
            $response->emit();
        }
    }
}
