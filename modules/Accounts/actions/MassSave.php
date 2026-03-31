<?php
/*+***********************************************************************************
 * Accounts mass edit performance override.
 *
 * Original core pattern saved all records in one loop:
 *   // foreach($recordModels as $recordId => $recordModel) { saveMassEditedRecord(...); }
 * Optimized replacement batches records with transaction-per-chunk in
 * Vtiger_CUSCBatchMassSave_Action.
 *************************************************************************************/

require_once 'modules/Vtiger/actions/CUSCBatchMassSave.php';

class Accounts_MassSave_Action extends Vtiger_CUSCBatchMassSave_Action {
}
