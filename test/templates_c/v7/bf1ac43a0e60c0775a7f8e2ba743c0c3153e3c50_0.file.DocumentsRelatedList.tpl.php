<?php
/* Smarty version 4.5.5, created on 2025-10-08 08:25:03
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Documents\DocumentsRelatedList.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e61fdf20bde6_50919566',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bf1ac43a0e60c0775a7f8e2ba743c0c3153e3c50' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Documents\\DocumentsRelatedList.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e61fdf20bde6_50919566 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\vtigercrm\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "PicklistColorMap.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('LISTVIEW_HEADERS'=>$_smarty_tpl->tpl_vars['RELATED_HEADERS']->value), 0, true);
?><div class="relatedContainer"><?php $_smarty_tpl->_assignInScope('RELATED_MODULE_NAME', $_smarty_tpl->tpl_vars['RELATED_MODULE']->value->get('name'));
ob_start();
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
" id='isRelationFieldActive'><div class="relatedHeader"><div class="btn-toolbar row"><div class="col-lg-6 col-md-6 col-sm-6 btn-toolbar"><div class="row"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RELATED_LIST_LINKS']->value['LISTVIEWBASIC'], 'RELATED_LINK');
$_smarty_tpl->tpl_vars['RELATED_LINK']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['RELATED_LINK']->value) {
$_smarty_tpl->tpl_vars['RELATED_LINK']->do_else = false;
if ($_smarty_tpl->tpl_vars['RELATED_LINK']->value->get('linkmodule') == 'Documents') {?><div class="col-sm-3" style="width:22%;"><?php ob_start();
echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->get('_selectRelation');
$_prefixVariable2 = ob_get_clean();
$_smarty_tpl->_assignInScope('IS_SELECT_BUTTON', $_prefixVariable2);
ob_start();
echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->get('linklabel');
$_prefixVariable3 = ob_get_clean();
$_smarty_tpl->_assignInScope('LINK_LABEL', $_prefixVariable3);
if ($_smarty_tpl->tpl_vars['RELATED_LINK']->value->get('_linklabel') === '_add_event') {
$_smarty_tpl->_assignInScope('RELATED_MODULE_NAME', 'Events');
} elseif ($_smarty_tpl->tpl_vars['RELATED_LINK']->value->get('_linklabel') === '_add_task') {
$_smarty_tpl->_assignInScope('RELATED_MODULE_NAME', 'Calendar');
}?><button type="button" module="<?php echo $_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value;?>
"  class="btn addButton btn-default<?php if ($_smarty_tpl->tpl_vars['IS_SELECT_BUTTON']->value == true) {?> selectRelation <?php }?> "<?php if ($_smarty_tpl->tpl_vars['IS_SELECT_BUTTON']->value == true) {?> data-moduleName=<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->get('_module')->get('name');?>
 <?php }
if (($_smarty_tpl->tpl_vars['RELATED_LINK']->value->isPageLoadLink())) {
if ($_smarty_tpl->tpl_vars['RELATION_FIELD']->value) {?> data-name="<?php echo $_smarty_tpl->tpl_vars['RELATION_FIELD']->value->getName();?>
" <?php }?>data-url="<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getUrl();?>
"<?php }
if ($_smarty_tpl->tpl_vars['IS_SELECT_BUTTON']->value != true) {?>name="addButton"<?php }?>><?php if ($_smarty_tpl->tpl_vars['IS_SELECT_BUTTON']->value == false) {?><i class="icon-plus icon-white"></i><?php }?>&nbsp;<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getLabel();?>
</button></div><?php }
if ($_smarty_tpl->tpl_vars['RELATED_LINK']->value->getLabel() == 'Vtiger') {
if ($_smarty_tpl->tpl_vars['IS_CREATE_PERMITTED']->value) {?><div class="col-sm-3"><div class="dropdown"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="fa fa-plus" title="<?php echo vtranslate('LBL_NEW_DOCUMENT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"></span>&nbsp;&nbsp;<?php echo vtranslate('LBL_NEW_DOCUMENT',$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);?>
&nbsp; <span class="caret"></span></button><ul class="dropdown-menu"><li class="dropdown-header"><i class="fa fa-upload"></i> <?php echo vtranslate('LBL_FILE_UPLOAD',$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);?>
</li><li id="VtigerAction"><a href="javascript:Documents_Index_Js.uploadTo('Vtiger',<?php echo $_smarty_tpl->tpl_vars['PARENT_ID']->value;?>
,'<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
')"><img style="  margin-top: -3px;margin-right: 4%;" title="Vtiger" alt="Vtiger" src="layouts/v7/skins//images/Vtiger.png"><?php ob_start();
echo vtranslate('LBL_VTIGER',$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);
$_prefixVariable4 = ob_get_clean();
echo vtranslate('LBL_TO_SERVICE',$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value,$_prefixVariable4);?>
</a></li><li role="separator" class="divider"></li><li class="dropdown-header"><i class="fa fa-link"></i> <?php echo vtranslate('LBL_LINK_EXTERNAL_DOCUMENT',$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);?>
</li><li id="shareDocument"><a href="javascript:Documents_Index_Js.createDocument('E',<?php echo $_smarty_tpl->tpl_vars['PARENT_ID']->value;?>
,'<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
')">&nbsp;<i class="fa fa-external-link"></i>&nbsp;&nbsp; <?php ob_start();
echo vtranslate('LBL_FILE_URL',$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);
$_prefixVariable5 = ob_get_clean();
echo vtranslate('LBL_FROM_SERVICE',$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value,$_prefixVariable5);?>
</a></li><li role="separator" class="divider"></li><li id="createDocument"><a href="javascript:Documents_Index_Js.createDocument('W',<?php echo $_smarty_tpl->tpl_vars['PARENT_ID']->value;?>
,'<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
')"><i class="fa fa-file-text"></i> <?php ob_start();
echo vtranslate('SINGLE_Documents',$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);
$_prefixVariable6 = ob_get_clean();
echo vtranslate('LBL_CREATE_NEW',$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value,$_prefixVariable6);?>
</a></li></ul></div></div><?php }
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></div>&nbsp;</div><?php $_smarty_tpl->_assignInScope('CLASS_VIEW_ACTION', 'relatedViewActions');
$_smarty_tpl->_assignInScope('CLASS_VIEW_PAGING_INPUT', 'relatedViewPagingInput');
$_smarty_tpl->_assignInScope('CLASS_VIEW_PAGING_INPUT_SUBMIT', 'relatedViewPagingInputSubmit');
$_smarty_tpl->_assignInScope('CLASS_VIEW_BASIC_ACTION', 'relatedViewBasicAction');
$_smarty_tpl->_assignInScope('PAGING_MODEL', $_smarty_tpl->tpl_vars['PAGING']->value);
$_smarty_tpl->_assignInScope('RECORD_COUNT', smarty_modifier_count($_smarty_tpl->tpl_vars['RELATED_RECORDS']->value));
$_smarty_tpl->_assignInScope('PAGE_NUMBER', $_smarty_tpl->tpl_vars['PAGING']->value->get('page'));
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "Pagination.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('SHOWPAGEJUMP'=>true), 0, true);
?></div></div><?php if ($_smarty_tpl->tpl_vars['MODULE']->value == 'Products' && $_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value == 'Products' && $_smarty_tpl->tpl_vars['TAB_LABEL']->value === 'Product Bundles' && $_smarty_tpl->tpl_vars['RELATED_LIST_LINKS']->value) {?><div class="row-fluid" data-module="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
"><?php $_smarty_tpl->_assignInScope('IS_VIEWABLE', $_smarty_tpl->tpl_vars['PARENT_RECORD']->value->isBundleViewable());?><input type="hidden" class="isShowBundles" value="<?php echo $_smarty_tpl->tpl_vars['IS_VIEWABLE']->value;?>
"><label class="showBundlesInInventory checkbox"><input type="checkbox" <?php if ($_smarty_tpl->tpl_vars['IS_VIEWABLE']->value) {?>checked<?php }?> value="<?php echo $_smarty_tpl->tpl_vars['IS_VIEWABLE']->value;?>
">&nbsp;&nbsp;<?php echo vtranslate('LBL_SHOW_BUNDLE_IN_INVENTORY',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></div><?php }?><div class="relatedContents col-lg-12 col-md-12 col-sm-12 table-container"><div class="bottomscroll-div"><?php $_smarty_tpl->_assignInScope('WIDTHTYPE', $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('rowheight'));?><table id="listview-table" class="table listview-table"><thead><tr class="listViewHeaders"><th style="min-width:100px"></th><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RELATED_HEADERS']->value, 'HEADER_FIELD');
$_smarty_tpl->tpl_vars['HEADER_FIELD']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['HEADER_FIELD']->value) {
$_smarty_tpl->tpl_vars['HEADER_FIELD']->do_else = false;
if ($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column') == 'time_start' || $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column') == 'time_end') {?><th class="nowrap" style="width:15px"><?php } else { ?><th class="nowrap"><?php if ($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column') == "access_count" || $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column') == "idlists") {?><a href="javascript:void(0);" class="noSorting"><?php echo vtranslate($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('label'),$_smarty_tpl->tpl_vars['RELATED_MODULE']->value->get('name'));?>
</a><?php } else { ?><a href="javascript:void(0);" class="listViewContentHeaderValues" data-nextsortorderval="<?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value == $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column')) {
echo $_smarty_tpl->tpl_vars['NEXT_SORT_ORDER']->value;
} else { ?>ASC<?php }?>" data-fieldname="<?php echo $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column');?>
"><?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value == $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column')) {?><i class="fa fa-sort <?php echo $_smarty_tpl->tpl_vars['FASORT_IMAGE']->value;?>
"></i><?php } else { ?><i class="fa fa-sort customsort"></i><?php }?>&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('label'),$_smarty_tpl->tpl_vars['RELATED_MODULE']->value->get('name'));?>
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
?><th><?php if ($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column') == 'time_start' || $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column') == 'time_end' || $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column') == 'folderid' || $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getFieldDataType() == 'reference') {
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
'<?php $_smarty_tpl->_assignInScope('DETAILVIEWPERMITTED', isPermitted($_smarty_tpl->tpl_vars['RELATED_MODULE']->value->get('name'),'DetailView',$_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getId()));
if ($_smarty_tpl->tpl_vars['DETAILVIEWPERMITTED']->value == 'yes') {?>data-recordUrl='<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDetailViewUrl();?>
'<?php }
} else { ?>data-recordUrl='<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDetailViewUrl();?>
'<?php }?>><td style="width:100px">&nbsp;&nbsp;&nbsp;<span class="actionImages"><a name="relationEdit" data-url="<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getEditViewUrl();?>
"><i title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="fa fa-pencil"></i></a> &nbsp;&nbsp;<?php if ($_smarty_tpl->tpl_vars['IS_DELETABLE']->value) {?><a class="relationDelete"><i title="<?php echo vtranslate('LBL_UNLINK',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="vicon-linkopen"></i></a>&nbsp;&nbsp;<?php }
$_smarty_tpl->_assignInScope('RECORD_ID', $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getId());
$_smarty_tpl->_assignInScope('DOCUMENT_RECORD_MODEL', Vtiger_Record_Model::getInstanceById($_smarty_tpl->tpl_vars['RECORD_ID']->value));
if ($_smarty_tpl->tpl_vars['DOCUMENT_RECORD_MODEL']->value->get('filename') && $_smarty_tpl->tpl_vars['DOCUMENT_RECORD_MODEL']->value->get('filestatus')) {?><a name="viewfile" href="javascript:void(0)" data-filelocationtype="<?php echo $_smarty_tpl->tpl_vars['DOCUMENT_RECORD_MODEL']->value->get('filelocationtype');?>
" data-filename="<?php echo $_smarty_tpl->tpl_vars['DOCUMENT_RECORD_MODEL']->value->get('filename');?>
" onclick="Vtiger_Header_Js.previewFile(event)"><i title="<?php echo vtranslate('LBL_VIEW_FILE',$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);?>
" class="fa fa-picture-o alignMiddle"></i></a>&nbsp;&nbsp;<?php }
if ($_smarty_tpl->tpl_vars['DOCUMENT_RECORD_MODEL']->value->get('filename') && $_smarty_tpl->tpl_vars['DOCUMENT_RECORD_MODEL']->value->get('filestatus') && $_smarty_tpl->tpl_vars['DOCUMENT_RECORD_MODEL']->value->get('filelocationtype') == 'I') {?><a name="downloadfile" href="<?php echo $_smarty_tpl->tpl_vars['DOCUMENT_RECORD_MODEL']->value->getDownloadFileURL();?>
" onclick="event.stopImmediatePropagation();"><i title="<?php echo vtranslate('LBL_DOWNLOAD_FILE',$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);?>
" class="fa fa-download alignMiddle"></i></a><?php }?></span></td><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RELATED_HEADERS']->value, 'HEADER_FIELD');
$_smarty_tpl->tpl_vars['HEADER_FIELD']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['HEADER_FIELD']->value) {
$_smarty_tpl->tpl_vars['HEADER_FIELD']->do_else = false;
$_smarty_tpl->_assignInScope('RELATED_HEADERNAME', $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('name'));
$_smarty_tpl->_assignInScope('RELATED_LIST_VALUE', $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value));
$_smarty_tpl->_assignInScope('IS_DOCUMENT_SOURCE_FIELD', 0);
if ($_smarty_tpl->tpl_vars['RELATED_MODULE']->value->get('name') == 'Documents' && $_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value == 'document_source') {
if ($_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value) == 'Vtiger' || $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value) == 'Google Drive' || $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value) == 'Dropbox') {
$_smarty_tpl->_assignInScope('IS_DOCUMENT_SOURCE_FIELD', 1);
}
}?><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
 relatedListEntryValues " data-field-type="<?php echo $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getFieldDataType();?>
" nowrap style="width:inherit;"><?php if ($_smarty_tpl->tpl_vars['RELATED_MODULE']->value->get('name') == 'Documents' && $_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value == 'document_source') {?><center><?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value);?>
</center><?php } else { ?><span class= "value textOverflowEllipsis"><?php if ($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->isNameField() == true || $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('uitype') == '4') {?><a href="<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDetailViewUrl();?>
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
} elseif ($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getFieldDataType() == 'picklist') {?><span <?php if (!empty($_smarty_tpl->tpl_vars['RELATED_LIST_VALUE']->value)) {?> class="picklist-color picklist-<?php echo $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getId();?>
-<?php echo Vtiger_Util_Helper::convertSpaceToHyphen($_smarty_tpl->tpl_vars['RELATED_LIST_VALUE']->value);?>
" <?php }?>> <?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDisplayValue($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value);?>
 </span><?php } else {
echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDisplayValue($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value);
}?></span><?php }?></td><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></table></div></div><?php echo '<script'; ?>
 type="text/javascript">var related_uimeta = (function() {var fieldInfo  = <?php echo $_smarty_tpl->tpl_vars['RELATED_FIELDS_INFO']->value;?>
;return {field: {get: function(name, property) {if(name && property === undefined) {return fieldInfo[name];}if(name && property) {return fieldInfo[name][property]}},isMandatory : function(name){if(fieldInfo[name]) {return fieldInfo[name].mandatory;}return false;},getType : function(name){if(fieldInfo[name]) {return fieldInfo[name].type}return false;}},};})();<?php echo '</script'; ?>
></div>

    <?php echo '<script'; ?>
 type="text/javascript">
        jQuery(function() {
            if(typeof Documents_Index_Js !== 'function') {
                jQuery("body").append('<?php echo '<script'; ?>
 type="text/javascript" src="layouts/v7/modules/Documents/resources/Documents.js"><\/script>');
            }
        });
    <?php echo '</script'; ?>
>
<?php }
}
