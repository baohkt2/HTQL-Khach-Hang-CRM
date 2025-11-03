<?php
/* Smarty version 4.5.5, created on 2025-10-30 06:12:47
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\LayoutEditor\DefaultValueUi.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690301df2d9252_51259456',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '172b07989d7d642b7ee37e5de6acb9d4e35845e6' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\LayoutEditor\\DefaultValueUi.tpl',
      1 => 1761802269,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690301df2d9252_51259456 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isDefaultValueOptionDisabled() != "true") {?><div class="form-group"><label class="control-label fieldLabel col-sm-5"><img src="<?php echo vimage_path('DefaultValue.png');?>
" height=14 width=14/> &nbsp; <?php echo vtranslate('LBL_DEFAULT_VALUE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label><div class="controls col-sm-7"><div class="defaultValueUi"><?php if (!(isset($_smarty_tpl->tpl_vars['NAME_ATTR']->value)) || !$_smarty_tpl->tpl_vars['NAME_ATTR']->value) {
$_smarty_tpl->_assignInScope('NAME_ATTR', "fieldDefaultValue");
}
if ((!(isset($_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value)) || $_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value == false) && (!(isset($_smarty_tpl->tpl_vars['IS_SET']->value)) || !$_smarty_tpl->tpl_vars['IS_SET']->value)) {
$_smarty_tpl->_assignInScope('DEFAULT_VALUE', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('defaultvalue'));
}
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType() == "picklist") {
if (!is_array($_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value)) {
$_smarty_tpl->_assignInScope('PICKLIST_VALUES', $_smarty_tpl->tpl_vars['FIELD_INFO']->value['picklistvalues']);
}
if (!$_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value) {
$_smarty_tpl->_assignInScope('DEFAULT_VALUE', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('defaultvalue'));
}
ob_start();
echo decode_html($_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value);
$_prefixVariable14 = ob_get_clean();
$_smarty_tpl->_assignInScope('DEFAULT_VALUE', $_prefixVariable14);?><select class="col-sm-9 select2" name="<?php echo $_smarty_tpl->tpl_vars['NAME_ATTR']->value;?>
"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value, 'PICKLIST_VALUE', false, 'PICKLIST_NAME');
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_NAME']->value => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value) {
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->do_else = false;
?><option value="<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value);?>
" <?php if ($_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value == $_smarty_tpl->tpl_vars['PICKLIST_NAME']->value) {?> selected <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value,$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value);?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select><?php } elseif ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType() == "multipicklist") {
if (!is_array($_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value)) {
$_smarty_tpl->_assignInScope('PICKLIST_VALUES', $_smarty_tpl->tpl_vars['FIELD_INFO']->value['picklistvalues']);
}
$_smarty_tpl->_assignInScope('FIELD_VALUE_LIST', explode(' |##| ',$_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value));?><select multiple class="col-sm-9 select2" name="<?php echo $_smarty_tpl->tpl_vars['NAME_ATTR']->value;?>
[]" ><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value, 'PICKLIST_VALUE');
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value) {
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->do_else = false;
?><option value="<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value);?>
" <?php if (in_array(Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value),$_smarty_tpl->tpl_vars['FIELD_VALUE_LIST']->value)) {?> selected <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value,$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value);?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select><?php } elseif ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType() == "boolean") {?><input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['NAME_ATTR']->value;?>
" value="" /><input type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['NAME_ATTR']->value;?>
" value="1" <?php if ($_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value == 'on' || $_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value == 1) {?> checked <?php }?> /><?php } elseif ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType() == "time") {?><div class="input-group time"><input type="text" class="timepicker-default inputElement" data-format="<?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('hour_format');?>
" data-toregister="time" value="<?php echo $_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['NAME_ATTR']->value;?>
"  style='width: 75%'/><span class="input-group-addon cursorPointer"><i class="fa fa-times"></i></span></div><?php } elseif ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType() == "date") {?><div class="input-group date"><?php $_smarty_tpl->_assignInScope('FIELD_NAME', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name'));?><input type="text" class="inputElement dateField" name="<?php echo $_smarty_tpl->tpl_vars['NAME_ATTR']->value;?>
" data-toregister="date" data-date-format="<?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('date_format');?>
"value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getEditViewDisplayValue($_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value);?>
" style='width: 75%'/><span class="input-group-addon"><i class="fa fa-calendar"></i></span></div><?php } elseif ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType() == "percentage") {?><div class="input-group" style='width: 75%'><input type="number" class="form-control" name="<?php echo $_smarty_tpl->tpl_vars['NAME_ATTR']->value;?>
"value="<?php echo $_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value;?>
"  step="any"/><span class="input-group-addon">%</span></div><?php } elseif ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType() == "currency") {?><div class="input-group"><span class="input-group-addon"><?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('currency_symbol');?>
</span><input type="text" class="inputElement" name="<?php echo $_smarty_tpl->tpl_vars['NAME_ATTR']->value;?>
"value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getEditViewDisplayValue($_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value,true);?>
"data-decimal-separator='<?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('currency_decimal_separator');?>
' data-group-separator='<?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('currency_grouping_separator');?>
' style='width: 75%'/></div><?php } elseif ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName() == "terms_conditions" && $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype') == 19) {
$_smarty_tpl->_assignInScope('INVENTORY_TERMS_AND_CONDITIONS_MODEL', Settings_Vtiger_MenuItem_Model::getInstance("INVENTORYTERMSANDCONDITIONS"));?><a href="<?php echo $_smarty_tpl->tpl_vars['INVENTORY_TERMS_AND_CONDITIONS_MODEL']->value->getUrl();?>
" target="_blank"><?php echo vtranslate('LBL_CLICK_HERE_TO_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a><?php } elseif ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType() == "text") {?><textarea class="input-lg col-sm-4" name="<?php echo $_smarty_tpl->tpl_vars['NAME_ATTR']->value;?>
"  style="resize: vertical"><?php echo $_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value;?>
</textarea><?php } else { ?><input type="text" class="inputElement col-sm-3" name="<?php echo $_smarty_tpl->tpl_vars['NAME_ATTR']->value;?>
" value="<?php echo (isset($_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value)) ? $_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value : '';?>
" style='width: 75%'/><?php }?></div></div></div><?php }
}
}
