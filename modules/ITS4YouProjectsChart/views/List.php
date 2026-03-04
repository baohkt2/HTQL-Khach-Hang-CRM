<?php
/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouProjectsChart license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

class ITS4YouProjectsChart_List_View extends Vtiger_Index_View
{

	private static $showChartMode = 'showChart';
	public static $projectModuleName = 'Project';

	protected $isInstalled = false;

	public function __construct()
	{
		parent::__construct();
		$this->exposeMethod(self::$showChartMode);
	}

	/**
	 * @param Vtiger_Request                    $request
	 * @param ITS4YouProjectsChart_Module_Model $moduleModel
	 */
	public function setModuleInfo($request, $moduleModel)
	{
		$fieldsInfo = [];
		$basicLinks = [];
		$settingLinks = [];
		$sourceModule = $this->getSourceModule();
		$moduleModel->setSourceModule($sourceModule);
		$sourceModel = Vtiger_Module_Model::getInstance($sourceModule);
		$kanbanBasicLinks = $moduleModel->getModuleBasicLinks();
		$moduleBasicLinks = $sourceModel->getModuleBasicLinks();
		$moduleSettingLinks = $sourceModel->getSettingLinks();

		if ($moduleBasicLinks) {
			foreach ($kanbanBasicLinks as $basicLink) {
				$basicLinks[] = Vtiger_Link_Model::getInstanceFromValues($basicLink);
			}
			foreach ($moduleBasicLinks as $basicLink) {
				$basicLinks[] = $moduleModel->getLinkModel($basicLink);
			}
		}

		if ($moduleSettingLinks) {
			foreach ($moduleSettingLinks as $settingsLink) {
				$settingLinks[] = $moduleModel->getLinkModel($settingsLink);
			}
		}

		$viewer = $this->getViewer($request);
		$viewer->assign('FIELDS_INFO', json_encode($fieldsInfo));
		$viewer->assign('MODULE_BASIC_ACTIONS', $basicLinks);
		$viewer->assign('MODULE_SETTING_ACTIONS', $settingLinks);
	}

	public function preProcess(Vtiger_Request $request, $display = true)
	{
		vtws_addDefaultModuleTypeEntity($request->getModule());

		$moduleChart = $request->getModule();
		$viewer = $this->getViewer($request);
		$sourceModule = $this->getSourceModule();
		$sourceModuleModel = Vtiger_Module_Model::getInstance($sourceModule);
		/** @var $modelChart ITS4YouProjectsChart_Module_Model */
		$modelChart = Vtiger_Module_Model::getInstance($moduleChart);
		$modelChart->initializeCustomView($request);
		$modelChart->initializeDefaultColor($sourceModuleModel);
		$parent = $modelChart->getParentFromObject($sourceModuleModel);
		$customViewId = $modelChart->getCustomViewId($request);
		$customViews = Vtiger_Filter::getAllForModule($sourceModuleModel);

		$viewer->assign('SOURCE_MODULE_NAME', $sourceModule);
		$viewer->assign('SOURCE_MODULE_MODEL', $sourceModuleModel);
		$viewer->assign('PICKLIST_CUSTOM_VIEWS', $customViews);
		$viewer->assign('DEFAULT_CUSTOM_VIEW_ID', $customViewId);
		$viewer->assign('DEFAULT_CUSTOM_VIEW', CustomView_Record_Model::getInstanceById($customViewId));
		$viewer->assign('DEFAULT_CUSTOM_VIEW_URL', $modelChart->getViewUrl($sourceModule) . '&viewname=' . $customViewId);
		$viewer->assign('SOURCE_CUSTOM_VIEWS', CustomView_Record_Model::getAllByGroup($sourceModule));
		$viewer->assign('SOURCE_ASSIGNED_USERS', $modelChart->getAssignedUsers($sourceModule));
		$viewer->assign('SOURCE_STATUS', getAllPickListValues('projectstatus'));
		$viewer->assign('SOURCE_MODULE_MENU_PARENT', $parent);
		$viewer->assign('DEFAULT_COLOR', $modelChart->getDefaultColor());
		$viewer->assign('MODULE_MODEL', $modelChart);
		$viewer->assign('PROJECT_MODULE', self::$projectModuleName);

		$menuGroupedByParent = Settings_MenuEditor_Module_Model::getAllVisibleModules();
		$viewer->assign('SOURCE_MODULE_MENU', $menuGroupedByParent[$parent]);

		parent::preProcess($request);
	}

