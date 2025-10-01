// /**
//  * ====================================================================
//  * VTIGER CRON SERVICE WORKER
//  * ====================================================================
//  * 
//  * Service Worker để chạy cron job trong background
//  * Hoạt động ngay cả khi browser tab bị đóng
//  */

// const CACHE_NAME = 'vtiger-cron-v1';
// const CRON_INTERVAL = 5 * 60 * 1000; // 5 phút

// let cronTimer = null;
// let isRunning = false;

// // Install Service Worker
// self.addEventListener('install', function(event) {
//     console.log('🔧 VtigerCron ServiceWorker: Installing...');
//     self.skipWaiting();
// });

// // Activate Service Worker
// self.addEventListener('activate', function(event) {
//     console.log('🔧 VtigerCron ServiceWorker: Activated');
    
//     event.waitUntil(
//         clients.claim().then(() => {
//             startCronTimer();
//         })
//     );
// });

// // Message handling từ main thread
// self.addEventListener('message', function(event) {
//     const { type, data } = event.data;
    
//     switch (type) {
//         case 'START_CRON':
//             startCronTimer();
//             event.ports[0].postMessage({ success: true, message: 'Cron timer started' });
//             break;
            
//         case 'STOP_CRON':
//             stopCronTimer();
//             event.ports[0].postMessage({ success: true, message: 'Cron timer stopped' });
//             break;
            
//         case 'TRIGGER_NOW':
//             triggerCron().then(result => {
//                 event.ports[0].postMessage(result);
//             });
//             break;
            
//         case 'STATUS':
//             event.ports[0].postMessage({
//                 success: true,
//                 isRunning: !!cronTimer,
//                 isExecuting: isRunning,
//                 interval: CRON_INTERVAL
//             });
//             break;
            
//         default:
//             event.ports[0].postMessage({ success: false, message: 'Unknown message type' });
//     }
// });

// /**
//  * Bắt đầu timer tự động
//  */
// function startCronTimer() {
//     if (cronTimer) {
//         clearInterval(cronTimer);
//     }
    
//     cronTimer = setInterval(() => {
//         triggerCron();
//     }, CRON_INTERVAL);
    
//     console.log('⏰ VtigerCron ServiceWorker: Timer started (every', CRON_INTERVAL / 1000, 'seconds)');
    
//     // Trigger ngay lập tức
//     setTimeout(() => triggerCron(), 5000);
// }

// /**
//  * Dừng timer
//  */
// function stopCronTimer() {
//     if (cronTimer) {
//         clearInterval(cronTimer);
//         cronTimer = null;
//         console.log('⏹️ VtigerCron ServiceWorker: Timer stopped');
//     }
// }

// /**
//  * Trigger cron job
//  */
// async function triggerCron() {
//     if (isRunning) {
//         console.log('⏳ VtigerCron ServiceWorker: Already running, skipping...');
//         return { success: false, message: 'Already running' };
//     }
    
//     isRunning = true;
//     const startTime = Date.now();
    
//     try {
//         console.log('🔄 VtigerCron ServiceWorker: Triggering cron...');
        
//         // Lấy app key từ storage hoặc client
//         const appKey = await getAppUniqueKey();
        
//         if (!appKey) {
//             throw new Error('No app unique key available');
//         }
        
//         // Construct cron URL
//         const baseUrl = self.location.origin + self.location.pathname.replace(/\/[^/]*$/, '');
//         const cronUrl = `${baseUrl}/vtigercron.php?app_unique_key=${appKey}`;
        
//         // Gọi cron
//         const response = await fetch(cronUrl, {
//             method: 'GET',
//             cache: 'no-cache',
//             headers: {
//                 'X-Requested-With': 'ServiceWorker'
//             }
//         });
        
//         if (response.ok) {
//             const text = await response.text();
//             const duration = Date.now() - startTime;
            
//             console.log(`✅ VtigerCron ServiceWorker: Completed (${duration}ms)`);
            
//             // Log kết quả
//             logCronRun(startTime, duration, 'SUCCESS');
            
//             // Notify clients
//             notifyClients({
//                 type: 'CRON_COMPLETED',
//                 success: true,
//                 duration: duration,
//                 timestamp: startTime
//             });
            
//             return { success: true, duration: duration };
            
//         } else {
//             throw new Error(`HTTP ${response.status}: ${response.statusText}`);
//         }
        
//     } catch (error) {
//         const duration = Date.now() - startTime;
//         console.error('❌ VtigerCron ServiceWorker: Failed -', error);
        
//         logCronRun(startTime, duration, 'FAILED: ' + error.message);
        
//         // Notify clients
//         notifyClients({
//             type: 'CRON_FAILED',
//             success: false,
//             error: error.message,
//             duration: duration,
//             timestamp: startTime
//         });
        
//         return { success: false, error: error.message };
        
//     } finally {
//         isRunning = false;
//     }
// }

// /**
//  * Lấy app unique key
//  */
// async function getAppUniqueKey() {
//     try {
//         // Thử lấy từ API
//         const response = await fetch('./get_app_key.php', {
//             headers: { 'X-Requested-With': 'ServiceWorker' }
//         });
        
//         if (response.ok) {
//             const data = await response.json();
//             if (data.success) {
//                 return data.app_unique_key;
//             }
//         }
//     } catch (error) {
//         console.warn('Cannot get app key from API:', error);
//     }
    
//     // Fallback key
//     return '40709172e88b8f6c672bc88408891a3b';
// }

// /**
//  * Log cron run
//  */
// function logCronRun(timestamp, duration, status) {
//     const logEntry = {
//         timestamp: new Date(timestamp).toISOString(),
//         duration: duration,
//         status: status,
//         trigger: 'SERVICE_WORKER'
//     };
    
//     // Gửi log tới clients để lưu trong localStorage
//     notifyClients({
//         type: 'LOG_CRON_RUN',
//         logEntry: logEntry
//     });
// }

// /**
//  * Notify tất cả clients
//  */
// async function notifyClients(message) {
//     const clients = await self.clients.matchAll();
//     clients.forEach(client => {
//         client.postMessage(message);
//     });
// }

// // Background sync nếu hỗ trợ
// self.addEventListener('sync', function(event) {
//     if (event.tag === 'vtiger-cron-sync') {
//         event.waitUntil(triggerCron());
//     }
// });

// // Push notification support (optional)
// self.addEventListener('push', function(event) {
//     if (event.data) {
//         const data = event.data.json();
//         if (data.type === 'TRIGGER_CRON') {
//             event.waitUntil(triggerCron());
//         }
//     }
// });

// console.log('🚀 VtigerCron ServiceWorker: Script loaded');