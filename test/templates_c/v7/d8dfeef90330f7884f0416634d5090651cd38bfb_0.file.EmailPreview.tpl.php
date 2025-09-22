<?php
/* Smarty version 4.5.5, created on 2025-09-18 08:42:31
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Vtiger\EmailPreview.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68cbc5f7c4fdb0_96737286',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd8dfeef90330f7884f0416634d5090651cd38bfb' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Vtiger\\EmailPreview.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68cbc5f7c4fdb0_96737286 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
?>

<div class="SendEmailFormStep2 modal-dialog modal-lg" name="emailPreview"><div class="modal-content"><input type="hidden" name="parentRecord" value="<?php echo $_smarty_tpl->tpl_vars['PARENT_RECORD']->value;?>
"/><input type="hidden" name="recordId" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
"/><form class="form-horizontal" id="massEmailForm" method="post" action="index.php" enctype="multipart/form-data" name="massEmailForm"><?php ob_start();
echo vtranslate('SINGLE_Emails',$_smarty_tpl->tpl_vars['MODULE']->value);
$_prefixVariable1 = ob_get_clean();
ob_start();
echo vtranslate('LBL_INFO',$_smarty_tpl->tpl_vars['MODULE']->value);
$_prefixVariable2 = ob_get_clean();
$_smarty_tpl->_assignInScope('HEADER_TITLE', (($_prefixVariable1).(" ")).($_prefixVariable2));
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0, true);
?><div class="modal-body" id='emailPreviewScroll'><div class="row"><div class="col-lg-6"><div class="row email-info-row"><span class="col-lg-12"><span class="col-lg-4"><span class="pull-right"><?php echo vtranslate('LBL_FROM',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span></span><span class="col-lg-8"><span class="row-fluid"><?php echo $_smarty_tpl->tpl_vars['FROM']->value;?>
</span></span></span></div><div class="row email-info-row"><span class="col-lg-12"><span class="col-lg-4"><span class="pull-right"><?php echo vtranslate('LBL_TO',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span></span><span class="col-lg-8"><?php if (empty($_smarty_tpl->tpl_vars['TO']->value)) {
$_smarty_tpl->_assignInScope('TO', array());
}
$_smarty_tpl->_assignInScope('TO_EMAILS', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'implode' ][ 0 ], array( ",",$_smarty_tpl->tpl_vars['TO']->value )));?><span class="row-fluid"><span class="col-sm-10 paddingLeft0"><p class="textOverflowEllipsis"><?php echo $_smarty_tpl->tpl_vars['TO_EMAILS']->value;?>
</p></span><?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['TO']->value) > 1) {?><span class="col-sm-2"><a href="#" data-toggle="dropdown" style="text-transform: lowercase;"><?php echo vtranslate('LBL_MORE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a><ul class="dropdown-menu" style="padding:3px 6px; max-height:200px;" id="toAddressesDropdown"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['TO']->value, 'TO_ADDRESS');
$_smarty_tpl->tpl_vars['TO_ADDRESS']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['TO_ADDRESS']->value) {
$_smarty_tpl->tpl_vars['TO_ADDRESS']->do_else = false;
?><li><?php echo $_smarty_tpl->tpl_vars['TO_ADDRESS']->value;?>
</li><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></ul></span><?php }?></span></span></span></div></div><div class="col-lg-6"><div class="email-preview-toolbar pull-right"><?php if ($_smarty_tpl->tpl_vars['RECORD']->value->getEmailFlag() != 'SAVED') {?><button type="button" name="previewReply" class="btn btn-sm btn-default" data-mode="emailReply"><?php echo vtranslate('LBL_REPLY',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button><?php if (php7_count($_smarty_tpl->tpl_vars['TO']->value) > 1 || !empty($_smarty_tpl->tpl_vars['CC']->value) || !empty($_smarty_tpl->tpl_vars['BCC']->value)) {?><button type="button" name="previewReplyAll" class="btn btn-sm btn-default" data-mode="emailReplyAll"><?php echo vtranslate('LBL_REPLY_ALL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button><?php }
}?><button type="button" name="previewForward" class="btn btn-sm btn-default" data-mode="emailForward"><?php echo vtranslate('LBL_FORWARD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button><?php if ($_smarty_tpl->tpl_vars['RECORD']->value->getEmailFlag() == 'SAVED') {?><button type="button" name="previewEdit" class="btn btn-sm btn-default" data-mode="emailEdit"><?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button><?php }?><button type="button" name="previewPrint" class="btn btn-sm btn-default" data-mode="previewPrint"><?php echo vtranslate('LBL_PRINT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button></div></div></div><div class="row"><div class="col-lg-8"><?php if (!empty($_smarty_tpl->tpl_vars['CC']->value)) {?><div class="row email-info-row"><span class="col-lg-12"><span class="col-lg-3"><span class="pull-right"><?php echo vtranslate('LBL_CC',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span></span><span class="col-lg-9"><span class="row-fluid"><?php echo $_smarty_tpl->tpl_vars['CC']->value;?>
</span></span></span></div><?php }
if (!empty($_smarty_tpl->tpl_vars['BCC']->value)) {?><div class="row hide email-info-row"><span class="col-lg-12"><span class="col-lg-3"><span class="pull-right"><?php echo vtranslate('LBL_BCC',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span></span><span class="col-lg-9"><span class="row-fluid"><?php echo $_smarty_tpl->tpl_vars['BCC']->value;?>
</span></span></span></div><?php }?><div class="row email-info-row"><span class="col-lg-12"><span class="col-lg-3"><span class="pull-right"><?php echo vtranslate('LBL_SUBJECT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span></span><span class="col-lg-9"><?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('subject');?>
</span></span></div><div class="row email-info-row"><span class="col-lg-12"><span class="col-lg-3"><span class="pull-right"><?php echo vtranslate('LBL_ATTACHMENT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span></span><span class="col-lg-9"><?php if (php7_count($_smarty_tpl->tpl_vars['RECORD']->value->getAttachmentDetails()) <= 0) {
echo vtranslate('LBL_NO_ATTACHMENTS',$_smarty_tpl->tpl_vars['MODULE']->value);
} else {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RECORD']->value->getAttachmentDetails(), 'ATTACHMENT_DETAILS');
$_smarty_tpl->tpl_vars['ATTACHMENT_DETAILS']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ATTACHMENT_DETAILS']->value) {
$_smarty_tpl->tpl_vars['ATTACHMENT_DETAILS']->do_else = false;
?><i class="fa fa-download"></i>&nbsp;<a	<?php if (array_key_exists('docid',$_smarty_tpl->tpl_vars['ATTACHMENT_DETAILS']->value)) {?>href="index.php?module=Documents&action=DownloadFile&record=<?php echo $_smarty_tpl->tpl_vars['ATTACHMENT_DETAILS']->value['docid'];?>
&fileid=<?php echo $_smarty_tpl->tpl_vars['ATTACHMENT_DETAILS']->value['fileid'];?>
&name=<?php echo $_smarty_tpl->tpl_vars['ATTACHMENT_DETAILS']->value['attachment'];?>
"<?php } else { ?>href="index.php?module=Emails&action=DownloadFile&attachment_id=<?php echo $_smarty_tpl->tpl_vars['ATTACHMENT_DETAILS']->value['fileid'];?>
&name=<?php echo $_smarty_tpl->tpl_vars['ATTACHMENT_DETAILS']->value['attachment'];?>
"<?php }?>><?php echo $_smarty_tpl->tpl_vars['ATTACHMENT_DETAILS']->value['attachment'];?>
</a>&nbsp;&nbsp;<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?></span></span></div></div></div><textarea style="display:none;" id="iframeDescription"><?php echo decode_html($_smarty_tpl->tpl_vars['RECORD']->value->get('description'));?>
</textarea><div class="row email-info-row"><div class="col-lg-2" style="padding-right:10px;"><div class="pull-right"><?php echo vtranslate('LBL_DESCRIPTION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</div></div><div class="col-lg-10"><div class="email-body-preview"><iframe frameBorder="0" scrolling='yes' id="emailPreviewIframe" style='width: 100%; overflow-y:visible; height:100%;'></iframe></div></div></div><hr><div class="row"><span class="col-lg-12" style="text-align: center;"><span class="muted"><?php if ($_smarty_tpl->tpl_vars['RECORD']->value->get('email_flag') == "SAVED") {?><small><em><?php echo vtranslate('LBL_DRAFTED_ON',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</em></small><span><small><em>&nbsp;<?php echo Vtiger_Util_Helper::formatDateTimeIntoDayString($_smarty_tpl->tpl_vars['RECORD']->value->get('createdtime'));?>
</em></small></span><?php } else { ?><small><em><?php echo vtranslate('LBL_SENT_ON',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</em></small><?php $_smarty_tpl->_assignInScope('SEND_TIME', (($_smarty_tpl->tpl_vars['RECORD']->value->get('date_start')).(' ')).($_smarty_tpl->tpl_vars['RECORD']->value->get('time_start')));?><span><small><em>&nbsp;<?php echo Vtiger_Util_Helper::formatDateTimeIntoDayString($_smarty_tpl->tpl_vars['SEND_TIME']->value);?>
</em></small></span><?php }?></span></span></div><div class="row"><span class="col-lg-12" style="text-align: center;"><span><strong> <?php echo vtranslate('LBL_OWNER',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 : <?php echo getOwnerName($_smarty_tpl->tpl_vars['RECORD']->value->get('assigned_user_id'));?>
</strong></span></span></div></div></form></div></div>
<?php }
}
