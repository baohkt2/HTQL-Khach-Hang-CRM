<?php
/* Smarty version 4.5.5, created on 2025-10-19 19:57:22
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Rss\RssFeedContents.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68f542a22558d9_12552593',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b4b122da20a4544afe5ce5d0c6a70b52c522f39d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Rss\\RssFeedContents.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68f542a22558d9_12552593 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('WIDTHTYPE', $_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('rowheight'));?><table class="table listview-table listViewEntriesTable"><thead><tr class="listViewContentHeader"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value, 'LISTVIEW_HEADER', true);
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration = 0;
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value) {
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = false;
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration++;
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->last = $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration === $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->total;
$__foreach_LISTVIEW_HEADER_0_saved = $_smarty_tpl->tpl_vars['LISTVIEW_HEADER'];
?><th nowrap <?php if ($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->last) {?> colspan="2" <?php }?> class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th><?php
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER'] = $__foreach_LISTVIEW_HEADER_0_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tr></thead><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RECORD']->value->getRssObject(), 'LISTVIEW_ENTRY', false, NULL, 'listview', array (
));
$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value) {
$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->do_else = false;
?><tr class="listViewEntries" data-id='<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getId();?>
'><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value, 'LISTVIEW_HEADER', true);
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration = 0;
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value) {
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = false;
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration++;
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->last = $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration === $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->total;
$__foreach_LISTVIEW_HEADER_2_saved = $_smarty_tpl->tpl_vars['LISTVIEW_HEADER'];
$_smarty_tpl->_assignInScope('LISTVIEW_HEADERNAME', $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name'));?><td class="listViewEntryValue <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" data-field-type="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getFieldDataType();?>
" nowrap><a class='feedLink' href="#" data-url="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value[$_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value];?>
</a><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->last) {?></td><td nowrap class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><span class="actions"><span class="actionImages pull-right"><a href="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value['link'];?>
" target="_BLANK"><i title="<?php echo vtranslate('LBL_SHOW_COMPLETE_DETAILS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="fa fa-external-link"></i></a>&nbsp;</span></span></td><?php }?></td><?php
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER'] = $__foreach_LISTVIEW_HEADER_2_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?><tr class="listViewEntrie <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" nowrap><td class="listViewEntryValue"><a href="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('url');?>
" target="_BLANK" name="history_more"><?php echo vtranslate('LBL_MORE');?>
...</a></td><td nowrap class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"></td><td nowrap class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"></td></tr></table><?php }
}
