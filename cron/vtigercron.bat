@echo OFF
REM #*********************************************************************************
REM # The contents of this file are subject to the vtiger CRM Public License Version 1.0
REM # ("License"); You may not use this file except in compliance with the License
REM # The Original Code is:  vtiger CRM Open Source
REM # The Initial Developer of the Original Code is vtiger.
REM # Portions created by vtiger are Copyright (C) vtiger.
REM # All Rights Reserved.
REM #
REM # ********************************************************************************

set VTIGERCRM_ROOTDIR="C:\xampp\htdocs\vtigercrm"
set PHP_EXE="C:\xampp\php\php.exe"

cd /D %VTIGERCRM_ROOTDIR%

%PHP_EXE% -f vtigercron.php 
