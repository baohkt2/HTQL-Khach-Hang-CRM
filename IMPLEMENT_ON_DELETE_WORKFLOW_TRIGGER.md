# Implement ON_DELETE Workflow Trigger in Vtiger CRM

## Tổng Quan

Tài liệu này mô tả chi tiết quá trình implement tính năng **ON_DELETE Workflow Trigger** trong Vtiger CRM v7. Tính năng này cho phép workflows tự động thực thi khi một record bị xóa.

### Vấn Đề Ban Đầu

Vtiger CRM có sẵn các execution conditions cho workflows:

- `ON_FIRST_SAVE` (1): Khi record được tạo mới lần đầu
- `ONCE` (2): Chạy một lần duy nhất
- `ON_EVERY_SAVE` (3): Mỗi khi record được lưu
- `ON_MODIFY` (4): Khi record được chỉnh sửa
- `ON_SCHEDULE` (6): Theo lịch định sẵn

Tuy nhiên, **ON_DELETE (5)** đã được reserve trong code nhưng **CHƯA ĐƯỢC IMPLEMENT**. Điều này có nghĩa là không thể tạo workflows tự động chạy khi xóa records.

### Use Case

Trong hệ thống CRM, Organizations (Accounts) có custom field `cf_1260` để đếm số lượng Contacts thuộc về organization đó. Khi:

- **Tạo Contact mới**: Cần tăng counter `cf_1260` lên 1
- **Xóa Contact**: Cần giảm counter `cf_1260` xuống 1

Workflow "Cộng 1" (ON_FIRST_SAVE) đã hoạt động tốt, nhưng workflow "Trừ 1" cần ON_DELETE trigger.

---

## Chi Tiết Implementation

### 1. Thêm ON_DELETE Constant vào Workflow Manager

**File**: `modules/com_vtiger_workflow/VTWorkflowManager.inc`

**Thay đổi**:

```php
class VTWorkflowManager{
	static $ON_FIRST_SAVE = 1;
	static $ONCE = 2;
	static $ON_EVERY_SAVE = 3;
	static $ON_MODIFY = 4;
	static $ON_DELETE = 5;  // ← ADDED
	static $ON_SCHEDULE = 6;
	// ... rest of code
}
```

**Giải thích**:

- Constant này định nghĩa execution condition cho ON_DELETE workflows
- Value `5` đã được reserve sẵn trong database schema
- Được sử dụng để so sánh trong event handlers

---

### 2. Cập Nhật Module Model với Trigger Type

**File**: `modules/Settings/Workflows/models/Module.php`

**Thay đổi**:

```php
public function getTriggerTypes() {
    return array(
        '1' => 'ON_FIRST_SAVE',
        '2' => 'ONCE',
        '3' => 'ON_EVERY_SAVE',
        '4' => 'ON_MODIFY',
        '5' => 'ON_DELETE',  // ← ADDED
        '6' => 'ON_SCHEDULE'
    );
}
```

**Giải thích**:

- Method này trả về danh sách các trigger types có thể chọn khi tạo workflow
- Key là execution_condition value trong database
- Value là tên constant tương ứng trong VTWorkflowManager

---

### 3. Thêm Language Keys

**File**: `languages/en_us/Settings/Workflows.php`

```php
$languageStrings = array(
    // ... existing translations
    'ON_DELETE' => 'When a record is deleted',  // ← ADDED
);
```

**File**: `languages/en_us/Vtiger.php`

```php
$languageStrings = array(
    // ... existing translations
    'LBL_DELETION' => 'deletion',  // ← ADDED
);
```

**Giải thích**:

- `ON_DELETE`: Label hiển thị trong dropdown/radio button selection
- `LBL_DELETION`: Label cho radio button text "On deletion of ..."

---

### 4. Cập Nhật UI Template

**File**: `layouts/v7/modules/Settings/Workflows/WorkFlowTrigger.tpl`

**Thay đổi**:

