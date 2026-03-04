<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Invoice_ExportPDFFiles_Action extends Vtiger_Action_Controller {

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
        // Debug logging with timestamp
        $timestamp = date('Y-m-d H:i:s');
        error_log("=== [$timestamp] ExportPDFFiles Action Called - NEW VERSION ===");
        error_log("Module: " . $request->getModule());
        error_log("Selected IDs raw: " . $request->get('selected_ids'));
        error_log("Excluded IDs raw: " . $request->get('excluded_ids'));
        error_log("Search params: " . $request->get('search_params'));
        error_log("Request method: " . $_SERVER['REQUEST_METHOD']);
        error_log("User Agent: " . $_SERVER['HTTP_USER_AGENT']);
        
        $moduleName = $request->getModule();
        $selectedIds = $request->get('selected_ids');
        $excludedIds = $request->get('excluded_ids');
        $searchInfo = $request->get('search_params');
        $createOnly = $request->get('create_only'); // New parameter to control behavior
        
        // Parse selected records
        $recordIds = array();
        if($selectedIds != 'all') {
            if(!empty($selectedIds)) {
                $recordIds = explode(',', $selectedIds);
                // Trim whitespace from each ID
                $recordIds = array_map('trim', $recordIds);
                error_log("Raw selected_ids string: '" . $selectedIds . "'");
                error_log("After explode: " . print_r($recordIds, true));
                error_log("Record count: " . count($recordIds));
            }
        } else {
            // Get all records with search params but exclude excluded_ids
            $listViewModel = Vtiger_ListView_Model::getInstance($moduleName);
            if(!empty($searchInfo)) {
                $listViewModel->set('search_params', $searchInfo);
            }
            
            $queryGenerator = $listViewModel->get('query_generator');
            if(!empty($excludedIds)) {
                $excludedRecordIds = explode(',', $excludedIds);
                $queryGenerator->addCondition('id', $excludedRecordIds, 'n');
            }
            
            $query = $queryGenerator->createQuery();
            $query .= ' LIMIT 5000'; // Limit to prevent memory issues
            
            $result = $listViewModel->getListViewEntries($queryGenerator);
            foreach($result as $recordModel) {
                $recordIds[] = $recordModel->getId();
            }
        }
        
        if(empty($recordIds)) {
            error_log("ERROR: No records found for export");
            $response = new Vtiger_Response();
            $response->setError('No records selected for export');
            $response->emit();
            return;
        }
        
        // Limit to prevent server overload
        if(count($recordIds) > 100) {
            error_log("ERROR: Too many records selected: " . count($recordIds));
            $response = new Vtiger_Response();
            $response->setError('Too many records selected. Maximum 100 records allowed.');
            $response->emit();
            return;
        }
        
        error_log("Proceeding to generate PDFs for " . count($recordIds) . " records");
        
        try {
            $zipFilePath = $this->generatePDFFiles($recordIds, $moduleName, $createOnly);
            
            // Always return JSON response for both modes
            if($zipFilePath) {
                error_log("=== Returning JSON response ===");
                
                $baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . 
                          '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']);
                $zipDownloadUrl = $baseUrl . '/' . $zipFilePath;
                
                error_log("ZIP Download URL: " . $zipDownloadUrl);
                
                $responseMessage = 'ZIP file created successfully';
                if($createOnly === 'true') {
                    $responseMessage .= ' (file preserved for download)';
                } else {
                    $responseMessage .= ' (file will be cleaned up after download)';
                }
                
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => true,
                    'zip_file_path' => $zipFilePath,
                    'zip_download_url' => $zipDownloadUrl,
                    'message' => $responseMessage,
                    'create_only' => $createOnly === 'true'
                ]);
                exit;
            }
        } catch (Exception $e) {
            error_log("CRITICAL ERROR in generatePDFFiles: " . $e->getMessage());
            error_log("Stack trace: " . $e->getTraceAsString());
            
            // Return JSON error response instead of blank page
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'error' => $e->getMessage(),
                'debug' => 'Check Apache error log for details'
            ]);
            exit;
        }
    }
    
    private function generatePDFFiles($recordIds, $moduleName, $createOnly = false) {
        error_log("=== generatePDFFiles called ===");
        error_log("Record IDs: " . print_r($recordIds, true));
        error_log("Module: " . $moduleName);
        error_log("=== USING NEW CACHE STRUCTURE: cache/letters/ ===");
        
        // Set execution limits to prevent timeout
        set_time_limit(300); // 5 minutes
        ini_set('memory_limit', '512M');
        error_log("Set timeout: 300s, memory: 512M");
        
        // Include required classes  
        if (!class_exists('PDFMaker_PDFMaker_Model')) {
            require_once 'modules/PDFMaker/models/PDFMaker.php';
        }
        
        // Create custom ZIP filename with Vietnamese name and date format
        $currentDate = date('d/m/Y');
        $zipFileName = "Danh Sách Giấy Báo Trúng Tuyển " . $currentDate . '.zip';
        // Clean filename for filesystem (replace / with -)
        $zipFileNameSafe = str_replace('/', '-', $zipFileName);
        $zipFilePath = 'cache/letters/zip/' . $zipFileNameSafe;
        
        error_log("ZIP file path: " . $zipFilePath);
        
        // Create cache/letters/pdf and cache/letters/zip directories if they don't exist
        $pdfDir = 'cache/letters/pdf';
        $zipDir = 'cache/letters/zip';
        
        if (!is_dir($pdfDir)) {
            mkdir($pdfDir, 0755, true);
            error_log("Created PDF directory: " . $pdfDir);
        }
        if (!is_dir($zipDir)) {
            mkdir($zipDir, 0755, true);
            error_log("Created ZIP directory: " . $zipDir);
        }
        
        // Use PHP's native ZipArchive instead of Vtiger_Zip
        $zip = new ZipArchive();
        $zipResult = $zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        if ($zipResult !== TRUE) {
            error_log("ERROR: Failed to create ZIP file. Error code: " . $zipResult);
            throw new Exception("Failed to create ZIP file");
        }
        error_log("ZIP archive created successfully with native ZipArchive");
        
        $successCount = 0;
        $errorCount = 0;
        
        error_log("Starting PDF generation loop for " . count($recordIds) . " records");
        
        foreach($recordIds as $index => $recordId) {
            error_log("=== LOOP START: Iteration " . ($index + 1) . "/" . count($recordIds) . " - Record ID: '" . $recordId . "' ===");
            try {
                error_log("Step 1: Starting PDF generation for record " . $recordId);
                $pdfContent = $this->generateSinglePDF($recordId, $moduleName);
                error_log("Step 2: PDF content generated successfully (Size: " . strlen($pdfContent) . " bytes)");
                
                $pdfFileName = $this->getPDFFileName($recordId, $moduleName);
                error_log("Step 3: PDF filename generated: " . $pdfFileName);
                
                // Save individual PDF file to cache/export/pdf directory for debugging
                $individualPdfPath = $pdfDir . '/' . $pdfFileName;
                error_log("Step 4: Saving PDF to: " . $individualPdfPath);
                file_put_contents($individualPdfPath, $pdfContent);
                error_log("Step 5: PDF file saved successfully");
                
                // Add to ZIP using native ZipArchive
                error_log("Step 6: Adding to ZIP...");
                $zipAddResult = $zip->addFromString($pdfFileName, $pdfContent);
                if($zipAddResult) {
                    $successCount++;
                    error_log("Step 7: Successfully added " . $pdfFileName . " to ZIP");
                } else {
                    error_log("ERROR: Failed to add " . $pdfFileName . " to ZIP");
                    $errorCount++;
                }
                
                // Log memory usage and force flush
                $memoryUsage = memory_get_usage(true) / 1024 / 1024;
                error_log("Memory usage after record $recordId: " . round($memoryUsage, 2) . " MB");
                
                // Clear PDF content from memory
                unset($pdfContent);
                
                // Force flush any output buffers
                if(ob_get_level()) {
                    ob_flush();
                }
                flush();
                
                error_log("=== CHECKPOINT: Finished processing record " . $recordId . " ===");
                
            } catch(Exception $e) {
                // Log detailed error information
                error_log("DETAILED ERROR for record $recordId:");
                error_log("Error message: " . $e->getMessage());
                error_log("Error file: " . $e->getFile());
                error_log("Error line: " . $e->getLine());
                error_log("Stack trace: " . $e->getTraceAsString());
                $errorCount++;
            }
            
            error_log("=== LOOP END: Completed iteration " . ($index + 1) . " ===");
        }
        
        error_log("=== FOREACH LOOP COMPLETED - All records processed ===");
        
        error_log("PDF Generation Summary - Success: $successCount, Errors: $errorCount");
        
        // List all files in PDF directory for debugging
        error_log("=== Files in PDF directory ===");
        if(is_dir($pdfDir)) {
            $pdfFiles = scandir($pdfDir);
            foreach($pdfFiles as $file) {
                if($file != '.' && $file != '..' && $file != 'index.html') {
                    $filePath = $pdfDir . '/' . $file;
                    $fileSize = filesize($filePath);
                    error_log("File: $file (Size: $fileSize bytes)");
                }
            }
        }
        error_log("=== End files listing ===");

        $zip->close();
        error_log("ZIP file closed");
        
        // Check if ZIP file was created successfully
        if(file_exists($zipFilePath)) {
            $zipSize = filesize($zipFilePath);
            $fullZipPath = realpath($zipFilePath);
            error_log("ZIP file created successfully: " . $zipFilePath . " (Size: " . $zipSize . " bytes)");
            error_log("Full ZIP path: " . $fullZipPath);
            
            // Log direct access URL for the ZIP file
            $baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . 
                      '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']);
            $zipDirectUrl = $baseUrl . '/' . $zipFilePath;
            error_log("Direct ZIP URL: " . $zipDirectUrl);
            error_log("ZIP filename for download: " . $zipFileName);
            
            if($zipSize > 0) {
                // Clean up individual PDF files after successful ZIP creation
                error_log("=== CLEANING UP INDIVIDUAL PDF FILES ===");
                $cleanupCount = 0;
                if(is_dir($pdfDir)) {
                    $pdfFiles = scandir($pdfDir);
                    foreach($pdfFiles as $file) {
                        if($file != '.' && $file != '..' && $file != 'index.html' && pathinfo($file, PATHINFO_EXTENSION) === 'pdf') {
                            $filePath = $pdfDir . '/' . $file;
                            if(unlink($filePath)) {
                                error_log("Deleted PDF file: " . $file);
                                $cleanupCount++;
                            } else {
                                error_log("Failed to delete PDF file: " . $file);
                            }
                        }
                    }
                }
                error_log("PDF cleanup completed. Deleted $cleanupCount files");
                
                // Check if this is create_only mode
                if($createOnly === 'true') {
                    error_log("=== CREATE_ONLY MODE - ZIP file created, not downloading ===");
                    error_log("ZIP file ready for download: " . $zipFilePath);
                    return $zipFilePath; // Return path for JSON response
                } else {
                    error_log("=== NORMAL MODE - ZIP file created, will be cleaned up after download ===");
                    error_log("ZIP file ready for download: " . $zipFilePath);
                    
                    // Don't clean up yet - let frontend download first
                    // File will be cleaned up by a separate process or after timeout
                    return $zipFilePath; // Return path for JSON response
                }
            } else {
                error_log("ERROR: ZIP file is empty");
                throw new AppException('Generated ZIP file is empty');
            }
        } else {
            error_log("ERROR: ZIP file was not created");
            throw new AppException('Error creating export file');
        }
        
        return null;
    }
    
    private function generateSinglePDF($recordId, $moduleName) {
        // Use PDFMaker to generate PDF content
        $PDFMaker = new PDFMaker_PDFMaker_Model();
        $language = Vtiger_Language_Handler::getLanguage();
        
        $mpdf = null;
        $name = $PDFMaker->GetPreparedMPDF($mpdf, $recordId, $moduleName, $language);
        
        if ($mpdf) {
            return $mpdf->Output('', 'S'); // Return as string
        }
        
        throw new Exception("Failed to generate PDF for record: $recordId");
    }
    
    private function getPDFFileName($recordId, $moduleName) {
        $recordModel = Vtiger_Record_Model::getInstanceById($recordId, $moduleName);
        
        // Get record display name for filename
        $displayName = $recordModel->getDisplayName();
        
        // Decode HTML entities to get proper Vietnamese characters
        $displayName = html_entity_decode($displayName, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        
        // Remove any remaining HTML tags
        $displayName = strip_tags($displayName);
        
        // Only remove characters that are truly problematic for filenames
        // Keep Vietnamese characters, spaces, and common punctuation
        $displayName = preg_replace('/[\\\\\/\:\*\?\"\<\>\|]/', '_', $displayName);
        
        // Trim spaces and remove multiple spaces
        $displayName = preg_replace('/\s+/', ' ', trim($displayName));
        
        return $displayName . '.pdf';
    }
    
    private function downloadFile($filePath, $fileName) {
        if(!file_exists($filePath)) {
            throw new AppException('File not found');
        }
        
        $fileSize = filesize($filePath);
        
        // Clear any previous output
        if(ob_get_level()) {
            ob_end_clean();
        }
        
        // Set headers for file download
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Content-Length: ' . $fileSize);
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Expires: 0');
        
        // Output file content
        readfile($filePath);
        exit;
    }
}