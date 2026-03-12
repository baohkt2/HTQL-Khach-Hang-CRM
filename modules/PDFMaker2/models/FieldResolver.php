<?php
/**
 * PDFMaker2 — FieldResolver Model
 * Resolves module fields and replaces $FIELD$ variables with actual record data.
 * Supports related module field resolution inherited from original PDFMaker UIType mapping.
 */
class PDFMaker2_FieldResolver_Model {

    private $db;

    /**
     * Map of UITypes to related module names.
     * Inherited from original PDFMaker's Fields model.
     */
    private static $uitypeRelatedModuleMap = [
        51 => ['Accounts'],
        57 => ['Contacts'],
        58 => ['Campaigns'],
        59 => ['Products'],
        73 => ['Accounts'],
        75 => ['Vendors'],
        76 => ['Potentials'],
        78 => ['Quotes'],
        80 => ['SalesOrder'],
        81 => ['Vendors'],
        68 => ['Accounts', 'Contacts'],
    ];

    public function __construct() {
        $this->db = PearDatabase::getInstance();
    }

    /**
     * Get all entity modules available in the system.
     */
    public function getEntityModules() {
        $result = $this->db->pquery(
            "SELECT name FROM vtiger_tab WHERE isentitytype = 1 AND presence IN (0,2) AND name NOT IN ('Emails','Events','ModComments','SMSNotifier','Webmails') ORDER BY name",
            []
        );
        $modules = [];
        while ($row = $this->db->fetchByAssoc($result)) {
            $modules[] = [
                'name' => $row['name'],
                'label' => vtranslate($row['name'], $row['name'])
            ];
        }
        return $modules;
    }

