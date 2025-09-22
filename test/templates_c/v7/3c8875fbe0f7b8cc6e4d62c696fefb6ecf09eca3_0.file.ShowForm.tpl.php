<?php
/* Smarty version 4.5.5, created on 2025-09-22 08:20:54
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Settings\Webforms\ShowForm.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68d106e6ab4a05_50643497',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3c8875fbe0f7b8cc6e4d62c696fefb6ecf09eca3' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Settings\\Webforms\\ShowForm.tpl',
      1 => 1758006205,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68d106e6ab4a05_50643497 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.replace.php','function'=>'smarty_modifier_replace',),));
?>

<div class="modal-dialog modelContainer modal-content"><?php ob_start();
echo vtranslate(('SINGLE_').($_smarty_tpl->tpl_vars['MODULE']->value),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
$_prefixVariable1 = ob_get_clean();
ob_start();
echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('name');
$_prefixVariable2 = ob_get_clean();
$_smarty_tpl->_assignInScope('HEADER_TITLE', (($_prefixVariable1).(" - ")).($_prefixVariable2));
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0, true);
?><div class="modal-body"><div class="marginBottom10px"><span><?php echo vtranslate('LBL_EMBED_THE_FOLLOWING_FORM_IN_YOUR_WEBSITE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><span class="pull-right"><a href="" id="webformCopyClipboard"><i class="fa fa-clipboard" aria-hidden="true"></i><?php echo vtranslate('LBL_COPY_TO_CLIPBOARD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a></span></div><input type="hidden" class="allowedAllFilesSize" value="<?php echo $_smarty_tpl->tpl_vars['ALLOWED_ALL_FILES_SIZE']->value;?>
"><textarea id="showFormContent" class="input-xxlarge" style="min-height:400px;width: 100%" readonly></textarea><code><pre><meta http-equiv="Content-Type" content="text/html;charset=UTF-8"><form id="__vtigerWebForm" name="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getName();?>
" action="<?php echo $_smarty_tpl->tpl_vars['ACTION_PATH']->value;?>
" method="post" accept-charset="utf-8" enctype="multipart/form-data"><input type="hidden" name="publicid" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('publicid');?>
" /><input type="hidden" name="urlencodeenable" value="1" /><input type="hidden" name="name" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getName();?>
" /><?php $_smarty_tpl->_assignInScope('IS_CAPTCHA_ENABLED', $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->isCaptchaEnabled());?><table><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['SELECTED_FIELD_MODELS_LIST']->value, 'FIELD_MODEL', false, 'FIELD_NAME');
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_NAME']->value => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value) {
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = false;
$_smarty_tpl->_assignInScope('SOURCE_MODULE', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getModuleName());
$_smarty_tpl->_assignInScope('DATA_TYPE', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType());
$_smarty_tpl->_assignInScope('HIDDEN_STATUS', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('hidden'));
$_smarty_tpl->_assignInScope('TYPE', '');?><tr><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('hidden') != 1) {?><td><label><?php ob_start();
echo $_smarty_tpl->tpl_vars['SOURCE_MODULE']->value;
$_prefixVariable3 = ob_get_clean();
echo vtranslate(decode_html($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label')),$_prefixVariable3);
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('required') == 1) {?>*<?php }?></label></td><?php }?><td><?php if (($_smarty_tpl->tpl_vars['DATA_TYPE']->value == 'picklist' || $_smarty_tpl->tpl_vars['DATA_TYPE']->value == 'multipicklist')) {
$_smarty_tpl->_assignInScope('FIELD_INFO', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo());
$_smarty_tpl->_assignInScope('PICKLIST_VALUES', $_smarty_tpl->tpl_vars['FIELD_INFO']->value['picklistvalues']);
$_smarty_tpl->_assignInScope('FIELD_INFO', Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($_smarty_tpl->tpl_vars['FIELD_INFO']->value)));
$_smarty_tpl->_assignInScope('SPECIAL_VALIDATOR', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getValidator());
$_smarty_tpl->_assignInScope('PICKLIST_NAME', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name'));
if (Settings_Webforms_Record_Model::isCustomField($_smarty_tpl->tpl_vars['FIELD_NAME']->value)) {
ob_start();
echo urlencode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'));
$_prefixVariable4=ob_get_clean();
$_smarty_tpl->_assignInScope('FIELD_LABEL', $_prefixVariable4);
ob_start();
echo smarty_modifier_replace($_smarty_tpl->tpl_vars['FIELD_LABEL']->value,' ','_');
$_prefixVariable5=ob_get_clean();
$_smarty_tpl->_assignInScope('PICKLIST_DATA_LABEL', "label:".$_prefixVariable5);
} else {
$_smarty_tpl->_assignInScope('PICKLIST_DATA_LABEL', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name'));
}
} elseif (($_smarty_tpl->tpl_vars['DATA_TYPE']->value == "salutation") || ($_smarty_tpl->tpl_vars['DATA_TYPE']->value == "string") || ($_smarty_tpl->tpl_vars['DATA_TYPE']->value == "currency") || ($_smarty_tpl->tpl_vars['DATA_TYPE']->value == "url") || ($_smarty_tpl->tpl_vars['DATA_TYPE']->value == "phone")) {
$_smarty_tpl->_assignInScope('TYPE', "text");
} elseif (($_smarty_tpl->tpl_vars['DATA_TYPE']->value == "text")) {
$_smarty_tpl->_assignInScope('TYPE', "text");?><textarea name="<?php echo urlencode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName());?>
" <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('required') == 1) {?> required<?php }
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('hidden') == 1) {?> hidden<?php }?> ><?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue');?>
</textarea><?php } elseif (($_smarty_tpl->tpl_vars['DATA_TYPE']->value == "email")) {
$_smarty_tpl->_assignInScope('TYPE', "email");
} elseif (($_smarty_tpl->tpl_vars['DATA_TYPE']->value == "image")) {
$_smarty_tpl->_assignInScope('TYPE', "image");
} elseif ((($_smarty_tpl->tpl_vars['DATA_TYPE']->value == "integer") || ($_smarty_tpl->tpl_vars['DATA_TYPE']->value == "double"))) {
$_smarty_tpl->_assignInScope('TYPE', "number");
} elseif (($_smarty_tpl->tpl_vars['DATA_TYPE']->value == "boolean")) {
$_smarty_tpl->_assignInScope('TYPE', "checkbox");
} elseif (($_smarty_tpl->tpl_vars['DATA_TYPE']->value == "date")) {
$_smarty_tpl->_assignInScope('TYPE', "date");
} elseif (($_smarty_tpl->tpl_vars['DATA_TYPE']->value == "time")) {
$_smarty_tpl->_assignInScope('TYPE', "time");
}
if ($_smarty_tpl->tpl_vars['HIDDEN_STATUS']->value == 1) {
$_smarty_tpl->_assignInScope('TYPE', 'hidden');
}
if ($_smarty_tpl->tpl_vars['DATA_TYPE']->value == 'picklist') {?><select name="<?php echo $_smarty_tpl->tpl_vars['PICKLIST_NAME']->value;?>
" data-label="<?php echo $_smarty_tpl->tpl_vars['PICKLIST_DATA_LABEL']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('required') == 1) {?> required<?php }?> <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('hidden') == 1) {?> hidden<?php }?>><option value><?php echo vtranslate('LBL_SELECT_VALUE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value, 'PICKLIST_VALUE', false, 'PICKLIST_NAME');
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_NAME']->value => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value) {
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['PICKLIST_NAME']->value;?>
" <?php if (trim(decode_html($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'))) == trim($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value)) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value;?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select><?php } elseif ($_smarty_tpl->tpl_vars['DATA_TYPE']->value == 'multipicklist') {
$_smarty_tpl->_assignInScope('FIELD_VALUE_LIST', explode(' |##| ',$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')));?><select name="<?php echo $_smarty_tpl->tpl_vars['PICKLIST_NAME']->value;?>
[]" data-label="<?php echo $_smarty_tpl->tpl_vars['PICKLIST_DATA_LABEL']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('required') == 1) {?> required<?php }?> multiple style="width: 60%;" <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('hidden') == 1) {?> hidden<?php }?>><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value, 'PICKLIST_VALUE');
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value) {
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value;?>
" <?php if (in_array(Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value),$_smarty_tpl->tpl_vars['FIELD_VALUE_LIST']->value)) {?> selected <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select><?php } elseif ($_smarty_tpl->tpl_vars['DATA_TYPE']->value == "reference") {?><input type="hidden" name="<?php echo urlencode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName());?>
" data-label="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('neutralizedFieldName');?>
" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue');?>
" /><?php $_smarty_tpl->_assignInScope('EXPLODED_FIELD_VALUES', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'explode' ][ 0 ], array( 'x',$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue') )));?><input type="<?php echo $_smarty_tpl->tpl_vars['TYPE']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getEditViewDisplayValue($_smarty_tpl->tpl_vars['EXPLODED_FIELD_VALUES']->value[1]);?>
" readonly= /><?php } elseif ($_smarty_tpl->tpl_vars['DATA_TYPE']->value == "image") {?><input type="file" name="<?php echo urlencode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName());?>
[]" data-label="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('neutralizedFieldName');?>
" <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('hidden') == 1) {?> hidden<?php }?> <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('required') == 1) {?> required<?php }?>/><?php } elseif ($_smarty_tpl->tpl_vars['DATA_TYPE']->value == "boolean") {?><input type="hidden" name="<?php echo urlencode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName());?>
" data-label="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('neutralizedFieldName');?>
" value=0 /><?php if (($_smarty_tpl->tpl_vars['HIDDEN_STATUS']->value == 1) && ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue') == "on")) {?><input type="hidden" name="<?php echo urlencode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName());?>
" data-label="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('neutralizedFieldName');?>
" value=1 checked /><?php } elseif (($_smarty_tpl->tpl_vars['HIDDEN_STATUS']->value != 1)) {?><input type="<?php echo $_smarty_tpl->tpl_vars['TYPE']->value;?>
" name="<?php echo urlencode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName());?>
" data-label="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('neutralizedFieldName');?>
" value=1 <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue') == "on") {?> checked <?php }?> <?php if (($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('required') == 1) || ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory(true))) {?> required<?php }?>/><?php }
} elseif (($_smarty_tpl->tpl_vars['DATA_TYPE']->value != "text") && ($_smarty_tpl->tpl_vars['DATA_TYPE']->value != "boolean")) {?><input type="<?php echo $_smarty_tpl->tpl_vars['TYPE']->value;?>
" name="<?php echo urlencode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName());?>
" data-label="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('neutralizedFieldName');?>
" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue');?>
" <?php if (($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('required') == 1) || ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory(true))) {?> required<?php }?> <?php if (($_smarty_tpl->tpl_vars['DATA_TYPE']->value == "double")) {?> datatype="<?php echo $_smarty_tpl->tpl_vars['DATA_TYPE']->value;?>
" step="any" <?php }?>/><?php if (($_smarty_tpl->tpl_vars['DATA_TYPE']->value == "date") && ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('hidden') != 1)) {
}
}?></td></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELDS']->value, 'DOCUMENT_FILE_FIELD');
$_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELD']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELD']->value) {
$_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELD']->do_else = false;
?><tr><td><label><?php echo $_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELD']->value['fieldlabel'];?>
 <?php if ($_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELD']->value['required']) {?>*<?php }?></label></td><td><input type="file" name="<?php echo $_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELD']->value['fieldname'];?>
" <?php if ($_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELD']->value['required']) {?>required='required'<?php }?>></td></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></table><?php if ($_smarty_tpl->tpl_vars['IS_CAPTCHA_ENABLED']->value) {?><vscript src="https://www.google.com/recaptcha/api.js" async defer></vscript><div class="g-recaptcha" data-sitekey="<?php echo $_smarty_tpl->tpl_vars['CAPTCHA_CONFIG']->value['VTIGER_RECAPTCHA_PUBLIC_KEY'];?>
" data-callback="enableSubmitBtn"></div><?php }?><input type="submit" value="Submit" ></input></form></pre></code></div><div class="modal-footer"><center><a href="#" class="cancelLink" type="reset" data-dismiss="modal"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></center></div></div>
<?php }
}
