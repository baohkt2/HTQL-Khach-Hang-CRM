<?php
/* Smarty version 4.5.5, created on 2025-09-16 08:50:14
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Emails\SendEmailResult.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68c924c69e7bf4_02383542',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0744b78d57c7231f46c26eadf72a5e0eb4ae0a7b' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Emails\\SendEmailResult.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68c924c69e7bf4_02383542 (Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="modal-dialog">
	<div class="modal-content">
		<?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('TITLE'=>"Result"), 0, true);
?> 
		<div class="modal-body">
			<?php if ($_smarty_tpl->tpl_vars['SUCCESS']->value) {?>
				<div class="mailSentSuccessfully" data-relatedload="<?php if ((isset($_smarty_tpl->tpl_vars['RELATED_LOAD']->value))) {
echo $_smarty_tpl->tpl_vars['RELATED_LOAD']->value;
} else { ?>''<?php }?>">
                                    <?php if ($_smarty_tpl->tpl_vars['FLAG']->value == 'SENT') {?>
                                        <?php echo vtranslate('LBL_MAIL_SENT_SUCCESSFULLY');?>

                                    <?php } else { ?>
                                        <?php echo vtranslate('LBL_MAIL_SAVED_SUCCESSFULLY');?>

                                    <?php }?>
				</div>
				<?php if ($_smarty_tpl->tpl_vars['FLAG']->value) {?>
					<input type="hidden" id="flag" value="<?php echo $_smarty_tpl->tpl_vars['FLAG']->value;?>
">
				<?php }?>
			<?php } else { ?>
				<div class="failedToSend" data-relatedload="false">
					<?php echo vtranslate('LBL_FAILED_TO_SEND');?>

					<br>
					<?php echo $_smarty_tpl->tpl_vars['MESSAGE']->value;?>

				</div>
			<?php }?>
		</div>
	</div>
</div>
<?php }
}
