<?php
/* Smarty version 4.5.5, created on 2025-10-30 06:12:41
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\LayoutEditor\Index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690301d9b510a3_46127961',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '34b6f8f5a3a3ba12f3cacdffc5921489e3067aaa' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\LayoutEditor\\Index.tpl',
      1 => 1761802269,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690301d9b510a3_46127961 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container-fluid main-scroll paddingTop15" id="layoutEditorContainer"><input id="selectedModuleName" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value;?>
" /><input class="selectedTab" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['SELECTED_TAB']->value;?>
"><input class="selectedMode" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['MODE']->value;?>
"><input type="hidden" id="selectedModuleLabel" value="<?php echo vtranslate($_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value);?>
" /><div class="widget_header row"><label class="col-sm-2 textAlignCenter" style="padding-top: 7px;"><?php echo vtranslate('SELECT_MODULE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label><div class="col-sm-6"><select class="select2 col-sm-6" name="layoutEditorModules"><option value=''><?php echo vtranslate('LBL_SELECT_OPTION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['SUPPORTED_MODULES']->value, 'MODULE_NAME', false, 'TRANSLATED_MODULE_NAME');
$_smarty_tpl->tpl_vars['MODULE_NAME']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['TRANSLATED_MODULE_NAME']->value => $_smarty_tpl->tpl_vars['MODULE_NAME']->value) {
$_smarty_tpl->tpl_vars['MODULE_NAME']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['MODULE_NAME']->value == $_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['TRANSLATED_MODULE_NAME']->value;?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></div></div><br><br><?php if ($_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value) {?><div class="contents tabbable"><ul class="nav nav-tabs layoutTabs massEditTabs marginBottom10px"><?php $_smarty_tpl->_assignInScope('URL', "index.php?module=LayoutEditor&parent=Settings&view=Index");?><li class="<?php if ($_smarty_tpl->tpl_vars['SELECTED_TAB']->value == 'detailViewTab') {?>active <?php }?>detailViewTab"><a data-toggle="tab" href="#detailViewLayout" data-url="<?php echo $_smarty_tpl->tpl_vars['URL']->value;?>
" data-mode="showFieldLayout"><strong><?php echo vtranslate('LBL_DETAILVIEW_LAYOUT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></a></li><li class="<?php if ($_smarty_tpl->tpl_vars['SELECTED_TAB']->value == 'relatedListTab') {?>active <?php }?>relatedListTab"><a data-toggle="tab" href="#relatedTabOrder" data-url="<?php echo $_smarty_tpl->tpl_vars['URL']->value;?>
" data-mode="showRelatedListLayout"><strong><?php echo vtranslate('LBL_RELATION_SHIPS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></a></li><li class="<?php if ($_smarty_tpl->tpl_vars['SELECTED_TAB']->value == 'duplicationTab') {?>active <?php }?>duplicationTab"><a data-toggle="tab" href="#duplicationContainer" data-url="<?php echo $_smarty_tpl->tpl_vars['URL']->value;?>
" data-mode="showDuplicationHandling"><strong><?php echo vtranslate('LBL_DUPLICATE_HANDLING',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></a></li></ul><div class="tab-content layoutContent themeTableColor overflowVisible"><div class="tab-pane<?php if ($_smarty_tpl->tpl_vars['SELECTED_TAB']->value == 'detailViewTab') {?> active<?php }?>" id="detailViewLayout"><?php if ($_smarty_tpl->tpl_vars['SELECTED_TAB']->value == 'detailViewTab') {
$_smarty_tpl->_subTemplateRender(vtemplate_path('FieldsList.tpl',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}?></div><div class="tab-pane <?php if ($_smarty_tpl->tpl_vars['SELECTED_TAB']->value == 'relatedListTab') {?> active<?php }?>" id="relatedTabOrder"><?php if ($_smarty_tpl->tpl_vars['SELECTED_TAB']->value == 'relatedListTab') {
$_smarty_tpl->_subTemplateRender(vtemplate_path('RelatedList.tpl',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}?></div><div class="tab-pane<?php if ($_smarty_tpl->tpl_vars['SELECTED_TAB']->value == 'duplicationTab') {?> active<?php }?>" id="duplicationContainer"><?php if ($_smarty_tpl->tpl_vars['SELECTED_TAB']->value == 'duplicationTab') {
$_smarty_tpl->_subTemplateRender(vtemplate_path('DuplicateHandling.tpl',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}?></div></div></div><?php }?></div><?php }
}
