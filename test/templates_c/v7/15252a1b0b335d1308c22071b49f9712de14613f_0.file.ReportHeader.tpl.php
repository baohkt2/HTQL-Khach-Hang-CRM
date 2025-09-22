<?php
/* Smarty version 4.5.5, created on 2025-09-16 07:16:50
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Reports\ReportHeader.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68c90ee2103246_64076255',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '15252a1b0b335d1308c22071b49f9712de14613f' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Reports\\ReportHeader.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68c90ee2103246_64076255 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="reportsDetailHeader"><input type="hidden" name="date_filters" data-value='<?php echo Vtiger_Util_Helper::toSafeHTML(ZEND_JSON::encode($_smarty_tpl->tpl_vars['DATE_FILTERS']->value));?>
' /><input type="hidden" id="reportLimit" value="<?php echo $_smarty_tpl->tpl_vars['REPORT_LIMIT']->value;?>
" /><form id="detailView" onSubmit="return false;"><input type="hidden" name="date_filters" data-value='<?php echo Vtiger_Util_Helper::toSafeHTML(ZEND_JSON::encode($_smarty_tpl->tpl_vars['DATE_FILTERS']->value));?>
' /><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "DetailViewActions.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?><br><div class=''><?php $_smarty_tpl->_assignInScope('filterConditionNotExists', (php7_count($_smarty_tpl->tpl_vars['SELECTED_ADVANCED_FILTER_FIELDS']->value[1]['columns']) == 0 && php7_count($_smarty_tpl->tpl_vars['SELECTED_ADVANCED_FILTER_FIELDS']->value[2]['columns']) == 0));?><button class="btn btn-default" name="modify_condition" data-val="<?php echo $_smarty_tpl->tpl_vars['filterConditionNotExists']->value;?>
"><strong><?php echo vtranslate('LBL_MODIFY_CONDITION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong>&nbsp;&nbsp;<i class="fa <?php if ($_smarty_tpl->tpl_vars['filterConditionNotExists']->value == true) {?> fa-chevron-right <?php } else { ?> fa-chevron-down <?php }?>"></i></button></div><br><div id="filterContainer" class="filterElements filterConditionsDiv <?php if ($_smarty_tpl->tpl_vars['filterConditionNotExists']->value == true) {?> hide <?php }?>"><input type="hidden" id="recordId" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
" /><?php $_smarty_tpl->_assignInScope('RECORD_STRUCTURE', array());
$_smarty_tpl->_assignInScope('PRIMARY_MODULE_LABEL', vtranslate($_smarty_tpl->tpl_vars['PRIMARY_MODULE']->value,$_smarty_tpl->tpl_vars['PRIMARY_MODULE']->value));
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['PRIMARY_MODULE_RECORD_STRUCTURE']->value, 'BLOCK_FIELDS', false, 'BLOCK_LABEL');
$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['BLOCK_LABEL']->value => $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value) {
$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->do_else = false;
$_smarty_tpl->_assignInScope('PRIMARY_MODULE_BLOCK_LABEL', vtranslate($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value,$_smarty_tpl->tpl_vars['PRIMARY_MODULE']->value));
$_smarty_tpl->_assignInScope('key', ((string)$_smarty_tpl->tpl_vars['PRIMARY_MODULE_LABEL']->value)." ".((string)$_smarty_tpl->tpl_vars['PRIMARY_MODULE_BLOCK_LABEL']->value));
if ($_smarty_tpl->tpl_vars['LINEITEM_FIELD_IN_CALCULATION']->value == false && $_smarty_tpl->tpl_vars['BLOCK_LABEL']->value == 'LBL_ITEM_DETAILS') {
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
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?><div class="filterConditionContainer"><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( 'AdvanceFilter.tpl' )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('RECORD_STRUCTURE'=>$_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value,'ADVANCE_CRITERIA'=>$_smarty_tpl->tpl_vars['SELECTED_ADVANCED_FILTER_FIELDS']->value,'COLUMNNAME_API'=>'getReportFilterColumnName'), 0, true);
?></div><div class="row"><div class="textAlignCenter hide reportActionButtons"><button class="btn btn-default generateReport" data-mode="generate" value="<?php echo vtranslate('LBL_GENERATE_NOW',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"/><strong><?php echo vtranslate('LBL_GENERATE_NOW',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button>&nbsp;<?php if ($_smarty_tpl->tpl_vars['REPORT_MODEL']->value->isEditableBySharing()) {?><button class="btn btn-success generateReport" data-mode="save" value="<?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"/><strong><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button><?php }?></div></div><br></div></form></div><div id="reportContentsDiv"><?php }
}
