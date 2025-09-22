<?php
/* Smarty version 4.5.5, created on 2025-09-19 13:04:28
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\EmailTemplates\IndexViewPreProcess.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68cd54dcac8bc5_44740487',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6a92699a734d2409c9ae963b85eac987f230868c' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\EmailTemplates\\IndexViewPreProcess.tpl',
      1 => 1758006181,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:modules/Vtiger/partials/Topbar.tpl' => 1,
    'file:modules/Settings/Vtiger/SidebarHeader.tpl' => 1,
    'file:modules/Settings/Vtiger/ModuleHeader.tpl' => 1,
  ),
),false)) {
function content_68cd54dcac8bc5_44740487 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:modules/Vtiger/partials/Topbar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="container-fluid app-nav">
    <div class="row">
        <?php $_smarty_tpl->_subTemplateRender("file:modules/Settings/Vtiger/SidebarHeader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <?php $_smarty_tpl->_assignInScope('ACTIVE_BLOCK', array('block'=>'Templates','menu'=>$_smarty_tpl->tpl_vars['REQ']->value->get('module')));?>
        <?php $_smarty_tpl->_subTemplateRender("file:modules/Settings/Vtiger/ModuleHeader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    </div>
</div>
</nav>
 <div id='overlayPageContent' class='fade modal overlayPageContent content-area overlay-container-60' tabindex='-1' role='dialog' aria-hidden='true'>
        <div class="data">
        </div>
        <div class="modal-dialog">
        </div>
    </div>
<?php }
}
