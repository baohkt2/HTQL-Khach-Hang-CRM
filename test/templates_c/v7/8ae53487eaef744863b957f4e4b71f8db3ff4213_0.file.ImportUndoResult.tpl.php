<?php
/* Smarty version 4.5.5, created on 2025-10-22 08:06:29
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Import\ImportUndoResult.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68f890850cac12_30187154',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8ae53487eaef744863b957f4e4b71f8db3ff4213' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Import\\ImportUndoResult.tpl',
      1 => 1758006149,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68f890850cac12_30187154 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class='fc-overlay-modal modal-content'>
    <div class="overlayHeader">
        <?php ob_start();
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_DELETION_COMPLETED',$_smarty_tpl->tpl_vars['MODULE']->value ));
$_prefixVariable1=ob_get_clean();
$_smarty_tpl->_assignInScope('TITLE', $_prefixVariable1);?>
        <?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('TITLE'=>$_smarty_tpl->tpl_vars['TITLE']->value), 0, true);
?>
    </div>
    <div class='modal-body' id ="importContainer" style="margin-bottom:390px">
        <div style="padding-left: 15px;">
            <input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['FOR_MODULE']->value;?>
" />
            <div class='importBlockContainer'>
                <span>
                    <h4>&nbsp;&nbsp;&nbsp;<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_DELETION_SUMMARY',$_smarty_tpl->tpl_vars['MODULE']->value ));?>
</h4>
                </span>
                <hr style="margin-top:12px;margin-bottom:12px;">
                <table class = "table table-borderless">
                    <?php if ((isset($_smarty_tpl->tpl_vars['ERROR_MESSAGE']->value)) && $_smarty_tpl->tpl_vars['ERROR_MESSAGE']->value != '') {?>
                        <span>
                            <h4>
                                <?php echo $_smarty_tpl->tpl_vars['ERROR_MESSAGE']->value;?>

                            </h4>
                        </span>
                    <?php }?>
                    <tr>
                        <td >
                            <table cellpadding="10" cellspacing="0" class = "table table-bordered importResultsTable">
                                <tr>
                                    <td  width="40%"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_TOTAL_RECORDS',$_smarty_tpl->tpl_vars['MODULE']->value ));?>
</td>
                                    <td  width="50%"><?php echo $_smarty_tpl->tpl_vars['TOTAL_RECORDS']->value;?>
</td>
                                </tr>
                                <tr>
                                    <td width="40%"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_NUMBER_OF_RECORDS_DELETED',$_smarty_tpl->tpl_vars['MODULE']->value ));?>
</td>
                                    <td width="60%"><?php echo $_smarty_tpl->tpl_vars['DELETED_RECORDS_COUNT']->value;?>
</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" colspan="2">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class='modal-footer overlayFooter'>
        <footer>
            <center><button class='btn-primary btn-lg undoDoneButton' data-dismiss="modal" onclick="Vtiger_Import_Js.finishUndoOperation();"><?php echo vtranslate('LBL_DONE_BUTTON',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button></center>
        </footer>
    </div>
</div>
<?php }
}
