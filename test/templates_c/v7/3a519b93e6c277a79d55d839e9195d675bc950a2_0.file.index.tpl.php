<?php
/* Smarty version 4.5.5, created on 2025-10-02 09:15:01
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\MailManager\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68de429527e335_94656094',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3a519b93e6c277a79d55d839e9195d675bc950a2' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\MailManager\\index.tpl',
      1 => 1758006150,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68de429527e335_94656094 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('IS_MAILBOX_EXISTS', $_smarty_tpl->tpl_vars['MAILBOX']->value->exists());?><input type="hidden" id="isMailBoxExists" value="<?php if ($_smarty_tpl->tpl_vars['IS_MAILBOX_EXISTS']->value) {?>1<?php } else { ?>0<?php }?>"><?php if (!$_smarty_tpl->tpl_vars['IS_MAILBOX_EXISTS']->value) {?><div class="mmDescription"><center><br><br><div><?php echo vtranslate('LBL_MODULE_DESCRIPTION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</div><br><br><br><button class="btn btn-success mailbox_setting"><strong><?php echo vtranslate('LBL_CONFIGURE_MAILBOX',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button></center></div><?php } else { ?><div id="mailmanagerContainer" class="clearfix"><input type="hidden" id="refresh_timeout" value="<?php echo $_smarty_tpl->tpl_vars['MAILBOX']->value->refreshTimeOut();?>
"/><div id="mails_container" class='col-lg-5'></div><div id="mailPreviewContainer" class="col-lg-7"><div class="mmListMainContainer"><center><strong><?php echo vtranslate('LBL_NO_MAIL_SELECTED_DESC',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></center></div></div></div><?php }
}
}
