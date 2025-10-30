<?php
/* Smarty version 4.5.5, created on 2025-10-10 08:39:47
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\EmailTemplates\partials\EditViewContents.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e8c653926e88_39450930',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6c1324b7448a7855a708ff2292c2a2ca69b72e76' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\EmailTemplates\\partials\\EditViewContents.tpl',
      1 => 1758006181,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e8c653926e88_39450930 (Smarty_Internal_Template $_smarty_tpl) {
if (!empty($_smarty_tpl->tpl_vars['PICKIST_DEPENDENCY_DATASOURCE']->value)) {?><input type="hidden" name="picklistDependency" value='<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKIST_DEPENDENCY_DATASOURCE']->value);?>
' /><?php }?><div name='editContent'><div class='fieldBlockContainer'><span><h4 class='fieldBlockHeader' ><?php echo vtranslate('SINGLE_EmailTemplates',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h4></span><hr><table class="table table-borderless"><tbody><tr><td class="fieldLabel <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
 alignMiddle"><?php echo vtranslate('LBL_TEMPLATE_NAME',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<span class="redColor">*</span></td><td class="fieldValue <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><input id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_editView_fieldName_templatename" type="text" class="inputElement" data-rule-required="true" name="templatename" value="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('templatename');?>
"></td></tr><tr><td class="fieldLabel <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
 alignMiddle"><?php echo vtranslate('LBL_DESCRIPTION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td><td class="fieldValue <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><textarea class="inputElement col-lg-12" id="description" name="description"><?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('description');?>
</textarea></td></tr></tbody></table></div><div class='fieldBlockContainer'><span><h4 class='fieldBlockHeader'><?php echo vtranslate('LBL_EMAIL_TEMPLATE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate('LBL_DESCRIPTION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h4></span><hr><table class="table table-borderless"><tbody><tr><td class="fieldLabel <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><?php echo vtranslate('LBL_SELECT_FIELD_TYPE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<span class="redColor">*</span></td><td class="fieldValue <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><span class="filterContainer" ><input type=hidden name="moduleFields" data-value='<?php echo Vtiger_Functions::jsonEncode($_smarty_tpl->tpl_vars['ALL_FIELDS']->value);?>
' /><span class="col-sm-4 col-xs-4 conditionRow"><select class="inputElement select2" name="modulename" data-rule-required="true"><option value=""><?php echo vtranslate('LBL_SELECT_MODULE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ALL_FIELDS']->value, 'FIELDS', false, 'MODULENAME');
$_smarty_tpl->tpl_vars['FIELDS']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['MODULENAME']->value => $_smarty_tpl->tpl_vars['FIELDS']->value) {
$_smarty_tpl->tpl_vars['FIELDS']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['MODULENAME']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['RECORD']->value->get('module') == $_smarty_tpl->tpl_vars['MODULENAME']->value) {?>selected<?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULENAME']->value,$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></span>&nbsp;&nbsp;<span class="col-sm-6 col-xs-6"><select class="inputElement select2 col-sm-5 col-xs-5" id="templateFields" name="templateFields"><option value=""><?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option></select></span></span></td></tr><tr><td class="fieldLabel <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><?php echo vtranslate('LBL_GENERAL_FIELDS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td><td class="fieldValue <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><span class="col-sm-6 col-xs-6"><select class="inputElement select2 col-sm5 col-xs-5" id="generalFields" name="generalFields"><option value=""><?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><optgroup label="<?php echo vtranslate('LBL_COMPANY_DETAILS','Settings:Vtiger');?>
"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['COMPANY_FIELDS']->value, 'COMPANY_FIELD', false, 'index');
$_smarty_tpl->tpl_vars['COMPANY_FIELD']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['index']->value => $_smarty_tpl->tpl_vars['COMPANY_FIELD']->value) {
$_smarty_tpl->tpl_vars['COMPANY_FIELD']->do_else = false;
?><option value="<?php ob_start();
echo $_smarty_tpl->tpl_vars['COMPANY_FIELD']->value[1];
$_prefixVariable2 = ob_get_clean();
echo $_prefixVariable2;?>
"><?php echo $_smarty_tpl->tpl_vars['COMPANY_FIELD']->value[0];?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></optgroup><optgroup label="<?php echo vtranslate('LBL_GENERAL_FIELDS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['GENERAL_FIELDS']->value, 'GENERAL_FIELD', false, 'index');
$_smarty_tpl->tpl_vars['GENERAL_FIELD']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['index']->value => $_smarty_tpl->tpl_vars['GENERAL_FIELD']->value) {
$_smarty_tpl->tpl_vars['GENERAL_FIELD']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['GENERAL_FIELD']->value[1];?>
"><?php echo $_smarty_tpl->tpl_vars['GENERAL_FIELD']->value[0];?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></optgroup></select></span></td></tr><tr><td class="fieldLabel <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><?php echo vtranslate('LBL_SUBJECT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<span class="redColor">*</span></td><td class="fieldValue <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><div class="col-sm-6 col-xs-6"><input id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_editView_fieldName_subject" type="text" <?php if ($_smarty_tpl->tpl_vars['IS_SYSTEM_TEMPLATE_EDIT']->value) {?> disabled="disabled" <?php }?> class="inputElement col-lg-12" data-rule-required="true" name="subject" value="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('subject');?>
"  spellcheck="true" /></div></td></tr></tbody></table><div class="row padding-bottom1per"><?php $_smarty_tpl->_assignInScope('TEMPLATE_CONTENT', $_smarty_tpl->tpl_vars['RECORD']->value->get('body'));?><textarea id="templatecontent" name="templatecontent" <?php if ($_smarty_tpl->tpl_vars['IS_SYSTEM_TEMPLATE_EDIT']->value) {?> data-rule-required="true" <?php }?> ><?php if (!empty($_smarty_tpl->tpl_vars['TEMPLATE_CONTENT']->value)) {
echo $_smarty_tpl->tpl_vars['TEMPLATE_CONTENT']->value;
} else {
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "DefaultContentForTemplates.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}?></textarea></div></div></div><?php }
}
