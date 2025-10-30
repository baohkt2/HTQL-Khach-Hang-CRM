<?php
/* Smarty version 4.5.5, created on 2025-10-29 04:06:01
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\Workflows\CreateEntity.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690192a92f3911_18665236',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '70e419b352c09f5b35dbbed57bd271ebf43938a0' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\Workflows\\CreateEntity.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690192a92f3911_18665236 (Smarty_Internal_Template $_smarty_tpl) {
?>
<input type="hidden" id="fieldValueMapping" name="field_value_mapping" value='<?php echo $_smarty_tpl->tpl_vars['TASK_OBJECT']->value->field_value_mapping;?>
' />
<input type="hidden" value="<?php if ($_smarty_tpl->tpl_vars['TASK_ID']->value) {
echo $_smarty_tpl->tpl_vars['TASK_OBJECT']->value->reference_field;
} else {
echo (isset($_smarty_tpl->tpl_vars['REFERENCE_FIELD_NAME']->value)) ? $_smarty_tpl->tpl_vars['REFERENCE_FIELD_NAME']->value : '';
}?>" name='reference_field' id='reference_field' />
<div class="conditionsContainer" id="save_fieldvaluemapping">
	<?php if ($_smarty_tpl->tpl_vars['RELATED_MODULE_MODEL_NAME']->value != '' && getTabid($_smarty_tpl->tpl_vars['RELATED_MODULE_MODEL_NAME']->value)) {?>
		<div>
			<button type="button" class="btn btn-default" id="addFieldBtn"><?php echo vtranslate('LBL_ADD_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button>
		</div><br>
		<?php $_smarty_tpl->_assignInScope('RELATED_MODULE_MODEL', Vtiger_Module_Model::getInstance($_smarty_tpl->tpl_vars['TASK_OBJECT']->value->entity_type));?>
		<?php $_smarty_tpl->_assignInScope('FIELD_VALUE_MAPPING', ZEND_JSON::decode($_smarty_tpl->tpl_vars['TASK_OBJECT']->value->field_value_mapping));?>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FIELD_VALUE_MAPPING']->value, 'FIELD_MAP');
$_smarty_tpl->tpl_vars['FIELD_MAP']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MAP']->value) {
$_smarty_tpl->tpl_vars['FIELD_MAP']->do_else = false;
?>
			<?php $_smarty_tpl->_assignInScope('SELECTED_FIELD_MODEL', $_smarty_tpl->tpl_vars['RELATED_MODULE_MODEL']->value->getField($_smarty_tpl->tpl_vars['FIELD_MAP']->value['fieldname']));?>
			<?php if (empty($_smarty_tpl->tpl_vars['SELECTED_FIELD_MODEL']->value)) {?>
				<?php continue 1;?>
			<?php }?>
			<?php $_smarty_tpl->_assignInScope('SELECTED_FIELD_MODEL_FIELD_TYPE', $_smarty_tpl->tpl_vars['SELECTED_FIELD_MODEL']->value->getFieldDataType());?>
			<div class="row conditionRow form-group">
				<span class="col-lg-4">
					<select name="fieldname" class="select2" style="min-width: 250px" <?php if ($_smarty_tpl->tpl_vars['SELECTED_FIELD_MODEL']->value->isMandatory() || ($_smarty_tpl->tpl_vars['DISABLE_ROW']->value == 'true')) {?> disabled="" <?php }?> >
						<option value="none"></option>
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RELATED_MODULE_MODEL']->value->getFields(), 'FIELD_MODEL');
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->value) {
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = false;
?>
							<?php $_smarty_tpl->_assignInScope('FIELD_INFO', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo());?>
							<option value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
" <?php if ($_smarty_tpl->tpl_vars['FIELD_MAP']->value['fieldname'] == $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name')) {?> <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()) {
$_smarty_tpl->_assignInScope('MANDATORY_FIELD', true);?> <?php } else { ?> <?php $_smarty_tpl->_assignInScope('MANDATORY_FIELD', false);?> <?php }
$_smarty_tpl->_assignInScope('FIELD_TYPE', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType());?> selected=""<?php }?> data-fieldtype="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldType();?>
" data-field-name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
" data-fieldinfo='<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['FIELD_INFO']->value);?>
' >
								<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getModuleName());
if ($_smarty_tpl->tpl_vars['SELECTED_FIELD_MODEL']->value->isMandatory() && $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getName() != 'assigned_user_id') {?><span class="redColor">*</span><?php }?>
							</option>	
						<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					</select>
				</span>
				<span>
					<input name="modulename" type="hidden"
						<?php if ($_smarty_tpl->tpl_vars['FIELD_MAP']->value['modulename'] == $_smarty_tpl->tpl_vars['SOURCE_MODULE']->value) {?> value="<?php echo $_smarty_tpl->tpl_vars['SOURCE_MODULE']->value;?>
" <?php }?>
						<?php if ($_smarty_tpl->tpl_vars['FIELD_MAP']->value['modulename'] == $_smarty_tpl->tpl_vars['RELATED_MODULE_MODEL_NAME']->value) {?> value="<?php echo $_smarty_tpl->tpl_vars['RELATED_MODULE_MODEL_NAME']->value;?>
" <?php }?> 
					/>
				</span>
				<span class="fieldUiHolder col-lg-4">
					<input type="text" class="getPopupUi inputElement" <?php if (($_smarty_tpl->tpl_vars['DISABLE_ROW']->value == 'true')) {?> disabled=""<?php }?> readonly="" name="fieldValue" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MAP']->value['value'];?>
" />
					<input type="hidden" name="valuetype" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MAP']->value['valuetype'];?>
" />
				</span>
				<?php if ($_smarty_tpl->tpl_vars['MANDATORY_FIELD']->value != true) {?>
					<span class="cursorPointer col-lg-1">
						<i class="alignMiddle deleteCondition fa fa-trash"></i>
					</span>
				<?php }?>
			</div>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

		<?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "FieldExpressions.tpl",$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('RELATED_MODULE_MODEL'=>$_smarty_tpl->tpl_vars['RELATED_MODULE_MODEL']->value,'MODULE_MODEL'=>$_smarty_tpl->tpl_vars['MODULE_MODEL']->value,'FIELD_EXPRESSIONS'=>$_smarty_tpl->tpl_vars['FIELD_EXPRESSIONS']->value), 0, true);
?>
	<?php } else { ?>
		<?php if ((isset($_smarty_tpl->tpl_vars['RELATED_MODULE_MODEL']->value)) && $_smarty_tpl->tpl_vars['RELATED_MODULE_MODEL']->value) {?>
			<div>
				<button type="button" class="btn btn-default" id="addFieldBtn"><?php echo vtranslate('LBL_ADD_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button>
			</div><br>
			<?php $_smarty_tpl->_assignInScope('MANDATORY_FIELD_MODELS', $_smarty_tpl->tpl_vars['RELATED_MODULE_MODEL']->value->getMandatoryFieldModels());?>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MANDATORY_FIELD_MODELS']->value, 'MANDATORY_FIELD_MODEL');
$_smarty_tpl->tpl_vars['MANDATORY_FIELD_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['MANDATORY_FIELD_MODEL']->value) {
$_smarty_tpl->tpl_vars['MANDATORY_FIELD_MODEL']->do_else = false;
?>
				<?php if (in_array($_smarty_tpl->tpl_vars['SOURCE_MODULE']->value,$_smarty_tpl->tpl_vars['MANDATORY_FIELD_MODEL']->value->getReferenceList())) {?>
					<?php continue 1;?>
				<?php }?>
				<div class="row conditionRow form-group">
					<span class="col-lg-4">
						<select name="fieldname" class="select2" disabled="" style="min-width: 250px">
							<option value="none"></option>
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RELATED_MODULE_MODEL']->value->getFields(), 'FIELD_MODEL');
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->value) {
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = false;
?>
								<?php $_smarty_tpl->_assignInScope('FIELD_INFO', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo());?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
" data-fieldtype="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldType();?>
" <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name') == $_smarty_tpl->tpl_vars['MANDATORY_FIELD_MODEL']->value->get('name')) {?> <?php $_smarty_tpl->_assignInScope('FIELD_TYPE', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType());?> selected=""<?php }?> data-field-name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
" data-fieldinfo='<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['FIELD_INFO']->value);?>
' >
									<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getModuleName());?>
<span class="redColor">*</span>
								</option>	
							<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
						</select>
					</span>
					<span>
						<?php if (($_smarty_tpl->tpl_vars['FIELD_TYPE']->value == 'picklist' || $_smarty_tpl->tpl_vars['FIELD_TYPE']->value == 'multipicklist')) {?>
							<input type="hidden" name="modulename" value="<?php echo $_smarty_tpl->tpl_vars['RELATED_MODULE_MODEL']->value->get('name');?>
" />
						<?php } else { ?>
							<input type="hidden" name="modulename" value="<?php echo $_smarty_tpl->tpl_vars['SOURCE_MODULE']->value;?>
" />
						<?php }?>
					</span>
					<span class="fieldUiHolder col-lg-4">
						<input type="text" class="getPopupUi inputElement" name="fieldValue" value="" />
						<input type="hidden" name="valuetype" value="rawtext" />
					</span>
				</div>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			<?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "FieldExpressions.tpl",$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('RELATED_MODULE_MODEL'=>$_smarty_tpl->tpl_vars['RELATED_MODULE_MODEL']->value,'MODULE_MODEL'=>$_smarty_tpl->tpl_vars['MODULE_MODEL']->value,'FIELD_EXPRESSIONS'=>$_smarty_tpl->tpl_vars['FIELD_EXPRESSIONS']->value), 0, true);
?>
		<?php }?>
	<?php }?>
</div><br>
<?php if ((isset($_smarty_tpl->tpl_vars['RELATED_MODULE_MODEL']->value)) && $_smarty_tpl->tpl_vars['RELATED_MODULE_MODEL']->value) {?>
	<div class="row form-group basicAddFieldContainer hide">
		<span class="col-lg-4">
			<select name="fieldname" style="min-width: 250px">
				<option value="none"><?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RELATED_MODULE_MODEL']->value->getFields(), 'FIELD_MODEL');
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->value) {
$_smarty_tpl->tpl_vars['FIELD_MODEL']->do_else = false;
?>
					<?php $_smarty_tpl->_assignInScope('FIELD_INFO', $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo());?>
					<?php if (!$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()) {?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
" data-fieldtype="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldType();?>
" data-field-name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
" data-fieldinfo='<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['FIELD_INFO']->value);?>
' >
						<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getModuleName());?>

					</option>
					<?php }?>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</select>
		</span>
		<span>
			<input type="hidden" name="modulename" value="<?php echo $_smarty_tpl->tpl_vars['SOURCE_MODULE']->value;?>
" />
		</span>
		<span class="fieldUiHolder col-lg-4">
			<input type="text" class="inputElement" readonly="" name="fieldValue" value="" />
			<input type="hidden" name="valuetype" value="rawtext" />
		</span>
		<span class="cursorPointer col-lg-1">
			<i class="alignMiddle deleteCondition fa fa-trash"></i>
		</span>
	</div>
<?php }
}
}
