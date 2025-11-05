<?php
/* Smarty version 4.5.5, created on 2025-11-05 08:02:04
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\CTFacebookMessengerIntegration\AddFacebookPagesPopup.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690b047caf09c5_75096276',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '62dd246304c4d42852ce5f0b72655dd3b26971cf' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\CTFacebookMessengerIntegration\\AddFacebookPagesPopup.tpl',
      1 => 1761724815,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690b047caf09c5_75096276 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="sendWhatsappSmsContainer" class='modal-xs modal-dialog'>
   <div class="modal-header" style="height: 50px;">
		<button type="button" class="close " data-dismiss="modal" aria-hidden="true" style="float: right;">&times;</button>
		<h4 style="font-size: 15px;"><?php echo vtranslate('LBL_ADD_DELETE_FACEBOOK_PAGE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h4>&nbsp;
   </div>
   <?php $_smarty_tpl->_assignInScope('ALL_ACTIVEUSER_LIST', $_smarty_tpl->tpl_vars['USER_MODEL']->value->getAccessibleUsers());?>
  	<?php $_smarty_tpl->_assignInScope('ALL_ACTIVEGROUP_LIST', $_smarty_tpl->tpl_vars['USER_MODEL']->value->getAccessibleGroups());?>
  	<div class="modal-body">
    	<div class="clearfix"></div>
    	<form name="facebookPageConfig" id="facebookPageConfig">
    		<input type="hidden" name="recordId" id="recordId" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
">
    		<input type="hidden" name="chatTypeId" id="chatTypeId" value="<?php echo $_smarty_tpl->tpl_vars['CHATTYPEID']->value;?>
">
    		
			<table class="table editview-table no-border">
				<tbody>
					<tr>
						<td class="fieldLabel alignMiddle"><?php echo vtranslate('LBL_SELECT_FACEBOOK_PAGE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<span class="redColor">*</span></td>
						<td class="fieldValue optionsWidth" >
							<select name="pageId" id="pageId" class="inputElement select2 row select2-offscreen" <?php if ($_smarty_tpl->tpl_vars['RECORD_ID']->value != '') {?> disabled='true'<?php }?>>
								<option value=""><?php echo vtranslate('LBL_SELECT_AN_OPTION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option>
								<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FACEBOOK_PAGE_LIST']->value, 'pageData', false, 'key');
$_smarty_tpl->tpl_vars['pageData']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['pageData']->value) {
$_smarty_tpl->tpl_vars['pageData']->do_else = false;
?>
									<?php if (!empty($_smarty_tpl->tpl_vars['FACEBOOK_PAGE_DATA']->value) && $_smarty_tpl->tpl_vars['FACEBOOK_PAGE_DATA']->value['facebookPageId'] == $_smarty_tpl->tpl_vars['key']->value) {?>
										<option value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" selected><?php echo $_smarty_tpl->tpl_vars['pageData']->value;?>
</option>
									<?php } else { ?>
										<option value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['pageData']->value;?>
</option>
									<?php }?>
								<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
							</select>
							<?php if ($_smarty_tpl->tpl_vars['RECORD_ID']->value == '') {?>
							<span id="syncFBPages" title="<?php echo vtranslate('LBL_SYNC_FACEBOOK_PAGES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" style="height: 31px;cursor:pointer;"><img src="layouts/v7/modules/CTChatLog/image/sync.png" style="width: 24px;"></span>
							<?php }?>
						</td>
					</tr>
					<tr>
						<td class="fieldLabel alignMiddle"><?php echo vtranslate('LBL_SELECT_USERS_GROUPS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<span class="redColor">*</span></td>
						<td class="fieldValue">
							<select name="facebookUsersGroups[]" id="facebookUsersGroups" class="inputElement select2 row select2-offscreen"  multiple="">
								<optgroup label="<?php echo vtranslate('LBL_USERS');?>
">
									<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ALL_ACTIVEUSER_LIST']->value, 'OWNER_NAME', false, 'OWNER_ID');
$_smarty_tpl->tpl_vars['OWNER_NAME']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['OWNER_ID']->value => $_smarty_tpl->tpl_vars['OWNER_NAME']->value) {
$_smarty_tpl->tpl_vars['OWNER_NAME']->do_else = false;
?>
			                  	<option value="<?php echo $_smarty_tpl->tpl_vars['OWNER_ID']->value;?>
"  <?php if (!empty($_smarty_tpl->tpl_vars['FACEBOOK_PAGE_DATA']->value) && in_array($_smarty_tpl->tpl_vars['OWNER_ID']->value,$_smarty_tpl->tpl_vars['FACEBOOK_PAGE_DATA']->value['allowUsersGroups'])) {?> selected="" <?php }?>>
			                    		<?php echo $_smarty_tpl->tpl_vars['OWNER_NAME']->value;?>

			                    	</option>
									<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
								</optgroup>
								<optgroup label="<?php echo vtranslate('LBL_GROUPS');?>
">
									<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ALL_ACTIVEGROUP_LIST']->value, 'OWNER_NAME', false, 'OWNER_ID');
$_smarty_tpl->tpl_vars['OWNER_NAME']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['OWNER_ID']->value => $_smarty_tpl->tpl_vars['OWNER_NAME']->value) {
$_smarty_tpl->tpl_vars['OWNER_NAME']->do_else = false;
?>
										<option value="<?php echo $_smarty_tpl->tpl_vars['OWNER_ID']->value;?>
"  <?php if (!empty($_smarty_tpl->tpl_vars['FACEBOOK_PAGE_DATA']->value) && in_array($_smarty_tpl->tpl_vars['OWNER_ID']->value,$_smarty_tpl->tpl_vars['FACEBOOK_PAGE_DATA']->value['allowUsersGroups'])) {?> selected="" <?php }?>>
					               	<?php echo $_smarty_tpl->tpl_vars['OWNER_NAME']->value;?>

					               </option>
									<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
								</optgroup>
							</select>
						</td>
					</tr>
					<tr>
						<td class="fieldLabel alignMiddle"><?php echo vtranslate('LBL_ACTIVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td>
						<td class="fieldValue">
							<input type="checkbox" name="facebookConfigActive" id="facebookConfigActive" value="<?php echo $_smarty_tpl->tpl_vars['FACEBOOK_PAGE_DATA']->value['active'];?>
" <?php if (!empty($_smarty_tpl->tpl_vars['FACEBOOK_PAGE_DATA']->value) && $_smarty_tpl->tpl_vars['FACEBOOK_PAGE_DATA']->value['active'] == 1) {?> checked="checked" <?php }?>>
						</td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
	<div class="modal-footer">
		<center>
			<button id="saveFacebookPageConfig" class="btn btn-success" style="background-color:#1877f2;"><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button>&nbsp;&nbsp;
			<a type="reset" data-dismiss="modal" class="cancelLink cursorPointer"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
		</center>
    </div>    
</div><?php }
}
