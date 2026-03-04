<?php

/* * *******************************************************************************
 * The content of this file is subject to the PDF Maker Free license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

class PDFMaker_AjaxRequestHandle_Action extends Vtiger_Action_Controller {

    public function checkPermission(Vtiger_Request $request) {
        
    }

    public function process(Vtiger_Request $request) {
        $adb = PearDatabase::getInstance();
        $cu_model = Users_Record_Model::getCurrentUserModel();
        switch ($request->get("handler")) {
            case "fill_lang":
                $module = addslashes($request->get("langmod"));

                $mod_lang_big = Vtiger_Language_Handler::getModuleStringsFromFile($cu_model->get('language'), $module);
                $mod_lang = $mod_lang_big['languageStrings'];
                unset($mod_lang_big);

                $module_lang_labels = array_flip($mod_lang);
                $module_lang_labels = array_flip($module_lang_labels);
                asort($module_lang_labels);

                $response = new Vtiger_Response();
                $response->setResult(array('success' => true,'labels' => $module_lang_labels));
                $response->emit();
                break;

            case "fill_module_product_fields":
                $module = addslashes($request->get("productmod"));
                $PDFMaker = new PDFMaker_PDFMaker_Model();
                $Product_Block_Fields = $PDFMaker->GetProductBlockFields($module);
                $keys = implode('||', array_keys($Product_Block_Fields["SELECT_PRODUCT_FIELD"]));
                $values = implode('||', $Product_Block_Fields["SELECT_PRODUCT_FIELD"]);
                echo $keys . '|@|' . $values;
                break;
        }
    }
}