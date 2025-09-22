<?php
/* Smarty version 4.5.5, created on 2025-09-18 09:17:50
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\RecycleBin\ListViewContents.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68cbce3ef205d2_44324207',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '236266894e11e2ea83ff7c4cc86876e5225a7ca2' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\RecycleBin\\ListViewContents.tpl',
      1 => 1758006195,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68cbce3ef205d2_44324207 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "PicklistColorMap.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?><div class="col-sm-12 col-xs-12"><?php $_smarty_tpl->_assignInScope('LEFTPANELHIDE', $_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('leftpanelhide'));?><div class="essentials-toggle" title="<?php echo vtranslate('LBL_LEFT_PANEL_SHOW_HIDE','Vtiger');?>
"><span class="essentials-toggle-marker fa <?php if ($_smarty_tpl->tpl_vars['LEFTPANELHIDE']->value == '1') {?>fa-chevron-right<?php } else { ?>fa-chevron-left<?php }?> cursorPointer"></span></div><input type="hidden" id="pageStartRange" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->getRecordStartRange();?>
" /><input type="hidden" id="pageEndRange" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->getRecordEndRange();?>
" /><input type="hidden" id="previousPageExist" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->isPrevPageExists();?>
" /><input type="hidden" id="nextPageExist" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->isNextPageExists();?>
" /><input type="hidden" id="numberOfEntries" value= "<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value;?>
" /><input type="hidden" id="totalCount" value="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_COUNT']->value;?>
" /><input type="hidden" id="sourceModule" value="<?php echo $_smarty_tpl->tpl_vars['SOURCE_MODULE']->value;?>
" /><input type='hidden' id='pageNumber' value="<?php echo $_smarty_tpl->tpl_vars['PAGE_NUMBER']->value;?>
"><input type='hidden' id='pageLimit' value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->getPageLimit();?>
"><input type="hidden" id="noOfEntries" value="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value;?>
"><input type="hidden" id="isRecordsDeleted" value="<?php echo $_smarty_tpl->tpl_vars['IS_RECORDS_DELETED']->value;?>
"><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['ORDER_BY']->value;?>
" name="orderBy" id="orderBy"><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['SORT_ORDER']->value;?>
" name="sortOrder" id="sortOrder"><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value;?>
" id="recordsCount"><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ListViewActions.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?><div id="table-content" class="table-container"><form name='list' id='listedit' action='' onsubmit="return false;"><table id="listview-table" class="table <?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value == '0') {?>listview-table-norecords <?php } else { ?> listview-table<?php }?> "><thead><tr class="listViewContentHeader"><th><?php if (!$_smarty_tpl->tpl_vars['SEARCH_MODE_RESULTS']->value) {?><div class="table-actions"><span class="input"><input class="listViewEntriesMainCheckBox" type="checkbox"></span></div><?php } else {
echo vtranslate('LBL_ACTIONS',$_smarty_tpl->tpl_vars['MODULE']->value);
}?></th><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value, 'LISTVIEW_HEADER');
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value) {
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = false;
?><th><a href="#" class="listViewContentHeaderValues" data-nextsortorderval="<?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value == $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name')) {
echo $_smarty_tpl->tpl_vars['NEXT_SORT_ORDER']->value;
} else { ?>ASC<?php }?>" data-columnname="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name');?>
"><?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value == $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name')) {?><i class="fa fa-sort <?php echo $_smarty_tpl->tpl_vars['FASORT_IMAGE']->value;?>
"></i><?php } else { ?><i class="fa fa-sort customsort"></i><?php }?>&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;</a><?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value == $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name')) {?><a href="#" class="removeSorting"><i class="fa fa-remove"></i></a><?php }?></th><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tr><?php if ($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->isQuickSearchEnabled() && !$_smarty_tpl->tpl_vars['SEARCH_MODE_RESULTS']->value) {?><tr class="searchRow listViewSearchContainer"><th class="inline-search-btn"><div class="table-actions"><button class="btn btn-sm btn-success <?php if (php7_count($_smarty_tpl->tpl_vars['SEARCH_DETAILS']->value) > 0) {?>hide<?php }?>" data-trigger="listSearch"><i class="fa fa-search"></i>&nbsp;<span class="s2-btn-text"><?php echo vtranslate("LBL_SEARCH",$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span></button><button class="searchAndClearButton btn btn-sm btn-danger <?php if (php7_count($_smarty_tpl->tpl_vars['SEARCH_DETAILS']->value) == 0) {?>hide<?php }?>" data-trigger="clearListSearch"><i class="fa fa-close"></i>&nbsp;<?php echo vtranslate("LBL_CLEAR",$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button></div></th><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value, 'LISTVIEW_HEADER');
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value) {
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = false;
?><th><?php $_smarty_tpl->_assignInScope('FIELD_UI_TYPE_MODEL', $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getUITypeModel());
$_smarty_tpl->_assignInScope('FIELD_SEARCH_INFO', array("searchValue"=>'',"comparator"=>''));
if ((isset($_smarty_tpl->tpl_vars['SEARCH_DETAILS']->value[$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getName()]))) {
$_smarty_tpl->_assignInScope('FIELD_SEARCH_INFO', $_smarty_tpl->tpl_vars['SEARCH_DETAILS']->value[$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getName()]);
}
$_smarty_tpl->_subTemplateRender(vtemplate_path($_smarty_tpl->tpl_vars['FIELD_UI_TYPE_MODEL']->value->getListSearchTemplateName(),$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('FIELD_MODEL'=>$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value,'SEARCH_INFO'=>$_smarty_tpl->tpl_vars['FIELD_SEARCH_INFO']->value,'USER_MODEL'=>$_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value), 0, true);
?><input type="hidden" class="operatorValue" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_SEARCH_INFO']->value['comparator'];?>
"></th><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tr><?php }?><tbody class="overflow-y"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES']->value, 'LISTVIEW_ENTRY', false, NULL, 'listview', array (
  'index' => true,
));
$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value) {
$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_listview']->value['index']++;
?><tr class="listViewEntries" data-id='<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getId();?>
' id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_listView_row_<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_listview']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_listview']->value['index'] : null)+1;?>
"><td class = "listViewRecordActions"><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ListViewRecordActions.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></td><?php if ($_smarty_tpl->tpl_vars['SOURCE_MODULE']->value == 'Documents' && $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('document_source')) {?><input type="hidden" name="document_source_type" value="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('document_source');?>
"><?php }
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value, 'LISTVIEW_HEADER');
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value) {
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = false;
$_smarty_tpl->_assignInScope('LISTVIEW_HEADERNAME', $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name'));
$_smarty_tpl->_assignInScope('LISTVIEW_ENTRY_RAWVALUE', $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getRaw($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('column')));
$_smarty_tpl->_assignInScope('LISTVIEW_ENTRY_VALUE', $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value));?><td class="listViewEntryValue" data-name="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name');?>
" data-rawvalue="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY_RAWVALUE']->value;?>
" data-field-type="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getFieldDataType();?>
"><span class="fieldValue"><span class="value"><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('uitype') == '72') {
ob_start();
echo $_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('currency_symbol_placement');
$_prefixVariable1 = ob_get_clean();
$_smarty_tpl->_assignInScope('CURRENCY_SYMBOL_PLACEMENT', $_prefixVariable1);
if ($_smarty_tpl->tpl_vars['CURRENCY_SYMBOL_PLACEMENT']->value == '1.0$') {
echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY_VALUE']->value;
echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('currencySymbol');
} else {
echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('currencySymbol');
echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY_VALUE']->value;
}
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
echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY_VALUE']->value;
}?></span></span><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->isEditable() == 'true' && $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->isAjaxEditable() == 'true') {?><span class="hide edit"></span><?php }?></td><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value == '0') {?><tr class="emptyRecordsDiv"><?php ob_start();
echo php7_count($_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value);
$_prefixVariable2 = ob_get_clean();
$_smarty_tpl->_assignInScope('COLSPAN_WIDTH', $_prefixVariable2+1);?><td colspan="<?php echo $_smarty_tpl->tpl_vars['COLSPAN_WIDTH']->value;?>
"><div class="emptyRecordsContent" style="padding-top:15%;"><?php $_smarty_tpl->_assignInScope('SINGLE_MODULE', "SINGLE_".((string)$_smarty_tpl->tpl_vars['MODULE']->value));
echo vtranslate('LBL_NO_RECORDS_FOUND',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['SOURCE_MODULE']->value,$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
.<?php if ((isset($_smarty_tpl->tpl_vars['IS_MODULE_EDITABLE']->value)) && $_smarty_tpl->tpl_vars['IS_MODULE_EDITABLE']->value) {?><a style="color:blue" href="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getCreateRecordUrl();?>
"> <?php echo vtranslate('LBL_CREATE');?>
</a><?php if (Users_Privileges_Model::isPermitted($_smarty_tpl->tpl_vars['MODULE']->value,'Import') && $_smarty_tpl->tpl_vars['LIST_VIEW_MODEL']->value->isImportEnabled()) {
echo vtranslate('LBL_OR',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<a style="color:blue" href="#" onclick="return Vtiger_Import_Js.triggerImportAction()"><?php echo vtranslate('LBL_IMPORT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);
} else {
echo vtranslate($_smarty_tpl->tpl_vars['SINGLE_MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);
}
}?></div></td></tr><?php }?></tbody></thead></table></form></div><div id="scroller_wrapper" class="bottom-fixed-scroll"><div id="scroller" class="scroller-div"></div></div></div><?php }
}
