<?php
/* Smarty version 4.5.5, created on 2025-11-02 07:43:06
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Vtiger\uitypes\Reference.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_69070b8a2c1f36_64742600',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '741a2b7cd6185c9f977ae2b3dd8b695154574b27' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Vtiger\\uitypes\\Reference.tpl',
      1 => 1761802269,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69070b8a2c1f36_64742600 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('FIELD_INFO', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo());
$_smarty_tpl->_assignInScope('FIELD_NAME', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name'));
$_smarty_tpl->_assignInScope('FIELD_VALUE', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'));
$_smarty_tpl->_assignInScope('REFERENCE_LIST', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getReferenceList());
$_smarty_tpl->_assignInScope('REFERENCE_LIST_COUNT', php7_count($_smarty_tpl->tpl_vars['REFERENCE_LIST']->value));
$_smarty_tpl->_assignInScope('SPECIAL_VALIDATOR', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getValidator());
$_smarty_tpl->_assignInScope('AUTOFILL_VALUE', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getAutoFillValue());
$_smarty_tpl->_assignInScope('QUICKCREATE_RESTRICTED_MODULES', Vtiger_Functions::getNonQuickCreateSupportedModules());?><div class="referencefield-wrapper <?php if ($_smarty_tpl->tpl_vars['FIELD_VALUE']->value != 0) {?> selected <?php }?>"><?php ob_start();
echo $_smarty_tpl->tpl_vars['REFERENCE_LIST_COUNT']->value;
$_prefixVariable2 = ob_get_clean();
if ($_prefixVariable2 == 1) {?><input name="popupReferenceModule" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['REFERENCE_LIST']->value[0];?>
"/><?php }
ob_start();
echo $_smarty_tpl->tpl_vars['REFERENCE_LIST_COUNT']->value;
$_prefixVariable3 = ob_get_clean();
if ($_prefixVariable3 > 1) {
$_smarty_tpl->_assignInScope('DISPLAYID', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'));
$_smarty_tpl->_assignInScope('REFERENCED_MODULE_STRUCT', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getReferenceModule($_smarty_tpl->tpl_vars['DISPLAYID']->value));
if (!empty($_smarty_tpl->tpl_vars['REFERENCED_MODULE_STRUCT']->value)) {
$_smarty_tpl->_assignInScope('REFERENCED_MODULE_NAME', $_smarty_tpl->tpl_vars['REFERENCED_MODULE_STRUCT']->value->get('name'));
}
if ((isset($_smarty_tpl->tpl_vars['REFERENCED_MODULE_NAME']->value)) && in_array($_smarty_tpl->tpl_vars['REFERENCED_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['REFERENCE_LIST']->value)) {?><input name="popupReferenceModule" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['REFERENCED_MODULE_NAME']->value;?>
" /><?php } else { ?><input name="popupReferenceModule" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['REFERENCE_LIST']->value[0];?>
" /><?php }
}
$_smarty_tpl->_assignInScope('displayId', $_smarty_tpl->tpl_vars['FIELD_VALUE']->value);?><div class="input-group"><input name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_VALUE']->value;?>
" class="sourceField" data-displayvalue='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getEditViewDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'));?>
' <?php if ($_smarty_tpl->tpl_vars['AUTOFILL_VALUE']->value) {?> data-autofill=<?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['AUTOFILL_VALUE']->value);?>
 <?php }?>/><input id="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
_display" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
_display" data-fieldname="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
" data-fieldtype="reference" type="text"class="marginLeftZero autoComplete inputElement"value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getEditViewDisplayValue($_smarty_tpl->tpl_vars['displayId']->value);?>
"placeholder="<?php echo vtranslate('LBL_TYPE_SEARCH',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"<?php if (!empty($_smarty_tpl->tpl_vars['displayId']->value)) {?>disabled="disabled"<?php }
if ($_smarty_tpl->tpl_vars['FIELD_INFO']->value["mandatory"] == true) {?> data-rule-required="true" data-rule-reference_required="true" <?php }
if (php7_count($_smarty_tpl->tpl_vars['FIELD_INFO']->value['validator'])) {?>data-specific-rules='<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['FIELD_INFO']->value["validator"]);?>
'<?php }?>/><a href="#" class="clearReferenceSelection <?php if (empty($_smarty_tpl->tpl_vars['FIELD_VALUE']->value) || $_smarty_tpl->tpl_vars['FIELD_VALUE']->value <= 0) {?>hide<?php }?>"> x </a><span class="input-group-addon relatedPopup cursorPointer" title="<?php echo vtranslate('LBL_SELECT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_editView_fieldName_<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
_select" class="fa fa-search"></i></span><?php if ((($_smarty_tpl->tpl_vars['REQ']->value->get('view') == 'Edit') || ($_smarty_tpl->tpl_vars['MODULE_NAME']->value == 'Webforms')) && ($_smarty_tpl->tpl_vars['REFERENCE_LIST']->value && !in_array($_smarty_tpl->tpl_vars['REFERENCE_LIST']->value[0],$_smarty_tpl->tpl_vars['QUICKCREATE_RESTRICTED_MODULES']->value))) {?><span class="input-group-addon createReferenceRecord cursorPointer clearfix" title="<?php echo vtranslate('LBL_CREATE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_editView_fieldName_<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
_create" class="fa fa-plus"></i></span><?php }?></div></div>
<?php }
}
