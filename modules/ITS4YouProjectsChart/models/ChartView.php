<?php
/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouProjectsChart license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

class ITS4YouProjectsChart_ChartView_Model extends Vtiger_Base_Model
{
    /**
     * @var object
     */
    protected $listViewModel;

    /**
     * @var object
     */
    protected $pagingModel;

    /**
     * @var object
     */
    protected $queryGenerator;

    /**
     * @param object $listViewModel
     * @param object $pagingModel
     *
     * @return self
     */
    public static function getInstance($listViewModel, $pagingModel)
    {
        $self = new self();
        $self->setListView($listViewModel);
        $self->setPaging($pagingModel);

        return $self;
    }

    /**
     * @param object $value
     */
    public function setListView($value)
    {
        $this->listViewModel = $value;
    }

    /**
     * @param object $value
     */
    public function setPaging($value)
    {
        $this->pagingModel = $value;
    }

    /**
     * @return array
     */
    public function getRecords()
    {
        $records = [];

        foreach ($this->getListView()->getListViewEntries($this->getPaging()) as $recordModel) {
            array_push($records, Vtiger_Record_Model::getInstanceById($recordModel->getId(), $recordModel->getModuleName()));
        }

        return $records;
    }

    /**
     * @return object
     */
    public function getListView()
    {
        return $this->listViewModel;
    }

    /**
     * @return object
     */
    public function getPaging()
    {
        return $this->pagingModel;
    }

    /**
     * @return int
     * @throws Exception
     */
    public function getRecordsCount()
    {
        $adb = PearDatabase::getInstance();
        $moduleModel = $this->getListView()->getModule();
        $listQuery = preg_replace(
            '/(.*?)(\ FROM\ )/i',
            'SELECT count(distinct(' . $moduleModel->get('basetable') . '.' . $moduleModel->get('basetableid') . ')) AS count FROM ',
            $this->getListView()->getQuery()
        );
        $result = $adb->pquery($listQuery);

        return (int)$adb->query_result($result, 0, 'count');
    }

    /**
     * @param string $name
     * @param string $value
     */
    public function filterRecordsByFieldValue($name, $value)
    {
        $queryGeneratorClone = clone $this->getQueryGenerator();
        $queryGeneratorClone->addUserSearchConditions(['search_field' => $name, 'search_text' => $value, 'operator' => 'e']);

        $this->getListView()->set('query_generator', $queryGeneratorClone);
    }

    /**
     * @param object|string $parent
     */
    public function initializeDefaultColor($parent)
    {
        if (is_object($parent)) {
            $parent = $this->getParentFromObject($parent);
        }

        $this->setDefaultColor($this->defaultColors[$parent]);
    }

    /**
     * @return object
     */
    public function getQueryGenerator()
    {
        if (!$this->queryGenerator) {
            $this->setQueryGenerator($this->getListView()->get('query_generator'));
        }

        return $this->queryGenerator;
    }

    /**
     * @param object $value
     */
    public function setQueryGenerator($value)
    {
        $this->queryGenerator = $value;
    }

    /**
     * @param string $value
     */
    public function assignUsersFilter($value)
    {
        $queryGenerator = $this->getQueryGenerator();
        $queryGenerator->addCondition('assigned_user_id', $value, 'c', 'AND');
    }
}