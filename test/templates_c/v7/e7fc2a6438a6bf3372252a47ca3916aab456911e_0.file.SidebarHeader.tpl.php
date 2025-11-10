<?php
/* Smarty version 4.5.5, created on 2025-11-10 06:54:31
  from 'C:\xampp\htdocs\cusc\layouts\v7\modules\Settings\Vtiger\SidebarHeader.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_69118c276224c3_24522736',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e7fc2a6438a6bf3372252a47ca3916aab456911e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\cusc\\layouts\\v7\\modules\\Settings\\Vtiger\\SidebarHeader.tpl',
      1 => 1762713639,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:modules/Vtiger/partials/SidebarAppMenu.tpl' => 1,
  ),
),false)) {
function content_69118c276224c3_24522736 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('APP_IMAGE_MAP', Vtiger_MenuStructure_Model::getAppIcons());?>
<div class="col-sm-12 col-xs-12 app-indicator-icon-container app-<?php echo $_smarty_tpl->tpl_vars['SELECTED_MENU_CATEGORY']->value;?>
">
    <div class="row" title="<?php echo vtranslate("LBL_SETTINGS",$_smarty_tpl->tpl_vars['MODULE']->value);?>
">
        <span class="app-indicator-icon fa fa-cog"></span>
    </div>
</div>
    
<?php $_smarty_tpl->_subTemplateRender("file:modules/Vtiger/partials/SidebarAppMenu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
