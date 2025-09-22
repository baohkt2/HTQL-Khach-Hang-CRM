<?php
/* Smarty version 4.5.5, created on 2025-09-17 13:20:31
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Settings\Vtiger\ConfigEditorDetail.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68cab59f29dfb6_55830547',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '59ee65def5151cacc85edb06ea719568edd676a1' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Settings\\Vtiger\\ConfigEditorDetail.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68cab59f29dfb6_55830547 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="detailViewContainer" id="ConfigEditorDetails"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 "><?php $_smarty_tpl->_assignInScope('WIDTHTYPE', $_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('rowheight'));?><div class="contents "><div class="clearfix"><h4 class="pull-left"><?php echo vtranslate('LBL_CONFIG_EDITOR',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4><div class="btn-group pull-right"><button class="btn btn-default editButton" data-url='<?php echo $_smarty_tpl->tpl_vars['MODEL']->value->getEditViewUrl();?>
' type="button" title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"><?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button></div></div><hr><br><div class="detailViewInfo"><?php $_smarty_tpl->_assignInScope('FIELD_DATA', $_smarty_tpl->tpl_vars['MODEL']->value->getViewableData());
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MODEL']->value->getEditableFields(), 'FIELD_DETAILS', false, 'FIELD_NAME');
$_smarty_tpl->tpl_vars['FIELD_DETAILS']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_NAME']->value => $_smarty_tpl->tpl_vars['FIELD_DETAILS']->value) {
$_smarty_tpl->tpl_vars['FIELD_DETAILS']->do_else = false;
?><div class="row form-group"><div class="col-lg-4 col-md-4 col-sm-4 fieldLabel"><label><?php if ($_smarty_tpl->tpl_vars['FIELD_NAME']->value == 'upload_maxsize') {
if ($_smarty_tpl->tpl_vars['FIELD_DATA']->value[$_smarty_tpl->tpl_vars['FIELD_NAME']->value] > 5) {
echo vtranslate($_smarty_tpl->tpl_vars['FIELD_DETAILS']->value['label'],$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value,$_smarty_tpl->tpl_vars['FIELD_DATA']->value[$_smarty_tpl->tpl_vars['FIELD_NAME']->value]);
} else {
echo vtranslate($_smarty_tpl->tpl_vars['FIELD_DETAILS']->value['label'],$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value,5);
}
} else {
echo vtranslate($_smarty_tpl->tpl_vars['FIELD_DETAILS']->value['label'],$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
}?></label></div><div class="col-lg-8 col-md-8 col-sm-8 fieldValue break-word"><div><?php if ($_smarty_tpl->tpl_vars['FIELD_DETAILS']->value['fieldType'] == 'checkbox') {
echo vtranslate($_smarty_tpl->tpl_vars['FIELD_DATA']->value[$_smarty_tpl->tpl_vars['FIELD_NAME']->value],$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
if ($_smarty_tpl->tpl_vars['FIELD_NAME']->value == 'email_tracking') {?><div class="input-info-addon"><a class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="<?php echo vtranslate('LBL_PERSONAL_EMAIL_TRACKING_INFO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></a></div><?php }
} elseif ($_smarty_tpl->tpl_vars['FIELD_NAME']->value == 'default_reply_to') {
echo vtranslate($_smarty_tpl->tpl_vars['FIELD_DATA']->value[$_smarty_tpl->tpl_vars['FIELD_NAME']->value]);?>
<div class="input-info-addon"><a class="fa fa-info-circle" data-toggle="tooltip" data-placement="right" title="<?php echo vtranslate('LBL_DEFAULT_REPLY_TO_INFO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></a></div><?php } else {
echo $_smarty_tpl->tpl_vars['FIELD_DATA']->value[$_smarty_tpl->tpl_vars['FIELD_NAME']->value];
}
if ($_smarty_tpl->tpl_vars['FIELD_NAME']->value == 'upload_maxsize') {?>&nbsp;<?php echo vtranslate('LBL_MB',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
}?></div></div></div><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></div></div></div></div>
<?php }
}
