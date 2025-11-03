<?php
/* Smarty version 4.5.5, created on 2025-11-02 16:50:35
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Vtiger\ListColumnsEdit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_69078bdbb28a93_23842496',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '88aaa1dea9e651bd356b8c9f5b44cb11410f3142' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Vtiger\\ListColumnsEdit.tpl',
      1 => 1761802269,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69078bdbb28a93_23842496 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="modal-dialog modal-lg configColumnsContainer"><div class="modal-content"><?php ob_start();
echo vtranslate('LBL_CONFIG_COLUMNS',$_smarty_tpl->tpl_vars['MODULE']->value);
$_prefixVariable1 = ob_get_clean();
$_smarty_tpl->_assignInScope('HEADER_TITLE', $_prefixVariable1);
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('TITLE'=>(($_smarty_tpl->tpl_vars['HEADER_TITLE']->value).(' - ')).($_smarty_tpl->tpl_vars['CV_MODEL']->value->get('viewname'))), 0, true);
?><form class="form-horizontal configColumnsForm" method="post" action="index.php"><input type="hidden" name="module" value="CustomView"/><input type="hidden" name="action" value="SaveAjax"/><input type="hidden" name="mode" value="updateColumns"/><input type="hidden" name="record" value="<?php echo $_smarty_tpl->tpl_vars['CV_MODEL']->value->getId();?>
" /><div class="modal-body"><div class="row"><div class="col-lg-6 selectedFieldsContainer"><h5><?php echo vtranslate('LBL_SELECTED_FIELDS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h5><div class="selectedFieldsListContainer"><ul id="selectedFieldsList"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['SELECTED_FIELDS']->value, 'FIELD_MODEL');
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->value) {
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = false;
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value && $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayType() != '6') {
ob_start();
echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getModule()->getName();
$_prefixVariable2 = ob_get_clean();
$_smarty_tpl->_assignInScope('FIELD_MODULE_NAME', $_prefixVariable2);?><li class="item" data-cv-columnname="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getCustomViewColumnName();?>
" data-columnname="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('column');?>
" data-field-id='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getId();?>
'><span class="dragContainer"><img src="<?php echo vimage_path('drag.png');?>
" class="cursorPointerMove" border="0" title="<?php echo vtranslate('LBL_DRAG',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"></span><span class="fieldLabel"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['FIELD_MODULE_NAME']->value);?>
</span><span class="pull-right removeField"><i class="fa fa-times" title="<?php echo vtranslate('LBL_REMOVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"></i></span></li><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></ul><li class="item-dummy hide"><span class="dragContainer"><img src="<?php echo vimage_path('drag.png');?>
" class="cursorPointerMove" border="0" title="<?php echo vtranslate('LBL_DRAG',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"></span><span class="fieldLabel"></span><span class="pull-right removeField"><i class="fa fa-times"></i></span></li></div></div><div class="col-lg-6 availFiedlsContainer"><div class="row"><div class="col-lg-10"><h5><?php echo vtranslate('LBL_AVAILABLE_FIELDS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h5><input type="text" class="inputElement searchAvailFields" placeholder="<?php echo vtranslate('LBL_SEARCH_FIELDS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" /><div class="panel-group avialFieldsListContainer" id="accordion"><div class="panel panel-default" id="avialFieldsList"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value, 'BLOCK_FIELDS', false, 'BLOCK_LABEL', 'availFieldsLoop', array (
));
$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['BLOCK_LABEL']->value => $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value) {
$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->do_else = false;
$_smarty_tpl->_assignInScope('RAND_ID', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'mt_rand' ][ 0 ], array( 10,1000 )));?><div class="instafilta-section"><div id="<?php echo $_smarty_tpl->tpl_vars['RAND_ID']->value;?>
_accordion" class="availFieldBlock" role="tab"><a class="fieldLabel" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $_smarty_tpl->tpl_vars['RAND_ID']->value;?>
"><i class="fa fa-caret-right"></i><span><?php echo vtranslate($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value,$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
</span></a></div><div id="<?php echo $_smarty_tpl->tpl_vars['RAND_ID']->value;?>
" class="panel-collapse collapse"><div class="panel-body"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value, 'FIELD_MODEL', false, 'FIELD_NAME');
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_NAME']->value => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value) {
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = false;
ob_start();
echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getModule()->getName();
$_prefixVariable3 = ob_get_clean();
$_smarty_tpl->_assignInScope('FIELD_MODULE_NAME', $_prefixVariable3);
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayType() == '6') {
continue 1;
}?><div class="instafilta-target item <?php if (array_key_exists(decode_html($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getCustomViewColumnName()),$_smarty_tpl->tpl_vars['SELECTED_FIELDS']->value)) {?>hide<?php }?>" data-cv-columnname="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getCustomViewColumnName();?>
" data-columnname='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('column');?>
' data-field-id='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getId();?>
'><span class="fieldLabel"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['FIELD_MODULE_NAME']->value);?>
</span></div><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></div></div></div><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?><div class="instafilta-target item-dummy hide"><span class="fieldLabel"></span></div></div></div></div></div></div></div></div><div class="modal-footer "><button class="btn btn-success" type="submit" name="saveButton"><strong><?php echo vtranslate('LBL_UPDATE_LIST');?>
</strong></button><a href="#" class="cancelLink" type="reset" data-dismiss="modal"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div></form></div></div><?php }
}
