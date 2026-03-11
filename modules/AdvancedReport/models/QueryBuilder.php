<?php
/**
 * AdvancedReport - Dynamic Query Builder
 * 
 * Builds SQL queries dynamically based on a JSON report configuration.
 * Supports any module with relationships, aggregations, grouping, and filters.
 */
class AdvancedReport_QueryBuilder_Model {

    /** @var PearDatabase */
    private $db;
    
    /** @var array Report config */
    private $config;
    
    /** @var array Bound parameters for prepared statements */
    private $params = [];
    
    /** @var array Table alias counter to avoid collisions */
    private $aliasCounter = 0;
    
    /** @var array Maps module names to their base table info */
    private static $moduleTableMap = null;
    
    public function __construct($config = []) {
        $this->db = PearDatabase::getInstance();
        $this->config = $config;
    }
    
    /**
     * Set report configuration
     * @param array $config
     * @return self
     */
    public function setConfig(array $config) {
        $this->config = $config;
        return $this;
    }
    
    /**
     * Build the complete SQL query from config
     * 
     * Config structure:
     * {
     *   "primary_module": "Campaigns",
     *   "select_fields": ["campaignname", "campaignstatus"],
     *   "related_modules": [
     *     {
     *       "module": "Contacts",
     *       "relation": "campaign_contact",
     *       "fields": ["firstname", "lastname"],
     *       "aggregates": [{"field": "contactid", "function": "COUNT", "alias": "total_contacts"}]
     *     }
     *   ],
     *   "joins": [...],  // custom joins
     *   "filters": [{"field": "campaignstatus", "operator": "=", "value": "Active"}],
     *   "group_by": ["campaignname"],
     *   "order_by": [{"field": "campaignname", "direction": "ASC"}],
     *   "limit": 1000
     * }
     * 
     * @return array ['sql' => string, 'params' => array]
     */
    public function build() {
        $this->params = [];
        
        $select  = $this->buildSelect();
        $from    = $this->buildFrom();
        $joins   = $this->buildJoins();
        $where   = $this->buildWhere();
        $groupBy = $this->buildGroupBy();
        $having  = $this->buildHaving();
        $orderBy = $this->buildOrderBy();
        $limit   = $this->buildLimit();
        
        $sql = "SELECT $select FROM $from $joins $where $groupBy $having $orderBy $limit";
        
        return [
            'sql' => $sql,
            'params' => $this->params
        ];
    }
    
    /**
     * Execute the built query and return results
     * @return array
     */
    public function execute() {
        $query = $this->build();
        $result = $this->db->pquery($query['sql'], $query['params']);
        
        $rows = [];
        $numRows = $this->db->num_rows($result);
        for ($i = 0; $i < $numRows; $i++) {
            $rows[] = $this->db->fetchByAssoc($result, $i);
        }
        return $rows;
    }
    
    // ── SELECT ──────────────────────────────────────────────────────────
    
    private function buildSelect() {
        $parts = [];
        $config = $this->config;
        
        // Primary module fields
        if (!empty($config['select_fields'])) {
            foreach ($config['select_fields'] as $fieldDef) {
                if (is_string($fieldDef)) {
                    $parts[] = $this->qualifyField($fieldDef, $config['primary_module']);
                } elseif (is_array($fieldDef)) {
                    $expr = $this->buildFieldExpression($fieldDef);
                    $parts[] = $expr;
                }
            }
        }
        
        // Related module fields and aggregates
        if (!empty($config['related_modules'])) {
            foreach ($config['related_modules'] as $rel) {
                if (!empty($rel['fields'])) {
                    foreach ($rel['fields'] as $fieldDef) {
                        if (is_string($fieldDef)) {
                            $parts[] = $this->qualifyField($fieldDef, $rel['module']);
                        } elseif (is_array($fieldDef)) {
                            $parts[] = $this->buildFieldExpression($fieldDef);
                        }
                    }
                }
                if (!empty($rel['aggregates'])) {
                    foreach ($rel['aggregates'] as $agg) {
                        $parts[] = $this->buildAggregate($agg, $rel['module']);
                    }
                }
            }
        }
        
        // Custom expressions
        if (!empty($config['custom_expressions'])) {
            foreach ($config['custom_expressions'] as $expr) {
                $parts[] = $this->buildCustomExpression($expr);
            }
        }
        
        return empty($parts) ? '*' : implode(', ', $parts);
    }
    
