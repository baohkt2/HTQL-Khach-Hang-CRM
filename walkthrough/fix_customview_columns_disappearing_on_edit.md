# Fix: Custom View Columns Disappearing on Edit

**Date**: 2026-02-25

## Problem

Khi edit một list filter đã tạo, phần "Choose columns and order" hiển thị trống — các columns đã chọn trước đó bị biến mất.

## Root Cause

`getSelectedFields()` trong `modules/CustomView/models/Record.php` (line 547-568) trả về **mảng associative**:

```php
$selectedFields[$columnIndex] = array(
    'columnname' => decode_html($columnName),
    'is_fixed' => $isFixed
);
```

Nhưng `EditView.tpl` dùng `in_array(string, $SELECTED_FIELDS)` — so sánh string với mảng con → **luôn trả false** → không column nào được đánh dấu `selected`.

## Fix Applied

**File**: `layouts/v7/modules/CustomView/EditView.tpl`

1. Thêm vòng lặp trích xuất mảng phẳng `$SELECTED_FIELD_NAMES` từ `$SELECTED_FIELDS`:

```smarty
{assign var=SELECTED_FIELD_NAMES value=array()}
{foreach from=$SELECTED_FIELDS item=FIELD_INFO}
    {append var='SELECTED_FIELD_NAMES' value=$FIELD_INFO.columnname}
{/foreach}
```

2. Sửa 2 chỗ `in_array()` (line 74 và 99) dùng `$SELECTED_FIELD_NAMES` thay vì `$SELECTED_FIELDS`:

```diff
-{if in_array(decode_html($FIELD_MODEL->getCustomViewColumnName()), $SELECTED_FIELDS)}
+{if in_array(decode_html($FIELD_MODEL->getCustomViewColumnName()), $SELECTED_FIELD_NAMES)}
```

3. Sửa hidden input `columnslist` (line 110) truyền `$SELECTED_FIELD_NAMES` cho JavaScript:

```diff
-<input type="hidden" name="columnslist" value='{Vtiger_Functions::jsonEncode($SELECTED_FIELDS)}' />
+<input type="hidden" name="columnslist" value='{Vtiger_Functions::jsonEncode($SELECTED_FIELD_NAMES)}' />
```

## Verification

1. Vào module bất kỳ → Tạo list filter mới với vài columns → Save
2. Edit filter vừa tạo → Columns đã chọn hiển thị đúng trong "Choose columns and order"
3. Save lại → List view vẫn hoạt động bình thường
