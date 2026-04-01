# Contacts Multi-Owner Model

## Overview
Contacts now supports 4 owner roles:

- `assigned_user_id`: CTV owner (`CTV phu trach`)
- `assigned_to_2`: Can Bo owner (`Can Bo phu trach`)
- `assigned_to_zalo`: Zalo owner
- `assigned_to_facebook`: Facebook owner

The 3 non-primary owner roles are optional and can be left blank.

## Label Changes (Contacts)

- `Assigned To` -> `CTV phu trach`
- `LBL_ASSIGNED_TO_2` -> `Can Bo phu trach`
- Added `LBL_ASSIGNED_TO_ZALO`
- Added `LBL_ASSIGNED_TO_FACEBOOK`

Mass actions in Contacts list view:

- Transfer CTV owner
- Transfer Can Bo owner
- Transfer Zalo owner
- Transfer Facebook owner

## Permission Behavior

For Contacts records, users are treated as owners if they are in any of these roles:

- Primary owner (`smownerid`)
- Secondary owner (`assigned_to_2`)
- Zalo owner (`assigned_to_zalo`)
- Facebook owner (`assigned_to_facebook`)

This applies to:

- Non-admin list visibility filtering
- Record operation checks (`isPermitted`) for Contacts

## Deployment Steps

1. Deploy code changes.
2. Run migration to create missing owner fields:

```bash
php migrate/20260403_contacts_social_assignees_setup.php
```

3. Clear cache if needed:

```bash
./clear_cache.sh
```

4. Verify in Contacts:

- Both new owner fields are visible and optional.
- 4 transfer mass actions are visible.
- A user assigned in any owner role can open and edit the record.

## Updated Files

- `modules/Contacts/models/ListView.php`
- `modules/Vtiger/views/MassActionAjax.php`
- `modules/Contacts/actions/TransferOwnership.php`
- `data/CRMEntity.php`
- `include/utils/UserInfoUtil.php`
- `layouts/v7/modules/Vtiger/uitypes/Owner.tpl`
- `languages/vi_vn/Contacts.php`
- `languages/en_us/Contacts.php`
- `migrate/20260403_contacts_social_assignees_setup.php`
