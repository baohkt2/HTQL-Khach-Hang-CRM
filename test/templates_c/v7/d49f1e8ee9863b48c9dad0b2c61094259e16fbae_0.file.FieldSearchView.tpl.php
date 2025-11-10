<?php
/* Smarty version 4.5.5, created on 2025-11-09 19:02:26
  from 'C:\xampp\htdocs\cusc\layouts\v7\modules\Vtiger\uitypes\FieldSearchView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_6910e54204bc00_12451548',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd49f1e8ee9863b48c9dad0b2c61094259e16fbae' => 
    array (
      0 => 'C:\\xampp\\htdocs\\cusc\\layouts\\v7\\modules\\Vtiger\\uitypes\\FieldSearchView.tpl',
      1 => 1762713640,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6910e54204bc00_12451548 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('FIELD_INFO', Zend_Json::encode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo()));?><div class=""><input type="text" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
" class="listSearchContributor inputElement" value="<?php if ((isset($_smarty_tpl->tpl_vars['SEARCH_INFO']->value['searchValue']))) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['SEARCH_INFO']->value['searchValue'], ENT_QUOTES, 'UTF-8', true);
}?>" data-field-type="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType();?>
" data-fieldinfo='<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['FIELD_INFO']->value, ENT_QUOTES, 'UTF-8', true);?>
'/></div>
<?php }
}
