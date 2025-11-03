<?php
/* Smarty version 4.5.5, created on 2025-10-30 07:12:41
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\CTFacebookMessengerIntegration\CTFacebookMessengerIntegrationList.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_69030fe99e0854_04199465',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '355dccea02e847ef41a42158b022309ef136da51' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\CTFacebookMessengerIntegration\\CTFacebookMessengerIntegrationList.tpl',
      1 => 1761802269,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69030fe99e0854_04199465 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="main" id="facebookIntegrationListPageDiv">
    <div class="main">
        <div class="header">
            <h4><?php echo vtranslate('LBL_CTFACEBOOK_MESSENGER_INTEGRATION_CONFIGURATION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4><br>
        </div>		
		<?php if ($_smarty_tpl->tpl_vars['ACCESSTOKEN']->value == '') {?>
            <button id="loginWithFacebook" class="btn btn-sm"><?php echo vtranslate('LBL_CTFACEBOOK_LOGIN_WITH_FACEBOOK',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</b></button>
        <?php }?>
    </div>
</div><?php }
}
