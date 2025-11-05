<?php
/* Smarty version 4.5.5, created on 2025-11-05 04:54:23
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\ITS4YouEmails\Footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690ad87f2930e9_19266489',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9e82d9c3441998ba2bc3cbef375056bbe26a9fcb' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\ITS4YouEmails\\Footer.tpl',
      1 => 1762316121,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690ad87f2930e9_19266489 (Smarty_Internal_Template $_smarty_tpl) {
?>
<br><div class="small" style="color: rgb(153, 153, 153);text-align: center;"><?php echo vtranslate('ITS4YouEmails','ITS4YouEmails');?>
 <?php echo ITS4YouEmails_Version_Helper::$version;?>
 <?php echo vtranslate('COPYRIGHT','ITS4YouEmails');?>
</div><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "Footer.tpl",'Vtiger' )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
}
