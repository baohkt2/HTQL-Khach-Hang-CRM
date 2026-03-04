<?php
/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouProjectsChart license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

class ITS4YouProjectsChart_SaveProject_Action extends Vtiger_Save_Action
{

    public function checkPermission(Vtiger_Request $request)
    {
        $moduleName = $request->getModule();
        $record = $request->get('record');

        $nonEntityModules = ['Users', 'Events', 'Calendar', 'Portal', 'Reports', 'Rss', 'EmailTemplates'];
        if ($record && !in_array($moduleName, $nonEntityModules)) {
            $recordEntityName = getSalesEntityType($record);
            if ('Project' !== $recordEntityName) {
                throw new AppException(vtranslate('LBL_PERMISSION_DENIED'));
            }
        }

        if (!Users_Privileges_Model::isPermitted('Products', 'Save', $record)) {
            throw new AppException(vtranslate('LBL_PERMISSION_DENIED'));
        }

        return true;
    }

    public function validateRequest(Vtiger_Request $request)
    {
        return $request->validateWriteAccess();
    }

    public function process(Vtiger_Request $request)
    {
        $response = new Vtiger_Response();
        try {
            $recordModel = $this->saveRecord($request);
            $response->setResult(['record' => $recordModel->getId(), 'module' => $recordModel->get('for_module')]);
        } catch (DuplicateException $e) {
            $response->setError($e->getMessage(), $e->getDuplicationMessage(), $e->getMessage());
        } catch (Exception $e) {
            $response->setError($e->getMessage());
        }
        $response->emit();
    }

    /**
     * Function to save record
     *
     * @param <Vtiger_Request> $request - values of the record
     *
     * @return Vtiger_Record_Model - record Model of saved record
     */
    public function saveRecord($request)
    {
        $recordModel = $this->getRecordModelFromRequest($request);
        $recordModel->save();

        return $recordModel;
    }

    /**
     * Function to get the record model based on the request parameters
     *
     * @param Vtiger_Request $request
     *
     * @return Vtiger_Record_Model or Module specific Record Model instance
     */
    protected function getRecordModelFromRequest(Vtiger_Request $request)
    {
        $moduleName = $request->get('for_module');
        $recordId = $request->get('record');

        $moduleModel = Vtiger_Module_Model::getInstance($moduleName);

        if (!empty($recordId)) {
            $recordModel = Vtiger_Record_Model::getInstanceById($recordId, $moduleName);
            $recordModel->set('id', $recordId);
            $recordModel->set('mode', 'edit');
        } else {
            $recordModel = Vtiger_Record_Model::getCleanInstance($moduleName);
            $recordModel->set('mode', '');
        }

        $fieldModelList = $moduleModel->getFields();
        foreach ($fieldModelList as $fieldName => $fieldModel) {
            $fieldValue = null;

            if (in_array($fieldName, ['actualenddate', 'targetenddate',])) {
                // based on IFNULL(actualenddate, targetenddate) enddate,
                switch ($fieldName) {
                    case 'actualenddate':
                        if ($request->has('enddate')) {
                            if (!empty($recordModel->get('actualenddate'))) {
                                $fieldValue = $request->get('enddate', null);
                            }
                        } else {
                            $fieldValue = $request->get($fieldName, null);
                        }
                        break;
                    case 'targetenddate':
                        if ($request->has('enddate')) {
                            if (empty($recordModel->get('actualenddate'))) {
                                $fieldValue = $request->get('enddate', null);
                            }
                        } else {
                            $fieldValue = $request->get($fieldName, null);
                        }
                        break;
                }
            } else {
                $fieldValue = $request->get($fieldName, null);
            }

            $fieldDataType = $fieldModel->getFieldDataType();
            if ($fieldDataType == 'time' && $fieldValue !== null) {
                $fieldValue = Vtiger_Time_UIType::getTimeValueWithSeconds($fieldValue);
            }
            $ckeditorFields = ['commentcontent', 'notecontent'];
            if ((in_array($fieldName, $ckeditorFields)) && $fieldValue !== null) {
                $purifiedContent = vtlib_purify(decode_html($fieldValue));
                // Purify malicious html event attributes
                $fieldValue = purifyHtmlEventAttributes(decode_html($purifiedContent), true);
            }

            if ($fieldValue !== null) {
                if (!is_array($fieldValue) && $fieldDataType != 'currency') {
                    $fieldValue = trim($fieldValue);
                }
                $recordModel->set($fieldName, $fieldValue);
            }
        }

        return $recordModel;
    }
}
