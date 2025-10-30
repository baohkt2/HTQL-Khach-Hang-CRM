<?php
/* Smarty version 4.5.5, created on 2025-09-30 07:51:46
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Reports\DetailViewActions.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68db8c1284e779_28542299',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e1cd6a721737b95b5592b70e631718fa421d4f2d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Reports\\DetailViewActions.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68db8c1284e779_28542299 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="listViewPageDiv"><div class="reportHeader"><div class="row"><div class="col-lg-4 detailViewButtoncontainer"><div class="btn-toolbar"><div class="btn-group"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['DETAILVIEW_ACTIONS']->value, 'DETAILVIEW_LINK');
$_smarty_tpl->tpl_vars['DETAILVIEW_LINK']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['DETAILVIEW_LINK']->value) {
$_smarty_tpl->tpl_vars['DETAILVIEW_LINK']->do_else = false;
$_smarty_tpl->_assignInScope('LINK_URL', $_smarty_tpl->tpl_vars['DETAILVIEW_LINK']->value->getUrl());
$_smarty_tpl->_assignInScope('LINK_NAME', $_smarty_tpl->tpl_vars['DETAILVIEW_LINK']->value->getLabel());
$_smarty_tpl->_assignInScope('LINK_ICON_CLASS', $_smarty_tpl->tpl_vars['DETAILVIEW_LINK']->value->get('linkiconclass'));
if ($_smarty_tpl->tpl_vars['LINK_ICON_CLASS']->value == 'vtGlyph vticon-attach') {?><div class="btn-group"><?php }?><button <?php if ($_smarty_tpl->tpl_vars['LINK_URL']->value) {?> onclick='window.location.href = "<?php echo $_smarty_tpl->tpl_vars['LINK_URL']->value;?>
"' <?php }?> type="button"class="cursorPointer btn btn-default <?php echo $_smarty_tpl->tpl_vars['DETAILVIEW_LINK']->value->get('customclass');
if ($_smarty_tpl->tpl_vars['LINK_ICON_CLASS']->value == 'vtGlyph vticon-attach' && php7_count($_smarty_tpl->tpl_vars['DASHBOARD_TABS']->value) > 1) {?> dropdown-toggle<?php }?>"title="<?php if ($_smarty_tpl->tpl_vars['LINK_ICON_CLASS']->value == 'vtGlyph vticon-attach') {
if ($_smarty_tpl->tpl_vars['REPORT_MODEL']->value->isPinnedToDashboard()) {
echo vtranslate('LBL_UNPIN_CHART_FROM_DASHBOARD',$_smarty_tpl->tpl_vars['MODULE']->value);
} else {
echo vtranslate('LBL_PIN_CHART_TO_DASHBOARD',$_smarty_tpl->tpl_vars['MODULE']->value);
}
} else {
echo $_smarty_tpl->tpl_vars['DETAILVIEW_LINK']->value->get('linktitle');
}?>" <?php if ($_smarty_tpl->tpl_vars['LINK_ICON_CLASS']->value == 'vtGlyph vticon-attach' && php7_count($_smarty_tpl->tpl_vars['DASHBOARD_TABS']->value) > 1) {?>data-toggle="dropdown"<?php }
if ($_smarty_tpl->tpl_vars['LINK_ICON_CLASS']->value == 'vtGlyph vticon-attach') {?>data-dashboard-tab-count='<?php echo php7_count($_smarty_tpl->tpl_vars['DASHBOARD_TABS']->value);?>
'<?php }?> ><?php if ($_smarty_tpl->tpl_vars['LINK_NAME']->value) {?> <?php echo $_smarty_tpl->tpl_vars['LINK_NAME']->value;
}
if ($_smarty_tpl->tpl_vars['LINK_ICON_CLASS']->value) {
if ($_smarty_tpl->tpl_vars['LINK_ICON_CLASS']->value == 'icon-pencil') {?>&nbsp;&nbsp;&nbsp;<?php }?><i class="fa <?php if ($_smarty_tpl->tpl_vars['LINK_ICON_CLASS']->value == 'icon-pencil') {?>fa-pencil<?php } elseif ($_smarty_tpl->tpl_vars['LINK_ICON_CLASS']->value == 'vtGlyph vticon-attach') {
if ($_smarty_tpl->tpl_vars['REPORT_MODEL']->value->isPinnedToDashboard()) {?>vicon-unpin<?php } else { ?>vicon-pin<?php }
}?>" style="font-size: 13px;"></i><?php }?></button><?php if ($_smarty_tpl->tpl_vars['LINK_ICON_CLASS']->value == 'vtGlyph vticon-attach') {?><ul class='dropdown-menu dashBoardTabMenu'><li class="dropdown-header popover-title"><?php echo vtranslate('LBL_DASHBOARD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</li><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['DASHBOARD_TABS']->value, 'TAB_INFO');
$_smarty_tpl->tpl_vars['TAB_INFO']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['TAB_INFO']->value) {
$_smarty_tpl->tpl_vars['TAB_INFO']->do_else = false;
?><li class='dashBoardTab' data-tab-id='<?php echo $_smarty_tpl->tpl_vars['TAB_INFO']->value['id'];?>
'><a href='javascript:void(0)'> <?php echo $_smarty_tpl->tpl_vars['TAB_INFO']->value['tabname'];?>
</a></li><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></ul><?php }
if ($_smarty_tpl->tpl_vars['LINK_ICON_CLASS']->value == 'vtGlyph vticon-attach') {?></div><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></div></div></div><div class="col-lg-4 textAlignCenter"><h3 class="marginTop0px"><?php echo $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->getName();?>
</h3><?php if ($_smarty_tpl->tpl_vars['REPORT_MODEL']->value->getReportType() == 'tabular' || $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->getReportType() == 'summary') {?><div id="noOfRecords"><?php echo vtranslate('LBL_NO_OF_RECORDS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span id="countValue"><?php echo $_smarty_tpl->tpl_vars['COUNT']->value;?>
</span></div><?php if ($_smarty_tpl->tpl_vars['COUNT']->value > $_smarty_tpl->tpl_vars['REPORT_LIMIT']->value) {?><span class="redColor" id="moreRecordsText"> (<?php echo vtranslate('LBL_MORE_RECORDS_TXT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
)</span><?php } else { ?><span class="redColor hide" id="moreRecordsText"> (<?php echo vtranslate('LBL_MORE_RECORDS_TXT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
)</span><?php }
}?></div><div class='col-lg-4 detailViewButtoncontainer'><span class="pull-right"><div class="btn-toolbar"><div class="btn-group"><?php if ((isset($_smarty_tpl->tpl_vars['DETAILVIEW_LINKS']->value)) && $_smarty_tpl->tpl_vars['DETAILVIEW_LINKS']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['DETAILVIEW_LINKS']->value, 'DETAILVIEW_LINK');
$_smarty_tpl->tpl_vars['DETAILVIEW_LINK']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['DETAILVIEW_LINK']->value) {
$_smarty_tpl->tpl_vars['DETAILVIEW_LINK']->do_else = false;
$_smarty_tpl->_assignInScope('LINKNAME', $_smarty_tpl->tpl_vars['DETAILVIEW_LINK']->value->getLabel());?><button class="btn btn-default reportActions" name="<?php echo $_smarty_tpl->tpl_vars['LINKNAME']->value;?>
" data-href="<?php echo $_smarty_tpl->tpl_vars['DETAILVIEW_LINK']->value->getUrl();?>
&source=<?php echo $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->getReportType();?>
"><?php echo $_smarty_tpl->tpl_vars['LINKNAME']->value;?>
</button><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?></div></div></span></div></div></div></div><?php }
}
