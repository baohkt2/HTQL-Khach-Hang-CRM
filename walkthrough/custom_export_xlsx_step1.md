# Custom Export + XLSX Export (Step 1)

## 1. Mục tiêu của bước này

Bước này chỉ triển khai phần nền cho tính năng **Custom Export** và bổ sung khả năng **xuất dữ liệu ra file `.xlsx`** trong luồng export hiện tại của Vtiger.

Phạm vi đã làm:

- Thêm một option mới là **Custom Export** trong menu **More** của danh sách bản ghi.
- Giữ nguyên luồng export cũ để tránh ảnh hưởng hành vi hiện tại.
- Bổ sung thêm lựa chọn **Excel (.xlsx)** trong popup export.
- Mở rộng backend để hỗ trợ xuất `.xlsx` bằng thư viện `PHPExcel` có sẵn.

Phạm vi chưa làm trong bước này:

- Chưa có logic custom field riêng cho `Custom Export`.
- Chưa có màn hình chọn cột, mapping, preset, hay điều kiện export nâng cao.
- `Custom Export` hiện mới là entry point để dùng cho các bước phát triển tiếp theo.

## 2. Các file đã thay đổi

### 2.1. Thêm URL cho Custom Export

- `modules/Vtiger/models/Module.php`

Đã thêm method:

- `getCustomExportUrl()`

Method này trả về URL:

```php
index.php?module=<MODULE>&view=CustomExport
```

### 2.2. Thêm menu Custom Export trong More menu

Đã bổ sung thêm item `LBL_CUSTOM_EXPORT` bên cạnh `LBL_EXPORT` tại các nơi sau:

- `modules/Vtiger/models/ListView.php`
- `modules/Calendar/models/ListView.php`
- `modules/PriceBooks/models/ListView.php`

Lý do cần sửa nhiều file:

- `Vtiger_ListView_Model` là luồng chung.
- `Calendar` và `PriceBooks` có override riêng phần advanced links, nên cần thêm thủ công để menu xuất hiện đồng nhất.

## 3. Thêm view nền cho Custom Export

### File mới

- `modules/Vtiger/views/CustomExport.php`

Nội dung hiện tại:

- `Vtiger_CustomExport_View` kế thừa trực tiếp từ `Vtiger_Export_View`.

Ý nghĩa:

- Tạo một entry point riêng cho `Custom Export`.
- Chưa tách logic export mới ngay ở bước đầu.
- Cho phép các bước sau phát triển màn hình hoặc behavior riêng mà không phải sửa đè trực tiếp vào `Export` cũ.

## 4. Cập nhật popup Export

### File

- `layouts/v7/modules/Vtiger/Export.tpl`

Đã thay đổi:

- Tiêu đề popup giờ lấy theo biến truyền từ backend:
  - `LBL_EXPORT_RECORDS`
  - hoặc `LBL_CUSTOM_EXPORT_RECORDS`
- Nút submit giờ lấy theo biến:
  - `LBL_EXPORT`
  - hoặc `LBL_CUSTOM_EXPORT`
- Thêm lựa chọn mới:

```text
Excel (.xlsx)
```

Các định dạng hiện hỗ trợ trong popup export thường:

- `CSV (.csv)`
- `Excel (.xls)`
- `Excel (.xlsx)`

## 5. Cập nhật backend export để hỗ trợ XLSX

### File

- `modules/Vtiger/actions/ExportData.php`

Trước khi sửa:

- Chỉ hỗ trợ:
  - `.csv`
  - `.xls`
- Nhánh Excel dùng:

```php
PHPExcel_IOFactory::createWriter($workbook, 'Excel5')
```

Sau khi sửa:

- Hỗ trợ cả:
  - `.xls`
  - `.xlsx`
- Nếu chọn `.xlsx`, hệ thống dùng:

```php
PHPExcel_IOFactory::createWriter($workbook, 'Excel2007')
```

- Nếu server không có `ZipArchive`, code sẽ fallback sang `PCLZIP`:

```php
PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP)
```

### Content-Type theo định dạng

- `.xls`:

```text
application/vnd.ms-excel
```

- `.xlsx`:

```text
application/vnd.openxmlformats-officedocument.spreadsheetml.sheet
```

## 6. Cập nhật backend view để phân biệt Export và Custom Export

### File

- `modules/Vtiger/views/Export.php`

Đã thêm logic nhận biết:

- nếu `view=CustomExport`

thì truyền xuống template:

- `EXPORT_TITLE_LABEL = LBL_CUSTOM_EXPORT_RECORDS`
- `EXPORT_ACTION_LABEL = LBL_CUSTOM_EXPORT`

Ngược lại vẫn dùng:

- `LBL_EXPORT_RECORDS`
- `LBL_EXPORT`

Điều này giúp cùng một template hiển thị đúng ngữ cảnh mà không cần nhân đôi file giao diện.

## 7. Thêm label ngôn ngữ

Đã bổ sung label ở:

- `languages/en_us/Vtiger.php`
- `languages/vi_vn/Vtiger.php`

Các key mới:

```php
'LBL_CUSTOM_EXPORT'
'LBL_CUSTOM_EXPORT_RECORDS'
```

Giá trị tiếng Việt:

- `LBL_CUSTOM_EXPORT` => `Xuất tùy chỉnh`
- `LBL_CUSTOM_EXPORT_RECORDS` => `Xuất bản ghi tùy chỉnh`

## 8. Kết quả hiện tại

Sau bước này, người dùng có thể:

- Mở **More** trong list view.
- Chọn **Export** hoặc **Custom Export**.
- Trong popup export, chọn định dạng:
  - `.csv`
  - `.xls`
  - `.xlsx`

Luồng `Custom Export` hiện tại vẫn dùng chung form export cũ, nhưng đã có đường dẫn và view riêng để tiếp tục mở rộng ở bước sau.

## 9. Kiểm tra đã thực hiện

Đã kiểm tra syntax bằng lệnh:

```bash
php -l modules/Vtiger/models/Module.php
php -l modules/Vtiger/models/ListView.php
php -l modules/Calendar/models/ListView.php
php -l modules/PriceBooks/models/ListView.php
php -l modules/Vtiger/views/Export.php
php -l modules/Vtiger/views/CustomExport.php
php -l modules/Vtiger/actions/ExportData.php
```

Kết quả:

- Không có lỗi cú pháp.

## 10. Hướng triển khai tiếp theo

Các bước tiếp theo phù hợp cho `Custom Export`:

1. Tạo popup hoặc page riêng để chọn danh sách cột cần export.
2. Cho phép lưu preset cấu hình export theo module.
3. Bổ sung điều kiện lọc riêng chỉ áp dụng cho custom export.
4. Hỗ trợ thứ tự cột và tên cột tùy chỉnh.
5. Tách action xử lý riêng nếu business logic của `Custom Export` bắt đầu khác hẳn export chuẩn.
