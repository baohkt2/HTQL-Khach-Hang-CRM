<?php
/* Smarty version 4.5.5, created on 2025-09-20 08:34:17
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Vtiger\uitypes\Recurrence.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68ce6709e407a6_89908132',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f759efa19de9a46c2c6a57cf042ddf4a6599fdf0' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Vtiger\\uitypes\\Recurrence.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68ce6709e407a6_89908132 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('SPECIAL_VALIDATOR', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getValidator());?><div class="row"><div class="col-sm-1"><?php if ($_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['recurringcheck'] == 'Yes' && !$_smarty_tpl->tpl_vars['REQ']->value->get('isDuplicate')) {?><input type="hidden" class="recurringEdit" value="true" /><?php }?><input type="checkbox" name="recurringcheck" data-field-id= '<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('id');?>
' value="" <?php if ($_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['recurringcheck'] == 'Yes') {?>checked<?php }?>/>&nbsp;&nbsp;</div><div id="repeatUI" style="visibility: <?php if ($_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['recurringcheck'] == 'Yes') {?>visible<?php } else { ?>collapse<?php }?>;" class="col-sm-9"><div class="row"><span class="col-sm-2 padding0px"><span class="alignMiddle"><?php echo vtranslate('LBL_REPEATEVENT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;&nbsp;</span><select class="select2 input-mini" name="repeat_frequency"><?php
$_smarty_tpl->tpl_vars['FREQUENCY'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['FREQUENCY']->step = 1;$_smarty_tpl->tpl_vars['FREQUENCY']->total = (int) ceil(($_smarty_tpl->tpl_vars['FREQUENCY']->step > 0 ? 14+1 - (1) : 1-(14)+1)/abs($_smarty_tpl->tpl_vars['FREQUENCY']->step));
if ($_smarty_tpl->tpl_vars['FREQUENCY']->total > 0) {
for ($_smarty_tpl->tpl_vars['FREQUENCY']->value = 1, $_smarty_tpl->tpl_vars['FREQUENCY']->iteration = 1;$_smarty_tpl->tpl_vars['FREQUENCY']->iteration <= $_smarty_tpl->tpl_vars['FREQUENCY']->total;$_smarty_tpl->tpl_vars['FREQUENCY']->value += $_smarty_tpl->tpl_vars['FREQUENCY']->step, $_smarty_tpl->tpl_vars['FREQUENCY']->iteration++) {
$_smarty_tpl->tpl_vars['FREQUENCY']->first = $_smarty_tpl->tpl_vars['FREQUENCY']->iteration === 1;$_smarty_tpl->tpl_vars['FREQUENCY']->last = $_smarty_tpl->tpl_vars['FREQUENCY']->iteration === $_smarty_tpl->tpl_vars['FREQUENCY']->total;?><option value="<?php echo $_smarty_tpl->tpl_vars['FREQUENCY']->value;?>
" <?php if ((isset($_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['repeat_frequency'])) && $_smarty_tpl->tpl_vars['FREQUENCY']->value == $_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['repeat_frequency']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['FREQUENCY']->value;?>
</option><?php }
}
?></select></span><span class="col-sm-2 padding0px"><select class="select2 input-medium" style="width:85px;margin-left: 10px;" name="recurringtype" id="recurringType"><option value="Daily" <?php if ($_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['eventrecurringtype'] == 'Daily') {?> selected <?php }?>><?php echo vtranslate('LBL_DAYS_TYPE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><option value="Weekly" <?php if ($_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['eventrecurringtype'] == 'Weekly') {?> selected <?php }?>><?php echo vtranslate('LBL_WEEKS_TYPE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><option value="Monthly" <?php if ($_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['eventrecurringtype'] == 'Monthly') {?> selected <?php }?>><?php echo vtranslate('LBL_MONTHS_TYPE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><option value="Yearly" <?php if ($_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['eventrecurringtype'] == 'Yearly') {?> selected <?php }?>><?php echo vtranslate('LBL_YEAR_TYPE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option></select><span class="alignMiddle displayInlineBlock">&nbsp;&nbsp;<?php echo vtranslate('LBL_UNTIL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span></span><span class="col-sm-6 padding0px"><span class="input-group date inputElement"><input type="text" id="calendar_repeat_limit_date" class="dateField input-small form-control" name="calendar_repeat_limit_date" data-date-format="<?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('date_format');?>
"value="<?php if ($_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['recurringcheck'] != 'Yes') {
echo $_smarty_tpl->tpl_vars['TOMORROWDATE']->value;
} elseif ($_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['recurringcheck'] == 'Yes') {
echo $_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['recurringenddate'];
}?>"data-rule-date="true" data-rule-required="true" data-specific-rules='<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['FIELD_INFO']->value["validator"]);?>
' <?php if (!empty($_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR']->value)) {?>data-validator='<?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR']->value);?>
'<?php }?>/><span class="input-group-addon"><i class="fa fa-calendar"></i></span></span></span></div><div class="row <?php if ((isset($_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['eventrecurringtype'])) && $_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['eventrecurringtype'] == 'Weekly') {?>show<?php } else { ?>hide<?php }?>"  id="repeatWeekUI" style="margin:10px 0;"><span class="col-lg-2"><span class="medium" style="padding-left:23px"><?php echo ucwords(vtranslate('LBL_ON',$_smarty_tpl->tpl_vars['MODULE']->value));?>
</span></span><span class="col-lg-10"><label class="checkbox" style="margin-left: 30px;display: inline;"><input name="sun_flag" value="sunday" <?php echo (isset($_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['week0'])) ? $_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['week0'] : '';?>
 type="checkbox"/><?php echo vtranslate('LBL_SM_SUN',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label><label class="checkbox" style="margin-left: 30px;display: inline;"><input name="mon_flag" value="monday" <?php echo (isset($_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['week1'])) ? $_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['week1'] : '';?>
 type="checkbox"><?php echo vtranslate('LBL_SM_MON',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label><label class="checkbox" style="margin-left: 30px;display: inline;"><input name="tue_flag" value="tuesday" <?php echo (isset($_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['week2'])) ? $_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['week2'] : '';?>
 type="checkbox"><?php echo vtranslate('LBL_SM_TUE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label><label class="checkbox" style="margin-left: 30px;display: inline;"><input name="wed_flag" value="wednesday" <?php echo (isset($_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['week3'])) ? $_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['week3'] : '';?>
 type="checkbox"><?php echo vtranslate('LBL_SM_WED',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label><label class="checkbox" style="margin-left: 30px;display: inline;"><input name="thu_flag" value="thursday" <?php echo (isset($_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['week4'])) ? $_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['week4'] : '';?>
 type="checkbox"><?php echo vtranslate('LBL_SM_THU',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label><label class="checkbox" style="margin-left: 30px;display: inline;"><input name="fri_flag" value="friday" <?php echo (isset($_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['week5'])) ? $_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['week5'] : '';?>
 type="checkbox"><?php echo vtranslate('LBL_SM_FRI',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label><label class="checkbox" style="margin-left: 30px;display: inline;"><input name="sat_flag" value="saturday" <?php echo (isset($_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['week5'])) ? $_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['week6'] : '';?>
 type="checkbox"><?php echo vtranslate('LBL_SM_SAT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></span></div><div class="<?php if ((isset($_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['eventrecurringtype'])) && $_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['eventrecurringtype'] == 'Monthly') {?>show<?php } else { ?>hide<?php }?>" id="repeatMonthUI" style="margin-top:10px;"RCa><div class="row"><span class="col-lg-4"><span class="pull-right"><input type="radio" id="repeatDate" data-field-id= '<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('id');?>
' name="repeatMonth" checked value="date" <?php if ((isset($_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['repeatMonth'])) && $_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['repeatMonth'] == 'date') {?> checked <?php }?>/><span class="alignMiddle" style="margin-left: 0.8em;"><?php echo vtranslate('LBL_ON',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span></span></span><span class="col-lg-8"><input type="text" id="repeatMonthDate" data-field-id= '<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('id');?>
' class="input-mini" style="width: 50px;" name="repeatMonth_date" data-validation-engine='validate[funcCall[Calendar_RepeatMonthDate_Validator_Js.invokeValidation]]' value="<?php if ((isset($_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['repeatMonth_date'])) && $_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['repeatMonth_date'] == '') {?>2<?php } else {
echo (isset($_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['repeatMonth_date'])) ? $_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['repeatMonth_date'] : '';
}?>"/><span class="alignMiddle" style="margin-left: 0.8em;"><?php echo vtranslate('LBL_DAY_OF_THE_MONTH',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span></span><div class="clearfix"></div></div><div class="row" id="repeatMonthDayUI" style="margin-top: 10px;"><span class="col-lg-4"><span class="pull-right"><input type="radio" id="repeatDay" data-field-id= '<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('id');?>
' name="repeatMonth" value="day" <?php if ((isset($_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['repeatMonth'])) && $_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['repeatMonth'] == 'day') {?> checked <?php }?>/><span class="alignMiddle" style="margin-left: 0.8em;"><?php echo vtranslate('LBL_ON',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span></span></span><span class="col-lg-2"><select id="repeatMonthDayType" class="select2" name="repeatMonth_daytype" style="width: 90px;"><option value="first" <?php if ($_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['repeatMonth_daytype'] == 'first') {?> selected <?php }?>><?php echo vtranslate('LBL_FIRST',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><option value="last" <?php if ($_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['repeatMonth_daytype'] == 'last') {?> selected <?php }?>><?php echo vtranslate('LBL_LAST',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option></select></span><span class="col-lg-6 margin0"><select id="repeatMonthDay" class="select2" name="repeatMonth_day" style="width: 120px;"><option value=0 <?php if ($_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['repeatMonth_day'] == 0) {?> selected <?php }?>><?php echo vtranslate('LBL_DAY0',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><option value=1 <?php if ($_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['repeatMonth_day'] == 1) {?> selected <?php }?>><?php echo vtranslate('LBL_DAY1',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><option value=2 <?php if ($_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['repeatMonth_day'] == 2) {?> selected <?php }?>><?php echo vtranslate('LBL_DAY2',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><option value=3 <?php if ($_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['repeatMonth_day'] == 3) {?> selected <?php }?>><?php echo vtranslate('LBL_DAY3',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><option value=4 <?php if ($_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['repeatMonth_day'] == 4) {?> selected <?php }?>><?php echo vtranslate('LBL_DAY4',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><option value=5 <?php if ($_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['repeatMonth_day'] == 5) {?> selected <?php }?>><?php echo vtranslate('LBL_DAY5',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><option value=6 <?php if ($_smarty_tpl->tpl_vars['RECURRING_INFORMATION']->value['repeatMonth_day'] == 6) {?> selected <?php }?>><?php echo vtranslate('LBL_DAY6',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option></select></span></div></div></div></div>
<?php }
}
