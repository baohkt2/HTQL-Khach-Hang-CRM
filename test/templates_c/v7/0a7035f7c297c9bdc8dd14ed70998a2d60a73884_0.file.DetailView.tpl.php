<?php
/* Smarty version 4.5.5, created on 2025-09-22 08:20:46
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Settings\Webforms\DetailView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68d106de238349_09899641',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0a7035f7c297c9bdc8dd14ed70998a2d60a73884' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Settings\\Webforms\\DetailView.tpl',
      1 => 1758006205,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68d106de238349_09899641 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="detailViewContainer"><div class="col-sm-12"><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "DetailViewHeader.tpl",'Vtiger' )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('MODULE_NAME'=>$_smarty_tpl->tpl_vars['MODULE_NAME']->value), 0, true);
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( 'DetailViewBlockView.tpl','Vtiger' )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('RECORD_STRUCTURE'=>$_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value,'MODULE_NAME'=>$_smarty_tpl->tpl_vars['MODULE_NAME']->value), 0, true);
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( 'FieldsDetailView.tpl',$_smarty_tpl->tpl_vars['MODULE_NAME']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('RECORD_STRUCTURE'=>$_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value,'MODULE_NAME'=>$_smarty_tpl->tpl_vars['MODULE_NAME']->value), 0, true);
?></div></div></div></div><?php }
}
