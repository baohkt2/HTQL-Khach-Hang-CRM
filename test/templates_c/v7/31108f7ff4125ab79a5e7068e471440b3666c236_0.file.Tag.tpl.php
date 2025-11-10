<?php
/* Smarty version 4.5.5, created on 2025-11-09 19:02:22
  from 'C:\xampp\htdocs\cusc\layouts\v7\modules\Vtiger\Tag.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_6910e53e28cde6_21597770',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '31108f7ff4125ab79a5e7068e471440b3666c236' => 
    array (
      0 => 'C:\\xampp\\htdocs\\cusc\\layouts\\v7\\modules\\Vtiger\\Tag.tpl',
      1 => 1762713639,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6910e53e28cde6_21597770 (Smarty_Internal_Template $_smarty_tpl) {
?> 
 <span class="tag <?php if ($_smarty_tpl->tpl_vars['ACTIVE']->value == true) {?> active <?php }?>" title="<?php echo $_smarty_tpl->tpl_vars['TAG_MODEL']->value->getName();?>
" data-type="<?php echo $_smarty_tpl->tpl_vars['TAG_MODEL']->value->getType();?>
" data-id="<?php echo $_smarty_tpl->tpl_vars['TAG_MODEL']->value->getId();?>
">
    <i class="activeToggleIcon fa <?php if ($_smarty_tpl->tpl_vars['ACTIVE']->value == true) {?> fa-circle-o <?php } else { ?> fa-circle <?php }?>"></i>
    <span class="tagLabel display-inline-block textOverflowEllipsis" title="<?php echo $_smarty_tpl->tpl_vars['TAG_MODEL']->value->getName();?>
"><?php echo $_smarty_tpl->tpl_vars['TAG_MODEL']->value->getName();?>
</span>
    <?php if (!$_smarty_tpl->tpl_vars['NO_EDIT']->value) {?>
        <i class="editTag fa fa-pencil"></i>
    <?php }?>
    <?php if (!$_smarty_tpl->tpl_vars['NO_DELETE']->value) {?>
        <i class="deleteTag fa fa-times"></i>
    <?php }?>
</span><?php }
}
