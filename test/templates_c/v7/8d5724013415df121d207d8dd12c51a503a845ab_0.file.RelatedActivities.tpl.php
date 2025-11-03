<?php
/* Smarty version 4.5.5, created on 2025-11-02 08:35:47
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Vtiger\RelatedActivities.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690717e3c57245_85330945',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8d5724013415df121d207d8dd12c51a503a845ab' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Vtiger\\RelatedActivities.tpl',
      1 => 1761802269,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690717e3c57245_85330945 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('MODULE_NAME', "Calendar");?><div class="summaryWidgetContainer"><div class="widget_header clearfix"><h4 class="display-inline-block pull-left"><?php echo vtranslate('LBL_ACTIVITIES',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</h4><?php $_smarty_tpl->_assignInScope('CALENDAR_MODEL', Vtiger_Module_Model::getInstance('Calendar'));?><div class="pull-right" style="margin-top: -5px;"><?php if ($_smarty_tpl->tpl_vars['CALENDAR_MODEL']->value->isPermitted('CreateView')) {?><button class="btn addButton btn-sm btn-default createActivity toDotask textOverflowEllipsis max-width-100" title="<?php echo vtranslate('LBL_ADD_TASK',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
" type="button" href="javascript:void(0)" data-url="sourceModule=<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getModuleName();?>
&sourceRecord=<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getId();?>
&relationOperation=true" ><i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo vtranslate('LBL_ADD_TASK',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</button>&nbsp;&nbsp;<button class="btn addButton btn-sm btn-default createActivity textOverflowEllipsis max-width-100" title="<?php echo vtranslate('LBL_ADD_EVENT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
" data-name="Events" data-url="index.php?module=Events&view=QuickCreateAjax" href="javascript:void(0)" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo vtranslate('LBL_ADD_EVENT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</button><?php }?></div><?php $_smarty_tpl->_assignInScope('SOURCE_MODEL', $_smarty_tpl->tpl_vars['RECORD']->value);?></div><div class="widget_contents"><?php if (php7_count($_smarty_tpl->tpl_vars['ACTIVITIES']->value) != '0') {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ACTIVITIES']->value, 'RECORD', false, 'KEY');
$_smarty_tpl->tpl_vars['RECORD']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['KEY']->value => $_smarty_tpl->tpl_vars['RECORD']->value) {
$_smarty_tpl->tpl_vars['RECORD']->do_else = false;
$_smarty_tpl->_assignInScope('START_DATE', $_smarty_tpl->tpl_vars['RECORD']->value->get('date_start'));
$_smarty_tpl->_assignInScope('START_TIME', $_smarty_tpl->tpl_vars['RECORD']->value->get('time_start'));
$_smarty_tpl->_assignInScope('EDITVIEW_PERMITTED', isPermitted('Calendar','EditView',$_smarty_tpl->tpl_vars['RECORD']->value->get('crmid')));
$_smarty_tpl->_assignInScope('DETAILVIEW_PERMITTED', isPermitted('Calendar','DetailView',$_smarty_tpl->tpl_vars['RECORD']->value->get('crmid')));
$_smarty_tpl->_assignInScope('DELETE_PERMITTED', isPermitted('Calendar','Delete',$_smarty_tpl->tpl_vars['RECORD']->value->get('crmid')));?><div class="activityEntries"><input type="hidden" class="activityId" value="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('activityid');?>
"/><div class='media'><div class='row'><div class='module-icon col-lg-1 col-md-1 col-sm-1 textAlignCenter'><span class='vicon-<?php echo strtolower($_smarty_tpl->tpl_vars['RECORD']->value->get('activitytype'));?>
'></span></div><div class='col-lg-7 col-md-7 col-sm-7'><div class="summaryViewEntries"><?php if ($_smarty_tpl->tpl_vars['DETAILVIEW_PERMITTED']->value == 'yes') {?><a href="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getDetailViewUrl();?>
" title="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('subject');?>
"><?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('subject');?>
</a><?php } else {
echo $_smarty_tpl->tpl_vars['RECORD']->value->get('subject');
}?>&nbsp;&nbsp;<?php if ($_smarty_tpl->tpl_vars['EDITVIEW_PERMITTED']->value == 'yes') {?><a href="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getEditViewUrl();?>
&sourceModule=<?php echo $_smarty_tpl->tpl_vars['SOURCE_MODEL']->value->getModuleName();?>
&sourceRecord=<?php echo $_smarty_tpl->tpl_vars['SOURCE_MODEL']->value->getId();?>
&relationOperation=true" class="fieldValue"><i class="summaryViewEdit fa fa-pencil" title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
"></i></a><?php }?>&nbsp;<?php if ($_smarty_tpl->tpl_vars['DELETE_PERMITTED']->value == 'yes') {?><a onclick="Vtiger_Detail_Js.deleteRelatedActivity(event);" data-id="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getId();?>
" data-recurring-enabled="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->isRecurringEnabled();?>
" class="fieldValue"><i class="summaryViewEdit fa fa-trash " title="<?php echo vtranslate('LBL_DELETE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
"></i></a><?php }?></div><span><strong title="<?php echo Vtiger_Util_Helper::formatDateTimeIntoDayString(((string)$_smarty_tpl->tpl_vars['START_DATE']->value)." ".((string)$_smarty_tpl->tpl_vars['START_TIME']->value));?>
"><?php echo Vtiger_Util_Helper::formatDateIntoStrings($_smarty_tpl->tpl_vars['START_DATE']->value,$_smarty_tpl->tpl_vars['START_TIME']->value);?>
</strong></span></div><div class='col-lg-4 col-md-4 col-sm-4 activityStatus' style='line-height: 0px;padding-right:30px;'><div class="row"><?php if ($_smarty_tpl->tpl_vars['RECORD']->value->get('activitytype') == 'Task') {
$_smarty_tpl->_assignInScope('MODULE_NAME', $_smarty_tpl->tpl_vars['RECORD']->value->getModuleName());?><input type="hidden" class="activityModule" value="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getModuleName();?>
"/><input type="hidden" class="activityType" value="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('activitytype');?>
"/><div class="pull-right"><?php $_smarty_tpl->_assignInScope('FIELD_MODEL', $_smarty_tpl->tpl_vars['RECORD']->value->getModule()->getField('taskstatus'));?><style><?php $_smarty_tpl->_assignInScope('PICKLIST_COLOR_MAP', Settings_Picklist_Module_Model::getPicklistColorMap('taskstatus',true));
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['PICKLIST_COLOR_MAP']->value, 'PICKLIST_COLOR', false, 'PICKLIST_VALUE');
$_smarty_tpl->tpl_vars['PICKLIST_COLOR']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value => $_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value) {
$_smarty_tpl->tpl_vars['PICKLIST_COLOR']->do_else = false;
$_smarty_tpl->_assignInScope('PICKLIST_TEXT_COLOR', Settings_Picklist_Module_Model::getTextColor($_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value));
$_smarty_tpl->_assignInScope('CONVERTED_PICKLIST_VALUE', Vtiger_Util_Helper::convertSpaceToHyphen($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value));?>.picklist-<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getId();?>
-<?php echo Vtiger_Util_Helper::escapeCssSpecialCharacters($_smarty_tpl->tpl_vars['CONVERTED_PICKLIST_VALUE']->value);?>
 {background-color: <?php echo $_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value;?>
;color: <?php echo $_smarty_tpl->tpl_vars['PICKLIST_TEXT_COLOR']->value;?>
;}<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></style><strong><span class="value picklist-color picklist-<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getId();?>
-<?php echo Vtiger_Util_Helper::convertSpaceToHyphen($_smarty_tpl->tpl_vars['RECORD']->value->get('status'));?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['RECORD']->value->get('status'),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</span></strong>&nbsp&nbsp;<?php if ($_smarty_tpl->tpl_vars['EDITVIEW_PERMITTED']->value == 'yes') {?><span class="editStatus cursorPointer"><i class="fa fa-pencil" title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
"></i></span><span class="edit hide"><?php $_smarty_tpl->_assignInScope('FIELD_VALUE', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->set('fieldvalue',$_smarty_tpl->tpl_vars['RECORD']->value->get('status')));
$_smarty_tpl->_subTemplateRender(vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getTemplateName(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('FIELD_MODEL'=>$_smarty_tpl->tpl_vars['FIELD_MODEL']->value,'USER_MODEL'=>$_smarty_tpl->tpl_vars['USER_MODEL']->value,'MODULE'=>$_smarty_tpl->tpl_vars['MODULE_NAME']->value,'OCCUPY_COMPLETE_WIDTH'=>'true'), 0, true);
?><input type="hidden" class="fieldname" value='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
' data-prev-value='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue');?>
' /></span><?php }?></div><?php } else {
$_smarty_tpl->_assignInScope('MODULE_NAME', "Events");?><input type="hidden" class="activityModule" value="Events"/><input type="hidden" class="activityType" value="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('activitytype');?>
"/><div class="pull-right"><?php $_smarty_tpl->_assignInScope('FIELD_MODEL', $_smarty_tpl->tpl_vars['RECORD']->value->getModule()->getField('eventstatus'));?><style><?php $_smarty_tpl->_assignInScope('PICKLIST_COLOR_MAP', Settings_Picklist_Module_Model::getPicklistColorMap('eventstatus',true));
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['PICKLIST_COLOR_MAP']->value, 'PICKLIST_COLOR', false, 'PICKLIST_VALUE');
$_smarty_tpl->tpl_vars['PICKLIST_COLOR']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value => $_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value) {
$_smarty_tpl->tpl_vars['PICKLIST_COLOR']->do_else = false;
$_smarty_tpl->_assignInScope('PICKLIST_TEXT_COLOR', Settings_Picklist_Module_Model::getTextColor($_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value));
$_smarty_tpl->_assignInScope('CONVERTED_PICKLIST_VALUE', Vtiger_Util_Helper::convertSpaceToHyphen($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value));?>.picklist-<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getId();?>
-<?php echo Vtiger_Util_Helper::escapeCssSpecialCharacters($_smarty_tpl->tpl_vars['CONVERTED_PICKLIST_VALUE']->value);?>
 {background-color: <?php echo $_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value;?>
;color: <?php echo $_smarty_tpl->tpl_vars['PICKLIST_TEXT_COLOR']->value;?>
;}<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></style><strong><span class="value picklist-color picklist-<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getId();?>
-<?php echo Vtiger_Util_Helper::convertSpaceToHyphen($_smarty_tpl->tpl_vars['RECORD']->value->get('eventstatus'));?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['RECORD']->value->get('eventstatus'),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</span></strong>&nbsp&nbsp;<?php if ($_smarty_tpl->tpl_vars['EDITVIEW_PERMITTED']->value == 'yes') {?><span class="editStatus cursorPointer"><i class="fa fa-pencil" title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
"></i></span><span class="edit hide"><?php $_smarty_tpl->_assignInScope('FIELD_VALUE', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->set('fieldvalue',$_smarty_tpl->tpl_vars['RECORD']->value->get('eventstatus')));
$_smarty_tpl->_subTemplateRender(vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getTemplateName(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('FIELD_MODEL'=>$_smarty_tpl->tpl_vars['FIELD_MODEL']->value,'USER_MODEL'=>$_smarty_tpl->tpl_vars['USER_MODEL']->value,'MODULE'=>$_smarty_tpl->tpl_vars['MODULE_NAME']->value,'OCCUPY_COMPLETE_WIDTH'=>'true'), 0, true);
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType() == 'multipicklist') {?><input type="hidden" class="fieldname" value='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
[]' data-prev-value='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'));?>
' /><?php } else { ?><input type="hidden" class="fieldname" value='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
' data-prev-value='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'));?>
' /><?php }?></span><?php }?></div><?php }?></div></div></div></div><hr></div><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
} else { ?><div class="summaryWidgetContainer noContent"><p class="textAlignCenter"><?php echo vtranslate('LBL_NO_PENDING_ACTIVITIES',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</p></div><?php }
if ($_smarty_tpl->tpl_vars['PAGING_MODEL']->value->isNextPageExists()) {?><div class="row"><div class="textAlignCenter"><a href="javascript:void(0)" class="moreRecentActivities"><?php echo vtranslate('LBL_SHOW_MORE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</a></div></div><?php }?></div></div>
<?php }
}
