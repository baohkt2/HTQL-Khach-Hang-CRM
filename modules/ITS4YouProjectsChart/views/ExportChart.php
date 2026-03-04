<?php
/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouProjectsChart license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

class ITS4YouProjectsChart_ExportChart_View extends Vtiger_Index_View
{

    function checkPermission(Vtiger_Request $request)
    {
        $moduleName = 'Project';
        $moduleModel = Reports_Module_Model::getInstance($moduleName);

        $currentUserPriviligesModel = Users_Privileges_Model::getCurrentUserPrivilegesModel();
        if (!$currentUserPriviligesModel->hasModulePermission($moduleModel->getId())) {
            throw new AppException(vtranslate('LBL_PERMISSION_DENIED'));
        }
    }

    function preProcess(Vtiger_Request $request)
    {
        return false;
    }

    function postProcess(Vtiger_Request $request)
    {
        return false;
    }

    function process(Vtiger_request $request)
    {
        $this->GetPrintReport($request);
    }

    /**
     * Function displays the report in printable format
     *
     * @param Vtiger_Request $request
     */
    function GetPrintReport(Vtiger_Request $request)
    {
        $moduleName = $request->get('module');
        $projectModuleName = 'Project';
        $parentId = $request->get('record');
        $projects = [];
        $currentUserModel = Users_Record_Model::getCurrentUserModel();
        $projects['tasks'] = ITS4YouProjectsChart_Record_Model::getProjects();
        $projects['selectedRow'] = 0;
        $projects['canWrite'] = true;
        $projects['canWriteOnParent'] = true;
        $viewer = $this->getViewer($request);
        $viewer->assign('PARENT_ID', $parentId);
        $viewer->assign('PROJECT_MODULE' , $projectModuleName);
        $viewer->assign('MODULE', $moduleName);
        $viewer->assign('PROJECTS', $projects);
//        $viewer->assign('TASK_STATUS_COLOR', ITS4YouProjectsChart_Record_Model::getStatusColors());
        $viewer->assign('USER_DATE_FORMAT', $currentUserModel->get('date_format'));

        $viewer->view('ShowChartPrintView.tpl', $moduleName);
    }
}