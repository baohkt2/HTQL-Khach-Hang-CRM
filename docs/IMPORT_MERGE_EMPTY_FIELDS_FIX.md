# Import Merge Empty Fields Fix

## Context

Issue observed on Contacts import with `merge_type = Merge (3)`:

- User imported a row with follow-up fields 1-10 filled.
- User imported again (merge) with only follow-up 1-6 filled and 7-10 left blank.
- Existing data in follow-up 7-10 was overwritten/cleared.

A concrete case was verified on record `Contacts#149073`.

## Root Cause

Two factors contributed:

1. Import merge considered some empty-like values as valid update values.
   - Hidden whitespace / non-breaking spaces can pass simple empty checks.
   - String `"0"` can be interpreted as a value for non-numeric business fields.

2. Active workflows on Contacts then cascaded additional clear actions.
   - Workflows `142-145` are configured with `is empty` conditions on follow-up statuses (`cf_1852`, `cf_1862`, `cf_1872`, `cf_1882`), and clear related operator/date fields.

## Code Changes

File changed: `modules/Import/actions/Data.php`

### 1) Stronger empty-value detection

- Added `shouldTreatAsEmptyImportValue($fieldName, $value, $moduleFields)`.
- Treats hidden whitespace chars as empty:
  - NBSP (`\xC2\xA0`)
  - zero-width space (`\xE2\x80\x8B`)
  - BOM (`\xEF\xBB\xBF`)
- Treats string `"0"` as empty for non-numeric datatypes (string/text/picklist/date/reference/owner...), while preserving numeric semantics.

### 2) Merge overwrite safety

- In overwrite flow, mapped empty-like fields are now restored from existing record values instead of being pushed as blank.

### 3) Merge-fields safety

- In merge-fields flow, only non-empty-like imported values are included in update payload.

### 4) Import history support (previous patch in same file)

- Import-specific ModTracker entries were added to capture create/update/merge changes by field, even in bulk import mode.

## Operational Notes

- This fix protects against sparse import files accidentally clearing existing data.
- If users intentionally need to clear a field, use inline edit/mass edit instead of blank import cells.

## Validation Checklist

1. Import a Contacts row with follow-up 1-10 populated.
2. Re-import same row with merge and only follow-up 1-6 values.
3. Confirm follow-up 7-10 values remain unchanged.
4. Confirm ModTracker history records updated fields and actor.
5. Confirm no PHP syntax errors:
   - `php -l modules/Import/actions/Data.php`

## Related Workflows (Contacts)

- `142`: condition on `cf_1852 is empty`
- `143`: condition on `cf_1862 is empty`
- `144`: condition on `cf_1872 is empty`
- `145`: condition on `cf_1882 is empty`

These workflows can still clear related fields if statuses are truly empty by business logic.
