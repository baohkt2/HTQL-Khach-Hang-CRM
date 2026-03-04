# Custom View History Feature

**Date**: 2026-02-26

## Problem

Cần lưu lại lịch sử tương tác (tạo/cập nhật) trên List filter, tương tự như tab Updates trên record detail view.

## Changes Made

### 1. Database — `vtiger_cv_history`

```sql
CREATE TABLE vtiger_cv_history (
  id INT AUTO_INCREMENT PRIMARY KEY,
  cvid INT NOT NULL,
  userid INT NOT NULL,
  action_type VARCHAR(20) NOT NULL,  -- 'created' or 'updated'
  action_time DATETIME NOT NULL,
  details TEXT,                       -- JSON: viewname, columns_count
  FOREIGN KEY (cvid) REFERENCES vtiger_customview(cvid) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```

### 2. Backend — `modules/CustomView/models/Record.php`

- `logHistory($actionType, $details)` — ghi log vào `vtiger_cv_history`
- `getHistory()` — lấy lịch sử với user name, timestamp, action, details

### 3. Save Action — `modules/CustomView/actions/Save.php`

- Sau khi save, ghi `'created'` (filter mới) hoặc `'updated'` (edit filter)
- Lưu details JSON: viewname, columns_count

### 4. Edit View — `modules/CustomView/views/EditAjax.php`

- Truyền `CV_HISTORY` vào template

### 5. Template — `layouts/v7/modules/CustomView/EditView.tpl`

- Thêm block "Lịch sử thao tác" dạng timeline
- Chỉ hiển thị khi edit filter (không hiện khi tạo mới)
- Hiển thị: timestamp, user name, hành động (tạo/cập nhật), tên view, số cột

### 6. Language Labels

- `languages/vi_vn/Vtiger.php`: `LBL_LIST_HISTORY`, `LBL_CREATED_LIST`, `LBL_UPDATED_LIST`, `LBL_COLUMNS`
- `languages/en_us/Vtiger.php`: Same labels in English

## Verification

1. Tạo list filter mới → Save → Edit lại → History block hiện "đã tạo danh sách"
2. Edit → Save lại → History thêm "đã cập nhật danh sách"
3. Khi tạo filter mới → không hiện History block
