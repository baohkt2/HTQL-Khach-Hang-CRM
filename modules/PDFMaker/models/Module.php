<?php

/* * *******************************************************************************
 * The content of this file is subject to the PDF Maker Free license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

class PDFMaker_Module_Model extends Vtiger_Module_Model {

    public static $mobileIcon = 'pdffile1';
	public static $BROWSER_MERGE_TAG = '$custom-viewinbrowser$';

	/**
	 * Function to get the url for the Create Record view of the module
	 * @return <String> - url
	 */
	public function getCreateRecordUrl() {
		return '';
	}

    /**
     * @return <String> - url
    */
    public function getManualUrl() {
        return '';
    }

	/**
	 * Function to get the Quick Links for the module
	 * @param <Array> $linkParams
	 * @return <Array> List of Vtiger_Link_Model instances
	 */
	public function getSideBarLinks($linkParams) {

		$linkTypes = array('SIDEBARLINK', 'SIDEBARWIDGET');
		$links = Vtiger_Link_Model::getAllByType($this->getId(), $linkTypes, $linkParams);

		$quickLinks = array(
			array(
				'linktype' => 'SIDEBARLINK',
				'linklabel' => 'LBL_RECORDS_LIST',
				'linkurl' => $this->getDefaultUrl(),
				'linkicon' => '',
			),
		);
		foreach($quickLinks as $quickLink) {
			$links['SIDEBARLINK'][] = Vtiger_Link_Model::getInstanceFromValues($quickLink);
		}
		return $links;
	}

	/**
	 * Funxtion to identify if the module supports quick search or not
	 */
	public function isQuickSearchEnabled() {
		return false;
	}

	public function getPopupUrl() {
		return '';
	}

	/*
	 * Function to get supported utility actions for a module
	 */
	function getUtilityActionsNames() {
		return array();
	}

    /**
     * Function to get Settings links
     * @return <Array>
     */
    public function getSettingLinks(){

        $settingsLinks = array();

        $currentUserModel = Users_Record_Model::getCurrentUserModel();
        if($currentUserModel->isAdminUser()) {
            $settingsLinks[] =  array(
                'linktype' => 'LISTVIEWSETTING',
                'linklabel' => 'LBL_UPGRADE',
                'linkurl' => 'index.php?module=ModuleManager&parent=Settings&view=ModuleImport&mode=importUserModuleStep1',
                'linkicon' => ''
            );

            $settingsLinks[] =  array(
                'linktype' => 'LISTVIEWSETTING',
                'linklabel' => 'LBL_UNINSTALL',
                'linkurl' => 'index.php?module=ITS4YouInstaller&view=Uninstall&parent=Settings&sourceModule=PDFMaker',
                'linkicon' => ''
            );
        }
        return $settingsLinks;
    }

    public function getNameFields(){

        $nameFieldObject = Vtiger_Cache::get('EntityField',$this->getName());
        $moduleName = $this->getName();
        if($nameFieldObject && $nameFieldObject->fieldname) {
            $this->nameFields = explode(',', $nameFieldObject->fieldname);
        } else {
            $fieldNames = 'filename';
            $this->nameFields = array($fieldNames);


            $entiyObj = new stdClass();
            $entiyObj->basetable = "vtiger_pdfmaker";
            $entiyObj->basetableid = "templateid";
            $entiyObj->fieldname =  $fieldNames;
            Vtiger_Cache::set('EntityField',$this->getName(), $entiyObj);
        }

        return $this->nameFields;
    }


    function isStarredEnabled() {
        return false;
    }

	function isFilterColumnEnabled() {
		return false;
	}

    public function GetVersionType() {
        return $this->version_type;
    }

    public function GetListviewResult() {
        $adb = PearDatabase::getInstance();

        $sql = "SELECT vtiger_pdfmaker.*, vtiger_pdfmaker_settings.* FROM vtiger_pdfmaker 
                LEFT JOIN vtiger_pdfmaker_settings USING(templateid) ORDER BY vtiger_pdfmaker.templateid ASC";

        $result = $adb->pquery($sql, array());
        return $result;
    }
    
    public function GetListviewData() {
        $adb = PearDatabase::getInstance();
        $current_user = Users_Record_Model::getCurrentUserModel();

        $result = $this->GetListviewResult();

        $return_data = Array();
        $num_rows = $adb->num_rows($result);

        for ($i = 0; $i < $num_rows; $i++) {
            $currModule = $adb->query_result($result, $i, 'module');
            $templateid = $adb->query_result($result, $i, 'templateid');

            $pdftemplatearray = array();
            $pdftemplatearray['templateid'] = $templateid;
            $pdftemplatearray['description'] = $adb->query_result($result, $i, 'description');
            $pdftemplatearray['module'] = vtranslate($currModule, $currModule);
            $pdftemplatearray['filename'] = "<a href=\"index.php?module=PDFMaker&view=DetailFree&templateid=" . $templateid . "\">" . $pdftemplatearray['module']  . "</a>";
            $pdftemplatearray['edit'] = "<li><a href=\"index.php?module=PDFMaker&view=EditFree&return_view=List&templateid=" . $templateid . "\">" . vtranslate("LBL_EDIT", $MODULE) . "</a></li>";

            $return_data [] = $pdftemplatearray;
        }

        return $return_data;
    }

    //DetailView data
    public function GetDetailViewData($templateid) {

        $current_user = Users_Record_Model::getCurrentUserModel();
        $adb = PearDatabase::getInstance();
        $sql = "SELECT vtiger_pdfmaker.*, vtiger_pdfmaker_settings.*
			FROM vtiger_pdfmaker
                        LEFT JOIN vtiger_pdfmaker_settings USING(templateid)
			WHERE vtiger_pdfmaker.templateid=? AND vtiger_pdfmaker.deleted = ?";

        $result = $adb->pquery($sql, array($templateid,'0'));
        $pdftemplateResult = $adb->fetch_array($result);

        $pdftemplateResult["templateid"] = $templateid;
        return $pdftemplateResult;
    }

    public function GetEditViewData($templateid) {
        $adb = PearDatabase::getInstance();
        $sql = "SELECT vtiger_pdfmaker.*, vtiger_pdfmaker_settings.*
    			FROM vtiger_pdfmaker
    			LEFT JOIN vtiger_pdfmaker_settings USING(templateid)
    			WHERE vtiger_pdfmaker.templateid=? AND vtiger_pdfmaker.deleted = ?";

        $result = $adb->pquery($sql, array($templateid,'0'));
        $pdftemplateResult = $adb->fetch_array($result);
        return $pdftemplateResult;
    }

    public function GetAvailableSettings() {
        $menu_array = array();
        return $menu_array;
    }

    public function GetAvailableLanguages() {

        if (!isset($_SESSION["template_languages"]) || $_SESSION["template_languages"] == "") {
            $adb = PearDatabase::getInstance();
            $temp_res = $adb->pquery("SELECT label, prefix FROM vtiger_language WHERE active = ?", array('1'));
            while ($temp_row = $adb->fetchByAssoc($temp_res)) {
                $template_languages[$temp_row["prefix"]] = $temp_row["label"];
            }
            $_SESSION["template_languages"] = $template_languages;
        } else {
            $template_languages = $_SESSION["template_languages"];
        }
        return $template_languages;
    }

    public function getUrlAttributesString(Vtiger_Request $request,$Add_Attr = array()){
        $A = array();
        foreach ($this->UrlAttributes AS $attr_type){
            if(!isset($Add_Attr[$attr_type])){
                if ($request->has($attr_type) && !$request->isEmpty($attr_type)) {
                    $attr_val = $request->get($attr_type);
                    if (is_array($attr_val)) $attr_val = json_encode($attr_val);
                    $A[] = $attr_type.'='.urlencode($attr_val);
                }
            }
        }

        if (count($Add_Attr) > 0) {
            foreach ($Add_Attr AS $attr_type => $req_name){
                if ($request->has($req_name) && !$request->isEmpty($req_name)) {
                    $attr_val = $request->get($req_name);
                    if (is_array($attr_val)) $attr_val = json_encode($attr_val);
                    $A[] = $attr_type.'='.urlencode($attr_val);
                }
            }
        }

        return implode('&',$A);
    }

    public static function fixStoredName($values)
    {
        if (!isset($values["storedname"]) || empty($values["storedname"])) {
            $values["storedname"] = $values["name"];
        }

        return $values;
    }

    public function getDatabaseTables()
    {
        return [
            'vtiger_pdfmaker_license',
            'vtiger_pdfmaker_settings',
            'vtiger_pdfmaker_extensions',
            'vtiger_pdfmaker_displayed',
            'vtiger_pdfmaker_usersettings',
            'vtiger_pdfmaker_usersettings',
            'vtiger_pdfmaker_label_vals',
            'vtiger_pdfmaker_label_keys',
            'vtiger_pdfmaker_sharing',
            'vtiger_pdfmaker_profilespermissions',
            'vtiger_pdfmaker_ignorepicklistvalues',
            'vtiger_pdfmaker_productbloc_tpl',
            'vtiger_pdfmaker_relblocksortcol',
            'vtiger_pdfmaker_relblockdatefilter',
            'vtiger_pdfmaker_relblockcriteria_g',
            'vtiger_pdfmaker_relblockcriteria',
            'vtiger_pdfmaker_relblockcol',
            'vtiger_pdfmaker_relblocks',
            'vtiger_pdfmaker_userstatus',
            'vtiger_pdfmaker_releases',
            'vtiger_pdfmaker_images',
            'vtiger_pdfmaker_breakline',
            'vtiger_pdfmaker_settings',
            'vtiger_pdfmaker_seq',
            'vtiger_pdfmaker',
        ];
    }

    public function getPicklistFields()
    {
        return [];
    }
}