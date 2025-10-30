<?php
/* Smarty version 4.5.5, created on 2025-10-08 07:33:07
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Vtiger\RecentActivities.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e613b36a3740_77679076',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b6d632fb65389726ab065c82f21af9d88e59d618' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Vtiger\\RecentActivities.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e613b36a3740_77679076 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="recentActivitiesContainer" id="updates"><input type="hidden" id="updatesCurrentPage" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->get('page');?>
"/><div class='history'><?php if (!empty($_smarty_tpl->tpl_vars['RECENT_ACTIVITIES']->value)) {?><ul class="updates_timeline"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RECENT_ACTIVITIES']->value, 'RECENT_ACTIVITY');
$_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value) {
$_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->do_else = false;
$_smarty_tpl->_assignInScope('PROCEED', TRUE);
if (($_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value->isRelationLink()) || ($_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value->isRelationUnLink())) {
$_smarty_tpl->_assignInScope('RELATION', $_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value->getRelationInstance());
if (!($_smarty_tpl->tpl_vars['RELATION']->value->getLinkedRecord())) {
$_smarty_tpl->_assignInScope('PROCEED', FALSE);
}
}
if ($_smarty_tpl->tpl_vars['PROCEED']->value) {
if ($_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value->isCreate()) {?><li><time class="update_time cursorDefault"><small title="<?php echo Vtiger_Util_Helper::formatDateTimeIntoDayString($_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value->getParent()->get('createdtime'));?>
"><?php echo Vtiger_Util_Helper::formatDateDiffInStrings($_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value->getParent()->get('createdtime'));?>
</small></time><?php $_smarty_tpl->_assignInScope('USER_MODEL', $_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value->getModifiedBy());
$_smarty_tpl->_assignInScope('IMAGE_DETAILS', $_smarty_tpl->tpl_vars['USER_MODEL']->value->getImageDetails());
if ($_smarty_tpl->tpl_vars['IMAGE_DETAILS']->value != '' && $_smarty_tpl->tpl_vars['IMAGE_DETAILS']->value[0] != '' && $_smarty_tpl->tpl_vars['IMAGE_DETAILS']->value[0]['url'] == '') {?><div class="update_icon bg-info"><i class='update_image vicon-vtigeruser'></i></div><?php } else {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['IMAGE_DETAILS']->value, 'IMAGE_INFO');
$_smarty_tpl->tpl_vars['IMAGE_INFO']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['IMAGE_INFO']->value) {
$_smarty_tpl->tpl_vars['IMAGE_INFO']->do_else = false;
if (!empty($_smarty_tpl->tpl_vars['IMAGE_INFO']->value['url'])) {?><div class="update_icon"><img class="update_image" src="<?php echo $_smarty_tpl->tpl_vars['IMAGE_INFO']->value['url'];?>
" ></div><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?><div class="update_info"><h5><span class="field-name"><?php echo $_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value->getModifiedBy()->getName();?>
</span> <?php echo vtranslate('LBL_CREATED',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</h5></div></li><?php } elseif ($_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value->isUpdate()) {?><li><time class="update_time cursorDefault"><small title="<?php echo Vtiger_Util_Helper::formatDateTimeIntoDayString($_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value->getActivityTime());?>
"><?php echo Vtiger_Util_Helper::formatDateDiffInStrings($_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value->getActivityTime());?>
</small></time><?php $_smarty_tpl->_assignInScope('USER_MODEL', $_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value->getModifiedBy());
$_smarty_tpl->_assignInScope('IMAGE_DETAILS', $_smarty_tpl->tpl_vars['USER_MODEL']->value->getImageDetails());
if ($_smarty_tpl->tpl_vars['IMAGE_DETAILS']->value != '' && $_smarty_tpl->tpl_vars['IMAGE_DETAILS']->value[0] != '' && $_smarty_tpl->tpl_vars['IMAGE_DETAILS']->value[0]['url'] == '') {?><div class="update_icon bg-info"><i class='update_image vicon-vtigeruser'></i></div><?php } else {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['IMAGE_DETAILS']->value, 'IMAGE_INFO');
$_smarty_tpl->tpl_vars['IMAGE_INFO']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['IMAGE_INFO']->value) {
$_smarty_tpl->tpl_vars['IMAGE_INFO']->do_else = false;
if (!empty($_smarty_tpl->tpl_vars['IMAGE_INFO']->value['url'])) {?><div class="update_icon"><img class="update_image" src="<?php echo $_smarty_tpl->tpl_vars['IMAGE_INFO']->value['url'];?>
" ></div><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?><div class="update_info"><div><h5><span class="field-name"><?php echo $_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value->getModifiedBy()->getDisplayName();?>
 </span> <?php echo vtranslate('LBL_UPDATED',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</h5></div><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value->getFieldInstances(), 'FIELDMODEL');
$_smarty_tpl->tpl_vars['FIELDMODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELDMODEL']->value) {
$_smarty_tpl->tpl_vars['FIELDMODEL']->do_else = false;
$_smarty_tpl->_assignInScope('FIELD_NAME', $_smarty_tpl->tpl_vars['FIELDMODEL']->value->getFieldInstance()->getName());
$_smarty_tpl->_assignInScope('FIELD_DATA_TYPE', $_smarty_tpl->tpl_vars['FIELDMODEL']->value->getFieldInstance()->getFieldDataType());
$_smarty_tpl->_assignInScope('PRE_DISPLAY_VALUE', $_smarty_tpl->tpl_vars['FIELDMODEL']->value->getDisplayValue(decode_html($_smarty_tpl->tpl_vars['FIELDMODEL']->value->get('prevalue'))));
$_smarty_tpl->_assignInScope('POST_DISPLAY_VALUE', $_smarty_tpl->tpl_vars['FIELDMODEL']->value->getDisplayValue(decode_html($_smarty_tpl->tpl_vars['FIELDMODEL']->value->get('postvalue'))));
$_smarty_tpl->_assignInScope('TIME_PRE_DISPLAY_VALUE', $_smarty_tpl->tpl_vars['FIELDMODEL']->value->getDisplayValue(decode_html($_smarty_tpl->tpl_vars['FIELDMODEL']->value->get('prevalue'))));
$_smarty_tpl->_assignInScope('TIME_POST_DISPLAY_VALUE', $_smarty_tpl->tpl_vars['FIELDMODEL']->value->getDisplayValue(decode_html($_smarty_tpl->tpl_vars['FIELDMODEL']->value->get('postvalue'))));
if (in_array($_smarty_tpl->tpl_vars['FIELD_NAME']->value,array('time_start','time_end')) && in_array($_smarty_tpl->tpl_vars['MODULE_NAME']->value,array('Events','Calendar'))) {
$_smarty_tpl->_assignInScope('CALENDAR_RECORD_MODEL', Vtiger_Record_Model::getInstanceById($_smarty_tpl->tpl_vars['RECORD_ID']->value));
ob_start();
echo Calendar_Time_UIType::getModTrackerDisplayValue($_smarty_tpl->tpl_vars['FIELD_NAME']->value,$_smarty_tpl->tpl_vars['FIELDMODEL']->value->get('prevalue'),$_smarty_tpl->tpl_vars['CALENDAR_RECORD_MODEL']->value);
$_prefixVariable1 = ob_get_clean();
$_smarty_tpl->_assignInScope('TIME_PRE_DISPLAY_VALUE', $_prefixVariable1);
ob_start();
echo Calendar_Time_UIType::getModTrackerDisplayValue($_smarty_tpl->tpl_vars['FIELD_NAME']->value,$_smarty_tpl->tpl_vars['FIELDMODEL']->value->get('postvalue'),$_smarty_tpl->tpl_vars['CALENDAR_RECORD_MODEL']->value);
$_prefixVariable2 = ob_get_clean();
$_smarty_tpl->_assignInScope('TIME_POST_DISPLAY_VALUE', $_prefixVariable2);
$_smarty_tpl->_assignInScope('PRE_DISPLAY_VALUE', $_smarty_tpl->tpl_vars['TIME_PRE_DISPLAY_VALUE']->value);
$_smarty_tpl->_assignInScope('POST_DISPLAY_VALUE', $_smarty_tpl->tpl_vars['TIME_POST_DISPLAY_VALUE']->value);
}
if ((isset($_smarty_tpl->tpl_vars['TIME_PRE_DISPLAY_VALUE']->value))) {
$_smarty_tpl->_assignInScope('PRE_DISPLAY_TITLE', $_smarty_tpl->tpl_vars['TIME_PRE_DISPLAY_VALUE']->value);
} else {
$_smarty_tpl->_assignInScope('PRE_DISPLAY_TITLE', '');
}
if ($_smarty_tpl->tpl_vars['FIELDMODEL']->value && $_smarty_tpl->tpl_vars['FIELDMODEL']->value->getFieldInstance() && $_smarty_tpl->tpl_vars['FIELDMODEL']->value->getFieldInstance()->isViewable() && $_smarty_tpl->tpl_vars['FIELDMODEL']->value->getFieldInstance()->getDisplayType() != '5') {?><div class='font-x-small updateInfoContainer textOverflowEllipsis'><div class='update-name'><span class="field-name"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELDMODEL']->value->getName(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</span><?php if ($_smarty_tpl->tpl_vars['FIELDMODEL']->value->get('prevalue') != '' && $_smarty_tpl->tpl_vars['FIELDMODEL']->value->get('postvalue') != '' && !($_smarty_tpl->tpl_vars['FIELDMODEL']->value->getFieldInstance()->getFieldDataType() == 'reference' && ($_smarty_tpl->tpl_vars['FIELDMODEL']->value->get('postvalue') == '0' || $_smarty_tpl->tpl_vars['FIELDMODEL']->value->get('prevalue') == '0'))) {?><span> &nbsp;<?php echo vtranslate('LBL_CHANGED');?>
</span></div><div class='update-from'><span class="field-name"><?php echo vtranslate('LBL_FROM');?>
</span>&nbsp;<em style="white-space:pre-line;" title="<?php ob_start();
echo Vtiger_Util_Helper::toVtiger6SafeHTML($_smarty_tpl->tpl_vars['PRE_DISPLAY_TITLE']->value);
$_prefixVariable3 = ob_get_clean();
echo strip_tags($_prefixVariable3);?>
"><?php echo Vtiger_Util_Helper::toVtiger6SafeHTML($_smarty_tpl->tpl_vars['PRE_DISPLAY_VALUE']->value);?>
</em></div><?php } elseif ($_smarty_tpl->tpl_vars['FIELDMODEL']->value->get('postvalue') == '' || ($_smarty_tpl->tpl_vars['FIELDMODEL']->value->getFieldInstance()->getFieldDataType() == 'reference' && $_smarty_tpl->tpl_vars['FIELDMODEL']->value->get('postvalue') == '0')) {?>&nbsp;(<del><?php echo Vtiger_Util_Helper::toVtiger6SafeHTML($_smarty_tpl->tpl_vars['PRE_DISPLAY_VALUE']->value);?>
)</del> ) <?php echo vtranslate('LBL_IS_REMOVED');?>
</div><?php } elseif ($_smarty_tpl->tpl_vars['FIELDMODEL']->value->get('postvalue') != '' && !($_smarty_tpl->tpl_vars['FIELDMODEL']->value->getFieldInstance()->getFieldDataType() == 'reference' && $_smarty_tpl->tpl_vars['FIELDMODEL']->value->get('postvalue') == '0')) {?>&nbsp;<?php echo vtranslate('LBL_UPDATED');?>
</div><?php } else { ?>&nbsp;<?php echo vtranslate('LBL_CHANGED');?>
</div><?php }
if ($_smarty_tpl->tpl_vars['FIELDMODEL']->value->get('postvalue') != '' && !($_smarty_tpl->tpl_vars['FIELDMODEL']->value->getFieldInstance()->getFieldDataType() == 'reference' && $_smarty_tpl->tpl_vars['FIELDMODEL']->value->get('postvalue') == '0')) {?><div class="update-to"><span class="field-name"><?php echo vtranslate('LBL_TO');?>
</span>&nbsp;<em style="white-space:pre-line;"><?php echo Vtiger_Util_Helper::toVtiger6SafeHTML($_smarty_tpl->tpl_vars['POST_DISPLAY_VALUE']->value);?>
</em></div><?php }?></div><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></div></li><?php } elseif (($_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value->isRelationLink() || $_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value->isRelationUnLink())) {
$_smarty_tpl->_assignInScope('RELATED_MODULE', $_smarty_tpl->tpl_vars['RELATION']->value->getLinkedRecord()->getModuleName());?><li><time class="update_time cursorDefault"><small title="<?php echo Vtiger_Util_Helper::formatDateTimeIntoDayString($_smarty_tpl->tpl_vars['RELATION']->value->get('changedon'));?>
"><?php echo Vtiger_Util_Helper::formatDateDiffInStrings($_smarty_tpl->tpl_vars['RELATION']->value->get('changedon'));?>
 </small></time><div class="update_icon bg-info-<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'strtolower' ][ 0 ], array( $_smarty_tpl->tpl_vars['RELATED_MODULE']->value ));?>
"><?php ob_start();
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'strtolower' ][ 0 ], array( $_smarty_tpl->tpl_vars['RELATED_MODULE']->value )) == 'modcomments';
$_prefixVariable4 = ob_get_clean();
if ($_prefixVariable4) {
$_smarty_tpl->_assignInScope('VICON_MODULES', "vicon-chat");?><i class="update_image <?php echo $_smarty_tpl->tpl_vars['VICON_MODULES']->value;?>
"></i><?php } else { ?><span class="update_image"><?php echo Vtiger_Module_Model::getModuleIconPath($_smarty_tpl->tpl_vars['RELATED_MODULE']->value);?>
</span><?php }?></div><div class="update_info"><h5><?php $_smarty_tpl->_assignInScope('RELATION', $_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value->getRelationInstance());?><span class="field-name"><?php echo vtranslate($_smarty_tpl->tpl_vars['RELATION']->value->getLinkedRecord()->getModuleName(),$_smarty_tpl->tpl_vars['RELATION']->value->getLinkedRecord()->getModuleName());?>
</span>&nbsp;<span><?php if ($_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value->isRelationLink()) {
echo vtranslate('LBL_LINKED',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);
} else {
echo vtranslate('LBL_UNLINKED',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);
}?></span></h5><div class='font-x-small updateInfoContainer textOverflowEllipsis'><span><?php if ($_smarty_tpl->tpl_vars['RELATION']->value->getLinkedRecord()->getModuleName() == 'Calendar') {
if (isPermitted('Calendar','DetailView',$_smarty_tpl->tpl_vars['RELATION']->value->getLinkedRecord()->getId()) == 'yes') {
$_smarty_tpl->_assignInScope('PERMITTED', 1);
} else {
$_smarty_tpl->_assignInScope('PERMITTED', 0);
}
} else {
$_smarty_tpl->_assignInScope('PERMITTED', 1);
}
if ($_smarty_tpl->tpl_vars['PERMITTED']->value) {
if ($_smarty_tpl->tpl_vars['RELATED_MODULE']->value == 'ModComments') {
echo $_smarty_tpl->tpl_vars['RELATION']->value->getLinkedRecord()->getName();
} else {
$_smarty_tpl->_assignInScope('DETAILVIEW_URL', $_smarty_tpl->tpl_vars['RELATION']->value->getRecordDetailViewUrl());
if ($_smarty_tpl->tpl_vars['DETAILVIEW_URL']->value) {?><a <?php if (stripos($_smarty_tpl->tpl_vars['DETAILVIEW_URL']->value,'javascript:') === 0) {?>onclick<?php } else { ?>href<?php }?>='<?php echo $_smarty_tpl->tpl_vars['DETAILVIEW_URL']->value;?>
'><?php }?><strong><?php echo $_smarty_tpl->tpl_vars['RELATION']->value->getLinkedRecord()->getName();?>
</strong><?php if ($_smarty_tpl->tpl_vars['DETAILVIEW_URL']->value) {?></a><?php }
}
}?></span></div></div></li><?php } elseif ($_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value->isRestore()) {
}
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
if ($_smarty_tpl->tpl_vars['PAGING_MODEL']->value->isNextPageExists()) {?><li id='more_button'><div class='update_icon' id="moreLink"><button type="button" class="btn btn-success moreRecentUpdates"><?php echo vtranslate('LBL_MORE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
..</button></div></li><?php }?></ul><?php } else { ?><div class="summaryWidgetContainer"><p class="textAlignCenter"><?php echo vtranslate('LBL_NO_RECENT_UPDATES');?>
</p></div><?php }?></div></div>
<?php }
}
