<?php
/* Smarty version 4.5.5, created on 2025-09-16 07:16:43
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Reports\ListViewRecordActions.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68c90edb254061_79224479',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '91301221da675f7214e2650b3e6851c71efbc390' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Reports\\ListViewRecordActions.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68c90edb254061_79224479 (Smarty_Internal_Template $_smarty_tpl) {
?><!--LIST VIEW RECORD ACTIONS--><div class="table-actions reportListActions"><?php if (!$_smarty_tpl->tpl_vars['SEARCH_MODE_RESULTS']->value) {?><span class="input" ><input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getId();?>
" class="listViewEntriesCheckBox"/></span><?php }
$_smarty_tpl->_assignInScope('REPORT_TYPE', $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('reporttype'));
if ($_smarty_tpl->tpl_vars['REPORT_TYPE']->value == 'chart') {?><span><a class="quickView fa fa-eye icon action" title="<?php echo vtranslate('LBL_QUICK_VIEW',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"></a></span><?php }
$_smarty_tpl->_assignInScope('PINNED', $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('pinned'));
if ($_smarty_tpl->tpl_vars['PINNED']->value != null && $_smarty_tpl->tpl_vars['REPORT_TYPE']->value == 'chart') {
$_smarty_tpl->_assignInScope('PIN_CLASS', 'vicon-unpin');
} elseif ($_smarty_tpl->tpl_vars['REPORT_TYPE']->value == 'chart') {
$_smarty_tpl->_assignInScope('PIN_CLASS', 'vicon-pin');
}
if ($_smarty_tpl->tpl_vars['REPORT_TYPE']->value == 'chart') {?><span class="more dropdown action"><span title="<?php if ($_smarty_tpl->tpl_vars['PIN_CLASS']->value == 'vicon-pin') {
echo vtranslate('LBL_PIN_CHART_TO_DASHBOARD',$_smarty_tpl->tpl_vars['MODULE']->value);
} else {
echo vtranslate('LBL_UNPIN_CHART_FROM_DASHBOARD',$_smarty_tpl->tpl_vars['MODULE']->value);
}?>"class="pinToDashboard dropdown-toggle"  data-recordid="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('reportid');?>
"data-primemodule="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('primarymodule');?>
" data-toggle="dropdown"data-dashboard-tab-count='<?php echo php7_count($_smarty_tpl->tpl_vars['DASHBOARD_TABS']->value);?>
'><i class="fa icon <?php echo $_smarty_tpl->tpl_vars['PIN_CLASS']->value;?>
 action" style="font-size:13px;"></i></span><ul class="dropdown-menu dashBoardTabMenu"><li class="dropdown-header popover-title"><?php echo vtranslate('LBL_DASHBOARD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</li><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['DASHBOARD_TABS']->value, 'TAB_INFO');
$_smarty_tpl->tpl_vars['TAB_INFO']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['TAB_INFO']->value) {
$_smarty_tpl->tpl_vars['TAB_INFO']->do_else = false;
?><li class='dashBoardTab' data-tab-id='<?php echo $_smarty_tpl->tpl_vars['TAB_INFO']->value['id'];?>
'><a href='javascript:void(0);' class="dropdown-item"><?php echo $_smarty_tpl->tpl_vars['TAB_INFO']->value['tabname'];?>
</a></li><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></ul></span><?php }
if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->isEditableBySharing()) {?><span class="more dropdown action"><span href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-v icon"></i></span><ul class="dropdown-menu"><li><a data-id="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getId();?>
" href="javascript:void(0);" data-url="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getEditViewUrl();?>
" name="editlink" class="dropdown-item"><?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li><li><a data-id="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getId();?>
" class="deleteRecordButton dropdown-item" href="javascript:void(0);"><?php echo vtranslate('LBL_DELETE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li></ul></span><?php }?><div class="btn-group inline-save hide"><button class="button btn-success btn-small save" name="save"><i class="fa fa-check"></i></button><button class="button btn-danger btn-small cancel" name="Cancel"><i class="fa fa-close"></i></button></div></div><?php }
}
