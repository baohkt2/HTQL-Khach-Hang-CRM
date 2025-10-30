<?php
/* Smarty version 4.5.5, created on 2025-10-10 08:40:02
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\RecycleBin\ModuleHeader.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e8c6629e7070_90547079',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1aef57448329bcdad3e2a4a682e7dc508c423460' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\RecycleBin\\ModuleHeader.tpl',
      1 => 1758006195,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e8c6629e7070_90547079 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="col-sm-12 col-xs-12 module-action-bar clearfix coloredBorderTop"><div class="module-action-content clearfix"><span class="col-lg-7 col-md-7 module-breadcrumb module-breadcrumb-<?php echo $_smarty_tpl->tpl_vars['REQ']->value->get('view');?>
"><span><h4 title="<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="module-title pull-left text-uppercase">&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;</h4></span><span><p class="current-filter-name pull-left"><span class="fa fa-angle-right" aria-hidden="true"></span>&nbsp;<?php echo $_smarty_tpl->tpl_vars['VIEW']->value;?>
&nbsp;</p></span><span><p class="current-filter-name pull-left textOverflowEllipsis" style="width:250px;"><span class="fa fa-angle-right" aria-hidden="true"></span>&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['SOURCE_MODULE']->value,$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
&nbsp;</p></span></span></div><?php if ($_smarty_tpl->tpl_vars['FIELDS_INFO']->value != null) {
echo '<script'; ?>
 type="text/javascript">var uimeta = (function () {var fieldInfo = <?php echo $_smarty_tpl->tpl_vars['FIELDS_INFO']->value;?>
;return {field: {get: function (name, property) {if (name && property === undefined) {return fieldInfo[name];}if (name && property) {return fieldInfo[name][property]}},isMandatory: function (name) {if (fieldInfo[name]) {return fieldInfo[name].mandatory;}return false;},getType: function (name) {if (fieldInfo[name]) {return fieldInfo[name].type}return false;}}};})();<?php echo '</script'; ?>
><?php }?></div><?php }
}
