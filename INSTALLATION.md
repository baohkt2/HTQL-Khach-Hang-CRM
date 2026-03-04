# Hướng Dẫn Cài Đặt CUSC CRM

## 📋 Mục Lục
- [Yêu Cầu Hệ Thống](#yêu-cầu-hệ-thống)
- [Cài Đặt Trên Windows (XAMPP)](#cài-đặt-trên-windows-xampp)
- [Cài Đặt Trên Linux](#cài-đặt-trên-linux)
- [Cấu Hình Database](#cấu-hình-database)
- [Cấu Hình Environment](#cấu-hình-environment)
- [Cài Đặt Dependencies](#cài-đặt-dependencies)
- [Thiết Lập Cron Jobs](#thiết-lập-cron-jobs)
- [Khắc Phục Sự Cố](#khắc-phục-sự-cố)

---

## Yêu Cầu Hệ Thống

### PHP Requirements
- **PHP Version**: >= 8.1
- **Required Extensions**:
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

### Web Server
- Apache 2.4+ với mod_rewrite enabled
- Hoặc Nginx

### Memory & Limits
- PHP Memory Limit: >= 512MB (khuyến nghị 1GB+)
- Max Execution Time: >= 300 seconds
- Upload Max Filesize: >= 30MB

---

## Cài Đặt Trên Windows (XAMPP)

### Bước 1: Cài đặt XAMPP
1. Tải XAMPP từ [https://www.apachefriends.org](https://www.apachefriends.org)
2. Cài đặt với các components: Apache, MySQL, PHP
3. Khởi động Apache và MySQL từ XAMPP Control Panel

### Bước 2: Clone/Copy Source Code
```batch
cd C:\xampp\htdocs
git clone <repository-url> cusc
```

### Bước 3: Cài đặt Composer Dependencies
```batch
cd C:\xampp\htdocs\cusc
composer install
```

### Bước 4: Tạo Database
1. Mở phpMyAdmin: http://localhost/phpmyadmin
2. Tạo database mới: `cusc_db`
3. Import file `database/cusc_db.sql`

### Bước 5: Cấu hình Environment
```batch
copy .env.example .env
```
Mở file `.env` và cập nhật các thông số.

### Bước 6: Cấu hình PHP (php.ini)
Mở `C:\xampp\php\php.ini` và sửa:
```ini
memory_limit = 1024M
max_execution_time = 600
upload_max_filesize = 50M
post_max_size = 50M
date.timezone = Asia/Ho_Chi_Minh
```

### Bước 7: Truy cập ứng dụng
Mở trình duyệt: http://localhost/cusc

---

## Cài Đặt Trên Linux

### Bước 1: Cài đặt LAMP Stack

**Ubuntu/Debian:**
```bash
sudo apt update
sudo apt install apache2 mysql-server php php-mysqli php-imap php-curl php-gd php-mbstring php-xml php-zip
sudo apt install composer
```

**CentOS/RHEL:**
```bash
sudo yum install httpd mariadb-server php php-mysqli php-imap php-curl php-gd php-mbstring php-xml php-zip
sudo yum install composer
```

### Bước 2: Clone Source Code
```bash
cd /var/www/html
sudo git clone <repository-url> cusc
sudo chown -R www-data:www-data cusc
sudo chmod -R 755 cusc
```

### Bước 3: Thiết lập permissions
```bash
cd /var/www/html/cusc
sudo chmod -R 775 cache/ storage/ logs/ user_privileges/
```

### Bước 4: Cài đặt Dependencies
```bash
composer install --no-dev --optimize-autoloader
```

### Bước 5: Cấu hình Apache Virtual Host
Tạo file `/etc/apache2/sites-available/cusc.conf`:
```apache
<VirtualHost *:80>
    ServerName crm.yourdomain.com
    DocumentRoot /var/www/html/cusc
    
    <Directory /var/www/html/cusc>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/cusc_error.log
    CustomLog ${APACHE_LOG_DIR}/cusc_access.log combined
</VirtualHost>
```

Enable site:
```bash
sudo a2ensite cusc.conf
sudo a2enmod rewrite
sudo systemctl restart apache2
```

---

## Cấu Hình Database

### Tạo Database và User
```sql
CREATE DATABASE cusc_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'cusc_user'@'localhost' IDENTIFIED BY 'your_strong_password';
GRANT ALL PRIVILEGES ON cusc_db.* TO 'cusc_user'@'localhost';
FLUSH PRIVILEGES;
```

### Import Schema
```bash
mysql -u cusc_user -p cusc_db < database/cusc_db.sql
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
| `DB_SERVER` | Database server | `localhost` |
| `DB_PORT` | Database port | `3306` |
| `DB_USERNAME` | Database username | `cusc_user` |
| `DB_PASSWORD` | Database password | `your_password` |
| `DB_NAME` | Database name | `cusc_db` |
| `SITE_URL` | URL của website | `https://crm.yourdomain.com/` |
| `ROOT_DIRECTORY` | Đường dẫn thư mục gốc | `/var/www/html/cusc/` |
| `APPLICATION_UNIQUE_KEY` | Key bảo mật ứng dụng | 32 ký tự ngẫu nhiên |
| `CSRF_SECRET` | CSRF protection key | 40 ký tự ngẫu nhiên |

### Tạo Security Keys
```bash
# Application Unique Key (32 characters)
openssl rand -hex 16

# CSRF Secret (40 characters)
openssl rand -hex 20
```

---

## Cài Đặt Dependencies

### Sử dụng Composer
```bash
# Development
composer install

# Production
composer install --no-dev --optimize-autoloader
```

### Verify Installation
```bash
composer validate
composer dump-autoload
```

---

## Thiết Lập Cron Jobs

### Windows (Task Scheduler)
```batch
schtasks /create /tn "CUSC-CRM-Cron" /tr "C:\xampp\htdocs\cusc\cron\run_all_crons.bat" /sc minute /mo 15 /ru SYSTEM
```

### Linux (Crontab)
```bash
crontab -e
```
Thêm dòng:
```cron
*/15 * * * * cd /var/www/html/cusc && php vtigercron.php > /dev/null 2>&1
```

Xem chi tiết tại: [cron/CRON_SETUP_GUIDE.md](cron/CRON_SETUP_GUIDE.md)

---

## Khắc Phục Sự Cố

### Lỗi Permission Denied
```bash
sudo chown -R www-data:www-data /var/www/html/cusc
sudo chmod -R 755 /var/www/html/cusc
sudo chmod -R 775 cache/ storage/ logs/ user_privileges/
```

### Lỗi PHP Extensions
Kiểm tra extensions:
```bash
php -m | grep -E "mysqli|imap|curl|gd"
```

### Lỗi Database Connection
1. Kiểm tra thông tin trong `.env`
2. Kiểm tra MySQL service đang chạy
3. Test connection:
```bash
mysql -u cusc_user -p -h localhost cusc_db
```

### Lỗi Blank Page / 500 Error
1. Bật debug mode trong `.env`: `DEBUG_MODE=true`
2. Kiểm tra Apache error log:
   - Windows: `C:\xampp\apache\logs\error.log`
   - Linux: `/var/log/apache2/error.log`

### Clear Cache
```bash
# Linux
rm -rf cache/images/* cache/import/* cache/upload/*

# Windows
del /s /q cache\images\* cache\import\* cache\upload\*
```

---

## Hỗ Trợ

Nếu gặp vấn đề, vui lòng:
1. Kiểm tra [FAQ](docs/FAQ.md)
2. Tạo issue trên GitHub
3. Liên hệ email: tuvantuyensinh@cusc.ctu.edu.vn

---

## License
Xem file [LICENSE.txt](LICENSE.txt) để biết thêm chi tiết.
