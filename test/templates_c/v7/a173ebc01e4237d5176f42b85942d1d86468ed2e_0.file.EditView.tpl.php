<?php
/* Smarty version 4.5.5, created on 2025-09-16 07:47:06
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\CustomView\EditView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68c915fade8425_65155744',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a173ebc01e4237d5176f42b85942d1d86468ed2e' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\CustomView\\EditView.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68c915fade8425_65155744 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('SELECTED_FIELDS', $_smarty_tpl->tpl_vars['CUSTOMVIEW_MODEL']->value->getSelectedFields());
$_smarty_tpl->_assignInScope('MODULE_FIELDS', $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getFields());?><div id="filterContainer" style="height:100%"><form id="CustomView" style="height:100%"><div class="modal-content" style="height:100%"><div class="overlayHeader"><?php if ($_smarty_tpl->tpl_vars['RECORD_ID']->value) {
ob_start();
echo vtranslate('LBL_EDIT_CUSTOM',$_smarty_tpl->tpl_vars['MODULE']->value);
$_prefixVariable1 = ob_get_clean();
$_smarty_tpl->_assignInScope('TITLE', $_prefixVariable1);
} else {
ob_start();
echo vtranslate('LBL_CREATE_LIST',$_smarty_tpl->tpl_vars['MODULE']->value);
$_prefixVariable2 = ob_get_clean();
$_smarty_tpl->_assignInScope('TITLE', $_prefixVariable2);
}
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('TITLE'=>$_smarty_tpl->tpl_vars['TITLE']->value), 0, true);
?></div><div class="modal-body" style="height:100%"><div class="customview-content row" style="height:90%"><input type=hidden name="record" id="record" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
" /><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
" /><input type="hidden" name="action" value="Save" /><input type="hidden" id="sourceModule" name="source_module" value="<?php echo $_smarty_tpl->tpl_vars['SOURCE_MODULE']->value;?>
"/><input type="hidden" id="stdfilterlist" name="stdfilterlist" value=""/><input type="hidden" id="advfilterlist" name="advfilterlist" value=""/><input type="hidden" name="status" value="<?php echo $_smarty_tpl->tpl_vars['CV_PRIVATE_VALUE']->value;?>
"/><?php if ($_smarty_tpl->tpl_vars['RECORD_ID']->value) {?><input type="hidden" name="status" value="<?php echo $_smarty_tpl->tpl_vars['CUSTOMVIEW_MODEL']->value->get('status');?>
" /><?php }?><input type="hidden" name="date_filters" data-value='<?php echo Vtiger_Util_Helper::toSafeHTML(ZEND_JSON::encode($_smarty_tpl->tpl_vars['DATE_FILTERS']->value));?>
' /><div class="form-group"><label><?php echo vtranslate('LBL_VIEW_NAME',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<span class="redColor">*</span> </label><div class="row"><div class="col-lg-5 col-md-5 col-sm-5"><input class="form-control" type="text" data-record-id="<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
" id="viewname" name="viewname" value="<?php echo $_smarty_tpl->tpl_vars['CUSTOMVIEW_MODEL']->value->get('viewname');?>
" data-rule-required="true" data-rule-maxsize="100" data-rule-check-filter-duplicate='<?php echo Vtiger_Util_Helper::toSafeHTML(Zend_JSON::encode($_smarty_tpl->tpl_vars['CUSTOM_VIEWS_LIST']->value));?>
'></div><div class="col-lg-5 col-md-5 col-sm-5"><label class="checkbox-inline"><input type="checkbox" name="setdefault" value="1" <?php if ($_smarty_tpl->tpl_vars['CUSTOMVIEW_MODEL']->value->isDefault()) {?> checked="checked"<?php }?>> &nbsp;&nbsp;<?php echo vtranslate('LBL_SET_AS_DEFAULT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label><label class="checkbox-inline"><input id="setmetrics" name="setmetrics" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['CUSTOMVIEW_MODEL']->value->get('setmetrics') == '1') {?> checked="checked"<?php }?>> &nbsp;&nbsp;<?php echo vtranslate('LBL_LIST_IN_METRICS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></label></div></div></div><div class="form-group"><label><?php echo vtranslate('LBL_CHOOSE_COLUMNS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 (<?php echo vtranslate('LBL_MAX_NUMBER_FILTER_COLUMNS');?>
)</label><div class="columnsSelectDiv clearfix"><?php $_smarty_tpl->_assignInScope('MANDATORY_FIELDS', array());
$_smarty_tpl->_assignInScope('NUMBER_OF_COLUMNS_SELECTED', 0);
$_smarty_tpl->_assignInScope('MAX_ALLOWED_COLUMNS', 15);?><select name="selectColumns" data-rule-required="true" data-msg-required="<?php echo vtranslate('LBL_PLEASE_SELECT_ATLEAST_ONE_OPTION',$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
" data-placeholder="<?php echo vtranslate('LBL_ADD_MORE_COLUMNS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" multiple class="select2 columnsSelect col-lg-10" id="viewColumnsSelect" ><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value, 'BLOCK_FIELDS', false, 'BLOCK_LABEL');
$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['BLOCK_LABEL']->value => $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value) {
$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->do_else = false;
?><optgroup label='<?php echo vtranslate($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value,$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
'><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value, 'FIELD_MODEL', false, 'FIELD_NAME');
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_NAME']->value => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value) {
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = false;
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayType() == '6') {
continue 1;
}
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()) {
echo array_push($_smarty_tpl->tpl_vars['MANDATORY_FIELDS']->value,$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getCustomViewColumnName());
}
$_smarty_tpl->_assignInScope('FIELD_MODULE_NAME', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getModule()->getName());?><option value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getCustomViewColumnName();?>
" data-field-name="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
"<?php if (in_array(decode_html($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getCustomViewColumnName()),$_smarty_tpl->tpl_vars['SELECTED_FIELDS']->value)) {?>selected<?php } elseif ((!$_smarty_tpl->tpl_vars['RECORD_ID']->value) && ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isSummaryField() || $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isHeaderField()) && ($_smarty_tpl->tpl_vars['FIELD_MODULE_NAME']->value == $_smarty_tpl->tpl_vars['SOURCE_MODULE']->value) && (!(preg_match("/\([A-Za-z_0-9]* \; \([A-Za-z_0-9]*\) [A-Za-z_0-9]*\)/",$_smarty_tpl->tpl_vars['FIELD_NAME']->value))) && $_smarty_tpl->tpl_vars['NUMBER_OF_COLUMNS_SELECTED']->value < $_smarty_tpl->tpl_vars['MAX_ALLOWED_COLUMNS']->value) {?>selected<?php $_smarty_tpl->_assignInScope('NUMBER_OF_COLUMNS_SELECTED', $_smarty_tpl->tpl_vars['NUMBER_OF_COLUMNS_SELECTED']->value+1);
}?>><?php echo Vtiger_Util_Helper::toSafeHTML(vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value));
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory() == true) {?> <span>*</span> <?php }?></option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></optgroup><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
if ((isset($_smarty_tpl->tpl_vars['EVENT_RECORD_STRUCTURE']->value)) && is_array($_smarty_tpl->tpl_vars['EVENT_RECORD_STRUCTURE']->value)) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['EVENT_RECORD_STRUCTURE']->value, 'BLOCK_FIELDS', false, 'BLOCK_LABEL');
$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['BLOCK_LABEL']->value => $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value) {
$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->do_else = false;
?><optgroup label='<?php echo vtranslate($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value,'Events');?>
'><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value, 'FIELD_MODEL', false, 'FIELD_NAME');
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_NAME']->value => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value) {
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = false;
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayType() == '6') {
continue 1;
}
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()) {
echo array_push($_smarty_tpl->tpl_vars['MANDATORY_FIELDS']->value,$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getCustomViewColumnName());
}?><option value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getCustomViewColumnName();?>
" data-field-name="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
"<?php if (in_array(decode_html($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getCustomViewColumnName()),$_smarty_tpl->tpl_vars['SELECTED_FIELDS']->value)) {?>selected<?php }?>><?php echo Vtiger_Util_Helper::toSafeHTML(vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value));
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory() == true) {?> <span>*</span> <?php }?></option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></optgroup><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?></select><input type="hidden" name="columnslist" value='<?php echo Vtiger_Functions::jsonEncode($_smarty_tpl->tpl_vars['SELECTED_FIELDS']->value);?>
' /><input id="mandatoryFieldsList" type="hidden" value='<?php echo Vtiger_Util_Helper::toSafeHTML(ZEND_JSON::encode($_smarty_tpl->tpl_vars['MANDATORY_FIELDS']->value));?>
' /></div><div class="col-lg-2 col-md-2 col-sm-2"></div></div><div><label class="filterHeaders"><?php echo vtranslate('LBL_CHOOSE_FILTER_CONDITIONS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 :</label><div class="filterElements well filterConditionContainer filterConditionsDiv"><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( 'AdvanceFilter.tpl' )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></div></div><div class="checkbox"><label><input type="hidden" name="sharelist" value="0" /><input type="checkbox" data-toogle-members="true" name="sharelist" value="1" <?php if ($_smarty_tpl->tpl_vars['LIST_SHARED']->value) {?> checked="checked"<?php }?>> &nbsp;&nbsp;<?php echo vtranslate('LBL_SHARE_THIS_LIST',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></div><select id="memberList" class="col-lg-7 col-md-7 col-sm-7 select2 members op0<?php if ($_smarty_tpl->tpl_vars['LIST_SHARED']->value) {?> fadeInx<?php }?>" multiple="true" name="members[]" data-placeholder="<?php echo vtranslate('LBL_ADD_USERS_ROLES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" style="margin-bottom: 10px;" data-rule-required="<?php if ($_smarty_tpl->tpl_vars['LIST_SHARED']->value) {?>true<?php } else { ?>false<?php }?>"><optgroup label="<?php echo vtranslate('LBL_ALL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><option value="All::Users" data-member-type="<?php echo vtranslate('LBL_ALL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"<?php if (($_smarty_tpl->tpl_vars['CUSTOMVIEW_MODEL']->value->get('status') == $_smarty_tpl->tpl_vars['CV_PUBLIC_VALUE']->value)) {?> selected="selected"<?php }?>><?php echo vtranslate('LBL_ALL_USERS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option></optgroup><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MEMBER_GROUPS']->value, 'ALL_GROUP_MEMBERS', false, 'GROUP_LABEL');
$_smarty_tpl->tpl_vars['ALL_GROUP_MEMBERS']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['GROUP_LABEL']->value => $_smarty_tpl->tpl_vars['ALL_GROUP_MEMBERS']->value) {
$_smarty_tpl->tpl_vars['ALL_GROUP_MEMBERS']->do_else = false;
$_smarty_tpl->_assignInScope('TRANS_GROUP_LABEL', $_smarty_tpl->tpl_vars['GROUP_LABEL']->value);
if ($_smarty_tpl->tpl_vars['GROUP_LABEL']->value == 'RoleAndSubordinates') {
$_smarty_tpl->_assignInScope('TRANS_GROUP_LABEL', 'LBL_ROLEANDSUBORDINATE');
}
ob_start();
echo vtranslate($_smarty_tpl->tpl_vars['TRANS_GROUP_LABEL']->value);
$_prefixVariable3 = ob_get_clean();
$_smarty_tpl->_assignInScope('TRANS_GROUP_LABEL', $_prefixVariable3);?><optgroup label="<?php echo $_smarty_tpl->tpl_vars['TRANS_GROUP_LABEL']->value;?>
"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ALL_GROUP_MEMBERS']->value, 'MEMBER');
$_smarty_tpl->tpl_vars['MEMBER']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['MEMBER']->value) {
$_smarty_tpl->tpl_vars['MEMBER']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['MEMBER']->value->getId();?>
" data-member-type="<?php echo $_smarty_tpl->tpl_vars['GROUP_LABEL']->value;?>
" <?php if ((isset($_smarty_tpl->tpl_vars['SELECTED_MEMBERS_GROUP']->value[$_smarty_tpl->tpl_vars['GROUP_LABEL']->value][$_smarty_tpl->tpl_vars['MEMBER']->value->getId()]))) {?>selected="true"<?php }?>><?php echo $_smarty_tpl->tpl_vars['MEMBER']->value->getName();?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></optgroup><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select><input type="hidden" name="status" id="allUsersStatusValue" value="" data-public="<?php echo $_smarty_tpl->tpl_vars['CV_PUBLIC_VALUE']->value;?>
" data-private="<?php echo $_smarty_tpl->tpl_vars['CV_PRIVATE_VALUE']->value;?>
"/></div></div><div class='modal-overlay-footer clearfix border1px'><div class="row clearfix"><div class=' textAlignCenter col-lg-12 col-md-12 col-sm-12 '><button type='submit' class='btn btn-success saveButton' id="customViewSubmit"><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button>&nbsp;&nbsp;<a class='cancelLink' href="javascript:void(0);" type="reset" data-dismiss="modal"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div></div></div></div></form></div>
<?php }
}
