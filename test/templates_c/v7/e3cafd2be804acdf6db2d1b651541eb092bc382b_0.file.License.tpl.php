<?php
/* Smarty version 4.5.5, created on 2025-11-05 04:54:42
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\ITS4YouInstaller\License.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690ad892ef8ac6_81837500',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e3cafd2be804acdf6db2d1b651541eb092bc382b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\ITS4YouInstaller\\License.tpl',
      1 => 1762116567,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690ad892ef8ac6_81837500 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="licenseContainer" style="padding: 15px; background: #fff;"><div><div class="row"><div class="col-sm-12 col-md-12 col-lg-12"><h3><?php echo vtranslate('LBL_MODULE_NAME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 <?php echo vtranslate('LBL_LICENSE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h3><hr></div></div><div class="row"><div class="col-sm-12 col-md-12 col-lg-12"><br><table class="table table-bordered table-condensed themeTableColor"><thead><tr class="blockHeader"><th colspan="2" class="mediumWidthType"><span class="alignMiddle"><?php echo vtranslate('LBL_MODULE_NAME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 <?php echo vtranslate('LBL_LICENSE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></th></tr></thead><tbody><tr><td style="width: 25%"><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_MODULE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></td><td style="border-left: none;"><div class="pull-left" id="vatid_label"><a href="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getDefaultUrl();?>
"><?php echo vtranslate('LBL_MODULE_NAME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a></div></td></tr><?php if ($_smarty_tpl->tpl_vars['VERSION']->value) {?><tr><td><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_MODULE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate('LBL_VERSION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td><?php echo $_smarty_tpl->tpl_vars['VERSION']->value;?>
</td></tr><?php }?><tr><td><label class="muted pull-right marginRight10px"><?php echo vtranslate('Vtiger',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate('LBL_VERSION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td><?php echo Vtiger_Version::current();?>
</td></tr><tr><td style="width: 25%"><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_URL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></td><td style="border-left: none;"><div class="pull-left" id="vatid_label"><?php echo $_smarty_tpl->tpl_vars['URL']->value;?>
</div></td></tr><tr><td style="width: 25%"><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_DESCRIPTION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></td><td style="border-left: none;"><div class="clearfix"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ERRORS']->value, 'ERROR');
$_smarty_tpl->tpl_vars['ERROR']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ERROR']->value) {
$_smarty_tpl->tpl_vars['ERROR']->do_else = false;
?><div><div class="alert alert-danger displayInlineBlock"><?php echo vtranslate($_smarty_tpl->tpl_vars['ERROR']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div></div><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['INFO']->value, 'I');
$_smarty_tpl->tpl_vars['I']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['I']->value) {
$_smarty_tpl->tpl_vars['I']->do_else = false;
?><div><div class="alert alert-warning displayInlineBlock"><?php echo vtranslate($_smarty_tpl->tpl_vars['I']->value,'Settings:ITS4YouInstaller');?>
</div></div><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
if (empty($_smarty_tpl->tpl_vars['INFO']->value) && empty($_smarty_tpl->tpl_vars['ERRORS']->value)) {
if ($_smarty_tpl->tpl_vars['IS_ALLOWED']->value) {?><div class="alert alert-info displayInlineBlock"><?php echo vtranslate('LBL_LICENSE_ACTIVE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><?php } else { ?><div class="alert alert-danger displayInlineBlock"><?php echo vtranslate('LBL_LICENSE_INACTIVE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><?php }
}?></div></td></tr></tbody></table><div style="text-align: center"><?php if ($_smarty_tpl->tpl_vars['INSTALLER_MODEL']->value) {?><a href="<?php echo $_smarty_tpl->tpl_vars['INSTALLER_MODEL']->value->getDefaultUrl();?>
" target="_blank" class="btn btn-primary"><?php echo vtranslate('LBL_LICENSE_MANAGE','Settings:ITS4YouInstaller');?>
</a><?php } else { ?><a target="_blank" href="https://www.its4you.sk/en/vtiger-shop" class="btn btn-danger" type="button"><?php echo vtranslate('LBL_DOWNLOAD_INSTALLER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a><?php }?></div></div></div></div></div><?php }
}