    // ── FROM ────────────────────────────────────────────────────────────
    
    private function buildFrom() {
        $module = $this->config['primary_module'];
        $tableInfo = $this->getModuleTableInfo($module);
        
        $from = $tableInfo['base_table'];
        
        // Always join crmentity for standard modules
        if (!empty($tableInfo['entity_id_field'])) {
            $from .= " INNER JOIN vtiger_crmentity ON vtiger_crmentity.crmid = " 
                    . $tableInfo['base_table'] . "." . $tableInfo['entity_id_field'];
        }
        
        return $from;
    }
    
    // ── JOINS ───────────────────────────────────────────────────────────
    
    private function buildJoins() {
        $joins = [];
        $config = $this->config;
        
        // Auto joins for related modules
        if (!empty($config['related_modules'])) {
            foreach ($config['related_modules'] as $rel) {
                $joins[] = $this->buildRelationJoin($rel);
            }
        }
        
        // Custom joins
        if (!empty($config['joins'])) {
            foreach ($config['joins'] as $join) {
                $type = strtoupper($join['type'] ?? 'LEFT');
                $allowed = ['LEFT', 'INNER', 'RIGHT', 'LEFT OUTER'];
                $type = in_array($type, $allowed) ? $type : 'LEFT';
                $table = $this->sanitizeIdentifier($join['table']);
                $alias = isset($join['alias']) ? $this->sanitizeIdentifier($join['alias']) : '';
                $on = $join['on']; // validated below
                
                $joinStr = "$type JOIN $table";
                if ($alias) $joinStr .= " AS $alias";
                $joinStr .= " ON " . $this->buildJoinCondition($on);
                $joins[] = $joinStr;
            }
        }
        
        return implode(' ', $joins);
    }
    
    /**
     * Build join for a related module based on known relationships
     */
    private function buildRelationJoin(array $rel) {
        $primaryModule = $this->config['primary_module'];
        $relModule = $rel['module'];
        $relationType = $rel['relation'] ?? '';
        
        // Known relationship mappings
        $relationMap = [
            'campaign_contact' => [
                'join_table' => 'vtiger_campaigncontrel',
                'primary_key' => 'campaignid',
                'related_key' => 'contactid',
                'primary_base' => 'vtiger_campaign',
                'related_base' => 'vtiger_contactdetails',
            ],
            'campaign_lead' => [
                'join_table' => 'vtiger_campaignleadrel',
                'primary_key' => 'campaignid',
                'related_key' => 'leadid',
                'primary_base' => 'vtiger_campaign',
                'related_base' => 'vtiger_leaddetails',
            ],
            'campaign_account' => [
                'join_table' => 'vtiger_campaignaccountrel',
                'primary_key' => 'campaignid',
                'related_key' => 'accountid',
                'primary_base' => 'vtiger_campaign',
                'related_base' => 'vtiger_account',
            ],
            'contact_account' => [
                'join_table' => null, // direct FK
                'primary_key' => 'accountid',
                'related_key' => 'accountid',
                'primary_base' => 'vtiger_contactdetails',
                'related_base' => 'vtiger_account',
            ],
            'contact_activity' => [
                'join_table' => 'vtiger_cntactivityrel',
                'primary_key' => 'contactid',
                'related_key' => 'activityid',
                'primary_base' => 'vtiger_contactdetails',
                'related_base' => 'vtiger_activity',
            ],
            'entity_activity' => [
                'join_table' => 'vtiger_seactivityrel',
                'primary_key' => 'crmid',
                'related_key' => 'activityid',
                'primary_base' => 'vtiger_crmentity',
                'related_base' => 'vtiger_activity',
            ],
        ];
        
        if (isset($relationMap[$relationType])) {
            $map = $relationMap[$relationType];
            $joinType = $rel['join_type'] ?? 'LEFT';
            $allowed = ['LEFT', 'INNER', 'RIGHT'];
            $joinType = in_array(strtoupper($joinType), $allowed) ? strtoupper($joinType) : 'LEFT';
            
            $relTableInfo = $this->getModuleTableInfo($relModule);
            $sql = '';
            
            if ($map['join_table']) {
                // M:N relationship through junction table
                $sql .= "$joinType JOIN {$map['join_table']} ON {$map['primary_base']}.{$map['primary_key']} = {$map['join_table']}.{$map['primary_key']}";
                $sql .= " $joinType JOIN {$map['related_base']} ON {$map['join_table']}.{$map['related_key']} = {$map['related_base']}.{$map['related_key']}";
            } else {
                // Direct FK relationship
                $sql .= "$joinType JOIN {$map['related_base']} ON {$map['primary_base']}.{$map['primary_key']} = {$map['related_base']}.{$map['related_key']}";
            }
            
            // Join crmentity for related module if needed
            if (!empty($relTableInfo['entity_id_field']) && $relModule !== $primaryModule) {
                $relAlias = 'crm_' . strtolower($relModule);
                $sql .= " LEFT JOIN vtiger_crmentity AS $relAlias ON $relAlias.crmid = {$map['related_base']}.{$relTableInfo['entity_id_field']}";
                
                // Only non-deleted records
                if (!empty($rel['include_deleted']) && $rel['include_deleted']) {
                    // include all
                } else {
                    $sql .= " AND $relAlias.deleted = 0";
                }
            }
            
            // Additional condition filters on the join
            if (!empty($rel['join_conditions'])) {
                foreach ($rel['join_conditions'] as $cond) {
                    $sql .= ' AND ' . $this->buildCondition($cond);
                }
            }
            
            return $sql;
        }
        
        // Generic relationship via vtiger_crmentityrel if no specific mapping
        return $this->buildGenericRelationJoin($rel);
    }
    
