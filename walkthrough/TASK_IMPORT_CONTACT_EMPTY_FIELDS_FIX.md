# Task: Fix Import Contacts - Empty CSV values becoming "0"

## Ngữ cảnh

- Module: Contacts
- Nguồn dữ liệu: CSV import
- Hiện tượng: Các cột để trống trong file CSV khi import vào CRM lại bị lưu thành `0` (thay vì rỗng), đặc biệt thấy rõ ở các field như Mobile, Email, Phone.

## Triệu chứng đã xác nhận

- Dữ liệu hiển thị trên List View bị `0` ở nhiều cột.
- Kiểm tra DB cho thấy giá trị `0` thực sự đã được lưu trong bảng dữ liệu Contacts.
- Kiểm tra bảng staging import (`vtiger_import_1`) cho thấy một số giá trị đã là `0` ngay từ bước trước khi save record.

## Phân tích nguyên nhân

1. Luồng save có cơ chế ép kiểu có thể biến giá trị rỗng numeric thành `0`.
2. Trong một số lần import, dữ liệu tại staging/import mapping có thể mang giá trị chuỗi `"0"` cho field đáng ra phải rỗng.
3. Khi đi qua transform/import record, các `"0"` này không được chuẩn hóa lại về rỗng.

## Thay đổi đã thực hiện

### 1) Bật cơ chế preserve empty numeric trong luồng import

- File: `modules/Import/actions/Data.php`
- Tại hàm `importRecord(...)`:
  - Bật cờ global `VTIGER_IMPORT_PRESERVE_EMPTY_NUMERIC = true` trước khi gọi `vtws_create / vtws_update / vtws_revise`.
  - Restore lại trạng thái cờ sau khi xử lý xong.

### 2) Chỉnh ép kiểu numeric trong save layer để tôn trọng import flag

- File: `data/CRMEntity.php`
- Tại hàm `get_column_value(...)`:
  - Nếu đang ở import mode (`VTIGER_IMPORT_PRESERVE_EMPTY_NUMERIC`) và field numeric có giá trị rỗng (`''` hoặc `null`) thì trả về `null` thay vì `0`.

### 3) Chuẩn hóa chuỗi `"0"` cho text-like field ngay trong transform import

- File: `modules/Import/actions/Data.php`
- Tại `transformForImport(...)`:
  - Nếu value là chuỗi `"0"` và datatype thuộc nhóm text-like (`string`, `text`, `email`, `phone`, `url`) thì ép về rỗng (`''`).

## Kết quả mong đợi sau fix

- Import CSV với cột trống sẽ được lưu rỗng đúng như nguồn (thay vì `0`) cho các field text/email/phone/url.
- Hành vi save thông thường ngoài import không bị thay đổi ngoài phạm vi cờ import.

## Kiểm tra kỹ thuật đã chạy

- `php -l modules/Import/actions/Data.php`
- `php -l data/CRMEntity.php`
- Kết quả: Không có lỗi cú pháp.

## Lưu ý vận hành

- Cần import lại dữ liệu mới để thấy tác dụng của bản vá.
- Các record đã import trước đó và đang có `0` cần xử lý dữ liệu cũ bằng SQL cleanup riêng.

## Gợi ý cleanup dữ liệu cũ (tham khảo)

> Chạy cẩn trọng theo phạm vi record cần sửa (lọc theo thời gian import / assigned user / danh sách contactid).

- Ví dụ ý tưởng:
  - `mobile = '0'` -> `NULL`
  - `email = '0'` -> `NULL`
  - các cột text custom tương tự nếu bị `0` giả.

---

Cập nhật: March 3, 2026
