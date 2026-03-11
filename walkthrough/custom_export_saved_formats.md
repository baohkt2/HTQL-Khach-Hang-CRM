# Custom Export Saved Formats

## Mục tiêu

Bổ sung khả năng lưu lại cấu hình Custom Export để người dùng tái sử dụng nhanh.

Phạm vi của task này gồm:

1. Lưu format export theo user và module.
2. Có dropdown để chọn lại format đã lưu ngay trong popup Custom Export.
3. Có nút xóa từng item history trong dropdown.
4. Chỉnh lại layout phần controls để dễ dùng hơn.

## Hành vi sau khi hoàn thành

- Popup Custom Export có thêm một dropdown `Saved formats`.
- Dropdown hiển thị danh sách format đã lưu của đúng user hiện tại và đúng module hiện tại.
- Khi chọn một format đã lưu, hệ thống sẽ apply lại:
  - `filename`
  - `export_title`
  - danh sách cột
  - thứ tự cột
  - điều kiện lọc
- Có checkbox `Save format` để lưu cấu hình hiện tại.
- Có input `Format name` để đặt tên format.
- Mỗi item trong dropdown có nút xóa riêng.
- Sau khi xóa, dropdown được cập nhật lại ngay trong popup.

## Layout UI

Khối `Choose columns and order` được chia thành 2 row:

### Row 1

- Dropdown format đã lưu
- Input chọn columns

### Row 2

- Checkbox `Save format`
- Input `Format name`

Mục đích là để popup gọn hơn và phần chọn cột không bị ép xuống dưới.

## Quy tắc lưu dữ liệu

Format được lưu theo scope:

- `userid`
- `module_name`

Tên format là unique trong phạm vi `userid + module_name`.

Điều này giúp:

- Không đụng format giữa các user khác nhau.
- Không đụng format giữa các module khác nhau.

## Bảng database mới

Task này tạo bảng mới:

- `vtiger_custom_export_formats`

Các cột chính:

- `id`
- `userid`
- `module_name`
- `format_name`
- `filename`
- `export_title`
- `columnslist`
- `advfilterlist`
- `createdtime`
- `modifiedtime`

Index quan trọng:

- `UNIQUE KEY uniq_custom_export_format (userid, module_name, format_name)`

Table được tạo bằng `CREATE TABLE IF NOT EXISTS` trong model để tránh xung đột khi deploy.

## File chính đã sửa

### 1. Model lưu format

- `modules/Vtiger/models/CustomExportFormat.php`

Vai trò:

- Tạo bảng nếu chưa tồn tại.
- Lấy danh sách format theo user và module.
- Lưu format mới.
- Cập nhật format cũ.
- Xóa format.

### 2. Action lưu format

- `modules/Vtiger/actions/SaveCustomExportFormat.php`

Vai trò:

- Nhận dữ liệu từ popup qua AJAX.
- Validate tên format và danh sách cột.
- Lưu hoặc update format.
- Trả JSON để UI cập nhật lại dropdown.

### 3. Action xóa format

- `modules/Vtiger/actions/DeleteCustomExportFormat.php`

Vai trò:

- Xóa một format đã lưu theo `record id`.
- Chỉ cho phép xóa format của đúng user hiện tại và đúng module hiện tại.
- Trả JSON để UI refresh lại history.

### 4. View render popup export

- `modules/Vtiger/views/Export.php`

Vai trò:

- Khi vào `view=CustomExport`, view này preload thêm `SAVED_EXPORT_FORMATS`.
- Truyền danh sách format đã lưu sang template popup.

### 5. View render lại filter

- `modules/Vtiger/views/CustomExportFilter.php`

Vai trò:

- Render lại block `AdvanceFilter.tpl` theo `advfilterlist` của format được chọn.
- Đảm bảo khi user chọn format cũ thì phần conditions hiện đúng UI.

### 6. Template popup

- `layouts/v7/modules/Vtiger/CustomExport.tpl`

Vai trò:

- Thêm dropdown format đã lưu.
- Thêm checkbox lưu format.
- Thêm input tên format.
- Chỉnh layout controls thành 2 row.

### 7. JS popup custom export

- `layouts/v7/modules/Vtiger/resources/List.js`

Vai trò:

- Load danh sách format đã lưu từ hidden input.
- Render dropdown.
- Apply format đã chọn vào form.
- Gọi AJAX lưu format.
- Gọi AJAX xóa format.
- Reload phần filter UI sau khi apply format.

### 8. Ngôn ngữ

- `languages/vi_vn/Vtiger.php`
- `languages/en_us/Vtiger.php`

Đã thêm cả vào:

- `languageStrings`
- `jsLanguageStrings`

Lý do:

- Template dùng `vtranslate(...)`
- JavaScript dùng `app.vtranslate(...)`

Nếu chỉ thêm ở `languageStrings` thì text gọi trong JS sẽ hiện raw key như `LBL_SELECT_SAVED_EXPORT_FORMAT`.

## Dữ liệu được lưu trong mỗi format

Mỗi format hiện lưu các phần sau:

- `format_name`
- `filename`
- `export_title`
- `columnslist`
- `advfilterlist`

## Flow hoạt động

### Lưu format

1. User tick `Save format`.
2. User nhập `Format name`.
3. User submit Custom Export.
4. JS serialize `columnslist` và `advfilterlist`.
5. JS gọi `SaveCustomExportFormat` qua AJAX.
6. Nếu lưu thành công, dropdown được update tại chỗ.
7. Sau đó form export thật mới được submit.

### Chọn lại format đã lưu

1. User mở dropdown `Saved formats`.
2. Chọn một item.
3. JS apply dữ liệu vào `filename`, `title`, `columns`.
4. JS gọi `CustomExportFilter` để render lại conditions.

### Xóa format

1. User click icon thùng rác ở item tương ứng.
2. JS hiện confirmation box.
3. Nếu xác nhận, gọi `DeleteCustomExportFormat` qua AJAX.
4. Nếu thành công, item biến mất khỏi dropdown ngay.

## Các điểm cần lưu ý

- Đây là preset runtime cho popup export, không phải custom view.
- Không ghi đè hay lưu vào `CustomView`.
- Không share format giữa user.
- Không share format giữa module.
- Khi chọn lại format, phần filter phải được render lại để UI khớp dữ liệu.

## Kiểm tra nên thực hiện

1. Lưu một format mới trong cùng module.
2. Mở lại popup và chọn format vừa lưu.
3. Kiểm tra cột và thứ tự cột được apply đúng.
4. Kiểm tra conditions được apply đúng.
5. Kiểm tra xóa một item history trong dropdown.
6. Kiểm tra cùng tên format nhưng ở module khác không bị xung đột.
7. Kiểm tra user khác không nhìn thấy format của nhau.

## Ghi chú

File này mô tả phần mở rộng tiếp theo của Custom Export popup, tập trung vào save/load/delete preset format và chỉnh UX layout của popup.
