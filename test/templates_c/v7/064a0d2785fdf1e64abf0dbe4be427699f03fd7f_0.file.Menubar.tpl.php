<?php
/* Smarty version 4.5.5, created on 2025-09-16 07:17:34
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Vtiger\partials\Menubar.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68c90f0e7020b2_87755231',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '064a0d2785fdf1e64abf0dbe4be427699f03fd7f' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Vtiger\\partials\\Menubar.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68c90f0e7020b2_87755231 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['MENU_STRUCTURE']->value) {
$_smarty_tpl->_assignInScope('topMenus', $_smarty_tpl->tpl_vars['MENU_STRUCTURE']->value->getTop());
$_smarty_tpl->_assignInScope('moreMenus', $_smarty_tpl->tpl_vars['MENU_STRUCTURE']->value->getMore());?>

<div id="modules-menu" class="modules-menu">
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['SELECTED_CATEGORY_MENU_LIST']->value, 'moduleModel', false, 'moduleName');
$_smarty_tpl->tpl_vars['moduleModel']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['moduleName']->value => $_smarty_tpl->tpl_vars['moduleModel']->value) {
$_smarty_tpl->tpl_vars['moduleModel']->do_else = false;
?>
		<?php $_smarty_tpl->_assignInScope('translatedModuleLabel', vtranslate($_smarty_tpl->tpl_vars['moduleModel']->value->get('label'),$_smarty_tpl->tpl_vars['moduleName']->value));?>
		<ul title="<?php echo $_smarty_tpl->tpl_vars['translatedModuleLabel']->value;?>
" class="module-qtip">
			<li <?php if ($_smarty_tpl->tpl_vars['MODULE']->value == $_smarty_tpl->tpl_vars['moduleName']->value) {?>class="active"<?php } else { ?>class=""<?php }?>>
				<a href="<?php echo $_smarty_tpl->tpl_vars['moduleModel']->value->getDefaultUrl();?>
&app=<?php echo $_smarty_tpl->tpl_vars['SELECTED_MENU_CATEGORY']->value;?>
">
					<?php echo $_smarty_tpl->tpl_vars['moduleModel']->value->getModuleIcon();?>

					<span><?php echo $_smarty_tpl->tpl_vars['translatedModuleLabel']->value;?>
</span>
				</a>
			</li>
		</ul>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</div>
<?php }
}
}
