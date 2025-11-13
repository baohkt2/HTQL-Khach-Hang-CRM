<?php
/* * *******************************************************************************
* The content of this file is subject to the CRMTiger Pro license.
* ("License"); You may not use this file except in compliance with the License
* The Initial Developer of the Original Code is https://crmtiger.com/
* Portions created by CRMTiger.com are Copyright(C) CRMTiger.com
* All Rights Reserved.
* ****************************************************************************** */
class CTFacebookMessengerIntegration {
    function vtlib_handler($moduleName, $eventType) {
        $adb = PearDatabase::getInstance();

        if ($eventType == 'module.postinstall') {
            $this->updateSettings();
        } else if ($eventType == 'module.disabled') {
            $adb->pquery('UPDATE vtiger_settings_field SET active= 1  WHERE  name= ?', array('Facebook Messenger Integration'));
        } else if ($eventType == 'module.enabled') {
            $adb->pquery('UPDATE vtiger_settings_field SET active= 0  WHERE  name= ?', array('Facebook Messenger Integration'));
        } else if ($eventType == 'module.preuninstall') {
        } else if ($eventType == 'module.preupdate') {
        } else if ($eventType == 'module.postupdate') {
            $this->updateSettings();
        }
    }

    private function updateSettings() {
        $adb = PearDatabase::getInstance();
        $linkto = 'index.php?parent=Settings&module=CTFacebookMessengerIntegration&view=CTGeneralConfiguration';

        $result=$adb->pquery('SELECT 1 FROM vtiger_settings_field WHERE name=?',array('Facebook Messenger Integration'));
        if($adb->num_rows($result)){
            $adb->pquery('UPDATE vtiger_settings_field SET name=?, iconpath=?, description=?, linkto=? WHERE name=?',array('Facebook Messenger Integration', '', '', $linkto, 'Facebook Messenger Integration'));
        }else{
            $fieldid = $adb->getUniqueID('vtiger_settings_field');
            $blockid = getSettingsBlockId('LBL_OTHER_SETTINGS');
            $seq_res = $adb->pquery("SELECT max(sequence) AS max_seq FROM vtiger_settings_field WHERE blockid = ?", array($blockid));
            if ($adb->num_rows($seq_res) > 0) {
                $cur_seq = $adb->query_result($seq_res, 0, 'max_seq');
                if ($cur_seq != null)   $seq = $cur_seq + 1;
            }
            $adb->pquery('INSERT INTO vtiger_settings_field(fieldid, blockid, name, iconpath, description, linkto, sequence) VALUES (?,?,?,?,?,?,?)', array($fieldid, $blockid, 'Facebook Messenger Integration' , '', '', $linkto, $seq));
        }
    }
}
?>