# Walkthrough: Duplicate Prevention – Thay đổi giới hạn số field

**Date:** 2026-02-25  
**Scope:** `layouts/v7/modules/Settings/LayoutEditor/resources/LayoutEditor.js`, `layouts/v7/modules/Settings/LayoutEditor/DuplicateHandling.tpl`

---

## Vấn đề

Tính năng **Duplicate Prevention** trong `Settings > Module Layouts & Fields > Duplicate Prevention` mặc định chỉ cho phép chọn tối đa **3 fields** để kiểm tra trùng lặp.

---

## Vị trí cần chỉnh sửa

### 1. Giới hạn chọn field (chức năng chính)

📄 [`LayoutEditor.js`](file:///c:/xampp/htdocs/cusc/layouts/v7/modules/Settings/LayoutEditor/resources/LayoutEditor.js) — **Dòng 2177**

```javascript
// TRƯỚC
vtUtils.showSelect2ElementView(form.find("select").addClass("select2"), {
  maximumSelectionSize: 3,
});

// SAU (ví dụ đổi thành 5)
vtUtils.showSelect2ElementView(form.find("select").addClass("select2"), {
  maximumSelectionSize: 5,
});
```

> ⚠️ Đây là giới hạn duy nhất có hiệu lực. Phía server (`updateDuplicateHandling()`) **không có giới hạn** – nhận bao nhiêu field cũng được.

---

### 2. Label text "Max 3 Fields" (chỉ là hiển thị)

📄 [`DuplicateHandling.tpl`](file:///c:/xampp/htdocs/cusc/layouts/v7/modules/Settings/LayoutEditor/DuplicateHandling.tpl) — **Dòng 52**

```smarty
{vtranslate('LBL_MAX_3_FIELDS', $QUALIFIED_MODULE)}
```

Tìm key `LBL_MAX_3_FIELDS` trong file ngôn ngữ của module `Settings::LayoutEditor` và sửa text cho khớp với số mới.

---

## Tóm tắt

| Bước         | File                    | Dòng | Thay đổi                           |
| ------------ | ----------------------- | ---- | ---------------------------------- |
| 1 (bắt buộc) | `LayoutEditor.js`       | 2177 | `maximumSelectionSize: 3` → số mới |
| 2 (tuỳ chọn) | `DuplicateHandling.tpl` | 52   | Cập nhật label text hiển thị       |
