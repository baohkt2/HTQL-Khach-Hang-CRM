<?php
/* Smarty version 4.5.5, created on 2025-10-09 07:40:49
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Vtiger\ShowAllComments.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e767010e0204_28810791',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '34d903b7feae81fa790659d52a52199c4d0690e5' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Vtiger\\ShowAllComments.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e767010e0204_28810791 (Smarty_Internal_Template $_smarty_tpl) {
?><form id="detailView" method="POST"><?php $_smarty_tpl->_assignInScope('COMMENT_TEXTAREA_DEFAULT_ROWS', "2");
$_smarty_tpl->_assignInScope('PRIVATE_COMMENT_MODULES', Vtiger_Functions::getPrivateCommentModules());
$_smarty_tpl->_assignInScope('IS_CREATABLE', $_smarty_tpl->tpl_vars['COMMENTS_MODULE_MODEL']->value->isPermitted('CreateView'));
$_smarty_tpl->_assignInScope('IS_EDITABLE', $_smarty_tpl->tpl_vars['COMMENTS_MODULE_MODEL']->value->isPermitted('EditView'));?><div class="commentContainer commentsRelatedContainer container-fluid"><?php if ($_smarty_tpl->tpl_vars['IS_CREATABLE']->value) {?><div class="commentTitle row"><div class="addCommentBlock"><div class="commentTextArea"><textarea name="commentcontent" class="commentcontent form-control" placeholder="<?php echo vtranslate('LBL_POST_YOUR_COMMENT_HERE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
" rows="<?php echo $_smarty_tpl->tpl_vars['COMMENT_TEXTAREA_DEFAULT_ROWS']->value;?>
"></textarea></div><div class="row"><div class="col-xs-4 pull-right"><div class="pull-right"><?php if (in_array($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['PRIVATE_COMMENT_MODULES']->value)) {?><input type="checkbox" id="is_private" checked>&nbsp;&nbsp;<?php echo vtranslate('LBL_INTERNAL_COMMENT');?>
&nbsp;<i class="fa fa-question-circle cursorPointer" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo vtranslate('LBL_INTERNAL_COMMENT_INFO');?>
"></i>&nbsp;&nbsp;<?php }?><button class="btn btn-success btn-sm saveComment" type="button" data-mode="add"><strong><?php echo vtranslate('LBL_POST',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong></button></div></div><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getProfileReadWritePermission()) {?><div class="col-xs-8 pull-left"><?php $_smarty_tpl->_subTemplateRender(vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getTemplateName(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('MODULE'=>"ModComments"), 0, true);
?></div><?php }?></div></div></div><?php }?><div class="showcomments container-fluid row" style="margin-top:10px;"><div class="recentCommentsHeader row"><h4 class="display-inline-block col-lg-7 textOverflowEllipsis" title="<?php echo vtranslate('LBL_RECENT_COMMENTS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
"><?php echo vtranslate('LBL_COMMENTS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h4><?php if ($_smarty_tpl->tpl_vars['MODULE_NAME']->value != 'Leads') {?><div class="col-lg-5 commentHeader pull-right" style="margin-top:5px;text-align:right;padding-right:20px;"><div class="display-inline-block"><span class=""><?php echo vtranslate('LBL_ROLL_UP',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 &nbsp;</span><span class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="<?php echo vtranslate('LBL_ROLLUP_COMMENTS_INFO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></span>&nbsp;&nbsp;</div><input type="checkbox" class="bootstrap-switch" id="rollupcomments" hascomments="1" startindex="<?php echo $_smarty_tpl->tpl_vars['STARTINDEX']->value;?>
" data-view="relatedlist" rollupid="<?php echo $_smarty_tpl->tpl_vars['ROLLUPID']->value;?>
"rollup-status="<?php echo $_smarty_tpl->tpl_vars['ROLLUP_STATUS']->value;?>
" module="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
" record="<?php echo $_smarty_tpl->tpl_vars['MODULE_RECORD']->value;?>
" checked data-on-color="success"/></div><?php }?></div><hr><div class="commentsList commentsBody marginBottom15"><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( 'CommentsList.tpl' )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('COMMENT_MODULE_MODEL'=>$_smarty_tpl->tpl_vars['COMMENTS_MODULE_MODEL']->value,'IS_CREATABLE'=>$_smarty_tpl->tpl_vars['IS_CREATABLE']->value,'IS_EDITABLE'=>$_smarty_tpl->tpl_vars['IS_EDITABLE']->value), 0, true);
?></div><div class="hide basicAddCommentBlock container-fluid"><div class="commentTextArea row"><textarea name="commentcontent" class="commentcontent" placeholder="<?php echo vtranslate('LBL_POST_YOUR_COMMENT_HERE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
" rows="<?php echo $_smarty_tpl->tpl_vars['COMMENT_TEXTAREA_DEFAULT_ROWS']->value;?>
"></textarea></div><div class="pull-right row"><?php if (in_array($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['PRIVATE_COMMENT_MODULES']->value)) {?><input type="checkbox" id="is_private" checked>&nbsp;&nbsp;<?php echo vtranslate('LBL_INTERNAL_COMMENT');?>
&nbsp;&nbsp;<?php }?><button class="btn btn-success btn-sm saveComment" type="button" data-mode="add"><strong><?php echo vtranslate('LBL_POST',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong></button><a href="javascript:void(0);" class="cursorPointer closeCommentBlock cancelLink" type="reset"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</a></div></div><div class="hide basicEditCommentBlock container-fluid"><div class="row" style="padding-bottom: 10px;"><input style="width:100%;height:30px;" type="text" name="reasonToEdit" placeholder="<?php echo vtranslate('LBL_REASON_FOR_CHANGING_COMMENT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
" class="input-block-level"/></div><div class="row"><div class="commentTextArea"><textarea name="commentcontent" class="commentcontenthidden" placeholder="<?php echo vtranslate('LBL_ADD_YOUR_COMMENT_HERE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
" rows="<?php echo $_smarty_tpl->tpl_vars['COMMENT_TEXTAREA_DEFAULT_ROWS']->value;?>
"></textarea></div></div><input type="hidden" name="is_private"><div class="pull-right row"><button class="btn btn-success btn-sm saveComment" type="button" data-mode="edit"><strong><?php echo vtranslate('LBL_POST',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong></button><a href="javascript:void(0);" class="cursorPointer closeCommentBlock cancelLink" type="reset"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</a></div></div></div></div></form><?php }
}
