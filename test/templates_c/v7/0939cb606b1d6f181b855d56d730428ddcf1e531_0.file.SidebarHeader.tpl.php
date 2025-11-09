<?php
/* Smarty version 4.5.5, created on 2025-11-05 18:16:24
  from 'C:\xampp\htdocs\HTQL-Khach-Hang-CRM-vvan\layouts\v7\modules\Settings\ITS4YouInstaller\partials\SidebarHeader.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690b94784669e1_05443721',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0939cb606b1d6f181b855d56d730428ddcf1e531' => 
    array (
      0 => 'C:\\xampp\\htdocs\\HTQL-Khach-Hang-CRM-vvan\\layouts\\v7\\modules\\Settings\\ITS4YouInstaller\\partials\\SidebarHeader.tpl',
      1 => 1762352656,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:modules/Vtiger/partials/SidebarAppMenu.tpl' => 1,
  ),
),false)) {
function content_690b94784669e1_05443721 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('APP_IMAGE_MAP', array('MARKETING'=>'fa-users','SALES'=>'fa-dot-circle-o','SUPPORT'=>'fa-life-ring','INVENTORY'=>'vicon-inventory','PROJECT'=>'fa-briefcase','TOOLS'=>'fa-wrench'));?>

<div class="col-sm-12 col-xs-12 app-indicator-icon-container extensionstore app-MARKETING">
    <div class="row" title="<?php echo vtranslate('LBL_EXTENSION_STORE','Settings:$QUALIFIED_MODULE');?>
">
        <span class="app-indicator-icon cursorPointer fa fa-shopping-cart"></span>
    </div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:modules/Vtiger/partials/SidebarAppMenu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
