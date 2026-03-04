/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouInstaller license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

let ITS4YouInstaller_Hs = {
	initialize: function() {
		this.registerMenuIcon();
	},
	registerMenuIcon: function() {
		let self = this,
			params = {
				data: {
					module: 'ITS4YouInstaller',
					parent: 'Settings',
					view: 'Reminder',
				}
			};

		app.request.post(params).then(function(error, data) {
			if(!error) {
				let height = jQuery(window).height() / 2 - 100;

				jQuery('#navbar .nav.navbar-nav').prepend(data);
				app.helper.showVerticalScroll(jQuery('.its4you_installer_alerts'), {setHeight: height + 'px'});
				self.updateBadge();
				self.registerMenuClick();
			}
		});
	},
	updateBadge: function() {
		let badge = jQuery('.its4you_installer_badge'),
			new_alerts = jQuery('.installer_new_alert'),
			alerts_len = new_alerts.length;

		if(alerts_len > 0) {
			badge.text(alerts_len);
			badge.removeClass('hide');
			new_alerts.removeClass('installer_new_alert');
		}
	},
	registerMenuClick: function() {
		let self = this;

		jQuery('.its4you_installer_menu .installer_icon').on('click', function() {
			if(!jQuery('.its4you_installer_dropdown').is(':visible')) {
				let params = {
					data: {
						module: 'ITS4YouInstaller',
						parent: 'Settings',
						action: 'Reminder',
						mode: 'UpdateStatus',
					}
				};

				app.request.post(params).then(function(error, data) {
					if(!error) {
						self.updateBadge();
					}
				});
			}
		});
	}
};

ITS4YouInstaller_Hs.initialize();

