<?php
/* Smarty version 4.5.5, created on 2025-09-16 07:13:33
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Settings\Potentials\MappingDetail.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68c90e1d74f796_52853227',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '592dde98f258af0108cff529d88a6056804454cf' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Settings\\Potentials\\MappingDetail.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68c90e1d74f796_52853227 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="potentialsFieldMappingListPageDiv"><div class="col-sm-12 col-xs-12"><div class="row settingsHeader"><span class="col-sm-12"><span class="pull-right"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getDetailViewLinks(), 'LINK_MODEL');
$_smarty_tpl->tpl_vars['LINK_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LINK_MODEL']->value) {
$_smarty_tpl->tpl_vars['LINK_MODEL']->do_else = false;
?><button type="button" class="btn btn-default" onclick=<?php echo $_smarty_tpl->tpl_vars['LINK_MODEL']->value->getUrl();?>
><?php echo vtranslate($_smarty_tpl->tpl_vars['LINK_MODEL']->value->getLabel(),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></span></span></div><div class="contents table-container" id="detailView"><table class="table listview-table" id="listview-table"><thead><tr><th></th><th><?php echo vtranslate('LBL_FIELD_LABEL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><th><?php echo vtranslate('LBL_FIELD_TYPE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><th><?php echo vtranslate('LBL_MAPPING_WITH_OTHER_MODULES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th></tr><tr><th width="10%"><?php echo vtranslate('LBL_ACTIONS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getHeaders(), 'LABEL', false, 'key');
$_smarty_tpl->tpl_vars['LABEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['LABEL']->value) {
$_smarty_tpl->tpl_vars['LABEL']->do_else = false;
?><th width="30%"><?php echo vtranslate($_smarty_tpl->tpl_vars['LABEL']->value,$_smarty_tpl->tpl_vars['LABEL']->value);?>
</th><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tr></thead><tbody><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getMapping(), 'MAPPING', false, 'MAPPING_ID');
$_smarty_tpl->tpl_vars['MAPPING']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['MAPPING_ID']->value => $_smarty_tpl->tpl_vars['MAPPING']->value) {
$_smarty_tpl->tpl_vars['MAPPING']->do_else = false;
?><tr class="listViewEntries" data-cfmid="<?php echo $_smarty_tpl->tpl_vars['MAPPING_ID']->value;?>
"><td><?php if ($_smarty_tpl->tpl_vars['MAPPING']->value['editable'] == 1) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getMappingLinks(), 'LINK_MODEL');
$_smarty_tpl->tpl_vars['LINK_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LINK_MODEL']->value) {
$_smarty_tpl->tpl_vars['LINK_MODEL']->do_else = false;
?><div class="table-actions"><span class="actionImages"><a onclick=<?php echo $_smarty_tpl->tpl_vars['LINK_MODEL']->value->getUrl();?>
><i title="<?php echo vtranslate($_smarty_tpl->tpl_vars['LINK_MODEL']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="fa fa-trash alignMiddle"></i></a></span></div><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?></td><td><?php ob_start();
echo $_smarty_tpl->tpl_vars['MAPPING']->value['Potentials']['label'];
$_prefixVariable1 = ob_get_clean();
echo vtranslate($_prefixVariable1,'Potentials');?>
</td><td><?php echo vtranslate($_smarty_tpl->tpl_vars['MAPPING']->value['Potentials']['fieldDataType'],$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</td><td><?php ob_start();
echo $_smarty_tpl->tpl_vars['MAPPING']->value['Project']['label'];
$_prefixVariable2 = ob_get_clean();
echo vtranslate($_prefixVariable2,'Project');?>
</td></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tbody></table></div></div><div id="scroller_wrapper" class="bottom-fixed-scroll"><div id="scroller" class="scroller-div"></div></div></div><?php }
}
