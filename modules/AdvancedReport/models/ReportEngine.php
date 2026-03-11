<?php
/**
 * AdvancedReport - Report Engine
 * 
 * Provides pre-built report configurations and data processing.
 * Each "report type" is a method that returns a config for the QueryBuilder,
 * plus post-processing logic for the raw data.
 */
class AdvancedReport_ReportEngine_Model {

    /** @var PearDatabase */
    private $db;

    /** @var AdvancedReport_QueryBuilder_Model */
    private $queryBuilder;

    public function __construct() {
        $this->db = PearDatabase::getInstance();
        $this->queryBuilder = new AdvancedReport_QueryBuilder_Model();
    }

    /**
     * Run a report from a saved config or a dynamic config
     * @param array $reportConfig
     * @return array ['headers' => [...], 'data' => [...], 'summary' => [...]]
     */
    public function runReport(array $reportConfig) {
        $reportType = $reportConfig['report_type'] ?? 'custom';
        
        switch ($reportType) {
            case 'campaign_contact_stats':
                return $this->campaignContactStats($reportConfig);
            case 'campaign_activity_stats':
                return $this->campaignActivityStats($reportConfig);
            case 'campaign_followup_stats':
                return $this->campaignFollowupStats($reportConfig);
            case 'campaign_account_breakdown':
                return $this->campaignAccountBreakdown($reportConfig);
            case 'organization_group_export':
                return $this->organizationGroupExport($reportConfig);
            case 'custom':
            default:
                return $this->customReport($reportConfig);
        }
    }

    // ═══════════════════════════════════════════════════════════════════
    // Issue 1.1: Campaign Contact Stats (calls/emails sent count)
    // ═══════════════════════════════════════════════════════════════════

    /**
     * Report: How many contacts have been called/emailed in a campaign
     * @param array $params ['campaign_id' => int|array, 'activity_types' => ['Call','Emails']]
     */
    public function campaignContactStats(array $params) {
        $campaignFilter = $this->buildCampaignFilter($params);
        $activityTypes = $params['activity_types'] ?? ['Call', 'Emails'];
        
        $placeholders = implode(',', array_fill(0, count($activityTypes), '?'));
        
        $sql = "
            SELECT 
                c.campaignname,
                c.campaignid,
                COUNT(DISTINCT ccr.contactid) AS total_contacts_in_campaign,
                COUNT(DISTINCT CASE WHEN act.activitytype IN ($placeholders) THEN ccr.contactid END) AS contacted_count,
                SUM(CASE WHEN act.activitytype = 'Call' THEN 1 ELSE 0 END) AS total_calls,
                SUM(CASE WHEN act.activitytype = 'Emails' THEN 1 ELSE 0 END) AS total_emails,
                ROUND(
                    COUNT(DISTINCT CASE WHEN act.activitytype IN ($placeholders) THEN ccr.contactid END) * 100.0 
                    / NULLIF(COUNT(DISTINCT ccr.contactid), 0), 2
                ) AS contact_rate_percent
            FROM vtiger_campaign c
            INNER JOIN vtiger_crmentity ce ON ce.crmid = c.campaignid AND ce.deleted = 0
            LEFT JOIN vtiger_campaigncontrel ccr ON ccr.campaignid = c.campaignid
            LEFT JOIN vtiger_contactdetails cd ON cd.contactid = ccr.contactid
            LEFT JOIN vtiger_crmentity ce_contact ON ce_contact.crmid = cd.contactid AND ce_contact.deleted = 0
            LEFT JOIN vtiger_seactivityrel sar ON sar.crmid = cd.contactid
            LEFT JOIN vtiger_activity act ON act.activityid = sar.activityid
            LEFT JOIN vtiger_crmentity ce_act ON ce_act.crmid = act.activityid AND ce_act.deleted = 0
            {$campaignFilter['where']}
            GROUP BY c.campaignid, c.campaignname
            ORDER BY c.campaignname ASC
        ";
        
        $queryParams = array_merge(
            $activityTypes, 
            $activityTypes, 
            $campaignFilter['params']
        );
        
        $result = $this->db->pquery($sql, $queryParams);
        $data = $this->fetchAll($result);
        
        return [
            'headers' => [
                'campaignname' => 'Tên Kế Hoạch',
                'total_contacts_in_campaign' => 'Tổng Liên Hệ',
                'contacted_count' => 'Đã Liên Hệ',
                'total_calls' => 'Số Cuộc Gọi',
                'total_emails' => 'Số Email',
                'contact_rate_percent' => 'Tỷ Lệ (%)',
            ],
            'data' => $data,
            'summary' => $this->buildSummary($data, ['total_contacts_in_campaign', 'contacted_count', 'total_calls', 'total_emails']),
        ];
    }