    /**
     * Get all fields for a module, organized by block.
     * Includes related module fields for template variable picker.
     */
    public function getFieldsForModule($moduleName) {
        $tabId = getTabId($moduleName);
        if (!$tabId) return [];

        // Get blocks
        if ($moduleName == 'Calendar') {
            $blockResult = $this->db->pquery(
                "SELECT blockid, blocklabel FROM vtiger_blocks WHERE tabid IN (9,16) ORDER BY sequence ASC", []
            );
        } else {
            $blockResult = $this->db->pquery(
                "SELECT blockid, blocklabel FROM vtiger_blocks WHERE tabid = ? ORDER BY sequence ASC",
                [$tabId]
            );
        }

        $blocks = [];
        $relatedModulesFound = [];

        while ($blockRow = $this->db->fetchByAssoc($blockResult)) {
            $blockLabel = $blockRow['blocklabel'];
            if (empty($blockLabel)) $blockLabel = 'LBL_BLOCK_' . $blockRow['blockid'];

            $fieldResult = $this->db->pquery(
                "SELECT fieldid, fieldname, fieldlabel, uitype, columnname, tablename
                 FROM vtiger_field
                 WHERE block = ? AND (displaytype != 3 OR uitype = 55) AND displaytype != 4 AND fieldlabel != 'Add Comment'
                 ORDER BY sequence ASC",
                [$blockRow['blockid']]
            );

            $fields = [];
            while ($fieldRow = $this->db->fetchByAssoc($fieldResult)) {
                $fields[] = [
                    'fieldname' => $fieldRow['fieldname'],
                    'fieldlabel' => vtranslate($fieldRow['fieldlabel'], $moduleName),
                    'uitype' => $fieldRow['uitype'],
                    'columnname' => $fieldRow['columnname'],
                    'variable' => '$' . strtoupper($moduleName) . '_' . strtoupper($fieldRow['columnname']) . '$',
                ];

                // Detect related modules
                $uitype = (int)$fieldRow['uitype'];
                if (isset(self::$uitypeRelatedModuleMap[$uitype])) {
                    foreach (self::$uitypeRelatedModuleMap[$uitype] as $relMod) {
                        $relatedModulesFound[$relMod] = true;
                    }
                } elseif ($uitype == 10) {
                    // Dynamic related modules from vtiger_fieldmodulerel
                    $relResult = $this->db->pquery(
                        "SELECT relmodule FROM vtiger_fieldmodulerel WHERE fieldid = ?",
                        [$fieldRow['fieldid']]
                    );
                    while ($relRow = $this->db->fetchByAssoc($relResult)) {
                        $relatedModulesFound[$relRow['relmodule']] = true;
                    }
                } elseif ($uitype == 101 || $uitype == 52 || $uitype == 53) {
                    $relatedModulesFound['Users'] = true;
                }
            }

            if (!empty($fields)) {
                $blocks[] = [
                    'label' => vtranslate($blockLabel, $moduleName),
                    'fields' => $fields,
                ];
            }
        }

        // Add related module fields
        foreach ($relatedModulesFound as $relModuleName => $v) {
            if ($relModuleName == $moduleName) continue;
            $relFields = $this->getBasicFieldsForModule($relModuleName);
            if (!empty($relFields)) {
                $blocks[] = [
                    'label' => vtranslate($relModuleName, $relModuleName) . ' (' . vtranslate('LBL_RELATED', 'PDFMaker2') . ')',
                    'fields' => $relFields,
                ];
            }
        }

        // Add special system variables
        $blocks[] = [
            'label' => vtranslate('LBL_SYSTEM_VARIABLES', 'PDFMaker2'),
            'fields' => [
                ['fieldname' => 'record_id', 'fieldlabel' => 'Record ID', 'variable' => '$RECORD_ID$'],
                ['fieldname' => 'current_date', 'fieldlabel' => vtranslate('LBL_CURRENT_DATE', 'PDFMaker2'), 'variable' => '$CURRENT_DATE$'],
                ['fieldname' => 'current_time', 'fieldlabel' => vtranslate('LBL_CURRENT_TIME', 'PDFMaker2'), 'variable' => '$CURRENT_TIME$'],
                ['fieldname' => 'current_day', 'fieldlabel' => 'Ngày (dd)', 'variable' => '$CURRENT_DAY$'],
                ['fieldname' => 'current_month', 'fieldlabel' => 'Tháng (mm)', 'variable' => '$CURRENT_MONTH$'],
                ['fieldname' => 'current_year', 'fieldlabel' => 'Năm (yyyy)', 'variable' => '$CURRENT_YEAR$'],
                ['fieldname' => 'current_day_name', 'fieldlabel' => 'Thứ trong tuần', 'variable' => '$CURRENT_DAY_NAME$'],
                ['fieldname' => 'current_month_name', 'fieldlabel' => 'Tháng (chữ)', 'variable' => '$CURRENT_MONTH_NAME$'],
                ['fieldname' => 'current_user', 'fieldlabel' => vtranslate('LBL_CURRENT_USER', 'PDFMaker2'), 'variable' => '$CURRENT_USER$'],
                ['fieldname' => 'company_name', 'fieldlabel' => vtranslate('LBL_COMPANY_NAME', 'PDFMaker2'), 'variable' => '$COMPANY_NAME$'],
                ['fieldname' => 'company_address', 'fieldlabel' => vtranslate('LBL_COMPANY_ADDRESS', 'PDFMaker2'), 'variable' => '$COMPANY_ADDRESS$'],
                ['fieldname' => 'company_phone', 'fieldlabel' => vtranslate('LBL_COMPANY_PHONE', 'PDFMaker2'), 'variable' => '$COMPANY_PHONE$'],
                ['fieldname' => 'company_website', 'fieldlabel' => vtranslate('LBL_COMPANY_WEBSITE', 'PDFMaker2'), 'variable' => '$COMPANY_WEBSITE$'],
                ['fieldname' => 'company_logo', 'fieldlabel' => vtranslate('LBL_COMPANY_LOGO', 'PDFMaker2'), 'variable' => '$COMPANY_LOGO$'],
                ['fieldname' => 'page_number', 'fieldlabel' => vtranslate('LBL_PAGE_NUMBER', 'PDFMaker2'), 'variable' => '$PAGE_NUMBER$'],
            ]
        ];

        return $blocks;
    }

