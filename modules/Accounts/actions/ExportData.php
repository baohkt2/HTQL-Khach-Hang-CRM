<?php
/*+***********************************************************************************
 * Accounts export performance override.
 *
 * Original core pattern loaded full result in memory:
 *   // for ($j = 0; $j < $db->num_rows($result); $j++) { ... }
 * Optimized replacement uses chunked CSV streaming in Vtiger_CUSCChunkedExport_Action.
 *************************************************************************************/

require_once 'modules/Vtiger/actions/CUSCChunkedExport.php';

class Accounts_ExportData_Action extends Vtiger_CUSCChunkedExport_Action {
}
