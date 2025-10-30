<?php
/* Smarty version 4.5.5, created on 2025-09-16 07:19:03
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Vtiger\EmailRelatedList.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68c90f670f2db1_72371280',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'faa1773f41b02040681c455a1cf3ed96e90dd206' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Vtiger\\EmailRelatedList.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68c90f670f2db1_72371280 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
?>
<div class="relatedContainer"><input type="hidden" name="currentPageNum" value="<?php echo $_smarty_tpl->tpl_vars['PAGING']->value->getCurrentPage();?>
" /><?php $_smarty_tpl->_assignInScope('RELATED_MODULE_NAME', $_smarty_tpl->tpl_vars['RELATED_MODULE']->value->get('name'));?><input type="hidden" name="relatedModuleName" class="relatedModuleName" value="<?php echo $_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value;?>
" /><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['ORDER_BY']->value;?>
" id="orderBy"><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['SORT_ORDER']->value;?>
" id="sortOrder"><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['RELATED_ENTIRES_COUNT']->value;?>
" id="noOfEntries"><input type='hidden' value="<?php echo $_smarty_tpl->tpl_vars['PAGING']->value->getPageLimit();?>
" id='pageLimit'><input type='hidden' value="<?php echo $_smarty_tpl->tpl_vars['PAGING']->value->get('page');?>
" id='pageNumber'><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['PAGING']->value->isNextPageExists();?>
" id="nextPageExist"/><input type='hidden' value="<?php echo $_smarty_tpl->tpl_vars['TOTAL_ENTRIES']->value;?>
" id='totalCount'><div class="relatedHeader "><div class="btn-toolbar row-fluid"><div class="col-lg-6 col-md-6 col-sm-6"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RELATED_LIST_LINKS']->value['LISTVIEWBASIC'], 'RELATED_LINK');
$_smarty_tpl->tpl_vars['RELATED_LINK']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['RELATED_LINK']->value) {
$_smarty_tpl->tpl_vars['RELATED_LINK']->do_else = false;
?><div class="btn-group"><?php ob_start();
echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->get('_selectRelation');
$_prefixVariable1 = ob_get_clean();
$_smarty_tpl->_assignInScope('IS_SELECT_BUTTON', $_prefixVariable1);?><button onclick="javascript:Vtiger_Detail_Js.triggerSendEmail('index.php?module=<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
&view=MassActionAjax&mode=showComposeEmailForm&step=step1&relatedLoad=true','Emails');" type="button" class="btn addButton btn-default<?php if ($_smarty_tpl->tpl_vars['IS_SELECT_BUTTON']->value == true) {?> selectRelation <?php }?> "<?php if ($_smarty_tpl->tpl_vars['IS_SELECT_BUTTON']->value == true) {?> data-moduleName=<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->get('_module')->get('name');?>
 <?php }
if (($_smarty_tpl->tpl_vars['RELATED_LINK']->value->isPageLoadLink())) {
if ($_smarty_tpl->tpl_vars['RELATION_FIELD']->value) {?> data-name="<?php echo $_smarty_tpl->tpl_vars['RELATION_FIELD']->value->getName();?>
" <?php }
}
if ($_smarty_tpl->tpl_vars['IS_SELECT_BUTTON']->value != true) {?>name="composeEmail"<?php }?>><?php if ($_smarty_tpl->tpl_vars['IS_SELECT_BUTTON']->value == false) {?><i class="fa fa-plus"></i>&nbsp;<?php }?>&nbsp;<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getLabel();?>
</button></div><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>&nbsp;</div><?php $_smarty_tpl->_assignInScope('CLASS_VIEW_ACTION', 'relatedViewActions');
$_smarty_tpl->_assignInScope('CLASS_VIEW_PAGING_INPUT', 'relatedViewPagingInput');
$_smarty_tpl->_assignInScope('CLASS_VIEW_PAGING_INPUT_SUBMIT', 'relatedViewPagingInputSubmit');
$_smarty_tpl->_assignInScope('CLASS_VIEW_BASIC_ACTION', 'relatedViewBasicAction');
$_smarty_tpl->_assignInScope('PAGING_MODEL', $_smarty_tpl->tpl_vars['PAGING']->value);
$_smarty_tpl->_assignInScope('RECORD_COUNT', smarty_modifier_count($_smarty_tpl->tpl_vars['RELATED_RECORDS']->value));
$_smarty_tpl->_assignInScope('PAGE_NUMBER', $_smarty_tpl->tpl_vars['PAGING']->value->get('page'));
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "Pagination.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('SHOWPAGEJUMP'=>true), 0, true);
?></div></div><div class="relatedContents col-lg-12 col-md-12 col-sm-12 table-container"><div class="bottomscroll-div"><?php $_smarty_tpl->_assignInScope('WIDTHTYPE', $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('rowheight'));?><table id="listview-table" class="table listview-table"><thead><tr class="listViewHeaders"><th class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><a href="javascript:void(0);" class="noSorting"><?php echo vtranslate('LBL_SENDER_NAME');?>
</a></th><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RELATED_HEADERS']->value, 'HEADER_FIELD');
$_smarty_tpl->tpl_vars['HEADER_FIELD']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['HEADER_FIELD']->value) {
$_smarty_tpl->tpl_vars['HEADER_FIELD']->do_else = false;
?><th class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><?php if ($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column') == 'access_count' || $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column') == 'idlists') {?><a href="javascript:void(0);" class="noSorting"><?php echo vtranslate($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('label'),$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);?>
</a><?php } else { ?><a href="javascript:void(0);" class="relatedListHeaderValues" data-nextsortorderval="<?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value == $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column')) {
echo $_smarty_tpl->tpl_vars['NEXT_SORT_ORDER']->value;
} else { ?>ASC<?php }?>" data-fieldname="<?php echo $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column');?>
"><?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value == $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column')) {?><i class="fa fa-sort <?php echo $_smarty_tpl->tpl_vars['FASORT_IMAGE']->value;?>
"></i><?php } else { ?><i class="fa fa-sort customsort"></i><?php }?>&nbsp;&nbsp;<?php echo vtranslate(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'html_entity_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('label') )),$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);?>
&nbsp;<?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value == $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column')) {?><img class="<?php echo $_smarty_tpl->tpl_vars['SORT_IMAGE']->value;?>
"><?php }?>&nbsp;</a><?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value == $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column')) {?><a href="#" class="removeSorting"><i class="fa fa-remove"></i></a><?php }
}?></th><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?><th class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><a href="javascript:void(0);" class="noSorting"><?php echo vtranslate('LBL_STATUS');?>
</a></th></tr></thead><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RELATED_RECORDS']->value, 'RELATED_RECORD');
$_smarty_tpl->tpl_vars['RELATED_RECORD']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['RELATED_RECORD']->value) {
$_smarty_tpl->tpl_vars['RELATED_RECORD']->do_else = false;
$_smarty_tpl->_assignInScope('EMAIL_FLAG', $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getEmailFlag());?><tr class="listViewEntries" data-id='<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getId();?>
' data-emailflag='<?php echo $_smarty_tpl->tpl_vars['EMAIL_FLAG']->value;?>
' name="emailsRelatedRecord"><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><a><?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getSenderName($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['PARENT_RECORD']->value->getId());?>
</a></td><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RELATED_HEADERS']->value, 'HEADER_FIELD');
$_smarty_tpl->tpl_vars['HEADER_FIELD']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['HEADER_FIELD']->value) {
$_smarty_tpl->tpl_vars['HEADER_FIELD']->do_else = false;
$_smarty_tpl->_assignInScope('RELATED_HEADERNAME', $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('name'));?><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><?php if ($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->isNameField() == true || $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('uitype') == '4') {?><a><?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDisplayValue($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value);?>
</a><?php } elseif ($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value == 'access_count') {
echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getAccessCountValue($_smarty_tpl->tpl_vars['PARENT_RECORD']->value->getId());
} elseif ($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value == 'click_count') {
echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getClickCountValue($_smarty_tpl->tpl_vars['PARENT_RECORD']->value->getId());
} elseif ($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value == 'date_start') {
if ($_smarty_tpl->tpl_vars['EMAIL_FLAG']->value != 'SAVED') {
echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDisplayValue($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value);
}
} elseif ($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value == 'time_start') {
if ($_smarty_tpl->tpl_vars['EMAIL_FLAG']->value != 'SAVED') {
echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDisplayValue($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value);
}
} elseif ($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getFieldDataType() == 'owner') {
echo getOwnerName($_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value));
} else {
echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDisplayValue($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value);
}?></td><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><span class="label <?php if ($_smarty_tpl->tpl_vars['EMAIL_FLAG']->value == 'SAVED') {?>label-info<?php } elseif ($_smarty_tpl->tpl_vars['EMAIL_FLAG']->value == 'SENT') {?>label-success<?php } else { ?>label-warning<?php }?>"><?php echo vtranslate($_smarty_tpl->tpl_vars['EMAIL_FLAG']->value);?>
</span><div class="pull-right actions"><span class="actionImages"><a name="emailsDetailView" data-id='<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getId();?>
'><i title="<?php echo vtranslate('LBL_SHOW_COMPLETE_DETAILS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="fa fa-bars"></i></a>&nbsp;&nbsp;<?php if ($_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getEmailFlag() == 'SAVED') {?><a name="emailsEditView"><i title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="fa fa-pencil"></i></a>	&nbsp;&nbsp;<?php }
if ($_smarty_tpl->tpl_vars['IS_DELETABLE']->value) {?><a class="relationDelete"><i title="<?php echo vtranslate('LBL_UNLINK',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="vicon-linkopen"></i></a><?php }?></span></div></td></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></table></div></div></div>
<?php }
}
