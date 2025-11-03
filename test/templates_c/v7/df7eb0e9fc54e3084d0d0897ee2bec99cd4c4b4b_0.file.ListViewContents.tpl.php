<?php
/* Smarty version 4.5.5, created on 2025-11-02 07:42:43
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Users\ListViewContents.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_69070b730e6593_40790157',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'df7eb0e9fc54e3084d0d0897ee2bec99cd4c4b4b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Users\\ListViewContents.tpl',
      1 => 1761802269,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69070b730e6593_40790157 (Smarty_Internal_Template $_smarty_tpl) {
?>
<input type="hidden" id="listViewEntriesCount" value="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value;?>
" /><input type="hidden" id="pageStartRange" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->getRecordStartRange();?>
" /><input type="hidden" id="pageEndRange" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->getRecordEndRange();?>
" /><input type="hidden" id="previousPageExist" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->isPrevPageExists();?>
" /><input type="hidden" id="nextPageExist" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->isNextPageExists();?>
" /><input type="hidden" id="pageNumberValue" value= "<?php echo $_smarty_tpl->tpl_vars['PAGE_NUMBER']->value;?>
"/><input type="hidden" id="pageLimitValue" value= "<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->getPageLimit();?>
" /><input type="hidden" id="numberOfEntries" value= "<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value;?>
" /><input type="hidden" id="alphabetSearchKey" value= "<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getAlphabetSearchField();?>
" /><input type="hidden" id="Operator" value="<?php echo $_smarty_tpl->tpl_vars['OPERATOR']->value;?>
" /><input type="hidden" id="alphabetValue" value="<?php echo (isset($_smarty_tpl->tpl_vars['ALPHABET_VALUE']->value)) ? $_smarty_tpl->tpl_vars['ALPHABET_VALUE']->value : '';?>
" /><input type="hidden" id="totalCount" value="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_COUNT']->value;?>
" /><input type="hidden" name="orderBy" value="<?php echo $_smarty_tpl->tpl_vars['ORDER_BY']->value;?>
" id="orderBy"><input type="hidden" name="sortOrder" value="<?php echo $_smarty_tpl->tpl_vars['SORT_ORDER']->value;?>
" id="sortOrder"><input type='hidden' value="<?php echo $_smarty_tpl->tpl_vars['PAGE_NUMBER']->value;?>
" id='pageNumber'><input type='hidden' value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->getPageLimit();?>
" id='pageLimit'><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value;?>
" id="noOfEntries"><input type="hidden" value="<?php echo (isset($_smarty_tpl->tpl_vars['NO_SEARCH_PARAMS_CACHE']->value)) ? $_smarty_tpl->tpl_vars['NO_SEARCH_PARAMS_CACHE']->value : '';?>
" id="noFilterCache" ><div id="table-content" class="table-container"><form name='list' id='listedit' action='' onsubmit="return false;"><table id="listview-table" class="table <?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value == '0') {?>listview-table-norecords <?php }?> listview-table"><thead><tr class="listViewContentHeader"><th><?php echo vtranslate('LBL_ACTIONS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value, 'LISTVIEW_HEADER');
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value) {
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = false;
if ($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getName() != 'last_name' && $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getName() != 'email1' && $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getName() != 'status') {
if ($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getName() == 'first_name') {
$_smarty_tpl->_assignInScope('HEADER_LABEL', 'LBL_NAME_EMAIL');
} else {
$_smarty_tpl->_assignInScope('HEADER_LABEL', $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('label'));
}?><th <?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value == $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name')) {?> nowrap="nowrap" <?php }?> ><a href="#" class="listViewContentHeaderValues" data-nextsortorderval="<?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value == $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name')) {
echo $_smarty_tpl->tpl_vars['NEXT_SORT_ORDER']->value;
} else { ?>ASC<?php }?>" data-columnname="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name');?>
"><?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value == $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name')) {?><i class="fa fa-sort <?php echo $_smarty_tpl->tpl_vars['FASORT_IMAGE']->value;?>
"></i><?php } else { ?><i class="fa fa-sort customsort"></i><?php }?>&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['HEADER_LABEL']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;</a><?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value == $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name')) {?><a href="#" class="removeSorting"><i class="fa fa-remove"></i></a><?php }?></th><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tr></thead><tbody class="overflow-y"><?php if ($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->isQuickSearchEnabled() && !$_smarty_tpl->tpl_vars['SEARCH_MODE_RESULTS']->value) {?><tr class="searchRow listViewSearchContainer"><th class="user-inline-search-btn"><div class="table-actions"><?php $_smarty_tpl->_assignInScope('HIDE_CLEAR_SEARCH', false);
if (php7_count($_smarty_tpl->tpl_vars['SEARCH_DETAILS']->value) == 0 || (is_array($_smarty_tpl->tpl_vars['SEARCH_DETAILS']->value[0]) && php7_count($_smarty_tpl->tpl_vars['SEARCH_DETAILS']->value[0]) == 0 && php7_count($_smarty_tpl->tpl_vars['SEARCH_DETAILS']->value) == 1)) {
$_smarty_tpl->_assignInScope('HIDE_CLEAR_SEARCH', true);
}?><button class="btn btn-sm btn-success <?php if (!$_smarty_tpl->tpl_vars['HIDE_CLEAR_SEARCH']->value) {?>hide<?php }?>" data-trigger="listSearch"><i class="fa fa-search"></i> &nbsp;<span class="s2-btn-text"><?php echo vtranslate("LBL_SEARCH",$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span></button><button class="searchAndClearButton btn btn-danger btn-sm <?php if ($_smarty_tpl->tpl_vars['HIDE_CLEAR_SEARCH']->value) {?>hide<?php }?>" data-trigger="clearListSearch"><i class="fa fa-close"></i>&nbsp;<?php echo vtranslate("LBL_CLEAR",$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button></div></th><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value, 'LISTVIEW_HEADER');
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value) {
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = false;
if ($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getName() == 'last_name' || $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getName() == 'email1' || $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getName() == 'status') {
continue 1;
}?><th><?php $_smarty_tpl->_assignInScope('FIELD_UI_TYPE_MODEL', $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getUITypeModel());
$_smarty_tpl->_assignInScope('FIELD_SEARCH_INFO', array("searchValue"=>'',"comparator"=>''));
if ((isset($_smarty_tpl->tpl_vars['SEARCH_DETAILS']->value[$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getName()]))) {
$_smarty_tpl->_assignInScope('FIELD_SEARCH_INFO', $_smarty_tpl->tpl_vars['SEARCH_DETAILS']->value[$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getName()]);
}
$_smarty_tpl->_subTemplateRender(vtemplate_path($_smarty_tpl->tpl_vars['FIELD_UI_TYPE_MODEL']->value->getListSearchTemplateName(),$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('FIELD_MODEL'=>$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value,'SEARCH_INFO'=>$_smarty_tpl->tpl_vars['FIELD_SEARCH_INFO']->value,'USER_MODEL'=>$_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value), 0, true);
?><input type="hidden" class="operatorValue" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_SEARCH_INFO']->value['comparator'];?>
"></th><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tr><?php }
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES']->value, 'LISTVIEW_ENTRY', false, NULL, 'listview', array (
  'index' => true,
));
$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value) {
$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_listview']->value['index']++;
?><tr class="listViewEntries" data-id='<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getId();?>
' data-recordUrl='<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getDetailViewUrl();?>
&parentblock=LBL_USER_MANAGEMENT' id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_listView_row_<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_listview']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_listview']->value['index'] : null)+1;?>
"><td class="listViewRecordActions"><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ListViewRecordActions.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></td><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value, 'LISTVIEW_HEADER');
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value) {
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = false;
$_smarty_tpl->_assignInScope('LISTVIEW_HEADERNAME', $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name'));
$_smarty_tpl->_assignInScope('LISTVIEW_ENTRY_RAWVALUE', $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getRaw($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('column')));
$_smarty_tpl->_assignInScope('LISTVIEW_ENTRY_VALUE', $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value));
if ($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getName() == 'first_name') {?><td data-name="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name');?>
" data-rawvalue="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY_RAWVALUE']->value;?>
" data-type="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getFieldDataType();?>
"><span class="fieldValue show"><span class="value show textOverflowEllipsis"><div><?php $_smarty_tpl->_assignInScope('IMAGE_DETAILS', $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getImageDetails());
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['IMAGE_DETAILS']->value, 'IMAGE_INFO');
$_smarty_tpl->tpl_vars['IMAGE_INFO']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['IMAGE_INFO']->value) {
$_smarty_tpl->tpl_vars['IMAGE_INFO']->do_else = false;
if (!empty($_smarty_tpl->tpl_vars['IMAGE_INFO']->value['url'])) {?><div class='col-lg-2'><img height="25px" width="25px" src="<?php echo $_smarty_tpl->tpl_vars['IMAGE_INFO']->value['url'];?>
"></div><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
if ($_smarty_tpl->tpl_vars['IMAGE_DETAILS']->value[0]['id'] == null) {?><div class='col-lg-2'><i class="fa fa-user userDefaultIcon"></i></div><?php }?><div class="usersinfo col-lg-9 textOverflowEllipsis" title="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('last_name');?>
"><a href="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getDetailViewUrl();?>
"><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value);?>
 <?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('last_name');?>
</a></div><div class="usersinfo col-lg-9 textOverflowEllipsis"><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('email1');?>
</div></div></span></span></td><?php } elseif ($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getName() != 'last_name' && $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getName() != 'email1' && $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getName() != 'status') {?><td class="<?php echo (isset($_smarty_tpl->tpl_vars['WIDTHTYPE']->value)) ? $_smarty_tpl->tpl_vars['WIDTHTYPE']->value : '';?>
" nowrap><span class="fieldValue"><span class="value textOverflowEllipsis"><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value);?>
</span></span></td><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value == '0') {?><tr class="emptyRecordsDiv"><?php ob_start();
echo php7_count($_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value);
$_prefixVariable1 = ob_get_clean();
$_smarty_tpl->_assignInScope('COLSPAN_WIDTH', $_prefixVariable1);?><td colspan="<?php echo $_smarty_tpl->tpl_vars['COLSPAN_WIDTH']->value;?>
"><div class="emptyRecordsContent"><center><?php if ($_smarty_tpl->tpl_vars['SEARCH_VALUE']->value == 'Active') {
$_smarty_tpl->_assignInScope('SINGLE_MODULE', "SINGLE_".((string)$_smarty_tpl->tpl_vars['MODULE']->value));
echo vtranslate('LBL_NO');?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate('LBL_FOUND');?>
,<?php if ($_smarty_tpl->tpl_vars['IS_MODULE_EDITABLE']->value) {?> <a style="color:blue" href="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getCreateRecordUrl();?>
"> <?php echo vtranslate('LBL_CREATE_USER',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a><?php }
} else {
echo vtranslate('LBL_NO');?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate('LBL_FOUND');
}?></center></div></td></tr><?php }?></tbody></table></form></div><div id="scroller_wrapper" class="bottom-fixed-scroll"><div id="scroller" class="scroller-div"></div></div><?php }
}
