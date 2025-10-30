<?php
/* Smarty version 4.5.5, created on 2025-09-16 07:16:08
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Users\uitypes\UserRoleFieldSearchView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68c90eb8eaa096_19922653',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd764ab4a65b6e961db311779a0ade8cdcf8fb3f8' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Users\\uitypes\\UserRoleFieldSearchView.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68c90eb8eaa096_19922653 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('FIELD_INFO', Zend_Json::encode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo()));
$_smarty_tpl->_assignInScope('FIELD_NAME', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name'));
$_smarty_tpl->_assignInScope('ROLES', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getAllRoles());
$_smarty_tpl->_assignInScope('SEARCH_VALUES', explode(',',$_smarty_tpl->tpl_vars['SEARCH_INFO']->value['searchValue']));?>
<div class="select2_search_div">
	<input type="text" class="listSearchContributor inputElement select2_input_element"/>
	<select class="select2 listSearchContributor" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
" multiple data-fieldinfo='<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['FIELD_INFO']->value, ENT_QUOTES, 'UTF-8', true);?>
' style="display:none;">
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ROLES']->value, 'ROLE_ID', false, 'ROLE_NAME');
$_smarty_tpl->tpl_vars['ROLE_ID']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ROLE_NAME']->value => $_smarty_tpl->tpl_vars['ROLE_ID']->value) {
$_smarty_tpl->tpl_vars['ROLE_ID']->do_else = false;
?>
			<option value="<?php echo $_smarty_tpl->tpl_vars['ROLE_NAME']->value;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['ROLE_NAME']->value,$_smarty_tpl->tpl_vars['SEARCH_VALUES']->value) && ($_smarty_tpl->tpl_vars['ROLE_NAME']->value != '')) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['ROLE_NAME']->value;?>
</option>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	</select>
</div>
<?php }
}