    /**
     * Build generic relation join via vtiger_crmentityrel
     */
    private function buildGenericRelationJoin(array $rel) {
        $relModule = $rel['module'];
        $relTableInfo = $this->getModuleTableInfo($relModule);
        $joinType = strtoupper($rel['join_type'] ?? 'LEFT');
        $allowed = ['LEFT', 'INNER', 'RIGHT'];
        $joinType = in_array($joinType, $allowed) ? $joinType : 'LEFT';
        
        $sql = "$joinType JOIN vtiger_crmentityrel ON (vtiger_crmentity.crmid = vtiger_crmentityrel.crmid OR vtiger_crmentity.crmid = vtiger_crmentityrel.relcrmid)";
        $sql .= " $joinType JOIN {$relTableInfo['base_table']} ON {$relTableInfo['base_table']}.{$relTableInfo['entity_id_field']} = ";
        $sql .= "CASE WHEN vtiger_crmentity.crmid = vtiger_crmentityrel.crmid THEN vtiger_crmentityrel.relcrmid ELSE vtiger_crmentityrel.crmid END";
        
        return $sql;
    }
    
    // ── WHERE ───────────────────────────────────────────────────────────
    
    private function buildWhere() {
        $conditions = ["vtiger_crmentity.deleted = 0"];
        
        if (!empty($this->config['filters'])) {
            foreach ($this->config['filters'] as $filter) {
                $conditions[] = $this->buildCondition($filter);
            }
        }
        
        return 'WHERE ' . implode(' AND ', $conditions);
    }
    
    private function buildCondition(array $filter) {
        $field = $this->sanitizeIdentifier($filter['field']);
        $operator = $this->sanitizeOperator($filter['operator']);
        $value = $filter['value'];
        
        // Handle table.column notation
        if (strpos($field, '.') === false && !empty($filter['module'])) {
            $field = $this->qualifyFieldRaw($field, $filter['module']);
        }
        
        switch (strtoupper($operator)) {
            case 'IN':
                if (!is_array($value)) $value = [$value];
                $placeholders = implode(',', array_fill(0, count($value), '?'));
                $this->params = array_merge($this->params, $value);
                return "$field IN ($placeholders)";
                
            case 'NOT IN':
                if (!is_array($value)) $value = [$value];
                $placeholders = implode(',', array_fill(0, count($value), '?'));
                $this->params = array_merge($this->params, $value);
                return "$field NOT IN ($placeholders)";
                
            case 'BETWEEN':
                $this->params[] = $value[0];
                $this->params[] = $value[1];
                return "$field BETWEEN ? AND ?";
                
            case 'IS NULL':
                return "$field IS NULL";
                
            case 'IS NOT NULL':
                return "$field IS NOT NULL";
                
            case 'LIKE':
                $this->params[] = $value;
                return "$field LIKE ?";
                
            default:
                $this->params[] = $value;
                return "$field $operator ?";
        }
    }
    
