<?php
/* Smarty version 4.5.5, created on 2025-11-02 07:42:25
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\Profiles\EditViewContents.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_69070b613d6929_49021651',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1516d549ff5c5e9c75eb4f7b92c5371507a69bec' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\Profiles\\EditViewContents.tpl',
      1 => 1761802269,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69070b613d6929_49021651 (Smarty_Internal_Template $_smarty_tpl) {
if ((isset($_smarty_tpl->tpl_vars['SHOW_EXISTING_PROFILES']->value)) && $_smarty_tpl->tpl_vars['SHOW_EXISTING_PROFILES']->value) {?>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['SCRIPTS']->value, 'jsModel', false, 'index');
$_smarty_tpl->tpl_vars['jsModel']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['index']->value => $_smarty_tpl->tpl_vars['jsModel']->value) {
$_smarty_tpl->tpl_vars['jsModel']->do_else = false;
?>
		<?php echo '<script'; ?>
 type="<?php echo $_smarty_tpl->tpl_vars['jsModel']->value->getType();?>
" src="<?php echo $_smarty_tpl->tpl_vars['jsModel']->value->getSrc();?>
"><?php echo '</script'; ?>
>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	<div class="form-group row">
		<div class="col-lg-3 col-md-3 col-sm-3 control-label fieldLabel">
			<strong><?php echo vtranslate('LBL_COPY_PRIVILEGES_FROM',"Settings:Roles");?>
</strong>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6">
			<select class="select2" id="directProfilePriviligesSelect" placeholder="<?php echo vtranslate('LBL_CHOOSE_PROFILES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
">
				<option></option>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ALL_PROFILES']->value, 'PROFILE');
$_smarty_tpl->tpl_vars['PROFILE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['PROFILE']->value) {
$_smarty_tpl->tpl_vars['PROFILE']->do_else = false;
?>
					<?php if ($_smarty_tpl->tpl_vars['PROFILE']->value->isDirectlyRelated() == false) {?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['PROFILE']->value->getId();?>
" <?php if ($_smarty_tpl->tpl_vars['RECORD_ID']->value == $_smarty_tpl->tpl_vars['PROFILE']->value->getId()) {?> selected="" <?php }?> ><?php echo $_smarty_tpl->tpl_vars['PROFILE']->value->getName();?>
</option>
					<?php }?>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</select>
		</div>
	</div>
<?php }?>
<input type="hidden" name="viewall" value="0" />
<input type="hidden" name="editall" value="0" />
<?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value && $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getId() && empty($_smarty_tpl->tpl_vars['IS_DUPLICATE_RECORD']->value)) {?>
	<?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->hasGlobalReadPermission() || $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->hasGlobalWritePermission()) {?>
		<div class="form-group row">
			<div class="col-lg-3 col-md-3 col-sm-3 fieldLabel"></div>
			<div class="col-lg-6 col-md-6 col-sm-6">
				<label class="control-label">
					<input type="hidden" name="viewall" value="0" />
					<label class="control-label">
						<input class="listViewEntriesCheckBox" type="checkbox" name="viewall" <?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->hasGlobalReadPermission()) {?>checked="true"<?php }?> style="top: -2px;" />
						&nbsp;<?php echo vtranslate('LBL_VIEW_ALL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;
					</label>
					<span style="margin-left: 10px">
						<i class="fa fa-info-circle" title="<?php echo vtranslate('LBL_VIEW_ALL_DESC',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i>
					</span>
				</label>
				<br>
				<label class="control-label">
					<input type="hidden" name="editall" value="0" />
					<label class="control-label">
						<input class="listViewEntriesCheckBox" type="checkbox" name="editall" <?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->hasGlobalReadPermission()) {?>checked="true"<?php }?> style="top: -2px;"/>
						&nbsp;<?php echo vtranslate('LBL_EDIT_ALL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;
					</label>
					<span style="margin-left: 15px">
						<i class="fa fa-info-circle" title="<?php echo vtranslate('LBL_EDIT_ALL_DESC',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i>
					</span>
				</label>
				<br><br>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-3 fieldLabel"></div>
			<div class="col-lg-7 col-md-7 col-sm-7">
				<div class="alert alert-warning" style="width:85%">
					<?php echo vtranslate('LBL_GLOBAL_PERMISSION_WARNING',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

				</div>
			</div>
	<?php }
}?>
<div class="row col-lg-12 col-md-12 col-sm-12">
	<div class=" col-lg-10 col-md-10 col-sm-10">
		<h5><?php echo vtranslate('LBL_EDIT_PRIVILEGES_OF_THIS_PROFILE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h5><br>
	</div>
</div>
<div class="row">
	<div class="col-lg-1 col-md-1 col-sm-1"></div>
	<div class=" col-lg-10 col-md-10 col-sm-10">
		<table class="table table-bordered profilesEditView">
			<thead>
				<tr class="blockHeader">
					<th width="25%" style="text-align: left !important">
						<label><input class="verticalAlignMiddle" checked="true" type="checkbox" id="mainModulesCheckBox" style="top: -2px;"/>&nbsp;
							<?php echo vtranslate('LBL_MODULES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

						</label>
					</th>
					<th class='textAlignCenter' width="14%">
						<label><input class="verticalAlignMiddle" type="checkbox" <?php if (empty($_smarty_tpl->tpl_vars['RECORD_ID']->value) && empty($_smarty_tpl->tpl_vars['IS_DUPLICATE_RECORD']->value)) {?> checked="true" <?php }?> id="mainAction4CheckBox" style="top: -2px;" />&nbsp;
							<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_VIEW_PRVILIGE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value ));?>

						</label>
					</th>
					<th class='textAlignCenter' width="14%">
						<label><input class="verticalAlignMiddle" <?php if (empty($_smarty_tpl->tpl_vars['RECORD_ID']->value) && empty($_smarty_tpl->tpl_vars['IS_DUPLICATE_RECORD']->value)) {?> checked="true" <?php }?> type="checkbox" id="mainAction7CheckBox" style="top: -2px;"/>&nbsp;
							<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_CREATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value ));?>

						</label>
					</th>
					<th class='textAlignCenter' width="14%">
						<label><input class="verticalAlignMiddle" <?php if (empty($_smarty_tpl->tpl_vars['RECORD_ID']->value) && empty($_smarty_tpl->tpl_vars['IS_DUPLICATE_RECORD']->value)) {?> checked="true" <?php }?> type="checkbox" id="mainAction1CheckBox" style="top: -2px;" />&nbsp;
							<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value ));?>

						</label>
					</th>
					<th class='textAlignCenter' width="14%">
						<label><input class="verticalAlignMiddle" checked="true" type="checkbox" id="mainAction2CheckBox" style="top: -2px;" />&nbsp;
							<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_DELETE_PRVILIGE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value ));?>

						</label>
					</th>
					<th class='textAlignCenter verticalAlignMiddleImp' width="28%;" nowrap="nowrap">
						<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( 'LBL_FIELD_AND_TOOL_PRIVILEGES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value ));?>

					</th>
				</tr>
			</thead>
			<tbody>
				<?php $_smarty_tpl->_assignInScope('PROFILE_MODULES', $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getModulePermissions());?>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['PROFILE_MODULES']->value, 'PROFILE_MODULE', false, 'TABID');
$_smarty_tpl->tpl_vars['PROFILE_MODULE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['TABID']->value => $_smarty_tpl->tpl_vars['PROFILE_MODULE']->value) {
$_smarty_tpl->tpl_vars['PROFILE_MODULE']->do_else = false;
?>
					<?php $_smarty_tpl->_assignInScope('MODULE_NAME', $_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->getName());?>
					<?php if ($_smarty_tpl->tpl_vars['MODULE_NAME']->value != 'Events') {?>
						<tr>
							<td class="verticalAlignMiddleImp">
								<input class="modulesCheckBox" type="checkbox" name="permissions[<?php echo $_smarty_tpl->tpl_vars['TABID']->value;?>
][is_permitted]" data-value="<?php echo $_smarty_tpl->tpl_vars['TABID']->value;?>
" data-module-state="" <?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->hasModulePermission($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value)) {?>checked="true"<?php } else { ?> data-module-unchecked="true" <?php }?>> <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtranslate' ][ 0 ], array( $_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->get('label'),$_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->getName() ));?>

							</td>
							<?php $_smarty_tpl->_assignInScope('BASIC_ACTION_ORDER', array(2,3,0,1));?>
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['BASIC_ACTION_ORDER']->value, 'ORDERID');
$_smarty_tpl->tpl_vars['ORDERID']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ORDERID']->value) {
$_smarty_tpl->tpl_vars['ORDERID']->do_else = false;
?>
								<td class="textAlignCenter verticalAlignMiddleImp">
									<?php $_smarty_tpl->_assignInScope('ACTION_MODEL', $_smarty_tpl->tpl_vars['ALL_BASIC_ACTIONS']->value[$_smarty_tpl->tpl_vars['ORDERID']->value]);?>
									<?php $_smarty_tpl->_assignInScope('ACTION_ID', $_smarty_tpl->tpl_vars['ACTION_MODEL']->value->get('actionid'));?>
									<?php if ($_smarty_tpl->tpl_vars['ACTION_MODEL']->value->isModuleEnabled($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value)) {?>
										<input class="action<?php echo $_smarty_tpl->tpl_vars['ACTION_ID']->value;?>
CheckBox" type="checkbox" name="permissions[<?php echo $_smarty_tpl->tpl_vars['TABID']->value;?>
][actions][<?php echo $_smarty_tpl->tpl_vars['ACTION_ID']->value;?>
]" data-action-state="<?php echo $_smarty_tpl->tpl_vars['ACTION_MODEL']->value->getName();?>
" <?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->hasModuleActionPermission($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value,$_smarty_tpl->tpl_vars['ACTION_MODEL']->value)) {?>checked="true"<?php } elseif (empty($_smarty_tpl->tpl_vars['RECORD_ID']->value) && empty($_smarty_tpl->tpl_vars['IS_DUPLICATE_RECORD']->value)) {?> checked="true" <?php } else { ?> data-action<?php echo $_smarty_tpl->tpl_vars['ACTION_ID']->value;?>
-unchecked="true"<?php }?>></td>
									<?php }?>
								</td>
							<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
							<td class="textAlignCenter">
								<?php if (($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->getFields() && $_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->isEntityModule() && $_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->isProfileLevelUtilityAllowed()) || $_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->isUtilityActionEnabled()) {?>
									<button type="button" data-handlerfor="fields" data-togglehandler="<?php echo $_smarty_tpl->tpl_vars['TABID']->value;?>
-fields" class="btn btn-default btn-sm" style="padding-right: 20px; padding-left: 20px;">
										<i class="fa fa-chevron-down"></i>
									</button>
								<?php }?>
							</td>
						</tr>
						<tr class="hide">
							<td colspan="6" class="row" style="padding-left: 5%;padding-right: 5%">
								<div class="row" data-togglecontent="<?php echo $_smarty_tpl->tpl_vars['TABID']->value;?>
-fields" style="display: none">
									<?php if ($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->getFields() && $_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->isEntityModule()) {?>
										<div class="col-sm-12">
											<label class="pull-left"><strong><?php echo vtranslate('LBL_FIELDS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
if ($_smarty_tpl->tpl_vars['MODULE_NAME']->value == 'Calendar') {?> <?php echo vtranslate('LBL_OF',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 <?php echo vtranslate('LBL_TASKS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);
}?></strong></label>
											<div class="pull-right">
												<span class="mini-slider-control ui-slider" data-value="0">
													<a style="margin-top: 3px" class="ui-slider-handle"></a>
												</span>
												<span style="margin: 0 20px;"><?php echo vtranslate('LBL_INIVISIBLE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span>&nbsp;&nbsp;
												<span class="mini-slider-control ui-slider" data-value="1">
													<a style="margin-top: 3px" class="ui-slider-handle"></a>
												</span>
												<span style="margin: 0 20px;"><?php echo vtranslate('LBL_READ_ONLY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span>&nbsp;&nbsp;
												<span class="mini-slider-control ui-slider" data-value="2">
													<a style="margin-top: 3px" class="ui-slider-handle"></a>
												</span>
												<span style="margin: 0 20px;"><?php echo vtranslate('LBL_WRITE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span>
											</div>
											<div class="clearfix"></div>
										</div>
										<table class="table table-bordered no-border">
											<?php $_smarty_tpl->_assignInScope('COUNTER', 0);?>
											<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->getFields(), 'FIELD_MODEL', false, 'FIELD_NAME', 'fields', array (
  'last' => true,
  'iteration' => true,
  'total' => true,
));
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_NAME']->value => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value) {
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_fields']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_fields']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_fields']->value['iteration'] === $_smarty_tpl->tpl_vars['__smarty_foreach_fields']->value['total'];
?>
												<?php $_smarty_tpl->_assignInScope('FIELD_ID', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getId());?>
												<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isActiveField() && $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype') != '83' && $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('displaytype') != '6') {?>
													<?php if ($_smarty_tpl->tpl_vars['COUNTER']->value%3 == 0) {?>
														<tr>
													<?php }?>
													<td >
														<!-- Field will be locked iff that field is non editable or Mandatory or UIType 70.
														 But, we can't set emailoptout field to either Mandatory/non-editable/uitype70
														-->
														<?php $_smarty_tpl->_assignInScope('FIELD_LOCKED', true);?>
														<?php if ($_smarty_tpl->tpl_vars['FIELD_NAME']->value != 'emailoptout') {?>
															<?php $_smarty_tpl->_assignInScope('FIELD_LOCKED', $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->isModuleFieldLocked($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value,$_smarty_tpl->tpl_vars['FIELD_MODEL']->value));?>
														<?php }?>
														<input type="hidden" name="permissions[<?php echo $_smarty_tpl->tpl_vars['TABID']->value;?>
][fields][<?php echo $_smarty_tpl->tpl_vars['FIELD_ID']->value;?>
]" data-range-input="<?php echo $_smarty_tpl->tpl_vars['FIELD_ID']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getModuleFieldPermissionValue($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value,$_smarty_tpl->tpl_vars['FIELD_MODEL']->value);?>
" readonly="true">
														<div class="mini-slider-control editViewMiniSlider pull-left" data-locked="<?php echo $_smarty_tpl->tpl_vars['FIELD_LOCKED']->value;?>
" data-range="<?php echo $_smarty_tpl->tpl_vars['FIELD_ID']->value;?>
" data-value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getModuleFieldPermissionValue($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value,$_smarty_tpl->tpl_vars['FIELD_MODEL']->value);?>
"></div>
														<div class="pull-left">
															<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
&nbsp;<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()) {?><span class="redColor">*</span><?php }?>
														</div>
													</td>
													<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_fields']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_fields']->value['last'] : null) || ($_smarty_tpl->tpl_vars['COUNTER']->value+1)%3 == 0) {?>
														</tr>
													<?php }?>
												<?php $_smarty_tpl->_assignInScope('COUNTER', $_smarty_tpl->tpl_vars['COUNTER']->value+1);?>
												<?php } elseif ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('displaytype') == '6' || $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getName() == 'adjusted_amount') {?>
													<input type='hidden' name='permissions[<?php echo $_smarty_tpl->tpl_vars['TABID']->value;?>
][fields][<?php echo $_smarty_tpl->tpl_vars['FIELD_ID']->value;?>
]' value='2' />
												<?php }?>
											<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
										</table>
										<?php if ($_smarty_tpl->tpl_vars['MODULE_NAME']->value == 'Calendar') {?>
											<?php $_smarty_tpl->_assignInScope('EVENT_MODULE', $_smarty_tpl->tpl_vars['PROFILE_MODULES']->value[16]);?>
											<?php $_smarty_tpl->_assignInScope('COUNTER', 0);?>
											<label class="pull-left"><strong><?php echo vtranslate('LBL_FIELDS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 <?php echo vtranslate('LBL_OF',$_smarty_tpl->tpl_vars['EVENT_MODULE']->value->getName());?>
 <?php echo vtranslate('LBL_EVENTS',$_smarty_tpl->tpl_vars['EVENT_MODULE']->value->getName());?>
</strong></label>
											<table class="table table-bordered">
												<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['EVENT_MODULE']->value->getFields(), 'FIELD_MODEL', false, 'FIELD_NAME', 'fields', array (
  'last' => true,
  'iteration' => true,
  'total' => true,
));
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_NAME']->value => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value) {
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_fields']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_fields']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_fields']->value['iteration'] === $_smarty_tpl->tpl_vars['__smarty_foreach_fields']->value['total'];
?>
													<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isActiveField()) {?>
														<?php $_smarty_tpl->_assignInScope('FIELD_ID', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getId());?>
														<?php if ($_smarty_tpl->tpl_vars['COUNTER']->value%3 == 0) {?>
															<tr>
															<?php }?>
															<td>
																<?php $_smarty_tpl->_assignInScope('FIELD_LOCKED', $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->isModuleFieldLocked($_smarty_tpl->tpl_vars['EVENT_MODULE']->value,$_smarty_tpl->tpl_vars['FIELD_MODEL']->value));?>
																<input type="hidden" name="permissions[16][fields][<?php echo $_smarty_tpl->tpl_vars['FIELD_ID']->value;?>
]" data-range-input="<?php echo $_smarty_tpl->tpl_vars['FIELD_ID']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getModuleFieldPermissionValue($_smarty_tpl->tpl_vars['EVENT_MODULE']->value,$_smarty_tpl->tpl_vars['FIELD_MODEL']->value);?>
" readonly="true">
																<div class="mini-slider-control editViewMiniSlider pull-left" data-locked="<?php echo $_smarty_tpl->tpl_vars['FIELD_LOCKED']->value;?>
" data-range="<?php echo $_smarty_tpl->tpl_vars['FIELD_ID']->value;?>
" data-value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getModuleFieldPermissionValue($_smarty_tpl->tpl_vars['EVENT_MODULE']->value,$_smarty_tpl->tpl_vars['FIELD_MODEL']->value);?>
"></div>
																<div class="pull-left">
																	<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
&nbsp;<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()) {?><span class="redColor">*</span><?php }?> 
																</div>
															</td>
															<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_fields']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_fields']->value['last'] : null) || ($_smarty_tpl->tpl_vars['COUNTER']->value+1)%3 == 0) {?>
															</tr>
														<?php }?>
														<?php $_smarty_tpl->_assignInScope('COUNTER', $_smarty_tpl->tpl_vars['COUNTER']->value+1);?>
													<?php }?>
												<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
											</table>
										<?php }?>
									<?php }?>
								</div>
							</td>
						</tr>
						<tr class="hide <?php echo $_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->getName();?>
_ACTIONS">
							<?php $_smarty_tpl->_assignInScope('UTILITY_ACTION_COUNT', 0);?>
							<?php $_smarty_tpl->_assignInScope('ALL_UTILITY_ACTIONS_ARRAY', array());?>
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ALL_UTILITY_ACTIONS']->value, 'ACTION_MODEL');
$_smarty_tpl->tpl_vars['ACTION_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ACTION_MODEL']->value) {
$_smarty_tpl->tpl_vars['ACTION_MODEL']->do_else = false;
?>
								<?php if ($_smarty_tpl->tpl_vars['ACTION_MODEL']->value->isModuleEnabled($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value)) {?>
									<?php $_smarty_tpl->_assignInScope('testArray', array_push($_smarty_tpl->tpl_vars['ALL_UTILITY_ACTIONS_ARRAY']->value,$_smarty_tpl->tpl_vars['ACTION_MODEL']->value));?>
								<?php }?>
							<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
							<?php if ($_smarty_tpl->tpl_vars['ALL_UTILITY_ACTIONS_ARRAY']->value) {?>
								<td colspan="6" class="row" style="padding-left: 5%;padding-right: 5%;">
									<div class="row" data-togglecontent="<?php echo $_smarty_tpl->tpl_vars['TABID']->value;?>
-fields" style="display: none">
										<div class="col-sm-12">
											<label class="pull-left">
												<strong><?php echo vtranslate('LBL_TOOLS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong>
											</label>
										</div>
										<table class="table table-bordered">
											<tr>
												<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ALL_UTILITY_ACTIONS_ARRAY']->value, 'ACTION_MODEL', false, NULL, 'actions', array (
  'last' => true,
  'index' => true,
  'iteration' => true,
  'total' => true,
));
$_smarty_tpl->tpl_vars['ACTION_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ACTION_MODEL']->value) {
$_smarty_tpl->tpl_vars['ACTION_MODEL']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_actions']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_actions']->value['index']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_actions']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_actions']->value['iteration'] === $_smarty_tpl->tpl_vars['__smarty_foreach_actions']->value['total'];
?>
													<?php $_smarty_tpl->_assignInScope('ACTIONID', $_smarty_tpl->tpl_vars['ACTION_MODEL']->value->get('actionid'));?>
													<td <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_actions']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_actions']->value['last'] : null) && (((isset($_smarty_tpl->tpl_vars['__smarty_foreach_actions']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_actions']->value['index'] : null)+1)%3 != 0)) {?>
														<?php $_smarty_tpl->_assignInScope('index', ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_actions']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_actions']->value['index'] : null)+1)%3);?>
														<?php $_smarty_tpl->_assignInScope('colspan', 4-$_smarty_tpl->tpl_vars['index']->value);?>
														colspan="<?php echo $_smarty_tpl->tpl_vars['colspan']->value;?>
"
														<?php }?>>
														<input type="checkbox" <?php if (empty($_smarty_tpl->tpl_vars['RECORD_ID']->value) && empty($_smarty_tpl->tpl_vars['IS_DUPLICATE_RECORD']->value)) {?> checked="true" <?php }?> name="permissions[<?php echo $_smarty_tpl->tpl_vars['TABID']->value;?>
][actions][<?php echo $_smarty_tpl->tpl_vars['ACTIONID']->value;?>
]" <?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->hasModuleActionPermission($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value,$_smarty_tpl->tpl_vars['ACTIONID']->value)) {?>checked="true"<?php }?> data-action-name='<?php echo $_smarty_tpl->tpl_vars['ACTION_MODEL']->value->getName();?>
' data-action-tool='<?php echo $_smarty_tpl->tpl_vars['TABID']->value;?>
'> <?php echo vtranslate($_smarty_tpl->tpl_vars['ACTION_MODEL']->value->getName(),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

													</td>
													<?php if (((isset($_smarty_tpl->tpl_vars['__smarty_foreach_actions']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_actions']->value['index'] : null)+1)%3 == 0) {?>
														</tr><tr>
													<?php }?>
												<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
											</tr>
										</table>
									</div>
								</td>
							<?php }?>
						</tr>
					<?php }?>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</tbody>
		</table>
	</div>
</div>
<?php }
}
