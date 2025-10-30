<?php
/* Smarty version 4.5.5, created on 2025-10-02 08:04:45
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\Vtiger\OutgoingServerEdit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68de321d6734e0_71653095',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1d6a6493a8ce7738f25594f68e1ff3e816884175' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\Vtiger\\OutgoingServerEdit.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68de321d6734e0_71653095 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="editViewPageDiv editViewContainer" id="EditViewOutgoing" style="padding-top:0px;"><div class="col-lg-12 col-md-12 col-sm-12"><div><h3 style="margin-top: 0px;"><?php echo vtranslate('LBL_OUTGOING_SERVER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h3>&nbsp;<?php echo vtranslate('LBL_OUTGOING_SERVER_DESC',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><?php $_smarty_tpl->_assignInScope('WIDTHTYPE', $_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('rowheight'));?><form id="OutgoingServerForm" data-detail-url="<?php echo $_smarty_tpl->tpl_vars['MODEL']->value->getDetailViewUrl();?>
" method="POST"><input type="hidden" name="default" value="false" /><input type="hidden" name="server_port" value="0" /><input type="hidden" name="server_type" value="email"/><input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['MODEL']->value->get('id');?>
"/><div class="blockData"><br><div class="hide errorMessage"><div class="alert alert-danger"><?php echo vtranslate('LBL_TESTMAILSTATUS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<strong><?php echo vtranslate('LBL_MAILSENDERROR',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></div></div><div class="block"><div><div class="btn-group pull-right"><button class="btn t-btn resetButton" type="button" title="<?php echo vtranslate('LBL_RESET_TO_DEFAULT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"><strong><?php echo vtranslate('LBL_RESET_TO_DEFAULT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></button></div><h4><?php echo vtranslate('LBL_MAIL_SERVER_SMTP',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4></div><hr><table class="table editview-table no-border"><tbody><tr><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
 fieldLabel"><label><?php echo vtranslate('LBL_SERVER_TYPE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></td><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
 fieldValue"><div class=" col-lg-6 col-md-6 col-sm-12"><select class="select2 inputElement col-lg-12 col-md-12 col-lg-12" name="serverType"><option value=""><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><option value="google-oauth2" <?php ob_start();
echo $_smarty_tpl->tpl_vars['MODEL']->value->get('server');
$_prefixVariable1 = ob_get_clean();
ob_start();
echo $_smarty_tpl->tpl_vars['MODEL']->value->get('smtp_auth_type');
$_prefixVariable2 = ob_get_clean();
if ($_prefixVariable1 == "ssl://smtp.gmail.com:465" && $_prefixVariable2 == "XOAUTH2") {?> selected <?php }?>><?php echo vtranslate('LBL_GMAIL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 OAuth2</option><option value="<?php echo "smtp.live.com";?>
" <?php ob_start();
echo $_smarty_tpl->tpl_vars['MODEL']->value->get('server');
$_prefixVariable3 = ob_get_clean();
if ($_prefixVariable3 == "smtp.live.com") {?> selected <?php }?>><?php echo vtranslate('LBL_HOTMAIL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><option value="<?php echo "smtp-mail.outlook.com";?>
" <?php ob_start();
echo $_smarty_tpl->tpl_vars['MODEL']->value->get('server');
$_prefixVariable4 = ob_get_clean();
if ($_prefixVariable4 == "smtp.live.com") {?> selected <?php }?>><?php echo vtranslate('LBL_OFFICE365',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><option value="<?php echo "smtp.mail.yahoo.com";?>
" <?php ob_start();
echo $_smarty_tpl->tpl_vars['MODEL']->value->get('server');
$_prefixVariable5 = ob_get_clean();
if ($_prefixVariable5 == "smtp.mail.yahoo.com") {?> selected <?php }?>><?php echo vtranslate('LBL_YAHOO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><option value=""><?php echo vtranslate('LBL_OTHERS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option></select></div></td></tr><tr><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
 fieldLabel"><label><?php echo vtranslate('LBL_SERVER_NAME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label>&nbsp;<span class="redColor">*</span></td><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
 fieldValue"><div class=" col-lg-6 col-md-6 col-sm-12"><input type="text" class="inputElement" name="server" data-rule-required="true" value="<?php echo $_smarty_tpl->tpl_vars['MODEL']->value->get('server');?>
" ></div></td></tr><tr><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
 fieldLabel"><label><?php echo vtranslate('LBL_USER_NAME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></td><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
 fieldValue" ><div class=" col-lg-6 col-md-6 col-sm-12"><input type="text" class="inputElement" name="server_username" value="<?php echo $_smarty_tpl->tpl_vars['MODEL']->value->get('server_username');?>
" ></div></td></tr><tr><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
 fieldLabel"><label><?php echo vtranslate('LBL_PASSWORD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></td><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
 fieldValue" ><div class=" col-lg-6 col-md-6 col-sm-12"><input type="password" class="inputElement" name="server_password" value="<?php echo $_smarty_tpl->tpl_vars['MODEL']->value->get('server_password');?>
" ></div></td></tr><tr><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
 fieldLabel"><label><?php echo vtranslate('LBL_FROM_EMAIL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></td><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
 fieldValue" ><div class=" col-lg-6 col-md-6 col-sm-12"><input type="text" class="inputElement" name="from_email_field" data-rule-email="true" data-rule-illegal="true" value="<?php echo $_smarty_tpl->tpl_vars['MODEL']->value->get('from_email_field');?>
" ></div> </td></tr><tr><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
 fieldLabel">&nbsp;</td><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
 fieldValue" ><div class=" col-lg-12 col-md-12 col-sm-12"><div class="alert alert-info alert-mini"><?php echo vtranslate('LBL_OUTGOING_SERVER_FROM_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div></div></td></tr><tr><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
 fieldLabel"><label><?php echo vtranslate('LBL_REQUIRES_AUTHENTICATION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></td><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" style="border-left: none;"><div class=" col-lg-6 col-md-6 col-sm-12"><input type="checkbox" name="smtp_auth" <?php if ($_smarty_tpl->tpl_vars['MODEL']->value->isSmtpAuthEnabled()) {?>checked<?php }?> ></div></td></tr></tbody></table></div><br><div class='modal-overlay-footer clearfix'><div class="row clearfix"><div class='textAlignCenter col-lg-12 col-md-12 col-sm-12 '><button type='submit' class='btn btn-success saveButton' ><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button>&nbsp;&nbsp;<a class='cancelLink' data-dismiss="modal" href="#"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div></div></div></div></form></div></div>
<?php }
}
