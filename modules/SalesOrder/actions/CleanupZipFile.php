<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class SalesOrder_CleanupZipFile_Action extends Vtiger_Action_Controller {

    public function requiresPermission(\Vtiger_Request $request) {
        $permissions = parent::requiresPermission($request);
        $permissions[] = array('module_parameter' => 'module', 'action' => 'Export');
        return $permissions;
    }

    public function checkPermission(Vtiger_Request $request) {
        $moduleName = $request->getModule();
        $moduleModel = Vtiger_Module_Model::getInstance($moduleName);
        
        $currentUserPrivilegesModel = Users_Privileges_Model::getCurrentUserPrivilegesModel();
        if(!$currentUserPrivilegesModel->hasModulePermission($moduleModel->getId())) {
            throw new AppException(vtranslate('LBL_PERMISSION_DENIED', 'Vtiger'));
        }
        
        if(!Users_Privileges_Model::isPermitted($moduleName, 'Export')) {
            throw new AppException(vtranslate('LBL_PERMISSION_DENIED', 'Vtiger'));
        }
    }

    public function process(Vtiger_Request $request) {
        $timestamp = date('Y-m-d H:i:s');
        error_log("=== [$timestamp] SalesOrder CleanupZipFile Action Called ===");
        
        $zipFilePath = $request->get('zip_file');
        error_log("ZIP file to cleanup: " . $zipFilePath);
        
        if(empty($zipFilePath)) {
            error_log("ERROR: No ZIP file path provided");
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'error' => 'No ZIP file path provided'
            ]);
            exit;
        }
        
        // Security check - only allow files in cache/letters/zip/ directory
        if(strpos($zipFilePath, 'cache/letters/zip/') !== 0) {
            error_log("SECURITY ERROR: Invalid ZIP file path: " . $zipFilePath);
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'error' => 'Invalid file path'
            ]);
            exit;
        }
        
        try {
            if(file_exists($zipFilePath)) {
                if(unlink($zipFilePath)) {
                    error_log("ZIP file cleaned up successfully: " . $zipFilePath);
                    header('Content-Type: application/json');
                    echo json_encode([
                        'success' => true,
                        'message' => 'ZIP file cleaned up successfully',
                        'file_path' => $zipFilePath
                    ]);
                } else {
                    error_log("ERROR: Failed to delete ZIP file: " . $zipFilePath);
                    header('Content-Type: application/json');
                    echo json_encode([
                        'success' => false,
                        'error' => 'Failed to delete ZIP file'
                    ]);
                }
            } else {
                error_log("WARNING: ZIP file not found (may already be cleaned): " . $zipFilePath);
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => true,
                    'message' => 'ZIP file not found (may already be cleaned)',
                    'file_path' => $zipFilePath
                ]);
            }
        } catch (Exception $e) {
            error_log("CRITICAL ERROR in cleanup: " . $e->getMessage());
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
        
        exit;
    }
}