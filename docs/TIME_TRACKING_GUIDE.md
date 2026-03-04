# CUSC CRM - Time Tracking & Session Management Documentation

## 📋 Tổng Quan

Hệ thống CUSC CRM có 2 tính năng chính:
1. **Activity Tracking** - Theo dõi hoạt động người dùng trong phiên làm việc
2. **Login/Logout History** - Ghi nhận thời gian đăng nhập/đăng xuất

---

## 🔐 1. SESSION TIMEOUT (Thời gian hết hạn phiên)

### Session Timeout Configuration

**Được cấu hình ở:** PHP `php.ini`

```ini
session.gc_maxlifetime = 1800  ; Default: 30 phút (1800 giây)
```

### Cách tính thời gian session:
```
Session timeout = 1800 giây = 30 phút
```

**Ý nghĩa:**
- Nếu người dùng **không hoạt động** trong vòng **30 phút**, session sẽ bị xóa
- Phiên làm việc tự động kết thúc

### File quản lý session:
- **[includes/http/Session.php](includes/http/Session.php)** - Khởi tạo & quản lý session
- **[libraries/HTTP_Session2/HTTP/Session2.php](libraries/HTTP_Session2/HTTP/Session2.php)** - Logic session core

---

## 📊 2. LOGIN/LOGOUT HISTORY TRACKING

### Database Table: `vtiger_loginhistory`

Cấu trúc lưu trữ:
```sql
CREATE TABLE vtiger_loginhistory (
    login_id        INT PRIMARY KEY AUTO_INCREMENT,
    user_name       VARCHAR(255),           -- Tên đăng nhập
    user_ip         VARCHAR(100),           -- IP address
    login_time      DATETIME,               -- Thời gian đăng nhập
    logout_time     DATETIME,               -- Thời gian đăng xuất
    status          VARCHAR(50),            -- 'Signed in', 'Signed off', 'Session expired'
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Quy trình Tracking

#### **1️⃣ LÚC ĐĂNG NHẬP (Login)**

**File:** [modules/Users/actions/Login.php](modules/Users/actions/Login.php)

```php
// Khi đăng nhập thành công:
$moduleModel = Users_Module_Model::getInstance('Users');
$moduleModel->saveLoginHistory($user->column_fields['user_name']);
```

**Chi tiết lưu:** [modules/Users/models/Module.php - Line 188-200](modules/Users/models/Module.php#L188-L200)

```php
public function saveLoginHistory($username){
    $adb = PearDatabase::getInstance();

    $userIPAddress = $_SERVER['REMOTE_ADDR'];
    $loginTime = date("Y-m-d H:i:s");
    
    // INSERT vào database
    $query = "INSERT INTO vtiger_loginhistory 
              (user_name, user_ip, logout_time, login_time, status) 
              VALUES (?,?,?,?,?)";
    $params = array($username, $userIPAddress, $loginTime, $loginTime, 'Signed in');
    $adb->pquery($query, $params);
    
    // Lưu login_id vào session để theo dõi hoạt động
    $loginId = $adb->getLastInsertID();
    $_SESSION['login_id'] = $loginId;
    $_SESSION['user_name'] = $username;
}
```

**Dữ liệu lưu:**
- `login_time` = Thời gian hiện tại
- `logout_time` = Bằng `login_time` (chưa đăng xuất)
- `status` = "Signed in" (đang đăng nhập)

---

#### **2️⃣ TRONG LÚC HOẠT ĐỘNG (Activity Tracking)**

**File:** [includes/utils/ActivityTracker.php](includes/utils/ActivityTracker.php)

```php
public static function updateActivity() {
    // Gọi trên mỗi request từ người dùng đã đăng nhập
    
    global $adb;
    
    // Lấy login_id từ session
    $loginId = $_SESSION['login_id'];
    $userName = $_SESSION['user_name'];
    
    $currentTime = date('Y-m-d H:i:s');
    
    // Cập nhật/Insert vào activity tracking table
    $updateQuery = "UPDATE vtiger_user_activity_tracking 
                   SET last_activity_time = ?, 
                       updated_at = ? 
                   WHERE login_id = ?";
    $adb->pquery($updateQuery, array($currentTime, $currentTime, $loginId));
}
```

**Database Table:** `vtiger_user_activity_tracking`

```sql
CREATE TABLE vtiger_user_activity_tracking (
    id                  INT PRIMARY KEY AUTO_INCREMENT,
    login_id            INT,                -- Liên kết với vtiger_loginhistory
    user_name           VARCHAR(255),
    last_activity_time  DATETIME,           -- Thời gian hoạt động cuối cùng
    created_at          TIMESTAMP,
    updated_at          TIMESTAMP
);
```

**Mục đích:** Theo dõi thời gian hoạt động thực tế (không chỉ thời gian đăng nhập)

---

#### **3️⃣ LÚC ĐĂNG XUẤT (Logout)**

**File:** [modules/Users/models/Module.php - Line 210-235](modules/Users/models/Module.php#L210-L235)

```php
public function saveLogoutHistory(){
    $adb = PearDatabase::getInstance();

    $userRecordModel = Users_Record_Model::getCurrentUserModel();
    $outtime = date("Y-m-d H:i:s");

    // Tìm login session gần nhất
    $loginIdQuery = "SELECT login_id FROM vtiger_loginhistory 
                     WHERE user_name=? 
                     AND (status='Signed in' OR logout_time = login_time)
                     ORDER BY login_id DESC LIMIT 1";
    $result = $adb->pquery($loginIdQuery, array($userRecordModel->get('user_name')));
    
    if ($adb->num_rows($result) > 0) {
        $loginid = $adb->query_result($result, 0, "login_id");
        
        // Cập nhật logout_time và status
        $query = "UPDATE vtiger_loginhistory 
                  SET logout_time = ?, 
                      status = ? 
                  WHERE login_id = ?";
        $adb->pquery($query, array($outtime, 'Signed off', $loginid));
    }
}
```

**Dữ liệu cập nhật:**
- `logout_time` = Thời gian đăng xuất (thực tế)
- `status` = "Signed off" (đã đăng xuất)

---

## ⏱️ 3. AUTOMATIC SESSION CLEANUP (Tự động dọn dẹp session)

### Cron Job Configuration

**File:** [cron/UpdateExpiredSessions.php](cron/UpdateExpiredSessions.php)

**Chạy:** Mỗi 5-10 phút qua Cron Jobs

```bash
# Chạy thủ công
php cron/UpdateExpiredSessions.php

