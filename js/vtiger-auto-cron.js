/**
 * ====================================================================
 * VTIGER CRM AUTO CRON TRIGGER SYSTEM
 * ====================================================================
 * 
 * Hệ thống tự động gọi cron job từ JavaScript background
 * Thay thế việc cấu hình Windows Scheduled Task
 */

class VtigerAutoCron {
    constructor() {
        this.baseUrl = window.location.origin + window.location.pathname.replace(/\/[^/]*$/, '');
        this.cronUrl = this.baseUrl + '/vtigercron.php';
        this.appUniqueKey = null;
        this.intervalId = null;
        this.isRunning = false;
        this.defaultFrequency = 5 * 60 * 1000; // 5 phút
        
        this.init();
    }
    
    /**
     * Khởi tạo hệ thống
     */
    async init() {
        console.log('🚀 VtigerAutoCron: Initializing...');
        
        try {
            await this.getAppUniqueKey();
            await this.checkScheduledWorkflows();
            this.startAutoTrigger();
            this.setupEventListeners();
            
            console.log('✅ VtigerAutoCron: Successfully initialized');
        } catch (error) {
            console.error('❌ VtigerAutoCron: Initialization failed:', error);
        }
    }
    
    /**
     * Lấy application unique key từ server
     */
    async getAppUniqueKey() {
        try {
            const response = await fetch(this.baseUrl + '/get_app_key.php');
            const data = await response.json();
            
            if (data.success) {
                this.appUniqueKey = data.app_unique_key;
                console.log('🔑 App Unique Key obtained');
            } else {
                throw new Error('Cannot get app unique key');
            }
        } catch (error) {
            console.warn('⚠️ Cannot get app key via API, trying from page source');
            this.extractKeyFromPage();
        }
    }
    
    /**
     * Trích xuất key từ source code trang
     */
    extractKeyFromPage() {
        // Tìm trong script tags hoặc comments
        const scripts = document.getElementsByTagName('script');
        for (let script of scripts) {
            const content = script.innerHTML || script.textContent;
            const match = content.match(/app_unique_key['"]\s*[:=]\s*['"]([^'"]+)['"]/i);
            if (match) {
                this.appUniqueKey = match[1];
                console.log('🔑 App Unique Key extracted from page');
                return;
            }
        }
        
        // Backup: sử dụng key cố định (không an toàn nhưng hoạt động)
        this.appUniqueKey = '40709172e88b8f6c672bc88408891a3b';
        console.log('🔑 Using fallback app key');
    }
    
    /**
     * Kiểm tra có scheduled workflows không
     */
    async checkScheduledWorkflows() {
        try {
            const response = await fetch(this.baseUrl + '/check_scheduled_workflows.php');
            const data = await response.json();
            
            if (data.hasScheduledWorkflows) {
                console.log(`📋 Found ${data.count} scheduled workflow(s)`);
                return true;
            } else {
                console.log('📋 No scheduled workflows found');
                return false;
            }
        } catch (error) {
            console.warn('⚠️ Cannot check workflows, assuming they exist');
            return true; // Giả sử có để trigger cron
        }
    }
    
    /**
     * Bắt đầu auto trigger
     */
    startAutoTrigger() {
        if (this.intervalId) {
            clearInterval(this.intervalId);
        }
        
        this.intervalId = setInterval(() => {
            this.triggerCron();
        }, this.defaultFrequency);
        
        console.log(`⏰ Auto trigger started (every ${this.defaultFrequency / 1000} seconds)`);
        
        // Trigger ngay lập tức lần đầu
        setTimeout(() => this.triggerCron(), 2000);
    }
    
    /**
     * Dừng auto trigger
     */
    stopAutoTrigger() {
        if (this.intervalId) {
            clearInterval(this.intervalId);
            this.intervalId = null;
            console.log('⏹️ Auto trigger stopped');
        }
    }
    
    /**
     * Trigger cron job
     */
    async triggerCron() {
        if (this.isRunning) {
            console.log('⏳ Cron is already running, skipping...');
            return;
        }
        
        if (!this.appUniqueKey) {
            console.error('❌ No app unique key available');
            return;
        }
        
        this.isRunning = true;
        const startTime = new Date();
        
        try {
            console.log('🔄 Triggering cron job...');
            
            const cronUrlWithKey = `${this.cronUrl}?app_unique_key=${this.appUniqueKey}`;
            
            const response = await fetch(cronUrlWithKey, {
                method: 'GET',
                cache: 'no-cache',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            
            if (response.ok) {
                const text = await response.text();
                const endTime = new Date();
                const duration = endTime - startTime;
                
                console.log(`✅ Cron job completed (${duration}ms)`);
                
                // Log một phần output để debug
                const lines = text.split('\n').slice(0, 5);
                if (lines.length > 0) {
                    console.log('📋 Cron output:', lines.join('\n'));
                }
                
                this.logCronRun(startTime, endTime, 'SUCCESS');
                
            } else {
                throw new Error(`HTTP ${response.status}: ${response.statusText}`);
            }
            
        } catch (error) {
            console.error('❌ Cron job failed:', error);
            this.logCronRun(startTime, new Date(), 'FAILED: ' + error.message);
        } finally {
            this.isRunning = false;
        }
    }
    
    /**
     * Log thông tin chạy cron
     */
    logCronRun(startTime, endTime, status) {
        const logEntry = {
            timestamp: startTime.toISOString(),
            duration: endTime - startTime,
            status: status,
            trigger: 'AUTO_JS'
        };
        
        // Lưu vào localStorage để theo dõi
        const logs = JSON.parse(localStorage.getItem('vtigerCronLogs') || '[]');
        logs.unshift(logEntry);
        
        // Giữ tối đa 50 logs
        if (logs.length > 50) {
            logs.splice(50);
        }
        
        localStorage.setItem('vtigerCronLogs', JSON.stringify(logs));
    }
    
    /**
     * Lấy logs từ localStorage
     */
    getLogs() {
        return JSON.parse(localStorage.getItem('vtigerCronLogs') || '[]');
    }
    
    /**
     * Xóa logs
     */
    clearLogs() {
        localStorage.removeItem('vtigerCronLogs');
        console.log('🗑️ Cron logs cleared');
    }
    
    /**
     * Thiết lập event listeners
     */
    setupEventListeners() {
        // Listen cho page unload để cleanup
        window.addEventListener('beforeunload', () => {
            this.stopAutoTrigger();
        });
        
        // Listen cho visibility change để pause/resume
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                console.log('👁️ Page hidden, continuing cron in background');
            } else {
                console.log('👁️ Page visible, cron running normally');
            }
        });
    }
    
