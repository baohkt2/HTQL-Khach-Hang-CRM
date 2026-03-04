<?php
/*+**********************************************************************************
 * Activity Tracker - Track user activity for accurate time tracking
 * Purpose: Update last_activity_time for time attendance tracking
 * Date: 2025-11-18
 ************************************************************************************/

class ActivityTracker {
    
    /**
     * Update user activity timestamp
     * Should be called on every authenticated request
     */
    public static function updateActivity() {
        global $adb;
        
        // Only track if user is logged in and has a session
        if (!isset($_SESSION) || !isset($_SESSION['authenticated_user_id'])) {
            return false;
        }
        
        // Get login_id from session
        $loginId = isset($_SESSION['login_id']) ? $_SESSION['login_id'] : null;
        $userName = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : null;
        
        // If no login_id in session, try to get the latest one for this user
        if (empty($loginId) && !empty($userName)) {
            $query = "SELECT login_id FROM vtiger_loginhistory 
                     WHERE user_name = ? 
                     AND status = 'Signed in' 
                     ORDER BY login_time DESC 
                     LIMIT 1";
            $result = $adb->pquery($query, array($userName));
            if ($result && $adb->num_rows($result) > 0) {
                $loginId = $adb->query_result($result, 0, 'login_id');
                $_SESSION['login_id'] = $loginId;
            }
        }
        
        if (empty($loginId) || empty($userName)) {
            return false;
        }
        
        try {
            $currentTime = date('Y-m-d H:i:s');
            
            // Check if record exists
            $checkQuery = "SELECT id FROM vtiger_user_activity_tracking WHERE login_id = ?";
            $checkResult = $adb->pquery($checkQuery, array($loginId));
            
            if ($adb->num_rows($checkResult) > 0) {
                // Update existing record
                $updateQuery = "UPDATE vtiger_user_activity_tracking 
                               SET last_activity_time = ?, 
                                   updated_at = ? 
                               WHERE login_id = ?";
                $adb->pquery($updateQuery, array($currentTime, $currentTime, $loginId));
            } else {
                // Insert new record
                $insertQuery = "INSERT INTO vtiger_user_activity_tracking 
                               (login_id, user_name, last_activity_time, created_at, updated_at) 
                               VALUES (?, ?, ?, ?, ?)";
                $adb->pquery($insertQuery, array($loginId, $userName, $currentTime, $currentTime, $currentTime));
            }
            
            return true;
        } catch (Exception $e) {
            error_log("ActivityTracker Error: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Get last activity time for a login session
     */
    public static function getLastActivity($loginId) {
        global $adb;
        
        $query = "SELECT last_activity_time FROM vtiger_user_activity_tracking WHERE login_id = ?";
        $result = $adb->pquery($query, array($loginId));
        
        if ($result && $adb->num_rows($result) > 0) {
            return $adb->query_result($result, 0, 'last_activity_time');
        }
        
        return null;
    }
    
    /**
     * Clean up old tracking records (older than 30 days)
     */
    public static function cleanup($daysOld = 30) {
        global $adb;
        
        $cutoffDate = date('Y-m-d H:i:s', strtotime("-{$daysOld} days"));
        
        $deleteQuery = "DELETE FROM vtiger_user_activity_tracking 
                       WHERE last_activity_time < ?";
        $result = $adb->pquery($deleteQuery, array($cutoffDate));
        
        return $adb->getAffectedRowCount($result);
    }
}
