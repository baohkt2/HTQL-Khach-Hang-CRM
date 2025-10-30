<?php
/* Smarty version 4.5.5, created on 2025-10-15 07:32:20
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\MailManager\FolderOpen.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68ef4e04e93152_81064777',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f525c5fff8bef7ba19d9dc6f6ce91970f8940d07' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\MailManager\\FolderOpen.tpl',
      1 => 1758006150,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68ef4e04e93152_81064777 (Smarty_Internal_Template $_smarty_tpl) {
?><div class='col-lg-12 padding0px'><span class="col-lg-1 paddingLeft5px"><input type='checkbox' id='mainCheckBox' class="pull-left"></span><span class="col-lg-5 padding0px"><span class="fa-stack fa-sm cursorPointer mmActionIcon" id="mmMarkAsRead" data-folder="<?php echo $_smarty_tpl->tpl_vars['FOLDER']->value->name();?>
" title="<?php echo vtranslate('LBL_MARK_AS_READ',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><img src="layouts/v7/skins/images/envelope-open.png" id="mmEnvelopeOpenIcon"></span><span class="fa-stack fa-sm cursorPointer mmActionIcon" id="mmMarkAsUnread" data-folder="<?php echo $_smarty_tpl->tpl_vars['FOLDER']->value->name();?>
" title="<?php echo vtranslate('LBL_Mark_As_Unread',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i class="fa fa-envelope fa-stack-lg"></i></span><span class="fa-stack fa-sm cursorPointer mmActionIcon" id="mmDeleteMail" data-folder="<?php echo $_smarty_tpl->tpl_vars['FOLDER']->value->name();?>
" title="<?php echo vtranslate('LBL_Delete',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i class="fa fa-trash-o fa-stack-lg"></i></span><span class="fa-stack fa-sm cursorPointer moveToFolderDropDown more dropdown action" title="<?php echo vtranslate('LBL_MOVE_TO',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><span class='dropdown-toggle' data-toggle="dropdown"><i class="fa fa-folder mmMoveDropdownFolder"></i><i class="fa fa-arrow-right mmMoveDropdownArrow"></i><i class="fa fa-caret-down pull-right mmMoveDropdownCaret"></i></span><ul class="dropdown-menu" id="mmMoveToFolder"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FOLDERLIST']->value, 'folder');
$_smarty_tpl->tpl_vars['folder']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['folder']->value) {
$_smarty_tpl->tpl_vars['folder']->do_else = false;
?><li data-folder="<?php echo $_smarty_tpl->tpl_vars['FOLDER']->value->name();?>
" data-movefolder='<?php echo $_smarty_tpl->tpl_vars['folder']->value;?>
'><a class="paddingLeft15"><?php if (mb_strlen($_smarty_tpl->tpl_vars['folder']->value,'UTF-8') > 20) {
echo mb_substr($_smarty_tpl->tpl_vars['folder']->value,0,20,'UTF-8');?>
...<?php } else {
echo $_smarty_tpl->tpl_vars['folder']->value;
}?></a></li><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></ul></span></span><span class="col-lg-6 padding0px"><span class="pull-right"><?php if ($_smarty_tpl->tpl_vars['FOLDER']->value->mails()) {?><span class="pageInfo"><?php echo $_smarty_tpl->tpl_vars['FOLDER']->value->pageInfo();?>
&nbsp;&nbsp;</span> <span class="pageInfoData" data-start="<?php echo $_smarty_tpl->tpl_vars['FOLDER']->value->getStartCount();?>
" data-end="<?php echo $_smarty_tpl->tpl_vars['FOLDER']->value->getEndCount();?>
" data-total="<?php echo $_smarty_tpl->tpl_vars['FOLDER']->value->count();?>
" data-label-of="<?php echo vtranslate('LBL_OF');?>
"></span><?php }?><button type="button" id="PreviousPageButton" class="btn btn-default marginRight0px" <?php if ($_smarty_tpl->tpl_vars['FOLDER']->value->hasPrevPage()) {?>data-folder='<?php echo $_smarty_tpl->tpl_vars['FOLDER']->value->name();?>
' data-page='<?php echo $_smarty_tpl->tpl_vars['FOLDER']->value->pageCurrent(-1);?>
'<?php } else { ?>disabled="disabled"<?php }?>><i class="fa fa-caret-left"></i></button><button type="button" id="NextPageButton" class="btn btn-default" <?php if ($_smarty_tpl->tpl_vars['FOLDER']->value->hasNextPage()) {?>data-folder='<?php echo $_smarty_tpl->tpl_vars['FOLDER']->value->name();?>
' data-page='<?php echo $_smarty_tpl->tpl_vars['FOLDER']->value->pageCurrent(1);?>
'<?php } else { ?>disabled="disabled"<?php }?>><i class="fa fa-caret-right"></i></button></span></span></div><div class='col-lg-12 padding0px'><div class="col-lg-10 mmSearchContainerOther"><div><div class="input-group col-lg-8 padding0px"><input type="text" class="form-control" id="mailManagerSearchbox" aria-describedby="basic-addon2" value="<?php echo $_smarty_tpl->tpl_vars['QUERY']->value;?>
" data-foldername='<?php echo $_smarty_tpl->tpl_vars['FOLDER']->value->name();?>
' placeholder="<?php echo vtranslate('LBL_TYPE_TO_SEARCH',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"></div><div class="col-lg-4 padding0px mmSearchDropDown"><select id="searchType" style="background: #DDDDDD url('layouts/v7/skins/images/arrowdown.png') no-repeat 95% 40%; padding-left: 9px;"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['SEARCHOPTIONS']->value, 'arr', false, 'option');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['option']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['arr']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['arr']->value == $_smarty_tpl->tpl_vars['TYPE']->value) {?>selected<?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['option']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></div></div></div><div class='col-lg-2' id="mmSearchButtonContainer"><button id='mm_searchButton' class="pull-right"><?php echo vtranslate('LBL_Search',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button></div></div><?php if ($_smarty_tpl->tpl_vars['FOLDER']->value->mails()) {?><div class="col-lg-12 mmEmailContainerDiv padding0px" id='emailListDiv' style="margin-top:10px"><?php $_smarty_tpl->_assignInScope('IS_SENT_FOLDER', $_smarty_tpl->tpl_vars['FOLDER']->value->isSentFolder());?><input type="hidden" name="folderMailIds" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'implode' ][ 0 ], array( ',',$_smarty_tpl->tpl_vars['FOLDER']->value->mailIds() ));?>
"/><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FOLDER']->value->mails(), 'MAIL');
$_smarty_tpl->tpl_vars['MAIL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['MAIL']->value) {
$_smarty_tpl->tpl_vars['MAIL']->do_else = false;
if ($_smarty_tpl->tpl_vars['MAIL']->value->isRead()) {
$_smarty_tpl->_assignInScope('IS_READ', 1);
} else {
$_smarty_tpl->_assignInScope('IS_READ', 0);
}?><div class="col-lg-12 cursorPointer mailEntry <?php if ($_smarty_tpl->tpl_vars['IS_READ']->value) {?>mmReadEmail<?php }?>" id='mmMailEntry_<?php echo $_smarty_tpl->tpl_vars['MAIL']->value->msgNo();?>
' data-folder="<?php echo $_smarty_tpl->tpl_vars['FOLDER']->value->name();?>
" data-read='<?php echo $_smarty_tpl->tpl_vars['IS_READ']->value;?>
'><span class="col-lg-1 paddingLeft5px"><input type='checkbox' class='mailCheckBox' class="pull-left"></span><div class="col-lg-11 mmfolderMails padding0px" title="<?php echo $_smarty_tpl->tpl_vars['MAIL']->value->subject();?>
"><input type="hidden" class="msgNo" value='<?php echo $_smarty_tpl->tpl_vars['MAIL']->value->msgNo();?>
'><input type="hidden" class='mm_foldername' value='<?php echo $_smarty_tpl->tpl_vars['FOLDER']->value->name();?>
'><div class="col-lg-8 nameSubjectHolder font11px padding0px stepText"><?php $_smarty_tpl->_assignInScope('DISPLAY_NAME', $_smarty_tpl->tpl_vars['MAIL']->value->from(33));
if ($_smarty_tpl->tpl_vars['IS_SENT_FOLDER']->value) {
$_smarty_tpl->_assignInScope('DISPLAY_NAME', $_smarty_tpl->tpl_vars['MAIL']->value->to(33));
}
$_smarty_tpl->_assignInScope('SUBJECT', $_smarty_tpl->tpl_vars['MAIL']->value->subject());
if (mb_strlen($_smarty_tpl->tpl_vars['SUBJECT']->value,'UTF-8') > 33) {
$_smarty_tpl->_assignInScope('SUBJECT', mb_substr($_smarty_tpl->tpl_vars['MAIL']->value->subject(),0,30,'UTF-8'));
}
if ($_smarty_tpl->tpl_vars['IS_READ']->value) {
echo strip_tags($_smarty_tpl->tpl_vars['DISPLAY_NAME']->value);?>
<br><?php echo strip_tags($_smarty_tpl->tpl_vars['SUBJECT']->value);
} else { ?><strong><?php echo strip_tags($_smarty_tpl->tpl_vars['DISPLAY_NAME']->value);?>
<br><?php echo strip_tags($_smarty_tpl->tpl_vars['SUBJECT']->value);?>
</strong><?php }?></div><div class="col-lg-4 padding0px"><?php $_smarty_tpl->_assignInScope('ATTACHMENT', $_smarty_tpl->tpl_vars['MAIL']->value->attachments());
$_smarty_tpl->_assignInScope('INLINE_ATTCH', $_smarty_tpl->tpl_vars['MAIL']->value->inlineAttachments());
$_smarty_tpl->_assignInScope('ATTCHMENT_COUNT', (php7_count($_smarty_tpl->tpl_vars['ATTACHMENT']->value)-php7_count($_smarty_tpl->tpl_vars['INLINE_ATTCH']->value)));?><span class="pull-right"><?php if ($_smarty_tpl->tpl_vars['ATTCHMENT_COUNT']->value) {?><i class="fa fa-paperclip font14px"></i>&nbsp;<?php }?><span class='mmDateTimeValue' title="<?php echo Vtiger_Util_Helper::formatDateTimeIntoDayString(date('Y-m-d H:i:s',strtotime($_smarty_tpl->tpl_vars['MAIL']->value->_date)));?>
"><?php echo Vtiger_Util_Helper::formatDateDiffInStrings(date('Y-m-d H:i:s',strtotime($_smarty_tpl->tpl_vars['MAIL']->value->_date)));?>
</span></span></div><div class="col-lg-12 mmMailDesc"><img src="<?php echo vimage_path('128-dithered-regular.gif');?>
"></img></div></div></div><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></div><?php } else { ?><div class="noMailsDiv"><center><strong><?php echo vtranslate('LBL_No_Mails_Found',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></center></div><?php }
}
}
