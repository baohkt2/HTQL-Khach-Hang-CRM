<?php
/* Smarty version 4.5.5, created on 2025-11-05 17:03:56
  from 'C:\xampp\htdocs\HTQL-Khach-Hang-CRM-vvan\layouts\v7\modules\Vtiger\uitypes\OwnerFieldSearchView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690b837c99ae44_65998142',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '58fe984918871ee477cd7cca1498e6c126e4d1dd' => 
    array (
      0 => 'C:\\xampp\\htdocs\\HTQL-Khach-Hang-CRM-vvan\\layouts\\v7\\modules\\Vtiger\\uitypes\\OwnerFieldSearchView.tpl',
      1 => 1762352656,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690b837c99ae44_65998142 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('FIELD_INFO', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtlib_array' ][ 0 ], array( $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo() )));?><div class="select2_search_div"><?php $_smarty_tpl->_assignInScope('ASSIGNED_USER_ID', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name'));
$_smarty_tpl->_assignInScope('ALL_ACTIVEUSER_LIST', $_smarty_tpl->tpl_vars['FIELD_INFO']->value['picklistvalues'][vtranslate('LBL_USERS')]);
$_smarty_tpl->_assignInScope('SEARCH_VALUES', explode(',',(isset($_smarty_tpl->tpl_vars['SEARCH_INFO']->value['searchValue'])) ? $_smarty_tpl->tpl_vars['SEARCH_INFO']->value['searchValue'] : ','));
$_smarty_tpl->_assignInScope('SEARCH_VALUES', array_map("trim",$_smarty_tpl->tpl_vars['SEARCH_VALUES']->value));
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype') == '52' || $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype') == '77') {
$_smarty_tpl->_assignInScope('ALL_ACTIVEGROUP_LIST', array());
} else {
$_smarty_tpl->_assignInScope('ALL_ACTIVEGROUP_LIST', $_smarty_tpl->tpl_vars['FIELD_INFO']->value['picklistvalues'][vtranslate('LBL_GROUPS')]);
}
$_smarty_tpl->_assignInScope('ACCESSIBLE_USER_LIST', $_smarty_tpl->tpl_vars['USER_MODEL']->value->getAccessibleUsersForModule($_smarty_tpl->tpl_vars['MODULE']->value));
$_smarty_tpl->_assignInScope('ACCESSIBLE_GROUP_LIST', $_smarty_tpl->tpl_vars['USER_MODEL']->value->getAccessibleGroupForModule($_smarty_tpl->tpl_vars['MODULE']->value));?><input type="text" class="listSearchContributor inputElement select2_input_element"/><select class="select2 listSearchContributor <?php echo $_smarty_tpl->tpl_vars['ASSIGNED_USER_ID']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['ASSIGNED_USER_ID']->value;?>
" multiple data-fieldinfo='<?php echo htmlspecialchars((string)Zend_Json::encode($_smarty_tpl->tpl_vars['FIELD_INFO']->value), ENT_QUOTES, 'UTF-8', true);?>
' style="display:none"><optgroup label="<?php echo vtranslate('LBL_USERS');?>
"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ALL_ACTIVEUSER_LIST']->value, 'OWNER_NAME', false, 'OWNER_ID');
$_smarty_tpl->tpl_vars['OWNER_NAME']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['OWNER_ID']->value => $_smarty_tpl->tpl_vars['OWNER_NAME']->value) {
$_smarty_tpl->tpl_vars['OWNER_NAME']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['OWNER_NAME']->value;?>
" data-picklistvalue= '<?php echo $_smarty_tpl->tpl_vars['OWNER_NAME']->value;?>
' <?php if (in_array(trim(decode_html($_smarty_tpl->tpl_vars['OWNER_NAME']->value)),$_smarty_tpl->tpl_vars['SEARCH_VALUES']->value)) {?> selected <?php }
if (array_key_exists($_smarty_tpl->tpl_vars['OWNER_ID']->value,$_smarty_tpl->tpl_vars['ACCESSIBLE_USER_LIST']->value)) {?> data-recordaccess=true <?php } else { ?> data-recordaccess=false <?php }?>data-userId="<?php echo $_smarty_tpl->tpl_vars['CURRENT_USER_ID']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['OWNER_NAME']->value;?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></optgroup><?php if (php7_count($_smarty_tpl->tpl_vars['ALL_ACTIVEGROUP_LIST']->value) > 0) {?><optgroup label="<?php echo vtranslate('LBL_GROUPS');?>
"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ALL_ACTIVEGROUP_LIST']->value, 'OWNER_NAME', false, 'OWNER_ID');
$_smarty_tpl->tpl_vars['OWNER_NAME']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['OWNER_ID']->value => $_smarty_tpl->tpl_vars['OWNER_NAME']->value) {
$_smarty_tpl->tpl_vars['OWNER_NAME']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['OWNER_NAME']->value;?>
" data-picklistvalue= '<?php echo $_smarty_tpl->tpl_vars['OWNER_NAME']->value;?>
' <?php if (in_array(trim(decode_html($_smarty_tpl->tpl_vars['OWNER_NAME']->value)),$_smarty_tpl->tpl_vars['SEARCH_VALUES']->value)) {?> selected <?php }
if (array_key_exists($_smarty_tpl->tpl_vars['OWNER_ID']->value,$_smarty_tpl->tpl_vars['ACCESSIBLE_GROUP_LIST']->value)) {?> data-recordaccess=true <?php } else { ?> data-recordaccess=false <?php }?> ><?php echo $_smarty_tpl->tpl_vars['OWNER_NAME']->value;?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></optgroup><?php }?></select></div>
<?php }
}
