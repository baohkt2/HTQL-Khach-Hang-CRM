<?php
/* Smarty version 4.5.5, created on 2025-09-18 09:16:08
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Settings\PBXManager\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68cbcdd87e9fc6_16073880',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4b5e5ac8eca592ef3926cf4a08d7fc42b21d3450' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Settings\\PBXManager\\index.tpl',
      1 => 1758006164,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68cbcdd87e9fc6_16073880 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="col-sm-12 col-xs-12"><div class="container-fluid" id="AsteriskServerDetails"><input type="hidden" name="module" value="PBXManager"/><input type="hidden" name="action" value="SaveAjax"/><input type="hidden" name="parent" value="Settings"/><input type="hidden" class="recordid" name="id" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
"><div class="widget_header row"><div class="col-sm-8"><h4><?php echo vtranslate('LBL_PBXMANAGER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4></div><?php $_smarty_tpl->_assignInScope('MODULE_MODEL', Settings_PBXManager_Module_Model::getCleanInstance());?><div class="col-sm-4"><div class="clearfix"><div class="btn-group pull-right editbutton-container"><button class="btn btn-default editButton" data-url="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getEditViewUrl();?>
&mode=showpopup&id=<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
" title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"><?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button></div></div></div></div><hr><div class="contents col-lg-12"><table class="table detailview-table no-border"><tbody><?php $_smarty_tpl->_assignInScope('FIELDS', PBXManager_PBXManager_Connector::getSettingsParameters());
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FIELDS']->value, 'FIELD_TYPE', false, 'FIELD_NAME');
$_smarty_tpl->tpl_vars['FIELD_TYPE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_NAME']->value => $_smarty_tpl->tpl_vars['FIELD_TYPE']->value) {
$_smarty_tpl->tpl_vars['FIELD_TYPE']->do_else = false;
?><tr><td class="fieldLabel" style="width:25%"><label><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_NAME']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></td><td style="word-wrap:break-word;"><?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get($_smarty_tpl->tpl_vars['FIELD_NAME']->value);?>
</td></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tbody></table></div></div><div class="col-sm-12 col-xs-12"><div class="col-sm-8 col-xs-8"><div class="alert alert-danger container-fluid"><b><?php echo vtranslate('LBL_NOTE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</b>&nbsp;<?php echo vtranslate('LBL_PBXMANAGER_INFO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div></div></div></div><?php }
}
