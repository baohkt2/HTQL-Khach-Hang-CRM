<?php
/* Smarty version 4.5.5, created on 2025-10-19 18:06:23
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\ExtensionStore\ExtensionModules.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68f5289fcaa2f3_94820741',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0535c05871f78758e99710156c037ed09e862071' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\ExtensionStore\\ExtensionModules.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68f5289fcaa2f3_94820741 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\vtigercrm\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.truncate.php','function'=>'smarty_modifier_truncate',),));
?>

<div class="row"><?php $_smarty_tpl->_assignInScope('IS_AUTH', ($_smarty_tpl->tpl_vars['REGISTRATION_STATUS']->value && $_smarty_tpl->tpl_vars['PASSWORD_STATUS']->value));
$_smarty_tpl->_assignInScope('EXTENSIONS_COUNT', 0);
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['EXTENSIONS_LIST']->value, 'EXTENSION', false, NULL, 'extensions', array (
));
$_smarty_tpl->tpl_vars['EXTENSION']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['EXTENSION']->value) {
$_smarty_tpl->tpl_vars['EXTENSION']->do_else = false;
if (!$_smarty_tpl->tpl_vars['EXTENSION']->value->isVtigerCompatible()) {
continue 1;
}
$_smarty_tpl->_assignInScope('EXTENSIONS_COUNT', $_smarty_tpl->tpl_vars['EXTENSIONS_COUNT']->value+1);
if ($_smarty_tpl->tpl_vars['EXTENSION']->value->isAlreadyExists()) {
$_smarty_tpl->_assignInScope('EXTENSION_MODULE_MODEL', $_smarty_tpl->tpl_vars['EXTENSION']->value->get('moduleModel'));
} else {
$_smarty_tpl->_assignInScope('EXTENSION_MODULE_MODEL', 'false');
}
$_smarty_tpl->_assignInScope('IS_FREE', (($_smarty_tpl->tpl_vars['EXTENSION']->value->get('price') == 'Free') || ($_smarty_tpl->tpl_vars['EXTENSION']->value->get('price') == 0)));?><div class="col-lg-4 col-md-6 col-sm-6 " style="margin-bottom:10px;"><div class="extension_container extensionWidgetContainer"><div class="extension_header"><div class="font-x-x-large boxSizingBorderBox"><?php echo vtranslate($_smarty_tpl->tpl_vars['EXTENSION']->value->get('label'),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><input type="hidden" name="extensionName" value="<?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->get('name');?>
" /><input type="hidden" name="extensionUrl" value="<?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->get('downloadURL');?>
" /><input type="hidden" name="moduleAction" value="<?php if (($_smarty_tpl->tpl_vars['EXTENSION']->value->isAlreadyExists()) && (!$_smarty_tpl->tpl_vars['EXTENSION_MODULE_MODEL']->value->get('trial'))) {
if ($_smarty_tpl->tpl_vars['EXTENSION']->value->isUpgradable()) {?>Upgrade<?php } else { ?>Installed<?php }
} else { ?>Install<?php }?>" /><input type="hidden" name="extensionId" value="<?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->get('id');?>
" /></div><div style="padding-left:3px;"><div class="row extension_contents" style="border:none;"><div class="col-sm-8 col-xs-8"><div class="row extensionDescription" style="word-wrap:break-word;margin: 0px;"><?php $_smarty_tpl->_assignInScope('SUMMARY', $_smarty_tpl->tpl_vars['EXTENSION']->value->get('summary'));
if (empty($_smarty_tpl->tpl_vars['SUMMARY']->value)) {
ob_start();
echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['EXTENSION']->value->get('description'),100);
$_prefixVariable1 = ob_get_clean();
$_smarty_tpl->_assignInScope('SUMMARY', $_prefixVariable1);
}
echo $_smarty_tpl->tpl_vars['SUMMARY']->value;?>
</div></div><div class="col-sm-4 col-xs-4"><?php if ($_smarty_tpl->tpl_vars['EXTENSION']->value->get('thumbnailURL') != NULL) {
$_smarty_tpl->_assignInScope('imageSource', $_smarty_tpl->tpl_vars['EXTENSION']->value->get('thumbnailURL'));?><img width="100%" height="100%" class="thumbnailImage" src="<?php echo $_smarty_tpl->tpl_vars['imageSource']->value;?>
"/><?php } else { ?><i class="fa fa-picture-o" style="color:#ddd;font-size: 90px;" title="Image not available"></i><?php }?></div></div><div class="extensionInfo"><div class="row"><?php $_smarty_tpl->_assignInScope('ON_RATINGS', $_smarty_tpl->tpl_vars['EXTENSION']->value->get('avgrating'));?><div class="col-sm-5 col-xs-5"><span class="rating" data-score="<?php echo $_smarty_tpl->tpl_vars['ON_RATINGS']->value;?>
" data-readonly=true></span><span><?php if ($_smarty_tpl->tpl_vars['EXTENSION']->value->get('avgrating')) {?>&nbsp;(<?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->get('avgrating');?>
)<?php }?></span></div><div class="col-sm-7 col-xs-7"><div class="pull-right"><?php if ($_smarty_tpl->tpl_vars['EXTENSION']->value->isVtigerCompatible()) {?><button class="btn btn-sm btn-default installExtension addButton" style="margin-right:5px;"><?php echo vtranslate('LBL_MORE_DETAILS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button><?php if ($_smarty_tpl->tpl_vars['EXTENSION']->value->isAlreadyExists()) {
if (($_smarty_tpl->tpl_vars['EXTENSION']->value->isUpgradable())) {?><button class="oneclickInstallFree btn btn-success btn-sm margin0px <?php if ($_smarty_tpl->tpl_vars['IS_AUTH']->value) {?>authenticated <?php } else { ?> loginRequired<?php }?>"><?php echo vtranslate('LBL_UPGRADE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button><?php } else {
if ($_smarty_tpl->tpl_vars['EXTENSION_MODULE_MODEL']->value != 'false' && $_smarty_tpl->tpl_vars['EXTENSION_MODULE_MODEL']->value->get('trial')) {?><span class="alert alert-info"><?php echo vtranslate('LBL_TRIAL_INSTALLED',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><?php } else { ?><span class="alert alert-info" style="vertical-align:middle; padding: 3px 8px;"><?php echo vtranslate('LBL_INSTALLED',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><?php }
if (!($_smarty_tpl->tpl_vars['EXTENSION']->value->get('price') == 'Free' || $_smarty_tpl->tpl_vars['EXTENSION']->value->get('price') == 0)) {?>&nbsp;&nbsp;<button class="oneclickInstallPaid btn btn-info <?php if ($_smarty_tpl->tpl_vars['IS_AUTH']->value) {?>authenticated <?php } else { ?> loginRequired<?php }?>" data-trial=<?php if ($_smarty_tpl->tpl_vars['EXTENSION']->value->get('trialdays') > 0) {?>true<?php } else { ?>false<?php }?>><?php echo vtranslate('LBL_BUY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
$<?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->get('price');?>
</button><?php }
}
} else {
if ($_smarty_tpl->tpl_vars['EXTENSION']->value->get('price') == 'Free' || $_smarty_tpl->tpl_vars['EXTENSION']->value->get('price') == 0) {?><button class="oneclickInstallFree btn btn-success btn-sm <?php if ($_smarty_tpl->tpl_vars['IS_AUTH']->value) {?>authenticated <?php } else { ?> loginRequired<?php }?>"><?php echo vtranslate('LBL_INSTALL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button><?php } else { ?><button class="oneclickInstallPaid btn btn-info btn-sm <?php if ($_smarty_tpl->tpl_vars['IS_AUTH']->value) {?>authenticated <?php } else { ?> loginRequired<?php }?>" data-trial=false><?php echo vtranslate('LBL_BUY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
$<?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->get('price');?>
</button><?php }
}
} else { ?><span class="alert alert-error"><?php echo vtranslate('LBL_EXTENSION_NOT_COMPATABLE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><?php }?></div></div></div></div></div></div></div><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
if (empty($_smarty_tpl->tpl_vars['EXTENSIONS_LIST']->value) || $_smarty_tpl->tpl_vars['EXTENSIONS_COUNT']->value == 0) {?><div class="row"><div class="col-sm-2 col-xs-2"></div><div class="col-sm-8 col-xs-8"><br><br><br><h3><center> <?php echo vtranslate('LBL_NO_EXTENSIONS_FOUND',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 </center></h3></div><div class="col-sm-2 col-xs-2"></div></div><?php }?></div><?php }
}
