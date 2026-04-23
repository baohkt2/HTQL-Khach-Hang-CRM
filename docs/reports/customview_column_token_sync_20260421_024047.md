# CustomView Column Token Sync Report

## Metadata

| Key | Value |
|---|---|
| generated_at | 2026-04-21 02:40:47 |
| database | cusc_db |
| operation | sync stale custom-view column tokens after custom-field column rename |
| backup_cvcolumnlist | bak_cvcolumnlist_coltoken_sync_20260421_024047 |
| backup_cvadvfilter | bak_cvadvfilter_coltoken_sync_20260421_024047 |

## Updated Rows

| Table | Updated Rows |
|---|---:|
| vtiger_cvcolumnlist | 478 |
| vtiger_cvadvfilter | 77 |

## Scope by Module

### vtiger_cvcolumnlist

| Module | Updated Rows | Affected Lists |
|---|---:|---:|
| Accounts | 18 | 4 |
| Contacts | 452 | 62 |
| Leads | 8 | 1 |

### vtiger_cvadvfilter

| Module | Updated Rows | Affected Lists |
|---|---:|---:|
| Accounts | 1 | 1 |
| Contacts | 76 | 51 |

## Verification

| Check | Result |
|---|---:|
| remaining mismatch in vtiger_cvcolumnlist | 0 |
| remaining mismatch in vtiger_cvadvfilter | 0 |

## Sample Validation (User report)

| List | cvid | Status |
|---|---:|---|
| 63.AN THẠNH 3 (CTV_ĐP Trang) | 102 | all 11 selected columns now map to current metadata (OK) |

## Notes

- Token sync rule: keep table/field token/label/type and replace only column token with current `vtiger_field.columnname` resolved by module + field token.
- Rollback can be done by restoring rows from the 2 backup tables listed above.
