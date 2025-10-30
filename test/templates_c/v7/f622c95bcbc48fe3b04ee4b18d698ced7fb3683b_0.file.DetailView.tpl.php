<?php
/* Smarty version 4.5.5, created on 2025-09-30 09:03:35
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\Profiles\DetailView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68db9ce7c3b6b7_65339476',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f622c95bcbc48fe3b04ee4b18d698ced7fb3683b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\Profiles\\DetailView.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68db9ce7c3b6b7_65339476 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="detailViewContainer full-height"><div class="col-lg-12 col-md-12 col-sm-12 col-sm-12 col-xs-12 main-scroll"><div class="detailViewTitle form-horizontal" id="profilePageHeader"><div class="clearfix row"><div class="col-sm-10 col-md-10 col-sm-10"><h4><?php echo vtranslate('LBL_PROFILE_VIEW',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4></div><div class="col-sm-2"><div class="btn-group pull-right"><button class="btn btn-default  " type="button" onclick='window.location.href = "<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getEditViewUrl();?>
"'><?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button></div></div></div><hr><br><div class="profileDetailView detailViewInfo"><div class="row form-group"><div class="col-lg-2 col-md-2 col-sm-2 control-label fieldLabel"><label><?php echo vtranslate('LBL_PROFILE_NAME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></div><div class="fieldValue col-lg-6 col-md-6 col-sm-12" name="profilename" id="profilename" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getName();?>
"><strong><?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getName();?>
</strong></div></div><div class="row form-group"><div class="col-lg-2 col-md-2 col-sm-2 control-label fieldLabel"><label><?php echo vtranslate('LBL_DESCRIPTION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
:</label></div><div class="fieldValue col-lg-6 col-md-6 col-sm-12" name="description" id="description"><strong><?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getDescription();?>
</strong></div></div><br><?php ob_start();
echo vimage_path('Enable.png');
$_prefixVariable1=ob_get_clean();
$_smarty_tpl->_assignInScope('ENABLE_IMAGE_PATH', $_prefixVariable1);
ob_start();
echo vimage_path('Disable.png');
$_prefixVariable2=ob_get_clean();
$_smarty_tpl->_assignInScope('DISABLE_IMAGE_PATH', $_prefixVariable2);
if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->hasGlobalReadPermission()) {?><div class="row"><div class="col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-lg-10 col-md-10 col-sm-10"><div><img class="alignMiddle" src="<?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->hasGlobalReadPermission()) {
echo $_smarty_tpl->tpl_vars['ENABLE_IMAGE_PATH']->value;
} else {
echo $_smarty_tpl->tpl_vars['DISABLE_IMAGE_PATH']->value;
}?>" />&nbsp;<?php echo vtranslate('LBL_VIEW_ALL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<div class="input-info-addon"><i class="fa fa-info-circle"></i>&nbsp;<span ><?php echo vtranslate('LBL_VIEW_ALL_DESC',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></div><div><img class="alignMiddle" src="<?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->hasGlobalWritePermission()) {
echo $_smarty_tpl->tpl_vars['ENABLE_IMAGE_PATH']->value;
} else {
echo $_smarty_tpl->tpl_vars['DISABLE_IMAGE_PATH']->value;
}?>" />&nbsp;<?php echo vtranslate('LBL_EDIT_ALL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<div class="input-info-addon"><i class="fa fa-info-circle"></i>&nbsp;<span><?php echo vtranslate('LBL_EDIT_ALL_DESC',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></div></div></div></div></div><?php }?><br><div class="row"><div class="col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-lg-10 col-md-10 col-sm-10"><table class="table table-bordered"><thead><tr class='blockHeader'><th width="27%" style="text-align: left !important"><?php echo vtranslate('LBL_MODULES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><th width="11%"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_VIEW_PRVILIGE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value ));?>
</th><th width="11%"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_CREATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value ));?>
</th><th width="11%"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value ));?>
</th><th width="11%"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_DELETE_PRVILIGE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value ));?>
</th><th width="29%" nowrap="nowrap"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_FIELD_AND_TOOL_PRIVILEGES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value ));?>
</th></tr></thead><tbody><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getModulePermissions(), 'PROFILE_MODULE', false, 'TABID');
$_smarty_tpl->tpl_vars['PROFILE_MODULE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['TABID']->value => $_smarty_tpl->tpl_vars['PROFILE_MODULE']->value) {
$_smarty_tpl->tpl_vars['PROFILE_MODULE']->do_else = false;
?><tr><?php $_smarty_tpl->_assignInScope('MODULE_PERMISSION', $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->hasModulePermission($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value));?><td data-module-name='<?php echo $_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->getName();?>
' data-module-status='<?php echo $_smarty_tpl->tpl_vars['MODULE_PERMISSION']->value;?>
'><img src="<?php if ($_smarty_tpl->tpl_vars['MODULE_PERMISSION']->value) {
echo $_smarty_tpl->tpl_vars['ENABLE_IMAGE_PATH']->value;
} else {
echo $_smarty_tpl->tpl_vars['DISABLE_IMAGE_PATH']->value;
}?>"/>&nbsp;<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( $_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->get('label'),$_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->getName() ));?>
</td><?php $_smarty_tpl->_assignInScope('BASIC_ACTION_ORDER', array(2,3,0,1));
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['BASIC_ACTION_ORDER']->value, 'ACTION_ID');
$_smarty_tpl->tpl_vars['ACTION_ID']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ACTION_ID']->value) {
$_smarty_tpl->tpl_vars['ACTION_ID']->do_else = false;
$_smarty_tpl->_assignInScope('ACTION_MODEL', $_smarty_tpl->tpl_vars['ALL_BASIC_ACTIONS']->value[$_smarty_tpl->tpl_vars['ACTION_ID']->value]);
$_smarty_tpl->_assignInScope('MODULE_ACTION_PERMISSION', $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->hasModuleActionPermission($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value,$_smarty_tpl->tpl_vars['ACTION_MODEL']->value));?><td data-action-state='<?php echo $_smarty_tpl->tpl_vars['ACTION_MODEL']->value->getName();?>
' data-moduleaction-status='<?php echo $_smarty_tpl->tpl_vars['MODULE_ACTION_PERMISSION']->value;?>
' style="text-align: center;"><?php if ($_smarty_tpl->tpl_vars['ACTION_MODEL']->value->isModuleEnabled($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value)) {?><img src="<?php if ($_smarty_tpl->tpl_vars['MODULE_ACTION_PERMISSION']->value) {
echo $_smarty_tpl->tpl_vars['ENABLE_IMAGE_PATH']->value;
} else {
echo $_smarty_tpl->tpl_vars['DISABLE_IMAGE_PATH']->value;
}?>" /><?php }?></td><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?><td class="textAlignCenter"><?php if (($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->getFields() && $_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->isEntityModule()) || $_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->isUtilityActionEnabled()) {?><button type="button" data-handlerfor="fields" data-togglehandler="<?php echo $_smarty_tpl->tpl_vars['TABID']->value;?>
-fields" class="btn btn-sm btn-default" style="padding-right: 20px; padding-left: 20px;"><i class="fa fa-chevron-down"></i></button><?php }?></td></tr><tr class="hide"><td colspan="6" class="row" style="padding-left: 5%;padding-right: 5%"><div class="row" data-togglecontent="<?php echo $_smarty_tpl->tpl_vars['TABID']->value;?>
-fields" style="display: none"><?php if ($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->getFields() && $_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->isEntityModule()) {?><div class="col-sm-12"><label class="pull-left"><strong><?php echo vtranslate('LBL_FIELDS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
if ($_smarty_tpl->tpl_vars['MODULE_NAME']->value == 'Calendar') {?> <?php echo vtranslate('LBL_OF',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 <?php echo vtranslate('LBL_TASKS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);
}?></strong></label><div class="pull-right"><span class="mini-slider-control ui-slider" data-value="0"><a style="margin-top: 3px" class="ui-slider-handle"></a></span><span style="margin: 0 20px;"><?php echo vtranslate('LBL_INIVISIBLE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span>&nbsp;&nbsp;<span class="mini-slider-control ui-slider" data-value="1"><a style="margin-top: 3px" class="ui-slider-handle"></a></span><span style="margin: 0 20px;"><?php echo vtranslate('LBL_READ_ONLY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span>&nbsp;&nbsp;<span class="mini-slider-control ui-slider" data-value="2"><a style="margin-top: 3px" class="ui-slider-handle"></a></span><span style="margin: 0 14px;"><?php echo vtranslate('LBL_WRITE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></div><div class="clearfix"></div></div><table class="table table-bordered"><?php $_smarty_tpl->_assignInScope('COUNTER', 0);
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->getFields(), 'FIELD_MODEL', false, 'FIELD_NAME', 'fields', array (
  'last' => true,
  'iteration' => true,
  'total' => true,
));
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_NAME']->value => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value) {
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_fields']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_fields']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_fields']->value['iteration'] === $_smarty_tpl->tpl_vars['__smarty_foreach_fields']->value['total'];
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isActiveField() && $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('displaytype') != '6') {
$_smarty_tpl->_assignInScope('FIELD_ID', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getId());
if ($_smarty_tpl->tpl_vars['COUNTER']->value%3 == 0) {?><tr><?php }?><td class="col-sm-4"><?php $_smarty_tpl->_assignInScope('DATA_VALUE', $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getModuleFieldPermissionValue($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value,$_smarty_tpl->tpl_vars['FIELD_MODEL']->value));
if ($_smarty_tpl->tpl_vars['DATA_VALUE']->value == 0) {?><span class="mini-slider-control ui-slider col-sm-1" data-value="0" data-range-input='<?php echo $_smarty_tpl->tpl_vars['FIELD_ID']->value;?>
' style="width: 0px;"><a style="margin-top: 4px;margin-left: -13px;" class="ui-slider-handle"></a></span><?php } elseif ($_smarty_tpl->tpl_vars['DATA_VALUE']->value == 1) {?><span class="mini-slider-control ui-slider col-sm-1" data-value="1" data-range-input='<?php echo $_smarty_tpl->tpl_vars['FIELD_ID']->value;?>
' style="width: 0px;"><a style="margin-top: 4px;margin-left: -13px;" class="ui-slider-handle"></a></span><?php } else { ?><span class="mini-slider-control ui-slider col-sm-1" data-value="2" data-range-input='<?php echo $_smarty_tpl->tpl_vars['FIELD_ID']->value;?>
' style="width: 0px;"><a style="margin-top: 4px;margin-left: -13px;" class="ui-slider-handle"></a></span><?php }?>&nbsp;<span class="col-sm-9" style="padding-right: 0px;"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->getName());?>
&nbsp;<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()) {?><span class="redColor">*</span><?php }?></span></td><?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_fields']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_fields']->value['last'] : null) || ($_smarty_tpl->tpl_vars['COUNTER']->value+1)%3 == 0) {?></tr><?php }
$_smarty_tpl->_assignInScope('COUNTER', $_smarty_tpl->tpl_vars['COUNTER']->value+1);
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></table><?php }?></div></td></tr><tr class="hide"><td colspan="6" class="row" style="padding-left: 5%;padding-right: 5%"><div class="row" data-togglecontent="<?php echo $_smarty_tpl->tpl_vars['TABID']->value;?>
-fields" style="display: none"><div class="col-sm-12"><label class="themeTextColor font-x-large pull-left"><strong><?php echo vtranslate('LBL_TOOLS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></label></div><table class="table table-bordered table-striped"><?php $_smarty_tpl->_assignInScope('UTILITY_ACTION_COUNT', 0);
$_smarty_tpl->_assignInScope('ALL_UTILITY_ACTIONS_ARRAY', array());
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ALL_UTILITY_ACTIONS']->value, 'ACTION_MODEL');
$_smarty_tpl->tpl_vars['ACTION_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ACTION_MODEL']->value) {
$_smarty_tpl->tpl_vars['ACTION_MODEL']->do_else = false;
if ($_smarty_tpl->tpl_vars['ACTION_MODEL']->value->isModuleEnabled($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value)) {
$_smarty_tpl->_assignInScope('testArray', array_push($_smarty_tpl->tpl_vars['ALL_UTILITY_ACTIONS_ARRAY']->value,$_smarty_tpl->tpl_vars['ACTION_MODEL']->value));
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ALL_UTILITY_ACTIONS_ARRAY']->value, 'ACTION_MODEL', false, NULL, 'actions', array (
  'index' => true,
  'last' => true,
  'iteration' => true,
  'total' => true,
));
$_smarty_tpl->tpl_vars['ACTION_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ACTION_MODEL']->value) {
$_smarty_tpl->tpl_vars['ACTION_MODEL']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_actions']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_actions']->value['index']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_actions']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_actions']->value['iteration'] === $_smarty_tpl->tpl_vars['__smarty_foreach_actions']->value['total'];
if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_actions']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_actions']->value['index'] : null)%3 == 0) {?><tr><?php }
$_smarty_tpl->_assignInScope('ACTION_ID', $_smarty_tpl->tpl_vars['ACTION_MODEL']->value->get('actionid'));
$_smarty_tpl->_assignInScope('ACTIONNAME_STATUS', $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->hasModuleActionPermission($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value,$_smarty_tpl->tpl_vars['ACTION_ID']->value));?><td <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_actions']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_actions']->value['last'] : null) && (((isset($_smarty_tpl->tpl_vars['__smarty_foreach_actions']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_actions']->value['index'] : null)+1)%3 != 0)) {
$_smarty_tpl->_assignInScope('index', ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_actions']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_actions']->value['index'] : null)+1)%3);
$_smarty_tpl->_assignInScope('colspan', 4-$_smarty_tpl->tpl_vars['index']->value);?>colspan="<?php echo $_smarty_tpl->tpl_vars['colspan']->value;?>
"<?php }?> data-action-name='<?php echo $_smarty_tpl->tpl_vars['ACTION_MODEL']->value->getName();?>
' data-actionname-status='<?php echo $_smarty_tpl->tpl_vars['ACTIONNAME_STATUS']->value;?>
'><img class="alignMiddle" src="<?php if ($_smarty_tpl->tpl_vars['ACTIONNAME_STATUS']->value) {
echo $_smarty_tpl->tpl_vars['ENABLE_IMAGE_PATH']->value;
} else {
echo $_smarty_tpl->tpl_vars['DISABLE_IMAGE_PATH']->value;
}?>" />&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['ACTION_MODEL']->value->getName();?>
</td><?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_actions']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_actions']->value['last'] : null) || ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_actions']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_actions']->value['index'] : null)+1)%3 == 0) {?></div><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></table></div></td></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tbody></table></div></div></div></div></div></div>
<?php }
}
