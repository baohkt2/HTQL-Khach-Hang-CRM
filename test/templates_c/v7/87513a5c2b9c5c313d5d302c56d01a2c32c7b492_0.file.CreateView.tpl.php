<?php
/* Smarty version 4.5.5, created on 2025-09-30 09:04:42
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\Picklist\CreateView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68db9d2a5d57e1_51396524',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '87513a5c2b9c5c313d5d302c56d01a2c32c7b492' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\Picklist\\CreateView.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68db9d2a5d57e1_51396524 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="modalContents"><div class="modal-dialog basicCreateView"><div class='modal-content'><form name="addItemForm" class="form-horizontal" method="post" action="index.php"><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
" /><input type="hidden" name="parent" value="Settings" /><input type="hidden" name="source_module" value="<?php echo $_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value;?>
" /><input type="hidden" name="action" value="SaveAjax" /><input type="hidden" name="mode" value="add" /><input type="hidden" name="picklistName" value="<?php echo $_smarty_tpl->tpl_vars['SELECTED_PICKLIST_FIELDMODEL']->value->get('name');?>
" /><input type="hidden" name="pickListValues" value='<?php echo Vtiger_Util_Helper::toSafeHTML(ZEND_JSON::encode($_smarty_tpl->tpl_vars['SELECTED_PICKLISTFIELD_ALL_VALUES']->value));?>
' /><?php ob_start();
echo vtranslate('LBL_ADD_ITEM_TO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
$_prefixVariable1 = ob_get_clean();
ob_start();
echo vtranslate($_smarty_tpl->tpl_vars['SELECTED_PICKLIST_FIELDMODEL']->value->get('label'),$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value);
$_prefixVariable2 = ob_get_clean();
$_smarty_tpl->_assignInScope('HEADER_TITLE', (($_prefixVariable1).(" ")).($_prefixVariable2));
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0, true);
?><div class="modal-body"><div class="form-group"><div class="control-label col-sm-4 col-xs-4"><?php echo vtranslate('LBL_ITEM_VALUE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<span class="redColor">*</span></div><div class="controls col-sm-3 col-xs-3"><input style="min-width: 220px;" name="newValue" class="form-control select2" data-rule-required="true"/></div></div><?php if ($_smarty_tpl->tpl_vars['SELECTED_PICKLIST_FIELDMODEL']->value->isRoleBased()) {?><div class="form-group"><div class="control-label col-sm-4 col-xs-4"><?php echo vtranslate('LBL_ASSIGN_TO_ROLE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<span class="input-info-addon cursorPointer"><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="bottom" title="<?php echo vtranslate('LBL_ASSIGN_TO_ROLE_INFO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i></span></div><div class="controls col-sm-3 col-xs-3"><select class="rolesList form-control" name="rolesSelected[]" multiple style="min-width: 220px" data-placeholder="<?php echo vtranslate('LBL_CHOOSE_ROLES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"><option value="all" selected><?php echo vtranslate('LBL_ALL_ROLES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ROLES_LIST']->value, 'ROLE');
$_smarty_tpl->tpl_vars['ROLE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ROLE']->value) {
$_smarty_tpl->tpl_vars['ROLE']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['ROLE']->value->get('roleid');?>
"><?php echo $_smarty_tpl->tpl_vars['ROLE']->value->get('rolename');?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></div><div class="input-info-addon cursorPointer" style='line-height: 2;'><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="bottom" title="<?php echo vtranslate('LBL_ASSIGN_TO_ROLE_INFO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i></div></div><?php }?><div class="form-group"><div class="control-label col-sm-4 col-xs-4"><?php echo vtranslate('LBL_SELECT_COLOR',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><div class="controls col-sm-3 col-xs-3"><input type="hidden" name="selectedColor" /><div class="colorPicker"></div></div></div></div><?php ob_start();
echo (isset($_smarty_tpl->tpl_vars['qualifiedName']->value)) ? $_smarty_tpl->tpl_vars['qualifiedName']->value : '';
$_prefixVariable3 = ob_get_clean();
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( 'ModalFooter.tpl',$_prefixVariable3 )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></form></div></div></div><?php }
}
