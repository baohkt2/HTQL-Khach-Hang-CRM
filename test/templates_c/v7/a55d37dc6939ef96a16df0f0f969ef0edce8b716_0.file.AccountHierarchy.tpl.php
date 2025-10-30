<?php
/* Smarty version 4.5.5, created on 2025-10-27 07:00:40
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Accounts\AccountHierarchy.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68ff1898c91861_48161940',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a55d37dc6939ef96a16df0f0f969ef0edce8b716' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Accounts\\AccountHierarchy.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68ff1898c91861_48161940 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="modal-dialog modal-lg"><div id="accountHierarchyContainer" class="modelContainer modal-content" style='min-width:750px'><?php ob_start();
echo vtranslate('LBL_SHOW_ACCOUNT_HIERARCHY',$_smarty_tpl->tpl_vars['MODULE']->value);
$_prefixVariable1 = ob_get_clean();
$_smarty_tpl->_assignInScope('HEADER_TITLE', $_prefixVariable1);
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0, true);
?><div class="modal-body"><div id ="hierarchyScroll" style="margin-right: 8px;"><table class="table table-bordered"><thead><tr class="blockHeader"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ACCOUNT_HIERARCHY']->value['header'], 'HEADERNAME');
$_smarty_tpl->tpl_vars['HEADERNAME']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['HEADERNAME']->value) {
$_smarty_tpl->tpl_vars['HEADERNAME']->do_else = false;
?><th><?php echo vtranslate($_smarty_tpl->tpl_vars['HEADERNAME']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tr></thead><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ACCOUNT_HIERARCHY']->value['entries'], 'ENTRIES');
$_smarty_tpl->tpl_vars['ENTRIES']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ENTRIES']->value) {
$_smarty_tpl->tpl_vars['ENTRIES']->do_else = false;
?><tbody><tr><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ENTRIES']->value, 'LISTFIELDS');
$_smarty_tpl->tpl_vars['LISTFIELDS']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LISTFIELDS']->value) {
$_smarty_tpl->tpl_vars['LISTFIELDS']->do_else = false;
?><td><?php echo $_smarty_tpl->tpl_vars['LISTFIELDS']->value;?>
</td><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tr></tbody><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></table></div></div><div class="modal-footer"><div class="pull-right cancelLinkContainer"><button class="btn btn-primary" type="reset" data-dismiss="modal"><strong><?php echo vtranslate('LBL_CLOSE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button></div></div></div></div><?php }
}
