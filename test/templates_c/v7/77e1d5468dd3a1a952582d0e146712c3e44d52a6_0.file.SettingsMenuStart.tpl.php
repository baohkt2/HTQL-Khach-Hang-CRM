<?php
/* Smarty version 4.5.5, created on 2025-11-05 18:16:23
  from 'C:\xampp\htdocs\HTQL-Khach-Hang-CRM-vvan\layouts\v7\modules\Settings\ITS4YouInstaller\SettingsMenuStart.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690b9477dd4af0_67142015',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '77e1d5468dd3a1a952582d0e146712c3e44d52a6' => 
    array (
      0 => 'C:\\xampp\\htdocs\\HTQL-Khach-Hang-CRM-vvan\\layouts\\v7\\modules\\Settings\\ITS4YouInstaller\\SettingsMenuStart.tpl',
      1 => 1762352656,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:modules/Vtiger/partials/Topbar.tpl' => 1,
    'file:modules/Settings/Vtiger/Sidebar.tpl' => 1,
  ),
),false)) {
function content_690b9477dd4af0_67142015 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:modules/Vtiger/partials/Topbar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="container-fluid app-nav">
	<div class="row">
		<?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "partials/SidebarHeader.tpl",$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
		<?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModuleHeader.tpl",$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
	</div>
</div>
</nav>
<div id='overlayPageContent' class='fade modal overlayPageContent content-area overlay-container-300' tabindex='-1' role='dialog' aria-hidden='true'>
	<div class="data">
	</div>
	<div class="modal-dialog">
	</div>
</div>
<?php if ($_smarty_tpl->tpl_vars['FIELDS_INFO']->value != null) {?>
	<?php echo '<script'; ?>
 type="text/javascript">
		var uimeta = (function() {
			var fieldInfo  = <?php echo $_smarty_tpl->tpl_vars['FIELDS_INFO']->value;?>
;
			return {
				field: {
					get: function(name, property) {
						if(name && property === undefined) {
							return fieldInfo[name];
						}
						if(name && property) {
							return fieldInfo[name][property]
						}
					},
					isMandatory : function(name){
						if(fieldInfo[name]) {
							return fieldInfo[name].mandatory;
						}
						return false;
					},
					getType : function(name){
						if(fieldInfo[name]) {
							return fieldInfo[name].type
						}
						return false;
					}
				},
			};
		})();
	<?php echo '</script'; ?>
>
<?php }?>
<div class="main-container clearfix">
	<?php $_smarty_tpl->_assignInScope('LEFTPANELHIDE', $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('leftpanelhide'));?>
	<div class="module-nav clearfix settingsNav" id="modnavigator">
		<div class="hidden-xs hidden-sm height100Per">
			<?php $_smarty_tpl->_subTemplateRender("file:modules/Settings/Vtiger/Sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		</div>
	</div>
	<div class="settingsPageDiv content-area clearfix">

<?php }
}
