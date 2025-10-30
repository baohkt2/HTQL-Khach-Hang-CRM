<?php
/* Smarty version 4.5.5, created on 2025-09-30 08:59:06
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\Vtiger\CustomRecordNumbering.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68db9bda29dbf4_54773301',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '55782c8b529d90bd8665bf1a50e01233ad9d7170' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\Vtiger\\CustomRecordNumbering.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68db9bda29dbf4_54773301 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class=" detailViewContainer col-lg-12 col-md-12 col-sm-12"><form id="EditView" method="POST"><div class="blockData"><div class="clearfix"><div class="btn-group pull-right"><button type="button" class="btn addButton btn-default" name="updateRecordWithSequenceNumber"><?php echo vtranslate('LBL_UPDATE_MISSING_RECORD_SEQUENCE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button></div><div><h4><?php echo vtranslate('LBL_CUSTOMIZE_RECORD_NUMBERING',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4></div></div><hr><br><div class="table form-horizontal no-border" id="customRecordNumbering" ><?php $_smarty_tpl->_assignInScope('DEFAULT_MODULE_DATA', $_smarty_tpl->tpl_vars['DEFAULT_MODULE_MODEL']->value->getModuleCustomNumberingData());
$_smarty_tpl->_assignInScope('DEFAULT_MODULE_NAME', $_smarty_tpl->tpl_vars['DEFAULT_MODULE_MODEL']->value->getName());
$_smarty_tpl->_assignInScope('WIDTHTYPE', $_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('rowheight'));?><div class="row form-group"><div class="col-lg-3 col-md-3 col-sm-3 control-label fieldLabel"><label><?php echo vtranslate('LBL_SELECT_MODULE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></div><div class="fieldValue <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><div class=" col-lg-4 col-md-4 col-sm-4"><select class="select2 inputElement " name="sourceModule"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['SUPPORTED_MODULES']->value, 'MODULE_MODEL', false, 'index');
$_smarty_tpl->tpl_vars['MODULE_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['index']->value => $_smarty_tpl->tpl_vars['MODULE_MODEL']->value) {
$_smarty_tpl->tpl_vars['MODULE_MODEL']->do_else = false;
$_smarty_tpl->_assignInScope('MODULE_NAME', $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name'));?><option value=<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
 <?php if ($_smarty_tpl->tpl_vars['MODULE_NAME']->value == $_smarty_tpl->tpl_vars['DEFAULT_MODULE_NAME']->value) {?> selected <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></div></div></div><div class="row form-group"><div class="col-lg-3 col-md-3 col-sm-3 control-label fieldLabel"><label ><?php echo vtranslate('LBL_USE_PREFIX',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></div><div class="fieldValue <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><div class=" col-lg-4 col-md-4 col-sm-4"><input type="text" id="prefix" class="inputElement" value="<?php echo $_smarty_tpl->tpl_vars['DEFAULT_MODULE_DATA']->value['prefix'];?>
" data-old-prefix="<?php echo $_smarty_tpl->tpl_vars['DEFAULT_MODULE_DATA']->value['prefix'];?>
" name="prefix" /></div></div></div><div class="row form-group"><div class="col-lg-3 col-md-3 col-sm-3 control-label fieldLabel"><label><b><?php echo vtranslate('LBL_START_SEQUENCE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</b>&nbsp;<span class="redColor">*</span></label></div><div class="fieldValue <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><div class=" col-lg-4 col-md-4 col-sm-4"><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['DEFAULT_MODULE_DATA']->value['sequenceNumber'];?>
" class="inputElement " id="sequence"data-old-sequence-number="<?php echo $_smarty_tpl->tpl_vars['DEFAULT_MODULE_DATA']->value['sequenceNumber'];?>
" data-rule-required = "true" data-rule-positive="true" data-rule-wholeNumber="true" name="sequenceNumber"/></div></div></div></div></div><br><div class='modal-overlay-footer clearfix'><div class="row clearfix"><div class=' textAlignCenter col-lg-12 col-md-12 col-sm-12 '><button class="btn btn-success saveButton" type="submit" disabled="disabled"><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button>&nbsp;&nbsp;<a class='cancelLink' href="javascript:history.back()" type="reset"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a></div></div></div></form></div><?php }
}
