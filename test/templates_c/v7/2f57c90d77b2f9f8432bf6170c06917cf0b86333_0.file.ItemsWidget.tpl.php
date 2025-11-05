<?php
/* Smarty version 4.5.5, created on 2025-11-05 05:33:36
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\ITS4YouItemsWidget\ItemsWidget.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690ae1b0f22545_95881142',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2f57c90d77b2f9f8432bf6170c06917cf0b86333' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\ITS4YouItemsWidget\\ItemsWidget.tpl',
      1 => 1762116939,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690ae1b0f22545_95881142 (Smarty_Internal_Template $_smarty_tpl) {
if (!empty($_REQUEST['record']) && class_exists('ITSGPSForce_GpsRecordData_Helper')) {
$_smarty_tpl->_assignInScope('GPS_PRODUCTS_DATA_BY_SO', ITSGPSForce_GpsRecordData_Helper::getSORecordGpsForceProductsData($_REQUEST['record']));
}?><div><div class="summaryView"><div class="summaryViewHeader"><h4 class="display-inline-block"><?php echo vtranslate('LBL_ITEM_DETAILS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</h4></div><div class="summaryViewFields"><?php echo $_smarty_tpl->tpl_vars['MODULE_SUMMARY']->value;?>
</div><table class="summary-table no-border"><tbody><tr class="summaryViewHeader"><td class="fieldLabel" width="57%" align="left"><label class="muted textOverflowEllipsis"><?php echo vtranslate('LBL_ITEM_NAME',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</label></td><td class="fieldLabel" width="20%" align="right" style="padding-right: 0;"><label class="muted textOverflowEllipsis"><?php echo vtranslate('LBL_QTY',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</label></td><td class="fieldLabel" width="23%" align="right" style="padding-right: 0;"><label class="muted textOverflowEllipsis"><?php echo vtranslate('LBL_NET_PRICE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</label></td></tr><?php $_smarty_tpl->_assignInScope('FINAL_DETAILS', $_smarty_tpl->tpl_vars['PRODUCTS']->value[1]['final_details']);
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['PRODUCTS']->value, 'data', false, 'row_no');
$_smarty_tpl->tpl_vars['data']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['row_no']->value => $_smarty_tpl->tpl_vars['data']->value) {
$_smarty_tpl->tpl_vars['data']->do_else = false;
$_smarty_tpl->_assignInScope('productName', ("productName").($_smarty_tpl->tpl_vars['row_no']->value));
$_smarty_tpl->_assignInScope('qty', ("qty").($_smarty_tpl->tpl_vars['row_no']->value));
$_smarty_tpl->_assignInScope('netPrice', ("netPrice").($_smarty_tpl->tpl_vars['row_no']->value));
if (!empty($_smarty_tpl->tpl_vars['data']->value["productName".((string)$_smarty_tpl->tpl_vars['row_no']->value)])) {?><tr class="summaryViewEntries"><td class="fieldValue" style="white-space: normal;"><span style="display: inline-block;"><div style="white-space: normal;"><?php if ($_smarty_tpl->tpl_vars['data']->value["productDeleted".((string)$_smarty_tpl->tpl_vars['row_no']->value)]) {
echo $_smarty_tpl->tpl_vars['data']->value["productName".((string)$_smarty_tpl->tpl_vars['row_no']->value)];
} else { ?><h5><a class="fieldValue" href="index.php?module=<?php echo $_smarty_tpl->tpl_vars['data']->value["entityType".((string)$_smarty_tpl->tpl_vars['row_no']->value)];?>
&view=Detail&record=<?php echo $_smarty_tpl->tpl_vars['data']->value["hdnProductId".((string)$_smarty_tpl->tpl_vars['row_no']->value)];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['data']->value["productName".((string)$_smarty_tpl->tpl_vars['row_no']->value)];?>
</a><?php if (class_exists('ITS4YouImport_GpsRecordData_Helper') && 'SalesOrder' == $_smarty_tpl->tpl_vars['MODULE_NAME']->value) {
if (ITSGPSForce_GpsProductCategories_Helper::isGpsProduct($_smarty_tpl->tpl_vars['data']->value["hdnProductId".((string)$_smarty_tpl->tpl_vars['row_no']->value)]) && $_smarty_tpl->tpl_vars['data']->value["qty".((string)$_smarty_tpl->tpl_vars['row_no']->value)] > $_smarty_tpl->tpl_vars['GPS_PRODUCTS_DATA_BY_SO']->value[$_smarty_tpl->tpl_vars['data']->value["hdnProductId".((string)$_smarty_tpl->tpl_vars['row_no']->value)]] && 'Cancelled' != $_smarty_tpl->tpl_vars['RECORD']->value->get('sostatus')) {?>&nbsp;<a href="javascript:;"><span class="tab-icon" data-gps-name="set-gps" data-product-id="<?php echo $_smarty_tpl->tpl_vars['data']->value["hdnProductId".((string)$_smarty_tpl->tpl_vars['row_no']->value)];?>
"><img src="layouts/v7/modules/ITSGPSForce/ITSGPSForce.png" title="<?php echo vtranslate('ITSGPSForce','ITSGPSForce');?>
"></span></a>&nbsp;<?php if (!empty($_smarty_tpl->tpl_vars['GPS_PRODUCTS_DATA_BY_SO']->value[$_smarty_tpl->tpl_vars['data']->value["hdnProductId".((string)$_smarty_tpl->tpl_vars['row_no']->value)]])) {
echo $_smarty_tpl->tpl_vars['GPS_PRODUCTS_DATA_BY_SO']->value[$_smarty_tpl->tpl_vars['data']->value["hdnProductId".((string)$_smarty_tpl->tpl_vars['row_no']->value)]];
} else { ?>0<?php }?>/<?php echo $_smarty_tpl->tpl_vars['data']->value["qty".((string)$_smarty_tpl->tpl_vars['row_no']->value)];
}
}
if (class_exists('ITSONEForce_OneProductCategories_Helper')) {
if (ITSONEForce_OneProductCategories_Helper::isSimProduct($_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["hdnProductId".((string)$_smarty_tpl->tpl_vars['INDEX']->value)]) && $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["qty".((string)$_smarty_tpl->tpl_vars['INDEX']->value)] > $_smarty_tpl->tpl_vars['ONE_PRODUCTS_DATA_BY_SO']->value[$_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["hdnProductId".((string)$_smarty_tpl->tpl_vars['INDEX']->value)]] && 'Cancelled' != $_smarty_tpl->tpl_vars['RECORD']->value->get('sostatus')) {?>&nbsp;<a href="javascript:;"><span class="tab-icon" data-one-name="set-one" data-product-id="<?php echo $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["hdnProductId".((string)$_smarty_tpl->tpl_vars['INDEX']->value)];?>
"><img src="layouts/v7/modules/ITSONEForce/ITSONEForce.png" title="<?php echo vtranslate('ITSONEForce','ITSONEForce');?>
" height="18px"></span></a>&nbsp;<?php if (!empty($_smarty_tpl->tpl_vars['ONE_PRODUCTS_DATA_BY_SO']->value[$_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["hdnProductId".((string)$_smarty_tpl->tpl_vars['INDEX']->value)]])) {
echo $_smarty_tpl->tpl_vars['ONE_PRODUCTS_DATA_BY_SO']->value[$_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["hdnProductId".((string)$_smarty_tpl->tpl_vars['INDEX']->value)]];
} else { ?>0<?php }?>/<?php echo $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["qty".((string)$_smarty_tpl->tpl_vars['INDEX']->value)];
}
}?></h5><?php }?></div><?php if ($_smarty_tpl->tpl_vars['data']->value["productDeleted".((string)$_smarty_tpl->tpl_vars['row_no']->value)]) {?><div class="redColor deletedItem"><?php if (empty($_smarty_tpl->tpl_vars['data']->value["productName".((string)$_smarty_tpl->tpl_vars['row_no']->value)])) {
echo vtranslate('LBL_THIS_LINE_ITEM_IS_DELETED_FROM_THE_SYSTEM_PLEASE_REMOVE_THIS_LINE_ITEM',$_smarty_tpl->tpl_vars['MODULE']->value);
} else {
echo vtranslate('LBL_THIS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo $_smarty_tpl->tpl_vars['data']->value["entityType".((string)$_smarty_tpl->tpl_vars['row_no']->value)];?>
 <?php echo vtranslate('LBL_IS_DELETED_FROM_THE_SYSTEM_PLEASE_REMOVE_OR_REPLACE_THIS_ITEM',$_smarty_tpl->tpl_vars['MODULE']->value);
}?></div><?php }?><div><?php echo $_smarty_tpl->tpl_vars['data']->value["subprod_names".((string)$_smarty_tpl->tpl_vars['row_no']->value)];?>
</div></span></td><td class="fieldValue"><div align="right"><span style="display: inline-block;"><?php echo decimalFormat($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['qty']->value]);?>
</span></div></td><td class="fieldValue"><div align="right"><span style="display: inline-block;"><?php echo ITS4YouItemsWidget_Currency_UIType::convertToUserFormat($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['netPrice']->value],null,false);?>
</span></div></td></tr><?php } else { ?><tr class="summaryViewEntries"><td class="fieldValue" style="white-space: normal;"><?php echo vtranslate('LBL_NO_RECORDS_FOUND',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</td></tr><?php }
}
if ($_smarty_tpl->tpl_vars['data']->do_else) {
?><tr class="summaryViewEntries"><td class="fieldValue" style="white-space: normal;"><?php echo vtranslate('LBL_NO_RECORDS_FOUND',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</td></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
if ($_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['taxtype'] == 'group' && 0 < $_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['tax_totalamount'] || '0.00' != $_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['discountTotal_final']) {?><tr class="summaryViewEntries"><td class="fieldValue">&nbsp;</td><td class="fieldValue"><div align="right"><h6><?php echo vtranslate('LBL_PRE_TAX_TOTAL',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</h6></div></td><td class="fieldValue"><div align="right"><span style="display: inline-block;margin-bottom: 5px;"><?php echo ITS4YouItemsWidget_Currency_UIType::convertToUserFormat($_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['preTaxTotal'],null,false);?>
</span></div></td></tr><?php }
if ('0.00' != $_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['discountTotal_final']) {?><tr class="summaryViewEntries"><td class="fieldValue">&nbsp;</td><td class="fieldValue"><div align="right"><span style="display: inline-block;margin-bottom: 5px;"><?php echo vtranslate('LBL_OVERALL_DISCOUNT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</span></div></td><td class="fieldValue"><div align="right"><h6>(-)&nbsp;<?php echo ITS4YouItemsWidget_Currency_UIType::convertToUserFormat($_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['discountTotal_final'],null,false);?>
</h6></div></td></tr><?php }
if ($_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['taxtype'] == 'group' && 0 < $_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['tax_totalamount']) {?><tr class="summaryViewEntries"><td class="fieldValue">&nbsp;</td><td class="fieldValue"><div align="right"><h6><?php ob_start();
echo vtranslate('LBL_TOTAL_AFTER_DISCOUNT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);
$_prefixVariable1=ob_get_clean();
ob_start();
echo ITS4YouItemsWidget_Currency_UIType::convertToUserFormat($_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['totalAfterDiscount']);
$_prefixVariable2=ob_get_clean();
ob_start();
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['taxes'], 'tax_details');
$_smarty_tpl->tpl_vars['tax_details']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['tax_details']->value) {
$_smarty_tpl->tpl_vars['tax_details']->do_else = false;
echo (string)$_smarty_tpl->tpl_vars['tax_details']->value['taxlabel'];
echo " : \t";
echo ITS4YouItemsWidget_Currency_UIType::convertToUserFormat($_smarty_tpl->tpl_vars['tax_details']->value['percentage']);
echo "% ";
echo vtranslate('LBL_OF',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);
echo " ";
if ($_smarty_tpl->tpl_vars['tax_details']->value['method'] == 'Compound') {
echo "(";
}
echo ITS4YouItemsWidget_Currency_UIType::convertToUserFormat($_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['totalAfterDiscount']);
if ($_smarty_tpl->tpl_vars['tax_details']->value['method'] == 'Compound') {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tax_details']->value['compoundon'], 'COMPOUND_TAX_ID');
$_smarty_tpl->tpl_vars['COMPOUND_TAX_ID']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['COMPOUND_TAX_ID']->value) {
$_smarty_tpl->tpl_vars['COMPOUND_TAX_ID']->do_else = false;
if ($_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['taxes'][$_smarty_tpl->tpl_vars['COMPOUND_TAX_ID']->value]['taxlabel']) {
echo " + ";
echo (string)$_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['taxes'][$_smarty_tpl->tpl_vars['COMPOUND_TAX_ID']->value]['taxlabel'];
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
echo ")";
}
echo " = ";
echo ITS4YouItemsWidget_Currency_UIType::convertToUserFormat($_smarty_tpl->tpl_vars['tax_details']->value['amount']);
echo "<br />";
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
$_prefixVariable3=ob_get_clean();
ob_start();
echo vtranslate('LBL_TOTAL_TAX_AMOUNT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);
$_prefixVariable4=ob_get_clean();
ob_start();
echo ITS4YouItemsWidget_Currency_UIType::convertToUserFormat($_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['tax_totalamount']);
$_prefixVariable5=ob_get_clean();
$_smarty_tpl->_assignInScope('GROUP_TAX_INFO', $_prefixVariable1." = ".$_prefixVariable2."<br /><br />".$_prefixVariable3."<br />".$_prefixVariable4." = ".$_prefixVariable5);?>(+)&nbsp;<strong><a class="inventoryLineItemDetails" tabindex="0" role="tooltip" href="javascript:void(0)" id="finalTax" data-trigger ="focus" data-placement ="left" title = "<?php echo vtranslate('LBL_TAX',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
" data-toggle ="popover" data-content="<?php echo $_smarty_tpl->tpl_vars['GROUP_TAX_INFO']->value;?>
"><?php echo vtranslate('LBL_TAX',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</a></strong></h6></div></td><td class="fieldValue"><div align="right"><span style="display: inline-block;margin-bottom: 5px;">(+)&nbsp;<?php echo ITS4YouItemsWidget_Currency_UIType::convertToUserFormat($_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['tax_totalamount'],null,false);?>
</span></div></td></tr><?php }?><tr class="summaryViewEntries"><td class="fieldValue">&nbsp;</td><td class="fieldValue"><div align="right"><span style="display: inline-block;margin-bottom: 5px;"><strong><?php echo vtranslate('LBL_GRAND_TOTAL',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong></span></div></td><td class="fieldValue"><div align="right"><span style="display: inline-block;margin-bottom: 5px;"><?php echo ITS4YouItemsWidget_Currency_UIType::convertToUserFormat($_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['grandTotal'],null,false);?>
</span></div></td></tr></tbody></table></div></div>
<?php }
}
