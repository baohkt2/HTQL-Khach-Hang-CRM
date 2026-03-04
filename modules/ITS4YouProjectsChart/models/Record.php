<?php
/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouProjectsChart license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

class ITS4YouProjectsChart_Record_Model extends Vtiger_Record_Model
{

    public static function getGanttStatus($status)
    {
        switch ($status) {
            default                :
                return $status;
        }
    }

    public static function getGanttStatusCss($number, $color)
    {
        return '.taskStatus[number="' . $number . '"]{
					background-color: ' . $color . ';
				}';
    }

    public static function getGanttSvgStatusCss($number, $color)
    {
        return '.taskStatusSVG[number="' . $number . '"]{
					fill: ' . $color . ';
				}';
    }

    public static function getGanttNumberCss($number, $color)
    {
        return '.taskStatus[status="' . $number . '"]{
					background-color: ' . $color . ';
				}';
    }

    public static function getGanttSvgNumberCss($number, $color)
    {
        return '.taskStatusSVG[status="' . $number . '"]{
					fill: ' . $color . ';
				}';
    }

//    public static function getStatusColors()
//    {
//        $db = PearDatabase::getInstance();
//        $statusColorMap = [];
//        $result = $db->pquery('SELECT * FROM its4you_project_status_color');
//
//        if ($db->num_rows($result)) {
//            for ($i = 0; $i < $db->num_rows($result); $i++) {
//                $status = decode_html($db->query_result($result, $i, 'status'));
//                $color = $db->query_result($result, $i, 'color');
//                if (empty($color)) {
//                    $color = $db->query_result($result, $i, 'defaultcolor');
//                }
//                $statusColorMap[$status] = $color;
//            }
//        }
//
//        return $statusColorMap;
//    }

    /**
     * Function to get the duration
     *
     * @param <string> $startDate ,$endDate
     * @param          $endDate
     *
     * @return false|float|int $duration
     */
    public static function getDuration($startDate, $endDate)
    {
        $duration = round(((strtotime($endDate) - strtotime($startDate)) / (3600 * 24)) + 1);

        // if the start date and end date are same
        if (!$duration) {
            return $duration + 0.1;
        } elseif (0 > $duration) { // if end date is null or less than start date
            return 0;
        }

        return $duration;
    }

    /**
     * @param $str
     *
     * @return false|string
     */
    public static function stringToColorCode($str)
    {
        $code = dechex(crc32($str));
        $code = '#' . substr($code, 0, 6);

        return $code;
    }

    /**
     * Function to get the project task for a project
     * @return array - $projects
     */
    public static function getProjects()
    {
        $moduleName = 'Project';
        $db = PearDatabase::getInstance();
        $request = new Vtiger_Request($_REQUEST, $_REQUEST);

        $projects = [];
        $sql = 'SELECT 
                    projectid AS recordid,
                    projectname AS name,
                    project_no AS project_no,
                    startdate,
                    IFNULL(actualenddate, targetenddate) enddate,
                    projectstatus projecttaskstatus,
                    progress
                FROM vtiger_project 
				INNER JOIN vtiger_crmentity  ON vtiger_project.projectid = vtiger_crmentity.crmid
				WHERE vtiger_crmentity.deleted=0 
				  AND vtiger_project.startdate IS NOT NULL 
				  AND (
				      vtiger_project.actualenddate IS NOT NULL
				      OR
				      vtiger_project.targetenddate IS NOT NULL
                  )';

        $result = $db->pquery($sql, []);

        $i = -1;
        while ($record = $db->fetchByAssoc($result)) {
            $record['id'] = $i;
            $record['name'] = decode_html(textlength_check($record['name']));
            $record['status_value'] = vtranslate($record['projecttaskstatus'], 'Project');
            $record['start'] = strtotime($record['startdate']) * 1000;
            $record['duration'] = self::getDuration($record['startdate'], $record['enddate']);
            $record['end'] = strtotime($record['enddate']) * 1000;
            $record['progress'] = (int)$record['progress'];
            $record['color'] = self::stringToColorCode($record['project_no']);
            $record['status'] = $record['project_no']; // have to be used in status because of unable ganttDrawerChanging
            $record['number'] = $record['project_no'];
            $projects[] = $record;
            $i--;
        }

        return $projects;
    }

}

?>
