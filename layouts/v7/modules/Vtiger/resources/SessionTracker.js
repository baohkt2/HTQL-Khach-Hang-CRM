/**
 * Session Activity Tracker v2
 * - Server heartbeat every 5 min to keep session alive & update ActivityTracker
 * - Only marks "Signed off" on actual tab close (beforeunload)
 * - No false "inactive" logouts
 */
(function() {
    'use strict';
    
    var SessionTracker = {
        HEARTBEAT_INTERVAL: 5 * 60 * 1000, // 5 minutes
        lastActivityTime: Date.now(),
        heartbeatTimer: null,
        
        init: function() {
            this.setupActivityListeners();
            this.startServerHeartbeat();
            this.setupBeforeUnload();
        },
        
        /** Track user activity (mouse, keyboard, touch) */
        setupActivityListeners: function() {
            var self = this;
            var events = ['mousedown', 'keypress', 'scroll', 'touchstart', 'click'];
            
            events.forEach(function(event) {
                document.addEventListener(event, function() {
                    self.lastActivityTime = Date.now();
                }, true);
            });
        },
        
        /**
         * Send a lightweight ping to the server every 5 minutes.
         * This keeps the PHP session file alive (prevents sessionclean from
         * deleting it) AND keeps ActivityTracker.logout_time up-to-date.
         * Only pings if the user was active in the last 30 minutes AND
         * the tab is visible (avoids keeping forgotten tabs alive forever).
         */
        startServerHeartbeat: function() {
            var self = this;
            
            this.heartbeatTimer = setInterval(function() {
                var inactiveMs = Date.now() - self.lastActivityTime;
                var thirtyMinutes = 30 * 60 * 1000;
                
                // Only ping if user was active recently and tab is visible
                if (inactiveMs < thirtyMinutes && !document.hidden) {
                    self.sendHeartbeat();
                }
            }, this.HEARTBEAT_INTERVAL);
        },
        
        /** Ping the server to touch the session */
        sendHeartbeat: function() {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'index.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('module=Users&action=AutoLogout&reason=heartbeat');
        },
        
        /** Only fire AutoLogout (Signed off) when tab is actually closing */
        setupBeforeUnload: function() {
            var self = this;
            
            window.addEventListener('beforeunload', function() {
                self.sendLogout('beforeunload');
            });
        },
        
        /** Send logout beacon (reliable even during page unload) */
        sendLogout: function(reason) {
            if (navigator.sendBeacon) {
                var formData = new FormData();
                formData.append('module', 'Users');
                formData.append('action', 'AutoLogout');
                formData.append('reason', reason);
                navigator.sendBeacon('index.php', formData);
            } else {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'index.php?module=Users&action=AutoLogout', false);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.send('reason=' + reason);
            }
        },
        
        destroy: function() {
            if (this.heartbeatTimer) {
                clearInterval(this.heartbeatTimer);
            }
        }
    };
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            SessionTracker.init();
        });
    } else {
        SessionTracker.init();
    }
    
    window.SessionTracker = SessionTracker;
    
})();
