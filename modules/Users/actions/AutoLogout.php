<?php
/*+**********************************************************************************
 * Auto Logout Handler - Update logout time for expired sessions
 ************************************************************************************/

class Users_AutoLogout_Action extends Vtiger_Action_Controller {
    
    function checkPermission(Vtiger_Request $request) {
        return true;
    }

    /**
     * Update logout time for current session if expired or closing
     */
    function process(Vtiger_Request $request) {
        $response = new Vtiger_Response();
        
        try {
            $adb = PearDatabase::getInstance();
            $currentUser = Users_Record_Model::getCurrentUserModel();
            
            if ($currentUser) {
                $username = $currentUser->get('user_name');
                $userIPAddress = $_SERVER['REMOTE_ADDR'];
                $currentTime = date("Y-m-d H:i:s");
                
                // Get the latest login record that hasn't been logged out
                $loginIdQuery = "SELECT login_id FROM vtiger_loginhistory 
                                WHERE user_name=? AND user_ip=? 
                                AND (status='Signed in' OR logout_time = login_time)
                                ORDER BY login_id DESC LIMIT 1";
                
                $result = $adb->pquery($loginIdQuery, array($username, $userIPAddress));
                
                if ($adb->num_rows($result) > 0) {
                    $loginid = $adb->query_result($result, 0, "login_id");
                    
                    // Update logout time
                    $updateQuery = "UPDATE vtiger_loginhistory 
                                   SET logout_time = ?, status = ? 
                                   WHERE login_id = ?";
                    
                    $adb->pquery($updateQuery, array($currentTime, 'Signed off', $loginid));
                    
                    $response->setResult(array('success' => true, 'message' => 'Logout time updated'));
                } else {
                    $response->setResult(array('success' => false, 'message' => 'No active session found'));
                }
            } else {
                $response->setResult(array('success' => false, 'message' => 'No user session'));
            }
            
        } catch (Exception $e) {
            $response->setError($e->getCode(), $e->getMessage());
        }
        
        $response->emit();
    }
}