    /**
     * Hiển thị status cho user
     */
    showStatus() {
        const logs = this.getLogs();
        const lastRun = logs[0];
        
        console.group('📊 VtigerAutoCron Status');
        console.log('🔑 App Key:', this.appUniqueKey ? 'Available' : 'Missing');
        console.log('⏰ Auto Trigger:', this.intervalId ? 'Running' : 'Stopped');
        console.log('🔄 Currently Running:', this.isRunning);
        console.log('📋 Frequency:', this.defaultFrequency / 1000, 'seconds');
        
        if (lastRun) {
            console.log('🕐 Last Run:', lastRun.timestamp);
            console.log('📈 Last Status:', lastRun.status);
            console.log('⏱️ Last Duration:', lastRun.duration + 'ms');
        }
        
        console.log('📜 Total Logs:', logs.length);
        console.groupEnd();
        
        return {
            hasKey: !!this.appUniqueKey,
            isAutoRunning: !!this.intervalId,
            isCurrentlyRunning: this.isRunning,
            frequency: this.defaultFrequency / 1000,
            lastRun: lastRun,
            totalLogs: logs.length
        };
    }
}

// Tự động khởi tạo khi page load
let vtigerAutoCron = null;

document.addEventListener('DOMContentLoaded', function() {
    // Chỉ khởi động trên trang chính của vtiger
    if (window.location.pathname.includes('vtigercrm') || 
        window.location.pathname.includes('index.php') ||
        document.querySelector('[name="app_unique_key"]')) {
        
        vtigerAutoCron = new VtigerAutoCron();
        
        // Expose ra global cho debugging
        window.VtigerAutoCron = vtigerAutoCron;
        
        console.log('🎯 VtigerAutoCron is ready! Use VtigerAutoCron.showStatus() to check status');
    }
});

// Service Worker registration nếu hỗ trợ
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/vtigercrm/cron-worker.js')
        .then(registration => {
            console.log('🔧 Cron Service Worker registered:', registration);
        })
        .catch(error => {
            console.log('🔧 Service Worker registration failed:', error);
        });
}