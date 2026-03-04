# Fix: Share Task Info Not Showing in List History

**Date**: 2026-03-02

## Problem

Khi user tạo/cập nhật list filter có tick "Share the list" và phân công task cho members, phần **List History** không hiển thị thông tin phân công (user nào nhận task nào).

## Root Cause

Template `EditView.tpl` dùng Smarty modifier `|json_decode:true` để giải mã JSON details — nhưng `json_decode` không phải Smarty built-in modifier, nên khi Smarty security policy không cho phép, `$DETAIL_DATA` luôn null → khối share task info bị ẩn.

## Changes Made

### 1. Backend — `modules/CustomView/models/Record.php`

- `getHistory()` decode JSON `details` trong PHP, trả về thêm key `details_data` (mảng đã decode)

### 2. Template — `layouts/v7/modules/CustomView/EditView.tpl`

- Sử dụng `$HISTORY_ENTRY.details_data` thay vì `$HISTORY_ENTRY.details|json_decode:true`
- Hardcoded text → `{vtranslate('LBL_SHARE_TASK_ASSIGNMENT', $MODULE)}`

### 3. Language Labels

- `languages/vi_vn/Vtiger.php`: `LBL_SHARE_TASK_ASSIGNMENT` → `'Phân công công việc:'`
- `languages/en_us/Vtiger.php`: `LBL_SHARE_TASK_ASSIGNMENT` → `'Task Assignment:'`

## Verification

1. Tạo list filter mới → tick "Share the list" → phân công task → Save
2. Edit lại → List History hiện khối "Phân công công việc" với user nào nhận task nào
3. History entry cũ vẫn hiển thị bình thường
