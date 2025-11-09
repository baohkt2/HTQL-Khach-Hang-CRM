<?php
/* Smarty version 4.5.5, created on 2025-11-05 18:14:52
  from 'C:\xampp\htdocs\HTQL-Khach-Hang-CRM-vvan\layouts\v7\modules\Vtiger\uitypes\String.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690b941c4c4597_75532634',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4e5ba443e21f862cbd6abe4569da76ad92b96e97' => 
    array (
      0 => 'C:\\xampp\\htdocs\\HTQL-Khach-Hang-CRM-vvan\\layouts\\v7\\modules\\Vtiger\\uitypes\\String.tpl',
      1 => 1762352656,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690b941c4c4597_75532634 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('FIELD_INFO', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo());
$_smarty_tpl->_assignInScope('SPECIAL_VALIDATOR', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getValidator());
if (!(isset($_smarty_tpl->tpl_vars['FIELD_NAME']->value))) {
$_smarty_tpl->_assignInScope('FIELD_NAME', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName());
}?><input id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_editView_fieldName_<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
" type="text" data-fieldname="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
" data-fieldtype="string" class="inputElement <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isNameField()) {?>nameField<?php }?>" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'php7_htmlentities' ][ 0 ], array( decode_html($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')) ));?>
"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype') == '3' || $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype') == '4' || $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isReadOnly()) {
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype') != '106') {?>readonly<?php } elseif ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype') == '106' && $_smarty_tpl->tpl_vars['MODE']->value == 'edit') {?>readonly<?php }
}
if (!empty($_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR']->value)) {?>data-validator="<?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR']->value);?>
"<?php }
if ($_smarty_tpl->tpl_vars['FIELD_INFO']->value["mandatory"] == true) {?> data-rule-required="true" <?php }
if (!empty($_smarty_tpl->tpl_vars['FIELD_INFO']->value['validator']) && (php7_count($_smarty_tpl->tpl_vars['FIELD_INFO']->value['validator']))) {?>data-specific-rules='<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['FIELD_INFO']->value["validator"]);?>
'<?php }?>/>
<?php }
}
