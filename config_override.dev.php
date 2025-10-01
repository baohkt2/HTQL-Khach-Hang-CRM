<?php

/** Logging configuration for Strict Development */
require_once "vtlib/Vtiger/Utils/PhpLogHandler.php";
Vtiger_PhpLogHandler::enableStrictLogging(__DIR__, "logs/phperr.log");
