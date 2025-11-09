<?php
/* Smarty version 4.5.5, created on 2025-11-06 01:06:09
  from 'C:\xampp\htdocs\HTQL-Khach-Hang-CRM-vvan\layouts\v7\modules\Vtiger\FindDuplicateContents.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690bf4814f1486_53878269',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2b7d256001d29f2052ce9ce1889771a6c7ac1841' => 
    array (
      0 => 'C:\\xampp\\htdocs\\HTQL-Khach-Hang-CRM-vvan\\layouts\\v7\\modules\\Vtiger\\FindDuplicateContents.tpl',
      1 => 1762352656,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690bf4814f1486_53878269 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div>
	<?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "FindDuplicateHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</div>
<div id="findDuplicateContents" class="container-fluid" style="padding-top:5px;">
	<div class="row">
		<div class="col-lg-12">
			<input type="hidden" id="listViewEntriesCount" value="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value;?>
" />
			<input type="hidden" id="pageStartRange" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->getRecordStartRange();?>
" />
			<input type="hidden" id="pageEndRange" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->getRecordEndRange();?>
" />
			<input type="hidden" id="previousPageExist" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->isPrevPageExists();?>
" />
			<input type="hidden" id="nextPageExist" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->isNextPageExists();?>
" />
			<input type="hidden" id="pageNumber" value= "<?php echo $_smarty_tpl->tpl_vars['PAGE_NUMBER']->value;?>
"/>
			<input type="hidden" id="pageLimit" value= "<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->getPageLimit();?>
" />
			<input type="hidden" id="noOfEntries" value= "<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value;?>
" />
			<input type="hidden" id="duplicateSearchFields" value=<?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['DUPLICATE_SEARCH_FIELDS']->value);?>
 />
			<input type="hidden" id="viewName" value="<?php echo $_smarty_tpl->tpl_vars['VIEW_NAME']->value;?>
" />
			<input type="hidden" id="totalCount" value="<?php echo $_smarty_tpl->tpl_vars['TOTAL_COUNT']->value;?>
" />
			<input type='hidden' id='ignoreEmpty' value="<?php echo $_smarty_tpl->tpl_vars['IGNORE_EMPTY']->value;?>
" />
			<input type="hidden" id="mergeSelectedIds" />
			<?php $_smarty_tpl->_assignInScope('IS_EDITABLE', $_smarty_tpl->tpl_vars['CURRENT_USER_PRIVILAGES_MODEL']->value->hasModuleActionPermission($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getId(),'EditView'));?>
			<?php $_smarty_tpl->_assignInScope('IS_DELETABLE', $_smarty_tpl->tpl_vars['CURRENT_USER_PRIVILAGES_MODEL']->value->hasModuleActionPermission($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getId(),'Delete'));?>

			<table id="listview-table" class="listview-table table table-bordered" style="border-top:1px solid #ddd;">
				<thead>
					<tr class="listViewContentHeader">
						<?php if ($_smarty_tpl->tpl_vars['IS_DELETABLE']->value) {?>
							<th>
								<center><input type="checkbox" class="listViewEntriesMainCheckBox" /></center>
							</th>
						<?php }?>
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value, 'LISTVIEW_HEADER');
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value) {
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = false;
?>
							<th>
								<center><?php echo vtranslate($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
</center>
							</th>
						<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
						<?php if ($_smarty_tpl->tpl_vars['IS_EDITABLE']->value && $_smarty_tpl->tpl_vars['IS_DELETABLE']->value) {?>
							<th> <center><?php echo vtranslate('LBL_MERGE_SELECT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</center></th>
							<th> <center><?php echo vtranslate('LBL_ACTION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</center></th>
						<?php }?>
					</tr>
				</thead>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES']->value, 'LISTVIEW_ENTRY', false, 'GROUP_NAME');
$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['GROUP_NAME']->value => $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value) {
$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->do_else = false;
?>
					<?php $_smarty_tpl->_assignInScope('groupCount', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'php7_sizeof' ][ 0 ], array( $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value )));?>
					<?php $_smarty_tpl->_assignInScope('recordCount', 0);?>
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value, 'RECORD', false, NULL, 'listview', array (
  'index' => true,
));
$_smarty_tpl->tpl_vars['RECORD']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['RECORD']->value) {
$_smarty_tpl->tpl_vars['RECORD']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_listview']->value['index']++;
?>
						<tr class="listViewEntries" data-id='<?php echo $_smarty_tpl->tpl_vars['RECORD']->value['recordid'];?>
' id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_listView_row_<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_listview']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_listview']->value['index'] : null)+1;?>
">
							<?php if ($_smarty_tpl->tpl_vars['IS_DELETABLE']->value) {?>
								<td>
									<center><input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value['recordid'];?>
" class="listViewEntriesCheckBox"/></center>
								</td>
							<?php }?>
							<?php $_smarty_tpl->_assignInScope('sameRowValues', true);?>
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value, 'LISTVIEW_HEADER');
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value) {
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = false;
?>
							<?php if ($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name') == 'recordid') {?>
								<td nowrap>
									<center><a href="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getDetailViewUrl($_smarty_tpl->tpl_vars['RECORD']->value['recordid']);?>
"><?php echo $_smarty_tpl->tpl_vars['RECORD']->value[$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name')];?>
</a></center>
								</td>
							<?php } else { ?>
								<td name="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name');?>
" nowrap style='border-bottom:1px solid #DDD;' data-value="<?php echo strip_tags($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getDisplayValue($_smarty_tpl->tpl_vars['RECORD']->value[$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('column')],$_smarty_tpl->tpl_vars['RECORD']->value['recordid']));?>
">
									<center><?php echo strip_tags($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getDisplayValue($_smarty_tpl->tpl_vars['RECORD']->value[$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('column')],$_smarty_tpl->tpl_vars['RECORD']->value['recordid']));?>
</center>
								</td>
							<?php }?>
							<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
							<?php if ($_smarty_tpl->tpl_vars['IS_EDITABLE']->value && $_smarty_tpl->tpl_vars['IS_DELETABLE']->value) {?>
								<td>
									<center><input type="checkbox" data-id='<?php echo $_smarty_tpl->tpl_vars['RECORD']->value['recordid'];?>
' name="mergeRecord" data-group="<?php echo $_smarty_tpl->tpl_vars['GROUP_NAME']->value;?>
"/></center>
								</td>
								<?php if ($_smarty_tpl->tpl_vars['recordCount']->value == 0) {?>
									<td rowspan="<?php echo $_smarty_tpl->tpl_vars['groupCount']->value;?>
" style="vertical-align: middle;">
										<center><input type="button" value="<?php echo vtranslate('Merge',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" name="merge" class="btn btn-success" data-group="<?php echo $_smarty_tpl->tpl_vars['GROUP_NAME']->value;?>
"></center>
									</td>
								<?php }?>
							<?php }?>
							<?php $_smarty_tpl->_assignInScope('recordCount', $_smarty_tpl->tpl_vars['recordCount']->value+1);?>
						</tr>
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</table>
			<?php if ((isset($_smarty_tpl->tpl_vars['recordCount']->value)) && $_smarty_tpl->tpl_vars['recordCount']->value == 0) {?>
				<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 listViewContentDiv list-table-wrapper" id="listViewContents">
					<table class="emptyRecordsDiv">
						<tbody class="overflow-y">
							<tr class="emptyRecordDiv">
								<td colspan="8">
									<div class="emptyRecordsContent portal-empty-records-content">
										<?php echo vtranslate('LBL_NO_DUPLICATED_FOUND');?>
.
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			<?php }?>
		</div>
	</div>
</div><?php }
}
