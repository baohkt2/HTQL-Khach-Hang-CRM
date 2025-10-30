<?php
/* Smarty version 4.5.5, created on 2025-10-10 08:40:02
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\RecycleBin\partials\SidebarEssentials.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e8c662caf984_13684118',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6dab4786d0362373c9e820482f5e0fd79be072eb' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\RecycleBin\\partials\\SidebarEssentials.tpl',
      1 => 1758006195,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e8c662caf984_13684118 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\vtigercrm\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
?>
<div class="sidebar-menu sidebar-menu-full">
    <div class="module-filters" id="module-filters">
        <div class="sidebar-container lists-menu-container">
            <h5 class="sidebar-header"> <?php echo vtranslate('LBL_MODULES','Settings:$MODULE');?>
 </h5>
            <hr>
            <div>
                <input class="search-list" type="text" placeholder="Search for Modules">
            </div>
            <div class="list-menu-content">
                <div class="list-group">   
                    <ul class="lists-menu" style="list-style-type: none; padding-left: 0px;">
                        <?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['MODULE_LIST']->value) > 0) {?>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MODULE_LIST']->value, 'MODULEMODEL');
$_smarty_tpl->tpl_vars['MODULEMODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['MODULEMODEL']->value) {
$_smarty_tpl->tpl_vars['MODULEMODEL']->do_else = false;
?>
                                <li style="font-size:12px;" class='listViewFilter <?php if ($_smarty_tpl->tpl_vars['MODULEMODEL']->value->getName() == $_smarty_tpl->tpl_vars['SOURCE_MODULE']->value) {?>active<?php }?> '>
                                    <a class="filterName" href="index.php?module=RecycleBin&view=List&sourceModule=<?php echo $_smarty_tpl->tpl_vars['MODULEMODEL']->value->getName();?>
" ><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULEMODEL']->value->getName(),$_smarty_tpl->tpl_vars['MODULEMODEL']->value->getName());?>
</a>
                                </li>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <?php }?>
                    </ul>
                 </div>
                <div class="list-group hide noLists">
                    <h6 class="lists-header"><center> <?php echo vtranslate('LBL_NO');?>
 <?php echo vtranslate('LBL_MODULES','Settings:$MODULE');?>
 <?php echo vtranslate('LBL_FOUND');?>
 ... </center></h6>
                </div>
            </div>
        </div>
    </div>
</div><?php }
}