# Hoặc qua cron schedule
*/10 * * * * cd /var/www/html/cusc && php cron/UpdateExpiredSessions.php
```

### Quy trình xử lý:

```php
// 1. Lấy session timeout từ cấu hình
$sessionTimeout = ini_get('session.gc_maxlifetime'); // 1800 giây = 30 phút

// 2. Tính thời gian cutoff
$cutoffTime = date('Y-m-d H:i:s', time() - $sessionTimeout);
// VD: Nếu hiện tại 14:00, cutoff = 13:30

// 3. Tìm tất cả session hết hạn
$query = "SELECT h.login_id, h.user_name, 
                 COALESCE(t.last_activity_time, h.login_time) as last_activity
          FROM vtiger_loginhistory h
          LEFT JOIN vtiger_user_activity_tracking t ON h.login_id = t.login_id
          WHERE h.status = 'Signed in' 
          AND COALESCE(t.last_activity_time, h.login_time) < ?";

// 4. Cập nhật logout_time = last_activity_time (hoạt động cuối cùng)
// Điều này đảm bảo tracking chính xác thời gian làm việc thực tế

$updateQuery = "UPDATE vtiger_loginhistory 
               SET logout_time = ?, 
                   status = 'Session expired' 
               WHERE login_id = ?";
```

**Ví dụ:** 
- User đăng nhập lúc 12:00
- Lần hoạt động cuối cùng lúc 13:20
- Session expire khi quá 30 phút không hoạt động (13:50)
- Cron job set logout_time = 13:20 (hoạt động cuối)
- **Thời gian làm việc được tính:** 12:00 → 13:20 = 1 giờ 20 phút

---

## 📈 4. TIME WORKING CALCULATION (Tính toán thời gian làm việc)

### Database Query:

**File:** [modules/Settings/LoginHistory/models/ListView.php](modules/Settings/LoginHistory/models/ListView.php)

```sql
SELECT login_id, user_name, user_ip, login_time, logout_time,
       CASE 
           WHEN status = 'Signed in' THEN NULL
           WHEN logout_time IS NULL OR logout_time = '0000-00-00 00:00:00' THEN NULL
           ELSE TIMESTAMPDIFF(SECOND, login_time, logout_time)  -- Tính giây
       END AS duration_seconds
FROM vtiger_loginhistory
```

### Chuyển đổi thời gian:
```
Duration (seconds) → Duration (minutes) → Duration (hours:minutes)

