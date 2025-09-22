<?php
/* Smarty version 4.5.5, created on 2025-09-20 08:18:16
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Vtiger\Footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68ce63488590a6_56390774',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '10607a63e056f418dba2791790133a4ddee27ded' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Vtiger\\Footer.tpl',
      1 => 1758356280,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68ce63488590a6_56390774 (Smarty_Internal_Template $_smarty_tpl) {
?>
<footer class="app-footer">
	<p>
		Powered by vtiger CRM - <?php echo $_smarty_tpl->tpl_vars['VTIGER_VERSION']->value;?>
&nbsp;&nbsp;© 2004 - <?php echo date('Y');?>
&nbsp;&nbsp;
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
<div id="js_strings" class="hide noprint"><?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['LANGUAGE_STRINGS']->value);?>
</div>
<div id="maxListFieldsSelectionSize" class="hide noprint"><?php echo $_smarty_tpl->tpl_vars['MAX_LISTFIELDS_SELECTION_SIZE']->value;?>
</div>
<div class="modal myModal fade"></div>
<?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( 'JSResources.tpl' )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

<?php echo '<script'; ?>
 type="text/javascript" src="js/vtiger-auto-cron.js?v=<?php echo $_smarty_tpl->tpl_vars['VTIGER_VERSION']->value;?>
"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
// Auto Cron Configuration
if (typeof VtigerAutoCron !== 'undefined' && window.location.pathname.indexOf('index.php') !== -1) {
    console.log('🚀 VTiger Auto Cron: Enabled for this page');
}
<?php echo '</script'; ?>
>

<?php if ($_smarty_tpl->tpl_vars['USER_MODEL']->value->isAdminUser()) {?>
<div id="vtiger-auto-cron-indicator" style="position: fixed; bottom: 10px; right: 10px; background: #2c3e50; color: white; padding: 5px 10px; border-radius: 15px; font-size: 11px; z-index: 9999; cursor: pointer; box-shadow: 0 2px 8px rgba(0,0,0,0.3); display: none;" title="Click to view Auto Cron Controller">
    <span id="cron-status-icon">🔄</span> Auto Cron: <span id="cron-status-text">Loading...</span>
</div>

<?php echo '<script'; ?>
 type="text/javascript">
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
<?php echo '</script'; ?>
>
<?php }?>

</body>

</html>
<?php }
}
