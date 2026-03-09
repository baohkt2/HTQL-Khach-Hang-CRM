<?php
/**
 * PDFMaker2 — FieldResolver Model
 * Resolves module fields and replaces $FIELD$ variables with actual record data.
 */
class PDFMaker2_FieldResolver_Model {

    private $db;

    public function __construct() {
        $this->db = PearDatabase::getInstance();
    }

    /**
     * Get all entity modules available in the system.
     * Returns array of ['name' => 'ModuleName', 'label' => 'Translated Label']
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
     * Returns structure suitable for field picker UI.
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
        while ($blockRow = $this->db->fetchByAssoc($blockResult)) {
            $blockLabel = $blockRow['blocklabel'];
            if (empty($blockLabel)) $blockLabel = 'LBL_BLOCK_' . $blockRow['blockid'];

            $fieldResult = $this->db->pquery(
                "SELECT fieldid, fieldname, fieldlabel, uitype, columnname, tablename
                 FROM vtiger_field
                 WHERE block = ? AND displaytype != 3 AND displaytype != 4 AND fieldlabel != 'Add Comment'
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
            }

            if (!empty($fields)) {
                $blocks[] = [
                    'label' => vtranslate($blockLabel, $moduleName),
                    'fields' => $fields,
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
                ['fieldname' => 'current_user', 'fieldlabel' => vtranslate('LBL_CURRENT_USER', 'PDFMaker2'), 'variable' => '$CURRENT_USER$'],
                ['fieldname' => 'company_name', 'fieldlabel' => vtranslate('LBL_COMPANY_NAME', 'PDFMaker2'), 'variable' => '$COMPANY_NAME$'],
                ['fieldname' => 'company_address', 'fieldlabel' => vtranslate('LBL_COMPANY_ADDRESS', 'PDFMaker2'), 'variable' => '$COMPANY_ADDRESS$'],
                ['fieldname' => 'company_phone', 'fieldlabel' => vtranslate('LBL_COMPANY_PHONE', 'PDFMaker2'), 'variable' => '$COMPANY_PHONE$'],
                ['fieldname' => 'company_website', 'fieldlabel' => vtranslate('LBL_COMPANY_WEBSITE', 'PDFMaker2'), 'variable' => '$COMPANY_WEBSITE$'],
                ['fieldname' => 'company_logo', 'fieldlabel' => vtranslate('LBL_COMPANY_LOGO', 'PDFMaker2'), 'variable' => '$COMPANY_LOGO$'],
            ]
        ];

        return $blocks;
    }

    /**
     * Resolve all template variables with actual record data.
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
        $fieldResult = $this->db->pquery(
            "SELECT fieldname, columnname, uitype, tablename FROM vtiger_field WHERE tabid = ?",
            [$tabId]
        );
        while ($row = $this->db->fetchByAssoc($fieldResult)) {
            $rawValue = $focus->column_fields[$row['fieldname']] ?? '';
            $displayValue = $this->formatFieldValue($rawValue, $row['uitype'], $row['fieldname'], $moduleName);

            $varKey = strtoupper($moduleName) . '_' . strtoupper($row['columnname']);
            $fieldMap[$varKey] = $displayValue;
            // Also map by fieldname for convenience
            $varKey2 = strtoupper($moduleName) . '_' . strtoupper($row['fieldname']);
            $fieldMap[$varKey2] = $displayValue;
        }

        // System variables
        $currentUser = Users_Record_Model::getCurrentUserModel();
        $companyDetails = $this->getCompanyDetails();

        $fieldMap['RECORD_ID'] = $recordId;
        $fieldMap['CURRENT_DATE'] = date('d/m/Y');
        $fieldMap['CURRENT_TIME'] = date('H:i:s');
        $fieldMap['CURRENT_USER'] = $currentUser->get('first_name') . ' ' . $currentUser->get('last_name');
        $fieldMap['COMPANY_NAME'] = $companyDetails['organizationname'] ?? '';
        $fieldMap['COMPANY_ADDRESS'] = $companyDetails['address'] ?? '';
        $fieldMap['COMPANY_PHONE'] = $companyDetails['phone'] ?? '';
        $fieldMap['COMPANY_WEBSITE'] = $companyDetails['website'] ?? '';
        $fieldMap['COMPANY_LOGO'] = !empty($companyDetails['logoname'])
            ? '<img src="test/logo/' . htmlspecialchars($companyDetails['logoname'], ENT_QUOTES, 'UTF-8') . '" />'
            : '';
        $fieldMap['COMPANY_CITY'] = $companyDetails['city'] ?? '';
        $fieldMap['COMPANY_STATE'] = $companyDetails['state'] ?? '';
        $fieldMap['COMPANY_ZIP'] = $companyDetails['code'] ?? '';
        $fieldMap['COMPANY_COUNTRY'] = $companyDetails['country'] ?? '';
        $fieldMap['COMPANY_FAX'] = $companyDetails['fax'] ?? '';

        // Replace all $VARIABLE$ in HTML
        $html = preg_replace_callback('/\$([A-Z0-9_]+)\$/', function ($matches) use ($fieldMap) {
            $key = $matches[1];
            return $fieldMap[$key] ?? '';
        }, $html);

        return $html;
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
                    // Try datetime format
                    $dateObj = DateTime::createFromFormat('Y-m-d H:i:s', $value);
                    if ($dateObj) {
                        return $dateObj->format('d/m/Y H:i');
                    }
                }
                return $value;

            // Currency
            case 71:
            case 72:
                return number_format((float)$value, 0, ',', '.');

            // Reference/Relation fields — resolve to entity name
            case 10:
            case 51:
            case 57:
            case 58:
            case 59:
            case 73:
            case 75:
            case 76:
            case 78:
            case 80:
            case 81:
            case 101:
                if (!empty($value) && is_numeric($value)) {
                    $entityNames = getEntityName(getSalesEntityType($value), [$value]);
                    return $entityNames[$value] ?? $value;
                }
                return $value;

            // Checkbox
            case 56:
                return ($value == '1') ? 'Có' : 'Không';

            // Picklist — translate
            case 15:
            case 16:
            case 33:
                return vtranslate($value, $moduleName);

            default:
                return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }
    }

    /**
     * Get company details from vtiger_organizationdetails.
     */
    private function getCompanyDetails() {
        $result = $this->db->pquery("SELECT * FROM vtiger_organizationdetails LIMIT 1", []);
        if ($this->db->num_rows($result) > 0) {
            return $this->db->fetch_array($result);
        }
        return [];
    }
}
