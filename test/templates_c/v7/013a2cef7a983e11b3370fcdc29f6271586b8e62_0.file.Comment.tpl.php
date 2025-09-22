<?php
/* Smarty version 4.5.5, created on 2025-09-16 08:32:46
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Vtiger\Comment.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68c920ae0d4126_94854639',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '013a2cef7a983e11b3370fcdc29f6271586b8e62' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Vtiger\\Comment.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68c920ae0d4126_94854639 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('PRIVATE_COMMENT_MODULES', Vtiger_Functions::getPrivateCommentModules());?><div class="commentDiv <?php if ($_smarty_tpl->tpl_vars['COMMENT']->value->get('is_private')) {?>privateComment<?php }?>"><div class="singleComment"><input type="hidden" name="is_private" value="<?php echo $_smarty_tpl->tpl_vars['COMMENT']->value->get('is_private');?>
"><div class="commentInfoHeader" data-commentid="<?php echo $_smarty_tpl->tpl_vars['COMMENT']->value->getId();?>
" data-parentcommentid="<?php echo $_smarty_tpl->tpl_vars['COMMENT']->value->get('parent_comments');?>
" data-relatedto = "<?php echo $_smarty_tpl->tpl_vars['COMMENT']->value->get('related_to');?>
"><?php $_smarty_tpl->_assignInScope('PARENT_COMMENT_MODEL', $_smarty_tpl->tpl_vars['COMMENT']->value->getParentCommentModel());
$_smarty_tpl->_assignInScope('CHILD_COMMENTS_MODEL', $_smarty_tpl->tpl_vars['COMMENT']->value->getChildComments());?><div class="row"><div class="col-lg-12"><div class="media"><div class="media-left title" id="<?php echo $_smarty_tpl->tpl_vars['COMMENT']->value->getId();?>
"><?php ob_start();
echo decode_html($_smarty_tpl->tpl_vars['COMMENT']->value->getCommentedByName());
$_prefixVariable1 = ob_get_clean();
$_smarty_tpl->_assignInScope('CREATOR_NAME', $_prefixVariable1);?><div class="col-lg-2 recordImage commentInfoHeader" style ="width:50px; height:50px; font-size: 30px;" data-commentid="<?php echo $_smarty_tpl->tpl_vars['COMMENT']->value->getId();?>
" data-parentcommentid="<?php echo $_smarty_tpl->tpl_vars['COMMENT']->value->get('parent_comments');?>
" data-relatedto = "<?php echo $_smarty_tpl->tpl_vars['COMMENT']->value->get('related_to');?>
"><?php $_smarty_tpl->_assignInScope('IMAGE_PATH', $_smarty_tpl->tpl_vars['COMMENT']->value->getImagePath());
if (!empty($_smarty_tpl->tpl_vars['IMAGE_PATH']->value)) {?><img src="<?php echo $_smarty_tpl->tpl_vars['IMAGE_PATH']->value;?>
" width="100%" height="100%" align="left"><?php } else { ?><div class="name"><span><strong> <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'substr' ][ 0 ], array( $_smarty_tpl->tpl_vars['CREATOR_NAME']->value,0,2 ));?>
 </strong></span></div><?php }?></div></div><div class="media-body"><div class="comment" style="line-height:1;"><span class="creatorName" style="color:blue"><?php echo $_smarty_tpl->tpl_vars['CREATOR_NAME']->value;?>
</span>&nbsp;&nbsp;<?php if ((isset($_smarty_tpl->tpl_vars['ROLLUP_STATUS']->value)) && $_smarty_tpl->tpl_vars['ROLLUP_STATUS']->value && $_smarty_tpl->tpl_vars['COMMENT']->value->get('module') != $_smarty_tpl->tpl_vars['MODULE_NAME']->value) {
$_smarty_tpl->_assignInScope('SINGULR_MODULE', ('SINGLE_').($_smarty_tpl->tpl_vars['COMMENT']->value->get('module')));
$_smarty_tpl->_assignInScope('ENTITY_NAME', getEntityName($_smarty_tpl->tpl_vars['COMMENT']->value->get('module'),array($_smarty_tpl->tpl_vars['COMMENT']->value->get('related_to'))));?><span class="text-muted"><?php echo vtranslate('LBL_ON','Vtiger');?>
&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['SINGULR_MODULE']->value,$_smarty_tpl->tpl_vars['COMMENT']->value->get('module'));?>
&nbsp;<a href="index.php?module=<?php echo $_smarty_tpl->tpl_vars['COMMENT']->value->get('module');?>
&view=Detail&record=<?php echo $_smarty_tpl->tpl_vars['COMMENT']->value->get('related_to');?>
"><?php echo $_smarty_tpl->tpl_vars['ENTITY_NAME']->value[$_smarty_tpl->tpl_vars['COMMENT']->value->get('related_to')];?>
</a></span>&nbsp;&nbsp;<?php }?><span class="commentTime text-muted cursorDefault"><small title="<?php echo Vtiger_Util_Helper::formatDateTimeIntoDayString($_smarty_tpl->tpl_vars['COMMENT']->value->getCommentedTime());?>
"><?php echo Vtiger_Util_Helper::formatDateDiffInStrings($_smarty_tpl->tpl_vars['COMMENT']->value->getCommentedTime());?>
</small></span>&nbsp;&nbsp;<?php if (in_array($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['PRIVATE_COMMENT_MODULES']->value)) {?><span><?php if ($_smarty_tpl->tpl_vars['COMMENT']->value->get('is_private')) {?><i class="fa fa-lock" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo vtranslate('LBL_INTERNAL_COMMENT_TOOTLTIP',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"></i><?php } else { ?><i class="fa fa-unlock" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo vtranslate('LBL_EXTERNAL_COMMENT_TOOTLTIP',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"></i><?php }?></span><?php }?><div class="commentInfoContentBlock"><span class="commentInfoContent"><?php echo nl2br($_smarty_tpl->tpl_vars['COMMENT']->value->get('commentcontent'));?>
</span></div><br><div class="commentActionsContainer"><span class="commentActions"><?php if ((isset($_smarty_tpl->tpl_vars['CHILDS_ROOT_PARENT_MODEL']->value)) && $_smarty_tpl->tpl_vars['CHILDS_ROOT_PARENT_MODEL']->value) {
$_smarty_tpl->_assignInScope('CHILDS_ROOT_PARENT_ID', $_smarty_tpl->tpl_vars['CHILDS_ROOT_PARENT_MODEL']->value->getId());
}
if ($_smarty_tpl->tpl_vars['COMMENTS_MODULE_MODEL']->value->isPermitted('EditView')) {
if ((isset($_smarty_tpl->tpl_vars['CHILDS_ROOT_PARENT_MODEL']->value)) && $_smarty_tpl->tpl_vars['CHILDS_ROOT_PARENT_MODEL']->value) {
$_smarty_tpl->_assignInScope('CHILDS_ROOT_PARENT_ID', $_smarty_tpl->tpl_vars['CHILDS_ROOT_PARENT_MODEL']->value->getId());
}?><a href="javascript:void(0);" class="cursorPointer replyComment feedback" style="color: blue;"><?php echo vtranslate('LBL_REPLY',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</a><?php if ($_smarty_tpl->tpl_vars['CURRENTUSER']->value->getId() == $_smarty_tpl->tpl_vars['COMMENT']->value->get('userid')) {?>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" class="cursorPointer editComment feedback" style="color: blue;"><?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</a><?php }
}
$_smarty_tpl->_assignInScope('CHILD_COMMENTS_COUNT', $_smarty_tpl->tpl_vars['COMMENT']->value->getChildCommentsCount());
if ($_smarty_tpl->tpl_vars['CHILD_COMMENTS_MODEL']->value != null && ((isset($_smarty_tpl->tpl_vars['CHILDS_ROOT_PARENT_ID']->value)) && $_smarty_tpl->tpl_vars['CHILDS_ROOT_PARENT_ID']->value != $_smarty_tpl->tpl_vars['PARENT_COMMENT_ID']->value)) {
if ($_smarty_tpl->tpl_vars['COMMENTS_MODULE_MODEL']->value->isPermitted('EditView')) {?>&nbsp;&nbsp;&nbsp;<?php }?><span class="viewThreadBlock" data-child-comments-count="<?php echo $_smarty_tpl->tpl_vars['CHILD_COMMENTS_COUNT']->value;?>
"><a href="javascript:void(0)" class="cursorPointer viewThread" style="color: blue;"><span class="childCommentsCount"><?php echo $_smarty_tpl->tpl_vars['CHILD_COMMENTS_COUNT']->value;?>
</span>&nbsp;<?php if ($_smarty_tpl->tpl_vars['CHILD_COMMENTS_COUNT']->value == 1) {
echo vtranslate('LBL_REPLY',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);
} else {
echo vtranslate('LBL_REPLIES',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);
}?>&nbsp;</a></span><span class="hideThreadBlock" data-child-comments-count="<?php echo $_smarty_tpl->tpl_vars['CHILD_COMMENTS_COUNT']->value;?>
" style="display:none;"><a href="javascript:void(0)" class="cursorPointer hideThread" style="color: blue;"><span class="childCommentsCount"><?php echo $_smarty_tpl->tpl_vars['CHILD_COMMENTS_COUNT']->value;?>
</span>&nbsp;<?php if ($_smarty_tpl->tpl_vars['CHILD_COMMENTS_COUNT']->value == 1) {
echo vtranslate('LBL_REPLY',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);
} else {
echo vtranslate('LBL_REPLIES',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);
}?>&nbsp;</a></span><?php } elseif ($_smarty_tpl->tpl_vars['CHILD_COMMENTS_MODEL']->value != null && ((isset($_smarty_tpl->tpl_vars['CHILDS_ROOT_PARENT_ID']->value)) && $_smarty_tpl->tpl_vars['CHILDS_ROOT_PARENT_ID']->value == $_smarty_tpl->tpl_vars['PARENT_COMMENT_ID']->value)) {
if ($_smarty_tpl->tpl_vars['COMMENTS_MODULE_MODEL']->value->isPermitted('EditView')) {?>&nbsp;&nbsp;&nbsp;<?php }?><span class="viewThreadBlock" data-child-comments-count="<?php echo $_smarty_tpl->tpl_vars['CHILD_COMMENTS_COUNT']->value;?>
" style="display:none;"><a href="javascript:void(0)" class="cursorPointer viewThread" style="color: blue;"><span class="childCommentsCount"><?php echo $_smarty_tpl->tpl_vars['CHILD_COMMENTS_COUNT']->value;?>
</span>&nbsp;<?php if ($_smarty_tpl->tpl_vars['CHILD_COMMENTS_COUNT']->value == 1) {
echo vtranslate('LBL_REPLY',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);
} else {
echo vtranslate('LBL_REPLIES',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);
}?>&nbsp;</a></span><span class="hideThreadBlock" data-child-comments-count="<?php echo $_smarty_tpl->tpl_vars['CHILD_COMMENTS_COUNT']->value;?>
"><a href="javascript:void(0)" class="cursorPointer hideThread" style="color: blue;"><span class="childCommentsCount"><?php echo $_smarty_tpl->tpl_vars['CHILD_COMMENTS_COUNT']->value;?>
</span>&nbsp;<?php if ($_smarty_tpl->tpl_vars['CHILD_COMMENTS_COUNT']->value == 1) {
echo vtranslate('LBL_REPLY',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);
} else {
echo vtranslate('LBL_REPLIES',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);
}?>&nbsp;</a></span><?php }?></span></div><?php $_smarty_tpl->_assignInScope('REASON_TO_EDIT', $_smarty_tpl->tpl_vars['COMMENT']->value->get('reasontoedit'));
if ($_smarty_tpl->tpl_vars['COMMENT']->value->getCommentedTime() != $_smarty_tpl->tpl_vars['COMMENT']->value->getModifiedTime()) {?><br><div class="commentEditStatus" name="editStatus"><?php $_smarty_tpl->_assignInScope('REASON_TO_EDIT', $_smarty_tpl->tpl_vars['COMMENT']->value->get('reasontoedit'));
if ($_smarty_tpl->tpl_vars['REASON_TO_EDIT']->value) {?><div class="text-muted"><small><?php echo vtranslate('LBL_EDIT_REASON',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 : <span name="editReason" class="textOverflowEllipsis"><?php echo nl2br($_smarty_tpl->tpl_vars['REASON_TO_EDIT']->value);?>
</span></small></div><?php }?><div style="margin-top:5px;" class="text-muted"><small><?php echo vtranslate('LBL_COMMENT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 <?php echo strtolower(vtranslate('LBL_MODIFIED',$_smarty_tpl->tpl_vars['MODULE_NAME']->value));?>
</small>&nbsp;<small title="<?php echo Vtiger_Util_Helper::formatDateTimeIntoDayString($_smarty_tpl->tpl_vars['COMMENT']->value->getModifiedTime());?>
" class="commentModifiedTime"><?php echo Vtiger_Util_Helper::formatDateDiffInStrings($_smarty_tpl->tpl_vars['COMMENT']->value->getModifiedTime());?>
</small></div></div><?php }?><div style="margin-top:5px;"><?php $_smarty_tpl->_assignInScope('FILE_DETAILS', $_smarty_tpl->tpl_vars['COMMENT']->value->getFileNameAndDownloadURL());
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FILE_DETAILS']->value, 'FILE_DETAIL', false, 'index');
$_smarty_tpl->tpl_vars['FILE_DETAIL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['index']->value => $_smarty_tpl->tpl_vars['FILE_DETAIL']->value) {
$_smarty_tpl->tpl_vars['FILE_DETAIL']->do_else = false;
$_smarty_tpl->_assignInScope('FILE_NAME', $_smarty_tpl->tpl_vars['FILE_DETAIL']->value['trimmedFileName']);
if (!empty($_smarty_tpl->tpl_vars['FILE_NAME']->value)) {?><div class="row-fluid"><div class="span11 commentAttachmentName"><span class="filePreview"><a onclick="Vtiger_Detail_Js.previewFile(event,<?php echo $_smarty_tpl->tpl_vars['COMMENT']->value->get('id');?>
,<?php echo $_smarty_tpl->tpl_vars['FILE_DETAIL']->value['attachmentId'];?>
);" data-filename="<?php echo $_smarty_tpl->tpl_vars['FILE_NAME']->value;?>
" href="javascript:void(0)" name="viewfile"><span title="<?php echo $_smarty_tpl->tpl_vars['FILE_DETAIL']->value['rawFileName'];?>
" style="line-height:1.5em;"><?php echo $_smarty_tpl->tpl_vars['FILE_NAME']->value;?>
</span>&nbsp</a>&nbsp;<a name="downloadfile" href="<?php echo $_smarty_tpl->tpl_vars['FILE_DETAIL']->value['url'];?>
"><i title="<?php echo vtranslate('LBL_DOWNLOAD_FILE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
" class="pull-left hide fa fa-download alignMiddle"></i></a></span></div></div><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></div></div></div></div></div></div></div></div><hr></div><?php }
}
