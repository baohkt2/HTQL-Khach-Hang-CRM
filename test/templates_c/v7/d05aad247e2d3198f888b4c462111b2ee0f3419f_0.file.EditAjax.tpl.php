<?php
/* Smarty version 4.5.5, created on 2025-11-02 07:41:24
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\CronTasks\EditAjax.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_69070b24dfa259_47212045',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd05aad247e2d3198f888b4c462111b2ee0f3419f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\CronTasks\\EditAjax.tpl',
      1 => 1761802269,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69070b24dfa259_47212045 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="modal-dialog modelContainer"><?php ob_start();
echo vtranslate($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('name'),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
$_prefixVariable1 = ob_get_clean();
$_smarty_tpl->_assignInScope('HEADER_TITLE', $_prefixVariable1);
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0, true);
?><div class="modal-content"><form class="form-horizontal" id="cronJobSaveAjax" method="post" action="index.php"><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
" /><input type="hidden" name="parent" value="Settings" /><input type="hidden" name="action" value="SaveAjax" /><input type="hidden" name="record" value="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value;?>
" /><input type="hidden" name="cronjob" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('name');?>
" /><input type="hidden" name="oldstatus" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('status');?>
" /><input type="hidden" id="minimumFrequency" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getMinimumFrequency();?>
" /><input type="hidden" name="frequency" id="frequency" value="" /><div class="modal-body"><div class="form-group"><label class="control-label fieldLabel col-xs-5"><?php echo vtranslate('LBL_STATUS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label><div class="controls fieldValue col-xs-5"><select class="select2 inputElement" name="status"><option <?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('status') == 1) {?> selected="" <?php }?> value="1"><?php echo vtranslate('LBL_ACTIVE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><option <?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('status') == 0) {?> selected="" <?php }?> value="0"><?php echo vtranslate('LBL_INACTIVE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option></select></div></div><div class="form-group"><label class="control-label fieldLabel col-xs-5"><?php echo vtranslate('Frequency',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label><?php $_smarty_tpl->_assignInScope('VALUES', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'explode' ][ 0 ], array( ':',$_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getDisplayValue('frequency') )));
if ($_smarty_tpl->tpl_vars['VALUES']->value[0] == '00' && $_smarty_tpl->tpl_vars['VALUES']->value[1] == '00') {
$_smarty_tpl->_assignInScope('MINUTES', "true");
$_smarty_tpl->_assignInScope('FIELD_VALUE', $_smarty_tpl->tpl_vars['VALUES']->value[1]);
} elseif ($_smarty_tpl->tpl_vars['VALUES']->value[0] == '00') {
$_smarty_tpl->_assignInScope('MINUTES', "true");
$_smarty_tpl->_assignInScope('FIELD_VALUE', $_smarty_tpl->tpl_vars['VALUES']->value[1]);
} elseif ($_smarty_tpl->tpl_vars['VALUES']->value[1] == '00') {
$_smarty_tpl->_assignInScope('MINUTES', "false");
$_smarty_tpl->_assignInScope('FIELD_VALUE', ($_smarty_tpl->tpl_vars['VALUES']->value[0]));
} else {
$_smarty_tpl->_assignInScope('MINUTES', "true");
$_smarty_tpl->_assignInScope('FIELD_VALUE', ($_smarty_tpl->tpl_vars['VALUES']->value[0]*60)+$_smarty_tpl->tpl_vars['VALUES']->value[1]);
}?><div class="controls fieldValue col-xs-2"><input type="text" class="inputElement" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_VALUE']->value;?>
" <?php if ((isset($_smarty_tpl->tpl_vars['FIELD_INFO']->value["mandatory"])) && $_smarty_tpl->tpl_vars['FIELD_INFO']->value["mandatory"] == true) {?> data-rule-required="true" <?php }?> id="frequencyValue"/>&nbsp;</div><div class="controls fieldValue col-xs-3" style="padding-left: 0px;"><select class="select2 inputElement" id="time_format"><option value="mins" <?php if ($_smarty_tpl->tpl_vars['MINUTES']->value == 'true') {?> selected="" <?php }?>><?php echo vtranslate('LBL_MINUTES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><option value="hours" <?php if ($_smarty_tpl->tpl_vars['MINUTES']->value == 'false') {?>selected="" <?php }?>><?php echo vtranslate('LBL_HOURS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option></select></div></div><div class="form-group" style="text-align: center;"><div class="col-xs-2"></div><div class="col-xs-8"><div class="alert alert-info"><?php echo vtranslate($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('description'),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div></div></div></div><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( 'ModalFooter.tpl',$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></form></div></div>	
<?php }
}
