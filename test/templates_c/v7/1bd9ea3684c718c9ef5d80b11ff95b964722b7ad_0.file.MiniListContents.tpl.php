<?php
/* Smarty version 4.5.5, created on 2025-09-30 08:48:27
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Vtiger\dashboards\MiniListContents.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68db995b12b067_79892264',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1bd9ea3684c718c9ef5d80b11ff95b964722b7ad' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Vtiger\\dashboards\\MiniListContents.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68db995b12b067_79892264 (Smarty_Internal_Template $_smarty_tpl) {
?><div style='padding-top: 0;margin-bottom: 2%;padding-right:15px;'>
    <input type="hidden" id="widget_<?php echo $_smarty_tpl->tpl_vars['WIDGET']->value->get('id');?>
_currentPage" value="<?php echo $_smarty_tpl->tpl_vars['CURRENT_PAGE']->value;?>
">
		<?php $_smarty_tpl->_assignInScope('SPANSIZE', 12);?>
	<?php $_smarty_tpl->_assignInScope('HEADER_COUNT', $_smarty_tpl->tpl_vars['MINILIST_WIDGET_MODEL']->value->getHeaderCount());?>
	<?php if ($_smarty_tpl->tpl_vars['HEADER_COUNT']->value) {?>
		<?php $_smarty_tpl->_assignInScope('SPANSIZE', 12/$_smarty_tpl->tpl_vars['HEADER_COUNT']->value);?>
	<?php }?>

	<div class="row" style="padding:5px">
		<?php $_smarty_tpl->_assignInScope('HEADER_FIELDS', $_smarty_tpl->tpl_vars['MINILIST_WIDGET_MODEL']->value->getHeaders());?>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['HEADER_FIELDS']->value, 'FIELD');
$_smarty_tpl->tpl_vars['FIELD']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD']->value) {
$_smarty_tpl->tpl_vars['FIELD']->do_else = false;
?>
		<div class="col-lg-<?php echo $_smarty_tpl->tpl_vars['SPANSIZE']->value;?>
"><strong><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD']->value->get('label'),$_smarty_tpl->tpl_vars['BASE_MODULE']->value);?>
</strong></div>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	</div>

	<?php $_smarty_tpl->_assignInScope('MINILIST_WIDGET_RECORDS', $_smarty_tpl->tpl_vars['MINILIST_WIDGET_MODEL']->value->getRecords());?>

	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MINILIST_WIDGET_RECORDS']->value, 'RECORD');
$_smarty_tpl->tpl_vars['RECORD']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['RECORD']->value) {
$_smarty_tpl->tpl_vars['RECORD']->do_else = false;
?>
	<div class="row miniListContent" style="padding:5px">
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['HEADER_FIELDS']->value, 'FIELD', false, 'NAME', 'minilistWidgetModelRowHeaders', array (
  'last' => true,
  'iteration' => true,
  'total' => true,
));
$_smarty_tpl->tpl_vars['FIELD']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['NAME']->value => $_smarty_tpl->tpl_vars['FIELD']->value) {
$_smarty_tpl->tpl_vars['FIELD']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_minilistWidgetModelRowHeaders']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_minilistWidgetModelRowHeaders']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_minilistWidgetModelRowHeaders']->value['iteration'] === $_smarty_tpl->tpl_vars['__smarty_foreach_minilistWidgetModelRowHeaders']->value['total'];
?>
			<div class="col-lg-<?php echo $_smarty_tpl->tpl_vars['SPANSIZE']->value;?>
 textOverflowEllipsis" title="<?php echo strip_tags($_smarty_tpl->tpl_vars['RECORD']->value->get($_smarty_tpl->tpl_vars['NAME']->value));?>
" style="padding-right: 5px;">
               <?php if ($_smarty_tpl->tpl_vars['FIELD']->value->get('uitype') == '71' || ($_smarty_tpl->tpl_vars['FIELD']->value->get('uitype') == '72' && $_smarty_tpl->tpl_vars['FIELD']->value->getName() == 'unit_price')) {?>
					<?php $_smarty_tpl->_assignInScope('CURRENCY_ID', $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('currency_id'));?>
					<?php if ($_smarty_tpl->tpl_vars['FIELD']->value->get('uitype') == '72' && $_smarty_tpl->tpl_vars['NAME']->value == 'unit_price') {?>
						<?php $_smarty_tpl->_assignInScope('CURRENCY_ID', getProductBaseCurrency($_smarty_tpl->tpl_vars['RECORD_ID']->value,$_smarty_tpl->tpl_vars['RECORD']->value->getModuleName()));?>
					<?php }?>
					<?php $_smarty_tpl->_assignInScope('CURRENCY_INFO', getCurrencySymbolandCRate($_smarty_tpl->tpl_vars['CURRENCY_ID']->value));?>
					<?php if ($_smarty_tpl->tpl_vars['RECORD']->value->get($_smarty_tpl->tpl_vars['NAME']->value) != NULL) {?>
						&nbsp;<?php echo CurrencyField::appendCurrencySymbol($_smarty_tpl->tpl_vars['RECORD']->value->get($_smarty_tpl->tpl_vars['NAME']->value),$_smarty_tpl->tpl_vars['CURRENCY_INFO']->value['symbol']);?>
&nbsp;
					<?php }?>
				<?php } else { ?>
					<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get($_smarty_tpl->tpl_vars['NAME']->value);?>
&nbsp;
				<?php }?>
				<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_minilistWidgetModelRowHeaders']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_minilistWidgetModelRowHeaders']->value['last'] : null)) {?>
					<a href="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getDetailViewUrl();?>
" class="pull-right"><i title="<?php echo vtranslate('LBL_SHOW_COMPLETE_DETAILS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
" class="fa fa-list"></i></a>
				<?php }?>
			</div>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	</div>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    
    <?php if ($_smarty_tpl->tpl_vars['MORE_EXISTS']->value) {?>
        <div class="moreLinkDiv" style="padding-top:10px;padding-bottom:5px;">
            <a class="miniListMoreLink" data-linkid="<?php echo $_smarty_tpl->tpl_vars['WIDGET']->value->get('linkid');?>
" data-widgetid="<?php echo $_smarty_tpl->tpl_vars['WIDGET']->value->get('id');?>
" onclick="Vtiger_MiniList_Widget_Js.registerMoreClickEvent(event);"><?php echo vtranslate('LBL_MORE');?>
...</a>
        </div>
    <?php }?>
</div><?php }
}
