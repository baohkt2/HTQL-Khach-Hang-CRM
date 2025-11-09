<?php
/* Smarty version 4.5.5, created on 2025-11-03 07:37:05
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Import\ImportBasicStep.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_69085ba15150d5_13361599',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ffb569844c51b710247cac6611de035461f620e3' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Import\\ImportBasicStep.tpl',
      1 => 1761802268,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69085ba15150d5_13361599 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class='fc-overlay-modal modal-content'><div class="overlayHeader"><?php ob_start();
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_IMPORT',$_smarty_tpl->tpl_vars['MODULE']->value ));
$_prefixVariable1=ob_get_clean();
ob_start();
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( $_smarty_tpl->tpl_vars['FOR_MODULE']->value,$_smarty_tpl->tpl_vars['FOR_MODULE']->value ));
$_prefixVariable2=ob_get_clean();
$_smarty_tpl->_assignInScope('TITLE', $_prefixVariable1." ".$_prefixVariable2);
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('TITLE'=>$_smarty_tpl->tpl_vars['TITLE']->value), 0, true);
?></div><div class="importview-content"><form onsubmit="" action="index.php" enctype="multipart/form-data" method="POST" name="importBasic"><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['FOR_MODULE']->value;?>
" /><input type="hidden" name="view" value="Import" /><input type="hidden" name="mode" value="uploadAndParse" /><input type="hidden" id="auto_merge" name="auto_merge" value="0"/><div class='modal-body' id ="importContainer"><?php $_smarty_tpl->_assignInScope('LABELS', array());
if ($_smarty_tpl->tpl_vars['FORMAT']->value == 'vcf') {
$_tmp_array = isset($_smarty_tpl->tpl_vars['LABELS']) ? $_smarty_tpl->tpl_vars['LABELS']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array["step1"] = 'LBL_UPLOAD_VCF';
$_smarty_tpl->_assignInScope('LABELS', $_tmp_array);
} elseif ($_smarty_tpl->tpl_vars['FORMAT']->value == 'ics') {
$_tmp_array = isset($_smarty_tpl->tpl_vars['LABELS']) ? $_smarty_tpl->tpl_vars['LABELS']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array["step1"] = 'LBL_UPLOAD_ICS';
$_smarty_tpl->_assignInScope('LABELS', $_tmp_array);
} else {
$_tmp_array = isset($_smarty_tpl->tpl_vars['LABELS']) ? $_smarty_tpl->tpl_vars['LABELS']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array["step1"] = 'LBL_UPLOAD_CSV';
$_smarty_tpl->_assignInScope('LABELS', $_tmp_array);
}
if ($_smarty_tpl->tpl_vars['FORMAT']->value != 'ics') {
if ((isset($_smarty_tpl->tpl_vars['DUPLICATE_HANDLING_NOT_SUPPORTED']->value)) && $_smarty_tpl->tpl_vars['DUPLICATE_HANDLING_NOT_SUPPORTED']->value == 'true') {
$_tmp_array = isset($_smarty_tpl->tpl_vars['LABELS']) ? $_smarty_tpl->tpl_vars['LABELS']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array["step3"] = 'LBL_FIELD_MAPPING';
$_smarty_tpl->_assignInScope('LABELS', $_tmp_array);
} else {
$_tmp_array = isset($_smarty_tpl->tpl_vars['LABELS']) ? $_smarty_tpl->tpl_vars['LABELS']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array["step2"] = 'LBL_DUPLICATE_HANDLING';
$_smarty_tpl->_assignInScope('LABELS', $_tmp_array);
$_tmp_array = isset($_smarty_tpl->tpl_vars['LABELS']) ? $_smarty_tpl->tpl_vars['LABELS']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array["step3"] = 'LBL_FIELD_MAPPING';
$_smarty_tpl->_assignInScope('LABELS', $_tmp_array);
}
}
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "BreadCrumbs.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('BREADCRUMB_ID'=>'navigation_links','ACTIVESTEP'=>1,'BREADCRUMB_LABELS'=>$_smarty_tpl->tpl_vars['LABELS']->value,'MODULE'=>$_smarty_tpl->tpl_vars['MODULE']->value), 0, true);
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( 'ImportStepOne.tpl','Import' )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
if ($_smarty_tpl->tpl_vars['FORMAT']->value != 'ics') {
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( 'ImportStepTwo.tpl','Import' )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}?></div></form></div><div class='modal-overlay-footer border1px clearfix'><div class="row clearfix"><div class='textAlignCenter col-lg-12 col-md-12 col-sm-12 '><?php if ($_smarty_tpl->tpl_vars['FORMAT']->value == 'ics') {?><button type="submit" name="import" id="importButton" class="btn btn-success btn-lg" onclick="return Calendar_Edit_Js.uploadAndParse();"><?php echo vtranslate('LBL_IMPORT_BUTTON_LABEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button>&nbsp;&nbsp;&nbsp;<a class="cancelLink" data-dismiss="modal" href="#"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a><?php } else { ?><div id="importStepOneButtonsDiv"><?php if ((isset($_smarty_tpl->tpl_vars['DUPLICATE_HANDLING_NOT_SUPPORTED']->value)) && $_smarty_tpl->tpl_vars['DUPLICATE_HANDLING_NOT_SUPPORTED']->value == 'true') {?><button class="btn btn-success btn-lg" id="skipDuplicateMerge" onclick="Vtiger_Import_Js.uploadAndParse('0');"><?php echo vtranslate('LBL_NEXT_BUTTON_LABEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button><?php } else { ?><button class="btn btn-success btn-lg" id ="importStep2" onclick="Vtiger_Import_Js.importActionStep2();"><?php echo vtranslate('LBL_NEXT_BUTTON_LABEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button><?php }?>&nbsp;&nbsp;&nbsp;<a class='cancelLink' onclick="Vtiger_Import_Js.loadListRecords();" data-dismiss="modal" href="#"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div><div id="importStepTwoButtonsDiv" class = "hide"><button class="btn btn-default btn-lg" id="backToStep1" onclick="Vtiger_Import_Js.bactToStep1();"><?php echo vtranslate('LBL_BACK',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button>&nbsp;&nbsp;&nbsp;<button name="next" class="btn btn-success btn-lg" id="uploadAndParse" onclick="Vtiger_Import_Js.uploadAndParse('1');"><?php echo vtranslate('LBL_NEXT_BUTTON_LABEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button>&nbsp;&nbsp;&nbsp;<button class="btn btn-primary btn-lg" id="skipDuplicateMerge" onclick="Vtiger_Import_Js.uploadAndParse('0');"><?php echo vtranslate('Skip this step',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button>&nbsp;&nbsp;&nbsp;<a class='cancelLink' data-dismiss="modal" href="#"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div><?php }?></div></div></div></div>
<?php }
}
