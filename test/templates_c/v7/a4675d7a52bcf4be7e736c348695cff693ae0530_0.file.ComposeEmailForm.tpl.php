<?php
/* Smarty version 4.5.5, created on 2025-09-16 08:49:44
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Vtiger\ComposeEmailForm.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68c924a8e49121_39086276',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a4675d7a52bcf4be7e736c348695cff693ae0530' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Vtiger\\ComposeEmailForm.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68c924a8e49121_39086276 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
?>

<div class="SendEmailFormStep2 modal-dialog modal-lg" id="composeEmailContainer"><div class="modal-content"><form class="form-horizontal" id="massEmailForm" method="post" action="index.php" enctype="multipart/form-data" name="massEmailForm"><?php ob_start();
echo vtranslate('LBL_COMPOSE_EMAIL',$_smarty_tpl->tpl_vars['MODULE']->value);
$_prefixVariable1 = ob_get_clean();
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('TITLE'=>$_prefixVariable1), 0, true);
?><div class="modal-body"><input type="hidden" name="selected_ids" value='<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['SELECTED_IDS']->value);?>
' /><input type="hidden" name="excluded_ids" value='<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['EXCLUDED_IDS']->value);?>
' /><input type="hidden" name="viewname" value="<?php echo $_smarty_tpl->tpl_vars['VIEWNAME']->value;?>
" /><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
"/><input type="hidden" name="mode" value="massSave" /><input type="hidden" name="toemailinfo" value='<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['TOMAIL_INFO']->value);?>
' /><input type="hidden" name="view" value="MassSaveAjax" /><input type="hidden" name="to" value='<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['TO']->value);?>
' /><input type="hidden" name="toMailNamesList" value='<?php echo $_smarty_tpl->tpl_vars['TOMAIL_NAMES_LIST']->value;?>
'/><input type="hidden" id="flag" name="flag" value="" /><input type="hidden" id="maxUploadSize" value="<?php echo $_smarty_tpl->tpl_vars['MAX_UPLOAD_SIZE']->value;?>
" /><input type="hidden" id="documentIds" name="documentids" value="" /><input type="hidden" name="emailMode" value="<?php if ((isset($_smarty_tpl->tpl_vars['EMAIL_MODE']->value))) {
echo $_smarty_tpl->tpl_vars['EMAIL_MODE']->value;
}?>" /><input type="hidden" name="source_module" value="<?php echo $_smarty_tpl->tpl_vars['SOURCE_MODULE']->value;?>
" /><?php if (!empty($_smarty_tpl->tpl_vars['PARENT_EMAIL_ID']->value)) {?><input type="hidden" name="parent_id" value="<?php echo $_smarty_tpl->tpl_vars['PARENT_EMAIL_ID']->value;?>
" /><input type="hidden" name="parent_record_id" value="<?php echo $_smarty_tpl->tpl_vars['PARENT_RECORD']->value;?>
" /><?php }
if (!empty($_smarty_tpl->tpl_vars['RECORDID']->value)) {?><input type="hidden" name="record" value="<?php echo $_smarty_tpl->tpl_vars['RECORDID']->value;?>
" /><?php }?><input type="hidden" name="search_key" value="<?php if ((isset($_smarty_tpl->tpl_vars['SEARCH_KEY']->value))) {
echo $_smarty_tpl->tpl_vars['SEARCH_KEY']->value;
}?>" /><input type="hidden" name="operator" value="<?php echo $_smarty_tpl->tpl_vars['OPERATOR']->value;?>
" /><input type="hidden" name="search_value" value="<?php if ((isset($_smarty_tpl->tpl_vars['ALPHABET_VALUE']->value))) {
echo $_smarty_tpl->tpl_vars['ALPHABET_VALUE']->value;
}?>" /><?php if (!empty($_smarty_tpl->tpl_vars['SEARCH_PARAMS']->value)) {?><input type="hidden" name="search_params" value='<?php echo Vtiger_Util_Helper::toSafeHTML(ZEND_JSON::encode($_smarty_tpl->tpl_vars['SEARCH_PARAMS']->value));?>
' /><?php }?><div class="row toEmailField"><div class="col-lg-12"><div class="col-lg-2"><span class=""><?php echo vtranslate('LBL_TO',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<span class="redColor">*</span></span></div><div class="col-lg-6"><?php if (!empty($_smarty_tpl->tpl_vars['TO']->value)) {
$_smarty_tpl->_assignInScope('TO_EMAILS', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'htmlentities' ][ 0 ], array( call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'implode' ][ 0 ], array( ",",$_smarty_tpl->tpl_vars['TO']->value )) )));
}?><input id="emailField" style="width:100%" name="toEmail" type="text" class="autoComplete sourceField select2" data-rule-required="true" data-rule-multiEmails="true" value="<?php if (!empty($_smarty_tpl->tpl_vars['TO_EMAILS']->value)) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['TO_EMAILS']->value, ENT_QUOTES, 'UTF-8', true);
}?>" placeholder="<?php echo vtranslate('LBL_TYPE_AND_SEARCH',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"></div><div class="col-lg-4 input-group"><select style="width: 140px;" class="select2 emailModulesList pull-right"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RELATED_MODULES']->value, 'MODULE_NAME');
$_smarty_tpl->tpl_vars['MODULE_NAME']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['MODULE_NAME']->value) {
$_smarty_tpl->tpl_vars['MODULE_NAME']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['MODULE_NAME']->value == $_smarty_tpl->tpl_vars['FIELD_MODULE']->value) {?> selected <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select><a href="#" class="clearReferenceSelection cursorPointer" name="clearToEmailField"> X </a><span class="input-group-addon"><span class="selectEmail cursorPointer"><i class="fa fa-search" title="<?php echo vtranslate('LBL_SELECT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"></i></span></span></div></div></div><div class="row <?php if (empty($_smarty_tpl->tpl_vars['CC']->value)) {?> hide <?php }?> ccContainer"><div class="col-lg-12"><div class="col-lg-2"><span class=""><?php echo vtranslate('LBL_CC',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span></div><div class="col-lg-6"><input type="text" name="cc" data-rule-multiEmails="true" value="<?php if (!empty($_smarty_tpl->tpl_vars['CC']->value)) {
echo $_smarty_tpl->tpl_vars['CC']->value;
}?>"/></div><div class="col-lg-4"></div></div></div><div class="row <?php if (empty($_smarty_tpl->tpl_vars['BCC']->value)) {?> hide <?php }?> bccContainer"><div class="col-lg-12"><div class="col-lg-2"><span class=""><?php echo vtranslate('LBL_BCC',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span></div><div class="col-lg-6"><input type="text" name="bcc" data-rule-multiEmails="true" value="<?php if (!empty($_smarty_tpl->tpl_vars['BCC']->value)) {
echo $_smarty_tpl->tpl_vars['BCC']->value;
}?>"/></div><div class="col-lg-4"></div></div></div><div class="row <?php if ((!empty($_smarty_tpl->tpl_vars['CC']->value)) && (!empty($_smarty_tpl->tpl_vars['BCC']->value))) {?> hide <?php }?> "><div class="col-lg-12"><div class="col-lg-2"></div><div class="col-lg-6"><a href="#" class="cursorPointer <?php if ((!empty($_smarty_tpl->tpl_vars['CC']->value))) {?>hide<?php }?>" id="ccLink"><?php echo vtranslate('LBL_ADD_CC',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>&nbsp;&nbsp;<a href="#" class="cursorPointer <?php if ((!empty($_smarty_tpl->tpl_vars['BCC']->value))) {?>hide<?php }?>" id="bccLink"><?php echo vtranslate('LBL_ADD_BCC',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div><div class="col-lg-4"></div></div></div><div class="row subjectField"><div class="col-lg-12"><div class="col-lg-2"><span class=""><?php echo vtranslate('LBL_SUBJECT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<span class="redColor">*</span></span></div><div class="col-lg-6"><input type="text" name="subject" value="<?php if (!empty($_smarty_tpl->tpl_vars['SUBJECT']->value)) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['SUBJECT']->value, ENT_QUOTES, 'UTF-8', true);
}?>" data-rule-required="true" id="subject" spellcheck="true" class="inputElement"/></div><div class="col-lg-4"></div></div></div><div class="row attachment"><div class="col-lg-12"><div class="col-lg-2"><span class=""><?php echo vtranslate('LBL_ATTACHMENT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span></div><div class="col-lg-9"><div class="row"><div class="col-lg-4 browse"><input type="file" <?php if ((isset($_smarty_tpl->tpl_vars['FILE_ATTACHED']->value))) {?>class="removeNoFileChosen"<?php }?> id="multiFile" name="file[]"/>&nbsp;</div><div class="col-lg-4 brownseInCrm"><button type="button" class="btn btn-small btn-default" id="browseCrm" data-url="<?php echo $_smarty_tpl->tpl_vars['DOCUMENTS_URL']->value;?>
" title="<?php echo vtranslate('LBL_BROWSE_CRM',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><?php echo vtranslate('LBL_BROWSE_CRM',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button></div><div class="col-lg-4 insertTemplate"><button id="selectEmailTemplate" class="btn btn-success" data-url="module=EmailTemplates&view=Popup"><?php echo vtranslate('LBL_SELECT_EMAIL_TEMPLATE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button></div></div><div id="attachments"><?php if ((isset($_smarty_tpl->tpl_vars['ATTACHMENTS']->value)) && smarty_modifier_count($_smarty_tpl->tpl_vars['ATTACHMENTS']->value) > 0) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ATTACHMENTS']->value, 'ATTACHMENT');
$_smarty_tpl->tpl_vars['ATTACHMENT']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ATTACHMENT']->value) {
$_smarty_tpl->tpl_vars['ATTACHMENT']->do_else = false;
if ((call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'array_key_exists' ][ 0 ], array( 'docid',$_smarty_tpl->tpl_vars['ATTACHMENT']->value )))) {
$_smarty_tpl->_assignInScope('DOCUMENT_ID', $_smarty_tpl->tpl_vars['ATTACHMENT']->value['docid']);
$_smarty_tpl->_assignInScope('FILE_TYPE', "document");
} else {
$_smarty_tpl->_assignInScope('FILE_TYPE', "file");
}?><div class="MultiFile-label customAttachment" data-file-id="<?php echo (isset($_smarty_tpl->tpl_vars['ATTACHMENT']->value['fileid'])) ? $_smarty_tpl->tpl_vars['ATTACHMENT']->value['fileid'] : '';?>
" data-file-type="<?php echo $_smarty_tpl->tpl_vars['FILE_TYPE']->value;?>
"  data-file-size="<?php echo $_smarty_tpl->tpl_vars['ATTACHMENT']->value['size'];?>
" <?php if ($_smarty_tpl->tpl_vars['FILE_TYPE']->value == "document") {?> data-document-id="<?php echo $_smarty_tpl->tpl_vars['DOCUMENT_ID']->value;?>
"<?php }?>><?php if ((isset($_smarty_tpl->tpl_vars['ATTACHMENT']->value['nondeletable'])) && $_smarty_tpl->tpl_vars['ATTACHMENT']->value['nondeletable'] != true) {?><a name="removeAttachment" class="cursorPointer">x </a><?php }?><span><?php echo $_smarty_tpl->tpl_vars['ATTACHMENT']->value['attachment'];?>
</span></div><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?></div></div></div></div><div class="row"><div class="col-lg-12"><div class="col-lg-2"><span class=""><?php echo vtranslate('LBL_INCLUDE_SIGNATURE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span></div><div class="item col-lg-9"><input class="" type="checkbox" name="signature" value="Yes" checked="checked" id="signature"></div></div></div><div class="container-fluid hide" id='emailTemplateWarning'><div class="alert alert-warning fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><p><?php echo vtranslate('LBL_EMAILTEMPLATE_WARNING_CONTENT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</p></div></div><div class="row templateContent"><div class="col-lg-12"><textarea style="width:390px;height:200px;" id="description" name="description"><?php if (!empty($_smarty_tpl->tpl_vars['DESCRIPTION']->value)) {
echo $_smarty_tpl->tpl_vars['DESCRIPTION']->value;
}?></textarea></div></div><?php if ((isset($_smarty_tpl->tpl_vars['RELATED_LOAD']->value)) && $_smarty_tpl->tpl_vars['RELATED_LOAD']->value == true) {?><input type="hidden" name="related_load" value=<?php echo $_smarty_tpl->tpl_vars['RELATED_LOAD']->value;?>
 /><?php }?><input type="hidden" name="attachments" value="<?php if ((isset($_smarty_tpl->tpl_vars['ATTACHMENTS']->value))) {
echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['ATTACHMENTS']->value);
} else { ?>null<?php }?>" /><div id="emailTemplateWarningContent" style="display: none;"><?php echo vtranslate('LBL_EMAILTEMPLATE_WARNING_CONTENT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</div></div><div class="modal-footer"><div class="pull-right cancelLinkContainer"><a href="#" class="cancelLink" type="reset" data-dismiss="modal"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div><button id="sendEmail" name="sendemail" class="btn btn-success" title="<?php echo vtranslate("LBL_SEND_EMAIL",$_smarty_tpl->tpl_vars['MODULE']->value);?>
" type="submit"><strong><?php echo vtranslate("LBL_SEND_EMAIL",$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button><button id="saveDraft" name="savedraft" class="btn btn-default" title="<?php echo vtranslate('LBL_SAVE_AS_DRAFT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" type="submit"><strong><?php echo vtranslate('LBL_SAVE_AS_DRAFT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button></div></form></div></div>
<?php }
}