    /**
     * Get basic fields for a related module (for field picker).
     */
    private function getBasicFieldsForModule($moduleName) {
        $tabId = getTabId($moduleName);
        if (!$tabId) return [];

        $fieldResult = $this->db->pquery(
            "SELECT f.fieldname, f.fieldlabel, f.uitype, f.columnname
             FROM vtiger_field f
             INNER JOIN vtiger_blocks b ON b.blockid = f.block
             WHERE f.tabid = ? AND f.displaytype != 3 AND f.displaytype != 4
             ORDER BY b.sequence ASC, f.sequence ASC",
            [$tabId]
        );

        $fields = [];
        while ($row = $this->db->fetchByAssoc($fieldResult)) {
            $fields[] = [
                'fieldname' => $row['fieldname'],
                'fieldlabel' => vtranslate($row['fieldlabel'], $moduleName),
                'uitype' => $row['uitype'],
                'columnname' => $row['columnname'],
                'variable' => '$' . strtoupper($moduleName) . '_' . strtoupper($row['columnname']) . '$',
            ];
        }
        return $fields;
    }

    /**
     * Resolve all template variables with actual record data.
     * Supports: main module fields, related module fields, system variables.
     *
     * @param string $html Template HTML with $VARIABLES$
     * @param int $recordId CRM record ID
     * @param string $moduleName Module name
     * @return string Resolved HTML
     */
    public function resolveVariables($html, $recordId, $moduleName) {
        // Load record data
        $focus = CRMEntity::getInstance($moduleName);
        foreach ($focus->column_fields as $key => $val) {
            $focus->column_fields[$key] = '';
        }
        $focus->retrieve_entity_info($recordId, $moduleName);
        $focus->id = $recordId;

        $tabId = getTabId($moduleName);

        // Build field map: columnname -> value, fieldname -> value
        $fieldMap = [];
        $relatedRecordIds = []; // key: relatedModuleName, value: recordId

        $fieldResult = $this->db->pquery(
            "SELECT fieldid, fieldname, columnname, uitype, tablename FROM vtiger_field WHERE tabid = ?",
            [$tabId]
        );
        while ($row = $this->db->fetchByAssoc($fieldResult)) {
            $rawValue = $focus->column_fields[$row['fieldname']] ?? '';
            // PearDatabase to_html() encodes all values; decode for clean UTF-8
            if (is_string($rawValue)) {
                $rawValue = html_entity_decode($rawValue, ENT_QUOTES, 'UTF-8');
            }
            $uitype = (int)$row['uitype'];

            // Track related record IDs for later resolution
            if (!empty($rawValue) && is_numeric($rawValue)) {
                if (isset(self::$uitypeRelatedModuleMap[$uitype])) {
                    foreach (self::$uitypeRelatedModuleMap[$uitype] as $relMod) {
                        $relatedRecordIds[$relMod] = (int)$rawValue;
                    }
                } elseif ($uitype == 10) {
                    $relModule = getSalesEntityType($rawValue);
                    if ($relModule) {
                        $relatedRecordIds[$relModule] = (int)$rawValue;
                    }
                } elseif ($uitype == 53 || $uitype == 52 || $uitype == 101) {
                    $relatedRecordIds['Users'] = (int)$rawValue;
                }
            }

            $displayValue = $this->formatFieldValue($rawValue, $uitype, $row['fieldname'], $moduleName);

            $varKey = strtoupper($moduleName) . '_' . strtoupper($row['columnname']);
            $fieldMap[$varKey] = $displayValue;
            $varKey2 = strtoupper($moduleName) . '_' . strtoupper($row['fieldname']);
            $fieldMap[$varKey2] = $displayValue;
        }

        // Resolve related module fields
        foreach ($relatedRecordIds as $relModuleName => $relRecordId) {
            $this->resolveRelatedModuleFields($fieldMap, $relModuleName, $relRecordId);
        }

        // System variables
        $currentUser = Users_Record_Model::getCurrentUserModel();
        $companyDetails = $this->getCompanyDetails();

        $fieldMap['RECORD_ID'] = $recordId;
        $fieldMap['CURRENT_DATE'] = date('d/m/Y');
        $fieldMap['CURRENT_TIME'] = date('H:i:s');
        $fieldMap['CURRENT_DAY'] = date('d');
        $fieldMap['CURRENT_MONTH'] = date('m');
        $fieldMap['CURRENT_YEAR'] = date('Y');
        $fieldMap['CURRENT_DAY_NAME'] = $this->getVietnameseDayName(date('N'));
        $fieldMap['CURRENT_MONTH_NAME'] = $this->getVietnameseMonthName(date('n'));
        $fieldMap['CURRENT_USER'] = trim(($currentUser->get('first_name') ?? '') . ' ' . ($currentUser->get('last_name') ?? ''));
        $fieldMap['COMPANY_NAME'] = $companyDetails['organizationname'] ?? '';
        $fieldMap['COMPANY_ADDRESS'] = $companyDetails['address'] ?? '';
        $fieldMap['COMPANY_PHONE'] = $companyDetails['phone'] ?? '';
        $fieldMap['COMPANY_WEBSITE'] = $companyDetails['website'] ?? '';
        $fieldMap['COMPANY_LOGO'] = !empty($companyDetails['logoname'])
            ? '<img src="test/logo/' . ($companyDetails['logoname']) . '" style="max-width:200px" />'
            : '';
        $fieldMap['COMPANY_CITY'] = $companyDetails['city'] ?? '';
        $fieldMap['COMPANY_STATE'] = $companyDetails['state'] ?? '';
        $fieldMap['COMPANY_ZIP'] = $companyDetails['code'] ?? '';
        $fieldMap['COMPANY_COUNTRY'] = $companyDetails['country'] ?? '';
        $fieldMap['COMPANY_FAX'] = $companyDetails['fax'] ?? '';
        $fieldMap['PAGE_NUMBER'] = '{PAGENO}';

        // Replace all $VARIABLE$ in HTML
        $html = preg_replace_callback('/\$([A-Z0-9_]+)\$/', function ($matches) use ($fieldMap) {
            $key = $matches[1];
            return $fieldMap[$key] ?? '';
        }, $html);

        return $html;
    }

