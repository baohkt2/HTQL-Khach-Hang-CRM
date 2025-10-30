<?php
/* Smarty version 4.5.5, created on 2025-09-20 08:22:05
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Settings\MailConverter\RuleEditView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68ce642d0e6319_14490298',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ae89139db6c7e7b154150ba477b5e678840dbab4' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Settings\\MailConverter\\RuleEditView.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68ce642d0e6319_14490298 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="modelContainer modal-dialog modal-xs" style="width: 600px;"><div class="modal-content"><form class="form-horizontal" id="ruleSave" method="post" action="index.php"><?php if ($_smarty_tpl->tpl_vars['RECORD_ID']->value) {
ob_start();
echo vtranslate('LBL_EDIT_RULE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
$_prefixVariable1 = ob_get_clean();
$_smarty_tpl->_assignInScope('TITLE', $_prefixVariable1);
} else {
ob_start();
echo vtranslate('LBL_ADD_RULE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
$_prefixVariable2 = ob_get_clean();
$_smarty_tpl->_assignInScope('TITLE', $_prefixVariable2);
}
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('TITLE'=>$_smarty_tpl->tpl_vars['TITLE']->value), 0, true);
?><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
" /><input type="hidden" name="parent" value="Settings" /><input type="hidden" name="action" value="SaveRule" /><input type="hidden" name="scannerId" value="<?php echo $_smarty_tpl->tpl_vars['SCANNER_ID']->value;?>
" /><input type="hidden" name="record" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
" /><div class="addMailBoxStep modal-body"><?php $_smarty_tpl->_assignInScope('FIELDS', $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getSetupRuleFields());?><table class="table editview-table no-border"><tbody><?php $_smarty_tpl->_assignInScope('FIELDS', $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getSetupRuleFields());
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FIELDS']->value, 'FIELD_MODEL', false, 'FIELD_NAME');
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_NAME']->value => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value) {
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = false;
?><tr class="row"><td class="col-lg-2 control-label"><label class="fieldLabel"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label><td class="col-lg-4"><?php $_smarty_tpl->_assignInScope('FIELD_DATA_TYPE', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType());
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
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select>&nbsp;&nbsp;<?php } elseif ($_smarty_tpl->tpl_vars['FIELD_NAME']->value == 'body') {?><select name="bodyop" class="select2 fieldValue inputElement"><option value="" <?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('bodyop') == '') {?>selected<?php }?>><?php echo vtranslate('LBL_SELECT_OPTION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
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
" class="form-control col-sm-12" style="padding: 3px 8px;"><?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get($_smarty_tpl->tpl_vars['FIELD_NAME']->value);?>
</textarea><?php } else { ?><select id="actions" name="action1" class="select2 fieldValue inputElement"><?php
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
" <?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get($_smarty_tpl->tpl_vars['FIELD_NAME']->value) == $_smarty_tpl->tpl_vars['RADIO_NAME']->value) {?> checked <?php }?> /><?php echo $_smarty_tpl->tpl_vars['RADIO_VALUE']->value;?>
</label>&nbsp;&nbsp;&nbsp;&nbsp;<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
} elseif ($_smarty_tpl->tpl_vars['FIELD_DATA_TYPE']->value == 'email') {?><input type="text" class="fieldValue inputElement" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getName();?>
" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get($_smarty_tpl->tpl_vars['FIELD_NAME']->value);?>
" data-validation-engine="validate[funcCall[Vtiger_Email_Validator_Js.invokeValidation]]"/><?php } else { ?><input type="text" class="fieldValue inputElement" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getName();?>
" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get($_smarty_tpl->tpl_vars['FIELD_NAME']->value);?>
"/><?php }?></td><td class="col-lg-4"><?php if ($_smarty_tpl->tpl_vars['FIELD_NAME']->value == 'subject') {?><input type="text" class="fieldValue inputElement" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getName();?>
" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get($_smarty_tpl->tpl_vars['FIELD_NAME']->value);?>
" /><?php }?></td></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?><tr class="row" id="assignedToBlock"><td class="col-lg-2 control-label"><label class="fieldLabel"><?php echo vtranslate('Assigned To');?>
</label></td><td class="col-lg-4"><select class="select2 fieldValue inputElement" id="assignedTo" name="assignedTo"><optgroup label="<?php echo vtranslate('LBL_USERS');?>
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
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></optgroup></select></td><td class="col-lg-4"></td></tr></tbody></table></div><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( 'ModalFooter.tpl',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></form></div></div>
<?php }
}
