<?php
/* Smarty version 4.5.5, created on 2025-09-16 07:14:42
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Vtiger\ModalFooter.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68c90e620a7094_83258409',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '79e1f4c25ff1a7ef0ca7605ab28ab87c42b7ee34' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Vtiger\\ModalFooter.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68c90e620a7094_83258409 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="modal-footer "><center><?php if ($_smarty_tpl->tpl_vars['BUTTON_NAME']->value != null) {
$_smarty_tpl->_assignInScope('BUTTON_LABEL', $_smarty_tpl->tpl_vars['BUTTON_NAME']->value);
} else {
ob_start();
echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);
$_prefixVariable6 = ob_get_clean();
$_smarty_tpl->_assignInScope('BUTTON_LABEL', $_prefixVariable6);
}?><button <?php if ($_smarty_tpl->tpl_vars['BUTTON_ID']->value != null) {?> id="<?php echo $_smarty_tpl->tpl_vars['BUTTON_ID']->value;?>
" <?php }?> class="btn btn-success" type="submit" name="saveButton"><strong><?php echo $_smarty_tpl->tpl_vars['BUTTON_LABEL']->value;?>
</strong></button><a href="#" class="cancelLink" type="reset" data-dismiss="modal"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></center></div><?php }
}
