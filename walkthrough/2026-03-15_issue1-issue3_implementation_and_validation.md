# CUSC vTiger - Issue 1/2/3 Implementation & Validation

- Date: 2026-03-15
- Environment: Linux server, MySQL 8.0.45, workspace `/var/www/html/cusc`
- Scope:
  - Issue 1: Auto-sync student count from Contacts to Accounts (`cf_2090`)
  - Issue 2: Plan module + follow-up history tracking
  - Issue 3: AdvancedReport enhancement for Plan reports and advanced query features

## 1) Key Implementations

### 1.1 Issue 1 - Student count auto-sync

Added handler:
- `modules/Accounts/handlers/AccountStudentCountHandler.php`

Behavior:
- Handle `vtiger.entity.aftersave` for Contacts:
  - New Contact with `account_id` => recalc target Account count
  - Contact moved between Accounts => recalc old + new Account counts
- Handle `vtiger.entity.afterdelete` and `vtiger.entity.afterrestore`:
  - Recalc linked Account count
- Persist result to `vtiger_accountscf.cf_2090`

Migration/setup:
- `migrate/20260315_issue1_student_count_setup.php`

Setup responsibilities:
- Ensure field exists/visible (`presence = 0`, `displaytype = 1`)
- Register handler for 3 events
- Backfill all existing account counts
- Idempotent event registration with fallback direct insert if `VTEventsManager->registerHandler` does not create expected row

### 1.2 Issue 2 - Plan module and follow-up tracking

Added module entity:
- `modules/Plan/Plan.php`

Added handler:
- `modules/Plan/handlers/PlanFollowupHandler.php`

Behavior:
- Listen on Calendar/Events/Emails lifecycle events
- Success policy:
  - Call is successful when `status = Completed`
  - Email is successful when `status = Completed` (approved policy B)
- Maintain `vtiger_plan_followup_history` via upsert/update for:
  - success/unsuccess transitions
  - active/inactive transitions on delete/restore
  - follow-up sequence (`followup_no`)

Migration/setup:
- `migrate/20260315_issue2_plan_module_setup.php`

Setup responsibilities:
- Create Plan module with key fields (`planname`, `plan_no`, `plan_status`, dates, email policy)
- Create Plan relations with Contacts and Accounts
- Ensure `vtiger_plan_followup_history` table exists
- Register handler for 3 events with same idempotent fallback strategy

### 1.3 Issue 3 - AdvancedReport upgrades

Updated backend:
- `modules/AdvancedReport/models/QueryBuilder.php`
  - Added nested `filter_groups` / `having_groups` (AND/OR recursive tree)
  - Added operators: `CONTAINS`, `STARTS WITH`, `ENDS WITH`
  - Added calculation expressions in selected fields
  - Added `PERCENTAGE` aggregate
  - Added Plan module table mapping
- `modules/AdvancedReport/models/ReportEngine.php`
  - Added report types:
    - `plan_success_overview`
    - `plan_user_breakdown`
    - `plan_followup_levels`
  - Added plan-specific filters (`plan_id`, `owner_id`, date range)
  - Added Plan table readiness assertion
- `modules/AdvancedReport/actions/Generate.php`
- `modules/AdvancedReport/actions/Export.php`
  - Support request/config overrides for `plan_id`, `owner_id`

Updated UI:
- `modules/AdvancedReport/views/List.php`
  - Load plans and active users for filters
- `layouts/v7/modules/AdvancedReport/List.tpl`
  - Added Plan report options and Plan/User filters
- `layouts/v7/modules/AdvancedReport/resources/AdvancedReport.js`
  - Added Plan report toggles and serialization/deserialization for new filters
- Language labels:
  - `languages/en_us/AdvancedReport.php`
  - `languages/vi_vn/AdvancedReport.php`
  - `languages/en_us/Plan.php`
  - `languages/vi_vn/Plan.php`

## 2) Execution Steps Performed

1. Ran setup scripts:
   - `php migrate/20260315_issue1_student_count_setup.php`
   - `php migrate/20260315_issue2_plan_module_setup.php`
2. Verified event registrations in DB and fixed missing registrations.
3. Hardened both setup scripts so reruns reliably ensure all required event rows.
4. Re-ran setup scripts to verify idempotency.

## 3) Validation Results

### 3.1 Syntax checks

- `php -l migrate/20260315_issue1_student_count_setup.php` => OK
- `php -l migrate/20260315_issue2_plan_module_setup.php` => OK

### 3.2 Event registration validation

Confirmed active rows for both handlers:
- `AccountStudentCountHandler`:
  - `vtiger.entity.aftersave`
  - `vtiger.entity.afterdelete`
  - `vtiger.entity.afterrestore`
- `PlanFollowupHandler`:
  - `vtiger.entity.aftersave`
  - `vtiger.entity.afterdelete`
  - `vtiger.entity.afterrestore`

### 3.3 Issue 1 functional smoke tests

Test A - aftersave create + move:
- Created Account A1/A2 + Contact linked to A1
- Verified counts:
  - A1: `0 -> 1` after create
  - A1: `1 -> 0` and A2: `0 -> 1` after moving Contact to A2

Test B - afterdelete + afterrestore:
- Created Account + Contact linked to Account
- Verified counts:
  - `1 -> 0` after delete
  - `0 -> 1` after restore

### 3.4 Issue 2 handler smoke test

Direct lifecycle simulation using controlled `vtiger_activity` data and `VTEntityData`:
- aftersave with Completed Call => history row created (`is_success=1`, `is_active=1`)
- aftersave with Planned status => same row updated (`is_success=0`)
- afterdelete => row updated (`is_active=0`)
- afterrestore with Completed status => row updated back (`is_success=1`, `is_active=1`)

### 3.5 Issue 3 report smoke tests

Runtime checks:
- `plan_success_overview` => executes successfully
- `plan_user_breakdown` => executes successfully
- `plan_followup_levels` => executes successfully

Data-backed checks with test Plan:
- `plan_success_overview`: returned expected totals and `100.00%` success for the test target
- `plan_user_breakdown`: returned owner-level row with successful call count
- `plan_followup_levels`: returned level distribution with `followup_1_count = 1`

## 4) Notes

- No `DROP` operations were executed.
- Setup scripts are now safer for rerun on existing environments due to registration fallback logic.
- Unrelated working-tree log changes were left untouched as instructed.
