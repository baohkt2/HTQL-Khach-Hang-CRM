<?php
/* Smarty version 4.5.5, created on 2025-11-05 18:19:01
  from 'C:\xampp\htdocs\HTQL-Khach-Hang-CRM-vvan\layouts\v7\modules\PDFMaker\GetPDFActions.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690b951521d0f3_38362906',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '30da2a073bc47b69f4661d3881991df0dcde3789' => 
    array (
      0 => 'C:\\xampp\\htdocs\\HTQL-Khach-Hang-CRM-vvan\\layouts\\v7\\modules\\PDFMaker\\GetPDFActions.tpl',
      1 => 1762366664,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690b951521d0f3_38362906 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\HTQL-Khach-Hang-CRM-vvan\\vendor\\smarty\\smarty\\libs\\plugins\\function.html_options.php','function'=>'smarty_function_html_options',),));
if ($_smarty_tpl->tpl_vars['ENABLE_PDFMAKER']->value == 'true') {?>

    <input type="hidden" name="email_function" id="email_function" value="<?php echo $_smarty_tpl->tpl_vars['EMAIL_FUNCTION']->value;?>
"/>
        <li>
        <a href="javascript:;" class="PDFMakerDownloadPDF PDFMakerTemplateAction"><?php echo vtranslate('LBL_DOWNLOAD','PDFMaker');?>
</a>
    </li>
    <li class="dropdown-header">
        <i class="fa fa-settings"></i> <?php echo vtranslate('LBL_SETTINGS','PDFMaker');?>

    </li>
        <li>
            <a href="javascript:;" class="showPDFBreakline"><?php echo vtranslate('LBL_PRODUCT_BREAKLINE','PDFMaker');?>
</a>
        </li>
    <li>
        <a href="javascript:;" class="showProductImages"><?php echo vtranslate('LBL_PRODUCT_IMAGE','PDFMaker');?>
</a>
    </li>

    <?php if (sizeof($_smarty_tpl->tpl_vars['TEMPLATE_LANGUAGES']->value) > 1) {?>
        <li class="dropdown-header">
            <i class="fa fa-settings"></i> <?php echo vtranslate('LBL_PDF_LANGUAGE','PDFMaker');?>

        </li>
        <li>
            <select name="template_language" id="template_language" class="col-lg-12">
                <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['TEMPLATE_LANGUAGES']->value,'selected'=>$_smarty_tpl->tpl_vars['CURRENT_LANGUAGE']->value),$_smarty_tpl);?>

            </select>
        </li>
    <?php } else { ?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['TEMPLATE_LANGUAGES']->value), 'lang', false, 'lang_key');
$_smarty_tpl->tpl_vars['lang']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['lang_key']->value => $_smarty_tpl->tpl_vars['lang']->value) {
$_smarty_tpl->tpl_vars['lang']->do_else = false;
?>
            <input type="text" name="template_language" id="template_language" value="<?php echo $_smarty_tpl->tpl_vars['lang_key']->value;?>
"/>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php }
}
}
}
