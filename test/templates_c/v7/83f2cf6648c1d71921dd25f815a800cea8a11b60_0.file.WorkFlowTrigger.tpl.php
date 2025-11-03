<?php
/* Smarty version 4.5.5, created on 2025-11-03 01:32:42
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\Workflows\WorkFlowTrigger.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_6908063a912135_90273456',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '83f2cf6648c1d71921dd25f815a800cea8a11b60' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\Workflows\\WorkFlowTrigger.tpl',
      1 => 1762105171,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6908063a912135_90273456 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('EXECUTION_CONDITION', $_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->executionCondition);?><input type="hidden" name="workflow_trigger" value="<?php echo $_smarty_tpl->tpl_vars['EXECUTION_CONDITION']->value;?>
" /><div class="form-group"><label for="name" class="col-sm-3 control-label"><?php echo vtranslate('LBL_TRIGGER_WORKFLOW_ON',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label><div class="col-sm-6 controls"><?php $_smarty_tpl->_assignInScope('SINGLE_SELECTED_MODULE', "SINGLE_".((string)$_smarty_tpl->tpl_vars['SELECTED_MODULE']->value));?><span><input type="radio" name="workflow_trigger" value="1" <?php if ($_smarty_tpl->tpl_vars['EXECUTION_CONDITION']->value == '1') {?> checked="" <?php }?>> <span id="workflowTriggerCreate"><?php echo vtranslate($_smarty_tpl->tpl_vars['SINGLE_SELECTED_MODULE']->value,$_smarty_tpl->tpl_vars['SELECTED_MODULE']->value);?>
 <?php echo vtranslate('LBL_CREATION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></span><br><span><input type="radio" name="workflow_trigger" value="3" <?php if ($_smarty_tpl->tpl_vars['EXECUTION_CONDITION']->value == '3' || $_smarty_tpl->tpl_vars['EXECUTION_CONDITION']->value == '2') {?> checked="" <?php }?>> <span id="workflowTriggerUpdate"><?php echo vtranslate($_smarty_tpl->tpl_vars['SINGLE_SELECTED_MODULE']->value,$_smarty_tpl->tpl_vars['SELECTED_MODULE']->value);?>
 <?php echo vtranslate('LBL_UPDATED',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span> &nbsp;(<?php echo vtranslate('LBL_INCLUDES_CREATION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
)</span><br><span><input type="radio" name="workflow_trigger" value="5" <?php if ($_smarty_tpl->tpl_vars['EXECUTION_CONDITION']->value == '5') {?> checked="" <?php }?>> <span id="workflowTriggerDelete"><?php echo vtranslate($_smarty_tpl->tpl_vars['SINGLE_SELECTED_MODULE']->value,$_smarty_tpl->tpl_vars['SELECTED_MODULE']->value);?>
 <?php echo vtranslate('LBL_DELETION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></span><br><span><input type="radio" name="workflow_trigger" value="6" <?php if ($_smarty_tpl->tpl_vars['EXECUTION_CONDITION']->value == '6') {?> checked="" <?php } elseif ($_smarty_tpl->tpl_vars['SCHEDULED_WORKFLOW_COUNT']->value >= $_smarty_tpl->tpl_vars['MAX_ALLOWED_SCHEDULED_WORKFLOWS']->value) {?> disabled="disabled" <?php }?>> <?php echo vtranslate('LBL_TIME_INTERVAL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
if ($_smarty_tpl->tpl_vars['SCHEDULED_WORKFLOW_COUNT']->value >= $_smarty_tpl->tpl_vars['MAX_ALLOWED_SCHEDULED_WORKFLOWS']->value) {?>&nbsp;&nbsp;<span class="alert-info textAlignCenter"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;(<?php echo vtranslate('LBL_MAX_SCHEDULED_WORKFLOWS_EXCEEDED',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value,$_smarty_tpl->tpl_vars['MAX_ALLOWED_SCHEDULED_WORKFLOWS']->value);?>
)</span><?php }?></span></div></div><div class="form-group workflowRecurrenceBlock <?php if (!in_array($_smarty_tpl->tpl_vars['EXECUTION_CONDITION']->value,array(2,3))) {?> hide <?php }?>"><label for="name" class="col-sm-3 control-label"><?php echo vtranslate('LBL_RECURRENCE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label><div class="col-sm-5 controls"><span><input type="radio" name="workflow_recurrence" value="2" <?php if ($_smarty_tpl->tpl_vars['EXECUTION_CONDITION']->value == '2') {?> checked="" <?php }?>> <?php echo vtranslate('LBL_FIRST_TIME_CONDITION_MET',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><br><span><input type="radio" name="workflow_recurrence" value="3" <?php if ($_smarty_tpl->tpl_vars['EXECUTION_CONDITION']->value == '3') {?> checked="" <?php }?>> <?php echo vtranslate('LBL_EVERY_TIME_CONDITION_MET',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></div></div><?php if ($_smarty_tpl->tpl_vars['SCHEDULED_WORKFLOW_COUNT']->value < $_smarty_tpl->tpl_vars['MAX_ALLOWED_SCHEDULED_WORKFLOWS']->value) {?><div id="scheduleBox" class='contentsBackground <?php if ($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->executionCondition != 6) {?> hide <?php }?>'><div class="form-group"><label class="col-sm-3 control-label"> <?php echo vtranslate('LBL_FREQUENCY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 </label><div class="col-sm-9 controls"><div class="well"><div class="form-group"><label for="schtypeid" class="col-sm-2 control-label"><?php echo vtranslate('LBL_RUN_WORKFLOW',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label><div class="col-sm-4 controls"><select class='select2' id='schtypeid' name='schtypeid' style="min-width: 150px;"><option value="1" <?php if ($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->schtypeid == 1) {?>selected<?php }?>><?php echo vtranslate('LBL_HOURLY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><option value="2" <?php if ($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->schtypeid == 2) {?>selected<?php }?>><?php echo vtranslate('LBL_DAILY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><option value="3" <?php if ($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->schtypeid == 3) {?>selected<?php }?>><?php echo vtranslate('LBL_WEEKLY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><option value="4" <?php if ($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->schtypeid == 4) {?>selected<?php }?>><?php echo vtranslate('LBL_SPECIFIC_DATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><option value="5" <?php if ($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->schtypeid == 5) {?>selected<?php }?>><?php echo vtranslate('LBL_MONTHLY_BY_DATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><!--option value="6" <?php if ($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->schtypeid == 6) {?>selected<?php }?>><?php echo vtranslate('LBL_MONTHLY_BY_WEEKDAY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option--><option value="7" <?php if ($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->schtypeid == 7) {?>selected<?php }?>><?php echo vtranslate('LBL_YEARLY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option></select></div></div><div class='form-group <?php if ($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->schtypeid != 3) {?> hide <?php }?>' id='scheduledWeekDay'><label class='col-sm-2 control-label' style='position:relative;top:5px;'><?php echo vtranslate('LBL_ON_THESE_DAYS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<span class="redColor">*</span></label><div class='col-sm-10 controls' style="padding-top: 15px; padding-bottom: 15px;"><?php $_smarty_tpl->_assignInScope('dayOfWeek', Zend_Json::decode($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->schdayofweek));?><div class="weekDaySelect"><span class="ui-state-default <?php if (is_array($_smarty_tpl->tpl_vars['dayOfWeek']->value) && in_array("7",$_smarty_tpl->tpl_vars['dayOfWeek']->value)) {?>ui-selected<?php }?>" data-value="7"> <?php echo vtranslate('LBL_DAY0','Calendar');?>
 </span><span class="ui-state-default <?php if (is_array($_smarty_tpl->tpl_vars['dayOfWeek']->value) && in_array("1",$_smarty_tpl->tpl_vars['dayOfWeek']->value)) {?>ui-selected<?php }?>" data-value="1"> <?php echo vtranslate('LBL_DAY1','Calendar');?>
 </span><span class="ui-state-default <?php if (is_array($_smarty_tpl->tpl_vars['dayOfWeek']->value) && in_array("2",$_smarty_tpl->tpl_vars['dayOfWeek']->value)) {?>ui-selected<?php }?>" data-value="2"> <?php echo vtranslate('LBL_DAY2','Calendar');?>
 </span><span class="ui-state-default <?php if (is_array($_smarty_tpl->tpl_vars['dayOfWeek']->value) && in_array("3",$_smarty_tpl->tpl_vars['dayOfWeek']->value)) {?>ui-selected<?php }?>" data-value="3"> <?php echo vtranslate('LBL_DAY3','Calendar');?>
 </span><span class="ui-state-default <?php if (is_array($_smarty_tpl->tpl_vars['dayOfWeek']->value) && in_array("4",$_smarty_tpl->tpl_vars['dayOfWeek']->value)) {?>ui-selected<?php }?>" data-value="4"> <?php echo vtranslate('LBL_DAY4','Calendar');?>
 </span><span class="ui-state-default <?php if (is_array($_smarty_tpl->tpl_vars['dayOfWeek']->value) && in_array("5",$_smarty_tpl->tpl_vars['dayOfWeek']->value)) {?>ui-selected<?php }?>" data-value="5"> <?php echo vtranslate('LBL_DAY5','Calendar');?>
 </span><span class="ui-state-default <?php if (is_array($_smarty_tpl->tpl_vars['dayOfWeek']->value) && in_array("6",$_smarty_tpl->tpl_vars['dayOfWeek']->value)) {?>ui-selected<?php }?>" data-value="6"> <?php echo vtranslate('LBL_DAY6','Calendar');?>
 </span><input type="hidden" data-rule-required="true" name='schdayofweek' id='schdayofweek' <?php if (is_array($_smarty_tpl->tpl_vars['dayOfWeek']->value)) {?> value="<?php echo implode(',',$_smarty_tpl->tpl_vars['dayOfWeek']->value);?>
" <?php } else { ?> value=""<?php }?>/></div></div></div><div class='form-group <?php if ($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->schtypeid != 5) {?> hide <?php }?>' id='scheduleMonthByDates' style="padding:5px 0px;"><label class='col-sm-2 control-label'><?php echo vtranslate('LBL_ON_THESE_DAYS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<span class="redColor">*</span></label><div class='col-sm-4 controls'><?php $_smarty_tpl->_assignInScope('DAYS', Zend_Json::decode($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->schdayofmonth));?><select style='width:150px;' multiple class="select2" data-rule-required="true" name='schdayofmonth[]' id='schdayofmonth' ><?php
$_smarty_tpl->tpl_vars['__smarty_section_foo'] = new Smarty_Variable(array());
if (true) {
for ($_smarty_tpl->tpl_vars['__smarty_section_foo']->value['iteration'] = 1, $_smarty_tpl->tpl_vars['__smarty_section_foo']->value['index'] = 0; $_smarty_tpl->tpl_vars['__smarty_section_foo']->value['iteration'] <= 31; $_smarty_tpl->tpl_vars['__smarty_section_foo']->value['iteration']++, $_smarty_tpl->tpl_vars['__smarty_section_foo']->value['index']++){
?><option value=<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_foo']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_section_foo']->value['iteration'] : null);?>
 <?php if (is_array($_smarty_tpl->tpl_vars['DAYS']->value) && in_array((isset($_smarty_tpl->tpl_vars['__smarty_section_foo']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_section_foo']->value['iteration'] : null),$_smarty_tpl->tpl_vars['DAYS']->value)) {?>selected<?php }?>><?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_foo']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_section_foo']->value['iteration'] : null);?>
</option><?php
}
}
?></select></div></div><div class='form-group <?php if ($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->schtypeid != 4) {?> hide <?php }?>' id='scheduleByDate' style="padding:5px 0px;"><label class='col-sm-2 control-label'><?php echo vtranslate('LBL_CHOOSE_DATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<span class="redColor">*</span></label><div class='col-sm-3 controls'><div class="input-group" style="margin-bottom: 3px"><?php $_smarty_tpl->_assignInScope('specificDate', Zend_Json::decode($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->schannualdates));
if ((isset($_smarty_tpl->tpl_vars['specificDate']->value[0])) && $_smarty_tpl->tpl_vars['specificDate']->value[0] != '') {
$_smarty_tpl->_assignInScope('specificDate1', DateTimeField::convertToUserFormat($_smarty_tpl->tpl_vars['specificDate']->value[0]));
}?><input type="text" class="dateField form-control" name="schdate" value="<?php echo (isset($_smarty_tpl->tpl_vars['specificDate1']->value)) ? $_smarty_tpl->tpl_vars['specificDate1']->value : '';?>
" data-date-format="<?php echo $_smarty_tpl->tpl_vars['CURRENT_USER']->value->date_format;?>
" data-rule-required="true"/><span class="input-group-addon"><i class="fa fa-calendar "></i></span></div></div></div><div class='form-group <?php if ($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->schtypeid != 7) {?> hide <?php }?>' id='scheduleAnually'><label class='col-sm-2 control-label'> <?php echo vtranslate('LBL_SELECT_MONTH_AND_DAY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 <span class="redColor">*</span> </label><div class='col-sm-6 controls'><div id='annualDatePicker'></div></div><div class='col-sm-4 controls'><label style='padding-bottom:5px;'><?php echo vtranslate('LBL_SELECTED_DATES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label><div><input type=hidden id=hiddenAnnualDates value='<?php echo $_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->schannualdates;?>
' /><select multiple class="select2" id='annualDates' name='schannualdates[]' data-rule-required="true" style="min-width: 100px;"><?php if ((isset($_smarty_tpl->tpl_vars['ANNUAL_DATES']->value))) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ANNUAL_DATES']->value, 'DATES');
$_smarty_tpl->tpl_vars['DATES']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['DATES']->value) {
$_smarty_tpl->tpl_vars['DATES']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['DATES']->value;?>
" selected><?php echo $_smarty_tpl->tpl_vars['DATES']->value;?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?></select></div></div></div><div class="form-group <?php if ($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->schtypeid < 2) {?> hide <?php }?>" id='scheduledTime' style='padding:5px 0px 10px 0px;'><label for="schtime" class="col-sm-2 control-label"><?php echo vtranslate('LBL_AT_TIME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 <span class="redColor">*</span></label><div class="col-sm-2 controls" id='schtime'><div class="input-group time" ><input type='text' data-format='<?php echo $_smarty_tpl->tpl_vars['CURRENT_USER']->value->get('hour_format');?>
' name='schtime' value="<?php echo $_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->schtime;?>
" data-rule-required="true" class="timepicker-default inputElement"/><span class="input-group-addon"><i class="fa fa-clock-o"></i></span></div></div></div><?php if ($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->nexttrigger_time) {?><div class="form-group"><label class='col-sm-2 control-label'><?php echo vtranslate('LBL_NEXT_TRIGGER_TIME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label><div class='col-sm-4 controls'><?php if ($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->schtypeid != 4) {
$_smarty_tpl->_assignInScope('userModel', Users_Privileges_Model::getCurrentUserModel());
if ($_smarty_tpl->tpl_vars['userModel']->value->get('hour_format') == '12') {
$_smarty_tpl->_assignInScope('fieldvalue', DateTimeField::convertToUserFormat($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->nexttrigger_time));
$_smarty_tpl->_assignInScope('time_parts', explode(" ",$_smarty_tpl->tpl_vars['fieldvalue']->value));
$_smarty_tpl->_assignInScope('time', $_smarty_tpl->tpl_vars['time_parts']->value[1]);
$_smarty_tpl->_assignInScope('value', Vtiger_Time_UIType::getTimeValueInAMorPM($_smarty_tpl->tpl_vars['time']->value));
$_smarty_tpl->_assignInScope('fieldvalue', (($_smarty_tpl->tpl_vars['time_parts']->value[0]).(' ')).($_smarty_tpl->tpl_vars['value']->value));
echo $_smarty_tpl->tpl_vars['fieldvalue']->value;
} else {
echo DateTimeField::convertToUserFormat($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->nexttrigger_time);
}?><span>&nbsp;(<?php echo $_smarty_tpl->tpl_vars['ACTIVE_ADMIN']->value->time_zone;?>
)</span><?php }?></div></div><?php }?></div></div></div></div><?php }
}
}
