<?php
if (defined('VTIGER_UPGRADE')) {
    global $adb, $current_user;
    $db = PearDatabase::getInstance();

    // Increase column length to hold longer JSONified value.
    $db->pquery('ALTER TABLE com_vtiger_workflows MODIFY COLUMN schannualdates VARCHAR(500)', array());

    // Trim the space in value.
    $db->pquery('UPDATE vtiger_projecttaskstatus set projecttaskstatus = "Canceled" where projecttaskstatus = "Canceled "', array());

    // Ensure related-tab for ModComments on Inventory modules (if missed in previous migration)
    $modCommentsInstance = Vtiger_Module_Model::getInstance('ModComments');
    $modCommentFieldInstance = Vtiger_Field_Model::getInstance('related_to', $modCommentsInstance);
    foreach(getInventoryModules() as $refModuleName) {
        $refModuleModel = Vtiger_Module_Model::getInstance($refModuleName);
        $rs = $db->pquery("SELECT 1 FROM vtiger_relatedlists WHERE tabid=? and related_tabid=? and relationfieldid=? limit 1", array(
               $refModuleModel->id, $modCommentsInstance->id, $modCommentFieldInstance->id
        ));
        if (!$db->num_rows($rs)) {
            $refModuleModel->setRelatedList($modCommentsInstance, "ModComments", '', 'get_comments', $modCommentFieldInstance->id);
        }
    }

    // Resize column width to text (instead of varchar)
    $db->pquery("ALTER TABLE vtiger_shorturls MODIFY COLUMN handler_data text");

    // Disabling the mass edit for the inventory line item discount fields.
    $db->pquery("UPDATE vtiger_field set masseditable = 0 where columnname in ('discount_percent','discount_amount') 
    and tablename in ('vtiger_quotes','vtiger_purchaseorder','vtiger_salesorder','vtiger_invoice')", array());

    // Set value to 0 to avoid NaN troubles.
    $db->pquery("UPDATE vtiger_inventorycharges SET value = 0 WHERE  name = 'Shipping & Handling' and value IS NULL",array());

    // Increase column length of product and service name.
    $db->pquery("ALTER TABLE vtiger_products MODIFY COLUMN productname VARCHAR(255)", array());
    $db->pquery("ALTER TABLE vtiger_service MODIFY COLUMN servicename VARCHAR(255)", array());

    // Shipping & Handling tax column data-type should be consistent (for Invoice fixed in 660 migration).
    $db->pquery('ALTER TABLE vtiger_salesorder MODIFY s_h_percent DECIMAL(25,3)', array());
    $db->pquery('ALTER TABLE vtiger_purchaseorder MODIFY s_h_percent DECIMAL(25,3)', array());
    $db->pquery('ALTER TABLE vtiger_quotes MODIFY s_h_percent DECIMAL(25,3)', array());

    // Make hidden mandatory fields optional
    $db->pquery("UPDATE vtiger_field SET typeofdata = replace(typeofdata,'~M','~O') where presence =1 and typeofdata like '%~M%'", array());

	// START - Adding htaccess to upload_badext array in config file.
	// Updating the config file
	$fileName = 'config.inc.php';
	if (file_exists($fileName)) {
		// Read the contents of the file
		$completeData = file_get_contents('config.inc.php');
		$pattern = "/upload_badext\s*=+\s*array\(?...+\);/i";
		
		if (preg_match($pattern, $completeData, $matches)) {
			$arrayString = $matches[0];
			$content = '/htaccess/i';
			if (!preg_match($content, $arrayString)) {
				$updateStringPattern = "/upload_badext\s*=+\s*array\(?...+'/i";
				preg_match($updateStringPattern,$completeData,$matches);
				$updatedContent = preg_replace($updateStringPattern, "$matches[0],'htaccess'", $completeData);
				// Put the new contents into the file
				file_put_contents($fileName, $updatedContent);
			}
		}
	}
	//END
}
