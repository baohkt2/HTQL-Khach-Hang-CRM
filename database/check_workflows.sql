-- Check workflow configuration
SELECT workflow_id, workflowname, module_name, execution_condition, status 
FROM com_vtiger_workflows 
WHERE workflowname LIKE '%Trừ%' OR workflowname LIKE '%Tru%';

-- Check all workflows with their execution conditions
SELECT workflow_id, workflowname, module_name, 
       CASE execution_condition
           WHEN 1 THEN 'ON_FIRST_SAVE (Creation)'
           WHEN 2 THEN 'ONCE'
           WHEN 3 THEN 'ON_EVERY_SAVE (Update)'
           WHEN 4 THEN 'ON_MODIFY'
           WHEN 5 THEN 'ON_DELETE'
           WHEN 6 THEN 'ON_SCHEDULE'
           ELSE 'UNKNOWN'
       END as trigger_type,
       status
FROM com_vtiger_workflows;

-- Check event handlers
SELECT * FROM vtiger_eventhandlers WHERE event_name LIKE '%delete%';
