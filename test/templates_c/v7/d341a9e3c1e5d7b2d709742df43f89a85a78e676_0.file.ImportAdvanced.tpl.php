<?php
/* Smarty version 4.5.5, created on 2025-11-03 07:52:39
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Import\ImportAdvanced.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_69085f470cc7e2_47642304',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd341a9e3c1e5d7b2d709742df43f89a85a78e676' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Import\\ImportAdvanced.tpl',
      1 => 1761802268,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69085f470cc7e2_47642304 (Smarty_Internal_Template $_smarty_tpl) {
?>

<div class='fc-overlay-modal modal-content'>
    <div class="overlayHeader">
        <?php ob_start();
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_IMPORT',$_smarty_tpl->tpl_vars['MODULE']->value ));
$_prefixVariable1=ob_get_clean();
ob_start();
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( $_smarty_tpl->tpl_vars['FOR_MODULE']->value,$_smarty_tpl->tpl_vars['FOR_MODULE']->value ));
$_prefixVariable2=ob_get_clean();
$_smarty_tpl->_assignInScope('TITLE', $_prefixVariable1." ".$_prefixVariable2);?>
        <?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('TITLE'=>$_smarty_tpl->tpl_vars['TITLE']->value), 0, true);
?>
    </div>
    <div class="importview-content">
        <form action="index.php" enctype="multipart/form-data" method="POST" name="importAdvanced" id = "importAdvanced">
            <input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['FOR_MODULE']->value;?>
" />
            <input type="hidden" name="view" value="Import" />
            <input type="hidden" name="mode" value="import" />
            <input type="hidden" name="type" value="<?php echo $_smarty_tpl->tpl_vars['USER_INPUT']->value->get('type');?>
" />
            <input type="hidden" name="has_header" value='<?php echo $_smarty_tpl->tpl_vars['HAS_HEADER']->value;?>
' />
            <input type="hidden" name="file_encoding" value='<?php echo $_smarty_tpl->tpl_vars['USER_INPUT']->value->get('file_encoding');?>
' />
            <input type="hidden" name="delimiter" value='<?php echo $_smarty_tpl->tpl_vars['USER_INPUT']->value->get('delimiter');?>
' />

            <div class='modal-body'>
				<?php $_smarty_tpl->_assignInScope('LABELS', array());?>
                <?php if ((isset($_smarty_tpl->tpl_vars['FORMAT']->value)) && $_smarty_tpl->tpl_vars['FORMAT']->value == 'vcf') {?>
                    <?php $_tmp_array = isset($_smarty_tpl->tpl_vars['LABELS']) ? $_smarty_tpl->tpl_vars['LABELS']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array["step1"] = 'LBL_UPLOAD_VCF';
$_smarty_tpl->_assignInScope('LABELS', $_tmp_array);?>
                <?php } elseif ((isset($_smarty_tpl->tpl_vars['FORMAT']->value)) && $_smarty_tpl->tpl_vars['FORMAT']->value == 'ics') {?>
					<?php $_tmp_array = isset($_smarty_tpl->tpl_vars['LABELS']) ? $_smarty_tpl->tpl_vars['LABELS']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array["step1"] = 'LBL_UPLOAD_ICS';
$_smarty_tpl->_assignInScope('LABELS', $_tmp_array);?>
				<?php } else { ?>
                    <?php $_tmp_array = isset($_smarty_tpl->tpl_vars['LABELS']) ? $_smarty_tpl->tpl_vars['LABELS']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array["step1"] = 'LBL_UPLOAD_CSV';
$_smarty_tpl->_assignInScope('LABELS', $_tmp_array);?>
                <?php }?>

                <?php if ((isset($_smarty_tpl->tpl_vars['DUPLICATE_HANDLING_NOT_SUPPORTED']->value)) == 'true') {?>
                    <?php $_tmp_array = isset($_smarty_tpl->tpl_vars['LABELS']) ? $_smarty_tpl->tpl_vars['LABELS']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array["step3"] = 'LBL_FIELD_MAPPING';
$_smarty_tpl->_assignInScope('LABELS', $_tmp_array);?>
                <?php } else { ?>
                    <?php $_tmp_array = isset($_smarty_tpl->tpl_vars['LABELS']) ? $_smarty_tpl->tpl_vars['LABELS']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array["step2"] = 'LBL_DUPLICATE_HANDLING';
$_smarty_tpl->_assignInScope('LABELS', $_tmp_array);?>
                    <?php $_tmp_array = isset($_smarty_tpl->tpl_vars['LABELS']) ? $_smarty_tpl->tpl_vars['LABELS']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array["step3"] = 'LBL_FIELD_MAPPING';
$_smarty_tpl->_assignInScope('LABELS', $_tmp_array);?>
                <?php }?>
                <?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "BreadCrumbs.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('BREADCRUMB_ID'=>'navigation_links','ACTIVESTEP'=>3,'BREADCRUMB_LABELS'=>$_smarty_tpl->tpl_vars['LABELS']->value,'MODULE'=>$_smarty_tpl->tpl_vars['MODULE']->value), 0, true);
?>
                <div class = "importBlockContainer">
                    <table class = "table table-borderless">
                        <?php if ((isset($_smarty_tpl->tpl_vars['ERROR_MESSAGE']->value)) && $_smarty_tpl->tpl_vars['ERROR_MESSAGE']->value != '') {?>
                            <tr>
                                <td align="left">
                                    <?php echo $_smarty_tpl->tpl_vars['ERROR_MESSAGE']->value;?>

                                </td>
                            </tr>
                        <?php }?>
                        <tr>
                            <td>
                                <?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( 'ImportStepThree.tpl','Import' )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class='modal-overlay-footer border1px clearfix'>
                <div class="row clearfix">
                        <div class='textAlignCenter col-lg-12 col-md-12 col-sm-12 '>
                        <button type="submit" name="import" id="importButton" class="btn btn-success btn-lg" onclick="return Vtiger_Import_Js.sanitizeAndSubmit()"
                                ><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_IMPORT_BUTTON_LABEL',$_smarty_tpl->tpl_vars['MODULE']->value ));?>
</button>
                        &nbsp;&nbsp;&nbsp;<a class='cancelLink' data-dismiss="modal" href="#"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php }
}
