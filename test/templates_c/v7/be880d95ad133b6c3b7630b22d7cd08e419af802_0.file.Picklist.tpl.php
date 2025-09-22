<?php
/* Smarty version 4.5.5, created on 2025-09-19 07:51:01
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Settings\Webforms\uitypes\Picklist.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68cd0b65118142_29361517',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'be880d95ad133b6c3b7630b22d7cd08e419af802' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Settings\\Webforms\\uitypes\\Picklist.tpl',
      1 => 1758006205,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68cd0b65118142_29361517 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.replace.php','function'=>'smarty_modifier_replace',),));
?>

<?php $_smarty_tpl->_assignInScope('FIELD_INFO', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo());
$_smarty_tpl->_assignInScope('PICKLIST_VALUES', $_smarty_tpl->tpl_vars['FIELD_INFO']->value['picklistvalues']);
$_smarty_tpl->_assignInScope('PICKLIST_COLORS', $_smarty_tpl->tpl_vars['FIELD_INFO']->value['picklistColors']);
$_smarty_tpl->_assignInScope('SPECIAL_VALIDATOR', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getValidator());?><select data-fieldname="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
" data-fieldtype="picklist" class="inputElement select2 <?php if ($_smarty_tpl->tpl_vars['OCCUPY_COMPLETE_WIDTH']->value) {?> row <?php }?>" type="picklist" data-field-id= '<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('id');?>
' name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
" <?php if (!empty($_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR']->value)) {?>data-validator='<?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR']->value);?>
'<?php }?> data-selected-value='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue');?>
'<?php if ($_smarty_tpl->tpl_vars['FIELD_INFO']->value["mandatory"] == true) {?> data-rule-required="true" <?php }
if (php7_count($_smarty_tpl->tpl_vars['FIELD_INFO']->value['validator'])) {?>data-specific-rules='<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['FIELD_INFO']->value["validator"]);?>
'<?php }
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName() == 'targetmodule' && $_smarty_tpl->tpl_vars['MODE']->value == 'edit') {?>disabled='disabled'<?php }?>><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isEmptyPicklistOptionAllowed()) {?><option value=""><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><?php }
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value, 'PICKLIST_VALUE', false, 'PICKLIST_NAME');
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_NAME']->value => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value) {
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->do_else = false;
ob_start();
echo smarty_modifier_replace($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value,' ','_');
$_prefixVariable2=ob_get_clean();
$_smarty_tpl->_assignInScope('CLASS_NAME', "picklistColor_".((string)$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName())."_".$_prefixVariable2);?><option value="<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value);?>
" <?php if ((isset($_smarty_tpl->tpl_vars['PICKLIST_COLORS']->value[$_smarty_tpl->tpl_vars['PICKLIST_NAME']->value])) && $_smarty_tpl->tpl_vars['PICKLIST_COLORS']->value[$_smarty_tpl->tpl_vars['PICKLIST_NAME']->value]) {?>class="<?php echo $_smarty_tpl->tpl_vars['CLASS_NAME']->value;?>
"<?php }?> <?php if (trim(decode_html($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'))) == trim($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value)) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value;?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName() == 'targetmodule' && $_smarty_tpl->tpl_vars['MODE']->value == 'edit') {?><input type="hidden" name="targetmodule" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue');?>
" /><?php }
if ($_smarty_tpl->tpl_vars['PICKLIST_COLORS']->value) {?><style type="text/css"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value, 'PICKLIST_VALUE', false, 'PICKLIST_NAME');
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_NAME']->value => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value) {
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->do_else = false;
ob_start();
echo smarty_modifier_replace($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value,' ','_');
$_prefixVariable3=ob_get_clean();
$_smarty_tpl->_assignInScope('CLASS_NAME', ((string)$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName())."_".$_prefixVariable3);?>.picklistColor_<?php echo $_smarty_tpl->tpl_vars['CLASS_NAME']->value;?>
 {background-color: <?php echo $_smarty_tpl->tpl_vars['PICKLIST_COLORS']->value[$_smarty_tpl->tpl_vars['PICKLIST_NAME']->value];?>
 !important;}<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></style><?php }
}
}
