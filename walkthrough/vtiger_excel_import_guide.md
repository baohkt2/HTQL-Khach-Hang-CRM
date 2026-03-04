# Thêm chức năng Import file Excel (.xls, .xlsx) vào vtiger CRM

## 1. Tổng quan

vtiger CRM mặc định chỉ hỗ trợ import dữ liệu từ file `.csv` và `.vcf`. Tài liệu này mô tả chi tiết các bước kỹ thuật để thêm khả năng đọc và import trực tiếp từ file `.xls` và `.xlsx` cho hệ thống, sử dụng thư viện `PHPExcel` có sẵn của vtiger.

## 2. Các thành phần đã chỉnh sửa và thêm mới

### 2.1. Module Config và Utilities

- **`modules/Import/models/Config.php`**: Cập nhật danh sách loại file (file types) được phép tải lên.
- **`modules/Import/helpers/Utils.php`**: Thêm logic nhận diện đuôi file `xls` và `xlsx` vào hàm kiểm tra phần mở rộng định dạng hỗ trợ.

### 2.2. Giao diện (UI & Templates)

- **`layouts/v7/modules/Import/ImportStepOne.tpl`**:
  - **Lỗi Fix**: Sửa lỗi hardcode trường input hidden `type="csv"` thành lấy giá trị động giúp hệ thống biết chính xác loại file đang được import để gọi đúng Reader.
- **Biên dịch ngôn ngữ (`languages/en_us/Import.php` & `languages/vi_vn/Import.php`)**: Bổ sung các biến dịch thuật như `LBL_XLS_FILE`, `LBL_UPLOAD_XLS`, `LBL_IMPORT_FROM_XLS_FILE`.

### 2.3. Trình đọc file Excel (XLSReader)

- **Tạo mới `modules/Import/readers/XLSReader.php`**:
  - Class `Import_XLSReader_Reader` được xây dựng kế thừa từ `Import_FileReader_Reader`.
  - Sử dụng thư viện `PHPExcel` (`libraries/PHPExcel/PHPExcel.php`) để quét và chuyển đổi dữ liệu từ các sheet Excel thành các mảng mapping.

## 3. Các vấn đề kỹ thuật lớn đã khắc phục (Troubleshooting & Fixes)

Trong quá trình phát triển, chúng tôi đã giải quyết 2 bug cực kỳ nghiêm trọng liên quan đến Core CRM:

### Bug 1: Lỗi "0 records scanned" do giới hạn của MySQL (Row Size Limit)

- **Vấn đề**: Khi import file Excel với số lượng cột rất lớn (ví dụ: 156 cột), hàm `createTable()` gốc sẽ cố gắng tạo 156 cột `VARCHAR(250)`. Điều này vượt mức giới hạn độ dài dòng phần cứng của MySQL (65,535 bytes). DB từ chối tạo bảng staging (`vtiger_import_x`) một cách âm thầm, làm cho bước tiếp theo không thể tìm thấy dữ liệu.
- **Giải pháp**: Ghi đè phương thức `createTable()` bên trong `XLSReader.php`. Thay vì lấy cấu trúc type từ schema, ép kiểu tất cả các field được parse từ Excel thành kiểu `TEXT`. Kiểu dữ liệu `TEXT` lưu trữ content overflow ở page bên ngoài, hoàn toàn vượt qua giới hạn 65KB này.

### Bug 2: Lỗi "Id specified is incorrect" làm sập import (VTQL Exception)

- **Vấn đề**: Trong vtiger, tất cả entity được khởi tạo qua vtiger WebServices. Hàm `vtws_create()` (bên trong `Import_Data_Action`) sẽ thắt chặt điều kiện với các tham chiếu ID. Nếu một field Reference của Excel chứa tên user hợp lệ nhưng không phải định dạng WEBSERVICE ID (vd: `x`), VTQL sẽ ném ra WebServiceException vô điều kiện, làm crash thẳng và gián đoạn toàn bộ quá trình (`Current Import has been interrupted`).
- **Giải pháp**: Bọc lệnh gọi `vtws_create()` bên trong các block `try { ... } catch (Exception $e) { ... }` tại `modules/Import/actions/Data.php`. Nếu một dòng (record) nào đó bị lỗi Id lookup, framework sẽ chủ động in lỗi (Error Log) và đánh dấu Record đó là _Failed_, sau đó **vẫn tiếp tục import** các dòng còn lại mà không làm sập tiến trình chung. Dữ liệu thành công vẫn sẽ được lưu trữ bình thường.

### Bug 3: Lỗi giới hạn Row Size của import CSV mặc định của Vtiger

- **Vấn đề**: Sau khi fix Import cho định dạng Excel, chúng tôi nhận thấy chức năng Import `.csv` gốc của Vtiger cũng dính phải lỗi tương tự khi import 1 file có quá nhiều cột (ví dụ: 154 cột). Cụ thể, hàm `createTable()` gốc trong `FileReader.php` mặc định tạo cấu trúc table với tất cả các field được parse là kiểu `VARCHAR(250)`. Việc này cũng lập tức vượt quá giới hạn 65,535 bytes của MySQL và ném ra lỗi `ERR_CREATE_TABLE_FAILED`, dẫn đến import 0 records.
- **Giải pháp**: Chúng tôi đã can thiệp vào mã nguồn gốc tại `modules/Import/readers/FileReader.php` để sửa hàm `createTable()`. Thay vì tạo cột `VARCHAR(250)` và ENGINE MyISAM cứng nhắc, chúng tôi chuyển tất cả kiểu dữ liệu lúc parse thành loại `TEXT` cũng như sử dụng `ENGINE=InnoDB ROW_FORMAT=DYNAMIC` như đã làm thành công với Excel. Cập nhật này giúp **mọi file dữ liệu CSV** trong tương lai có bao nhiêu dữ liệu cột đi nữa cũng sẽ được dựng bảng thành công và bypass qua giới hạn của hệ quản trị CSDL.
