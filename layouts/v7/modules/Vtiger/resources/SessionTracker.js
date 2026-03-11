/**
 * Session Activity Tracker
 * - Server heartbeat keeps authenticated sessions alive while the user is active.
 * - If the browser tab stays idle for too long, trigger a real sign off.
 */
(function() {
    'use strict';

    var trackerConfig = window.CUSC_SESSION_TRACKER_CONFIG || {};

    var SessionTracker = {
        HEARTBEAT_INTERVAL: Number(trackerConfig.heartbeatIntervalMs) > 0 ? Number(trackerConfig.heartbeatIntervalMs) : 5 * 60 * 1000,
        INACTIVITY_LIMIT: Number(trackerConfig.inactivityLimitMs) > 0 ? Number(trackerConfig.inactivityLimitMs) : 15 * 60 * 1000,
        lastActivityTime: Date.now(),
        heartbeatTimer: null,
        inactivityTimer: null,
        isLoggingOut: false,

        init: function() {
            this.registerActivity();
            this.setupActivityListeners();
            this.setupPageStateListeners();
            this.startServerHeartbeat();
            this.resetInactivityTimer();
            this.setupBeforeUnload();
        },

        setupActivityListeners: function() {
            var self = this;
            var events = ['mousedown', 'mousemove', 'keydown', 'scroll', 'touchstart', 'click'];

            events.forEach(function(eventName) {
                document.addEventListener(eventName, function() {
                    self.registerActivity();
                }, true);
            });
        },

        setupPageStateListeners: function() {
            var self = this;

            document.addEventListener('visibilitychange', function() {
                self.checkInactivity();
            });

            window.addEventListener('focus', function() {
                self.checkInactivity();
            });

            window.addEventListener('pageshow', function() {
                self.checkInactivity();
            });
        },

        registerActivity: function() {
            if (this.isLoggingOut) {
                return;
            }

            this.lastActivityTime = Date.now();
            this.resetInactivityTimer();
        },

        resetInactivityTimer: function() {
            var self = this;
            var remainingMs;

            if (this.inactivityTimer) {
                clearTimeout(this.inactivityTimer);
            }

            remainingMs = this.INACTIVITY_LIMIT - (Date.now() - this.lastActivityTime);
            if (remainingMs <= 0) {
                this.handleInactivityLogout();
                return;
            }

            this.inactivityTimer = window.setTimeout(function() {
                self.handleInactivityLogout();
            }, remainingMs);
        },

        isInactive: function() {
            return (Date.now() - this.lastActivityTime) >= this.INACTIVITY_LIMIT;
        },

        checkInactivity: function() {
            if (this.isLoggingOut) {
                return true;
            }

            if (this.isInactive()) {
                this.handleInactivityLogout();
                return true;
            }

            this.resetInactivityTimer();
            return false;
        },

        startServerHeartbeat: function() {
            var self = this;

            this.heartbeatTimer = window.setInterval(function() {
                if (self.isLoggingOut || self.checkInactivity()) {
                    return;
                }

                if (!document.hidden) {
                    self.sendHeartbeat();
                }
            }, this.HEARTBEAT_INTERVAL);
        },

        sendHeartbeat: function() {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'index.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('module=Users&action=AutoLogout&reason=heartbeat');
        },

        setupBeforeUnload: function() {
            var self = this;

            window.addEventListener('beforeunload', function() {
                if (!self.isLoggingOut) {
                    self.sendLogout('beforeunload');
                }
            });
        },

        handleInactivityLogout: function() {
            var self = this;

            if (this.isLoggingOut) {
                return;
            }

            this.isLoggingOut = true;
            this.destroy();
            this.sendLogout('inactive');

            window.setTimeout(function() {
                window.location.href = 'index.php?module=Users&action=Logout&autoLogout=1';
            }, 150);
        },

        sendLogout: function(reason) {
            if (navigator.sendBeacon) {
                var formData = new FormData();
                formData.append('module', 'Users');
                formData.append('action', 'AutoLogout');
                formData.append('reason', reason);
                navigator.sendBeacon('index.php', formData);
                return;
            }

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'index.php?module=Users&action=AutoLogout', reason === 'beforeunload' ? false : true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('reason=' + encodeURIComponent(reason));
        },

        destroy: function() {
            if (this.heartbeatTimer) {
                clearInterval(this.heartbeatTimer);
                this.heartbeatTimer = null;
            }

            if (this.inactivityTimer) {
                clearTimeout(this.inactivityTimer);
                this.inactivityTimer = null;
            }
        }
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            SessionTracker.init();
        });
    } else {
        SessionTracker.init();
    }

    window.SessionTracker = SessionTracker;
})();
