{strip}
<style>
/* =========================
   GOOGLE FONTS
========================= */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

/* =========================
   CSS VARIABLES
========================= */
:root {
    --primary: #2563eb;
    --primary-dark: #1d4ed8;
    --primary-light: #3b82f6;
    --accent: #06b6d4;
    --success: #10b981;
    --danger: #ef4444;
    --warning: #f59e0b;
    --dark: #0f172a;
    --dark-2: #1e293b;
    --gray-50: #f8fafc;
    --gray-100: #f1f5f9;
    --gray-200: #e2e8f0;
    --gray-300: #cbd5e1;
    --gray-400: #94a3b8;
    --gray-500: #64748b;
    --gray-600: #475569;
    --gray-700: #334155;
    --gray-800: #1e293b;
    --gray-900: #0f172a;
    --radius: 16px;
    --radius-sm: 10px;
    --radius-xs: 8px;
    --shadow-sm: 0 1px 2px rgba(0,0,0,0.05);
    --shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -2px rgba(0,0,0,0.1);
    --shadow-lg: 0 20px 50px -12px rgba(0,0,0,0.25);
    --shadow-xl: 0 25px 60px -15px rgba(0,0,0,0.3);
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* =========================
   RESET & GLOBAL
========================= */
*, *::before, *::after {
    box-sizing: border-box;
}

body {
    min-height: 100vh;
    width: 100%;
    margin: 0;
    padding: 0;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    background: var(--dark);
    overflow-x: hidden;
    -webkit-font-smoothing: antialiased;
}

/* =========================
   ANIMATED BACKGROUND
========================= */
.login-bg {
    position: fixed;
    inset: 0;
    z-index: 0;
    background:
        radial-gradient(ellipse at 15% 25%, rgba(37,99,235,0.25) 0%, transparent 50%),
        radial-gradient(ellipse at 85% 20%, rgba(6,182,212,0.2) 0%, transparent 45%),
        radial-gradient(ellipse at 50% 90%, rgba(139,92,246,0.15) 0%, transparent 50%),
        radial-gradient(ellipse at 70% 60%, rgba(16,185,129,0.1) 0%, transparent 40%),
        linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
}

.login-bg::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.02'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    opacity: 0.5;
}

/* Floating orbs */
.login-bg .orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    animation: floatOrb 20s ease-in-out infinite;
}
.login-bg .orb-1 {
    width: 400px; height: 400px;
    top: -100px; left: -100px;
    background: rgba(37,99,235,0.15);
    animation-delay: 0s;
}
.login-bg .orb-2 {
    width: 350px; height: 350px;
    top: 50%; right: -80px;
    background: rgba(6,182,212,0.12);
    animation-delay: -7s;
    animation-duration: 25s;
}
.login-bg .orb-3 {
    width: 300px; height: 300px;
    bottom: -80px; left: 30%;
    background: rgba(139,92,246,0.1);
    animation-delay: -14s;
    animation-duration: 22s;
}

@keyframes floatOrb {
    0%, 100% { transform: translate(0, 0) scale(1); }
    25% { transform: translate(30px, -30px) scale(1.05); }
    50% { transform: translate(-20px, 20px) scale(0.95); }
    75% { transform: translate(15px, 15px) scale(1.02); }
}

/* =========================
   LAYOUT CONTAINER
========================= */
.login-wrapper {
    position: relative;
    z-index: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    padding: 20px;
}

.login-container {
    display: flex;
    max-width: 1100px;
    width: 100%;
    border-radius: var(--radius);
    overflow: hidden;
    background: rgba(255,255,255,0.03);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255,255,255,0.08);
    box-shadow: var(--shadow-xl);
    animation: cardEntrance 0.8s cubic-bezier(0.16, 1, 0.3, 1);
}

