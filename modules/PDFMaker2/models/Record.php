<?php
/**
 * PDFMaker2 — Record Model
 * Handles CRUD operations for PDF templates.
 */
class PDFMaker2_Record_Model extends Vtiger_Base_Model {

    protected $db;

    public function __construct() {
        $this->db = PearDatabase::getInstance();
    }

    private function getCreatedBy() {
        $user = Users_Record_Model::getCurrentUserModel();
        return ($user && $user->getId()) ? $user->getId() : 1;
    }

    /**
     * Get a template by ID.
     */
    public static function getInstanceById($templateId) {
        $db = PearDatabase::getInstance();
        $result = $db->pquery(
            "SELECT * FROM vtiger_pdfmaker2_templates WHERE templateid = ?",
            [$templateId]
        );
        if ($db->num_rows($result) == 0) {
            return null;
        }
        $row = $db->fetch_array($result);
        $instance = new self();
        $instance->setData($row);

        // Load assigned modules
        $modResult = $db->pquery(
            "SELECT module_name, is_default, sequence FROM vtiger_pdfmaker2_template_module_rel WHERE templateid = ? ORDER BY sequence",
            [$templateId]
        );
        $modules = [];
        while ($modRow = $db->fetchByAssoc($modResult)) {
            $modules[] = $modRow;
        }
        $instance->set('assigned_modules', $modules);
        return $instance;
    }

    /**
     * Get all active templates for a given module.
     */
    public static function getTemplatesForModule($moduleName) {
        $db = PearDatabase::getInstance();
        $result = $db->pquery(
            "SELECT t.templateid, t.template_name, t.description, r.is_default
             FROM vtiger_pdfmaker2_templates t
             INNER JOIN vtiger_pdfmaker2_template_module_rel r ON r.templateid = t.templateid
             WHERE r.module_name = ? AND t.status = 1
             ORDER BY r.is_default DESC, r.sequence ASC, t.template_name ASC",
            [$moduleName]
        );
        $templates = [];
        while ($row = $db->fetchByAssoc($result)) {
            $templates[] = $row;
        }
        return $templates;
    }

    /**
     * Get all templates for list view.
     */
    public static function getAll($page = 1, $pageSize = 20) {
        $db = PearDatabase::getInstance();
        $offset = ($page - 1) * $pageSize;

        $countResult = $db->pquery("SELECT COUNT(*) as cnt FROM vtiger_pdfmaker2_templates", []);
        $totalCount = $db->query_result($countResult, 0, 'cnt');

        $result = $db->pquery(
            "SELECT t.*, GROUP_CONCAT(r.module_name ORDER BY r.sequence SEPARATOR ', ') as modules
             FROM vtiger_pdfmaker2_templates t
             LEFT JOIN vtiger_pdfmaker2_template_module_rel r ON r.templateid = t.templateid
             GROUP BY t.templateid
             ORDER BY t.modified_at DESC
             LIMIT ?, ?",
            [$offset, $pageSize]
        );
        $templates = [];
        while ($row = $db->fetchByAssoc($result)) {
            $templates[] = $row;
        }
        return ['records' => $templates, 'total' => $totalCount];
    }

    /**
     * Save (create or update) a template.
     */
    public function save() {
        $templateId = $this->get('templateid');

        if ($templateId) {
            return $this->update();
        } else {
            return $this->create();
        }
    }

    private function create() {
        $this->db->pquery(
            "INSERT INTO vtiger_pdfmaker2_templates
             (template_name, description, body, header, footer, format, orientation,
              margin_top, margin_bottom, margin_left, margin_right, status, created_by)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
            [
                $this->get('template_name'),
                $this->get('description') ?: '',
                $this->get('body') ?: '',
                $this->get('header') ?: '',
                $this->get('footer') ?: '',
                $this->get('format') ?: 'A4',
                $this->get('orientation') ?: 'portrait',
                $this->get('margin_top') ?: 10,
                $this->get('margin_bottom') ?: 10,
                $this->get('margin_left') ?: 10,
                $this->get('margin_right') ?: 10,
                1,
                $this->getCreatedBy()
            ]
        );
        $templateId = $this->db->getLastInsertID();
        $this->set('templateid', $templateId);

        $this->saveModuleRelations();
        return $templateId;
    }

    private function update() {
        $templateId = $this->get('templateid');
        $this->db->pquery(
            "UPDATE vtiger_pdfmaker2_templates SET
             template_name=?, description=?, body=?, header=?, footer=?,
             format=?, orientation=?, margin_top=?, margin_bottom=?,
             margin_left=?, margin_right=?, status=?
             WHERE templateid=?",
            [
                $this->get('template_name'),
                $this->get('description') ?: '',
                $this->get('body') ?: '',
                $this->get('header') ?: '',
                $this->get('footer') ?: '',
                $this->get('format') ?: 'A4',
                $this->get('orientation') ?: 'portrait',
                $this->get('margin_top') ?: 10,
                $this->get('margin_bottom') ?: 10,
                $this->get('margin_left') ?: 10,
                $this->get('margin_right') ?: 10,
                $this->get('status') !== null ? $this->get('status') : 1,
                $templateId
            ]
        );
        $this->saveModuleRelations();
        return $templateId;
    }

    private function saveModuleRelations() {
        $templateId = $this->get('templateid');
        $rawModules = $this->get('target_modules');

        // If target_modules was never set, skip — don't wipe existing relations
        if ($rawModules === null) {
            return;
        }

        if (!is_array($rawModules)) {
            $modules = array_filter(array_map('trim', explode(',', $rawModules)));
        } else {
            $modules = array_filter($rawModules);
        }

        // Don't delete existing relations if the new list is empty
        if (empty($modules)) {
            return;
        }

        $this->db->pquery("DELETE FROM vtiger_pdfmaker2_template_module_rel WHERE templateid = ?", [$templateId]);

        $seq = 0;
        foreach ($modules as $mod) {
            $this->db->pquery(
                "INSERT INTO vtiger_pdfmaker2_template_module_rel (templateid, module_name, is_default, sequence) VALUES (?, ?, 0, ?)",
                [$templateId, $mod, $seq++]
            );
        }
    }

    /**
     * Delete template.
     */
    public static function deleteById($templateId) {
        $db = PearDatabase::getInstance();
        // CASCADE will handle vtiger_pdfmaker2_template_module_rel
        $db->pquery("DELETE FROM vtiger_pdfmaker2_templates WHERE templateid = ?", [$templateId]);
    }
}
