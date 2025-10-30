<?php
/* Smarty version 4.5.5, created on 2025-10-29 06:40:41
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\Workflows\Tasks\VTCreateTodoTask.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_6901b6e98dd1c0_14073158',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dff95cbe288aa2838f8f25d9cd696671f3bb4ef0' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\Workflows\\Tasks\\VTCreateTodoTask.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6901b6e98dd1c0_14073158 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('SHOWN_FIELDS_LIST', array());?><div class="row" style="margin-bottom: 70px;"><div class="col-sm-9 col-xs-9"><div class="row form-group"><div class="col-sm-2 col-xs-2"><?php echo vtranslate('LBL_TITLE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<span class="redColor">*</span></div><div class="col-sm-8 col-xs-8"><input data-rule-required="true" class="inputElement" name="todo" type="text" value="<?php echo $_smarty_tpl->tpl_vars['TASK_OBJECT']->value->todo;?>
" /><?php $_tmp_array = isset($_smarty_tpl->tpl_vars['SHOWN_FIELDS_LIST']) ? $_smarty_tpl->tpl_vars['SHOWN_FIELDS_LIST']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['subject'] = 'subject';
$_smarty_tpl->_assignInScope('SHOWN_FIELDS_LIST', $_tmp_array);?></div></div><div class="row form-group"><div class="col-sm-2 col-xs-2"><?php echo vtranslate('LBL_DESCRIPTION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><div class="col-sm-8 col-xs-8"><textarea class="inputElement" name="description" style="height: inherit;"><?php echo $_smarty_tpl->tpl_vars['TASK_OBJECT']->value->description;?>
</textarea><?php $_tmp_array = isset($_smarty_tpl->tpl_vars['SHOWN_FIELDS_LIST']) ? $_smarty_tpl->tpl_vars['SHOWN_FIELDS_LIST']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['description'] = 'description';
$_smarty_tpl->_assignInScope('SHOWN_FIELDS_LIST', $_tmp_array);?></div></div><div class="row form-group"><div class="col-sm-2 col-xs-2"><?php echo vtranslate('LBL_STATUS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><div class="col-sm-5 col-xs-5"><?php $_smarty_tpl->_assignInScope('STATUS_PICKLIST_VALUES', $_smarty_tpl->tpl_vars['TASK_TYPE_MODEL']->value->getTaskBaseModule()->getField('taskstatus')->getPickListValues());?><select name="status" class="select2"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['STATUS_PICKLIST_VALUES']->value, 'STATUS_PICKLIST_VALUE', false, 'STATUS_PICKLIST_KEY');
$_smarty_tpl->tpl_vars['STATUS_PICKLIST_VALUE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['STATUS_PICKLIST_KEY']->value => $_smarty_tpl->tpl_vars['STATUS_PICKLIST_VALUE']->value) {
$_smarty_tpl->tpl_vars['STATUS_PICKLIST_VALUE']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['STATUS_PICKLIST_KEY']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['STATUS_PICKLIST_KEY']->value == $_smarty_tpl->tpl_vars['TASK_OBJECT']->value->status) {?> selected="" <?php }?>><?php echo $_smarty_tpl->tpl_vars['STATUS_PICKLIST_VALUE']->value;?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></div><?php $_tmp_array = isset($_smarty_tpl->tpl_vars['SHOWN_FIELDS_LIST']) ? $_smarty_tpl->tpl_vars['SHOWN_FIELDS_LIST']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['taskstatus'] = 'taskstatus';
$_smarty_tpl->_assignInScope('SHOWN_FIELDS_LIST', $_tmp_array);?></div><div class="row form-group"><div class="col-sm-2 col-xs-2"><?php echo vtranslate('LBL_PRIORITY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><div class="col-sm-5 col-xs-5"><?php $_smarty_tpl->_assignInScope('PRIORITY_PICKLIST_VALUES', $_smarty_tpl->tpl_vars['TASK_TYPE_MODEL']->value->getTaskBaseModule()->getField('taskpriority')->getPickListValues());?><select name="priority" class="select2"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['PRIORITY_PICKLIST_VALUES']->value, 'PRIORITY_PICKLIST_VALUE', false, 'PRIORITY_PICKLIST_KEY');
$_smarty_tpl->tpl_vars['PRIORITY_PICKLIST_VALUE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['PRIORITY_PICKLIST_KEY']->value => $_smarty_tpl->tpl_vars['PRIORITY_PICKLIST_VALUE']->value) {
$_smarty_tpl->tpl_vars['PRIORITY_PICKLIST_VALUE']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['PRIORITY_PICKLIST_KEY']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['PRIORITY_PICKLIST_KEY']->value == $_smarty_tpl->tpl_vars['TASK_OBJECT']->value->priority) {?> selected="" <?php }?>><?php echo $_smarty_tpl->tpl_vars['PRIORITY_PICKLIST_VALUE']->value;?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></div><?php $_tmp_array = isset($_smarty_tpl->tpl_vars['SHOWN_FIELDS_LIST']) ? $_smarty_tpl->tpl_vars['SHOWN_FIELDS_LIST']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['taskpriority'] = 'taskpriority';
$_smarty_tpl->_assignInScope('SHOWN_FIELDS_LIST', $_tmp_array);?></div><div class="row form-group"><div class="col-sm-2 col-xs-2"><?php echo vtranslate('LBL_ASSIGNED_TO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><div class="col-sm-5 col-xs-5"><select name="assigned_user_id" class="select2"><option value=""><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ASSIGNED_TO']->value, 'ASSIGNED_USERS_LIST', false, 'LABEL');
$_smarty_tpl->tpl_vars['ASSIGNED_USERS_LIST']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LABEL']->value => $_smarty_tpl->tpl_vars['ASSIGNED_USERS_LIST']->value) {
$_smarty_tpl->tpl_vars['ASSIGNED_USERS_LIST']->do_else = false;
?><optgroup label="<?php echo vtranslate($_smarty_tpl->tpl_vars['LABEL']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ASSIGNED_USERS_LIST']->value, 'ASSIGNED_USER', false, 'ASSIGNED_USER_KEY');
$_smarty_tpl->tpl_vars['ASSIGNED_USER']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ASSIGNED_USER_KEY']->value => $_smarty_tpl->tpl_vars['ASSIGNED_USER']->value) {
$_smarty_tpl->tpl_vars['ASSIGNED_USER']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['ASSIGNED_USER_KEY']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['ASSIGNED_USER_KEY']->value == $_smarty_tpl->tpl_vars['TASK_OBJECT']->value->assigned_user_id) {?> selected="" <?php }?>><?php echo $_smarty_tpl->tpl_vars['ASSIGNED_USER']->value;?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></optgroup><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?><optgroup label="<?php echo vtranslate('LBL_SPECIAL_OPTIONS');?>
"><option value="copyParentOwner" <?php if ($_smarty_tpl->tpl_vars['TASK_OBJECT']->value->assigned_user_id == 'copyParentOwner') {?> selected="" <?php }?>><?php echo vtranslate('LBL_PARENT_OWNER');?>
</option></optgroup></select></div><?php $_tmp_array = isset($_smarty_tpl->tpl_vars['SHOWN_FIELDS_LIST']) ? $_smarty_tpl->tpl_vars['SHOWN_FIELDS_LIST']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['assigned_user_id'] = 'assigned_user_id';
$_smarty_tpl->_assignInScope('SHOWN_FIELDS_LIST', $_tmp_array);?></div><div class="row form-group"><div class="col-sm-2 col-xs-2"><?php echo vtranslate('LBL_TIME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><div class="col-sm-3 col-xs-3" ><div class="input-group time"><?php if ($_smarty_tpl->tpl_vars['TASK_OBJECT']->value->time != '') {
$_smarty_tpl->_assignInScope('TIME', $_smarty_tpl->tpl_vars['TASK_OBJECT']->value->time);
}?><input type="text" class="timepicker-default inputElement" value="<?php echo (isset($_smarty_tpl->tpl_vars['TIME']->value)) ? $_smarty_tpl->tpl_vars['TIME']->value : '';?>
" name="time" /><span class="input-group-addon"><i class="fa fa-clock-o"></i></span></div></div></div><div class="row form-group"><div class="col-sm-2 col-xs-2"><?php echo vtranslate('LBL_DUE_DATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><div class="col-sm-2 col-xs-2"><div class="row"><div class="col-sm-8 col-xs-8"><input class="inputElement" type="text" name="days" value="<?php echo $_smarty_tpl->tpl_vars['TASK_OBJECT']->value->days;?>
">&nbsp;</div><span class="alignMiddle"><?php echo vtranslate('LBL_DAYS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></div></div><div class="col-sm-2 col-xs-2 marginLeftZero"><select class="select2" name="direction" style="width: 100%;"><option <?php if ($_smarty_tpl->tpl_vars['TASK_OBJECT']->value->direction == 'after') {?>selected=""<?php }?> value="after"><?php echo vtranslate('LBL_AFTER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><option <?php if ($_smarty_tpl->tpl_vars['TASK_OBJECT']->value->direction == 'before') {?>selected=""<?php }?> value="before"><?php echo vtranslate('LBL_BEFORE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option></select></div><span class="col-sm-6 col-xs-6"><div class="row"><div class="col-sm-6 col-xs-6"><select class="select2" name="datefield" style="width: 100%;"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['DATETIME_FIELDS']->value, 'DATETIME_FIELD');
$_smarty_tpl->tpl_vars['DATETIME_FIELD']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['DATETIME_FIELD']->value) {
$_smarty_tpl->tpl_vars['DATETIME_FIELD']->do_else = false;
?><option <?php if ($_smarty_tpl->tpl_vars['TASK_OBJECT']->value->datefield == $_smarty_tpl->tpl_vars['DATETIME_FIELD']->value->get('name')) {?>selected<?php }?> value="<?php echo $_smarty_tpl->tpl_vars['DATETIME_FIELD']->value->get('name');?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['DATETIME_FIELD']->value->get('label'),$_smarty_tpl->tpl_vars['DATETIME_FIELD']->value->getModuleName());?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select>&nbsp;</div><div class="col-sm-6 col-xs-6" style="vertical-align: super; word-wrap: break-word; padding: 0px;">(<?php echo vtranslate('LBL_THE_SAME_VALUE_IS_USED_FOR_START_DATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
)</div></div></span><?php $_tmp_array = isset($_smarty_tpl->tpl_vars['SHOWN_FIELDS_LIST']) ? $_smarty_tpl->tpl_vars['SHOWN_FIELDS_LIST']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['date_start'] = 'date_start';
$_smarty_tpl->_assignInScope('SHOWN_FIELDS_LIST', $_tmp_array);
$_tmp_array = isset($_smarty_tpl->tpl_vars['SHOWN_FIELDS_LIST']) ? $_smarty_tpl->tpl_vars['SHOWN_FIELDS_LIST']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['due_date'] = 'due_date';
$_smarty_tpl->_assignInScope('SHOWN_FIELDS_LIST', $_tmp_array);?></div><div class="row form-group"><div class="col-sm-2 col-xs-2"><?php echo vtranslate('LBL_SEND_NOTIFICATION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><div class="col-sm-6 col-xs-6"><input type="checkbox" name="sendNotification" value="true" <?php if ($_smarty_tpl->tpl_vars['TASK_OBJECT']->value->sendNotification) {?>checked<?php }?> /></div><?php $_tmp_array = isset($_smarty_tpl->tpl_vars['SHOWN_FIELDS_LIST']) ? $_smarty_tpl->tpl_vars['SHOWN_FIELDS_LIST']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['sendnotification'] = 'sendnotification';
$_smarty_tpl->_assignInScope('SHOWN_FIELDS_LIST', $_tmp_array);?></div><?php $_smarty_tpl->_assignInScope('QUALIFIED_MODULE', 'Calendar');
$_smarty_tpl->_assignInScope('RELATED_MODULE_MODEL', Vtiger_Module_Model::getInstance($_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value));
if (!empty($_smarty_tpl->tpl_vars['TASK_OBJECT']->value->todo)) {
$_smarty_tpl->_assignInScope('FIELD_MODELS', $_smarty_tpl->tpl_vars['RELATED_MODULE_MODEL']->value->getFields());
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FIELD_MODELS']->value, 'FIELD_MODEL');
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->value) {
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = false;
$_smarty_tpl->_assignInScope('FIELD_NAME', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name'));
if (!in_array($_smarty_tpl->tpl_vars['FIELD_NAME']->value,$_smarty_tpl->tpl_vars['SHOWN_FIELDS_LIST']->value) && $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayType() != '3' && ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory() || !empty($_smarty_tpl->tpl_vars['TASK_OBJECT']->value->{$_smarty_tpl->tpl_vars['FIELD_NAME']->value})) && $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType() != 'reference' && $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType() != 'multireference') {
$_smarty_tpl->_assignInScope('test', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->set('fieldvalue',$_smarty_tpl->tpl_vars['TASK_OBJECT']->value->{$_smarty_tpl->tpl_vars['FIELD_NAME']->value}));?><div class="row form-group"><div class="col-sm-2 col-xs-2"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory() == true) {?><span class="redColor">*</span><?php }?></div><div class="col-sm-6 col-xs-6"><?php $_smarty_tpl->_subTemplateRender(vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getTemplateName(),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('FIELD_MODEL'=>$_smarty_tpl->tpl_vars['FIELD_MODEL']->value,'USER_MODEL'=>Users_Record_Model::getCurrentUserModel()), 0, true);
?></div></div><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
} else {
$_smarty_tpl->_assignInScope('MANDATORY_FIELD_MODELS', $_smarty_tpl->tpl_vars['RELATED_MODULE_MODEL']->value->getMandatoryFieldModels());
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MANDATORY_FIELD_MODELS']->value, 'MANDATORY_FIELD_MODEL');
$_smarty_tpl->tpl_vars['MANDATORY_FIELD_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['MANDATORY_FIELD_MODEL']->value) {
$_smarty_tpl->tpl_vars['MANDATORY_FIELD_MODEL']->do_else = false;
if (!in_array($_smarty_tpl->tpl_vars['MANDATORY_FIELD_MODEL']->value->get('name'),$_smarty_tpl->tpl_vars['SHOWN_FIELDS_LIST']->value) && $_smarty_tpl->tpl_vars['MANDATORY_FIELD_MODEL']->value->getDisplayType() != '3' && $_smarty_tpl->tpl_vars['MANDATORY_FIELD_MODEL']->value->getFieldDataType() != 'reference' && $_smarty_tpl->tpl_vars['MANDATORY_FIELD_MODEL']->value->getFieldDataType() != 'multireference') {
$_smarty_tpl->_assignInScope('FIELD_NAME', $_smarty_tpl->tpl_vars['MANDATORY_FIELD_MODEL']->value->get('name'));
$_smarty_tpl->_assignInScope('test', $_smarty_tpl->tpl_vars['MANDATORY_FIELD_MODEL']->value->set('fieldvalue',$_smarty_tpl->tpl_vars['TASK_OBJECT']->value->{$_smarty_tpl->tpl_vars['FIELD_NAME']->value}));?><div class="row form-group"><div class="col-sm-2 col-xs-2"><?php echo vtranslate($_smarty_tpl->tpl_vars['MANDATORY_FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<span class="redColor">*</span></div><div class="col-sm-6 col-xs-6"><?php $_smarty_tpl->_subTemplateRender(vtemplate_path($_smarty_tpl->tpl_vars['MANDATORY_FIELD_MODEL']->value->getUITypeModel()->getTemplateName(),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('FIELD_MODEL'=>$_smarty_tpl->tpl_vars['MANDATORY_FIELD_MODEL']->value,'USER_MODEL'=>Users_Record_Model::getCurrentUserModel()), 0, true);
?></div></div><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?></div></div>
<?php }
}