    // ── GROUP BY ────────────────────────────────────────────────────────
    
    private function buildGroupBy() {
        if (empty($this->config['group_by'])) return '';
        
        $fields = [];
        foreach ($this->config['group_by'] as $field) {
            if (is_string($field)) {
                $fields[] = $this->sanitizeIdentifier($field);
            } elseif (is_array($field)) {
                $fields[] = $this->qualifyFieldRaw($field['field'], $field['module'] ?? $this->config['primary_module']);
            }
        }
        
        return 'GROUP BY ' . implode(', ', $fields);
    }
    
    // ── HAVING ──────────────────────────────────────────────────────────
    
    private function buildHaving() {
        if (empty($this->config['having'])) return '';
        
        $conditions = [];
        foreach ($this->config['having'] as $filter) {
            $conditions[] = $this->buildCondition($filter);
        }
        
        return 'HAVING ' . implode(' AND ', $conditions);
    }
    
    // ── ORDER BY ────────────────────────────────────────────────────────
    
    private function buildOrderBy() {
        if (empty($this->config['order_by'])) return '';
        
        $parts = [];
        foreach ($this->config['order_by'] as $order) {
            $field = $this->sanitizeIdentifier($order['field']);
            $dir = strtoupper($order['direction'] ?? 'ASC');
            $dir = in_array($dir, ['ASC', 'DESC']) ? $dir : 'ASC';
            $parts[] = "$field $dir";
        }
        
        return 'ORDER BY ' . implode(', ', $parts);
    }
    
    // ── LIMIT ───────────────────────────────────────────────────────────
    
    private function buildLimit() {
        if (empty($this->config['limit'])) return '';
        $limit = (int) $this->config['limit'];
        if ($limit <= 0) return '';
        
        $sql = "LIMIT $limit";
        if (!empty($this->config['offset'])) {
            $offset = (int) $this->config['offset'];
            $sql .= " OFFSET $offset";
        }
        return $sql;
    }
    
    // ── HELPERS ──────────────────────────────────────────────────────────
    
    private function buildFieldExpression(array $fieldDef) {
        $expr = $this->sanitizeIdentifier($fieldDef['expression'] ?? $fieldDef['field']);
        if (!empty($fieldDef['alias'])) {
            $expr .= ' AS ' . $this->sanitizeIdentifier($fieldDef['alias']);
        }
        return $expr;
    }
    
    private function buildAggregate(array $agg, $module) {
        $allowedFunctions = ['COUNT', 'SUM', 'AVG', 'MIN', 'MAX', 'GROUP_CONCAT'];
        $func = strtoupper($agg['function']);
        if (!in_array($func, $allowedFunctions)) {
            throw new \InvalidArgumentException("Invalid aggregate function: {$agg['function']}");
        }
        
        $field = $agg['field'];
        if ($field === '*') {
            $expr = "$func(*)";
        } else {
            $qualified = $this->qualifyFieldRaw($field, $module);
            $distinct = !empty($agg['distinct']) ? 'DISTINCT ' : '';
            $expr = "$func($distinct$qualified)";
        }
        
        if (!empty($agg['alias'])) {
            $expr .= ' AS ' . $this->sanitizeIdentifier($agg['alias']);
        }
        return $expr;
    }
    
    private function buildCustomExpression(array $expr) {
        // Custom SQL expressions with alias - must be whitelisted patterns
        $sql = $expr['sql'];
        if (!empty($expr['alias'])) {
            $sql .= ' AS ' . $this->sanitizeIdentifier($expr['alias']);
        }
        return $sql;
    }
    
    private function buildJoinCondition($on) {
        if (is_string($on)) {
            // Simple condition string like "t1.id = t2.id"
            return $on;
        }
        if (is_array($on)) {
            $parts = [];
            foreach ($on as $cond) {
                $parts[] = $this->sanitizeIdentifier($cond['left']) . ' = ' . $this->sanitizeIdentifier($cond['right']);
            }
            return implode(' AND ', $parts);
        }
        return '1=1';
    }
    
    private function qualifyField($field, $module) {
        $raw = $this->qualifyFieldRaw($field, $module);
        return $raw;
    }
    
