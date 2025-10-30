<?php
/* Smarty version 4.5.5, created on 2025-10-14 08:45:22
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Vtiger\ModuleSummaryView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68ee0da201c7f8_34345391',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'caf777171d2ece0e4f3d47fd2380fd3dc92c004c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Vtiger\\ModuleSummaryView.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68ee0da201c7f8_34345391 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="recordDetails">
    <?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( 'DetailViewBlockView.tpl',$_smarty_tpl->tpl_vars['MODULE_NAME']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('RECORD_STRUCTURE'=>$_smarty_tpl->tpl_vars['SUMMARY_RECORD_STRUCTURE']->value,'MODULE_NAME'=>$_smarty_tpl->tpl_vars['MODULE_NAME']->value), 0, true);
?>
</div><?php }
}
