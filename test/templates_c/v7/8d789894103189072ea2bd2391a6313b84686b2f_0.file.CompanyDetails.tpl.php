<?php
/* Smarty version 4.5.5, created on 2025-11-05 06:18:33
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\Vtiger\CompanyDetails.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690aec39d515a3_77372787',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8d789894103189072ea2bd2391a6313b84686b2f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\Vtiger\\CompanyDetails.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690aec39d515a3_77372787 (Smarty_Internal_Template $_smarty_tpl) {
?>

<div class=" col-lg-12 col-md-12 col-sm-12"><input type="hidden" id="supportedImageFormats" value='<?php echo ZEND_JSON::encode(Settings_Vtiger_CompanyDetails_Model::$logoSupportedFormats);?>
' /><div class="clearfix"><div class="btn-group pull-right editbutton-container"><button id="updateCompanyDetails" class="btn btn-default "><?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button></div></div><?php $_smarty_tpl->_assignInScope('WIDTHTYPE', $_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('rowheight'));?><div id="CompanyDetailsContainer" class=" detailViewContainer <?php if (!empty($_smarty_tpl->tpl_vars['ERROR_MESSAGE']->value)) {?>hide<?php }?>" ><div class="block"><div><h4><?php echo vtranslate('LBL_COMPANY_LOGO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4></div><hr><div class="blockData"><table class="table detailview-table no-border"><tbody><tr><td class="fieldLabel"><div class="companyLogo"><?php if ($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getLogoPath()) {?><img src="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getLogoPath();?>
" class="alignMiddle" style="max-width:700px;"/><?php } else {
echo vtranslate('LBL_NO_LOGO_EDIT_AND_UPLOAD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
}?></div></td></tr></tbody></table></div></div><br><div class="block"><div><h4><?php echo vtranslate('LBL_COMPANY_INFORMATION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4></div><hr><div class="blockData"><table class="table detailview-table no-border"><tbody><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getFields(), 'FIELD_TYPE', false, 'FIELD');
$_smarty_tpl->tpl_vars['FIELD_TYPE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD']->value => $_smarty_tpl->tpl_vars['FIELD_TYPE']->value) {
$_smarty_tpl->tpl_vars['FIELD_TYPE']->do_else = false;
if ($_smarty_tpl->tpl_vars['FIELD']->value != 'logoname' && $_smarty_tpl->tpl_vars['FIELD']->value != 'logo') {?><tr><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
 fieldLabel" style="width:25%"><label ><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></td><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" style="word-wrap:break-word;"><?php if ($_smarty_tpl->tpl_vars['FIELD']->value == 'address') {?> <?php echo nl2br((string) decode_html($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get($_smarty_tpl->tpl_vars['FIELD']->value)), (bool) 1);?>
 <?php } else { ?> <?php echo decode_html($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get($_smarty_tpl->tpl_vars['FIELD']->value));?>
 <?php }?></td></tr><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tbody></table></div></div></div><div class="editViewContainer"><form class="form-horizontal <?php if (empty($_smarty_tpl->tpl_vars['ERROR_MESSAGE']->value)) {?>hide<?php }?>" id="updateCompanyDetailsForm" method="post" action="index.php" enctype="multipart/form-data"><input type="hidden" name="module" value="Vtiger" /><input type="hidden" name="parent" value="Settings" /><input type="hidden" name="action" value="CompanyDetailsSave" /><div class="form-group companydetailsedit"><label class="col-sm-2 fieldLabel control-label"> <?php echo vtranslate('LBL_COMPANY_LOGO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label><div class="fieldValue col-sm-5" ><div class="company-logo-content"><img src="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getLogoPath();?>
" class="alignMiddle" style="max-width:700px;"/><br><hr><input type="file" name="logo" id="logoFile" /></div><br><div class="alert alert-info" ><?php echo vtranslate('LBL_LOGO_RECOMMENDED_MESSAGE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div></div></div><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getFields(), 'FIELD_TYPE', false, 'FIELD');
$_smarty_tpl->tpl_vars['FIELD_TYPE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD']->value => $_smarty_tpl->tpl_vars['FIELD_TYPE']->value) {
$_smarty_tpl->tpl_vars['FIELD_TYPE']->do_else = false;
if ($_smarty_tpl->tpl_vars['FIELD']->value != 'logoname' && $_smarty_tpl->tpl_vars['FIELD']->value != 'logo') {?><div class="form-group companydetailsedit"><label class="col-sm-2 fieldLabel control-label "><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
if ($_smarty_tpl->tpl_vars['FIELD']->value == 'organizationname') {?>&nbsp;<span class="redColor">*</span><?php }?></label><div class="fieldValue col-sm-5"><?php if ($_smarty_tpl->tpl_vars['FIELD']->value == 'address') {?><textarea class="form-control col-sm-6 resize-vertical" rows="2" name="<?php echo $_smarty_tpl->tpl_vars['FIELD']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get($_smarty_tpl->tpl_vars['FIELD']->value);?>
</textarea><?php } elseif ($_smarty_tpl->tpl_vars['FIELD']->value == 'website') {?><input type="text" class="inputElement" data-rule-url="true" name="<?php echo $_smarty_tpl->tpl_vars['FIELD']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get($_smarty_tpl->tpl_vars['FIELD']->value);?>
"/><?php } else { ?><input type="text" <?php if ($_smarty_tpl->tpl_vars['FIELD']->value == 'organizationname') {?> data-rule-required="true" <?php }?> class="inputElement" name="<?php echo $_smarty_tpl->tpl_vars['FIELD']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get($_smarty_tpl->tpl_vars['FIELD']->value);?>
"/><?php }?></div></div><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?><div class="modal-overlay-footer clearfix"><div class="row clearfix"><div class="textAlignCenter col-lg-12 col-md-12 col-sm-12"><button type="submit" class="btn btn-success saveButton"><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button>&nbsp;&nbsp;<a class="cancelLink" data-dismiss="modal" href="#"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div></div></div></form></div></div></div>
<?php }
}
