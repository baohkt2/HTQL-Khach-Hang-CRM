<?php
/* Smarty version 4.5.5, created on 2025-09-19 07:45:42
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Calendar\CalendarHeader.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68cd0a26e87a00_11256992',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '612c6d08557ced49a23f060eeb3595c4dae0dd26' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Calendar\\CalendarHeader.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68cd0a26e87a00_11256992 (Smarty_Internal_Template $_smarty_tpl) {
?>
<input type="hidden" name="is_record_creation_allowed" id="is_record_creation_allowed" value="<?php echo $_smarty_tpl->tpl_vars['IS_CREATE_PERMITTED']->value;?>
"><div class="col-sm-12 col-xs-12 module-action-bar clearfix"><div class="module-action-content clearfix coloredBorderTop"><div class="col-lg-5 col-md-5"><span><?php $_smarty_tpl->_assignInScope('VIEW_HEADER_LABEL', "LBL_CALENDAR_VIEW");
if ($_smarty_tpl->tpl_vars['VIEW']->value === 'SharedCalendar') {
$_smarty_tpl->_assignInScope('VIEW_HEADER_LABEL', "LBL_SHARED_CALENDAR");
}?><a href='javascript:void(0)'><h4 class="module-title pull-left"><span style="cursor: default;"> <?php echo strtoupper(vtranslate($_smarty_tpl->tpl_vars['VIEW_HEADER_LABEL']->value,$_smarty_tpl->tpl_vars['MODULE']->value));?>
 </span></h4></a></span></div><div class="col-lg-7 col-md-7 pull-right"><div id="appnav" class="navbar-right"><ul class="nav navbar-nav"><?php if ($_smarty_tpl->tpl_vars['IS_CREATE_PERMITTED']->value) {?><li><button id="calendarview_basicaction_addevent" type="button" class="btn addButton btn-default module-buttons cursorPointer" onclick='Calendar_Calendar_Js.showCreateEventModal();'><div class="fa fa-plus" aria-hidden="true"></div>&nbsp;&nbsp;<?php echo vtranslate('LBL_ADD_EVENT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button><button id="calendarview_basicaction_addtask" type="button" class="btn addButton btn-default module-buttons cursorPointer" onclick='Calendar_Calendar_Js.showCreateTaskModal();'><div class="fa fa-plus" aria-hidden="true"></div>&nbsp;&nbsp;<?php echo vtranslate('LBL_ADD_TASK',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button></li><?php }?><li><div class="settingsIcon"><button type="button" class="btn btn-default module-buttons dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="fa fa-wrench" aria-hidden="true" title="<?php echo vtranslate('LBL_SETTINGS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"></span>&nbsp;&nbsp;<?php echo vtranslate('LBL_CUSTOMIZE','Reports');?>
&nbsp; <span class="caret"></span></button><ul class="detailViewSetting dropdown-menu"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MODULE_SETTING_ACTIONS']->value, 'SETTING');
$_smarty_tpl->tpl_vars['SETTING']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['SETTING']->value) {
$_smarty_tpl->tpl_vars['SETTING']->do_else = false;
if ($_smarty_tpl->tpl_vars['SETTING']->value->getLabel() == 'LBL_EDIT_FIELDS') {?><li id="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
_listview_advancedAction_<?php echo $_smarty_tpl->tpl_vars['SETTING']->value->getLabel();?>
_Events"><a href="<?php echo $_smarty_tpl->tpl_vars['SETTING']->value->getUrl();?>
&sourceModule=Events"><?php echo vtranslate($_smarty_tpl->tpl_vars['SETTING']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value,vtranslate('LBL_EVENTS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value));?>
</a></li><li id="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
_listview_advancedAction_<?php echo $_smarty_tpl->tpl_vars['SETTING']->value->getLabel();?>
_Calendar"><a href="<?php echo $_smarty_tpl->tpl_vars['SETTING']->value->getUrl();?>
&sourceModule=Calendar"><?php echo vtranslate($_smarty_tpl->tpl_vars['SETTING']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value,vtranslate('LBL_TASKS','Calendar'));?>
</a></li><?php } elseif ($_smarty_tpl->tpl_vars['SETTING']->value->getLabel() == 'LBL_EDIT_WORKFLOWS') {?><li id="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
_listview_advancedAction_<?php echo $_smarty_tpl->tpl_vars['SETTING']->value->getLabel();?>
_WORKFLOWS"><a href="<?php echo $_smarty_tpl->tpl_vars['SETTING']->value->getUrl();?>
&sourceModule=Events"><?php echo vtranslate('LBL_EVENTS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 <?php echo vtranslate('LBL_WORKFLOWS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</a></li><li id="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
_listview_advancedAction_<?php echo $_smarty_tpl->tpl_vars['SETTING']->value->getLabel();?>
_WORKFLOWS"><a href="<?php echo $_smarty_tpl->tpl_vars['SETTING']->value->getUrl();?>
&sourceModule=Calendar"><?php echo vtranslate('LBL_TASKS','Calendar');?>
 <?php echo vtranslate('LBL_WORKFLOWS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</a></li><?php } else { ?><li id="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
_listview_advancedAction_<?php echo $_smarty_tpl->tpl_vars['SETTING']->value->getLabel();?>
"><a href=<?php echo $_smarty_tpl->tpl_vars['SETTING']->value->getUrl();?>
><?php echo vtranslate($_smarty_tpl->tpl_vars['SETTING']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value,vtranslate($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value));?>
</a></li><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?><li><a><span id="calendarview_basicaction_calendarsetting" onclick='Calendar_Calendar_Js.showCalendarSettings();' class="cursorPointer"><?php echo vtranslate('LBL_CALENDAR_SETTINGS','Calendar');?>
</span></a></li></ul></div></li></ul></div></div></div><?php if ($_smarty_tpl->tpl_vars['FIELDS_INFO']->value != null) {
echo '<script'; ?>
 type="text/javascript">var uimeta = (function () {var fieldInfo = <?php echo $_smarty_tpl->tpl_vars['FIELDS_INFO']->value;?>
;return {field: {get: function (name, property) {if (name && property === undefined) {return fieldInfo[name];}if (name && property) {return fieldInfo[name][property]}},isMandatory: function (name) {if (fieldInfo[name]) {return fieldInfo[name].mandatory;}return false;},getType: function (name) {if (fieldInfo[name]) {return fieldInfo[name].type}return false;}},};})();<?php echo '</script'; ?>
><?php }?></div><?php }
}
