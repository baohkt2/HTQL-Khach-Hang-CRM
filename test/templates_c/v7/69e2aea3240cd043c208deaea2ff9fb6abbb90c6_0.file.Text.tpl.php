<?php
/* Smarty version 4.5.5, created on 2025-10-08 07:32:22
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Accounts\uitypes\Text.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e613867b2e78_34726996',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '69e2aea3240cd043c208deaea2ff9fb6abbb90c6' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Accounts\\uitypes\\Text.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e613867b2e78_34726996 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('FIELD_INFO', Zend_Json::encode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo()));
$_smarty_tpl->_assignInScope('SPECIAL_VALIDATOR', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getValidator());
$_smarty_tpl->_assignInScope('FIELD_NAME', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName());
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype') == '19' || $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype') == '20') {?><textarea rows="3" class="inputElement textAreaElement col-lg-12 <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isNameField()) {?>nameField<?php }?>" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['FIELD_NAME']->value == "notecontent") {?>id="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
"<?php }?> data-validation-engine="validate[<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory() == true) {?>required,<?php }?>funcCall[Vtiger_Base_Validator_Js.invokeValidation]]" data-fieldinfo='<?php echo $_smarty_tpl->tpl_vars['FIELD_INFO']->value;?>
' <?php if (!empty($_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR']->value)) {?>data-validator=<?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR']->value);
}?>><?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue');?>
</textarea><?php } else { ?><textarea rows="5" class="inputElement <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isNameField()) {?>nameField<?php }?>" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
" data-validation-engine="validate[<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory() == true) {?>required,<?php }?>funcCall[Vtiger_Base_Validator_Js.invokeValidation]]" data-fieldinfo='<?php echo $_smarty_tpl->tpl_vars['FIELD_INFO']->value;?>
' <?php if (!empty($_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR']->value)) {?>data-validator=<?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR']->value);
}?>><?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue');?>
</textarea><?php if ($_smarty_tpl->tpl_vars['MODULE_NAME']->value != 'Webforms' && $_smarty_tpl->tpl_vars['REQ']->value->get('view') != 'Detail') {
if ($_smarty_tpl->tpl_vars['FIELD_NAME']->value == "bill_street") {?><div><a class="cursorPointer" name="copyAddress" data-target="shipping"><?php echo vtranslate('LBL_COPY_SHIPPING_ADDRESS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div><?php } elseif ($_smarty_tpl->tpl_vars['FIELD_NAME']->value == "ship_street") {?><div><a class="cursorPointer" name="copyAddress" data-target="billing"><?php echo vtranslate('LBL_COPY_BILLING_ADDRESS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div><?php }
}
}
}
}
