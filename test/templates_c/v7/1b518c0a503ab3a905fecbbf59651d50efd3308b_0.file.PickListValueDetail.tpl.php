<?php
/* Smarty version 4.5.5, created on 2025-09-30 09:04:41
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\Picklist\PickListValueDetail.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68db9d29d5f505_74954089',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1b518c0a503ab3a905fecbbf59651d50efd3308b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\Picklist\\PickListValueDetail.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68db9d29d5f505_74954089 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('PICKLIST_COLOR_MAP', Settings_Picklist_Module_Model::getPicklistColorMap($_smarty_tpl->tpl_vars['SELECTED_PICKLIST_FIELDMODEL']->value->getName()));?><style type="text/css"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['PICKLIST_COLOR_MAP']->value, 'PICKLIST_COLOR', false, 'PICKLIST_KEY_ID');
$_smarty_tpl->tpl_vars['PICKLIST_COLOR']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_KEY_ID']->value => $_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value) {
$_smarty_tpl->tpl_vars['PICKLIST_COLOR']->do_else = false;
$_smarty_tpl->_assignInScope('PICKLIST_TEXT_COLOR', Settings_Picklist_Module_Model::getTextColor($_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value));?>.picklist-<?php echo $_smarty_tpl->tpl_vars['SELECTED_PICKLIST_FIELDMODEL']->value->getId();?>
-<?php echo $_smarty_tpl->tpl_vars['PICKLIST_KEY_ID']->value;?>
 {background-color: <?php echo $_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value;?>
;color: <?php echo $_smarty_tpl->tpl_vars['PICKLIST_TEXT_COLOR']->value;?>
;}<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></style><?php $_smarty_tpl->_assignInScope('NON_DELETABLE_VALUES', $_smarty_tpl->tpl_vars['SELECTED_PICKLIST_FIELDMODEL']->value->getNonEditablePicklistValues($_smarty_tpl->tpl_vars['SELECTED_PICKLIST_FIELDMODEL']->value->getName()));?><ul class="nav nav-tabs massEditTabs" style="margin-bottom: 0;"><li class="active"><a href="#allValuesLayout" data-toggle="tab"><strong><?php echo vtranslate('LBL_ALL_VALUES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></a></li><?php if ($_smarty_tpl->tpl_vars['SELECTED_PICKLIST_FIELDMODEL']->value->isRoleBased()) {?><li id="assignedToRoleTab"><a href="#AssignedToRoleLayout" data-toggle="tab"><strong><?php echo vtranslate('LBL_VALUES_ASSIGNED_TO_A_ROLE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></a></li><?php }?></ul><div class="tab-content layoutContent padding20 themeTableColor overflowVisible"><br><div class="tab-pane active" id="allValuesLayout"><div class="row"><div class="col-lg-2 col-md-2 col-sm-2"></div><div class="col-lg-8 col-md-8 col-sm-8"><table id="pickListValuesTable" class="table table-bordered" style="table-layout: fixed"><thead><tr class="listViewHeaders bgColor"><th><span><?php echo vtranslate($_smarty_tpl->tpl_vars['SELECTED_PICKLIST_FIELDMODEL']->value->get('label'),$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value);?>
&nbsp;<?php echo vtranslate('LBL_ITEMS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><button class="btn pull-right btn-default marginLeftZero" id="addItem"><i class="fa fa-plus"></i>&nbsp;<?php echo vtranslate('LBL_ADD_VALUE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button><br><br></th></tr></thead><tbody><tr><td><!-- Placeholder role to allow drag-and-drop for last elements --></td></tr><input type="hidden" id="dragImagePath" value="<?php echo vimage_path('drag.png');?>
" /><?php $_smarty_tpl->_assignInScope('PICKLIST_VALUES', $_smarty_tpl->tpl_vars['SELECTED_PICKLISTFIELD_ALL_VALUES']->value);
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value, 'PICKLIST_VALUE', false, 'PICKLIST_KEY');
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_KEY']->value => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value) {
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->do_else = false;
?><tr class="pickListValue" data-key-id="<?php echo $_smarty_tpl->tpl_vars['PICKLIST_KEY']->value;?>
" data-key="<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value);?>
" data-deletable="<?php if (!in_array($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value,$_smarty_tpl->tpl_vars['NON_DELETABLE_VALUES']->value)) {?>true<?php } else { ?>false<?php }?>"><td class="textOverflowEllipsis fieldPropertyContainer"><span class="pull-left"><img class="cursorDrag alignMiddle" src="<?php echo vimage_path('drag.png');?>
"/> &nbsp;&nbsp;<span class="picklist-color picklist-<?php echo $_smarty_tpl->tpl_vars['SELECTED_PICKLIST_FIELDMODEL']->value->getId();?>
-<?php echo $_smarty_tpl->tpl_vars['PICKLIST_KEY']->value;?>
"> <?php echo vtranslate($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value,$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value);?>
 </span></span><span class="pull-right picklistActions" style='margin-top:0px;'><a title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"  class="renameItem"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;&nbsp;<?php if (!in_array($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value,$_smarty_tpl->tpl_vars['NON_DELETABLE_VALUES']->value)) {?><a title="<?php echo vtranslate('LBL_DELETE_VALUE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" class="deleteItem"><i class="fa fa-trash-o"></i></a><?php }?></span></td></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tbody><span class="picklistActionsTemplate hide"><a title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"  class="renameItem"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;&nbsp;<a title="<?php echo vtranslate('LBL_DELETE_VALUE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" class="deleteItem"><i class="fa fa-trash-o"></i></a></span></table></div></div><div id="createViewContents" style="display: none;"><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "CreateView.tpl",$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></div></div><br><?php if ($_smarty_tpl->tpl_vars['SELECTED_PICKLIST_FIELDMODEL']->value->isRoleBased()) {?><div class="tab-pane form-horizontal row" id="AssignedToRoleLayout"><div class="col-lg-2 col-md-2 col-sm-2"></div><div class="col-lg-10 col-md-10 col-sm-10"><div class="form-group row"><label class="control-label col-lg-2 col-md-2 col-sm-2"><?php echo vtranslate('LBL_ROLE_NAME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label><div class="controls col-lg-4 col-md-4 col-sm-4"><select id="rolesList" class="select2 inputElement" name="rolesSelected" data-placeholder="<?php echo vtranslate('LBL_CHOOSE_ROLES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ROLES_LIST']->value, 'ROLE');
$_smarty_tpl->tpl_vars['ROLE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ROLE']->value) {
$_smarty_tpl->tpl_vars['ROLE']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['ROLE']->value->get('roleid');?>
"><?php echo $_smarty_tpl->tpl_vars['ROLE']->value->get('rolename');?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></div></div><div id="pickListValeByRoleContainer" class="col-lg-12 col-md-12 col-sm-12"></div></div></div><?php }?></div>
<?php }
}
