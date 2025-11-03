<?php
/* Smarty version 4.5.5, created on 2025-11-02 16:53:12
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Vtiger\PopupNavigation.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_69078c78c02d98_90898051',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'db1d71f1cdaa71f1c4072634e22c8897722432f2' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Vtiger\\PopupNavigation.tpl',
      1 => 1761802269,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69078c78c02d98_90898051 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="col-md-2"><?php if ((isset($_smarty_tpl->tpl_vars['MULTI_SELECT']->value)) && $_smarty_tpl->tpl_vars['MULTI_SELECT']->value) {
if (!empty($_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES']->value)) {?><button class="select btn btn-default" disabled="disabled"><strong><?php echo vtranslate('LBL_ADD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button><?php }
} else { ?>&nbsp;<?php }?></div><div class="col-md-10"><?php $_smarty_tpl->_assignInScope('RECORD_COUNT', $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value);
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "Pagination.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('SHOWPAGEJUMP'=>true), 0, true);
?></div>
<?php }
}
