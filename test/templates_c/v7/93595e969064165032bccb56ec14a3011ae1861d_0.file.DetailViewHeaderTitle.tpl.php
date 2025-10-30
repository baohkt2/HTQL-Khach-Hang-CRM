<?php
/* Smarty version 4.5.5, created on 2025-09-16 07:14:40
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Vtiger\DetailViewHeaderTitle.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68c90e6005b364_06558520',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '93595e969064165032bccb56ec14a3011ae1861d' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Vtiger\\DetailViewHeaderTitle.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68c90e6005b364_06558520 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="col-lg-6 col-md-6 col-sm-6"><div class="record-header clearfix"><?php if (!$_smarty_tpl->tpl_vars['MODULE']->value) {
$_smarty_tpl->_assignInScope('MODULE', $_smarty_tpl->tpl_vars['MODULE_NAME']->value);
}?><div class="recordImage bg_<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
 app-<?php echo (isset($_smarty_tpl->tpl_vars['SELECTED_MENU_CATEGORY']->value)) ? $_smarty_tpl->tpl_vars['SELECTED_MENU_CATEGORY']->value : '';?>
"><div class="name"><span><strong><?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getModuleIcon();?>
</strong></span></div></div><div class="recordBasicInfo"><div class="info-row"><h4><span class="recordLabel pushDown" title="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getName();?>
"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getNameFields(), 'NAME_FIELD');
$_smarty_tpl->tpl_vars['NAME_FIELD']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['NAME_FIELD']->value) {
$_smarty_tpl->tpl_vars['NAME_FIELD']->do_else = false;
$_smarty_tpl->_assignInScope('FIELD_MODEL', $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getField($_smarty_tpl->tpl_vars['NAME_FIELD']->value));
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getPermissions()) {?><span class="<?php echo $_smarty_tpl->tpl_vars['NAME_FIELD']->value;?>
"><?php echo decode_html($_smarty_tpl->tpl_vars['RECORD']->value->get($_smarty_tpl->tpl_vars['NAME_FIELD']->value));?>
</span>&nbsp;<?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></span></h4></div><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "DetailViewHeaderFieldsView.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></div></div></div><?php }
}
