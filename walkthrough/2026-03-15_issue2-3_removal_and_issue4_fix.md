# CUSC vTiger - Remove Plan/AdvancedReport and Fix Organization Name Suffix

- Date: 2026-03-15
- Context: User accepted Issue 1, requested removing Issue 2 + 3 modules, and removing organization-name suffix format like `THPT ... [157]`.

## 1) Scope Executed

### Kept (Issue 1)
- Kept student counter implementation:
  - `modules/Accounts/handlers/AccountStudentCountHandler.php`
  - `migrate/20260315_issue1_student_count_setup.php`

### Removed (Issue 2 and 3)
- Removed Plan module code:
  - `modules/Plan/`
  - `languages/en_us/Plan.php`
  - `languages/vi_vn/Plan.php`
  - `migrate/20260315_issue2_plan_module_setup.php`
- Removed AdvancedReport module code:
  - `modules/AdvancedReport/`
  - `layouts/v7/modules/AdvancedReport/`
  - `languages/en_us/AdvancedReport.php`
  - `languages/vi_vn/AdvancedReport.php`

## 2) Metadata / DB Cleanup (without DROP)

Executed metadata cleanup in `cusc_db`:
- Disabled tabs:
  - `vtiger_tab.name IN ('Plan','AdvancedReport')` set `presence = 1`
- Removed menu/link wiring:
  - deleted `vtiger_parenttabrel` rows for those tabids
  - deleted `vtiger_links` rows for URLs containing `module=Plan` or `module=AdvancedReport`
- Removed Plan runtime hooks:
  - deleted `vtiger_eventhandlers` rows for `PlanFollowupHandler`
- Removed Plan webservice entity registration:
  - deleted `vtiger_ws_entity` row where `name = 'Plan'`
- Removed `AdvancedReport` from `tabdata.php` cache mappings.

## 3) Issue 4 Fix - Remove "[count]" from Organization Name

Located offending feature in Accounts list view customization that appended contact count into name text.

Removed:
- Name mutation JavaScript in:
  - `layouts/v7/modules/Accounts/resources/List.js`
- Count payload injection in list template:
  - `layouts/v7/modules/Accounts/ListViewContents.tpl`
- Extra listview count enrichment method:
  - `modules/Accounts/models/ListView.php` (`getListViewEntries` override removed)

Result:
- Organization names are displayed normally again (no bracket suffix like `[157]`).

## 4) Validation

- Syntax check:
  - `php -l modules/Accounts/models/ListView.php` => OK
  - `php -l migrate/20260315_issue1_student_count_setup.php` => OK
- Issue 1 smoke test rerun:
  - create/move contact between accounts => counts update correctly
- DB verification:
  - `Plan` and `AdvancedReport` are disabled (`presence=1`)
  - `PlanFollowupHandler` rows = 0
  - module links for Plan/AdvancedReport = 0
- Search verification:
  - no remaining `accountsContactsCount` / `appendContactsCount` code paths.
