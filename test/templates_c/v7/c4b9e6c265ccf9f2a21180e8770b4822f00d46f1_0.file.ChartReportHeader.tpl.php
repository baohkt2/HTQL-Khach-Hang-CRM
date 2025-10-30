<?php
/* Smarty version 4.5.5, created on 2025-10-09 08:09:01
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Reports\ChartReportHeader.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e76d9de20b97_36686845',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c4b9e6c265ccf9f2a21180e8770b4822f00d46f1' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Reports\\ChartReportHeader.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e76d9de20b97_36686845 (Smarty_Internal_Template $_smarty_tpl) {
?><div class=""><div class="reportsDetailHeader"><input type="hidden" name="date_filters" data-value='<?php echo Vtiger_Util_Helper::toSafeHTML(ZEND_JSON::encode($_smarty_tpl->tpl_vars['DATE_FILTERS']->value));?>
' /><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "DetailViewActions.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?><div class="filterElements contactAdd filterConditionsDiv<?php if (!$_smarty_tpl->tpl_vars['REPORT_MODEL']->value->isEditableBySharing()) {?> hide<?php }?>"><form name='chartDetailForm' id='chartDetailForm' method="POST"><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
" /><input type="hidden" name="action" value="ChartSave" /><input type="hidden" name="recordId" id="recordId" value="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value;?>
" /><input type="hidden" name="reportname" value="<?php echo $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('reportname');?>
" /><input type="hidden" name="reportfolderid" value="<?php echo $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('reportfolderid');?>
" /><input type="hidden" name="reports_description" value="<?php echo $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('reports_description');?>
" /><input type="hidden" name="primary_module" value="<?php echo $_smarty_tpl->tpl_vars['PRIMARY_MODULE']->value;?>
" /><input type="hidden" name="secondary_modules" value=<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['SECONDARY_MODULES']->value);?>
 /><input type="hidden" name="advanced_filter" id="advanced_filter" value=<?php if ((isset($_smarty_tpl->tpl_vars['ADVANCED_FILTERS']->value))) {
echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['ADVANCED_FILTERS']->value);
} else { ?>''<?php }?> /><input type="hidden" name='groupbyfield' value=<?php echo $_smarty_tpl->tpl_vars['CHART_MODEL']->value->getGroupByField();?>
 /><input type="hidden" name='datafields' value=<?php echo Zend_JSON::encode($_smarty_tpl->tpl_vars['CHART_MODEL']->value->getDataFields());?>
 /><input type="hidden" name='charttype' value="<?php echo $_smarty_tpl->tpl_vars['CHART_MODEL']->value->getChartType();?>
" /><?php $_smarty_tpl->_assignInScope('RECORD_STRUCTURE', array());
$_smarty_tpl->_assignInScope('PRIMARY_MODULE_LABEL', vtranslate($_smarty_tpl->tpl_vars['PRIMARY_MODULE']->value,$_smarty_tpl->tpl_vars['PRIMARY_MODULE']->value));
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['PRIMARY_MODULE_RECORD_STRUCTURE']->value, 'BLOCK_FIELDS', false, 'BLOCK_LABEL');
$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['BLOCK_LABEL']->value => $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value) {
$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->do_else = false;
$_smarty_tpl->_assignInScope('PRIMARY_MODULE_BLOCK_LABEL', vtranslate($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value,$_smarty_tpl->tpl_vars['PRIMARY_MODULE']->value));
$_smarty_tpl->_assignInScope('key', ((string)$_smarty_tpl->tpl_vars['PRIMARY_MODULE_LABEL']->value)." ".((string)$_smarty_tpl->tpl_vars['PRIMARY_MODULE_BLOCK_LABEL']->value));
if ((isset($_smarty_tpl->tpl_vars['LINEITEM_FIELD_IN_CALCULATION']->value)) && $_smarty_tpl->tpl_vars['LINEITEM_FIELD_IN_CALCULATION']->value == false && $_smarty_tpl->tpl_vars['BLOCK_LABEL']->value == 'LBL_ITEM_DETAILS') {
} else {
$_tmp_array = isset($_smarty_tpl->tpl_vars['RECORD_STRUCTURE']) ? $_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array[$_smarty_tpl->tpl_vars['key']->value] = $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value;
$_smarty_tpl->_assignInScope('RECORD_STRUCTURE', $_tmp_array);
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['SECONDARY_MODULE_RECORD_STRUCTURES']->value, 'SECONDARY_MODULE_RECORD_STRUCTURE', false, 'MODULE_LABEL');
$_smarty_tpl->tpl_vars['SECONDARY_MODULE_RECORD_STRUCTURE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['MODULE_LABEL']->value => $_smarty_tpl->tpl_vars['SECONDARY_MODULE_RECORD_STRUCTURE']->value) {
$_smarty_tpl->tpl_vars['SECONDARY_MODULE_RECORD_STRUCTURE']->do_else = false;
$_smarty_tpl->_assignInScope('SECONDARY_MODULE_LABEL', vtranslate($_smarty_tpl->tpl_vars['MODULE_LABEL']->value,$_smarty_tpl->tpl_vars['MODULE_LABEL']->value));
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['SECONDARY_MODULE_RECORD_STRUCTURE']->value, 'BLOCK_FIELDS', false, 'BLOCK_LABEL');
$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['BLOCK_LABEL']->value => $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value) {
$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->do_else = false;
$_smarty_tpl->_assignInScope('SECONDARY_MODULE_BLOCK_LABEL', vtranslate($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value,$_smarty_tpl->tpl_vars['MODULE_LABEL']->value));
$_smarty_tpl->_assignInScope('key', ((string)$_smarty_tpl->tpl_vars['SECONDARY_MODULE_LABEL']->value)." ".((string)$_smarty_tpl->tpl_vars['SECONDARY_MODULE_BLOCK_LABEL']->value));
$_tmp_array = isset($_smarty_tpl->tpl_vars['RECORD_STRUCTURE']) ? $_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array[$_smarty_tpl->tpl_vars['key']->value] = $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value;
$_smarty_tpl->_assignInScope('RECORD_STRUCTURE', $_tmp_array);
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?><div class="well filterConditionContainer"><div><div class='row'><span class="col-lg-4"><div><span><?php echo vtranslate('LBL_SELECT_GROUP_BY_FIELD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span><span class="redColor">*</span></div><br><div><select id='groupbyfield' name='groupbyfield' class="col-lg-10" data-validation-engine="validate[required]" style='min-width:300px;'></select></div></span><span class="col-lg-2">&nbsp;</span><span class="col-lg-4"><div><span><?php echo vtranslate('LBL_SELECT_DATA_FIELD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span><span class="redColor">*</span></div><br><div><select id='datafields' name='datafields[]' class="col-lg-10" data-validation-engine="validate[required]" style='min-width:300px;'></select></div></span></div><br><div class='hide'><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "chartReportHiddenContents.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></div></div></div><div><?php $_smarty_tpl->_assignInScope('filterConditionNotExists', (php7_count($_smarty_tpl->tpl_vars['SELECTED_ADVANCED_FILTER_FIELDS']->value[1]['columns']) == 0 && php7_count($_smarty_tpl->tpl_vars['SELECTED_ADVANCED_FILTER_FIELDS']->value[2]['columns']) == 0));?><button class="btn btn-default" name="modify_condition" data-val="<?php echo $_smarty_tpl->tpl_vars['filterConditionNotExists']->value;?>
"><strong><?php echo vtranslate('LBL_MODIFY_CONDITION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong>&nbsp;&nbsp;<i class="fa <?php if ($_smarty_tpl->tpl_vars['filterConditionNotExists']->value == true) {?>fa-chevron-right<?php } else { ?>fa-chevron-down<?php }?>"></i></button></div><br><div id='filterContainer' class='<?php if ($_smarty_tpl->tpl_vars['filterConditionNotExists']->value == true) {?> hide <?php }?>'><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( 'AdvanceFilter.tpl' )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('RECORD_STRUCTURE'=>$_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value,'ADVANCE_CRITERIA'=>$_smarty_tpl->tpl_vars['SELECTED_ADVANCED_FILTER_FIELDS']->value,'COLUMNNAME_API'=>'getReportFilterColumnName'), 0, true);
?></div><?php if ($_smarty_tpl->tpl_vars['REPORT_MODEL']->value->isEditableBySharing()) {?><div class="row textAlignCenter hide reportActionButtons"><button class="btn btn-success generateReportChart" data-mode="save" value="<?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><strong><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button></div><?php }?></div></form></div></div><div id="reportContentsDiv"><?php }
}