```smarty
<div class="radio">
    <label>
        <input type="radio" name="workflow_trigger" data-value="5" value="ON_DELETE"
               {if $TRIGGER eq 'ON_DELETE'}checked{/if}>
        {vtranslate('LBL_ON', $QUALIFIED_MODULE)}
        {vtranslate('LBL_DELETION', $MODULE)}
        {vtranslate('LBL_OF', $QUALIFIED_MODULE)}
        {vtranslate($SOURCE_MODULE, $SOURCE_MODULE)}
    </label>
</div>
```

**Giải thích**:

- Thêm radio button option cho "On deletion of [Module]"
- `data-value="5"`: Execution condition value trong database
- `value="ON_DELETE"`: Tên constant
- Checked nếu workflow hiện tại đang dùng ON_DELETE trigger

**Kết quả UI**: Radio button mới xuất hiện trong workflow creation form với text "On deletion of Contacts"

---

### 5. Tạo Delete Event Handler

**File**: `modules/com_vtiger_workflow/VTDeleteEventHandler.inc` (NEW FILE)

```php
<?php
require_once('modules/com_vtiger_workflow/VTEventHandler.inc');
require_once('modules/com_vtiger_workflow/VTWorkflowManager.inc');
require_once 'include/Webservices/ModuleTypes.php';

class VTDeleteEventHandler extends VTEventHandler {

	function handleEvent($eventName, $entityData) {
		$util = new VTWorkflowUtils();
		$user = $util->adminUser();
		global $adb;

		// DEBUG: Log that handler is called
		error_log("VTDeleteEventHandler: handleEvent called for event: $eventName");
		error_log("VTDeleteEventHandler: Entity ID: " . $entityData->getId());
		error_log("VTDeleteEventHandler: Module: " . $entityData->getModuleName());

		$entityCache = new VTEntityCache($user);

		$wsModuleName = $util->toWSModuleName($entityData);
		$wsId = vtws_getWebserviceEntityId($wsModuleName, $entityData->getId());
		$entityData = $entityCache->forId($wsId);

		// Get workflows for this module with ON_DELETE execution condition
		$wfs = new VTWorkflowManager($adb);
		$workflows = $wfs->getWorkflowsForModule($entityData->getModuleName());

		error_log("VTDeleteEventHandler: Found " . count($workflows) . " workflows for module");

		foreach ($workflows as $workflow) {
			if (!is_a($workflow, 'Workflow'))
				continue;

			error_log("VTDeleteEventHandler: Checking workflow ID: " . $workflow->id . ", execution_condition: " . $workflow->executionCondition);

			// Only execute workflows with ON_DELETE execution condition
			if ($workflow->executionCondition == VTWorkflowManager::$ON_DELETE) {
				error_log("VTDeleteEventHandler: Found ON_DELETE workflow: " . $workflow->description);

				// Evaluate conditions and execute tasks
				if ($workflow->evaluate($entityCache, $entityData->getId())) {
					error_log("VTDeleteEventHandler: Conditions met, executing tasks...");
					$workflow->performTasks($entityData);
					error_log("VTDeleteEventHandler: Tasks executed");
				} else {
					error_log("VTDeleteEventHandler: Conditions NOT met");
				}
			}
		}

		$util->revertUser();
		error_log("VTDeleteEventHandler: handleEvent completed");
	}
}
?>
```

**Giải thích từng bước**:

1. **Initialize Workflow Utils và Admin User**:

   ```php
   $util = new VTWorkflowUtils();
   $user = $util->adminUser();
   ```

   - Workflows cần chạy với quyền admin để access tất cả records
   - `adminUser()` switch context sang admin user

2. **Debug Logging**:

   ```php
   error_log("VTDeleteEventHandler: handleEvent called for event: $eventName");
   ```

   - Log vào Apache error log để debug
   - Giúp trace execution flow

