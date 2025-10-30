<?php
/* Smarty version 4.5.5, created on 2025-09-30 08:54:10
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Calendar\TaskManagementContents.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68db9ab2513055_25248086',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '713867a983de8d22ab0646ff3526a40250fa01f6' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Calendar\\TaskManagementContents.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68db9ab2513055_25248086 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('MODULE_MODEL', Vtiger_Module_Model::getInstance($_smarty_tpl->tpl_vars['MODULE']->value));
$_smarty_tpl->_assignInScope('SELECTED_PICKLIST_FIELDMODEL', Vtiger_Field_Model::getInstance('taskstatus',$_smarty_tpl->tpl_vars['MODULE_MODEL']->value));
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
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></style><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['TASKS']->value, 'RECORD_MODEL', false, 'RECORDID');
$_smarty_tpl->tpl_vars['RECORD_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['RECORDID']->value => $_smarty_tpl->tpl_vars['RECORD_MODEL']->value) {
$_smarty_tpl->tpl_vars['RECORD_MODEL']->do_else = false;
?><div class="entries ui-draggable"><?php $_smarty_tpl->_assignInScope('RECORD_BASIC_INFO', $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('basicInfo'));?><div class="task clearfix" data-recordid="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('id');?>
" data-priority="<?php echo $_smarty_tpl->tpl_vars['PRIORITY']->value;?>
" data-basicinfo='<?php echo json_encode($_smarty_tpl->tpl_vars['RECORD_BASIC_INFO']->value);?>
' style="border-left:4px solid <?php echo $_smarty_tpl->tpl_vars['COLORS']->value[$_smarty_tpl->tpl_vars['PRIORITY']->value];?>
"><?php $_smarty_tpl->_assignInScope('STATUS', $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('status'));?><div class="task-status pull-left"><input class='statusCheckbox' type="checkbox" name="taskstatus" <?php if ($_smarty_tpl->tpl_vars['STATUS']->value == "Completed") {?> checked disabled <?php }?>/></div><div class='task-body clearfix'><div class="taskSubject pull-left <?php if ($_smarty_tpl->tpl_vars['STATUS']->value == "Completed") {?> textStrike <?php }?> textOverflowEllipsis" style='width:70%;'><a class="quickPreview" data-id="<?php echo $_smarty_tpl->tpl_vars['RECORDID']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('subject');?>
"><?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('subject');?>
</a></div><?php $_smarty_tpl->_assignInScope('SELECTED_PICKLISTFIELD_ALL_VALUES', Vtiger_Util_Helper::getPickListValues('taskstatus'));
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['SELECTED_PICKLISTFIELD_ALL_VALUES']->value, 'PICKLIST_VALUE', false, 'PICKLIST_KEY');
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_KEY']->value => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value) {
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->do_else = false;
if ($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value == $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('status')) {?><div class="more pull-right taskStatus picklist-<?php echo $_smarty_tpl->tpl_vars['SELECTED_PICKLIST_FIELDMODEL']->value->getId();?>
-<?php echo $_smarty_tpl->tpl_vars['PICKLIST_KEY']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('status');?>
</div><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></div><div class='other-details clearfix'><div class="pull-left drag-task"><img class="cursorPointerMove" src="<?php echo vimage_path('drag.png');?>
" />&nbsp;&nbsp;</div><?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('sendnotification') == 1) {?><i class='notificationEnabled fa fa-bell'></i>&nbsp;&nbsp;<?php }?><div class="task-details"><span class='taskDueDate'><i class="fa fa-calendar"></i>&nbsp;<span style="vertical-align: middle"><?php echo Vtiger_Date_UIType::getDisplayDateValue($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('due_date'));?>
</span></span><?php $_smarty_tpl->_assignInScope('RELATED_PARENT', $_smarty_tpl->tpl_vars['RECORD_BASIC_INFO']->value['parent_id']);
$_smarty_tpl->_assignInScope('RELATED_CONTACT', $_smarty_tpl->tpl_vars['RECORD_BASIC_INFO']->value['contact_id']);
if (!empty($_smarty_tpl->tpl_vars['RELATED_PARENT']->value)) {?><span class='related_account' style='margin-left: 8px;'><?php $_smarty_tpl->_assignInScope('RELATED_PARENT_MODULE', $_smarty_tpl->tpl_vars['RELATED_PARENT']->value['module']);?><span style="font-size: 12px;"><?php echo Vtiger_Module_Model::getModuleIconPath($_smarty_tpl->tpl_vars['RELATED_PARENT_MODULE']->value);?>
&nbsp;</span><span class="recordName textOverflowEllipsis" style="vertical-align: middle"><a class="quickPreview" href="index.php?module=<?php echo $_smarty_tpl->tpl_vars['RELATED_PARENT_MODULE']->value;?>
&view=Detail&record=<?php echo $_smarty_tpl->tpl_vars['RELATED_PARENT']->value['id'];?>
"  data-id="<?php echo $_smarty_tpl->tpl_vars['RELATED_PARENT']->value['id'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['RELATED_PARENT']->value['display_value'];?>
"><?php echo $_smarty_tpl->tpl_vars['RELATED_PARENT']->value['display_value'];?>
</a></span></span><?php }
if (!empty($_smarty_tpl->tpl_vars['RELATED_CONTACT']->value['id'])) {?><span class='related_contact' style='margin-left: 8px;'><span style="font-size: 12px;"><?php echo Vtiger_Module_Model::getModuleIconPath('Contacts');?>
&nbsp;</span><span class="recordName textOverflowEllipsis" style="vertical-align: middle"><a class="quickPreview" href="index.php?module=<?php echo $_smarty_tpl->tpl_vars['RELATED_CONTACT']->value['module'];?>
&view=Detail&record=<?php echo $_smarty_tpl->tpl_vars['RELATED_CONTACT']->value['id'];?>
" data-id="<?php echo $_smarty_tpl->tpl_vars['RELATED_CONTACT']->value['id'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['RELATED_CONTACT']->value['display_value'];?>
"><?php echo $_smarty_tpl->tpl_vars['RELATED_CONTACT']->value['display_value'];?>
</a></span></span><?php }?></div><div class="more pull-right cursorPointer task-actions"><a href="#" class="quickTask" id="taskPopover"><i class="fa fa-pencil-square-o icon"></i></a>&nbsp;&nbsp;<a href="#" class="taskDelete"><i class="fa fa-trash icon"></i></a></div></div></div></div><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
if ($_smarty_tpl->tpl_vars['PAGING_MODEL']->value->get("nextPageExists") == true) {?><div class="row moreButtonBlock"><button class="btn btn-default moreRecords" style="width:100%;"> <?php echo vtranslate("LBL_MORE",$_smarty_tpl->tpl_vars['MODULE']->value);?>
 </button></div><?php }
}
}
