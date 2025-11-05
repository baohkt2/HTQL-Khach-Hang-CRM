<?php
/* Smarty version 4.5.5, created on 2025-11-05 05:05:32
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\ExtensionStore\Detail.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690adb1ca1d4f4_73840453',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c6d6739eaa13a918516fc4659a726d75542261e1' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\ExtensionStore\\Detail.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690adb1ca1d4f4_73840453 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\vtigercrm\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.replace.php','function'=>'smarty_modifier_replace',),));
?>
<div class="col-lg-12 col-sm-12 content-area detailViewInfo extensionDetails extensionWidgetContainer" style='margin-top:0px;'><?php if (!($_smarty_tpl->tpl_vars['ERROR']->value)) {?><input type="hidden" name="mode" value="<?php echo $_smarty_tpl->tpl_vars['REQ']->value->get('mode');?>
" /><input type="hidden" name="extensionId" value="<?php echo $_smarty_tpl->tpl_vars['EXTENSION_ID']->value;?>
" /><input type="hidden" name="targetModule" value="<?php echo $_smarty_tpl->tpl_vars['EXTENSION_DETAIL']->value->get('name');?>
" /><input type="hidden" name="moduleAction" value="<?php echo $_smarty_tpl->tpl_vars['MODULE_ACTION']->value;?>
" /><div class="row contentHeader extension_header" style="margin-bottom: 10px;"><div class="col-sm-6 col-xs-6" style="margin-bottom: 5px;"><div style="margin-bottom: 5px;"><span class="font-x-x-large"><?php echo $_smarty_tpl->tpl_vars['EXTENSION_DETAIL']->value->get('name');?>
</span>&nbsp;<span class="muted"><?php echo vtranslate('LBL_BY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['AUTHOR_INFO']->value['firstname'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['AUTHOR_INFO']->value['lastname'];?>
</span></div><?php $_smarty_tpl->_assignInScope('ON_RATINGS', $_smarty_tpl->tpl_vars['EXTENSION_DETAIL']->value->get('avgrating'));?><div><span data-score="<?php echo $_smarty_tpl->tpl_vars['ON_RATINGS']->value;?>
" class="rating " data-readonly="true"></span><span class=""><?php if ($_smarty_tpl->tpl_vars['ON_RATINGS']->value) {?>(<?php echo $_smarty_tpl->tpl_vars['ON_RATINGS']->value;?>
 <?php echo vtranslate('LBL_RATINGS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
)<?php }?></span></div></div><div class="col-sm-6 col-xs-6"><div class="pull-right extensionDetailActions"><span style="margin: 5px;"><a class="btn btn-default" id="declineExtension"><i class="fa fa-chevron-left"></i> <?php echo vtranslate('LBL_BACK',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>&nbsp;</span><span style="margin: 5px"><?php if (($_smarty_tpl->tpl_vars['MODULE_ACTION']->value == 'Installed')) {?><button class="btn btn-danger <?php if (($_smarty_tpl->tpl_vars['REGISTRATION_STATUS']->value) && ($_smarty_tpl->tpl_vars['PASSWORD_STATUS']->value)) {?>authenticated <?php } else { ?> loginRequired<?php }?>" type="button" style="margin-right: 6px;" id="uninstallModule"><strong><?php echo vtranslate('LBL_UNINSTALL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></button><?php } else {
if ($_smarty_tpl->tpl_vars['EXTENSION_DETAIL']->value->get('isprotected') && $_smarty_tpl->tpl_vars['IS_PRO']->value && ($_smarty_tpl->tpl_vars['EXTENSION_DETAIL']->value->get('price') > 0)) {?><button class="btn btn-info <?php if ((!$_smarty_tpl->tpl_vars['CUSTOMER_PROFILE']->value['CustomerCardId'])) {?> setUpCard<?php }
if (($_smarty_tpl->tpl_vars['REGISTRATION_STATUS']->value) && ($_smarty_tpl->tpl_vars['PASSWORD_STATUS']->value)) {?> authenticated <?php } else { ?> loginRequired<?php }?>" type="button" id="installExtension"><strong><?php echo vtranslate('LBL_BUY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
$<?php echo $_smarty_tpl->tpl_vars['EXTENSION_DETAIL']->value->get('price');?>
</strong></button><?php } elseif ((!$_smarty_tpl->tpl_vars['EXTENSION_DETAIL']->value->get('isprotected')) && ($_smarty_tpl->tpl_vars['EXTENSION_DETAIL']->value->get('price') > 0)) {?><button class="btn btn-info <?php if ((!$_smarty_tpl->tpl_vars['CUSTOMER_PROFILE']->value['CustomerCardId'])) {?> setUpCard<?php }
if (($_smarty_tpl->tpl_vars['REGISTRATION_STATUS']->value) && ($_smarty_tpl->tpl_vars['PASSWORD_STATUS']->value)) {?> authenticated <?php } else { ?> loginRequired<?php }?>" type="button" id="installExtension"><strong><?php echo vtranslate('LBL_BUY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
$<?php echo $_smarty_tpl->tpl_vars['EXTENSION_DETAIL']->value->get('price');?>
</strong></button><?php } elseif (!$_smarty_tpl->tpl_vars['EXTENSION_DETAIL']->value->get('isprotected') && (($_smarty_tpl->tpl_vars['EXTENSION_DETAIL']->value->get('price') == 0) || ($_smarty_tpl->tpl_vars['EXTENSION_DETAIL']->value->get('price') == 'Free'))) {?><button class="btn btn-success <?php if (($_smarty_tpl->tpl_vars['REGISTRATION_STATUS']->value) && ($_smarty_tpl->tpl_vars['PASSWORD_STATUS']->value)) {?>authenticated <?php } else { ?> loginRequired<?php }?>" type="button" id="installExtension"><strong><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_ACTION']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></button><?php } elseif ($_smarty_tpl->tpl_vars['EXTENSION_DETAIL']->value->get('isprotected') && $_smarty_tpl->tpl_vars['IS_PRO']->value && (($_smarty_tpl->tpl_vars['EXTENSION_DETAIL']->value->get('price') == 0) || ($_smarty_tpl->tpl_vars['EXTENSION_DETAIL']->value->get('price') == 'Free'))) {?><button class="btn btn-success <?php if (($_smarty_tpl->tpl_vars['REGISTRATION_STATUS']->value) && ($_smarty_tpl->tpl_vars['PASSWORD_STATUS']->value)) {?>authenticated <?php } else { ?> loginRequired<?php }?>" type="button" id="installExtension"><strong><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_ACTION']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></button><?php }
}?></span><span style="margin: 5px;"><?php if ($_smarty_tpl->tpl_vars['MODULE_ACTION']->value == 'Installed') {
$_smarty_tpl->_assignInScope('LAUNCH_URL', $_smarty_tpl->tpl_vars['EXTENSION_MODULE_MODEL']->value->getExtensionLaunchUrl());
}?><button class="btn btn-info <?php if ($_smarty_tpl->tpl_vars['MODULE_ACTION']->value == 'Installed') {
if ($_smarty_tpl->tpl_vars['EXTENSION_MODULE_MODEL']->value->get('extnType') == 'language') {?>hide<?php }
} else { ?>hide<?php }?>" type="button" id="launchExtension" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['LAUNCH_URL']->value;?>
'"><strong><?php echo vtranslate('LBL_LAUNCH',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></button></span></div><div class="clearfix"></div></div></div><div class="tabbable-panel"><div class="tabbable-line margin0px" style="padding-bottom: 20px;"><ul id="extensionTab" class="nav nav-tabs" style="margin-bottom: 0px; padding-bottom: 0px;text-align: left;"><li class="active"><a href="#description" data-toggle="tab"><strong><?php echo vtranslate('LBL_DESCRIPTION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></a></li><li class="divider-vertical"></li><li><a href="#CustomerReviews" data-toggle="tab"><strong><?php echo vtranslate('LBL_CUSTOMER_REVIEWS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></a></li><li class="divider-vertical"></li><li><a href="#Author" data-toggle="tab"><strong><?php echo vtranslate('LBL_PUBLISHER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></a></li></ul><div class="tab-content boxSizingBorderBox" style="background-color: #fff; padding: 20px; margin-top: 10px;"><div class="tab-pane active" id="description"><div style="width:90%;padding: 0px 5%;"><div class="row"><div class="col-sm-2 col-xs-2">&nbsp;</div><div class="col-sm-8 col-xs-8"><div id="imageSlider" class="carousel slide" data-ride="carousel"><!-- Indicators --><ol class="carousel-indicators"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['SCREEN_SHOTS']->value, 'SCREEN_SHOT', false, 'key', 'screen', array (
  'index' => true,
));
$_smarty_tpl->tpl_vars['SCREEN_SHOT']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['SCREEN_SHOT']->value) {
$_smarty_tpl->tpl_vars['SCREEN_SHOT']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_screen']->value['index']++;
?><li data-target="#imageSlider" data-slide-to="<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_screen']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_screen']->value['index'] : null);?>
" <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_screen']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_screen']->value['index'] : null) == 0) {?>class="active" <?php }?>></li><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></ol><!-- Wrapper for slides --><div class="carousel-inner" role="listbox"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['SCREEN_SHOTS']->value, 'SCREEN_SHOT', false, 'key', 'screen', array (
  'index' => true,
));
$_smarty_tpl->tpl_vars['SCREEN_SHOT']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['SCREEN_SHOT']->value) {
$_smarty_tpl->tpl_vars['SCREEN_SHOT']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_screen']->value['index']++;
?><div class="item <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_screen']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_screen']->value['index'] : null) == 0) {?> active <?php }?>"><img src="<?php echo $_smarty_tpl->tpl_vars['SCREEN_SHOT']->value->get('screenShotURL');?>
" ></div><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></div><!-- Controls --><a class="left carousel-control" href="#imageSlider" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span><span class="sr-only"></span></a><a class="right carousel-control" href="#imageSlider" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span><span class="sr-only"></span></a></div></div><div class="col-sm-2 col-xs-2">&nbsp;</div></div></div><br><div class="scrollableTab" style="text-align: left;"><p><?php echo $_smarty_tpl->tpl_vars['EXTENSION_DETAIL']->value->get('description');?>
</p><p></p></div></div><div class="tab-pane" id="CustomerReviews"><div class="row boxSizingBorderBox" style="padding-bottom: 15px;"><div class="col-sm-6 col-xs-6"><div class="pull-left"><div style="font-size: 55px; line-height:50px; margin-right: 20px;"><?php echo $_smarty_tpl->tpl_vars['ON_RATINGS']->value;?>
</div></div><div class="pull-left"><span data-score="<?php echo $_smarty_tpl->tpl_vars['ON_RATINGS']->value;?>
" class="rating" data-readonly="true"></span><div>out of 5</div><div>(<?php echo php7_count($_smarty_tpl->tpl_vars['CUSTOMER_REVIEWS']->value);?>
 Reviews)</div></div></div><?php if (($_smarty_tpl->tpl_vars['REGISTRATION_STATUS']->value) && ($_smarty_tpl->tpl_vars['PASSWORD_STATUS']->value)) {?><div class="col-sm-6 col-xs-6"><div class="pull-right"><button type="button" class="writeReview margin0px pull-right <?php if ($_smarty_tpl->tpl_vars['MODULE_ACTION']->value != 'Installed') {?> hide<?php }?>"><?php echo vtranslate('LBL_WRITE_A_REVIEW',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button></div></div><?php }?></div><hr><div class="scrollableTab"><div class="customerReviewContainer" style=""><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['CUSTOMER_REVIEWS']->value, 'CUSTOMER_REVIEW', false, 'key');
$_smarty_tpl->tpl_vars['CUSTOMER_REVIEW']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['CUSTOMER_REVIEW']->value) {
$_smarty_tpl->tpl_vars['CUSTOMER_REVIEW']->do_else = false;
?><div class="row" style="margin: 8px 0 15px;"><div class="col-sm-3 col-xs-3"><?php $_smarty_tpl->_assignInScope('ON_RATINGS', $_smarty_tpl->tpl_vars['CUSTOMER_REVIEW']->value['rating']);?><div data-score="<?php echo $_smarty_tpl->tpl_vars['ON_RATINGS']->value;?>
" class="rating" data-readonly="true"></div><?php $_smarty_tpl->_assignInScope('CUSTOMER_INFO', $_smarty_tpl->tpl_vars['CUSTOMER_REVIEW']->value['customer']);?><div><?php $_smarty_tpl->_assignInScope('REVIEW_CREATED_TIME', smarty_modifier_replace($_smarty_tpl->tpl_vars['CUSTOMER_REVIEW']->value['createdon'],'T',' '));
echo $_smarty_tpl->tpl_vars['CUSTOMER_INFO']->value['firstname'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['CUSTOMER_INFO']->value['lastname'];?>
</div><div class="muted"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'substr' ][ 0 ], array( Vtiger_Util_Helper::formatDateTimeIntoDayString($_smarty_tpl->tpl_vars['REVIEW_CREATED_TIME']->value),4 ));?>
</div></div><div class="col-sm-9 col-xs-9"><?php echo $_smarty_tpl->tpl_vars['CUSTOMER_REVIEW']->value['comment'];?>
</div></div><hr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></div></div></div><div class="tab-pane" id="Author"><div class="scrollableTab"><div class="row extension_header"><div class="col-sm-6 col-xs-6"><?php if (!empty($_smarty_tpl->tpl_vars['AUTHOR_INFO']->value['company'])) {?><div class="font-x-x-large authorInfo"><?php echo $_smarty_tpl->tpl_vars['AUTHOR_INFO']->value['company'];?>
</div><?php } else { ?><div class="font-x-x-large authorInfo"><?php echo $_smarty_tpl->tpl_vars['AUTHOR_INFO']->value['firstname'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['AUTHOR_INFO']->value['lastname'];?>
</div><?php }?><div class="authorInfo"><?php echo $_smarty_tpl->tpl_vars['AUTHOR_INFO']->value['phone'];?>
</div><div class="authorInfo"><?php echo $_smarty_tpl->tpl_vars['AUTHOR_INFO']->value['email'];?>
</div><div class="authorInfo"><a href="<?php echo $_smarty_tpl->tpl_vars['AUTHOR_INFO']->value['website'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['AUTHOR_INFO']->value['website'];?>
</a></div></div><div class="col-sm-6 col-xs-6"> &nbsp; </div></div></div></div></div></div></div><div class="modal-dialog customerReviewModal hide"><div class="modal-content"><div class="modal-header contentsBackground"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h3><?php echo vtranslate('LBL_CUSTOMER_REVIEW',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h3></div><form class="form-horizontal customerReviewForm"><input type="hidden" name="extensionId" value="<?php echo $_smarty_tpl->tpl_vars['EXTENSION_ID']->value;?>
" /><div class="modal-body"><div class="form-group"><span class="control-label col-sm-2 col-xs-2"><?php echo vtranslate('LBL_REVIEW',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><div class="controls col-sm-4 col-xs-4"><textarea class="form-control" name="customerReview" data-rule-required="true"></textarea></div></div><div class="form-group"><span class="control-label col-sm-2 col-xs-2"><?php echo vtranslate('LBL_RATE_IT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><div class="controls col-sm-4 col-xs-4"><div class="rating"></div></div></div></div><div class="modal-footer"><div class="row"><div class="col-sm-12 col-xs-12"><div class="pull-right"><div class="pull-right cancelLinkContainer" style="margin-top:0px;"><a class="cancelLink" type="reset" data-dismiss="modal"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div><button class="btn btn-success" type="submit" name="saveButton"><strong><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button></div></div></div></div></form></div></div><?php } else { ?><div class="row"><div class="col-sm-12 col-xs-12"><?php echo $_smarty_tpl->tpl_vars['ERROR_MESSAGE']->value;?>
</div></div><?php }?></div><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "CardSetupModals.tpl",$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
}
