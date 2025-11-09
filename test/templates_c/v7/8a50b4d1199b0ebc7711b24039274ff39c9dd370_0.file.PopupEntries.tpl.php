<?php
/* Smarty version 4.5.5, created on 2025-11-05 18:15:31
  from 'C:\xampp\htdocs\HTQL-Khach-Hang-CRM-vvan\layouts\v7\modules\Inventory\PopupEntries.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690b9443ac1f87_76981666',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8a50b4d1199b0ebc7711b24039274ff39c9dd370' => 
    array (
      0 => 'C:\\xampp\\htdocs\\HTQL-Khach-Hang-CRM-vvan\\layouts\\v7\\modules\\Inventory\\PopupEntries.tpl',
      1 => 1762352656,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690b9443ac1f87_76981666 (Smarty_Internal_Template $_smarty_tpl) {
?>
<input type='hidden' id='pageNumber' value="<?php echo $_smarty_tpl->tpl_vars['PAGE_NUMBER']->value;?>
"><input type='hidden' id='pageLimit' value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->getPageLimit();?>
"><input type="hidden" id="noOfEntries" value="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value;?>
"><input type="hidden" id="pageStartRange" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->getRecordStartRange();?>
" /><input type="hidden" id="pageEndRange" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->getRecordEndRange();?>
" /><input type="hidden" id="view" value="<?php echo $_smarty_tpl->tpl_vars['VIEW']->value;?>
"/><input type="hidden" id="previousPageExist" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->isPrevPageExists();?>
" /><input type="hidden" id="nextPageExist" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->isNextPageExists();?>
" /><input type="hidden" id="totalCount" value="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_COUNT']->value;?>
" /><input type="hidden" value="<?php echo Vtiger_Util_Helper::toSafeHTML(Zend_JSON::encode($_smarty_tpl->tpl_vars['SEARCH_DETAILS']->value));?>
" id="currentSearchParams" /><?php if ((!empty($_smarty_tpl->tpl_vars['SUBPRODUCTS_POPUP']->value)) && (!empty($_smarty_tpl->tpl_vars['PARENT_PRODUCT_ID']->value))) {?><input type="hidden" id="subProductsPopup" value="<?php echo $_smarty_tpl->tpl_vars['SUBPRODUCTS_POPUP']->value;?>
" /><input type="hidden" id="parentProductId" value="<?php echo $_smarty_tpl->tpl_vars['PARENT_PRODUCT_ID']->value;?>
" /><?php }?><div class="contents-topscroll"><div class="topscroll-div">&nbsp;</div></div><div class="popupEntriesDiv relatedContents contents-bottomscroll"><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['ORDER_BY']->value;?>
" id="orderBy"><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['SORT_ORDER']->value;?>
" id="sortOrder"><input type="hidden" value="Inventory_Popup_Js" id="popUpClassName"/><?php $_smarty_tpl->_assignInScope('WIDTHTYPE', $_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('rowheight'));?><div class="bottomscroll-div"><table class="listview-table table-bordered listViewEntriesTable"><thead><tr class="listViewHeaders"><?php if ($_smarty_tpl->tpl_vars['MULTI_SELECT']->value) {?><th class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><input type="checkbox" class="selectAllInCurrentPage" /></th><?php } else { ?><th class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
">&nbsp;</th><?php }
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value, 'LISTVIEW_HEADER');
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value) {
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = false;
?><th class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><a href="javascript:void(0);" class="listViewContentHeaderValues listViewHeaderValues" data-nextsortorderval="<?php if ($_smarty_tpl->tpl_vars['ORDER_BY']->value == $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('column')) {
echo $_smarty_tpl->tpl_vars['NEXT_SORT_ORDER']->value;
} else { ?>ASC<?php }?>" data-columnname="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('column');?>
"><?php if ($_smarty_tpl->tpl_vars['ORDER_BY']->value == $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('column')) {?><i class="fa fa-sort <?php echo $_smarty_tpl->tpl_vars['FASORT_IMAGE']->value;?>
"></i><?php } else { ?><i class="fa fa-sort customsort"></i><?php }?>&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('label'),$_smarty_tpl->tpl_vars['TARGET_MODULE']->value);?>
&nbsp;</a></th><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
if ($_smarty_tpl->tpl_vars['RELATED_MODULE']->value == 'Products') {?><th></th><?php }?></tr></thead><?php if ($_smarty_tpl->tpl_vars['MODULE_MODEL']->value && $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->isQuickSearchEnabled()) {?><tr class="searchRow"><td class="searchBtn textAlignCenter"><button class="btn btn-success" data-trigger="PopupListSearch"><?php echo vtranslate('LBL_SEARCH',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button></td><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value, 'LISTVIEW_HEADER');
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value) {
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = false;
?><td><?php $_smarty_tpl->_assignInScope('FIELD_UI_TYPE_MODEL', $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getUITypeModel());
$_smarty_tpl->_assignInScope('FIELD_SEARCH_INFO', array("searchValue"=>''));
if ((isset($_smarty_tpl->tpl_vars['SEARCH_DETAILS']->value[$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getName()]))) {
ob_start();
$_smarty_tpl->_assignInScope('FIELD_SEARCH_INFO', $_smarty_tpl->tpl_vars['SEARCH_DETAILS']->value[$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getName()]);
$_prefixVariable1 = ob_get_clean();
echo $_prefixVariable1;
}
$_smarty_tpl->_subTemplateRender(vtemplate_path($_smarty_tpl->tpl_vars['FIELD_UI_TYPE_MODEL']->value->getListSearchTemplateName(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('FIELD_MODEL'=>$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value,'SEARCH_INFO'=>$_smarty_tpl->tpl_vars['FIELD_SEARCH_INFO']->value,'USER_MODEL'=>$_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value), 0, true);
?></td><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
if ($_smarty_tpl->tpl_vars['RELATED_MODULE']->value == 'Products') {?><td></td><?php }?></tr><?php }
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES']->value, 'LISTVIEW_ENTRY', false, NULL, 'popupListView', array (
  'index' => true,
));
$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value) {
$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_popupListView']->value['index']++;
ob_start();
echo implode(' ',$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getRawData());
$_prefixVariable2=ob_get_clean();
$_smarty_tpl->_assignInScope('RECORD_DATA', $_prefixVariable2);?><tr class="listViewEntries" data-id="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getId();?>
" data-name='<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getName();?>
' data-info='<?php echo Vtiger_Util_Helper::toSafeHTML(ZEND_JSON::encode($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getRawData()));?>
'<?php if ($_smarty_tpl->tpl_vars['GETURL']->value != '') {?> data-url="<?php $_prefixVariable3 = $_smarty_tpl->tpl_vars['GETURL']->value;
echo (($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->$_prefixVariable3()).('&sourceModule=')).($_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
" <?php }?>  id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_popUpListView_row_<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_popupListView']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_popupListView']->value['index'] : null)+1;?>
"><?php if ($_smarty_tpl->tpl_vars['MULTI_SELECT']->value) {?><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><input class="entryCheckBox" type="checkbox" /></td><?php } else { ?><td></td><?php }
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value, 'LISTVIEW_HEADER');
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value) {
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = false;
$_smarty_tpl->_assignInScope('LISTVIEW_HEADERNAME', $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name'));?><td class="listViewEntryValue textOverflowEllipsis <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->isNameField() == true || $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('uitype') == '4') {?><a><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value);?>
</a><?php } elseif ($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('uitype') == '72') {
ob_start();
echo $_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('currency_symbol_placement');
$_prefixVariable4 = ob_get_clean();
$_smarty_tpl->_assignInScope('CURRENCY_SYMBOL_PLACEMENT', $_prefixVariable4);
if ($_smarty_tpl->tpl_vars['CURRENCY_SYMBOL_PLACEMENT']->value == '1.0$') {
echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value);
echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('currencySymbol');
} else {
echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('currencySymbol');
echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value);
}
} else {
echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value);
}?></td><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
if ($_smarty_tpl->tpl_vars['RELATED_MODULE']->value == 'Products') {?><td class="listViewEntryValue <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('subProducts') == true) {?><a class="subproducts"><b><?php echo vtranslate('LBL_SUB_PRODUCTS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</b></a><!--<img class="lineItemPopup cursorPointer alignMiddle" data-popup="ProductsPopup" title="<?php echo vtranslate('Products',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" data-module-name="Products" data-field-name="productid" src="<?php echo vimage_path('Products.png');?>
"/>--><?php } else {
echo vtranslate('NOT_A_BUNDLE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);
}?></td><?php }?></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></table><!--added this div for Temporarily --><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value == '0') {
if ($_smarty_tpl->tpl_vars['IS_MODULE_DISABLED']->value == 'true') {?><div class="emptyRecordsDiv"><?php echo vtranslate('LBL_PRODUCTSMOD_DISABLED',$_smarty_tpl->tpl_vars['RELATED_MODULE']->value);?>
.</div><?php } else { ?><div class="emptyRecordsDiv"><?php echo vtranslate('LBL_NO',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['RELATED_MODULE']->value,$_smarty_tpl->tpl_vars['RELATED_MODULE']->value);?>
 <?php echo vtranslate('LBL_FOUND',$_smarty_tpl->tpl_vars['MODULE']->value);?>
.</div><?php }
}?></div></div><?php if ((!empty($_smarty_tpl->tpl_vars['SUBPRODUCTS_POPUP']->value)) && (!empty($_smarty_tpl->tpl_vars['PARENT_PRODUCT_ID']->value))) {?><div style="margin-top: 10px; height:50px"><div class="pull-right"><button type="button" class="btn btn-default" id="backToProducts"><strong><?php echo vtranslate('LBL_BACK_TO_PRODUCTS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button></div></div><?php }?><div id="scroller_wrapper" class="bottom-fixed-scroll"><div id="scroller" class="scroller-div"></div></div><?php if ($_smarty_tpl->tpl_vars['FIELDS_INFO']->value != null) {
echo '<script'; ?>
 type="text/javascript">var popup_uimeta = (function() {var fieldInfo = <?php echo $_smarty_tpl->tpl_vars['FIELDS_INFO']->value;?>
;return {field: {get: function(name, property) {if (name && property === undefined) {return fieldInfo[name];}if (name && property) {return fieldInfo[name][property]}},isMandatory: function(name) {if (fieldInfo[name]) {return fieldInfo[name].mandatory;}return false;},getType: function(name) {if (fieldInfo[name]) {return fieldInfo[name].type}return false;}},};})();<?php echo '</script'; ?>
><?php }
}
}