	/**
	 * @return string
	 */
	public function getSourceModule()
	{
		return 'Project';
	}

	public function preProcessTplName(Vtiger_Request $request)
	{
		return 'ListViewPreProcess.tpl';
	}

	public function process(Vtiger_Request $request)
	{
		$this->getProcess($request);
	}

	public function getProcess(Vtiger_Request $request)
	{
		$mode = $request->getMode();

		if (empty($mode)) {
			$mode = self::$showChartMode;
		}

		if (method_exists($this, $mode)) {
			echo $this->invokeExposedMethod($mode, $request);

			return;
		}

		die('unsupported mode!');
	}

	/**
	 * Function to show Gantt chart
	 *
	 * @param Vtiger_Request $request
	 *
	 * @return bool|html
	 */
	public function showChart(Vtiger_Request $request)
	{
		$projects = [];
		$moduleName = $request->getModule();
		$currentUserModel = Users_Record_Model::getCurrentUserModel();
		$projectModel = Vtiger_Module_Model::getInstance(self::$projectModuleName);
		$projects['tasks'] = self::getProjects($request);
		$projects['selectedRow'] = 0;
		$projects['canWrite'] = true;
		$projects['canWriteOnParent'] = true;

		$viewer = $this->getViewer($request);
		$viewer->assign('MODULE', $moduleName);
		$viewer->assign('PROJECT_MODULE', self::$projectModuleName);
		$viewer->assign('PROJECTS', $projects);
		$viewer->assign('SCRIPTS', $this->getHeaderScripts($request));
		$viewer->assign('TASK_STATUS', Vtiger_Util_Helper::getRoleBasedPicklistValues('projectstatus', $currentUserModel->get('roleid')));
//		$viewer->assign('TASK_STATUS_COLOR', ITS4YouProjectsChart_Record_Model::getStatusColors());
		$viewer->assign('STYLES', $this->getHeaderCss($request));
		$viewer->assign('USER_DATE_FORMAT', $currentUserModel->get('date_format'));
		$viewer->assign('STATUS_FIELD_MODEL', Vtiger_Field_Model::getInstance('projectstatus', $projectModel));

		return $viewer->view('ShowChart.tpl', $moduleName, 'true');
	}

	/**
	 * @param Vtiger_Request $request
	 *
	 * @return array
	 */
	public static function getProjects(Vtiger_Request $request)
	{
		$cvId = 0;
		$projects = [];
		$db = PearDatabase::getInstance();
		$customView = new CustomView();

		if ($request->has('viewname')
			&& 'yes' === $customView->isPermittedCustomView($request->get('viewname'), 'List', self::$projectModuleName)
		) {
			$cvId = $request->get('viewname');
		}

		if (empty($cvId)) {
			$cvId = $customView->getViewId(self::$projectModuleName);
		}

		if (!$cvId) {
			$cvId = $customView->getViewIdByName('All', self::$projectModuleName);
		}

		$currentUser = Users_Record_Model::getCurrentUserModel();
		$queryGenerator = new QueryGenerator(self::$projectModuleName, $currentUser);

		$noQuery = '';

		if (columnExists('project_no', 'vtiger_project')) {
			$noQuery = ' project_no AS project_no, ';
			$idForColorColumn = 'project_no';
		} else {
			$noQuery = ' concat("clr", "", vtiger_project.projectid) AS project_no, ';
			$idForColorColumn = 'project_no';
		}

		$selectQuery = 'SELECT
                    vtiger_project.projectid AS recordid,
                    projectname AS name,
                    ' . $noQuery . '
                    startdate,
                    IFNULL(actualenddate, targetenddate) enddate,
                    projectstatus projecttaskstatus,
                    progress
                    FROM ';
		$queryGenerator->initForCustomViewById($cvId);

		if (!$request->isEmpty('usersFilter')) {
			$queryGenerator->addCondition('assigned_user_id', $request->get('usersFilter'), 'c', 'AND');
		}

		if (!$request->isEmpty('usersStatus')) {
			$queryGenerator->addCondition('projectstatus', $request->get('usersStatus'), 'c', 'AND');
		}

		$customViewQuery = $queryGenerator->getQuery();
		$matches = preg_split('/ FROM /', $customViewQuery);
		$matchesWhere = preg_split('/ WHERE /', $matches[1]);
		$selectQuery .= implode(' WHERE startdate IS NOT NULL AND ', $matchesWhere);

		$result = $db->query($selectQuery);

		if ($result && $db->num_rows($result)) {
			$i = -1;
			while ($record = $db->fetchByAssoc($result)) {
				$record['id'] = $i;
				$record['name'] = decode_html(textlength_check($record['name']));
				$record['status_value'] = vtranslate($record['projecttaskstatus'], 'Project');
				$record['start'] = strtotime($record['startdate']) * 1000;
				$record['duration'] = ITS4YouProjectsChart_Record_Model::getDuration($record['startdate'], $record['enddate']);
				$record['end'] = strtotime($record['enddate']) * 1000;
				$record['progress'] = (int)$record['progress'];
				$record['color'] = ITS4YouProjectsChart_Record_Model::stringToColorCode($record[$idForColorColumn]);
				$record['status'] = $record[$idForColorColumn]; // have to be used in status because of unable ganttDrawerChanging
				$record['number'] = $record[$idForColorColumn];
				$projects[] = $record;
				$i--;
			}
		}

		return $projects;
	}

