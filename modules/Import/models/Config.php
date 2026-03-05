<?php
/* +***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 * *********************************************************************************** */

class Import_Config_Model extends Vtiger_Base_Model {

	function __construct($values = array()) {
		$ImportConfig = array(
			'importTypes' => array(
							'csv'     => array('reader' => 'Import_CSVReader_Reader',   'classpath' => 'modules/Import/readers/CSVReader.php'),
							'vcf'     => array('reader' => 'Import_VCardReader_Reader', 'classpath' => 'modules/Import/readers/VCardReader.php'),
							'ics'     => array('reader' => 'Import_ICSReader_Reader',   'classpath' => 'modules/Import/readers/ICSReader.php'),
							'xls'     => array('reader' => 'Import_XLSReader_Reader',   'classpath' => 'modules/Import/readers/XLSReader.php'),
							'xlsx'    => array('reader' => 'Import_XLSReader_Reader',   'classpath' => 'modules/Import/readers/XLSReader.php'),
							'default' => array('reader' => 'Import_FileReader_Reader',  'classpath' => 'modules/Import/readers/FileReader.php')
						),

			'userImportTablePrefix' => 'vtiger_import_',
			// Individual batch limit - Keep low (250) so each AJAX cycle completes quickly and the UI stays responsive
			'importBatchLimit' => '250',
			// Threshold record limit for immediate import. If record count is more than this, then the import is scheduled through cron job
			// Set high (100000) because session_write_close() + set_time_limit(0) + batchImport=false allow safe immediate processing
			'immediateImportLimit' => '100000',
			'importPagingLimit' => '250',
			// Stale lock timeout in seconds - locks older than this will be auto-released
			'staleLockTimeout' => '1800',
		);

		$this->setData($ImportConfig);
	}	
}