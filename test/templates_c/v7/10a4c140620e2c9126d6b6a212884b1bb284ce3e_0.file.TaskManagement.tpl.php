<?php
/* Smarty version 4.5.5, created on 2025-09-19 07:00:33
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Calendar\TaskManagement.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68ccff91981bd6_86615644',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '10a4c140620e2c9126d6b6a212884b1bb284ce3e' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Calendar\\TaskManagement.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:modules/Calendar/uitypes/OwnerFieldTaskSearchView.tpl' => 1,
  ),
),false)) {
function content_68ccff91981bd6_86615644 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="taskManagementContainer" class='fc-overlay-modal modal-content' style="height:100%;"><input type="hidden" name="colors" value='<?php echo json_encode($_smarty_tpl->tpl_vars['COLORS']->value);?>
'><div class="overlayHeader"><?php $_smarty_tpl->_assignInScope('HEADER_TITLE', "TASK MANAGEMENT");
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0, true);
?></div><hr style="margin:0px;"><div class='modal-body overflowYAuto'><div class='datacontent'><div class="data-header clearfix"><div class="btn-group dateFilters pull-left" role="group" aria-label="..."><button type="button" class="btn btn-default <?php if ($_smarty_tpl->tpl_vars['TASK_FILTERS']->value['date'] == "all") {?>active<?php }?>" data-filtermode="all"><?php echo vtranslate('LBL_ALL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button><button type="button" class="btn btn-default <?php if ($_smarty_tpl->tpl_vars['TASK_FILTERS']->value['date'] == "today") {?>active<?php }?>" data-filtermode="today"><?php echo vtranslate('LBL_TODAY',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button><button type="button" class="btn btn-default <?php if ($_smarty_tpl->tpl_vars['TASK_FILTERS']->value['date'] == "thisweek") {?>active<?php }?>" data-filtermode="thisweek"><?php echo vtranslate('LBL_THIS_WEEK',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button><button type="button" class="btn btn-default dateRange dateField" data-calendar-type="range" data-filtermode="range"><i class="fa fa-calendar"></i></button><button type="button" class="btn btn-default hide rangeDisplay"><span class="selectedRange"></span>&nbsp;<i class="fa fa-times clearRange"></i></button></div><div id="taskManagementOtherFilters" class="otherFilters pull-right" style="width:550px;"><div class='field pull-left' style="width:250px;padding-right: 5px;"><?php $_smarty_tpl->_subTemplateRender("file:modules/Calendar/uitypes/OwnerFieldTaskSearchView.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('FIELD_MODEL'=>$_smarty_tpl->tpl_vars['OWNER_FIELD']->value), 0, false);
?></div><div class='field pull-left' style="width:250px;padding-right: 5px;"><?php $_smarty_tpl->_assignInScope('FIELD_MODEL', $_smarty_tpl->tpl_vars['STATUS_FIELD']->value);
$_smarty_tpl->_assignInScope('FIELD_INFO', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo());
$_smarty_tpl->_assignInScope('PICKLIST_VALUES', $_smarty_tpl->tpl_vars['FIELD_INFO']->value['picklistvalues']);
$_smarty_tpl->_assignInScope('FIELD_INFO', Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($_smarty_tpl->tpl_vars['FIELD_INFO']->value)));
if ((isset($_smarty_tpl->tpl_vars['SEARCH_INFO']->value)) && (isset($_smarty_tpl->tpl_vars['SEARCH_INFO']->value['searchValue']))) {
$_smarty_tpl->_assignInScope('SEARCH_VALUES', explode(',',$_smarty_tpl->tpl_vars['SEARCH_INFO']->value['searchValue']));
} else {
$_smarty_tpl->_assignInScope('SEARCH_VALUES', array());
}?><select class="select2 listSearchContributor" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
" multiple data-fieldinfo='<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['FIELD_INFO']->value, ENT_QUOTES, 'UTF-8', true);?>
'><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value, 'PICKLIST_LABEL', false, 'PICKLIST_KEY');
$_smarty_tpl->tpl_vars['PICKLIST_LABEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_KEY']->value => $_smarty_tpl->tpl_vars['PICKLIST_LABEL']->value) {
$_smarty_tpl->tpl_vars['PICKLIST_LABEL']->do_else = false;
?><option <?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'in_array' ][ 0 ], array( $_smarty_tpl->tpl_vars['PICKLIST_KEY']->value,$_smarty_tpl->tpl_vars['TASK_FILTERS']->value['status'] ))) {?>selected<?php }?> value="<?php echo $_smarty_tpl->tpl_vars['PICKLIST_KEY']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['PICKLIST_LABEL']->value;?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></div><div><button class="btn btn-success search"><span class="fa fa-search"></span></button></div></div></div><hr><div class="data-body row"><?php $_smarty_tpl->_assignInScope('MODULE_MODEL', Vtiger_Module_Model::getInstance($_smarty_tpl->tpl_vars['MODULE']->value));
$_smarty_tpl->_assignInScope('USER_PRIVILEGES_MODEL', Users_Privileges_Model::getCurrentUserPrivilegesModel());
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['PRIORITIES']->value, 'PRIORITY');
$_smarty_tpl->tpl_vars['PRIORITY']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['PRIORITY']->value) {
$_smarty_tpl->tpl_vars['PRIORITY']->do_else = false;
?><div class="col-lg-4 contentsBlock <?php echo strtolower($_smarty_tpl->tpl_vars['PRIORITY']->value);?>
 ui-droppable" data-priority='<?php echo $_smarty_tpl->tpl_vars['PRIORITY']->value;?>
' data-page="<?php echo $_smarty_tpl->tpl_vars['PAGE']->value;?>
"><div class="<?php echo strtolower($_smarty_tpl->tpl_vars['PRIORITY']->value);?>
-header" style="border-bottom: 2px solid <?php echo $_smarty_tpl->tpl_vars['COLORS']->value[$_smarty_tpl->tpl_vars['PRIORITY']->value];?>
"><div class="title" style="background:<?php echo $_smarty_tpl->tpl_vars['COLORS']->value[$_smarty_tpl->tpl_vars['PRIORITY']->value];?>
"><span><?php echo $_smarty_tpl->tpl_vars['PRIORITY']->value;?>
</span></div></div><br><div class="<?php echo strtolower($_smarty_tpl->tpl_vars['PRIORITY']->value);?>
-content content" data-priority='<?php echo $_smarty_tpl->tpl_vars['PRIORITY']->value;?>
' style="border-bottom: 1px solid <?php echo $_smarty_tpl->tpl_vars['COLORS']->value[$_smarty_tpl->tpl_vars['PRIORITY']->value];?>
;padding-bottom: 10px"><?php if ($_smarty_tpl->tpl_vars['USER_PRIVILEGES_MODEL']->value->hasModuleActionPermission($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getId(),'CreateView')) {?><div class="input-group"><input type="text" class="form-control taskSubject <?php echo $_smarty_tpl->tpl_vars['PRIORITY']->value;?>
" placeholder="<?php echo vtranslate('LBL_ADD_TASK_AND_PRESS_ENTER',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" aria-describedby="basic-addon1" style="width: 99%"><span class="quickTask input-group-addon js-task-popover-container more cursorPointer" id="basic-addon1" style="border: 1px solid #ddd; padding: 0 13px;"><a href="#" id="taskPopover" priority='<?php echo $_smarty_tpl->tpl_vars['PRIORITY']->value;?>
'><i class="fa fa-plus icon"></i></a></span></div><?php }?><br><div class='<?php echo strtolower($_smarty_tpl->tpl_vars['PRIORITY']->value);?>
-entries container-fluid scrollable dataEntries padding20' style="height:400px;overflow:auto;width:400px;padding-left: 0px;padding-right: 0px;"></div></div></div><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></div><div class="editTaskContent hide"><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "TaskManagementEdit.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></div></div></div></div>
<?php }
}
