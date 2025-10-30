<?php
/* Smarty version 4.5.5, created on 2025-09-19 07:45:43
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Calendar\CalendarView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68cd0a27c943b4_20676839',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '22df514cef3d2c81c712555354cd2d067d65c81b' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Calendar\\CalendarView.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68cd0a27c943b4_20676839 (Smarty_Internal_Template $_smarty_tpl) {
?><input type="hidden" id="currentView" value="<?php echo $_smarty_tpl->tpl_vars['REQ']->value->get('view');?>
" /><input type="hidden" id="start_day" value="<?php echo $_smarty_tpl->tpl_vars['CURRENT_USER']->value->get('dayoftheweek');?>
" /><input type="hidden" id="activity_view" value="<?php echo $_smarty_tpl->tpl_vars['CURRENT_USER']->value->get('activity_view');?>
" /><input type="hidden" id="time_format" value="<?php echo $_smarty_tpl->tpl_vars['CURRENT_USER']->value->get('hour_format');?>
" /><input type="hidden" id="start_hour" value="<?php echo $_smarty_tpl->tpl_vars['CURRENT_USER']->value->get('start_hour');?>
" /><input type="hidden" id="date_format" value="<?php echo $_smarty_tpl->tpl_vars['CURRENT_USER']->value->get('date_format');?>
" /><input type="hidden" id="hideCompletedEventTodo" value="<?php echo $_smarty_tpl->tpl_vars['CURRENT_USER']->value->get('hidecompletedevents');?>
"><input type="hidden" id="show_allhours" value="<?php echo $_smarty_tpl->tpl_vars['CURRENT_USER']->value->get('showallhours');?>
" /><div id="mycalendar" class="calendarview col-lg-12"><?php $_smarty_tpl->_assignInScope('LEFTPANELHIDE', $_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('leftpanelhide'));?><div class="essentials-toggle" title="<?php echo vtranslate('LBL_LEFT_PANEL_SHOW_HIDE','Vtiger');?>
"><span class="essentials-toggle-marker fa <?php if ($_smarty_tpl->tpl_vars['LEFTPANELHIDE']->value == '1') {?>fa-chevron-right<?php } else { ?>fa-chevron-left<?php }?> cursorPointer"></span></div></div>
<?php }
}
