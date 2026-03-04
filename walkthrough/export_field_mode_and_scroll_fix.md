# Export Field Mode + UI Scroll Fix (03-03-2026)

## Mục tiêu

Sửa chức năng Export để:

1. Cột export bám đúng theo List filter khi cần.
2. Có tuỳ chọn export toàn bộ cột khi cần full data.
3. Popup Export không bị thiếu scroll sau khi thêm option mới.

## Vấn đề ban đầu

- File export (`.csv` / `.xls`) không theo đúng format cột của table List filter.
- Header và dữ liệu bị lệch thứ tự cột.
- Sau khi thêm `Export Field`, popup Export bị tràn nội dung và thiếu thanh cuộn.

## Nguyên nhân gốc

Trong `modules/Vtiger/actions/ExportData.php` có đoạn override:

- ép `QueryGenerator->setFields()` bằng toàn bộ field của module.
- điều này làm mất danh sách field theo custom view/list filter hiện tại.

Ngoài ra, phần ghi dữ liệu không cưỡng bức theo đúng thứ tự header, nên có thể lệch cột khi mảng dữ liệu trả về khác thứ tự.

## Giải pháp đã triển khai

### 1) Chuẩn hoá export theo List filter (mặc định)

File: `modules/Vtiger/actions/ExportData.php`

- Bỏ logic override field toàn module trong flow mặc định.
- Giữ danh sách field từ custom view (`accessibleFields`) để export theo List filter.
- Thêm cơ chế map dữ liệu theo đúng thứ tự header trước khi ghi CSV/XLS.

### 2) Thêm tuỳ chọn Export Field

UI:

- `layouts/v7/modules/Vtiger/Export.tpl`
- `layouts/vlayout/modules/Vtiger/Export.tpl`

Thêm mục **Export Field** với 2 options:

- `Based on list` (mặc định)
- `All columns`

Backend:

- `modules/Vtiger/actions/ExportData.php`
- Nhận tham số mới: `export_fields_mode`
  - `list`: giữ field theo list filter.
  - `all`: set lại field export = toàn bộ cột exportable của module (presence 0/2, displaytype != 6).

### 3) Sửa UI thiếu scroll trong popup Export

File: `layouts/v7/modules/Vtiger/Export.tpl`

- Đổi `modal-body` từ `margin-bottom:250px` sang:
  - `max-height: calc(100vh - 220px)`
  - `overflow-y: auto`
  - `overflow-x: hidden`

Kết quả: popup có thanh cuộn khi nội dung dài, không bị che phần dưới.

## Language labels đã thêm

- `languages/en_us/Vtiger.php`
  - `LBL_EXPORT_FIELDS` = `Export Field`
  - `LBL_EXPORT_FIELDS_BASED_ON_LIST` = `Based on list`
  - `LBL_EXPORT_FIELDS_ALL_COLUMNS` = `All columns`

- `languages/vi_vn/Vtiger.php`
  - `LBL_EXPORT_FIELDS` = `Trường xuất`
  - `LBL_EXPORT_FIELDS_BASED_ON_LIST` = `Theo danh sách hiện tại`
  - `LBL_EXPORT_FIELDS_ALL_COLUMNS` = `Tất cả cột`

## Checklist test nhanh

1. Mở Contacts List với custom view chỉ vài cột (ví dụ Name, Mobile Networks, Year of Birth).
2. Export với `Export Field = Based on list`:
   - Header file phải đúng thứ tự cột trên list.
3. Export với `Export Field = All columns`:
   - Header file phải là toàn bộ cột exportable của module.
4. Test cả `CSV` và `Excel (.xls)`.
5. Mở popup Export khi nhiều option:
   - Có thanh cuộn dọc, thao tác được tới nút Export/Cancel.

## Ghi chú

- Đây là thay đổi dùng chung cho luồng export của modules kế thừa `Vtiger_ExportData_Action`.
- Nếu UI chưa cập nhật, cần refresh trình duyệt và clear template/cache theo môi trường đang chạy.
