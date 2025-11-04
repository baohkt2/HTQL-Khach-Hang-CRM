-- Register VTBatchEventHandler for vtiger.batchevent.save
-- This enables workflows to be triggered during import operations

-- Check if handler is already registered
SELECT 'Checking existing registrations...' as status;
SELECT * FROM vtiger_eventhandlers WHERE handler_class = 'VTBatchEventHandler';

-- Insert the new handler registration
INSERT INTO vtiger_eventhandlers 
(event_name, handler_path, handler_class, cond, is_active) 
VALUES (
    'vtiger.batchevent.save',
    'modules/com_vtiger_workflow/VTBatchEventHandler.inc',
    'VTBatchEventHandler',
    '',
    1
);

-- Verify the registration
SELECT 'Registration completed. Verifying...' as status;
SELECT * FROM vtiger_eventhandlers WHERE handler_class = 'VTBatchEventHandler';

-- Show all event handlers for reference
SELECT 'All event handlers:' as status;
SELECT eventhandler_id, event_name, handler_class, is_active 
FROM vtiger_eventhandlers 
ORDER BY event_name, handler_class;