    /**
     * Resolve fields from a related module record and add to fieldMap.
     */
    private function resolveRelatedModuleFields(&$fieldMap, $relModuleName, $relRecordId) {
        if (empty($relRecordId)) return;

        try {
            if ($relModuleName === 'Users') {
                $this->resolveUserFields($fieldMap, $relRecordId);
                return;
            }

            $relFocus = CRMEntity::getInstance($relModuleName);
            foreach ($relFocus->column_fields as $key => $val) {
                $relFocus->column_fields[$key] = '';
            }
            $relFocus->retrieve_entity_info($relRecordId, $relModuleName);
            $relFocus->id = $relRecordId;

            $relTabId = getTabId($relModuleName);
            $fieldResult = $this->db->pquery(
                "SELECT fieldname, columnname, uitype FROM vtiger_field WHERE tabid = ?",
                [$relTabId]
            );
            while ($row = $this->db->fetchByAssoc($fieldResult)) {
                $rawValue = $relFocus->column_fields[$row['fieldname']] ?? '';
                // PearDatabase to_html() encodes all values; decode for clean UTF-8
                if (is_string($rawValue)) {
                    $rawValue = html_entity_decode($rawValue, ENT_QUOTES, 'UTF-8');
                }
                $displayValue = $this->formatFieldValue($rawValue, (int)$row['uitype'], $row['fieldname'], $relModuleName);

                $varKey = strtoupper($relModuleName) . '_' . strtoupper($row['columnname']);
                if (!isset($fieldMap[$varKey])) {
                    $fieldMap[$varKey] = $displayValue;
                }
                $varKey2 = strtoupper($relModuleName) . '_' . strtoupper($row['fieldname']);
                if (!isset($fieldMap[$varKey2])) {
                    $fieldMap[$varKey2] = $displayValue;
                }
            }
        } catch (Exception $e) {
            error_log("PDFMaker2: Error resolving related module $relModuleName record $relRecordId: " . $e->getMessage());
        }
    }

