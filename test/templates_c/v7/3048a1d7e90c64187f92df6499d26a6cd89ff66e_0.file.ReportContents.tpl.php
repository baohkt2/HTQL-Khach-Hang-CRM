<?php
/* Smarty version 4.5.5, created on 2025-09-30 07:51:48
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Reports\ReportContents.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68db8c1440f9b1_97639919',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3048a1d7e90c64187f92df6499d26a6cd89ff66e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Reports\\ReportContents.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68db8c1440f9b1_97639919 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\vtigercrm\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.replace.php','function'=>'smarty_modifier_replace',),));
?>
<div class="contents-topscroll"><div class="topscroll-div"><?php if (!empty($_smarty_tpl->tpl_vars['CALCULATION_FIELDS']->value)) {?><table class=" table-bordered table-condensed marginBottom10px" width="100%"><thead><tr class="blockHeader"><th><?php echo vtranslate('LBL_FIELD_NAMES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th><th><?php echo vtranslate('LBL_SUM',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th><th><?php echo vtranslate('LBL_AVG',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th><th><?php echo vtranslate('LBL_MIN',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th><th><?php echo vtranslate('LBL_MAX',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th></tr></thead><?php $_smarty_tpl->_assignInScope('ESCAPE_CHAR', array('_SUM','_AVG','_MIN','_MAX'));
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['CALCULATION_FIELDS']->value, 'CALCULATION_FIELD', false, 'index');
$_smarty_tpl->tpl_vars['CALCULATION_FIELD']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['index']->value => $_smarty_tpl->tpl_vars['CALCULATION_FIELD']->value) {
$_smarty_tpl->tpl_vars['CALCULATION_FIELD']->do_else = false;
?><tr><?php $_smarty_tpl->_assignInScope('CALCULATION_FIELD_KEYS', array_keys($_smarty_tpl->tpl_vars['CALCULATION_FIELD']->value));
$_smarty_tpl->_assignInScope('CALCULATION_FIELD_KEYS', smarty_modifier_replace($_smarty_tpl->tpl_vars['CALCULATION_FIELD_KEYS']->value,$_smarty_tpl->tpl_vars['ESCAPE_CHAR']->value,''));
$_smarty_tpl->_assignInScope('FIELD_IMPLODE', explode('_',$_smarty_tpl->tpl_vars['CALCULATION_FIELD_KEYS']->value['0']));
$_smarty_tpl->_assignInScope('MODULE_NAME', $_smarty_tpl->tpl_vars['FIELD_IMPLODE']->value['0']);
$_smarty_tpl->_assignInScope('FIELD_LABEL', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'implode' ][ 0 ], array( " ",$_smarty_tpl->tpl_vars['FIELD_IMPLODE']->value )));
$_smarty_tpl->_assignInScope('FIELD_LABEL', str_replace($_smarty_tpl->tpl_vars['MODULE_NAME']->value,'',$_smarty_tpl->tpl_vars['FIELD_LABEL']->value));?><td><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 <?php echo vtranslate(trim($_smarty_tpl->tpl_vars['FIELD_LABEL']->value),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</td><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['CALCULATION_FIELD']->value, 'CALCULATION_VALUE');
$_smarty_tpl->tpl_vars['CALCULATION_VALUE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['CALCULATION_VALUE']->value) {
$_smarty_tpl->tpl_vars['CALCULATION_VALUE']->do_else = false;
?><td width="15%"><?php echo $_smarty_tpl->tpl_vars['CALCULATION_VALUE']->value;?>
</td><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></table><?php if ($_smarty_tpl->tpl_vars['REPORT_MODEL']->value->isInventoryModuleSelected()) {?><div class="alert alert-info"><?php $_smarty_tpl->_assignInScope('BASE_CURRENCY_INFO', Vtiger_Util_Helper::getUserCurrencyInfo());?><i class="fa fa-info-circle"></i>&nbsp;&nbsp;<?php echo vtranslate('LBL_CALCULATION_CONVERSION_MESSAGE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 - <?php echo $_smarty_tpl->tpl_vars['BASE_CURRENCY_INFO']->value['currency_name'];?>
 (<?php echo $_smarty_tpl->tpl_vars['BASE_CURRENCY_INFO']->value['currency_code'];?>
)</div><?php }
}?></div></div><div id="reportDetails" class="contents-bottomscroll"><div class="bottomscroll-div"><input type="hidden" id="updatedCount" value="<?php if ((isset($_smarty_tpl->tpl_vars['NEW_COUNT']->value))) {
echo $_smarty_tpl->tpl_vars['NEW_COUNT']->value;
} else { ?>''<?php }?>" /><?php if ($_smarty_tpl->tpl_vars['DATA']->value != '') {
$_smarty_tpl->_assignInScope('HEADERS', $_smarty_tpl->tpl_vars['DATA']->value[0]);?><table class="table table-bordered"><thead><tr class="blockHeader"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['HEADERS']->value, 'HEADER', false, 'NAME');
$_smarty_tpl->tpl_vars['HEADER']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['NAME']->value => $_smarty_tpl->tpl_vars['HEADER']->value) {
$_smarty_tpl->tpl_vars['HEADER']->do_else = false;
?><th nowrap><?php echo $_smarty_tpl->tpl_vars['NAME']->value;?>
</th><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tr></thead><?php $_smarty_tpl->_assignInScope('REPORTRUN', $_smarty_tpl->tpl_vars['REPORT_RUN_INSTANCE']->value);
$_smarty_tpl->_assignInScope('GROUPBYFIELDS', array_keys($_smarty_tpl->tpl_vars['REPORTRUN']->value->getGroupingList($_smarty_tpl->tpl_vars['RECORD_ID']->value)));
$_smarty_tpl->_assignInScope('GROUPBYFIELDSCOUNT', php7_count($_smarty_tpl->tpl_vars['GROUPBYFIELDS']->value));
if ($_smarty_tpl->tpl_vars['GROUPBYFIELDSCOUNT']->value > 0) {
$_smarty_tpl->_assignInScope('FIELDNAMES', array());
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['GROUPBYFIELDSCOUNT']->value-1+1 - (0) : 0-($_smarty_tpl->tpl_vars['GROUPBYFIELDSCOUNT']->value-1)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 0, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration === 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;
$_smarty_tpl->_assignInScope('FIELD', explode(':',$_smarty_tpl->tpl_vars['GROUPBYFIELDS']->value[$_smarty_tpl->tpl_vars['i']->value]));
$_smarty_tpl->_assignInScope('FIELD_EXPLODE', explode('_',$_smarty_tpl->tpl_vars['FIELD']->value[2]));
$_smarty_tpl->tpl_vars['j'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['j']->step = 1;$_smarty_tpl->tpl_vars['j']->total = (int) ceil(($_smarty_tpl->tpl_vars['j']->step > 0 ? php7_count($_smarty_tpl->tpl_vars['FIELD_EXPLODE']->value)-1+1 - (1) : 1-(php7_count($_smarty_tpl->tpl_vars['FIELD_EXPLODE']->value)-1)+1)/abs($_smarty_tpl->tpl_vars['j']->step));
if ($_smarty_tpl->tpl_vars['j']->total > 0) {
for ($_smarty_tpl->tpl_vars['j']->value = 1, $_smarty_tpl->tpl_vars['j']->iteration = 1;$_smarty_tpl->tpl_vars['j']->iteration <= $_smarty_tpl->tpl_vars['j']->total;$_smarty_tpl->tpl_vars['j']->value += $_smarty_tpl->tpl_vars['j']->step, $_smarty_tpl->tpl_vars['j']->iteration++) {
$_smarty_tpl->tpl_vars['j']->first = $_smarty_tpl->tpl_vars['j']->iteration === 1;$_smarty_tpl->tpl_vars['j']->last = $_smarty_tpl->tpl_vars['j']->iteration === $_smarty_tpl->tpl_vars['j']->total;
$_tmp_array = isset($_smarty_tpl->tpl_vars['FIELDNAMES']) ? $_smarty_tpl->tpl_vars['FIELDNAMES']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array[$_smarty_tpl->tpl_vars['i']->value] = (($_smarty_tpl->tpl_vars['FIELDNAMES']->value[$_smarty_tpl->tpl_vars['i']->value]).($_smarty_tpl->tpl_vars['FIELD_EXPLODE']->value[$_smarty_tpl->tpl_vars['j']->value])).(" ");
$_smarty_tpl->_assignInScope('FIELDNAMES', $_tmp_array);
}
}
}
}
if ($_smarty_tpl->tpl_vars['GROUPBYFIELDSCOUNT']->value == 1) {
$_smarty_tpl->_assignInScope('FIRST_FIELD', vtranslate(trim($_smarty_tpl->tpl_vars['FIELDNAMES']->value[0]),$_smarty_tpl->tpl_vars['MODULE']->value));
} elseif ($_smarty_tpl->tpl_vars['GROUPBYFIELDSCOUNT']->value == 2) {
$_smarty_tpl->_assignInScope('FIRST_FIELD', vtranslate(trim($_smarty_tpl->tpl_vars['FIELDNAMES']->value[0]),$_smarty_tpl->tpl_vars['MODULE']->value));
$_smarty_tpl->_assignInScope('SECOND_FIELD', vtranslate(trim($_smarty_tpl->tpl_vars['FIELDNAMES']->value[1]),$_smarty_tpl->tpl_vars['MODULE']->value));
} elseif ($_smarty_tpl->tpl_vars['GROUPBYFIELDSCOUNT']->value == 3) {
$_smarty_tpl->_assignInScope('FIRST_FIELD', vtranslate(trim($_smarty_tpl->tpl_vars['FIELDNAMES']->value[0]),$_smarty_tpl->tpl_vars['MODULE']->value));
$_smarty_tpl->_assignInScope('SECOND_FIELD', vtranslate(trim($_smarty_tpl->tpl_vars['FIELDNAMES']->value[1]),$_smarty_tpl->tpl_vars['MODULE']->value));
$_smarty_tpl->_assignInScope('THIRD_FIELD', vtranslate(trim($_smarty_tpl->tpl_vars['FIELDNAMES']->value[2]),$_smarty_tpl->tpl_vars['MODULE']->value));
}
$_smarty_tpl->_assignInScope('FIRST_VALUE', " ");
$_smarty_tpl->_assignInScope('SECOND_VALUE', " ");
$_smarty_tpl->_assignInScope('THIRD_VALUE', " ");
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['DATA']->value, 'VALUES');
$_smarty_tpl->tpl_vars['VALUES']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['VALUES']->value) {
$_smarty_tpl->tpl_vars['VALUES']->do_else = false;
?><tr><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['VALUES']->value, 'VALUE', false, 'NAME');
$_smarty_tpl->tpl_vars['VALUE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['NAME']->value => $_smarty_tpl->tpl_vars['VALUE']->value) {
$_smarty_tpl->tpl_vars['VALUE']->do_else = false;
ob_start();
echo $_smarty_tpl->tpl_vars['FIRST_FIELD']->value;
$_prefixVariable5 = ob_get_clean();
if (($_smarty_tpl->tpl_vars['NAME']->value == $_smarty_tpl->tpl_vars['FIRST_FIELD']->value || call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'strstr' ][ 0 ], array( $_smarty_tpl->tpl_vars['NAME']->value,$_prefixVariable5 ))) && ($_smarty_tpl->tpl_vars['FIRST_VALUE']->value == $_smarty_tpl->tpl_vars['VALUE']->value || $_smarty_tpl->tpl_vars['FIRST_VALUE']->value == " ")) {
if ($_smarty_tpl->tpl_vars['FIRST_VALUE']->value == " " || $_smarty_tpl->tpl_vars['VALUE']->value == "-") {?><td class="summary"><?php echo $_smarty_tpl->tpl_vars['VALUE']->value;?>
</td><?php } else { ?><td class="summary"><?php echo " ";?>
</td><?php }
if ($_smarty_tpl->tpl_vars['VALUE']->value != " ") {
$_smarty_tpl->_assignInScope('FIRST_VALUE', $_smarty_tpl->tpl_vars['VALUE']->value);
}
} elseif (($_smarty_tpl->tpl_vars['NAME']->value == $_smarty_tpl->tpl_vars['SECOND_FIELD']->value || call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'strstr' ][ 0 ], array( $_smarty_tpl->tpl_vars['NAME']->value,$_smarty_tpl->tpl_vars['SECOND_FIELD']->value ))) && ($_smarty_tpl->tpl_vars['SECOND_VALUE']->value == $_smarty_tpl->tpl_vars['VALUE']->value || $_smarty_tpl->tpl_vars['SECOND_VALUE']->value == " ")) {
if ($_smarty_tpl->tpl_vars['SECOND_VALUE']->value == " " || $_smarty_tpl->tpl_vars['VALUE']->value == "-") {?><td class="summary"><?php echo $_smarty_tpl->tpl_vars['VALUE']->value;?>
</td><?php } else { ?><td class="summary"><?php echo " ";?>
</td><?php }
if ($_smarty_tpl->tpl_vars['VALUE']->value != " ") {
$_smarty_tpl->_assignInScope('SECOND_VALUE', $_smarty_tpl->tpl_vars['VALUE']->value);
}
} elseif (($_smarty_tpl->tpl_vars['NAME']->value == $_smarty_tpl->tpl_vars['THIRD_FIELD']->value || call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'strstr' ][ 0 ], array( $_smarty_tpl->tpl_vars['NAME']->value,$_smarty_tpl->tpl_vars['THIRD_FIELD']->value ))) && ($_smarty_tpl->tpl_vars['THIRD_VALUE']->value == $_smarty_tpl->tpl_vars['VALUE']->value || $_smarty_tpl->tpl_vars['THIRD_VALUE']->value == " ")) {
if ($_smarty_tpl->tpl_vars['THIRD_VALUE']->value == " " || $_smarty_tpl->tpl_vars['VALUE']->value == "-") {?><td class="summary"><?php echo $_smarty_tpl->tpl_vars['VALUE']->value;?>
</td><?php } else { ?><td class="summary"><?php echo " ";?>
</td><?php }
if ($_smarty_tpl->tpl_vars['VALUE']->value != " ") {
$_smarty_tpl->_assignInScope('THIRD_VALUE', $_smarty_tpl->tpl_vars['VALUE']->value);
}
} else { ?><td><?php echo $_smarty_tpl->tpl_vars['VALUE']->value;?>
</td><?php if ($_smarty_tpl->tpl_vars['NAME']->value == $_smarty_tpl->tpl_vars['FIRST_FIELD']->value || call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'strstr' ][ 0 ], array( $_smarty_tpl->tpl_vars['NAME']->value,$_smarty_tpl->tpl_vars['FIRST_FIELD']->value ))) {
$_smarty_tpl->_assignInScope('FIRST_VALUE', $_smarty_tpl->tpl_vars['VALUE']->value);
} elseif ($_smarty_tpl->tpl_vars['NAME']->value == $_smarty_tpl->tpl_vars['SECOND_FIELD']->value || call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'strstr' ][ 0 ], array( $_smarty_tpl->tpl_vars['NAME']->value,$_smarty_tpl->tpl_vars['SECOND_FIELD']->value ))) {
$_smarty_tpl->_assignInScope('SECOND_VALUE', $_smarty_tpl->tpl_vars['VALUE']->value);
} elseif ($_smarty_tpl->tpl_vars['NAME']->value == $_smarty_tpl->tpl_vars['THIRD_FIELD']->value || call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'strstr' ][ 0 ], array( $_smarty_tpl->tpl_vars['NAME']->value,$_smarty_tpl->tpl_vars['THIRD_FIELD']->value ))) {
$_smarty_tpl->_assignInScope('THIRD_VALUE', $_smarty_tpl->tpl_vars['VALUE']->value);
}
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
} else {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['DATA']->value, 'VALUES');
$_smarty_tpl->tpl_vars['VALUES']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['VALUES']->value) {
$_smarty_tpl->tpl_vars['VALUES']->do_else = false;
?><tr><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['VALUES']->value, 'VALUE', false, 'NAME');
$_smarty_tpl->tpl_vars['VALUE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['NAME']->value => $_smarty_tpl->tpl_vars['VALUE']->value) {
$_smarty_tpl->tpl_vars['VALUE']->do_else = false;
?><td><?php echo $_smarty_tpl->tpl_vars['VALUE']->value;?>
</td><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?></table><?php if ((isset($_smarty_tpl->tpl_vars['LIMIT_EXCEEDED']->value)) && $_smarty_tpl->tpl_vars['LIMIT_EXCEEDED']->value) {?><center><?php echo vtranslate('LBL_LIMIT_EXCEEDED',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="pull-right"><a href="#top" ><?php echo vtranslate('LBL_TOP',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></span></center><?php }
} else { ?><div style="text-align: center; border: 1px solid #DDD; padding: 20px; font-size: 15px;"><?php echo vtranslate('LBL_NO_DATA_AVAILABLE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</div><?php }?></div></div><br>

<?php }
}
