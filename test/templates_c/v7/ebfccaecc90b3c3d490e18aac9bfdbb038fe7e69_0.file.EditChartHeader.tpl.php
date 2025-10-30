<?php
/* Smarty version 4.5.5, created on 2025-09-30 08:54:24
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Reports\EditChartHeader.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68db9ac0e9b417_72689957',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ebfccaecc90b3c3d490e18aac9bfdbb038fe7e69' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Reports\\EditChartHeader.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68db9ac0e9b417_72689957 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="editContainer" style="padding-left: 2%;padding-right: 2%"><div class="row"><?php $_smarty_tpl->_assignInScope('LABELS', array("step1"=>"LBL_REPORT_DETAILS","step2"=>"LBL_FILTERS","step3"=>"LBL_SELECT_CHART"));
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "BreadCrumbs.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('ACTIVESTEP'=>1,'BREADCRUMB_LABELS'=>$_smarty_tpl->tpl_vars['LABELS']->value,'MODULE'=>$_smarty_tpl->tpl_vars['MODULE']->value), 0, true);
?></div><div class="clearfix"></div><?php }
}
