<?php
/**
 * AdvancedReport - Export Action
 * 
 * Handles Excel/CSV export of report data.
 * URL: index.php?module=AdvancedReport&action=Export
 */
class AdvancedReport_Export_Action extends Vtiger_Action_Controller {

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
            require_once 'modules/AdvancedReport/models/ExcelExporter.php';

            // Get report config
            $reportConfig = $this->getReportConfig($request);
            
            // Generate report data
            $engine = new AdvancedReport_ReportEngine_Model();
            $reportResult = $engine->runReport($reportConfig);
            
            // Get export config
            $exportConfig = $this->getExportConfig($request, $reportResult);
            
            // Export
            $exporter = new AdvancedReport_ExcelExporter_Model();
            $exporter->exportToStream($reportResult, $exportConfig);
            
        } catch (\Exception $e) {
            // For file download actions, we need to output an error differently
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    /**
     * Extract report config from request
     */
    private function getReportConfig(Vtiger_Request $request) {
        $mode = $request->get('mode');
        
        if ($mode === 'saved') {
            $engine = new AdvancedReport_ReportEngine_Model();
            $saved = $engine->loadReportConfig((int)$request->get('config_id'));
            $config = $saved['config'];
            $this->applyRequestOverrides($config, $request);
            return $config;
        }
        
        $configJson = $request->get('report_config');
        if ($configJson) {
            $config = json_decode($configJson, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \InvalidArgumentException('Invalid report config JSON');
            }
            return $config;
        }
        
        return $this->buildConfigFromParams($request);
    }

    /**
     * Build export configuration from request
     */
    private function getExportConfig(Vtiger_Request $request, array $reportResult) {
        $config = [
            'format' => $request->get('export_format') ?: 'xlsx',
            'filename' => $request->get('filename') ?: ('BaoCao_' . date('Ymd_His')),
        ];

        $title = $request->get('export_title');
        if ($title) $config['title'] = $title;

        $subtitle = $request->get('export_subtitle');
        if ($subtitle) $config['subtitle'] = $subtitle;

        $sheetName = $request->get('sheet_name');
        if ($sheetName) $config['sheet_name'] = $sheetName;

        // Column widths from request (JSON array)
        $colWidths = $request->get('column_widths');
        if ($colWidths) {
            $config['column_widths'] = is_array($colWidths) ? $colWidths : json_decode($colWidths, true);
        }

        // Column types from request (JSON object)
        $colTypes = $request->get('column_types');
        if ($colTypes) {
            $config['column_types'] = is_array($colTypes) ? $colTypes : json_decode($colTypes, true);
        }

        // Group field for merged cells
        $groupField = $request->get('group_field');
        if ($groupField) $config['group_field'] = $groupField;

        // Summary row
        $config['show_summary'] = ($request->get('show_summary') !== '0');

        // Footer
        $footerLeft = $request->get('footer_left');
        if ($footerLeft) $config['footer_left'] = $footerLeft;

        $footerRight = $request->get('footer_right');
        if ($footerRight) $config['footer_right'] = $footerRight;

        return $config;
    }

    private function buildConfigFromParams(Vtiger_Request $request) {
        $config = [
            'report_type' => $request->get('report_type') ?: 'custom',
        ];
        
        $campaignId = $request->get('campaign_id');
        if ($campaignId) {
            $config['campaign_id'] = is_array($campaignId) ? $campaignId : [$campaignId];
        }
        
        $campaignStatus = $request->get('campaign_status');
        if ($campaignStatus) $config['campaign_status'] = $campaignStatus;
        
        $dateFrom = $request->get('date_from');
        if ($dateFrom) $config['date_from'] = $dateFrom;
        
        $dateTo = $request->get('date_to');
        if ($dateTo) $config['date_to'] = $dateTo;
        
        $activityTypes = $request->get('activity_types');
        if ($activityTypes) {
            $config['activity_types'] = is_array($activityTypes) ? $activityTypes : explode(',', $activityTypes);
        }
        
        $maxFollowup = $request->get('max_followup');
        if ($maxFollowup) $config['max_followup'] = (int)$maxFollowup;
        
        return $config;
    }

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
