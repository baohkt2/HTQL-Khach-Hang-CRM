<?php
/* Smarty version 4.5.5, created on 2025-10-14 07:31:21
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\Leads\LeadMappingEdit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68edfc49d4e610_58069184',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4e5cb1f09d57a9eb19329ea816678d7e64bf37ce' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\Leads\\LeadMappingEdit.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68edfc49d4e610_58069184 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="leadsFieldMappingEditPageDiv"><div class="col-sm-12 col-xs-12"><div class="editViewContainer "><form id="leadsMapping" method="POST"><div class="editViewBody "><div class="editViewContents table-container" ><input type="hidden" id="restrictedFieldsList" value=<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['RESTRICTED_FIELD_IDS_LIST']->value);?>
 /><table class="table listview-table-norecords" width="100%" id="convertLeadMapping"><tbody><tr><th width="7%"></th><th width="15%"><?php echo vtranslate('LBL_FIELD_LABEL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><th width="15%"><?php echo vtranslate('LBL_FIELD_TYPE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><th colspan="3" width="70%"><?php echo vtranslate('LBL_MAPPING_WITH_OTHER_MODULES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th></tr><tr><th width="7%"><?php echo vtranslate('LBL_ACTIONS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getHeaders(), 'LABEL', false, 'key');
$_smarty_tpl->tpl_vars['LABEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['LABEL']->value) {
$_smarty_tpl->tpl_vars['LABEL']->do_else = false;
?><th width="15%"><?php echo vtranslate($_smarty_tpl->tpl_vars['LABEL']->value,$_smarty_tpl->tpl_vars['LABEL']->value);?>
</th><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tr><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getMapping(), 'MAPPING_ARRAY', false, 'MAPPING_ID', 'mappingLoop', array (
  'iteration' => true,
));
$_smarty_tpl->tpl_vars['MAPPING_ARRAY']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['MAPPING_ID']->value => $_smarty_tpl->tpl_vars['MAPPING_ARRAY']->value) {
$_smarty_tpl->tpl_vars['MAPPING_ARRAY']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_mappingLoop']->value['iteration']++;
?><tr class="listViewEntries" sequence-number="<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_mappingLoop']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_mappingLoop']->value['iteration'] : null);?>
"><td width="7%"><?php if ($_smarty_tpl->tpl_vars['MAPPING_ARRAY']->value['editable'] == 1) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getMappingLinks(), 'LINK_MODEL');
$_smarty_tpl->tpl_vars['LINK_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LINK_MODEL']->value) {
$_smarty_tpl->tpl_vars['LINK_MODEL']->do_else = false;
?><div class="table-actions"><span class="actionImages"><i title="<?php echo vtranslate($_smarty_tpl->tpl_vars['LINK_MODEL']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="fa fa-trash deleteMapping"></i></span></div><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?></td><td width="10%"><input type="hidden" name="mapping[<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_mappingLoop']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_mappingLoop']->value['iteration'] : null);?>
][mappingId]" value="<?php echo $_smarty_tpl->tpl_vars['MAPPING_ID']->value;?>
"/><select class="leadsFields select2 col-sm-12" name="mapping[<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_mappingLoop']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_mappingLoop']->value['iteration'] : null);?>
][lead]" <?php if ($_smarty_tpl->tpl_vars['MAPPING_ARRAY']->value['editable'] == 0) {?> disabled <?php }?>><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LEADS_MODULE_MODEL']->value->getFields(), 'FIELDS_INFO', false, 'FIELD_TYPE');
$_smarty_tpl->tpl_vars['FIELDS_INFO']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_TYPE']->value => $_smarty_tpl->tpl_vars['FIELDS_INFO']->value) {
$_smarty_tpl->tpl_vars['FIELDS_INFO']->do_else = false;
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FIELDS_INFO']->value, 'FIELD_OBJECT', false, 'FIELD_ID');
$_smarty_tpl->tpl_vars['FIELD_OBJECT']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_ID']->value => $_smarty_tpl->tpl_vars['FIELD_OBJECT']->value) {
$_smarty_tpl->tpl_vars['FIELD_OBJECT']->do_else = false;
?><option data-type="<?php echo $_smarty_tpl->tpl_vars['FIELD_TYPE']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['FIELD_ID']->value == $_smarty_tpl->tpl_vars['MAPPING_ARRAY']->value['Leads']['id']) {?> selected <?php }?> label="<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_OBJECT']->value->get('label'),$_smarty_tpl->tpl_vars['LEADS_MODULE_MODEL']->value->getName());?>
" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_ID']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_OBJECT']->value->get('label'),$_smarty_tpl->tpl_vars['LEADS_MODULE_MODEL']->value->getName());?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></td><td width="10%" class="selectedFieldDataType"><?php echo vtranslate($_smarty_tpl->tpl_vars['MAPPING_ARRAY']->value['Leads']['fieldDataType'],$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</td><td width="10%"><select class="accountsFields select2 col-sm-12" name="mapping[<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_mappingLoop']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_mappingLoop']->value['iteration'] : null);?>
][account]" <?php if ($_smarty_tpl->tpl_vars['MAPPING_ARRAY']->value['editable'] == 0) {?> disabled <?php }?>><option data-type="<?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" value="0" label="<?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"><?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ACCOUNTS_MODULE_MODEL']->value->getFields(), 'FIELDS_INFO', false, 'FIELD_TYPE');
$_smarty_tpl->tpl_vars['FIELDS_INFO']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_TYPE']->value => $_smarty_tpl->tpl_vars['FIELDS_INFO']->value) {
$_smarty_tpl->tpl_vars['FIELDS_INFO']->do_else = false;
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FIELDS_INFO']->value, 'FIELD_OBJECT', false, 'FIELD_ID');
$_smarty_tpl->tpl_vars['FIELD_OBJECT']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_ID']->value => $_smarty_tpl->tpl_vars['FIELD_OBJECT']->value) {
$_smarty_tpl->tpl_vars['FIELD_OBJECT']->do_else = false;
if ($_smarty_tpl->tpl_vars['MAPPING_ARRAY']->value['Leads']['fieldDataType'] == $_smarty_tpl->tpl_vars['FIELD_TYPE']->value) {?><option data-type="<?php echo $_smarty_tpl->tpl_vars['FIELD_TYPE']->value;?>
" <?php if ((isset($_smarty_tpl->tpl_vars['MAPPING_ARRAY']->value['Accounts']['id'])) && $_smarty_tpl->tpl_vars['FIELD_ID']->value == $_smarty_tpl->tpl_vars['MAPPING_ARRAY']->value['Accounts']['id']) {?> selected <?php }?> label="<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_OBJECT']->value->get('label'),$_smarty_tpl->tpl_vars['ACCOUNTS_MODULE_MODEL']->value->getName());?>
" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_ID']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_OBJECT']->value->get('label'),$_smarty_tpl->tpl_vars['ACCOUNTS_MODULE_MODEL']->value->getName());?>
</option><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></td><td width="10%"><select class="contactFields select2 col-sm-12" name="mapping[<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_mappingLoop']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_mappingLoop']->value['iteration'] : null);?>
][contact]" <?php if ($_smarty_tpl->tpl_vars['MAPPING_ARRAY']->value['editable'] == 0) {?> disabled <?php }?>><option data-type="<?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" value="0" label="<?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"><?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['CONTACTS_MODULE_MODEL']->value->getFields(), 'FIELDS_INFO', false, 'FIELD_TYPE');
$_smarty_tpl->tpl_vars['FIELDS_INFO']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_TYPE']->value => $_smarty_tpl->tpl_vars['FIELDS_INFO']->value) {
$_smarty_tpl->tpl_vars['FIELDS_INFO']->do_else = false;
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FIELDS_INFO']->value, 'FIELD_OBJECT', false, 'FIELD_ID');
$_smarty_tpl->tpl_vars['FIELD_OBJECT']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_ID']->value => $_smarty_tpl->tpl_vars['FIELD_OBJECT']->value) {
$_smarty_tpl->tpl_vars['FIELD_OBJECT']->do_else = false;
if ($_smarty_tpl->tpl_vars['MAPPING_ARRAY']->value['Leads']['fieldDataType'] == $_smarty_tpl->tpl_vars['FIELD_TYPE']->value) {?><option data-type="<?php echo $_smarty_tpl->tpl_vars['FIELD_TYPE']->value;?>
" <?php if ((isset($_smarty_tpl->tpl_vars['MAPPING_ARRAY']->value['Contacts']['id'])) && $_smarty_tpl->tpl_vars['FIELD_ID']->value == $_smarty_tpl->tpl_vars['MAPPING_ARRAY']->value['Contacts']['id']) {?> selected <?php }?> label="<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_OBJECT']->value->get('label'),$_smarty_tpl->tpl_vars['CONTACTS_MODULE_MODEL']->value->getName());?>
" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_ID']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_OBJECT']->value->get('label'),$_smarty_tpl->tpl_vars['CONTACTS_MODULE_MODEL']->value->getName());?>
</option><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></td><td width="10%"><select class="potentialFields select2 col-sm-12" name="mapping[<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_mappingLoop']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_mappingLoop']->value['iteration'] : null);?>
][potential]" <?php if ($_smarty_tpl->tpl_vars['MAPPING_ARRAY']->value['editable'] == 0) {?> disabled <?php }?>><option data-type="<?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" value="0" label="<?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"><?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['POTENTIALS_MODULE_MODEL']->value->getFields(), 'FIELDS_INFO', false, 'FIELD_TYPE');
$_smarty_tpl->tpl_vars['FIELDS_INFO']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_TYPE']->value => $_smarty_tpl->tpl_vars['FIELDS_INFO']->value) {
$_smarty_tpl->tpl_vars['FIELDS_INFO']->do_else = false;
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FIELDS_INFO']->value, 'FIELD_OBJECT', false, 'FIELD_ID');
$_smarty_tpl->tpl_vars['FIELD_OBJECT']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_ID']->value => $_smarty_tpl->tpl_vars['FIELD_OBJECT']->value) {
$_smarty_tpl->tpl_vars['FIELD_OBJECT']->do_else = false;
if ($_smarty_tpl->tpl_vars['MAPPING_ARRAY']->value['Leads']['fieldDataType'] == $_smarty_tpl->tpl_vars['FIELD_TYPE']->value) {?><option data-type="<?php echo $_smarty_tpl->tpl_vars['FIELD_TYPE']->value;?>
" <?php if ((isset($_smarty_tpl->tpl_vars['MAPPING_ARRAY']->value['Potentials']['id'])) && $_smarty_tpl->tpl_vars['FIELD_ID']->value == $_smarty_tpl->tpl_vars['MAPPING_ARRAY']->value['Potentials']['id']) {?> selected <?php }?> label="<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_OBJECT']->value->get('label'),$_smarty_tpl->tpl_vars['POTENTIALS_MODULE_MODEL']->value->getName());?>
" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_ID']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_OBJECT']->value->get('label'),$_smarty_tpl->tpl_vars['POTENTIALS_MODULE_MODEL']->value->getName());?>
</option><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></td></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?><tr class="hide newMapping listViewEntries"><td width="5%"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getMappingLinks(), 'LINK_MODEL');
$_smarty_tpl->tpl_vars['LINK_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LINK_MODEL']->value) {
$_smarty_tpl->tpl_vars['LINK_MODEL']->do_else = false;
?><div class="table-actions"><span class="actionImages"><i title="<?php echo vtranslate($_smarty_tpl->tpl_vars['LINK_MODEL']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="fa fa-trash deleteMapping"></i></span></div><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></td><td width="10%"><select class="leadsFields newSelect col-sm-12"><option data-type="<?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" value="0" label="<?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"><?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LEADS_MODULE_MODEL']->value->getFields(), 'FIELDS_INFO', false, 'FIELD_TYPE');
$_smarty_tpl->tpl_vars['FIELDS_INFO']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_TYPE']->value => $_smarty_tpl->tpl_vars['FIELDS_INFO']->value) {
$_smarty_tpl->tpl_vars['FIELDS_INFO']->do_else = false;
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FIELDS_INFO']->value, 'FIELD_OBJECT', false, 'FIELD_ID');
$_smarty_tpl->tpl_vars['FIELD_OBJECT']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_ID']->value => $_smarty_tpl->tpl_vars['FIELD_OBJECT']->value) {
$_smarty_tpl->tpl_vars['FIELD_OBJECT']->do_else = false;
?><option data-type="<?php echo $_smarty_tpl->tpl_vars['FIELD_TYPE']->value;?>
" label="<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_OBJECT']->value->get('label'),$_smarty_tpl->tpl_vars['LEADS_MODULE_MODEL']->value->getName());?>
" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_ID']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_OBJECT']->value->get('label'),$_smarty_tpl->tpl_vars['LEADS_MODULE_MODEL']->value->getName());?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></td><td width="10%" class="selectedFieldDataType"></td><td width="10%"><select class="accountsFields newSelect col-sm-12"><option data-type="<?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" label="<?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" value="0"><?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ACCOUNTS_MODULE_MODEL']->value->getFields(), 'FIELDS_INFO', false, 'FIELD_TYPE');
$_smarty_tpl->tpl_vars['FIELDS_INFO']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_TYPE']->value => $_smarty_tpl->tpl_vars['FIELDS_INFO']->value) {
$_smarty_tpl->tpl_vars['FIELDS_INFO']->do_else = false;
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FIELDS_INFO']->value, 'FIELD_OBJECT', false, 'FIELD_ID');
$_smarty_tpl->tpl_vars['FIELD_OBJECT']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_ID']->value => $_smarty_tpl->tpl_vars['FIELD_OBJECT']->value) {
$_smarty_tpl->tpl_vars['FIELD_OBJECT']->do_else = false;
?><option data-type="<?php echo $_smarty_tpl->tpl_vars['FIELD_TYPE']->value;?>
" label="<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_OBJECT']->value->get('label'),$_smarty_tpl->tpl_vars['ACCOUNTS_MODULE_MODEL']->value->getName());?>
" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_ID']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_OBJECT']->value->get('label'),$_smarty_tpl->tpl_vars['ACCOUNTS_MODULE_MODEL']->value->getName());?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></td><td width="10%"><select class="contactFields newSelect col-sm-12"><option data-type="<?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" label="<?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" value="0"><?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['CONTACTS_MODULE_MODEL']->value->getFields(), 'FIELDS_INFO', false, 'FIELD_TYPE');
$_smarty_tpl->tpl_vars['FIELDS_INFO']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_TYPE']->value => $_smarty_tpl->tpl_vars['FIELDS_INFO']->value) {
$_smarty_tpl->tpl_vars['FIELDS_INFO']->do_else = false;
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FIELDS_INFO']->value, 'FIELD_OBJECT', false, 'FIELD_ID');
$_smarty_tpl->tpl_vars['FIELD_OBJECT']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_ID']->value => $_smarty_tpl->tpl_vars['FIELD_OBJECT']->value) {
$_smarty_tpl->tpl_vars['FIELD_OBJECT']->do_else = false;
?><option data-type="<?php echo $_smarty_tpl->tpl_vars['FIELD_TYPE']->value;?>
" label="<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_OBJECT']->value->get('label'),$_smarty_tpl->tpl_vars['CONTACTS_MODULE_MODEL']->value->getName());?>
" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_ID']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_OBJECT']->value->get('label'),$_smarty_tpl->tpl_vars['CONTACTS_MODULE_MODEL']->value->getName());?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></td><td width="10%"><select class="potentialFields newSelect col-sm-12"><option data-type="<?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" label="<?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" value="0"><?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['POTENTIALS_MODULE_MODEL']->value->getFields(), 'FIELDS_INFO', false, 'FIELD_TYPE');
$_smarty_tpl->tpl_vars['FIELDS_INFO']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_TYPE']->value => $_smarty_tpl->tpl_vars['FIELDS_INFO']->value) {
$_smarty_tpl->tpl_vars['FIELDS_INFO']->do_else = false;
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FIELDS_INFO']->value, 'FIELD_OBJECT', false, 'FIELD_ID');
$_smarty_tpl->tpl_vars['FIELD_OBJECT']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_ID']->value => $_smarty_tpl->tpl_vars['FIELD_OBJECT']->value) {
$_smarty_tpl->tpl_vars['FIELD_OBJECT']->do_else = false;
?><option data-type="<?php echo $_smarty_tpl->tpl_vars['FIELD_TYPE']->value;?>
" label="<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_OBJECT']->value->get('label'),$_smarty_tpl->tpl_vars['POTENTIALS_MODULE_MODEL']->value->getName());?>
" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_ID']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_OBJECT']->value->get('label'),$_smarty_tpl->tpl_vars['POTENTIALS_MODULE_MODEL']->value->getName());?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></td></tr></tbody></table><div class="row"><span class="col-sm-4"><button id="addMapping" class="btn addButton module-buttons" type="button" style="margin-left: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo vtranslate('LBL_ADD_MAPPING',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button></span></div></div><div class='modal-overlay-footer clearfix'><div class="row clearfix"><div class='textAlignCenter col-lg-12 col-md-12 col-sm-12 '><button type='submit' class='btn btn-success saveButton' ><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button>&nbsp;&nbsp;<a class="cancelLink" type="reset" href="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getDetailViewUrl();?>
"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div></div></div></div></form></div></div></div><?php }
}
