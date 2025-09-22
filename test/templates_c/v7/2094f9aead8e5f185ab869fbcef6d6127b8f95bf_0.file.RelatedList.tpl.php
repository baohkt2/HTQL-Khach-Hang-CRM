<?php
/* Smarty version 4.5.5, created on 2025-09-18 08:47:05
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Campaigns\RelatedList.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68cbc7092a89f5_07318531',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2094f9aead8e5f185ab869fbcef6d6127b8f95bf' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Campaigns\\RelatedList.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68cbc7092a89f5_07318531 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
if (!empty($_smarty_tpl->tpl_vars['CUSTOM_VIEWS']->value)) {
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "PicklistColorMap.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('LISTVIEW_HEADERS'=>$_smarty_tpl->tpl_vars['RELATED_HEADERS']->value), 0, true);
?><div class="relatedContainer"><?php $_smarty_tpl->_assignInScope('RELATED_MODULE_NAME', $_smarty_tpl->tpl_vars['RELATED_MODULE']->value->get('name'));
ob_start();
if ($_smarty_tpl->tpl_vars['RELATION_FIELD']->value) {
echo (string)$_smarty_tpl->tpl_vars['RELATION_FIELD']->value->isActiveField();
} else {
echo "false";
}
$_prefixVariable1=ob_get_clean();
$_smarty_tpl->_assignInScope('IS_RELATION_FIELD_ACTIVE', $_prefixVariable1);?><input type="hidden" name="emailEnabledModules" value=true /><input type="hidden" id="view" value="<?php echo $_smarty_tpl->tpl_vars['VIEW']->value;?>
" /><input type="hidden" name="currentPageNum" value="<?php echo $_smarty_tpl->tpl_vars['PAGING']->value->getCurrentPage();?>
" /><input type="hidden" name="relatedModuleName" class="relatedModuleName" value="<?php echo $_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value;?>
" /><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['ORDER_BY']->value;?>
" id="orderBy"><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['SORT_ORDER']->value;?>
" id="sortOrder"><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['RELATED_ENTIRES_COUNT']->value;?>
" id="noOfEntries"><input type='hidden' value="<?php echo $_smarty_tpl->tpl_vars['PAGING']->value->getPageLimit();?>
" id='pageLimit'><input type='hidden' value="<?php echo $_smarty_tpl->tpl_vars['PAGING']->value->get('page');?>
" id='pageNumber'><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['PAGING']->value->isNextPageExists();?>
" id="nextPageExist"/><input type="hidden" id="selectedIds" name="selectedIds" data-selected-ids=<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['SELECTED_IDS']->value);?>
 /><input type="hidden" id="excludedIds" name="excludedIds" data-excluded-ids=<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['EXCLUDED_IDS']->value);?>
 /><input type="hidden" id="recordsCount" name="recordsCount" /><input type='hidden' value="<?php echo $_smarty_tpl->tpl_vars['TOTAL_ENTRIES']->value;?>
" id='totalCount'><input type='hidden' value="<?php echo $_smarty_tpl->tpl_vars['TAB_LABEL']->value;?>
" id='tab_label' name='tab_label'><input type='hidden' value="<?php echo $_smarty_tpl->tpl_vars['IS_RELATION_FIELD_ACTIVE']->value;?>
" id='isRelationFieldActive'><div class="relatedHeader"><div class="btn-toolbar row"><div class="col-lg-5 col-md-5 col-sm-5 btn-toolbar"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RELATED_LIST_LINKS']->value['LISTVIEWBASIC'], 'RELATED_LINK');
$_smarty_tpl->tpl_vars['RELATED_LINK']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['RELATED_LINK']->value) {
$_smarty_tpl->tpl_vars['RELATED_LINK']->do_else = false;
?><div class="btn-group"><?php $_smarty_tpl->_assignInScope('DROPDOWNS', $_smarty_tpl->tpl_vars['RELATED_LINK']->value->get('linkdropdowns'));
if (php7_count($_smarty_tpl->tpl_vars['DROPDOWNS']->value) > 0) {?><div class="btn-group"><a class="btn dropdown-toggle" href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200" data-close-others="false" style="width:20px;height:18px;"><img title="<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getLabel();?>
" alt="<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getLabel();?>
" src="<?php echo vimage_path(((string)$_smarty_tpl->tpl_vars['RELATED_LINK']->value->getIcon()));?>
"></a><ul class="dropdown-menu"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['DROPDOWNS']->value, 'DROPDOWN');
$_smarty_tpl->tpl_vars['DROPDOWN']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['DROPDOWN']->value) {
$_smarty_tpl->tpl_vars['DROPDOWN']->do_else = false;
?><li><a id="<?php echo $_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value;?>
_relatedlistView_add_<?php echo Vtiger_Util_Helper::replaceSpaceWithUnderScores($_smarty_tpl->tpl_vars['DROPDOWN']->value['label']);?>
" class="<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->get('linkclass');?>
" href='javascript:void(0)' data-documentType="<?php echo $_smarty_tpl->tpl_vars['DROPDOWN']->value['type'];?>
" data-url="<?php echo $_smarty_tpl->tpl_vars['DROPDOWN']->value['url'];?>
" data-name="<?php echo $_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value;?>
" data-firsttime="<?php echo $_smarty_tpl->tpl_vars['DROPDOWN']->value['firsttime'];?>
"><i class="icon-plus"></i>&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['DROPDOWN']->value['label'],$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);?>
</a></li><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></ul></div><?php } else {
ob_start();
echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->get('_sendEmail');
$_prefixVariable2 = ob_get_clean();
$_smarty_tpl->_assignInScope('IS_SEND_EMAIL_BUTTON', $_prefixVariable2);
ob_start();
echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->get('_selectRelation');
$_prefixVariable3 = ob_get_clean();
$_smarty_tpl->_assignInScope('IS_SELECT_BUTTON', $_prefixVariable3);?><button type="button" module="<?php echo $_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value;?>
"  class="btn addButton btn-default<?php if ($_smarty_tpl->tpl_vars['IS_SELECT_BUTTON']->value == true) {?> selectRelation <?php }?> <?php if ($_smarty_tpl->tpl_vars['IS_SEND_EMAIL_BUTTON']->value == true) {?> sendEmail <?php }?>"<?php if ($_smarty_tpl->tpl_vars['IS_SELECT_BUTTON']->value == true) {?> data-moduleName="<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->get('_module')->get('name');?>
"<?php }
if (($_smarty_tpl->tpl_vars['RELATED_LINK']->value->isPageLoadLink())) {
if ($_smarty_tpl->tpl_vars['RELATION_FIELD']->value) {?> data-name="<?php echo $_smarty_tpl->tpl_vars['RELATION_FIELD']->value->getName();?>
" <?php }
if ($_smarty_tpl->tpl_vars['IS_SEND_EMAIL_BUTTON']->value != true) {?>data-url="<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getUrl();?>
"<?php }
} elseif ($_smarty_tpl->tpl_vars['IS_SEND_EMAIL_BUTTON']->value == true) {?>onclick="<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getUrl();?>
"<?php }
if (($_smarty_tpl->tpl_vars['IS_SELECT_BUTTON']->value != true) && ($_smarty_tpl->tpl_vars['IS_SEND_EMAIL_BUTTON']->value != true)) {?>name="addButton"<?php }
if ($_smarty_tpl->tpl_vars['IS_SEND_EMAIL_BUTTON']->value == true) {?> disabled="disabled" <?php }?>><?php if (($_smarty_tpl->tpl_vars['IS_SELECT_BUTTON']->value != true) && ($_smarty_tpl->tpl_vars['IS_SEND_EMAIL_BUTTON']->value != true)) {?><i class="fa fa-plus"></i><?php }?>&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getLabel();?>
</button><?php }?></div><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>&nbsp;</div><div class='col-lg-4 col-md-4 col-sm-4'><span class="customFilterMainSpan"><?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['CUSTOM_VIEWS']->value) > 0) {?><select id="recordsFilter" class="select2 col-lg-8" data-placeholder="<?php echo vtranslate('LBL_SELECT_TO_LOAD_LIST',$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);?>
"><option></option><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['CUSTOM_VIEWS']->value, 'GROUP_CUSTOM_VIEWS', false, 'GROUP_LABEL');
$_smarty_tpl->tpl_vars['GROUP_CUSTOM_VIEWS']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['GROUP_LABEL']->value => $_smarty_tpl->tpl_vars['GROUP_CUSTOM_VIEWS']->value) {
$_smarty_tpl->tpl_vars['GROUP_CUSTOM_VIEWS']->do_else = false;
?><optgroup label=' <?php if ($_smarty_tpl->tpl_vars['GROUP_LABEL']->value == 'Mine') {?> &nbsp; <?php } else { ?> <?php echo vtranslate($_smarty_tpl->tpl_vars['GROUP_LABEL']->value,$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);?>
 <?php }?>' ><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['GROUP_CUSTOM_VIEWS']->value, 'CUSTOM_VIEW');
$_smarty_tpl->tpl_vars['CUSTOM_VIEW']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value) {
$_smarty_tpl->tpl_vars['CUSTOM_VIEW']->do_else = false;
?><option id="filterOptionId_<?php echo $_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->get('cvid');?>
" value="<?php echo $_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->get('cvid');?>
" class="filterOptionId_<?php echo $_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->get('cvid');?>
" data-id="<?php echo $_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->get('cvid');?>
"><?php if ($_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->get('viewname') == 'All') {
echo vtranslate($_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->get('viewname'),$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);
} else {
echo vtranslate($_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->get('viewname'),$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);
}
if ($_smarty_tpl->tpl_vars['GROUP_LABEL']->value != 'Mine') {?> [ <?php echo $_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->getOwnerName();?>
 ] <?php }?></option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></optgroup><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select><?php } else { ?><input type="hidden" value="0" id="customFilter" /><?php }?></span></div><?php $_smarty_tpl->_assignInScope('CLASS_VIEW_ACTION', 'relatedViewActions');
$_smarty_tpl->_assignInScope('CLASS_VIEW_PAGING_INPUT', 'relatedViewPagingInput');
$_smarty_tpl->_assignInScope('CLASS_VIEW_PAGING_INPUT_SUBMIT', 'relatedViewPagingInputSubmit');
$_smarty_tpl->_assignInScope('CLASS_VIEW_BASIC_ACTION', 'relatedViewBasicAction');
$_smarty_tpl->_assignInScope('PAGING_MODEL', $_smarty_tpl->tpl_vars['PAGING']->value);
$_smarty_tpl->_assignInScope('RECORD_COUNT', smarty_modifier_count($_smarty_tpl->tpl_vars['RELATED_RECORDS']->value));
$_smarty_tpl->_assignInScope('PAGE_NUMBER', $_smarty_tpl->tpl_vars['PAGING']->value->get('page'));
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "Pagination.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('SHOWPAGEJUMP'=>true), 0, true);
?></div></div><div class='col-lg-12 col-md-12 col-sm-12'><?php $_smarty_tpl->_assignInScope('RELATED_MODULE_NAME', $_smarty_tpl->tpl_vars['RELATED_MODULE']->value->get('name'));?><div class="hide messageContainer" style = "height:30px;"><center><a id="selectAllMsgDiv" href="#"><?php echo vtranslate('LBL_SELECT_ALL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);?>
&nbsp;(<span id="totalRecordsCount" value=""></span>)</a></center></div><div class="hide messageContainer" style = "height:30px;"><center><a id="deSelectAllMsgDiv" href="#"><?php echo vtranslate('LBL_DESELECT_ALL_RECORDS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></center></div></div><div class="relatedContents col-lg-12 col-md-12 col-sm-12 table-container"><div class="bottomscroll-div"><?php $_smarty_tpl->_assignInScope('WIDTHTYPE', $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('rowheight'));?><table id="listview-table" class="table listview-table"><thead><tr class="listViewHeaders"><th width="4%" style="padding-left: 12px;"><input type="checkbox" id="listViewEntriesMainCheckBox"/></th><th style="min-width:100px"></th><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RELATED_HEADERS']->value, 'HEADER_FIELD');
$_smarty_tpl->tpl_vars['HEADER_FIELD']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['HEADER_FIELD']->value) {
$_smarty_tpl->tpl_vars['HEADER_FIELD']->do_else = false;
?><th class="nowrap"><a href="javascript:void(0);" class="listViewContentHeaderValues" data-nextsortorderval="<?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value == $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column')) {
echo $_smarty_tpl->tpl_vars['NEXT_SORT_ORDER']->value;
} else { ?>ASC<?php }?>" data-fieldname="<?php echo $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column');?>
"><?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value == $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column')) {?><i class="fa fa-sort <?php echo $_smarty_tpl->tpl_vars['FASORT_IMAGE']->value;?>
"></i><?php } else { ?><i class="fa fa-sort customsort"></i><?php }?>&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('label'),$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);?>
&nbsp;<?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value == $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column')) {?><img class="<?php echo $_smarty_tpl->tpl_vars['SORT_IMAGE']->value;?>
"><?php }?>&nbsp;</a><?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value == $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column')) {?><a href="#" class="removeSorting"><i class="fa fa-remove"></i></a><?php }?></th><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?><th class="nowrap"><a href="javascript:void(0);" class="listViewContentHeaderValues noSorting"><?php echo vtranslate('Status',$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);?>
</a></th></tr><tr class="searchRow"><th></th><th class="inline-search-btn"><button class="btn btn-success btn-sm" data-trigger="relatedListSearch"><?php echo vtranslate("LBL_SEARCH",$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button></th><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RELATED_HEADERS']->value, 'HEADER_FIELD');
$_smarty_tpl->tpl_vars['HEADER_FIELD']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['HEADER_FIELD']->value) {
$_smarty_tpl->tpl_vars['HEADER_FIELD']->do_else = false;
?><th><?php if ($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column') == 'time_start' || $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column') == 'time_end' || $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getFieldDataType() == 'reference') {
} else {
$_smarty_tpl->_assignInScope('FIELD_UI_TYPE_MODEL', $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getUITypeModel());
$_smarty_tpl->_assignInScope('FIELD_SEARCH_INFO', array("searchValue"=>'',"comparator"=>''));
if ((isset($_smarty_tpl->tpl_vars['SEARCH_DETAILS']->value[$_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getName()]))) {
$_smarty_tpl->_assignInScope('FIELD_SEARCH_INFO', $_smarty_tpl->tpl_vars['SEARCH_DETAILS']->value[$_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getName()]);
}
$_smarty_tpl->_subTemplateRender(vtemplate_path($_smarty_tpl->tpl_vars['FIELD_UI_TYPE_MODEL']->value->getListSearchTemplateName(),$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('FIELD_MODEL'=>$_smarty_tpl->tpl_vars['HEADER_FIELD']->value,'SEARCH_INFO'=>$_smarty_tpl->tpl_vars['FIELD_SEARCH_INFO']->value,'USER_MODEL'=>$_smarty_tpl->tpl_vars['USER_MODEL']->value), 0, true);
?><input type="hidden" class="operatorValue" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_SEARCH_INFO']->value['comparator'];?>
"><?php }?></th><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?><th></th></tr></thead><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RELATED_RECORDS']->value, 'RELATED_RECORD');
$_smarty_tpl->tpl_vars['RELATED_RECORD']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['RELATED_RECORD']->value) {
$_smarty_tpl->tpl_vars['RELATED_RECORD']->do_else = false;
?><tr class="listViewEntries" data-id='<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getId();?>
' data-recordUrl='<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDetailViewUrl();?>
'><td width="4%" class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getId();?>
" class="listViewEntriesCheckBox"/></td><td style="width:100px"><span class="actionImages"><a name="relationEdit" data-url="<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getEditViewUrl();?>
" href="javascript:void(0)"><i title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="fa fa-pencil"></i></a> &nbsp;&nbsp;<?php if ($_smarty_tpl->tpl_vars['IS_DELETABLE']->value) {?><a class="relationDelete"><i title="<?php echo vtranslate('LBL_UNLINK',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="vicon-linkopen"></i></a><?php }?></span></td><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RELATED_HEADERS']->value, 'HEADER_FIELD');
$_smarty_tpl->tpl_vars['HEADER_FIELD']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['HEADER_FIELD']->value) {
$_smarty_tpl->tpl_vars['HEADER_FIELD']->do_else = false;
$_smarty_tpl->_assignInScope('RELATED_HEADERNAME', $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('name'));
$_smarty_tpl->_assignInScope('RELATED_LIST_VALUE', $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value));?><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
 relatedListEntryValues" data-field-type="<?php echo $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getFieldDataType();?>
" nowrap><span class="value textOverflowEllipsis"><?php if ($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->isNameField() == true || $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('uitype') == '4') {?><a href="<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDetailViewUrl();?>
"><?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDisplayValue($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value);?>
</a><?php } elseif ($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('uitype') == '71' || $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('uitype') == '72') {
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
} elseif ($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getFieldDataType() == 'picklist') {?><span <?php if (!empty($_smarty_tpl->tpl_vars['RELATED_LIST_VALUE']->value)) {?> class="picklist-color picklist-<?php echo $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getId();?>
-<?php echo Vtiger_Util_Helper::convertSpaceToHyphen($_smarty_tpl->tpl_vars['RELATED_LIST_VALUE']->value);?>
" <?php }?>> <?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDisplayValue($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value);?>
 </span><?php } else {
echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDisplayValue($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value);
}?></span></td><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" nowrap><span class="currentStatus more dropdown action"><span class="statusValue dropdown-toggle" data-toggle="dropdown"><?php echo vtranslate($_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get('status'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;</span><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="fa fa-arrow-down alignMiddle editRelatedStatus"></i></a><ul class="dropdown-menu dropdown-menu-right"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['STATUS_VALUES']->value, 'STATUS', false, 'STATUS_ID');
$_smarty_tpl->tpl_vars['STATUS']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['STATUS_ID']->value => $_smarty_tpl->tpl_vars['STATUS']->value) {
$_smarty_tpl->tpl_vars['STATUS']->do_else = false;
?><li id="<?php echo $_smarty_tpl->tpl_vars['STATUS_ID']->value;?>
" data-status="<?php echo vtranslate($_smarty_tpl->tpl_vars['STATUS']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><a><?php echo vtranslate($_smarty_tpl->tpl_vars['STATUS']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></ul></span></td></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></table></div></div></div><?php echo '<script'; ?>
 type="text/javascript">var related_uimeta = (function () {var fieldInfo = <?php echo $_smarty_tpl->tpl_vars['RELATED_FIELDS_INFO']->value;?>
;return {field: {get: function (name, property) {if (name && property === undefined) {return fieldInfo[name];}if (name && property) {return fieldInfo[name][property]}},isMandatory: function (name) {if (fieldInfo[name]) {return fieldInfo[name].mandatory;}return false;},getType: function (name) {if (fieldInfo[name]) {return fieldInfo[name].type}return false;}},};})();<?php echo '</script'; ?>
><?php } else {
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( 'RelatedList.tpl' )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
}
}
