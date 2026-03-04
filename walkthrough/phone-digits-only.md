# Walkthrough: Phone Field – Digits-Only Input

**Date:** 2026-02-25  
**Scope:** `layouts/v7/modules/Vtiger/uitypes/Phone.tpl`, `layouts/vlayout/modules/Vtiger/uitypes/Phone.tpl`, `layouts/v7/modules/Vtiger/resources/Edit.js`

---

## Mục tiêu

Trường `phone` (datatype) chỉ cho phép nhập **số** (0–9).  
Ký tự chữ bị chặn ngay khi nhập hoặc paste.  
Số **0 ở đầu** được giữ nguyên (hỗ trợ số Việt Nam như `0901234567`).

---

## Thay đổi

### 1. `layouts/v7/modules/Vtiger/uitypes/Phone.tpl`

```diff
-<input ... type="text" class="inputElement" name="{$FIELD_NAME}"
+<input ... type="text" class="inputElement phoneField" name="{$FIELD_NAME}" data-type="phone"
```

### 2. `layouts/vlayout/modules/Vtiger/uitypes/Phone.tpl`

```diff
-<input ... type="text" class="input-large" ...
+<input ... type="text" class="input-large phoneField" data-type="phone" ...
```

### 3. `layouts/v7/modules/Vtiger/resources/Edit.js`

Thêm hàm `registerPhoneFieldFilter()` và gọi từ `registerBasicEvents()`:

```javascript
registerPhoneFieldFilter: function (form) {
    form.on("input", ".phoneField", function () {
        var input = jQuery(this);
        var val = input.val();
        // Chỉ giữ số 0-9, bảo toàn số 0 đầu số điện thoại VN
        var filtered = val.replace(/[^0-9]/g, "");
        if (val !== filtered) {
            input.val(filtered);
        }
    });
},
```

> Dùng sự kiện `input` thay vì `keypress` để bắt cả paste (Ctrl+V) và drag-drop.  
> Không dùng `type="number"` vì browser sẽ tự loại bỏ số 0 ở đầu.

---

## Kiểm tra

| Hành động          | Kết quả mong đợi           |
| ------------------ | -------------------------- |
| Gõ `abc`           | Không xuất hiện            |
| Gõ `0901234567`    | Hiển thị đúng `0901234567` |
| Paste `abc123`     | Chỉ còn `123`              |
| Paste `0909abc456` | Chỉ còn `0909456`          |
| Lưu `0909123456`   | DB giữ nguyên số 0 đầu     |

---

## Lưu ý

Cần **xóa Smarty cache** sau khi deploy để thấy thay đổi template:  
`Admin → CRM Settings → Clear Cache`
