<?php
/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouProjectsChart license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

class ITS4YouProjectsChart_SaveAjax_Action extends Project_SaveAjax_Action
{

    function saveColor(Vtiger_Request $request)
    {
        $db = PearDatabase::getInstance();
        $color = $request->get('color');
        $status = $request->get('status');

        $db->pquery('INSERT INTO its4you_project_status_color(status,color) VALUES(?,?) ON DUPLICATE KEY UPDATE color = ?', [$status, $color, $color]);
        $response = new Vtiger_Response();
        $response->setEmitType(Vtiger_Response::$EMIT_JSON);
        $response->setResult(true);
        $response->emit();
    }

}
