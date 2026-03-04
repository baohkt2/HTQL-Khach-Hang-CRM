# Tính năng: Nút xem thông tin Phân công Task trên Shared List

## Tổng quan

Khi một người dùng (Owner) chia sẻ một Custom View (List) cho các thành viên khác và phân công công việc, người được chia sẻ cần biết ai là người đã giao việc và nội dung công việc cụ thể là gì.
Phần bổ sung này thêm một nút thông tin nhỏ (icon ℹ️) ngay bên cạnh tên của mỗi List được chia sẻ. Khi click vào, một popup (modal) sẽ hiện ra để cung cấp các thông tin này mà không cần tải lại trang.

## Các thay đổi chính

### 1. Backend: Tạo API Endpoint mới

- **File:** `modules/CustomView/actions/GetShareTaskInfo.php`
- **Mô tả:** Đây là một Action Controller mới phục vụ AJAX requests. Nó nhận `cvid` (Custom View ID), kiểm tra trong DB mục `vtiger_customview` để tìm người tạo (Owner), và trong `vtiger_cv_share_tasks` để tìm kiếm thông tin giao việc đối chiếu với ID của User hiện tại đang đăng nhập.
- **Tính năng nổi bật:** Kiểm tra tự động membership của User, bao gồm việc người dùng được gán trực tiếp, gán qua Roles, hoặc gán qua Group.

### 2. Frontend: Giao diện Sidebar

- **File:** `layouts/v7/modules/Vtiger/partials/SidebarEssentials.tpl`
- **Mô tả:**
  - **Nút Info:** Đã thêm thẻ `<span class="shareTaskInfoBtn">` chứa icon chữ "i" được định dạng bằng CSS Absolute Positioning. Cách hiển thị này đảm bảo list name không bị rớt dòng khi người dùng hover chuột vào (để hiện nút dropdown mặc định của Vtiger).
  - **Căn chỉnh CSS:** Nút được canh giữa quang học (`margin-top: -1px; transform: translateY(-55%)`) và thụt lề tĩnh (`padding-left: 20px`) để khớp hoàn toàn 100% với danh sách List chữ thông thường.
  - **Modal Template:** Khai báo cấu trúc Modal của Bootstrap ở cuối template, đảm bảo nằm độc lập về Stacking Context.

### 3. Frontend: Javascript Logic

- **Mô tả (đặt trực tiếp ở SidebarEssentials):**
  - **Sự cố Stacking Context:** Modal Bootstrap khi hiển thị bên trong component Sidebar sẽ bị rơi xuống dưới bảng báo cáo (Table) vì giới hạn z-index của thẻ cha. _Cách khắc phục:_ Javascript sẽ "bứng" DOM node của Modal ra khỏi cấu trúc hiện tại và `appendTo('body')` trước khi show, giúp modal luôn nổi lên trên cùng với màng đen mờ đằng sau chính xác.
  - **Sự cố Event Bubbling:** Do Vtiger bắt sự kiện click List cha (`<li>` và `<a>`), nếu bắt sự kiện dạng Document Delegation sẽ gây ra hiện tượng nhấn nút 'i' lại bị load list. _Cách khắc phục:_ Thay bằng Direct Target Binding: `jQuery('.shareTaskInfoBtn').on('click')` kèm theo `e.stopPropagation()` và `e.stopImmediatePropagation()`.

## Hướng dẫn Test

1. Đăng nhập bằng tài khoản A, tạo một List và Share cho tài khoản B (Kèm theo Task Description).
2. Đăng xuất A, Đăng nhập B.
3. Nhìn sang tay trái phần Sidebar, ở menu con SHARED LIST sẽ có danh sách các List vừa được share, mỗi List có một nút chữ 'i' nhỏ bên cạnh sát lề trái.
4. Click thẳng vào chữ 'i'.
5. Kết quả mong đợi: Popup hiện lên hiển thị đúng người share là tài khoản A và đoạn description bạn đã nhập ở Bước 1. List ở bên dưới không hề bị trigger load lại trang. Nút 'X' của Popup thiết kế đẹp mắt và hoạt động chuẩn xác.
