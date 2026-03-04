# Inline Validation for Custom Fields - Walkthrough

## Overview

Added validation hooks for **Age limit** (Date field) and **Phone length limit + Vietnamese Prefix** (Phone field) into VtigerCRM's **Inline Edit** (Details tab/Quick Edit) mode. The functionality ensures that validation logic doesn't only apply to the main `Edit/Create` view, but also correctly triggers when users edit individual fields via ajax.

---

## Changes Made

| File                                            | Change                                                                                                                                                                                                     |
| ----------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `modules/Vtiger/models/Field.php`               | Modified `getFieldInfo()` to inject `typeofdata` into the field's metadata array. This exposes the limits configured by the admin (e.g. `V~O~PHONE~10` or `D~O~AGE~18`) to the Javascript layer properly.  |
| `layouts/v7/modules/Vtiger/resources/Field.js`  | Added `Vtiger_Phone_Field_Js` class to ensure `Phone` fields generated dynamically during Inline Edit are assigned the `phoneField` class.                                                                 |
| `layouts/v7/modules/Vtiger/resources/Detail.js` | Injected logic into the `PreAjaxSaveEvent` hook via `registerBasicEvents()`. Added three new validation methods: `registerPhoneFieldFilter()`, `registerPhoneValidation()`, and `registerAgeValidation()`. |

---

## Technical Details

### 1. Passing Field Information to Frontend

During an inline edit, the field's UI is dynamically generated via ajax. Vtiger passes field metadata using a JSON string inside a `data-fieldinfo` attribute on the input tags.

In `Field.php`, the method `getFieldInfo()` now extracts `typeofdata` directly from the database schema configuration and assigns it so it gets JSON-encoded down to the client.

### 2. Identifying Phone Fields

By default, Vtiger doesn't assign a `phoneField` HTML class to phone input boxes generated during inline editing. The new `Vtiger_Phone_Field_Js` overrides the default text field behavior so that it explicitly adds `phoneField`, allowing our Javascript selectors `input.phoneField` to find it.

### 3. Intercepting the Ajax Save Event

`Detail.js` fires a custom event called `PreAjaxSaveEvent` right before the field's value is submitted to the server.

Our new functions (`registerPhoneValidation` and `registerAgeValidation`) listen to this exact event:

- Checks if the triggered field is a `phoneField` or `dateField`.
- Parses the newly injected `typeofdata` from `data-fieldinfo` to find the limit.
- Evaluates the limits (Phone: length and VN prefixes; Date: Age).
- If validation fails, it displays a red error notification (`app.helper.showErrorNotification()`), focuses on the input with a red border (`.addClass('error')`), and calls `e.preventDefault()` to stop the save request.

## Testing the Changes

1. Open any Contact or Lead, and switch to the **Details** tab.
2. Hover over a customized Date field (with Age limit >= 18) and click the pencil icon to edit.
3. Choose a birth year that is less than 18 years old and click the **Checkmark (✔)** to save. You should see a validation error stopping the save.
4. Hover over a customized Phone field (with a Length limit) and click the pencil icon.
5. Enter a phone number that has an invalid prefix (e.g., `011...`) or doesn't meet the length requirement. Click the **Checkmark (✔)** to save. You should see a validation error stopping the save.
