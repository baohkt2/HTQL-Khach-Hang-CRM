<?php
/* Smarty version 4.5.5, created on 2025-10-02 08:10:25
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Calendar\QuickCreate.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68de3371907c23_11572448',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '41253351e29fe3fadd0810ba7c1bbdd8b4afe682' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Calendar\\QuickCreate.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68de3371907c23_11572448 (Smarty_Internal_Template $_smarty_tpl) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['SCRIPTS']->value, 'jsModel', false, 'index');
$_smarty_tpl->tpl_vars['jsModel']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['index']->value => $_smarty_tpl->tpl_vars['jsModel']->value) {
$_smarty_tpl->tpl_vars['jsModel']->do_else = false;
echo '<script'; ?>
 type="<?php echo $_smarty_tpl->tpl_vars['jsModel']->value->getType();?>
" src="<?php echo $_smarty_tpl->tpl_vars['jsModel']->value->getSrc();?>
"><?php echo '</script'; ?>
><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?><div class="modal-dialog modal-md"><div class="modal-content"><form class="form-horizontal recordEditView" id="QuickCreate" name="QuickCreate" method="post" action="index.php"><?php if ($_smarty_tpl->tpl_vars['MODE']->value == 'edit' && !empty($_smarty_tpl->tpl_vars['RECORD_ID']->value)) {
ob_start();
echo vtranslate('LBL_EDITING',$_smarty_tpl->tpl_vars['MODULE']->value);
$_prefixVariable1 = ob_get_clean();
ob_start();
echo vtranslate(('SINGLE_').($_smarty_tpl->tpl_vars['MODULE']->value),$_smarty_tpl->tpl_vars['MODULE']->value);
$_prefixVariable2 = ob_get_clean();
$_smarty_tpl->_assignInScope('HEADER_TITLE', (($_prefixVariable1).(" ")).($_prefixVariable2));
} else {
ob_start();
echo vtranslate('LBL_QUICK_CREATE',$_smarty_tpl->tpl_vars['MODULE']->value);
$_prefixVariable3 = ob_get_clean();
ob_start();
echo vtranslate(('SINGLE_').($_smarty_tpl->tpl_vars['MODULE']->value),$_smarty_tpl->tpl_vars['MODULE']->value);
$_prefixVariable4 = ob_get_clean();
$_smarty_tpl->_assignInScope('HEADER_TITLE', (($_prefixVariable3).(" ")).($_prefixVariable4));
}
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0, true);
?><div class="modal-body"><?php if (!empty($_smarty_tpl->tpl_vars['PICKIST_DEPENDENCY_DATASOURCE']->value)) {?><input type="hidden" name="picklistDependency" value='<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKIST_DEPENDENCY_DATASOURCE']->value);?>
' /><?php }?><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
"><input type="hidden" name="action" value="SaveAjax"><input type="hidden" name="calendarModule" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
"><input type="hidden" name="defaultCallDuration" value="<?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('callduration');?>
" /><input type="hidden" name="defaultOtherEventDuration" value="<?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('othereventduration');?>
" /><?php if ($_smarty_tpl->tpl_vars['MODE']->value == 'edit' && !empty($_smarty_tpl->tpl_vars['RECORD_ID']->value)) {?><input type="hidden" name="record" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
" /><input type="hidden" name="mode" value="<?php echo $_smarty_tpl->tpl_vars['MODE']->value;?>
" /><?php } else { ?><input type="hidden" name="record" value=""><?php }
$_smarty_tpl->_assignInScope('RECORD_STRUCTURE_MODEL', $_smarty_tpl->tpl_vars['QUICK_CREATE_CONTENTS']->value[$_smarty_tpl->tpl_vars['MODULE']->value]['recordStructureModel']);
$_smarty_tpl->_assignInScope('RECORD_STRUCTURE', $_smarty_tpl->tpl_vars['QUICK_CREATE_CONTENTS']->value[$_smarty_tpl->tpl_vars['MODULE']->value]['recordStructure']);
$_smarty_tpl->_assignInScope('BLOCK_FIELDS', $_smarty_tpl->tpl_vars['QUICK_CREATE_CONTENTS']->value[$_smarty_tpl->tpl_vars['MODULE']->value]['recordStructure']);?> 					<?php $_smarty_tpl->_assignInScope('MODULE_MODEL', $_smarty_tpl->tpl_vars['QUICK_CREATE_CONTENTS']->value[$_smarty_tpl->tpl_vars['MODULE']->value]['moduleModel']);?><div class="quickCreateContent calendarQuickCreateContent" style="padding-top:2%;margin-top:5px;"><?php if ($_smarty_tpl->tpl_vars['MODULE']->value == 'Calendar') {
if (!empty($_smarty_tpl->tpl_vars['PICKIST_DEPENDENCY_DATASOURCE_TODO']->value)) {?><input type="hidden" name="picklistDependency" value='<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKIST_DEPENDENCY_DATASOURCE_TODO']->value);?>
' /><?php }
} else {
if (!empty($_smarty_tpl->tpl_vars['PICKIST_DEPENDENCY_DATASOURCE_EVENT']->value)) {?><input type="hidden" name="picklistDependency" value='<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKIST_DEPENDENCY_DATASOURCE_EVENT']->value);?>
' /><?php }
}?><div><?php $_smarty_tpl->_assignInScope('FIELD_MODEL', $_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value['subject']);?><div style="margin-left: 14px;width: 95%;"><?php $_smarty_tpl->_assignInScope('FIELD_INFO', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo());
$_smarty_tpl->_assignInScope('SPECIAL_VALIDATOR', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getValidator());?><input id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_editView_fieldName_<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
" type="text" class="inputElement <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isNameField()) {?>nameField<?php }?>" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue');?>
"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype') == '3' || $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype') == '4' || $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isReadOnly()) {?> readonly <?php }?> <?php if (!empty($_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR']->value)) {?>data-validator="<?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR']->value);?>
"<?php }
if ($_smarty_tpl->tpl_vars['FIELD_INFO']->value["mandatory"] == true) {?> data-rule-required="true" <?php }
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FIELD_INFO']->value["validator"], 'VALIDATOR');
$_smarty_tpl->tpl_vars['VALIDATOR']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['VALIDATOR']->value) {
$_smarty_tpl->tpl_vars['VALIDATOR']->do_else = false;
$_smarty_tpl->_assignInScope('VALIDATOR_NAME', $_smarty_tpl->tpl_vars['VALIDATOR']->value["name"]);?>data-rule-<?php echo $_smarty_tpl->tpl_vars['VALIDATOR_NAME']->value;?>
 = "true"<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>placeholder="<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
 *" style="width: 100%;"/></div></div><div class="row" style="padding-top: 2%;"><div class="col-sm-12"><div class="col-sm-5"><?php $_smarty_tpl->_assignInScope('FIELD_MODEL', $_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value['date_start']);
$_smarty_tpl->_subTemplateRender(vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getTemplateName(),$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></div><div class="muted col-sm-1" style="line-height: 67px;left: 20px; padding-right: 7%;"><?php echo vtranslate('LBL_TO',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</div><div class="col-sm-5" <?php if ($_smarty_tpl->tpl_vars['MODULE']->value == 'Calendar') {?>style="margin-top: 4%;"<?php }?>><?php $_smarty_tpl->_assignInScope('FIELD_MODEL', $_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value['due_date']);
$_smarty_tpl->_subTemplateRender(vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getTemplateName(),$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></div></div></div><div class="container-fluid paddingTop15"><table class="massEditTable table no-border"><tr><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value, 'FIELD_MODEL', false, 'FIELD_NAME', 'blockfields', array (
));
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_NAME']->value => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value) {
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = false;
if ($_smarty_tpl->tpl_vars['FIELD_NAME']->value == 'subject' || $_smarty_tpl->tpl_vars['FIELD_NAME']->value == 'date_start' || $_smarty_tpl->tpl_vars['FIELD_NAME']->value == 'due_date' || $_smarty_tpl->tpl_vars['FIELD_NAME']->value == 'time_start') {?></tr><?php continue 1;
}
$_smarty_tpl->_assignInScope('isReferenceField', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType());
$_smarty_tpl->_assignInScope('referenceList', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getReferenceList());
$_smarty_tpl->_assignInScope('referenceListCount', php7_count($_smarty_tpl->tpl_vars['referenceList']->value));
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype') == "19") {
if ($_smarty_tpl->tpl_vars['COUNTER']->value == '1') {?><td></td><td></td></tr><tr><?php $_smarty_tpl->_assignInScope('COUNTER', 0);
}
}?></tr><tr><td class='fieldLabel col-lg-3'><?php if ($_smarty_tpl->tpl_vars['isReferenceField']->value != "reference") {?><label class="muted"><?php }
if ($_smarty_tpl->tpl_vars['isReferenceField']->value == "reference") {
if ($_smarty_tpl->tpl_vars['referenceListCount']->value > 1) {
$_smarty_tpl->_assignInScope('DISPLAYID', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'));
$_smarty_tpl->_assignInScope('REFERENCED_MODULE_STRUCT', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getReferenceModule($_smarty_tpl->tpl_vars['DISPLAYID']->value));
if (!empty($_smarty_tpl->tpl_vars['REFERENCED_MODULE_STRUCT']->value)) {
$_smarty_tpl->_assignInScope('REFERENCED_MODULE_NAME', $_smarty_tpl->tpl_vars['REFERENCED_MODULE_STRUCT']->value->get('name'));
}?><span class=""><select style="width: 150px;" class="select2 referenceModulesList"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['referenceList']->value, 'value', false, 'index');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['index']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['value']->value == $_smarty_tpl->tpl_vars['REFERENCED_MODULE_NAME']->value) {?> selected <?php }?> ><?php echo vtranslate($_smarty_tpl->tpl_vars['value']->value,$_smarty_tpl->tpl_vars['value']->value);?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></span><?php } else { ?><label class="muted"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
 &nbsp;<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory() == true) {?> <span class="redColor">*</span> <?php }?></label><?php }
} else {
echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory() == true) {?> <span class="redColor">*</span> <?php }
}
if ($_smarty_tpl->tpl_vars['isReferenceField']->value != "reference") {?></label><?php }?></td><td class="fieldValue col-lg-9" <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype') == '19') {?> colspan="3" <?php $_smarty_tpl->_assignInScope('COUNTER', $_smarty_tpl->tpl_vars['COUNTER']->value+1);?> <?php }?>><?php $_smarty_tpl->_subTemplateRender(vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getTemplateName(),$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></td><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tr></table></div></div></div><div class="modal-footer"><center><?php if ($_smarty_tpl->tpl_vars['BUTTON_NAME']->value != null) {
$_smarty_tpl->_assignInScope('BUTTON_LABEL', $_smarty_tpl->tpl_vars['BUTTON_NAME']->value);
} else {
ob_start();
echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);
$_prefixVariable5 = ob_get_clean();
$_smarty_tpl->_assignInScope('BUTTON_LABEL', $_prefixVariable5);
}
$_smarty_tpl->_assignInScope('CALENDAR_MODULE_MODEL', $_smarty_tpl->tpl_vars['QUICK_CREATE_CONTENTS']->value['Calendar']['moduleModel']);
$_smarty_tpl->_assignInScope('EDIT_VIEW_URL', $_smarty_tpl->tpl_vars['CALENDAR_MODULE_MODEL']->value->getCreateTaskRecordUrl());
if ($_smarty_tpl->tpl_vars['MODULE']->value == 'Events') {
$_smarty_tpl->_assignInScope('EDIT_VIEW_URL', $_smarty_tpl->tpl_vars['CALENDAR_MODULE_MODEL']->value->getCreateEventRecordUrl());
}?><button class="btn btn-default" id="goToFullForm" data-edit-view-url="<?php echo $_smarty_tpl->tpl_vars['EDIT_VIEW_URL']->value;?>
" type="button"><strong><?php echo vtranslate('LBL_GO_TO_FULL_FORM',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button><button <?php if ($_smarty_tpl->tpl_vars['BUTTON_ID']->value != null) {?> id="<?php echo $_smarty_tpl->tpl_vars['BUTTON_ID']->value;?>
" <?php }?> class="btn btn-success" type="submit" name="saveButton"><strong><?php echo $_smarty_tpl->tpl_vars['BUTTON_LABEL']->value;?>
</strong></button><a href="#" class="cancelLink" type="reset" data-dismiss="modal"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></center></div></form></div><?php if ($_smarty_tpl->tpl_vars['FIELDS_INFO']->value != null) {
echo '<script'; ?>
 type="text/javascript">var quickcreate_uimeta = (function () {var fieldInfo = <?php echo $_smarty_tpl->tpl_vars['FIELDS_INFO']->value;?>
;return {field: {get: function (name, property) {if (name && property === undefined) {return fieldInfo[name];}if (name && property) {return fieldInfo[name][property]}},isMandatory: function (name) {if (fieldInfo[name]) {return fieldInfo[name].mandatory;}return false;},getType: function (name) {if (fieldInfo[name]) {return fieldInfo[name].type;}return false;}},};})();<?php echo '</script'; ?>
><?php }?></div>
<?php }
}