@keyframes cardEntrance {
    from {
        opacity: 0;
        transform: translateY(30px) scale(0.97);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

/* =========================
   LEFT PANEL - BRANDING/MARKETING
========================= */
.login-panel-left {
    flex: 1;
    padding: 50px 45px;
    background: linear-gradient(145deg, rgba(37,99,235,0.08), rgba(6,182,212,0.05));
    border-right: 1px solid rgba(255,255,255,0.06);
    display: flex;
    flex-direction: column;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.login-panel-left::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -30%;
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(37,99,235,0.08), transparent 70%);
    border-radius: 50%;
}

.welcome-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    background: rgba(37,99,235,0.12);
    border: 1px solid rgba(37,99,235,0.2);
    border-radius: 50px;
    color: var(--primary-light);
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 0.5px;
    margin-bottom: 28px;
    width: fit-content;
    animation: fadeInUp 0.6s ease-out 0.2s both;
}

.welcome-badge svg {
    width: 16px;
    height: 16px;
}

.marketing-title {
    font-size: 34px;
    font-weight: 800;
    color: #fff;
    line-height: 1.2;
    margin-bottom: 16px;
    animation: fadeInUp 0.6s ease-out 0.3s both;
}

.marketing-title span {
    background: linear-gradient(135deg, var(--primary-light), var(--accent));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.marketing-description {
    font-size: 15px;
    color: var(--gray-400);
    line-height: 1.7;
    margin-bottom: 36px;
    animation: fadeInUp 0.6s ease-out 0.4s both;
}

.feature-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
    animation: fadeInUp 0.6s ease-out 0.5s both;
}

.feature-card {
    padding: 16px;
    border-radius: var(--radius-sm);
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.06);
    transition: var(--transition);
}

.feature-card:hover {
    background: rgba(255,255,255,0.07);
    border-color: rgba(37,99,235,0.3);
    transform: translateY(-2px);
}

.feature-icon {
    width: 38px;
    height: 38px;
    border-radius: var(--radius-xs);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 10px;
    font-size: 18px;
}

.feature-icon.blue { background: rgba(37,99,235,0.15); }
.feature-icon.cyan { background: rgba(6,182,212,0.15); }
.feature-icon.green { background: rgba(16,185,129,0.15); }
.feature-icon.purple { background: rgba(139,92,246,0.15); }

.feature-card h4 {
    font-size: 14px;
    font-weight: 600;
    color: #fff;
    margin: 0 0 4px;
}

.feature-card p {
    font-size: 12px;
    color: var(--gray-400);
    margin: 0;
    line-height: 1.5;
}

/* =========================
   RIGHT PANEL - LOGIN FORM
========================= */
.login-panel-right {
    width: 440px;
    min-width: 440px;
    padding: 50px 45px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    background: rgba(15,23,42,0.6);
    backdrop-filter: blur(30px);
}

.login-logo {
    display: block;
    max-height: 64px;
    max-width: 160px;
    margin: 0 auto 20px;
    animation: fadeInUp 0.5s ease-out 0.1s both;
}

.login-heading {
    text-align: center;
    margin-bottom: 8px;
    animation: fadeInUp 0.5s ease-out 0.15s both;
}

.login-heading h2 {
    font-size: 24px;
    font-weight: 700;
    color: #fff;
    margin: 0;
}

.login-subheading {
    text-align: center;
    font-size: 14px;
    color: var(--gray-400);
    margin-bottom: 32px;
    animation: fadeInUp 0.5s ease-out 0.2s both;
}

/* Form Fields */
.form-group {
    margin-bottom: 20px;
    animation: fadeInUp 0.5s ease-out 0.25s both;
}

.form-group:nth-child(2) {
    animation-delay: 0.3s;
}

.form-label {
    display: block;
    font-size: 13px;
    font-weight: 500;
    color: var(--gray-300);
    margin-bottom: 8px;
    position: static;
}

.input-wrapper {
    position: relative;
}

.input-wrapper .input-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--gray-500);
    transition: var(--transition);
    pointer-events: none;
}

.input-wrapper .input-icon svg {
    width: 18px;
    height: 18px;
}

