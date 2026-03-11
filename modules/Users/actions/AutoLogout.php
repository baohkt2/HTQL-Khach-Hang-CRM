<?php
/*+**********************************************************************************
 * Auto Logout Handler - Update logout time when browser tab closes or user is idle.
 * Called by SessionTracker.js via navigator.sendBeacon().
 ************************************************************************************/

class Users_AutoLogout_Action extends Vtiger_Action_Controller {
    
    function checkPermission(Vtiger_Request $request) {
        return true;
    }

    function process(Vtiger_Request $request) {
        $response = new Vtiger_Response();
        
        try {
            $reason = $request->get('reason');
            $adb = PearDatabase::getInstance();
            $currentTime = date("Y-m-d H:i:s");
            $loginId = null;
            $username = null;
            
            // 1) Try login_id from session (most reliable)
            if (isset($_SESSION['login_id']) && !empty($_SESSION['login_id'])) {
                $loginId = $_SESSION['login_id'];
            }
            
            // 2) Try from current user model
            if (!$loginId) {
                $currentUser = Users_Record_Model::getCurrentUserModel();
                if ($currentUser) {
                    $username = $currentUser->get('user_name');
                    $userIPAddress = $_SERVER['REMOTE_ADDR'];
                    
                    $result = $adb->pquery(
                        "SELECT login_id FROM vtiger_loginhistory 
                         WHERE user_name=? AND user_ip=? AND status IN ('Signed in','Signed off')
                         ORDER BY login_id DESC LIMIT 1",
                        array($username, $userIPAddress)
                    );
                    
                    if ($adb->num_rows($result) > 0) {
                        $loginId = $adb->query_result($result, 0, "login_id");
                    }
                }
            }
            
            if ($loginId) {
                if ($reason === 'beforeunload') {
                    // ACTUAL tab close → mark as Signed off definitively
                    $adb->pquery(
                        "UPDATE vtiger_loginhistory SET logout_time = ?, status = 'Signed off' 
                         WHERE login_id = ? AND status IN ('Signed in','Signed off')",
                        array($currentTime, $loginId)
                    );
                } else {
                    // Heartbeat or any other reason → only touch logout_time,
                    // keep status 'Signed in' so the session stays active.
                    $adb->pquery(
                        "UPDATE vtiger_loginhistory SET logout_time = ? 
                         WHERE login_id = ? AND status = 'Signed in'",
                        array($currentTime, $loginId)
                    );
                }
                $response->setResult(array('success' => true));
            } else {
                $response->setResult(array('success' => false, 'message' => 'No active session'));
            }
            
        } catch (\Throwable $e) {
            $response->setError($e->getCode(), $e->getMessage());
        }
        
        $response->emit();
    }
}