    /**
     * Get fully qualified field name (table.column)
     */
    private function qualifyFieldRaw($field, $module) {
        // If already qualified (has a dot), return as-is
        if (strpos($field, '.') !== false) {
            return $this->sanitizeIdentifier($field);
        }
        
        $tableInfo = $this->getModuleTableInfo($module);
        return $tableInfo['base_table'] . '.' . $this->sanitizeIdentifier($field);
    }
    
    /**
     * Get module table information
     */
    public function getModuleTableInfo($module) {
        if (self::$moduleTableMap === null) {
            self::$moduleTableMap = [
                'Campaigns' => [
                    'base_table' => 'vtiger_campaign',
                    'entity_id_field' => 'campaignid',
                    'cf_table' => 'vtiger_campaignscf',
                ],
                'Contacts' => [
                    'base_table' => 'vtiger_contactdetails',
                    'entity_id_field' => 'contactid',
                    'cf_table' => 'vtiger_contactscf',
                ],
                'Accounts' => [
                    'base_table' => 'vtiger_account',
                    'entity_id_field' => 'accountid',
                    'cf_table' => 'vtiger_accountscf',
                ],
                'Leads' => [
                    'base_table' => 'vtiger_leaddetails',
                    'entity_id_field' => 'leadid',
                    'cf_table' => 'vtiger_leadscf',
                ],
                'Calendar' => [
                    'base_table' => 'vtiger_activity',
                    'entity_id_field' => 'activityid',
                    'cf_table' => 'vtiger_activitycf',
                ],
                'Emails' => [
                    'base_table' => 'vtiger_activity',
                    'entity_id_field' => 'activityid',
                    'cf_table' => null,
                ],
                'Potentials' => [
                    'base_table' => 'vtiger_potential',
                    'entity_id_field' => 'potentialid',
                    'cf_table' => 'vtiger_potentialscf',
                ],
                'Products' => [
                    'base_table' => 'vtiger_products',
                    'entity_id_field' => 'productid',
                    'cf_table' => 'vtiger_productcf',
                ],
                'HelpDesk' => [
                    'base_table' => 'vtiger_troubletickets',
                    'entity_id_field' => 'ticketid',
                    'cf_table' => 'vtiger_ticketcf',
                ],
                'Users' => [
                    'base_table' => 'vtiger_users',
                    'entity_id_field' => 'id',
                    'cf_table' => null,
                ],
            ];
        }
        
        if (isset(self::$moduleTableMap[$module])) {
            return self::$moduleTableMap[$module];
        }
        
        // Try to discover from vtiger_tab + vtiger_entityname
        return $this->discoverModuleTableInfo($module);
    }
    
    /**
     * Discover module table info from vtiger metadata
     */
    private function discoverModuleTableInfo($module) {
        $result = $this->db->pquery(
            "SELECT tablename, entityidfield FROM vtiger_entityname WHERE modulename = ?",
            [$module]
        );
        if ($this->db->num_rows($result) > 0) {
            $row = $this->db->fetchByAssoc($result);
            $info = [
                'base_table' => $row['tablename'],
                'entity_id_field' => $row['entityidfield'],
                'cf_table' => null,
            ];
            self::$moduleTableMap[$module] = $info;
            return $info;
        }
        
        throw new \InvalidArgumentException("Unknown module: $module");
    }
    
    /**
     * Sanitize SQL identifier (table/column name) to prevent injection
     */
    private function sanitizeIdentifier($identifier) {
        // Allow table.column, basic alphanumeric, underscore, and alias patterns
        if (!preg_match('/^[a-zA-Z0-9_.()* ]+$/', $identifier)) {
            throw new \InvalidArgumentException("Invalid SQL identifier: $identifier");
        }
        return $identifier;
    }
    
    /**
     * Sanitize SQL operator
     */
    private function sanitizeOperator($operator) {
        $allowed = ['=', '!=', '<>', '<', '>', '<=', '>=', 'LIKE', 'NOT LIKE', 'IN', 'NOT IN', 'BETWEEN', 'IS NULL', 'IS NOT NULL'];
        $op = strtoupper(trim($operator));
        if (!in_array($op, $allowed)) {
            throw new \InvalidArgumentException("Invalid operator: $operator");
        }
        return $op;
    }
}
