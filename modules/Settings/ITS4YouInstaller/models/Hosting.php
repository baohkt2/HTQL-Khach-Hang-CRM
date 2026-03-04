<?php
/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouInstaller license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

class Settings_ITS4YouInstaller_Hosting_Model extends Vtiger_Base_Model
{
    public $headers;

    /**
     * @param array $data
     * @return Settings_ITS4YouInstaller_Hosting_Model|void
     */
    public static function getInstanceFromArray($data)
    {
        if (empty($data['hostingData'])) {
            return;
        }

        $instance = new self();
        $instance->headers = $data['hostingHeaders'];
        $instance->setData($data['hostingData']);

        return $instance;
    }

    public function getExpireString()
    {
        if(1 === (int)$this->get('dontuseworkflow')) {
            return ', ' . vtranslate('LBL_UNLIMITED', 'Settings:ITS4YouInstaller');
        }
        
        if(($this->has('closingdate_raw') && !$this->isEmpty('closingdate_raw') && strtotime($this->get('closingdate_raw')))) {
            return ', ' . Settings_ITS4YouInstaller_License_Model::formatDateDiffInStrings($this->get('closingdate_raw'));
        }

        return '';
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function isExpired()
    {
        if (1 === (int)$this->get('dontuseworkflow')) {
            return false;
        }

        $closingDate = $this->get('closingdate_raw');

        if (empty($closingDate) || $closingDate > date('Y-m-d')) {
            return false;
        }

        return true;
    }
}