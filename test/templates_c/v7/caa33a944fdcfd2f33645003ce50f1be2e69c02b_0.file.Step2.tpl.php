<?php
/* Smarty version 4.5.5, created on 2025-09-20 08:25:49
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Settings\MailConverter\Step2.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68ce650d25eb27_49799559',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'caa33a944fdcfd2f33645003ce50f1be2e69c02b' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Settings\\MailConverter\\Step2.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68ce650d25eb27_49799559 (Smarty_Internal_Template $_smarty_tpl) {
if (((isset($_smarty_tpl->tpl_vars['IMAP_ERROR']->value)) && $_smarty_tpl->tpl_vars['IMAP_ERROR']->value) || ((isset($_smarty_tpl->tpl_vars['CONNECTION_ERROR']->value)) && $_smarty_tpl->tpl_vars['CONNECTION_ERROR']->value)) {?><div class="block"><strong><?php if ($_smarty_tpl->tpl_vars['IMAP_ERROR']->value) {
echo $_smarty_tpl->tpl_vars['IMAP_ERROR']->value;
} elseif ($_smarty_tpl->tpl_vars['CONNECTION_ERROR']->value) {
echo vtranslate('LBL_CONNECTION_ERROR',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
}?></strong></div><br><?php }?><div class="addMailBoxBlock"><div class="row col-lg-12 padding-bottom1per"><div id="mailConverterDragIcon"><i class="icon-info-sign"></i>&nbsp;&nbsp;<?php echo vtranslate('TO_CHANGE_THE_FOLDER_SELECTION_DESELECT_ANY_OF_THE_SELECTED_FOLDERS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div></div><br><br><form class="form-horizontal" id="mailBoxEditView" name="step2"><div class="block"><div class="addMailBoxStep row" style="margin-top: 10px; margin-bottom: 10px;"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FOLDERS']->value, 'SELECTED', false, 'FOLDER');
$_smarty_tpl->tpl_vars['SELECTED']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FOLDER']->value => $_smarty_tpl->tpl_vars['SELECTED']->value) {
$_smarty_tpl->tpl_vars['SELECTED']->do_else = false;
?><div class="col-lg-3"><label><input type="checkbox" name="folders" value="<?php echo $_smarty_tpl->tpl_vars['FOLDER']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['SELECTED']->value == 'checked') {?>checked<?php }?>><span>&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['FOLDER']->value;?>
</span></label></div><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></div><div class="border1px modal-overlay-footer clearfix"><div class="row clearfix"><div class="textAlignCenter col-lg-12 col-md-12 col-lg-12 "><button class="btn btn-danger backStep" type="button" onclick="javascript:window.history.back();"><strong><?php echo vtranslate('LBL_BACK',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></button>&nbsp;&nbsp;<button class="btn btn-success" onclick="javascript:Settings_MailConverter_Edit_Js.secondStep()"><strong><?php if ($_smarty_tpl->tpl_vars['CREATE']->value == 'new') {
echo vtranslate('LBL_NEXT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
} else {
echo vtranslate('LBL_FINISH',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
}?></strong></button><a class="cancelLink" type="reset" onclick="javascript:window.history.go(-2);"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a></div></div></div></div></form></div></div></div><?php }
}
