<?php
/* Smarty version 4.5.5, created on 2025-10-02 09:01:24
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\MailConverter\Step1.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68de3f64105dd4_83664991',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8227aa13cc8e1c300f58b5bec22e97000fe8526a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\MailConverter\\Step1.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68de3f64105dd4_83664991 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="block fieldBlockContainer"><form class="form-horizontal" id="mailBoxEditView" name="step1"><?php $_smarty_tpl->_assignInScope('FIELDS', $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getFields());
if (empty($_smarty_tpl->tpl_vars['RECORD_ID']->value)) {
$_smarty_tpl->_assignInScope('RECORD_EXISTS', false);
} else {
$_smarty_tpl->_assignInScope('RECORD_EXISTS', true);
}
if ($_smarty_tpl->tpl_vars['RECORD_EXISTS']->value) {?><input type="hidden" name="record" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getId();?>
" /><input type="hidden" name="scannerOldName" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getName();?>
" /><?php }?><div class="addMailBoxStep"><div class="row"><table class="table editview-table no-border"><tbody><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FIELDS']->value, 'FIELD_MODEL', false, 'FIELD_NAME');
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_NAME']->value => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value) {
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = false;
if (!$_smarty_tpl->tpl_vars['RECORD_MODEL']->value->isFieldEditable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value)) {
continue 1;
}?><tr><td class="fieldLabel control-label" style="width:25%;"><label><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()) {?> <span class="redColor">*</span><?php }?></label></td><td style="word-wrap:break-word;"><?php $_smarty_tpl->_assignInScope('FIELD_DATA_TYPE', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType());
if ($_smarty_tpl->tpl_vars['FIELD_DATA_TYPE']->value == 'password') {?><input class="fieldValue inputElement" type="password" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getName();?>
" <?php if ($_smarty_tpl->tpl_vars['RECORD_EXISTS']->value) {?> value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get($_smarty_tpl->tpl_vars['FIELD_NAME']->value);?>
" <?php }
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()) {?>data-validation-engine="validate[required]"<?php }?> /><?php } elseif ($_smarty_tpl->tpl_vars['FIELD_DATA_TYPE']->value == 'boolean') {
$_smarty_tpl->_assignInScope('RECORD_ID', $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getId());?><input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getName();?>
" value="0" /><input type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getName();?>
" <?php if (($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getName()) == '1') || (empty($_smarty_tpl->tpl_vars['RECORD_ID']->value))) {?>checked<?php }?> /><?php } elseif ($_smarty_tpl->tpl_vars['FIELD_DATA_TYPE']->value == 'picklist') {
$_smarty_tpl->_assignInScope('PICKLIST_VALUES', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getPickListValues());
$_smarty_tpl->_assignInScope('FIELD_VALUE', $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get($_smarty_tpl->tpl_vars['FIELD_NAME']->value));
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getName() == 'time_zone' && empty($_smarty_tpl->tpl_vars['FIELD_VALUE']->value)) {
$_smarty_tpl->_assignInScope('FIELD_VALUE', " ");
}?><select name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getName();?>
" class="select2 fieldValue inputElement"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getName() == 'time_zone') {?>data-dropdownCssClass="select2-drop-above"<?php }?>><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getName() == 'time_zone') {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value, 'PICKLIST_VALUE', false, 'PICKLIST_KEY');
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_KEY']->value => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value) {
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['PICKLIST_KEY']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['FIELD_VALUE']->value == $_smarty_tpl->tpl_vars['PICKLIST_KEY']->value) {?> selected <?php }?> ><?php echo vtranslate($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
} else {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value, 'PICKLIST_VALUE', false, 'PICKLIST_KEY');
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_KEY']->value => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value) {
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['PICKLIST_KEY']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get($_smarty_tpl->tpl_vars['FIELD_NAME']->value) == $_smarty_tpl->tpl_vars['PICKLIST_KEY']->value) {?> selected <?php }?> ><?php echo $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value;?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?></select><?php } elseif ($_smarty_tpl->tpl_vars['FIELD_DATA_TYPE']->value == 'radio') {
$_smarty_tpl->_assignInScope('RADIO_OPTIONS', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getRadioOptions());
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RADIO_OPTIONS']->value, 'RADIO_VALUE', false, 'RADIO_NAME');
$_smarty_tpl->tpl_vars['RADIO_VALUE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['RADIO_NAME']->value => $_smarty_tpl->tpl_vars['RADIO_VALUE']->value) {
$_smarty_tpl->tpl_vars['RADIO_VALUE']->do_else = false;
?><label class="radioOption inline"><input class="radioOption" type="radio" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getName();?>
" value="<?php echo $_smarty_tpl->tpl_vars['RADIO_NAME']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['RECORD_EXISTS']->value) {
if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get($_smarty_tpl->tpl_vars['FIELD_NAME']->value) == $_smarty_tpl->tpl_vars['RADIO_NAME']->value) {?> checked <?php }
} else {
if ($_smarty_tpl->tpl_vars['RADIO_NAME']->value == 'imap4' || $_smarty_tpl->tpl_vars['RADIO_NAME']->value == 'ssl' || $_smarty_tpl->tpl_vars['RADIO_NAME']->value == 'novalidate-cert') {?> checked <?php }
}?> />&nbsp;<?php echo $_smarty_tpl->tpl_vars['RADIO_VALUE']->value;?>
</label>&nbsp;&nbsp;&nbsp;&nbsp;<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
} else { ?><input type="text" class="fieldValue inputElement" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getName();?>
" <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()) {?>data-validation-engine="validate[required]"<?php }?> value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get($_smarty_tpl->tpl_vars['FIELD_NAME']->value);?>
"/><?php }?></td></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tbody></table></div></div><div class="border1px modal-overlay-footer clearfix"><div class="row clearfix"><div class="textAlignCenter col-lg-12 col-md-12 col-lg-12 "><button type="submit" class="btn btn-success nextStep" onclick="javascript:Settings_MailConverter_Edit_Js.firstStep()"><?php echo vtranslate('LBL_NEXT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button>&nbsp;&nbsp;<a type="reset" class="cancelLink cursorPointer" onclick="javascript:window.history.back();"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div></div></div></form></div></div></div><?php }
}
