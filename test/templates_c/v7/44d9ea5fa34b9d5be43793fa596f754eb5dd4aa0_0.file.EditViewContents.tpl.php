<?php
/* Smarty version 4.5.5, created on 2025-09-19 07:59:31
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Inventory\partials\EditViewContents.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68cd0d63cf2775_53238155',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '44d9ea5fa34b9d5be43793fa596f754eb5dd4aa0' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Inventory\\partials\\EditViewContents.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68cd0d63cf2775_53238155 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
if (!empty($_smarty_tpl->tpl_vars['PICKIST_DEPENDENCY_DATASOURCE']->value)) {?><input type="hidden" name="picklistDependency" value='<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKIST_DEPENDENCY_DATASOURCE']->value);?>
' /><?php }?><div name='editContent'><?php if ($_smarty_tpl->tpl_vars['DUPLICATE_RECORDS']->value) {?><div class="fieldBlockContainer duplicationMessageContainer"><div class="duplicationMessageHeader"><b><?php echo vtranslate('LBL_DUPLICATES_DETECTED',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</b></div><div><?php echo getDuplicatesPreventionMessage($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['DUPLICATE_RECORDS']->value);?>
</div></div><?php }
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value, 'BLOCK_FIELDS', false, 'BLOCK_LABEL', 'blockIterator', array (
));
$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['BLOCK_LABEL']->value => $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value) {
$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->do_else = false;
if ($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value == 'LBL_ITEM_DETAILS') {
continue 1;
}
if (smarty_modifier_count($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value) > 0) {?><div class='fieldBlockContainer' data-block="<?php echo $_smarty_tpl->tpl_vars['BLOCK_LABEL']->value;?>
"><h4 class='fieldBlockHeader'><?php echo vtranslate($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h4><hr><table class="table table-borderless <?php if ($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value == 'LBL_ADDRESS_INFORMATION') {?> addressBlock<?php }?>"><?php if (($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value == 'LBL_ADDRESS_INFORMATION') && ($_smarty_tpl->tpl_vars['MODULE']->value != 'PurchaseOrder')) {?><tr><td class="fieldLabel " name="copyHeader1"><label name="togglingHeader"><?php echo vtranslate('LBL_BILLING_ADDRESS_FROM',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td class="fieldValue" name="copyAddress1"><div class="radio"><label><input type="radio" name="copyAddressFromRight" class="accountAddress" data-copy-address="billing" checked="checked">&nbsp;<?php echo vtranslate('SINGLE_Accounts',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></div><div class="radio"><label><?php if ($_smarty_tpl->tpl_vars['MODULE']->value == 'Quotes') {?><input type="radio" name="copyAddressFromRight" class="contactAddress" data-copy-address="billing" checked="checked">&nbsp;<?php echo vtranslate('Related To',$_smarty_tpl->tpl_vars['MODULE']->value);
} else { ?><input type="radio" name="copyAddressFromRight" class="contactAddress" data-copy-address="billing" checked="checked">&nbsp;<?php echo vtranslate('SINGLE_Contacts',$_smarty_tpl->tpl_vars['MODULE']->value);
}?></label></div><div class="radio" name="togglingAddressContainerRight"><label><input type="radio" name="copyAddressFromRight" class="shippingAddress" data-target="shipping" checked="checked">&nbsp;<?php echo vtranslate('Shipping Address',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></div><div class="radio hide" name="togglingAddressContainerLeft"><label><input type="radio" name="copyAddressFromRight" class="billingAddress" data-target="billing" checked="checked">&nbsp;<?php echo vtranslate('Billing Address',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></div></td><td class="fieldLabel" name="copyHeader2"><label name="togglingHeader"><?php echo vtranslate('LBL_SHIPPING_ADDRESS_FROM',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td class="fieldValue" name="copyAddress2"><div class="radio"><label><input type="radio" name="copyAddressFromLeft" class="accountAddress" data-copy-address="shipping" checked="checked">&nbsp;<?php echo vtranslate('SINGLE_Accounts',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></div><div class="radio"><label><?php if ($_smarty_tpl->tpl_vars['MODULE']->value == 'Quotes') {?><input type="radio" name="copyAddressFromLeft" class="contactAddress" data-copy-address="shipping" checked="checked">&nbsp;<?php echo vtranslate('Related To',$_smarty_tpl->tpl_vars['MODULE']->value);
} else { ?><input type="radio" name="copyAddressFromLeft" class="contactAddress" data-copy-address="shipping" checked="checked">&nbsp;<?php echo vtranslate('SINGLE_Contacts',$_smarty_tpl->tpl_vars['MODULE']->value);
}?></label></div><div class="radio" name="togglingAddressContainerLeft"><label><input type="radio" name="copyAddressFromLeft" class="billingAddress" data-target="billing" checked="checked">&nbsp;<?php echo vtranslate('Billing Address',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></div><div class="radio hide" name="togglingAddressContainerRight"><label><input type="radio" name="copyAddressFromLeft" class="shippingAddress" data-target="shipping" checked="checked">&nbsp;<?php echo vtranslate('Shipping Address',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></div></td></tr><?php }?><tr><?php $_smarty_tpl->_assignInScope('COUNTER', 0);
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value, 'FIELD_MODEL', false, 'FIELD_NAME', 'blockfields', array (
));
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_NAME']->value => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value) {
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = false;
$_smarty_tpl->_assignInScope('isReferenceField', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType());
$_smarty_tpl->_assignInScope('refrenceList', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getReferenceList());
$_smarty_tpl->_assignInScope('refrenceListCount', php7_count($_smarty_tpl->tpl_vars['refrenceList']->value));
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isEditable() == true) {
if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype') == "19") {
if ($_smarty_tpl->tpl_vars['COUNTER']->value == '1') {?><td></td><td></td></tr><tr><?php $_smarty_tpl->_assignInScope('COUNTER', 0);
}
}
if ($_smarty_tpl->tpl_vars['COUNTER']->value == 2) {?></tr><tr><?php $_smarty_tpl->_assignInScope('COUNTER', 1);
} else {
$_smarty_tpl->_assignInScope('COUNTER', $_smarty_tpl->tpl_vars['COUNTER']->value+1);
}?><td class="fieldLabel alignMiddle"><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory() == true) {?> <span class="redColor">*</span> <?php }
if ($_smarty_tpl->tpl_vars['isReferenceField']->value == "reference") {
if ($_smarty_tpl->tpl_vars['refrenceListCount']->value > 1) {
$_smarty_tpl->_assignInScope('REFERENCED_MODULE_ID', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'));
$_smarty_tpl->_assignInScope('REFERENCED_MODULE_STRUCTURE', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getReferenceModule($_smarty_tpl->tpl_vars['REFERENCED_MODULE_ID']->value));
if (!empty($_smarty_tpl->tpl_vars['REFERENCED_MODULE_STRUCTURE']->value)) {
$_smarty_tpl->_assignInScope('REFERENCED_MODULE_NAME', $_smarty_tpl->tpl_vars['REFERENCED_MODULE_STRUCTURE']->value->get('name'));
}?><select style="width: 140px;" class="select2 referenceModulesList"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['refrenceList']->value, 'value', false, 'index');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['index']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['value']->value == $_smarty_tpl->tpl_vars['REFERENCED_MODULE_NAME']->value) {?> selected <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['value']->value,$_smarty_tpl->tpl_vars['value']->value);?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select><?php } else {
echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE']->value);
}
} else {
echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE']->value);
}?>&nbsp;&nbsp;</td><td <?php if (in_array($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype'),array('19','69')) || $_smarty_tpl->tpl_vars['FIELD_NAME']->value == 'description') {?> class="fieldValue fieldValueWidth80" colspan="3" <?php $_smarty_tpl->_assignInScope('COUNTER', $_smarty_tpl->tpl_vars['COUNTER']->value+1);?> <?php } else { ?> class="fieldValue" <?php }?>><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType() == 'image' || $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType() == 'file') {?><div class='col-lg-4 col-md-4 redColor'><?php echo vtranslate('LBL_NOTE_EXISTING_ATTACHMENTS_WILL_BE_REPLACED',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</div><?php }
$_smarty_tpl->_subTemplateRender(vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getTemplateName(),$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></td><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
if ((1 & $_smarty_tpl->tpl_vars['COUNTER']->value)) {?><td></td><td></td><?php }?></tr></table></div><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></div><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "partials/LineItemsEdit.tpl",'Inventory' )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
}
