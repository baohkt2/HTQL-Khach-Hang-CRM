<?php
/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouInstaller license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

class Settings_ITS4YouInstaller_UpdateMessage_Model extends Vtiger_Base_Model
{
    public static function ITS4YouEmailMarketing()
    {
        $adb = PearDatabase::getInstance();

        if (!empty($adb->getColumnNames('its4you_emailmarketing'))) {
            $sql = 'SELECT its4youemailmarketingid 
                FROM its4you_emailmarketing 
                INNER JOIN vtiger_crmentity ON its4you_emailmarketing.its4youemailmarketingid=vtiger_crmentity.crmid 
                WHERE emailmarketingstatus IN (?,?) AND vtiger_crmentity.deleted=0';
            $result = $adb->pquery(
                $sql,
                ['Ready', 'Sending']
            );
            $numRows = $adb->num_rows($result);

            if ($numRows) {
                return vtranslate('LBL_FINISH_MARKETING_BEFORE_UPDATE', 'ITS4YouInstaller');
            }
        }

        return null;
    }
}