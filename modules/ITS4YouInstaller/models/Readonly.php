<?php

class ITS4YouInstaller_Readonly_Model extends Vtiger_Base_Model
{
    /**
     * @var Vtiger_Record_Model $recordModel
     * @var Vtiger_Module_Model $moduleModel
     * @var CRMEntity $moduleFocus
     * @var PearDatabase $adb
     */
    public $record, $module, $moduleModel, $recordModel, $moduleFocus, $adb;

    /**
     * @param int $record
     * @param string $module
     */
    public static function getInstance($module, $record = 0)
    {
        $self = new self();
        $self->retrieveDatabase();
        $self->setModule($module);
        $self->retrieveModuleModel();
        $self->retrieveModuleFocus();

        if ($record) {
            $self->setRecord($record);
            $self->retrieveRecordModel();
        }

        return $self;
    }

    public function retrieveDatabase()
    {
        $this->adb = PearDatabase::getInstance();
    }

    /**
     * @param string $value
     */
    public function setModule($value)
    {
        $this->module = $value;
    }

    public function retrieveModuleModel()
    {
        $this->moduleModel = Vtiger_Module_Model::getInstance($this->module);
    }

    public function retrieveModuleFocus()
    {
        $this->moduleFocus = CRMEntity::getInstance($this->module);
    }

    public function retrieveRecordModel()
    {
        $this->recordModel = Vtiger_Record_Model::getInstanceById($this->record, $this->moduleModel);
    }

    /**
     * @throws Exception
     */
    public function save()
    {
        if (empty($this->getData())) {
            throw new AppException(vtranslate('LBL_EMPTY_UPDATE_DATA'));
        }

        $entityData = $this->getEntityData(true);
        $em = new VTEventsManager($this->adb);
        $em->triggerEvent('vtiger.entity.beforesave', $entityData);

        $this->updateValues();

        $entityData = $this->getEntityData(true);
        $em->triggerEvent('vtiger.entity.aftersave', $entityData);
        $em->triggerEvent('vtiger.entity.aftersave.final', $entityData);
    }

    /**
     * @return VTEntityData
     * @throws Exception
     */
    public function getEntityData($retrieve = false)
    {
        if ($retrieve) {
            $this->retrieveFocusInfo();
        }

        $focus = $this->getModuleFocus();
        $focus->mode = 'edit';

        return VTEntityData::fromCRMEntity($focus);
    }

    public function retrieveFocusInfo()
    {
        $this->moduleFocus->retrieve_entity_info($this->getRecord(), $this->module);
        $this->moduleFocus->id = $this->getRecord();
    }

    public function getRecord()
    {
        return $this->record;
    }

    /**
     * @param int $value
     */
    public function setRecord($value)
    {
        $this->record = $value;
    }

    /**
     * @return CRMEntity
     */
    public function getModuleFocus()
    {
        return $this->moduleFocus;
    }

    /**
     * @throws Exception
     */
    public function updateValues()
    {
        $data = $this->getData();

        foreach ($data as $fieldName => $fieldValue) {
            $fieldModel = Vtiger_Field_Model::getInstance($fieldName, $this->getModuleModel());

            if (!$fieldModel) {
                continue;
            }

            $table = $fieldModel->get('table');
            $tableId = $this->getTableIndex($table);
            $column = $fieldModel->get('column');

            if (empty($table) || empty($column) || empty($tableId)) {
                continue;
            }

            $this->adb->pquery(
                sprintf('UPDATE %s SET %s=? WHERE %s=?', $table, $column, $tableId),
                array($fieldValue, $this->record)
            );
        }
    }

    /**
     * @return Vtiger_Module_Model
     */
    public function getModuleModel()
    {
        return $this->moduleModel;
    }

    /**
     * @param string $table
     * @return string
     */
    public function getTableIndex($table)
    {
        return isset($this->getModuleFocus()->tab_name_index) ? $this->getModuleFocus()->tab_name_index[$table] : '';
    }
}