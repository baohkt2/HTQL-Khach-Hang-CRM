<?php
/* Smarty version 4.5.5, created on 2025-09-16 07:16:41
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Reports\partials\SidebarEssentials.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68c90ed951d0f8_91794604',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '98899170ed4fffb9ba03c3d6228077050dd8ebb9' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Reports\\partials\\SidebarEssentials.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68c90ed951d0f8_91794604 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="sidebar-menu sidebar-menu-full"><div class="module-filters" id="module-filters"><div class="sidebar-container lists-menu-container"><div class="sidebar-header clearfix"><h5 class="pull-left"><?php echo vtranslate('LBL_FOLDERS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h5><button id="createFilter" onclick='Reports_List_Js.triggerAddFolder("index.php?module=Reports&view=EditFolder");' class="btn btn-default pull-right sidebar-btn" title="<?php echo vtranslate('LBL_ADD_NEW_FOLDER',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><div class="fa fa-plus" aria-hidden="true"></div></button></div><hr><div><input class="search-list" type="text" placeholder="<?php echo vtranslate('LBL_SEARCH_FOR_FOLDERS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"></div><div class="menu-scroller mCustomScrollBox" data-mcs-theme="dark"><div class="mCustomScrollBox mCS-light-2 mCSB_inside" tabindex="0"><div class="mCSB_container" style="position:relative; top:0; left:0;"><div class="list-menu-content"><div class="list-group"><ul class="lists-menu"><li style="font-size:12px;" class="listViewFilter" ><a href="#" class='filterName' data-filter-id="All"><i class="fa fa-folder foldericon"></i>&nbsp;<?php echo vtranslate('LBL_ALL_REPORTS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FOLDERS']->value, 'FOLDER', false, NULL, 'folderview', array (
  'iteration' => true,
));
$_smarty_tpl->tpl_vars['FOLDER']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FOLDER']->value) {
$_smarty_tpl->tpl_vars['FOLDER']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_folderview']->value['iteration']++;
?><li style="font-size:12px;" class="listViewFilter <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_folderview']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_folderview']->value['iteration'] : null) > 5) {?> filterHidden hide<?php }?>" ><?php ob_start();
echo vtranslate($_smarty_tpl->tpl_vars['FOLDER']->value->getName(),$_smarty_tpl->tpl_vars['MODULE']->value);
$_prefixVariable1 = ob_get_clean();
$_smarty_tpl->_assignInScope('VIEWNAME', $_prefixVariable1);?><a href="#" class='filterName' data-filter-id=<?php echo $_smarty_tpl->tpl_vars['FOLDER']->value->getId();?>
><i class="fa fa-folder foldericon"></i>&nbsp;<?php ob_start();
echo strlen((string) $_smarty_tpl->tpl_vars['VIEWNAME']->value);
$_prefixVariable2 = ob_get_clean();
if ($_prefixVariable2 > 50) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'substr' ][ 0 ], array( $_smarty_tpl->tpl_vars['VIEWNAME']->value,0,45 ));?>
..<?php } else {
echo $_smarty_tpl->tpl_vars['VIEWNAME']->value;
}?></a><div class="pull-right"><?php $_smarty_tpl->_assignInScope('FOLDERID', $_smarty_tpl->tpl_vars['FOLDER']->value->get('folderid'));?><span class="js-popover-container"><span class="fa fa-angle-down" data-id="<?php echo $_smarty_tpl->tpl_vars['FOLDERID']->value;?>
" data-deletable="true" data-editable="true" rel="popover" data-toggle="popover" data-deleteurl="<?php echo $_smarty_tpl->tpl_vars['FOLDER']->value->getDeleteUrl();?>
" data-editurl="<?php echo $_smarty_tpl->tpl_vars['FOLDER']->value->getEditUrl();?>
" data-toggle="dropdown" aria-expanded="true"></span></span></div></li><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?><li style="font-size:12px;" class="listViewFilter" ><a href="#" class='filterName' data-filter-id="shared"><i class="fa fa-folder foldericon"></i>&nbsp;<?php echo vtranslate('LBL_SHARED_REPORTS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li></ul><div id="filterActionPopoverHtml"><ul class="listmenu hide" role="menu"><li role="presentation" class="editFilter"><a role="menuitem"><i class="fa fa-pencil-square-o"></i>&nbsp;<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li><li role="presentation" class="deleteFilter"><a role="menuitem"><i class="fa fa-trash"></i>&nbsp;<?php echo vtranslate('LBL_DELETE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li></ul></div><h5 class="toggleFilterSize" data-more-text="<?php echo vtranslate('LBL_MORE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
.." data-less-text="<?php echo vtranslate('LBL_LESS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
.."><?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_folderview']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_folderview']->value['iteration'] : null) > 5) {
echo vtranslate('LBL_MORE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
..<?php }?></h5></div></div></div></div></div></div></div></div>
<?php }
}
