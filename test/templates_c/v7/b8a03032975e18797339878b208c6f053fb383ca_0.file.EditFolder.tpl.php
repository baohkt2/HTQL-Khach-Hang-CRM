<?php
/* Smarty version 4.5.5, created on 2025-09-30 08:54:20
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Reports\EditFolder.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68db9abc658679_43484485',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b8a03032975e18797339878b208c6f053fb383ca' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Reports\\EditFolder.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68db9abc658679_43484485 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="addFolderContainer" class="modal-dialog" style='min-width:350px;'><div class='modal-content'><?php $_smarty_tpl->_assignInScope('FOLDER_ID', $_smarty_tpl->tpl_vars['FOLDER_MODEL']->value->getId());
ob_start();
echo Vtiger_Util_Helper::tosafeHTML(vtranslate($_smarty_tpl->tpl_vars['FOLDER_MODEL']->value->getName(),$_smarty_tpl->tpl_vars['MODULE']->value));
$_prefixVariable1 = ob_get_clean();
$_smarty_tpl->_assignInScope('FOLDER_NAME', $_prefixVariable1);
ob_start();
echo vtranslate('LBL_ADD_NEW_FOLDER',$_smarty_tpl->tpl_vars['MODULE']->value);
$_prefixVariable2 = ob_get_clean();
$_smarty_tpl->_assignInScope('HEADER_TITLE', $_prefixVariable2);
if ($_smarty_tpl->tpl_vars['FOLDER_ID']->value) {
ob_start();
echo vtranslate('LBL_EDIT_FOLDER',$_smarty_tpl->tpl_vars['MODULE']->value);
$_prefixVariable3=ob_get_clean();
$_smarty_tpl->_assignInScope('HEADER_TITLE', $_prefixVariable3.": ".((string)$_smarty_tpl->tpl_vars['FOLDER_NAME']->value));
}
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0, true);
?><form class="form-horizontal contentsBackground" id="addFolder" method="post" action="index.php"><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
" /><input type="hidden" name="action" value="Folder" /><input type="hidden" name="mode" value="save" /><input type="hidden" name="folderid" value="<?php echo $_smarty_tpl->tpl_vars['FOLDER_MODEL']->value->getId();?>
" /><div class="modal-body"><div class="form-group"><label for="foldername" class="col-sm-4 control-label"><?php echo vtranslate('LBL_FOLDER_NAME',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<span class="redColor">*</span></label><div class="col-sm-7"><input id="foldername" name="foldername" class="form-control col-lg-12" data-rule-required="true" type="text" value="<?php echo $_smarty_tpl->tpl_vars['FOLDER_NAME']->value;?>
"/></div></div><div class="form-group"><label for="description" class="col-sm-4 control-label"><?php echo vtranslate('LBL_FOLDER_DESCRIPTION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label><div class="col-sm-7"><textarea name="description" class="form-control col-sm-12" rows="3" placeholder="<?php echo vtranslate('LBL_WRITE_YOUR_DESCRIPTION_HERE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['FOLDER_MODEL']->value->getDescription(),$_smarty_tpl->tpl_vars['MODULE']->value);?>
</textarea></div></div></div><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( 'ModalFooter.tpl',$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></form></div></div><?php }
}
