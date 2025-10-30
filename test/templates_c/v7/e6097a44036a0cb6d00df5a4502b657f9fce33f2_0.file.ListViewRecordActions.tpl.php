<?php
/* Smarty version 4.5.5, created on 2025-09-16 07:16:14
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Settings\Profiles\ListViewRecordActions.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68c90ebe246cb4_48776349',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e6097a44036a0cb6d00df5a4502b657f9fce33f2' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Settings\\Profiles\\ListViewRecordActions.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68c90ebe246cb4_48776349 (Smarty_Internal_Template $_smarty_tpl) {
?><!--LIST VIEW RECORD ACTIONS--><div class="table-actions"><?php $_smarty_tpl->_assignInScope('RECORD_LINKS', $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getRecordLinks());
$_smarty_tpl->_assignInScope('RECORD_LINK_URL', array());
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getRecordLinks(), 'RECORD_LINK', false, 'key');
$_smarty_tpl->tpl_vars['RECORD_LINK']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['RECORD_LINK']->value) {
$_smarty_tpl->tpl_vars['RECORD_LINK']->do_else = false;
$_tmp_array = isset($_smarty_tpl->tpl_vars['RECORD_LINK_URL']) ? $_smarty_tpl->tpl_vars['RECORD_LINK_URL']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array[$_smarty_tpl->tpl_vars['key']->value] = $_smarty_tpl->tpl_vars['RECORD_LINK']->value->getUrl();
$_smarty_tpl->_assignInScope('RECORD_LINK_URL', $_tmp_array);
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?><span><a href="<?php echo $_smarty_tpl->tpl_vars['RECORD_LINK_URL']->value[1];?>
" title="<?php echo vtranslate('LBL_DUPLICATE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i class="fa fa-copy"></i></a></span><span class="more dropdown action"><span href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-v icon"></i></span><ul class="dropdown-menu"><li><a data-id="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getId();?>
" href="<?php echo $_smarty_tpl->tpl_vars['RECORD_LINK_URL']->value[0];?>
" title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li><li> <a data-id="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getId();?>
" href="javascript:void(0)" onclick="<?php echo $_smarty_tpl->tpl_vars['RECORD_LINK_URL']->value[2];?>
" title="<?php echo vtranslate('LBL_DELETE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><?php echo vtranslate('LBL_DELETE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li></ul></span></div><?php }
}
