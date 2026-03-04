<?php
/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouInstaller license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

class Settings_ITS4YouInstaller_ModuleRequirements_Model extends Vtiger_Base_Model
{
    /**
     * @var array
     */
    const SOURCE_MODULES = array(
        'EMAILMaker',
        'PDFMaker'
    );

    /**
     * @var string
     */
    public $moduleName;

    /**
     * @var PearDatabase
     */
    public $db;
    public $customLinks = array();
    public $eventHandler = array();
    public $cron = array();
    public $relatedList = array();
    /**
     * @var object
     */
    public $focus;

    /**
     * @return array
     */
    public static function getSourceModules()
    {
        $adb = PearDatabase::getInstance();
        $sourceModules = self::SOURCE_MODULES;
        $modules = array();

        $sql = 'SELECT * FROM vtiger_tab WHERE name LIKE ? OR name LIKE ? OR name IN (' . generateQuestionMarks($sourceModules) . ')';
        $params = array('ITS4You%', '%4You', $sourceModules);
        $result = $adb->pquery($sql, $params);

        while ($row = $adb->fetchByAssoc($result)) {
            $modules[$row['tabid']] = self::getInstance($row['name']);
        }

        return $modules;
    }

    /**
     * @return self
     */
    public static function getInstance($moduleName)
    {
        $self = new self();
        $self->db = PearDatabase::getInstance();
        $self->setModuleName($moduleName);

        return $self;
    }

    public function getHeaders($type)
    {
        switch ($type) {
            case 'links':
                return array(
                    'LBL_MODULE' => 'module',
                    'LBL_LABEL' => 'label',
                    'LBL_TYPE' => 'type',
                    'LBL_LINK_URL' => 'url',
                );
            case 'cron':
                return array(
                    'LBL_MODULE' => 'module',
                    'LBL_NAME' => 'name',
                    'LBL_FREQUENCY' => 'frequency',
                    'LBL_HANDLER_FILE' => 'handler',
                );
            case 'handler':
                return array(
                    'LBL_MODULE' => 'module',
                    'LBL_EVENT_NAME' => 'event_name',
                    'LBL_CLASS' => 'class_name',
                    'LBL_EVENT_FILE' => 'file_name',
                );
            case 'related_list':
                return array(
                    'LBL_MODULE' => 'module',
                    'LBL_RELATED_MODULE' => 'related_module',
                    'LBL_RELATED_LABEL' => 'related_label',
                    'LBL_FUNCTION' => 'function',
                );
        }

        if (method_exists($this->focus, 'getRequirementHeaders')) {
            return $this->focus->getRequirementHeaders($type);
        }

        return array();
    }

    public function getCustomLinks()
    {
        $info = array();

        foreach ($this->customLinks as $customLink) {
            list($moduleName, $type, $label, $url, $icon, $sequence, $handlerInfo) = $customLink;

            $data = array(
                'module' => $moduleName,
                'type' => $type,
                'label' => $label,
                'url' => str_replace('$LAYOUT$', Vtiger_Viewer::getDefaultLayoutName(), $url),
            );

            $this->validateCustomLink($data);

            array_push($info, $data);
        }

        return $info;
    }

    public function validateCustomLink(&$data)
    {
        $result = $this->db->pquery(
            'SELECT * FROM vtiger_links WHERE tabid=? AND linktype=? AND linkurl=?',
            array(getTabid($data['module']), $data['type'], $data['url'])
        );
        $number = $this->db->num_rows($result);

        $data['validate'] = 1 === $number;
        $data['validate_message'] = 1 < $number ? 'LBL_DUPLICATE_LINKS' : '';
    }

    /**
     * @throws Exception
     */
    public function getCron()
    {
        $info = array();

        foreach ($this->cron as $cron) {
            list($name, $handler, $frequency, $module, $sequence, $description) = $cron;

            $data = array(
                'name' => $name,
                'module' => $module,
                'frequency' => $frequency,
                'handler' => $handler,
            );

            $this->validateCron($data);

            array_push($info, $data);
        }

        return $info;
    }

    /**
     * @throws Exception
     */
    public function validateCron(&$data)
    {
        $result = $this->db->pquery(
            'SELECT * FROM vtiger_cron_task WHERE name=? AND handler_file=? AND module=?',
            array($data['name'], $data['handler'], $data['module'])
        );
        $number = $this->db->num_rows($result);
        $row = $this->db->query_result_rowdata($result);

        $validate = 1 === $number;
        $message = 1 < $number ? 'LBL_DUPLICATE_LINKS' : '';

        if (empty($row['status'])) {
            $message = 'LBL_CRON_DISABLED';
            $validate = false;
        }

        if (intval($data['frequency']) !== intval($row['frequency'])) {
            $message = 'LBL_DIFFERENT_FREQUENCY';
        }

        $data['validate'] = $validate;
        $data['validate_message'] = $message;
    }

    public function getEventHandler()
    {
        $info = array();

        foreach ($this->eventHandler as $handler) {
            list($events, $fileName, $className, $condition, $dependOn, $modules) = $handler;

            foreach ((array)$events as $eventName) {
                $modules = !empty($modules) ? $modules : array('');

                foreach ((array)$modules as $moduleName) {
                    $data = array(
                        'event_name' => $eventName,
                        'module' => $moduleName,
                        'file_name' => $fileName,
                        'class_name' => $className,
                    );

                    $this->validateEventHandler($data);

                    array_push($info, $data);
                }
            }
        }

        return $info;
    }

