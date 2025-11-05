<?php
/* Smarty version 4.5.5, created on 2025-11-05 07:55:34
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\ITS4YouInstaller\InstalledModules.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690b02f6155fe0_72962890',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '37bbf45333c4518bc2bd6e1436d3b0907746cd51' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\ITS4YouInstaller\\InstalledModules.tpl',
      1 => 1762329314,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690b02f6155fe0_72962890 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="tab-pane active" id="installedModules"><?php if ($_smarty_tpl->tpl_vars['ERROR_MESSAGES']->value) {?><div class="col-md-12"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ERROR_MESSAGES']->value, 'ERROR_MESSAGE');
$_smarty_tpl->tpl_vars['ERROR_MESSAGE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ERROR_MESSAGE']->value) {
$_smarty_tpl->tpl_vars['ERROR_MESSAGE']->do_else = false;
?><div><div class="displayInlineBlock alert alert-danger"><?php echo vtranslate($_smarty_tpl->tpl_vars['ERROR_MESSAGE']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div></div><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></div><?php } elseif (!$_smarty_tpl->tpl_vars['IS_AUTH']->value) {?><div style="text-align: center;"><a href="index.php?module=ITS4YouInstaller&parent=Settings&view=Login"><div class="alert alert-danger displayInlineBlock extensionLoginAlert"><?php echo vtranslate('LBL_LOGIN_TO_INSTALLER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div></a><br></div><?php } else { ?><div class="col-md-12"><h4><?php echo vtranslate('LBL_ACTIVATED_LICENSES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4><hr><div><button class="btn btn-primary activateButton" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<div class="displayInlineBlock"><?php echo vtranslate('LBL_ACTIVATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 <?php echo vtranslate('LBL_LICENSE_KEY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div></button>&nbsp;&nbsp;<button class="btn btn-default updateButton" type="button"><i class="fa fa-refresh"></i>&nbsp;&nbsp;<div class="displayInlineBlock"><?php echo vtranslate('LBL_UPDATE_LICENSES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div></button></div><br><table class="table table-bordered licenseTable"><thead><tr><th><?php echo vtranslate('LBL_LICENSE_KEY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><th><?php echo vtranslate('LBL_LICENSE_NAME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><th><?php echo vtranslate('LBL_LICENSE_DUE_DATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><th><?php echo vtranslate('LBL_LICENSE_TYPE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><th><?php echo vtranslate('LBL_ACTION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th></tr></thead><tbody><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LICENSES_LIST']->value, 'LICENSE', false, 'LICENSE_KEY');
$_smarty_tpl->tpl_vars['LICENSE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LICENSE_KEY']->value => $_smarty_tpl->tpl_vars['LICENSE']->value) {
$_smarty_tpl->tpl_vars['LICENSE']->do_else = false;
if (!$_smarty_tpl->tpl_vars['LICENSE']->value) {
continue 1;
}
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "rows/License.tpl",$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
if (!empty($_smarty_tpl->tpl_vars['EMPTY_LICENSES']->value)) {?><tr><td style="border-left:none;border-right:none;" colspan="4"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['EMPTY_LICENSES']->value, 'EMPTY_LICENSE');
$_smarty_tpl->tpl_vars['EMPTY_LICENSE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['EMPTY_LICENSE']->value) {
$_smarty_tpl->tpl_vars['EMPTY_LICENSE']->do_else = false;
?><div><?php echo $_smarty_tpl->tpl_vars['EMPTY_LICENSE']->value;?>
</div><br><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></td><td style="border-left:none;border-right:none;" title="<?php echo vtranslate('LBL_EMPTY_LICENSES_MESSAGE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"><form action="index.php" method="post"><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
"><input type="hidden" name="parent" value="Settings"><input type="hidden" name="action" value="Basic"><input type="hidden" name="mode" value="clearEmptyLicenses"><button class="btn btn-warning"><?php echo vtranslate('LBL_EMPTY_LICENSES_BUTTON',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</></form></td></tr><?php }?></tbody></table></div><?php if ($_smarty_tpl->tpl_vars['HOSTING_MODEL']->value) {?><div class="col-md-12"><h4><?php echo vtranslate('LBL_HOSTING',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4><hr><table class="table table-bordered hostingTable"><thead><tr><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['HOSTING_MODEL']->value->getHeaders(), 'HOSTING_HEADER', false, 'HOSTING_FIELD');
$_smarty_tpl->tpl_vars['HOSTING_HEADER']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['HOSTING_FIELD']->value => $_smarty_tpl->tpl_vars['HOSTING_HEADER']->value) {
$_smarty_tpl->tpl_vars['HOSTING_HEADER']->do_else = false;
?><th><?php echo vtranslate($_smarty_tpl->tpl_vars['HOSTING_HEADER']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?><th><?php echo vtranslate('LBL_ACTION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th></tr></thead><tbody><tr><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['HOSTING_MODEL']->value->getHeaders(), 'HOSTING_HEADER', false, 'HOSTING_FIELD');
$_smarty_tpl->tpl_vars['HOSTING_HEADER']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['HOSTING_FIELD']->value => $_smarty_tpl->tpl_vars['HOSTING_HEADER']->value) {
$_smarty_tpl->tpl_vars['HOSTING_HEADER']->do_else = false;
?><td><?php echo $_smarty_tpl->tpl_vars['HOSTING_MODEL']->value->get($_smarty_tpl->tpl_vars['HOSTING_FIELD']->value);?>
</td><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?><td><div class="pull-right"><?php if ($_smarty_tpl->tpl_vars['HOSTING_MODEL']->value->isExpired()) {?><div class="alert alert-danger displayInlineBlock" style="margin:0;"><?php echo vtranslate('LBL_HOSTING_INACTIVE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><?php } else { ?><div class="alert alert-info displayInlineBlock" style="margin:0;"><?php echo vtranslate('LBL_HOSTING_ACTIVE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
echo $_smarty_tpl->tpl_vars['HOSTING_MODEL']->value->getExpireString();?>
</div><?php }?></div></td></tr></tbody></table></div><?php }
}?><div class="col-md-12"><div><h4><?php echo vtranslate('LBL_MODULES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4><hr><div class="clearfix"><label class="pull-left searchModuleContainer"><i class="fa fa-search"></i><input type="text" class="inputElement searchModule" placeholder="<?php echo vtranslate('LBL_SEARCH_MODULES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></label></div><table class="table table-bordered extensionsTable"><thead><tr><th style="width: 30%;"><?php echo vtranslate('Name',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><th style="width: 10%;"><?php echo vtranslate('LBL_INSTALLED_VERSION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><th style="width: 10%;"><?php echo vtranslate('LBL_UPDATE_DATETIME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><th style="width: 10%;"><?php echo vtranslate('LBL_NEWEST_VERSION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><th><?php echo vtranslate('LBL_ACTION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th></tr></thead><tbody><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['EXTENSIONS_LIST']->value, 'EXTENSION');
$_smarty_tpl->tpl_vars['EXTENSION']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['EXTENSION']->value) {
$_smarty_tpl->tpl_vars['EXTENSION']->do_else = false;
if (!$_smarty_tpl->tpl_vars['EXTENSION']->value->isVisible()) {
continue 1;
}
if ($_smarty_tpl->tpl_vars['EXTENSION']->value->isMultiPackage()) {
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "rows/Package.tpl",$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
} else {
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "rows/Extension.tpl",$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tbody></table></div><div><h4><?php echo vtranslate('LBL_AVAILABLE_LANGUAGES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4><table class="table table-bordered"><thead><tr><th style="width: 30%;"><?php echo vtranslate('LBL_LANGUAGE_NAME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><th style="width: 30%;" colspan="2"><?php echo vtranslate('LBL_DESCRIPTION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><th><?php echo vtranslate('LBL_ACTION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th></tr></thead><tbody><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LANGUAGES_LIST']->value, 'LANGUAGE', false, NULL, 'languages', array (
));
$_smarty_tpl->tpl_vars['LANGUAGE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LANGUAGE']->value) {
$_smarty_tpl->tpl_vars['LANGUAGE']->do_else = false;
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "rows/Language.tpl",$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tbody></table></div></div></div><?php }
}
