<?php
/* Smarty version 4.5.5, created on 2025-11-05 03:49:57
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\ModuleLinkCreator\ListViewContents.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690ac965158ca1_07545250',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4d7542097e89da44d82132e66d2ed6442245238a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\ModuleLinkCreator\\ListViewContents.tpl',
      1 => 1762314568,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690ac965158ca1_07545250 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="col-sm-12 col-xs-12 "><div class="row" style="margin-bottom: 20px"><h3 style="text-align: center;margin-top: 0; margin-bottom: 20px"><?php echo vtranslate('Welcome To Module & Link Creator',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h3><div class="listViewActionsDiv row"><table style="margin: 0 auto;"><tr><td><a id="Contacts_listView_basicAction_LBL_ADD_RECORD" target="_blank" href="index.php?module=ModuleLinkCreator&view=Edit" class="btn btn-default btn-warning">Custom Module</a></td><td><a href="index.php?module=ModuleLinkCreator&parent=Settings&view=IndexRelatedFields" target="_blank" class="btn btn-default btn-warning">1:M Relationship</a></td><td><a href="index.php?module=ModuleLinkCreator&parent=Settings&view=RelationshipMM" target="_blank" class="btn btn-default btn-warning">M:M Relationship</a></td><td><a href="index.php?module=ModuleLinkCreator&parent=Settings&view=RelationshipOneNone" target="_blank" class="btn btn-default btn-warning">One Way Relationship</a></td></tr></table></div></div><div class="listViewContentDiv" id="listViewContents" style="position: relative; clear:both;"><div class="listViewEntriesDiv contents-bottomscroll"><div class="bottomscroll-div"><?php $_smarty_tpl->_assignInScope('WIDTHTYPE', $_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('rowheight'));?><table id="module-link-creator-list-table" class="table table-bordered listview-table" style="border-top: 1px solid #ddd"><thead><tr class="listViewContentHeader"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value, 'LISTVIEW_HEADER', true, 'COLUMNNAME');
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration = 0;
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['COLUMNNAME']->value => $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value) {
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = false;
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration++;
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->last = $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration === $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->total;
$__foreach_LISTVIEW_HEADER_4_saved = $_smarty_tpl->tpl_vars['LISTVIEW_HEADER'];
?><th nowrap <?php if ($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->last) {?> colspan="2" <?php }?> style="text-align: right;"><?php if ($_smarty_tpl->tpl_vars['COLUMNNAME']->value != 'description') {
echo vtranslate($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value,$_smarty_tpl->tpl_vars['MODULE']->value);
} else {
echo vtranslate('Icon',$_smarty_tpl->tpl_vars['MODULE']->value);
}?></th><?php
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER'] = $__foreach_LISTVIEW_HEADER_4_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tr></thead><tbody class="overflow-y"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RECORDS']->value, 'LISTVIEW_ENTRY', false, NULL, 'listview', array (
  'index' => true,
));
$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value) {
$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_listview']->value['index']++;
?><tr class="listViewEntries" data-id='<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('id');?>
'id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_listView_row_<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_listview']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_listview']->value['index'] : null)+1;?>
"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value, 'LISTVIEW_HEADER', true, 'COLUMNNAME');
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration = 0;
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['COLUMNNAME']->value => $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value) {
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = false;
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration++;
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->last = $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration === $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->total;
$__foreach_LISTVIEW_HEADER_6_saved = $_smarty_tpl->tpl_vars['LISTVIEW_HEADER'];
if ($_smarty_tpl->tpl_vars['COLUMNNAME']->value != 'description') {?><td class="<?php if ($_smarty_tpl->tpl_vars['COLUMNNAME']->value == 'filename') {?>listViewEntryValue<?php }?> <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" nowrap data-column="<?php echo $_smarty_tpl->tpl_vars['COLUMNNAME']->value;?>
"><?php if ($_smarty_tpl->tpl_vars['COLUMNNAME']->value == 'filename') {?><a href='index.php?module=ModuleLinkCreator&view=Edit&record=<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('id');?>
'><?php echo vtranslate($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get($_smarty_tpl->tpl_vars['COLUMNNAME']->value),$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get($_smarty_tpl->tpl_vars['COLUMNNAME']->value));?>
</a><?php } elseif ($_smarty_tpl->tpl_vars['COLUMNNAME']->value == 'module') {
echo vtranslate($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get($_smarty_tpl->tpl_vars['COLUMNNAME']->value),$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get($_smarty_tpl->tpl_vars['COLUMNNAME']->value));
} else {
echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get($_smarty_tpl->tpl_vars['COLUMNNAME']->value);
}?></td><?php }
if ($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->last) {?><td nowrap class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><div class="actions pull-right"><span class="actionImages">&nbsp;&nbsp;<i class="vicon-<?php echo strtolower($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('module_name'));?>
"></i>&nbsp;<button type="button" data-module="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('module_name');?>
" class="btn btn-default btn-update-icon" data-toggle="modal" data-target="#ModalIcons">Update Icon</button></span></div></td><?php }
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER'] = $__foreach_LISTVIEW_HEADER_6_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value == '0') {?><tr class="emptyRecordsDiv"><td colspan="5"><div class="emptyRecordsContent"><?php $_smarty_tpl->_assignInScope('SINGLE_MODULE', "SINGLE_".((string)$_smarty_tpl->tpl_vars['MODULE']->value));
echo vtranslate('LBL_NO');?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate('LBL_FOUND');?>
.<?php if ($_smarty_tpl->tpl_vars['IS_MODULE_EDITABLE']->value) {?> <?php echo vtranslate('LBL_CREATE');?>
 <a href="index.php?module=ModuleLinkCreator&view=Edit"><?php echo vtranslate($_smarty_tpl->tpl_vars['SINGLE_MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a><?php }?></div></td></tr><?php }?></tbody></table><!-- Modal --><div class="modal fade" id="ModalIcons" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true"><div class="modal-dialog" role="document" style="width: 680px"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Modal Header</h4></div><div class="modal-body" style="max-height: 500px; overflow: scroll; overflow-x: hidden;"><div class="form"><input value="" type="hidden" id="selected_module"/><?php $_smarty_tpl->_assignInScope('LISTICONS_LENGTH', (count($_smarty_tpl->tpl_vars['LISTICONS']->value)-1));
$_smarty_tpl->_assignInScope('INDEX', 0);?><table data-length="<?php echo $_smarty_tpl->tpl_vars['LISTICONS_LENGTH']->value;?>
" border="1px solid #cccccc"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LISTICONS']->value, 'val', false, 'k');
$_smarty_tpl->tpl_vars['val']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->do_else = false;
$_smarty_tpl->_assignInScope('MODE4OK', (($_smarty_tpl->tpl_vars['INDEX']->value % 14) == 0));
if ($_smarty_tpl->tpl_vars['MODE4OK']->value) {?><tr><?php }?><td style="padding: 5px;" class="cell-icon"><span class="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
 icon-module" style="font-size: 30px; vertical-align: middle;" data-info="<?php echo $_smarty_tpl->tpl_vars['val']->value;?>
"></span></td><?php if (($_smarty_tpl->tpl_vars['INDEX']->value % 14) == 13 || $_smarty_tpl->tpl_vars['LISTICONS_LENGTH']->value == $_smarty_tpl->tpl_vars['INDEX']->value) {?></tr><?php }?><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['INDEX']->value++;?>
"><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></table></div></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button><button type="button" class="btn btn-primary btn-submit">Save</button></div></div></div></div><!--added this div for Temporarily --></div></div></div></div>
<?php }
}
