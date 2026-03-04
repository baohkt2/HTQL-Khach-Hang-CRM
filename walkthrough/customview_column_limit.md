# Walkthrough: Modifying Custom View Column Limit

This walkthrough documents the process of increasing the maximum number of columns allowed when creating a "List" (Custom View) in VtigerCRM from the default 15 to 50.

## 1. Changing the JavaScript Limit

The client-side validation for the Select2 dropdown that enforces the maximum number of selectable columns was updated.

**File:** [CustomView.js](file:///c:/xampp/htdocs/cusc/layouts/v7/modules/CustomView/resources/CustomView.js)
**Change:** Updated `maximumSelectionSize` from 15 to 50 within the `registerSelect2ElementForColumnsSelection` function.

```diff
     registerSelect2ElementForColumnsSelection: function () {
       var selectElement = this.getColumnSelectElement();
       vtUtils.showSelect2ElementView(selectElement, {
-        maximumSelectionSize: 15,
+        maximumSelectionSize: 50,
       });
     },
```

## 2. Updating the Language Translation Label

The UI text label that indicates the limit to the user was updated to reflect the new limit.

**File:** [en_us/Vtiger.php](file:///c:/xampp/htdocs/cusc/languages/en_us/Vtiger.php)
**Change:** Modified the value of `LBL_MAX_NUMBER_FILTER_COLUMNS`.

```diff
 	'LBL_CREATE_VIEW' => 'Creating new view',
 	'LBL_BASIC_DETAILS' => 'Basic details',
 	'LBL_CHOOSE_COLUMNS' => 'Choose columns and order',
-	'LBL_MAX_NUMBER_FILTER_COLUMNS' => 'Max 15',
+	'LBL_MAX_NUMBER_FILTER_COLUMNS' => 'Max 50',
 	'LBL_FILTER_ON_DATE' => 'List on date',
```

> [!NOTE]
> If the system uses other languages (like Vietnamese), equivalent language files (e.g., `languages/vi_vn/Vtiger.php`) should also be updated.

> [!TIP]
> After saving these changes, users may need to **clear their browser cache (Ctrl + F5)** so that the updated `CustomView.js` file is loaded by the browser instead of the old cached version.
