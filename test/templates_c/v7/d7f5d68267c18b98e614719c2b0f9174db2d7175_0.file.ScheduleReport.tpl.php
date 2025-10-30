<?php
/* Smarty version 4.5.5, created on 2025-09-30 07:52:21
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Reports\ScheduleReport.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68db8c3551ed05_30963713',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd7f5d68267c18b98e614719c2b0f9174db2d7175' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Reports\\ScheduleReport.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68db8c3551ed05_30963713 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('show_report_scheduled', true);?><div class="row"><div><label><input type="checkbox" <?php if ($_smarty_tpl->tpl_vars['show_report_scheduled']->value == false) {?> disabled="disabled" <?php }?> <?php if ($_smarty_tpl->tpl_vars['show_report_scheduled']->value == true && $_smarty_tpl->tpl_vars['SCHEDULEDREPORTS']->value->get('scheduleid') != '') {?> checked="checked" <?php }?> value="<?php if ($_smarty_tpl->tpl_vars['SCHEDULEDREPORTS']->value->get('scheduleid') != '') {?>true<?php }?>" name='enable_schedule' style="margin-top: 0px !important;"> &nbsp;<strong><?php echo vtranslate('LBL_SCHEDULE_REPORTS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></label></div></div><?php if ($_smarty_tpl->tpl_vars['show_report_scheduled']->value == true) {?><div id="scheduleBox" class='row well contentsBackground <?php if ($_smarty_tpl->tpl_vars['SCHEDULEDREPORTS']->value->get('scheduleid') == '') {?> hide <?php }?>'><div class='col-lg-12' style="padding:5px 0px;"><div class='col-lg-3' style='position:relative;top:5px;'><?php echo vtranslate('LBL_RUN_REPORT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</div><div class='col-lg-4'><?php $_smarty_tpl->_assignInScope('scheduleid', $_smarty_tpl->tpl_vars['SCHEDULEDREPORTS']->value->get('scheduleid'));?><select class='select2 inputElement col-lg-3' id='schtypeid' name='schtypeid' style="width: 280px;"><option value="1" <?php if ($_smarty_tpl->tpl_vars['scheduleid']->value == 1) {?>selected<?php }?>><?php echo vtranslate('LBL_DAILY',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><option value="2" <?php if ($_smarty_tpl->tpl_vars['scheduleid']->value == 2) {?>selected<?php }?>><?php echo vtranslate('LBL_WEEKLY',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><option value="5" <?php if ($_smarty_tpl->tpl_vars['scheduleid']->value == 5) {?>selected<?php }?>><?php echo vtranslate('LBL_SPECIFIC_DATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><option value="3" <?php if ($_smarty_tpl->tpl_vars['scheduleid']->value == 3) {?>selected<?php }?>><?php echo vtranslate('LBL_MONTHLY_BY_DATE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><option value="4" <?php if ($_smarty_tpl->tpl_vars['scheduleid']->value == 4) {?>selected<?php }?>><?php echo vtranslate('LBL_YEARLY',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option></select></div></div><div class='col-lg-12 <?php if ($_smarty_tpl->tpl_vars['scheduleid']->value != 2) {?> hide <?php }?>' id='scheduledWeekDay' style='padding:5px 0px;'><div class='col-lg-3' style='position:relative;top:5px;'><?php echo vtranslate('LBL_ON_THESE_DAYS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</div><div class='col-lg-4'><?php $_smarty_tpl->_assignInScope('dayOfWeek', Zend_Json::decode($_smarty_tpl->tpl_vars['SCHEDULEDREPORTS']->value->get('schdayoftheweek')));?><select style='width:280px;' multiple class='select2' name='schdayoftheweek' data-rule-required="true" id='schdayoftheweek'><option value="7" <?php if (is_array($_smarty_tpl->tpl_vars['dayOfWeek']->value) && in_array('7',$_smarty_tpl->tpl_vars['dayOfWeek']->value)) {?> selected <?php }?>><?php echo vtranslate('LBL_DAY0','Calendar');?>
</option><option value="1" <?php if (is_array($_smarty_tpl->tpl_vars['dayOfWeek']->value) && in_array('1',$_smarty_tpl->tpl_vars['dayOfWeek']->value)) {?> selected <?php }?>><?php echo vtranslate('LBL_DAY1','Calendar');?>
</option><option value="2" <?php if (is_array($_smarty_tpl->tpl_vars['dayOfWeek']->value) && in_array('2',$_smarty_tpl->tpl_vars['dayOfWeek']->value)) {?> selected <?php }?>><?php echo vtranslate('LBL_DAY2','Calendar');?>
</option><option value="3" <?php if (is_array($_smarty_tpl->tpl_vars['dayOfWeek']->value) && in_array('3',$_smarty_tpl->tpl_vars['dayOfWeek']->value)) {?> selected <?php }?>><?php echo vtranslate('LBL_DAY3','Calendar');?>
</option><option value="4" <?php if (is_array($_smarty_tpl->tpl_vars['dayOfWeek']->value) && in_array('4',$_smarty_tpl->tpl_vars['dayOfWeek']->value)) {?> selected <?php }?>><?php echo vtranslate('LBL_DAY4','Calendar');?>
</option><option value="5" <?php if (is_array($_smarty_tpl->tpl_vars['dayOfWeek']->value) && in_array('5',$_smarty_tpl->tpl_vars['dayOfWeek']->value)) {?> selected <?php }?>><?php echo vtranslate('LBL_DAY5','Calendar');?>
</option><option value="6" <?php if (is_array($_smarty_tpl->tpl_vars['dayOfWeek']->value) && in_array('6',$_smarty_tpl->tpl_vars['dayOfWeek']->value)) {?> selected <?php }?>><?php echo vtranslate('LBL_DAY6','Calendar');?>
</option></select></div></div><div class='col-lg-12 <?php if ($_smarty_tpl->tpl_vars['scheduleid']->value != 3) {?> hide <?php }?>' id='scheduleMonthByDates' style="padding:5px 0px;"><div class='col-lg-3' style='position:relative;top:5px;'><?php echo vtranslate('LBL_ON_THESE_DAYS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</div><div class='col-lg-4'><?php $_smarty_tpl->_assignInScope('dayOfMonth', Zend_Json::decode($_smarty_tpl->tpl_vars['SCHEDULEDREPORTS']->value->get('schdayofthemonth')));?><select style="width: 280px !important;" multiple class="select2 col-lg-6" data-rule-required="true" name='schdayofthemonth' id='schdayofthemonth' ><?php
$_smarty_tpl->tpl_vars['__smarty_section_foo'] = new Smarty_Variable(array());
if (true) {
for ($_smarty_tpl->tpl_vars['__smarty_section_foo']->value['iteration'] = 1, $_smarty_tpl->tpl_vars['__smarty_section_foo']->value['index'] = 0; $_smarty_tpl->tpl_vars['__smarty_section_foo']->value['iteration'] <= 31; $_smarty_tpl->tpl_vars['__smarty_section_foo']->value['iteration']++, $_smarty_tpl->tpl_vars['__smarty_section_foo']->value['index']++){
?><option value=<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_foo']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_section_foo']->value['iteration'] : null);?>
 <?php if (is_array($_smarty_tpl->tpl_vars['dayOfMonth']->value) && in_array((isset($_smarty_tpl->tpl_vars['__smarty_section_foo']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_section_foo']->value['iteration'] : null),$_smarty_tpl->tpl_vars['dayOfMonth']->value)) {?>selected<?php }?>><?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_foo']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_section_foo']->value['iteration'] : null);?>
</option><?php
}
}
?></select></div></div><div class='col-lg-12 <?php if ($_smarty_tpl->tpl_vars['scheduleid']->value != 5) {?> hide <?php }?>' id='scheduleByDate' style="padding:5px 0px;"><div class='col-lg-3' style='position:relative;top:5px;'><?php echo vtranslate('LBL_CHOOSE_DATE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</div><div class='col-lg-2'><div class="input-group inputElement date" style="margin-bottom: 3px"><?php $_smarty_tpl->_assignInScope('specificDate', Zend_Json::decode($_smarty_tpl->tpl_vars['SCHEDULEDREPORTS']->value->get('schdate')));
if ((isset($_smarty_tpl->tpl_vars['specificDate']->value[0])) && $_smarty_tpl->tpl_vars['specificDate']->value[0] != '') {?> <?php $_smarty_tpl->_assignInScope('specificDate1', DateTimeField::convertToUserFormat($_smarty_tpl->tpl_vars['specificDate']->value[0]));?> <?php }?><input style='width: 185px;' type="text" class="dateField form-control" id="schdate" name="schdate" value="<?php if ((isset($_smarty_tpl->tpl_vars['specificDate1']->value))) {
echo $_smarty_tpl->tpl_vars['specificDate1']->value;
} else { ?>''<?php }?>" data-date-format="<?php echo $_smarty_tpl->tpl_vars['CURRENT_USER']->value->date_format;?>
" data-rule-required="true" /><span class="input-group-addon"><i class="fa fa-calendar "></i></span></div></div></div><div class='col-lg-12 <?php if ($_smarty_tpl->tpl_vars['scheduleid']->value != 4) {?> hide <?php }?>' id='scheduleAnually' style='padding:5px 0px;'><div class='col-lg-3' style='position:relative;top:5px;'><?php echo vtranslate('LBL_SELECT_MONTH_AND_DAY',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</div><div class='col-lg-5'><div id='annualDatePicker'></div></div><div class='col-lg-3'><div style='padding-bottom:5px;'><?php echo vtranslate('LBL_SELECTED_DATES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</div><div><input type=hidden id=hiddenAnnualDates value='<?php echo $_smarty_tpl->tpl_vars['SCHEDULEDREPORTS']->value->get('schannualdates');?>
' /><?php $_smarty_tpl->_assignInScope('ANNUAL_DATES', Zend_Json::decode($_smarty_tpl->tpl_vars['SCHEDULEDREPORTS']->value->get('schannualdates')));?><select multiple class="select2 inputElement col-lg-3" id='annualDates' name='schannualdates' data-rule-required="true" data-date-format="<?php echo $_smarty_tpl->tpl_vars['CURRENT_USER']->value->date_format;?>
"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ANNUAL_DATES']->value, 'DATES');
$_smarty_tpl->tpl_vars['DATES']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['DATES']->value) {
$_smarty_tpl->tpl_vars['DATES']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['DATES']->value;?>
" selected><?php echo $_smarty_tpl->tpl_vars['DATES']->value;?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></div></div></div><div class='col-lg-12' id='scheduledTime' style='padding:5px 0px 10px 0px;'><div class='col-lg-3' style='position:relative;top:5px;'><?php echo vtranslate('LBL_AT_TIME',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<span class="redColor">*</span></div><div class='col-lg-2' id='schtime'><div class='input-group inputElement time'><input type='text' class='timepicker-default form-control ui-timepicker-input' data-format='<?php echo $_smarty_tpl->tpl_vars['CURRENT_USER']->value->get('hour_format');?>
' name='schtime' value="<?php echo $_smarty_tpl->tpl_vars['SCHEDULEDREPORTS']->value->get('schtime');?>
" data-rule-required="true" data-rule-time="true" /><span class="input-group-addon"><i class="fa fa-clock-o"></i></span></div></div></div><div class='col-lg-12' id='recipientsList' style='padding:5px 0px 10px 0px;'><div class='col-lg-3' style='position:relative;top:5px;'><?php echo vtranslate('LBL_SELECT_RECIEPIENTS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<span class="redColor">*</span></div><div class='col-lg-4'><?php $_smarty_tpl->_assignInScope('ALL_ACTIVEUSER_LIST', $_smarty_tpl->tpl_vars['CURRENT_USER']->value->getAccessibleUsers());
$_smarty_tpl->_assignInScope('ALL_ACTIVEGROUP_LIST', $_smarty_tpl->tpl_vars['CURRENT_USER']->value->getAccessibleGroups());
$_smarty_tpl->_assignInScope('recipients', Zend_Json::decode($_smarty_tpl->tpl_vars['SCHEDULEDREPORTS']->value->get('recipients')));?><select multiple class="select2 col-lg-6" id='recipients' name='recipients' data-rule-required="true" style="width: 280px !important;"><optgroup label="<?php echo vtranslate('LBL_USERS');?>
"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ALL_ACTIVEUSER_LIST']->value, 'USER_NAME', false, 'USER_ID');
$_smarty_tpl->tpl_vars['USER_NAME']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['USER_ID']->value => $_smarty_tpl->tpl_vars['USER_NAME']->value) {
$_smarty_tpl->tpl_vars['USER_NAME']->do_else = false;
$_smarty_tpl->_assignInScope('USERID', "USER::".((string)$_smarty_tpl->tpl_vars['USER_ID']->value));?><option value="<?php echo $_smarty_tpl->tpl_vars['USERID']->value;?>
" <?php if (is_array($_smarty_tpl->tpl_vars['recipients']->value) && in_array($_smarty_tpl->tpl_vars['USERID']->value,$_smarty_tpl->tpl_vars['recipients']->value)) {?> selected <?php }?> data-picklistvalue= '<?php echo $_smarty_tpl->tpl_vars['USER_NAME']->value;?>
'> <?php echo $_smarty_tpl->tpl_vars['USER_NAME']->value;?>
 </option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></optgroup><optgroup label="<?php echo vtranslate('LBL_GROUPS');?>
"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ALL_ACTIVEGROUP_LIST']->value, 'GROUP_NAME', false, 'GROUP_ID');
$_smarty_tpl->tpl_vars['GROUP_NAME']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['GROUP_ID']->value => $_smarty_tpl->tpl_vars['GROUP_NAME']->value) {
$_smarty_tpl->tpl_vars['GROUP_NAME']->do_else = false;
$_smarty_tpl->_assignInScope('GROUPID', "GROUP::".((string)$_smarty_tpl->tpl_vars['GROUP_ID']->value));?><option value="<?php echo $_smarty_tpl->tpl_vars['GROUPID']->value;?>
" <?php if (is_array($_smarty_tpl->tpl_vars['recipients']->value) && in_array($_smarty_tpl->tpl_vars['GROUPID']->value,$_smarty_tpl->tpl_vars['recipients']->value)) {?> selected <?php }?> data-picklistvalue= '<?php echo $_smarty_tpl->tpl_vars['GROUP_NAME']->value;?>
'><?php echo $_smarty_tpl->tpl_vars['GROUP_NAME']->value;?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></optgroup><optgroup label="<?php echo vtranslate('Roles','Roles');?>
"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ROLES']->value, 'ROLE_OBJ', false, 'ROLE_ID');
$_smarty_tpl->tpl_vars['ROLE_OBJ']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ROLE_ID']->value => $_smarty_tpl->tpl_vars['ROLE_OBJ']->value) {
$_smarty_tpl->tpl_vars['ROLE_OBJ']->do_else = false;
$_smarty_tpl->_assignInScope('ROLEID', "ROLE::".((string)$_smarty_tpl->tpl_vars['ROLE_ID']->value));?><option value="<?php echo $_smarty_tpl->tpl_vars['ROLEID']->value;?>
" <?php if (is_array($_smarty_tpl->tpl_vars['recipients']->value) && in_array($_smarty_tpl->tpl_vars['ROLEID']->value,$_smarty_tpl->tpl_vars['recipients']->value)) {?> selected <?php }?> data-picklistvalue= '<?php echo $_smarty_tpl->tpl_vars['ROLE_OBJ']->value->get('rolename');?>
'><?php echo $_smarty_tpl->tpl_vars['ROLE_OBJ']->value->get('rolename');?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></optgroup></select></div></div><div class='col-lg-12' id='specificemailsids' style='padding:5px 0px 10px 0px;'><div class='col-lg-3' style='position:relative;top:5px;'><?php echo vtranslate('LBL_SPECIFIC_EMAIL_ADDRESS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</div><div class='col-lg-4'><?php $_smarty_tpl->_assignInScope('specificemailids', Zend_Json::decode($_smarty_tpl->tpl_vars['SCHEDULEDREPORTS']->value->get('specificemails')));?><input id="specificemails" style="width: 281px !important;" class="col-lg-6 inputElement" type="text" value="<?php echo $_smarty_tpl->tpl_vars['specificemailids']->value;?>
" name="specificemails" data-validation-engine="validate[funcCall[Vtiger_MultiEmails_Validator_Js.invokeValidation]]"></input></div></div><?php if ($_smarty_tpl->tpl_vars['TYPE']->value != 'Chart') {?><div class='col-lg-12' id='fileformat' style='padding:5px 0px 10px 0px;'><div class='col-lg-3' style='position:relative;top:5px;'><?php echo vtranslate('LBL_FILE_FORMAT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</div><div class='col-lg-2'><select class="select2 inputElement" id='fileformat' name='fileformat' data-validation-engine="validate[required,funcCall[Vtiger_Base_Validator_Js.invokeValidation]]" ><option value="CSV" <?php if ($_smarty_tpl->tpl_vars['SCHEDULEDREPORTS']->value->get('fileformat') == 'CSV') {?> selected <?php }?> data-picklistvalue= 'CSV'>CSV</option><option value="XLS" <?php if ($_smarty_tpl->tpl_vars['SCHEDULEDREPORTS']->value->get('fileformat') == 'XLS') {?> selected <?php }?> data-picklistvalue= 'XLS'>Excel</option></select></div></div><?php }
if ($_smarty_tpl->tpl_vars['SCHEDULEDREPORTS']->value->get('next_trigger_time')) {?><div class="col-lg-12" style="padding:5px 0px 10px 0px;"><div class='col-lg-3'><span class=''><?php echo vtranslate('LBL_NEXT_TRIGGER_TIME',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span></div><div class='col-lg-5'><?php echo $_smarty_tpl->tpl_vars['SCHEDULEDREPORTS']->value->getNextTriggerTimeInUserFormat();?>
<span>&nbsp;(<?php echo $_smarty_tpl->tpl_vars['CURRENT_USER']->value->time_zone;?>
)</span></div></div><?php }?></div><?php }
}
}
