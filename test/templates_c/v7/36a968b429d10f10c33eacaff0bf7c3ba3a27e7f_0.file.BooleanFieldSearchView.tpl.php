<?php
/* Smarty version 4.5.5, created on 2025-11-02 07:42:44
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Users\uitypes\BooleanFieldSearchView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_69070b74bca4d8_29169718',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '36a968b429d10f10c33eacaff0bf7c3ba3a27e7f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Users\\uitypes\\BooleanFieldSearchView.tpl',
      1 => 1761802269,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69070b74bca4d8_29169718 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('FIELD_INFO', Zend_Json::encode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo()));
$_smarty_tpl->_assignInScope('SEARCH_VALUES', $_smarty_tpl->tpl_vars['SEARCH_INFO']->value['searchValue']);
$_smarty_tpl->_assignInScope('CHECKED_VALUE', "1");
$_smarty_tpl->_assignInScope('UNCHECKED_VALUE', "0");
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name') == 'is_admin') {
$_smarty_tpl->_assignInScope('CHECKED_VALUE', "on");
$_smarty_tpl->_assignInScope('UNCHECKED_VALUE', "off");
} elseif ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name') == 'is_owner') {
$_smarty_tpl->_assignInScope('UNCHECKED_VALUE', ' ');
}?><div class=""><select class="select2 listSearchContributor" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
" style="width:90px;" data-fieldinfo='<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['FIELD_INFO']->value, ENT_QUOTES, 'UTF-8', true);?>
'><option value=""><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><option value="<?php echo $_smarty_tpl->tpl_vars['CHECKED_VALUE']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['SEARCH_VALUES']->value == $_smarty_tpl->tpl_vars['CHECKED_VALUE']->value) {?> selected<?php }?>><?php echo vtranslate('LBL_YES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><option value="<?php echo $_smarty_tpl->tpl_vars['UNCHECKED_VALUE']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['SEARCH_VALUES']->value == $_smarty_tpl->tpl_vars['UNCHECKED_VALUE']->value) {?> selected<?php }?>><?php echo vtranslate('LBL_NO',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option></select></div><?php }
}
