<?php
/* Smarty version 4.5.5, created on 2025-11-05 18:17:43
  from 'C:\xampp\htdocs\HTQL-Khach-Hang-CRM-vvan\layouts\v7\modules\Settings\ITS4YouInstaller\InstallationLog.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690b94c7a4ef79_11159076',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '225f40433fdddfe4d572fc99af3d7f9b2274fc78' => 
    array (
      0 => 'C:\\xampp\\htdocs\\HTQL-Khach-Hang-CRM-vvan\\layouts\\v7\\modules\\Settings\\ITS4YouInstaller\\InstallationLog.tpl',
      1 => 1762352656,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690b94c7a4ef79_11159076 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="modal-dialog modal-lg installationLog"><div class='modal-content'><div class="modal-header" style="background: #596875;color:white;"><div class="pull-right " ><button type="button" class="close" aria-label="Close" data-dismiss="modal"><span aria-hidden="true" class='fa fa-close'></span></button></div><div class="row"><div class="col-lg-11 col-md-11"><?php if ($_smarty_tpl->tpl_vars['ERROR']->value) {?><input type="hidden" name="installationStatus" value="error" /><h3 class="modal-title" style="color: red"><?php if ($_smarty_tpl->tpl_vars['MODULE_ACTION']->value == "Upgrade") {
echo vtranslate('LBL_UPGRADE_FAILED',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
} else {
echo vtranslate('LBL_INSTALLATION_FAILED',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
}?></h3><?php } else { ?><input type="hidden" name="installationStatus" value="success" /><h3 class="modal-title"><?php if ('Upgrade' == $_smarty_tpl->tpl_vars['MODULE_ACTION']->value) {
echo vtranslate('LBL_UPGRADE_INFORMATION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
} else {
echo vtranslate('LBL_INSTALL_INFORMATION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
}?></h3><?php }?></div></div></div><div class="modal-body" id="installationLog"><h3><?php if ($_smarty_tpl->tpl_vars['MODULE_ACTION']->value == "Upgrade") {
echo vtranslate('LBL_UPGRADE_LOG',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
} else {
echo vtranslate('LBL_INSTALLATION_LOG',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
}?></h3><div id="extensionInstallationInfo" class="backgroundImageNone" style="background-color: white;"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ERRORS']->value, 'ERROR');
$_smarty_tpl->tpl_vars['ERROR']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ERROR']->value) {
$_smarty_tpl->tpl_vars['ERROR']->do_else = false;
?><h4><?php echo vtranslate($_smarty_tpl->tpl_vars['ERROR']->value['EXTENSION'],$_smarty_tpl->tpl_vars['ERROR']->value['EXTENSION']);?>
</h4><p style="color:red;"><?php echo vtranslate($_smarty_tpl->tpl_vars['ERROR']->value['message'],$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</p><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['EXTENSIONS']->value, 'EXTENSION');
$_smarty_tpl->tpl_vars['EXTENSION']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['EXTENSION']->value) {
$_smarty_tpl->tpl_vars['EXTENSION']->do_else = false;
?><h4><?php echo vtranslate($_smarty_tpl->tpl_vars['EXTENSION']->value->getName(),$_smarty_tpl->tpl_vars['EXTENSION']->value->getName());?>
</h4><?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->installExtension();
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></div></div><div class="modal-footer"><span class="pull-right"><button class="btn btn-success" id="importCompleted" onclick="location.reload()"><?php echo vtranslate('LBL_OK',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button></span></div></div></div><?php }
}
