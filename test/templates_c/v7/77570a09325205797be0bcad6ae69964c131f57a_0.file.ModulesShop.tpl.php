<?php
/* Smarty version 4.5.5, created on 2025-11-05 18:16:30
  from 'C:\xampp\htdocs\HTQL-Khach-Hang-CRM-vvan\layouts\v7\modules\Settings\ITS4YouInstaller\ModulesShop.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690b947e9e6399_72993345',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '77570a09325205797be0bcad6ae69964c131f57a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\HTQL-Khach-Hang-CRM-vvan\\layouts\\v7\\modules\\Settings\\ITS4YouInstaller\\ModulesShop.tpl',
      1 => 1762352656,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690b947e9e6399_72993345 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="tab-pane col-lg-12" id="modulesShop"><div class="clearfix"><div class="grid-container-block-3"><div class="grid-container-3"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['PACKAGES_LIST']->value, 'PACKAGE', false, NULL, 'packages', array (
));
$_smarty_tpl->tpl_vars['PACKAGE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['PACKAGE']->value) {
$_smarty_tpl->tpl_vars['PACKAGE']->do_else = false;
if ($_smarty_tpl->tpl_vars['PACKAGE']->value->get('inshop') != "1") {
continue 1;
}?><div class="grid-container-div-3"><div class="thumbnail extension_container extensionWidgetContainer padding10"><div class="contentHeader"><div style="margin-bottom: 5px;"><div class="extension_header"><div class="font-x-x-large boxSizingBorderBox" style="text-align: center;"><?php echo vtranslate($_smarty_tpl->tpl_vars['PACKAGE']->value->get('label'),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div></div></div></div><?php if ($_smarty_tpl->tpl_vars['PACKAGE']->value->get('thumbnailURLTop') != NULL) {
$_smarty_tpl->_assignInScope('imageSource', $_smarty_tpl->tpl_vars['PACKAGE']->value->get('thumbnailURLTop'));?><img src="<?php echo $_smarty_tpl->tpl_vars['imageSource']->value;?>
" class="thumbnailImage"/><?php }
if ($_smarty_tpl->tpl_vars['PACKAGE']->value->get('description') != '') {?><div class="caption"><div class="font-x-x-large boxSizingBorderBox"><div style="text-align: center;"><strong><?php echo $_smarty_tpl->tpl_vars['PACKAGE']->value->get('description');?>
</strong></div></div></div><?php }
if ($_smarty_tpl->tpl_vars['PACKAGE']->value->get('thumbnailURLCenterA') != NULL) {
$_smarty_tpl->_assignInScope('imageSource', $_smarty_tpl->tpl_vars['PACKAGE']->value->get('thumbnailURLCenterA'));?><img src="<?php echo $_smarty_tpl->tpl_vars['imageSource']->value;?>
" class="thumbnailImage"/><?php }?><div><div class="col-lg-12 col-md-12 col-sm-12" style="text-align: center;"><a href="<?php echo $_smarty_tpl->tpl_vars['SHOP_LINK']->value;?>
?q=true&addidtob=<?php echo $_smarty_tpl->tpl_vars['PACKAGE']->value->get('bid');?>
"><h2 class="summaryCount" style="padding:0px;margin:0px"><?php echo $_smarty_tpl->tpl_vars['PACKAGE']->value->get('price');
echo $_smarty_tpl->tpl_vars['PACKAGE']->value->get('currency_symbol');?>
</h2></a></div></div><br><?php if ($_smarty_tpl->tpl_vars['PACKAGE']->value->get('thumbnailURLCenterB') != NULL) {
$_smarty_tpl->_assignInScope('imageSource', $_smarty_tpl->tpl_vars['PACKAGE']->value->get('thumbnailURLCenterB'));?><img src="<?php echo $_smarty_tpl->tpl_vars['imageSource']->value;?>
" class="thumbnailImage"/><?php }?><div class="caption"><hr><div class="font-x-x-large boxSizingBorderBox"><?php echo $_smarty_tpl->tpl_vars['PACKAGE']->value->getMoreInfo();?>
</div><?php if ($_smarty_tpl->tpl_vars['PACKAGE']->value->get('thumbnailURLBottom') != NULL) {
$_smarty_tpl->_assignInScope('imageSource', $_smarty_tpl->tpl_vars['PACKAGE']->value->get('thumbnailURLBottom'));?><div style="text-align: center;"><img src="<?php echo $_smarty_tpl->tpl_vars['imageSource']->value;?>
" class="thumbnailImage"/></div><?php }?><br><div class="row" style="padding: 10px 0 5px 0"><div class="col-md-12" style="text-align: right;"><span><?php if (!$_smarty_tpl->tpl_vars['PACKAGE']->value->isRegisteredUser()) {?><button class="m0550 btn btn-secondary logintoInstaller" type="button"><?php echo vtranslate('LBL_TRIAL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button><?php } elseif ($_smarty_tpl->tpl_vars['PACKAGE']->value->isTrialReady()) {?><button class="m0550 btn btn-warning trialButton" data-trial="<?php echo $_smarty_tpl->tpl_vars['PACKAGE']->value->get('id');?>
"><?php echo vtranslate('LBL_TRIAL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button><?php } else { ?><button class="m0550 btn btn-warning" disabled type="button"><?php echo vtranslate('LBL_TRIAL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button><?php }
if ($_smarty_tpl->tpl_vars['PACKAGE']->value->get('price') != 'Free' && $_smarty_tpl->tpl_vars['PACKAGE']->value->get('price') != 0 && $_smarty_tpl->tpl_vars['PACKAGE']->value->get('bid') != '') {?><button class="m0550 btn btn-success  buyButton" data-url="<?php echo $_smarty_tpl->tpl_vars['SHOP_LINK']->value;?>
?q=true&addidtob=<?php echo $_smarty_tpl->tpl_vars['PACKAGE']->value->get('bid');?>
" data-trial=false><?php echo vtranslate('LBL_BUY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
echo $_smarty_tpl->tpl_vars['PACKAGE']->value->get('price');
echo $_smarty_tpl->tpl_vars['PACKAGE']->value->get('currency_symbol');?>
</button><?php }
if ($_smarty_tpl->tpl_vars['PACKAGE']->value->get('website') != '') {?><button class="m0550 btn installExtension addButton" style="margin-right:5px;" data-url="<?php echo $_smarty_tpl->tpl_vars['PACKAGE']->value->get('website');?>
"><?php echo vtranslate('LBL_MORE_DETAILS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button><?php }?></span></div></div></div></div></div class="grid-container-div"><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></div></div></div><div class="clearfix"><div class="grid-container-block"><div class="grid-container grid-columns-4"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['EXTENSIONS_LIST']->value, 'EXTENSION', false, NULL, 'extensions', array (
));
$_smarty_tpl->tpl_vars['EXTENSION']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['EXTENSION']->value) {
$_smarty_tpl->tpl_vars['EXTENSION']->do_else = false;
if (!$_smarty_tpl->tpl_vars['EXTENSION']->value->isVtigerCompatible() || $_smarty_tpl->tpl_vars['EXTENSION']->value->get('inshop') != '1') {
continue 1;
}?><div class="grid-container-div"><div class="thumbnail extension_container extensionWidgetContainer"><div class="contentHeader" style="margin-bottom: 10px;"><div class="col-sm-12 col-xs-12" style="margin-bottom: 5px;"><div style="margin-bottom: 5px;"><div class="extension_header"><div class="font-x-x-large boxSizingBorderBox"><?php echo vtranslate($_smarty_tpl->tpl_vars['EXTENSION']->value->get('label'),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><input type="hidden" name="extensionName" value="<?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->get('name');?>
" /><input type="hidden" name="extensionUrl" value="<?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->get('downloadURL');?>
" /><input type="hidden" name="moduleAction" value="<?php if (($_smarty_tpl->tpl_vars['EXTENSION']->value->isAlreadyExists())) {
if ($_smarty_tpl->tpl_vars['EXTENSION']->value->isUpgradable()) {?>Upgrade<?php } else { ?>Installed<?php }
} else { ?>Install<?php }?>" /><input type="hidden" name="extensionId" value="<?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->get('id');?>
" /></div></div></div></div><?php if (NULL != $_smarty_tpl->tpl_vars['EXTENSION']->value->get('thumbnailURL')) {
$_smarty_tpl->_assignInScope('imageSource', $_smarty_tpl->tpl_vars['EXTENSION']->value->get('thumbnailURL'));?><img src="<?php echo $_smarty_tpl->tpl_vars['imageSource']->value;?>
" class="thumbnailImage"/><?php }?><div class="caption extensionDescription" ><div class="font-x-x-large boxSizingBorderBox"><?php if ('' != $_smarty_tpl->tpl_vars['EXTENSION']->value->get('description')) {
echo $_smarty_tpl->tpl_vars['EXTENSION']->value->get('description');
}?></div><br><div class="row"><div class="col-md-12" style="text-align: right"><span><?php if ($_smarty_tpl->tpl_vars['EXTENSION']->value->isExtensionTrialReady()) {?><button class="m0550 btn btn-warning trialButton" data-trial="<?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->get('id');?>
"><?php echo vtranslate('LBL_TRIAL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button><?php }
if ('Free' != $_smarty_tpl->tpl_vars['EXTENSION']->value->get('price') || 0 != $_smarty_tpl->tpl_vars['EXTENSION']->value->get('price')) {?><button class="m0550 btn btn-success  buyButton" data-url="<?php echo $_smarty_tpl->tpl_vars['SHOP_LINK']->value;?>
?addidtob=<?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->get('bid');?>
" data-trial=false><?php echo vtranslate('LBL_BUY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
echo $_smarty_tpl->tpl_vars['EXTENSION']->value->get('currency_symbol');
echo $_smarty_tpl->tpl_vars['EXTENSION']->value->get('price');?>
</button><?php }
if ('' != $_smarty_tpl->tpl_vars['EXTENSION']->value->get('website')) {?><button class="m0550 btn installExtension addButton" style="margin-right:5px;" data-url="<?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->get('website');?>
"><?php echo vtranslate('LBL_MORE_DETAILS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button><?php }?></span></div></div></div></div></div><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></div></div></div></div><?php }
}