3. **Load Entity Cache**:

   ```php
   $entityCache = new VTEntityCache($user);
   $wsId = vtws_getWebserviceEntityId($wsModuleName, $entityData->getId());
   $entityData = $entityCache->forId($wsId);
   ```

   - Entity cache cung cấp field values cho workflow evaluation
   - Webservice ID format: `[ModuleId]x[RecordId]` (e.g., `4x123`)

4. **Get Workflows cho Module**:

   ```php
   $wfs = new VTWorkflowManager($adb);
   $workflows = $wfs->getWorkflowsForModule($entityData->getModuleName());
   ```

   - Load tất cả workflows cho module này (Contacts, Accounts, etc.)

5. **Filter ON_DELETE Workflows**:

   ```php
   if ($workflow->executionCondition == VTWorkflowManager::$ON_DELETE) {
   ```

   - Chỉ execute workflows có execution_condition = 5

6. **Evaluate Conditions và Execute Tasks**:

   ```php
   if ($workflow->evaluate($entityCache, $entityData->getId())) {
       $workflow->performTasks($entityData);
   }
   ```

   - `evaluate()`: Check workflow conditions (If conditions)
   - `performTasks()`: Execute workflow tasks (Update fields, Send email, etc.)

7. **Cleanup**:
   ```php
   $util->revertUser();
   ```
   - Switch lại về user context ban đầu

---

### 6. Đăng Ký Event Handler vào Database

Event handler cần được register trong table `vtiger_eventhandlers` để Vtiger biết gọi nó khi event xảy ra.

#### Vấn Đề Quan Trọng: beforedelete vs afterdelete

**Ban đầu**: Register handler cho event `vtiger.entity.afterdelete`

```sql
INSERT INTO vtiger_eventhandlers
(event_name, handler_path, handler_class, cond, is_active)
VALUES (
    'vtiger.entity.afterdelete',  -- WRONG!
    'modules/com_vtiger_workflow/VTDeleteEventHandler.inc',
    'VTDeleteEventHandler',
    '',
    1
);
```

**Vấn đề**:

- Event `afterdelete` được trigger AFTER record đã bị xóa khỏi database
- Entity data không còn tồn tại
- Không thể load field values để evaluate conditions hoặc get related records
- Workflow tasks không thể access entity data

**Giải pháp**: Thay đổi sang event `vtiger.entity.beforedelete`

```sql
UPDATE vtiger_eventhandlers
SET event_name = 'vtiger.entity.beforedelete'  -- CORRECT!
WHERE handler_class = 'VTDeleteEventHandler';
```

**Tại sao beforedelete?**

Check trong `data/CRMEntity.php`:

```php
public function trash($module, $id) {
    // ... initialization code

    $entityData = VTEntityData::fromEntityId($adb, $id);

    // Trigger BEFORE delete - entity data still in database
    $em->triggerEvent("vtiger.entity.beforedelete", $entityData);  // ← Line 1357

    // Now mark as deleted
    $this->mark_deleted($id);  // ← Line 1359

    // ... cleanup code

    // Trigger AFTER delete - entity data already deleted
    $em->triggerEvent("vtiger.entity.afterdelete", $entityData);  // ← Line 1370
}
```

**Kết luận**:

- `beforedelete` (line 1357): Entity vẫn còn trong database → có thể access fields
- `mark_deleted()` (line 1359): Set `deleted = 1` trong database
- `afterdelete` (line 1370): Entity đã bị mark deleted → không access được fields

**Final SQL**:

```sql
-- Verify current registration
SELECT * FROM vtiger_eventhandlers WHERE handler_class = 'VTDeleteEventHandler';

-- Result:
-- eventhandler_id: 35
-- event_name: vtiger.entity.beforedelete  ← CORRECT!
-- handler_path: modules/com_vtiger_workflow/VTDeleteEventHandler.inc
-- handler_class: VTDeleteEventHandler
-- is_active: 1
```

---

### 7. Helper Scripts để Registration và Debugging

#### Script 1: CLI Registration Script

