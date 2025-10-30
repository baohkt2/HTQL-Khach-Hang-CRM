<?php
/* Smarty version 4.5.5, created on 2025-10-19 17:21:20
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Google\ContactsSyncSettings.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68f51e10748196_80797083',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ccd4828c8be0df4ccf5568eede379980e8930ce0' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Google\\ContactsSyncSettings.tpl',
      1 => 1758006183,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68f51e10748196_80797083 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="modal-dialog modal-lg googleSettings" style="min-width: 800px;"><div class="modal-content" ><?php ob_start();
echo vtranslate('LBL_FIELD_MAPPING',$_smarty_tpl->tpl_vars['MODULE']->value);
$_prefixVariable1 = ob_get_clean();
$_smarty_tpl->_assignInScope('HEADER_TITLE', $_prefixVariable1);
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0, true);
?><form class="form-horizontal" name="contactsyncsettings"><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULENAME']->value;?>
" /><input type="hidden" name="action" value="SaveSettings" /><input type="hidden" name="sourcemodule" value="<?php echo $_smarty_tpl->tpl_vars['SOURCE_MODULE']->value;?>
" /><input id="user_field_mapping" type="hidden" name="fieldmapping" value="fieldmappings" /><input id="google_fields" type="hidden" value='<?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['GOOGLE_FIELDS']->value);?>
' /><div class="modal-body"><div class="row"><div class="col-sm-12 col-xs-12"><div class="pull-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><div class="btn-group pull-right"><button id="googlesync_addcustommapping" class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown"><span class="caret"></span>&nbsp;<?php echo vtranslate('LBL_ADD_CUSTOM_FIELD_MAPPING',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
</button><ul class="dropdown-menu dropdown-menu-left" role="menu"><li class="addCustomFieldMapping" data-type="email" data-vtigerfields='<?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['VTIGER_EMAIL_FIELDS']->value);?>
'><a><?php echo vtranslate('LBL_EMAIL',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
</a></li><li class="addCustomFieldMapping" data-type="phone" data-vtigerfields='<?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['VTIGER_PHONE_FIELDS']->value);?>
'><a><?php echo vtranslate('LBL_PHONE',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
</a></li><li class="addCustomFieldMapping" data-type="url" data-vtigerfields='<?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['VTIGER_URL_FIELDS']->value);?>
'><a><?php echo vtranslate('LBL_URL',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
</a></li><li class="divider"></li><li class="addCustomFieldMapping" data-type="custom" data-vtigerfields='<?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['VTIGER_OTHER_FIELDS']->value);?>
'><a><?php echo vtranslate('LBL_CUSTOM',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
</a></li></ul></div></div></div><div id="googlesyncfieldmapping" style="margin:15px;"><table class="table table-bordered"><thead><tr><td><b><?php echo vtranslate('APPTITLE',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
</b></td><td><b><?php echo vtranslate('EXTENTIONNAME',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
</b></td></tr></thead><tbody><tr><?php $_smarty_tpl->_assignInScope('FLDNAME', "salutationtype");?><td><?php echo vtranslate('Salutation',$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
<input type="hidden" class="vtiger_field_name" value="<?php echo $_smarty_tpl->tpl_vars['FLDNAME']->value;?>
" /></td><td><?php echo vtranslate('Name Prefix',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
<input type="hidden" class="google_field_name" value="<?php echo $_smarty_tpl->tpl_vars['GOOGLE_FIELDS']->value[$_smarty_tpl->tpl_vars['FLDNAME']->value]['name'];?>
" /></td></tr><tr><?php $_smarty_tpl->_assignInScope('FLDNAME', "firstname");?><td><?php echo vtranslate('First Name',$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
<input type="hidden" class="vtiger_field_name" value="<?php echo $_smarty_tpl->tpl_vars['FLDNAME']->value;?>
" /></td><td><?php echo vtranslate('First Name',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
<input type="hidden" class="google_field_name" value="<?php echo $_smarty_tpl->tpl_vars['GOOGLE_FIELDS']->value[$_smarty_tpl->tpl_vars['FLDNAME']->value]['name'];?>
" /></td></tr><tr><?php $_smarty_tpl->_assignInScope('FLDNAME', "lastname");?><td><?php echo vtranslate('Last Name',$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
<input type="hidden" class="vtiger_field_name" value="<?php echo $_smarty_tpl->tpl_vars['FLDNAME']->value;?>
" /></td><td><?php echo vtranslate('Last Name',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
<input type="hidden" class="google_field_name" value="<?php echo $_smarty_tpl->tpl_vars['GOOGLE_FIELDS']->value[$_smarty_tpl->tpl_vars['FLDNAME']->value]['name'];?>
" /></td></tr><tr><?php $_smarty_tpl->_assignInScope('FLDNAME', "title");?><td><?php echo vtranslate('Title',$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
<input type="hidden" class="vtiger_field_name" value="<?php echo $_smarty_tpl->tpl_vars['FLDNAME']->value;?>
" /></td><td><?php echo vtranslate('Job Title',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
<input type="hidden" class="google_field_name" value="<?php echo $_smarty_tpl->tpl_vars['GOOGLE_FIELDS']->value[$_smarty_tpl->tpl_vars['FLDNAME']->value]['name'];?>
" /></td></tr><tr><?php $_smarty_tpl->_assignInScope('FLDNAME', "account_id");?><td><?php echo vtranslate('Organization Name',$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
<input type="hidden" class="vtiger_field_name" value="<?php echo $_smarty_tpl->tpl_vars['FLDNAME']->value;?>
" /></td><td><?php echo vtranslate('Company',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
<input type="hidden" class="google_field_name" value="<?php echo $_smarty_tpl->tpl_vars['GOOGLE_FIELDS']->value['organizationname']['name'];?>
" /></td></tr><tr><?php $_smarty_tpl->_assignInScope('FLDNAME', "birthday");?><td><?php echo vtranslate('Date of Birth',$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
<input type="hidden" class="vtiger_field_name" value="<?php echo $_smarty_tpl->tpl_vars['FLDNAME']->value;?>
" /></td><td><?php echo vtranslate('Birthday',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
<input type="hidden" class="google_field_name" value="<?php echo $_smarty_tpl->tpl_vars['GOOGLE_FIELDS']->value[$_smarty_tpl->tpl_vars['FLDNAME']->value]['name'];?>
" /></td></tr><tr><?php $_smarty_tpl->_assignInScope('FLDNAME', "email");?><td><?php echo vtranslate('Email',$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
<input type="hidden" class="vtiger_field_name" value="<?php echo $_smarty_tpl->tpl_vars['FLDNAME']->value;?>
" /></td><td><input type="hidden" class="google_field_name" value="<?php echo $_smarty_tpl->tpl_vars['GOOGLE_FIELDS']->value['email']['name'];?>
" /><?php $_smarty_tpl->_assignInScope('GOOGLE_TYPES', $_smarty_tpl->tpl_vars['GOOGLE_FIELDS']->value[$_smarty_tpl->tpl_vars['FLDNAME']->value]['types']);?><select class="select2 google-type col-sm-5" data-category="email"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['GOOGLE_TYPES']->value, 'TYPE');
$_smarty_tpl->tpl_vars['TYPE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['TYPE']->value) {
$_smarty_tpl->tpl_vars['TYPE']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['TYPE']->value;?>
" <?php ob_start();
echo $_smarty_tpl->tpl_vars['FLDNAME']->value;
$_prefixVariable2 = ob_get_clean();
if ($_smarty_tpl->tpl_vars['FIELD_MAPPING']->value[$_prefixVariable2]['google_field_type'] == $_smarty_tpl->tpl_vars['TYPE']->value) {?>selected<?php }?>><?php echo vtranslate('Email',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
 (<?php echo vtranslate($_smarty_tpl->tpl_vars['TYPE']->value,$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
)</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select>&nbsp;&nbsp;<input type="text" class="google-custom-label inputElement" style="visibility:<?php if ($_smarty_tpl->tpl_vars['FIELD_MAPPING']->value[$_smarty_tpl->tpl_vars['FLDNAME']->value]['google_field_type'] != 'custom') {?>hidden<?php } else { ?>visible<?php }?>;width:40%;"value="<?php if ($_smarty_tpl->tpl_vars['FIELD_MAPPING']->value[$_smarty_tpl->tpl_vars['FLDNAME']->value]['google_field_type'] == 'custom') {
echo $_smarty_tpl->tpl_vars['FIELD_MAPPING']->value[$_smarty_tpl->tpl_vars['FLDNAME']->value]['google_custom_label'];
}?>"data-rule-required="true" /></td></tr><tr><?php $_smarty_tpl->_assignInScope('FLDNAME', "secondaryemail");?><td><?php echo vtranslate('Secondary Email',$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
<input type="hidden" class="vtiger_field_name" value="<?php echo $_smarty_tpl->tpl_vars['FLDNAME']->value;?>
" /></td><td><input type="hidden" class="google_field_name" value="<?php echo $_smarty_tpl->tpl_vars['GOOGLE_FIELDS']->value['email']['name'];?>
" /><?php $_smarty_tpl->_assignInScope('GOOGLE_TYPES', $_smarty_tpl->tpl_vars['GOOGLE_FIELDS']->value['email']['types']);?><select class="select2 google-type col-sm-5" data-category="email"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['GOOGLE_TYPES']->value, 'TYPE');
$_smarty_tpl->tpl_vars['TYPE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['TYPE']->value) {
$_smarty_tpl->tpl_vars['TYPE']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['TYPE']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['FIELD_MAPPING']->value['secondaryemail']['google_field_type'] == $_smarty_tpl->tpl_vars['TYPE']->value) {?>selected<?php }?>><?php echo vtranslate('Email',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
 (<?php echo vtranslate($_smarty_tpl->tpl_vars['TYPE']->value,$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
)</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select>&nbsp;&nbsp;<input type="text" class="google-custom-label inputElement" style="visibility:<?php if ($_smarty_tpl->tpl_vars['FIELD_MAPPING']->value[$_smarty_tpl->tpl_vars['FLDNAME']->value]['google_field_type'] != 'custom') {?>hidden<?php } else { ?>visible<?php }?>;width:40%;"value="<?php if ($_smarty_tpl->tpl_vars['FIELD_MAPPING']->value[$_smarty_tpl->tpl_vars['FLDNAME']->value]['google_field_type'] == 'custom') {
echo $_smarty_tpl->tpl_vars['FIELD_MAPPING']->value[$_smarty_tpl->tpl_vars['FLDNAME']->value]['google_custom_label'];
}?>"data-rule-required="true"/></td></tr><tr><?php $_smarty_tpl->_assignInScope('FLDNAME', "mobile");?><td><?php echo vtranslate('Mobile Phone',$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
<input type="hidden" class="vtiger_field_name" value="<?php echo $_smarty_tpl->tpl_vars['FLDNAME']->value;?>
" /></td><td><input type="hidden" class="google_field_name" value="<?php echo $_smarty_tpl->tpl_vars['GOOGLE_FIELDS']->value['phone']['name'];?>
" /><?php $_smarty_tpl->_assignInScope('GOOGLE_TYPES', $_smarty_tpl->tpl_vars['GOOGLE_FIELDS']->value['phone']['types']);?><select class="select2 stretched google-type col-sm-5" data-category="phone"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['GOOGLE_TYPES']->value, 'TYPE');
$_smarty_tpl->tpl_vars['TYPE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['TYPE']->value) {
$_smarty_tpl->tpl_vars['TYPE']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['TYPE']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['FIELD_MAPPING']->value[$_smarty_tpl->tpl_vars['FLDNAME']->value]['google_field_type'] == $_smarty_tpl->tpl_vars['TYPE']->value) {?>selected<?php }?>><?php echo vtranslate('Phone',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
 (<?php echo vtranslate($_smarty_tpl->tpl_vars['TYPE']->value,$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
)</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select>&nbsp;&nbsp;<input type="text" class="google-custom-label inputElement" style="visibility:<?php if ($_smarty_tpl->tpl_vars['FIELD_MAPPING']->value[$_smarty_tpl->tpl_vars['FLDNAME']->value]['google_field_type'] != 'custom') {?>hidden<?php } else { ?>visible<?php }?>;width:40%;"value="<?php if ($_smarty_tpl->tpl_vars['FIELD_MAPPING']->value[$_smarty_tpl->tpl_vars['FLDNAME']->value]['google_field_type'] == 'custom') {
echo $_smarty_tpl->tpl_vars['FIELD_MAPPING']->value[$_smarty_tpl->tpl_vars['FLDNAME']->value]['google_custom_label'];
}?>"data-rule-required="true"/></td></tr><tr><?php $_smarty_tpl->_assignInScope('FLDNAME', "phone");?><td><?php echo vtranslate('Office Phone',$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
<input type="hidden" class="vtiger_field_name" value="<?php echo $_smarty_tpl->tpl_vars['FLDNAME']->value;?>
" /></td><td><input type="hidden" class="google_field_name" value="<?php echo $_smarty_tpl->tpl_vars['GOOGLE_FIELDS']->value['phone']['name'];?>
" /><?php $_smarty_tpl->_assignInScope('GOOGLE_TYPES', $_smarty_tpl->tpl_vars['GOOGLE_FIELDS']->value['phone']['types']);?><select class="select2 stretched google-type col-sm-5" data-category="phone"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['GOOGLE_TYPES']->value, 'TYPE');
$_smarty_tpl->tpl_vars['TYPE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['TYPE']->value) {
$_smarty_tpl->tpl_vars['TYPE']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['TYPE']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['FIELD_MAPPING']->value[$_smarty_tpl->tpl_vars['FLDNAME']->value]['google_field_type'] == $_smarty_tpl->tpl_vars['TYPE']->value) {?>selected<?php }?>><?php echo vtranslate('Phone',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
 (<?php echo vtranslate($_smarty_tpl->tpl_vars['TYPE']->value,$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
)</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select>&nbsp;&nbsp;<input type="text" class="google-custom-label inputElement" style="visibility:<?php if ($_smarty_tpl->tpl_vars['FIELD_MAPPING']->value[$_smarty_tpl->tpl_vars['FLDNAME']->value]['google_field_type'] != 'custom') {?>hidden<?php } else { ?>visible<?php }?>;width:40%;"value="<?php if ($_smarty_tpl->tpl_vars['FIELD_MAPPING']->value[$_smarty_tpl->tpl_vars['FLDNAME']->value]['google_field_type'] == 'custom') {
echo $_smarty_tpl->tpl_vars['FIELD_MAPPING']->value[$_smarty_tpl->tpl_vars['FLDNAME']->value]['google_custom_label'];
}?>"data-rule-required="true"/></td></tr><tr><?php $_smarty_tpl->_assignInScope('FLDNAME', "homephone");?><td><?php echo vtranslate('Home Phone',$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
<input type="hidden" class="vtiger_field_name" value="<?php echo $_smarty_tpl->tpl_vars['FLDNAME']->value;?>
" /></td><td><input type="hidden" class="google_field_name" value="<?php echo $_smarty_tpl->tpl_vars['GOOGLE_FIELDS']->value['phone']['name'];?>
" /><?php $_smarty_tpl->_assignInScope('GOOGLE_TYPES', $_smarty_tpl->tpl_vars['GOOGLE_FIELDS']->value['phone']['types']);?><select class="select2 stretched google-type col-sm-5" data-category="phone"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['GOOGLE_TYPES']->value, 'TYPE');
$_smarty_tpl->tpl_vars['TYPE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['TYPE']->value) {
$_smarty_tpl->tpl_vars['TYPE']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['TYPE']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['FIELD_MAPPING']->value[$_smarty_tpl->tpl_vars['FLDNAME']->value]['google_field_type'] == $_smarty_tpl->tpl_vars['TYPE']->value) {?>selected<?php }?>><?php echo vtranslate('Phone',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
 (<?php echo vtranslate($_smarty_tpl->tpl_vars['TYPE']->value,$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
)</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select>&nbsp;&nbsp;<input type="text" class="google-custom-label inputElement" style="visibility:<?php if ($_smarty_tpl->tpl_vars['FIELD_MAPPING']->value[$_smarty_tpl->tpl_vars['FLDNAME']->value]['google_field_type'] != 'custom') {?>hidden<?php } else { ?>visible<?php }?>;width:40%;"value="<?php if ($_smarty_tpl->tpl_vars['FIELD_MAPPING']->value[$_smarty_tpl->tpl_vars['FLDNAME']->value]['google_field_type'] == 'custom') {
echo $_smarty_tpl->tpl_vars['FIELD_MAPPING']->value[$_smarty_tpl->tpl_vars['FLDNAME']->value]['google_custom_label'];
}?>"data-rule-required="true"/></td></tr><tr><?php $_smarty_tpl->_assignInScope('FLDNAME', "mailingaddress");?><td><?php echo vtranslate('Mailing Address',$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
<input type="hidden" class="vtiger_field_name" value="<?php echo $_smarty_tpl->tpl_vars['FLDNAME']->value;?>
"></td><td><input type="hidden" class="google_field_name" value="<?php echo $_smarty_tpl->tpl_vars['GOOGLE_FIELDS']->value['address']['name'];?>
" /><?php $_smarty_tpl->_assignInScope('GOOGLE_TYPES', $_smarty_tpl->tpl_vars['GOOGLE_FIELDS']->value['address']['types']);?><select class="select2 stretched google-type col-sm-5" data-category="address"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['GOOGLE_TYPES']->value, 'TYPE');
$_smarty_tpl->tpl_vars['TYPE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['TYPE']->value) {
$_smarty_tpl->tpl_vars['TYPE']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['TYPE']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['FIELD_MAPPING']->value[$_smarty_tpl->tpl_vars['FLDNAME']->value]['google_field_type'] == $_smarty_tpl->tpl_vars['TYPE']->value) {?>selected<?php }?>><?php echo vtranslate('Address',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
 (<?php echo vtranslate($_smarty_tpl->tpl_vars['TYPE']->value,$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
)</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select>&nbsp;&nbsp;<input type="text" class="google-custom-label inputElement" style="visibility:<?php if ($_smarty_tpl->tpl_vars['FIELD_MAPPING']->value[$_smarty_tpl->tpl_vars['FLDNAME']->value]['google_field_type'] != 'custom') {?>hidden<?php } else { ?>visible<?php }?>;width:40%;"value="<?php if ($_smarty_tpl->tpl_vars['FIELD_MAPPING']->value[$_smarty_tpl->tpl_vars['FLDNAME']->value]['google_field_type'] == 'custom') {
echo $_smarty_tpl->tpl_vars['FIELD_MAPPING']->value[$_smarty_tpl->tpl_vars['FLDNAME']->value]['google_custom_label'];
}?>"data-rule-required="true"/></td></tr><tr><?php $_smarty_tpl->_assignInScope('FLDNAME', "otheraddress");?><td><?php echo vtranslate('Other Address',$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
<input type="hidden" class="vtiger_field_name" value="<?php echo $_smarty_tpl->tpl_vars['FLDNAME']->value;?>
"></td><td><input type="hidden" class="google_field_name" value="<?php echo $_smarty_tpl->tpl_vars['GOOGLE_FIELDS']->value['address']['name'];?>
" /><?php $_smarty_tpl->_assignInScope('GOOGLE_TYPES', $_smarty_tpl->tpl_vars['GOOGLE_FIELDS']->value['address']['types']);?><select class="select2 stretched google-type col-sm-5" data-category="address"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['GOOGLE_TYPES']->value, 'TYPE');
$_smarty_tpl->tpl_vars['TYPE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['TYPE']->value) {
$_smarty_tpl->tpl_vars['TYPE']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['TYPE']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['FIELD_MAPPING']->value[$_smarty_tpl->tpl_vars['FLDNAME']->value]['google_field_type'] == $_smarty_tpl->tpl_vars['TYPE']->value) {?>selected<?php }?>><?php echo vtranslate('Address',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
 (<?php echo vtranslate($_smarty_tpl->tpl_vars['TYPE']->value,$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
)</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select>&nbsp;&nbsp;<input type="text" class="google-custom-label inputElement" style="visibility:<?php if ($_smarty_tpl->tpl_vars['FIELD_MAPPING']->value[$_smarty_tpl->tpl_vars['FLDNAME']->value]['google_field_type'] != 'custom') {?>hidden<?php } else { ?>visible<?php }?>;width:40%;"value="<?php if ($_smarty_tpl->tpl_vars['FIELD_MAPPING']->value[$_smarty_tpl->tpl_vars['FLDNAME']->value]['google_field_type'] == 'custom') {
echo $_smarty_tpl->tpl_vars['FIELD_MAPPING']->value[$_smarty_tpl->tpl_vars['FLDNAME']->value]['google_custom_label'];
}?>"data-rule-required="true"/></td></tr><tr><?php $_smarty_tpl->_assignInScope('FLDNAME', "description");?><td><?php echo vtranslate('Description',$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
<input type="hidden" class="vtiger_field_name" value="<?php echo $_smarty_tpl->tpl_vars['FLDNAME']->value;?>
"></td><td><?php echo vtranslate('Note',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
<input type="hidden" class="google_field_name" value="<?php echo $_smarty_tpl->tpl_vars['GOOGLE_FIELDS']->value[$_smarty_tpl->tpl_vars['FLDNAME']->value]['name'];?>
" /></td></tr><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['CUSTOM_FIELD_MAPPING']->value, 'CUSTOM_FIELD_MAP', false, 'VTIGER_FIELD_NAME');
$_smarty_tpl->tpl_vars['CUSTOM_FIELD_MAP']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['VTIGER_FIELD_NAME']->value => $_smarty_tpl->tpl_vars['CUSTOM_FIELD_MAP']->value) {
$_smarty_tpl->tpl_vars['CUSTOM_FIELD_MAP']->do_else = false;
?><tr><td><?php if ($_smarty_tpl->tpl_vars['CUSTOM_FIELD_MAP']->value['google_field_name'] == 'gd:email') {?><select class="select2 stretched vtiger_field_name col-sm-12" data-category="email"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['VTIGER_EMAIL_FIELDS']->value, 'EMAIL_FIELD_LABEL', false, 'EMAIL_FIELD_NAME');
$_smarty_tpl->tpl_vars['EMAIL_FIELD_LABEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['EMAIL_FIELD_NAME']->value => $_smarty_tpl->tpl_vars['EMAIL_FIELD_LABEL']->value) {
$_smarty_tpl->tpl_vars['EMAIL_FIELD_LABEL']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['EMAIL_FIELD_NAME']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['VTIGER_FIELD_NAME']->value == $_smarty_tpl->tpl_vars['EMAIL_FIELD_NAME']->value) {?>selected<?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['EMAIL_FIELD_LABEL']->value,$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select><?php } elseif ($_smarty_tpl->tpl_vars['CUSTOM_FIELD_MAP']->value['google_field_name'] == 'gd:phoneNumber') {?><select class="select2 stretched vtiger_field_name col-sm-12" data-category="phone"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['VTIGER_PHONE_FIELDS']->value, 'PHONE_FIELD_LABEL', false, 'PHONE_FIELD_NAME');
$_smarty_tpl->tpl_vars['PHONE_FIELD_LABEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['PHONE_FIELD_NAME']->value => $_smarty_tpl->tpl_vars['PHONE_FIELD_LABEL']->value) {
$_smarty_tpl->tpl_vars['PHONE_FIELD_LABEL']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['PHONE_FIELD_NAME']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['VTIGER_FIELD_NAME']->value == $_smarty_tpl->tpl_vars['PHONE_FIELD_NAME']->value) {?>selected<?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['PHONE_FIELD_LABEL']->value,$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select><?php } elseif ($_smarty_tpl->tpl_vars['CUSTOM_FIELD_MAP']->value['google_field_name'] == 'gContact:userDefinedField') {?><select class="select2 stretched vtiger_field_name col-sm-12" data-category="custom"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['VTIGER_OTHER_FIELDS']->value, 'OTHER_FIELD_LABEL', false, 'OTHER_FIELD_NAME');
$_smarty_tpl->tpl_vars['OTHER_FIELD_LABEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['OTHER_FIELD_NAME']->value => $_smarty_tpl->tpl_vars['OTHER_FIELD_LABEL']->value) {
$_smarty_tpl->tpl_vars['OTHER_FIELD_LABEL']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['OTHER_FIELD_NAME']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['VTIGER_FIELD_NAME']->value == $_smarty_tpl->tpl_vars['OTHER_FIELD_NAME']->value) {?>selected<?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['OTHER_FIELD_LABEL']->value,$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select><?php } elseif ($_smarty_tpl->tpl_vars['CUSTOM_FIELD_MAP']->value['google_field_name'] == 'gContact:website') {?><select class="select2 stretched vtiger_field_name col-sm-12" data-category="url"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['VTIGER_URL_FIELDS']->value, 'URL_FIELD_LABEL', false, 'URL_FIELD_NAME');
$_smarty_tpl->tpl_vars['URL_FIELD_LABEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['URL_FIELD_NAME']->value => $_smarty_tpl->tpl_vars['URL_FIELD_LABEL']->value) {
$_smarty_tpl->tpl_vars['URL_FIELD_LABEL']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['URL_FIELD_NAME']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['VTIGER_FIELD_NAME']->value == $_smarty_tpl->tpl_vars['URL_FIELD_NAME']->value) {?>selected<?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['URL_FIELD_LABEL']->value,$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select><?php }?></td><td><input type="hidden" class="google_field_name" value="<?php echo $_smarty_tpl->tpl_vars['CUSTOM_FIELD_MAP']->value['google_field_name'];?>
" /><?php if ($_smarty_tpl->tpl_vars['CUSTOM_FIELD_MAP']->value['google_field_name'] == 'gd:email') {
$_smarty_tpl->_assignInScope('GOOGLE_TYPES', $_smarty_tpl->tpl_vars['GOOGLE_FIELDS']->value['email']['types']);?><select class="select2 google-type col-sm-5" data-category="email"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['GOOGLE_TYPES']->value, 'TYPE');
$_smarty_tpl->tpl_vars['TYPE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['TYPE']->value) {
$_smarty_tpl->tpl_vars['TYPE']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['TYPE']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['CUSTOM_FIELD_MAP']->value['google_field_type'] == $_smarty_tpl->tpl_vars['TYPE']->value) {?>selected<?php }?>><?php echo vtranslate('Email',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
 (<?php echo vtranslate($_smarty_tpl->tpl_vars['TYPE']->value,$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
)</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select>&nbsp;&nbsp;<input type="text" class="google-custom-label inputElement" style="visibility:<?php if ($_smarty_tpl->tpl_vars['CUSTOM_FIELD_MAP']->value['google_field_type'] != 'custom') {?>hidden<?php } else { ?>visible<?php }?>;width:40%;"value="<?php if ($_smarty_tpl->tpl_vars['CUSTOM_FIELD_MAP']->value['google_field_type'] == 'custom') {
echo $_smarty_tpl->tpl_vars['CUSTOM_FIELD_MAP']->value['google_custom_label'];
}?>" data-rule-required="true"/><?php } elseif ($_smarty_tpl->tpl_vars['CUSTOM_FIELD_MAP']->value['google_field_name'] == 'gd:phoneNumber') {
$_smarty_tpl->_assignInScope('GOOGLE_TYPES', $_smarty_tpl->tpl_vars['GOOGLE_FIELDS']->value['phone']['types']);?><select class="select2 google-type col-sm-5" data-category="phone"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['GOOGLE_TYPES']->value, 'TYPE');
$_smarty_tpl->tpl_vars['TYPE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['TYPE']->value) {
$_smarty_tpl->tpl_vars['TYPE']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['TYPE']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['CUSTOM_FIELD_MAP']->value['google_field_type'] == $_smarty_tpl->tpl_vars['TYPE']->value) {?>selected<?php }?>><?php echo vtranslate('Phone',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
 (<?php echo vtranslate($_smarty_tpl->tpl_vars['TYPE']->value,$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
)</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select>&nbsp;&nbsp;<input type="text" class="google-custom-label inputElement" style="visibility:<?php if ($_smarty_tpl->tpl_vars['CUSTOM_FIELD_MAP']->value['google_field_type'] != 'custom') {?>hidden<?php } else { ?>visible<?php }?>;width:40%;"value="<?php if ($_smarty_tpl->tpl_vars['CUSTOM_FIELD_MAP']->value['google_field_type'] == 'custom') {
echo $_smarty_tpl->tpl_vars['CUSTOM_FIELD_MAP']->value['google_custom_label'];
}?>" data-rule-required="true"/><?php } elseif ($_smarty_tpl->tpl_vars['CUSTOM_FIELD_MAP']->value['google_field_name'] == 'gContact:userDefinedField') {?><input type="hidden" class="google-type" value="<?php echo $_smarty_tpl->tpl_vars['CUSTOM_FIELD_MAP']->value['google_field_type'];?>
"><input type="text" class="google-custom-label inputElement" value="<?php echo $_smarty_tpl->tpl_vars['CUSTOM_FIELD_MAP']->value['google_custom_label'];?>
" style="width:40%;" data-rule-required="true"/><?php } elseif ($_smarty_tpl->tpl_vars['CUSTOM_FIELD_MAP']->value['google_field_name'] == 'gContact:website') {
$_smarty_tpl->_assignInScope('GOOGLE_TYPES', $_smarty_tpl->tpl_vars['GOOGLE_FIELDS']->value['url']['types']);?><select class="select2 google-type col-sm-5" data-category="url"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['GOOGLE_TYPES']->value, 'TYPE');
$_smarty_tpl->tpl_vars['TYPE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['TYPE']->value) {
$_smarty_tpl->tpl_vars['TYPE']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['TYPE']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['CUSTOM_FIELD_MAP']->value['google_field_type'] == $_smarty_tpl->tpl_vars['TYPE']->value) {?>selected<?php }?>><?php echo vtranslate('URL',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
 (<?php echo vtranslate($_smarty_tpl->tpl_vars['TYPE']->value,$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
)</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select>&nbsp;&nbsp;<input type="text" class="google-custom-label inputElement" style="visibility:<?php if ($_smarty_tpl->tpl_vars['CUSTOM_FIELD_MAP']->value['google_field_type'] != 'custom') {?>hidden<?php } else { ?>visible<?php }?>;width:40%;"value="<?php if ($_smarty_tpl->tpl_vars['CUSTOM_FIELD_MAP']->value['google_field_type'] == 'custom') {
echo $_smarty_tpl->tpl_vars['CUSTOM_FIELD_MAP']->value['google_custom_label'];
}?>" data-rule-required="true"/><?php }?><a class="deleteCustomMapping marginTop7px pull-right"><i title="Delete" class="fa fa-trash"></i></a></td></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tbody></table><br><br><br></div><div id="scroller_wrapper" class="bottom-fixed-scroll"><div id="scroller" class="scroller-div"></div></div></div></form><div class="modal-footer "><center><?php if ($_smarty_tpl->tpl_vars['BUTTON_NAME']->value != null) {
$_smarty_tpl->_assignInScope('BUTTON_LABEL', $_smarty_tpl->tpl_vars['BUTTON_NAME']->value);
} else {
ob_start();
echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);
$_prefixVariable3 = ob_get_clean();
$_smarty_tpl->_assignInScope('BUTTON_LABEL', $_prefixVariable3);
}?><button id="save_syncsetting" class="btn btn-success" name="saveButton"><strong><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
</strong></button><a href="#" class="cancelLink" type="reset" data-dismiss="modal"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></center></div></div></div><?php }
}
