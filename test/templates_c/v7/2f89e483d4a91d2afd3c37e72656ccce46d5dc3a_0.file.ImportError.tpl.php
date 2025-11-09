<?php
/* Smarty version 4.5.5, created on 2025-11-03 07:37:03
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Import\ImportError.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_69085b9f348267_11655864',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2f89e483d4a91d2afd3c37e72656ccce46d5dc3a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Import\\ImportError.tpl',
      1 => 1761802268,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69085b9f348267_11655864 (Smarty_Internal_Template $_smarty_tpl) {
?><div class='fc-overlay-modal modal-content'>
    <div class="overlayHeader">
        <?php ob_start();
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_IMPORT',$_smarty_tpl->tpl_vars['MODULE']->value ));
$_prefixVariable1=ob_get_clean();
ob_start();
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_ERROR',$_smarty_tpl->tpl_vars['MODULE']->value ));
$_prefixVariable2=ob_get_clean();
$_smarty_tpl->_assignInScope('TITLE', $_prefixVariable1." - ".$_prefixVariable2);?>
        <?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('TITLE'=>$_smarty_tpl->tpl_vars['TITLE']->value), 0, true);
?> 
    </div>
    <div class='modal-body' style="margin-bottom:380px" id = "landingPageDiv">
        <input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['FOR_MODULE']->value;?>
" />
        <div class = "alert alert-danger">
            <?php echo $_smarty_tpl->tpl_vars['ERROR_MESSAGE']->value;?>

        </div>
        <table class = "table table-borderless">
            <tr>
                <td valign="top">
                    <table  class="table table-borderless">
                        
                        <?php if ($_smarty_tpl->tpl_vars['ERROR_DETAILS']->value != '') {?>
                            <tr>
                                <td>
                                    <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'ERR_DETAILS_BELOW',$_smarty_tpl->tpl_vars['MODULE']->value ));?>

                                    <table cellpadding="5" cellspacing="0">
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ERROR_DETAILS']->value, '_VALUE', false, '_TITLE');
$_smarty_tpl->tpl_vars['_VALUE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['_TITLE']->value => $_smarty_tpl->tpl_vars['_VALUE']->value) {
$_smarty_tpl->tpl_vars['_VALUE']->do_else = false;
?>
                                            <tr>
                                                <td><?php echo $_smarty_tpl->tpl_vars['_TITLE']->value;?>
</td>
                                                <td>-</td>
                                                <td><?php echo $_smarty_tpl->tpl_vars['_VALUE']->value;?>
</td>
                                            </tr>
                                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                    </table>
                                </td>
                            </tr>
                        <?php }?>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="right">

                </td>
            </tr>
        </table>
    </div> 
    <div class='modal-overlay-footer border1px clearfix'>
        <div class="row clearfix">
            <div class='textAlignCenter col-lg-12 col-md-12 col-sm-12 '>
                <?php if ($_smarty_tpl->tpl_vars['CUSTOM_ACTIONS']->value != '') {?>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['CUSTOM_ACTIONS']->value, '_ACTION', false, '_LABEL');
$_smarty_tpl->tpl_vars['_ACTION']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['_LABEL']->value => $_smarty_tpl->tpl_vars['_ACTION']->value) {
$_smarty_tpl->tpl_vars['_ACTION']->do_else = false;
?>
                        <button name="<?php echo $_smarty_tpl->tpl_vars['_LABEL']->value;?>
" onclick="return Vtiger_Import_Js.clearSheduledImportData()" class="btn btn-danger btn-lg"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( $_smarty_tpl->tpl_vars['_LABEL']->value,$_smarty_tpl->tpl_vars['MODULE']->value ));?>
</button>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                <?php }?>
            </div>
        </div>
    </div>
</div><?php }
}
