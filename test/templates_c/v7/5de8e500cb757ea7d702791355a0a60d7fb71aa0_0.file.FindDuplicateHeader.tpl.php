<?php
/* Smarty version 4.5.5, created on 2025-10-10 08:47:08
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Vtiger\FindDuplicateHeader.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e8c80c4d8737_64555643',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5de8e500cb757ea7d702791355a0a60d7fb71aa0' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Vtiger\\FindDuplicateHeader.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e8c80c4d8737_64555643 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container-fluid">
	<div class="row">
		<?php ob_start();
echo ((vtranslate('LBL_DUPLICATE')).(' ')).(vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value));
$_prefixVariable1 = ob_get_clean();
$_smarty_tpl->_assignInScope('HEADER_TITLE', $_prefixVariable1);?>
		<h3>
			<div class="col-lg-7">
				<?php echo $_smarty_tpl->tpl_vars['HEADER_TITLE']->value;?>

			 </div>
			<div class="col-lg-5">
				<div class="alert alert-static">
					<span class="fa fa-info-circle icon"></span>
					<span class="message"><?php echo vJsTranslate('JS_ALLOWED_TO_SELECT_MAX_OF_THREE_RECORDS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span>
				</div>
			</div>
		</h3>
	</div>
	<div class="row">
		<div class="col-lg-1">
			<?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value > 0) {?>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['LISTVIEW_LINKS']->value, 'LISTVIEW_BASICACTION');
$_smarty_tpl->tpl_vars['LISTVIEW_BASICACTION']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_BASICACTION']->value) {
$_smarty_tpl->tpl_vars['LISTVIEW_BASICACTION']->do_else = false;
?>
					<button id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_listView_basicAction_<?php echo Vtiger_Util_Helper::replaceSpaceWithUnderScores($_smarty_tpl->tpl_vars['LISTVIEW_BASICACTION']->value->getLabel());?>
" class="btn btn-danger pull-left" 
						<?php if (stripos($_smarty_tpl->tpl_vars['LISTVIEW_BASICACTION']->value->getUrl(),'javascript:') === 0) {?> onclick='<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'substr' ][ 0 ], array( $_smarty_tpl->tpl_vars['LISTVIEW_BASICACTION']->value->getUrl(),strlen("javascript:") ));?>
;'<?php } else { ?> onclick='window.location.href="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_BASICACTION']->value->getUrl();?>
"'<?php }?>>
							<strong><?php echo vtranslate($_smarty_tpl->tpl_vars['LISTVIEW_BASICACTION']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong>
					</button>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			<?php }?>
		</div>
		<div class="col-lg-11">
			<div class="col-lg-1">
				&nbsp;
			</div>
			<div class="col-lg-9 select-deselect-container" >
				<div class="hide messageContainer" style = "height:30px;">
					<center><a id="selectAllMsgDiv" href="#"><?php echo vtranslate('LBL_SELECT_ALL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;(<span id="totalRecordsCount" value=""></span>)</a></center>
				</div>
				<div class="hide messageContainer" style = "height:30px;">
					<center><a id="deSelectAllMsgDiv" href="#"><?php echo vtranslate('LBL_DESELECT_ALL_RECORDS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></center>
				</div>
			</div>
			<?php $_smarty_tpl->_assignInScope('RECORD_COUNT', $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value);?>
			<?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "Pagination.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('SHOWPAGEJUMP'=>true), 0, true);
?>
		</div>
	</div>
</div><?php }
}
