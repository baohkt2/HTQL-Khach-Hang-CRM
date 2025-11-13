<?php
/*+**********************************************************************************
* The content of this file is subject to the CRMTiger Pro license.
* ("License"); You may not use this file except in compliance with the License
* The Initial Developer of the Original Code is vTiger
* The Modified Code of the Original Code owned by https://crmtiger.com/
* Portions created by CRMTiger.com are Copyright(C) CRMTiger.com
* All Rights Reserved.
************************************************************************************/
class CTChatLog_DashBoard_View extends Vtiger_Index_View {
    function __construct() {
        $this->exposeMethod('moduleDashBoard');
        $this->exposeMethod('getFacebookMessage');
    }

    function checkPermission(Vtiger_Request $request) {
        $moduleName = $request->getModule();
        if(!Users_Privileges_Model::isPermitted($moduleName, $actionName)) {
            throw new AppException(vtranslate('LBL_PERMISSION_DENIED'));
        }
    }

    function process(Vtiger_Request $request) {
        $mode = $request->get('mode');
        if(!empty($mode)) {
            $this->invokeExposedMethod($mode, $request);
        }
        return;
    }

    function moduleDashBoard(Vtiger_Request $request) {
        global $adb, $site_URL, $current_user;
        $moduleName = $request->getModule();
        $viewer = $this->getViewer($request);
        $analytics = $request->get('analytics');
        $currenUserID = $current_user->id;

        $isAdmin = $current_user->is_admin;
        $settingModule = 'Settings:'.$moduleName;

        $licensePage = $site_URL."/index.php?parent=Settings&module=CTFacebookMessengerIntegration&view=CTFacebookMessengerIntegrationList";
        $getLicenseData = Settings_CTFacebookMessengerIntegration_License_View::getLicenseData();
        $licenseStatus = $getLicenseData['status'];
        
        if ($licenseStatus == 0){
            echo "<h3>".$getLicenseData['message']." Please <a href=".$licensePage." style='color:blue;'>Click Here</a> to go License Page.</h3>";
            exit;
        }else if ($licenseStatus == 2) {
            echo "<h3>".$getLicenseData['message']."</h3>";
            exit;
        }//end of else if

        $facebookAllPageList = CTChatLog_Record_Model::getAllConnectedUsersFacebookPage($currenUserID);

        //Get login with facebook data
        $getChatTypeData = Settings_CTFacebookMessengerIntegration_Record_Model::getCTFacebookMessengerIntegrationData('ct_chat_chattype', array('chat_type_id'), array('platform' => 'Facebook Messenger'));
        $chatTypeRows = $adb->num_rows($getChatTypeData);
        $chatAccessTokenNumRows = 0;
        if($chatTypeRows > 0){
            $chatTypeId = $adb->query_result($getChatTypeData, 0, 'chat_type_id');

            //get access token data
            $getChatAccessTokenData =  Settings_CTFacebookMessengerIntegration_Record_Model::getCTFacebookMessengerIntegrationData("ct_chat_token", array('*'), array('chat_type_id' => $chatTypeId));
            $chatAccessTokenNumRows = $adb->num_rows($getChatAccessTokenData);
        }//end of if

        $viewer->assign('MODULE', $moduleName);
        $viewer->assign('ISADMIN', $isAdmin);
        $viewer->assign('ANALYTICS', $analytics);
        $viewer->assign('QUALIFIED_MODULE', $settingModule);
        $viewer->assign("FACEBOOK_STATUS", $chatAccessTokenNumRows);
        $viewer->assign("FACEBOOK_PAGES_LIST", $facebookAllPageList);

        echo $viewer->view('DashBoard.tpl', $moduleName);
    }//end of function

