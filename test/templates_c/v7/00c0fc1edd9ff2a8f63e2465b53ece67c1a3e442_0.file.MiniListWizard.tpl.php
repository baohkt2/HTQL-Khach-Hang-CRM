<?php
/* Smarty version 4.5.5, created on 2025-09-30 08:48:05
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Vtiger\dashboards\MiniListWizard.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68db9945256e01_47383664',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '00c0fc1edd9ff2a8f63e2465b53ece67c1a3e442' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Vtiger\\dashboards\\MiniListWizard.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68db9945256e01_47383664 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['WIZARD_STEP']->value == 'step1') {?><div id="minilistWizardContainer" class='modelContainer modal-dialog'><div class="modal-content"><?php ob_start();
echo vtranslate('LBL_MINI_LIST',$_smarty_tpl->tpl_vars['MODULE']->value);
$_prefixVariable1 = ob_get_clean();
ob_start();
echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);
$_prefixVariable2 = ob_get_clean();
$_smarty_tpl->_assignInScope('HEADER_TITLE', (($_prefixVariable1).(" ")).($_prefixVariable2));
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0, true);
?><form class="form-horizontal" method="post" action="javascript:;"><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
" /><input type="hidden" name="action" value="MassSave" /><table class="table no-border"><tbody><tr><td class="col-lg-1"></td><td class="fieldLabel col-lg-4"><label class="pull-right"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_SELECT_MODULE' ));?>
</label></td><td class="fieldValue col-lg-5"><select name="module" style="width: 100%"><option></option><?php $_smarty_tpl->_assignInScope('TRANSLATED_MODULES_NAMES', array());
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MODULES']->value, 'MODULE_MODEL', false, 'MODULE_NAME');
$_smarty_tpl->tpl_vars['MODULE_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['MODULE_NAME']->value => $_smarty_tpl->tpl_vars['MODULE_MODEL']->value) {
$_smarty_tpl->tpl_vars['MODULE_MODEL']->do_else = false;
ob_start();
echo vtranslate($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);
$_prefixVariable3 = ob_get_clean();
$_tmp_array = isset($_smarty_tpl->tpl_vars['TRANSLATED_MODULE_NAMES']) ? $_smarty_tpl->tpl_vars['TRANSLATED_MODULE_NAMES']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array[$_smarty_tpl->tpl_vars['MODULE_NAME']->value] = $_prefixVariable3;
$_smarty_tpl->_assignInScope('TRANSLATED_MODULE_NAMES', $_tmp_array);?><option value="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></td><td class="col-lg-4"></td></tr><tr><td class="col-lg-1"></td><td class="fieldLabel col-lg-4"><label class="pull-right"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_FILTER' ));?>
</label></td><td class="fieldValue col-lg-5"><select name="filterid" style="width: 100%"><option></option></select></td><td class="col-lg-4"></td></tr><tr><td class="col-lg-1"></td><td class="fieldLabel col-lg-4"><label class="pull-right"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_EDIT_FIELDS' ));?>
</label></td><td class="fieldValue col-lg-5"><select name="fields" size="2" multiple="true" style="width: 100%"><option></option></select></td><td class="col-lg-4"></td></tr></tbody><input type="hidden" id="translatedModuleNames" value='<?php echo Vtiger_Util_Helper::toSafeHTML(ZEND_JSON::encode($_smarty_tpl->tpl_vars['TRANSLATED_MODULE_NAMES']->value));?>
'></table><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( 'ModalFooter.tpl',$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></form></div></div><?php } elseif ($_smarty_tpl->tpl_vars['WIZARD_STEP']->value == 'step2') {?><option></option><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ALLFILTERS']->value, 'FILTERS', false, 'FILTERGROUP');
$_smarty_tpl->tpl_vars['FILTERS']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FILTERGROUP']->value => $_smarty_tpl->tpl_vars['FILTERS']->value) {
$_smarty_tpl->tpl_vars['FILTERS']->do_else = false;
?><optgroup label="<?php echo $_smarty_tpl->tpl_vars['FILTERGROUP']->value;?>
"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FILTERS']->value, 'FILTER', false, 'FILTERNAME');
$_smarty_tpl->tpl_vars['FILTER']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FILTERNAME']->value => $_smarty_tpl->tpl_vars['FILTER']->value) {
$_smarty_tpl->tpl_vars['FILTER']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['FILTER']->value->getId();?>
"><?php echo $_smarty_tpl->tpl_vars['FILTER']->value->get('viewname');?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></optgroup><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
} elseif ($_smarty_tpl->tpl_vars['WIZARD_STEP']->value == 'step3') {?><option></option><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LIST_VIEW_CONTROLLER']->value->getListViewHeaderFields(), 'FIELD', false, 'FIELD_NAME');
$_smarty_tpl->tpl_vars['FIELD']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_NAME']->value => $_smarty_tpl->tpl_vars['FIELD']->value) {
$_smarty_tpl->tpl_vars['FIELD']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD']->value->getFieldLabelKey(),$_smarty_tpl->tpl_vars['SELECTED_MODULE']->value);?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
}
