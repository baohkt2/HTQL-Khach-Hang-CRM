-- SQL Script to register VTDeleteEventHandler for ON_DELETE workflow functionality
-- Run this in MySQL/phpMyAdmin

-- Check if handler already exists
SELECT * FROM vtiger_eventhandlers WHERE event_name = 'vtiger.entity.afterdelete' AND handler_class = 'VTDeleteEventHandler';

-- If not exists, insert the handler
INSERT INTO vtiger_eventhandlers (event_name, handler_path, handler_class, cond, is_active, dependent_on)
SELECT 'vtiger.entity.afterdelete', 'modules/com_vtiger_workflow/VTDeleteEventHandler.inc', 'VTDeleteEventHandler', '', 1, NULL
WHERE NOT EXISTS (
    SELECT 1 FROM vtiger_eventhandlers 
    WHERE event_name = 'vtiger.entity.afterdelete' 
    AND handler_class = 'VTDeleteEventHandler'
);

-- Verify registration
SELECT * FROM vtiger_eventhandlers WHERE event_name = 'vtiger.entity.afterdelete';
