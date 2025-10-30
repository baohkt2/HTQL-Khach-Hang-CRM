<?php
/* Smarty version 4.5.5, created on 2025-09-16 07:17:34
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Vtiger\ListViewPreProcess.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68c90f0e3af465_20909736',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '651252cd943bc218890540aaf9f6eb8d5ab367e0' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Vtiger\\ListViewPreProcess.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:modules/Vtiger/partials/Topbar.tpl' => 1,
  ),
),false)) {
function content_68c90f0e3af465_20909736 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:modules/Vtiger/partials/Topbar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="container-fluid app-nav">
	<div class="row">
		<?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "partials/SidebarHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
		<?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModuleHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
	</div>
</div>
</nav>
<div id='overlayPageContent' class='fade modal overlayPageContent content-area overlay-container-60' tabindex='-1' role='dialog' aria-hidden='true'>
	<div class="data">
	</div>
	<div class="modal-dialog">
	</div>
</div>  
<div class="main-container main-container-<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
">
		<?php $_smarty_tpl->_assignInScope('LEFTPANELHIDE', $_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('leftpanelhide'));?>
		<div id="modnavigator" class="module-nav">
			<div class="hidden-xs hidden-sm mod-switcher-container">
				<?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "partials/Menubar.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
			</div>
		</div>
		<div id="sidebar-essentials" class="sidebar-essentials <?php if ($_smarty_tpl->tpl_vars['LEFTPANELHIDE']->value == '1') {?> hide <?php }?>">
			<?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "partials/SidebarEssentials.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
		</div>
		<div class="listViewPageDiv content-area <?php if ($_smarty_tpl->tpl_vars['LEFTPANELHIDE']->value == '1') {?> full-width <?php }?>" id="listViewContent">

<?php }
}
