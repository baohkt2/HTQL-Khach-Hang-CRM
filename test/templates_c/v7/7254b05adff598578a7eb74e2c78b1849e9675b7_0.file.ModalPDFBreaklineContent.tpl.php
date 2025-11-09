<?php
/* Smarty version 4.5.5, created on 2025-11-05 22:27:13
  from 'C:\xampp\htdocs\HTQL-Khach-Hang-CRM-vvan\layouts\v7\modules\PDFMaker\ModalPDFBreaklineContent.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690bcf41c31742_93265360',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7254b05adff598578a7eb74e2c78b1849e9675b7' => 
    array (
      0 => 'C:\\xampp\\htdocs\\HTQL-Khach-Hang-CRM-vvan\\layouts\\v7\\modules\\PDFMaker\\ModalPDFBreaklineContent.tpl',
      1 => 1762366664,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690bcf41c31742_93265360 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="modal-dialog modelContainer"><div class="modal-content" style="width:675px;"><?php ob_start();
echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;
$_prefixVariable1 = ob_get_clean();
ob_start();
echo vtranslate('LBL_PRODUCT_BREAKLINE',$_prefixVariable1);
$_prefixVariable2 = ob_get_clean();
$_smarty_tpl->_assignInScope('HEADER_TITLE', $_prefixVariable2);
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0, true);
?><div class="modal-body"><div class="container-fluid"><div><form id="SavePDFBreaklineForm" class="form-horizontal" name="upload" method="post" action="index.php"><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
" /><input type="hidden" name="action" value="SaveAjax" /><input type="hidden" name="mode" value="SavePDFBreakline" /><input type="hidden" name="return_id" value="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value;?>
" /><h4 class="fieldBlockHeader"><?php echo vtranslate('LBL_GLOBAL_SETTINGS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</h4><table class="table no-border"><tr><td class="" style="width: 1%"><input type="checkbox" class="settingsCheckbox" name="show_header" value="1" <?php echo $_smarty_tpl->tpl_vars['HEADER_CHECKED']->value;?>
/></td><td class=""><?php echo vtranslate('LBL_SHOW_HEADER',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</td></tr><tr><td class="lineItemFieldName" style="width: 1%"><input type="checkbox" class="settingsCheckbox" name="show_subtotal" value="1" <?php echo $_smarty_tpl->tpl_vars['SUBTOTAL_CHECKED']->value;?>
/></td><td class="lineItemFieldName"><?php echo vtranslate('LBL_SHOW_SUBTOTAL',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</td></tr></table><h4 class="fieldBlockHeader"><?php echo vtranslate('LBL_ITEM_DETAILS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</h4><table class="table table-bordered lineItemsTable" style = "margin-top:15px"><thead><th class="lineItemBlockHeader"></th><th class="lineItemBlockHeader"><?php echo vtranslate('LBL_ITEM_NAME',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</th></thead><tbody><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['PRODUCTS']->value, 'PRODUCT');
$_smarty_tpl->tpl_vars['PRODUCT']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['PRODUCT']->value) {
$_smarty_tpl->tpl_vars['PRODUCT']->do_else = false;
?><tr><td class="lineItemFieldName" style="width: 1%"><input type="checkbox" class="LineItemCheckbox" value="1" name="ItemPageBreak_<?php echo $_smarty_tpl->tpl_vars['PRODUCT']->value['uid'];?>
" <?php if ($_smarty_tpl->tpl_vars['PRODUCT']->value['checked'] == "yes") {?>checked<?php }?>/></td><td class="lineItemFieldName"><?php echo $_smarty_tpl->tpl_vars['PRODUCT']->value['name'];?>
</td></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tbody></table></form></div></div></div><?php ob_start();
echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);
$_prefixVariable3 = ob_get_clean();
$_smarty_tpl->_assignInScope('BUTTON_NAME', $_prefixVariable3);
$_smarty_tpl->_assignInScope('BUTTON_ID', "js-save-button");
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalFooter.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></div></div>
<?php }
}
