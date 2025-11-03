<?php
/* Smarty version 4.5.5, created on 2025-11-03 07:36:51
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Import\ImportResult.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_69085b93eb05c2_34236677',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '760e84354932e1fd324f9aa760815df0225b862c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Import\\ImportResult.tpl',
      1 => 1761802268,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69085b93eb05c2_34236677 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class='fc-overlay-modal modal-content'>
    <div class="overlayHeader">
        <?php ob_start();
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_IMPORT_SUMMARY',$_smarty_tpl->tpl_vars['MODULE']->value ));
$_prefixVariable1=ob_get_clean();
$_smarty_tpl->_assignInScope('TITLE', $_prefixVariable1);?>
        <?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('TITLE'=>$_smarty_tpl->tpl_vars['TITLE']->value), 0, true);
?>
    </div>
    <div class='modal-body' style="margin-bottom:100%">
        <div class="summaryWidgetContainer">
            <input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['FOR_MODULE']->value;?>
" />
            <h4><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_TOTAL_RECORDS_SCANNED',$_smarty_tpl->tpl_vars['MODULE']->value ));?>
&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['IMPORT_RESULT']->value['TOTAL'];?>
</h4>
            <?php if ((isset($_smarty_tpl->tpl_vars['ERROR_MESSAGE']->value)) && $_smarty_tpl->tpl_vars['ERROR_MESSAGE']->value != '') {?><span><?php echo $_smarty_tpl->tpl_vars['ERROR_MESSAGE']->value;?>
</span><?php }?>
            <hr>
            <div><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "Import_Result_Details.tpl",'Import' )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></div>
        </div>
    </div>
    <div class='modal-overlay-footer border1px clearfix'>
       <div class="row clearfix">
            <div class='textAlignCenter col-lg-12 col-md-12 col-sm-12 '>
                <button name="next" class="btn btn-primary btn-lg"
                        onclick="return Vtiger_Import_Js.triggerImportAction();"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_IMPORT_MORE',$_smarty_tpl->tpl_vars['MODULE']->value ));?>
</button>
                &nbsp;&nbsp;&nbsp;
                <?php if ($_smarty_tpl->tpl_vars['MERGE_ENABLED']->value == '0') {?>
                    <button name="next" class="btn btn-danger btn-lg"
                            onclick="Vtiger_Import_Js.undoImport('index.php?module=<?php echo $_smarty_tpl->tpl_vars['FOR_MODULE']->value;?>
&view=Import&mode=undoImport&foruser=<?php echo $_smarty_tpl->tpl_vars['OWNER_ID']->value;?>
')"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_UNDO_LAST_IMPORT',$_smarty_tpl->tpl_vars['MODULE']->value ));?>
</button>
                    &nbsp;&nbsp;&nbsp;
                <?php }?>
                <button class='btn btn-success btn-lg' data-dismiss="modal" onclick="Vtiger_Import_Js.loadListRecords();"><?php echo vtranslate('LBL_FINISH',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button>
            </div>
        </div>
    </div>
</div>
<?php }
}
