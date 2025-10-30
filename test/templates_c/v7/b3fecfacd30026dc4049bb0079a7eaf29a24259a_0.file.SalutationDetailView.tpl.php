<?php
/* Smarty version 4.5.5, created on 2025-10-07 09:13:18
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Vtiger\uitypes\SalutationDetailView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4d9aea90fc6_83321967',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b3fecfacd30026dc4049bb0079a7eaf29a24259a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Vtiger\\uitypes\\SalutationDetailView.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4d9aea90fc6_83321967 (Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['RECORD']->value->getDisplayValue('salutationtype');?>


<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'),$_smarty_tpl->tpl_vars['RECORD']->value->getId(),$_smarty_tpl->tpl_vars['RECORD']->value);
}
}
