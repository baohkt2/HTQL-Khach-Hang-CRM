<?php
/* Smarty version 4.5.5, created on 2025-10-31 05:21:48
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\CTChatLog\ModuleHeader.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_6904476cefeb79_58347629',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cf2e2a5e04e3084879be90756ce18213f46350e4' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\CTChatLog\\ModuleHeader.tpl',
      1 => 1761807767,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6904476cefeb79_58347629 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\vtigercrm\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
?>
<div class="col-sm-11 col-xs-10 padding0 module-action-bar clearfix coloredBorderTop"><div class="module-action-content clearfix <?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
-module-action-content"><div class="col-lg-7 col-md-6 col-sm-5 col-xs-11 padding0 module-breadcrumb module-breadcrumb-<?php echo $_REQUEST['view'];?>
 transitionsAllHalfSecond"><?php $_smarty_tpl->_assignInScope('MODULE_MODEL', Vtiger_Module_Model::getInstance($_smarty_tpl->tpl_vars['MODULE']->value));
if ($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getDefaultViewName() != 'List') {
$_smarty_tpl->_assignInScope('DEFAULT_FILTER_URL', $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getDefaultUrl());
} else {
$_smarty_tpl->_assignInScope('DEFAULT_FILTER_ID', $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getDefaultCustomFilter());
if ($_smarty_tpl->tpl_vars['DEFAULT_FILTER_ID']->value) {
$_smarty_tpl->_assignInScope('CVURL', ("&viewname=").($_smarty_tpl->tpl_vars['DEFAULT_FILTER_ID']->value));
$_smarty_tpl->_assignInScope('DEFAULT_FILTER_URL', ($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getListViewUrl()).($_smarty_tpl->tpl_vars['CVURL']->value));
} else {
$_smarty_tpl->_assignInScope('DEFAULT_FILTER_URL', $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getListViewUrlWithAllFilter());
}
}?><a title="<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
" href='<?php echo $_smarty_tpl->tpl_vars['DEFAULT_FILTER_URL']->value;?>
&app=<?php echo $_smarty_tpl->tpl_vars['SELECTED_MENU_CATEGORY']->value;?>
'><h4 class="module-title pull-left text-uppercase"> <?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
 </h4>&nbsp;&nbsp;</a><?php if ((isset($_SESSION['lvs'])) && (isset($_SESSION['lvs'][$_smarty_tpl->tpl_vars['MODULE']->value])) && (isset($_SESSION['lvs'][$_smarty_tpl->tpl_vars['MODULE']->value]['viewname']))) {
$_smarty_tpl->_assignInScope('VIEWID', $_SESSION['lvs'][$_smarty_tpl->tpl_vars['MODULE']->value]['viewname']);
}
if ((isset($_smarty_tpl->tpl_vars['VIEWID']->value)) && $_smarty_tpl->tpl_vars['VIEWID']->value) {
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
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?><p class="current-filter-name filter-name pull-left cursorPointer" title="<?php echo $_smarty_tpl->tpl_vars['CVNAME']->value;?>
"><span class="fa fa-angle-right pull-left" aria-hidden="true"></span><a href='<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getListViewUrl();?>
&viewname=<?php echo $_smarty_tpl->tpl_vars['VIEWID']->value;?>
&app=<?php echo $_smarty_tpl->tpl_vars['SELECTED_MENU_CATEGORY']->value;?>
'>&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['CVNAME']->value;?>
&nbsp;&nbsp;</a> </p><?php }
$_smarty_tpl->_assignInScope('SINGLE_MODULE_NAME', ('SINGLE_').($_smarty_tpl->tpl_vars['MODULE']->value));
if ((isset($_smarty_tpl->tpl_vars['RECORD']->value)) && $_smarty_tpl->tpl_vars['RECORD']->value && $_REQUEST['view'] == 'Edit') {?><p class="current-filter-name filter-name pull-left "><span class="fa fa-angle-right pull-left" aria-hidden="true"></span><a title="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('label');?>
">&nbsp;&nbsp;<?php echo vtranslate('LBL_EDITING',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 : <?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('label');?>
 &nbsp;&nbsp;</a></p><?php } elseif ($_REQUEST['view'] == 'Edit') {?><p class="current-filter-name filter-name pull-left "><span class="fa fa-angle-right pull-left" aria-hidden="true"></span><a>&nbsp;&nbsp;<?php echo vtranslate('LBL_ADDING_NEW',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;&nbsp;</a></p><?php }
if ($_REQUEST['view'] == 'Detail') {?><p class="current-filter-name filter-name pull-left"><span class="fa fa-angle-right pull-left" aria-hidden="true"></span><a title="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('label');?>
">&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('label');?>
 &nbsp;&nbsp;</a></p><?php }?></div><div class="col-lg-5 col-md-6 col-sm-7 col-xs-1 padding0 pull-right"><div id="appnav" class="navbar-right"><nav class="navbar navbar-inverse border0 margin0"><?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['MODULE_BASIC_ACTIONS']->value) > 0) {
}?></nav></div></div></div><?php if ($_smarty_tpl->tpl_vars['FIELDS_INFO']->value != null) {
echo '<script'; ?>
 type="text/javascript">var uimeta = (function () {var fieldInfo = <?php echo $_smarty_tpl->tpl_vars['FIELDS_INFO']->value;?>
;return {field: {get: function (name, property) {if (name && property === undefined) {return fieldInfo[name];}if (name && property) {return fieldInfo[name][property]}},isMandatory: function (name) {if (fieldInfo[name]) {return fieldInfo[name].mandatory;}return false;},getType: function (name) {if (fieldInfo[name]) {return fieldInfo[name].type}return false;}},};})();<?php echo '</script'; ?>
><?php }?></div>
<?php }
}
