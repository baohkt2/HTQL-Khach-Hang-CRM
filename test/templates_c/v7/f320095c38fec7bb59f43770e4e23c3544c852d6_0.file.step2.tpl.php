<?php
/* Smarty version 4.5.5, created on 2025-09-30 07:52:27
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Reports\step2.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68db8c3b224fd7_61566086',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f320095c38fec7bb59f43770e4e23c3544c852d6' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Reports\\step2.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68db8c3b224fd7_61566086 (Smarty_Internal_Template $_smarty_tpl) {
?><form class="form-horizontal recordEditView" id="report_step2" method="post" action="index.php"><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
" /><input type="hidden" name="view" value="Edit" /><input type="hidden" name="mode" value="step3" /><input type="hidden" name="record" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
" /><input type="hidden" name="reportname" value="<?php echo $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('reportname');?>
" /><?php if ($_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('members')) {?><input type="hidden" name="members" value=<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('members'));?>
 /><?php }?><input type="hidden" name="reportfolderid" value="<?php echo $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('reportfolderid');?>
" /><input type="hidden" name="description" value="<?php echo $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('description');?>
" /><input type="hidden" name="primary_module" value="<?php echo $_smarty_tpl->tpl_vars['PRIMARY_MODULE']->value;?>
" /><input type="hidden" name="secondary_modules" value=<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['SECONDARY_MODULES']->value);?>
 /><input type="hidden" name="selected_fields" id="selected_fields" value='<?php if ((isset($_smarty_tpl->tpl_vars['SELECTED_FIELDS']->value))) {
echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['SELECTED_FIELDS']->value);
} else { ?>false<?php }?>' /><input type="hidden" name="selected_sort_fields" id="selected_sort_fields" value="" /><input type="hidden" name="calculation_fields" id="calculation_fields" value="" /><input type="hidden" name="isDuplicate" value="<?php echo $_smarty_tpl->tpl_vars['IS_DUPLICATE']->value;?>
" /><input type="hidden" name="enable_schedule" value="<?php echo $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('enable_schedule');?>
"><input type="hidden" name="schtime" value="<?php echo $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('schtime');?>
"><input type="hidden" name="schdate" value="<?php echo $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('schdate');?>
"><input type="hidden" name="schdayoftheweek" value=<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('schdayoftheweek'));?>
><input type="hidden" name="schdayofthemonth" value=<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('schdayofthemonth'));?>
><input type="hidden" name="schannualdates" value=<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('schannualdates'));?>
><input type="hidden" name="recipients" value=<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('recipients'));?>
><input type="hidden" name="specificemails" value=<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('specificemails'));?>
><input type="hidden" name="schtypeid" value="<?php echo $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('schtypeid');?>
"><input type="hidden" name="fileformat" value="<?php echo $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('fileformat');?>
"><input type="hidden" class="step" value="2" /><div class="" style="border:1px solid #ccc;padding:4%;"><div class="form-group"><label><?php echo vtranslate('LBL_SELECT_COLUMNS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
(<?php echo vtranslate('LBL_MAX',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 25)</label><select data-placeholder="<?php echo vtranslate('LBL_ADD_MORE_COLUMNS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" id="reportsColumnsList" style="width :100%;" class="select2-container select2 col-lg-11 columns"  data-rule-required="true" multiple=""><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['PRIMARY_MODULE_FIELDS']->value, 'PRIMARY_MODULE', false, 'PRIMARY_MODULE_NAME');
$_smarty_tpl->tpl_vars['PRIMARY_MODULE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['PRIMARY_MODULE_NAME']->value => $_smarty_tpl->tpl_vars['PRIMARY_MODULE']->value) {
$_smarty_tpl->tpl_vars['PRIMARY_MODULE']->do_else = false;
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['PRIMARY_MODULE']->value, 'BLOCK', false, 'BLOCK_LABEL');
$_smarty_tpl->tpl_vars['BLOCK']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['BLOCK_LABEL']->value => $_smarty_tpl->tpl_vars['BLOCK']->value) {
$_smarty_tpl->tpl_vars['BLOCK']->do_else = false;
?><optgroup label='<?php echo vtranslate($_smarty_tpl->tpl_vars['PRIMARY_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
-<?php echo vtranslate($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value,$_smarty_tpl->tpl_vars['PRIMARY_MODULE_NAME']->value);?>
'><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['BLOCK']->value, 'FIELD_LABEL', false, 'FIELD_KEY');
$_smarty_tpl->tpl_vars['FIELD_LABEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_KEY']->value => $_smarty_tpl->tpl_vars['FIELD_LABEL']->value) {
$_smarty_tpl->tpl_vars['FIELD_LABEL']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['FIELD_KEY']->value;?>
" <?php if (!empty($_smarty_tpl->tpl_vars['SELECTED_FIELDS']->value) && in_array($_smarty_tpl->tpl_vars['FIELD_KEY']->value,array_map('decode_html',$_smarty_tpl->tpl_vars['SELECTED_FIELDS']->value))) {?>selected=""<?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['PRIMARY_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['PRIMARY_MODULE_NAME']->value);?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_LABEL']->value,$_smarty_tpl->tpl_vars['PRIMARY_MODULE_NAME']->value);?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></optgroup><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['SECONDARY_MODULE_FIELDS']->value, 'SECONDARY_MODULE', false, 'SECONDARY_MODULE_NAME');
$_smarty_tpl->tpl_vars['SECONDARY_MODULE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['SECONDARY_MODULE_NAME']->value => $_smarty_tpl->tpl_vars['SECONDARY_MODULE']->value) {
$_smarty_tpl->tpl_vars['SECONDARY_MODULE']->do_else = false;
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['SECONDARY_MODULE']->value, 'BLOCK', false, 'BLOCK_LABEL');
$_smarty_tpl->tpl_vars['BLOCK']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['BLOCK_LABEL']->value => $_smarty_tpl->tpl_vars['BLOCK']->value) {
$_smarty_tpl->tpl_vars['BLOCK']->do_else = false;
?><optgroup label='<?php echo vtranslate($_smarty_tpl->tpl_vars['SECONDARY_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
-<?php echo vtranslate($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value,$_smarty_tpl->tpl_vars['SECONDARY_MODULE_NAME']->value);?>
'><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['BLOCK']->value, 'FIELD_LABEL', false, 'FIELD_KEY');
$_smarty_tpl->tpl_vars['FIELD_LABEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_KEY']->value => $_smarty_tpl->tpl_vars['FIELD_LABEL']->value) {
$_smarty_tpl->tpl_vars['FIELD_LABEL']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['FIELD_KEY']->value;?>
"<?php if (!empty($_smarty_tpl->tpl_vars['SELECTED_FIELDS']->value) && in_array($_smarty_tpl->tpl_vars['FIELD_KEY']->value,array_map('decode_html',$_smarty_tpl->tpl_vars['SELECTED_FIELDS']->value))) {?>selected=""<?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['SECONDARY_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['SECONDARY_MODULE_NAME']->value);?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_LABEL']->value,$_smarty_tpl->tpl_vars['SECONDARY_MODULE_NAME']->value);?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></optgroup><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></div><div class="form-group"><div class="row"><label class="col-lg-6"><?php echo vtranslate('LBL_GROUP_BY',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label><label class="col-lg-6"><?php echo vtranslate('LBL_SORT_ORDER',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></div><div class=""><?php $_smarty_tpl->_assignInScope('ROW_VAL', 1);
if ((isset($_smarty_tpl->tpl_vars['SELECTED_SORT_FIELDS']->value)) && is_array($_smarty_tpl->tpl_vars['SELECTED_SORT_FIELDS']->value)) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['SELECTED_SORT_FIELDS']->value, 'SELECTED_SORT_FIELD_VALUE', false, 'SELECTED_SORT_FIELD_KEY');
$_smarty_tpl->tpl_vars['SELECTED_SORT_FIELD_VALUE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['SELECTED_SORT_FIELD_KEY']->value => $_smarty_tpl->tpl_vars['SELECTED_SORT_FIELD_VALUE']->value) {
$_smarty_tpl->tpl_vars['SELECTED_SORT_FIELD_VALUE']->do_else = false;
?><div class="row sortFieldRow" style="padding-bottom:10px;"><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( 'RelatedFields.tpl',$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('ROW_VAL'=>$_smarty_tpl->tpl_vars['ROW_VAL']->value), 0, true);
$_smarty_tpl->_assignInScope('ROW_VAL', ($_smarty_tpl->tpl_vars['ROW_VAL']->value+1));?></div><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
$_smarty_tpl->_assignInScope('SELECTED_SORT_FEILDS_ARRAY', (isset($_smarty_tpl->tpl_vars['SELECTED_SORT_FIELDS']->value)) ? $_smarty_tpl->tpl_vars['SELECTED_SORT_FIELDS']->value : array());
$_smarty_tpl->_assignInScope('SELECTED_SORT_FIELDS_COUNT', (isset($_smarty_tpl->tpl_vars['SELECTED_SORT_FEILDS_ARRAY']->value)) ? php7_count($_smarty_tpl->tpl_vars['SELECTED_SORT_FEILDS_ARRAY']->value) : array());
while ($_smarty_tpl->tpl_vars['SELECTED_SORT_FIELDS_COUNT']->value < 3) {?><div class="row sortFieldRow" style="padding-bottom:10px;"><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( 'RelatedFields.tpl',$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('ROW_VAL'=>$_smarty_tpl->tpl_vars['ROW_VAL']->value), 0, true);
$_smarty_tpl->_assignInScope('ROW_VAL', ($_smarty_tpl->tpl_vars['ROW_VAL']->value+1));
$_smarty_tpl->_assignInScope('SELECTED_SORT_FIELDS_COUNT', ($_smarty_tpl->tpl_vars['SELECTED_SORT_FIELDS_COUNT']->value+1));?></div><?php }?>
</div></div><div class="row block padding1per"><div class="padding1per"><strong><?php echo vtranslate('LBL_CALCULATIONS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></div><div class="padding1per"><table class="table table-bordered CalculationFields" width="100%"><thead><tr class="calculationHeaders blockHeader"><th><?php echo vtranslate('LBL_COLUMNS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th><th><?php echo vtranslate('LBL_SUM_VALUE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th><th><?php echo vtranslate('LBL_AVERAGE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th><th><?php echo vtranslate('LBL_LOWEST_VALUE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th><th><?php echo vtranslate('LBL_HIGHEST_VALUE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th></tr></thead><?php $_smarty_tpl->_assignInScope('FIELD_OPERATION_VALUES', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'explode' ][ 0 ], array( ',','SUM:2,AVG:3,MIN:4,MAX:5' )));
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['CALCULATION_FIELDS']->value, 'CALCULATION_FIELDS_MODULE', false, 'CALCULATION_FIELDS_MODULE_LABEL');
$_smarty_tpl->tpl_vars['CALCULATION_FIELDS_MODULE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['CALCULATION_FIELDS_MODULE_LABEL']->value => $_smarty_tpl->tpl_vars['CALCULATION_FIELDS_MODULE']->value) {
$_smarty_tpl->tpl_vars['CALCULATION_FIELDS_MODULE']->do_else = false;
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['CALCULATION_FIELDS_MODULE']->value, 'CALCULATION_FIELD', false, 'CALCULATION_FIELD_KEY');
$_smarty_tpl->tpl_vars['CALCULATION_FIELD']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['CALCULATION_FIELD_KEY']->value => $_smarty_tpl->tpl_vars['CALCULATION_FIELD']->value) {
$_smarty_tpl->tpl_vars['CALCULATION_FIELD']->do_else = false;
$_smarty_tpl->_assignInScope('FIELD_EXPLODE', explode(':',$_smarty_tpl->tpl_vars['CALCULATION_FIELD_KEY']->value));
$_smarty_tpl->_assignInScope('tableName', $_smarty_tpl->tpl_vars['FIELD_EXPLODE']->value['0']);
$_smarty_tpl->_assignInScope('columnName', $_smarty_tpl->tpl_vars['FIELD_EXPLODE']->value['1']);
$_smarty_tpl->_assignInScope('FIELDNAME_EXPLODE', explode('_',$_smarty_tpl->tpl_vars['FIELD_EXPLODE']->value['2']));
$_smarty_tpl->_assignInScope('fieldNameArray', array_slice($_smarty_tpl->tpl_vars['FIELDNAME_EXPLODE']->value,1));
$_smarty_tpl->_assignInScope('fieldName', implode('_',$_smarty_tpl->tpl_vars['fieldNameArray']->value));?><tr class="calculationFieldRow"><td><?php echo vtranslate($_smarty_tpl->tpl_vars['CALCULATION_FIELDS_MODULE_LABEL']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
-<?php echo vtranslate($_smarty_tpl->tpl_vars['CALCULATION_FIELD']->value,$_smarty_tpl->tpl_vars['CALCULATION_FIELDS_MODULE_LABEL']->value);?>
</td><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FIELD_OPERATION_VALUES']->value, 'FIELD_OPERATION_VALUE');
$_smarty_tpl->tpl_vars['FIELD_OPERATION_VALUE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_OPERATION_VALUE']->value) {
$_smarty_tpl->tpl_vars['FIELD_OPERATION_VALUE']->do_else = false;
$_smarty_tpl->_assignInScope('FIELD_CALCULATION_VALUE', (("cb:".((string)$_smarty_tpl->tpl_vars['tableName']->value).":".((string)$_smarty_tpl->tpl_vars['columnName']->value).":".((string)$_smarty_tpl->tpl_vars['fieldName']->value)).('_')).($_smarty_tpl->tpl_vars['FIELD_OPERATION_VALUE']->value));?><td width="15%"><input class="calculationType" type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_CALCULATION_VALUE']->value;?>
" <?php if (!empty($_smarty_tpl->tpl_vars['SELECTED_CALCULATION_FIELDS']->value) && in_array($_smarty_tpl->tpl_vars['FIELD_CALCULATION_VALUE']->value,$_smarty_tpl->tpl_vars['SELECTED_CALCULATION_FIELDS']->value)) {?> checked=""<?php }?> /></td><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></table></div></div></div><div class="modal-overlay-footer border1px clearfix"><div class="row clearfix"><div class="textAlignCenter col-lg-12 col-md-12 col-sm-12 "><button type="button" class="btn btn-danger backStep"><strong><?php echo vtranslate('LBL_BACK',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button>&nbsp;&nbsp;<button type="submit" class="btn btn-success nextStep"><strong><?php echo vtranslate('LBL_NEXT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button>&nbsp;&nbsp;<a class="cancelLink" onclick="window.history.back()"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div></div></div><br><br></form>
<?php }
}
