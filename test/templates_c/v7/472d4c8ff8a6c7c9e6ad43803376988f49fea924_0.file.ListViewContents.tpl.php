<?php
/* Smarty version 4.5.5, created on 2025-11-02 07:43:56
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\Workflows\ListViewContents.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_69070bbc7feea2_97104006',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '472d4c8ff8a6c7c9e6ad43803376988f49fea924' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\Workflows\\ListViewContents.tpl',
      1 => 1761802269,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69070bbc7feea2_97104006 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="col-sm-12 col-xs-12 "><input type="hidden" id="pageStartRange" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->getRecordStartRange();?>
" /><input type="hidden" id="pageEndRange" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->getRecordEndRange();?>
" /><input type="hidden" id="previousPageExist" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->isPrevPageExists();?>
" /><input type="hidden" id="nextPageExist" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->isNextPageExists();?>
" /><input type="hidden" id="totalCount" value="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_COUNT']->value;?>
" /><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['ORDER_BY']->value;?>
" id="orderBy"><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['SORT_ORDER']->value;?>
" id="sortOrder"><input type="hidden" id="totalCount" value="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_COUNT']->value;?>
" /><input type='hidden' value="<?php echo $_smarty_tpl->tpl_vars['PAGE_NUMBER']->value;?>
" id='pageNumber'><input type='hidden' value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->getPageLimit();?>
" id='pageLimit'><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value;?>
" id="noOfEntries"><div class = "row"><div class='col-md-5'><div class="foldersContainer hidden-xs pull-left"><select class="select2" style="width: 300px;" id="moduleFilter"><option value="" data-count='<?php echo $_smarty_tpl->tpl_vars['MODULES_COUNT']->value['All'];?>
'><?php echo vtranslate('LBL_ALL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<?php echo vtranslate('LBL_WORKFLOWS');?>
</option><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['SUPPORTED_MODULE_MODELS']->value, 'MODULE_MODEL', false, 'TAB_ID');
$_smarty_tpl->tpl_vars['MODULE_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['TAB_ID']->value => $_smarty_tpl->tpl_vars['MODULE_MODEL']->value) {
$_smarty_tpl->tpl_vars['MODULE_MODEL']->do_else = false;
?><option <?php if ($_smarty_tpl->tpl_vars['SOURCE_MODULE']->value == $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getName()) {?> selected="" <?php }?> value="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getName();?>
" data-count='<?php if ((isset($_smarty_tpl->tpl_vars['MODULES_COUNT']->value[$_smarty_tpl->tpl_vars['TAB_ID']->value])) && $_smarty_tpl->tpl_vars['MODULES_COUNT']->value[$_smarty_tpl->tpl_vars['TAB_ID']->value]) {
echo $_smarty_tpl->tpl_vars['MODULES_COUNT']->value[$_smarty_tpl->tpl_vars['TAB_ID']->value];
} else { ?>0<?php }?>'><?php if ($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getName() == 'Calendar') {
echo vtranslate('LBL_TASK',$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getName());?>
&nbsp;<?php echo vtranslate('LBL_WORKFLOWS');
} else {
echo vtranslate($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getName(),$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getName());?>
&nbsp;<?php echo vtranslate('LBL_WORKFLOWS');
}?></option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></div></div><div class="col-md-4"><div class="search-link hidden-xs" style="margin-top: 0px;"><span aria-hidden="true" class="fa fa-search"></span><input class="searchWorkflows" type="text" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'htmlentities' ][ 0 ], array( decode_html($_smarty_tpl->tpl_vars['SEARCH_VALUE']->value) ));?>
" placeholder="<?php echo vtranslate('LBL_WORKFLOW_SEARCH',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></div></div><div class="col-md-3"><?php $_smarty_tpl->_assignInScope('RECORD_COUNT', $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value);
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "Pagination.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('SHOWPAGEJUMP'=>true), 0, true);
?></div></div><div class="list-content row"><div class="col-sm-12 col-xs-12 "><div id="table-content" class="table-container" style="padding-top:0px !important;"><table id="listview-table" class="workflow-table table listview-table"><?php $_smarty_tpl->_assignInScope('NAME_FIELDS', $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getNameFields());
$_smarty_tpl->_assignInScope('WIDTHTYPE', $_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('rowheight'));?><thead><tr class="listViewContentHeader"><th style="width: 100px;"></th><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value, 'LISTVIEW_HEADER', true);
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration = 0;
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value) {
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = false;
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration++;
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->last = $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration === $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->total;
$__foreach_LISTVIEW_HEADER_1_saved = $_smarty_tpl->tpl_vars['LISTVIEW_HEADER'];
$_smarty_tpl->_assignInScope('HEADER_NAME', ((string)$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name')));
if ($_smarty_tpl->tpl_vars['HEADER_NAME']->value != 'summary' && $_smarty_tpl->tpl_vars['HEADER_NAME']->value != 'module_name') {?><th nowrap><a <?php if (!($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->has('sort'))) {?> class="listViewHeaderValues cursorPointer" data-nextsortorderval="<?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value == $_smarty_tpl->tpl_vars['HEADER_NAME']->value) {
echo $_smarty_tpl->tpl_vars['NEXT_SORT_ORDER']->value;
} else { ?>ASC<?php }?>" data-columnname="<?php echo $_smarty_tpl->tpl_vars['HEADER_NAME']->value;?>
" <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('label'),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value == $_smarty_tpl->tpl_vars['HEADER_NAME']->value) {?><img class="<?php echo $_smarty_tpl->tpl_vars['SORT_IMAGE']->value;?>
 icon-white"><?php }?></a>&nbsp;</th><?php } elseif ($_smarty_tpl->tpl_vars['HEADER_NAME']->value == 'module_name' && empty($_smarty_tpl->tpl_vars['SOURCE_MODULE']->value)) {?><th nowrap><a <?php if (!($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->has('sort'))) {?> class="listViewHeaderValues cursorPointer" data-nextsortorderval="<?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value == $_smarty_tpl->tpl_vars['HEADER_NAME']->value) {
echo $_smarty_tpl->tpl_vars['NEXT_SORT_ORDER']->value;
} else { ?>ASC<?php }?>" data-columnname="<?php echo $_smarty_tpl->tpl_vars['HEADER_NAME']->value;?>
" <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('label'),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value == $_smarty_tpl->tpl_vars['HEADER_NAME']->value) {?><img class="<?php echo $_smarty_tpl->tpl_vars['SORT_IMAGE']->value;?>
 icon-white"><?php }?></a>&nbsp;</th><?php } else {
}
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER'] = $__foreach_LISTVIEW_HEADER_1_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?><th nowrap><?php echo vtranslate('LBL_ACTIONS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th></tr></thead><tbody><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES']->value, 'LISTVIEW_ENTRY');
$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value) {
$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->do_else = false;
?><tr class="listViewEntries" data-id="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getId();?>
"data-recordurl="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getEditViewUrl();?>
&mode=V7Edit"><td><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ListViewRecordActions.tpl",$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></td><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value, 'LISTVIEW_HEADER', true);
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration = 0;
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value) {
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->do_else = false;
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration++;
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->last = $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration === $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->total;
$__foreach_LISTVIEW_HEADER_3_saved = $_smarty_tpl->tpl_vars['LISTVIEW_HEADER'];
$_smarty_tpl->_assignInScope('LISTVIEW_HEADERNAME', $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name'));
$_smarty_tpl->_assignInScope('LAST_COLUMN', $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->last);
if ($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value != 'summary' && $_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value != 'module_name') {?><td class="listViewEntryValue <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" width="<?php echo (isset($_smarty_tpl->tpl_vars['WIDTH']->value)) ? $_smarty_tpl->tpl_vars['WIDTH']->value : '';?>
%" nowrap><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value == 'test') {
$_smarty_tpl->_assignInScope('WORKFLOW_CONDITION', $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getConditonDisplayValue());
$_smarty_tpl->_assignInScope('ALL_CONDITIONS', (isset($_smarty_tpl->tpl_vars['WORKFLOW_CONDITION']->value['All'])) ? $_smarty_tpl->tpl_vars['WORKFLOW_CONDITION']->value['All'] : '');
$_smarty_tpl->_assignInScope('ANY_CONDITIONS', (isset($_smarty_tpl->tpl_vars['WORKFLOW_CONDITION']->value['Any'])) ? $_smarty_tpl->tpl_vars['WORKFLOW_CONDITION']->value['Any'] : '');?><span><strong><?php echo vtranslate('All');?>
&nbsp;:&nbsp;&nbsp;&nbsp;</strong></span><?php if (is_array($_smarty_tpl->tpl_vars['ALL_CONDITIONS']->value) && !empty($_smarty_tpl->tpl_vars['ALL_CONDITIONS']->value)) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ALL_CONDITIONS']->value, 'ALL_CONDITION', false, NULL, 'allCounter', array (
  'iteration' => true,
));
$_smarty_tpl->tpl_vars['ALL_CONDITION']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ALL_CONDITION']->value) {
$_smarty_tpl->tpl_vars['ALL_CONDITION']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_allCounter']->value['iteration']++;
if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_allCounter']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_allCounter']->value['iteration'] : null) != 1) {?><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><?php }?><span><?php echo $_smarty_tpl->tpl_vars['ALL_CONDITION']->value;?>
</span><br><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
} else {
echo vtranslate('LBL_NA');
}?><br><span><strong><?php echo vtranslate('Any');?>
&nbsp;:&nbsp;</strong></span><?php if (is_array($_smarty_tpl->tpl_vars['ANY_CONDITIONS']->value) && !empty($_smarty_tpl->tpl_vars['ANY_CONDITIONS']->value)) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ANY_CONDITIONS']->value, 'ANY_CONDITION', false, NULL, 'anyCounter', array (
  'iteration' => true,
));
$_smarty_tpl->tpl_vars['ANY_CONDITION']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ANY_CONDITION']->value) {
$_smarty_tpl->tpl_vars['ANY_CONDITION']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_anyCounter']->value['iteration']++;
if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_anyCounter']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_anyCounter']->value['iteration'] : null) != 1) {?><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><?php }?><span><?php echo $_smarty_tpl->tpl_vars['ANY_CONDITION']->value;?>
</span><br><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
} else {
echo vtranslate('LBL_NA');
}
} elseif ($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value == 'execution_condition') {
echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getDisplayValue('v7_execution_condition');
} else {
echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getDisplayValue($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value);
}?></td><?php } elseif ($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value == 'module_name' && empty($_smarty_tpl->tpl_vars['SOURCE_MODULE']->value)) {?><td class="listViewEntryValue <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" width="<?php echo (isset($_smarty_tpl->tpl_vars['WIDTH']->value)) ? $_smarty_tpl->tpl_vars['WIDTH']->value : '';?>
%" nowrap><?php ob_start();
echo strtolower($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('raw_module_name'));
$_prefixVariable1=ob_get_clean();
$_smarty_tpl->_assignInScope('MODULE_ICON_NAME', $_prefixVariable1);
echo Vtiger_Module_Model::getModuleIconPath($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('raw_module_name'));?>
</td><?php } else {
}
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER'] = $__foreach_LISTVIEW_HEADER_3_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?><td class="listViewEntryValue <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" width="<?php echo (isset($_smarty_tpl->tpl_vars['WIDTH']->value)) ? $_smarty_tpl->tpl_vars['WIDTH']->value : '';?>
%" nowrap><?php $_smarty_tpl->_assignInScope('ACTIONS', $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getActionsDisplayValue());
if (is_array($_smarty_tpl->tpl_vars['ACTIONS']->value) && !empty($_smarty_tpl->tpl_vars['ACTIONS']->value)) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ACTIONS']->value, 'ACTION_COUNT', false, 'ACTION_NAME');
$_smarty_tpl->tpl_vars['ACTION_COUNT']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ACTION_NAME']->value => $_smarty_tpl->tpl_vars['ACTION_COUNT']->value) {
$_smarty_tpl->tpl_vars['ACTION_COUNT']->do_else = false;
echo vtranslate("LBL_".((string)$_smarty_tpl->tpl_vars['ACTION_NAME']->value),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;(<?php echo $_smarty_tpl->tpl_vars['ACTION_COUNT']->value;?>
)<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?></td></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value == '0') {?><tr class="emptyRecordsDiv"><?php ob_start();
echo php7_count($_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value)+1;
$_prefixVariable2 = ob_get_clean();
$_smarty_tpl->_assignInScope('COLSPAN_WIDTH', $_prefixVariable2);?><td colspan="<?php echo $_smarty_tpl->tpl_vars['COLSPAN_WIDTH']->value;?>
" style="vertical-align:inherit !important;"><center><?php echo vtranslate('LBL_NO');?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 <?php echo vtranslate('LBL_FOUND');?>
</center></td></tr><?php }?></tbody></table></div><div id="scroller_wrapper" class="bottom-fixed-scroll"><div id="scroller" class="scroller-div"></div></div></div></div></div>
<?php }
}
