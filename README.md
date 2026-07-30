# CRM Demo Source

<p align="center">
  <strong>Source Code Demo — Hệ thống Quản lý Quan hệ Khách hàng</strong><br>
  <em>Portfolio / Demo Project — trích từ dự án thực tế, đã lược bỏ dữ liệu và cấu hình nhạy cảm</em>
</p>

---

> ℹ️ **GHI CHÚ**
>
> Repo này là **bản demo trích từ một dự án CRM thực tế** (dựa trên nền tảng Vtiger CRM mã nguồn mở) mà tôi từng phát triển cho khách hàng.
>
> Vì lý do **bảo mật thông tin khách hàng**, source code, database và cấu hình đầy đủ **không được công khai**. Bản demo này chỉ mang tính minh hoạ, phục vụ mục đích tham khảo.

---

## 📋 Giới Thiệu

Đây là bản rút gọn của một hệ thống CRM (Customer Relationship Management) do tôi tuỳ biến trên nền tảng Vtiger CRM mã nguồn mở, phục vụ cho một đơn vị tư vấn/đào tạo. Công việc thực tế bao gồm tuỳ biến nghiệp vụ, tối ưu hiệu năng, xử lý dữ liệu backend, và bàn giao kỹ thuật.

Do dự án gắn với khách hàng cụ thể, phần source được chia sẻ ở đây **đã được lược bỏ** thông tin cấu hình, dữ liệu, và các phần liên quan trực tiếp đến hạ tầng của khách hàng.

### ⚡ Phạm vi của bản demo này

| Hạng mục | Trạng thái | Lý do |
|----------|------------|-------|
| Database | ❌ Không bao gồm | Chứa dữ liệu khách hàng |
| Cấu hình server / secrets | ❌ Không bao gồm | Bảo mật hạ tầng thực tế |
| Toàn bộ module tuỳ biến | ⚠️ Chỉ trích một phần | Giới hạn theo thỏa thuận với khách hàng |
| Mục đích sử dụng | ✅ Xem tham khảo năng lực kỹ thuật | Portfolio cho nhà tuyển dụng |

## 💼 Về dự án gốc

Dự án gốc là hệ thống CRM tuỳ biến trên nền Vtiger, phục vụ nghiệp vụ tư vấn khách hàng thực tế, bao gồm các phần việc từ tuỳ biến chức năng, tối ưu hiệu năng, đến xử lý dữ liệu và vận hành server. Chi tiết cụ thể có thể trao đổi thêm khi cần.

## 💻 Yêu Cầu Hệ Thống (Tham Khảo)

| Requirement | Version |
|------------|---------|
| PHP | 8.1+ |
| MySQL/MariaDB | 5.7+ / 10.3+ |
| Memory | 512MB+ |
| Web Server | Apache 2.4+ |
| Requirement | Version |
|------------|---------|
| PHP | 8.1+ |
| MySQL/MariaDB | 5.7+ / 10.3+ |
| Memory | 512MB+ |
| Web Server | Apache 2.4+ |

### PHP Extensions cần thiết
### PHP Extensions cần thiết
- mysqli, imap, curl, gd, mbstring, xml, zip, openssl

## 🔧 Cài Đặt (Chỉ Cho Mục Đích Tham Khảo)

> **⚠️ LƯU Ý:** Vì đã lược bỏ database và một số cấu hình, bản demo này **không thể chạy hoàn chỉnh** nếu không bổ sung thêm dữ liệu/config riêng. Phần dưới đây chỉ minh hoạ quy trình cài đặt gốc.

### 1. Clone Repository
```bash
git clone <repository-url>
git clone <repository-url>
```

### 2. Cài đặt Dependencies
```bash
composer install
```

### 3. Cấu hình
### 3. Cấu hình
```bash
cp .env.example .env
cp config.inc.template.php config.inc.php
cp config.csrf-secret.template.php config.csrf-secret.php
```

### 4. Database
> ❌ **Không bao gồm trong repo này** vì lý do bảo mật dữ liệu khách hàng.
> Cần tự tạo database schema nếu muốn thử nghiệm cục bộ.

📖 **Xem thêm:** [INSTALLATION.md](INSTALLATION.md) để biết chi tiết cấu hình.

## 📁 Cấu Trúc Dự Án

```
CRM-Demo/
├── cache/              # Cache files
CRM-Demo/
├── cache/              # Cache files
├── cron/               # Cron job scripts
├── include/            # Core includes
├── includes/           # Additional includes
├── languages/          # Language files (vi_vn, en_us)
├── layouts/            # UI layouts & templates
├── languages/          # Language files (vi_vn, en_us)
├── layouts/            # UI layouts & templates
├── libraries/          # Third-party libraries
├── modules/            # CRM modules
├── vendor/             # Composer packages
├── vendor/             # Composer packages
├── .env.example        # Environment template
├── composer.json       # PHP dependencies
└── README.md           # File này
└── README.md           # File này
```

## ⚖️ Điều Khoản Sử Dụng

1. Source code này được cung cấp **"nguyên trạng" (AS-IS)**, chỉ nhằm mục đích tham khảo năng lực kỹ thuật, không có bảo hành nào.
2. Đây là **bản trích từ dự án freelance thực tế**, đã được điều chỉnh để phù hợp với thỏa thuận bảo mật với khách hàng — **không phải source production đầy đủ**.
3. Không sử dụng repo này để triển khai hệ thống thật; nhiều phần đã bị lược bỏ có chủ đích.
4. Tác giả không chịu trách nhiệm cho bất kỳ vấn đề nào phát sinh từ việc sử dụng bản demo này ngoài mục đích tham khảo.
5. Source code nền tảng gốc (Vtiger CRM) được phát hành dưới [Vtiger Public License](LICENSE.txt).

## 📧 Liên Hệ

- **Email:** nbaocs13@gmail.com

## 📄 License

Nền tảng gốc được phát hành dưới [Vtiger Public License](LICENSE.txt).
Nền tảng gốc được phát hành dưới [Vtiger Public License](LICENSE.txt).

---

<p align="center">
  <strong>📌 Bản demo minh hoạ kinh nghiệm thực tế — chi tiết đầy đủ xin trao đổi trong buổi phỏng vấn</strong>
</p>