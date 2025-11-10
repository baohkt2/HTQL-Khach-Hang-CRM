<?php
/* Smarty version 4.5.5, created on 2025-11-09 19:02:48
  from 'C:\xampp\htdocs\cusc\layouts\v7\modules\PDFMaker\GetPDFButtons.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_6910e558d6f457_15240475',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f6c9f909ba9bec6624b70d98e680f8314ca68aab' => 
    array (
      0 => 'C:\\xampp\\htdocs\\cusc\\layouts\\v7\\modules\\PDFMaker\\GetPDFButtons.tpl',
      1 => 1762713639,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6910e558d6f457_15240475 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['ENABLE_PDFMAKER']->value == 'true') {?>

     <div class="col-sm-4 pull-right" id="PDFMakerContentDiv">
        <div class="row clearfix">
                <div class="col-sm-6 padding0px pull-right">
                    <div class="btn-group pull-right">
                        <button class="btn btn-default selectPDFTemplates"><?php echo vtranslate('LBL_EXPORT_TO_PDF','PDFMaker');?>
</button>
                        <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split PDFMoreAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo vtranslate('LBL_MORE','PDFMaker');?>
&nbsp;&nbsp;<span class="caret"></span></button>
                        </button>
                            <ul class="dropdown-menu">
                                <?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "GetPDFActions.tpl",'PDFMaker' )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
                            </ul>
                        </div>
                    </div>
                </div>
        </div>
    </div>
<?php }
}
}
