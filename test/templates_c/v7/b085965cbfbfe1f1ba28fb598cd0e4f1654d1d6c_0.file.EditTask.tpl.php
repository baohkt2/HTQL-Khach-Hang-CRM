<?php
/* Smarty version 4.5.5, created on 2025-11-02 16:48:57
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\Workflows\EditTask.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_69078b79efca29_41378474',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b085965cbfbfe1f1ba28fb598cd0e4f1654d1d6c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\Workflows\\EditTask.tpl',
      1 => 1761802269,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69078b79efca29_41378474 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="fc-overlay-modal modal-content"><div class="modal-content"><?php ob_start();
echo vtranslate('LBL_ADD_TASKS_FOR_WORKFLOW',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
$_prefixVariable1 = ob_get_clean();
ob_start();
echo vtranslate($_smarty_tpl->tpl_vars['TASK_TYPE_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
$_prefixVariable2 = ob_get_clean();
$_smarty_tpl->_assignInScope('HEADER_TITLE', (($_prefixVariable1).(" -> ")).($_prefixVariable2));
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0, true);
?><div class="modal-body editTaskBody"><form class="form-horizontal" id="saveTask" method="post" action="index.php"><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
" /><input type="hidden" name="parent" value="Settings" /><input type="hidden" name="action" value="TaskAjax" /><input type="hidden" name="mode" value="Save" /><input type="hidden" name="for_workflow" value="<?php echo $_smarty_tpl->tpl_vars['WORKFLOW_ID']->value;?>
" /><input type="hidden" name="task_id" value="<?php echo $_smarty_tpl->tpl_vars['TASK_ID']->value;?>
" /><input type="hidden" name="taskType" id="taskType" value="<?php echo $_smarty_tpl->tpl_vars['TASK_TYPE_MODEL']->value->get('tasktypename');?>
" /><input type="hidden" name="tmpTaskId" value="<?php echo $_smarty_tpl->tpl_vars['TASK_MODEL']->value->get('tmpTaskId');?>
" /><?php if ($_smarty_tpl->tpl_vars['TASK_MODEL']->value->get('active') == 'false') {?> <input type="hidden" name="active" value="false" /> <?php }?><div id="scrollContainer"><div class="tabbable"><div class="row form-group"><div class="col-sm-6 col-xs-6"><div class="row"><div class="col-sm-3 col-xs-3"><?php echo vtranslate('LBL_TASK_TITLE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<span class="redColor">*</span></div><div class="col-sm-9 col-xs-9"><input name="summary" class="inputElement" data-rule-required="true" type="text" value="<?php echo $_smarty_tpl->tpl_vars['TASK_MODEL']->value->get('summary');?>
" /></div></div></div></div><?php if ($_smarty_tpl->tpl_vars['TASK_TYPE_MODEL']->value->get('tasktypename') == "VTEmailTask" && $_smarty_tpl->tpl_vars['TASK_OBJECT']->value->trigger != null) {
if (($_smarty_tpl->tpl_vars['TASK_OBJECT']->value->trigger != null)) {
$_smarty_tpl->_assignInScope('trigger', $_smarty_tpl->tpl_vars['TASK_OBJECT']->value->trigger);
$_smarty_tpl->_assignInScope('days', $_smarty_tpl->tpl_vars['trigger']->value['days']);
if (($_smarty_tpl->tpl_vars['days']->value < 0)) {
$_smarty_tpl->_assignInScope('days', $_smarty_tpl->tpl_vars['days']->value*-1);
$_smarty_tpl->_assignInScope('direction', 'before');
} else {
$_smarty_tpl->_assignInScope('direction', 'after');
}
}?><div class="row form-group"><div class="col-sm-9 col-xs-9"><div class="row"><div class="col-sm-2 col-xs-2"> <?php echo vtranslate('LBL_DELAY_ACTION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 </div><div class="col-sm-10 col-xs-10"><div class="row"><div class="col-sm-1 col-xs-1" style="margin-top: 7px;"><input type="checkbox" class="alignTop" name="check_select_date" <?php if ($_smarty_tpl->tpl_vars['trigger']->value != null) {?>checked<?php }?>/></div><div class="col-sm-10 col-xs-10 <?php if ($_smarty_tpl->tpl_vars['trigger']->value != null) {?>show <?php } else { ?> hide <?php }?>" id="checkSelectDateContainer"><div class="row"><div class="col-sm-2 col-xs-2"><div class="row"><div class="col-sm-6 col-xs-6" style="padding: 0px;"><input class="inputElement" type="text" name="select_date_days" value="<?php echo $_smarty_tpl->tpl_vars['days']->value;?>
" data-rule-WholeNumber=="true" >&nbsp;</div><div class="alignMiddle col-sm-5 col-xs-5" style="padding: 0px; margin-left: 2px;"><span style="position:relative;top:3px;">&nbsp;<?php echo vtranslate('LBL_DAYS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></div></div></div><div class="col-sm-3 col-xs-3" ><select class="select2" name="select_date_direction" style="width: 100px"><option <?php if ($_smarty_tpl->tpl_vars['direction']->value == 'after') {?> selected="" <?php }?> value="after"><?php echo vtranslate('LBL_AFTER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><option <?php if ($_smarty_tpl->tpl_vars['direction']->value == 'before') {?> selected="" <?php }?> value="before"><?php echo vtranslate('LBL_BEFORE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option></select></div><div class="col-sm-6 col-xs-6 marginLeftZero"><select class="select2" name="select_date_field"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['DATETIME_FIELDS']->value, 'DATETIME_FIELD');
$_smarty_tpl->tpl_vars['DATETIME_FIELD']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['DATETIME_FIELD']->value) {
$_smarty_tpl->tpl_vars['DATETIME_FIELD']->do_else = false;
?><option <?php if ($_smarty_tpl->tpl_vars['trigger']->value['field'] == $_smarty_tpl->tpl_vars['DATETIME_FIELD']->value->get('name')) {?> selected="" <?php }?> value="<?php echo $_smarty_tpl->tpl_vars['DATETIME_FIELD']->value->get('name');?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['DATETIME_FIELD']->value->get('label'),$_smarty_tpl->tpl_vars['DATETIME_FIELD']->value->getModuleName());?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></div></div></div></div></div></div></div></div><?php }?><br><div class="taskTypeUi"><?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['TASK_TEMPLATE_PATH']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></div></div></div><div class="modal-overlay-footer clearfix" style="margin-left: 230px; border-left-width: 0px;"><div class="row clearfix"><div class='textAlignCenter col-lg-12 col-md-12 col-sm-12 '><button type="submit" class="btn btn-success" ><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button>&nbsp;&nbsp;<a href="#" class="cancelLink" type="reset" data-dismiss="modal"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div></div></div></form></div></div></div>
<?php }
}
