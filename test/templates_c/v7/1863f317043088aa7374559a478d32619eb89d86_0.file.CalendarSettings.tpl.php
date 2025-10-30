<?php
/* Smarty version 4.5.5, created on 2025-10-19 17:20:49
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Calendar\CalendarSettings.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68f51df1749646_53953722',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1863f317043088aa7374559a478d32619eb89d86' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Calendar\\CalendarSettings.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68f51df1749646_53953722 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="modal-dialog modal-lg calendarSettingsContainer"><div class="modal-content"><?php ob_start();
echo vtranslate('LBL_CALENDAR_SETTINGS',$_smarty_tpl->tpl_vars['MODULE']->value);
$_prefixVariable1 = ob_get_clean();
$_smarty_tpl->_assignInScope('HEADER_TITLE', $_prefixVariable1);
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0, true);
$_smarty_tpl->_assignInScope('TRANSLATION_MODULE', "Users");?><div class="modal-body"><form class="form-horizontal" id="CalendarSettings" name="CalendarSettings" method="post" action="index.php"><input type="hidden" name="module" value="Users" /><input type="hidden" name="action" value="SaveCalendarSettings" /><input type="hidden" name="record" value="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value;?>
" /><input type=hidden name="timeFormatOptions" data-value='<?php echo $_smarty_tpl->tpl_vars['DAY_STARTS']->value;?>
' /><input type=hidden name="sourceView" /><div><div style="margin-left: 20px;"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value['LBL_CALENDAR_SETTINGS'], 'FIELD_MODEL');
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->value) {
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = false;
$_smarty_tpl->_assignInScope('FIELD_NAME', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name'));
$_smarty_tpl->_assignInScope('FIELD_VALUE', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'));
if ($_smarty_tpl->tpl_vars['FIELD_NAME']->value == 'callduration') {
$_smarty_tpl->_assignInScope('CALL_DURATION_MODEL', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value);
} elseif ($_smarty_tpl->tpl_vars['FIELD_NAME']->value == 'othereventduration') {
$_smarty_tpl->_assignInScope('EVENT_DURATION_MODEL', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value);
} elseif ($_smarty_tpl->tpl_vars['FIELD_NAME']->value == 'hour_format') {
$_smarty_tpl->_assignInScope('HOUR_FORMAT_VALUE', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'));
} elseif ($_smarty_tpl->tpl_vars['FIELD_NAME']->value == 'defaulteventstatus') {
$_smarty_tpl->_assignInScope('DEFAULT_EVENT_STATUS_MODEL', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value);
} elseif ($_smarty_tpl->tpl_vars['FIELD_NAME']->value == 'defaultactivitytype') {
$_smarty_tpl->_assignInScope('DEFAULT_ACTIVITY_TYPE_MODEL', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value);
} elseif ($_smarty_tpl->tpl_vars['FIELD_NAME']->value == 'hidecompletedevents') {
$_smarty_tpl->_assignInScope('HIDE_COMPLETED_EVENTS_MODEL', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value);
}
if ($_smarty_tpl->tpl_vars['FIELD_NAME']->value != 'callduration' && $_smarty_tpl->tpl_vars['FIELD_NAME']->value != 'othereventduration' && $_smarty_tpl->tpl_vars['FIELD_NAME']->value != 'defaulteventstatus' && $_smarty_tpl->tpl_vars['FIELD_NAME']->value != 'defaultactivitytype' && $_smarty_tpl->tpl_vars['FIELD_NAME']->value != 'hidecompletedevents') {?><div class="form-group"><label class="fieldLabel col-lg-4 col-sm-4 col-xs-4"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['TRANSLATION_MODULE']->value);?>
</label><div class="fieldValue col-lg-8 col-sm-8 col-xs-8"><?php if ($_smarty_tpl->tpl_vars['FIELD_NAME']->value == 'hour_format' || $_smarty_tpl->tpl_vars['FIELD_NAME']->value == 'activity_view') {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getPicklistValues(), 'LABEL', false, 'ID');
$_smarty_tpl->tpl_vars['LABEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ID']->value => $_smarty_tpl->tpl_vars['LABEL']->value) {
$_smarty_tpl->tpl_vars['LABEL']->do_else = false;
if ($_smarty_tpl->tpl_vars['LABEL']->value != 'This Year') {?><input type="radio" value="<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['FIELD_VALUE']->value == $_smarty_tpl->tpl_vars['ID']->value) {?>checked=""<?php }?> name="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
" class="alignTop" />&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['LABEL']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<?php if ($_smarty_tpl->tpl_vars['FIELD_NAME']->value == 'hour_format') {
echo vtranslate('LBL_HOUR',$_smarty_tpl->tpl_vars['MODULE']->value);
}?>&nbsp;&nbsp;&nbsp;<?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
} elseif ($_smarty_tpl->tpl_vars['FIELD_NAME']->value == 'start_hour') {
$_smarty_tpl->_assignInScope('DECODED_DAYS_STARTS', ZEND_JSON::decode($_smarty_tpl->tpl_vars['DAY_STARTS']->value));
$_smarty_tpl->_assignInScope('PICKLIST_VALUES', $_smarty_tpl->tpl_vars['DECODED_DAYS_STARTS']->value['hour_format'][$_smarty_tpl->tpl_vars['HOUR_FORMAT_VALUE']->value][$_smarty_tpl->tpl_vars['FIELD_NAME']->value]);?><select class="select2" style="min-width: 150px;" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value, 'LABEL', false, 'ID');
$_smarty_tpl->tpl_vars['LABEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ID']->value => $_smarty_tpl->tpl_vars['LABEL']->value) {
$_smarty_tpl->tpl_vars['LABEL']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['FIELD_VALUE']->value == $_smarty_tpl->tpl_vars['ID']->value) {?> selected="" <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['LABEL']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select><?php } else { ?><select class="select2" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['FIELD_NAME']->value == 'time_zone') {?> style="min-width: 350px" <?php } else { ?> style="min-width: 150px" <?php }?>><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isEmptyPicklistOptionAllowed()) {?><option value=""><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><?php }
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getPicklistValues(), 'LABEL', false, 'ID');
$_smarty_tpl->tpl_vars['LABEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ID']->value => $_smarty_tpl->tpl_vars['LABEL']->value) {
$_smarty_tpl->tpl_vars['LABEL']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['FIELD_VALUE']->value == $_smarty_tpl->tpl_vars['ID']->value) {?> selected="" <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['LABEL']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select><?php }?></div></div><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
$_smarty_tpl->_assignInScope('EVENTS_MODULE_MODEL', Vtiger_Module_Model::getInstance('Events'));
$_smarty_tpl->_assignInScope('EVENT_STATUS_MODEL', $_smarty_tpl->tpl_vars['EVENTS_MODULE_MODEL']->value->getField('eventstatus'));
$_smarty_tpl->_assignInScope('ACTIVITY_TYPE_MODEL', $_smarty_tpl->tpl_vars['EVENTS_MODULE_MODEL']->value->getField('activitytype'));?><div class="form-group"><label class="fieldLabel col-lg-4 col-sm-4 col-xs-4"><?php echo vtranslate('LBL_DEFAULT_STATUS_TYPE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label><div class="fieldValue col-lg-8 col-sm-8 col-xs-8"><span class="alignMiddle"><?php echo vtranslate('LBL_STATUS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span>&nbsp;&nbsp;<select class="select2" style="min-width: 133px" name="<?php echo $_smarty_tpl->tpl_vars['DEFAULT_EVENT_STATUS_MODEL']->value->get('name');?>
"><option value="<?php echo vtranslate('LBL_SELECT_OPTION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><?php echo vtranslate('LBL_SELECT_OPTION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['EVENT_STATUS_MODEL']->value->getPicklistValues(), 'LABEL', false, 'ID');
$_smarty_tpl->tpl_vars['LABEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ID']->value => $_smarty_tpl->tpl_vars['LABEL']->value) {
$_smarty_tpl->tpl_vars['LABEL']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['DEFAULT_EVENT_STATUS_MODEL']->value->get('fieldvalue') == $_smarty_tpl->tpl_vars['ID']->value) {?> selected="" <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['LABEL']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select>&nbsp;&nbsp;&nbsp;<span class="alignMiddle"><?php echo vtranslate('LBL_TYPE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span>&nbsp;&nbsp;<select class="select2" style="min-width: 133px" name="<?php echo $_smarty_tpl->tpl_vars['DEFAULT_ACTIVITY_TYPE_MODEL']->value->get('name');?>
"><option value="<?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
"><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ACTIVITY_TYPE_MODEL']->value->getPicklistValues(), 'LABEL', false, 'ID');
$_smarty_tpl->tpl_vars['LABEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ID']->value => $_smarty_tpl->tpl_vars['LABEL']->value) {
$_smarty_tpl->tpl_vars['LABEL']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['DEFAULT_ACTIVITY_TYPE_MODEL']->value->get('fieldvalue') == $_smarty_tpl->tpl_vars['ID']->value) {?> selected="" <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['LABEL']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></div></div><div class="form-group"><label class="fieldLabel col-lg-4 col-sm-4 col-xs-4"><?php echo vtranslate('LBL_DEFAULT_EVENT_DURATION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label><div class="fieldValue col-lg-8 col-sm-8 col-xs-8"><span class="alignMiddle"><?php echo vtranslate('LBL_CALL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select class="select2" name="<?php echo $_smarty_tpl->tpl_vars['CALL_DURATION_MODEL']->value->get('name');?>
"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['CALL_DURATION_MODEL']->value->getPicklistValues(), 'LABEL', false, 'ID');
$_smarty_tpl->tpl_vars['LABEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ID']->value => $_smarty_tpl->tpl_vars['LABEL']->value) {
$_smarty_tpl->tpl_vars['LABEL']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['CALL_DURATION_MODEL']->value->get('fieldvalue') == $_smarty_tpl->tpl_vars['ID']->value) {?> selected="" <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['LABEL']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<?php echo vtranslate('LBL_MINUTES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select>&nbsp;&nbsp;&nbsp;<span class="alignMiddle"><?php echo vtranslate('LBL_OTHER_EVENTS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span>&nbsp;&nbsp;<select class="select2" name="<?php echo $_smarty_tpl->tpl_vars['EVENT_DURATION_MODEL']->value->get('name');?>
"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['EVENT_DURATION_MODEL']->value->getPicklistValues(), 'LABEL', false, 'ID');
$_smarty_tpl->tpl_vars['LABEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ID']->value => $_smarty_tpl->tpl_vars['LABEL']->value) {
$_smarty_tpl->tpl_vars['LABEL']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['EVENT_DURATION_MODEL']->value->get('fieldvalue') == $_smarty_tpl->tpl_vars['ID']->value) {?> selected="" <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['LABEL']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<?php echo vtranslate('LBL_MINUTES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></div></div><div class="form-group"><label class="fieldLabel col-lg-4 col-sm-4 col-xs-4"><?php echo vtranslate($_smarty_tpl->tpl_vars['HIDE_COMPLETED_EVENTS_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label><div class="fieldValue col-lg-8 col-sm-8 col-xs-8"><?php $_smarty_tpl->_subTemplateRender(vtemplate_path($_smarty_tpl->tpl_vars['HIDE_COMPLETED_EVENTS_MODEL']->value->getUITypeModel()->getTemplateName(),$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('FIELD_MODEL'=>$_smarty_tpl->tpl_vars['HIDE_COMPLETED_EVENTS_MODEL']->value,'FIELD_NAME'=>'hidecompletedevents'), 0, true);
?></div></div><?php $_smarty_tpl->_assignInScope('SHARED_TYPE', $_smarty_tpl->tpl_vars['SHAREDTYPE']->value);?><div class="form-group"><label class="fieldLabel col-lg-4"><?php echo vtranslate('LBL_CALENDAR_SHARING',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label><div class="fieldValue col-lg-8 col-sm-8 col-xs-8" style="margin-top: -8px; padding-left: 35px;"><label class="radio inline"><input type="radio" value="private"<?php if ($_smarty_tpl->tpl_vars['SHARED_TYPE']->value == 'private') {?> checked="" <?php }?> name="sharedtype" />&nbsp;<?php echo vtranslate('Private',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;</label><label class="radio inline"><input type="radio" value="public" <?php if ($_smarty_tpl->tpl_vars['SHARED_TYPE']->value == 'public') {?> checked="" <?php }?> name="sharedtype" />&nbsp;<?php echo vtranslate('Public',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;</label><label class="radio inline"><input type="radio" value="selectedusers" <?php if ($_smarty_tpl->tpl_vars['SHARED_TYPE']->value == 'selectedusers') {?> checked="" <?php }?> data-sharingtype="selectedusers" name="sharedtype" id="selectedUsersSharingType" />&nbsp;<?php echo vtranslate('Selected Users',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label><br><br><select class="select2 row <?php if ($_smarty_tpl->tpl_vars['SHARED_TYPE']->value != 'selectedusers') {?> hide <?php }?>" id="selectedUsers" name="sharedIds[]" multiple="" data-placeholder="<?php echo vtranslate('LBL_SELECT_USERS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ALL_USERS']->value, 'USER_MODEL', false, 'ID');
$_smarty_tpl->tpl_vars['USER_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ID']->value => $_smarty_tpl->tpl_vars['USER_MODEL']->value) {
$_smarty_tpl->tpl_vars['USER_MODEL']->do_else = false;
if ($_smarty_tpl->tpl_vars['ID']->value != $_smarty_tpl->tpl_vars['CURRENTUSER_MODEL']->value->get('id')) {?><option value="<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" <?php if (array_key_exists($_smarty_tpl->tpl_vars['ID']->value,$_smarty_tpl->tpl_vars['SHAREDUSERS']->value)) {?> selected="" <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['USER_MODEL']->value->getName(),$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></div></div><br></div></div></form></div><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalFooter.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></div></div><?php }
}
