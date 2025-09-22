{*+**********************************************************************************
* The contents of this file are subject to the vtiger CRM Public License Version 1.1
* ("License"); You may not use this file except in compliance with the License
* The Original Code is: vtiger CRM Open Source
* The Initial Developer of the Original Code is vtiger.
* Portions created by vtiger are Copyright (C) vtiger.
* All Rights Reserved.
************************************************************************************}

<footer class="app-footer">
	<p>
		Powered by vtiger CRM - {$VTIGER_VERSION}&nbsp;&nbsp;© 2004 - {date('Y')}&nbsp;&nbsp;
		<a href="//www.vtiger.com" target="_blank">Vtiger</a>&nbsp;|&nbsp;
		<a href="https://www.vtiger.com/privacy-policy" target="_blank">Privacy Policy</a>
	</p>
</footer>
</div>
<div id='overlayPage'>
	<!-- arrow is added to point arrow to the clicked element (Ex:- TaskManagement), 
	any one can use this by adding "show" class to it -->
	<div class='arrow'></div>
	<div class='data'>
	</div>
</div>
<div id='helpPageOverlay'></div>
<div id="js_strings" class="hide noprint">{Zend_Json::encode($LANGUAGE_STRINGS)}</div>
<div id="maxListFieldsSelectionSize" class="hide noprint">{$MAX_LISTFIELDS_SELECTION_SIZE}</div>
<div class="modal myModal fade"></div>
{include file='JSResources.tpl'|@vtemplate_path}

{* VTiger Auto Cron System - JavaScript Background Service *}
<script type="text/javascript" src="js/vtiger-auto-cron.js?v={$VTIGER_VERSION}"></script>
<script type="text/javascript">
// Auto Cron Configuration
if (typeof VtigerAutoCron !== 'undefined' && window.location.pathname.indexOf('index.php') !== -1) {
    console.log('🚀 VTiger Auto Cron: Enabled for this page');
}
</script>

{* Auto Cron Status Indicator (chỉ hiện cho Admin) *}
{if $USER_MODEL->isAdminUser()}
<div id="vtiger-auto-cron-indicator" style="position: fixed; bottom: 10px; right: 10px; background: #2c3e50; color: white; padding: 5px 10px; border-radius: 15px; font-size: 11px; z-index: 9999; cursor: pointer; box-shadow: 0 2px 8px rgba(0,0,0,0.3); display: none;" title="Click to view Auto Cron Controller">
    <span id="cron-status-icon">🔄</span> Auto Cron: <span id="cron-status-text">Loading...</span>
</div>

<script type="text/javascript">
// Auto Cron Status Indicator cho Admin
(function() {
    let indicator = document.getElementById('vtiger-auto-cron-indicator');
    let statusIcon = document.getElementById('cron-status-icon');
    let statusText = document.getElementById('cron-status-text');
    let isVisible = false;
    
    // Hiển thị indicator sau 5 giây
    setTimeout(function() {
        if (window.VtigerAutoCron) {
            indicator.style.display = 'block';
            isVisible = true;
            updateIndicator();
            
            // Update status mỗi 30 giây
            setInterval(updateIndicator, 30000);
        }
    }, 5000);
    
    function updateIndicator() {
        if (!window.VtigerAutoCron || !isVisible) return;
        
        try {
            const status = window.VtigerAutoCron.showStatus();
            
            if (status.isAutoRunning) {
                statusIcon.textContent = '✅';
                statusText.textContent = 'Running';
                indicator.style.background = '#27ae60';
            } else {
                statusIcon.textContent = '⏸️';
                statusText.textContent = 'Stopped';
                indicator.style.background = '#e74c3c';
            }
            
            if (status.isCurrentlyRunning) {
                statusIcon.textContent = '🔄';
                statusText.textContent = 'Executing...';
                indicator.style.background = '#f39c12';
            }
            
        } catch (error) {
            statusIcon.textContent = '❌';
            statusText.textContent = 'Error';
            indicator.style.background = '#e74c3c';
        }
    }
    
    // Click to open controller
    indicator.addEventListener('click', function() {
        window.open('cron-controller.html', 'CronController', 'width=900,height=700,scrollbars=yes,resizable=yes');
    });
    
    // Hide indicator when clicked outside
    let hideTimer = null;
    document.addEventListener('click', function(e) {
        if (!indicator.contains(e.target)) {
            clearTimeout(hideTimer);
            hideTimer = setTimeout(function() {
                if (isVisible) {
                    indicator.style.opacity = '0.3';
                }
            }, 5000);
        } else {
            clearTimeout(hideTimer);
            indicator.style.opacity = '1';
        }
    });
})();
</script>
{/if}

</body>

</html>
