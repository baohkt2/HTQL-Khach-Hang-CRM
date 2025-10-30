<?php
/* Smarty version 4.5.5, created on 2025-09-19 07:59:32
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Inventory\partials\LineItemsEdit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68cd0d64c9c790_02681659',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'aa12755f61a95f3911008849d146b38296ec0eb4' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Inventory\\partials\\LineItemsEdit.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68cd0d64c9c790_02681659 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
?>

<?php $_smarty_tpl->_assignInScope('LINEITEM_FIELDS', $_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value['LBL_ITEM_DETAILS']);
$_smarty_tpl->_assignInScope('COL_SPAN1', 1);
$_smarty_tpl->_assignInScope('COL_SPAN2', 2);
$_smarty_tpl->_assignInScope('COL_SPAN3', 3);
if ((isset($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['image']))) {
$_smarty_tpl->_assignInScope('IMAGE_EDITABLE', $_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['image']->isEditable());
if ($_smarty_tpl->tpl_vars['IMAGE_EDITABLE']->value) {
$_smarty_tpl->_assignInScope('COL_SPAN1', ($_smarty_tpl->tpl_vars['COL_SPAN1']->value)+1);
}
}
if ((isset($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['productid']))) {
$_smarty_tpl->_assignInScope('PRODUCT_EDITABLE', $_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['productid']->isEditable());
if ($_smarty_tpl->tpl_vars['PRODUCT_EDITABLE']->value) {
$_smarty_tpl->_assignInScope('COL_SPAN1', ($_smarty_tpl->tpl_vars['COL_SPAN1']->value)+1);
}
}
if ((isset($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['quantity']))) {
$_smarty_tpl->_assignInScope('QUANTITY_EDITABLE', $_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['quantity']->isEditable());
if ($_smarty_tpl->tpl_vars['QUANTITY_EDITABLE']->value) {
$_smarty_tpl->_assignInScope('COL_SPAN1', ($_smarty_tpl->tpl_vars['COL_SPAN1']->value)+1);
}
}
if ((isset($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['purchase_cost']))) {
$_smarty_tpl->_assignInScope('PURCHASE_COST_EDITABLE', $_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['purchase_cost']->isEditable());
if ($_smarty_tpl->tpl_vars['PURCHASE_COST_EDITABLE']->value) {
$_smarty_tpl->_assignInScope('COL_SPAN2', ($_smarty_tpl->tpl_vars['COL_SPAN2']->value)+1);
}
}
if ((isset($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['listprice']))) {
$_smarty_tpl->_assignInScope('LIST_PRICE_EDITABLE', $_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['listprice']->isEditable());
if ($_smarty_tpl->tpl_vars['LIST_PRICE_EDITABLE']->value) {
$_smarty_tpl->_assignInScope('COL_SPAN2', ($_smarty_tpl->tpl_vars['COL_SPAN2']->value)+1);
}
}
if ((isset($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['margin']))) {
$_smarty_tpl->_assignInScope('MARGIN_EDITABLE', $_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['margin']->isEditable());
if ($_smarty_tpl->tpl_vars['MARGIN_EDITABLE']->value) {
$_smarty_tpl->_assignInScope('COL_SPAN3', ($_smarty_tpl->tpl_vars['COL_SPAN3']->value)+1);
}
}
if ((isset($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['comment']))) {
$_smarty_tpl->_assignInScope('COMMENT_EDITABLE', $_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['comment']->isEditable());
}
if ((isset($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['discount_amount']))) {
$_smarty_tpl->_assignInScope('ITEM_DISCOUNT_AMOUNT_EDITABLE', $_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['discount_amount']->isEditable());
}
if ((isset($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['discount_percent']))) {
$_smarty_tpl->_assignInScope('ITEM_DISCOUNT_PERCENT_EDITABLE', $_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['discount_percent']->isEditable());
}
if ((isset($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['hdnS_H_Percent']))) {
$_smarty_tpl->_assignInScope('SH_PERCENT_EDITABLE', $_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['hdnS_H_Percent']->isEditable());
}
if ((isset($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['hdnDiscountAmount']))) {
$_smarty_tpl->_assignInScope('DISCOUNT_AMOUNT_EDITABLE', $_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['hdnDiscountAmount']->isEditable());
}
if ((isset($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['hdnDiscountPercent']))) {
$_smarty_tpl->_assignInScope('DISCOUNT_PERCENT_EDITABLE', $_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['hdnDiscountPercent']->isEditable());
}
$_smarty_tpl->_assignInScope('FINAL', (isset($_smarty_tpl->tpl_vars['RELATED_PRODUCTS']->value[1]['final_details'])) ? $_smarty_tpl->tpl_vars['RELATED_PRODUCTS']->value[1]['final_details'] : null);
$_smarty_tpl->_assignInScope('IS_INDIVIDUAL_TAX_TYPE', false);
$_smarty_tpl->_assignInScope('IS_GROUP_TAX_TYPE', true);
if ($_smarty_tpl->tpl_vars['TAX_TYPE']->value == 'individual') {
$_smarty_tpl->_assignInScope('IS_GROUP_TAX_TYPE', false);
$_smarty_tpl->_assignInScope('IS_INDIVIDUAL_TAX_TYPE', true);
}?><input type="hidden" class="numberOfCurrencyDecimal" value="<?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('no_of_currency_decimals');?>
" /><input type="hidden" name="totalProductCount" id="totalProductCount" value="<?php echo (isset($_smarty_tpl->tpl_vars['row_no']->value)) ? $_smarty_tpl->tpl_vars['row_no']->value : '';?>
" /><input type="hidden" name="subtotal" id="subtotal" value="" /><input type="hidden" name="total" id="total" value="" /><div name='editContent'><?php $_smarty_tpl->_assignInScope('LINE_ITEM_BLOCK_LABEL', "LBL_ITEM_DETAILS");
$_smarty_tpl->_assignInScope('BLOCK_FIELDS', $_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value[$_smarty_tpl->tpl_vars['LINE_ITEM_BLOCK_LABEL']->value]);
$_smarty_tpl->_assignInScope('BLOCK_LABEL', $_smarty_tpl->tpl_vars['LINE_ITEM_BLOCK_LABEL']->value);
if (smarty_modifier_count($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value) > 0) {?><div class='fieldBlockContainer'><div class="row"><div class="col-sm-3"><h4 class='fieldBlockHeader' style="margin-top:5px;"><?php echo vtranslate($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h4></div><div class="col-sm-9 well"><div class="row"><div class="col-sm-4"><?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['region_id'] && $_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['region_id']->isEditable()) {?><span class="pull-right"><i class="fa fa-info-circle"></i>&nbsp;<label><?php echo vtranslate($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['region_id']->get('label'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label>&nbsp;<select class="select2" id="region_id" name="region_id" style="width: 164px;"><option value="0" data-info="<?php echo Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($_smarty_tpl->tpl_vars['DEFAULT_TAX_REGION_INFO']->value));?>
"><?php echo vtranslate('LBL_SELECT_OPTION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['TAX_REGIONS']->value, 'TAX_REGION_INFO', false, 'TAX_REGION_ID');
$_smarty_tpl->tpl_vars['TAX_REGION_INFO']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['TAX_REGION_ID']->value => $_smarty_tpl->tpl_vars['TAX_REGION_INFO']->value) {
$_smarty_tpl->tpl_vars['TAX_REGION_INFO']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['TAX_REGION_ID']->value;?>
" data-info='<?php echo Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($_smarty_tpl->tpl_vars['TAX_REGION_INFO']->value));?>
' <?php if ($_smarty_tpl->tpl_vars['TAX_REGION_ID']->value == $_smarty_tpl->tpl_vars['RECORD']->value->get('region_id')) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['TAX_REGION_INFO']->value['name'];?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select><input type="hidden" id="prevRegionId" value="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('region_id');?>
" /><a class="fa fa-wrench hidden-xs" href="index.php?module=Vtiger&parent=Settings&view=TaxIndex" target="_blank" style="vertical-align:middle;"></a></span><?php }?></div><div class="col-sm-4"><div class="pull-right"><i class="fa fa-info-circle"></i>&nbsp;<label><?php echo vtranslate('LBL_CURRENCY',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label>&nbsp;<?php $_smarty_tpl->_assignInScope('SELECTED_CURRENCY', $_smarty_tpl->tpl_vars['CURRENCINFO']->value);
if ($_smarty_tpl->tpl_vars['SELECTED_CURRENCY']->value == '') {
$_smarty_tpl->_assignInScope('USER_CURRENCY_ID', $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('currency_id'));
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['CURRENCIES']->value, 'currency_details');
$_smarty_tpl->tpl_vars['currency_details']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['currency_details']->value) {
$_smarty_tpl->tpl_vars['currency_details']->do_else = false;
if ($_smarty_tpl->tpl_vars['currency_details']->value['curid'] == $_smarty_tpl->tpl_vars['USER_CURRENCY_ID']->value) {
$_smarty_tpl->_assignInScope('SELECTED_CURRENCY', $_smarty_tpl->tpl_vars['currency_details']->value);
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?><select class="select2" id="currency_id" name="currency_id" style="width: 150px;"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['CURRENCIES']->value, 'currency_details', false, 'count');
$_smarty_tpl->tpl_vars['currency_details']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['count']->value => $_smarty_tpl->tpl_vars['currency_details']->value) {
$_smarty_tpl->tpl_vars['currency_details']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['currency_details']->value['curid'];?>
" class="textShadowNone" data-conversion-rate="<?php echo $_smarty_tpl->tpl_vars['currency_details']->value['conversionrate'];?>
" <?php if ($_smarty_tpl->tpl_vars['SELECTED_CURRENCY']->value['currency_id'] == $_smarty_tpl->tpl_vars['currency_details']->value['curid']) {?> selected <?php }?>><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'getTranslatedCurrencyString' ][ 0 ], array( $_smarty_tpl->tpl_vars['currency_details']->value['currencylabel'] ));?>
 (<?php echo $_smarty_tpl->tpl_vars['currency_details']->value['currencysymbol'];?>
)</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select><?php $_smarty_tpl->_assignInScope('RECORD_CURRENCY_RATE', $_smarty_tpl->tpl_vars['RECORD_STRUCTURE_MODEL']->value->getRecord()->get('conversion_rate'));
if ($_smarty_tpl->tpl_vars['RECORD_CURRENCY_RATE']->value == '') {
$_smarty_tpl->_assignInScope('RECORD_CURRENCY_RATE', $_smarty_tpl->tpl_vars['SELECTED_CURRENCY']->value['conversionrate']);
}?><input type="hidden" name="conversion_rate" id="conversion_rate" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_CURRENCY_RATE']->value;?>
" /><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['SELECTED_CURRENCY']->value['currency_id'];?>
" id="prev_selected_currency_id" /><!-- TODO : To get default currency in even better way than depending on first element --><input type="hidden" id="default_currency_id" value="<?php echo $_smarty_tpl->tpl_vars['CURRENCIES']->value[0]['curid'];?>
" /><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['SELECTED_CURRENCY']->value['currency_id'];?>
" id="selectedCurrencyId" /></div></div><div class="col-sm-4"><div class="pull-right"><i class="fa fa-info-circle"></i>&nbsp;<label><?php echo vtranslate('LBL_TAX_MODE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label>&nbsp;<select class="select2 lineItemTax" id="taxtype" name="taxtype" style="width: 150px;"><option value="individual" <?php if ($_smarty_tpl->tpl_vars['IS_INDIVIDUAL_TAX_TYPE']->value) {?>selected<?php }?>><?php echo vtranslate('LBL_INDIVIDUAL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><option value="group" <?php if ($_smarty_tpl->tpl_vars['IS_GROUP_TAX_TYPE']->value) {?>selected<?php }?>><?php echo vtranslate('LBL_GROUP',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option></select></div></div></div></div></div><div class="lineitemTableContainer"><table class="table table-bordered" id="lineItemTab"><tr><td><strong><?php echo vtranslate('LBL_TOOLS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></td><?php if ((isset($_smarty_tpl->tpl_vars['IMAGE_EDITABLE']->value))) {?><td><strong><?php ob_start();
echo $_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['image']->get('label');
$_prefixVariable2 = ob_get_clean();
echo vtranslate($_prefixVariable2,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></td><?php }
if ((isset($_smarty_tpl->tpl_vars['PRODUCT_EDITABLE']->value))) {?><td><span class="redColor">*</span><strong><?php ob_start();
echo $_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['productid']->get('label');
$_prefixVariable3 = ob_get_clean();
echo vtranslate($_prefixVariable3,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></td><?php }?><td><strong><?php echo vtranslate('LBL_QTY',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></td><?php if ((isset($_smarty_tpl->tpl_vars['PURCHASE_COST_EDITABLE']->value))) {?><td><strong class="pull-right"><?php ob_start();
echo $_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['purchase_cost']->get('label');
$_prefixVariable4 = ob_get_clean();
echo vtranslate($_prefixVariable4,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></td><?php }
if ((isset($_smarty_tpl->tpl_vars['LIST_PRICE_EDITABLE']->value))) {?><td><strong><?php ob_start();
echo $_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['listprice']->get('label');
$_prefixVariable5 = ob_get_clean();
echo vtranslate($_prefixVariable5,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></td><?php }?><td><strong class="pull-right"><?php echo vtranslate('LBL_TOTAL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></td><?php if ((isset($_smarty_tpl->tpl_vars['MARGIN_EDITABLE']->value)) && (isset($_smarty_tpl->tpl_vars['PURCHASE_COST_EDITABLE']->value))) {?><td><strong class="pull-right"><?php ob_start();
echo $_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['margin']->get('label');
$_prefixVariable6 = ob_get_clean();
echo vtranslate($_prefixVariable6,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></td><?php }?><td><strong class="pull-right"><?php echo vtranslate('LBL_NET_PRICE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></td></tr><tr id="row0" class="hide lineItemCloneCopy" data-row-num="0"><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "partials/LineItemsContent.tpl",'Inventory' )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('row_no'=>0,'data'=>array(),'IGNORE_UI_REGISTRATION'=>true), 0, true);
?></tr><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RELATED_PRODUCTS']->value, 'data', false, 'row_no');
$_smarty_tpl->tpl_vars['data']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['row_no']->value => $_smarty_tpl->tpl_vars['data']->value) {
$_smarty_tpl->tpl_vars['data']->do_else = false;
?><tr id="row<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" data-row-num="<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" class="lineItemRow" <?php if ((isset($_smarty_tpl->tpl_vars['data']->value["entityType".((string)$_smarty_tpl->tpl_vars['row_no']->value)])) && $_smarty_tpl->tpl_vars['data']->value["entityType".((string)$_smarty_tpl->tpl_vars['row_no']->value)] == 'Products') {?>data-quantity-in-stock=<?php echo (isset($_smarty_tpl->tpl_vars['data']->value["qtyInStock".((string)$_smarty_tpl->tpl_vars['row_no']->value)])) ? $_smarty_tpl->tpl_vars['data']->value["qtyInStock".((string)$_smarty_tpl->tpl_vars['row_no']->value)] : '';
}?>><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "partials/LineItemsContent.tpl",'Inventory' )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('row_no'=>$_smarty_tpl->tpl_vars['row_no']->value,'data'=>$_smarty_tpl->tpl_vars['data']->value), 0, true);
?></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
if ($_smarty_tpl->tpl_vars['RELATED_PRODUCTS']->value && php7_count($_smarty_tpl->tpl_vars['RELATED_PRODUCTS']->value) == 0 && ($_smarty_tpl->tpl_vars['PRODUCT_ACTIVE']->value == 'true' || $_smarty_tpl->tpl_vars['SERVICE_ACTIVE']->value == 'true')) {?><tr id="row1" class="lineItemRow" data-row-num="1"><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "partials/LineItemsContent.tpl",'Inventory' )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('row_no'=>1,'data'=>array(),'IGNORE_UI_REGISTRATION'=>false), 0, true);
?></tr><?php }?></table></div></div><br><div><div><?php if ($_smarty_tpl->tpl_vars['PRODUCT_ACTIVE']->value == 'true' && $_smarty_tpl->tpl_vars['SERVICE_ACTIVE']->value == 'true') {?><div class="btn-toolbar"><span class="btn-group"><button type="button" class="btn btn-default" id="addProduct" data-module-name="Products" ><i class="fa fa-plus"></i>&nbsp;&nbsp;<strong><?php echo vtranslate('LBL_ADD_PRODUCT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button></span><span class="btn-group"><button type="button" class="btn btn-default" id="addService" data-module-name="Services" ><i class="fa fa-plus"></i>&nbsp;&nbsp;<strong><?php echo vtranslate('LBL_ADD_SERVICE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button></span></div><?php } elseif ($_smarty_tpl->tpl_vars['PRODUCT_ACTIVE']->value == 'true') {?><div class="btn-group"><button type="button" class="btn btn-default" id="addProduct" data-module-name="Products"><i class="fa fa-plus"></i><strong>&nbsp;&nbsp;<?php echo vtranslate('LBL_ADD_PRODUCT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button></div><?php } elseif ($_smarty_tpl->tpl_vars['SERVICE_ACTIVE']->value == 'true') {?><div class="btn-group"><button type="button" class="btn btn-default" id="addService" data-module-name="Services"><i class="fa fa-plus"></i><strong>&nbsp;&nbsp;<?php echo vtranslate('LBL_ADD_SERVICE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button></div><?php }?></div></div><br><div class="fieldBlockContainer"><table class="table table-bordered blockContainer lineItemTable" id="lineItemResult"><tr><td width="83%"><div class="pull-right"><strong><?php echo vtranslate('LBL_ITEMS_TOTAL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></div></td><td><div id="netTotal" class="pull-right netTotal"><?php if (!empty($_smarty_tpl->tpl_vars['FINAL']->value['hdnSubTotal'])) {
echo $_smarty_tpl->tpl_vars['FINAL']->value['hdnSubTotal'];
} else { ?>0<?php }?></div></td></tr><?php if ($_smarty_tpl->tpl_vars['DISCOUNT_AMOUNT_EDITABLE']->value || $_smarty_tpl->tpl_vars['DISCOUNT_PERCENT_EDITABLE']->value) {?><tr><td width="83%"><span class="pull-right">(-)&nbsp;<strong><a href="javascript:void(0)" id="finalDiscount"><?php echo vtranslate('LBL_OVERALL_DISCOUNT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<span id="overallDiscount"><?php if ((isset($_smarty_tpl->tpl_vars['FINAL']->value['discount_type_final'])) && $_smarty_tpl->tpl_vars['DISCOUNT_PERCENT_EDITABLE']->value && $_smarty_tpl->tpl_vars['FINAL']->value['discount_type_final'] == 'percentage') {?>(<?php echo $_smarty_tpl->tpl_vars['FINAL']->value['discount_percentage_final'];?>
%)<?php } elseif ((isset($_smarty_tpl->tpl_vars['FINAL']->value['discount_type_final'])) && $_smarty_tpl->tpl_vars['DISCOUNT_AMOUNT_EDITABLE']->value && $_smarty_tpl->tpl_vars['FINAL']->value['discount_type_final'] == 'amount') {?>(<?php echo $_smarty_tpl->tpl_vars['FINAL']->value['discount_amount_final'];?>
)<?php } else { ?>(0)<?php }?></span></a></strong></span></td><td><span id="discountTotal_final" class="pull-right discountTotal_final"><?php if ((isset($_smarty_tpl->tpl_vars['FINAL']->value['discountTotal_final'])) ? $_smarty_tpl->tpl_vars['FINAL']->value['discountTotal_final'] : '') {
echo $_smarty_tpl->tpl_vars['FINAL']->value['discountTotal_final'];
} else { ?>0<?php }?></span><!-- Popup Discount Div --><div id="finalDiscountUI" class="finalDiscountUI validCheck hide"><?php $_smarty_tpl->_assignInScope('DISCOUNT_TYPE_FINAL', "zero");
if (!empty($_smarty_tpl->tpl_vars['FINAL']->value['discount_type_final'])) {
$_smarty_tpl->_assignInScope('DISCOUNT_TYPE_FINAL', $_smarty_tpl->tpl_vars['FINAL']->value['discount_type_final']);
}?><input type="hidden" id="discount_type_final" name="discount_type_final" value="<?php echo $_smarty_tpl->tpl_vars['DISCOUNT_TYPE_FINAL']->value;?>
" /><p class="popover_title hide"><?php echo vtranslate('LBL_SET_DISCOUNT_FOR',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 : <span class="subTotalVal"><?php if (!empty($_smarty_tpl->tpl_vars['FINAL']->value['hdnSubTotal'])) {
echo $_smarty_tpl->tpl_vars['FINAL']->value['hdnSubTotal'];
} else { ?>0<?php }?></span></p><table width="100%" border="0" cellpadding="5" cellspacing="0" class="table table-nobordered popupTable"><tbody><tr><td><input type="radio" name="discount_final" class="finalDiscounts" data-discount-type="zero" <?php if ($_smarty_tpl->tpl_vars['DISCOUNT_TYPE_FINAL']->value == 'zero') {?>checked<?php }?> />&nbsp; <?php echo vtranslate('LBL_ZERO_DISCOUNT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td><td class="lineOnTop"><!-- Make the discount value as zero --><input type="hidden" class="discountVal" value="0" /></td></tr><?php if ($_smarty_tpl->tpl_vars['DISCOUNT_PERCENT_EDITABLE']->value) {?><tr><td><input type="radio" name="discount_final" class="finalDiscounts" data-discount-type="percentage" <?php if ($_smarty_tpl->tpl_vars['DISCOUNT_TYPE_FINAL']->value == 'percentage') {?>checked<?php }?> />&nbsp; % <?php echo vtranslate('LBL_OF_PRICE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td><td><span class="pull-right">&nbsp;%</span><input type="text" data-rule-positive=true data-rule-inventory_percentage=true id="discount_percentage_final" name="discount_percentage_final" value="<?php echo (isset($_smarty_tpl->tpl_vars['FINAL']->value['discount_percentage_final'])) ? $_smarty_tpl->tpl_vars['FINAL']->value['discount_percentage_final'] : '';?>
" class="discount_percentage_final span1 pull-right discountVal <?php if ($_smarty_tpl->tpl_vars['DISCOUNT_TYPE_FINAL']->value != 'percentage') {?>hide<?php }?>" /></td></tr><?php }
if ($_smarty_tpl->tpl_vars['DISCOUNT_AMOUNT_EDITABLE']->value) {?><tr><td><input type="radio" name="discount_final" class="finalDiscounts" data-discount-type="amount" <?php if ($_smarty_tpl->tpl_vars['DISCOUNT_TYPE_FINAL']->value == 'amount') {?>checked<?php }?> />&nbsp;<?php echo vtranslate('LBL_DIRECT_PRICE_REDUCTION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td><td><input type="text" data-rule-positive=true id="discount_amount_final" name="discount_amount_final" value="<?php echo (isset($_smarty_tpl->tpl_vars['FINAL']->value['discount_amount_final'])) ? $_smarty_tpl->tpl_vars['FINAL']->value['discount_amount_final'] : '';?>
" class="span1 pull-right discount_amount_final discountVal <?php if ($_smarty_tpl->tpl_vars['DISCOUNT_TYPE_FINAL']->value != 'amount') {?>hide<?php }?>" /></td></tr><?php }?></tbody></table></div><!-- End Popup Div --></td></tr><?php }
if ($_smarty_tpl->tpl_vars['SH_PERCENT_EDITABLE']->value) {
$_smarty_tpl->_assignInScope('CHARGE_AND_CHARGETAX_VALUES', (isset($_smarty_tpl->tpl_vars['FINAL']->value['chargesAndItsTaxes'])) ? $_smarty_tpl->tpl_vars['FINAL']->value['chargesAndItsTaxes'] : NULL);?><tr><td width="83%"><span class="pull-right">(+)&nbsp;<strong><a href="javascript:void(0)" id="charges"><?php echo vtranslate('LBL_CHARGES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></strong></span><div id="chargesBlock" class="validCheck hide chargesBlock"><table width="100%" border="0" cellpadding="5" cellspacing="0" class="table table-nobordered popupTable"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['INVENTORY_CHARGES']->value, 'CHARGE_MODEL', false, 'CHARGE_ID');
$_smarty_tpl->tpl_vars['CHARGE_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['CHARGE_ID']->value => $_smarty_tpl->tpl_vars['CHARGE_MODEL']->value) {
$_smarty_tpl->tpl_vars['CHARGE_MODEL']->do_else = false;
?><tr><?php $_smarty_tpl->_assignInScope('CHARGE_VALUE', (isset($_smarty_tpl->tpl_vars['CHARGE_AND_CHARGETAX_VALUES']->value[$_smarty_tpl->tpl_vars['CHARGE_ID']->value]['value'])) ? $_smarty_tpl->tpl_vars['CHARGE_AND_CHARGETAX_VALUES']->value[$_smarty_tpl->tpl_vars['CHARGE_ID']->value]['value'] : NULL);
$_smarty_tpl->_assignInScope('CHARGE_PERCENT', 0);
if ($_smarty_tpl->tpl_vars['CHARGE_MODEL']->value->get('format') == 'Percent' && $_smarty_tpl->tpl_vars['CHARGE_AND_CHARGETAX_VALUES']->value[$_smarty_tpl->tpl_vars['CHARGE_ID']->value]['percent'] != NULL) {
$_smarty_tpl->_assignInScope('CHARGE_PERCENT', $_smarty_tpl->tpl_vars['CHARGE_AND_CHARGETAX_VALUES']->value[$_smarty_tpl->tpl_vars['CHARGE_ID']->value]['percent']);
}?><td class="lineOnTop chargeName" data-charge-id="<?php echo $_smarty_tpl->tpl_vars['CHARGE_ID']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['CHARGE_MODEL']->value->getName();?>
</td><td class="lineOnTop"><?php if ($_smarty_tpl->tpl_vars['CHARGE_MODEL']->value->get('format') == 'Percent') {?><input type="text" class="span1 chargePercent" size="5" data-rule-positive=true data-rule-inventory_percentage=true name="charges[<?php echo $_smarty_tpl->tpl_vars['CHARGE_ID']->value;?>
][percent]" value="<?php if ($_smarty_tpl->tpl_vars['CHARGE_PERCENT']->value) {
echo $_smarty_tpl->tpl_vars['CHARGE_PERCENT']->value;
} elseif ($_smarty_tpl->tpl_vars['RECORD_ID']->value) {?>0<?php } else {
echo $_smarty_tpl->tpl_vars['CHARGE_MODEL']->value->getValue();
}?>" />&nbsp;%<?php }?></td><td style="text-align: right;" class="lineOnTop"><input type="text" class="span1 chargeValue" size="5" <?php if ($_smarty_tpl->tpl_vars['CHARGE_MODEL']->value->get('format') == 'Percent') {?>readonly<?php }?> data-rule-positive=true name="charges[<?php echo $_smarty_tpl->tpl_vars['CHARGE_ID']->value;?>
][value]" value="<?php if ($_smarty_tpl->tpl_vars['CHARGE_VALUE']->value) {
echo $_smarty_tpl->tpl_vars['CHARGE_VALUE']->value;
} elseif ($_smarty_tpl->tpl_vars['RECORD_ID']->value) {?>0<?php } else {
echo $_smarty_tpl->tpl_vars['CHARGE_MODEL']->value->getValue()*$_smarty_tpl->tpl_vars['USER_MODEL']->value->get('conv_rate');
}?>" />&nbsp;</td></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></table></div></td><td><input type="hidden" class="lineItemInputBox" id="chargesTotal" name="shipping_handling_charge" value="<?php if ((isset($_smarty_tpl->tpl_vars['FINAL']->value['shipping_handling_charge'])) ? $_smarty_tpl->tpl_vars['FINAL']->value['shipping_handling_charge'] : '') {
echo $_smarty_tpl->tpl_vars['FINAL']->value['shipping_handling_charge'];
} else { ?>0<?php }?>" /><span id="chargesTotalDisplay" class="pull-right chargesTotalDisplay"><?php if ((isset($_smarty_tpl->tpl_vars['FINAL']->value['shipping_handling_charge'])) ? $_smarty_tpl->tpl_vars['FINAL']->value['shipping_handling_charge'] : '') {
echo $_smarty_tpl->tpl_vars['FINAL']->value['shipping_handling_charge'];
} else { ?>0<?php }?></span></td></tr><?php }?><tr><td width="83%"><span class="pull-right"><strong><?php echo vtranslate('LBL_PRE_TAX_TOTAL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 </strong></span></td><td><?php $_smarty_tpl->_assignInScope('PRE_TAX_TOTAL', ((string)((isset($_smarty_tpl->tpl_vars['FINAL']->value['preTaxTotal'])) ? $_smarty_tpl->tpl_vars['FINAL']->value['preTaxTotal'] : '')));?><span class="pull-right" id="preTaxTotal"><?php if ($_smarty_tpl->tpl_vars['PRE_TAX_TOTAL']->value) {
echo $_smarty_tpl->tpl_vars['PRE_TAX_TOTAL']->value;
} else { ?>0<?php }?></span><input type="hidden" id="pre_tax_total" name="pre_tax_total" value="<?php if ($_smarty_tpl->tpl_vars['PRE_TAX_TOTAL']->value) {
echo $_smarty_tpl->tpl_vars['PRE_TAX_TOTAL']->value;
} else { ?>0<?php }?>"/></td></tr><!-- Group Tax - starts --><tr id="group_tax_row" valign="top" class="<?php if ($_smarty_tpl->tpl_vars['IS_INDIVIDUAL_TAX_TYPE']->value) {?>hide<?php }?>"><td width="83%"><span class="pull-right">(+)&nbsp;<strong><a href="javascript:void(0)" id="finalTax"><?php echo vtranslate('LBL_TAX',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></strong></span><!-- Pop Div For Group TAX --><div class="hide finalTaxUI validCheck" id="group_tax_div"><input type="hidden" class="popover_title" value="<?php echo vtranslate('LBL_GROUP_TAX',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" /><table width="100%" border="0" cellpadding="5" cellspacing="0" class="table table-nobordered popupTable"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['TAXES']->value, 'tax_detail', false, 'loop_count', 'group_tax_loop', array (
  'iteration' => true,
));
$_smarty_tpl->tpl_vars['tax_detail']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['loop_count']->value => $_smarty_tpl->tpl_vars['tax_detail']->value) {
$_smarty_tpl->tpl_vars['tax_detail']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_group_tax_loop']->value['iteration']++;
?><tr><td class="lineOnTop"><?php echo $_smarty_tpl->tpl_vars['tax_detail']->value['taxlabel'];?>
</td><td class="lineOnTop"><input type="text" size="5" data-compound-on="<?php if ($_smarty_tpl->tpl_vars['tax_detail']->value['method'] == 'Compound') {
echo Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($_smarty_tpl->tpl_vars['tax_detail']->value['compoundon']));
}?>"name="<?php echo $_smarty_tpl->tpl_vars['tax_detail']->value['taxname'];?>
_group_percentage" id="group_tax_percentage<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_group_tax_loop']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_group_tax_loop']->value['iteration'] : null);?>
" value="<?php echo $_smarty_tpl->tpl_vars['tax_detail']->value['percentage'];?>
" class="span1 groupTaxPercentage" data-rule-positive=true data-rule-inventory_percentage=true />&nbsp;%</td><td style="text-align: right;" class="lineOnTop"><input type="text" size="6" name="<?php echo $_smarty_tpl->tpl_vars['tax_detail']->value['taxname'];?>
_group_amount" id="group_tax_amount<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_group_tax_loop']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_group_tax_loop']->value['iteration'] : null);?>
" style="cursor:pointer;" value="<?php echo (isset($_smarty_tpl->tpl_vars['tax_detail']->value['amount'])) ? $_smarty_tpl->tpl_vars['tax_detail']->value['amount'] : '';?>
" readonly class="cursorPointer span1 groupTaxTotal" /></td></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?><input type="hidden" id="group_tax_count" value="<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_group_tax_loop']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_group_tax_loop']->value['iteration'] : null);?>
" /></table></div><!-- End Popup Div Group Tax --></td><td><span id="tax_final" class="pull-right tax_final"><?php if ((isset($_smarty_tpl->tpl_vars['FINAL']->value['tax_totalamount'])) ? $_smarty_tpl->tpl_vars['FINAL']->value['tax_totalamount'] : '') {
echo $_smarty_tpl->tpl_vars['FINAL']->value['tax_totalamount'];
} else { ?>0<?php }?></span></td></tr><!-- Group Tax - ends --><?php if ($_smarty_tpl->tpl_vars['SH_PERCENT_EDITABLE']->value) {?><tr><td width="83%"><span class="pull-right">(+)&nbsp;<strong><a href="javascript:void(0)" id="chargeTaxes"><?php echo vtranslate('LBL_TAXES_ON_CHARGES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 </a></strong></span><!-- Pop Div For Shipping and Handling TAX --><div id="chargeTaxesBlock" class="hide validCheck chargeTaxesBlock"><p class="popover_title hide"><?php echo vtranslate('LBL_TAXES_ON_CHARGES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 : <span id="SHChargeVal" class="SHChargeVal"><?php if ((isset($_smarty_tpl->tpl_vars['FINAL']->value['shipping_handling_charge'])) ? $_smarty_tpl->tpl_vars['FINAL']->value['shipping_handling_charge'] : '') {
echo $_smarty_tpl->tpl_vars['FINAL']->value['shipping_handling_charge'];
} else { ?>0<?php }?></span></p><table class="table table-nobordered popupTable"><tbody><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['INVENTORY_CHARGES']->value, 'CHARGE_MODEL', false, 'CHARGE_ID');
$_smarty_tpl->tpl_vars['CHARGE_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['CHARGE_ID']->value => $_smarty_tpl->tpl_vars['CHARGE_MODEL']->value) {
$_smarty_tpl->tpl_vars['CHARGE_MODEL']->do_else = false;
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RECORD']->value->getChargeTaxModelsList($_smarty_tpl->tpl_vars['CHARGE_ID']->value), 'CHARGE_TAX_MODEL', false, 'CHARGE_TAX_ID');
$_smarty_tpl->tpl_vars['CHARGE_TAX_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['CHARGE_TAX_ID']->value => $_smarty_tpl->tpl_vars['CHARGE_TAX_MODEL']->value) {
$_smarty_tpl->tpl_vars['CHARGE_TAX_MODEL']->do_else = false;
if (!(isset($_smarty_tpl->tpl_vars['CHARGE_AND_CHARGETAX_VALUES']->value[$_smarty_tpl->tpl_vars['CHARGE_ID']->value]['taxes'][$_smarty_tpl->tpl_vars['CHARGE_TAX_ID']->value])) && $_smarty_tpl->tpl_vars['CHARGE_TAX_MODEL']->value->isDeleted()) {
continue 1;
}
if (!$_smarty_tpl->tpl_vars['RECORD_ID']->value && $_smarty_tpl->tpl_vars['CHARGE_TAX_MODEL']->value->isDeleted()) {
continue 1;
}?><tr><?php $_smarty_tpl->_assignInScope('SH_TAX_VALUE', $_smarty_tpl->tpl_vars['CHARGE_TAX_MODEL']->value->getTax());
if ((isset($_smarty_tpl->tpl_vars['CHARGE_AND_CHARGETAX_VALUES']->value[$_smarty_tpl->tpl_vars['CHARGE_ID']->value]['value'])) && $_smarty_tpl->tpl_vars['CHARGE_AND_CHARGETAX_VALUES']->value[$_smarty_tpl->tpl_vars['CHARGE_ID']->value]['value'] != NULL) {
$_smarty_tpl->_assignInScope('SH_TAX_VALUE', 0);
if ($_smarty_tpl->tpl_vars['CHARGE_AND_CHARGETAX_VALUES']->value[$_smarty_tpl->tpl_vars['CHARGE_ID']->value]['taxes'][$_smarty_tpl->tpl_vars['CHARGE_TAX_ID']->value]) {
$_smarty_tpl->_assignInScope('SH_TAX_VALUE', $_smarty_tpl->tpl_vars['CHARGE_AND_CHARGETAX_VALUES']->value[$_smarty_tpl->tpl_vars['CHARGE_ID']->value]['taxes'][$_smarty_tpl->tpl_vars['CHARGE_TAX_ID']->value]);
}
}?><td class="lineOnTop"><?php echo $_smarty_tpl->tpl_vars['CHARGE_MODEL']->value->getName();?>
 - <?php echo $_smarty_tpl->tpl_vars['CHARGE_TAX_MODEL']->value->getName();?>
</td><td class="lineOnTop"><input type="text" data-charge-id="<?php echo $_smarty_tpl->tpl_vars['CHARGE_ID']->value;?>
" data-compound-on="<?php if ($_smarty_tpl->tpl_vars['CHARGE_TAX_MODEL']->value->getTaxMethod() == 'Compound') {
echo $_smarty_tpl->tpl_vars['CHARGE_TAX_MODEL']->value->get('compoundon');
}?>"class="span1 chargeTaxPercentage" name="charges[<?php echo $_smarty_tpl->tpl_vars['CHARGE_ID']->value;?>
][taxes][<?php echo $_smarty_tpl->tpl_vars['CHARGE_TAX_ID']->value;?>
]" value="<?php echo $_smarty_tpl->tpl_vars['SH_TAX_VALUE']->value;?>
"data-rule-positive=true data-rule-inventory_percentage=true />&nbsp;%</td><td style="text-align: right;" class="lineOnTop"><input type="text" class="span1 chargeTaxValue cursorPointer pull-right chargeTax<?php echo $_smarty_tpl->tpl_vars['CHARGE_ID']->value;
echo $_smarty_tpl->tpl_vars['CHARGE_TAX_ID']->value;?>
" size="5" value="0" readonly />&nbsp;</td></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tbody></table></div><!-- End Popup Div for Shipping and Handling TAX --></td><td><input type="hidden" id="chargeTaxTotalHidden" class="chargeTaxTotal" name="s_h_percent" value="<?php if ((isset($_smarty_tpl->tpl_vars['FINAL']->value['shtax_totalamount'])) ? $_smarty_tpl->tpl_vars['FINAL']->value['shtax_totalamount'] : '') {
echo $_smarty_tpl->tpl_vars['FINAL']->value['shtax_totalamount'];
} else { ?>0<?php }?>" /><span class="pull-right" id="chargeTaxTotal"><?php if ((isset($_smarty_tpl->tpl_vars['FINAL']->value['shtax_totalamount'])) ? $_smarty_tpl->tpl_vars['FINAL']->value['shtax_totalamount'] : '') {
echo $_smarty_tpl->tpl_vars['FINAL']->value['shtax_totalamount'];
} else { ?>0<?php }?></span></td></tr><tr><td width="83%"><span class="pull-right">(-)&nbsp;<strong><a href="javascript:void(0)" id="deductTaxes"><?php echo vtranslate('LBL_DEDUCTED_TAXES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 </a></strong></span><div id="deductTaxesBlock" class="hide validCheck deductTaxesBlock"><table class="table table-nobordered popupTable"><tbody><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['DEDUCTED_TAXES']->value, 'DEDUCTED_TAX_INFO', false, 'DEDUCTED_TAX_ID');
$_smarty_tpl->tpl_vars['DEDUCTED_TAX_INFO']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['DEDUCTED_TAX_ID']->value => $_smarty_tpl->tpl_vars['DEDUCTED_TAX_INFO']->value) {
$_smarty_tpl->tpl_vars['DEDUCTED_TAX_INFO']->do_else = false;
?><tr><td class="lineOnTop"><?php echo $_smarty_tpl->tpl_vars['DEDUCTED_TAX_INFO']->value['taxlabel'];?>
</td><td class="lineOnTop"><input type="text" class="span1 deductTaxPercentage" name="<?php echo $_smarty_tpl->tpl_vars['DEDUCTED_TAX_INFO']->value['taxname'];?>
_group_percentage" value="<?php if ($_smarty_tpl->tpl_vars['DEDUCTED_TAX_INFO']->value['selected'] || !$_smarty_tpl->tpl_vars['RECORD_ID']->value) {
echo $_smarty_tpl->tpl_vars['DEDUCTED_TAX_INFO']->value['percentage'];
} else { ?>0<?php }?>"data-rule-positive=true data-rule-inventory_percentage=true />&nbsp;%</td><td style="text-align: right;" class="lineOnTop"><input type="text" class="span1 deductTaxValue cursorPointer pull-right" name="<?php echo $_smarty_tpl->tpl_vars['DEDUCTED_TAX_INFO']->value['taxname'];?>
_group_amount" size="5" readonly value="<?php echo $_smarty_tpl->tpl_vars['DEDUCTED_TAX_INFO']->value['amount'];?>
"/>&nbsp;</td></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tbody></table></div></td><td><span class="pull-right" id="deductTaxesTotalAmount"><?php if ((isset($_smarty_tpl->tpl_vars['FINAL']->value['deductTaxesTotalAmount'])) && $_smarty_tpl->tpl_vars['FINAL']->value['deductTaxesTotalAmount']) {
echo $_smarty_tpl->tpl_vars['FINAL']->value['deductTaxesTotalAmount'];
} else { ?>0<?php }?></span></td></tr><?php }?><tr valign="top"><td width="83%" ><div class="pull-right"><strong><?php echo vtranslate('LBL_ADJUSTMENT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;&nbsp;</strong><span><input type="radio" name="adjustmentType" option value="+" <?php if ((isset($_smarty_tpl->tpl_vars['FINAL']->value['adjustment'])) && $_smarty_tpl->tpl_vars['FINAL']->value['adjustment'] >= 0) {?>checked<?php }?>>&nbsp;<?php echo vtranslate('LBL_ADD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;&nbsp;</span><span><input type="radio" name="adjustmentType" option value="-" <?php if ((isset($_smarty_tpl->tpl_vars['FINAL']->value['adjustment'])) && $_smarty_tpl->tpl_vars['FINAL']->value['adjustment'] < 0) {?>checked<?php }?>>&nbsp;<?php echo vtranslate('LBL_DEDUCT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span></div></td><td><span class="pull-right"><input id="adjustment" name="adjustment" type="text" data-rule-positive="true" class="lineItemInputBox form-control" value="<?php if ((isset($_smarty_tpl->tpl_vars['FINAL']->value['adjustment'])) && $_smarty_tpl->tpl_vars['FINAL']->value['adjustment'] < 0) {
echo abs($_smarty_tpl->tpl_vars['FINAL']->value['adjustment']);
} elseif ((isset($_smarty_tpl->tpl_vars['FINAL']->value['adjustment'])) && $_smarty_tpl->tpl_vars['FINAL']->value['adjustment']) {
echo $_smarty_tpl->tpl_vars['FINAL']->value['adjustment'];
} else { ?>0<?php }?>"></span></td></tr><tr valign="top"><td width="83%"><span class="pull-right"><strong><?php echo vtranslate('LBL_GRAND_TOTAL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></span></td><td><span id="grandTotal" name="grandTotal" class="pull-right grandTotal"><?php echo (isset($_smarty_tpl->tpl_vars['FINAL']->value['grandTotal'])) ? $_smarty_tpl->tpl_vars['FINAL']->value['grandTotal'] : '';?>
</span></td></tr><?php if ($_smarty_tpl->tpl_vars['MODULE']->value == 'Invoice' || $_smarty_tpl->tpl_vars['MODULE']->value == 'PurchaseOrder') {?><tr valign="top"><td width="83%" ><div class="pull-right"><?php if ($_smarty_tpl->tpl_vars['MODULE']->value == 'Invoice') {?><strong><?php echo vtranslate('LBL_RECEIVED',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong><?php } else { ?><strong><?php echo vtranslate('LBL_PAID',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong><?php }?></div></td><td><?php if ($_smarty_tpl->tpl_vars['MODULE']->value == 'Invoice') {?><span class="pull-right"><input id="received" name="received" type="text" class="lineItemInputBox form-control" value="<?php if ($_smarty_tpl->tpl_vars['RECORD']->value->getDisplayValue('received') && !($_smarty_tpl->tpl_vars['IS_DUPLICATE']->value)) {
echo $_smarty_tpl->tpl_vars['RECORD']->value->getDisplayValue('received');
} else { ?>0<?php }?>"></span><?php } else { ?><span class="pull-right"><input id="paid" name="paid" type="text" class="lineItemInputBox" value="<?php if ($_smarty_tpl->tpl_vars['RECORD']->value->getDisplayValue('paid') && !($_smarty_tpl->tpl_vars['IS_DUPLICATE']->value)) {
echo $_smarty_tpl->tpl_vars['RECORD']->value->getDisplayValue('paid');
} else { ?>0<?php }?>"></span><?php }?></td></tr><tr valign="top"><td width="83%" ><div class="pull-right"><strong><?php echo vtranslate('LBL_BALANCE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></div></td><td><span class="pull-right"><input id="balance" name="balance" type="text" class="lineItemInputBox form-control" value="<?php if ($_smarty_tpl->tpl_vars['RECORD']->value->getDisplayValue('balance') && !($_smarty_tpl->tpl_vars['IS_DUPLICATE']->value)) {
echo $_smarty_tpl->tpl_vars['RECORD']->value->getDisplayValue('balance');
} else { ?>0<?php }?>" readonly></span></td></tr><?php }?></table></div><?php }?></div><?php }
}