VD: 4800 seconds = 80 minutes = 1 hour 20 minutes
```

---

## 💰 5. SALARY CALCULATION (Tính lương)

### Thông tin cần thiết:
1. **Daily Working Hours** - Giờ làm việc/ngày (8 giờ)
2. **Monthly Salary** - Lương tháng
3. **Actual Working Time** - Thời gian làm việc thực tế (từ tracking)

### Công thức:

```
Hourly Rate = Monthly Salary / (Daily Working Hours × 22 working days)
           = Monthly Salary / 176 hours

Actual Salary = (Actual Working Hours / Daily Working Hours) × Daily Rate
```

**Ví dụ:**
```
- Monthly Salary: 10,000,000 VND
- Daily Working Hours: 8 hours
- Hourly Rate = 10,000,000 / 176 = 56,818 VND/hour

- Nếu làm 7.5 giờ/ngày
- Actual Salary = (7.5 / 8) × (10,000,000 / 22) = 9,375,000 / 22 × 7.5
```

---

## 🔍 6. VIEWS & REPORTS

### Login History View

**Module:** Settings → LoginHistory

**Hiển thị:**
- Login Time
- Logout Time  
- Duration (thời gian làm việc)
- User IP
- Status

### Cách xem:
1. Đăng nhập với tư cách Admin
2. Settings → LoginHistory (hoặc CustomSetup)
3. Xem tất cả login/logout records

---

## ⚙️ 7. CRON JOBS SETUP

### Windows (Task Scheduler):

```batch
schtasks /create /tn "CUSC-UpdateExpiredSessions" ^
  /tr "C:\xampp\htdocs\cusc\cron\UpdateExpiredSessions.bat" ^
  /sc minute /mo 10 /ru SYSTEM
```

### Linux (Crontab):

```bash
# Chạy mỗi 10 phút
*/10 * * * * cd /var/www/html/cusc && php cron/UpdateExpiredSessions.php >> /tmp/cusc_sessions.log 2>&1

# Hoặc mỗi 15 phút
*/15 * * * * cd /var/www/html/cusc && php cron/UpdateExpiredSessions.php
```

---

## 📝 8. TABLES LIÊN QUAN

| Table | Purpose | Key Fields |
|-------|---------|-----------|
| `vtiger_loginhistory` | Ghi nhận login/logout | login_id, user_name, login_time, logout_time, status |
| `vtiger_user_activity_tracking` | Theo dõi hoạt động | login_id, last_activity_time |
| `vtiger_users` | Thông tin người dùng | id, user_name, salary (nếu có) |

---

## 🎯 9. KEY CONFIGURATION

### Sửa đổi Session Timeout:

**File:** `php.ini` hoặc `.htaccess`

```ini
[Session]
session.gc_maxlifetime = 1800        ; 30 phút
session.cookie_lifetime = 0           ; Hết khi đóng browser
session.use_strict_mode = 1           ; Bảo mật cao hơn
```

### Sửa đổi Cron Schedule:

**File:** [cron/UpdateExpiredSessions.php - Line 27-31](cron/UpdateExpiredSessions.php#L27-L31)

```php
// Sửa đây để thay đổi timeout
$sessionTimeout = ini_get('session.gc_maxlifetime');
if (empty($sessionTimeout)) {
    $sessionTimeout = 1800; // Thay đổi giá trị này (giây)
}
```

---

## 📞 SUMMARY

| Thành phần | Vị trí | Mục đích |
|-----------|-------|---------|
| **Session Init** | `includes/http/Session.php` | Khởi tạo session |
| **Login Record** | `modules/Users/actions/Login.php` | Ghi nhận lúc đăng nhập |
| **Activity Track** | `includes/utils/ActivityTracker.php` | Cập nhật hoạt động |
| **Logout Record** | `modules/Users/models/Module.php` | Ghi nhận lúc đăng xuất |
| **Auto Cleanup** | `cron/UpdateExpiredSessions.php` | Tự động cập nhật session hết hạn |
| **View History** | Settings → LoginHistory | Xem báo cáo |

---

## 🔗 Tài liệu liên quan

- [INSTALLATION.md](INSTALLATION.md) - Cài đặt hệ thống
- [SECURITY.md](docs/SECURITY.md) - Bảo mật session
- [cron/CRON_SETUP_GUIDE.md](cron/CRON_SETUP_GUIDE.md) - Hướng dẫn cron jobs
