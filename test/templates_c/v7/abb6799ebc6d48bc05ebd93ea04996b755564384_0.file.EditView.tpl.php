<?php
/* Smarty version 4.5.5, created on 2025-11-02 16:27:31
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\Workflows\EditView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_69078673c68c86_52787253',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'abb6799ebc6d48bc05ebd93ea04996b755564384' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\Workflows\\EditView.tpl',
      1 => 1761802269,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69078673c68c86_52787253 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="editViewPageDiv"><div class="col-sm-12 col-xs-12" id="EditView"><form name="EditWorkflow" action="index.php" method="post" id="workflow_edit" class="form-horizontal"><?php $_smarty_tpl->_assignInScope('WORKFLOW_MODEL_OBJ', $_smarty_tpl->tpl_vars['WORKFLOW_MODEL']->value->getWorkflowObject());?><input type="hidden" name="record" value="<?php echo $_smarty_tpl->tpl_vars['RECORDID']->value;?>
" id="record" /><input type="hidden" name="module" value="Workflows" /><input type="hidden" name="action" value="SaveWorkflow" /><input type="hidden" name="parent" value="Settings" /><input type="hidden" name="returnsourcemodule" value="<?php echo $_smarty_tpl->tpl_vars['RETURN_SOURCE_MODULE']->value;?>
" /><input type="hidden" name="returnpage" value="<?php echo $_smarty_tpl->tpl_vars['RETURN_PAGE']->value;?>
" /><input type="hidden" name="returnsearch_value" value="<?php echo $_smarty_tpl->tpl_vars['RETURN_SEARCH_VALUE']->value;?>
" /><div class="editViewHeader"><div class='row'><div class="col-lg-12 col-md-12 col-lg-pull-0"><h4><?php echo vtranslate('LBL_BASIC_INFORMATION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4></div></div></div><hr style="margin-top: 0px !important;"><div class="editViewBody"><div class="editViewContents" style="text-align: center; "><div class="form-group"><label for="name" class="col-sm-3 control-label"><?php echo vtranslate('LBL_WORKFLOW_NAME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<span class="redColor">*</span></label><div class="col-sm-5 controls"><input class="form-control" id="name" name="workflowname" value="<?php echo $_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->workflowname;?>
" data-rule-required="true"></div></div><div class="form-group"><label for="name" class="col-sm-3 control-label"><?php echo vtranslate('LBL_DESCRIPTION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label><div class="col-sm-5 controls"><textarea class="form-control" name="summary" id="summary"><?php echo $_smarty_tpl->tpl_vars['WORKFLOW_MODEL']->value->get('summary');?>
</textarea></div></div><div class="form-group"><label for="module_name" class="col-sm-3 control-label"><?php echo vtranslate('LBL_TARGET_MODULE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label><div class="col-sm-5 controls"><?php if ((isset($_smarty_tpl->tpl_vars['MODE']->value)) && $_smarty_tpl->tpl_vars['MODE']->value == 'edit') {?><div class="pull-left"><input type='text' disabled='disabled' class="inputElement" value="<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getName(),$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getName());?>
" ><input type='hidden' id="module_name" name='module_name' value="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name');?>
" ></div><?php } else { ?><select class="select2 col-sm-6 pull-left" id="module_name" name="module_name" required="true" data-placeholder="Select Module..." style="text-align: left"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ALL_MODULES']->value, 'MODULE_MODEL', false, 'TABID');
$_smarty_tpl->tpl_vars['MODULE_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['TABID']->value => $_smarty_tpl->tpl_vars['MODULE_MODEL']->value) {
$_smarty_tpl->tpl_vars['MODULE_MODEL']->do_else = false;
$_smarty_tpl->_assignInScope('TARGET_MODULE_NAME', $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getName());
$_smarty_tpl->_assignInScope('SINGLE_MODULE', "SINGLE_".((string)$_smarty_tpl->tpl_vars['TARGET_MODULE_NAME']->value));?><option value="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getName();?>
" <?php if ($_smarty_tpl->tpl_vars['SELECTED_MODULE']->value == $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getName()) {?> selected <?php }?>data-create-label="<?php echo vtranslate($_smarty_tpl->tpl_vars['SINGLE_MODULE']->value,$_smarty_tpl->tpl_vars['TARGET_MODULE_NAME']->value);?>
 <?php echo vtranslate('LBL_CREATION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"data-update-label="<?php echo vtranslate($_smarty_tpl->tpl_vars['SINGLE_MODULE']->value,$_smarty_tpl->tpl_vars['TARGET_MODULE_NAME']->value);?>
 <?php echo vtranslate('LBL_UPDATED',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"><?php if ($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getName() == 'Calendar') {
echo vtranslate('LBL_TASK',$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getName());
} else {
echo vtranslate($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getName(),$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getName());
}?></option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select><?php }?></div></div><div class="form-group"><label for="status" class="col-sm-3 control-label"><?php echo vtranslate('LBL_STATUS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label><div class="col-sm-5 controls"><div class="pull-left"><span style="margin-right: 10px;"><input name="status" type="radio" value="active" <?php if ($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->status == '1') {?> checked="" <?php }?>>&nbsp;<span><?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></span><span style="margin-right: 10px;"><input name="status" type="radio" value="inActive" <?php if ($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->status == '0' || empty($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value)) {?> checked="" <?php }?>>&nbsp;<span><?php echo vtranslate('InActive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></span></div></div></div></div></div><div class="editViewHeader"><div class='row'><div class="col-lg-12 col-md-12 col-lg-pull-0"><h4><?php echo vtranslate('LBL_WORKFLOW_TRIGGER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4></div></div></div><hr style="margin-top: 0px !important;"><div class="editViewBody"><div class="editViewContents" style="padding-bottom: 0px;"><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( 'WorkFlowTrigger.tpl',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></div></div><div id="workflow_condition"></div><div class="modal-overlay-footer clearfix"><div class="row clearfix"><div class='textAlignCenter col-lg-12 col-md-12 col-sm-12 '><button type='submit' class='btn btn-success saveButton' ><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button>&nbsp;&nbsp;<a class='cancelLink' href="javascript:history.back()" type="reset"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div></div></div></form></div></div><?php }
}
