# Hướng Dẫn Bảo Mật CUSC CRM

## 🔐 Bảo Mật Thông Tin Nhạy Cảm

### Nguyên Tắc Chung
1. **KHÔNG BAO GIỜ** commit các file chứa thông tin nhạy cảm lên git
2. Sử dụng file `.env` cho tất cả các cấu hình bí mật
3. Tạo key mới cho mỗi môi trường (dev, staging, production)
4. Thay đổi tất cả mật khẩu mặc định trước khi đưa lên production

### Các File Nhạy Cảm Không Được Commit
```
.env
config.inc.php (sau khi đã cấu hình)
config.csrf-secret.php
user_privileges/user_privileges_*.php
```

---

## 🔑 Tạo Security Keys

### Application Unique Key
Key 32 ký tự dùng để mã hóa session và các dữ liệu nhạy cảm.

```bash
# Linux/Mac
openssl rand -hex 16

# Windows PowerShell
-join ((1..32) | ForEach-Object { '{0:X}' -f (Get-Random -Maximum 16) })

# PHP
php -r "echo bin2hex(random_bytes(16));"
```

### CSRF Secret Key
Key 40 ký tự cho CSRF protection.

```bash
# Linux/Mac
openssl rand -hex 20

# PHP
php -r "echo bin2hex(random_bytes(20));"
```

---

## 🛡️ Cấu Hình Production

### 1. Tắt Debug Mode
Trong `.env`:
```env
DEBUG_MODE=false
```

### 2. Xóa Default Credentials
```env
DEFAULT_USER_NAME=
DEFAULT_PASSWORD=
```

### 3. Database Security
```env
# Sử dụng user riêng, không dùng root
DB_USERNAME=cusc_app_user
DB_PASSWORD=very_strong_password_here
```

### 4. HTTPS
Đảm bảo `SITE_URL` sử dụng HTTPS:
```env
SITE_URL=https://crm.yourdomain.com/
```

---

## 🔒 Apache Security Headers

Thêm vào `.htaccess` hoặc Apache config:

```apache
# Security Headers
Header always set X-Content-Type-Options "nosniff"
Header always set X-Frame-Options "SAMEORIGIN"
Header always set X-XSS-Protection "1; mode=block"
Header always set Referrer-Policy "strict-origin-when-cross-origin"
Header always set Content-Security-Policy "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval'; style-src 'self' 'unsafe-inline';"

# Prevent access to sensitive files
<FilesMatch "^\.env|\.git|composer\.(json|lock)$">
    Order allow,deny
    Deny from all
</FilesMatch>
```

---

## 📝 Checklist Bảo Mật Trước Khi Deploy

- [ ] Tạo file `.env` với thông tin thật
- [ ] Tạo `APPLICATION_UNIQUE_KEY` mới
- [ ] Tạo `CSRF_SECRET` mới
- [ ] Thay đổi mật khẩu database
- [ ] Xóa `DEFAULT_USER_NAME` và `DEFAULT_PASSWORD`
- [ ] Đặt `DEBUG_MODE=false`
- [ ] Cấu hình HTTPS
- [ ] Kiểm tra file permissions
- [ ] Xóa các file debug/test
- [ ] Backup database trước khi deploy

---

## 🚨 Xử Lý Khi Key Bị Lộ

Nếu phát hiện key đã bị commit lên git:

1. **Ngay lập tức** tạo key mới
2. Cập nhật file `.env` trên server
3. Xóa key cũ khỏi git history:
```bash
git filter-branch --force --index-filter \
  "git rm --cached --ignore-unmatch .env config.inc.php" \
  --prune-empty --tag-name-filter cat -- --all
```
4. Force push:
```bash
git push origin --force --all
```
5. Thông báo cho team và kiểm tra logs

---

## 📞 Liên Hệ Bảo Mật

Nếu phát hiện lỗ hổng bảo mật, vui lòng liên hệ:
- Email: security@cusc.ctu.edu.vn
- **KHÔNG** tạo public issue cho các vấn đề bảo mật
