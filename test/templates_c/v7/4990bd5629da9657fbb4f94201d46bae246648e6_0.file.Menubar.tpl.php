<?php
/* Smarty version 4.5.5, created on 2025-09-16 07:46:03
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Documents\partials\Menubar.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68c915bb4f7f42_50708315',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4990bd5629da9657fbb4f94201d46bae246648e6' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Documents\\partials\\Menubar.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68c915bb4f7f42_50708315 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['REQ']->value->get('view') == 'Detail') {?>
<div id="modules-menu" class="modules-menu">    
    <ul>
        <li class="active">
            <a href="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getListViewUrl();?>
">
				<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getModuleIcon();?>

                <span><?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
</span>
            </a>
        </li>
    </ul>
</div>
<?php }
}
}
