<?php
/* Smarty version 4.5.5, created on 2025-11-02 16:27:37
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\Workflows\FieldExpressions.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690786791e6895_27813303',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '73322984b83b034232d1b9777631756625405ebc' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\Workflows\\FieldExpressions.tpl',
      1 => 1761802269,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690786791e6895_27813303 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="popupUi modal-dialog modal-md hide" data-backdrop="false"><div class="modal-content"><?php ob_start();
echo vtranslate('LBL_SET_VALUE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
$_prefixVariable3 = ob_get_clean();
$_smarty_tpl->_assignInScope('HEADER_TITLE', $_prefixVariable3);
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0, true);
?><div class="modal-body"><div class="row"><div class="col-sm-4"><select class="textType" style="min-width: 160px;"><option data-ui="textarea" value="rawtext"><?php echo vtranslate('LBL_RAW_TEXT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><option data-ui="textarea" value="fieldname"><?php echo vtranslate('LBL_FIELD_NAME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><option data-ui="textarea" value="expression"><?php echo vtranslate('LBL_EXPRESSION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option></select></div><div class="col-sm-4 hide useFieldContainer"><span name="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name');?>
" class="useFieldElement"><?php $_smarty_tpl->_assignInScope('MODULE_FIELDS', $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getFields());?><select class="useField" data-placeholder="<?php echo vtranslate('LBL_USE_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" style="min-width: 160px;"><option></option><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value, 'FIELDS');
$_smarty_tpl->tpl_vars['FIELDS']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELDS']->value) {
$_smarty_tpl->tpl_vars['FIELDS']->do_else = false;
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FIELDS']->value, 'MODULE_FIELD');
$_smarty_tpl->tpl_vars['MODULE_FIELD']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['MODULE_FIELD']->value) {
$_smarty_tpl->tpl_vars['MODULE_FIELD']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['MODULE_FIELD']->value->get('workflow_columnname');?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_FIELD']->value->get('workflow_columnlabel'),$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name'));?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></span><?php if ((isset($_smarty_tpl->tpl_vars['RELATED_MODULE_MODEL']->value)) && $_smarty_tpl->tpl_vars['RELATED_MODULE_MODEL']->value != '') {?><span name="<?php echo $_smarty_tpl->tpl_vars['RELATED_MODULE_MODEL']->value->get('name');?>
" class="useFieldElement"><?php $_smarty_tpl->_assignInScope('MODULE_FIELDS', $_smarty_tpl->tpl_vars['RELATED_MODULE_MODEL']->value->getFields());?><select class="useField" data-placeholder="<?php echo vtranslate('LBL_USE_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" style="min-width: 160px;"><option></option><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MODULE_FIELDS']->value, 'MODULE_FIELD');
$_smarty_tpl->tpl_vars['MODULE_FIELD']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['MODULE_FIELD']->value) {
$_smarty_tpl->tpl_vars['MODULE_FIELD']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['MODULE_FIELD']->value->getName();?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_FIELD']->value->get('label'),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></span><?php }?></div><div class="col-sm-4 hide useFunctionContainer"><select class="useFunction pull-right" data-placeholder="<?php echo vtranslate('LBL_USE_FUNCTION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" style="min-width: 160px;"><option></option><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FIELD_EXPRESSIONS']->value, 'FIELD_EXPRESSIONS_KEY', false, 'FIELD_EXPRESSION_VALUE');
$_smarty_tpl->tpl_vars['FIELD_EXPRESSIONS_KEY']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_EXPRESSION_VALUE']->value => $_smarty_tpl->tpl_vars['FIELD_EXPRESSIONS_KEY']->value) {
$_smarty_tpl->tpl_vars['FIELD_EXPRESSIONS_KEY']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['FIELD_EXPRESSIONS_KEY']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_EXPRESSION_VALUE']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></div></div><br><div class="row fieldValueContainer"><div class="col-sm-12"><textarea data-textarea="true" class="fieldValue inputElement hide" style="height: inherit;"></textarea></div></div><br><div id="rawtext_help" class="alert alert-info helpmessagebox hide"><p><h5><?php echo vtranslate('LBL_RAW_TEXT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h5></p><p>2000</p><p><?php echo vtranslate('LBL_VTIGER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</p></div><div id="fieldname_help" class="helpmessagebox alert alert-info hide"><p><h5><?php echo vtranslate('LBL_EXAMPLE_FIELD_NAME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h5></p><p><?php echo vtranslate('LBL_ANNUAL_REVENUE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</p><p><?php echo vtranslate('LBL_NOTIFY_OWNER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</p></div><div id="expression_help" class="alert alert-info helpmessagebox hide"><p><h5><?php echo vtranslate('LBL_EXAMPLE_EXPRESSION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h5></p><p><?php echo vtranslate('LBL_ANNUAL_REVENUE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
/12</p><p><?php echo vtranslate('LBL_EXPRESSION_EXAMPLE2',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</p></div></div><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalFooter.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></div></div><div class="clonedPopUp"></div>
<?php }
}