**File**: `register_delete_workflow_handler.php`

```php
<?php
/**
 * This script registers the VTDeleteEventHandler for vtiger.entity.beforedelete event
 */

chdir(dirname(__FILE__));
require_once 'vtlib/Vtiger/Module.php';
require_once 'includes/main/WebUI.php';

global $adb;

echo "Registering VTDeleteEventHandler for vtiger.entity.beforedelete event...\n";

// Check if handler already exists
$checkQuery = "SELECT * FROM vtiger_eventhandlers WHERE event_name = 'vtiger.entity.beforedelete' AND handler_class = 'VTDeleteEventHandler'";
$result = $adb->pquery($checkQuery, array());

if ($adb->num_rows($result) > 0) {
    echo "Handler already registered!\n";
} else {
    // Register the handler
    $em = new VTEventsManager($adb);
    $em->registerHandler(
        'vtiger.entity.beforedelete',
        'modules/com_vtiger_workflow/VTDeleteEventHandler.inc',
        'VTDeleteEventHandler'
    );
    echo "Handler registered successfully!\n";
}

echo "Done!\n";
?>
```

**Usage**:

```bash
php register_delete_workflow_handler.php
```

#### Script 2: Web-based Registration & Verification

**File**: `register_delete_handler_web.php`

```php
<?php
require_once 'vtlib/Vtiger/Module.php';
require_once 'includes/main/WebUI.php';

global $adb;

echo "<h2>VTDeleteEventHandler Registration & Verification</h2>";

// Check existing handlers
echo "<h3>Current Event Handlers for Delete Events:</h3>";
$query = "SELECT * FROM vtiger_eventhandlers WHERE event_name = 'vtiger.entity.beforedelete'";
$result = $adb->pquery($query, array());
echo "<pre>";
echo "Found " . $adb->num_rows($result) . " handlers:\n\n";
while ($row = $adb->fetchByAssoc($result)) {
    print_r($row);
}
echo "</pre>";

// Register if not exists
echo "<h3>Registration Status:</h3>";
$checkQuery = "SELECT * FROM vtiger_eventhandlers WHERE event_name = 'vtiger.entity.beforedelete' AND handler_class = 'VTDeleteEventHandler'";
$checkResult = $adb->pquery($checkQuery, array());

if ($adb->num_rows($checkResult) > 0) {
    echo "<p style='color: green;'>✓ VTDeleteEventHandler is already registered!</p>";
} else {
    echo "<p style='color: orange;'>⚠ VTDeleteEventHandler not found. Registering...</p>";

    $em = new VTEventsManager($adb);
    $em->registerHandler(
        'vtiger.entity.beforedelete',
        'modules/com_vtiger_workflow/VTDeleteEventHandler.inc',
        'VTDeleteEventHandler'
    );

    echo "<p style='color: green;'>✓ Handler registered successfully!</p>";
}

echo "<h3>Verification:</h3>";
$verifyResult = $adb->pquery($checkQuery, array());
if ($adb->num_rows($verifyResult) > 0) {
    echo "<pre>";
    print_r($adb->fetchByAssoc($verifyResult));
    echo "</pre>";
}
?>
```

**Usage**: Navigate to `http://localhost/vtigercrm/register_delete_handler_web.php`

#### Script 3: SQL Verification Queries

**File**: `database/check_workflows.sql`

```sql
-- Check ON_DELETE workflows
SELECT workflow_id, workflowname, module_name, execution_condition, status
FROM com_vtiger_workflows
WHERE execution_condition = 5;

-- Check workflow tasks
SELECT task_id, workflow_id, summary, task
FROM com_vtiger_workflowtasks
WHERE workflow_id IN (SELECT workflow_id FROM com_vtiger_workflows WHERE execution_condition = 5);

-- Check event handlers
SELECT * FROM vtiger_eventhandlers
WHERE event_name = 'vtiger.entity.beforedelete';

-- Verify handler registration
SELECT * FROM vtiger_eventhandlers
WHERE handler_class = 'VTDeleteEventHandler';
```

