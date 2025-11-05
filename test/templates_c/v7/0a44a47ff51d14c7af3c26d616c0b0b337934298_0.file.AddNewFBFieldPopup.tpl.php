<?php
/* Smarty version 4.5.5, created on 2025-11-05 08:02:20
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\CTFacebookMessengerIntegration\AddNewFBFieldPopup.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690b048c479ab2_56906818',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0a44a47ff51d14c7af3c26d616c0b0b337934298' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\CTFacebookMessengerIntegration\\AddNewFBFieldPopup.tpl',
      1 => 1761724815,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690b048c479ab2_56906818 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="modal-xs modal-dialog">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title"><?php echo vtranslate('LBL_CHOOSE_MODULES_FIELDS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4>
	</div>
	<div class="modal-body">
		<div class="clearfix">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
				<h4 style="margin-top: 0px;"><?php echo vtranslate('LBL_CHOOSE_MODULES_FIELDS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4>
			</div>
		</div><hr>
		
		<input type="hidden" name="chatTypeId" id="chatTypeId" value="<?php echo $_smarty_tpl->tpl_vars['CHATTYPEID']->value;?>
">

		<table class="table editview-table no-border">
			<tbody>
				<tr>
					<td class="fieldLabel alignMiddle" style="width: 300px;"><?php echo vtranslate('LBL_ALLOW_SELECTED_SELECTED_MODULE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<span class="redColor">*</span></td>
					<td class="fieldValue">
						<select class="inputElement select2  select2-offscreen" id="select_module" name="select_module" style="width: 50%;">
							<option value=""><?php echo vtranslate('LBL_SELECT_AN_OPTION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option>
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ALLOW_FACEBOOK_MODULES']->value, 'value', false, 'key');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['value']->value,$_smarty_tpl->tpl_vars['value']->value);?>
</option>
							<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
						</select>
					</td>
				</tr>
			<tr>
				<td class="fieldLabel alignMiddle" style="width: 300px;"><?php echo vtranslate('LBL_ACTIVE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</td>
				<td class="fieldValue">
					<input type="checkbox" class="inputElement" name="active" id="active" value="">
				</td>
			</tr>
			</tbody>
		</table>
	</div>
	<div class="modal-footer">
		<center><button class="btn btn-success" id="submitbutton" type="button"><strong><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button><a class="cancelLink" data-dismiss="modal"  href="#" type="reset"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a></center>
	</div>
</div><?php }
}
