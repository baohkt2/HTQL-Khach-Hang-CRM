<?php
/* Smarty version 4.5.5, created on 2025-09-19 07:59:35
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Inventory\partials\LineItemsContent.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68cd0d67806538_37069715',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2bab582023d9cf4e4fbd82d6e30413e9d4dff3f6' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Inventory\\partials\\LineItemsContent.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68cd0d67806538_37069715 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('deleted', ("deleted").($_smarty_tpl->tpl_vars['row_no']->value));
$_smarty_tpl->_assignInScope('image', ("productImage").($_smarty_tpl->tpl_vars['row_no']->value));
$_smarty_tpl->_assignInScope('purchaseCost', ("purchaseCost").($_smarty_tpl->tpl_vars['row_no']->value));
$_smarty_tpl->_assignInScope('margin', ("margin").($_smarty_tpl->tpl_vars['row_no']->value));
$_smarty_tpl->_assignInScope('hdnProductId', ("hdnProductId").($_smarty_tpl->tpl_vars['row_no']->value));
$_smarty_tpl->_assignInScope('productName', ("productName").($_smarty_tpl->tpl_vars['row_no']->value));
$_smarty_tpl->_assignInScope('comment', ("comment").($_smarty_tpl->tpl_vars['row_no']->value));
$_smarty_tpl->_assignInScope('productDescription', ("productDescription").($_smarty_tpl->tpl_vars['row_no']->value));
$_smarty_tpl->_assignInScope('qtyInStock', ("qtyInStock").($_smarty_tpl->tpl_vars['row_no']->value));
$_smarty_tpl->_assignInScope('qty', ("qty").($_smarty_tpl->tpl_vars['row_no']->value));
$_smarty_tpl->_assignInScope('listPrice', ("listPrice").($_smarty_tpl->tpl_vars['row_no']->value));
$_smarty_tpl->_assignInScope('productTotal', ("productTotal").($_smarty_tpl->tpl_vars['row_no']->value));
$_smarty_tpl->_assignInScope('subproduct_ids', ("subproduct_ids").($_smarty_tpl->tpl_vars['row_no']->value));
$_smarty_tpl->_assignInScope('subprod_names', ("subprod_names").($_smarty_tpl->tpl_vars['row_no']->value));
$_smarty_tpl->_assignInScope('subprod_qty_list', ("subprod_qty_list").($_smarty_tpl->tpl_vars['row_no']->value));
$_smarty_tpl->_assignInScope('entityIdentifier', ("entityType").($_smarty_tpl->tpl_vars['row_no']->value));
$_smarty_tpl->_assignInScope('entityType', (isset($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['entityIdentifier']->value])) ? $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['entityIdentifier']->value] : '');
$_smarty_tpl->_assignInScope('discount_type', ("discount_type").($_smarty_tpl->tpl_vars['row_no']->value));
$_smarty_tpl->_assignInScope('discount_percent', ("discount_percent").($_smarty_tpl->tpl_vars['row_no']->value));
$_smarty_tpl->_assignInScope('checked_discount_percent', ("checked_discount_percent").($_smarty_tpl->tpl_vars['row_no']->value));
$_smarty_tpl->_assignInScope('style_discount_percent', ("style_discount_percent").($_smarty_tpl->tpl_vars['row_no']->value));
$_smarty_tpl->_assignInScope('discount_amount', ("discount_amount").($_smarty_tpl->tpl_vars['row_no']->value));
$_smarty_tpl->_assignInScope('checked_discount_amount', ("checked_discount_amount").($_smarty_tpl->tpl_vars['row_no']->value));
$_smarty_tpl->_assignInScope('style_discount_amount', ("style_discount_amount").($_smarty_tpl->tpl_vars['row_no']->value));
$_smarty_tpl->_assignInScope('checked_discount_zero', ("checked_discount_zero").($_smarty_tpl->tpl_vars['row_no']->value));
$_smarty_tpl->_assignInScope('discountTotal', ("discountTotal").($_smarty_tpl->tpl_vars['row_no']->value));
$_smarty_tpl->_assignInScope('totalAfterDiscount', ("totalAfterDiscount").($_smarty_tpl->tpl_vars['row_no']->value));
$_smarty_tpl->_assignInScope('taxTotal', ("taxTotal").($_smarty_tpl->tpl_vars['row_no']->value));
$_smarty_tpl->_assignInScope('netPrice', ("netPrice").($_smarty_tpl->tpl_vars['row_no']->value));
$_smarty_tpl->_assignInScope('FINAL', (isset($_smarty_tpl->tpl_vars['RELATED_PRODUCTS']->value[1]['final_details'])) ? $_smarty_tpl->tpl_vars['RELATED_PRODUCTS']->value[1]['final_details'] : '');
$_smarty_tpl->_assignInScope('productDeleted', ("productDeleted").($_smarty_tpl->tpl_vars['row_no']->value));
$_smarty_tpl->_assignInScope('productId', (isset($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['hdnProductId']->value])) ? $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['hdnProductId']->value] : '');
$_smarty_tpl->_assignInScope('listPriceValues', Products_Record_Model::getListPriceValues($_smarty_tpl->tpl_vars['productId']->value));
if ($_smarty_tpl->tpl_vars['MODULE']->value == 'PurchaseOrder') {
$_smarty_tpl->_assignInScope('listPriceValues', array());
ob_start();
echo $_smarty_tpl->tpl_vars['RECORD_CURRENCY_RATE']->value;
$_prefixVariable7 = ob_get_clean();
ob_start();
if ((isset($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['purchaseCost']->value])) && (isset($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['qty']->value])) && $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['purchaseCost']->value] && $_smarty_tpl->tpl_vars['RECORD_CURRENCY_RATE']->value && $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['qty']->value]) {
echo (string)(((float)$_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['purchaseCost']->value])/((float)$_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['qty']->value]*(float)$_prefixVariable7));
} else {
echo "0";
}
$_prefixVariable8=ob_get_clean();
$_smarty_tpl->_assignInScope('purchaseCost', $_prefixVariable8);
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['CURRENCIES']->value, 'currency_details');
$_smarty_tpl->tpl_vars['currency_details']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['currency_details']->value) {
$_smarty_tpl->tpl_vars['currency_details']->do_else = false;
$_tmp_array = isset($_smarty_tpl->tpl_vars['listPriceValues']) ? $_smarty_tpl->tpl_vars['listPriceValues']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array[$_smarty_tpl->tpl_vars['currency_details']->value['currency_id']] = $_smarty_tpl->tpl_vars['currency_details']->value['conversionrate']*$_smarty_tpl->tpl_vars['purchaseCost']->value;
$_smarty_tpl->_assignInScope('listPriceValues', $_tmp_array);
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?><td style="text-align:center;"><i class="fa fa-trash deleteRow cursorPointer" title="<?php echo vtranslate('LBL_DELETE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"></i>&nbsp;<a><img src="<?php echo vimage_path('drag.png');?>
" border="0" title="<?php echo vtranslate('LBL_DRAG',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"/></a><input type="hidden" class="rowNumber" value="<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" /></td><?php if ((isset($_smarty_tpl->tpl_vars['IMAGE_EDITABLE']->value)) && $_smarty_tpl->tpl_vars['IMAGE_EDITABLE']->value) {?><td class='lineItemImage' style="text-align:center;"><img src='<?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['image']->value];?>
' height="42" width="42"></td><?php }
if ($_smarty_tpl->tpl_vars['PRODUCT_EDITABLE']->value) {?><td><!-- Product Re-Ordering Feature Code Addition Starts --><input type="hidden" name="hidtax_row_no<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" id="hidtax_row_no<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" value="<?php echo (isset($_smarty_tpl->tpl_vars['tax_row_no']->value)) ? $_smarty_tpl->tpl_vars['tax_row_no']->value : '';?>
"/><!-- Product Re-Ordering Feature Code Addition ends --><div class="itemNameDiv form-inline"><div class="row"><div class="col-lg-10"><div class="input-group" style="width:100%"><input type="text" id="<?php echo $_smarty_tpl->tpl_vars['productName']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['productName']->value;?>
" value="<?php echo (isset($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['productName']->value])) ? $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['productName']->value] : '';?>
" class="productName form-control <?php if ($_smarty_tpl->tpl_vars['row_no']->value != 0) {?> autoComplete <?php }?> " placeholder="<?php echo vtranslate('LBL_TYPE_SEARCH',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"data-rule-required=true <?php if (!empty($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['productName']->value])) {?> disabled="disabled" <?php }?>><?php if ((isset($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['productDeleted']->value])) && !$_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['productDeleted']->value]) {?><span class="input-group-addon cursorPointer clearLineItem" title="<?php echo vtranslate('LBL_CLEAR',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i class="fa fa-times-circle"></i></span><?php }?><input type="hidden" id="<?php echo $_smarty_tpl->tpl_vars['hdnProductId']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['hdnProductId']->value;?>
" value="<?php echo (isset($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['hdnProductId']->value])) ? $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['hdnProductId']->value] : '';?>
" class="selectedModuleId"/><input type="hidden" id="lineItemType<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" name="lineItemType<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['entityType']->value;?>
" class="lineItemType"/></div></div><div class="col-lg-2"><?php if ($_smarty_tpl->tpl_vars['row_no']->value == 0) {?><span class="lineItemPopup cursorPointer" data-popup="ServicesPopup" title="<?php echo vtranslate('Services',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" data-module-name="Services" data-field-name="serviceid"><?php echo Vtiger_Module_Model::getModuleIconPath('Services');?>
</span><span class="lineItemPopup cursorPointer" data-popup="ProductsPopup" title="<?php echo vtranslate('Products',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" data-module-name="Products" data-field-name="productid"><?php echo Vtiger_Module_Model::getModuleIconPath('Products');?>
</span><?php } elseif ($_smarty_tpl->tpl_vars['entityType']->value == '' && $_smarty_tpl->tpl_vars['PRODUCT_ACTIVE']->value == 'true') {?><span class="lineItemPopup cursorPointer" data-popup="ProductsPopup" title="<?php echo vtranslate('Products',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" data-module-name="Products" data-field-name="productid"><?php echo Vtiger_Module_Model::getModuleIconPath('Products');?>
</span><?php } elseif ($_smarty_tpl->tpl_vars['entityType']->value == '' && $_smarty_tpl->tpl_vars['SERVICE_ACTIVE']->value == 'true') {?><span class="lineItemPopup cursorPointer" data-popup="ServicesPopup" title="<?php echo vtranslate('Services',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" data-module-name="Services" data-field-name="serviceid"><?php echo Vtiger_Module_Model::getModuleIconPath('Services');?>
</span><?php } else {
if (($_smarty_tpl->tpl_vars['entityType']->value == 'Services') && ((isset($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['productDeleted']->value])) && !$_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['productDeleted']->value])) {?><span class="lineItemPopup cursorPointer" data-popup="ServicesPopup" title="<?php echo vtranslate('Services',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" data-module-name="Services" data-field-name="serviceid"><?php echo Vtiger_Module_Model::getModuleIconPath('Services');?>
</span><?php } elseif ((!$_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['productDeleted']->value])) {?><span class="lineItemPopup cursorPointer" data-popup="ProductsPopup" title="<?php echo vtranslate('Products',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" data-module-name="Products" data-field-name="productid"><?php echo Vtiger_Module_Model::getModuleIconPath('Products');?>
</span><?php }
}?></div></div></div><input type="hidden" value="<?php echo (isset($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['subproduct_ids']->value])) ? $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['subproduct_ids']->value] : '';?>
" id="<?php echo $_smarty_tpl->tpl_vars['subproduct_ids']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['subproduct_ids']->value;?>
" class="subProductIds" /><div id="<?php echo $_smarty_tpl->tpl_vars['subprod_names']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['subprod_names']->value;?>
" class="subInformation"><span class="subProductsContainer"><?php if ((isset($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['subprod_qty_list']->value]))) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['subprod_qty_list']->value], 'SUB_PRODUCT_INFO', false, 'SUB_PRODUCT_ID');
$_smarty_tpl->tpl_vars['SUB_PRODUCT_INFO']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['SUB_PRODUCT_ID']->value => $_smarty_tpl->tpl_vars['SUB_PRODUCT_INFO']->value) {
$_smarty_tpl->tpl_vars['SUB_PRODUCT_INFO']->do_else = false;
?><em> - <?php echo $_smarty_tpl->tpl_vars['SUB_PRODUCT_INFO']->value['name'];?>
 (<?php echo $_smarty_tpl->tpl_vars['SUB_PRODUCT_INFO']->value['qty'];?>
)<?php if ($_smarty_tpl->tpl_vars['SUB_PRODUCT_INFO']->value['qty'] > getProductQtyInStock($_smarty_tpl->tpl_vars['SUB_PRODUCT_ID']->value)) {?>&nbsp;-&nbsp;<span class="redColor"><?php echo vtranslate('LBL_STOCK_NOT_ENOUGH',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span><?php }?></em><br><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?></span></div><?php if ((isset($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['productDeleted']->value])) && $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['productDeleted']->value]) {?><div class="row-fluid deletedItem redColor"><?php if (empty($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['productName']->value])) {
echo vtranslate('LBL_THIS_LINE_ITEM_IS_DELETED_FROM_THE_SYSTEM_PLEASE_REMOVE_THIS_LINE_ITEM',$_smarty_tpl->tpl_vars['MODULE']->value);
} else {
echo vtranslate('LBL_THIS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo $_smarty_tpl->tpl_vars['entityType']->value;?>
 <?php echo vtranslate('LBL_IS_DELETED_FROM_THE_SYSTEM_PLEASE_REMOVE_OR_REPLACE_THIS_ITEM',$_smarty_tpl->tpl_vars['MODULE']->value);
}?></div><?php } else {
if ($_smarty_tpl->tpl_vars['COMMENT_EDITABLE']->value) {?><div><br><textarea id="<?php echo $_smarty_tpl->tpl_vars['comment']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['comment']->value;?>
" class="lineItemCommentBox"><?php echo (isset($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['comment']->value])) ? decode_html($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['comment']->value]) : '';?>
</textarea></div><?php }
}?></td><?php }?><td><input id="<?php echo $_smarty_tpl->tpl_vars['qty']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['qty']->value;?>
" type="text" class="qty smallInputBox inputElement"data-rule-required=true data-rule-positive=true data-rule-greater_than_zero=true value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['qty']->value])) {
echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['qty']->value];
} else { ?>1<?php }?>"<?php if ($_smarty_tpl->tpl_vars['QUANTITY_EDITABLE']->value == false) {?> disabled=disabled <?php }?> /><?php if ((isset($_smarty_tpl->tpl_vars['PURCHASE_COST_EDITABLE']->value)) && $_smarty_tpl->tpl_vars['PURCHASE_COST_EDITABLE']->value == false && $_smarty_tpl->tpl_vars['MODULE']->value != 'PurchaseOrder') {?><input id="<?php echo $_smarty_tpl->tpl_vars['purchaseCost']->value;?>
" type="hidden" value="<?php if ($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['purchaseCost']->value] && $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['qty']->value]) {
echo ((float)$_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['purchaseCost']->value])/((float)$_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['qty']->value]);
} else { ?>0<?php }?>" /><span style="display:none" class="purchaseCost">0</span><input name="<?php echo $_smarty_tpl->tpl_vars['purchaseCost']->value;?>
" type="hidden" value="<?php if ($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['purchaseCost']->value]) {
echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['purchaseCost']->value];
} else { ?>0<?php }?>" /><?php }
if ((isset($_smarty_tpl->tpl_vars['MARGIN_EDITABLE']->value)) && $_smarty_tpl->tpl_vars['MARGIN_EDITABLE']->value == false) {?><input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['margin']->value;?>
" value="<?php if ($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['margin']->value]) {
echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['margin']->value];
} else { ?>0<?php }?>"></span><span class="margin pull-right" style="display:none"><?php if ($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['margin']->value]) {
echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['margin']->value];
} else { ?>0<?php }?></span><?php }
if ($_smarty_tpl->tpl_vars['MODULE']->value != 'PurchaseOrder') {?><br><span class="stockAlert redColor <?php if ((isset($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['qty']->value])) && $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['qty']->value] <= $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['qtyInStock']->value]) {?>hide<?php }?>" ><?php echo vtranslate('LBL_STOCK_NOT_ENOUGH',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<br><?php echo vtranslate('LBL_MAX_QTY_SELECT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<span class="maxQuantity"><?php echo (isset($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['qtyInStock']->value])) ? $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['qtyInStock']->value] : '';?>
</span></span><?php }?></td><?php if ((isset($_smarty_tpl->tpl_vars['PURCHASE_COST_EDITABLE']->value)) && $_smarty_tpl->tpl_vars['PURCHASE_COST_EDITABLE']->value) {?><td><input id="<?php echo $_smarty_tpl->tpl_vars['purchaseCost']->value;?>
" type="hidden" value="<?php if ($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['purchaseCost']->value] && $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['qty']->value]) {
echo ((float)$_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['purchaseCost']->value])/((float)$_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['qty']->value]);
} else { ?>0<?php }?>" /><input name="<?php echo $_smarty_tpl->tpl_vars['purchaseCost']->value;?>
" type="hidden" value="<?php if ($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['purchaseCost']->value]) {
echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['purchaseCost']->value];
} else { ?>0<?php }?>" /><span class="pull-right purchaseCost"><?php if ($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['purchaseCost']->value]) {
echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['purchaseCost']->value];
} else { ?>0<?php }?></span></td><?php }
if ($_smarty_tpl->tpl_vars['LIST_PRICE_EDITABLE']->value) {?><td><div><input id="<?php echo $_smarty_tpl->tpl_vars['listPrice']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['listPrice']->value;?>
" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['listPrice']->value])) {
echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['listPrice']->value];
} else { ?>0<?php }?>" type="text"data-rule-required=true data-rule-positive=true class="listPrice smallInputBox inputElement" data-is-price-changed="<?php if ($_smarty_tpl->tpl_vars['RECORD_ID']->value && $_smarty_tpl->tpl_vars['row_no']->value != 0) {?>true<?php } else { ?>false<?php }?>" list-info='<?php if ((isset($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['listPrice']->value]))) {
echo Zend_Json::encode($_smarty_tpl->tpl_vars['listPriceValues']->value);
}?>' data-base-currency-id="<?php ob_start();
echo $_smarty_tpl->tpl_vars['entityType']->value;
$_prefixVariable9 = ob_get_clean();
echo getProductBaseCurrency($_smarty_tpl->tpl_vars['productId']->value,$_prefixVariable9);?>
" />&nbsp;<?php $_smarty_tpl->_assignInScope('PRICEBOOK_MODULE_MODEL', Vtiger_Module_Model::getInstance('PriceBooks'));
if ($_smarty_tpl->tpl_vars['PRICEBOOK_MODULE_MODEL']->value->isPermitted('DetailView') && $_smarty_tpl->tpl_vars['MODULE']->value != 'PurchaseOrder') {?><span class="priceBookPopup cursorPointer" data-popup="Popup" title="<?php echo vtranslate('PriceBooks',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" data-module-name="PriceBooks" style="float:left"><?php echo Vtiger_Module_Model::getModuleIconPath('PriceBooks');?>
</span><?php }?></div><div style="clear:both"></div><?php if ($_smarty_tpl->tpl_vars['ITEM_DISCOUNT_AMOUNT_EDITABLE']->value || $_smarty_tpl->tpl_vars['ITEM_DISCOUNT_PERCENT_EDITABLE']->value) {?><div><span>(-)&nbsp;<strong><a href="javascript:void(0)" class="individualDiscount"><?php echo vtranslate('LBL_DISCOUNT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<span class="itemDiscount"><?php if ((isset($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['discount_type']->value])) && $_smarty_tpl->tpl_vars['ITEM_DISCOUNT_PERCENT_EDITABLE']->value && $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['discount_type']->value] == 'percentage') {?>(<?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['discount_percent']->value];?>
%)<?php } elseif ((isset($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['discount_type']->value])) && $_smarty_tpl->tpl_vars['ITEM_DISCOUNT_AMOUNT_EDITABLE']->value && $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['discount_type']->value] == 'amount') {?>(<?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['discount_amount']->value];?>
)<?php } else { ?>(0)<?php }?></span></a> : </strong></span></div><div class="discountUI validCheck hide" id="discount_div<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
"><?php $_smarty_tpl->_assignInScope('DISCOUNT_TYPE', "zero");
if (!empty($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['discount_type']->value])) {
$_smarty_tpl->_assignInScope('DISCOUNT_TYPE', $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['discount_type']->value]);
}?><input type="hidden" id="discount_type<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" name="discount_type<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['DISCOUNT_TYPE']->value;?>
" class="discount_type" /><p class="popover_title hide"><?php echo vtranslate('LBL_SET_DISCOUNT_FOR',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 : <span class="variable"><?php echo (isset($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['productTotal']->value])) && $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['productTotal']->value];?>
</span></p><table width="100%" border="0" cellpadding="5" cellspacing="0" class="table table-nobordered popupTable"><!-- TODO : discount price and amount are hide by default we need to check id they are already selected if so we should not hide them  --><tr><td><input type="radio" name="discount<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" <?php echo (isset($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['checked_discount_zero']->value])) ? $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['checked_discount_zero']->value] : '';?>
 <?php if (empty($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['discount_type']->value])) {?>checked<?php }?> class="discounts" data-discount-type="zero" />&nbsp;<?php echo vtranslate('LBL_ZERO_DISCOUNT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td><td><!-- Make the discount value as zero --><input type="hidden" class="discountVal" value="0" /></td></tr><?php if ($_smarty_tpl->tpl_vars['ITEM_DISCOUNT_PERCENT_EDITABLE']->value) {?><tr><td><input type="radio" name="discount<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" <?php echo (isset($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['checked_discount_percent']->value])) ? $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['checked_discount_percent']->value] : '';?>
 class="discounts" data-discount-type="percentage" />&nbsp; %<?php echo vtranslate('LBL_OF_PRICE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td><td><span class="pull-right">&nbsp;%</span><input type="text" data-rule-positive=true data-rule-inventory_percentage=true id="discount_percentage<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" name="discount_percentage<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" value="<?php echo (isset($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['discount_percent']->value])) ? $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['discount_percent']->value] : '';?>
" class="discount_percentage span1 pull-right discountVal <?php if (empty($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['checked_discount_percent']->value])) {?>hide<?php }?>" /></td></tr><?php }
if ($_smarty_tpl->tpl_vars['ITEM_DISCOUNT_AMOUNT_EDITABLE']->value) {?><tr><td class="LineItemDirectPriceReduction"><input type="radio" name="discount<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" <?php echo (isset($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['checked_discount_amount']->value])) ? $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['checked_discount_amount']->value] : '';?>
 class="discounts" data-discount-type="amount" />&nbsp;<?php echo vtranslate('LBL_DIRECT_PRICE_REDUCTION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td><td><input type="text" data-rule-positive=true id="discount_amount<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" name="discount_amount<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" value="<?php echo (isset($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['discount_amount']->value])) ? $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['discount_amount']->value] : '';?>
" class="span1 pull-right discount_amount discountVal <?php if (empty($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['checked_discount_amount']->value])) {?>hide<?php }?>"/></td></tr><?php }?></table></div><div style="width:150px;"><strong><?php echo vtranslate('LBL_TOTAL_AFTER_DISCOUNT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 :</strong></div><?php }?><div class="individualTaxContainer <?php if ($_smarty_tpl->tpl_vars['IS_GROUP_TAX_TYPE']->value) {?>hide<?php }?>">(+)&nbsp;<strong><a href="javascript:void(0)" class="individualTax"><?php echo vtranslate('LBL_TAX',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 </a> : </strong></div><span class="taxDivContainer"><div class="taxUI hide" id="tax_div<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
"><p class="popover_title hide"><?php echo vtranslate('LBL_SET_TAX_FOR',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 : <span class="variable"><?php echo (isset($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['totalAfterDiscount']->value])) ? $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['totalAfterDiscount']->value] : '';?>
</span></p><?php if ((isset($_smarty_tpl->tpl_vars['data']->value['taxes'])) && $_smarty_tpl->tpl_vars['data']->value['taxes'] && php7_count($_smarty_tpl->tpl_vars['data']->value['taxes']) > 0) {?><div class="individualTaxDiv"><!-- we will form the table with all taxes --><table width="100%" border="0" cellpadding="5" cellspacing="0" class="table table-nobordered popupTable" id="tax_table<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value['taxes'], 'tax_data', false, 'tax_row_no');
$_smarty_tpl->tpl_vars['tax_data']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['tax_row_no']->value => $_smarty_tpl->tpl_vars['tax_data']->value) {
$_smarty_tpl->tpl_vars['tax_data']->do_else = false;
$_smarty_tpl->_assignInScope('taxname', (($_smarty_tpl->tpl_vars['tax_data']->value['taxname']).("_percentage")).($_smarty_tpl->tpl_vars['row_no']->value));
$_smarty_tpl->_assignInScope('tax_id_name', ("hidden_tax").($_smarty_tpl->tpl_vars['tax_row_no']->value)+((1).("_percentage")).($_smarty_tpl->tpl_vars['row_no']->value));
$_smarty_tpl->_assignInScope('taxlabel', (($_smarty_tpl->tpl_vars['tax_data']->value['taxlabel']).("_percentage")).($_smarty_tpl->tpl_vars['row_no']->value));
$_smarty_tpl->_assignInScope('popup_tax_rowname', ("popup_tax_row").($_smarty_tpl->tpl_vars['row_no']->value));?><tr><td>&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['tax_data']->value['taxlabel'];?>
</td><td style="text-align: right;"><input type="text" data-rule-positive=true data-rule-inventory_percentage=true  name="<?php echo $_smarty_tpl->tpl_vars['taxname']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['taxname']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['tax_data']->value['percentage'];?>
" data-compound-on="<?php if ($_smarty_tpl->tpl_vars['tax_data']->value['method'] == 'Compound') {
echo Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($_smarty_tpl->tpl_vars['tax_data']->value['compoundon']));
}?>" data-regions-list="<?php echo Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($_smarty_tpl->tpl_vars['tax_data']->value['regionsList']));?>
" class="span1 taxPercentage" />&nbsp;%</td><td style="text-align: right; padding-right: 10px;"><input type="text" name="<?php echo $_smarty_tpl->tpl_vars['popup_tax_rowname']->value;?>
" class="cursorPointer span1 taxTotal taxTotal<?php echo $_smarty_tpl->tpl_vars['tax_data']->value['taxid'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['tax_data']->value['amount'];?>
" readonly /></td></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></table></div><?php }?></div></span></td><?php }?><td><div id="productTotal<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" align="right" class="productTotal"><?php if ((isset($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['productTotal']->value])) && $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['productTotal']->value]) {
echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['productTotal']->value];
} else { ?>0<?php }?></div><?php if ($_smarty_tpl->tpl_vars['ITEM_DISCOUNT_AMOUNT_EDITABLE']->value || $_smarty_tpl->tpl_vars['ITEM_DISCOUNT_PERCENT_EDITABLE']->value) {?><div id="discountTotal<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" align="right" class="discountTotal"><?php if ((isset($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['discountTotal']->value])) && $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['discountTotal']->value]) {
echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['discountTotal']->value];
} else { ?>0<?php }?></div><div id="totalAfterDiscount<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" align="right" class="totalAfterDiscount"><?php if ((isset($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['totalAfterDiscount']->value])) && $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['totalAfterDiscount']->value]) {
echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['totalAfterDiscount']->value];
} else { ?>0<?php }?></div><?php }?><div id="taxTotal<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" align="right" class="productTaxTotal <?php if ($_smarty_tpl->tpl_vars['IS_GROUP_TAX_TYPE']->value) {?>hide<?php }?>"><?php if ((isset($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['taxTotal']->value])) && $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['taxTotal']->value]) {
echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['taxTotal']->value];
} else { ?>0<?php }?></div></td><?php if ((isset($_smarty_tpl->tpl_vars['MARGIN_EDITABLE']->value)) && $_smarty_tpl->tpl_vars['MARGIN_EDITABLE']->value && $_smarty_tpl->tpl_vars['PURCHASE_COST_EDITABLE']->value) {?><td><input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['margin']->value;?>
" value="<?php if ($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['margin']->value]) {
echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['margin']->value];
} else { ?>0<?php }?>"></span><span class="margin pull-right"><?php if ($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['margin']->value]) {
echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['margin']->value];
} else { ?>0<?php }?></span></td><?php }?><td><span id="netPrice<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" class="pull-right netPrice"><?php if ((isset($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['netPrice']->value])) && $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['netPrice']->value]) {
echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['netPrice']->value];
} else { ?>0<?php }?></span></td>
<?php }
}