---

## Testing

### 1. Tạo Workflows

**Workflow 1: "Cộng 1" (Creation)**

- Module: Contacts
- Trigger: ON_FIRST_SAVE
- Task: Update field `account_id.cf_1260` = `(account_id : (Accounts) cf_1260) + 1`

**Workflow 2: "Trừ 1" (Deletion)**

- Module: Contacts
- Trigger: ON_DELETE ← New option!
- Task: Update field `account_id.cf_1260` = `(account_id : (Accounts) cf_1260) - 1`

### 2. Verify Database State

```sql
-- Check workflows
mysql> SELECT workflow_id, workflowname, execution_condition, status
       FROM com_vtiger_workflows
       WHERE workflowname IN ('Cộng 1', 'Trừ 1');

+-------------+--------------+---------------------+--------+
| workflow_id | workflowname | execution_condition | status |
+-------------+--------------+---------------------+--------+
|          27 | Cộng 1       |                   1 |      1 |
|          29 | Trừ 1        |                   5 |      1 |
+-------------+--------------+---------------------+--------+

-- Check tasks
mysql> SELECT task_id, workflow_id, summary
       FROM com_vtiger_workflowtasks
       WHERE workflow_id IN (27, 29);

+---------+-------------+---------------------------+
| task_id | workflow_id | summary                   |
+---------+-------------+---------------------------+
|      31 |          27 | Update field cf_1260 (+1) |
|      33 |          29 | Update field cf_1260 (-1) |
+---------+-------------+---------------------------+

-- Check handler
mysql> SELECT * FROM vtiger_eventhandlers
       WHERE handler_class = 'VTDeleteEventHandler';

+-----------------+----------------------------+----------------------------------------+
| eventhandler_id | event_name                 | handler_class                          |
+-----------------+----------------------------+----------------------------------------+
|              35 | vtiger.entity.beforedelete | VTDeleteEventHandler                   |
+-----------------+----------------------------+----------------------------------------+
```

### 3. Test Execution

1. **Restart Apache** để load handler vào memory
2. **Check initial count**: Organization "THPT Cây Dương" có `cf_1260 = 1968`
3. **Create Contact**: Link contact to this organization
   - Expected: `cf_1260 = 1969` (workflow "Cộng 1" executes)
4. **Delete Contact**: Delete the contact just created
   - Expected: `cf_1260 = 1968` (workflow "Trừ 1" executes)

### 4. Debug với Logs

Check Apache error log:

```bash
tail -f C:\xampp\apache\logs\error.log | grep VTDelete
```

**Expected Log Output**:

```
VTDeleteEventHandler: handleEvent called for event: vtiger.entity.beforedelete
VTDeleteEventHandler: Entity ID: 12345
VTDeleteEventHandler: Module: Contacts
VTDeleteEventHandler: Found 2 workflows for module
VTDeleteEventHandler: Checking workflow ID: 27, execution_condition: 1
VTDeleteEventHandler: Checking workflow ID: 29, execution_condition: 5
VTDeleteEventHandler: Found ON_DELETE workflow: Trừ 1
VTDeleteEventHandler: Conditions met, executing tasks...
VTDeleteEventHandler: Tasks executed
VTDeleteEventHandler: handleEvent completed
```

---

## Kiến Trúc và Flow

### Event Flow Diagram

```
User Action: Delete Contact
         |
         v
[CRMEntity::trash()]
         |
         v
Create EntityData object
         |
         v
Trigger: vtiger.entity.beforedelete  ← Handler listens here
         |
         v
[VTEventsManager]
         |
         v
[VTDeleteEventHandler::handleEvent()]
         |
         ├─> Load Entity Cache
         ├─> Get Webservice ID
         ├─> Get All Workflows for Module
         ├─> Filter ON_DELETE Workflows
         |       |
         |       v
         |   Evaluate Conditions
         |       |
         |       v
         |   Execute Tasks
         |       |
         |       v
         |   Update Related Fields
         |
         v
Return to trash()
         |
         v
mark_deleted() - Set deleted=1
         |
         v
Trigger: vtiger.entity.afterdelete
         |
         v
Complete
```

