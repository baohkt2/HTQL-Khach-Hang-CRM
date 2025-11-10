<?php
/* Smarty version 4.5.5, created on 2025-11-10 06:56:30
  from 'C:\xampp\htdocs\cusc\layouts\v7\modules\Vtiger\uitypes\DateFieldSearchView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_69118c9ea34c78_43584079',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '40eb36bfeb1ff13716cb5658a80fffb0b692d3db' => 
    array (
      0 => 'C:\\xampp\\htdocs\\cusc\\layouts\\v7\\modules\\Vtiger\\uitypes\\DateFieldSearchView.tpl',
      1 => 1762713640,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69118c9ea34c78_43584079 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('FIELD_INFO', Zend_Json::encode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo()));
$_smarty_tpl->_assignInScope('dateFormat', $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('date_format'));?><div class="row-fluid"><input type="text" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
" class="listSearchContributor inputElement dateField" data-date-format="<?php echo $_smarty_tpl->tpl_vars['dateFormat']->value;?>
" data-calendar-type="range" value="<?php if ((isset($_smarty_tpl->tpl_vars['SEARCH_INFO']->value['searchValue']))) {
echo $_smarty_tpl->tpl_vars['SEARCH_INFO']->value['searchValue'];
}?>" data-fieldinfo='<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['FIELD_INFO']->value, ENT_QUOTES, 'UTF-8', true);?>
'  data-field-type="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType();?>
"/></div><?php }
}
