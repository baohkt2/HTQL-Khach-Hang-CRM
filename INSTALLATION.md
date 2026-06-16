# Hướng Dẫn Cài Đặt — CRM Demo

> ⚠️ **CẢNH BÁO: Source code này chỉ dành cho mục đích demo, thử nghiệm, và nghiên cứu cá nhân.**
>
> - Không có database đi kèm.
> - Có nhiều lỗi đã biết chưa được sửa.
> - KHÔNG sử dụng cho môi trường production.
> - Người sử dụng tự chịu mọi rủi ro.

---

## 📋 Mục Lục
- [Yêu Cầu Hệ Thống](#yêu-cầu-hệ-thống)
- [Cài Đặt Trên Windows (XAMPP)](#cài-đặt-trên-windows-xampp)
- [Cài Đặt Trên Linux](#cài-đặt-trên-linux)
- [Cấu Hình Environment](#cấu-hình-environment)
- [Khắc Phục Sự Cố](#khắc-phục-sự-cố)

---

## Yêu Cầu Hệ Thống

### Yêu cầu PHP
- **Phiên bản PHP**: >= 8.1
- **Các Extension cần thiết**:
  - mysqli
  - imap
  - curl
  - gd
  - mbstring
  - xml
  - zip
  - openssl

### Database
- **MySQL**: >= 5.7 hoặc **MariaDB**: >= 10.3
- ❌ **Lưu ý:** Source code này KHÔNG bao gồm file database. Bạn cần tự tạo schema nếu muốn thử nghiệm.

### Web Server
- Apache 2.4+ với mod_rewrite enabled
- Hoặc Nginx

### Bộ Nhớ & Giới Hạn
- PHP Memory Limit: >= 512MB (khuyến nghị 1GB+)
- Max Execution Time: >= 300 giây
- Upload Max Filesize: >= 30MB

---

## Cài Đặt Trên Windows (XAMPP)

### Bước 1: Cài đặt XAMPP
1. Tải XAMPP từ [https://www.apachefriends.org](https://www.apachefriends.org)
2. Cài đặt với các thành phần: Apache, MySQL, PHP
3. Khởi động Apache và MySQL từ XAMPP Control Panel

### Bước 2: Clone Source Code
```batch
cd C:\xampp\htdocs
git clone <repository-url> crm-demo
```

### Bước 3: Cài đặt Composer Dependencies
```batch
cd C:\xampp\htdocs\crm-demo
composer install
```

### Bước 4: Database

> ❌ **Source code này KHÔNG bao gồm database.**
> Bạn cần tự tạo database schema phù hợp nếu muốn thử nghiệm.
> Tham khảo cấu trúc modules trong source code để hiểu các bảng cần thiết.

### Bước 5: Cấu hình Environment
```batch
copy .env.example .env
copy config.inc.template.php config.inc.php
copy config.csrf-secret.template.php config.csrf-secret.php
```
Mở file `.env` và cập nhật các thông số phù hợp với môi trường của bạn.

### Bước 6: Cấu hình PHP (php.ini)
Mở `C:\xampp\php\php.ini` và chỉnh sửa:
```ini
memory_limit = 1024M
max_execution_time = 600
upload_max_filesize = 50M
post_max_size = 50M
date.timezone = Asia/Ho_Chi_Minh
```

### Bước 7: Truy cập ứng dụng
Mở trình duyệt tại: http://localhost/crm-demo

---

## Cài Đặt Trên Linux

### Bước 1: Cài đặt LAMP Stack

**Ubuntu/Debian:**
```bash
sudo apt update
sudo apt install apache2 mysql-server php php-mysqli php-imap php-curl php-gd php-mbstring php-xml php-zip
sudo apt install composer
```

### Bước 2: Clone Source Code
```bash
cd /var/www/html
sudo git clone <repository-url> crm-demo
sudo chown -R www-data:www-data crm-demo
sudo chmod -R 755 crm-demo
```

### Bước 3: Thiết lập quyền truy cập
```bash
cd /var/www/html/crm-demo
sudo chmod -R 775 cache/ storage/ logs/ user_privileges/
```

### Bước 4: Cài đặt Dependencies
```bash
composer install
```

---

## Cấu Hình Environment

### Tạo file .env
```bash
cp .env.example .env
```

### Các biến quan trọng cần cấu hình:

| Biến | Mô tả | Ví dụ |
|------|-------|-------|
| `DB_SERVER` | Máy chủ database | `localhost` |
| `DB_PORT` | Cổng database | `3306` |
| `DB_USERNAME` | Tên người dùng DB | `demo_user` |
| `DB_PASSWORD` | Mật khẩu DB | `your_password` |
| `DB_NAME` | Tên database | `crm_demo_db` |
| `SITE_URL` | URL website | `http://localhost/crm-demo/` |
| `ROOT_DIRECTORY` | Đường dẫn thư mục gốc | `/var/www/html/crm-demo/` |
| `APPLICATION_UNIQUE_KEY` | Khóa bảo mật ứng dụng | 32 ký tự ngẫu nhiên |
| `CSRF_SECRET` | Khóa chống tấn công CSRF | 40 ký tự ngẫu nhiên |

### Tạo Security Keys
```bash
# Application Unique Key (32 ký tự)
openssl rand -hex 16

# CSRF Secret (40 ký tự)
openssl rand -hex 20
```

---

## Khắc Phục Sự Cố

### Lỗi Permission Denied
```bash
sudo chown -R www-data:www-data /var/www/html/crm-demo
sudo chmod -R 755 /var/www/html/crm-demo
sudo chmod -R 775 cache/ storage/ logs/ user_privileges/
```

### Lỗi PHP Extensions
Kiểm tra các extension đã cài:
```bash
php -m | grep -E "mysqli|imap|curl|gd"
```

### Lỗi Kết Nối Database
1. Kiểm tra thông tin trong file `.env`
2. Kiểm tra MySQL/MariaDB service đang chạy
3. Đảm bảo đã tạo database và user phù hợp

### Lỗi Trang Trắng / 500 Error
1. Bật chế độ debug trong `.env`: `DEBUG_MODE=true`
2. Kiểm tra Apache error log:
   - Windows: `C:\xampp\apache\logs\error.log`
   - Linux: `/var/log/apache2/error.log`

### Xóa Cache
```bash
# Linux
rm -rf cache/images/* cache/import/* cache/upload/*

# Windows
del /s /q cache\images\* cache\import\* cache\upload\*
```

---

> ⚠️ **Nhắc lại:** Source code này CHỈ dành cho mục đích demo / thử nghiệm / nghiên cứu cá nhân.
> Không sử dụng cho production. Người sử dụng tự chịu mọi rủi ro.

## License
Nền tảng gốc (Vtiger CRM) được phát hành dưới [Vtiger Public License](LICENSE.txt).
