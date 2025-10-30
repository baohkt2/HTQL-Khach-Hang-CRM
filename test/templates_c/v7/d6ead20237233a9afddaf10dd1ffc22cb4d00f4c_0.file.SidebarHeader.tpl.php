<?php
/* Smarty version 4.5.5, created on 2025-09-16 07:19:18
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\EmailTemplates\partials\SidebarHeader.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68c90f76782cb6_84629257',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd6ead20237233a9afddaf10dd1ffc22cb4d00f4c' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\EmailTemplates\\partials\\SidebarHeader.tpl',
      1 => 1758006181,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:modules/Vtiger/partials/SidebarAppMenu.tpl' => 1,
  ),
),false)) {
function content_68c90f76782cb6_84629257 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('APP_IMAGE_MAP', Vtiger_MenuStructure_Model::getAppIcons());?>
 
<div class="col-sm-12 col-xs-12 app-indicator-icon-container app-<?php echo $_smarty_tpl->tpl_vars['SELECTED_MENU_CATEGORY']->value;?>
">
    <div class="row" title="<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
">
        <span class="app-indicator-icon fa vicon-emailtemplates"></span>
    </div>
</div>
    
<?php $_smarty_tpl->_subTemplateRender("file:modules/Vtiger/partials/SidebarAppMenu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
