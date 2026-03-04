<?php
/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouProjectsChart license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

class ITS4YouProjectsChart_EditAjax_View extends Project_EditAjax_View
{

    public function editColor(Vtiger_Request $request)
    {
        $viewer = $this->getViewer($request);
        $moduleName = $request->get('module');

        $parentRecordModel = Vtiger_Record_Model::getCleanInstance($moduleName);
        $viewer->assign('MODULE', $moduleName);
        $viewer->assign('STATUS', $request->get('status'));
        $viewer->assign('TASK_STATUS', Vtiger_Util_Helper::getPickListValues('projectstatus'));
//        $viewer->assign('TASK_STATUS_COLOR', ITS4YouProjectsChart_Record_Model::getStatusColors());
        $viewer->view('EditColor.tpl', $moduleName);
    }

}
