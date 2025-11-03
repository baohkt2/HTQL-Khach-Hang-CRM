<?php
/* Smarty version 4.5.5, created on 2025-11-03 07:10:36
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\LayoutEditor\DuplicateHandling.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_6908556c5d2338_36111075',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '90cc4b39040dcdf2b4e0052e5d2ddb093e805183' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\LayoutEditor\\DuplicateHandling.tpl',
      1 => 1761802269,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6908556c5d2338_36111075 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="duplicateHandlingDiv padding20"><form class="duplicateHandlingForm"><input type="hidden" name="_source" value="<?php echo (isset($_smarty_tpl->tpl_vars['SOURCE']->value)) ? $_smarty_tpl->tpl_vars['SOURCE']->value : '';?>
" /><input type="hidden" name="sourceModule" value="<?php echo $_smarty_tpl->tpl_vars['SOURCE_MODULE']->value;?>
" id="sourceModule" /><input type="hidden" name="parent" value="Settings" /><input type="hidden" name="module" value="LayoutEditor" /><input type="hidden" name="action" value="Field" /><input type="hidden" name="mode" value="updateDuplicateHandling" /><div><div class="vt-default-callout vt-info-callout"><h4 class="vt-callout-header"><span class="fa fa-info-circle"></span>&nbsp; Info </h4><div class="duplicationInfoMessage"><?php echo vtranslate('LBL_DUPLICATION_INFO_MESSAGE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div></div></div><br><div class="row"><div class="col-lg-12"><div class="col-lg-2 marginTop5px"><?php echo vtranslate('LBL_DUPLICATE_CHECK',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><div><input type="hidden" class="rule" name="rule" value=""><input type="checkbox" class="duplicateCheck" data-on-color="success" data-off-color="danger" data-current-rule="<?php echo $_smarty_tpl->tpl_vars['SOURCE_MODULE_MODEL']->value->allowDuplicates;?>
" <?php if (!$_smarty_tpl->tpl_vars['SOURCE_MODULE_MODEL']->value->isFieldsDuplicateCheckAllowed()) {?>readonly="readonly"<?php }?>data-on-text="<?php echo vtranslate('LBL_YES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" data-off-text="<?php echo vtranslate('LBL_NO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" /></div></div></div><br><br><div class="duplicateHandlingContainer show col-lg-12"><div class="fieldsBlock"><div><b><?php echo vtranslate('LBL_SELECT_FIELDS_FOR_DUPLICATION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</b></div><br><select class="col-lg-7 select" id="fieldsList" multiple name="fieldIdsList[]" data-placeholder="<?php echo vtranslate('LBL_SELECT_FIELDS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" data-rule-required="true" ><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FIELDS']->value, 'FIELD_MODELS', false, 'BLOCK_LABEL');
$_smarty_tpl->tpl_vars['FIELD_MODELS']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['BLOCK_LABEL']->value => $_smarty_tpl->tpl_vars['FIELD_MODELS']->value) {
$_smarty_tpl->tpl_vars['FIELD_MODELS']->do_else = false;
?><optgroup label='<?php echo vtranslate($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value,$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
'><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FIELD_MODELS']->value, 'FIELD_MODEL', false, 'KEY');
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['KEY']->value => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value) {
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = false;
?><option <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isUniqueField()) {?>selected=""<?php }?> value=<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getId();?>
><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></optgroup><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select><div class="col-lg-5 marginTop5px marginLeftZero"><b>&nbsp;&nbsp;<?php echo vtranslate('LBL_MAX_3_FIELDS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</b></div></div><br><br><br><?php if ($_smarty_tpl->tpl_vars['SOURCE_MODULE_MODEL']->value->isSyncable) {?><div class="ruleBlock"><div><b><?php echo vtranslate('LBL_DUPLICATES_IN_SYNC_MESSAGE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</b></div><br><div><select class="select actionsList" name="syncActionId"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ACTIONS']->value, 'ACTION_NAME', false, 'ACTION_ID');
$_smarty_tpl->tpl_vars['ACTION_NAME']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ACTION_ID']->value => $_smarty_tpl->tpl_vars['ACTION_NAME']->value) {
$_smarty_tpl->tpl_vars['ACTION_NAME']->do_else = false;
?><option <?php if ($_smarty_tpl->tpl_vars['SOURCE_MODULE_MODEL']->value->syncActionForDuplicate == $_smarty_tpl->tpl_vars['ACTION_ID']->value) {?>selected=""<?php }?> value="<?php echo $_smarty_tpl->tpl_vars['ACTION_ID']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['ACTION_NAME']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select><span class="input-info-addon syncMessage"><a class="fa fa-info-circle" data-toggle="tooltip" data-html="true" data-placement="right" title="<?php echo vtranslate('LBL_SYNC_TOOLTIP_MESSAGE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></a></span></div></div><br><br><?php }?><div class="formFooter hide"><button class="btn btn-success" type="submit" name="saveButton"><strong><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button><a class="cancelLink" type="reset" data-dismiss="modal"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div></div></form></div><?php }
}
