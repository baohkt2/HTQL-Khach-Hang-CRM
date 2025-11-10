<?php
/* Smarty version 4.5.5, created on 2025-11-09 19:02:51
  from 'C:\xampp\htdocs\cusc\layouts\v7\modules\PDFMaker\PDFPreview.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_6910e55bc1d723_87095289',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6495879d1af72ed96a954f51599a30aa6d506f5e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\cusc\\layouts\\v7\\modules\\PDFMaker\\PDFPreview.tpl',
      1 => 1762713639,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6910e55bc1d723_87095289 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="modal-dialog modal-lg"><div class="modal-content"><div class="filePreview container-fluid"><div class="modal-header row"><div class="filename col-lg-8"><h4 class="textOverflowEllipsis maxWidth50" title="<?php echo vtranslate('LBL_PREVIEW',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><b><?php echo vtranslate('LBL_PREVIEW',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</b></h4></div><div class="col-lg-1 pull-right"><button type="button" class="close" aria-label="Close" data-dismiss="modal"><span aria-hidden="true" class='fa fa-close'></span></button></div></div><div class="modal-body row" style="height:550px;"><iframe id='PDFMakerPreviewContent' src="<?php echo $_smarty_tpl->tpl_vars['FILE_PATH']->value;?>
" data-desc="<?php echo $_smarty_tpl->tpl_vars['FILE_PATH']->value;?>
" height="100%" width="100%"></iframe></div></div><div class="modal-footer"><div class='clearfix modal-footer-overwrite-style'><div class="row clearfix "><div class=' textAlignCenter col-lg-12 col-md-12 col-sm-12 '><button type='button' class='btn btn-success downloadButton' data-desc="<?php echo $_smarty_tpl->tpl_vars['DOWNLOAD_URL']->value;?>
"><strong><?php echo vtranslate('LBL_DOWNLOAD_FILE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button>&nbsp;&nbsp;<?php if ($_smarty_tpl->tpl_vars['PRINT_ACTION']->value == "1") {?><button type='button' class='btn btn-success printButton'><strong><?php echo vtranslate('LBL_PRINT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button>&nbsp;&nbsp;<?php }?><a class='cancelLink' href="javascript:void(0);" type="reset" data-dismiss="modal"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div></div></div></div></div></div>
<?php }
}
