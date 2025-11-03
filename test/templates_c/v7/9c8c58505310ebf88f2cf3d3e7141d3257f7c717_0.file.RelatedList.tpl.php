<?php
/* Smarty version 4.5.5, created on 2025-11-02 08:36:40
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Vtiger\RelatedList.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690718183fc247_77151784',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9c8c58505310ebf88f2cf3d3e7141d3257f7c717' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Vtiger\\RelatedList.tpl',
      1 => 1761802269,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690718183fc247_77151784 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('RELATED_MODULE_NAME', $_smarty_tpl->tpl_vars['RELATED_MODULE']->value->get('name'));
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "PicklistColorMap.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('LISTVIEW_HEADERS'=>$_smarty_tpl->tpl_vars['RELATED_HEADERS']->value), 0, true);
?><div class="relatedContainer"><?php ob_start();
if ($_smarty_tpl->tpl_vars['RELATION_FIELD']->value) {
echo (string)$_smarty_tpl->tpl_vars['RELATION_FIELD']->value->isActiveField();
} else {
echo "false";
}
$_prefixVariable1=ob_get_clean();
$_smarty_tpl->_assignInScope('IS_RELATION_FIELD_ACTIVE', $_prefixVariable1);?><input type="hidden" name="currentPageNum" value="<?php echo $_smarty_tpl->tpl_vars['PAGING']->value->getCurrentPage();?>
" /><input type="hidden" name="relatedModuleName" class="relatedModuleName" value="<?php echo $_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value;?>
" /><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['ORDER_BY']->value;?>
" id="orderBy"><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['SORT_ORDER']->value;?>
" id="sortOrder"><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['RELATED_ENTIRES_COUNT']->value;?>
" id="noOfEntries"><input type='hidden' value="<?php echo $_smarty_tpl->tpl_vars['PAGING']->value->getPageLimit();?>
" id='pageLimit'><input type='hidden' value="<?php echo $_smarty_tpl->tpl_vars['PAGING']->value->get('page');?>
" id='pageNumber'><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['PAGING']->value->isNextPageExists();?>
" id="nextPageExist"/><input type='hidden' value="<?php echo $_smarty_tpl->tpl_vars['TOTAL_ENTRIES']->value;?>
" id='totalCount'><input type='hidden' value="<?php echo $_smarty_tpl->tpl_vars['TAB_LABEL']->value;?>
" id='tab_label' name='tab_label'><input type='hidden' value="<?php echo $_smarty_tpl->tpl_vars['IS_RELATION_FIELD_ACTIVE']->value;?>
" id='isRelationFieldActive'><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "partials/RelatedListHeader.tpl",$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
if ($_smarty_tpl->tpl_vars['MODULE']->value == 'Products' && $_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value == 'Products' && $_smarty_tpl->tpl_vars['TAB_LABEL']->value === 'Product Bundles' && $_smarty_tpl->tpl_vars['RELATED_LIST_LINKS']->value) {?><div data-module="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
" style = "margin-left:20px"><?php $_smarty_tpl->_assignInScope('IS_VIEWABLE', $_smarty_tpl->tpl_vars['PARENT_RECORD']->value->isBundleViewable());?><input type="hidden" class="isShowBundles" value="<?php echo $_smarty_tpl->tpl_vars['IS_VIEWABLE']->value;?>
"><label class="showBundlesInInventory checkbox"><input type="checkbox" <?php if ($_smarty_tpl->tpl_vars['IS_VIEWABLE']->value) {?>checked<?php }?> value="<?php echo $_smarty_tpl->tpl_vars['IS_VIEWABLE']->value;?>
">&nbsp;&nbsp;<?php echo vtranslate('LBL_SHOW_BUNDLE_IN_INVENTORY',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></div><?php }?><div class="relatedContents col-lg-12 col-md-12 col-sm-12 table-container"><div class="bottomscroll-div"><table id="listview-table" class="table listview-table"><thead><tr class="listViewHeaders"><th style="min-width:100px"></th><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RELATED_HEADERS']->value, 'HEADER_FIELD');
$_smarty_tpl->tpl_vars['HEADER_FIELD']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['HEADER_FIELD']->value) {
$_smarty_tpl->tpl_vars['HEADER_FIELD']->do_else = false;
if ($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column') == 'time_start' || $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column') == 'time_end') {?><th class="nowrap" style="width:15px"><?php } else { ?><th class="nowrap"><?php if ($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column') == "access_count" || $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column') == "idlists") {?><a href="javascript:void(0);" class="noSorting"><?php echo vtranslate($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('label'),$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);?>
</a><?php } else { ?><a href="javascript:void(0);" class="listViewContentHeaderValues" data-nextsortorderval="<?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value == $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column')) {
echo $_smarty_tpl->tpl_vars['NEXT_SORT_ORDER']->value;
} else { ?>ASC<?php }?>" data-fieldname="<?php echo $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column');?>
"><?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value == $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column')) {?><i class="fa fa-sort <?php echo $_smarty_tpl->tpl_vars['FASORT_IMAGE']->value;?>
"></i><?php } else { ?><i class="fa fa-sort customsort"></i><?php }?>&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('label'),$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);?>
&nbsp;<?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value == $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column')) {?><img class="<?php echo $_smarty_tpl->tpl_vars['SORT_IMAGE']->value;?>
"><?php }?>&nbsp;</a><?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value == $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column')) {?><a href="#" class="removeSorting"><i class="fa fa-remove"></i></a><?php }
}
}?></th><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tr><tr class="searchRow"><th class="inline-search-btn"><button class="btn btn-success btn-sm" data-trigger="relatedListSearch"><?php echo vtranslate("LBL_SEARCH",$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button></th><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RELATED_HEADERS']->value, 'HEADER_FIELD');
$_smarty_tpl->tpl_vars['HEADER_FIELD']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['HEADER_FIELD']->value) {
$_smarty_tpl->tpl_vars['HEADER_FIELD']->do_else = false;
?><th><?php if ($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column') == 'time_start' || $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column') == 'time_end' || $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getFieldDataType() == 'reference') {
} else {
$_smarty_tpl->_assignInScope('FIELD_UI_TYPE_MODEL', $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getUITypeModel());
$_smarty_tpl->_assignInScope('SEARCH_DETAILS_FIELD_INFO', array('searchValue'=>'','comparator'=>''));
if ((isset($_smarty_tpl->tpl_vars['SEARCH_DETAILS']->value[$_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getName()]))) {
$_smarty_tpl->_assignInScope('SEARCH_DETAILS_FIELD_INFO', $_smarty_tpl->tpl_vars['SEARCH_DETAILS']->value[$_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getName()]);
}
$_smarty_tpl->_subTemplateRender(vtemplate_path($_smarty_tpl->tpl_vars['FIELD_UI_TYPE_MODEL']->value->getListSearchTemplateName(),$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('FIELD_MODEL'=>$_smarty_tpl->tpl_vars['HEADER_FIELD']->value,'SEARCH_INFO'=>$_smarty_tpl->tpl_vars['SEARCH_DETAILS_FIELD_INFO']->value,'USER_MODEL'=>$_smarty_tpl->tpl_vars['USER_MODEL']->value), 0, true);
?><input type="hidden" class="operatorValue" value="<?php echo $_smarty_tpl->tpl_vars['SEARCH_DETAILS_FIELD_INFO']->value['comparator'];?>
"><?php }?></th><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tr></thead><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RELATED_RECORDS']->value, 'RELATED_RECORD');
$_smarty_tpl->tpl_vars['RELATED_RECORD']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['RELATED_RECORD']->value) {
$_smarty_tpl->tpl_vars['RELATED_RECORD']->do_else = false;
?><tr class="listViewEntries" data-id='<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getId();?>
'<?php if ($_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value == 'Calendar') {?>data-recurring-enabled='<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->isRecurringEnabled();?>
'<?php $_smarty_tpl->_assignInScope('DETAILVIEWPERMITTED', isPermitted($_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value,'DetailView',$_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getId()));
if ($_smarty_tpl->tpl_vars['DETAILVIEWPERMITTED']->value == 'yes') {?>data-recordUrl='<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDetailViewUrl();?>
'<?php }
} else { ?>data-recordUrl='<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDetailViewUrl();?>
'<?php }?>><td class="related-list-actions"><span class="actionImages">&nbsp;&nbsp;&nbsp;<?php if ($_smarty_tpl->tpl_vars['IS_EDITABLE']->value && $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->isEditable()) {
if ($_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value == 'PriceBooks' && (!empty($_smarty_tpl->tpl_vars['RELATED_HEADERS']->value['listprice']) || !empty($_smarty_tpl->tpl_vars['RELATED_HEADERS']->value['unit_price']))) {
if (!empty($_smarty_tpl->tpl_vars['RELATED_HEADERS']->value['listprice'])) {
$_smarty_tpl->_assignInScope('LISTPRICE', CurrencyField::convertToUserFormat($_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get('listprice'),null,true));
}
}
if ($_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value == 'PriceBooks') {?><a data-url="index.php?module=PriceBooks&view=ListPriceUpdate&record=<?php echo $_smarty_tpl->tpl_vars['PARENT_RECORD']->value->getId();?>
&relid=<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getId();?>
&currentPrice=<?php echo $_smarty_tpl->tpl_vars['LISTPRICE']->value;?>
"class="editListPrice cursorPointer" data-related-recordid='<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getId();?>
' data-list-price=<?php echo $_smarty_tpl->tpl_vars['LISTPRICE']->value;
} elseif ($_smarty_tpl->tpl_vars['MODULE']->value == 'Products' && $_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value == 'Products' && $_smarty_tpl->tpl_vars['TAB_LABEL']->value === 'Product Bundles' && $_smarty_tpl->tpl_vars['RELATED_LIST_LINKS']->value && $_smarty_tpl->tpl_vars['PARENT_RECORD']->value->isBundle()) {
$_smarty_tpl->_assignInScope('quantity', $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get($_smarty_tpl->tpl_vars['RELATION_FIELD']->value->getName()));?><a class="quantityEdit" data-url="index.php?module=Products&view=SubProductQuantityUpdate&record=<?php echo $_smarty_tpl->tpl_vars['PARENT_RECORD']->value->getId();?>
&relid=<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getId();?>
&currentQty=<?php echo $_smarty_tpl->tpl_vars['quantity']->value;?>
"onclick ="Products_Detail_Js.triggerEditQuantity('index.php?module=Products&view=SubProductQuantityUpdate&record=<?php echo $_smarty_tpl->tpl_vars['PARENT_RECORD']->value->getId();?>
&relid=<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getId();?>
&currentQty=<?php echo $_smarty_tpl->tpl_vars['quantity']->value;?>
');if(event.stopPropagation){event.stopPropagation();}else{event.cancelBubble=true;}"<?php } else { ?><a name="relationEdit" data-url="<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getEditViewUrl();?>
"<?php }?>><i class="fa fa-pencil" title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"></i></a> &nbsp;&nbsp;<?php }
if ($_smarty_tpl->tpl_vars['IS_DELETABLE']->value) {?><a class="relationDelete"><i title="<?php echo vtranslate('LBL_UNLINK',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="vicon-linkopen"></i></a><?php }?></span></td><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RELATED_HEADERS']->value, 'HEADER_FIELD');
$_smarty_tpl->tpl_vars['HEADER_FIELD']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['HEADER_FIELD']->value) {
$_smarty_tpl->tpl_vars['HEADER_FIELD']->do_else = false;
$_smarty_tpl->_assignInScope('RELATED_HEADERNAME', $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('name'));
$_smarty_tpl->_assignInScope('RELATED_LIST_VALUE', $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value));?><td class="relatedListEntryValues" title="<?php echo strip_tags((($_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDisplayValue($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value) !== null )) ? $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDisplayValue($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value) : '');?>
" data-field-type="<?php echo $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getFieldDataType();?>
" nowrap><span class="value textOverflowEllipsis"><?php if ($_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value == 'Documents' && $_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value == 'document_source') {?><center><?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value);?>
</center><?php } else {
if ($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->isNameField() == true || $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('uitype') == '4') {?><a href="<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDetailViewUrl();?>
"><?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDisplayValue($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value);?>
</a><?php } elseif ($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value == 'access_count') {
echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getAccessCountValue($_smarty_tpl->tpl_vars['PARENT_RECORD']->value->getId());
} elseif ($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value == 'time_start' || $_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value == 'time_end') {
} elseif ($_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value == 'PriceBooks' && ($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value == 'listprice' || $_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value == 'unit_price')) {
if ($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value == 'listprice') {
$_smarty_tpl->_assignInScope('LISTPRICE', CurrencyField::convertToUserFormat($_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value),null,true));
}
echo CurrencyField::convertToUserFormat($_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value),null,true);
} elseif ($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('uitype') == '71' || $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('uitype') == '72') {
$_smarty_tpl->_assignInScope('CURRENCY_SYMBOL', Vtiger_RelationListView_Model::getCurrencySymbol($_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get('id'),$_smarty_tpl->tpl_vars['HEADER_FIELD']->value));
$_smarty_tpl->_assignInScope('CURRENCY_VALUE', CurrencyField::convertToUserFormat($_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value)));
if ($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('uitype') == '72') {
$_smarty_tpl->_assignInScope('CURRENCY_VALUE', CurrencyField::convertToUserFormat($_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value),null,true));
}
if (Users_Record_Model::getCurrentUserModel()->get('currency_symbol_placement') == '$1.0') {
echo $_smarty_tpl->tpl_vars['CURRENCY_SYMBOL']->value;
echo $_smarty_tpl->tpl_vars['CURRENCY_VALUE']->value;
} else {
echo $_smarty_tpl->tpl_vars['CURRENCY_VALUE']->value;
echo $_smarty_tpl->tpl_vars['CURRENCY_SYMBOL']->value;
}
if ($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value == 'listprice') {
$_smarty_tpl->_assignInScope('LISTPRICE', CurrencyField::convertToUserFormat($_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value),null,true));
}
} elseif ($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getFieldDataType() == 'picklist') {
if ($_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value == 'Calendar' || $_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value == 'Events') {
if ($_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get('activitytype') == 'Task') {
ob_start();
echo $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getId();
$_prefixVariable2 = ob_get_clean();
$_smarty_tpl->_assignInScope('PICKLIST_FIELD_ID', $_prefixVariable2);
} else {
if ($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getName() == 'taskstatus') {
$_smarty_tpl->_assignInScope('EVENT_STATUS_FIELD_MODEL', Vtiger_Field_Model::getInstance('eventstatus',Vtiger_Module_Model::getInstance('Events')));
if ($_smarty_tpl->tpl_vars['EVENT_STATUS_FIELD_MODEL']->value) {
ob_start();
echo $_smarty_tpl->tpl_vars['EVENT_STATUS_FIELD_MODEL']->value->getId();
$_prefixVariable3 = ob_get_clean();
$_smarty_tpl->_assignInScope('PICKLIST_FIELD_ID', $_prefixVariable3);
} else {
ob_start();
echo $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getId();
$_prefixVariable4 = ob_get_clean();
$_smarty_tpl->_assignInScope('PICKLIST_FIELD_ID', $_prefixVariable4);
}
} else {
ob_start();
echo $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getId();
$_prefixVariable5 = ob_get_clean();
$_smarty_tpl->_assignInScope('PICKLIST_FIELD_ID', $_prefixVariable5);
}
}
} else {
ob_start();
echo $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getId();
$_prefixVariable6 = ob_get_clean();
$_smarty_tpl->_assignInScope('PICKLIST_FIELD_ID', $_prefixVariable6);
}?><span <?php if (!empty($_smarty_tpl->tpl_vars['RELATED_LIST_VALUE']->value)) {?> class="picklist-color picklist-<?php echo $_smarty_tpl->tpl_vars['PICKLIST_FIELD_ID']->value;?>
-<?php echo Vtiger_Util_Helper::convertSpaceToHyphen($_smarty_tpl->tpl_vars['RELATED_LIST_VALUE']->value);?>
" <?php }?>> <?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDisplayValue($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value);?>
 </span><?php } else {
echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDisplayValue($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value);
if ($_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value == 'Documents' && $_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value == 'filename' && isPermitted($_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value,'DetailView',$_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getId()) == 'yes') {?><span class="actionImages"><?php $_smarty_tpl->_assignInScope('RECORD_ID', $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getId());
$_smarty_tpl->_assignInScope('DOCUMENT_RECORD_MODEL', Vtiger_Record_Model::getInstanceById($_smarty_tpl->tpl_vars['RECORD_ID']->value));
if ($_smarty_tpl->tpl_vars['DOCUMENT_RECORD_MODEL']->value->get('filename') && $_smarty_tpl->tpl_vars['DOCUMENT_RECORD_MODEL']->value->get('filestatus')) {?><a name="viewfile" href="javascript:void(0)" data-filelocationtype="<?php echo $_smarty_tpl->tpl_vars['DOCUMENT_RECORD_MODEL']->value->get('filelocationtype');?>
" data-filename="<?php echo $_smarty_tpl->tpl_vars['DOCUMENT_RECORD_MODEL']->value->get('filename');?>
" onclick="Vtiger_Header_Js.previewFile(event)"><i title="<?php echo vtranslate('LBL_VIEW_FILE',$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);?>
" class="icon-picture alignMiddle"></i></a>&nbsp;<?php }
if ($_smarty_tpl->tpl_vars['DOCUMENT_RECORD_MODEL']->value->get('filename') && $_smarty_tpl->tpl_vars['DOCUMENT_RECORD_MODEL']->value->get('filestatus') && $_smarty_tpl->tpl_vars['DOCUMENT_RECORD_MODEL']->value->get('filelocationtype') == 'I') {?><a name="downloadfile" href="<?php echo $_smarty_tpl->tpl_vars['DOCUMENT_RECORD_MODEL']->value->getDownloadFileURL();?>
"><i title="<?php echo vtranslate('LBL_DOWNLOAD_FILE',$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);?>
" class="icon-download-alt alignMiddle"></i></a>&nbsp;<?php }?></span><?php }
}
}?></span></td><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></table></div></div><?php echo '<script'; ?>
 type="text/javascript">var related_uimeta = (function () {var fieldInfo = <?php echo $_smarty_tpl->tpl_vars['RELATED_FIELDS_INFO']->value;?>
;return {field: {get: function (name, property) {if (name && property === undefined) {return fieldInfo[name];}if (name && property) {return fieldInfo[name][property]}},isMandatory: function (name) {if (fieldInfo[name]) {return fieldInfo[name].mandatory;}return false;},getType: function (name) {if (fieldInfo[name]) {return fieldInfo[name].type}return false;}}};})();<?php echo '</script'; ?>
></div>
<?php }
}