    /**
     * Resolve user fields (for assigned_user_id type fields).
     */
    private function resolveUserFields(&$fieldMap, $userId) {
        $result = $this->db->pquery(
            "SELECT first_name, last_name, email1, phone_mobile, phone_home, user_name, title, department
             FROM vtiger_users WHERE id = ?",
            [$userId]
        );
        if ($this->db->num_rows($result) > 0) {
            $row = $this->db->fetchByAssoc($result);
            // Decode PearDatabase to_html() encoding for clean UTF-8
            foreach ($row as $k => $v) {
                if (is_string($v)) $row[$k] = html_entity_decode($v, ENT_QUOTES, 'UTF-8');
            }
            $fieldMap['USERS_FIRST_NAME'] = $row['first_name'] ?? '';
            $fieldMap['USERS_LAST_NAME'] = $row['last_name'] ?? '';
            $fieldMap['USERS_EMAIL1'] = $row['email1'] ?? '';
            $fieldMap['USERS_PHONE_MOBILE'] = $row['phone_mobile'] ?? '';
            $fieldMap['USERS_PHONE_HOME'] = $row['phone_home'] ?? '';
            $fieldMap['USERS_USER_NAME'] = $row['user_name'] ?? '';
            $fieldMap['USERS_TITLE'] = $row['title'] ?? '';
            $fieldMap['USERS_DEPARTMENT'] = $row['department'] ?? '';
            $fieldMap['USERS_FULLNAME'] = trim($fieldMap['USERS_FIRST_NAME'] . ' ' . $fieldMap['USERS_LAST_NAME']);
        } else {
            // Check if it's a group
            $grpResult = $this->db->pquery("SELECT groupname FROM vtiger_groups WHERE groupid = ?", [$userId]);
            if ($this->db->num_rows($grpResult) > 0) {
                $groupName = html_entity_decode($this->db->query_result($grpResult, 0, 'groupname'), ENT_QUOTES, 'UTF-8');
                $fieldMap['USERS_FULLNAME'] = $groupName;
                $fieldMap['USERS_FIRST_NAME'] = $fieldMap['USERS_FULLNAME'];
            }
        }
    }

    /**
     * Format a field value based on UIType.
     */
    private function formatFieldValue($value, $uitype, $fieldname, $moduleName) {
        if ($value === '' || $value === null) return '';

        switch ($uitype) {
            // Date fields
            case 5:
            case 6:
            case 23:
            case 70:
                if (!empty($value)) {
                    $dateObj = DateTime::createFromFormat('Y-m-d', $value);
                    if ($dateObj) {
                        return $dateObj->format('d/m/Y');
                    }
                    $dateObj = DateTime::createFromFormat('Y-m-d H:i:s', $value);
                    if ($dateObj) {
                        return $dateObj->format('d/m/Y H:i');
                    }
                }
                return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');

            // Currency
            case 71:
            case 72:
                return number_format((float)$value, 0, ',', '.');

            // Numeric fields
            case 7:
            case 9:
                if (is_numeric($value)) {
                    if (floor($value) == $value) {
                        return (string)(int)$value;
                    }
                    return rtrim(rtrim(number_format((float)$value, 6, '.', ''), '0'), '.');
                }
                return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');

            // Reference/Relation fields — resolve to entity name
            case 10:
            case 51:
            case 57:
            case 58:
            case 59:
            case 68:
            case 73:
            case 75:
            case 76:
            case 78:
            case 80:
            case 81:
                if (!empty($value) && is_numeric($value)) {
                    $entityType = getSalesEntityType($value);
                    if ($entityType) {
                        $entityNames = getEntityName($entityType, [$value]);
                        $name = $entityNames[$value] ?? '';
                        // getEntityName returns HTML-encoded values (via PearDatabase to_html)
                        if (!empty($name)) return html_entity_decode($name, ENT_QUOTES, 'UTF-8');
                    }
                }
                return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');

            // User fields (Assigned To, etc.)
            case 52:
            case 53:
            case 101:
                if (!empty($value) && is_numeric($value)) {
                    $userName = getUserFullName($value);
                    if (!empty($userName)) {
                        // getUserFullName() returns HTML-encoded string via PearDatabase
                        return html_entity_decode($userName, ENT_QUOTES, 'UTF-8');
                    }
                    $grpResult = $this->db->pquery("SELECT groupname FROM vtiger_groups WHERE groupid = ?", [$value]);
                    if ($this->db->num_rows($grpResult) > 0) {
                        return html_entity_decode($this->db->query_result($grpResult, 0, 'groupname'), ENT_QUOTES, 'UTF-8');
                    }
                }
                return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');

            // Checkbox
            case 56:
                return ($value == '1') ? 'Có' : 'Không';

            // Picklist — translate
            case 15:
            case 16:
                return vtranslate($value, $moduleName);

            // Multi-select picklist
            case 33:
                $values = explode(' |##| ', $value);
                $translated = array_map(function($v) use ($moduleName) {
                    return vtranslate(trim($v), $moduleName);
                }, $values);
                return implode(', ', $translated);

            // Text area
            case 19:
            case 20:
            case 21:
                $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
                return nl2br($value);

            // Email
            case 13:
                return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');

            // URL
            case 17:
                return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');

            // Phone
            case 11:
                return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');

            // Image (e.g., contact image)
            case 69:
                return $this->getRecordImage($value, $fieldname);

            default:
                return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }
    }

