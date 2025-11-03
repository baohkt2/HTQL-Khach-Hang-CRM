<?php
/* Smarty version 4.5.5, created on 2025-11-02 16:53:12
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Vtiger\PopupContents.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_69078c780b03a2_14710315',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1e6df1188dc6c3ac5acc8abdf5d938c794ff5dd6' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Vtiger\\PopupContents.tpl',
      1 => 1761802269,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69078c780b03a2_14710315 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "PicklistColorMap.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?><div class="row"><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( 'PopupNavigation.tpl',$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></div><div class="row"><div class="col-md-12"><input type='hidden' id='pageNumber' value="<?php echo $_smarty_tpl->tpl_vars['PAGE_NUMBER']->value;?>
"><input type='hidden' id='pageLimit' value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->getPageLimit();?>
"><input type="hidden" id="noOfEntries" value="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value;?>
"><input type="hidden" id="pageStartRange" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->getRecordStartRange();?>
" /><input type="hidden" id="pageEndRange" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->getRecordEndRange();?>
" /><input type="hidden" id="previousPageExist" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->isPrevPageExists();?>
" /><input type="hidden" id="nextPageExist" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->isNextPageExists();?>
" /><input type="hidden" id="totalCount" value="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value;?>
" /><?php if ((isset($_smarty_tpl->tpl_vars['GETURL']->value))) {?><input type="hidden" id="getUrl" value="<?php echo $_smarty_tpl->tpl_vars['GETURL']->value;?>
" /><?php }
if ((isset($_smarty_tpl->tpl_vars['SEARCH_DETAILS']->value))) {?><input type="hidden" value="<?php echo Vtiger_Util_Helper::toSafeHTML(Zend_JSON::encode($_smarty_tpl->tpl_vars['SEARCH_DETAILS']->value));?>
" id="currentSearchParams" /><?php }?><div class="contents-topscroll"><div class="topscroll-div">&nbsp;</div></div><div class="popupEntriesDiv relatedContents"><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['ORDER_BY']->value;?>
" id="orderBy"><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['SORT_ORDER']->value;?>
" id="sortOrder"><?php if ($_smarty_tpl->tpl_vars['SOURCE_MODULE']->value == "Emails") {
if ($_smarty_tpl->tpl_vars['MODULE']->value != 'Documents') {?><input type="hidden" value="Vtiger_EmailsRelatedModule_Popup_Js" id="popUpClassName"/><?php }
}
$_smarty_tpl->_assignInScope('WIDTHTYPE', $_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('rowheight'));?><div class="popupEntriesTableContainer <?php if ($_smarty_tpl->tpl_vars['MODULE']->value == 'EmailTemplates') {?> emailTemplatesPopupTableContainer<?php }?>"><table class="listview-table table-bordered listViewEntriesTable"><thead><tr class="listViewHeaders"><?php if ((isset($_smarty_tpl->tpl_vars['MULTI_SELECT']->value))) {?><th class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><input type="checkbox" class="selectAllInCurrentPage" /></th><?php } elseif ($_smarty_tpl->tpl_vars['MODULE']->value != 'EmailTemplates') {?><th class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
">&nbsp;</th><?php }
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value, 'LISTVIEW_HEADER');
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value) {
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = false;
?><th class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><a href="javascript:void(0);" class="listViewContentHeaderValues listViewHeaderValues <?php if ($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name') == 'listprice') {?> noSorting <?php }?>" data-nextsortorderval="<?php if ($_smarty_tpl->tpl_vars['ORDER_BY']->value == $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name')) {
echo $_smarty_tpl->tpl_vars['NEXT_SORT_ORDER']->value;
} else { ?>ASC<?php }?>" data-columnname="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name');?>
"><?php if ($_smarty_tpl->tpl_vars['ORDER_BY']->value == $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name')) {?><i class="fa fa-sort <?php echo $_smarty_tpl->tpl_vars['FASORT_IMAGE']->value;?>
"></i><?php } else { ?><i class="fa fa-sort customsort"></i><?php }?>&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;</a></th><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tr></thead><?php if ($_smarty_tpl->tpl_vars['MODULE_MODEL']->value && $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->isQuickSearchEnabled()) {?><tr class="searchRow"><td class="textAlignCenter"><button class="btn btn-success" data-trigger="PopupListSearch"><?php echo vtranslate('LBL_SEARCH',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button></td><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value, 'LISTVIEW_HEADER');
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value) {
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = false;
?><td><?php $_smarty_tpl->_assignInScope('FIELD_UI_TYPE_MODEL', $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getUITypeModel());
$_smarty_tpl->_assignInScope('SEARCH_DETAILS_FIELD_INFO', array('searchValue'=>'','comparator'=>''));
if ((isset($_smarty_tpl->tpl_vars['SEARCH_DETAILS']->value[$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getName()]))) {
$_smarty_tpl->_assignInScope('SEARCH_DETAILS_FIELD_INFO', $_smarty_tpl->tpl_vars['SEARCH_DETAILS']->value[$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getName()]);
}
$_smarty_tpl->_subTemplateRender(vtemplate_path($_smarty_tpl->tpl_vars['FIELD_UI_TYPE_MODEL']->value->getListSearchTemplateName(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('FIELD_MODEL'=>$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value,'SEARCH_INFO'=>$_smarty_tpl->tpl_vars['SEARCH_DETAILS_FIELD_INFO']->value,'USER_MODEL'=>$_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value), 0, true);
?></td><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tr><?php }
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES']->value, 'LISTVIEW_ENTRY', false, NULL, 'popupListView', array (
  'index' => true,
));
$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value) {
$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_popupListView']->value['index']++;
$_smarty_tpl->_assignInScope('RECORD_DATA', $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getRawData());?><tr class="listViewEntries" data-id="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getId();?>
" <?php if ($_smarty_tpl->tpl_vars['MODULE']->value == 'EmailTemplates') {?> data-name="<?php echo $_smarty_tpl->tpl_vars['RECORD_DATA']->value['subject'];?>
" data-info="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('body');?>
" <?php } else { ?> data-name="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getName();?>
" data-info='<?php echo Vtiger_Util_Helper::toSafeHTML(ZEND_JSON::encode($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getRawData()));?>
' <?php }
if ((isset($_smarty_tpl->tpl_vars['GETURL']->value)) && $_smarty_tpl->tpl_vars['GETURL']->value != '') {?> data-url='<?php $_prefixVariable2 = $_smarty_tpl->tpl_vars['GETURL']->value;
echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->$_prefixVariable2();?>
' <?php }?>  id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_popUpListView_row_<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_popupListView']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_popupListView']->value['index'] : null)+1;?>
"><?php if ((isset($_smarty_tpl->tpl_vars['MULTI_SELECT']->value)) && $_smarty_tpl->tpl_vars['MULTI_SELECT']->value) {?><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><input class="entryCheckBox" type="checkbox" /></td><?php } elseif ($_smarty_tpl->tpl_vars['MODULE']->value != 'EmailTemplates') {?><td></td><?php }
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value, 'LISTVIEW_HEADER');
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value) {
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = false;
$_smarty_tpl->_assignInScope('LISTVIEW_HEADERNAME', $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name'));
$_smarty_tpl->_assignInScope('LISTVIEW_ENTRY_VALUE', $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value));
$_smarty_tpl->_assignInScope('RECORD_DATA_LISTVIEW_HEADERNAME', '');
if ((isset($_smarty_tpl->tpl_vars['RECORD_DATA']->value[$_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value]))) {
$_smarty_tpl->_assignInScope('RECORD_DATA_LISTVIEW_HEADERNAME', $_smarty_tpl->tpl_vars['RECORD_DATA']->value[$_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value]);
}?><td class="listViewEntryValue value textOverflowEllipsis <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['RECORD_DATA_LISTVIEW_HEADERNAME']->value;?>
"><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->isNameField() == true || $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('uitype') == '4') {?><a><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value);?>
</a><?php } elseif ($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('uitype') == '72') {
ob_start();
echo $_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('currency_symbol_placement');
$_prefixVariable3 = ob_get_clean();
$_smarty_tpl->_assignInScope('CURRENCY_SYMBOL_PLACEMENT', $_prefixVariable3);
if ($_smarty_tpl->tpl_vars['CURRENCY_SYMBOL_PLACEMENT']->value == '1.0$') {
echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value);
echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('currencySymbol');
} else {
echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('currencySymbol');
echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value);
}
} elseif ($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value == 'listprice') {
echo CurrencyField::convertToUserFormat($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value),null,true,true);
} elseif ($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getFieldDataType() == 'picklist') {?><span <?php if (!empty($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY_VALUE']->value)) {?> class="picklist-color picklist-<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getId();?>
-<?php echo Vtiger_Util_Helper::convertSpaceToHyphen($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getRaw($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value));?>
" <?php }?>> <?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY_VALUE']->value;?>
 </span><?php } elseif ($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getFieldDataType() == 'multipicklist') {
$_smarty_tpl->_assignInScope('MULTI_RAW_PICKLIST_VALUES', explode('|##|',$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getRaw($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value)));
$_smarty_tpl->_assignInScope('MULTI_PICKLIST_VALUES', explode(',',$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY_VALUE']->value));
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MULTI_RAW_PICKLIST_VALUES']->value, 'MULTI_PICKLIST_VALUE', false, 'MULTI_PICKLIST_INDEX');
$_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['MULTI_PICKLIST_INDEX']->value => $_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUE']->value) {
$_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUE']->do_else = false;
?><span <?php if (!empty($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY_VALUE']->value)) {?> class="picklist-color picklist-<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getId();?>
-<?php echo Vtiger_Util_Helper::convertSpaceToHyphen(trim($_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUE']->value));?>
" <?php }?>> <?php echo trim($_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUES']->value[$_smarty_tpl->tpl_vars['MULTI_PICKLIST_INDEX']->value]);?>
 </span><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
} else {
echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value);
}?></td><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></table></div><!--added this div for Temporarily --><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value == '0') {?><div class="row"><div class="emptyRecordsDiv"><?php if ($_smarty_tpl->tpl_vars['IS_MODULE_DISABLED']->value == 'true') {
echo vtranslate($_smarty_tpl->tpl_vars['RELATED_MODULE']->value,$_smarty_tpl->tpl_vars['RELATED_MODULE']->value);
echo vtranslate('LBL_MODULE_DISABLED',$_smarty_tpl->tpl_vars['RELATED_MODULE']->value);
} else {
echo vtranslate('LBL_NO',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['RELATED_MODULE']->value,$_smarty_tpl->tpl_vars['RELATED_MODULE']->value);?>
 <?php echo vtranslate('LBL_FOUND',$_smarty_tpl->tpl_vars['MODULE']->value);?>
.<?php }?></div></div><?php }
if ((isset($_smarty_tpl->tpl_vars['FIELDS_INFO']->value)) && $_smarty_tpl->tpl_vars['FIELDS_INFO']->value != null) {
echo '<script'; ?>
 type="text/javascript">var popup_uimeta = (function() {var fieldInfo  = <?php echo $_smarty_tpl->tpl_vars['FIELDS_INFO']->value;?>
;return {field: {get: function(name, property) {if(name && property === undefined) {return fieldInfo[name];}if(name && property) {return fieldInfo[name][property]}},isMandatory : function(name){if(fieldInfo[name]) {return fieldInfo[name].mandatory;}return false;},getType : function(name){if(fieldInfo[name]) {return fieldInfo[name].type}return false;}},};})();<?php echo '</script'; ?>
><?php }?></div></div></div>
<?php }
}