    public function validateEventHandler(&$data)
    {
        $sql = 'SELECT * FROM vtiger_eventhandlers 
            LEFT JOIN vtiger_eventhandler_module ON vtiger_eventhandler_module.handler_class=vtiger_eventhandlers.handler_class
            WHERE vtiger_eventhandlers.handler_class=? AND handler_path=? AND event_name=?';
        $params = array($data['class_name'], $data['file_name'], $data['event_name']);

        if (!empty($data['module'])) {
            $sql .= ' AND module_name=? ';
            array_push($params, $data['module']);
        }

        $result = $this->db->pquery($sql, $params);
        $number = $this->db->num_rows($result);

        $data['validate'] = 1 === $number;
        $data['validate_message'] = 1 < $number ? 'LBL_DUPLICATE_LINKS' : '';
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getRelatedList()
    {
        $info = array();

        foreach ($this->relatedList as $value) {
            list($moduleName, $relationModule, $relationLabel, $actions, $function) = $value;

            $data = array(
                'module' => $moduleName,
                'related_module' => $relationModule,
                'related_label' => !empty($relationLabel) ? $relationLabel : $relationModule,
                'actions' => $actions,
                'function' => !empty($function) ? $function : 'get_related_list',
            );
            $this->validateRelatedList($data);

            array_push($info, $data);
        }

        return $info;
    }

    /**
     * @param array $data
     * @throws Exception
     */
    public function validateRelatedList(&$data)
    {
        $sql = 'SELECT * FROM vtiger_relatedlists 
            WHERE tabid=? AND related_tabid=? AND label=? AND name=?';
        $params = array(getTabid($data['module']), getTabid($data['related_module']), $data['related_label'], $data['function']);

        $result = $this->db->pquery($sql, $params);
        $row = $this->db->query_result_rowdata($result);
        $number = $this->db->num_rows($result);
        $message = 1 < $number ? 'LBL_DUPLICATE_RELATED_LISTS' : '';

        if ($data['actions'] !== $row['actions']) {
            $message = 'LBL_DIFFERENT_ACTIONS';
        }

        $data['validate'] = 1 === $number;
        $data['validate_message'] = $message;
    }

    public function retrieveData()
    {
        $this->retrieveFocus();
        $this->retrieveCustomLinks();
        $this->retrieveEventHandler();
        $this->retrieveRelatedList();
        $this->retrieveCron();
    }

    public function retrieveFocus()
    {
        $this->focus = CRMEntity::getInstance($this->getModuleName());
    }

    /**
     * @return string
     */
    public function getModuleName()
    {
        return $this->moduleName;
    }

    /**
     * @param string $value
     */
    public function setModuleName($value)
    {
        $this->moduleName = $value;
    }

    public function retrieveCustomLinks()
    {
        $focus = $this->getFocus();

        if (method_exists($focus, 'retrieveCustomLinks')) {
            $focus->retrieveCustomLinks();
        }

        if (isset($focus->registerCustomLinks)) {
            $this->customLinks = $focus->registerCustomLinks;
        }
    }

    public function getFocus()
    {
        return $this->focus;
    }

    public function retrieveEventHandler()
    {
        $focus = $this->getFocus();

        if (method_exists($focus, 'retrieveEventHandler')) {
            $focus->retrieveEventHandler();
        }

        if (isset($focus->registerEventHandler)) {
            $this->eventHandler = $focus->registerEventHandler;
        }
    }

    public function retrieveRelatedList()
    {
        $focus = $this->getFocus();

        if (method_exists($focus, 'retrieveRelatedList')) {
            $focus->retrieveRelatedList();
        }

        if (isset($focus->registerRelatedLists)) {
            $this->relatedList = $focus->registerRelatedLists;
        }
    }

    public function retrieveCron()
    {
        $focus = $this->getFocus();

        if (method_exists($focus, 'retrieveCron')) {
            $focus->retrieveCron();
        }

        if (isset($focus->registerCron)) {
            $this->cron = $focus->registerCron;
        }
    }

    /**
     * @return string
     */
    public function getModuleLabel()
    {
        return vtranslate($this->getModuleName(), $this->getModuleName());
    }

    /**
     * @return string
     */
    public function getDefaultUrl()
    {
        return 'index.php?module=ITS4YouInstaller&parent=Settings&view=Requirements&mode=Module&sourceModule=' . $this->getModuleName();
    }

    public function getDataFromFunction($value)
    {
        if (method_exists($this, $value)) {
            return $this->$value();
        }

        if (method_exists($this->focus, $value)) {
            return $this->focus->$value();
        }

        return array();
    }

    public function getValidations()
    {
        $defaultValidation = array(
            array(
                'type' => 'links',
                'label' => 'LBL_CUSTOM_LINKS',
                'function' => 'getCustomLinks',
            ),
            array(
                'type' => 'cron',
                'label' => 'LBL_CRON',
                'function' => 'getCron',
            ),
            array(
                'type' => 'handler',
                'label' => 'LBL_EVENT_HANDLER',
                'function' => 'getEventHandler',
            ),
            array(
                'type' => 'related_list',
                'label' => 'LBL_RELATED_LIST',
                'function' => 'getRelatedList',
            ),
        );
        $validations = array();

        if (method_exists($this->focus, 'getRequirementValidations')) {
            $validations = $this->focus->getRequirementValidations();
        }

        return array_merge($defaultValidation, $validations);
    }
}
