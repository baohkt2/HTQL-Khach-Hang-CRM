/**
 * Disable Console Logging for Security
 * =====================================================
 * File này vô hiệu hóa tất cả console logging để bảo mật
 * Thêm file này vào header của trang web để áp dụng
 * 
 * Cách sử dụng:
 * <script src="disable-console-security.js"></script>
 * 
 * Hoặc thêm vào config để chỉ áp dụng trong production
 */

(function() {
    'use strict';
    
    // Kiểm tra nếu đang trong development mode
    // Có thể thay đổi điều kiện này dựa vào cấu hình của bạn
    var isDevelopment = window.location.hostname === 'localhost' || 
                        window.location.hostname === '127.0.0.1' ||
                        window.location.search.indexOf('debug=1') > -1;
    
    // Chỉ vô hiệu hóa console trong production
    if (!isDevelopment) {
        // Tạo một đối tượng console giả để thay thế
        var noOp = function() {};
        
        // Override tất cả các phương thức console
        if (window.console) {
            console.log = noOp;
            console.warn = noOp;
            console.error = noOp;
            console.info = noOp;
            console.debug = noOp;
            console.trace = noOp;
            console.dir = noOp;
            console.dirxml = noOp;
            console.group = noOp;
            console.groupCollapsed = noOp;
            console.groupEnd = noOp;
            console.time = noOp;
            console.timeEnd = noOp;
            console.assert = noOp;
            console.profile = noOp;
        }
        
        // Đảm bảo console object tồn tại ngay cả khi không có
        if (!window.console) {
            window.console = {
                log: noOp,
                warn: noOp,
                error: noOp,
                info: noOp,
                debug: noOp,
                trace: noOp,
                dir: noOp,
                dirxml: noOp,
                group: noOp,
                groupCollapsed: noOp,
                groupEnd: noOp,
                time: noOp,
                timeEnd: noOp,
                assert: noOp,
                profile: noOp
            };
        }
    }
    
    // Log thông báo một lần duy nhất để cho biết console đã bị vô hiệu hóa
    if (!isDevelopment && typeof console !== 'undefined') {
        // Sử dụng setTimeout để đảm bảo message này được hiển thị
        setTimeout(function() {
            try {
                Object.defineProperty(console, '_disabled', {
                    value: true,
                    writable: false
                });
            } catch(e) {}
        }, 0);
    }
})();