.form-input {
    width: 100%;
    padding: 12px 14px 12px 44px;
    font-size: 14px;
    font-family: inherit;
    color: #fff;
    background: rgba(255,255,255,0.06);
    border: 1.5px solid rgba(255,255,255,0.1);
    border-radius: var(--radius-xs);
    outline: none;
    transition: var(--transition);
}

.form-input::placeholder {
    color: var(--gray-500);
}

.form-input:hover {
    border-color: rgba(255,255,255,0.18);
    background: rgba(255,255,255,0.08);
}

.form-input:focus {
    border-color: var(--primary);
    background: rgba(37,99,235,0.06);
    box-shadow: 0 0 0 3px rgba(37,99,235,0.15);
}

.form-input:focus ~ .input-icon,
.form-input:focus + .input-icon {
    color: var(--primary-light);
}

/* Password toggle */
.password-toggle {
    position: absolute;
    right: 14px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: var(--gray-500);
    cursor: pointer;
    padding: 4px;
    transition: var(--transition);
}

.password-toggle:hover {
    color: var(--gray-300);
}

/* Error & Success Messages */
.login-alert {
    padding: 12px 16px;
    border-radius: var(--radius-xs);
    font-size: 13px;
    font-weight: 500;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
    animation: shakeAlert 0.5s ease-out;
}

.login-alert svg {
    width: 18px;
    height: 18px;
    flex-shrink: 0;
}

.login-alert-error {
    background: rgba(239,68,68,0.12);
    border: 1px solid rgba(239,68,68,0.25);
    color: #fca5a5;
}

.login-alert-success {
    background: rgba(16,185,129,0.12);
    border: 1px solid rgba(16,185,129,0.25);
    color: #6ee7b7;
}

@keyframes shakeAlert {
    0%, 100% { transform: translateX(0); }
    20% { transform: translateX(-6px); }
    40% { transform: translateX(6px); }
    60% { transform: translateX(-4px); }
    80% { transform: translateX(4px); }
}

/* Submit Button */
.login-btn {
    width: 100%;
    padding: 13px 24px;
    font-size: 15px;
    font-weight: 600;
    font-family: inherit;
    color: #fff;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    border: none;
    border-radius: var(--radius-xs);
    cursor: pointer;
    transition: var(--transition);
    position: relative;
    overflow: hidden;
    margin-top: 4px;
    animation: fadeInUp 0.5s ease-out 0.35s both;
}

.login-btn::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(255,255,255,0.1), transparent);
    opacity: 0;
    transition: var(--transition);
}

.login-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 8px 25px rgba(37,99,235,0.4);
}

.login-btn:hover::before {
    opacity: 1;
}

.login-btn:active {
    transform: translateY(0);
    box-shadow: 0 4px 12px rgba(37,99,235,0.3);
}

/* Forgot Password */
.login-footer {
    text-align: center;
    margin-top: 24px;
    animation: fadeInUp 0.5s ease-out 0.4s both;
}

.login-footer a {
    font-size: 13px;
    color: var(--gray-400);
    text-decoration: none;
    transition: var(--transition);
}

.login-footer a:hover {
    color: var(--primary-light);
}

/* Copyright */
.login-copyright {
    text-align: center;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid rgba(255,255,255,0.06);
    animation: fadeInUp 0.5s ease-out 0.45s both;
}

.login-copyright p {
    font-size: 11px;
    color: var(--gray-600);
    margin: 0;
}

