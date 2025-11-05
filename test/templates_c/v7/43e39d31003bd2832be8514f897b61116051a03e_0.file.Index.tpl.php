<?php
/* Smarty version 4.5.5, created on 2025-11-05 03:58:27
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\ITS4YouCreator\Index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690acb63940ef5_85797502',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '43e39d31003bd2832be8514f897b61116051a03e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\ITS4YouCreator\\Index.tpl',
      1 => 1762116925,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690acb63940ef5_85797502 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="Settings_<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
_Index_View"><div class="listViewContentDiv col-lg-12"><h4><?php echo vtranslate('LBL_MODULE_NAME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 <?php echo vtranslate('LBL_SETTINGS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4><h6><?php echo vtranslate('LBL_CREATOR_DESCRIPTION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h6><hr><form name="linkModulesForm" id="linkModulesForm" method="POST"><table class="table table-bordered equalSplit"><tr><th><?php echo vtranslate('LBL_MODULE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><th style="width: 150px;"><?php echo vtranslate('LBL_CREATOR_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><th style="width: 150px;"><?php echo vtranslate('LBL_MODIFIED_BY_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><th><?php echo vtranslate('LBL_MODULE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><th style="width: 150px;"><?php echo vtranslate('LBL_CREATOR_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><th style="width: 150px;"><?php echo vtranslate('LBL_MODIFIED_BY_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th></tr><?php $_smarty_tpl->_assignInScope('COUNTER', 0);?><tr><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ALL_MODULES']->value, 'MODULE');
$_smarty_tpl->tpl_vars['MODULE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['MODULE']->value) {
$_smarty_tpl->tpl_vars['MODULE']->do_else = false;
$_smarty_tpl->_assignInScope('MODULE_ID', $_smarty_tpl->tpl_vars['MODULE']->value->id);
$_smarty_tpl->_assignInScope('MODULE_NAME', $_smarty_tpl->tpl_vars['MODULE']->value->name);
$_smarty_tpl->_assignInScope('MODULE_LABEL', vtranslate($_smarty_tpl->tpl_vars['MODULE']->value->label,$_smarty_tpl->tpl_vars['MODULE_NAME']->value));
$_smarty_tpl->_assignInScope('CREATOR_ACTIVE', $_smarty_tpl->tpl_vars['ALL_FIELDS']->value[$_smarty_tpl->tpl_vars['MODULE_ID']->value]['creator_active']);
$_smarty_tpl->_assignInScope('MODIFIED_BY_ACTIVE', $_smarty_tpl->tpl_vars['ALL_FIELDS']->value[$_smarty_tpl->tpl_vars['MODULE_ID']->value]['modified_by_active']);
if ($_smarty_tpl->tpl_vars['COUNTER']->value == 2) {
$_smarty_tpl->_assignInScope('COUNTER', 0);?></tr><tr><?php }?><td style="line-height: 1;"><?php echo $_smarty_tpl->tpl_vars['MODULE_LABEL']->value;?>
</td><td style="line-height: 1;"><input type="checkbox" class='its4you_field_checkbox' data-field="creator" data-tab_id="<?php echo $_smarty_tpl->tpl_vars['MODULE_ID']->value;?>
" data-module="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['CREATOR_ACTIVE']->value) {?>checked<?php }?> /></td><td style="line-height: 1;"><input type="checkbox" class='its4you_field_checkbox' data-field="modifiedby" data-tab_id="<?php echo $_smarty_tpl->tpl_vars['MODULE_ID']->value;?>
" data-module="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['MODIFIED_BY_ACTIVE']->value) {?>checked<?php }?> /></td><?php $_smarty_tpl->_assignInScope('COUNTER', $_smarty_tpl->tpl_vars['COUNTER']->value+1);
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tr></table></form></div></div><?php }
}
