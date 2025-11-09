<?php
/* Smarty version 4.5.5, created on 2025-11-03 07:36:49
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Import\ImportStatus.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_69085b91786ab4_06074729',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1affb682f4040a2c1aa7fa52cced9dc4c02574a4' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Import\\ImportStatus.tpl',
      1 => 1761802268,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69085b91786ab4_06074729 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class='fc-overlay-modal' id="scheduleImportStatus">
    <div class = "modal-content">
        <div class="overlayHeader">
            <?php ob_start();
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_IMPORT',$_smarty_tpl->tpl_vars['MODULE']->value ));
$_prefixVariable1=ob_get_clean();
ob_start();
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( $_smarty_tpl->tpl_vars['FOR_MODULE']->value,$_smarty_tpl->tpl_vars['FOR_MODULE']->value ));
$_prefixVariable2=ob_get_clean();
ob_start();
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_RUNNING',$_smarty_tpl->tpl_vars['MODULE']->value ));
$_prefixVariable3=ob_get_clean();
$_smarty_tpl->_assignInScope('TITLE', $_prefixVariable1." ".$_prefixVariable2." -
                    <span style = 'color:red'>".$_prefixVariable3." ... </span>");?>
			<?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('TITLE'=>$_smarty_tpl->tpl_vars['TITLE']->value), 0, true);
?>
			</div>
        <div class='modal-body' id = "importStatusDiv" style="margin-bottom:100%">
            <hr>
                <form onsubmit="VtigerJS_DialogBox.block();" action="index.php" enctype="multipart/form-data" method="POST" name="importStatusForm" id = "importStatusForm">
                    <input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['FOR_MODULE']->value;?>
" />
                    <input type="hidden" name="view" value="Import" />
                    <?php if ($_smarty_tpl->tpl_vars['CONTINUE_IMPORT']->value == 'true') {?>
                        <input type="hidden" name="mode" value="continueImport" />
                    <?php } else { ?>
                        <input type="hidden" name="mode" value="" />
                    <?php }?>
                </form>
                <?php if ($_smarty_tpl->tpl_vars['ERROR_MESSAGE']->value != '') {?>
                    <div class = "alert alert-danger">
                        <?php echo $_smarty_tpl->tpl_vars['ERROR_MESSAGE']->value;?>

                    </div>
                <?php }?>
                <div class = "col-lg-12 col-md-12 col-sm-12">
                    <div class = "col-lg-3 col-md-4 col-sm-6">
                        <span><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_TOTAL_RECORDS_IMPORTED',$_smarty_tpl->tpl_vars['MODULE']->value ));?>
</span> 
                    </div>
                    <div class ="col-lg-1 col-md-1 col-sm-1"><span>:</span> </div>
                    <div class = "col-lg-2 col-md-3 col-sm-4"><span><strong><?php echo $_smarty_tpl->tpl_vars['IMPORT_RESULT']->value['IMPORTED'];?>
 / <?php echo $_smarty_tpl->tpl_vars['IMPORT_RESULT']->value['TOTAL'];?>
</strong></span></div> 
                </div>
                <div class = "col-lg-12 col-md-12 col-sm-12">
                    <div class = "col-lg-3 col-md-4 col-sm-6">
                        <span><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_NUMBER_OF_RECORDS_CREATED',$_smarty_tpl->tpl_vars['MODULE']->value ));?>
</span> 
                    </div>
                    <div class ="col-lg-1 col-md-1 col-sm-1"><span>:</span> </div>
                    <div class = "col-lg-2 col-md-3 col-sm-4"><span><strong><?php echo $_smarty_tpl->tpl_vars['IMPORT_RESULT']->value['CREATED'];?>
</strong></span></div> 
                </div>
                <div class = "col-lg-12 col-md-12">
                    <div class = "col-lg-3 col-md-3">
                        <span><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_NUMBER_OF_RECORDS_UPDATED',$_smarty_tpl->tpl_vars['MODULE']->value ));?>
</span> 
                    </div>
                    <div class ="col-lg-1 col-md-1"><span>:</span> </div>
                    <div class = "col-lg-2 col-md-2"><span><strong><?php echo $_smarty_tpl->tpl_vars['IMPORT_RESULT']->value['UPDATED'];?>
</strong></span></div> 
                </div>
                <div class = "col-lg-12 col-md-12">
                    <div class = "col-lg-3 col-md-3">
                        <span><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_NUMBER_OF_RECORDS_SKIPPED',$_smarty_tpl->tpl_vars['MODULE']->value ));?>
</span> 
                    </div>
                    <div class ="col-lg-1 col-md-1"><span>:</span> </div>
                    <div class = "col-lg-2 col-md-2"><span><strong><?php echo $_smarty_tpl->tpl_vars['IMPORT_RESULT']->value['SKIPPED'];?>
</strong></span></div> 
                </div>
                <div class = "col-lg-12 col-md-12">
                    <div class = "col-lg-3 col-md-3">
                        <span><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_NUMBER_OF_RECORDS_MERGED',$_smarty_tpl->tpl_vars['MODULE']->value ));?>
</span> 
                    </div>
                    <div class ="col-lg-1 col-md-1"><span>:</span> </div>
                    <div class = "col-lg-2 col-md-2"><span><strong><?php echo $_smarty_tpl->tpl_vars['IMPORT_RESULT']->value['MERGED'];?>
</strong></span></div> 
                </div>
        </div>
        <div class='modal-overlay-footer border1px clearfix'>
            <div class="row clearfix">
                <div class='textAlignCenter col-lg-12 col-md-12 col-sm-12 '>
                    <button name="cancel" class="btn btn-danger btn-lg"
                            onclick="return Vtiger_Import_Js.cancelImport('index.php?module=<?php echo $_smarty_tpl->tpl_vars['FOR_MODULE']->value;?>
&view=Import&mode=cancelImport&import_id=<?php echo $_smarty_tpl->tpl_vars['IMPORT_ID']->value;?>
')"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_CANCEL_IMPORT',$_smarty_tpl->tpl_vars['MODULE']->value ));?>
</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }
}