/* =========================
   ANIMATIONS
========================= */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(15px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* =========================
   RESPONSIVE
========================= */
@media (max-width: 992px) {
    .login-container {
        flex-direction: column;
        max-width: 480px;
    }
    .login-panel-left {
        display: none;
    }
    .login-panel-right {
        width: 100%;
        min-width: auto;
        padding: 40px 32px;
    }
}

@media (max-width: 480px) {
    .login-wrapper {
        padding: 12px;
    }
    .login-panel-right {
        padding: 32px 24px;
    }
    .marketing-title { font-size: 28px; }
    .feature-grid { grid-template-columns: 1fr; }
}
</style>

<!-- Background -->
<div class="login-bg">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>
</div>

<!-- Main Wrapper -->
<div class="login-wrapper">
    <div class="login-container">

        <!-- Left Panel - Marketing -->
        <div class="login-panel-left">
            <div class="welcome-badge">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/>
                </svg>
                HỆ THỐNG QUẢN LÝ KHÁCH HÀNG
            </div>

            <div class="marketing-title">
                Chào mừng đến với<br><span>{$BRANDING.app_name}</span>
            </div>

            <div class="marketing-description">
                Nền tảng quản lý quan hệ khách hàng toàn diện, giúp tổ chức của bạn tối ưu hóa quy trình làm việc và phát triển bền vững.
            </div>

            <div class="feature-grid">
                <div class="feature-card">
                    <div class="feature-icon blue">👥</div>
                    <h4>Quản lý liên hệ</h4>
                    <p>Theo dõi và quản lý thông tin khách hàng, đối tác hiệu quả</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon cyan">📧</div>
                    <h4>Tích hợp Email</h4>
                    <p>Gửi và nhận email trực tiếp trong hệ thống CRM</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon green">📊</div>
                    <h4>Báo cáo thông minh</h4>
                    <p>Phân tích dữ liệu với biểu đồ trực quan, dễ hiểu</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon purple">⚡</div>
                    <h4>Tự động hóa</h4>
                    <p>Quy trình làm việc tự động, tiết kiệm thời gian</p>
                </div>
            </div>
        </div>

        <!-- Right Panel - Login Form -->
        <div class="login-panel-right">
            <img class="login-logo" src="{$BRANDING.app_logo}" alt="{$BRANDING.app_name}">

            <div class="login-heading">
                <h2>Đăng nhập</h2>
            </div>
            <div class="login-subheading">
                Nhập thông tin tài khoản để truy cập hệ thống
            </div>

            {if $ERROR}
                <div class="login-alert login-alert-error">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/>
                    </svg>
                    {$MESSAGE}
                </div>
            {/if}

            {if $MAIL_STATUS}
                <div class="login-alert login-alert-success">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
                    </svg>
                    {$MESSAGE}
                </div>
            {/if}

            <form method="POST" action="index.php" autocomplete="on">
                <input type="hidden" name="module" value="Users">
                <input type="hidden" name="action" value="Login">

                <div class="form-group">
                    <label class="form-label">Tên đăng nhập</label>
                    <div class="input-wrapper">
                        <input type="text"
                               name="username"
                               class="form-input"
                               placeholder="Nhập tên đăng nhập"
                               required
                               autofocus
                               autocomplete="username">
                        <span class="input-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                            </svg>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Mật khẩu</label>
                    <div class="input-wrapper">
                        <input type="password"
                               id="loginPassword"
                               name="password"
                               class="form-input"
                               placeholder="Nhập mật khẩu"
                               required
                               autocomplete="current-password">
                        <span class="input-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                        </span>
                        <button type="button" class="password-toggle" onclick="togglePassword()" tabindex="-1" title="Hiện/Ẩn mật khẩu">
                            <svg id="eyeIcon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="login-btn">
                    Đăng nhập
                </button>
            </form>

            <div class="login-footer">
                <a href="forgotPassword.php">Quên mật khẩu?</a>
            </div>

            <div class="login-copyright">
                <p>&copy; {$smarty.now|date_format:"%Y"} {$BRANDING.app_name}. Bản quyền thuộc CUSC.</p>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    var input = document.getElementById('loginPassword');
    var icon = document.getElementById('eyeIcon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>';
    } else {
        input.type = 'password';
        icon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
    }
}

// Add 'used' class for floating labels if needed
document.querySelectorAll('.form-input').forEach(function(input) {
    input.addEventListener('blur', function() {
        if (this.value) this.classList.add('used');
        else this.classList.remove('used');
    });
});
</script>
{/strip}
