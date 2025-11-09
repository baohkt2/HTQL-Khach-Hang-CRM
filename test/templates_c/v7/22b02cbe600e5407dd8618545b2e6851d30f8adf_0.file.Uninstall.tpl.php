<?php
/* Smarty version 4.5.5, created on 2025-11-05 18:17:15
  from 'C:\xampp\htdocs\HTQL-Khach-Hang-CRM-vvan\layouts\v7\modules\Settings\ITS4YouInstaller\Uninstall.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690b94ab1abe09_93638310',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '22b02cbe600e5407dd8618545b2e6851d30f8adf' => 
    array (
      0 => 'C:\\xampp\\htdocs\\HTQL-Khach-Hang-CRM-vvan\\layouts\\v7\\modules\\Settings\\ITS4YouInstaller\\Uninstall.tpl',
      1 => 1762352656,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690b94ab1abe09_93638310 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="uninstallContainer" id="Uninstall_<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_Container" style="padding: 15px; background: #fff;"><form name="profiles_privilegies" action="index.php" method="post" class="form-horizontal"><input type="hidden" name="module" value="ITS4YouInstaller" /><input type="hidden" name="view" value="Uninstall" /><input type="hidden" name="license_key_val" id="license_key_val" value="<?php echo $_smarty_tpl->tpl_vars['LICENSE']->value;?>
" /><input type="hidden" id="sourceModule" name="source_module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
"><div class="row"><div class="col-sm-12 col-md-12 col-lg-12"><h3><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate('LBL_UNINSTALL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h3><hr></div></div><br><div class="row"><div class="col-sm-12 col-md-12 col-lg-12"><table class="table table-bordered table-condensed themeTableColor"><thead><tr class="blockHeader"><th class="mediumWidthType" colspan="2"><span class="alignMiddle"><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate('LBL_UNINSTALL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></th></tr></thead><tbody><tr><td><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_MODULE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td></tr><?php if ($_smarty_tpl->tpl_vars['VERSION']->value) {?><tr><td><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_MODULE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate('LBL_VERSION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td><?php echo $_smarty_tpl->tpl_vars['VERSION']->value;?>
</td></tr><?php }?><tr><td><label class="muted pull-right marginRight10px"><?php echo vtranslate('Vtiger',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate('LBL_VERSION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td><?php echo Vtiger_Version::current();?>
</td></tr><tr><td style="width: 25%"><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_URL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></td><td style="border-left: none;"><div class="pull-left" id="vatid_label"><?php echo vglobal('site_URL');?>
</div></td></tr><tr><td><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_DESCRIPTION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td><div class="clearfix"><div class="alert alert-danger displayInlineBlock"><?php echo vtranslate('LBL_UNINSTALL_DESC',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div></div></td></tr></tbody></table><div class="textAlignCenter"><button id="ITS4YouUninstall_btn" type="button" class="btn btn-danger marginLeftZero"><?php echo vtranslate('LBL_UNINSTALL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button></div></div></div></form></div><?php }
}
