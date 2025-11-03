<?php
/* Smarty version 4.5.5, created on 2025-11-02 08:35:48
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Accounts\SummaryViewWidgets.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690717e4d91d31_84060389',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '899fa831e01b81f4f9271a9dae34b5ba8c9494c3' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Accounts\\SummaryViewWidgets.tpl',
      1 => 1761802268,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690717e4d91d31_84060389 (Smarty_Internal_Template $_smarty_tpl) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['DETAILVIEW_LINKS']->value['DETAILVIEWWIDGET'], 'DETAIL_VIEW_WIDGET');
$_smarty_tpl->tpl_vars['DETAIL_VIEW_WIDGET']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['DETAIL_VIEW_WIDGET']->value) {
$_smarty_tpl->tpl_vars['DETAIL_VIEW_WIDGET']->do_else = false;
if (($_smarty_tpl->tpl_vars['DETAIL_VIEW_WIDGET']->value->getLabel() == 'Documents')) {
$_smarty_tpl->_assignInScope('DOCUMENT_WIDGET_MODEL', $_smarty_tpl->tpl_vars['DETAIL_VIEW_WIDGET']->value);
} elseif (($_smarty_tpl->tpl_vars['DETAIL_VIEW_WIDGET']->value->getLabel() == 'ModComments')) {
$_smarty_tpl->_assignInScope('COMMENTS_WIDGET_MODEL', $_smarty_tpl->tpl_vars['DETAIL_VIEW_WIDGET']->value);
} elseif (($_smarty_tpl->tpl_vars['DETAIL_VIEW_WIDGET']->value->getLabel() == 'LBL_UPDATES')) {
$_smarty_tpl->_assignInScope('UPDATES_WIDGET_MODEL', $_smarty_tpl->tpl_vars['DETAIL_VIEW_WIDGET']->value);
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?><div class="left-block col-lg-4"><div class="summaryView"><div class="summaryViewHeader"><h4 class="display-inline-block"><?php echo vtranslate('LBL_KEY_FIELDS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</h4></div><div class="summaryViewFields"><?php echo $_smarty_tpl->tpl_vars['MODULE_SUMMARY']->value;?>
</div></div><?php if ($_smarty_tpl->tpl_vars['DOCUMENT_WIDGET_MODEL']->value) {?><div class="summaryWidgetContainer"><div class="widgetContainer_documents" data-url="<?php echo $_smarty_tpl->tpl_vars['DOCUMENT_WIDGET_MODEL']->value->getUrl();?>
" data-name="<?php echo $_smarty_tpl->tpl_vars['DOCUMENT_WIDGET_MODEL']->value->getLabel();?>
"><div class="widget_header clearfix"><input type="hidden" name="relatedModule" value="<?php echo $_smarty_tpl->tpl_vars['DOCUMENT_WIDGET_MODEL']->value->get('linkName');?>
" /><span class="toggleButton pull-left"><i class="fa fa-angle-down"></i>&nbsp;&nbsp;</span><h4 class="display-inline-block pull-left"><?php echo vtranslate($_smarty_tpl->tpl_vars['DOCUMENT_WIDGET_MODEL']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</h4><?php if ($_smarty_tpl->tpl_vars['DOCUMENT_WIDGET_MODEL']->value->get('action')) {
$_smarty_tpl->_assignInScope('PARENT_ID', $_smarty_tpl->tpl_vars['RECORD']->value->getId());?><div class="pull-right"><div class="dropdown"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="fa fa-plus" title="<?php echo vtranslate('LBL_NEW_DOCUMENT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
"></span>&nbsp;<?php echo vtranslate('LBL_NEW_DOCUMENT','Documents');?>
&nbsp; <span class="caret"></span></button><ul class="dropdown-menu"><li class="dropdown-header"><i class="fa fa-upload"></i> <?php echo vtranslate('LBL_FILE_UPLOAD','Documents');?>
</li><li id="VtigerAction"><a href="javascript:Documents_Index_Js.uploadTo('Vtiger',<?php echo $_smarty_tpl->tpl_vars['PARENT_ID']->value;?>
,'<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
')"><img style="  margin-top: -3px;margin-right: 4%;" title="Vtiger" alt="Vtiger" src="layouts/v7/skins//images/Vtiger.png"><?php ob_start();
echo vtranslate('LBL_VTIGER','Documents');
$_prefixVariable9 = ob_get_clean();
echo vtranslate('LBL_TO_SERVICE','Documents',$_prefixVariable9);?>
</a></li><li role="separator" class="divider"></li><li class="dropdown-header"><i class="fa fa-link"></i> <?php echo vtranslate('LBL_LINK_EXTERNAL_DOCUMENT','Documents');?>
</li><li id="shareDocument"><a href="javascript:Documents_Index_Js.createDocument('E',<?php echo $_smarty_tpl->tpl_vars['PARENT_ID']->value;?>
,'<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
')">&nbsp;<i class="fa fa-external-link"></i>&nbsp;&nbsp; <?php ob_start();
echo vtranslate('LBL_FILE_URL','Documents');
$_prefixVariable10 = ob_get_clean();
echo vtranslate('LBL_FROM_SERVICE','Documents',$_prefixVariable10);?>
</a></li><li role="separator" class="divider"></li><li id="createDocument"><a href="javascript:Documents_Index_Js.createDocument('W',<?php echo $_smarty_tpl->tpl_vars['PARENT_ID']->value;?>
,'<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
')"><i class="fa fa-file-text"></i> <?php ob_start();
echo vtranslate('SINGLE_Documents','Documents');
$_prefixVariable11 = ob_get_clean();
echo vtranslate('LBL_CREATE_NEW','Documents',$_prefixVariable11);?>
</a></li></ul></div></div><?php }?></div><div class="widget_contents"></div></div></div><?php }?></div><div class="middle-block col-lg-8"><div id="relatedActivities"><?php echo $_smarty_tpl->tpl_vars['RELATED_ACTIVITIES']->value;?>
</div><?php if ($_smarty_tpl->tpl_vars['COMMENTS_WIDGET_MODEL']->value) {?><div class="summaryWidgetContainer"><div class="widgetContainer_comments" data-url="<?php echo $_smarty_tpl->tpl_vars['COMMENTS_WIDGET_MODEL']->value->getUrl();?>
" data-name="<?php echo $_smarty_tpl->tpl_vars['COMMENTS_WIDGET_MODEL']->value->getLabel();?>
"><div class="widget_header"><input type="hidden" name="relatedModule" value="<?php echo $_smarty_tpl->tpl_vars['COMMENTS_WIDGET_MODEL']->value->get('linkName');?>
" /><h4 class="display-inline-block"><?php echo vtranslate($_smarty_tpl->tpl_vars['COMMENTS_WIDGET_MODEL']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</h4></div><div class="widget_contents"></div></div></div><?php }?></div><?php }
}