	/**
	 * Function get gantt specific headerscript
	 *
	 * @param Vtiger_Request $request
	 *
	 * @return array
	 */
	public function getHeaderScripts(Vtiger_Request $request)
	{
		$headerScriptInstances = parent::getHeaderScripts($request);
		$moduleName = $request->getModule();
		$layout = Vtiger_Viewer::getDefaultLayoutName();

		$jsFileNames = [
			'~/libraries/jquery/gantt/libs/jquery.livequery.min.js',
			'~/libraries/jquery/gantt/libs/jquery.timers.js',
			'~/libraries/jquery/gantt/libs/platform.js',
			'~/libraries/jquery/gantt/libs/date.js',
			'~/libraries/jquery/gantt/libs/i18nJs.js',
			'~/libraries/jquery/gantt/libs/JST/jquery.JST.js',
			'~/libraries/jquery/gantt/libs/jquery.svg.min.js',
			'~/libraries/jquery/gantt/ganttUtilities.js',
			'~/modules/ITS4YouProjectsChart/gant/ganttProject.js',
			'~/libraries/jquery/gantt/ganttTask.js',
			'~/libraries/jquery/gantt/ganttDrawerSVG.js',
			'~/libraries/jquery/gantt/ganttGridEditor.js',
			'~/libraries/jquery/gantt/ganttMaster.js',
			'~/libraries/jquery/gantt/libs/moment.min.js',
			'~/libraries/jquery/colorpicker/js/colorpicker.js',

			/* Required for left menu */
			"modules.$moduleName.resources.List",
			'modules.Vtiger.resources.ListSidebar',
			"modules.$moduleName.resources.ListSidebar",
			'modules.CustomView.resources.CustomView',
			"modules.$moduleName.resources.CustomView",
			'libraries.jquery.ckeditor.ckeditor',
			'libraries.jquery.ckeditor.adapters.jquery',
			'modules.Vtiger.resources.CkEditor',
			'modules.Vtiger.resources.MergeRecords',
			"~layouts/$layout/lib/jquery/Lightweight-jQuery-In-page-Filtering-Plugin-instaFilta/instafilta.min.js",
			'modules.Vtiger.resources.Tag',
			"~layouts/$layout/lib/jquery/floatThead/jquery.floatThead.js",
			"~layouts/$layout/lib/jquery/perfect-scrollbar/js/perfect-scrollbar.jquery.js",

			/* required for chart view*/
//			'modules.ITS4YouProjectsChart.resources.Chart',
		];

		$jsScriptInstances = $this->checkAndConvertJsScripts($jsFileNames);
		$headerScriptInstances = array_merge($headerScriptInstances, $jsScriptInstances);

		return $headerScriptInstances;
	}

	/**
	 * Function to get the css styles for gantt chart
	 *
	 * @param Vtiger_Request $request
	 *
	 * @return array
	 */
	public function getHeaderCss(Vtiger_Request $request)
	{
		$headerCssInstances = parent::getHeaderCss($request);
		$cssFileNames = [
			'~/libraries/jquery/gantt/platform.css',
			'~/libraries/jquery/gantt/gantt.css',
			'~/libraries/jquery/colorpicker/css/colorpicker.css',
			'~layouts/v7/modules/ITS4YouProjectsChart/css/ChartView.css',
		];
		$cssInstances = $this->checkAndConvertCssStyles($cssFileNames);
		$headerCssInstances = array_merge($cssInstances, $headerCssInstances);

		return $headerCssInstances;
	}
}

?>