    function getFacebookMessage(Vtiger_Request $request){
        global $adb;
        $moduleName = $request->getModule();
        $datePeriodChart = CTChatLog_DashBoard_View::getPeriodDate($request);
        $getDataFromPeriodData = CTChatLog_DashBoard_View::getDataFromPeriodData($request);
        
        $periodData = $getDataFromPeriodData['arrayData'];
        $totalSentMessage = $getDataFromPeriodData['totalSentMessage'];
        $totalSentMessageURL = $getDataFromPeriodData['totalSentMessageURL'];
        $totalReceivedMessage = $getDataFromPeriodData['totalReceivedMessage'];
        $totalReceivedMessageURL = $getDataFromPeriodData['totalReceivedMessageURL'];
        $totalMessage = $getDataFromPeriodData['totalMessage'];
        $totalMessageURL = $getDataFromPeriodData['totalMessageURL'];

        $totalFinishedChat = $getDataFromPeriodData['totalFinishedChat'];
        $totalPendingChat = $getDataFromPeriodData['totalPendingChat'];

        $reportData = array('periodData' => json_encode($datePeriodChart), 'getDataFromPeriodData' => json_encode($periodData), 'totalMessage' => $totalMessage, 'totalSentMessage' => $totalSentMessage, 'totalReceivedMessage' => $totalReceivedMessage, 'totalFinishedChat' => $totalFinishedChat, 'totalPendingChat' => $totalPendingChat, 'totalMessageURL' => $totalMessageURL, 'totalSentMessageURL' => $totalSentMessageURL, 'totalReceivedMessageURL' => $totalReceivedMessageURL);

        $response = new Vtiger_Response();
        $response->setResult($reportData);
        $response->emit();
    }//end of function
    
    /**
    * Function to Get Date from Selected Period Type like Alltime/Today/etc
    */
    public static function getPeriodDate($request){
        global $adb;
        $start_day = 'Monday';
        $periodData = $request->get('periodData');
        if($periodData == 'thisweek'){
            $saturday = strtotime("last ".$start_day);
            $saturday = date('w', $saturday)==date('w') ? $saturday+7*86400 : $saturday;
            $friday = strtotime(date("Y-m-d",$saturday)." +6 days");

            $startdate = date("Y-m-d",$saturday);
            $endtdate = date("Y-m-d",$friday);

            $interval = new DateInterval('P1D');
            $realEnd = new DateTime($endtdate);
            $realEnd->add($interval);
            $format = 'Y-m-d';

            $period = new DatePeriod(new DateTime($startdate), $interval, $realEnd);
            $dateString = array();
            foreach($period as $key => $date) {
                $dateString[] =  DateTimeField::convertToUserFormat($date->format($format));
            }
        }elseif ($periodData == 'lastweek') {
            $currentDay = date("N", strtotime(date("Y-m-d")));
            if($currentDay == 1){
                $saturday = strtotime("0 week last ".$start_day);
            }else{
                $saturday = strtotime("-1 week last ".$start_day);
            }
            $friday = strtotime(date("Y-m-d",$saturday)." +6 days");
            $startdate = date("Y-m-d",$saturday);
            $endtdate = date("Y-m-d",$friday);

            $interval = new DateInterval('P1D');
            $realEnd = new DateTime($endtdate);
            $realEnd->add($interval);
            $format = 'Y-m-d';

            $period = new DatePeriod(new DateTime($startdate), $interval, $realEnd);
            $periodCount = iterator_count($period) - 1;
            $dateString = array();
            foreach($period as $key => $date) {
                $dateString[] =  DateTimeField::convertToUserFormat($date->format($format));
            }
        }elseif ($periodData == 'thismonth') {
            $firstDayOfMonth = date("d-m-Y", strtotime("first day of this month"));
            $lastDayOfMonth = date("d-m-Y", strtotime("last day of this month"));

            $interval = new DateInterval('P1D');
            $realEnd = new DateTime($lastDayOfMonth);
            $realEnd->add($interval);
            $format = 'Y-m-d';
            $period = new DatePeriod(new DateTime($firstDayOfMonth), $interval, $realEnd);
            $dateString = array();
            foreach($period as $date) {
                $dateString[] =  DateTimeField::convertToUserFormat($date->format($format));
            }
        }elseif ($periodData == 'lastmonth') {
            $firstDayOfMonth = date("d-m-Y", strtotime("first day of last month"));
            $lastDayOfMonth = date("d-m-Y", strtotime("last day of last month"));

            $interval = new DateInterval('P1D');
            $realEnd = new DateTime($lastDayOfMonth);
            $realEnd->add($interval);
            $format = 'Y-m-d';
            $period = new DatePeriod(new DateTime($firstDayOfMonth), $interval, $realEnd);
            $dateString = array();
            foreach($period as $date) {
                $dateString[] =  DateTimeField::convertToUserFormat($date->format($format));
            }
        }elseif ($periodData == 'today') {
            $todayDate = date('Y-m-d');
            $dateString[] =  DateTimeField::convertToUserFormat($todayDate);
        }elseif ($periodData == 'yesterday') {
            $yesterdayDate = date('Y-m-d',strtotime("-1 days"));
            $dateString[] =  DateTimeField::convertToUserFormat($yesterdayDate);
        }elseif ($periodData == 'alltime') {
            global $adb;
            $minYear = '2019';
            $maxYear = date('Y');

            $interval = new DateInterval('P1Y');
            $realEnd = new DateTime($maxYear);
            $realEnd->add($interval);
            $format = 'Y';
            $period = new DatePeriod(new DateTime($minYear), $interval, $realEnd);
            $dateString = array();
            foreach($period as $date) {
                $dateString[] =  $date->format($format);
            }
        }
        return $dateString;
    }//end of function

