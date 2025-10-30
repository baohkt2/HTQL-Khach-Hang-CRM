<?php
/* Smarty version 4.5.5, created on 2025-10-25 17:29:50
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\MailConverter\Step3.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68fd090e67b2c1_49301356',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ed55dd675365381d7fb73a0c3364551967077982' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\MailConverter\\Step3.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68fd090e67b2c1_49301356 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="block fieldBlockContainer"><form class="form-horizontal" id="ruleSave" method="post" name="step3"><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
" /><input type="hidden" name="parent" value="Settings" /><input type="hidden" name="action" value="SaveRule" /><input type="hidden" name="scannerId" value="<?php echo $_smarty_tpl->tpl_vars['SCANNER_ID']->value;?>
" /><input type="hidden" name="record" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
" /><div class="addMailBoxStep"><div class="row"><table class="table editview-table no-border"><tbody><?php $_smarty_tpl->_assignInScope('FIELDS', $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getSetupRuleFields());
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FIELDS']->value, 'FIELD_MODEL', false, 'FIELD_NAME');
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_NAME']->value => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value) {
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = false;
?><tr><td class="fieldLabel control-label" style="width:25%; padding-right:20px;"><label><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label><td style="word-wrap:break-word;"><?php $_smarty_tpl->_assignInScope('FIELD_DATA_TYPE', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType());
if ($_smarty_tpl->tpl_vars['FIELD_DATA_TYPE']->value == 'picklist') {
$_smarty_tpl->_assignInScope('PICKLIST_VALUES', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getPickListValues());
if ($_smarty_tpl->tpl_vars['FIELD_NAME']->value == 'subject') {?><select name="subjectop" class="select2 fieldValue inputElement"><option value=""><?php echo vtranslate('LBL_SELECT_OPTION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value, 'PICKLIST_VALUE', false, 'PICKLIST_KEY');
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_KEY']->value => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value) {
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['PICKLIST_KEY']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('subjectop') == $_smarty_tpl->tpl_vars['PICKLIST_KEY']->value) {?> selected <?php }?> ><?php echo $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value;?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select>&nbsp;&nbsp;<input type="text" class="fieldValue inputElement" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getName();?>
" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get($_smarty_tpl->tpl_vars['FIELD_NAME']->value);?>
" style="margin-left: 10px;" /><?php } elseif ($_smarty_tpl->tpl_vars['FIELD_NAME']->value == 'body') {?><select name="bodyop" class="select2 fieldValue inputElement"><option value="" <?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('bodyop') == '') {?>selected<?php }?>><?php echo vtranslate('LBL_SELECT_OPTION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value, 'PICKLIST_VALUE', false, 'PICKLIST_KEY');
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_KEY']->value => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value) {
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['PICKLIST_KEY']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('bodyop') == $_smarty_tpl->tpl_vars['PICKLIST_KEY']->value) {?> selected <?php }?> ><?php echo $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value;?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select><br><br><textarea name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getName();?>
" class="boxSizingBorderBox fieldValue inputElement" style="width:416px;padding: 3px 8px;"><?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get($_smarty_tpl->tpl_vars['FIELD_NAME']->value);?>
</textarea><?php } else { ?><select id="actions" name="action1" class="select2 fieldValue inputElement" style="min-width:220px"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value, 'PICKLIST_VALUE', false, 'PICKLIST_KEY');
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_KEY']->value => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value) {
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['PICKLIST_KEY']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get($_smarty_tpl->tpl_vars['FIELD_NAME']->value) == $_smarty_tpl->tpl_vars['PICKLIST_KEY']->value) {?> selected <?php }?> ><?php echo $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value;?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select><?php }
} elseif ($_smarty_tpl->tpl_vars['FIELD_DATA_TYPE']->value == 'radio') {
$_smarty_tpl->_assignInScope('RADIO_OPTIONS', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getRadioOptions());
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RADIO_OPTIONS']->value, 'RADIO_VALUE', false, 'RADIO_NAME');
$_smarty_tpl->tpl_vars['RADIO_VALUE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['RADIO_NAME']->value => $_smarty_tpl->tpl_vars['RADIO_VALUE']->value) {
$_smarty_tpl->tpl_vars['RADIO_VALUE']->do_else = false;
?><label class="radioOption inline"><input class="radioOption" type="radio" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getName();?>
" value="<?php echo $_smarty_tpl->tpl_vars['RADIO_NAME']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['DEFAULT_MATCH']->value == $_smarty_tpl->tpl_vars['RADIO_NAME']->value) {?> checked <?php }?> /><?php echo $_smarty_tpl->tpl_vars['RADIO_VALUE']->value;?>
</label>&nbsp;&nbsp;&nbsp;&nbsp;<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
} elseif ($_smarty_tpl->tpl_vars['FIELD_DATA_TYPE']->value == 'email') {?><input type="text" class="fieldValue inputElement" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getName();?>
" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get($_smarty_tpl->tpl_vars['FIELD_NAME']->value);?>
" data-validation-engine="validate[funcCall[Vtiger_Email_Validator_Js.invokeValidation]]"/><?php } else { ?><input type="text" class="fieldValue inputElement" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getName();?>
" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get($_smarty_tpl->tpl_vars['FIELD_NAME']->value);?>
"/><?php }?></td></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?><tr id="assignedToBlock"><td class="fieldLabel control-label" style="width:25%; padding-right:20px;"><label><?php echo vtranslate('Assigned To');?>
</label></td><td style="word-wrap:break-word;"><select class="select2 fieldValue inputElement" id="assignedTo" name="assignedTo"><optgroup label="<?php echo vtranslate('LBL_USERS');?>
"><?php $_smarty_tpl->_assignInScope('USERS', $_smarty_tpl->tpl_vars['USER_MODEL']->value->getAccessibleUsersForModule($_smarty_tpl->tpl_vars['MODULE_NAME']->value));
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['USERS']->value, 'OWNER_NAME', false, 'OWNER_ID');
$_smarty_tpl->tpl_vars['OWNER_NAME']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['OWNER_ID']->value => $_smarty_tpl->tpl_vars['OWNER_NAME']->value) {
$_smarty_tpl->tpl_vars['OWNER_NAME']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['OWNER_ID']->value;?>
" data-picklistvalue= '<?php echo $_smarty_tpl->tpl_vars['OWNER_NAME']->value;?>
' <?php if ($_smarty_tpl->tpl_vars['ASSIGNED_USER']->value == $_smarty_tpl->tpl_vars['OWNER_ID']->value) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['OWNER_NAME']->value;?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></optgroup><optgroup label="<?php echo vtranslate('LBL_GROUPS');?>
"><?php $_smarty_tpl->_assignInScope('GROUPS', $_smarty_tpl->tpl_vars['USER_MODEL']->value->getAccessibleGroups());
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['GROUPS']->value, 'OWNER_NAME', false, 'OWNER_ID');
$_smarty_tpl->tpl_vars['OWNER_NAME']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['OWNER_ID']->value => $_smarty_tpl->tpl_vars['OWNER_NAME']->value) {
$_smarty_tpl->tpl_vars['OWNER_NAME']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['OWNER_ID']->value;?>
" data-picklistvalue= '<?php echo $_smarty_tpl->tpl_vars['OWNER_NAME']->value;?>
' <?php if ($_smarty_tpl->tpl_vars['ASSIGNED_USER']->value == $_smarty_tpl->tpl_vars['OWNER_ID']->value) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['OWNER_NAME']->value;?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></optgroup></select></td></tr></tbody></table></div></div><div class="border1px modal-overlay-footer clearfix"><div class="row clearfix"><div class="textAlignCenter col-lg-12 col-md-12 col-lg-12 "><button class="btn btn-danger backStep" type="button" onclick="javascript:window.history.back();"><strong><?php echo vtranslate('LBL_BACK',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></button>&nbsp;&nbsp;<button class="btn btn-success" onclick="javascript:Settings_MailConverter_Edit_Js.thirdStep()"><strong><?php echo vtranslate('LBL_FINISH',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></button><a class="cancelLink" type="reset" onclick="javascript:window.history.go(-3);"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a></div></div></div></form></div></div></div><?php }
}
