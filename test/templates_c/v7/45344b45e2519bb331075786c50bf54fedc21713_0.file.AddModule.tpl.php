<?php
/* Smarty version 4.5.5, created on 2025-09-17 13:20:40
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Settings\MenuEditor\AddModule.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68cab5a8d0bb45_89938123',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '45344b45e2519bb331075786c50bf54fedc21713' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Settings\\MenuEditor\\AddModule.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68cab5a8d0bb45_89938123 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('APP_ARRAY', Vtiger_MenuStructure_Model::getAppMenuList());?><div class="modal-dialog modal-lg addModuleContainer"><div class="modal-content"><input id="appname" type="hidden" name="appname" value="<?php echo $_smarty_tpl->tpl_vars['SELECTED_APP_NAME']->value;?>
" /><div class="modal-header" ><div class="clearfix"><div class="pull-right"><button type="button" class="close" aria-label="Close" data-dismiss="modal" style="color: inherit;"><span aria-hidden="true" class='fa fa-close'></span></button></div><div class="btn-group"><?php $_smarty_tpl->_assignInScope('APP_SELECTED_LABEL', "LBL_SELECT_".((string)$_smarty_tpl->tpl_vars['SELECTED_APP_NAME']->value)."_MODULES");?><h4 class="pull-left textOverflowEllipsis" style="word-break: break-all;max-width: 95%;"><?php echo vtranslate($_smarty_tpl->tpl_vars['APP_SELECTED_LABEL']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;&nbsp;</h4></div></div></div><div class="modal-body form-horizontal"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['APP_ARRAY']->value, 'APP_NAME');
$_smarty_tpl->tpl_vars['APP_NAME']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['APP_NAME']->value) {
$_smarty_tpl->tpl_vars['APP_NAME']->do_else = false;
$_smarty_tpl->_assignInScope('HIDDEN_MODULES', Settings_MenuEditor_Module_Model::getHiddenModulesForApp($_smarty_tpl->tpl_vars['APP_NAME']->value));?><div class="row modulesContainer <?php if ($_smarty_tpl->tpl_vars['APP_NAME']->value != $_smarty_tpl->tpl_vars['SELECTED_APP_NAME']->value) {?> hide <?php }?>" data-appname="<?php echo $_smarty_tpl->tpl_vars['APP_NAME']->value;?>
"><div class="col-lg-12 col-md-12 col-sm-12"><?php if (php7_count($_smarty_tpl->tpl_vars['HIDDEN_MODULES']->value) > 0) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['HIDDEN_MODULES']->value, 'MODULE_NAME');
$_smarty_tpl->tpl_vars['MODULE_NAME']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['MODULE_NAME']->value) {
$_smarty_tpl->tpl_vars['MODULE_NAME']->do_else = false;
?><span class="btn-group" style="margin-bottom: 10px; margin-left: 25px; margin-right: -15px;"><buttton class="btn addButton btn-default module-buttons addModule" data-module="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
" style="text-transform: inherit;margin-right:15px"><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
&nbsp;&nbsp;<i class="fa fa-plus"></i></buttton></span><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
} else { ?><h5><center><?php echo vtranslate('LBL_NO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 <?php echo vtranslate('LBL_MODULES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 <?php echo vtranslate('LBL_FOUND',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
.</h4></center></h5><?php }?></div></div><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></div><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalFooter.tpl",$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></div></div><?php }
}