    // ═══════════════════════════════════════════════════════════════════
    // Issue 1.2: Stats per Account in Campaign
    // ═══════════════════════════════════════════════════════════════════

    /**
     * Report: Break down contacts called/emailed per Organization (Account)
     */
    public function campaignAccountBreakdown(array $params) {
        $campaignFilter = $this->buildCampaignFilter($params);
        
        $sql = "
            SELECT 
                c.campaignname,
                acc.accountname,
                acc.accountid,
                COUNT(DISTINCT ccr.contactid) AS total_contacts,
                SUM(CASE WHEN act.activitytype = 'Call' THEN 1 ELSE 0 END) AS total_calls,
                SUM(CASE WHEN act.activitytype = 'Emails' THEN 1 ELSE 0 END) AS total_emails,
                COUNT(DISTINCT CASE WHEN act.activityid IS NOT NULL THEN ccr.contactid END) AS contacted_count
            FROM vtiger_campaign c
            INNER JOIN vtiger_crmentity ce ON ce.crmid = c.campaignid AND ce.deleted = 0
            LEFT JOIN vtiger_campaigncontrel ccr ON ccr.campaignid = c.campaignid
            LEFT JOIN vtiger_contactdetails cd ON cd.contactid = ccr.contactid
            LEFT JOIN vtiger_crmentity ce_contact ON ce_contact.crmid = cd.contactid AND ce_contact.deleted = 0
            LEFT JOIN vtiger_account acc ON acc.accountid = cd.accountid
            LEFT JOIN vtiger_seactivityrel sar ON sar.crmid = cd.contactid
            LEFT JOIN vtiger_activity act ON act.activityid = sar.activityid 
                AND act.activitytype IN ('Call', 'Emails')
            LEFT JOIN vtiger_crmentity ce_act ON ce_act.crmid = act.activityid AND ce_act.deleted = 0
            {$campaignFilter['where']}
            GROUP BY c.campaignid, c.campaignname, acc.accountid, acc.accountname
            ORDER BY c.campaignname ASC, acc.accountname ASC
        ";
        
        $result = $this->db->pquery($sql, $campaignFilter['params']);
        $data = $this->fetchAll($result);
        
        return [
            'headers' => [
                'campaignname' => 'Tên Kế Hoạch',
                'accountname' => 'Tổ Chức',
                'total_contacts' => 'Tổng Liên Hệ',
                'contacted_count' => 'Đã Liên Hệ',
                'total_calls' => 'Số Cuộc Gọi',
                'total_emails' => 'Số Email',
            ],
            'data' => $data,
            'summary' => $this->buildSummary($data, ['total_contacts', 'contacted_count', 'total_calls', 'total_emails']),
        ];
    }

    // ═══════════════════════════════════════════════════════════════════
    // Issue 1.3: Follow-up stats (1st, 2nd, 3rd follow-up)
    // ═══════════════════════════════════════════════════════════════════

    /**
     * Report: Count contacts by follow-up attempt number
     * Uses activity sequence (ordered by date) to determine follow-up level
     */
    public function campaignFollowupStats(array $params) {
        $campaignFilter = $this->buildCampaignFilter($params);
        $maxFollowup = (int)($params['max_followup'] ?? 3);
        
        // Build CASE expressions for each follow-up level
        $followupCases = [];
        $followupHeaders = [];
        for ($i = 1; $i <= $maxFollowup; $i++) {
            $followupCases[] = "SUM(CASE WHEN activity_rank = $i THEN 1 ELSE 0 END) AS followup_{$i}_count";
            $followupHeaders["followup_{$i}_count"] = "Lần $i";
        }
        $followupSelect = implode(",\n                ", $followupCases);
        
        $sql = "
            SELECT 
                sub.campaignname,
                sub.campaignid,
                COUNT(DISTINCT sub.contactid) AS total_contacts,
                $followupSelect,
                SUM(CASE WHEN activity_rank > $maxFollowup THEN 1 ELSE 0 END) AS followup_more_count
            FROM (
                SELECT 
                    c.campaignname,
                    c.campaignid,
                    ccr.contactid,
                    act.activityid,
                    act.activitytype,
                    act.date_start,
                    ROW_NUMBER() OVER (
                        PARTITION BY c.campaignid, ccr.contactid 
                        ORDER BY act.date_start ASC, act.activityid ASC
                    ) AS activity_rank
                FROM vtiger_campaign c
                INNER JOIN vtiger_crmentity ce ON ce.crmid = c.campaignid AND ce.deleted = 0
                INNER JOIN vtiger_campaigncontrel ccr ON ccr.campaignid = c.campaignid
                INNER JOIN vtiger_contactdetails cd ON cd.contactid = ccr.contactid
                INNER JOIN vtiger_crmentity ce_contact ON ce_contact.crmid = cd.contactid AND ce_contact.deleted = 0
                INNER JOIN vtiger_seactivityrel sar ON sar.crmid = cd.contactid
                INNER JOIN vtiger_activity act ON act.activityid = sar.activityid 
                    AND act.activitytype IN ('Call', 'Emails')
                INNER JOIN vtiger_crmentity ce_act ON ce_act.crmid = act.activityid AND ce_act.deleted = 0
                {$campaignFilter['where']}
            ) sub
            GROUP BY sub.campaignid, sub.campaignname
            ORDER BY sub.campaignname ASC
        ";
        
        $result = $this->db->pquery($sql, $campaignFilter['params']);
        $data = $this->fetchAll($result);
        
        $headers = [
            'campaignname' => 'Tên Kế Hoạch',
            'total_contacts' => 'Tổng Liên Hệ',
        ];
        $headers = array_merge($headers, $followupHeaders);
        $headers['followup_more_count'] = "Trên $maxFollowup lần";
        
        $summaryFields = ['total_contacts'];
        for ($i = 1; $i <= $maxFollowup; $i++) {
            $summaryFields[] = "followup_{$i}_count";
        }
        $summaryFields[] = 'followup_more_count';
        
        return [
            'headers' => $headers,
            'data' => $data,
            'summary' => $this->buildSummary($data, $summaryFields),
        ];
    }