    /**
     * Get record image (for uitype 69 fields).
     */
    private function getRecordImage($value, $fieldname) {
        if (empty($value)) return '';
        // For image fields, value is typically the record ID
        // vtiger stores images via attachments
        $result = $this->db->pquery(
            "SELECT a.attachmentsid, a.path, a.name, a.storedname
             FROM vtiger_attachments a
             INNER JOIN vtiger_seattachmentsrel r ON r.attachmentsid = a.attachmentsid
             WHERE r.crmid = ?
             ORDER BY a.attachmentsid DESC LIMIT 1",
            [$value]
        );
        if ($this->db->num_rows($result) > 0) {
            $row = $this->db->fetchByAssoc($result);
            // Decode PearDatabase to_html() encoding
            foreach ($row as $k => $v) {
                if (is_string($v)) $row[$k] = html_entity_decode($v, ENT_QUOTES, 'UTF-8');
            }
            $storedName = !empty($row['storedname']) ? $row['storedname'] : $row['name'];
            $imgPath = $row['path'] . $row['attachmentsid'] . '_' . $storedName;
            if (file_exists($imgPath)) {
                return '<img src="' . htmlspecialchars($imgPath, ENT_QUOTES, 'UTF-8') . '" style="max-width:150px;max-height:150px" />';
            }
        }
        return '';
    }

    /**
     * Get company details from vtiger_organizationdetails.
     */
    private function getCompanyDetails() {
        $result = $this->db->pquery("SELECT * FROM vtiger_organizationdetails LIMIT 1", []);
        if ($this->db->num_rows($result) > 0) {
            $row = $this->db->fetch_array($result);
            // Decode PearDatabase to_html() encoding
            foreach ($row as $k => $v) {
                if (is_string($v)) $row[$k] = html_entity_decode($v, ENT_QUOTES, 'UTF-8');
            }
            return $row;
        }
        return [];
    }

    private function getVietnameseDayName($dayOfWeek) {
        $days = [1 => 'Thứ Hai', 2 => 'Thứ Ba', 3 => 'Thứ Tư', 4 => 'Thứ Năm', 5 => 'Thứ Sáu', 6 => 'Thứ Bảy', 7 => 'Chủ Nhật'];
        return $days[(int)$dayOfWeek] ?? '';
    }

    private function getVietnameseMonthName($month) {
        return 'Tháng ' . (int)$month;
    }
}
