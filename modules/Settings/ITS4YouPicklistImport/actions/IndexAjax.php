<?php

/***********************************************************************************
 * The content of this file is subject to the ITS4YouPicklistImport license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 ************************************************************************************/

class Settings_ITS4YouPicklistImport_IndexAjax_Action extends Settings_Vtiger_IndexAjax_View {

    function __construct() {
        parent::__construct();
        $this->exposeMethod('importValuesToRole');
    }

    public function process(Vtiger_Request $request) {
        $mode = $request->get('mode');
        if($this->isMethodExposed($mode)) {
            $this->invokeExposedMethod($mode, $request);
        }
    }

    public function importValuesToRole(Vtiger_Request $request) {
        $current_user = Users_Record_Model::getCurrentUserModel();

        $temporaryFileName = Import_Utils_Helper::getImportFilePath($current_user);

        if ($this->validateFileUpload($request)){

            $pickListName = $request->get('picklistName');
            $moduleName = $request->get('source_module');
            $moduleModel = Settings_Picklist_Module_Model::getInstance($moduleName);
            $fieldModel = Settings_Picklist_Field_Model::getInstance($pickListName, $moduleModel);
            $rolesSelected = array();
            if($fieldModel->isRoleBased()) {
                $userSelectedRoles = $request->get('rolesSelected',array());
                //selected all roles option
                if(in_array('all',$userSelectedRoles)) {
                    $roleRecordList = Settings_Roles_Record_Model::getAll();
                    foreach($roleRecordList as $roleRecord) {
                        $rolesSelected[] = $roleRecord->getId();
                    }
                }else{
                    $rolesSelected = $userSelectedRoles;
                }
            }

            require_once("libraries/PHPExcel/PHPExcel.php");

            $objPHPExcel = PHPExcel_IOFactory::load($temporaryFileName);

            $objWorksheet = $objPHPExcel->getActiveSheet();

            $i = 0;
            foreach ($objWorksheet->getRowIterator() as $row) {
                if ($i > 500) break;
                $i++;

                foreach ($row->getCellIterator() as $cell) {
                    $newValue = trim($cell->getCalculatedValue());
                    try{
                        if ($newValue != "") {
                            $moduleModel->addPickListValues($fieldModel, $newValue, $rolesSelected);
                        }
                    }  catch (Exception $e) {

                    }
                    break;
                }
            }
            unlink($temporaryFileName);
            header("Location: index.php?parent=Settings&module=Picklist&view=Index&source_module=".$moduleName);
        } else {
            echo $request->get('error_message');
        }

    }

    public function validateFileUpload($request) {
        $current_user = Users_Record_Model::getCurrentUserModel();

        $uploadMaxSize = Import_Utils_Helper::getMaxUploadSize();
        $importDirectory = Import_Utils_Helper::getImportDirectory();
        $temporaryFileName = Import_Utils_Helper::getImportFilePath($current_user);

        if($_FILES['import_file']['error']) {
            $request->set('error_message', Import_Utils_Helper::fileUploadErrorMessage($_FILES['import_file']['error']));
            return false;
        }
        if(!is_uploaded_file($_FILES['import_file']['tmp_name'])) {
            $request->set('error_message', vtranslate('LBL_FILE_UPLOAD_FAILED', 'Import'));
            return false;
        }
        if ($_FILES['import_file']['size'] > $uploadMaxSize) {
            $request->set('error_message', vtranslate('LBL_IMPORT_ERROR_LARGE_FILE', 'Import').
                $uploadMaxSize.' '.vtranslate('LBL_IMPORT_CHANGE_UPLOAD_SIZE', 'Import'));
            return false;
        }
        if(!is_writable($importDirectory)) {
            $request->set('error_message', vtranslate('LBL_IMPORT_DIRECTORY_NOT_WRITABLE', 'Import'));
            return false;
        }

        $fileCopied = move_uploaded_file($_FILES['import_file']['tmp_name'], $temporaryFileName);
        if(!$fileCopied) {
            $request->set('error_message', vtranslate('LBL_IMPORT_FILE_COPY_FAILED', 'Import'));
            return false;
        }
        return true;
    }
}