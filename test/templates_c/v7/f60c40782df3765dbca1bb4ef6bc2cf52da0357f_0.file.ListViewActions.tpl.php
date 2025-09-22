<?php
/* Smarty version 4.5.5, created on 2025-09-16 07:19:19
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\EmailTemplates\ListViewActions.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68c90f7722bf90_39674420',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f60c40782df3765dbca1bb4ef6bc2cf52da0357f' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\EmailTemplates\\ListViewActions.tpl',
      1 => 1758006181,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68c90f7722bf90_39674420 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
$_smarty_tpl->_assignInScope('LISTVIEW_MASSACTIONS_1', array());?><div id="listview-actions" class="listview-actions-container"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LISTVIEW_MASSACTIONS']->value, 'LIST_MASSACTION', false, NULL, 'massActions', array (
));
$_smarty_tpl->tpl_vars['LIST_MASSACTION']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LIST_MASSACTION']->value) {
$_smarty_tpl->tpl_vars['LIST_MASSACTION']->do_else = false;
if ($_smarty_tpl->tpl_vars['LIST_MASSACTION']->value->getLabel() == 'LBL_EDIT') {
$_smarty_tpl->_assignInScope('editAction', $_smarty_tpl->tpl_vars['LIST_MASSACTION']->value);
} elseif ($_smarty_tpl->tpl_vars['LIST_MASSACTION']->value->getLabel() == 'LBL_DELETE') {
$_smarty_tpl->_assignInScope('deleteAction', $_smarty_tpl->tpl_vars['LIST_MASSACTION']->value);
} elseif ($_smarty_tpl->tpl_vars['LIST_MASSACTION']->value->getLabel() == 'LBL_ADD_COMMENT') {
$_smarty_tpl->_assignInScope('commentAction', $_smarty_tpl->tpl_vars['LIST_MASSACTION']->value);
} else {
$_smarty_tpl->_assignInScope('a', array_push($_smarty_tpl->tpl_vars['LISTVIEW_MASSACTIONS_1']->value,$_smarty_tpl->tpl_vars['LIST_MASSACTION']->value));
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?><div class = "row"><div class="btn-toolbar col-md-3" role="group" aria-label="..."><div class="btn-group" role="group" aria-label="..."><button type="button" class="btn btn-default viewType" title="<?php echo vtranslate('LBL_LIST_VIEW',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" data-mode="list" <?php if ($_smarty_tpl->tpl_vars['VIEWTYPE']->value == 'list') {?> disabled="disabled" <?php }?>><i class="fa fa-th-list"></i></button><button type="button" class="btn btn-default viewType" title="<?php echo vtranslate('LBL_THUMBNAIL_VIEW',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" data-mode="grid" <?php if ($_smarty_tpl->tpl_vars['VIEWTYPE']->value == 'grid') {?> disabled="disabled" <?php }?>><i class="fa fa-th-large"></i></button></div><div class="btn-group"><?php if ((isset($_smarty_tpl->tpl_vars['editAction']->value)) && $_smarty_tpl->tpl_vars['editAction']->value) {?><button type="button" class="btn btn-default" id=<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_listView_massAction_<?php echo $_smarty_tpl->tpl_vars['editAction']->value->getLabel();
if (stripos($_smarty_tpl->tpl_vars['editAction']->value->getUrl(),'javascript:') === 0) {?> href="javascript:void(0);" onclick='<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'substr' ][ 0 ], array( $_smarty_tpl->tpl_vars['editAction']->value->getUrl(),strlen("javascript:") ));?>
'<?php } else { ?> href='<?php echo $_smarty_tpl->tpl_vars['editAction']->value->getUrl();?>
' <?php }?> title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i class="fa fa-pencil"></i></button><?php }
if ($_smarty_tpl->tpl_vars['deleteAction']->value) {?><button type="button" class="btn btn-default <?php if ($_smarty_tpl->tpl_vars['VIEWTYPE']->value == 'grid') {?>hide<?php }?>" id=<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_listView_massAction_<?php echo $_smarty_tpl->tpl_vars['deleteAction']->value->getLabel();
if (stripos($_smarty_tpl->tpl_vars['deleteAction']->value->getUrl(),'javascript:') === 0) {?> href="javascript:void(0);" onclick='<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'substr' ][ 0 ], array( $_smarty_tpl->tpl_vars['deleteAction']->value->getUrl(),strlen("javascript:") ));?>
'<?php } else { ?> href='<?php echo $_smarty_tpl->tpl_vars['deleteAction']->value->getUrl();?>
' <?php }?> title="<?php echo vtranslate('LBL_DELETE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i class="fa fa-trash"></i></button><?php }
if ((isset($_smarty_tpl->tpl_vars['commentAction']->value)) && $_smarty_tpl->tpl_vars['commentAction']->value) {?><button type="button" class="btn btn-default" id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_listView_massAction_<?php echo $_smarty_tpl->tpl_vars['commentAction']->value->getLabel();?>
"onclick="Vtiger_List_Js.triggerMassAction('<?php echo $_smarty_tpl->tpl_vars['commentAction']->value->getUrl();?>
')" title="<?php echo vtranslate('LBL_COMMENT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i class="fa fa-comment"></i></button><?php }
if (php7_count($_smarty_tpl->tpl_vars['LISTVIEW_MASSACTIONS_1']->value) > 0 || smarty_modifier_count($_smarty_tpl->tpl_vars['LISTVIEW_LINKS']->value['LISTVIEW']) > 0) {?><div class="btn-group listViewMassActions" role="group"><button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"><?php echo vtranslate('LBL_MORE','Vtiger');?>
&nbsp;<span class="caret"></span></button><ul class="dropdown-menu" role="menu"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LISTVIEW_MASSACTIONS_1']->value, 'LISTVIEW_MASSACTION', false, NULL, 'advancedMassActions', array (
));
$_smarty_tpl->tpl_vars['LISTVIEW_MASSACTION']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_MASSACTION']->value) {
$_smarty_tpl->tpl_vars['LISTVIEW_MASSACTION']->do_else = false;
?><li><a id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_listView_massAction_<?php echo Vtiger_Util_Helper::replaceSpaceWithUnderScores($_smarty_tpl->tpl_vars['LISTVIEW_MASSACTION']->value->getLabel());?>
" <?php if (stripos($_smarty_tpl->tpl_vars['LISTVIEW_MASSACTION']->value->getUrl(),'javascript:') === 0) {?> href="javascript:void(0);" onclick='<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'substr' ][ 0 ], array( $_smarty_tpl->tpl_vars['LISTVIEW_MASSACTION']->value->getUrl(),strlen("javascript:") ));?>
;'<?php } else { ?> href='<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_MASSACTION']->value->getUrl();?>
' <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['LISTVIEW_MASSACTION']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
if (php7_count($_smarty_tpl->tpl_vars['LISTVIEW_MASSACTIONS_1']->value) > 0 && smarty_modifier_count($_smarty_tpl->tpl_vars['LISTVIEW_LINKS']->value['LISTVIEW']) > 0) {?><li class="divider"></li><?php }?><li><a id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_listView_massAction_LBL_ADD_STAR" onclick="Vtiger_List_Js.triggerAddStar()"><?php echo vtranslate('LBL_ADD_STAR',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li><li><a id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_listView_massAction_LBL_REMOVE_STAR" onclick="Vtiger_List_Js.triggerRemoveStar()"><?php echo vtranslate('LBL_REMOVE_STAR',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li><li><a id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_listView_massAction_LBL_ADD_TAG" onclick="Vtiger_List_Js.triggerAddTag()"><?php echo vtranslate('LBL_ADD_TAG',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li><?php if ($_smarty_tpl->tpl_vars['CURRENT_TAG']->value != '') {?><li><a id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_listview_massAction_LBL_REMOVE_TAG" onclick="Vtiger_List_Js.triggerRemoveTag(<?php echo $_smarty_tpl->tpl_vars['CURRENT_TAG']->value;?>
)"><?php echo vtranslate('LBL_REMOVE_TAG',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li><?php }?><li class="divider" style="margin:9px 0px;"></li><?php $_smarty_tpl->_assignInScope('FIND_DUPLICATES_EXITS', false);
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LISTVIEW_LINKS']->value['LISTVIEW'], 'LISTVIEW_ADVANCEDACTIONS');
$_smarty_tpl->tpl_vars['LISTVIEW_ADVANCEDACTIONS']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_ADVANCEDACTIONS']->value) {
$_smarty_tpl->tpl_vars['LISTVIEW_ADVANCEDACTIONS']->do_else = false;
if ($_smarty_tpl->tpl_vars['LISTVIEW_ADVANCEDACTIONS']->value->getLabel() == 'LBL_IMPORT') {
} else {
if ($_smarty_tpl->tpl_vars['LISTVIEW_ADVANCEDACTIONS']->value->getLabel() == 'LBL_FIND_DUPLICATES') {
$_smarty_tpl->_assignInScope('FIND_DUPLICATES_EXISTS', true);
}?><li><a id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_listView_advancedAction_<?php echo Vtiger_Util_Helper::replaceSpaceWithUnderScores($_smarty_tpl->tpl_vars['LISTVIEW_ADVANCEDACTIONS']->value->getLabel());?>
" <?php if (stripos($_smarty_tpl->tpl_vars['LISTVIEW_ADVANCEDACTIONS']->value->getUrl(),'javascript:') === 0) {?> href="javascript:void(0);" onclick='<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'substr' ][ 0 ], array( $_smarty_tpl->tpl_vars['LISTVIEW_ADVANCEDACTIONS']->value->getUrl(),strlen("javascript:") ));?>
;'<?php } else { ?> href='<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ADVANCEDACTIONS']->value->getUrl();?>
' <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['LISTVIEW_ADVANCEDACTIONS']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
if ($_smarty_tpl->tpl_vars['FIND_DUPLICATES_EXISTS']->value) {?><li><a id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_listView_advancedAction_MERGE_RECORD"  href="javascript:void(0);" onclick='Vtiger_List_Js.triggerMergeRecord()'><?php echo vtranslate('LBL_MERGE_SELECTED_RECORDS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li><?php }?></ul></div><?php }?></div></div><div class='col-md-6'><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value == '0' && $_smarty_tpl->tpl_vars['REQUEST_INSTANCE']->value->isAjax()) {
if ($_SESSION['lvs'][$_smarty_tpl->tpl_vars['MODULE']->value]['viewname']) {
$_smarty_tpl->_assignInScope('VIEWID', $_SESSION['lvs'][$_smarty_tpl->tpl_vars['MODULE']->value]['viewname']);
}
if ($_smarty_tpl->tpl_vars['VIEWID']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['CUSTOM_VIEWS']->value, 'FILTER_TYPES');
$_smarty_tpl->tpl_vars['FILTER_TYPES']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FILTER_TYPES']->value) {
$_smarty_tpl->tpl_vars['FILTER_TYPES']->do_else = false;
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FILTER_TYPES']->value, 'FILTERS');
$_smarty_tpl->tpl_vars['FILTERS']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FILTERS']->value) {
$_smarty_tpl->tpl_vars['FILTERS']->do_else = false;
if ($_smarty_tpl->tpl_vars['FILTERS']->value->get('cvid') == $_smarty_tpl->tpl_vars['VIEWID']->value) {
$_smarty_tpl->_assignInScope('CVNAME', $_smarty_tpl->tpl_vars['FILTERS']->value->get('viewname'));
break 1;
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
$_smarty_tpl->_assignInScope('DEFAULT_FILTER_URL', $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getDefaultUrl());
$_smarty_tpl->_assignInScope('DEFAULT_FILTER_ID', $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getDefaultCustomFilter());
if ($_smarty_tpl->tpl_vars['DEFAULT_FILTER_ID']->value) {
$_smarty_tpl->_assignInScope('DEFAULT_FILTER_URL', (($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getListViewUrl()).("&viewname=")).($_smarty_tpl->tpl_vars['DEFAULT_FILTER_ID']->value));
}
if ($_smarty_tpl->tpl_vars['CVNAME']->value != 'All') {?><div><?php echo vtranslate('LBL_DISPLAYING_RESULTS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate('LBL_FROM',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <b><?php echo $_smarty_tpl->tpl_vars['CVNAME']->value;?>
</b>. <a style="color:blue" href='<?php echo $_smarty_tpl->tpl_vars['DEFAULT_FILTER_URL']->value;?>
'><?php echo vtranslate('LBL_SEARCH_IN',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate('ALL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a> </div><?php }
}
}?><div id="selectAllMsgDiv" class="hide" style = "height:30px;"><center><a href="#"><?php echo vtranslate('LBL_SELECT_ALL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;(<span id="totalRecordsCount" value=""></span>)</a></center></div><div id="deSelectAllMsgDiv" class="hide" style = "height:30px;"><center><a href="#"><?php echo vtranslate('LBL_DESELECT_ALL_RECORDS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></center></div></div><div class="col-md-3"><?php $_smarty_tpl->_assignInScope('RECORD_COUNT', $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value);
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "Pagination.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('SHOWPAGEJUMP'=>true), 0, true);
?></div></div></div><?php }
}
