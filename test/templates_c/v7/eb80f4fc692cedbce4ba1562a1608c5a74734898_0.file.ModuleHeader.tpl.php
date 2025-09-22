<?php
/* Smarty version 4.5.5, created on 2025-09-16 07:46:02
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Documents\ModuleHeader.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68c915bab3a335_98684690',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'eb80f4fc692cedbce4ba1562a1608c5a74734898' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Documents\\ModuleHeader.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68c915bab3a335_98684690 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
?>

<div class="col-sm-12 col-xs-12 module-action-bar clearfix coloredBorderTop"><div class="module-action-content clearfix"><div class="col-lg-7 col-md-7 module-breadcrumb module-breadcrumb-<?php echo $_smarty_tpl->tpl_vars['REQ']->value->get('view');?>
"><?php $_smarty_tpl->_assignInScope('MODULE_MODEL', Vtiger_Module_Model::getInstance($_smarty_tpl->tpl_vars['MODULE']->value));
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
'><h4 class="module-title pull-left textOverflowEllipsis text-uppercase">&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;</h4></a><?php if ($_SESSION['lvs'][$_smarty_tpl->tpl_vars['MODULE']->value]['viewname']) {
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
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?><p class="current-filter-name filter-name pull-left cursorPointer" title="<?php echo $_smarty_tpl->tpl_vars['CVNAME']->value;?>
">&nbsp;<span class="fa fa-angle-right pull-left" aria-hidden="true"></span><a href='<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getListViewUrl();?>
&viewname=<?php echo $_smarty_tpl->tpl_vars['VIEWID']->value;?>
'>&nbsp;<?php echo $_smarty_tpl->tpl_vars['CVNAME']->value;?>
&nbsp;</a> </p><?php }
$_smarty_tpl->_assignInScope('SINGLE_MODULE_NAME', ('SINGLE_').($_smarty_tpl->tpl_vars['MODULE']->value));
if ((isset($_smarty_tpl->tpl_vars['RECORD']->value)) && $_smarty_tpl->tpl_vars['RECORD']->value && $_smarty_tpl->tpl_vars['REQ']->value->get('view') == 'Edit') {?><p class="current-filter-name filter-name pull-left "><span class="fa fa-angle-right pull-left" aria-hidden="true"></span><a title="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('label');?>
">&nbsp;<?php echo vtranslate('LBL_EDITING',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 : <?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('label');?>
&nbsp;</a></p><?php } elseif ($_smarty_tpl->tpl_vars['REQ']->value->get('view') == 'Edit') {?><p class="current-filter-name filter-name pull-left "><span class="fa fa-angle-right pull-left" aria-hidden="true"></span><a>&nbsp;<?php echo vtranslate('LBL_ADDING_NEW',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;</a></p><?php }
if ($_smarty_tpl->tpl_vars['REQ']->value->get('view') == 'Detail') {?><p class="current-filter-name filter-name pull-left"><span class="fa fa-angle-right pull-left" aria-hidden="true"></span><a title="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('label');?>
">&nbsp;<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('label');?>
&nbsp;</a></p><?php }?></div><div class="col-lg-5 col-md-5 pull-right "><div id="appnav" class="navbar-right"><ul class="nav navbar-nav"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MODULE_BASIC_ACTIONS']->value, 'BASIC_ACTION');
$_smarty_tpl->tpl_vars['BASIC_ACTION']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['BASIC_ACTION']->value) {
$_smarty_tpl->tpl_vars['BASIC_ACTION']->do_else = false;
if ($_smarty_tpl->tpl_vars['BASIC_ACTION']->value->getLabel() == 'LBL_ADD_RECORD') {?><li><div><button type="button" class="btn btn-default module-buttons dropdown-toggle" data-toggle="dropdown"><span class="fa fa-plus" title="<?php echo vtranslate('LBL_NEW_DOCUMENT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"></span>&nbsp;&nbsp;<?php echo vtranslate('LBL_NEW_DOCUMENT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<span class="caret"></span></button><ul class="dropdown-menu"><li class="dropdown-header"><i class="fa fa-upload"></i> <?php echo vtranslate('LBL_FILE_UPLOAD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</li><li id="VtigerAction"><a href="javascript:Documents_Index_Js.uploadTo('Vtiger')"><img style="  margin-top: -3px;margin-right: 4%;" title="Vtiger" alt="Vtiger" src="layouts/v7/skins//images/Vtiger.png"><?php ob_start();
echo vtranslate('LBL_VTIGER',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);
$_prefixVariable1 = ob_get_clean();
echo vtranslate('LBL_TO_SERVICE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_prefixVariable1);?>
</a></li><li role="separator" class="divider"></li><li class="dropdown-header"><i class="fa fa-link"></i> <?php echo vtranslate('LBL_LINK_EXTERNAL_DOCUMENT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</li><li id="shareDocument"><a href="javascript:Documents_Index_Js.createDocument('E')">&nbsp;<i class="fa fa-external-link"></i>&nbsp; <?php ob_start();
echo vtranslate('LBL_FILE_URL',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);
$_prefixVariable2 = ob_get_clean();
echo vtranslate('LBL_FROM_SERVICE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_prefixVariable2);?>
</a></li><li role="separator" class="divider"></li><li id="createDocument"><a href="javascript:Documents_Index_Js.createDocument('W')"><i class="fa fa-file-text"></i> <?php ob_start();
echo vtranslate('SINGLE_Documents',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);
$_prefixVariable3 = ob_get_clean();
echo vtranslate('LBL_CREATE_NEW',$_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_prefixVariable3);?>
</a></li></ul></div></li><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
if (smarty_modifier_count($_smarty_tpl->tpl_vars['MODULE_SETTING_ACTIONS']->value) > 0) {?><li><div class="settingsIcon"><button type="button" class="btn btn-default module-buttons dropdown-toggle" data-toggle="dropdown"><span class="fa fa-wrench" aria-hidden="true" title="<?php echo vtranslate('LBL_SETTINGS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"></span>&nbsp;<?php echo vtranslate('LBL_CUSTOMIZE','Reports');?>
&nbsp; <span class="caret"></span></button><ul class="detailViewSetting dropdown-menu"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MODULE_SETTING_ACTIONS']->value, 'SETTING');
$_smarty_tpl->tpl_vars['SETTING']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['SETTING']->value) {
$_smarty_tpl->tpl_vars['SETTING']->do_else = false;
ob_start();
echo vtranslate($_smarty_tpl->tpl_vars['SETTING']->value->getLabel());
$_prefixVariable4 = ob_get_clean();
if ($_prefixVariable4 == "%s Numbering") {?><li id="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
_listview_advancedAction_<?php echo $_smarty_tpl->tpl_vars['SETTING']->value->getLabel();?>
"><a href=<?php echo $_smarty_tpl->tpl_vars['SETTING']->value->getUrl();?>
><?php echo vtranslate($_smarty_tpl->tpl_vars['SETTING']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value,vtranslate($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value));?>
</a></li><?php } else { ?><li id="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
_listview_advancedAction_<?php echo $_smarty_tpl->tpl_vars['SETTING']->value->getLabel();?>
"><a href=<?php echo $_smarty_tpl->tpl_vars['SETTING']->value->getUrl();?>
><?php echo vtranslate($_smarty_tpl->tpl_vars['SETTING']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value,vtranslate("SINGLE_".((string)$_smarty_tpl->tpl_vars['MODULE_NAME']->value),$_smarty_tpl->tpl_vars['MODULE_NAME']->value));?>
</a></li><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></ul></div></li><?php }?></ul></div></div></div><?php if ($_smarty_tpl->tpl_vars['FIELDS_INFO']->value != null) {
echo '<script'; ?>
 type="text/javascript">var uimeta = (function() {var fieldInfo  = <?php echo $_smarty_tpl->tpl_vars['FIELDS_INFO']->value;?>
;return {field: {get: function(name, property) {if(name && property === undefined) {return fieldInfo[name];}if(name && property) {return fieldInfo[name][property]}},isMandatory : function(name){if(fieldInfo[name]) {return fieldInfo[name].mandatory;}return false;},getType : function(name){if(fieldInfo[name]) {return fieldInfo[name].type}return false;}}};})();<?php echo '</script'; ?>
><?php }?></div>
<?php }
}
