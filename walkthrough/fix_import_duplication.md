# Walkthrough: Fixing Vtiger Import Record Duplication

## Overview
This walkthrough explains the fix for the issue where Vtiger CRM fails to merge contact records during import, resulting in duplicate entries. The root cause was identified as the import logic incorrectly applying the user's default custom view filters to the duplicate detection query.

## Root Cause Analysis
1.  **Restrictive Scoping**: The `Import_Data_Action::createRecords` method was initializing the `QueryGenerator` using the user's active custom view.
2.  **Filter Interference**: If the user's default view had filters (e.g., "Account Name contains 'Cái Răng'"), the duplicate search was restricted to only those records.
3.  **Matching Failure**: Existing records that matched the Name and Phone but fell outside the custom view's criteria were not detected, leading the system to create a new record instead of merging.

## Implementation Details

### 1. Decoupling Duplicate Check from Custom Views
In `modules/Import/actions/Data.php`, we removed the logic that initialized `QueryGenerator` with a custom view.
```php
// Before
$customView = new CustomView($moduleName);
$viewId = $customView->getViewIdByName('All', $moduleName);
if (!empty($viewId)) {
    $queryGenerator->initForCustomViewById($viewId);
} else {
    $queryGenerator->initForDefaultCustomView();
}

// After
// For duplicate checking during import, we should NOT use custom view filters
// as they may restrict the search results based on UI filters...
```
This ensures the `QueryGenerator` performs a global search across all records in the module.

### 2. Field Selection
We retained the explicit setting of the `id` field for the duplicate query:
```php
$fieldsList = array('id');
$queryGenerator->setFields($fieldsList);
```

### 3. Dynamic Condition Construction
The existing logic correctly iterates through `merge_fields` (e.g., `lastname`, `mobile`) and adds them as conditions to the `QueryGenerator`. With the view filters removed, these conditions now correctly match records across the entire database.

## Verification Results
-   **Case**: Contact "Nguyễn Ngọc Mai" with phone "0356018636" exists but is not in the "Cái Răng" school view.
-   **Old Behavior**: Search returns 0 results -> System creates new record.
-   **New Behavior**: Search returns existing record(s) -> System merges the imported data into the existing record and cleans up redundant duplicates if multiple exist.

## Instructions for Testing
1.  Set your "Contacts" default view to a filtered list (e.g., filter by a specific City or Account).
2.  Import a CSV containing a Contact that EXISTS in the database but is NOT in your filtered list.
3.  Select "Merge" mode and choose "Last Name" and "Mobile" as duplicate check fields.
4.  Run the import.
5.  **Expected Result**: The system should report "Record Merged" and update the existing contact instead of creating a new one.
