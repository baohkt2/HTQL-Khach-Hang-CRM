<?php
/* Smarty version 4.5.5, created on 2025-10-19 18:06:24
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\ExtensionStore\CardSetupModals.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68f528a08259f4_18535412',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0dcac5a7a70bde7b87472ee43baa82ef32d20c90' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\ExtensionStore\\CardSetupModals.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68f528a08259f4_18535412 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!-- Setup card detals form start--> 
<div class="modal-dialog setUpCardModal hide">
	<div class="modal-content">
		<?php ob_start();
echo vtranslate('LBL_SETUP_CARD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
$_prefixVariable2 = ob_get_clean();
$_smarty_tpl->_assignInScope('HEADER_TITLE', $_prefixVariable2);?>
		<?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0, true);
?>
		<form class="form-horizontal setUpCardForm">
			<input type="hidden" name="customerId" value="<?php echo (isset($_smarty_tpl->tpl_vars['CUSTOMER_PROFILE']->value['id'])) ? $_smarty_tpl->tpl_vars['CUSTOMER_PROFILE']->value['id'] : '';?>
" />
			<input type="hidden" name="customerCardId" value="<?php echo (isset($_smarty_tpl->tpl_vars['CUSTOMER_PROFILE']->value['CustomerCardId'])) ? $_smarty_tpl->tpl_vars['CUSTOMER_PROFILE']->value['CustomerCardId'] : '';?>
" />
			<input type="hidden" name="module" value="ExtensionStore" />
			<input type="hidden" name="parent" value="Settings" />
			<input type="hidden" name="action" value="Basic" />
			<input type="hidden" name="mode" value="updateCardDetails" />
			<div class="modal-body">
				<div class="form-group">
					<span class="control-label col-sm-3 col-xs-3">
						<?php echo vtranslate('LBL_CARD_NUMBER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

						<span class="redColor">*</span>
					</span>
					<div class="controls col-sm-5 col-xs-5">
						<input class="col-sm-8 col-xs-8 inputElement" type="text" placeholder="<?php echo vtranslate('LBL_CARD_NUMBER_PLACEHOLDER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" name="cardNumber" value="" data-rule-required="true" data-rule-WholeNumber="true"/>
					</div>
				</div>
				<div class="form-group">
					<span class="control-label col-sm-3 col-xs-3">
						<?php echo vtranslate('LBL_EXPIRY_DATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

						<span class="redColor">*</span>
					</span>
					<div class="controls col-sm-9 col-xs-9"> 
						<input class="inputElement" style="width: 50px;" placeholder="mm" type="text" name="expMonth" value="" data-rule-required="true" data-mask="99" />
						&nbsp;-&nbsp;
						<input class="inputElement" style="width: 50px;" placeholder="yyyy" type="text" name="expYear" value="" data-rule-required="true" data-mask="9999" />
					</div>
				</div>
				<div class="form-group">
					<span class="control-label col-sm-3 col-xs-3">
						<?php echo vtranslate('LBL_SECURITY_CODE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

						<span class="redColor">*</span>
					</span>
					<div class="controls col-sm-9 col-xs-9">
						<input class="inputElement" style="width: 50px;" type="text" name="cvccode" value="" data-rule-required="true" data-mask="999"/>
						&nbsp;&nbsp;
						<span class="fa fa-info-circle" id="helpSecurityCode" onmouseover="Settings_ExtensionStore_ExtensionStore_Js.showPopover(this)" data-title="<?php echo vtranslate('LBL_WHAT_IS_SECURITY_CODE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" data-content="<?php echo vtranslate('LBL_SECURITY_CODE_HELP_CONTENT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" data-position="right"></span>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="row">
					<div class="col-sm-3 col-xs-3">
						<span class="pull-left"><button class="btn btn-danger" type="button" name="resetButton"><strong><?php echo vtranslate('LBL_RESET',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></button></span>
					</div>
					<div class="col-sm-9 col-xs-9">
						<div class="pull-right">
							<div class="pull-right cancelLinkContainer" style="margin-top:5px;">
								<a class="cancelLink" type="reset" data-dismiss="modal"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
							</div>
							<button class="btn btn-success saveButton" type="submit" name="saveButton" style="padding: 5px 12px;"><strong><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- Setup card detals form end-->

<!-- View card detals start-->
<div class="modal-dialog viewCardInfoModal hide">
	<div class="modal-content">
		<?php ob_start();
echo vtranslate('Card Information',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
$_prefixVariable3 = ob_get_clean();
$_smarty_tpl->_assignInScope('HEADER_TITLE', $_prefixVariable3);?>
		<?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0, true);
?>
		<div class="modal-body">
			<div class="row marginBottom10px">
				<div class="col-sm-3 col-xs-3">
					<?php echo vtranslate('LBL_CARD_NUMBER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

				</div>
				<div class="col-sm-4 col-xs-4 cardNumber"><?php echo (isset($_smarty_tpl->tpl_vars['CUSTOMER_CARD_INFO']->value['number'])) ? $_smarty_tpl->tpl_vars['CUSTOMER_CARD_INFO']->value['number'] : '';?>
</div>
			</div>
			<div class="row marginBottom10px">
				<div class="col-sm-3 col-xs-3">
					<?php echo vtranslate('LBL_EXPIRY_DATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

				</div>
				<div class="col-sm-4 col-xs-4 expiryDate"><?php echo (isset($_smarty_tpl->tpl_vars['CUSTOMER_CARD_INFO']->value['expmonth'])) ? $_smarty_tpl->tpl_vars['CUSTOMER_CARD_INFO']->value['expmonth'] : '';?>
&nbsp;-&nbsp;<?php echo (isset($_smarty_tpl->tpl_vars['CUSTOMER_CARD_INFO']->value['expyear'])) ? $_smarty_tpl->tpl_vars['CUSTOMER_CARD_INFO']->value['expyear'] : '';?>
</div>
			</div>
			<div class="row marginBottom10px">
				<div class="col-sm-3 col-xs-3 securityCode">
					<?php echo vtranslate('LBL_SECURITY_CODE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

				</div>
				<div class="col-sm-4 col-xs-4">***</div>
			</div>
		</div>
		<div class="modal-footer">
			<div class="row-fluid">
				<div class="pull-right">
					<div class="pull-right cancelLinkContainer" style="margin-top:5px;">
						<a class="cancelLink" type="reset" data-dismiss="modal"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
					</div>
					<button class="btn btn-success updateBtn"><?php echo vtranslate('Update',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- view card information end -->

<!-- Signup form start-->
<div class="modal-dialog signUpAccount hide">
	<div class="modal-content">
		<?php ob_start();
echo vtranslate('LBL_SIGN_UP_FOR_FREE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
$_prefixVariable4 = ob_get_clean();
$_smarty_tpl->_assignInScope('HEADER_TITLE', $_prefixVariable4);?>
		<?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0, true);
?>
		<form class="form-horizontal signUpForm">
			<input type="hidden" name="module" value="ExtensionStore" />
			<input type="hidden" name="parent" value="Settings" />
			<input type="hidden" name="action" value="Basic" />
			<input type="hidden" name="userAction" value="signup" />
			<input type="hidden" name="mode" value="registerAccount" />
			<div class="modal-body col-md-offset-2">
				<div class="form-group">
					<span class="control-label col-sm-4">
						<?php echo vtranslate('LBL_EMAIL_ADDRESS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

					</span>
					<div class="controls col-sm-5">
						<input class="inputElement" type="text" name="emailAddress" data-rule-required="true" data-rule-email="true"/>
					</div>
				</div>
				<div class="form-group">
					<span class="control-label col-sm-4">
						<?php echo vtranslate('LBL_FIRST_NAME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

					</span>
					<div class="controls col-sm-5">
						<input class="inputElement" type="text" name="firstName" data-rule-required="true" />
					</div>
				</div>
				<div class="form-group">
					<span class="control-label col-sm-4">
						<?php echo vtranslate('LBL_LAST_NAME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

					</span>
					<div class="controls col-sm-5">
						<input class="inputElement" type="text" name="lastName" data-rule-required="true" />
					</div>
				</div>
				<div class="form-group">
					<span class="control-label col-sm-4">
						<?php echo vtranslate('LBL_COMPANY_NAME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

					</span>
					<div class="controls col-sm-5">
						<input class="inputElement" type="text" name="companyName" data-rule-required="true" />
					</div>
				</div>
				<div class="form-group">
					<span class="control-label col-sm-4">
						<?php echo vtranslate('LBL_PASSWORD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

					</span>
					<div class="controls col-sm-5">
						<input class="inputElement" type="password" name="password" data-rule-required="true" />
					</div>
				</div>
				<div class="form-group">
					<span class="control-label col-sm-4">
						<?php echo vtranslate('LBL_CONFIRM_PASSWORD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

					</span>
					<div class="controls col-sm-5">
						<input class="inputElement" type="password" name="confirmPassword" data-rule-required="true"/>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="row-fluid">
					<span class="col-sm-6">&nbsp;
					</span>
					<span class="col-sm-6">
						<div class="pull-right">
							<div class="pull-right cancelLinkContainer" style="margin-top:5px;">
								<a class="cancelLink" type="reset" data-dismiss="modal"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
							</div>
							<button class="btn btn-success" name="saveButton"><strong><?php echo vtranslate('LBL_REGISTER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></button>
						</div>
					</span>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- Signup form end-->

<!-- Login form start-->
<div class="modal-dialog loginAccount hide">
	<div class="modal-content">
		<?php ob_start();
echo vtranslate('LBL_MARKETPLACE_LOGIN',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
$_prefixVariable5 = ob_get_clean();
$_smarty_tpl->_assignInScope('HEADER_TITLE', $_prefixVariable5);?>
		<?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0, true);
?>
		<form class="form-horizontal loginForm">
			<input type="hidden" name="module" value="ExtensionStore" />
			<input type="hidden" name="parent" value="Settings" />
			<input type="hidden" name="action" value="Basic" />
			<input type="hidden" name="userAction" value="login" />
			<input type="hidden" name="mode" value="registerAccount" />
			<div class="modal-body col-md-offset-2">
				<div class="form-group">
					<span class="control-label col-sm-3 fieldLabel">
						<?php echo vtranslate('LBL_EMAIL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

						<span class="redColor">*</span>
					</span>
					<div class="controls col-sm-5">
						<?php if ($_smarty_tpl->tpl_vars['REGISTRATION_STATUS']->value) {?>
							<input class="inputElement" type="hidden" name="emailAddress" value="<?php echo $_smarty_tpl->tpl_vars['USER_NAME']->value;?>
" />
							<span class="control-label"><span class="pull-left"><?php echo $_smarty_tpl->tpl_vars['USER_NAME']->value;?>
</span></span>
							<?php } else { ?>
							<input class="inputElement" type="text" name="emailAddress" data-rule-required="true" data-rule-email="true" />
						<?php }?>
					</div>
				</div>
				<div class="form-group">
					<span class="control-label fieldLabel col-sm-3">
						<?php echo vtranslate('LBL_PASSWORD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

						<span class="redColor">*</span>
					</span>
					<div class="controls col-sm-5">
						<input class="inputElement" type="password" name="password" data-rule-required="true" />
						<br>
						<br>
						<label style="font-weight:normal;"><input type="checkbox" name="savePassword" />&nbsp;&nbsp;<?php echo vtranslate('LBL_REMEMBER_ME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label>
						<br>
						<br>
						<a href="#" id="forgotPasswordLink" style="color: #15c !important"><?php echo vtranslate('LBL_FORGOT_PASSWORD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 ?</a>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="row-fluid">
					<span class="col-sm-8">
						<?php if (!$_smarty_tpl->tpl_vars['REGISTRATION_STATUS']->value) {?>
							<a class="pull-left" href="#" name="signUp"><?php echo vtranslate('LBL_CREATE_AN_ACCOUNT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a>
						<?php } else { ?>&nbsp;
						<?php }?>
					</span>
					<span class="col-sm-4">
						<div class="pull-right">
							<div class="pull-right cancelLinkContainer" style="margin-top:5px;">
								<a class="cancelLink" type="reset" data-dismiss="modal"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
							</div>
							<button class="btn btn-success" name="saveButton" type="submit"><strong><?php echo vtranslate('LBL_LOGIN',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></button>
						</div>
					</span>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- Login form end -->

<!-- forgot password form -->
<div class="modal-dialog forgotPasswordModal hide">
	<div class="modal-content">
		<?php ob_start();
echo vtranslate('LBL_FORGOT_PASSWORD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
$_prefixVariable6 = ob_get_clean();
$_smarty_tpl->_assignInScope('HEADER_TITLE', $_prefixVariable6);?>
		<?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0, true);
?>
		<form class="form-horizontal forgotPassword" method="POST">
			<input type="hidden" name="module" value="ExtensionStore" />
			<input type="hidden" name="parent" value="Settings" />
			<input type="hidden" name="action" value="Basic" />
			<input type="hidden" name="mode" value="forgotPassword" />
			<div class="modal-body col-md-offset-1">
				<div class="form-group">
					<span class="control-label col-sm-5">
						<?php echo vtranslate('LBL_ENTER_REGISTERED_EMAIL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

						<span class="redColor">*</span>
					</span>
					<div class="controls col-sm-5">
						<input class="inputElement" type="text" name="emailAddress" data-rule-required="true" data-rule-email="true" /></div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="row-fluid">
					<div class="pull-right">
						<div class="pull-right cancelLinkContainer" style="margin-top:5px;">
							<a class="cancelLink" type="reset" data-dismiss="modal"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
						</div>
						<button class="btn btn-success okBtn" type="submit" style="padding: 5px 12px;"><?php echo vtranslate('LBL_OK',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- forgot password form end -->
<?php if ($_smarty_tpl->tpl_vars['LOADER_REQUIRED']->value) {?>
	<div class="modal extensionLoader hide">
		<div class="modal-header contentsBackground">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h3><?php echo vtranslate('LBL_INSTALL_EXTENSION_LOADER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h3>
		</div>
		<div class="modal-body">
			<div class="row-fluid">
				<p><?php echo vtranslate('LBL_TO_CONTINUE_USING_EXTENSION_STORE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<a href="https://marketplace.vtiger.com/loaderfiles/<?php echo $_smarty_tpl->tpl_vars['LOADER_INFO']->value['loader_file'];?>
"><?php echo vtranslate('LBL_DOWNLOAD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a><?php echo vtranslate('LBL_COMPATIABLE_EXTENSION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</p>
			</div>
			<div class="row-fluid">
				<p><?php echo vtranslate('LBL_MORE_DETAILS_ON_INSTALLATION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<a onclick=window.open("http://community.vtiger.com/help/vtigercrm/php/extension-loader.html")><?php echo vtranslate('LBL_READ_HERE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a></p>
			</div>
		</div>
		<div class="modal-footer">
			<div class="row-fluid">
				<div class="pull-right">
					<div class="pull-right cancelLinkContainer" style="margin-top:5px;">
						<button class="btn btn-success" data-dismiss="modal"><?php echo vtranslate('LBL_OK',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php }
}
}
