<?php
/* Smarty version 4.5.5, created on 2025-10-30 05:35:18
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Vtiger\dashboards\HistoryContents.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_6902f916cc4ea1_57251673',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '54defe75c83f2a7509eae9ed3c233deb151bcef7' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Vtiger\\dashboards\\HistoryContents.tpl',
      1 => 1761802269,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6902f916cc4ea1_57251673 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div style='padding:5px;'>
	<?php if ($_smarty_tpl->tpl_vars['HISTORIES']->value != false) {?>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['HISTORIES']->value, 'HISTORY', false, 'index');
$_smarty_tpl->tpl_vars['HISTORY']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['index']->value => $_smarty_tpl->tpl_vars['HISTORY']->value) {
$_smarty_tpl->tpl_vars['HISTORY']->do_else = false;
?>
			<?php $_smarty_tpl->_assignInScope('MODELNAME', get_class($_smarty_tpl->tpl_vars['HISTORY']->value));?>
			<?php if ($_smarty_tpl->tpl_vars['MODELNAME']->value == 'ModTracker_Record_Model') {?>
				<?php $_smarty_tpl->_assignInScope('USER', $_smarty_tpl->tpl_vars['HISTORY']->value->getModifiedBy());?>
				<?php $_smarty_tpl->_assignInScope('TIME', $_smarty_tpl->tpl_vars['HISTORY']->value->getActivityTime());?>
				<?php $_smarty_tpl->_assignInScope('PARENT', $_smarty_tpl->tpl_vars['HISTORY']->value->getParent());?>
				<?php $_smarty_tpl->_assignInScope('MOD_NAME', $_smarty_tpl->tpl_vars['HISTORY']->value->getParent()->getModule()->getName());?>
				<?php $_smarty_tpl->_assignInScope('SINGLE_MODULE_NAME', ('SINGLE_').($_smarty_tpl->tpl_vars['MOD_NAME']->value));?>
				<?php $_smarty_tpl->_assignInScope('TRANSLATED_MODULE_NAME', vtranslate($_smarty_tpl->tpl_vars['MOD_NAME']->value,$_smarty_tpl->tpl_vars['MOD_NAME']->value));?>
				<?php $_smarty_tpl->_assignInScope('PROCEED', TRUE);?>
				<?php if (($_smarty_tpl->tpl_vars['HISTORY']->value->isRelationLink()) || ($_smarty_tpl->tpl_vars['HISTORY']->value->isRelationUnLink())) {?>
					<?php $_smarty_tpl->_assignInScope('RELATION', $_smarty_tpl->tpl_vars['HISTORY']->value->getRelationInstance());?>
					<?php if (!($_smarty_tpl->tpl_vars['RELATION']->value->getLinkedRecord())) {?>
						<?php $_smarty_tpl->_assignInScope('PROCEED', FALSE);?>
					<?php }?>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['PROCEED']->value) {?>
					<div class="row entry clearfix">
						<div class='col-lg-1 pull-left'>
							<?php $_smarty_tpl->_assignInScope('VT_ICON', $_smarty_tpl->tpl_vars['MOD_NAME']->value);?>
							<?php if ($_smarty_tpl->tpl_vars['MOD_NAME']->value == "Events") {?>
								<?php $_smarty_tpl->_assignInScope('TRANSLATED_MODULE_NAME', "Calendar");?>
								<?php $_smarty_tpl->_assignInScope('VT_ICON', "Calendar");?>
							<?php } elseif ($_smarty_tpl->tpl_vars['MOD_NAME']->value == "Calendar") {?>
								<?php $_smarty_tpl->_assignInScope('VT_ICON', "Task");?>
							<?php }?>
							<span><?php echo $_smarty_tpl->tpl_vars['HISTORY']->value->getParent()->getModule()->getModuleIcon($_smarty_tpl->tpl_vars['VT_ICON']->value);?>
</span>&nbsp;&nbsp;
						</div>
						<div class="col-lg-10 pull-left">
							<?php $_smarty_tpl->_assignInScope('DETAILVIEW_URL', $_smarty_tpl->tpl_vars['PARENT']->value->getDetailViewUrl());?>
							<?php if ($_smarty_tpl->tpl_vars['HISTORY']->value->isUpdate()) {?>
								<?php $_smarty_tpl->_assignInScope('FIELDS', $_smarty_tpl->tpl_vars['HISTORY']->value->getFieldInstances());?>
								<div>
									<div><b><?php echo $_smarty_tpl->tpl_vars['USER']->value->getName();?>
</b> <?php echo vtranslate('LBL_UPDATED');?>
 <a class="cursorPointer" <?php if (stripos($_smarty_tpl->tpl_vars['DETAILVIEW_URL']->value,'javascript:') === 0) {?>
																								  onclick='<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'substr' ][ 0 ], array( $_smarty_tpl->tpl_vars['DETAILVIEW_URL']->value,strlen("javascript:") ));?>
' <?php } else { ?> onclick='window.location.href="<?php echo $_smarty_tpl->tpl_vars['DETAILVIEW_URL']->value;?>
"' <?php }?>>
											<?php echo $_smarty_tpl->tpl_vars['PARENT']->value->getName();?>
</a>
									</div>
									<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FIELDS']->value, 'FIELD', false, 'INDEX');
$_smarty_tpl->tpl_vars['FIELD']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['INDEX']->value => $_smarty_tpl->tpl_vars['FIELD']->value) {
$_smarty_tpl->tpl_vars['FIELD']->do_else = false;
?>
										<?php if ($_smarty_tpl->tpl_vars['INDEX']->value < 2) {?>
											<?php if ($_smarty_tpl->tpl_vars['FIELD']->value && $_smarty_tpl->tpl_vars['FIELD']->value->getFieldInstance() && $_smarty_tpl->tpl_vars['FIELD']->value->getFieldInstance()->isViewableInDetailView()) {?>
												<div>
													<i><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD']->value->getName(),$_smarty_tpl->tpl_vars['FIELD']->value->getModuleName());?>
</i>
													<?php if ($_smarty_tpl->tpl_vars['FIELD']->value->get('prevalue') != '' && $_smarty_tpl->tpl_vars['FIELD']->value->get('postvalue') != '' && !($_smarty_tpl->tpl_vars['FIELD']->value->getFieldInstance()->getFieldDataType() == 'reference' && ($_smarty_tpl->tpl_vars['FIELD']->value->get('postvalue') == '0' || $_smarty_tpl->tpl_vars['FIELD']->value->get('prevalue') == '0'))) {?>
														&nbsp;<?php echo vtranslate('LBL_FROM');?>
 <b><?php echo Vtiger_Util_Helper::toVtiger6SafeHTML($_smarty_tpl->tpl_vars['FIELD']->value->getDisplayValue(decode_html($_smarty_tpl->tpl_vars['FIELD']->value->get('prevalue'))));?>
</b>
													<?php } elseif ($_smarty_tpl->tpl_vars['FIELD']->value->get('postvalue') == '' || ($_smarty_tpl->tpl_vars['FIELD']->value->getFieldInstance()->getFieldDataType() == 'reference' && $_smarty_tpl->tpl_vars['FIELD']->value->get('postvalue') == '0')) {?>
														&nbsp; <b> <?php echo vtranslate('LBL_DELETED');?>
 </b> ( <del><?php echo Vtiger_Util_Helper::toVtiger6SafeHTML($_smarty_tpl->tpl_vars['FIELD']->value->getDisplayValue(decode_html($_smarty_tpl->tpl_vars['FIELD']->value->get('prevalue'))));?>
</del> )
													<?php } else { ?>
														&nbsp;<?php echo vtranslate('LBL_CHANGED');?>

													<?php }?>
													<?php if ($_smarty_tpl->tpl_vars['FIELD']->value->get('postvalue') != '' && !($_smarty_tpl->tpl_vars['FIELD']->value->getFieldInstance()->getFieldDataType() == 'reference' && $_smarty_tpl->tpl_vars['FIELD']->value->get('postvalue') == '0')) {?>
														<?php echo vtranslate('LBL_TO');?>
 <b><?php echo Vtiger_Util_Helper::toVtiger6SafeHTML($_smarty_tpl->tpl_vars['FIELD']->value->getDisplayValue(decode_html($_smarty_tpl->tpl_vars['FIELD']->value->get('postvalue'))));?>
</b>
													<?php }?>    
												</div>
											<?php }?>
										<?php } else { ?>
											<a href="<?php echo $_smarty_tpl->tpl_vars['PARENT']->value->getUpdatesUrl();?>
"><?php echo vtranslate('LBL_MORE');?>
</a>
											<?php break 1;?>
										<?php }?>
									<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
								</div>
							<?php } elseif ($_smarty_tpl->tpl_vars['HISTORY']->value->isCreate()) {?>
								<div>
									<b><?php echo $_smarty_tpl->tpl_vars['USER']->value->getName();?>
</b> <?php echo vtranslate('LBL_ADDED');?>
 
									<a class="cursorPointer" <?php if (stripos($_smarty_tpl->tpl_vars['DETAILVIEW_URL']->value,'javascript:') === 0) {?> onclick='<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'substr' ][ 0 ], array( $_smarty_tpl->tpl_vars['DETAILVIEW_URL']->value,strlen("javascript:") ));?>
' <?php } else { ?> onclick='window.location.href="<?php echo $_smarty_tpl->tpl_vars['DETAILVIEW_URL']->value;?>
"' <?php }?>><?php echo $_smarty_tpl->tpl_vars['PARENT']->value->getName();?>
</a>
								</div>
							<?php } elseif (($_smarty_tpl->tpl_vars['HISTORY']->value->isRelationLink() || $_smarty_tpl->tpl_vars['HISTORY']->value->isRelationUnLink())) {?>
								<?php $_smarty_tpl->_assignInScope('RELATION', $_smarty_tpl->tpl_vars['HISTORY']->value->getRelationInstance());?>
								<?php $_smarty_tpl->_assignInScope('LINKED_RECORD_DETAIL_URL', $_smarty_tpl->tpl_vars['RELATION']->value->getLinkedRecord()->getDetailViewUrl());?>
								<?php $_smarty_tpl->_assignInScope('PARENT_DETAIL_URL', $_smarty_tpl->tpl_vars['RELATION']->value->getParent()->getParent()->getDetailViewUrl());?>
								<div>
									<b><?php echo $_smarty_tpl->tpl_vars['USER']->value->getName();?>
</b>
									<?php if ($_smarty_tpl->tpl_vars['HISTORY']->value->isRelationLink()) {?>
										<?php echo vtranslate('LBL_ADDED',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>

									<?php } else { ?>
										<?php echo vtranslate('LBL_REMOVED',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>

									<?php }?>
									<?php if ($_smarty_tpl->tpl_vars['RELATION']->value->getLinkedRecord()->getModuleName() == 'Calendar') {?>
										<?php if (isPermitted('Calendar','DetailView',$_smarty_tpl->tpl_vars['RELATION']->value->getLinkedRecord()->getId()) == 'yes') {?>
											<a class="cursorPointer" <?php if (stripos($_smarty_tpl->tpl_vars['LINKED_RECORD_DETAIL_URL']->value,'javascript:') === 0) {?> onclick='<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'substr' ][ 0 ], array( $_smarty_tpl->tpl_vars['LINKED_RECORD_DETAIL_URL']->value,strlen("javascript:") ));?>
'
											<?php } else { ?> onclick='window.location.href="<?php echo $_smarty_tpl->tpl_vars['LINKED_RECORD_DETAIL_URL']->value;?>
"' <?php }?>><?php echo $_smarty_tpl->tpl_vars['RELATION']->value->getLinkedRecord()->getName();?>
</a>
									<?php } else { ?>
										<?php echo vtranslate($_smarty_tpl->tpl_vars['RELATION']->value->getLinkedRecord()->getModuleName(),$_smarty_tpl->tpl_vars['RELATION']->value->getLinkedRecord()->getModuleName());?>

									<?php }?>
								<?php } elseif ($_smarty_tpl->tpl_vars['RELATION']->value->getLinkedRecord()->getModuleName() == 'ModComments') {?>
									<i>"<?php echo $_smarty_tpl->tpl_vars['RELATION']->value->getLinkedRecord()->getName();?>
"</i>
								<?php } else { ?>
									<a class="cursorPointer" <?php if (stripos($_smarty_tpl->tpl_vars['LINKED_RECORD_DETAIL_URL']->value,'javascript:') === 0) {?> onclick='<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'substr' ][ 0 ], array( $_smarty_tpl->tpl_vars['LINKED_RECORD_DETAIL_URL']->value,strlen("javascript:") ));?>
'
									<?php } else { ?> onclick='window.location.href="<?php echo $_smarty_tpl->tpl_vars['LINKED_RECORD_DETAIL_URL']->value;?>
"' <?php }?>><?php echo $_smarty_tpl->tpl_vars['RELATION']->value->getLinkedRecord()->getName();?>
</a>
							<?php }
echo vtranslate('LBL_FOR');?>
 <a class="cursorPointer" <?php if (stripos($_smarty_tpl->tpl_vars['PARENT_DETAIL_URL']->value,'javascript:') === 0) {?>
							   onclick='<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'substr' ][ 0 ], array( $_smarty_tpl->tpl_vars['PARENT_DETAIL_URL']->value,strlen("javascript:") ));?>
' <?php } else { ?> onclick='window.location.href="<?php echo $_smarty_tpl->tpl_vars['PARENT_DETAIL_URL']->value;?>
"' <?php }?>>
									<?php echo $_smarty_tpl->tpl_vars['RELATION']->value->getParent()->getParent()->getName();?>
</a>
							</div>
						<?php } elseif ($_smarty_tpl->tpl_vars['HISTORY']->value->isRestore()) {?>
							<div>
								<b><?php echo $_smarty_tpl->tpl_vars['USER']->value->getName();?>
</b> <?php echo vtranslate('LBL_RESTORED');?>
 <a class="cursorPointer" <?php if (stripos($_smarty_tpl->tpl_vars['DETAILVIEW_URL']->value,'javascript:') === 0) {?>
																						  onclick='<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'substr' ][ 0 ], array( $_smarty_tpl->tpl_vars['DETAILVIEW_URL']->value,strlen("javascript:") ));?>
' <?php } else { ?> onclick='window.location.href="<?php echo $_smarty_tpl->tpl_vars['DETAILVIEW_URL']->value;?>
"' <?php }?>>
									<?php echo $_smarty_tpl->tpl_vars['PARENT']->value->getName();?>
</a>
							</div>
						<?php } elseif ($_smarty_tpl->tpl_vars['HISTORY']->value->isDelete()) {?>
							<div>
								<b><?php echo $_smarty_tpl->tpl_vars['USER']->value->getName();?>
</b> <?php echo vtranslate('LBL_DELETED');?>
 
								<strong> <?php echo $_smarty_tpl->tpl_vars['PARENT']->value->getName();?>
</strong>
							</div>
						<?php }?>
					</div>
					<?php if ($_smarty_tpl->tpl_vars['TIME']->value) {?><p class="pull-right muted" style="padding-right:10px;"><small title="<?php echo Vtiger_Util_Helper::formatDateTimeIntoDayString(((string)$_smarty_tpl->tpl_vars['TIME']->value));?>
"><?php echo Vtiger_Util_Helper::formatDateDiffInStrings(((string)$_smarty_tpl->tpl_vars['TIME']->value));?>
</small></p><?php }?>
				</div>
			<?php }?>
			<?php } elseif ($_smarty_tpl->tpl_vars['MODELNAME']->value == 'ModComments_Record_Model') {?>
				<div class="row">
					<div class="col-lg-1 pull-left">
						<span><i class="vicon-chat entryIcon" title=<?php echo $_smarty_tpl->tpl_vars['TRANSLATED_MODULE_NAME']->value;?>
></i></span>
					</div>
					<div class="col-lg-10 pull-left" style="margin-top:5px;">
						<?php $_smarty_tpl->_assignInScope('COMMENT_TIME', $_smarty_tpl->tpl_vars['HISTORY']->value->getCommentedTime());?>
						<div>
							<b><?php echo $_smarty_tpl->tpl_vars['HISTORY']->value->getCommentedByName();?>
</b> <?php echo vtranslate('LBL_COMMENTED');?>
 <?php echo vtranslate('LBL_ON');?>
 <a class="textOverflowEllipsis" href="<?php echo $_smarty_tpl->tpl_vars['HISTORY']->value->getParentRecordModel()->getDetailViewUrl();?>
"><?php echo $_smarty_tpl->tpl_vars['HISTORY']->value->getParentRecordModel()->getName();?>
</a>
						</div>
						<div><i>"<?php echo nl2br($_smarty_tpl->tpl_vars['HISTORY']->value->get('commentcontent'));?>
"</i></div>
					</div>
					<p class="pull-right muted" style="padding-right:10px;"><small title="<?php echo Vtiger_Util_Helper::formatDateTimeIntoDayString(((string)$_smarty_tpl->tpl_vars['COMMENT_TIME']->value));?>
"><?php echo Vtiger_Util_Helper::formatDateDiffInStrings(((string)$_smarty_tpl->tpl_vars['COMMENT_TIME']->value));?>
</small></p>
				</div>
			<?php }?>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

		<?php if ($_smarty_tpl->tpl_vars['NEXTPAGE']->value) {?>
			<div class="row">
				<div class="col-lg-12">
					<a href="javascript:;" class="load-more" data-page="<?php echo $_smarty_tpl->tpl_vars['PAGE']->value;?>
" data-nextpage="<?php echo $_smarty_tpl->tpl_vars['NEXTPAGE']->value;?>
"><?php echo vtranslate('LBL_MORE');?>
...</a>
				</div>
			</div>
		<?php }?>

	<?php } else { ?>
		<span class="noDataMsg">
			<?php if ($_smarty_tpl->tpl_vars['HISTORY_TYPE']->value == 'updates') {?>
				<?php echo vtranslate('LBL_NO_UPDATES',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>

			<?php } elseif ($_smarty_tpl->tpl_vars['HISTORY_TYPE']->value == 'comments') {?>
				<?php echo vtranslate('LBL_NO_COMMENTS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>

			<?php } else { ?>
				<?php echo vtranslate('LBL_NO_UPDATES_OR_COMMENTS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>

			<?php }?>
		</span>
	<?php }?>
</div>
<?php }
}
