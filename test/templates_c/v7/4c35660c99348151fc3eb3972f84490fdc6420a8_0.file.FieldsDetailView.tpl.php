<?php
/* Smarty version 4.5.5, created on 2025-09-22 08:20:46
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Settings\Webforms\FieldsDetailView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68d106de52ad95_36641025',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4c35660c99348151fc3eb3972f84490fdc6420a8' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Settings\\Webforms\\FieldsDetailView.tpl',
      1 => 1758006205,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68d106de52ad95_36641025 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="contents-topscroll"><div class="topscroll-div">&nbsp;</div></div><div class="listViewEntriesDiv contents-bottomscroll"><div class="bottomscroll-div"><div class="fieldBlockContainer"><div class="fieldBlockHeader"><h4><?php ob_start();
echo $_smarty_tpl->tpl_vars['SOURCE_MODULE']->value;
$_prefixVariable1 = ob_get_clean();
echo vtranslate($_smarty_tpl->tpl_vars['SOURCE_MODULE']->value,$_prefixVariable1);?>
 <?php ob_start();
echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;
$_prefixVariable2 = ob_get_clean();
echo vtranslate('LBL_FIELD_INFORMATION',$_prefixVariable2);?>
</h4></div><hr><table class="table table-bordered"><tr><td class="paddingLeft20"><b><?php ob_start();
echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;
$_prefixVariable3 = ob_get_clean();
echo vtranslate('LBL_MANDATORY',$_prefixVariable3);?>
</b></td><td><b><?php ob_start();
echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;
$_prefixVariable4 = ob_get_clean();
echo vtranslate('LBL_HIDDEN',$_prefixVariable4);?>
</b></td><td><b><?php ob_start();
echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;
$_prefixVariable5 = ob_get_clean();
echo vtranslate('LBL_FIELD_NAME',$_prefixVariable5);?>
</b></td><td><b><?php ob_start();
echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;
$_prefixVariable6 = ob_get_clean();
echo vtranslate('LBL_OVERRIDE_VALUE',$_prefixVariable6);?>
</b></td><td><b><?php ob_start();
echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;
$_prefixVariable7 = ob_get_clean();
echo vtranslate('LBL_WEBFORM_REFERENCE_FIELD',$_prefixVariable7);?>
</b></td></tr><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['SELECTED_FIELD_MODELS_LIST']->value, 'FIELD_MODEL', false, 'FIELD_NAME');
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_NAME']->value => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value) {
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = false;
$_smarty_tpl->_assignInScope('FIELD_STATUS', ((string)$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('required')));
$_smarty_tpl->_assignInScope('FIELD_HIDDEN_STATUS', ((string)$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('hidden')));?><tr><td class="paddingLeft20"><?php if (($_smarty_tpl->tpl_vars['FIELD_STATUS']->value == 1) || ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory(true))) {
$_smarty_tpl->_assignInScope('FIELD_VALUE', "LBL_YES");
} else {
$_smarty_tpl->_assignInScope('FIELD_VALUE', "LBL_NO");
}
ob_start();
echo $_smarty_tpl->tpl_vars['FIELD_VALUE']->value;
$_prefixVariable8 = ob_get_clean();
ob_start();
echo $_smarty_tpl->tpl_vars['SOURCE_MODULE']->value;
$_prefixVariable9 = ob_get_clean();
echo vtranslate($_prefixVariable8,$_prefixVariable9);?>
</td><td><?php if ($_smarty_tpl->tpl_vars['FIELD_HIDDEN_STATUS']->value == 1) {
$_smarty_tpl->_assignInScope('FIELD_VALUE', "LBL_YES");
} else {
$_smarty_tpl->_assignInScope('FIELD_VALUE', "LBL_NO");
}
ob_start();
echo $_smarty_tpl->tpl_vars['FIELD_VALUE']->value;
$_prefixVariable10 = ob_get_clean();
ob_start();
echo $_smarty_tpl->tpl_vars['SOURCE_MODULE']->value;
$_prefixVariable11 = ob_get_clean();
echo vtranslate($_prefixVariable10,$_prefixVariable11);?>
</td><td><?php ob_start();
echo $_smarty_tpl->tpl_vars['SOURCE_MODULE']->value;
$_prefixVariable12 = ob_get_clean();
echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_prefixVariable12);
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()) {?><span class="redColor">*</span><?php }?></td><td><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType() == 'reference') {
$_smarty_tpl->_assignInScope('EXPLODED_FIELD_VALUE', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'explode' ][ 0 ], array( 'x',$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('defaultvalue') )));
$_smarty_tpl->_assignInScope('FIELD_VALUE', $_smarty_tpl->tpl_vars['EXPLODED_FIELD_VALUE']->value[1]);
if (!isRecordExists($_smarty_tpl->tpl_vars['FIELD_VALUE']->value)) {
$_smarty_tpl->_assignInScope('FIELD_VALUE', 0);
}
} else {
$_smarty_tpl->_assignInScope('FIELD_VALUE', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('defaultvalue'));
}
echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_VALUE']->value,$_smarty_tpl->tpl_vars['RECORD']->value->getId(),$_smarty_tpl->tpl_vars['RECORD']->value);?>
</td><td><?php if (Settings_Webforms_Record_Model::isCustomField($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name'))) {
echo vtranslate('LBL_LABEL',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 : <?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);
} else {
ob_start();
echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('neutralizedfield');
$_prefixVariable13 = ob_get_clean();
echo vtranslate($_prefixVariable13,$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);
}?></td></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tbody></table></div></div></div><?php if (Vtiger_Functions::isDocumentsRelated($_smarty_tpl->tpl_vars['SOURCE_MODULE']->value) && count($_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELDS']->value)) {?><div class="listViewEntriesDiv contents-bottomscroll"><div class="bottomscroll-div"><div class="fieldBlockContainer"><div class="fieldBlockHeader"><h4><?php echo vtranslate('LBL_UPLOAD_DOCUMENTS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</h4></div><div><div class="col-lg-7 padding0"><table class="table table-bordered"><tr><td><b><?php echo vtranslate('LBL_FIELD_LABEL',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</b></td><td><b><?php echo vtranslate('LBL_MANDATORY',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</b></td></tr><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELDS']->value, 'DOCUMENT_FILE_FIELD');
$_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELD']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELD']->value) {
$_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELD']->do_else = false;
?><tr><td><?php echo $_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELD']->value['fieldlabel'];?>
</td><td><?php if ($_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELD']->value['required']) {
echo vtranslate('LBL_YES');
} else {
echo vtranslate('LBL_NO');
}?></td></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></table></div><div class="col-lg-5"><div class="vt-default-callout vt-info-callout" style="margin: 0;"><h4 class="vt-callout-header"><span class="fa fa-info-circle"></span>&nbsp; <?php echo vtranslate('LBL_INFO');?>
</h4><div><?php echo vtranslate('LBL_FILE_FIELD_INFO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value,vtranslate("SINGLE_".((string)$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value),$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value));?>
</div></div></div></div></div></div></div><?php }?></div><?php }
}
