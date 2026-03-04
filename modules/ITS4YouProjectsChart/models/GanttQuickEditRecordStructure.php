<?php
/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouProjectsChart license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

class ITS4YouProjectsChart_GanttQuickEditRecordStructure_Model extends Vtiger_QuickCreateRecordStructure_Model
{

    /**
     * Function to get the values in stuctured format
     * @return <array> - values in structure array('block'=>array(fieldinfo));
     */
    public function getStructure()
    {
        if (!empty($this->structuredValues)) {
            return $this->structuredValues;
        }

        $this->setModule(Vtiger_Module_Model::getInstance('Project'));

        $values = [];
        $recordModel = $this->getRecord();
        $moduleModel = $this->getModule();

        $fieldModelList = $moduleModel->getQuickCreateFields();

        // end date should be there in the quick edit for gantt chart
        $fieldModelList['targetenddate'] = $moduleModel->getField('targetenddate');
        $fieldModelList['projectstatus'] = $moduleModel->getField('projectstatus');
        $fieldModelList['actualenddate'] = $moduleModel->getField('actualenddate');

        foreach ($fieldModelList as $fieldName => $fieldModel) {
            $recordModelFieldValue = $recordModel->get($fieldName);
            if (!empty($recordModelFieldValue)) {
                $fieldModel->set('fieldvalue', $recordModelFieldValue);
            } elseif ($fieldName == 'eventstatus') {
                $currentUserModel = Users_Record_Model::getCurrentUserModel();
                $defaulteventstatus = $currentUserModel->get('defaulteventstatus');
                $fieldValue = $defaulteventstatus;
                if (!$defaulteventstatus || $defaulteventstatus == 'Select an Option') {
                    $fieldValue = $fieldModel->getDefaultFieldValue();
                }
                $fieldModel->set('fieldvalue', $fieldValue);
            } elseif ($fieldName == 'activitytype') {
                $currentUserModel = Users_Record_Model::getCurrentUserModel();
                $defaultactivitytype = $currentUserModel->get('defaultactivitytype');
                $fieldValue = $defaultactivitytype;
                if (!$defaultactivitytype || $defaultactivitytype == 'Select an Option') {
                    $fieldValue = $fieldModel->getDefaultFieldValue();
                }
                $fieldModel->set('fieldvalue', $fieldValue);
            } else {
                $defaultValue = $fieldModel->getDefaultFieldValue();
                if ($defaultValue) {
                    $fieldModel->set('fieldvalue', $defaultValue);
                }
            }
            $values[$fieldName] = $fieldModel;
        }
        $this->structuredValues = $values;

        return $values;
    }

    /**
     * Function to retieve the instance from record model
     *
     * @param <Vtiger_Record_Model> $recordModel - record instance
     *
     * @return Vtiger_RecordStructure_Model
     */
    public static function getInstanceFromRecordModel($recordModel, $mode = self::RECORD_STRUCTURE_MODE_DEFAULT)
    {
        $moduleModel = $recordModel->getModule();
        $className = Vtiger_Loader::getComponentClassName(
            'Model',
            $mode . 'RecordStructure',
            'ITS4YouProjectsChart'
        );
        $instance = new $className();
        $instance->setModule($moduleModel)->setRecord($recordModel);

        return $instance;
    }

}
