<?php
/* Smarty version 4.5.5, created on 2025-10-15 09:11:17
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\MailManager\MailOpen.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68ef65350df513_84104627',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3df07678fd288dfa60f991b46f1d5fa23ae4539d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\MailManager\\MailOpen.tpl',
      1 => 1758006150,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68ef65350df513_84104627 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\vtigercrm\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
?>
<div class="container-fluid padding0px"><input type="hidden" id="mmFrom" value='<?php echo implode(',',$_smarty_tpl->tpl_vars['MAIL']->value->from());?>
'><input type="hidden" id="mmSubject" value='<?php echo Vtiger_Functions::jsonEncode($_smarty_tpl->tpl_vars['MAIL']->value->subject());?>
'><input type="hidden" id="mmMsgNo" value="<?php echo $_smarty_tpl->tpl_vars['MAIL']->value->msgNo();?>
"><input type="hidden" id="mmMsgUid" value="<?php echo $_smarty_tpl->tpl_vars['MAIL']->value->uniqueid();?>
"><input type="hidden" id="mmFolder" value="<?php echo $_smarty_tpl->tpl_vars['FOLDER']->value->name();?>
"><input type="hidden" id="mmTo" value='<?php echo implode(',',$_smarty_tpl->tpl_vars['MAIL']->value->to());?>
'><input type="hidden" id="mmCc" value="<?php if (is_array($_smarty_tpl->tpl_vars['MAIL']->value->cc())) {
echo implode(',',$_smarty_tpl->tpl_vars['MAIL']->value->cc());
} else {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['MAIL']->value->cc(), ENT_QUOTES, 'UTF-8', true);
}?>"><input type="hidden" id="mmDate" value="<?php echo $_smarty_tpl->tpl_vars['MAIL']->value->date();?>
"><input type="hidden" id="mmUserName" value="<?php echo $_smarty_tpl->tpl_vars['USERNAME']->value;?>
"><?php $_smarty_tpl->_assignInScope('ATTACHMENT_COUNT', (php7_count($_smarty_tpl->tpl_vars['ATTACHMENTS']->value)-php7_count($_smarty_tpl->tpl_vars['INLINE_ATT']->value)));?><input type="hidden" id="mmAttchmentCount" value="<?php echo $_smarty_tpl->tpl_vars['ATTACHMENT_COUNT']->value;?>
"><div class="row" id="mailManagerActions"><div class="col-lg-12"><div class="col-lg-8 padding0px" id="relationBlock"></div><div class="col-lg-4 padding0px"><span class="pull-right"><button type="button" class="btn btn-default mailPagination marginRight0px" <?php if ($_smarty_tpl->tpl_vars['MAIL']->value->msgno() < $_smarty_tpl->tpl_vars['FOLDER']->value->count()) {?>data-folder='<?php echo $_smarty_tpl->tpl_vars['FOLDER']->value->name();?>
' data-msgno='<?php echo $_smarty_tpl->tpl_vars['MAIL']->value->msgno(1);?>
'<?php } else { ?>disabled="disabled"<?php }?>><i class="fa fa-caret-left"></i></button><button type="button" class="btn btn-default mailPagination" <?php if ($_smarty_tpl->tpl_vars['MAIL']->value->msgno() > 1) {?>data-folder='<?php echo $_smarty_tpl->tpl_vars['FOLDER']->value->name();?>
' data-msgno='<?php echo $_smarty_tpl->tpl_vars['MAIL']->value->msgno(-1);?>
'<?php } else { ?>disabled="disabled"<?php }?>><i class="fa fa-caret-right"></i></button></span></div></div></div><div class="row marginTop15px"><div class="col-lg-12 "><h5 class="marginTop0px"><?php echo $_smarty_tpl->tpl_vars['MAIL']->value->subject();?>
</h5></div></div><hr><div class="row"><div class="col-lg-2"><div class="mmFirstNameChar"><center><?php $_smarty_tpl->_assignInScope('NAME', $_smarty_tpl->tpl_vars['MAIL']->value->from());
$_smarty_tpl->_assignInScope('FIRST_CHAR', strtoupper(substr($_smarty_tpl->tpl_vars['NAME']->value[0],0,1)));
if ($_smarty_tpl->tpl_vars['FOLDER']->value->isSentFolder()) {
$_smarty_tpl->_assignInScope('NAME', $_smarty_tpl->tpl_vars['MAIL']->value->to());
if (smarty_modifier_count($_smarty_tpl->tpl_vars['NAME']->value) > 0) {
$_smarty_tpl->_assignInScope('FIRST_CHAR', strtoupper(substr($_smarty_tpl->tpl_vars['NAME']->value[0],0,1)));
} else {
$_smarty_tpl->_assignInScope('FIRST_CHAR', '');
}
}?><strong><?php echo $_smarty_tpl->tpl_vars['FIRST_CHAR']->value;?>
</strong></center></div></div><div class="col-lg-6"><span class="mmDisplayName"><?php if ($_smarty_tpl->tpl_vars['FOLDER']->value->isSentFolder()) {
echo implode(', ',$_smarty_tpl->tpl_vars['MAIL']->value->to());
} else {
echo $_smarty_tpl->tpl_vars['NAME']->value[0];
}?></span><?php if ($_smarty_tpl->tpl_vars['ATTACHMENT_COUNT']->value) {?>&nbsp;&nbsp;<i class="fa fa-paperclip fontSize20px"></i><?php }?><span><?php $_smarty_tpl->_assignInScope('FROM', $_smarty_tpl->tpl_vars['MAIL']->value->from());?>&nbsp;&nbsp;<a href="javascript:void(0)" class="emailDetails" role="tooltip" data-toggle="popover" data-trigger="focus" title="<strong><?php echo vtranslate('LBL_DETAILS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong>"data-content="<table><tr><td class='muted input-info-addon'><?php echo vtranslate('LBL_FROM',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td><td class='displayEmailValues'><?php echo $_smarty_tpl->tpl_vars['FROM']->value[0];?>
</td></tr><tr><td>&nbsp;</td></tr><tr><td class='muted input-info-addon'><?php echo vtranslate('LBL_TO',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td><td class='displayEmailValues'><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MAIL']->value->to(), 'TO_VAL');
$_smarty_tpl->tpl_vars['TO_VAL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['TO_VAL']->value) {
$_smarty_tpl->tpl_vars['TO_VAL']->do_else = false;
echo $_smarty_tpl->tpl_vars['TO_VAL']->value;?>
<br><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></td></tr><tr><td>&nbsp;</td></tr><?php if ($_smarty_tpl->tpl_vars['MAIL']->value->cc()) {?><tr><td class='muted input-info-addon'><?php echo vtranslate('LBL_CC_SMALL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td><td class='displayEmailValues'><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MAIL']->value->cc(), 'CC_VAL');
$_smarty_tpl->tpl_vars['CC_VAL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['CC_VAL']->value) {
$_smarty_tpl->tpl_vars['CC_VAL']->do_else = false;
echo $_smarty_tpl->tpl_vars['CC_VAL']->value;?>
<br><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></td></tr><tr><td>&nbsp;</td></tr><?php }
if ($_smarty_tpl->tpl_vars['MAIL']->value->bcc()) {?><tr><td class='muted input-info-addon'><?php echo vtranslate('LBL_BCC_SMALL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td><td class='displayEmailValues'><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MAIL']->value->bcc(), 'BCC_VAL');
$_smarty_tpl->tpl_vars['BCC_VAL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['BCC_VAL']->value) {
$_smarty_tpl->tpl_vars['BCC_VAL']->do_else = false;
echo $_smarty_tpl->tpl_vars['BCC_VAL']->value;?>
<br><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></td></tr><tr><td>&nbsp;</td></tr><?php }?></table>"><i class="fa fa-caret-down" title="<?php echo vtranslate('LBL_SHOW_FULL_DETAILS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" style='border: 1px solid #AAA; padding: 0 2px; color: #AAA;'></i></a></span></div><div class="col-lg-4"><span class="pull-right mmDetailDate"><?php echo Vtiger_Util_Helper::formatDateTimeIntoDayString($_smarty_tpl->tpl_vars['MAIL']->value->date(),true);?>
</span></div></div><div class="clearfix"><div class="pull-right"><span class="cursorPointer mmDetailAction" id='mmPrint' title='<?php echo vtranslate('LBL_Print',$_smarty_tpl->tpl_vars['MODULE']->value);?>
'><i class="fa fa-print"></i></span><span class="cursorPointer mmDetailAction" id='mmReply' title='<?php echo vtranslate('LBL_Reply',$_smarty_tpl->tpl_vars['MODULE']->value);?>
'><i class="fa fa-reply"></i></span><span class="cursorPointer mmDetailAction" id='mmReplyAll' title='<?php echo vtranslate('LBL_Reply_All',$_smarty_tpl->tpl_vars['MODULE']->value);?>
'><i class="fa fa-reply-all"></i></span><span class="cursorPointer mmDetailAction" id='mmForward' title='<?php echo vtranslate('LBL_Forward',$_smarty_tpl->tpl_vars['MODULE']->value);?>
'><i class="fa fa-share"></i></span><span class="cursorPointer mmDetailAction" id='mmDelete' title='<?php echo vtranslate('LBL_Delete',$_smarty_tpl->tpl_vars['MODULE']->value);?>
' style="border-right: 1px solid #BBBBBB;"><i class="fa fa-trash-o"></i></span></div></div><br><div class="row"><div class="col-lg-12 mmEmailContainerDiv"><div id='mmBody'><?php echo $_smarty_tpl->tpl_vars['BODY']->value;?>
</div></div></div><?php if ($_smarty_tpl->tpl_vars['ATTACHMENT_COUNT']->value) {?><br><hr class="mmDetailHr"><br><div class='col-lg-12 padding0px'><span><strong><?php echo vtranslate('LBL_Attachments',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></span><span>&nbsp;&nbsp;(<?php echo php7_count($_smarty_tpl->tpl_vars['ATTACHMENTS']->value)-php7_count($_smarty_tpl->tpl_vars['INLINE_ATT']->value);?>
&nbsp;<?php echo vtranslate('LBL_FILES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
)</span><br><br><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ATTACHMENTS']->value, 'ATTACHVALUE', false, NULL, 'attach', array (
));
$_smarty_tpl->tpl_vars['ATTACHVALUE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ATTACHVALUE']->value) {
$_smarty_tpl->tpl_vars['ATTACHVALUE']->do_else = false;
$_smarty_tpl->_assignInScope('ATTACHNAME', $_smarty_tpl->tpl_vars['ATTACHVALUE']->value['filename']);
if ($_smarty_tpl->tpl_vars['INLINE_ATT']->value[$_smarty_tpl->tpl_vars['ATTACHNAME']->value] == null) {
$_smarty_tpl->_assignInScope('DOWNLOAD_LINK', rawurlencode((string)$_smarty_tpl->tpl_vars['ATTACHNAME']->value));
$_smarty_tpl->_assignInScope('ATTACHID', $_smarty_tpl->tpl_vars['ATTACHVALUE']->value['attachid']);?><span><i class="fa <?php echo $_smarty_tpl->tpl_vars['MAIL']->value->getAttachmentIcon($_smarty_tpl->tpl_vars['ATTACHVALUE']->value['path']);?>
"></i>&nbsp;&nbsp;<a href="index.php?module=<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
&view=Index&_operation=mail&_operationarg=attachment_dld&_muid=<?php echo $_smarty_tpl->tpl_vars['MAIL']->value->muid();?>
&_atid=<?php echo $_smarty_tpl->tpl_vars['ATTACHID']->value;?>
&_atname=<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['DOWNLOAD_LINK']->value, 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
"><?php echo $_smarty_tpl->tpl_vars['ATTACHNAME']->value;?>
</a><span>&nbsp;&nbsp;(<?php echo $_smarty_tpl->tpl_vars['ATTACHVALUE']->value['size'];?>
)</span><a href="index.php?module=<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
&view=Index&_operation=mail&_operationarg=attachment_dld&_muid=<?php echo $_smarty_tpl->tpl_vars['MAIL']->value->muid();?>
&_atid=<?php echo $_smarty_tpl->tpl_vars['ATTACHID']->value;?>
&_atname=<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['DOWNLOAD_LINK']->value, 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
">&nbsp;&nbsp;<i class="fa fa-download"></i></a></span><br><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></div><?php }?></div>
<?php }
}
