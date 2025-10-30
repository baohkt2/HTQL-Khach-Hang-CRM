<?php
/* Smarty version 4.5.5, created on 2025-09-16 07:15:33
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Settings\Workflows\ListViewRecordActions.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68c90e952a8345_12872455',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '62a33d1a7e74dee1a09c23d152050f69fb600e76' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Settings\\Workflows\\ListViewRecordActions.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68c90e952a8345_12872455 (Smarty_Internal_Template $_smarty_tpl) {
?><!--LIST VIEW RECORD ACTIONS--><div style="width:80px ;"><a class="deleteRecordButton" style=" opacity: 0; padding: 0 5px;"><i title="<?php echo vtranslate('LBL_DELETE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="fa fa-trash alignMiddle"></i></a><input style="opacity: 0;" <?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('status')) {?> checked value="on" <?php } else { ?> value="off"<?php }?> data-on-color="success"  data-id="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getId();?>
" type="checkbox" name="workflowstatus" id="workflowstatus"></div><?php }
}
