<?php
/* Smarty version 4.5.5, created on 2025-09-19 07:44:44
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Vtiger\uitypes\Reminder.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68cd09ecc21214_01026744',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bc00419d07297900dd586f66001b413de6c1b374' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Vtiger\\uitypes\\Reminder.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68cd09ecc21214_01026744 (Smarty_Internal_Template $_smarty_tpl) {
if ((isset($_smarty_tpl->tpl_vars['REMINDER_VALUES']->value)) && !$_smarty_tpl->tpl_vars['REMINDER_VALUES']->value) {
$_smarty_tpl->_assignInScope('REMINDER_VALUES', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getEditViewDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')));
}
if ((isset($_smarty_tpl->tpl_vars['REMINDER_VALUES']->value)) && $_smarty_tpl->tpl_vars['REMINDER_VALUES']->value == '') {
$_smarty_tpl->_assignInScope('DAYS', 0);
$_smarty_tpl->_assignInScope('HOURS', 0);
$_smarty_tpl->_assignInScope('MINUTES', 1);
} else {
$_smarty_tpl->_assignInScope('DAY', (isset($_smarty_tpl->tpl_vars['REMINDER_VALUES']->value[0])) ? $_smarty_tpl->tpl_vars['REMINDER_VALUES']->value[0] : '');
$_smarty_tpl->_assignInScope('HOUR', (isset($_smarty_tpl->tpl_vars['REMINDER_VALUES']->value[1])) ? $_smarty_tpl->tpl_vars['REMINDER_VALUES']->value[1] : '');
$_smarty_tpl->_assignInScope('MINUTE', (isset($_smarty_tpl->tpl_vars['REMINDER_VALUES']->value[2])) ? $_smarty_tpl->tpl_vars['REMINDER_VALUES']->value[2] : '');
}?><div id="js-reminder-controls"><div style="float:left;margin-top: 1%;"><input type=hidden name=set_reminder value=0 /><input type=checkbox name=set_reminder <?php if ((isset($_smarty_tpl->tpl_vars['REMINDER_VALUES']->value)) && $_smarty_tpl->tpl_vars['REMINDER_VALUES']->value != '') {?>checked<?php }?> value=1 />&nbsp;&nbsp;</div><div id="js-reminder-selections" style="float:left;visibility:<?php if ((isset($_smarty_tpl->tpl_vars['REMINDER_VALUES']->value)) && $_smarty_tpl->tpl_vars['REMINDER_VALUES']->value != '') {?>visible<?php } else { ?>collapse<?php }?>;"><div style="float:left"><div style="float:left"><select class="select2" name="remdays"><?php
$_smarty_tpl->tpl_vars['DAYS'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['DAYS']->step = 1;$_smarty_tpl->tpl_vars['DAYS']->total = (int) ceil(($_smarty_tpl->tpl_vars['DAYS']->step > 0 ? 31+1 - (0) : 0-(31)+1)/abs($_smarty_tpl->tpl_vars['DAYS']->step));
if ($_smarty_tpl->tpl_vars['DAYS']->total > 0) {
for ($_smarty_tpl->tpl_vars['DAYS']->value = 0, $_smarty_tpl->tpl_vars['DAYS']->iteration = 1;$_smarty_tpl->tpl_vars['DAYS']->iteration <= $_smarty_tpl->tpl_vars['DAYS']->total;$_smarty_tpl->tpl_vars['DAYS']->value += $_smarty_tpl->tpl_vars['DAYS']->step, $_smarty_tpl->tpl_vars['DAYS']->iteration++) {
$_smarty_tpl->tpl_vars['DAYS']->first = $_smarty_tpl->tpl_vars['DAYS']->iteration === 1;$_smarty_tpl->tpl_vars['DAYS']->last = $_smarty_tpl->tpl_vars['DAYS']->iteration === $_smarty_tpl->tpl_vars['DAYS']->total;?><option value="<?php echo $_smarty_tpl->tpl_vars['DAYS']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['DAYS']->value == $_smarty_tpl->tpl_vars['DAY']->value) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['DAYS']->value;?>
</option><?php }
}
?></select></div><div style="float:left;margin-top:5px">&nbsp;<?php echo vtranslate('LBL_DAYS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;&nbsp;</div><div class="clearfix"></div></div><div style="float:left"><div style="float:left"><select class="select2" name="remhrs"><?php
$_smarty_tpl->tpl_vars['HOURS'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['HOURS']->step = 1;$_smarty_tpl->tpl_vars['HOURS']->total = (int) ceil(($_smarty_tpl->tpl_vars['HOURS']->step > 0 ? 23+1 - (0) : 0-(23)+1)/abs($_smarty_tpl->tpl_vars['HOURS']->step));
if ($_smarty_tpl->tpl_vars['HOURS']->total > 0) {
for ($_smarty_tpl->tpl_vars['HOURS']->value = 0, $_smarty_tpl->tpl_vars['HOURS']->iteration = 1;$_smarty_tpl->tpl_vars['HOURS']->iteration <= $_smarty_tpl->tpl_vars['HOURS']->total;$_smarty_tpl->tpl_vars['HOURS']->value += $_smarty_tpl->tpl_vars['HOURS']->step, $_smarty_tpl->tpl_vars['HOURS']->iteration++) {
$_smarty_tpl->tpl_vars['HOURS']->first = $_smarty_tpl->tpl_vars['HOURS']->iteration === 1;$_smarty_tpl->tpl_vars['HOURS']->last = $_smarty_tpl->tpl_vars['HOURS']->iteration === $_smarty_tpl->tpl_vars['HOURS']->total;?><option value="<?php echo $_smarty_tpl->tpl_vars['HOURS']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['HOURS']->value == $_smarty_tpl->tpl_vars['HOUR']->value) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['HOURS']->value;?>
</option><?php }
}
?></select></div><div style="float:left;margin-top:5px">&nbsp;<?php echo vtranslate('LBL_HOURS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;&nbsp;</div><div class="clearfix"></div></div><div style="float:left"><div style="float:left"><select class="select2" name="remmin"><?php
$_smarty_tpl->tpl_vars['MINUTES'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['MINUTES']->step = 1;$_smarty_tpl->tpl_vars['MINUTES']->total = (int) ceil(($_smarty_tpl->tpl_vars['MINUTES']->step > 0 ? 59+1 - (1) : 1-(59)+1)/abs($_smarty_tpl->tpl_vars['MINUTES']->step));
if ($_smarty_tpl->tpl_vars['MINUTES']->total > 0) {
for ($_smarty_tpl->tpl_vars['MINUTES']->value = 1, $_smarty_tpl->tpl_vars['MINUTES']->iteration = 1;$_smarty_tpl->tpl_vars['MINUTES']->iteration <= $_smarty_tpl->tpl_vars['MINUTES']->total;$_smarty_tpl->tpl_vars['MINUTES']->value += $_smarty_tpl->tpl_vars['MINUTES']->step, $_smarty_tpl->tpl_vars['MINUTES']->iteration++) {
$_smarty_tpl->tpl_vars['MINUTES']->first = $_smarty_tpl->tpl_vars['MINUTES']->iteration === 1;$_smarty_tpl->tpl_vars['MINUTES']->last = $_smarty_tpl->tpl_vars['MINUTES']->iteration === $_smarty_tpl->tpl_vars['MINUTES']->total;?><option value="<?php echo $_smarty_tpl->tpl_vars['MINUTES']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['MINUTES']->value == $_smarty_tpl->tpl_vars['MINUTE']->value) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['MINUTES']->value;?>
</option><?php }
}
?></select></div><div style="float:left;margin-top:5px">&nbsp;<?php echo vtranslate('LBL_MINUTES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;&nbsp;</div><div class="clearfix"></div></div></div><div class="clearfix"></div></div><?php }
}
