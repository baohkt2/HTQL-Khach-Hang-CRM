<?php
/* Smarty version 4.5.5, created on 2025-10-19 17:04:38
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Calendar\CalendarSharedUsers.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68f51a2616f1d1_36064673',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1ae2ae7521647a1a8717fe2b24d107b7ab0aa332' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Calendar\\CalendarSharedUsers.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68f51a2616f1d1_36064673 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('SHARED_USER_INFO', Zend_Json::encode($_smarty_tpl->tpl_vars['SHAREDUSERS_INFO']->value));
$_smarty_tpl->_assignInScope('CURRENT_USER_ID', $_smarty_tpl->tpl_vars['CURRENTUSER_MODEL']->value->getId());?><input type="hidden" id="sharedUsersInfo" value= <?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['SHAREDUSERS_INFO']->value);?>
 /><div class="sidebar-widget-contents" name='calendarViewTypes'><div id="calendarview-feeds"><ul class="list-group feedslist"><li class="activitytype-indicator calendar-feed-indicator mass-edit-option" style="background-color:#2c3b49; color:#FFFFFF;"><span><?php echo vtranslate('LBL_MASS_SELECT');?>
</span><span class="activitytype-actions pull-right"><input class="mass-select" type="checkbox"></span></li><li class="activitytype-indicator calendar-feed-indicator" style="background-color: <?php echo $_smarty_tpl->tpl_vars['SHAREDUSERS_INFO']->value[$_smarty_tpl->tpl_vars['CURRENT_USER_ID']->value]['color'];?>
;"><span><?php echo vtranslate('LBL_MINE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span><span class="activitytype-actions pull-right"><input class="toggleCalendarFeed cursorPointer" type="checkbox" data-calendar-sourcekey="Events_<?php echo $_smarty_tpl->tpl_vars['CURRENT_USER_ID']->value;?>
" data-calendar-feed="Events"data-calendar-feed-color="<?php echo $_smarty_tpl->tpl_vars['SHAREDUSERS_INFO']->value[$_smarty_tpl->tpl_vars['CURRENT_USER_ID']->value]['color'];?>
" data-calendar-fieldlabel="<?php echo vtranslate('LBL_MINE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"data-calendar-userid="<?php echo $_smarty_tpl->tpl_vars['CURRENT_USER_ID']->value;?>
" data-calendar-group="false" data-calendar-feed-textcolor="white">&nbsp;&nbsp;<i class="fa fa-pencil editCalendarFeedColor cursorPointer"></i>&nbsp;&nbsp;</span></li><?php $_smarty_tpl->_assignInScope('INVISIBLE_CALENDAR_VIEWS_EXISTS', 'false');
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['SHAREDUSERS']->value, 'USER', false, 'ID');
$_smarty_tpl->tpl_vars['USER']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ID']->value => $_smarty_tpl->tpl_vars['USER']->value) {
$_smarty_tpl->tpl_vars['USER']->do_else = false;
if ($_smarty_tpl->tpl_vars['SHAREDUSERS_INFO']->value[$_smarty_tpl->tpl_vars['ID']->value]['visible'] != '0') {?><li class="activitytype-indicator calendar-feed-indicator" style="background-color: <?php echo $_smarty_tpl->tpl_vars['SHAREDUSERS_INFO']->value[$_smarty_tpl->tpl_vars['ID']->value]['color'];?>
;"><span class="userName textOverflowEllipsis" title="<?php echo $_smarty_tpl->tpl_vars['USER']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['USER']->value;?>
</span><span class="activitytype-actions pull-right"><input class="toggleCalendarFeed cursorPointer" type="checkbox" data-calendar-sourcekey="Events_<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" data-calendar-feed="Events"data-calendar-feed-color="<?php echo $_smarty_tpl->tpl_vars['SHAREDUSERS_INFO']->value[$_smarty_tpl->tpl_vars['ID']->value]['color'];?>
" data-calendar-fieldlabel="<?php echo $_smarty_tpl->tpl_vars['USER']->value;?>
"data-calendar-userid="<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" data-calendar-group="false" data-calendar-feed-textcolor="white">&nbsp;&nbsp;<i class="fa fa-pencil editCalendarFeedColor cursorPointer"></i>&nbsp;&nbsp;<i class="fa fa-trash deleteCalendarFeed cursorPointer"></i></span></li><?php } else {
$_smarty_tpl->_assignInScope('INVISIBLE_CALENDAR_VIEWS_EXISTS', 'true');
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['SHAREDGROUPS']->value, 'GROUP', false, 'ID');
$_smarty_tpl->tpl_vars['GROUP']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ID']->value => $_smarty_tpl->tpl_vars['GROUP']->value) {
$_smarty_tpl->tpl_vars['GROUP']->do_else = false;
if ($_smarty_tpl->tpl_vars['SHAREDUSERS_INFO']->value[$_smarty_tpl->tpl_vars['ID']->value]['visible'] != '0') {?><li class="activitytype-indicator calendar-feed-indicator" style="background-color: <?php echo $_smarty_tpl->tpl_vars['SHAREDUSERS_INFO']->value[$_smarty_tpl->tpl_vars['ID']->value]['color'];?>
;"><span class="userName textOverflowEllipsis" title="<?php echo $_smarty_tpl->tpl_vars['GROUP']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['GROUP']->value;?>
</span><span class="activitytype-actions pull-right"><input class="toggleCalendarFeed cursorPointer" type="checkbox" data-calendar-sourcekey="Events_<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" data-calendar-feed="Events"data-calendar-feed-color="<?php echo $_smarty_tpl->tpl_vars['SHAREDUSERS_INFO']->value[$_smarty_tpl->tpl_vars['ID']->value]['color'];?>
" data-calendar-fieldlabel="<?php echo $_smarty_tpl->tpl_vars['GROUP']->value;?>
"data-calendar-userid="<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" data-calendar-group="true" data-calendar-feed-textcolor="white">&nbsp;&nbsp;<i class="fa fa-pencil editCalendarFeedColor cursorPointer"></i>&nbsp;&nbsp;<i class="fa fa-trash deleteCalendarFeed cursorPointer"></i></span></li><?php } else {
$_smarty_tpl->_assignInScope('INVISIBLE_CALENDAR_VIEWS_EXISTS', 'true');
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></ul><ul class="hide dummy"><li class="activitytype-indicator calendar-feed-indicator feed-indicator-template"><span></span><span class="activitytype-actions pull-right"><input class="toggleCalendarFeed cursorPointer" type="checkbox" data-calendar-sourcekey="" data-calendar-feed="Events" data-calendar-feed-color="" data-calendar-fieldlabel="" data-calendar-userid="" data-calendar-group="" data-calendar-feed-textcolor="white">&nbsp;&nbsp;<i class="fa fa-pencil editCalendarFeedColor cursorPointer"></i>&nbsp;&nbsp;<i class="fa fa-trash deleteCalendarFeed cursorPointer"></i></span></li></ul><input type="hidden" class="invisibleCalendarViews" value="<?php echo $_smarty_tpl->tpl_vars['INVISIBLE_CALENDAR_VIEWS_EXISTS']->value;?>
" /></div></div>
<?php }
}
