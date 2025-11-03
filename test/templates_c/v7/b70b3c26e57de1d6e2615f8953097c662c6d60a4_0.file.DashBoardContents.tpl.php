<?php
/* Smarty version 4.5.5, created on 2025-10-30 05:35:05
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Vtiger\dashboards\DashBoardContents.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_6902f909be4392_77511686',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b70b3c26e57de1d6e2615f8953097c662c6d60a4' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Vtiger\\dashboards\\DashBoardContents.tpl',
      1 => 1761802269,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6902f909be4392_77511686 (Smarty_Internal_Template $_smarty_tpl) {
?>    
<div class="dashBoardContainer clearfix"><div class="tabContainer"><ul class="nav nav-tabs tabs sortable container-fluid"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['DASHBOARD_TABS']->value, 'TAB_DATA', false, 'index');
$_smarty_tpl->tpl_vars['TAB_DATA']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['index']->value => $_smarty_tpl->tpl_vars['TAB_DATA']->value) {
$_smarty_tpl->tpl_vars['TAB_DATA']->do_else = false;
?><li class="<?php if ($_smarty_tpl->tpl_vars['TAB_DATA']->value["id"] == $_smarty_tpl->tpl_vars['SELECTED_TAB']->value) {?>active<?php }?> dashboardTab" data-tabid="<?php echo $_smarty_tpl->tpl_vars['TAB_DATA']->value["id"];?>
" data-tabname="<?php echo $_smarty_tpl->tpl_vars['TAB_DATA']->value["tabname"];?>
"><a data-toggle="tab" href="#tab_<?php echo $_smarty_tpl->tpl_vars['TAB_DATA']->value["id"];?>
"><div><span class="name textOverflowEllipsis" value="<?php echo $_smarty_tpl->tpl_vars['TAB_DATA']->value["tabname"];?>
" style="width:10%"><strong><?php echo $_smarty_tpl->tpl_vars['TAB_DATA']->value["tabname"];?>
</strong></span><span class="editTabName hide"><input type="text" name="tabName"/></span><?php if ($_smarty_tpl->tpl_vars['TAB_DATA']->value["isdefault"] == 0) {?><i class="fa fa-close deleteTab"></i><?php }?><i class="fa fa-bars moveTab hide"></i></div></a></li><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?><div class="moreSettings pull-right"><div class="dropdown dashBoardDropDown"><button class="btn btn-default reArrangeTabs dropdown-toggle" type="button" data-toggle="dropdown"><?php echo vtranslate('LBL_MORE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;&nbsp;<span class="caret"></span></button><ul class="dropdown-menu dropdown-menu-right moreDashBoards"><li id="newDashBoardLi"<?php if (php7_count($_smarty_tpl->tpl_vars['DASHBOARD_TABS']->value) == $_smarty_tpl->tpl_vars['DASHBOARD_TABS_LIMIT']->value) {?>class="disabled"<?php }?>><a class = "addNewDashBoard" href="#"><?php echo vtranslate('LBL_ADD_NEW_DASHBOARD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li><li><a class = "reArrangeTabs" href="#"><?php echo vtranslate('LBL_REARRANGE_DASHBOARD_TABS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li></ul></div><button class="btn-success updateSequence pull-right hide"><?php echo vtranslate('LBL_SAVE_ORDER',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button></div></ul><div class="tab-content"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['DASHBOARD_TABS']->value, 'TAB_DATA', false, 'index');
$_smarty_tpl->tpl_vars['TAB_DATA']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['index']->value => $_smarty_tpl->tpl_vars['TAB_DATA']->value) {
$_smarty_tpl->tpl_vars['TAB_DATA']->do_else = false;
?><div id="tab_<?php echo $_smarty_tpl->tpl_vars['TAB_DATA']->value["id"];?>
" data-tabid="<?php echo $_smarty_tpl->tpl_vars['TAB_DATA']->value["id"];?>
" data-tabname="<?php echo $_smarty_tpl->tpl_vars['TAB_DATA']->value["tabname"];?>
" class="tab-pane fade <?php if ($_smarty_tpl->tpl_vars['TAB_DATA']->value["id"] == $_smarty_tpl->tpl_vars['SELECTED_TAB']->value) {?>in active<?php }?>"><?php if ($_smarty_tpl->tpl_vars['TAB_DATA']->value["id"] == $_smarty_tpl->tpl_vars['SELECTED_TAB']->value) {
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "dashboards/DashBoardTabContents.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('TABID'=>$_smarty_tpl->tpl_vars['TABID']->value), 0, true);
}?></div><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></div></div></div><?php }
}
