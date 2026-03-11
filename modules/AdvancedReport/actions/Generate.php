<?php
/**
 * AdvancedReport - Generate Action
 * 
 * Handles AJAX requests to generate report data (preview).
 * URL: index.php?module=AdvancedReport&action=Generate
 */
class AdvancedReport_Generate_Action extends Vtiger_Action_Controller {

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
            $reportConfig = $this->getReportConfig($request);
            
            require_once 'modules/AdvancedReport/models/QueryBuilder.php';
            require_once 'modules/AdvancedReport/models/ReportEngine.php';
            
            $engine = new AdvancedReport_ReportEngine_Model();
            $result = $engine->runReport($reportConfig);

            $response = new Vtiger_Response();
            $response->setResult([
                'success' => true,
                'headers' => $result['headers'],
                'data' => $result['data'],
                'summary' => $result['summary'] ?? [],
                'meta' => $result['meta'] ?? [
                    'total_rows' => count($result['data']),
                    'generated_at' => date('Y-m-d H:i:s'),
                ],
            ]);
            $response->emit();
        } catch (\Exception $e) {
            $response = new Vtiger_Response();
            $response->setError($e->getCode(), $e->getMessage());
            $response->emit();
        }
    }

    /**
     * Extract report config from request
     */
    private function getReportConfig(Vtiger_Request $request) {
        $mode = $request->get('mode');
        
        if ($mode === 'saved') {
            // Load saved config
            require_once 'modules/AdvancedReport/models/ReportEngine.php';
            $engine = new AdvancedReport_ReportEngine_Model();
            $saved = $engine->loadReportConfig((int)$request->get('config_id'));
            $config = $saved['config'];
            
            // Allow overriding filters from request
            $this->applyRequestOverrides($config, $request);
            return $config;
        }
        
        // Dynamic config from request
        $configJson = $request->get('report_config');
        if ($configJson) {
            $config = json_decode($configJson, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \InvalidArgumentException('Invalid report config JSON');
            }
            return $config;
        }
        
        // Build config from individual parameters
        return $this->buildConfigFromParams($request);
    }

    /**
     * Build report config from individual request parameters
     */
    private function buildConfigFromParams(Vtiger_Request $request) {
        $config = [
            'report_type' => $request->get('report_type') ?: 'custom',
        ];
        
        // Campaign-specific parameters
        $campaignId = $request->get('campaign_id');
        if ($campaignId) {
            $config['campaign_id'] = is_array($campaignId) ? $campaignId : [$campaignId];
        }
        
        $campaignStatus = $request->get('campaign_status');
        if ($campaignStatus) {
            $config['campaign_status'] = $campaignStatus;
        }
        
        $dateFrom = $request->get('date_from');
        if ($dateFrom) {
            $config['date_from'] = $dateFrom;
        }
        
        $dateTo = $request->get('date_to');
        if ($dateTo) {
            $config['date_to'] = $dateTo;
        }
        
        $activityTypes = $request->get('activity_types');
        if ($activityTypes) {
            $config['activity_types'] = is_array($activityTypes) ? $activityTypes : explode(',', $activityTypes);
        }
        
        $maxFollowup = $request->get('max_followup');
        if ($maxFollowup) {
            $config['max_followup'] = (int)$maxFollowup;
        }
        
        return $config;
    }

    /**
     * Apply request-time overrides to a saved config
     */
    private function applyRequestOverrides(array &$config, Vtiger_Request $request) {
        $overrides = ['campaign_id', 'campaign_status', 'date_from', 'date_to', 'activity_types'];
        foreach ($overrides as $key) {
            $value = $request->get($key);
            if ($value !== null && $value !== '') {
                $config[$key] = $value;
            }
        }
    }
}
