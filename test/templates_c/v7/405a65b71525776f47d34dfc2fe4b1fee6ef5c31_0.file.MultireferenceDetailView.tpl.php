<?php
/* Smarty version 4.5.5, created on 2025-09-18 08:40:37
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Events\uitypes\MultireferenceDetailView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68cbc58577dd63_19326677',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '405a65b71525776f47d34dfc2fe4b1fee6ef5c31' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Events\\uitypes\\MultireferenceDetailView.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68cbc58577dd63_19326677 (Smarty_Internal_Template $_smarty_tpl) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RELATED_CONTACTS']->value, 'CONTACT_INFO');
$_smarty_tpl->tpl_vars['CONTACT_INFO']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['CONTACT_INFO']->value) {
$_smarty_tpl->tpl_vars['CONTACT_INFO']->do_else = false;
?><a href='<?php echo $_smarty_tpl->tpl_vars['CONTACT_INFO']->value['_model']->getDetailViewUrl();?>
' title='<?php echo vtranslate("Contacts","Contacts");?>
'> <?php echo Vtiger_Util_Helper::getRecordName($_smarty_tpl->tpl_vars['CONTACT_INFO']->value['id']);?>
</a><br><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
