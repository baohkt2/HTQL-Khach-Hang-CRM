<?php
/* Smarty version 4.5.5, created on 2025-11-02 07:43:05
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Users\uitypes\Picklist.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_69070b897dc813_40226985',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2a989365b4480b30a95aac0588208e0e30b69731' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Users\\uitypes\\Picklist.tpl',
      1 => 1761802269,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69070b897dc813_40226985 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('FIELD_INFO', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo());
$_smarty_tpl->_assignInScope('PICKLIST_VALUES', $_smarty_tpl->tpl_vars['FIELD_INFO']->value['picklistvalues']);
$_smarty_tpl->_assignInScope('SPECIAL_VALIDATOR', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getValidator());
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName() == 'defaulteventstatus') {
$_smarty_tpl->_assignInScope('EVENT_MODULE', Vtiger_Module_Model::getInstance('Events'));
$_smarty_tpl->_assignInScope('EVENTSTATUS_FIELD_MODEL', $_smarty_tpl->tpl_vars['EVENT_MODULE']->value->getField('eventstatus'));
$_smarty_tpl->_assignInScope('PICKLIST_VALUES', $_smarty_tpl->tpl_vars['EVENTSTATUS_FIELD_MODEL']->value->getPicklistValues());
} elseif ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName() == 'defaultactivitytype') {
$_smarty_tpl->_assignInScope('EVENT_MODULE', Vtiger_Module_Model::getInstance('Events'));
$_smarty_tpl->_assignInScope('ACTIVITYTYPE_FIELD_MODEL', $_smarty_tpl->tpl_vars['EVENT_MODULE']->value->getField('activitytype'));
$_smarty_tpl->_assignInScope('PICKLIST_VALUES', $_smarty_tpl->tpl_vars['ACTIVITYTYPE_FIELD_MODEL']->value->getPicklistValues());
}?><select data-fieldname="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
" data-fieldtype="picklist" class="inputElement select2 <?php if ($_smarty_tpl->tpl_vars['OCCUPY_COMPLETE_WIDTH']->value) {?> row <?php }?>" type="picklist" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
" <?php if (!empty($_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR']->value)) {?>data-validator='<?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR']->value);?>
'<?php }?> data-selected-value='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue');?>
'<?php if ($_smarty_tpl->tpl_vars['FIELD_INFO']->value["mandatory"] == true) {?> data-rule-required="true" <?php }
if (php7_count($_smarty_tpl->tpl_vars['FIELD_INFO']->value['validator'])) {?>data-specific-rules='<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['FIELD_INFO']->value["validator"]);?>
'<?php }?>><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isEmptyPicklistOptionAllowed()) {?><option value=""><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><?php }
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value, 'PICKLIST_VALUE', false, 'PICKLIST_NAME');
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_NAME']->value => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value) {
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->do_else = false;
if ($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value == ' ' && ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name') == 'currency_decimal_separator' || $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name') == 'currency_grouping_separator')) {
$_smarty_tpl->_assignInScope('PICKLIST_VALUE', vtranslate('Space',$_smarty_tpl->tpl_vars['MODULE']->value));
$_smarty_tpl->_assignInScope('OPTION_VALUE', '&nbsp;');
} else {
$_smarty_tpl->_assignInScope('OPTION_VALUE', Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value));
}?><option value="<?php echo $_smarty_tpl->tpl_vars['OPTION_VALUE']->value;?>
" <?php if (decode_html($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')) == decode_html($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value)) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value;?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select><?php }
}
