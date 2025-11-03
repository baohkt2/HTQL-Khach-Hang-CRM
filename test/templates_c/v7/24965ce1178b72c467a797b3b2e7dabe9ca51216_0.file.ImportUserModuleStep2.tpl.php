<?php
/* Smarty version 4.5.5, created on 2025-10-30 06:58:31
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\ModuleManager\ImportUserModuleStep2.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_69030c97590fd9_55364965',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '24965ce1178b72c467a797b3b2e7dabe9ca51216' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\ModuleManager\\ImportUserModuleStep2.tpl',
      1 => 1761802269,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69030c97590fd9_55364965 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container-fluid" id="importModules"><div><div class="row"><div id="vtlib_modulemanager_import_div"><?php if ((isset($_smarty_tpl->tpl_vars['MODULEIMPORT_FAILED']->value)) && $_smarty_tpl->tpl_vars['MODULEIMPORT_FAILED']->value != '') {?><div class="col-lg-2"></div><div class="col-lg-10"><b><?php echo vtranslate('LBL_FAILED',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</b></div><div class="col-lg-2"></div><div class="col-lg-10"><?php if ($_smarty_tpl->tpl_vars['VERSION_NOT_SUPPORTED']->value == 'true') {?><font color=red><b><?php echo vtranslate('LBL_VERSION_NOT_SUPPORTED',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</b></font><?php } else {
if ($_smarty_tpl->tpl_vars['MODULEIMPORT_FILE_INVALID']->value == "true") {?><font color=red><b><?php echo vtranslate('LBL_INVALID_FILE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</b></font> <?php echo vtranslate('LBL_INVALID_IMPORT_TRY_AGAIN',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
} else { ?><font color=red><?php echo vtranslate('LBL_UNABLE_TO_UPLOAD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</font> <?php echo vtranslate('LBL_UNABLE_TO_UPLOAD2',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
}
}?></div><input type="hidden" name="view" value="List"><?php } else { ?><div class="col-lg-12"><div><h3><?php echo vtranslate('LBL_VERIFY_IMPORT_DETAILS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h3></div><hr></div><div class="container-fluid"><br><div class="col-lg-12"><h4><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULEIMPORT_NAME']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
if ($_smarty_tpl->tpl_vars['MODULEIMPORT_EXISTS']->value == 'true') {?> <font color=red><b><?php echo vtranslate('LBL_EXISTS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</b></font> <?php }?></h4></div><div class="col-lg-12"><p><small><?php echo vtranslate('LBL_REQ_VTIGER_VERSION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 : <?php echo $_smarty_tpl->tpl_vars['MODULEIMPORT_DEP_VTVERSION']->value;?>
</small></p></div><div class="col-lg-12"><?php if ($_smarty_tpl->tpl_vars['MODULEIMPORT_EXISTS']->value == 'true' || $_smarty_tpl->tpl_vars['MODULEIMPORT_DIR_EXISTS']->value == 'true') {
if ($_smarty_tpl->tpl_vars['MODULEIMPORT_EXISTS']->value == 'true') {?><input type="hidden" name="module_import_file" value="<?php echo $_smarty_tpl->tpl_vars['MODULEIMPORT_FILE']->value;?>
"><input type="hidden" name="module_import_type" value="<?php echo $_smarty_tpl->tpl_vars['MODULEIMPORT_TYPE']->value;?>
"><input type="hidden" name="module_import_name" value="<?php echo $_smarty_tpl->tpl_vars['MODULEIMPORT_NAME']->value;?>
"><?php } else { ?><br><br><span class="alert-info" style="padding: 4px 10px;"><?php echo vtranslate('LBL_DELETE_EXIST_DIRECTORY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><?php }
} else {
$_smarty_tpl->_assignInScope('need_license_agreement', "false");
if ($_smarty_tpl->tpl_vars['MODULEIMPORT_LICENSE']->value) {
$_smarty_tpl->_assignInScope('need_license_agreement', "true");?><div class="col-lg-12"><p><?php echo vtranslate('LBL_LICENSE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</p></div><div class="col-lg-12"><textarea readonly="" rows="15" style="width: 100%;font-family: monospace;"><?php echo $_smarty_tpl->tpl_vars['MODULEIMPORT_LICENSE']->value;?>
</textarea></div><?php }
if ($_smarty_tpl->tpl_vars['need_license_agreement']->value == 'true') {?><div class="col-lg-12"><input type="checkbox" class="acceptLicense"> <?php echo vtranslate('LBL_LICENSE_ACCEPT_AGREEMENT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><?php }?><input type="hidden" name="module_import_file" value="<?php echo $_smarty_tpl->tpl_vars['MODULEIMPORT_FILE']->value;?>
"><input type="hidden" name="module_import_type" value="<?php echo $_smarty_tpl->tpl_vars['MODULEIMPORT_TYPE']->value;?>
"><input type="hidden" name="module_import_name" value="<?php echo $_smarty_tpl->tpl_vars['MODULEIMPORT_NAME']->value;?>
"><?php }?></div></div><br><br><?php }?></div></div></div><div class="modal-overlay-footer clearfix"><div class="row clearfix"><div class="textAlignCenter col-lg-12 col-md-12 col-sm-12"><?php if ((isset($_smarty_tpl->tpl_vars['MODULEIMPORT_FAILED']->value)) && $_smarty_tpl->tpl_vars['MODULEIMPORT_FAILED']->value != '') {?><button class="btn btn-success finishButton" type="submit"><strong><?php echo vtranslate('LBL_FINISH',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></button><?php } elseif ($_smarty_tpl->tpl_vars['MODULEIMPORT_EXISTS']->value == 'true' || $_smarty_tpl->tpl_vars['MODULEIMPORT_DIR_EXISTS']->value == 'true') {?><button class="btn btn-success updateModule" name="saveButton" <?php if ((isset($_smarty_tpl->tpl_vars['need_license_agreement']->value)) && $_smarty_tpl->tpl_vars['need_license_agreement']->value == 'true') {?> disabled <?php }?>><?php echo vtranslate('LBL_UPDATE_NOW',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button><?php } else { ?><button class="btn btn-success importModule" name="saveButton" <?php if ($_smarty_tpl->tpl_vars['need_license_agreement']->value == 'true') {?> disabled <?php }?>><strong><?php echo vtranslate('LBL_IMPORT_NOW',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></button><?php }?>&nbsp;&nbsp;<a class="cancelLink" href="javascript:history.back()" type="reset"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div></div></div></div>
<?php }
}
