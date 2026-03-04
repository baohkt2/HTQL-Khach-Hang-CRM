# Sửa lỗi: Share List Task không hiển thị Users khi Edit (Reload)

## Mô tả lỗi ban đầu

Người dùng báo cáo rằng:

1. Khi tạo Custom View mới và check "Share the list", sau đó thêm một vài Members (Users/Groups) và Task Description rồi **Save** thì thành công.
2. Users được phân công đăng nhập vào thì **thấy** View được share.
3. Tuy nhiên, khi người tạo (owner) click vào **Edit** lại danh sách đó, thì danh sách members đã chọn **biến mất** (select trống), dù Task Description vẫn hiển thị bình thường.

## Quá trình Debug

Bằng cách thêm các log vào Javascript và PHP, chúng tôi đã phát hiện:

1. **Frontend (Javascript / Smarty)**:
   - Element Select2 v3 không tự động đọc thuộc tính `selected="selected"` trong DOM như các select thông thường khi có nhiều thay đổi động.
   - Thử truyền array members qua hidden `<input>`: log báo input rỗng!
2. **Backend (PHP - `getShareTasks()`)**:
   - `getShareTasks()` trả về `$membersArray = []` (mảng rỗng).
   - Kiểm tra Database MySQL bảng `vtiger_cv_share_tasks`: Dữ liệu cột `members` thực tế ghi nhận một chuỗi, ví dụ: `["Users:17"]`. (Đúng chuẩn JSON)
   - Tuy nhiên, khi in log tại đoạn `json_decode()`, thì hàm `json_decode()` báo lỗi **"Syntax error"**.
   - Kiểm tra giá trị raw lấy từ `query_result()`, giá trị thực tại thời điểm lấy ra là: `[&quot;Users:17&quot;]`.

## Nguyên nhân Root Cause

Do cơ chế bảo mật của Vtiger (`PearDatabase->pquery()` hoặc quá trình xử lý chuỗi trước khi lưu), Vtiger tự động **HTML-encode** các ký tự đặc biệt như dấu ngoặc kép (`"`) thành entity html (`&quot;`).

Vì vậy, mảng JSON hợp lệ `["Users:17"]` khi lưu vào database đã bị biến thành chuỗi không hợp lệ json `[&quot;Users:17&quot;]`.
Khi đọc lên lại, hàm `json_decode()` không hiểu `&quot;`, dẫn tới lỗi parse JSON và trả về `null`. Smarty Template nhận mảng rỗng và vì thế Select2 không có member ID nào để render lại.

## Cách giải quyết (The Fix)

1. **Tại `saveShareTasks` (File: `CustomView/models/Record.php`)**:
   - Làm sạch JSON string bằng cách loại bỏ các HTML entities ở các IDs thành viên bằng `html_entity_decode($m, ENT_QUOTES, 'UTF-8')` trước khi gọi `json_encode()` và Insert vào cơ sở dữ liệu.
   - Làm sạch luôn trường `task_description`.

2. **Tại `getShareTasks` (File: `CustomView/models/Record.php`)**:
   - Khi load cột `members` từ database lện, chúng ta giải mã ngược lại bằng `html_entity_decode($membersJson, ENT_QUOTES, 'UTF-8')` để chuyển chuỗi `[&quot;Users:17&quot;]` trở lại định dạng gốc `["Users:17"]`.
   - Sau đó mới tiến hành `json_decode()`.

3. **Tại `CustomView.js` (Javascript)**:
   - Thay vì trông chờ Select2 v3 tự động nhận `selected` options, chúng ta đã thêm một thẻ `<input type="hidden" class="share-task-saved-members" value="Users:11,Users:17" />` trong `EditView.tpl`.
   - TRƯỚC khi gọi Select2 init, Javascript đọc hidden input này, đánh dấu `.prop("selected", true)` cho các native `<option>` tags, sau đó mới init Select2.

## Kết quả

Tất cả các thành viên (Users, Groups, Role,...) được chọn vào list sẽ được lưu JSON chính xác vào CSDL, không bị mã hóa lỗi, Parse JSON thành công, hiện đầy đủ options mỗi khi người dùng truy cập lại màn hình Edit List.
