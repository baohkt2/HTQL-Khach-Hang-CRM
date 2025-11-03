<?php
/* Smarty version 4.5.5, created on 2025-10-30 06:12:42
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\LayoutEditor\FieldsList.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690301da7242b3_59337055',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1a47e6524ebd743aeeccf9c4d551c0eaa5d60dc3' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\LayoutEditor\\FieldsList.tpl',
      1 => 1761802269,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690301da7242b3_59337055 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('IS_SORTABLE', $_smarty_tpl->tpl_vars['SELECTED_MODULE_MODEL']->value->isSortableAllowed());
$_smarty_tpl->_assignInScope('ALL_BLOCK_LABELS', array());?><div class="row fieldsListContainer" style="padding:1% 0"><div class="col-sm-6"><button class="btn btn-default addButton addCustomBlock" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo vtranslate('LBL_ADD_CUSTOM_BLOCK',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button></div><div class="col-sm-6"><?php if ($_smarty_tpl->tpl_vars['IS_SORTABLE']->value) {?><span class="pull-right"><button class="btn btn-success saveFieldSequence" type="button" style="opacity:0;margin-right:0px;"><?php echo vtranslate('LBL_SAVE_LAYOUT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button></span><?php }?></div></div><div class="row"><div class="col-sm-12"><div id="moduleBlocks" style="margin-top:17px;"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['BLOCKS']->value, 'BLOCK_MODEL', false, 'BLOCK_LABEL_KEY');
$_smarty_tpl->tpl_vars['BLOCK_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['BLOCK_LABEL_KEY']->value => $_smarty_tpl->tpl_vars['BLOCK_MODEL']->value) {
$_smarty_tpl->tpl_vars['BLOCK_MODEL']->do_else = false;
$_smarty_tpl->_assignInScope('IS_BLOCK_SORTABLE', $_smarty_tpl->tpl_vars['SELECTED_MODULE_MODEL']->value->isBlockSortableAllowed($_smarty_tpl->tpl_vars['BLOCK_LABEL_KEY']->value));
$_smarty_tpl->_assignInScope('FIELDS_LIST', $_smarty_tpl->tpl_vars['BLOCK_MODEL']->value->getLayoutBlockActiveFields());
$_smarty_tpl->_assignInScope('BLOCK_ID', $_smarty_tpl->tpl_vars['BLOCK_MODEL']->value->get('id'));
if ($_smarty_tpl->tpl_vars['BLOCK_LABEL_KEY']->value != 'LBL_INVITE_USER_BLOCK') {
$_tmp_array = isset($_smarty_tpl->tpl_vars['ALL_BLOCK_LABELS']) ? $_smarty_tpl->tpl_vars['ALL_BLOCK_LABELS']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array[$_smarty_tpl->tpl_vars['BLOCK_ID']->value] = $_smarty_tpl->tpl_vars['BLOCK_MODEL']->value;
$_smarty_tpl->_assignInScope('ALL_BLOCK_LABELS', $_tmp_array);
}?><div id="block_<?php echo $_smarty_tpl->tpl_vars['BLOCK_ID']->value;?>
" class="editFieldsTable block_<?php echo $_smarty_tpl->tpl_vars['BLOCK_ID']->value;?>
 marginBottom10px border1px <?php if ($_smarty_tpl->tpl_vars['IS_BLOCK_SORTABLE']->value) {?> blockSortable<?php }?>" data-block-id="<?php echo $_smarty_tpl->tpl_vars['BLOCK_ID']->value;?>
" data-sequence="<?php echo $_smarty_tpl->tpl_vars['BLOCK_MODEL']->value->get('sequence');?>
" style="background: white;"data-custom-fields-count="<?php echo $_smarty_tpl->tpl_vars['BLOCK_MODEL']->value->getCustomFieldsCount();?>
"><div class="col-sm-12"><div class="layoutBlockHeader row"><div class="blockLabel col-sm-3 padding10 marginLeftZero" style="word-break: break-all;"><?php if ($_smarty_tpl->tpl_vars['IS_BLOCK_SORTABLE']->value) {?><img class="cursorPointerMove" src="<?php echo vimage_path('drag.png');?>
" />&nbsp;&nbsp;<?php }?><strong class="translatedBlockLabel"><?php echo vtranslate($_smarty_tpl->tpl_vars['BLOCK_LABEL_KEY']->value,$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value);?>
</strong></div><div class="col-sm-9 padding10 marginLeftZero"><div class="blockActions" style="float:right !important;"><span><i class="fa fa-info-circle" title="<?php echo vtranslate('LBL_COLLAPSE_BLOCK_DETAIL_VIEW',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i>&nbsp; <?php echo vtranslate('LBL_COLLAPSE_BLOCK',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<input style="opacity: 0;" type="checkbox"<?php if ($_smarty_tpl->tpl_vars['BLOCK_MODEL']->value->isHidden()) {?> checked value='0' <?php } else { ?> value='1' <?php }?> class ='cursorPointer bootstrap-switch' name="collapseBlock"data-on-text="<?php echo vtranslate('LBL_YES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" data-off-text="<?php echo vtranslate('LBL_NO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" data-on-color="primary" data-block-id="<?php echo $_smarty_tpl->tpl_vars['BLOCK_MODEL']->value->get('id');?>
"/></span>&nbsp;<?php if ($_smarty_tpl->tpl_vars['BLOCK_MODEL']->value->isAddCustomFieldEnabled()) {?><button class="btn btn-default addButton btn-sm addCustomField" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo vtranslate('LBL_ADD_CUSTOM_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button>&nbsp;&nbsp;<?php }
if ($_smarty_tpl->tpl_vars['BLOCK_MODEL']->value->isActionsAllowed()) {?><button class="inActiveFields addButton btn btn-default btn-sm"><?php echo vtranslate('LBL_SHOW_HIDDEN_FIELDS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button>&nbsp;&nbsp;<?php if ($_smarty_tpl->tpl_vars['BLOCK_MODEL']->value->isCustomized()) {?><button class="deleteCustomBlock addButton btn btn-default btn-sm"><?php echo vtranslate('LBL_DELETE_CUSTOM_BLOCK',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button><?php }
}?></div></div></div></div><?php $_smarty_tpl->_assignInScope('IS_FIELDS_SORTABLE', $_smarty_tpl->tpl_vars['SELECTED_MODULE_MODEL']->value->isFieldsSortableAllowed($_smarty_tpl->tpl_vars['BLOCK_LABEL_KEY']->value));?><div class="blockFieldsList <?php if ($_smarty_tpl->tpl_vars['IS_FIELDS_SORTABLE']->value) {?> blockFieldsSortable <?php }?> row"><ul name="<?php if ($_smarty_tpl->tpl_vars['IS_FIELDS_SORTABLE']->value) {?>sortable1<?php } else { ?>unSortable1<?php }?>" class="connectedSortable col-sm-6"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FIELDS_LIST']->value, 'FIELD_MODEL', false, NULL, 'fieldlist', array (
  'index' => true,
));
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->value) {
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_fieldlist']->value['index']++;
$_smarty_tpl->_assignInScope('FIELD_INFO', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo());
if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_fieldlist']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_fieldlist']->value['index'] : null)%2 == 0) {?><li><div class="row border1px"><div class="col-sm-4"><div class="opacity editFields marginLeftZero" data-block-id="<?php echo $_smarty_tpl->tpl_vars['BLOCK_ID']->value;?>
" data-field-id="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('id');?>
"data-sequence="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('sequence');?>
" data-field-name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
"><div class="row"><?php $_smarty_tpl->_assignInScope('IS_MANDATORY', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory());?><span class="col-sm-1">&nbsp;<?php if ($_smarty_tpl->tpl_vars['IS_FIELDS_SORTABLE']->value) {?><img src="<?php echo vimage_path('drag.png');?>
" class="cursorPointerMove" border="0" title="<?php echo vtranslate('LBL_DRAG',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"/><?php }?></span><div class="col-sm-9" style="word-wrap: break-word;"><div class="fieldLabelContainer row"><span class="fieldLabel"><b><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value);?>
</b>&nbsp;<?php if ($_smarty_tpl->tpl_vars['IS_MANDATORY']->value) {?><span class="redColor">*</span><?php }?></span><br><span class="pull-right" style="opacity:0.6;"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataTypeLabel(),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></div></div></div></div></div><div class="col-sm-8 fieldPropertyContainer"><div class="row " style="padding: 10px 0px;"><?php ob_start();
echo vtranslate('LBL_MAKE_THIS_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value,vtranslate('LBL_PROP_MANDATORY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value));
$_prefixVariable1 = ob_get_clean();
$_smarty_tpl->_assignInScope('M_FIELD_TITLE', $_prefixVariable1);
ob_start();
echo vtranslate('LBL_SHOW_THIS_FIELD_IN',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value,vtranslate('LBL_QUICK_CREATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value));
$_prefixVariable2 = ob_get_clean();
$_smarty_tpl->_assignInScope('Q_FIELD_TITLE', $_prefixVariable2);
ob_start();
echo vtranslate('LBL_SHOW_THIS_FIELD_IN',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value,vtranslate('LBL_MASS_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value));
$_prefixVariable3 = ob_get_clean();
$_smarty_tpl->_assignInScope('M_E_FIELD_TITLE', $_prefixVariable3);
ob_start();
echo vtranslate('LBL_SHOW_THIS_FIELD_IN',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value,vtranslate('LBL_KEY_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value));
$_prefixVariable4 = ob_get_clean();
$_smarty_tpl->_assignInScope('S_FIELD_TITLE', $_prefixVariable4);
ob_start();
echo vtranslate('LBL_SHOW_THIS_FIELD_IN',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value,vtranslate('LBL_DETAIL_HEADER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value));
$_prefixVariable5 = ob_get_clean();
$_smarty_tpl->_assignInScope('H_FIELD_TITLE', $_prefixVariable5);
ob_start();
echo vtranslate('LBL_NOT_MAKE_THIS_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value,vtranslate('LBL_PROP_MANDATORY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value));
$_prefixVariable6 = ob_get_clean();
$_smarty_tpl->_assignInScope('NOT_M_FIELD_TITLE', $_prefixVariable6);
ob_start();
echo vtranslate('LBL_HIDE_THIS_FIELD_IN',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value,vtranslate('LBL_QUICK_CREATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value));
$_prefixVariable7 = ob_get_clean();
$_smarty_tpl->_assignInScope('NOT_Q_FIELD_TITLE', $_prefixVariable7);
ob_start();
echo vtranslate('LBL_HIDE_THIS_FIELD_IN',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value,vtranslate('LBL_MASS_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value));
$_prefixVariable8 = ob_get_clean();
$_smarty_tpl->_assignInScope('NOT_M_E_FIELD_TITLE', $_prefixVariable8);
ob_start();
echo vtranslate('LBL_HIDE_THIS_FIELD_IN',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value,vtranslate('LBL_KEY_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value));
$_prefixVariable9 = ob_get_clean();
$_smarty_tpl->_assignInScope('NOT_S_FIELD_TITLE', $_prefixVariable9);
ob_start();
echo vtranslate('LBL_HIDE_THIS_FIELD_IN',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value,vtranslate('LBL_DETAIL_HEADER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value));
$_prefixVariable10 = ob_get_clean();
$_smarty_tpl->_assignInScope('NOT_H_FIELD_TITLE', $_prefixVariable10);
$_smarty_tpl->_assignInScope('IS_MANDATORY', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory());?><div class="fieldProperties col-sm-10" data-field-id="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('id');?>
"><span class="mandatory switch text-capitalize <?php if ((!$_smarty_tpl->tpl_vars['IS_MANDATORY']->value)) {?>disabled<?php }?> <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatoryOptionDisabled()) {?> cursorPointerNotAllowed <?php } else { ?> cursorPointer <?php }?>"data-toggle="tooltip" <?php if ($_smarty_tpl->tpl_vars['IS_MANDATORY']->value) {?> title="<?php echo $_smarty_tpl->tpl_vars['NOT_M_FIELD_TITLE']->value;?>
" <?php } else { ?> title="<?php echo $_smarty_tpl->tpl_vars['M_FIELD_TITLE']->value;?>
" <?php }?>><i class="fa fa-exclamation-circle" data-name="mandatory" data-enable-value="M" data-disable-value="O"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatoryOptionDisabled()) {?>readonly="readonly"<?php }?>></i>&nbsp;<?php echo vtranslate('LBL_PROP_MANDATORY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $_smarty_tpl->_assignInScope('IS_QUICK_EDIT_ENABLED', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isQuickCreateEnabled());?><span class="quickCreate switch <?php if ((!$_smarty_tpl->tpl_vars['IS_QUICK_EDIT_ENABLED']->value)) {?>disabled<?php }
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isQuickCreateOptionDisabled() || $_smarty_tpl->tpl_vars['IS_MANDATORY']->value) {?> cursorPointerNotAllowed <?php } else { ?> cursorPointer <?php }?>"data-toggle="tooltip" <?php if ($_smarty_tpl->tpl_vars['IS_QUICK_EDIT_ENABLED']->value) {?> title="<?php echo $_smarty_tpl->tpl_vars['NOT_Q_FIELD_TITLE']->value;?>
" <?php } else { ?> title="<?php echo $_smarty_tpl->tpl_vars['Q_FIELD_TITLE']->value;?>
" <?php }?>><i class="fa fa-plus" data-name="quickcreate" data-enable-value="2" data-disable-value="1"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isQuickCreateOptionDisabled() || $_smarty_tpl->tpl_vars['IS_MANDATORY']->value) {?>readonly="readonly"<?php }?>title="<?php echo vtranslate('LBL_QUICK_CREATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i>&nbsp;<?php echo vtranslate('LBL_QUICK_CREATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><br><br><?php $_smarty_tpl->_assignInScope('IS_MASS_EDIT_ENABLED', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMassEditable());?><span class="massEdit switch <?php if ((!$_smarty_tpl->tpl_vars['IS_MASS_EDIT_ENABLED']->value)) {?> disabled <?php }
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMassEditOptionDisabled()) {?> cursorPointerNotAllowed <?php } else { ?> cursorPointer <?php }?>"data-toggle="tooltip" <?php if ($_smarty_tpl->tpl_vars['IS_MASS_EDIT_ENABLED']->value) {?> title="<?php echo $_smarty_tpl->tpl_vars['NOT_M_E_FIELD_TITLE']->value;?>
" <?php } else { ?> title="<?php echo $_smarty_tpl->tpl_vars['M_E_FIELD_TITLE']->value;?>
" <?php }?>><img src="<?php echo vimage_path('MassEdit.png');?>
" data-name="masseditable"data-enable-value="1" data-disable-value="2" title="<?php echo vtranslate('LBL_MASS_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMassEditOptionDisabled()) {?>readonly="readonly"<?php }?> height=14 width=14/>&nbsp;<?php echo vtranslate('LBL_MASS_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $_smarty_tpl->_assignInScope('IS_HEADER_FIELD', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isHeaderField());?><span class="header switch <?php if ((!$_smarty_tpl->tpl_vars['IS_HEADER_FIELD']->value)) {?> disabled <?php }
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isHeaderFieldOptionDisabled()) {?> cursorPointerNotAllowed <?php } else { ?> cursorPointer <?php }?>"data-toggle="tooltip" <?php if ($_smarty_tpl->tpl_vars['IS_HEADER_FIELD']->value) {?> title="<?php echo $_smarty_tpl->tpl_vars['NOT_H_FIELD_TITLE']->value;?>
" <?php } else { ?> title="<?php echo $_smarty_tpl->tpl_vars['H_FIELD_TITLE']->value;?>
" <?php }?>><i class="fa fa-flag-o" data-name="headerfield" data-enable-value="1" data-disable-value="0"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isHeaderFieldOptionDisabled()) {?>readonly="readonly"<?php }?>title="<?php echo vtranslate('LBL_HEADER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i>&nbsp;<?php echo vtranslate('LBL_HEADER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><br><br><?php $_smarty_tpl->_assignInScope('IS_SUMMARY_VIEW_ENABLED', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isSummaryField());?><span class="summary switch <?php if ((!$_smarty_tpl->tpl_vars['IS_SUMMARY_VIEW_ENABLED']->value)) {?> disabled <?php }
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isSummaryFieldOptionDisabled()) {?> cursorPointerNotAllowed <?php } else { ?> cursorPointer <?php }?>"data-toggle="tooltip" <?php if ($_smarty_tpl->tpl_vars['IS_SUMMARY_VIEW_ENABLED']->value) {?> title="<?php echo $_smarty_tpl->tpl_vars['NOT_S_FIELD_TITLE']->value;?>
" <?php } else { ?> title="<?php echo $_smarty_tpl->tpl_vars['S_FIELD_TITLE']->value;?>
" <?php }?>><i class="fa fa-key" data-name="summaryfield" data-enable-value="1" data-disable-value="0"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isSummaryFieldOptionDisabled()) {?>readonly="readonly"<?php }?>title="<?php echo vtranslate('LBL_KEY_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i>&nbsp;<?php echo vtranslate('LBL_KEY_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><br><br><div class="defaultValue col-sm-12 <?php if (!$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->hasDefaultValue()) {?>disabled<?php }
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isDefaultValueOptionDisabled()) {?> cursorPointerNotAllowed <?php }?>"><?php $_smarty_tpl->_assignInScope('DEFAULT_VALUE', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDefaultFieldValueToViewInV7FieldsLayOut());
if ((isset($_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value)) && $_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value !== '') {
if (is_array($_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value)) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value, 'DEFAULT_FIELD_VALUE', false, 'DEFAULT_FIELD_NAME');
$_smarty_tpl->tpl_vars['DEFAULT_FIELD_VALUE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['DEFAULT_FIELD_NAME']->value => $_smarty_tpl->tpl_vars['DEFAULT_FIELD_VALUE']->value) {
$_smarty_tpl->tpl_vars['DEFAULT_FIELD_VALUE']->do_else = false;
?><div class="row"><span><img src="<?php echo vimage_path('DefaultValue.png');?>
"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isDefaultValueOptionDisabled()) {?> readonly="readonly" <?php }
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->hasDefaultValue()) {?> title="<?php echo $_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value;?>
" <?php }?>data-name="defaultValueField" height=14 width=14 /></span>&nbsp;<?php if ($_smarty_tpl->tpl_vars['DEFAULT_FIELD_VALUE']->value) {
$_smarty_tpl->_assignInScope('DEFAULT_FIELD_NAME', mb_strtoupper((string) $_smarty_tpl->tpl_vars['DEFAULT_FIELD_NAME']->value ?? '', 'UTF-8'));?><span><?php echo vtranslate('LBL_DEFAULT_VALUE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
echo vtranslate("LBL_".((string)$_smarty_tpl->tpl_vars['DEFAULT_FIELD_NAME']->value),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 : </span><span data-defaultvalue-fieldname="<?php echo $_smarty_tpl->tpl_vars['DEFAULT_FIELD_NAME']->value;?>
" data-defaultvalue="<?php echo $_smarty_tpl->tpl_vars['DEFAULT_FIELD_VALUE']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['DEFAULT_FIELD_VALUE']->value;?>
</span><?php } else {
echo vtranslate('LBL_DEFAULT_VALUE_NOT_SET',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
}?></div><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
} else { ?><div class="row"><span><img src="<?php echo vimage_path('DefaultValue.png');?>
"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isDefaultValueOptionDisabled()) {?> readonly="readonly" <?php }
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->hasDefaultValue()) {?> title="<?php echo preg_replace('!<[^>]*?>!', ' ', (string) $_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value);?>
" <?php }?>data-name="defaultValueField" height=14 width=14 /></span>&nbsp;<span><?php echo vtranslate('LBL_DEFAULT_VALUE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 : </span><span data-defaultvalue="<?php echo preg_replace('!<[^>]*?>!', ' ', (string) $_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value);?>
"><?php echo preg_replace('!<[^>]*?>!', ' ', (string) $_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value);?>
</span></div><?php }
} else { ?><div class="row"><span><img src="<?php echo vimage_path('DefaultValue.png');?>
"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isDefaultValueOptionDisabled()) {?> readonly="readonly" <?php }
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->hasDefaultValue()) {?> title="<?php echo $_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value;?>
" <?php }?>data-name="defaultValueField" height=14 width=14 /></span>&nbsp;<span><?php echo vtranslate('LBL_DEFAULT_VALUE_NOT_SET',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></div><?php }?></div></div><span class="col-sm-2 actions"><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isEditable()) {?><a href="javascript:void(0)" class="editFieldDetails"><i class="fa fa-pencil" title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i></a><?php }
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isCustomField() == 'true') {?><a href="javascript:void(0)" class="deleteCustomField pull-right" data-field-id="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('id');?>
"data-one-one-relationship="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isOneToOneRelationField();?>
" data-relationship-field="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isRelationShipReponsibleField();?>
"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isOneToOneRelationField()) {
$_smarty_tpl->_assignInScope('ONE_ONE_RELATION_FIELD_LABEL', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getOneToOneRelationField()->get('label'));
$_smarty_tpl->_assignInScope('ONE_ONE_RELATION_MODULE_NAME', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getOneToOneRelationField()->getModuleName());
$_smarty_tpl->_assignInScope('ONE_ONE_RELATION_FIELD_NAME', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getOneToOneRelationField()->getName());?>data-relation-field-label="<?php echo $_smarty_tpl->tpl_vars['ONE_ONE_RELATION_FIELD_LABEL']->value;?>
"data-relation-module-label="<?php echo vtranslate($_smarty_tpl->tpl_vars['ONE_ONE_RELATION_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['ONE_ONE_RELATION_MODULE_NAME']->value);?>
"data-current-field-label ="<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value);?>
"data-current-module-label="<?php echo vtranslate($_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value);?>
"data-field-name="<?php echo $_smarty_tpl->tpl_vars['ONE_ONE_RELATION_FIELD_NAME']->value;?>
"<?php }
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isRelationShipReponsibleField()) {
$_smarty_tpl->_assignInScope('RELATION_MODEL', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getRelationShipForThisField());?>data-relation-field-label="<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['RELATION_MODEL']->value->getRelationModuleName());?>
"data-relation-module-label="<?php echo vtranslate($_smarty_tpl->tpl_vars['RELATION_MODEL']->value->getRelationModuleName(),$_smarty_tpl->tpl_vars['RELATION_MODEL']->value->getRelationModuleName());?>
"data-current-module-label="<?php echo vtranslate($_smarty_tpl->tpl_vars['RELATION_MODEL']->value->getParentModuleName(),$_smarty_tpl->tpl_vars['RELATION_MODEL']->value->getParentModuleName());?>
"data-current-tab-label="<?php echo vtranslate($_smarty_tpl->tpl_vars['RELATION_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['RELATION_MODEL']->value->getRelationModuleName());?>
"<?php }?> ><i class="fa fa-trash" title="<?php echo vtranslate('LBL_DELETE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i></a><?php }?></span></div></div></div></li><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
if (php7_count($_smarty_tpl->tpl_vars['FIELDS_LIST']->value)%2 == 0) {
if ($_smarty_tpl->tpl_vars['BLOCK_MODEL']->value->isAddCustomFieldEnabled()) {?><li class="row dummyRow"><span class="dragUiText col-sm-8"><?php echo vtranslate('LBL_ADD_NEW_FIELD_HERE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><span class="col-sm-4" style="margin-top: 7%;margin-left: -15%;"><button class="btn btn-default btn-sm addButton"><i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo vtranslate('LBL_ADD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button></span></li><?php }
}?></ul><ul name="<?php if ($_smarty_tpl->tpl_vars['IS_FIELDS_SORTABLE']->value) {?>sortable2<?php } else { ?>unSortable2<?php }?>" class="connectedSortable col-sm-6"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FIELDS_LIST']->value, 'FIELD_MODEL', false, NULL, 'fieldlist1', array (
  'index' => true,
));
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->value) {
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_fieldlist1']->value['index']++;
$_smarty_tpl->_assignInScope('FIELD_INFO', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo());
if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_fieldlist1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_fieldlist1']->value['index'] : null)%2 != 0) {?><li><div class="row border1px"><div class="col-sm-4"><div class="opacity editFields marginLeftZero" data-block-id="<?php echo $_smarty_tpl->tpl_vars['BLOCK_ID']->value;?>
" data-field-id="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('id');?>
"data-sequence="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('sequence');?>
" data-field-name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
"><div class="row" ><?php $_smarty_tpl->_assignInScope('IS_MANDATORY', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory());?><span class="col-sm-1">&nbsp;<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isEditable() && $_smarty_tpl->tpl_vars['IS_FIELDS_SORTABLE']->value) {?><img src="<?php echo vimage_path('drag.png');?>
" class="cursorPointerMove" border="0" title="<?php echo vtranslate('LBL_DRAG',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"/><?php }?></span><div class="col-sm-9" style="word-wrap: break-word;"><div class="fieldLabelContainer row"><span class="fieldLabel"><b><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value);?>
</b><?php if ($_smarty_tpl->tpl_vars['IS_MANDATORY']->value) {?>&nbsp;<span class="redColor">*</span><?php }?></span><br><span class="pull-right" style="opacity:0.6;"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataTypeLabel(),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></div></div></div></div></div><div class="col-sm-8 fieldPropertyContainer"><div class="row " style="padding: 10px 0px;"><?php $_smarty_tpl->_assignInScope('IS_MANDATORY', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory());?><div class="fieldProperties col-sm-10" data-field-id="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('id');?>
"><span class="mandatory switch text-capitalize <?php if ((!$_smarty_tpl->tpl_vars['IS_MANDATORY']->value)) {?>disabled<?php }?> <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatoryOptionDisabled()) {?> cursorPointerNotAllowed <?php } else { ?> cursorPointer <?php }?>"data-toggle="tooltip" <?php if ($_smarty_tpl->tpl_vars['IS_MANDATORY']->value) {?> title="<?php echo $_smarty_tpl->tpl_vars['NOT_M_FIELD_TITLE']->value;?>
" <?php } else { ?> title="<?php echo $_smarty_tpl->tpl_vars['M_FIELD_TITLE']->value;?>
" <?php }?>><i class="fa fa-exclamation-circle" data-name="mandatory" data-enable-value="M" data-disable-value="O"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatoryOptionDisabled()) {?>readonly="readonly"<?php }?>></i>&nbsp;<?php echo vtranslate('LBL_PROP_MANDATORY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $_smarty_tpl->_assignInScope('IS_QUICK_EDIT_ENABLED', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isQuickCreateEnabled());?><span class="quickCreate switch <?php if ((!$_smarty_tpl->tpl_vars['IS_QUICK_EDIT_ENABLED']->value)) {?>disabled<?php }
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isQuickCreateOptionDisabled() || $_smarty_tpl->tpl_vars['IS_MANDATORY']->value) {?> cursorPointerNotAllowed <?php } else { ?> cursorPointer <?php }?>"data-toggle="tooltip" <?php if ($_smarty_tpl->tpl_vars['IS_QUICK_EDIT_ENABLED']->value) {?> title="<?php echo $_smarty_tpl->tpl_vars['NOT_Q_FIELD_TITLE']->value;?>
" <?php } else { ?> title="<?php echo $_smarty_tpl->tpl_vars['Q_FIELD_TITLE']->value;?>
" <?php }?>><i class="fa fa-plus" data-name="quickcreate" data-enable-value="2" data-disable-value="1"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isQuickCreateOptionDisabled() || $_smarty_tpl->tpl_vars['IS_MANDATORY']->value) {?>readonly="readonly"<?php }?>title="<?php echo vtranslate('LBL_QUICK_CREATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i>&nbsp;<?php echo vtranslate('LBL_QUICK_CREATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><br><br><?php $_smarty_tpl->_assignInScope('IS_MASS_EDIT_ENABLED', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMassEditable());?><span class="massEdit switch <?php if ((!$_smarty_tpl->tpl_vars['IS_MASS_EDIT_ENABLED']->value)) {?> disabled <?php }
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMassEditOptionDisabled()) {?> cursorPointerNotAllowed <?php } else { ?> cursorPointer <?php }?>"data-toggle="tooltip" <?php if ($_smarty_tpl->tpl_vars['IS_MASS_EDIT_ENABLED']->value) {?> title="<?php echo $_smarty_tpl->tpl_vars['NOT_M_E_FIELD_TITLE']->value;?>
" <?php } else { ?> title="<?php echo $_smarty_tpl->tpl_vars['M_E_FIELD_TITLE']->value;?>
" <?php }?>><img src="<?php echo vimage_path('MassEdit.png');?>
" data-name="masseditable"data-enable-value="1" data-disable-value="2" title="<?php echo vtranslate('LBL_MASS_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMassEditOptionDisabled()) {?>readonly="readonly"<?php }?> height=14 width=14/>&nbsp;<?php echo vtranslate('LBL_MASS_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $_smarty_tpl->_assignInScope('IS_HEADER_FIELD', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isHeaderField());?><span class="header switch <?php if ((!$_smarty_tpl->tpl_vars['IS_HEADER_FIELD']->value)) {?> disabled <?php }
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isHeaderFieldOptionDisabled()) {?> cursorPointerNotAllowed <?php } else { ?> cursorPointer <?php }?>"data-toggle="tooltip" <?php if ($_smarty_tpl->tpl_vars['IS_HEADER_FIELD']->value) {?> title="<?php echo $_smarty_tpl->tpl_vars['NOT_H_FIELD_TITLE']->value;?>
" <?php } else { ?> title="<?php echo $_smarty_tpl->tpl_vars['H_FIELD_TITLE']->value;?>
" <?php }?>><i class="fa fa-flag-o" data-name="headerfield" data-enable-value="1" data-disable-value="0"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isHeaderFieldOptionDisabled()) {?>readonly="readonly"<?php }?>title="<?php echo vtranslate('LBL_HEADER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i>&nbsp;<?php echo vtranslate('LBL_HEADER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><br><br><?php $_smarty_tpl->_assignInScope('IS_SUMMARY_VIEW_ENABLED', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isSummaryField());?><span class="summary switch <?php if ((!$_smarty_tpl->tpl_vars['IS_SUMMARY_VIEW_ENABLED']->value)) {?> disabled <?php }
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isSummaryFieldOptionDisabled()) {?> cursorPointerNotAllowed <?php } else { ?> cursorPointer <?php }?>"data-toggle="tooltip" <?php if ($_smarty_tpl->tpl_vars['IS_SUMMARY_VIEW_ENABLED']->value) {?> title="<?php echo $_smarty_tpl->tpl_vars['NOT_S_FIELD_TITLE']->value;?>
" <?php } else { ?> title="<?php echo $_smarty_tpl->tpl_vars['S_FIELD_TITLE']->value;?>
" <?php }?>><i class="fa fa-key" data-name="summaryfield" data-enable-value="1" data-disable-value="0"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isSummaryFieldOptionDisabled()) {?>readonly="readonly"<?php }?>title="<?php echo vtranslate('LBL_KEY_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i>&nbsp;<?php echo vtranslate('LBL_KEY_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><br><br><div class="defaultValue col-sm-12 <?php if (!$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->hasDefaultValue()) {?>disabled<?php }
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isDefaultValueOptionDisabled()) {?> cursorPointerNotAllowed <?php }?>"><?php $_smarty_tpl->_assignInScope('DEFAULT_VALUE', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDefaultFieldValueToViewInV7FieldsLayOut());
if ((isset($_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value)) && $_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value !== '') {
if (is_array($_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value)) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value, 'DEFAULT_FIELD_VALUE', false, 'DEFAULT_FIELD_NAME');
$_smarty_tpl->tpl_vars['DEFAULT_FIELD_VALUE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['DEFAULT_FIELD_NAME']->value => $_smarty_tpl->tpl_vars['DEFAULT_FIELD_VALUE']->value) {
$_smarty_tpl->tpl_vars['DEFAULT_FIELD_VALUE']->do_else = false;
?><div class="row defaultValueContent"><span><img src="<?php echo vimage_path('DefaultValue.png');?>
"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isDefaultValueOptionDisabled()) {?> readonly="readonly" <?php }
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->hasDefaultValue()) {?> title="<?php echo $_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value;?>
" <?php }?>data-name="defaultValueField" height=14 width=14 /></span>&nbsp;<?php if ($_smarty_tpl->tpl_vars['DEFAULT_FIELD_VALUE']->value) {
$_smarty_tpl->_assignInScope('DEFAULT_FIELD_NAME', mb_strtoupper((string) $_smarty_tpl->tpl_vars['DEFAULT_FIELD_NAME']->value ?? '', 'UTF-8'));?><span><?php echo vtranslate('LBL_DEFAULT_VALUE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
echo vtranslate("LBL_".((string)$_smarty_tpl->tpl_vars['DEFAULT_FIELD_NAME']->value),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 : </span><span data-defaultvalue-fieldname="<?php echo $_smarty_tpl->tpl_vars['DEFAULT_FIELD_NAME']->value;?>
" data-defaultvalue="<?php echo $_smarty_tpl->tpl_vars['DEFAULT_FIELD_VALUE']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['DEFAULT_FIELD_VALUE']->value;?>
</span><?php } else {
echo vtranslate('LBL_DEFAULT_VALUE_NOT_SET',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
}?></div><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
} else { ?><div class="row defaultValueContent"><span><img src="<?php echo vimage_path('DefaultValue.png');?>
" height=14 width=14<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isDefaultValueOptionDisabled()) {?> readonly="readonly" <?php }
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->hasDefaultValue()) {?> title="<?php echo preg_replace('!<[^>]*?>!', ' ', (string) $_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value);?>
" <?php }?>></span>&nbsp;<span><?php echo vtranslate('LBL_DEFAULT_VALUE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 : </span><span data-defaultvalue="<?php echo preg_replace('!<[^>]*?>!', ' ', (string) $_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value);?>
"><?php echo preg_replace('!<[^>]*?>!', ' ', (string) $_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value);?>
</span></div><?php }
} else { ?><div class="row defaultValueContent"><span><img src="<?php echo vimage_path('DefaultValue.png');?>
"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isDefaultValueOptionDisabled()) {?> readonly="readonly" <?php }
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->hasDefaultValue()) {?> title="<?php echo $_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value;?>
" <?php }?>data-name="defaultValueField" height=14 width=14 /></span>&nbsp;<span><?php echo vtranslate('LBL_DEFAULT_VALUE_NOT_SET',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></div><?php }?></div></div><span class="col-sm-2 actions"><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isEditable()) {?><a href="javascript:void(0)" class="editFieldDetails"><i class="fa fa-pencil" title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i></a><?php }
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isCustomField() == 'true') {?><a href="javascript:void(0)" class="deleteCustomField pull-right" data-field-id="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('id');?>
"data-one-one-relationship="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isOneToOneRelationField();?>
" data-relationship-field="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isRelationShipReponsibleField();?>
"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isOneToOneRelationField()) {
$_smarty_tpl->_assignInScope('ONE_ONE_RELATION_FIELD_LABEL', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getOneToOneRelationField()->get('label'));
$_smarty_tpl->_assignInScope('ONE_ONE_RELATION_MODULE_NAME', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getOneToOneRelationField()->getModuleName());
$_smarty_tpl->_assignInScope('ONE_ONE_RELATION_FIELD_NAME', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getOneToOneRelationField()->getName());?>data-relation-field-label="<?php echo $_smarty_tpl->tpl_vars['ONE_ONE_RELATION_FIELD_LABEL']->value;?>
"data-relation-module-label="<?php echo vtranslate($_smarty_tpl->tpl_vars['ONE_ONE_RELATION_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['ONE_ONE_RELATION_MODULE_NAME']->value);?>
"data-current-field-label ="<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value);?>
"data-current-module-label="<?php echo vtranslate($_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value);?>
"data-field-name="<?php echo $_smarty_tpl->tpl_vars['ONE_ONE_RELATION_FIELD_NAME']->value;?>
"<?php }
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isRelationShipReponsibleField()) {
$_smarty_tpl->_assignInScope('RELATION_MODEL', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getRelationShipForThisField());?>data-relation-field-label="<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['RELATION_MODEL']->value->getRelationModuleName());?>
"data-relation-module-label="<?php echo vtranslate($_smarty_tpl->tpl_vars['RELATION_MODEL']->value->getRelationModuleName(),$_smarty_tpl->tpl_vars['RELATION_MODEL']->value->getRelationModuleName());?>
"data-current-module-label="<?php echo vtranslate($_smarty_tpl->tpl_vars['RELATION_MODEL']->value->getParentModuleName(),$_smarty_tpl->tpl_vars['RELATION_MODEL']->value->getParentModuleName());?>
"data-current-tab-label="<?php echo vtranslate($_smarty_tpl->tpl_vars['RELATION_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['RELATION_MODEL']->value->getRelationModuleName());?>
"<?php }?> ><i class="fa fa-trash" title="<?php echo vtranslate('LBL_DELETE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i></a><?php }?></span></div></div></div></li><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
if (php7_count($_smarty_tpl->tpl_vars['FIELDS_LIST']->value)%2 != 0) {
if ($_smarty_tpl->tpl_vars['BLOCK_MODEL']->value->isAddCustomFieldEnabled()) {?><li class="row dummyRow"><span class="dragUiText col-sm-8"><?php echo vtranslate('LBL_ADD_NEW_FIELD_HERE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><span class="col-sm-4" style="margin-top: 7%;margin-left: -15%;"><button class="btn btn-default btn-sm addButton"><i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo vtranslate('LBL_ADD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button></span></li><?php }
}?></ul></div></div><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></div></div></div><input type="hidden" class="inActiveFieldsArray" value='<?php echo Vtiger_Functions::jsonEncode($_smarty_tpl->tpl_vars['IN_ACTIVE_FIELDS']->value);?>
' /><input type="hidden" id="headerFieldsCount" value="<?php echo $_smarty_tpl->tpl_vars['HEADER_FIELDS_COUNT']->value;?>
"><input type="hidden" id="nameFields" value='<?php echo Vtiger_Functions::jsonEncode($_smarty_tpl->tpl_vars['SELECTED_MODULE_MODEL']->value->getNameFields());?>
'><input type="hidden" id="headerFieldsMeta" value='<?php echo Vtiger_Functions::jsonEncode($_smarty_tpl->tpl_vars['HEADER_FIELDS_META']->value);?>
'><div id="" class="newCustomBlockCopy hide marginBottom10px border1px blockSortable" data-block-id="" data-sequence=""><div class="layoutBlockHeader"><div class="col-sm-3 blockLabel padding10 marginLeftZero" style="word-break: break-all;"><img class="alignMiddle" src="<?php echo vimage_path('drag.png');?>
" />&nbsp;&nbsp;</div><div class="col-sm-9 padding10 marginLeftZero"><div class="blockActions" style="float: right !important;"><span><i class="fa fa-info-circle" title="<?php echo vtranslate('LBL_COLLAPSE_BLOCK_DETAIL_VIEW',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i>&nbsp; <?php echo vtranslate('LBL_COLLAPSE_BLOCK',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<input style="opacity: 0;" type="checkbox"<?php if ($_smarty_tpl->tpl_vars['BLOCK_MODEL']->value->isHidden()) {?> checked value='0' <?php } else { ?> value='1' <?php }?> class ='cursorPointer' id="hiddenCollapseBlock" name=""data-on-text="<?php echo vtranslate('LBL_YES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" data-off-text="<?php echo vtranslate('LBL_NO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" data-on-color="primary" data-block-id="<?php echo $_smarty_tpl->tpl_vars['BLOCK_MODEL']->value->get('id');?>
"/></span>&nbsp;<button class="btn btn-default addButton addCustomField" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo vtranslate('LBL_ADD_CUSTOM_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button>&nbsp;&nbsp;<button class="inActiveFields addButton btn btn-default btn-sm"><?php echo vtranslate('LBL_SHOW_HIDDEN_FIELDS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button>&nbsp;&nbsp;<button class="deleteCustomBlock addButton btn btn-default btn-sm"><?php echo vtranslate('LBL_DELETE_CUSTOM_BLOCK',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button></div></div></div><div class="blockFieldsList row blockFieldsSortable"><ul class="connectedSortable col-sm-6 ui-sortable"name="sortable1"><li class="row dummyRow"><span class="dragUiText col-sm-8"><?php echo vtranslate('LBL_ADD_NEW_FIELD_HERE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><span class="col-sm-4" style="margin-top: 7%;margin-left: -15%;"><button class="btn btn-default btn-sm addButton"><i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo vtranslate('LBL_ADD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button></span></li></ul><ul class="connectedSortable col-sm-6 ui-sortable" name="sortable2"></ul></div></div><li class="newCustomFieldCopy hide"><div class="row border1px"><div class="col-sm-4"><div class="marginLeftZero" data-field-id="" data-sequence=""><div class="row"><span class="col-sm-1">&nbsp;<?php if ($_smarty_tpl->tpl_vars['IS_SORTABLE']->value) {?><img src="<?php echo vimage_path('drag.png');?>
" class="dragImage" border="0" title="<?php echo vtranslate('LBL_DRAG',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"/><?php }?></span><div class="col-sm-9" style="word-wrap: break-word;"><div class="fieldLabelContainer row"><span class="fieldLabel"><b></b>&nbsp;</span><div><span class="pull-right fieldTypeLabel" style="opacity:0.6;"></span></div></div></div></div></div></div><div class="col-sm-8 fieldPropertyContainer"><div class="row " style="padding:10px 0px"><div class="fieldProperties col-sm-10" data-field-id=""><span class="mandatory switch text-capitalize"><i class="fa fa-exclamation-circle" data-name="mandatory" data-enable-value="M" data-disable-value="O" title="<?php echo vtranslate('LBL_MANDATORY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i>&nbsp;<?php echo vtranslate('LBL_PROP_MANDATORY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="quickCreate switch"><i class="fa fa-plus" data-name="quickcreate" data-enable-value="2" data-disable-value="1" title="<?php echo vtranslate('LBL_QUICK_CREATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i>&nbsp;<?php echo vtranslate('LBL_QUICK_CREATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><br><br><span class="massEdit switch" ><img src="<?php echo vimage_path('MassEdit.png');?>
" data-name="masseditable"data-enable-value="1" data-disable-value="2" title="<?php echo vtranslate('LBL_MASS_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" height=14 width=14/>&nbsp;<?php echo vtranslate('LBL_MASS_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="header switch"><i class="fa fa-flag-o" data-name="headerfield" data-enable-value="1" data-disable-value="0" title="<?php echo vtranslate('LBL_HEADER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i>&nbsp;<?php echo vtranslate('LBL_HEADER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><br><br><span class="summary switch"><i class="fa fa-key" data-name="summaryfield" data-enable-value="1" data-disable-value="0" title="<?php echo vtranslate('LBL_KEY_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i>&nbsp;<?php echo vtranslate('LBL_KEY_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><br><br><div class="defaultValue col-sm-12"></div></div><span class="col-sm-2 actions"><a href="javascript:void(0)" class="editFieldDetails"><i class="fa fa-pencil" title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i></a><a href="javascript:void(0)" class="deleteCustomField pull-right"><i class="fa fa-trash" title="<?php echo vtranslate('LBL_DELETE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i></a></span></div></div></div></li><div class="modal-dialog modal-content addBlockModal hide"><?php ob_start();
echo vtranslate('LBL_ADD_CUSTOM_BLOCK',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
$_prefixVariable11 = ob_get_clean();
$_smarty_tpl->_assignInScope('HEADER_TITLE', $_prefixVariable11);
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0, true);
?><form class="form-horizontal addCustomBlockForm"><div class="modal-body"><div class="form-group"><label class="control-label fieldLabel col-sm-5"><span><?php echo vtranslate('LBL_BLOCK_NAME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><span class="redColor">*</span></label><div class="controls col-sm-6"><input type="text" name="label" class="col-sm-3 inputElement" data-rule-required='true' style='width: 75%'/></div></div><div class="form-group"><label class="control-label fieldLabel col-sm-5"><?php echo vtranslate('LBL_ADD_AFTER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label><div class="controls col-sm-6"><select class="col-sm-9" name="beforeBlockId"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ALL_BLOCK_LABELS']->value, 'BLOCK_MODEL', false, 'BLOCK_ID');
$_smarty_tpl->tpl_vars['BLOCK_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['BLOCK_ID']->value => $_smarty_tpl->tpl_vars['BLOCK_MODEL']->value) {
$_smarty_tpl->tpl_vars['BLOCK_MODEL']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['BLOCK_ID']->value;?>
" data-label="<?php echo $_smarty_tpl->tpl_vars['BLOCK_MODEL']->value->get('label');?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['BLOCK_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value);?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></div></div></div><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( 'ModalFooter.tpl','Vtiger' )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></form></div><div class="hide defaultValueIcon"><img src="<?php echo vimage_path('DefaultValue.png');?>
" height=14 width=14></div><?php $_smarty_tpl->_assignInScope('FIELD_INFO', $_smarty_tpl->tpl_vars['CLEAN_FIELD_MODEL']->value->getFieldInfo());
$_smarty_tpl->_subTemplateRender(vtemplate_path('FieldCreate.tpl','Settings:LayoutEditor'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('FIELD_MODEL'=>$_smarty_tpl->tpl_vars['CLEAN_FIELD_MODEL']->value,'IS_FIELD_EDIT_MODE'=>false), 0, true);
?><div class="modal-dialog inactiveFieldsModal hide"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h3><?php echo vtranslate('LBL_INACTIVE_FIELDS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h3></div><div class="modal-content"><form class="form-horizontal inactiveFieldsForm"><div class="modal-body"><div class="inActiveList row"><div class="col-sm-1"></div><div class="list col-sm-10"></div><div class="col-sm-1"></div></div></div><div class="modal-footer"><div class="pull-right cancelLinkContainer"><a class="cancelLink" type="reset" data-dismiss="modal"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a></div><button class="btn btn-success" type="submit" name="reactivateButton"><strong><?php echo vtranslate('LBL_REACTIVATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></button></div></form></div></div><div class="ps-scrollbar-y" style="height: 60px;"></div><?php if ($_smarty_tpl->tpl_vars['FIELDS_INFO']->value != '[]') {
echo '<script'; ?>
 type="text/javascript">var uimeta = (function() {var fieldInfo = <?php echo $_smarty_tpl->tpl_vars['FIELDS_INFO']->value;?>
;var newFieldInfo = <?php echo $_smarty_tpl->tpl_vars['NEW_FIELDS_INFO']->value;?>
;return {field: {get: function(name, property) {if(name && property === undefined) {return fieldInfo[name];}if(name && property) {return fieldInfo[name][property]}},isMandatory : function(name){if(fieldInfo[name]) {return fieldInfo[name].mandatory;}return false;},getType : function(name){if(fieldInfo[name]) {return fieldInfo[name].type}return false;},getNewFieldInfo : function() {if(newFieldInfo['newfieldinfo']){return newFieldInfo['newfieldinfo']}return false;}},};})();<?php echo '</script'; ?>
><?php }
}
}
