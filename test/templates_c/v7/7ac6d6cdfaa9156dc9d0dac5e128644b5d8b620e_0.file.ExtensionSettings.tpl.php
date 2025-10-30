<?php
/* Smarty version 4.5.5, created on 2025-10-19 14:40:09
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Google\ExtensionSettings.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68f4f849b47d33_43155758',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7ac6d6cdfaa9156dc9d0dac5e128644b5d8b620e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Google\\ExtensionSettings.tpl',
      1 => 1758006183,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68f4f849b47d33_43155758 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('MODULENAME', $_smarty_tpl->tpl_vars['MODULE']->value);
ob_start();
echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getExtensionSettingsUrl($_smarty_tpl->tpl_vars['SOURCEMODULE']->value);
$_prefixVariable1 = ob_get_clean();
$_smarty_tpl->_assignInScope('RETURN_URL', $_prefixVariable1);
if ($_smarty_tpl->tpl_vars['PARENT']->value == 'Settings') {?>
	<?php $_smarty_tpl->_assignInScope('RETURN_URL', ($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getExtensionSettingsUrl($_smarty_tpl->tpl_vars['SOURCEMODULE']->value)).("&parent=Settings"));
}?>
<input type="hidden" name="settingsPage" value="<?php echo $_smarty_tpl->tpl_vars['RETURN_URL']->value;?>
">
<div class="col-sm-12 col-xs-12 extensionContents">
	<div class="row">
		<div class="col-sm-12 col-xs-12">
			<h3 class="module-title pull-left"> <?php echo vtranslate('LBL_SELECT_MODULES_TO_SYNC',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 </h3>
		</div>
	</div>
	<br>
	<form name="settingsForm" action="index.php" method="POST" >
		<input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
" />
		<input type="hidden" name="action" value="SaveSyncSettings" />
		<input type="hidden" name="sourceModule" value="<?php echo $_smarty_tpl->tpl_vars['SOURCEMODULE']->value;?>
" />
		<input type="hidden" name="parent" value="<?php echo $_smarty_tpl->tpl_vars['PARENT']->value;?>
">
		<div class="row">
			<div class="col-sm-12 col-xs-12">
				<table class="listview-table table-bordered" align="center">
					<thead>
					<th> <?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate('LBL_DATA',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 </th>
					<th> <?php echo vtranslate('APPTITLE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate('LBL_DATA',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 </th>
					<th> <?php echo vtranslate('LBL_FIELD_MAPPING',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 </th> 
					<th> <?php echo vtranslate('LBL_ENABLE_SYNC',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 </th>
					<th> <?php echo vtranslate('LBL_SYNC_DIRECTION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 </th>
					</thead>
					<tbody>
						<tr>
							<td>
								<select name="Contacts[google_group]" class="inputElement select2 row" style="min-width: 250px;">
									<option value="all"><?php echo vtranslate('LBL_ALL',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
</option>
									<?php $_smarty_tpl->_assignInScope('IS_GROUP_DELETED', 1);?>
									<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['GOOGLE_CONTACTS_GROUPS']->value['entry'], 'ENTRY');
$_smarty_tpl->tpl_vars['ENTRY']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ENTRY']->value) {
$_smarty_tpl->tpl_vars['ENTRY']->do_else = false;
?>
										<option value="<?php echo $_smarty_tpl->tpl_vars['ENTRY']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['ENTRY']->value['id'] == $_smarty_tpl->tpl_vars['SELECTED_CONTACTS_GROUP']->value) {?> <?php $_smarty_tpl->_assignInScope('IS_GROUP_DELETED', 0);?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['ENTRY']->value['title'];?>
</option>
									<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
									<?php if ($_smarty_tpl->tpl_vars['IS_GROUP_DELETED']->value && $_smarty_tpl->tpl_vars['SELECTED_CONTACTS_GROUP']->value != 'all') {?>
										<?php if ($_smarty_tpl->tpl_vars['SELECTED_CONTACTS_GROUP']->value != '') {?><option value="none" selected><?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
</option><?php }?>
									<?php }?>
								</select>
							</td>
							<td><?php echo vtranslate('Contacts','Contacts');?>
</td>
							<td><a id="syncSetting" class="extensionLink" data-sync-module="Contacts"><?php echo vtranslate('LBL_CONFIGURE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></td>
							<td><input name="Contacts[enabled]" type="checkbox" <?php if ($_smarty_tpl->tpl_vars['CONTACTS_ENABLED']->value) {?> checked <?php }?>></td>
							<td>
								<select name="Contacts[sync_direction]" class="inputElement select2 row" style="min-width: 250px;">
									<option value="11" <?php if ($_smarty_tpl->tpl_vars['CONTACTS_SYNC_DIRECTION']->value == 11) {?> selected <?php }?>> <?php echo vtranslate('LBL_SYNC_BOTH_WAYS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 </option>
									<option value="10" <?php if ($_smarty_tpl->tpl_vars['CONTACTS_SYNC_DIRECTION']->value == 10) {?> selected <?php }?>> <?php echo vtranslate('LBL_SYNC_FROM_GOOGLE_TO_VTIGER',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 </option>
									<option value="01" <?php if ($_smarty_tpl->tpl_vars['CONTACTS_SYNC_DIRECTION']->value == 01) {?> selected <?php }?>> <?php echo vtranslate('LBL_SYNC_FROM_VTIGER_TO_GOOGLE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 </option>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<select name="Calendar[google_group]" class="inputElement select2 row" style="min-width: 250px;">
									<?php if ($_smarty_tpl->tpl_vars['GOOGLE_CALENDARS']->value && php7_count($_smarty_tpl->tpl_vars['GOOGLE_CALENDARS']->value) == 0) {?>
										<option value="primary"><?php echo vtranslate('LBL_PRIMARY',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
</option>
									<?php }?>
									<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['GOOGLE_CALENDARS']->value, 'CALENDAR_ITEM');
$_smarty_tpl->tpl_vars['CALENDAR_ITEM']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['CALENDAR_ITEM']->value) {
$_smarty_tpl->tpl_vars['CALENDAR_ITEM']->do_else = false;
?>
										<option value="<?php if ($_smarty_tpl->tpl_vars['CALENDAR_ITEM']->value['primary'] == 1) {?>primary<?php } else {
echo $_smarty_tpl->tpl_vars['CALENDAR_ITEM']->value['id'];
}?>" <?php if ($_smarty_tpl->tpl_vars['SELECTED_GOOGLE_CALENDAR']->value == $_smarty_tpl->tpl_vars['CALENDAR_ITEM']->value['id']) {?>selected<?php }?> <?php if ($_smarty_tpl->tpl_vars['SELECTED_GOOGLE_CALENDAR']->value == 'primary' && $_smarty_tpl->tpl_vars['CALENDAR_ITEM']->value['primary'] == 1) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['CALENDAR_ITEM']->value['summary'];?>
</option>
									<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
								</select>
							</td>
							<td><?php echo vtranslate('Calendar','Calendar');?>
</td>
							<td><a id="syncSetting" class="extensionLink" data-sync-module="Calendar"><?php echo vtranslate('LBL_VIEW',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></td>
							<td><input name="Calendar[enabled]" type="checkbox" <?php if ($_smarty_tpl->tpl_vars['CALENDAR_ENABLED']->value) {?> checked <?php }?>></td>
							<td>
								<select name="Calendar[sync_direction]" class="inputElement select2 row" style="min-width: 250px;">
									<option value="11" <?php if ($_smarty_tpl->tpl_vars['CALENDAR_SYNC_DIRECTION']->value == 11) {?> selected <?php }?>> <?php echo vtranslate('LBL_SYNC_BOTH_WAYS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 </option>
									<option value="10" <?php if ($_smarty_tpl->tpl_vars['CALENDAR_SYNC_DIRECTION']->value == 10) {?> selected <?php }?>> <?php echo vtranslate('LBL_SYNC_FROM_GOOGLE_TO_VTIGER',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 </option>
									<option value="01" <?php if ($_smarty_tpl->tpl_vars['CALENDAR_SYNC_DIRECTION']->value == 01) {?> selected <?php }?>> <?php echo vtranslate('LBL_SYNC_FROM_VTIGER_TO_GOOGLE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 </option>
								</select>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div id="scroller_wrapper" class="bottom-fixed-scroll">
				<div id="scroller" class="scroller-div"></div>
			</div>
			<div class="col-sm-2 col-xs-2">
			</div>
		</div>
		<br>
		<?php if (!$_smarty_tpl->tpl_vars['IS_SYNC_READY']->value) {?>
			<div class="row">
				<div class="col-sm-12 col-xs-12">
					<h3 class="module-title pull-left"> <?php echo vtranslate('LBL_GOOGLE_CONNECT_MSG',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 </h3>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-3 col-xs-3">
					<a id="authorizeButton" class="btn btn-block btn-social btn-lg btn-google-plus" data-url='index.php?module=<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
&view=List&operation=sync&sourcemodule=<?php echo $_smarty_tpl->tpl_vars['SOURCEMODULE']->value;?>
'><i class="fa fa-google-plus"></i><?php echo vtranslate('LBL_SIGN_IN_WITH_GOOGLE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
				</div>
			</div>
		<?php } else { ?>
			<div class="row">
				<div class="col-sm-12 col-xs-12">
					<h3 class="module-title pull-left"> <?php echo vtranslate('LBL_GOOGLE_ACCOUNT_DETAILS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 </h3>
				</div>
			</div>
			<br>
			<?php if ($_smarty_tpl->tpl_vars['USER_EMAIL']->value) {?>
				<div class="row">
					<div class="col-sm-3 col-xs-3">
						<h5 class="module-title pull-left fieldLabel"> <?php echo vtranslate('LBL_GOOGLE_ACCOUNT_SYNCED_WITH',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 </h5>
					</div>
					<div class="col-sm-4 col-xs-4">
						<input class="listSearchContributor col-sm-12 col-xs-12" type="text" value="<?php echo $_smarty_tpl->tpl_vars['USER_EMAIL']->value;?>
" disabled="disabled" style="height: 30px;">
					</div>
				</div>
			<?php }?>
			<div class="row">
				<div class="col-sm-3 col-xs-3">
					<a id="authorizeButton" class="btn btn-block btn-social btn-lg btn-google-plus" data-url='index.php?module=<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
&view=List&operation=changeUser&sourcemodule=<?php echo $_smarty_tpl->tpl_vars['SOURCEMODULE']->value;?>
'><i class="fa fa-google-plus"></i> <?php echo vtranslate('LBL_CHANGE_USER',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 </a>
				</div>
			</div>
		<?php }?>
		<br>
		<div class="row">
			<div class="col-sm-12 col-xs-12">
				<div class="vt-default-callout vt-info-callout"> 
					<h4 class="vt-callout-header"><span class="fa fa-info-circle"></span>&nbsp; Info </h4><br>
					<div>
						<?php echo vtranslate('LBL_REDIRECT_URL_MESSAGE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<br><br>
						<?php echo vtranslate('LBL_REDIRECT_URL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 : <span style="color: #15c !important"><?php echo Google_Config_Connector::getRedirectUrl();?>
</span>
					</div>
					<br>
					<img src="modules/Google/images/redirect_uri.png" />
				</div>
			</div>
		</div>
		<div style="margin-top: 8%;">
			<div>
				<button id="saveSettings" type="submit" class="btn btn-success saveButton"><?php echo vtranslate('LBL_SAVE_SETTINGS',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
</button>
				<?php if ($_smarty_tpl->tpl_vars['PARENT']->value != 'Settings') {?>
					<a type="reset" data-url="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getBaseExtensionUrl($_smarty_tpl->tpl_vars['SOURCEMODULE']->value);?>
" class="cancelLink navigationLink"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
</a>
				<?php }?>
			</div>
		</div>
	</form>
</div>
<?php }
}
