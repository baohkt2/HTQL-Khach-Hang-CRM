# Hướng dẫn Test Import Workflow

## Bước 1: Restart Apache (QUAN TRỌNG!)
Để VTBatchEventHandler hoạt động, bạn cần restart Apache:
```
1. Mở XAMPP Control Panel
2. Click "Stop" cho Apache
3. Đợi vài giây
4. Click "Start" để khởi động lại Apache
```

## Bước 2: Test Import
1. Truy cập VTiger CRM: http://localhost/vtigercrm
2. Đăng nhập vào hệ thống
3. Chuyển đến module **Contacts**
4. Click nút **Import**
5. Upload file: `test_contacts.csv` (đã tạo sẵn)
6. Mapping fields:
   - First Name → First Name
   - Last Name → Last Name
   - Mobile Phone → Mobile
   - Email → Email

## Bước 3: Kiểm tra kết quả
Sau khi import, check các contact mới tạo:
- Mobile numbers bắt đầu 034 → Mobile networks = "Viettel"
- Mobile numbers bắt đầu 084 → Mobile networks = (theo workflow mapping)
- Mobile numbers bắt đầu 096 → Mobile networks = (theo workflow mapping)

## Bước 4: Debug (nếu không hoạt động)
Chạy script kiểm tra:
```bash
cd /c/xampp/htdocs/vtigercrm
php test_workflow.php
```

Kiểm tra Apache error log:
```
tail -f C:\xampp\apache\logs\error.log
```

## Test Data
File `test_contacts.csv` chứa:
- Nguyen Van A, 0342345678 (Viettel)
- Tran Thi B, 0845567890 (Vina)
- Le Van C, 0967891234 (Mobi)
- Pham Thi D, 0345678901 (Viettel)
- Hoang Van E, 0847890123 (Vina)

## Expected Result
Sau import, tất cả contacts sẽ có Mobile networks field được populate tự động theo prefix mapping workflow.