### Class Relationships

```
VTEventHandler (Abstract Base Class)
         ^
         |
         | extends
         |
VTDeleteEventHandler
         |
         | uses
         |
         ├─> VTWorkflowUtils (Admin user context)
         ├─> VTEntityCache (Field values)
         ├─> VTWorkflowManager (Get workflows)
         └─> Workflow::evaluate() & performTasks()
```

### Database Schema

```
Table: com_vtiger_workflows
+---------------------+--------------+
| Field               | Description  |
+---------------------+--------------+
| workflow_id         | PK           |
| workflowname        | "Trừ 1"      |
| module_name         | "Contacts"   |
| execution_condition | 5 (ON_DELETE)|
| status              | 1 (Active)   |
+---------------------+--------------+

Table: com_vtiger_workflowtasks
+-------------+--------------------------------+
| Field       | Description                    |
+-------------+--------------------------------+
| task_id     | PK                             |
| workflow_id | FK to com_vtiger_workflows     |
| task        | Serialized task object         |
| summary     | "Update field cf_1260 (-1)"    |
+-------------+--------------------------------+

Table: vtiger_eventhandlers
+-----------------+-----------------------------+
| Field           | Description                 |
+-----------------+-----------------------------+
| eventhandler_id | PK                          |
| event_name      | vtiger.entity.beforedelete  |
| handler_path    | Path to .inc file           |
| handler_class   | VTDeleteEventHandler        |
| is_active       | 1 (Active)                  |
+-----------------+-----------------------------+
```

---

## Những Điều Cần Lưu Ý

### 1. **beforedelete vs afterdelete**

✅ **SỬ DỤNG**: `vtiger.entity.beforedelete`

- Entity data vẫn còn trong database
- Có thể evaluate workflow conditions
- Có thể access field values và related records
- Tasks có thể update related records

❌ **KHÔNG SỬ DỤNG**: `vtiger.entity.afterdelete`

- Entity đã bị mark deleted
- Không thể load field values
- VTEntityCache::forId() fails
- Workflow evaluation fails

### 2. **Workflow Evaluation Context**

Handler chạy với admin user context:

```php
$user = $util->adminUser();
```

Điều này có nghĩa:

- Workflows bỏ qua permission checks
- Có thể access tất cả records
- Cần cẩn thận với security implications

### 3. **Task Execution**

Workflow tasks được execute với entity data:

```php
$workflow->performTasks($entityData);
```

Task types có thể bao gồm:

- Update Fields
- Create Todo
- Send Email
- Send Notification
- Invoke Custom Function

### 4. **Cache và Memory**

Sau khi modify handler code hoặc register handler:

- **PHẢI restart Apache** để load handler mới
- Clear PHP opcode cache nếu có (APC, OPcache)
- Clear Vtiger template cache: `cache/templates_c/`

### 5. **Debugging**

Khi workflow không hoạt động:

1. Check Apache error log cho error messages
2. Verify handler registered: `SELECT * FROM vtiger_eventhandlers`
3. Verify workflow active: `SELECT * FROM com_vtiger_workflows WHERE execution_condition=5`
4. Add debug logging trong handler
5. Check workflow conditions có match không

---

## Troubleshooting Common Issues

### Issue 1: Handler không được gọi

**Symptoms**: Không có log message trong error log khi delete record

**Solutions**:

1. Restart Apache
2. Verify handler registered:
   ```sql
   SELECT * FROM vtiger_eventhandlers WHERE handler_class = 'VTDeleteEventHandler';
   ```
3. Check event name là `beforedelete` không phải `afterdelete`
4. Clear cache: `rm -rf cache/templates_c/*`

### Issue 2: Syntax Error

