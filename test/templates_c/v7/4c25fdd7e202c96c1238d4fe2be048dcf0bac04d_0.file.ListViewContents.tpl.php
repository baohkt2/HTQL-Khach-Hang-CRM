<?php
/* Smarty version 4.5.5, created on 2025-09-18 09:17:37
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Portal\ListViewContents.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68cbce318703e8_59463485',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4c25fdd7e202c96c1238d4fe2be048dcf0bac04d' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Portal\\ListViewContents.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:modules/Portal/ListViewActions.tpl' => 1,
  ),
),false)) {
function content_68cbce318703e8_59463485 (Smarty_Internal_Template $_smarty_tpl) {
?>
<input type="hidden" id="pageNumber" value="<?php echo $_smarty_tpl->tpl_vars['CURRENT_PAGE']->value;?>
"><input type="hidden" id="totalCount" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_INFO']->value['recordCount'];?>
" /><input type="hidden" id="recordsCount" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_INFO']->value['recordCount'];?>
"/><input type="hidden" id="selectedIds" name="selectedIds" /><input type="hidden" id="excludedIds" name="excludedIds" /><input type="hidden" id="alphabetValue" value="<?php echo $_smarty_tpl->tpl_vars['ALPHABET_VALUE']->value;?>
" /><input type="hidden" id="pageStartRange" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_INFO']->value['startSequence'];?>
" /><input type="hidden" id="pageEndRange" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_INFO']->value['endSequence'];?>
" /><input type="hidden" id="previousPageExist" <?php if ($_smarty_tpl->tpl_vars['CURRENT_PAGE']->value != 1) {?>value="1"<?php }?> /><input type="hidden" id="nextPageExist" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_INFO']->value['nextPageExists'];?>
" /><input type="hidden" id="pageLimit" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_INFO']->value['pageLimit'];?>
" /><input type="hidden" id="noOfEntries" value="<?php echo $_smarty_tpl->tpl_vars['NO_OF_ENTRIES']->value;?>
" /><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['COLUMN_NAME']->value;?>
" name="orderBy"><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['SORT_ORDER']->value;?>
" name="sortOrder"><?php $_smarty_tpl->_subTemplateRender("file:modules/Portal/ListViewActions.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?><div id="selectAllMsgDiv" class="hide" style = "background:gold;height:20px"><center><a href="#"><?php echo vtranslate('LBL_SELECT_ALL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;(<span id="totalRecordsCount" value=""></span>)</a></center></div><div id="deSelectAllMsgDiv" class="hide" style = "background:gold;height:20px"><center><a href="#"><?php echo vtranslate('LBL_DESELECT_ALL_RECORDS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></center></div><div class="contents-topscroll noprint"><div class="topscroll-div">&nbsp;</div></div><div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 listViewContentDiv" id="listViewContents"><div id="table-content" class="table-container"><?php $_smarty_tpl->_assignInScope('WIDTHTYPE', $_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('rowheight'));?><table id="listview-table" class="table listview-table portal-table"><thead><tr class="listViewContentHeader"><th><div class="table-actions" style="margin-left:0px !important;"><span class="input"><input class="listViewEntriesMainCheckBox" type="checkbox"></span></div></th><th><a href="#" class="listViewContentHeaderValues" data-nextsortorderval="<?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value == 'portalname') {
echo $_smarty_tpl->tpl_vars['NEXT_SORT_ORDER']->value;
} else { ?>ASC<?php }?>" data-columnname="portalname"><?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value == 'portalname') {?><i class="fa fa-sort <?php echo $_smarty_tpl->tpl_vars['FASORT_IMAGE']->value;?>
"></i><?php } else { ?><i class="fa fa-sort customsort"></i><?php }?>&nbsp;<?php echo vtranslate('LBL_BOOKMARK_NAME',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;</a><?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value == 'portalname') {?><a href="#" class="removeSorting"><i class="fa fa-remove"></i></a><?php }?></th><th><a href="#" class="listViewContentHeaderValues" data-nextsortorderval="<?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value == 'portalurl') {
echo $_smarty_tpl->tpl_vars['NEXT_SORT_ORDER']->value;
} else { ?>ASC<?php }?>" data-columnname="portalurl"><?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value == 'portalurl') {?><i class="fa fa-sort <?php echo $_smarty_tpl->tpl_vars['FASORT_IMAGE']->value;?>
"></i><?php } else { ?><i class="fa fa-sort customsort"></i><?php }?>&nbsp;<?php echo vtranslate('LBL_BOOKMARK_URL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;</a><?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value == 'portalurl') {?><a href="#" class="removeSorting"><i class="fa fa-remove"></i></a><?php }?></th><th><a href="#" class="listViewContentHeaderValues" data-nextsortorderval="<?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value == 'createdtime') {
echo $_smarty_tpl->tpl_vars['NEXT_SORT_ORDER']->value;
} else { ?>ASC<?php }?>" data-columnname="createdtime"><?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value == 'createdtime') {?><i class="fa fa-sort <?php echo $_smarty_tpl->tpl_vars['FASORT_IMAGE']->value;?>
"></i><?php } else { ?><i class="fa fa-sort customsort"></i><?php }?>&nbsp;<?php echo vtranslate('LBL_CREATED_ON',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;</a><?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value == 'createdtime') {?><a href="#" class="removeSorting"><i class="fa fa-remove"></i></a><?php }?></th></tr></thead><tbody class="overflow-y"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES']->value, 'LISTVIEW_ENTRY', false, 'RECORD_ID');
$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['RECORD_ID']->value => $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value) {
$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->do_else = false;
?><tr class="listViewEntries" data-id="<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
" data-recordurl="index.php?module=Portal&view=Detail&record=<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
"><td class="listViewRecordActions"><div class="table-actions"><span class="input" ><input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getId();?>
" class="listViewEntriesCheckBox"/></span><span class="more dropdown action"><span href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-v icon"></i></span><ul class="dropdown-menu" style="top:auto;bottom:30%;" data-id="<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
"><li><a href="javascript:void(0);" class="editPortalRecord" ><?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li><li><a href="javascript:void(0);" class="deleteRecordButton"><?php echo vtranslate('LBL_DELETE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li></ul></span></div></td><td class="listViewEntryValue <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" nowrap><a href="index.php?module=Portal&view=Detail&record=<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
" sl-processed="1"><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('portalname');?>
</a></td><td class="listViewEntryValue <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" nowrap><a class="urlField cursorPointer" href="<?php if (substr($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('portalurl'),0,4) != 'http') {?>//<?php }
echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('portalurl');?>
" target="_blank" sl-processed="1"><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('portalurl');?>
</a></td><td class="listViewEntryValue <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" nowrap><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('createdtime');?>
</td></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
if ($_smarty_tpl->tpl_vars['PAGING_INFO']->value['recordCount'] == '0') {?><tr class="emptyRecordsDiv"><?php $_smarty_tpl->_assignInScope('COLSPAN_WIDTH', 1);
if ((isset($_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value))) {
$_smarty_tpl->_assignInScope('COLSPAN_WIDTH', php7_count($_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value)+1);
}?><td colspan="<?php echo $_smarty_tpl->tpl_vars['COLSPAN_WIDTH']->value;?>
"><div class="emptyRecordsContent"><?php $_smarty_tpl->_assignInScope('SINGLE_MODULE', "SINGLE_".((string)$_smarty_tpl->tpl_vars['MODULE']->value));
echo vtranslate('LBL_NO');?>
 <?php echo vtranslate('LBL_BOOKMARKS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate('LBL_FOUND');?>
. <?php echo vtranslate('LBL_CREATE');?>
&nbsp;<a class="addBookmark" style="color:blue;"><?php echo vtranslate('LBL_BOOKMARK',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div></td></tr><?php }?></tbody></table></div></div>
<?php }
}
