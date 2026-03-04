<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/

vimport('~~/vtlib/Vtiger/Net/Client.php');
class Users_Login_View extends Vtiger_View_Controller {

	function loginRequired() {
		return false;
	}
	
	function checkPermission(Vtiger_Request $request) {
		return true;
	}
	
	function preProcess(Vtiger_Request $request, $display = true) {
		global $current_user;

		$viewer = $this->getViewer($request);
		$viewer->assign('PAGETITLE', $this->getPageTitle($request));
		$viewer->assign('SCRIPTS', $this->getHeaderScripts($request));
		$viewer->assign('STYLES', $this->getHeaderCss($request));
		$viewer->assign('MODULE', $request->getModule());
		$viewer->assign('VIEW', $request->get('view'));
		$viewer->assign('LANGUAGE_STRINGS', array());

		$viewer->assign('INVENTORY_MODULES', array());
		$viewer->assign('SELECTED_MENU_CATEGORY', '');
		$viewer->assign('QUALIFIED_MODULE', '');
		$viewer->assign('PARENT_MODULE', '');
		$viewer->assign('NOTIFIER_URL', '');
		$viewer->assign('EXTENSION_MODULE', '');
		$viewer->assign('CURRENT_USER_MODEL', $current_user);
		$viewer->assign('LANGUAGE', '');

		if ($display) {
			$this->preProcessDisplay($request);
		}
	}

	function process (Vtiger_Request $request) {
  // Ensure UTF-8 encoding for Vietnamese content
		header('Content-Type: text/html; charset=utf-8');
		if (function_exists('mb_internal_encoding')) {
			mb_internal_encoding('UTF-8');
		}
		
		$finalJsonData = array();

		$modelInstance = Settings_ExtensionStore_Extension_Model::getInstance();
		$news = $modelInstance->getNews();
		$jsonData = array();

		if ($news && isset($news['result'])) {
			$jsonData = $news['result'];
			$oldTextLength = vglobal('listview_max_textlength');
			foreach ($jsonData as $blockData) {
				if ($blockData['type'] === 'feature') {
					$blockData['heading'] = "What's new in Vtiger Cloud";
				} else if ($blockData['type'] === 'news') {
					$blockData['heading'] = "Latest News";
					$blockData['image'] = '';
				}

				vglobal('listview_max_textlength', 80);
				$blockData['displayTitle'] = textlength_check($blockData['title']);

				vglobal('listview_max_textlength', 200);
				$blockData['displaySummary'] = textlength_check($blockData['summary']);
				$finalJsonData[$blockData['type']][] = $blockData;
			}
			vglobal('listview_max_textlength', $oldTextLength);
		}

		$viewer = $this->getViewer($request);
		$viewer->assign('DATA_COUNT', php7_count($jsonData));
		$viewer->assign('JSON_DATA', $finalJsonData);

		$mailStatus = $request->get('mailStatus');
		$error = $request->get('error');
		$message = '';
		if ($error) {
			switch ($error) {
				case 'login'		:	$message = 'Tên dang nh?p ho?c m?t kh?u không dúng';			break;
				case 'fpError'		:	$message = 'Tên dang nh?p ho?c d?a ch? email không h?p l?';	break;
				case 'statusError'	:	$message = 'Máy ch? g?i mail chua du?c c?u hình';				break;
			}
		} else if ($mailStatus) {
			$message = 'Email dã du?c g?i d?n h?p thu c?a b?n, vui lòng ki?m tra email';
		}

		$viewer->assign('ERROR', $error);
		$viewer->assign('MESSAGE', $message);
		$viewer->assign('MAIL_STATUS', $mailStatus);
		
		// Load branding configuration from .env
		if (function_exists('getBrandingConfig')) {
			$branding = getBrandingConfig();
		} else {
			$branding = array(
				'app_name' => 'CUSC CRM',
				'app_tagline' => 'H? th?ng Qu?n lý Quan h? Khách hàng',
				'app_logo' => 'layouts/v7/resources/Images/cusc-logo.png',
				'login_background' => '',
				'app_copyright' => '© ' . date('Y') . ' CUSC CRM',
				'app_website' => '',
				'show_marketing_panel' => true,
				'marketing_title' => 'Chào m?ng',
				'marketing_description' => 'N?n t?ng qu?n lý quan h? khách hàng toàn di?n',
				'marketing_features' => array(
					'Qu?n lý liên h? & khách hàng ti?m nang',
					'Tích h?p Email',
					'Phân tích & báo cáo nâng cao',
					'Quy trình làm vi?c t? d?ng',
				),
			);
		}
		$viewer->assign('BRANDING', $branding);
		
		$viewer->view('Login.tpl', 'Users');
	}

	function postProcess(Vtiger_Request $request) {
		$moduleName = $request->getModule();
		$viewer = $this->getViewer($request);
		$viewer->view('Footer.tpl', $moduleName);
	}

	function getPageTitle(Vtiger_Request $request) {
		// Use branding app name if available
		if (function_exists('env')) {
			$appName = env('APP_NAME', '');
			if (!empty($appName)) {
				return $appName;
			}
		}
		$companyDetails = Vtiger_CompanyDetails_Model::getInstanceById();
		return $companyDetails->get('organizationname');
	}

	function getHeaderScripts(Vtiger_Request $request){
		$headerScriptInstances = parent::getHeaderScripts($request);

		$jsFileNames = array(
							'~libraries/jquery/boxslider/jquery.bxslider.min.js',
							'modules.Vtiger.resources.List',
							'modules.Vtiger.resources.Popup',
							);
		$jsScriptInstances = $this->checkAndConvertJsScripts($jsFileNames);
		$headerScriptInstances = array_merge($jsScriptInstances,$headerScriptInstances);
		return $headerScriptInstances;
	}
}