<?php
/* Smarty version 4.5.5, created on 2025-10-08 07:30:57
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Vtiger\uitypes\ProductTax.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e61331a9d636_87201035',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0f83c1fec9d4524c71f2b4bf2e87f599edfa6772' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Vtiger\\uitypes\\ProductTax.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e61331a9d636_87201035 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('tax_count', 1);
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['TAXCLASS_DETAILS']->value, 'tax', false, 'count');
$_smarty_tpl->tpl_vars['tax']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['count']->value => $_smarty_tpl->tpl_vars['tax']->value) {
$_smarty_tpl->tpl_vars['tax']->do_else = false;
if ($_smarty_tpl->tpl_vars['tax']->value['check_value'] == 1) {
$_smarty_tpl->_assignInScope('check_value', "checked");
$_smarty_tpl->_assignInScope('show_value', "visible");
} else {
$_smarty_tpl->_assignInScope('check_value', '');
$_smarty_tpl->_assignInScope('show_value', "hidden");
}
if ($_smarty_tpl->tpl_vars['tax_count']->value > 1) {?><td class="fieldLabel alignMiddle<?php if ((isset($_smarty_tpl->tpl_vars['PULL_RIGHT']->value)) && $_smarty_tpl->tpl_vars['PULL_RIGHT']->value) {?> pull-right<?php }?>"> <label class=""><?php }?><span class="taxLabel alignBottom"><?php echo vtranslate($_smarty_tpl->tpl_vars['tax']->value['taxlabel'],$_smarty_tpl->tpl_vars['MODULE']->value);?>
<span class="paddingLeft10px">(%)</span></span><span style="padding-left: 10px;"><input style="top: 3px;" type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['tax']->value['check_name'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['tax']->value['check_name'];?>
" class="taxes" data-tax-name=<?php echo $_smarty_tpl->tpl_vars['tax']->value['taxname'];?>
 <?php echo $_smarty_tpl->tpl_vars['check_value']->value;?>
></span></label></td><td class="fieldValue"><?php if ($_smarty_tpl->tpl_vars['tax']->value['type'] == 'Fixed') {?><input type="text" id="<?php echo $_smarty_tpl->tpl_vars['tax']->value['taxname'];?>
" class="inputElement<?php if ($_smarty_tpl->tpl_vars['show_value']->value == "hidden") {?> hide <?php } else { ?> show <?php }?>" name="<?php echo $_smarty_tpl->tpl_vars['tax']->value['taxname'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['tax']->value['percentage'];?>
" data-rule-required="true" data-rule-inventory_percentage="true" /><?php } else { ?><div class="<?php if ($_smarty_tpl->tpl_vars['show_value']->value == "hidden") {?>hide<?php }?>" id="<?php echo $_smarty_tpl->tpl_vars['tax']->value['taxname'];?>
" style="width:70%;"><div class="regionsList"><table class="table table-bordered themeTableColor"><tr><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" style="width:70%"><label><?php echo vtranslate('LBL_DEFAULT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></td><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" style="text-align: center; width:30%;"><input class="inputElement" type="text" name="<?php echo $_smarty_tpl->tpl_vars['tax']->value['taxname'];?>
_defaultPercentage" value="<?php echo $_smarty_tpl->tpl_vars['tax']->value['percentage'];?>
" data-rule-required="true" data-rule-inventory_percentage="true" style="width: 80px;" /></td></tr><?php $_smarty_tpl->_assignInScope('i', 0);
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tax']->value['regions'], 'REGIONS_INFO', false, NULL, 'i', array (
));
$_smarty_tpl->tpl_vars['REGIONS_INFO']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['REGIONS_INFO']->value) {
$_smarty_tpl->tpl_vars['REGIONS_INFO']->do_else = false;
?><tr><td><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['REGIONS_INFO']->value['list'], 'TAX_REGION_ID');
$_smarty_tpl->tpl_vars['TAX_REGION_ID']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['TAX_REGION_ID']->value) {
$_smarty_tpl->tpl_vars['TAX_REGION_ID']->do_else = false;
ob_start();
echo $_smarty_tpl->tpl_vars['TAX_REGION_ID']->value;
$_prefixVariable1 = ob_get_clean();
$_smarty_tpl->_assignInScope('TAX_REGION_MODEL', Inventory_TaxRegion_Model::getRegionModel($_prefixVariable1));?><input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['tax']->value['taxname'];?>
_regions[<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
][list][]" value="<?php echo $_smarty_tpl->tpl_vars['TAX_REGION_MODEL']->value->getId();?>
" /><span class="label label-info displayInlineBlock" style="margin: 2px 1px;"><?php echo $_smarty_tpl->tpl_vars['TAX_REGION_MODEL']->value->getName();?>
</span><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></td><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" style="text-align: center;"><input class="inputElement" type="text" name="<?php echo $_smarty_tpl->tpl_vars['tax']->value['taxname'];?>
_regions[<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
][value]" value="<?php echo $_smarty_tpl->tpl_vars['REGIONS_INFO']->value['value'];?>
" data-rule-required="true" data-rule-inventory_percentage="true" style="width: 80px;" /></td></tr><?php $_smarty_tpl->_assignInScope('i', $_smarty_tpl->tpl_vars['i']->value+1);
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></table></div></div><?php }?></td><?php $_smarty_tpl->_assignInScope('tax_count', $_smarty_tpl->tpl_vars['tax_count']->value+1);
if ($_smarty_tpl->tpl_vars['COUNTER']->value == 2) {?></tr><tr><?php $_smarty_tpl->_assignInScope('COUNTER', 1);
} else {
$_smarty_tpl->_assignInScope('COUNTER', $_smarty_tpl->tpl_vars['COUNTER']->value+1);
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
