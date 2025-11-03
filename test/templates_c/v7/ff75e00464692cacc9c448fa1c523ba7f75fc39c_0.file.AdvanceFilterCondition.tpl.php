<?php
/* Smarty version 4.5.5, created on 2025-11-02 16:27:36
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\Workflows\AdvanceFilterCondition.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_69078678124c30_23121572',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ff75e00464692cacc9c448fa1c523ba7f75fc39c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\Workflows\\AdvanceFilterCondition.tpl',
      1 => 1761802269,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69078678124c30_23121572 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="row conditionRow" style="margin-bottom: 10px;"><span class="col-lg-4 col-md-4 col-sm-4"><select class="<?php if (empty($_smarty_tpl->tpl_vars['NOCHOSEN']->value)) {?>select2<?php }?> col-lg-12" name="columnname" data-placeholder="<?php echo vtranslate('LBL_SELECT_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"><option value="none"></option><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value, 'BLOCK_FIELDS', false, 'BLOCK_LABEL');
$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['BLOCK_LABEL']->value => $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value) {
$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->do_else = false;
?><optgroup label='<?php echo vtranslate($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value,$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value);?>
'><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value, 'FIELD_MODEL', false, 'FIELD_NAME');
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_NAME']->value => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value) {
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = false;
$_smarty_tpl->_assignInScope('FIELD_INFO', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo());
$_smarty_tpl->_assignInScope('MODULE_MODEL', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getModule());
$_smarty_tpl->_assignInScope('SPECIAL_VALIDATOR', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getValidator());
if (!empty($_smarty_tpl->tpl_vars['COLUMNNAME_API']->value)) {
$_smarty_tpl->_assignInScope('columnNameApi', $_smarty_tpl->tpl_vars['COLUMNNAME_API']->value);
} else {
$_smarty_tpl->_assignInScope('columnNameApi', 'getCustomViewColumnName');
}?><option value="<?php $_prefixVariable1 = $_smarty_tpl->tpl_vars['columnNameApi']->value;
echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->$_prefixVariable1();?>
" data-fieldtype="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldType();?>
" data-field-name="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
"<?php $_prefixVariable2 = $_smarty_tpl->tpl_vars['columnNameApi']->value;
if ((isset($_smarty_tpl->tpl_vars['CONDITION_INFO']->value['columnname'])) && decode_html($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->$_prefixVariable2()) == $_smarty_tpl->tpl_vars['CONDITION_INFO']->value['columnname']) {
$_smarty_tpl->_assignInScope('FIELD_TYPE', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType());
$_smarty_tpl->_assignInScope('SELECTED_FIELD_MODEL', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value);
$_tmp_array = isset($_smarty_tpl->tpl_vars['FIELD_INFO']) ? $_smarty_tpl->tpl_vars['FIELD_INFO']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['value'] = decode_html($_smarty_tpl->tpl_vars['CONDITION_INFO']->value['value']);
$_smarty_tpl->_assignInScope('FIELD_INFO', $_tmp_array);?>selected="selected"<?php }
if (($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name') == 'Events') && ($_smarty_tpl->tpl_vars['FIELD_NAME']->value == 'recurringtype')) {
$_smarty_tpl->_assignInScope('PICKLIST_VALUES', Calendar_Field_Model::getReccurencePicklistValues());
$_tmp_array = isset($_smarty_tpl->tpl_vars['FIELD_INFO']) ? $_smarty_tpl->tpl_vars['FIELD_INFO']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['picklistvalues'] = $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value;
$_smarty_tpl->_assignInScope('FIELD_INFO', $_tmp_array);
}
if (($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name') == 'Documents') && ($_smarty_tpl->tpl_vars['FIELD_NAME']->value == 'filelocationtype' || $_smarty_tpl->tpl_vars['FIELD_NAME']->value == 'folderid' || $_smarty_tpl->tpl_vars['FIELD_NAME']->value == 'filename')) {
if ($_smarty_tpl->tpl_vars['FIELD_NAME']->value == 'filelocationtype') {
$_smarty_tpl->_assignInScope('PICKLIST_VALUES', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFileLocationType());
$_tmp_array = isset($_smarty_tpl->tpl_vars['FIELD_INFO']) ? $_smarty_tpl->tpl_vars['FIELD_INFO']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['type'] = 'picklist';
$_smarty_tpl->_assignInScope('FIELD_INFO', $_tmp_array);
$_smarty_tpl->_assignInScope('FIELD_TYPE', 'picklist');
$_tmp_array = isset($_smarty_tpl->tpl_vars['FIELD_INFO']) ? $_smarty_tpl->tpl_vars['FIELD_INFO']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['picklistvalues'] = $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value;
$_smarty_tpl->_assignInScope('FIELD_INFO', $_tmp_array);
} elseif ($_smarty_tpl->tpl_vars['FIELD_NAME']->value == 'folderid') {
$_smarty_tpl->_assignInScope('PICKLIST_VALUES', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDocumentFolders());
$_tmp_array = isset($_smarty_tpl->tpl_vars['FIELD_INFO']) ? $_smarty_tpl->tpl_vars['FIELD_INFO']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['type'] = 'picklist';
$_smarty_tpl->_assignInScope('FIELD_INFO', $_tmp_array);
$_smarty_tpl->_assignInScope('FIELD_TYPE', 'picklist');
$_tmp_array = isset($_smarty_tpl->tpl_vars['FIELD_INFO']) ? $_smarty_tpl->tpl_vars['FIELD_INFO']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['picklistvalues'] = $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value;
$_smarty_tpl->_assignInScope('FIELD_INFO', $_tmp_array);
} elseif ($_smarty_tpl->tpl_vars['FIELD_NAME']->value == 'filename') {
$_tmp_array = isset($_smarty_tpl->tpl_vars['FIELD_INFO']) ? $_smarty_tpl->tpl_vars['FIELD_INFO']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['type'] = 'string';
$_smarty_tpl->_assignInScope('FIELD_INFO', $_tmp_array);
$_smarty_tpl->_assignInScope('FIELD_TYPE', 'string');
}
}?>data-fieldinfo='<?php echo Vtiger_Util_Helper::toSafeHTML(ZEND_JSON::encode($_smarty_tpl->tpl_vars['FIELD_INFO']->value));?>
'<?php if (!empty($_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR']->value)) {?>data-validator='<?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR']->value);?>
'<?php }?>><?php if ($_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value != $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name')) {?>(<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name'),$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name'));?>
)  <?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name'));
} else {
echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value);
}?></option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></optgroup><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></span><span class="conditionComparator col-lg-3 col-md-3 col-sm-3"><select class="<?php if (empty($_smarty_tpl->tpl_vars['NOCHOSEN']->value)) {?>select2<?php }?> col-lg-12" name="comparator" data-placeholder="<?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"><option value="none"><?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><?php if ((isset($_smarty_tpl->tpl_vars['FIELD_TYPE']->value))) {
$_smarty_tpl->_assignInScope('ADVANCE_FILTER_OPTIONS', $_smarty_tpl->tpl_vars['ADVANCED_FILTER_OPTIONS_BY_TYPE']->value[$_smarty_tpl->tpl_vars['FIELD_TYPE']->value]);
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTIONS']->value, 'ADVANCE_FILTER_OPTION');
$_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTION']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTION']->value) {
$_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTION']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTION']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTION']->value === $_smarty_tpl->tpl_vars['CONDITION_INFO']->value['comparator']) {?>selected<?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['ADVANCED_FILTER_OPTIONS']->value[$_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTION']->value]);?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?></select></span><span class="col-lg-4 col-md-4 col-sm-4  fieldUiHolder"><?php if ((isset($_smarty_tpl->tpl_vars['CONDITION_INFO']->value['value']))) {
$_smarty_tpl->_assignInScope('CONDITIONINFO', $_smarty_tpl->tpl_vars['CONDITION_INFO']->value['value']);
} else {
$_smarty_tpl->_assignInScope('CONDITIONINFO', '');
}?><input name="<?php if ((isset($_smarty_tpl->tpl_vars['SELECTED_FIELD_MODEL']->value)) && $_smarty_tpl->tpl_vars['SELECTED_FIELD_MODEL']->value) {
echo $_smarty_tpl->tpl_vars['SELECTED_FIELD_MODEL']->value->get('name');
}?>" data-value="value" class="inputElement col-lg-12" type="text" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['CONDITIONINFO']->value, ENT_QUOTES, 'UTF-8', true);?>
" /></span><span class="hide"><!-- TODO : see if you need to respect CONDITION_INFO condition or / and  --><?php if (empty($_smarty_tpl->tpl_vars['CONDITION']->value)) {
$_smarty_tpl->_assignInScope('CONDITION', "and");
}?><input type="hidden" name="column_condition" value="<?php echo $_smarty_tpl->tpl_vars['CONDITION']->value;?>
" /></span><span class="col-lg-1" style="line-height: 30px;"><i class="deleteCondition glyphicon glyphicon-trash cursorPointer" title="<?php echo vtranslate('LBL_DELETE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"></i></span></div><?php }
}
