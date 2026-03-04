<?php
/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouProjectsChart license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

Class ITS4YouProjectsChart_IndexAjax_View extends Vtiger_IndexAjax_View {

	public function requiresPermission(\Vtiger_Request $request) {
		$permissions = parent::requiresPermission($request);
		$permissions[] = array('module_parameter' => 'source_module', 'action' => 'DetailView');
		return $permissions;
	}

    function __construct() {
        $this->exposeMethod('getProjectListButton');
        $this->exposeMethod('getListChart');
    }

	public function process(Vtiger_Request $request) {
        $mode = $request->get('mode');
        if(!empty($mode)) {
            $this->invokeExposedMethod($mode, $request);
            return;
        }
	}

    function getProjectListButton(Vtiger_Request $request)
    {
        if (!Users_Privileges_Model::isPermitted($request->getModule(), 'ListView')) {
            return false;
        }

        $viewer = $this->getViewer ($request);

		switch ($request->get('source_module')) {
            case 'Project':
                $urlModuleName = 'ITS4YouProjectsChart';
                $tplName = 'ProjectChartButton.tpl';
                break;
            default:
                $urlModuleName = 'Project';
                $tplName = 'ProjectListButton.tpl';
                break;
        }

        $viewer->assign('MODULE_MODEL', Vtiger_Module_Model::getInstance($urlModuleName));

        echo $viewer->view($tplName, $request->getModule(), true);
    }

    function getListChart(Vtiger_Request $request)
    {
        if (!Users_Privileges_Model::isPermitted($request->getModule(), 'ListView')) {
            return false;
        }

        $viewer = $this->getViewer ($request);
        $moduleName = $request->getModule();
        $currentUserModel = Users_Record_Model::getCurrentUserModel();

        $projects['tasks'] = ITS4YouProjectsChart_List_View::getProjects($request);
        $projects['selectedRow'] = 0;
        $projects['canWrite'] = true;
        $projects['canWriteOnParent'] = true;

        $viewer->assign('MODULE' , $moduleName);
        $viewer->assign('PROJECT_MODULE' , ITS4YouProjectsChart_List_View::$projectModuleName);
        $viewer->assign('PROJECTS' , $projects);
        $viewer->assign('USER_DATE_FORMAT', $currentUserModel->get('date_format'));

        echo $viewer->view('Datacontent.tpl', $request->getModule(), true);
    }
}