    public static function getDataFromPeriodData($request){
        global $adb,$current_user;
        $start_day = 'Monday';
        $periodData = $request->get('periodData');
        $facebookPage = $request->get('facebookPage');
        
        $yAxisData1 = array();
        $yAxisData2 = array();
        $arrayData = array();
        if($periodData == 'today'){
            $todayDate = date('Y-m-d');
            $interval = new DateInterval('P1D');
            $realEnd = new DateTime($todayDate);
            $realEnd->add($interval);

            $startdate = $todayDate;
            $endtdate = $todayDate;

            $period = new DatePeriod(new DateTime($todayDate), $interval, $realEnd);
            $format = 'Y-m-d';
            $arrayData = CTChatLog_DashBoard_View::getReportData($period, $format, $periodData, $facebookPage, $startdate, $endtdate);

        }elseif($periodData == 'yesterday'){
            $yesterdayDate = date('Y-m-d',strtotime("-1 days"));
            $interval = new DateInterval('P1D');
            $realEnd = new DateTime($yesterdayDate);
            $realEnd->add($interval);

            $startdate = $yesterdayDate;
            $endtdate = $yesterdayDate;

            $period = new DatePeriod(new DateTime($yesterdayDate), $interval, $realEnd);
            $format = 'Y-m-d';
            $arrayData = CTChatLog_DashBoard_View::getReportData($period, $format, $periodData, $facebookPage, $startdate, $endtdate);

        }elseif ($periodData == 'thisweek'){
            $saturday = strtotime("last ".$start_day);
            $saturday = date('w', $saturday)==date('w') ? $saturday+7*86400 : $saturday;
            $friday = strtotime(date("Y-m-d",$saturday)." +6 days");

            $startdate = date("Y-m-d",$saturday);
            $endtdate = date("Y-m-d",$friday);

            $interval = new DateInterval('P1D');
            $realEnd = new DateTime($endtdate);
            $realEnd->add($interval);
            $format = 'Y-m-d';

            $period = new DatePeriod(new DateTime($startdate), $interval, $realEnd);
            $periodCount = iterator_count($period) - 1;

            $arrayData = CTChatLog_DashBoard_View::getReportData($period, $format, $periodData, $facebookPage, $startdate, $endtdate);

        }elseif ($periodData == 'lastweek') {
            $currentDay = date("N", strtotime(date("Y-m-d")));
            if($currentDay == 1){
                $saturday = strtotime("0 week last ".$start_day);
            }else{
                $saturday = strtotime("-1 week last ".$start_day);
            }
            $friday = strtotime(date("Y-m-d",$saturday)." +6 days");
            $startdate = date("Y-m-d",$saturday);
            $endtdate = date("Y-m-d",$friday);

            $interval = new DateInterval('P1D');
            $realEnd = new DateTime($endtdate);
            $realEnd->add($interval);
            $format = 'Y-m-d';

            $period = new DatePeriod(new DateTime($startdate), $interval, $realEnd);

            $arrayData = CTChatLog_DashBoard_View::getReportData($period, $format, $periodData, $facebookPage, $startdate, $endtdate);

        }elseif ($periodData == 'thismonth') {
            $firstDayOfMonth = date("d-m-Y", strtotime("first day of this month"));
            $lastDayOfMonth = date("d-m-Y", strtotime("last day of this month"));

            $interval = new DateInterval('P1D');
            $realEnd = new DateTime($lastDayOfMonth);
            $realEnd->add($interval);
            $format = 'Y-m-d';
            $period = new DatePeriod(new DateTime($firstDayOfMonth), $interval, $realEnd);

            $startdate = $firstDayOfMonth;
            $endtdate = $lastDayOfMonth;

            $arrayData = CTChatLog_DashBoard_View::getReportData($period, $format, $periodData, $facebookPage, $startdate, $endtdate);     

        }elseif ($periodData == 'lastmonth') {
            $firstDayOfMonth = date("d-m-Y", strtotime("first day of last month"));
            $lastDayOfMonth = date("d-m-Y", strtotime("last day of last month"));

            $interval = new DateInterval('P1D');
            $realEnd = new DateTime($lastDayOfMonth);
            $realEnd->add($interval);
            $format = 'Y-m-d';
            $period = new DatePeriod(new DateTime($firstDayOfMonth), $interval, $realEnd);

            $startdate = $firstDayOfMonth;
            $endtdate = $lastDayOfMonth;

            $arrayData = CTChatLog_DashBoard_View::getReportData($period, $format, $periodData, $facebookPage, $startdate, $endtdate);

        }elseif ($periodData == 'alltime') {
            $minYear = '2019';
            $maxYear = date("Y");

            $interval = new DateInterval('P1Y');
            $realEnd = new DateTime($maxYear);
            $realEnd->add($interval);
            $format = 'Y';
            $period = new DatePeriod(new DateTime($minYear), $interval, $realEnd);

            $startdate = $maxYear.'-01-01';
            $endtdate = $maxYear.'-12-31';

            $arrayData = CTChatLog_DashBoard_View::getReportData($period, $format, $periodData, $facebookPage, $startdate, $endtdate);

        }
        return $arrayData;
    }//end of function

    public static function getReportData($period, $format, $periodData, $facebookPage, $startdate, $endtdate){
        $reportData = CTChatLog_Record_Model::getFacebookReportData($period, $format, $periodData, $facebookPage, $startdate, $endtdate);
        
        return $reportData;
    }//end of function


    /**
     * Function to get the list of Script models to be included
     * @param Vtiger_Request $request
     * @return <Array> - List of Vtiger_JsScript_Model instances
     */
    function getHeaderScripts(Vtiger_Request $request) {
        $headerScriptInstances = parent::getHeaderScripts($request);
        $moduleName = $request->getModule();

        $jsFileNames = array(
            "modules.$moduleName.resources.DashBoard",
            "modules.$moduleName.resources.highcharts",
        );

        $jsScriptInstances = $this->checkAndConvertJsScripts($jsFileNames);
        $headerScriptInstances = array_merge($jsScriptInstances,$headerScriptInstances);
        return $headerScriptInstances;
    }
}//end of class
?>