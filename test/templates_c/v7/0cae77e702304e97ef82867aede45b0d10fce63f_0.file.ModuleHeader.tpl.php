<?php
/* Smarty version 4.5.5, created on 2025-11-05 07:47:01
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Reports\ModuleHeader.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690b00f59a8918_87800521',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0cae77e702304e97ef82867aede45b0d10fce63f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Reports\\ModuleHeader.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690b00f59a8918_87800521 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="col-sm-12 col-xs-12 module-action-bar clearfix coloredBorderTop"><div class="module-action-content clearfix"><span class="col-lg-7 col-md-7"><span><?php $_smarty_tpl->_assignInScope('MODULE_MODEL', Vtiger_Module_Model::getInstance($_smarty_tpl->tpl_vars['MODULE']->value));
$_smarty_tpl->_assignInScope('DEFAULT_FILTER_ID', $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getDefaultCustomFilter());
if ($_smarty_tpl->tpl_vars['DEFAULT_FILTER_ID']->value) {
$_smarty_tpl->_assignInScope('CVURL', ("&viewname=").($_smarty_tpl->tpl_vars['DEFAULT_FILTER_ID']->value));
$_smarty_tpl->_assignInScope('DEFAULT_FILTER_URL', ($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getListViewUrl()).($_smarty_tpl->tpl_vars['CVURL']->value));
} else {
$_smarty_tpl->_assignInScope('DEFAULT_FILTER_URL', $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getListViewUrlWithAllFilter());
}?><a title="<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
" href='<?php echo $_smarty_tpl->tpl_vars['DEFAULT_FILTER_URL']->value;?>
'><h4 class="module-title pull-left">&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;</h4></a></span><span><p class="current-filter-name pull-left">&nbsp;<span class="fa fa-angle-right" aria-hidden="true"></span>&nbsp;<?php if ($_smarty_tpl->tpl_vars['VIEW']->value == 'Detail' || $_smarty_tpl->tpl_vars['VIEW']->value == 'ChartDetail') {
echo $_smarty_tpl->tpl_vars['REPORT_NAME']->value;
} else {
echo $_smarty_tpl->tpl_vars['VIEW']->value;
}?>&nbsp;</p></span><?php if ((isset($_smarty_tpl->tpl_vars['VIEWNAME']->value)) && $_smarty_tpl->tpl_vars['VIEWNAME']->value) {
if ($_smarty_tpl->tpl_vars['VIEWNAME']->value != 'All') {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FOLDERS']->value, 'FOLDER');
$_smarty_tpl->tpl_vars['FOLDER']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FOLDER']->value) {
$_smarty_tpl->tpl_vars['FOLDER']->do_else = false;
if ($_smarty_tpl->tpl_vars['FOLDER']->value->getId() == $_smarty_tpl->tpl_vars['VIEWNAME']->value) {
$_smarty_tpl->_assignInScope('FOLDERNAME', $_smarty_tpl->tpl_vars['FOLDER']->value->getName());
break 1;
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
} else {
$_smarty_tpl->_assignInScope('FOLDERNAME', vtranslate('LBL_ALL_REPORTS',$_smarty_tpl->tpl_vars['MODULE']->value));
}?><span><p class="current-filter-name filter-name pull-left"><span class="fa fa-angle-right" aria-hidden="true"></span>&nbsp;<?php if ((isset($_smarty_tpl->tpl_vars['FOLDERNAME']->value))) {
echo $_smarty_tpl->tpl_vars['FOLDERNAME']->value;
} else { ?>''<?php }?>&nbsp;</p></span><?php }?></span><span class="col-lg-5 col-md-5 pull-right"><div id="appnav" class="navbar-right"><?php if ((isset($_smarty_tpl->tpl_vars['LISTVIEW_LINKS']->value['LISTVIEWBASIC']))) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LISTVIEW_LINKS']->value['LISTVIEWBASIC'], 'LISTVIEW_BASICACTION');
$_smarty_tpl->tpl_vars['LISTVIEW_BASICACTION']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_BASICACTION']->value) {
$_smarty_tpl->tpl_vars['LISTVIEW_BASICACTION']->do_else = false;
$_smarty_tpl->_assignInScope('childLinks', $_smarty_tpl->tpl_vars['LISTVIEW_BASICACTION']->value->getChildLinks());
if ($_smarty_tpl->tpl_vars['childLinks']->value && $_smarty_tpl->tpl_vars['LISTVIEW_BASICACTION']->value->get('linklabel') == 'LBL_ADD_RECORD') {?><span class="btn-group"><button class="btn btn-default dropdown-toggle module-buttons" data-toggle="dropdown" id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_listView_basicAction_Add"><i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['LISTVIEW_BASICACTION']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<i class="caret icon-white"></i></button><ul class="dropdown-menu"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['childLinks']->value, 'childLink');
$_smarty_tpl->tpl_vars['childLink']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['childLink']->value) {
$_smarty_tpl->tpl_vars['childLink']->do_else = false;
if ($_smarty_tpl->tpl_vars['childLink']->value->getLabel() == 'LBL_CHARTS') {
$_smarty_tpl->_assignInScope('ICON_CLASS', 'fa fa-pie-chart');
} elseif ($_smarty_tpl->tpl_vars['childLink']->value->getLabel() == 'LBL_DETAIL_REPORT') {
$_smarty_tpl->_assignInScope('ICON_CLASS', 'vicon-detailreport');
}?><li id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_listView_basicAction_<?php echo Vtiger_Util_Helper::replaceSpaceWithUnderScores($_smarty_tpl->tpl_vars['childLink']->value->getLabel());?>
" data-edition-disable="<?php if ((isset($_smarty_tpl->tpl_vars['childLink']->value->disabled))) {?> <?php echo $_smarty_tpl->tpl_vars['childLink']->value->disabled;?>
 <?php }?>"data-edition-message="<?php if ((isset($_smarty_tpl->tpl_vars['childLink']->value->message))) {?> <?php echo $_smarty_tpl->tpl_vars['childLink']->value->message;?>
 <?php }?>"><a <?php if (($_smarty_tpl->tpl_vars['childLink']->value) && !(isset($_smarty_tpl->tpl_vars['childLink']->value->disabled)) || $_smarty_tpl->tpl_vars['childLink']->value->disabled != '1') {?> <?php if (stripos($_smarty_tpl->tpl_vars['childLink']->value->getUrl(),'javascript:') === 0) {?> onclick='<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'substr' ][ 0 ], array( $_smarty_tpl->tpl_vars['childLink']->value->getUrl(),strlen("javascript:") ));?>
;' <?php } else { ?> href='<?php echo $_smarty_tpl->tpl_vars['childLink']->value->getUrl();?>
' <?php }?> <?php } else { ?> href="javascript:void(0);" <?php }?>><i class='<?php echo $_smarty_tpl->tpl_vars['ICON_CLASS']->value;?>
' style="font-size:13px;"></i>&nbsp; <?php echo vtranslate($_smarty_tpl->tpl_vars['childLink']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></ul></span><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?></div></span></div><?php $_smarty_tpl->_assignInScope('FIELDS_INFO', Reports_Field_Model::getListViewFieldsInfo());
if ($_smarty_tpl->tpl_vars['FIELDS_INFO']->value != null) {
echo '<script'; ?>
 type="text/javascript">var uimeta = (function () {var fieldInfo = <?php echo $_smarty_tpl->tpl_vars['FIELDS_INFO']->value;?>
;return {field: {get: function (name, property) {if (name && property === undefined) {return fieldInfo[name];}if (name && property) {return fieldInfo[name][property]}},isMandatory: function (name) {if (fieldInfo[name]) {return fieldInfo[name].mandatory;}return false;},getType: function (name) {if (fieldInfo[name]) {return fieldInfo[name].type}return false;}}};})();<?php echo '</script'; ?>
><?php }?><div class="rssAddFormContainer hide"></div></div><?php }
}