    // ═══════════════════════════════════════════════════════════════════
    // Issue 2: Organization Group Export (matching screenshot format)
    // ═══════════════════════════════════════════════════════════════════

    /**
     * Report: Export data grouped by organization/province matching template format
     * Output columns: STT, TÊN TRƯỜNG, TỈNH, TỈNH SAU SẮP NHẬP, MỨC ĐỘ ƯU TIÊN, SỐ LƯỢNG HỌC
     * 
     * This is fully dynamic - the grouping field, display fields, and sort
     * order are all configurable.
     */
    public function organizationGroupExport(array $params) {
        $module = $params['module'] ?? 'Accounts';
        $fields = $params['fields'] ?? [];
        $groupField = $params['group_field'] ?? null;
        $sortFields = $params['sort_fields'] ?? [];
        $filters = $params['filters'] ?? [];
        $title = $params['title'] ?? '';
        $subtitle = $params['subtitle'] ?? '';
        $addRowNumber = $params['add_row_number'] ?? true;
        
        // Build query config for QueryBuilder 
        $config = [
            'primary_module' => $module,
            'select_fields' => [],
            'filters' => $filters,
            'order_by' => $sortFields,
        ];
        
        // Add related module joins if specified
        if (!empty($params['related_modules'])) {
            $config['related_modules'] = $params['related_modules'];
        }
        
        // Add fields
        foreach ($fields as $fieldDef) {
            if (is_string($fieldDef)) {
                $config['select_fields'][] = $fieldDef;
            } elseif (is_array($fieldDef) && !empty($fieldDef['expression'])) {
                $config['select_fields'][] = $fieldDef;
            }
        }
        
        $this->queryBuilder->setConfig($config);
        $data = $this->queryBuilder->execute();
        
        // Post-process: add row numbers
        if ($addRowNumber) {
            $counter = 1;
            foreach ($data as &$row) {
                $row = array_merge(['stt' => $counter++], $row);
            }
            unset($row);
        }
        
        // Build headers from field definitions
        $headers = [];
        if ($addRowNumber) {
            $headers['stt'] = 'STT';
        }
        foreach ($fields as $fieldDef) {
            if (is_string($fieldDef)) {
                $headers[$fieldDef] = $params['field_labels'][$fieldDef] ?? strtoupper($fieldDef);
            } elseif (is_array($fieldDef)) {
                $key = $fieldDef['alias'] ?? $fieldDef['field'] ?? $fieldDef['expression'];
                $headers[$key] = $fieldDef['label'] ?? strtoupper($key);
            }
        }
        
        return [
            'headers' => $headers,
            'data' => $data,
            'title' => $title,
            'subtitle' => $subtitle,
            'group_field' => $groupField,
            'summary' => $this->buildSummary($data, $params['summary_fields'] ?? []),
            'meta' => [
                'total_rows' => count($data),
                'generated_at' => date('Y-m-d H:i:s'),
            ],
        ];
    }

    // ═══════════════════════════════════════════════════════════════════
    // Custom Report (fully dynamic from QueryBuilder config)
    // ═══════════════════════════════════════════════════════════════════

