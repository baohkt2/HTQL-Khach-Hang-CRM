# CRM Demo Source

<p align="center">
  <strong>Source Code Demo — Hệ thống Quản lý Quan hệ Khách hàng</strong><br>
  <em>Customer Relationship Management — Demo / Research Only</em>
</p>

---

> ⚠️ **TUYÊN BỐ MIỄN TRỪ TRÁCH NHIỆM (DISCLAIMER)**
>
> **Source code này chỉ được cung cấp cho mục đích DEMO, THỬ NGHIỆM và NGHIÊN CỨU CÁ NHÂN.**
>
> - ❌ **KHÔNG** phải source code production — đây là bản demo chưa hoàn chỉnh.
> - ❌ **KHÔNG** đi kèm database — source này không bao gồm bất kỳ file cơ sở dữ liệu nào.
> - ❌ **KHÔNG** khuyến khích sử dụng cho môi trường production — source có nhiều lỗi đã biết chưa được sửa.
> - ❌ **KHÔNG** có bất kỳ bảo hành hay cam kết nào về tính ổn định, bảo mật, hoặc tính hoàn chỉnh.
>
> Người sử dụng tự chịu hoàn toàn trách nhiệm khi sử dụng source code này.
> Tác giả/người chia sẻ không chịu trách nhiệm cho bất kỳ thiệt hại, mất mát dữ liệu,
> hoặc vấn đề pháp lý nào phát sinh từ việc sử dụng source code này.

---

## 📋 Giới Thiệu

Đây là source code demo của một hệ thống CRM (Customer Relationship Management) được xây dựng dựa trên nền tảng Vtiger CRM mã nguồn mở. Source code này được chia sẻ **chỉ với mục đích tham khảo, nghiên cứu cá nhân, và học tập**.

### ⚡ Trạng thái Source Code

| Hạng mục | Trạng thái |
|----------|------------|
| Database | ❌ Không bao gồm |
| Bug fixes | ❌ Nhiều lỗi chưa được sửa |
| Security audit | ❌ Chưa được kiểm tra bảo mật |
| Production-ready | ❌ Không phù hợp cho production |
| Mục đích sử dụng | ✅ Demo, thử nghiệm, nghiên cứu cá nhân |

## ✨ Tính Năng (Tham Khảo)

Hệ thống CRM demo có các tính năng tham khảo sau (có thể không hoạt động đầy đủ):

- 📊 **Quản lý Leads & Contacts** — Theo dõi và quản lý thông tin khách hàng
- 📧 **Email Integration** — Tích hợp email
- 📅 **Calendar & Tasks** — Lịch làm việc và quản lý công việc
- 📈 **Reports & Analytics** — Báo cáo và phân tích dữ liệu
- 🔔 **Notifications** — Thông báo và nhắc nhở
- 🔐 **Role-based Access** — Phân quyền theo vai trò
- 🔄 **Workflows** — Tự động hóa quy trình

> **Lưu ý:** Các tính năng trên chỉ mang tính tham khảo. Do không có database đi kèm và nhiều lỗi chưa được sửa, các tính năng có thể không hoạt động hoặc hoạt động không chính xác.

## 💻 Yêu Cầu Hệ Thống (Tham Khảo)

| Requirement | Version |
|------------|---------|
| PHP | 8.1+ |
| MySQL/MariaDB | 5.7+ / 10.3+ |
| Memory | 512MB+ |
| Web Server | Apache 2.4+ |

### PHP Extensions cần thiết
- mysqli, imap, curl, gd, mbstring, xml, zip, openssl

## 🔧 Cài Đặt (Chỉ Cho Mục Đích Thử Nghiệm)

> **⚠️ CẢNH BÁO:** Hướng dẫn này chỉ dành cho mục đích thử nghiệm/nghiên cứu.
> **KHÔNG** sử dụng các bước này để triển khai production.

### 1. Clone Repository
```bash
git clone <repository-url>
```

### 2. Cài đặt Dependencies
```bash
composer install
```

### 3. Cấu hình
```bash
cp .env.example .env
cp config.inc.template.php config.inc.php
cp config.csrf-secret.template.php config.csrf-secret.php
```

### 4. Database
> ❌ **Source code này KHÔNG bao gồm database.**
> Bạn cần tự tạo database schema nếu muốn thử nghiệm.
> Không có file SQL nào được cung cấp.

📖 **Xem thêm:** [INSTALLATION.md](INSTALLATION.md) để biết chi tiết cấu hình.

## 📁 Cấu Trúc Dự Án

```
CRM-Demo/
├── cache/              # Cache files
├── cron/               # Cron job scripts
├── include/            # Core includes
├── includes/           # Additional includes
├── languages/          # Language files (vi_vn, en_us)
├── layouts/            # UI layouts & templates
├── libraries/          # Third-party libraries
├── modules/            # CRM modules
├── vendor/             # Composer packages
├── .env.example        # Environment template
├── composer.json       # PHP dependencies
└── README.md           # File này
```

## ⚖️ Điều Khoản Sử Dụng

1. Source code này được cung cấp **"nguyên trạng" (AS-IS)** không có bất kỳ bảo hành nào, dù rõ ràng hay ngụ ý.
2. Đây là sản phẩm nghiên cứu cá nhân, **không phải sản phẩm thương mại** và không liên kết với bất kỳ tổ chức nào.
3. Việc sử dụng source code này cho bất kỳ mục đích nào ngoài demo/thử nghiệm/nghiên cứu là **không được khuyến khích** và người sử dụng tự chịu mọi rủi ro.
4. Tác giả/người chia sẻ **không chịu trách nhiệm** cho:
   - Mất mát dữ liệu
   - Lỗ hổng bảo mật
   - Thiệt hại tài chính
   - Bất kỳ vấn đề pháp lý nào phát sinh từ việc sử dụng
5. Source code nền tảng gốc (Vtiger CRM) được phát hành dưới [Vtiger Public License](LICENSE.txt).

## 📧 Liên Hệ

- **Email:** nbaocs13@gmail.com

## 📄 License

Nền tảng gốc được phát hành dưới [Vtiger Public License](LICENSE.txt).

---

<p align="center">
  <strong>⚠️ CHỈ SỬ DỤNG CHO MỤC ĐÍCH DEMO / THỬ NGHIỆM / NGHIÊN CỨU CÁ NHÂN ⚠️</strong>
</p>
