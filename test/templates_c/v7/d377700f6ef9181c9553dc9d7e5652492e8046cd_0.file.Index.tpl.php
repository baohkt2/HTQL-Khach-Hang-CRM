<?php
/* Smarty version 4.5.5, created on 2025-09-30 09:04:57
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\CustomerPortal\Index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68db9d391683f8_02653424',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd377700f6ef9181c9553dc9d7e5652492e8046cd' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\CustomerPortal\\Index.tpl',
      1 => 1758006176,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68db9d391683f8_02653424 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="listViewPageDiv" id="listViewContent"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><br><form id="customerPortalForm" name="customerPortalForm" action="index.php" method="POST" class="form-horizontal"><input type="hidden" name="portalModulesInfo" value="" /><div class="col-sm-12 col-xs-12 input-group"><div class="form-group"><label for="defaultAssignee" class="col-sm-4 control-label fieldLabel"><span><?php echo vtranslate('LBL_DEFAULT_ASSIGNEE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></label><div class="fieldValue col-lg-3 col-md-3 col-sm-3 input-group"><select name="defaultAssignee" class="select2 inputElement"><optgroup label="<?php echo vtranslate('LBL_USERS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" ><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['USER_MODELS']->value, 'USER_MODEL');
$_smarty_tpl->tpl_vars['USER_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['USER_MODEL']->value) {
$_smarty_tpl->tpl_vars['USER_MODEL']->do_else = false;
$_smarty_tpl->_assignInScope('USER_ID', $_smarty_tpl->tpl_vars['USER_MODEL']->value->getId());?><option value="<?php echo $_smarty_tpl->tpl_vars['USER_ID']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['CURRENT_DEFAULT_ASSIGNEE']->value == $_smarty_tpl->tpl_vars['USER_ID']->value) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->getName();?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></optgroup><optgroup label="<?php echo vtranslate('LBL_GROUPS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['GROUP_MODELS']->value, 'GROUP_MODEL');
$_smarty_tpl->tpl_vars['GROUP_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['GROUP_MODEL']->value) {
$_smarty_tpl->tpl_vars['GROUP_MODEL']->do_else = false;
$_smarty_tpl->_assignInScope('GROUP_ID', $_smarty_tpl->tpl_vars['GROUP_MODEL']->value->getId());?><option value="<?php echo $_smarty_tpl->tpl_vars['GROUP_ID']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['CURRENT_DEFAULT_ASSIGNEE']->value == $_smarty_tpl->tpl_vars['GROUP_ID']->value) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['GROUP_MODEL']->value->getName();?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></optgroup></select><div class="input-group-addon input-select-addon"><a href="#" rel="tooltip" title="<?php echo vtranslate('LBL_DEFAULT_ASSIGNEE_MESSAGE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"><i class="fa fa-info-circle"></i></a></div></div></div></div><div class="col-sm-12 col-xs-12 input-group"><div class="form-group"><label for="portal-url" class="col-sm-4 control-label fieldLabel"><?php echo vtranslate('LBL_PORTAL_URL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label><div class="col-sm-5"><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['PORTAL_URL']->value;?>
" class="help-inline" style="width: 300px;color:blue;"><?php echo $_smarty_tpl->tpl_vars['PORTAL_URL']->value;?>
</a><div class="pull-left input-group-addon input-select-addon"><a href="#" rel="tooltip" title="<?php echo vtranslate('LBL_PORTAL_URL_MESSAGE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"><i class="fa fa-info-circle"></i></a></div></div></div></div><br><br><div class="row" style="margin-bottom: 100px;"><div class="col-sm-3 paddingRight0"><ul class="nav nav-tabs nav-stacked cp-nav-header-wrapper" ><li class="disabled unsortable portalMenuHeader" data-sequence="1" data-module="Dashboard"><a class="cp-nav-header"><?php echo vtranslate('LBL_LAYOUT_HEADER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a></li></ul><ul class="nav nav-tab nav-stacked" id="portalModulesTable"><li class="portalModuleRow active unsortable cp-modules-home" data-id="" data-sequence="1" data-module="Dashboard"><a href="javascript:void(0);"><strong class="portal-home-module"><?php echo vtranslate('LBL_HOME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></a></li><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MODULES_MODELS']->value, 'MODEL', false, 'TAB_ID', 'moduleModels', array (
  'last' => true,
  'iteration' => true,
  'total' => true,
));
$_smarty_tpl->tpl_vars['MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['TAB_ID']->value => $_smarty_tpl->tpl_vars['MODEL']->value) {
$_smarty_tpl->tpl_vars['MODEL']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_moduleModels']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_moduleModels']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_moduleModels']->value['iteration'] === $_smarty_tpl->tpl_vars['__smarty_foreach_moduleModels']->value['total'];
$_smarty_tpl->_assignInScope('MODULE_NAME', $_smarty_tpl->tpl_vars['MODEL']->value->get('name'));?><li class="portalModuleRow bgColor cp-tabs" <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_moduleModels']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_moduleModels']->value['last'] : null)) {?> style="border-color: #ddd; border-image: none; border-style: solid; border-width: 0 0 1px 1px;"<?php }?>data-id="<?php echo $_smarty_tpl->tpl_vars['TAB_ID']->value;?>
" data-sequence="<?php echo $_smarty_tpl->tpl_vars['MODEL']->value->get('sequence');?>
"data-module="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
"><input type="hidden" name="portalModulesInfo[<?php echo $_smarty_tpl->tpl_vars['TAB_ID']->value;?>
][sequence]" value="<?php echo $_smarty_tpl->tpl_vars['MODEL']->value->get('sequence');?>
" /><a href="javascript:void(0);" class="cp-modules" style="width:100%;"><span class="checkbox"><img class="drag-portal-module" src="layouts/v7/resources/Images/drag.png" border="0" title="Drag And Drop To Reorder Portal Menu In Customer Portal"/>&nbsp;&nbsp;<input class="enabledModules portal-module-name" name='<?php echo $_smarty_tpl->tpl_vars['TAB_ID']->value;?>
' type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['MODEL']->value->get('visible');?>
" <?php if ($_smarty_tpl->tpl_vars['MODEL']->value->get('visible')) {?>checked<?php }?> />&nbsp;&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</span></a></li><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></ul></div><div class="col-sm-9 portal-dashboard"><div id="dashboardContent" class="show" ><h4><?php echo vtranslate('LBL_HOME_LAYOUT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4><hr class="hrHeader"><input type="hidden" name="defaultWidgets" value='<?php echo Vtiger_Functions::jsonEncode($_smarty_tpl->tpl_vars['WIDGETS']->value,true);?>
'/><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( 'CustomerPortalDashboard.tpl',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></div><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MODULES_MODELS']->value, 'MODEL', false, 'TAB_ID');
$_smarty_tpl->tpl_vars['MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['TAB_ID']->value => $_smarty_tpl->tpl_vars['MODEL']->value) {
$_smarty_tpl->tpl_vars['MODEL']->do_else = false;
?><div id="fieldContent_<?php echo $_smarty_tpl->tpl_vars['MODEL']->value->get('name');?>
" class="hide"><?php echo $_smarty_tpl->tpl_vars['MODEL']->value->get('name');?>
</div><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></div><div class="textAlignCenter col-lg-12 col-md-12 col-sm-12"><button type="submit" class="btn btn-success saveButton pull-right" id="savePortalInfo" name="savePortalInfo" type="submit" disabled><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button>&nbsp;&nbsp;</div></div></form></div></div>
<?php }
}
