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
        GLOBAL_ACTIVITY_KEY: 'CUSC_SESSION_GLOBAL_ACTIVITY_TS',
        LOGOUT_SIGNAL_KEY: 'CUSC_SESSION_LOGOUT_SIGNAL',
        LOGOUT_SIGNAL_TTL: 10 * 1000,
        tabId: 'tab_' + Math.random().toString(36).slice(2),
        lastActivityTime: Date.now(),
        heartbeatTimer: null,
        inactivityTimer: null,
        isLoggingOut: false,
        storageAvailable: null,

        init: function() {
            this.storageAvailable = this.isStorageAvailable();
            this.seedGlobalActivity();
            this.registerActivity();
            this.setupActivityListeners();
            this.setupCrossTabListeners();
            this.setupPageStateListeners();
            this.startServerHeartbeat();
            this.resetInactivityTimer();
            this.setupBeforeUnload();
        },

        isStorageAvailable: function() {
            if (this.storageAvailable !== null) {
                return this.storageAvailable;
            }

            try {
                var testKey = 'CUSC_SESSION_TRACKER_TEST_KEY';
                window.localStorage.setItem(testKey, '1');
                window.localStorage.removeItem(testKey);
                return true;
            } catch (e) {
                return false;
            }
        },

        seedGlobalActivity: function() {
            var globalTime;

            if (!this.storageAvailable) {
                return;
            }

            globalTime = this.readGlobalActivityTime();
            if (!globalTime) {
                this.writeGlobalActivityTime(this.lastActivityTime);
            }
        },

        readGlobalActivityTime: function() {
            var value;
            var parsedValue;

            if (!this.storageAvailable) {
                return 0;
            }

            try {
                value = window.localStorage.getItem(this.GLOBAL_ACTIVITY_KEY);
                parsedValue = Number(value);
                return parsedValue > 0 ? parsedValue : 0;
            } catch (e) {
                return 0;
            }
        },

        writeGlobalActivityTime: function(timestamp) {
            if (!this.storageAvailable) {
                return;
            }

            try {
                window.localStorage.setItem(this.GLOBAL_ACTIVITY_KEY, String(timestamp));
            } catch (e) {
                // Ignore storage write issues and continue with tab-local tracking.
            }
        },

        getEffectiveLastActivityTime: function() {
            return Math.max(this.lastActivityTime, this.readGlobalActivityTime());
        },

        setupCrossTabListeners: function() {
            var self = this;

            if (!this.storageAvailable) {
                return;
            }

            window.addEventListener('storage', function(event) {
                var newTimestamp;

                if (!event || self.isLoggingOut) {
                    return;
                }

                if (event.key === self.GLOBAL_ACTIVITY_KEY) {
                    newTimestamp = Number(event.newValue);
                    if (newTimestamp > 0) {
                        self.lastActivityTime = Math.max(self.lastActivityTime, newTimestamp);
                        self.resetInactivityTimer();
                    }
                    return;
                }

                if (event.key === self.LOGOUT_SIGNAL_KEY && event.newValue) {
                    self.handleCrossTabLogout(event.newValue);
                }
            });
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
            var now;

            if (this.isLoggingOut) {
                return;
            }

            now = Date.now();
            this.lastActivityTime = now;
            this.writeGlobalActivityTime(now);
            this.resetInactivityTimer();
        },

        resetInactivityTimer: function() {
            var self = this;
            var remainingMs;

            if (this.inactivityTimer) {
                clearTimeout(this.inactivityTimer);
            }

            remainingMs = this.INACTIVITY_LIMIT - (Date.now() - this.getEffectiveLastActivityTime());
            if (remainingMs <= 0) {
                this.handleInactivityLogout();
                return;
            }

            this.inactivityTimer = window.setTimeout(function() {
                self.handleInactivityLogout();
            }, remainingMs);
        },

        isInactive: function() {
            return (Date.now() - this.getEffectiveLastActivityTime()) >= this.INACTIVITY_LIMIT;
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
                self.destroy();
            });
        },

        broadcastLogoutSignal: function() {
            var payload;

            if (!this.storageAvailable) {
                return;
            }

            payload = JSON.stringify({
                tabId: this.tabId,
                timestamp: Date.now()
            });

            try {
                window.localStorage.setItem(this.LOGOUT_SIGNAL_KEY, payload);
            } catch (e) {
                // Ignore storage write issues; server logout still proceeds in this tab.
            }
        },

        handleCrossTabLogout: function(payload) {
            var signal;

            try {
                signal = JSON.parse(payload);
            } catch (e) {
                return;
            }

            if (!signal || !signal.timestamp || signal.tabId === this.tabId) {
                return;
            }

            if ((Date.now() - Number(signal.timestamp)) > this.LOGOUT_SIGNAL_TTL) {
                return;
            }

            if (this.isLoggingOut) {
                return;
            }

            this.isLoggingOut = true;
            this.destroy();
            this.redirectToLogout();
        },

        redirectToLogout: function() {
            window.setTimeout(function() {
                window.location.href = 'index.php?module=Users&action=Logout&autoLogout=1';
            }, 150);
        },

        handleInactivityLogout: function() {
            if (this.isLoggingOut) {
                return;
            }

            if (!this.isInactive()) {
                this.resetInactivityTimer();
                return;
            }

            this.isLoggingOut = true;
            this.destroy();
            this.broadcastLogoutSignal();
            this.sendLogout('inactive');
            this.redirectToLogout();
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
            xhr.open('POST', 'index.php?module=Users&action=AutoLogout', true);
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
