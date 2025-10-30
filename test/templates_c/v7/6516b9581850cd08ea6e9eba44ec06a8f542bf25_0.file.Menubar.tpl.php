<?php
/* Smarty version 4.5.5, created on 2025-10-19 19:50:35
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Documents\partials\Menubar.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68f5410b95ae92_45140568',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6516b9581850cd08ea6e9eba44ec06a8f542bf25' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Documents\\partials\\Menubar.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68f5410b95ae92_45140568 (Smarty_Internal_Template $_smarty_tpl) {
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
