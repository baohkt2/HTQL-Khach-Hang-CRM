# Hướng Dẫn Bảo Mật — CRM Demo

> ⚠️ **Source code này là bản demo dùng cho nghiên cứu cá nhân, chưa được kiểm tra bảo mật đầy đủ.**
> **KHÔNG** sử dụng cho production mà không thực hiện security audit toàn diện.

## 🔐 Bảo Mật Thông Tin Nhạy Cảm

### Nguyên Tắc Chung
1. **KHÔNG BAO GIỜ** commit các file chứa thông tin nhạy cảm lên git
2. Sử dụng file `.env` cho tất cả các cấu hình bí mật
3. Tạo key mới cho mỗi môi trường (dev, staging, production)
4. Thay đổi tất cả mật khẩu mặc định trước khi sử dụng

### Các File Nhạy Cảm Không Được Commit
```
.env
config.inc.php (sau khi đã cấu hình)
config.csrf-secret.php
config.db.php
config.security.php
user_privileges/user_privileges_*.php
```

---

## 🔑 Tạo Security Keys

### Application Unique Key
Khóa 32 ký tự dùng để mã hóa session và các dữ liệu nhạy cảm.

```bash
# Linux/Mac
openssl rand -hex 16

# Windows PowerShell
-join ((1..32) | ForEach-Object { '{0:X}' -f (Get-Random -Maximum 16) })

# PHP
php -r "echo bin2hex(random_bytes(16));"
```

### CSRF Secret Key
Khóa 40 ký tự để bảo vệ chống tấn công CSRF.

```bash
# Linux/Mac
openssl rand -hex 20

# PHP
php -r "echo bin2hex(random_bytes(20));"
```

---

## 🛡️ Cấu Hình Cơ Bản

### 1. Tắt chế độ Debug
Trong `.env`:
```env
DEBUG_MODE=false
```

### 2. Xóa thông tin đăng nhập mặc định
```env
DEFAULT_USER_NAME=
DEFAULT_PASSWORD=
```

### 3. Bảo mật Database
```env
# Sử dụng user riêng, không dùng root
DB_USERNAME=your_app_user
DB_PASSWORD=your_strong_password_here
```

### 4. Sử dụng HTTPS
Đảm bảo `SITE_URL` sử dụng giao thức HTTPS:
```env
SITE_URL=https://your-domain.com/
```

---

## 🔒 Apache Security Headers

Thêm vào `.htaccess` hoặc cấu hình Apache:

```apache
# Các header bảo mật
Header always set X-Content-Type-Options "nosniff"
Header always set X-Frame-Options "SAMEORIGIN"
Header always set X-XSS-Protection "1; mode=block"
Header always set Referrer-Policy "strict-origin-when-cross-origin"
Header always set Content-Security-Policy "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval'; style-src 'self' 'unsafe-inline';"

# Ngăn truy cập các file nhạy cảm
<FilesMatch "^\.env|\.git|composer\.(json|lock)$">
    Order allow,deny
    Deny from all
</FilesMatch>
```

---

## 📝 Checklist Bảo Mật (Tham Khảo)

- [ ] Tạo file `.env` với thông tin phù hợp
- [ ] Tạo `APPLICATION_UNIQUE_KEY` mới
- [ ] Tạo `CSRF_SECRET` mới
- [ ] Đặt mật khẩu database mạnh
- [ ] Xóa `DEFAULT_USER_NAME` và `DEFAULT_PASSWORD`
- [ ] Đặt `DEBUG_MODE=false`
- [ ] Cấu hình HTTPS
- [ ] Kiểm tra quyền truy cập file (permissions)
- [ ] Xóa các file debug/test không cần thiết

---

> ⚠️ **Nhắc lại:** Đây là source demo cho nghiên cứu cá nhân.
> Cần thực hiện kiểm tra bảo mật toàn diện (security audit) trước khi sử dụng trong bất kỳ môi trường nào có dữ liệu thực.