**Symptoms**: PHP fatal error in logs

**Common Error**:

```php
// WRONG:
require_once 'include/Webservices/ModuleTypes.php');  // Extra )

// CORRECT:
require_once 'include/Webservices/ModuleTypes.php';
```

**Solution**: Check all require/include statements không có extra parentheses

### Issue 3: Workflow không execute

**Symptoms**: Handler được gọi nhưng tasks không chạy

**Debugging**:

```php
error_log("Workflow ID: " . $workflow->id);
error_log("Execution condition: " . $workflow->executionCondition);
error_log("Evaluation result: " . ($workflow->evaluate($entityCache, $entityData->getId()) ? 'TRUE' : 'FALSE'));
```

**Possible Causes**:

- Workflow conditions không match
- Workflow status = 0 (inactive)
- Module name không match
- execution_condition khác 5

### Issue 4: Entity data không load được

**Symptoms**: Error "Cannot load entity data"

**Solution**: Đảm bảo dùng `beforedelete` event:

```sql
UPDATE vtiger_eventhandlers
SET event_name = 'vtiger.entity.beforedelete'
WHERE handler_class = 'VTDeleteEventHandler';
```

---

## Files Changed Summary

### Core Files Modified

1. **modules/com_vtiger_workflow/VTWorkflowManager.inc**

   - Added: `static $ON_DELETE = 5;`

2. **modules/Settings/Workflows/models/Module.php**

   - Added: `'5' => 'ON_DELETE'` in triggerTypes array

3. **languages/en_us/Settings/Workflows.php**

   - Added: `'ON_DELETE' => 'When a record is deleted'`

4. **languages/en_us/Vtiger.php**

   - Added: `'LBL_DELETION' => 'deletion'`

5. **layouts/v7/modules/Settings/Workflows/WorkFlowTrigger.tpl**
   - Added: Radio button for ON_DELETE trigger

### New Files Created

6. **modules/com_vtiger_workflow/VTDeleteEventHandler.inc**

   - NEW: Event handler class for delete workflows

7. **register_delete_workflow_handler.php**

   - Helper: CLI script to register handler

8. **register_delete_handler_web.php**

   - Helper: Web interface for registration/verification

9. **database/check_workflows.sql**
   - Helper: SQL queries for verification

### Database Changes

10. **vtiger_eventhandlers table**
    - Inserted new row for VTDeleteEventHandler
    - Event: `vtiger.entity.beforedelete`

---

## Kết Luận

Implementation của ON_DELETE workflow trigger là một feature hoàn chỉnh với:

✅ **Backend Logic**: VTDeleteEventHandler để xử lý delete events
✅ **Database Integration**: Event handler registration
✅ **UI Components**: Radio button trong workflow creation form
✅ **Localization**: Language keys cho EN
✅ **Debugging Tools**: Logging và helper scripts
✅ **Documentation**: Chi tiết implementation process

**Key Learnings**:

1. **beforedelete vs afterdelete**: Entity data availability là critical
2. **Event-driven Architecture**: Vtiger sử dụng VTEventsManager
3. **Workflow Engine**: VTWorkflowManager quản lý workflow execution
4. **Admin Context**: Workflows chạy với admin privileges
5. **Cache Management**: Restart Apache sau khi change handlers

**Next Steps**:

- Test với nhiều modules khác nhau (Accounts, Leads, etc.)
- Add language support cho các languages khác (vi_vn, etc.)
- Consider adding ON_RESTORE trigger cho restore functionality
- Document performance implications với large datasets

---

## References

- Vtiger CRM Documentation: https://wiki.vtiger.com/
- Event Handlers: `include/events/VTEventsManager.inc`
- Workflow Engine: `modules/com_vtiger_workflow/`
- Entity Data: `include/events/VTEntityData.inc`

---

**Author**: Implementation Team  
**Date**: November 3, 2025  
**Version**: 1.0  
**Vtiger Version**: 7.x
