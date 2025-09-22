<?php
/* Smarty version 4.5.5, created on 2025-09-16 08:39:29
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Users\UserViewHeader.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68c92241d96672_75620306',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '09149a0e9c7251b640ae1f00850cda0a61aeed43' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Users\\UserViewHeader.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68c92241d96672_75620306 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
?>

<div class="detailViewContainer"><div class="col-sm-12 col-xs-12"><div class="detailViewTitle" id="userPageHeader"><div class = "row"><div class="col-md-5"><div class="col-md-5 recordImage" style="height: 50px;width: 50px;"><?php $_smarty_tpl->_assignInScope('NOIMAGE', 0);
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RECORD']->value->getImageDetails(), 'IMAGE_INFO', false, 'ITER');
$_smarty_tpl->tpl_vars['IMAGE_INFO']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ITER']->value => $_smarty_tpl->tpl_vars['IMAGE_INFO']->value) {
$_smarty_tpl->tpl_vars['IMAGE_INFO']->do_else = false;
if (!empty($_smarty_tpl->tpl_vars['IMAGE_INFO']->value['url'])) {?><img height="100%" width="100%" src="<?php echo $_smarty_tpl->tpl_vars['IMAGE_INFO']->value['url'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['IMAGE_INFO']->value['orgname'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['IMAGE_INFO']->value['orgname'];?>
" data-image-id="<?php echo $_smarty_tpl->tpl_vars['IMAGE_INFO']->value['id'];?>
"><?php } else {
$_smarty_tpl->_assignInScope('NOIMAGE', 1);
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
if ($_smarty_tpl->tpl_vars['NOIMAGE']->value == 1) {?><div class="name"><span style="font-size:24px;"><strong> <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'substr' ][ 0 ], array( $_smarty_tpl->tpl_vars['RECORD']->value->getName(),0,2 ));?>
 </strong></span></div><?php }?></div><span class="font-x-x-large" style="margin:5px;font-size:24px"><?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getName();?>
</span></div><div class="pull-right col-md-7 detailViewButtoncontainer"><div class="btn-group pull-right"><?php if ((isset($_smarty_tpl->tpl_vars['DETAILVIEW_LINKS']->value))) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['DETAILVIEW_LINKS']->value['DETAILVIEWBASIC'], 'DETAIL_VIEW_BASIC_LINK');
$_smarty_tpl->tpl_vars['DETAIL_VIEW_BASIC_LINK']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['DETAIL_VIEW_BASIC_LINK']->value) {
$_smarty_tpl->tpl_vars['DETAIL_VIEW_BASIC_LINK']->do_else = false;
?><button class="btn btn-default <?php if ($_smarty_tpl->tpl_vars['DETAIL_VIEW_BASIC_LINK']->value->getLabel() == 'LBL_EDIT') {
}?>" id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_detailView_basicAction_<?php echo Vtiger_Util_Helper::replaceSpaceWithUnderScores($_smarty_tpl->tpl_vars['DETAIL_VIEW_BASIC_LINK']->value->getLabel());?>
"<?php if ($_smarty_tpl->tpl_vars['DETAIL_VIEW_BASIC_LINK']->value->isPageLoadLink()) {?>onclick="window.location.href='<?php echo $_smarty_tpl->tpl_vars['DETAIL_VIEW_BASIC_LINK']->value->getUrl();?>
'"<?php } else { ?>onclick="<?php echo $_smarty_tpl->tpl_vars['DETAIL_VIEW_BASIC_LINK']->value->getUrl();?>
"<?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['DETAIL_VIEW_BASIC_LINK']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
if (smarty_modifier_count($_smarty_tpl->tpl_vars['DETAILVIEW_LINKS']->value['DETAILVIEW']) > 0) {?><button class="btn btn-default" data-toggle="dropdown" href="javascript:void(0);"><?php echo vtranslate('LBL_MORE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<i class="caret"></i></button><ul class="dropdown-menu pull-right"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['DETAILVIEW_LINKS']->value['DETAILVIEW'], 'DETAIL_VIEW_LINK');
$_smarty_tpl->tpl_vars['DETAIL_VIEW_LINK']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['DETAIL_VIEW_LINK']->value) {
$_smarty_tpl->tpl_vars['DETAIL_VIEW_LINK']->do_else = false;
if ($_smarty_tpl->tpl_vars['DETAIL_VIEW_LINK']->value->getLabel() == "Delete") {
if ($_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->isAdminUser() && $_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->getId() != $_smarty_tpl->tpl_vars['RECORD']->value->getId()) {?><li id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_detailView_moreAction_<?php echo Vtiger_Util_Helper::replaceSpaceWithUnderScores($_smarty_tpl->tpl_vars['DETAIL_VIEW_LINK']->value->getLabel());?>
"><a href=<?php echo $_smarty_tpl->tpl_vars['DETAIL_VIEW_LINK']->value->getUrl();?>
 ><?php echo vtranslate($_smarty_tpl->tpl_vars['DETAIL_VIEW_LINK']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a><?php }
} else { ?><li id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_detailView_moreAction_<?php echo Vtiger_Util_Helper::replaceSpaceWithUnderScores($_smarty_tpl->tpl_vars['DETAIL_VIEW_LINK']->value->getLabel());?>
"><a href=<?php echo $_smarty_tpl->tpl_vars['DETAIL_VIEW_LINK']->value->getUrl();?>
 ><?php echo vtranslate($_smarty_tpl->tpl_vars['DETAIL_VIEW_LINK']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></ul><?php }
}?></div></div></div></div><hr/><div class="detailview-content userPreferences container-fluid"><?php $_smarty_tpl->_assignInScope('MODULE_NAME', $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name'));?><input id="recordId" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getId();?>
" /><div class="details row"><?php }
}
