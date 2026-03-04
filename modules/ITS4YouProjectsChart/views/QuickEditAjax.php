<?php
/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouProjectsChart license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

class ITS4YouProjectsChart_QuickEditAjax_View extends Vtiger_IndexAjax_View
{

    public function checkPermission(Vtiger_Request $request)
    {
        $moduleName = $request->get('formodule');

        if (!(Users_Privileges_Model::isPermitted($moduleName, 'EditView'))) {
            throw new AppException(vtranslate('LBL_PERMISSION_DENIED', $moduleName));
        }
    }

    public function process(Vtiger_Request $request)
    {
        $currentModuleName = $request->getModule();
        $moduleName = $request->get('formodule');
        $projectId = $request->get('parentid');
        $recordId = $request->get('record');

        if ($recordId) {
            $recordModel = Vtiger_Record_Model::getInstanceById($recordId, $moduleName);
        } else {
            $recordModel = Vtiger_Record_Model::getCleanInstance($moduleName);
        }

        $moduleModel = $recordModel->getModule();

        $fieldList = $moduleModel->getFields();
        $fieldsInfo = [];
        foreach ($fieldList as $name => $model) {
            $fieldsInfo[$name] = $model->getFieldInfo();
        }
        $requestFieldList = array_intersect_key($request->getAll(), $fieldList);

        $recordStructureInstance = ITS4YouProjectsChart_GanttQuickEditRecordStructure_Model::getInstanceFromRecordModel($recordModel, 'GanttQuickEdit');
        $picklistDependencyDatasource = Vtiger_DependencyPicklist::getPicklistDependencyDatasource($moduleName);

        $viewer = $this->getViewer($request);
        $viewer->assign('PICKIST_DEPENDENCY_DATASOURCE', Vtiger_Functions::jsonEncode($picklistDependencyDatasource));
        $viewer->assign('RECORD', $recordId);
        $viewer->assign('CURRENTDATE', date('Y-n-j'));
        $viewer->assign('MODULE', $currentModuleName);
        $viewer->assign('FOR_MODULE', $moduleName);
        $viewer->assign('SINGLE_MODULE', 'SINGLE_' . $moduleName);
        $viewer->assign('MODULE_MODEL', $moduleModel);
        $viewer->assign('RECORD_STRUCTURE_MODEL', $recordStructureInstance);
        $viewer->assign('RECORD_STRUCTURE', $recordStructureInstance->getStructure());
        $viewer->assign('USER_MODEL', Users_Record_Model::getCurrentUserModel());

        $viewer->assign('SCRIPTS', $this->getHeaderScripts($request));

        $viewer->assign('MAX_UPLOAD_LIMIT_MB', Vtiger_Util_Helper::getMaxUploadSize());
        $viewer->assign('MAX_UPLOAD_LIMIT', vglobal('upload_maxsize'));
        $viewer->assign('RETURN_VIEW', $request->get('returnview'));
        $viewer->assign('RETURN_MODE', $request->get('returnmode'));
        $viewer->assign('RETURN_MODULE', $request->get('returnmodule'));
        $viewer->assign('RETURN_RECORD', $request->get('returnrecord'));
        $viewer->assign('FIELDS_INFO', json_encode($fieldsInfo));

        $viewer->view('QuickEdit.tpl', $currentModuleName);
    }

    public function getHeaderScripts(Vtiger_Request $request)
    {
        $moduleName = $request->getModule();
        $jsFileNames = [
            "modules.$moduleName.resources.Edit"
        ];
        $jsScriptInstances = $this->checkAndConvertJsScripts($jsFileNames);

        return $jsScriptInstances;
    }

}