<?php
/* Smarty version 4.5.5, created on 2025-10-14 07:33:27
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Leads\ConvertLeadError.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68edfcc7c0b677_83887873',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9db681f205b62a649724ecfca093a4c63fbfff73' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Leads\\ConvertLeadError.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68edfcc7c0b677_83887873 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="row" style="border: 3px solid rgb(153, 153, 153); background-color: rgb(255, 255, 255);position: relative; z-index: 10000000; padding: 10px; width: 80%; margin: 0 auto; margin-top: 5%;"><div class ="col-lg-1 col-sm-2 col-md-1" style="float: left;"><img src="<?php echo vimage_path('denied.gif');?>
" ></div><div class ="col-lg-11 col-sm-10 col-md-11" nowrap="nowrap"><span class="genHeaderSmall"><?php if ($_smarty_tpl->tpl_vars['IS_DUPICATES_FAILURE']->value) {?><span><?php echo $_smarty_tpl->tpl_vars['EXCEPTION']->value;?>
</span><?php } else {
$_smarty_tpl->_assignInScope('SINGLE_MODULE', "SINGLE_".((string)$_smarty_tpl->tpl_vars['MODULE']->value));?><span class="genHeaderSmall"><?php echo vtranslate($_smarty_tpl->tpl_vars['SINGLE_MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate('CANNOT_CONVERT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<br><ul> <?php echo vtranslate('LBL_FOLLOWING_ARE_POSSIBLE_REASONS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
:<li><?php echo vtranslate('LBL_LEADS_FIELD_MAPPING_INCOMPLETE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</li><li><?php echo vtranslate('LBL_MANDATORY_FIELDS_ARE_EMPTY',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</li><?php if ($_smarty_tpl->tpl_vars['EXCEPTION']->value) {?><li><?php echo $_smarty_tpl->tpl_vars['EXCEPTION']->value;?>
</li><?php }?></ul></span><?php }?></span><hr><div class="small" align="right" nowrap="nowrap"><?php if (!$_smarty_tpl->tpl_vars['IS_DUPICATES_FAILURE']->value && $_smarty_tpl->tpl_vars['CURRENT_USER']->value->isAdminUser()) {?><a href="index.php?parent=Settings&module=Leads&view=MappingDetail"><?php echo vtranslate('LBL_LEADS_FIELD_MAPPING',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a><br><?php }?><a href="javascript:window.history.back();"><?php echo vtranslate('LBL_GO_BACK',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a><br></div></div></div>

<?php }
}