    public function customReport(array $params) {
        $queryConfig = $params['query_config'] ?? $params;
        $this->queryBuilder->setConfig($queryConfig);
        $data = $this->queryBuilder->execute();
        
        $headers = $params['headers'] ?? [];
        if (empty($headers) && !empty($data)) {
            // Auto-generate headers from first row keys
            foreach (array_keys($data[0]) as $key) {
                $headers[$key] = ucfirst(str_replace('_', ' ', $key));
            }
        }
        
        return [
            'headers' => $headers,
            'data' => $data,
            'summary' => $this->buildSummary($data, $params['summary_fields'] ?? []),
        ];
    }

    // ═══════════════════════════════════════════════════════════════════
    // Saved Report Configs (CRUD for report templates)
    // ═══════════════════════════════════════════════════════════════════

    /**
     * Save a report configuration to database
     */
    public function saveReportConfig(array $config) {
        $name = $config['name'];
        $description = $config['description'] ?? '';
        $reportType = $config['report_type'] ?? 'custom';
        $configJson = json_encode($config, JSON_UNESCAPED_UNICODE);
        $currentUser = Users_Record_Model::getCurrentUserModel();
        $userId = $currentUser ? $currentUser->getId() : 1;
        if (!$userId) $userId = 1;
        
        if (!empty($config['id'])) {
            // Update existing
            $this->db->pquery(
                "UPDATE vtiger_advancedreport_configs SET name = ?, description = ?, report_type = ?, config_json = ?, modified_by = ?, modified_time = NOW() WHERE id = ?",
                [$name, $description, $reportType, $configJson, $userId, (int)$config['id']]
            );
            return (int)$config['id'];
        } else {
            // Insert new
            $this->db->pquery(
                "INSERT INTO vtiger_advancedreport_configs (name, description, report_type, config_json, created_by, created_time, modified_by, modified_time) VALUES (?, ?, ?, ?, ?, NOW(), ?, NOW())",
                [$name, $description, $reportType, $configJson, $userId, $userId]
            );
            return $this->db->getLastInsertID();
        }
    }

    /**
     * Load a saved report configuration
     */
    public function loadReportConfig($id) {
        $result = $this->db->pquery(
            "SELECT * FROM vtiger_advancedreport_configs WHERE id = ?",
            [(int)$id]
        );
        if ($this->db->num_rows($result) === 0) {
            throw new \InvalidArgumentException("Report config not found: $id");
        }
        $row = $this->db->fetchByAssoc($result);
        $row['config'] = json_decode($row['config_json'], true);
        return $row;
    }

    /**
     * List all saved report configurations
     */
    public function listReportConfigs($reportType = null) {
        $sql = "SELECT id, name, description, report_type, created_time, modified_time FROM vtiger_advancedreport_configs";
        $params = [];
        
        if ($reportType) {
            $sql .= " WHERE report_type = ?";
            $params[] = $reportType;
        }
        $sql .= " ORDER BY modified_time DESC";
        
        $result = $this->db->pquery($sql, $params);
        return $this->fetchAll($result);
    }

    /**
     * Delete a saved report configuration
     */
    public function deleteReportConfig($id) {
        $this->db->pquery("DELETE FROM vtiger_advancedreport_configs WHERE id = ?", [(int)$id]);
    }

    // ═══════════════════════════════════════════════════════════════════
    // Helpers
    // ═══════════════════════════════════════════════════════════════════

    private function buildCampaignFilter(array $params) {
        $where = 'WHERE ce.deleted = 0';
        $queryParams = [];
        
        if (!empty($params['campaign_id'])) {
            $ids = is_array($params['campaign_id']) ? $params['campaign_id'] : [$params['campaign_id']];
            $placeholders = implode(',', array_fill(0, count($ids), '?'));
            $where .= " AND c.campaignid IN ($placeholders)";
            $queryParams = array_merge($queryParams, array_map('intval', $ids));
        }
        
        if (!empty($params['campaign_status'])) {
            $where .= " AND c.campaignstatus = ?";
            $queryParams[] = $params['campaign_status'];
        }
        
        if (!empty($params['date_from'])) {
            $where .= " AND ce.createdtime >= ?";
            $queryParams[] = $params['date_from'];
        }
        
        if (!empty($params['date_to'])) {
            $where .= " AND ce.createdtime <= ?";
            $queryParams[] = $params['date_to'];
        }
        
        return ['where' => $where, 'params' => $queryParams];
    }

    private function buildSummary(array $data, array $sumFields) {
        $summary = [];
        foreach ($sumFields as $field) {
            $summary[$field] = 0;
        }
        foreach ($data as $row) {
            foreach ($sumFields as $field) {
                $summary[$field] += (float)($row[$field] ?? 0);
            }
        }
        return $summary;
    }

    private function fetchAll($result) {
        $rows = [];
        $numRows = $this->db->num_rows($result);
        for ($i = 0; $i < $numRows; $i++) {
            $rows[] = $this->db->fetchByAssoc($result, $i);
        }
        return $rows;
    }
}
