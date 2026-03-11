# Custom Export Popup XLSX

## Mục tiêu

Triển khai luồng Custom Export riêng cho list view.

Luồng này không lưu thành List Filter trong database.

Người dùng thao tác theo flow:

1. Mở list view.
2. Click Custom Export.
3. Chọn filename.
4. Nhập Title.
5. Chọn columns và thứ tự columns.
6. Chọn conditions ngay trong popup.
7. Click Export để tải file `.xlsx`.

## Hành vi hiện tại

- Popup Custom Export mở từ menu More của list view.
- Popup dùng UI giống phần tạo list filter, nhưng không có Save list.
- `filename` mặc định là `DS GBTT DOT `.
- `Title` mặc định là `DANH SÁCH TRÚNG TUYỂN `.
- Title được ghi ở row 1 của file Excel export.
- Header bắt đầu từ row 2 nếu có Title.
- Dữ liệu bắt đầu từ row 3 nếu có Title.
- Có thêm 2 block chữ ký dưới phần data, cách data 2 dòng trống.
- Block 1 hiển thị: `Ngày DD/MM/YYYY` và dòng dưới là `NGƯỜI LẬP`.
- Block 2 hiển thị: `Ngày .../.../...` và dòng dưới là `BP ĐÀO TẠO`.
- Sau 4 dòng trống, block 1 hiển thị thêm tên `user_name` của user đang click export.
- Sau 4 dòng trống, block 2 hiển thị thêm tên cố định `Trương Xuân Việt`.
- Nếu số cột export `>= 5`:
  - Block 1 chiếm cột 2 và 3.
  - Block 2 chiếm 2 cột cuối.
- Nếu số cột export `< 5`:
  - Block 1 nằm ở cột đầu.
  - Block 2 nằm ở cột cuối.
- Columns mặc định để trống, không tự chọn sẵn.
- Không còn validate điều kiện `at least mandatory field`.
- Conditions trong popup luôn sạch khi mở Custom Export.
- Conditions này chỉ dùng cho lần export hiện tại.
- Conditions không được lưu vào custom view hoặc list filter trong database.

## Logic nghiệp vụ

Custom Export phải hoạt động độc lập với saved custom view filter.

Điều đó có nghĩa là:

- Không load lại advanced conditions đã lưu của custom view hiện tại.
- Không dùng custom view như một object để save rồi export.
- Chỉ reuse UI và logic chọn field/filter của màn hình list filter.
- Query export chỉ nhận dữ liệu từ popup hiện tại:
  - `columnslist`
  - `advfilterlist`
  - `filename`
  - `export_title`

## File liên quan

### View render popup

- `modules/Vtiger/views/Export.php`

Vai trò:

- Detect khi `view=CustomExport`.
- Load record structure cho filter UI.
- Gán `ADVANCE_CRITERIA` rỗng để popup mở sạch conditions.
- Render template riêng cho custom export.

### Template popup

- `layouts/v7/modules/Vtiger/CustomExport.tpl`

Vai trò:

- Render form popup custom export.
- Chứa input:
  - `filename`
  - `export_title`
  - `Choose columns and order`
  - `Choose list conditions`
- Submit về `action=ExportData`.
- Gửi `custom_export=1` và `export_format=xlsx`.

### JS khởi tạo popup

- `layouts/v7/modules/Vtiger/resources/List.js`

Vai trò:

- Khi overlay export được mở, nếu form là `#customExportForm` thì khởi tạo riêng.
- Init select2 cho columns.
- Init `Vtiger_AdvanceFilter_Js` cho conditions.
- Serialize lại `columnslist` theo đúng thứ tự người dùng chọn.
- Serialize `advfilterlist` từ popup trước khi submit.
- Không check mandatory field nữa.

### Action export

- `modules/Vtiger/actions/ExportData.php`

Vai trò:

- Nếu `custom_export=1`:
  - Không init query từ custom view filter trong database.
  - Chỉ set fields từ `columnslist` của popup.
  - Chỉ parse conditions từ `advfilterlist` của popup.
  - Dùng `filename` làm tên file export.
  - Dùng `export_title` để ghi Title ở dòng đầu file Excel.
  - Ghi thêm 2 block chữ ký ở footer của sheet Excel theo số cột export.
- Hỗ trợ xuất `.xlsx`.

## Dữ liệu submit chính

### 1. `columnslist`

- Là mảng các field theo format custom view column name.
- Được gửi từ popup.
- Dùng để build các field cần export.

### 2. `advfilterlist`

- Là dữ liệu filter do `Vtiger_AdvanceFilter_Js` trả về.
- Chỉ áp dụng cho lần export hiện tại.
- Không được lưu thành custom view.

### 3. `filename`

- Là tên file tải xuống.
- Hệ thống tự remove phần mở rộng nếu user nhập `.xlsx`.

### 4. `export_title`

- Là text hiển thị tại row 1 trong file Excel.
- Nếu có Title:
  - row 1: title
  - row 2: header
  - row 3+: data

## Bố cục footer Excel

- Footer chữ ký nằm dưới data và cách data 2 dòng trống.
- Nội dung block trái:
  - `Ngày DD/MM/YYYY`
  - `NGƯỜI LẬP`
  - 4 dòng trống
  - `user_name` của user đang export
- Nội dung block phải:
  - `Ngày .../.../...`
  - `BP ĐÀO TẠO`
  - 4 dòng trống
  - `Trương Xuân Việt`
- Rule vị trí cột:
  - Nếu số cột export `>= 5`: block trái nằm ở cột 2-3, block phải nằm ở 2 cột cuối.
  - Nếu số cột export `< 5`: block trái nằm ở cột đầu, block phải nằm ở cột cuối.

## Điểm cần lưu ý

- Custom Export là luồng export runtime-only.
- Không được biến nó thành saveable custom view.
- Không được auto reuse filter đã lưu của list hiện tại.
- Chỉ reuse giao diện và cấu trúc filter builder.

## Test case nên kiểm tra

1. Mở Custom Export và xác nhận conditions trống.
2. Không chọn cột thì không cho export.
3. Chọn cột, không chọn condition, export ra `.xlsx` có dữ liệu.
4. Chọn cột và một condition, export ra `.xlsx` có dữ liệu đúng filter.
5. Kiểm tra row 1 có Title.
6. Kiểm tra filename tải xuống đúng giá trị nhập.
7. Kiểm tra mở lại Custom Export lần sau không bị dính conditions cũ.
8. Kiểm tra footer chữ ký hiển thị đúng vị trí theo số cột export.

## Ghi chú

File này mô tả trạng thái hiện tại của task Custom Export popup, tách riêng khỏi file `custom_export_xlsx_step1.md` là file nền ban đầu cho việc thêm entry Custom Export và hỗ trợ `.xlsx`.
