# Quick Filter Hotfix: Pull, Setup, and Test Guide

## Scope
This hotfix ensures single-list edit does not wipe existing quick filters when users do not enable "Sửa lọc nhanh".

## Files Changed
- modules/CustomView/actions/Save.php
- layouts/v7/modules/Vtiger/partials/SidebarEssentials.tpl
- layouts/v7/modules/Vtiger/resources/ListSidebar.js

## Pull and Deploy
1. SSH to server and go to project root.
2. Pull latest code from the target branch.

```bash
cd /var/www/html/cusc
git pull
```

3. Ensure PHP file has valid syntax.

```bash
php -l modules/CustomView/actions/Save.php
```

4. Clear application cache if needed.

```bash
rm -rf cache/templates_c/*
rm -rf cache/runtime/*
rm -rf test/templates_c/*
```

Note: on this server, `test/templates_c` is the active compiled-template cache path.

If your server uses PHP OPcache aggressively, reload PHP-FPM or Apache after deploy.

## Functional Smoke Test
Prepare one list that already has quick filters in group 3/4.

1. Open list edit popup.
2. Do not check "Sửa lọc nhanh".
3. Change a normal field (example: list name or share settings) and save.
4. Re-open list edit and inspect quick filter section.
5. Expected result: quick filter conditions remain unchanged.

## Regression Test
1. Check "Sửa lọc nhanh", edit quick filter condition, save.
2. Expected result: quick filter updates correctly.
3. Use "Xóa lọc nhanh" flow and confirm quick filter is cleared.

## Quick Edit Select-All Test
1. In sidebar, click "Sửa nhanh".
2. Click "Chọn tất cả".
3. Expected result: all editable lists are checked, button text changes to "Bỏ chọn tất cả", and action buttons show selected count.
4. Click "Bỏ chọn tất cả".
5. Expected result: all checked lists are unchecked, button text returns to "Chọn tất cả", and action buttons are disabled.

## Optional DB Verification
Replace `<CVID>` with the list ID.

```sql
SELECT groupid, columnindex, columnname, comparator, value
FROM vtiger_cvadvfilter
WHERE cvid = <CVID> AND groupid IN (3,4)
ORDER BY groupid, columnindex;
```

Validation rule:
- After save without "Sửa lọc nhanh", rows for group 3/4 must stay the same.
- After explicit clear action, rows for group 3/4 should be removed.
