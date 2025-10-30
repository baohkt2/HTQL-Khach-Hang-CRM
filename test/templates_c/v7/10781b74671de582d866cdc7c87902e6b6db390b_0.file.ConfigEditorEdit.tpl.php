<?php
/* Smarty version 4.5.5, created on 2025-10-25 17:39:32
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\Vtiger\ConfigEditorEdit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68fd0b54775818_64064676',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '10781b74671de582d866cdc7c87902e6b6db390b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\Vtiger\\ConfigEditorEdit.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68fd0b54775818_64064676 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="editViewPageDiv " id="editViewContent"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 "><div class="contents"><form id="ConfigEditorForm" class="form-horizontal" data-detail-url="<?php echo $_smarty_tpl->tpl_vars['MODEL']->value->getDetailViewUrl();?>
" method="POST"><?php $_smarty_tpl->_assignInScope('WIDTHTYPE', $_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('rowheight'));
$_smarty_tpl->_assignInScope('FIELD_VALIDATION', array('HELPDESK_SUPPORT_EMAIL_ID'=>'data-rule-email="true"','upload_maxsize'=>'data-rule-range=[1,5] data-rule-positive="true" data-rule-wholeNumber="true"','history_max_viewed'=>'data-rule-range=[1,5] data-rule-positive="true" data-rule-wholeNumber="true"','listview_max_textlength'=>'data-rule-range=[1,100] data-rule-positive="true" data-rule-wholeNumber="true"','list_max_entries_per_page'=>'data-rule-range=[1,100] data-rule-positive="true" data-rule-wholeNumber="true"'));?><div><h4><?php echo vtranslate('LBL_CONFIG_EDITOR',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4></div><hr><br><div class="detailViewInfo"><?php $_smarty_tpl->_assignInScope('FIELD_DATA', $_smarty_tpl->tpl_vars['MODEL']->value->getViewableData());
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MODEL']->value->getEditableFields(), 'FIELD_DETAILS', false, 'FIELD_NAME');
$_smarty_tpl->tpl_vars['FIELD_DETAILS']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_NAME']->value => $_smarty_tpl->tpl_vars['FIELD_DETAILS']->value) {
$_smarty_tpl->tpl_vars['FIELD_DETAILS']->do_else = false;
?><div class="row form-group"><div class="col-lg-4 control-label fieldLabel"><label><?php if ($_smarty_tpl->tpl_vars['FIELD_NAME']->value == 'upload_maxsize') {
if ($_smarty_tpl->tpl_vars['FIELD_DATA']->value[$_smarty_tpl->tpl_vars['FIELD_NAME']->value] > 5) {
echo vtranslate($_smarty_tpl->tpl_vars['FIELD_DETAILS']->value['label'],$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value,$_smarty_tpl->tpl_vars['FIELD_DATA']->value[$_smarty_tpl->tpl_vars['FIELD_NAME']->value]);
} else {
echo vtranslate($_smarty_tpl->tpl_vars['FIELD_DETAILS']->value['label'],$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value,5);
}
} else {
echo vtranslate($_smarty_tpl->tpl_vars['FIELD_DETAILS']->value['label'],$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
}?></label></div><div class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
  col-lg-4 input-group"><?php if ($_smarty_tpl->tpl_vars['FIELD_DETAILS']->value['fieldType'] == 'picklist') {?><select class="select2-container inputElement select2 col-lg-11" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
" ><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MODEL']->value->getPicklistValues($_smarty_tpl->tpl_vars['FIELD_NAME']->value), 'optionLabel', false, 'optionName');
$_smarty_tpl->tpl_vars['optionLabel']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['optionName']->value => $_smarty_tpl->tpl_vars['optionLabel']->value) {
$_smarty_tpl->tpl_vars['optionLabel']->do_else = false;
if ($_smarty_tpl->tpl_vars['FIELD_NAME']->value != 'default_reply_to') {?><option <?php if ($_smarty_tpl->tpl_vars['optionLabel']->value == $_smarty_tpl->tpl_vars['FIELD_DATA']->value[$_smarty_tpl->tpl_vars['FIELD_NAME']->value]) {?> selected <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['optionLabel']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><?php } elseif ($_smarty_tpl->tpl_vars['FIELD_NAME']->value == 'default_reply_to') {?><option value="<?php echo $_smarty_tpl->tpl_vars['optionName']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['optionName']->value == $_smarty_tpl->tpl_vars['FIELD_DATA']->value[$_smarty_tpl->tpl_vars['FIELD_NAME']->value]) {?> selected <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['optionName']->value);?>
</option><?php } else { ?><option value="<?php echo $_smarty_tpl->tpl_vars['optionName']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['optionLabel']->value == $_smarty_tpl->tpl_vars['FIELD_DATA']->value[$_smarty_tpl->tpl_vars['FIELD_NAME']->value]) {?> selected <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['optionLabel']->value,$_smarty_tpl->tpl_vars['optionLabel']->value);?>
</option><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select><?php if ($_smarty_tpl->tpl_vars['FIELD_NAME']->value == 'default_reply_to') {?><div class="input-group-addon input-select-addon"><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="right" title="<?php echo vtranslate('LBL_DEFAULT_REPLY_TO_INFO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i></div><?php }
} elseif ($_smarty_tpl->tpl_vars['FIELD_NAME']->value == 'USE_RTE') {?><input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
" value="false" /><div class=" "> <input type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
" value="true" <?php if ($_smarty_tpl->tpl_vars['FIELD_DATA']->value[$_smarty_tpl->tpl_vars['FIELD_NAME']->value] == 'true') {?> checked <?php }?> /></div><?php } elseif ($_smarty_tpl->tpl_vars['FIELD_NAME']->value == 'email_tracking') {?><input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
" value="No" /><input type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
" value="Yes" <?php if ($_smarty_tpl->tpl_vars['FIELD_DATA']->value[$_smarty_tpl->tpl_vars['FIELD_NAME']->value] == "Yes") {?> checked <?php }?> /><div class="input-info-addon"> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="<?php echo vtranslate('LBL_PERSONAL_EMAIL_TRACKING_INFO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i></div><?php } else { ?><div class=" input-group inputElement"><input type="text" class="inputElement " name="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
" data-rule-required="true" <?php if ((isset($_smarty_tpl->tpl_vars['FIELD_VALIDATION']->value[$_smarty_tpl->tpl_vars['FIELD_NAME']->value])) && $_smarty_tpl->tpl_vars['FIELD_VALIDATION']->value[$_smarty_tpl->tpl_vars['FIELD_NAME']->value]) {?> <?php echo $_smarty_tpl->tpl_vars['FIELD_VALIDATION']->value[$_smarty_tpl->tpl_vars['FIELD_NAME']->value];?>
 <?php }?> value="<?php echo $_smarty_tpl->tpl_vars['FIELD_DATA']->value[$_smarty_tpl->tpl_vars['FIELD_NAME']->value];?>
" /><?php if ($_smarty_tpl->tpl_vars['FIELD_NAME']->value == 'upload_maxsize') {?><div class="input-group-addon"><?php echo vtranslate('LBL_MB',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><?php }?></div><?php }?></div></div><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></div><div class='modal-overlay-footer clearfix'><div class=" row clearfix"><div class=' textAlignCenter col-lg-12 col-md-12 col-sm-12 '><button type='submit' class='btn btn-success saveButton' ><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button>&nbsp;&nbsp;<a class='cancelLink' type="reset"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div></div></div></form></div></div></div>

<?php }
}
