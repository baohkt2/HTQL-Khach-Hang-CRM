<?php
/* Smarty version 4.5.5, created on 2025-10-19 14:39:56
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Users\CalendarDetailViewHeader.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68f4f83c9a8910_21751409',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '405d77640a8a7b697b10599fd92169d6d37879dc' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Users\\CalendarDetailViewHeader.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68f4f83c9a8910_21751409 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('MODULE_NAME', $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name'));?><input id="recordId" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getId();?>
" /><div class="detailViewContainer"><div class="detailViewTitle" id="prefPageHeader"></div><div class="detailViewInfo userPreferences row-fluid"><div class="details col-xs-12"><?php }
}
