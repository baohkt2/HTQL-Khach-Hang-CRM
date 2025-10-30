<?php
/* Smarty version 4.5.5, created on 2025-10-10 08:44:11
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Events\partials\EditViewContents.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e8c75b214a60_18425899',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a982b9671dca152435b823c6ae21266995311158' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Events\\partials\\EditViewContents.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e8c75b214a60_18425899 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "partials/EditViewContents.tpl",'Vtiger' )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?><div name='editContent'><div class='fieldBlockContainer' data-block="<?php echo (isset($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value)) ? $_smarty_tpl->tpl_vars['BLOCK_LABEL']->value : '';?>
"><h4 class='fieldBlockHeader'><?php echo vtranslate('LBL_INVITE_USER_BLOCK',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h4><hr><table class="table table-borderless"><tr><td class="fieldLabel alignMiddle"><?php echo vtranslate('LBL_INVITE_USERS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td><td class="fieldValue"><select id="selectedUsers" class="select2 inputElement" multiple name="selectedusers[]"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ACCESSIBLE_USERS']->value, 'USER_NAME', false, 'USER_ID');
$_smarty_tpl->tpl_vars['USER_NAME']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['USER_ID']->value => $_smarty_tpl->tpl_vars['USER_NAME']->value) {
$_smarty_tpl->tpl_vars['USER_NAME']->do_else = false;
if ($_smarty_tpl->tpl_vars['USER_ID']->value == $_smarty_tpl->tpl_vars['CURRENT_USER']->value->getId()) {
continue 1;
}?><option value="<?php echo $_smarty_tpl->tpl_vars['USER_ID']->value;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['USER_ID']->value,$_smarty_tpl->tpl_vars['INVITIES_SELECTED']->value)) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['USER_NAME']->value;?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></td><td></td><td></td></tr></table><input type="hidden" name="recurringEditMode" value="" /><!--Confirmation modal for updating Recurring Events--><?php $_smarty_tpl->_assignInScope('MODULE', "Calendar");?><div class="modal-dialog modelContainer recurringEventsUpdation modal-content hide" style='min-width:350px;'><?php ob_start();
echo vtranslate('LBL_EDIT_RECURRING_EVENT',$_smarty_tpl->tpl_vars['MODULE']->value);
$_prefixVariable1 = ob_get_clean();
$_smarty_tpl->_assignInScope('HEADER_TITLE', $_prefixVariable1);
$_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0, true);
?><div class="modal-body"><div class="container-fluid"><div class="row" style="padding: 1%;padding-left: 3%;"><?php echo vtranslate('LBL_EDIT_RECURRING_EVENTS_INFO',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</div><div class="row" style="padding: 1%;"><span class="col-sm-12"><span class="col-sm-4"><button class="btn btn-default onlyThisEvent" style="width : 150px"><?php echo vtranslate('LBL_ONLY_THIS_EVENT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button></span><span class="col-sm-8"><?php echo vtranslate('LBL_ONLY_THIS_EVENT_EDIT_INFO',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span></span></div><div class="row" style="padding: 1%;"><span class="col-sm-12"><span class="col-sm-4"><button class="btn btn-default futureEvents" style="width : 150px"><?php echo vtranslate('LBL_FUTURE_EVENTS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button></span><span class="col-sm-8"><?php echo vtranslate('LBL_FUTURE_EVENTS_EDIT_INFO',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span></span></div><div class="row" style="padding: 1%;"><span class="col-sm-12"><span class="col-sm-4"><button class="btn btn-default allEvents" style="width : 150px"><?php echo vtranslate('LBL_ALL_EVENTS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button></span><span class="col-sm-8"><?php echo vtranslate('LBL_ALL_EVENTS_EDIT_INFO',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span></span></div></div></div></div><!--Confirmation modal for updating Recurring Events--></div></div>
<?php }
}
