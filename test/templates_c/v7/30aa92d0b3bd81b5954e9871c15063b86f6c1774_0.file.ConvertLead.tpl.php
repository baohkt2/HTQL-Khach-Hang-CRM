<?php
/* Smarty version 4.5.5, created on 2025-10-07 09:13:05
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Leads\ConvertLead.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4d9a10edf87_99004345',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '30aa92d0b3bd81b5954e9871c15063b86f6c1774' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Leads\\ConvertLead.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4d9a10edf87_99004345 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="modal-dialog"><div id="convertLeadContainer" class='modelContainer modal-content'><?php if (!$_smarty_tpl->tpl_vars['CONVERT_LEAD_FIELDS']->value['Accounts'] && !$_smarty_tpl->tpl_vars['CONVERT_LEAD_FIELDS']->value['Contacts']) {?><input type="hidden" id="convertLeadErrorTitle" value="<?php echo vtranslate('LBL_CONVERT_ERROR_TITLE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"/><input id="convertLeadError" class="convertLeadError" type="hidden" value="<?php echo vtranslate('LBL_CONVERT_LEAD_ERROR',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"/><?php } else {
ob_start();
echo vtranslate('LBL_CONVERT_LEAD',$_smarty_tpl->tpl_vars['MODULE']->value);
$_prefixVariable1 = ob_get_clean();
ob_start();
echo $_smarty_tpl->tpl_vars['RECORD']->value->getName();
$_prefixVariable2 = ob_get_clean();
$_smarty_tpl->_assignInScope('HEADER_TITLE', (($_prefixVariable1).(" ")).($_prefixVariable2));
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0, true);
?><form class="form-horizontal" id="convertLeadForm" method="post" action="index.php"><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
"/><input type="hidden" name="view" value="SaveConvertLead"/><input type="hidden" name="record" value="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getId();?>
"/><input type="hidden" name="modules" value=''/><input type="hidden" name="imageAttachmentId" value="<?php if ((isset($_smarty_tpl->tpl_vars['IMAGE_ATTACHMENT_ID']->value))) {
echo $_smarty_tpl->tpl_vars['IMAGE_ATTACHMENT_ID']->value;
}?>" /><?php $_smarty_tpl->_assignInScope('LEAD_COMPANY_NAME', $_smarty_tpl->tpl_vars['RECORD']->value->get('company'));?><div class="modal-body accordion container-fluid" id="leadAccordion"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['CONVERT_LEAD_FIELDS']->value, 'MODULE_FIELD_MODEL', false, 'MODULE_NAME');
$_smarty_tpl->tpl_vars['MODULE_FIELD_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['MODULE_NAME']->value => $_smarty_tpl->tpl_vars['MODULE_FIELD_MODEL']->value) {
$_smarty_tpl->tpl_vars['MODULE_FIELD_MODEL']->do_else = false;
?><div class="row"><div class="col-lg-1"></div><div class="col-lg-10 moduleContent" style="border:1px solid #CCC;"><div class="accordion-group convertLeadModules"><div class="header accordion-heading"><div data-parent="#leadAccordion" data-toggle="collapse" class="accordion-toggle moduleSelection" href="#<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
_FieldInfo"><?php if ($_smarty_tpl->tpl_vars['ACCOUNT_FIELD_MODEL']->value->isMandatory()) {?><input type="hidden" id="oppAccMandatory" value=<?php echo $_smarty_tpl->tpl_vars['ACCOUNT_FIELD_MODEL']->value->isMandatory();?>
 /><?php }
if ($_smarty_tpl->tpl_vars['CONTACT_FIELD_MODEL']->value->isMandatory()) {?><input type="hidden" id="oppConMandatory" value=<?php echo $_smarty_tpl->tpl_vars['CONTACT_FIELD_MODEL']->value->isMandatory();?>
 /><?php }
if ($_smarty_tpl->tpl_vars['CONTACT_ACCOUNT_FIELD_MODEL']->value->isMandatory()) {?><input type="hidden" id="conAccMandatory" value=<?php echo $_smarty_tpl->tpl_vars['CONTACT_ACCOUNT_FIELD_MODEL']->value->isMandatory();?>
 /><?php }
$_smarty_tpl->_assignInScope('SINGLE_MODULE_NAME', "SINGLE_".((string)$_smarty_tpl->tpl_vars['MODULE_NAME']->value));?><h5><input id="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
Module" class="convertLeadModuleSelection" data-module="<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
" value="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
" type="checkbox"<?php if ($_smarty_tpl->tpl_vars['MODULE_NAME']->value == 'Contacts' || ($_smarty_tpl->tpl_vars['LEAD_COMPANY_NAME']->value != '' && $_smarty_tpl->tpl_vars['MODULE_NAME']->value == 'Accounts') || ($_smarty_tpl->tpl_vars['CONTACT_ACCOUNT_FIELD_MODEL']->value && $_smarty_tpl->tpl_vars['CONTACT_ACCOUNT_FIELD_MODEL']->value->isMandatory() && $_smarty_tpl->tpl_vars['MODULE_NAME']->value != 'Potentials')) {
if ($_smarty_tpl->tpl_vars['MODULE_NAME']->value == 'Accounts' && $_smarty_tpl->tpl_vars['CONTACT_ACCOUNT_FIELD_MODEL']->value && $_smarty_tpl->tpl_vars['CONTACT_ACCOUNT_FIELD_MODEL']->value->isMandatory()) {?> disabled="disabled" <?php }?> checked="" <?php }?>/>&nbsp;&nbsp;&nbsp;<?php echo vtranslate('LBL_CREATE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['SINGLE_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</h5></div></div><div id="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
_FieldInfo" class="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
_FieldInfo accordion-body collapse fieldInfo <?php if ($_smarty_tpl->tpl_vars['CONVERT_LEAD_FIELDS']->value['Accounts'] && $_smarty_tpl->tpl_vars['MODULE_NAME']->value == "Accounts") {?> in <?php } elseif (!$_smarty_tpl->tpl_vars['CONVERT_LEAD_FIELDS']->value['Accounts'] && $_smarty_tpl->tpl_vars['MODULE_NAME']->value == "Contacts") {?> in <?php }?>"><hr><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MODULE_FIELD_MODEL']->value, 'FIELD_MODEL');
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->value) {
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = false;
?><div class="row"><div class="fieldLabel col-lg-4"><label class='muted pull-right'><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
&nbsp;<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory() == true) {?> <span class="redColor">*</span> <?php }?></label></div><div class="fieldValue col-lg-8"><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getTemplateName() )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></div></div><br><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></div></div></div><div class="col-lg-1"></div></div><br><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?><div class="defaultFields"><div class="row"><div class="col-lg-1"></div><div class="col-lg-10" style="border:1px solid #CCC;"><div style="margin-top:20px;margin-bottom: 20px;"><div class="row"><?php $_smarty_tpl->_assignInScope('FIELD_MODEL', $_smarty_tpl->tpl_vars['ASSIGN_TO']->value);?><div class="fieldLabel col-lg-4"><label class='muted pull-right'><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
&nbsp;<span class="redColor">*</span></label></div><div class="fieldValue col-lg-8"><?php $_smarty_tpl->_subTemplateRender(vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getTemplateName(),$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></div></div><br><div class="row"><div class="fieldLabel col-lg-4"><label class='muted pull-right'><?php echo vtranslate('LBL_TRANSFER_RELATED_RECORD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></div><div class="fieldValue col-lg-8"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['CONVERT_LEAD_FIELDS']->value, 'MODULE_FIELD_MODEL', false, 'MODULE_NAME');
$_smarty_tpl->tpl_vars['MODULE_FIELD_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['MODULE_NAME']->value => $_smarty_tpl->tpl_vars['MODULE_FIELD_MODEL']->value) {
$_smarty_tpl->tpl_vars['MODULE_FIELD_MODEL']->do_else = false;
if ($_smarty_tpl->tpl_vars['MODULE_NAME']->value != 'Potentials') {?><input type="radio" id="transfer<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
" class="transferModule" name="transferModule" value="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['CONVERT_LEAD_FIELDS']->value['Contacts'] && $_smarty_tpl->tpl_vars['MODULE_NAME']->value == "Contacts") {?> checked="" <?php } elseif (!$_smarty_tpl->tpl_vars['CONVERT_LEAD_FIELDS']->value['Contacts'] && $_smarty_tpl->tpl_vars['MODULE_NAME']->value == "Accounts") {?> checked="" <?php }?>/><?php if ($_smarty_tpl->tpl_vars['MODULE_NAME']->value == 'Contacts') {?>&nbsp; <?php echo vtranslate('SINGLE_Contacts',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 &nbsp;&nbsp;<?php } else { ?>&nbsp; <?php echo vtranslate('SINGLE_Accounts',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 &nbsp;&nbsp;<?php }
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></div></div></div></div><div class="col-lg-1"></div></div><br></div></div><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( 'ModalFooter.tpl',$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></form><?php }?></div></div>
<?php }
}
