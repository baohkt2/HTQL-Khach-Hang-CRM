# CUSC CRM

<p align="center">
  <strong>Hệ thống Quản lý Quan hệ Khách hàng - CUSC</strong><br>
  <em>Customer Relationship Management System</em>
</p>

<p align="center">
  <a href="#tính-năng">Tính năng</a> •
  <a href="#yêu-cầu-hệ-thống">Yêu cầu</a> •
  <a href="#cài-đặt-nhanh">Cài đặt</a> •
  <a href="#tài-liệu">Tài liệu</a> •
  <a href="#đóng-góp">Đóng góp</a>
</p>

---

## 📋 Giới Thiệu

CUSC CRM là hệ thống quản lý quan hệ khách hàng được phát triển dựa trên nền tảng Vtiger CRM, tùy chỉnh và tối ưu cho nhu cầu của Trung tâm Công nghệ Phần mềm - Đại học Cần Thơ.

## ✨ Tính Năng

- 📊 **Quản lý Leads & Contacts** - Theo dõi và quản lý thông tin khách hàng
- 📧 **Email Integration** - Tích hợp email, tự động gửi/nhận
- 📅 **Calendar & Tasks** - Lịch làm việc và quản lý công việc
- 📈 **Reports & Analytics** - Báo cáo và phân tích dữ liệu
- 🔔 **Notifications** - Thông báo và nhắc nhở tự động
- 🔐 **Role-based Access** - Phân quyền theo vai trò
- 🔄 **Workflows** - Tự động hóa quy trình làm việc

## 💻 Yêu Cầu Hệ Thống

| Requirement | Minimum | Recommended |
|------------|---------|-------------|
| PHP | 8.1+ | 8.2+ |
| MySQL | 5.7+ | 8.0+ |
| Memory | 512MB | 1GB+ |
| Disk Space | 500MB | 2GB+ |

### PHP Extensions Required
- mysqli, imap, curl, gd, mbstring, xml, zip, openssl

## 🚀 Cài Đặt Nhanh

### 1. Clone Repository
```bash
git clone https://github.com/baohkt2/HTQL-Khach-Hang-CRM.git
cd HTQL-Khach-Hang-CRM
```

### 2. Cài đặt Dependencies
```bash
composer install
```

### 3. Cấu hình Environment
```bash
# Copy file mẫu
cp .env.example .env
cp config.inc.template.php config.inc.php
cp config.csrf-secret.template.php config.csrf-secret.php

# Chỉnh sửa file .env với thông tin của bạn
```

### 4. Tạo Database
```sql
CREATE DATABASE crm CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 5. Import Schema
```bash
mysql -u root -p crm < database/schema.sql
```

### 6. Truy cập
Mở trình duyệt: `http://localhost/HTQL-Khach-Hang-CRM`

📖 **Xem hướng dẫn chi tiết:** [INSTALLATION.md](INSTALLATION.md)

## 📁 Cấu Trúc Dự Án

```
HTQL-Khach-Hang-CRM/
├── cache/              # Cache files (git ignored)
├── cron/               # Cron job scripts
├── database/           # Database schema
├── docs/               # Documentation
├── include/            # Core includes
├── includes/           # Additional includes
├── languages/          # Language files
├── layouts/            # UI layouts
├── libraries/          # Third-party libraries
├── logs/               # Log files (git ignored)
├── modules/            # CRM modules
├── storage/            # File storage (git ignored)
├── vendor/             # Composer packages (git ignored)
├── .env.example        # Environment template
├── config.inc.template.php  # Config template
├── composer.json       # PHP dependencies
└── README.md           # This file
```

## 📚 Tài Liệu

| Tài liệu | Mô tả |
|----------|-------|
| [INSTALLATION.md](INSTALLATION.md) | Hướng dẫn cài đặt chi tiết |
| [docs/SECURITY.md](docs/SECURITY.md) | Hướng dẫn bảo mật |
| [cron/CRON_SETUP_GUIDE.md](cron/CRON_SETUP_GUIDE.md) | Thiết lập Cron Jobs |

## ⚙️ Cấu Hình

### Environment Variables

Tất cả cấu hình nhạy cảm được lưu trong file `.env`:

| Variable | Description |
|----------|-------------|
| `DB_*` | Database connection settings |
| `SITE_URL` | Website URL |
| `APPLICATION_UNIQUE_KEY` | Security key (32 chars) |
| `CSRF_SECRET` | CSRF protection key (40 chars) |

**⚠️ QUAN TRỌNG:** Không bao giờ commit file `.env` lên git!

## 🔐 Bảo Mật

- Tạo key mới cho production: `openssl rand -hex 16`
- Xem [docs/SECURITY.md](docs/SECURITY.md) để biết thêm chi tiết

## 🤝 Đóng Góp

1. Fork repository
2. Tạo branch mới: `git checkout -b feature/your-feature`
3. Commit changes: `git commit -m 'Add some feature'`
4. Push to branch: `git push origin feature/your-feature`
5. Tạo Pull Request

## 📧 Liên Hệ

- **Email:** nbaocs13@gmail.com

## 📄 License

Dự án này được phát hành dưới [Vtiger Public License](LICENSE.txt).

---

<p align="center">
  Made with ❤️ by CUSC Team
</p>

