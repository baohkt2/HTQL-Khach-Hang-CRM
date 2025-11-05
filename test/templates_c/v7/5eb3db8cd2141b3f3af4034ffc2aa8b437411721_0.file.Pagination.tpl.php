<?php
/* Smarty version 4.5.5, created on 2025-11-05 04:53:49
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Vtiger\Pagination.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690ad85d452a06_49312735',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5eb3db8cd2141b3f3af4034ffc2aa8b437411721' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Vtiger\\Pagination.tpl',
      1 => 1762318404,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690ad85d452a06_49312735 (Smarty_Internal_Template $_smarty_tpl) {
if (!$_smarty_tpl->tpl_vars['CLASS_VIEW_ACTION']->value) {?>
    <?php $_smarty_tpl->_assignInScope('CLASS_VIEW_ACTION', 'listViewActions');?>
    <?php $_smarty_tpl->_assignInScope('CLASS_VIEW_PAGING_INPUT', 'listViewPagingInput');?>
    <?php $_smarty_tpl->_assignInScope('CLASS_VIEW_PAGING_INPUT_SUBMIT', 'listViewPagingInputSubmit');?>
    <?php $_smarty_tpl->_assignInScope('CLASS_VIEW_BASIC_ACTION', 'listViewBasicAction');
}?>
<div class = "<?php echo $_smarty_tpl->tpl_vars['CLASS_VIEW_ACTION']->value;?>
">
    <!-- Total Records Display - Moved to ListViewActions.tpl next to More button -->
    <div class="btn-group pull-right">
        <button type="button" id="PreviousPageButton" class="btn btn-default" <?php if (!$_smarty_tpl->tpl_vars['PAGING_MODEL']->value->isPrevPageExists()) {?> disabled <?php }?>><i class="fa fa-caret-left"></i></button>
        <?php if ($_smarty_tpl->tpl_vars['SHOWPAGEJUMP']->value) {?>
            <button type="button" id="PageJump" data-toggle="dropdown" class="btn btn-default">
                <i class="fa fa-ellipsis-h icon" title="<?php echo vtranslate('LBL_LISTVIEW_PAGE_JUMP',$_smarty_tpl->tpl_vars['moduleName']->value);?>
"></i>
            </button>
            <ul class="<?php echo $_smarty_tpl->tpl_vars['CLASS_VIEW_BASIC_ACTION']->value;?>
 dropdown-menu" id="PageJumpDropDown">
                <li>
                    <div class="listview-pagenum">
                        <span ><?php echo vtranslate('LBL_PAGE',$_smarty_tpl->tpl_vars['moduleName']->value);?>
</span>&nbsp;
                        <strong><span><?php echo $_smarty_tpl->tpl_vars['PAGE_NUMBER']->value;?>
</span></strong>&nbsp;
                        <span ><?php echo vtranslate('LBL_OF',$_smarty_tpl->tpl_vars['moduleName']->value);?>
</span>&nbsp;
                        <strong><span id="totalPageCount"></span></strong>
                    </div>
                    <div class="listview-pagejump">
                        <input type="text" id="pageToJump" placeholder="<?php echo vtranslate('LBL_LISTVIEW_JUMP_TO',$_smarty_tpl->tpl_vars['moduleName']->value);?>
" class="<?php echo $_smarty_tpl->tpl_vars['CLASS_VIEW_PAGING_INPUT']->value;?>
 text-center"/>&nbsp;
                        <button type="button" id="pageToJumpSubmit" class="btn btn-success <?php echo $_smarty_tpl->tpl_vars['CLASS_VIEW_PAGING_INPUT_SUBMIT']->value;?>
 text-center"><?php echo 'GO';?>
</button>
                    </div>    
                </li>
            </ul>
        <?php }?>
        <button type="button" id="NextPageButton" class="btn btn-default" <?php if (!$_smarty_tpl->tpl_vars['PAGING_MODEL']->value->isNextPageExists()) {?>disabled<?php }?>><i class="fa fa-caret-right"></i></button>
    </div>
    <span class="pageNumbers  pull-right" style="position:relative;top:7px;">
        <span class="pageNumbersText">
            <?php if ($_smarty_tpl->tpl_vars['RECORD_COUNT']->value) {
echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->getRecordStartRange();?>
 <?php echo vtranslate('LBL_to',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->getRecordEndRange();
} else { ?>
            <?php }?>
        </span>
        &nbsp;<span class="totalNumberOfRecords cursorPointer<?php if (!$_smarty_tpl->tpl_vars['RECORD_COUNT']->value) {?> hide<?php }?>" title="<?php echo vtranslate('LBL_SHOW_TOTAL_NUMBER_OF_RECORDS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><?php echo vtranslate('LBL_OF',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <i class="fa fa-question showTotalCountIcon"></i></span>&nbsp;&nbsp;
    </span>
</div><?php }
}
