/**
 * Session Activity Tracker
 * Tracks user activity and auto-updates logout time
 */
(function() {
    'use strict';
    
    var SessionTracker = {
        heartbeatInterval: 60000, // 1 minute
        lastActivityTime: Date.now(),
        heartbeatTimer: null,
        isActive: true,
        
        init: function() {
            this.setupActivityListeners();
            this.startHeartbeat();
            this.setupBeforeUnload();
        },
        
        setupActivityListeners: function() {
            var self = this;
            var events = ['mousedown', 'mousemove', 'keypress', 'scroll', 'touchstart', 'click'];
            
            events.forEach(function(event) {
                document.addEventListener(event, function() {
                    self.lastActivityTime = Date.now();
                    self.isActive = true;
                }, true);
            });
        },
        
        startHeartbeat: function() {
            var self = this;
            
            this.heartbeatTimer = setInterval(function() {
                // Check if user has been inactive for more than 5 minutes
                var inactiveTime = Date.now() - self.lastActivityTime;
                var fiveMinutes = 5 * 60 * 1000;
                
                if (inactiveTime > fiveMinutes && self.isActive) {
                    // User became inactive, update logout time
                    self.isActive = false;
                    self.updateLogoutTime('inactive');
                }
            }, this.heartbeatInterval);
        },
        
        setupBeforeUnload: function() {
            var self = this;
            
            // When user closes tab or navigates away
            window.addEventListener('beforeunload', function(e) {
                self.updateLogoutTime('beforeunload');
            });
            
            // For page visibility API (when tab is hidden)
            document.addEventListener('visibilitychange', function() {
                if (document.hidden) {
                    // Tab is now hidden, might be closing
                    setTimeout(function() {
                        if (document.hidden) {
                            self.updateLogoutTime('hidden');
                        }
                    }, 2000); // Wait 2 seconds to see if really closing
                }
            });
        },
        
        updateLogoutTime: function(reason) {
            // Use sendBeacon for reliable delivery even when page is closing
            if (navigator.sendBeacon) {
                var formData = new FormData();
                formData.append('module', 'Users');
                formData.append('action', 'AutoLogout');
                formData.append('reason', reason);
                
                navigator.sendBeacon('index.php', formData);
            } else {
                // Fallback for older browsers - use synchronous XHR
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
    
    // Make it globally accessible if needed
    window.SessionTracker = SessionTracker;
    
})();
