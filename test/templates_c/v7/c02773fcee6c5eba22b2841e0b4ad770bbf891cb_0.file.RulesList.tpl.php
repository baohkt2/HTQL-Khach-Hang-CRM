<?php
/* Smarty version 4.5.5, created on 2025-09-16 08:43:31
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Settings\MailConverter\RulesList.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68c923335a6346_09458184',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c02773fcee6c5eba22b2841e0b4ad770bbf891cb' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Settings\\MailConverter\\RulesList.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68c923335a6346_09458184 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="listViewContentDiv col-lg-12"><h4><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4><hr><?php if (!$_smarty_tpl->tpl_vars['RECORD_EXISTS']->value) {?><div class="mailConveterDesc"><center><br><br><div><?php echo vtranslate('LBL_MAILCONVERTER_DESCRIPTION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><img src="<?php echo vimage_path('MailConverter.png');?>
" alt="Mail Converter"><br><br><a onclick="window.location.href='<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getCreateRecordUrl();?>
'" style="color: #15c !important;"><u class="cursorPointer" style="font-size:12pt;"><?php echo vtranslate('LBL_CREATE_MAILBOX_NOW',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</u></a><br><br></center></div><?php } else { ?><input type="hidden" id="scannerId" value="<?php echo $_smarty_tpl->tpl_vars['SCANNER_ID']->value;?>
"/><div class="col-lg-12"><div class="col-lg-4 mailBoxDropdownWrapper" style="padding-left: 0px;"><select class="mailBoxDropdown select2" style="max-width: 300px; min-width: 200px;"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MAILBOXES']->value, 'SCANNER');
$_smarty_tpl->tpl_vars['SCANNER']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['SCANNER']->value) {
$_smarty_tpl->tpl_vars['SCANNER']->do_else = false;
?><option value="<?php echo $_smarty_tpl->tpl_vars['SCANNER']->value['scannerid'];?>
" <?php if ($_smarty_tpl->tpl_vars['SCANNER_ID']->value == $_smarty_tpl->tpl_vars['SCANNER']->value['scannerid']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['SCANNER']->value['scannername'];?>
</option><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></div><div class="col-lg-4" id="mailConverterStats"><?php if ($_smarty_tpl->tpl_vars['CRON_RECORD_MODEL']->value->isEnabled()) {
if ($_smarty_tpl->tpl_vars['CRON_RECORD_MODEL']->value->hadTimedout()) {
echo vtranslate('LBL_LAST_SCAN_TIMED_OUT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE_NAME']->value);?>
.<?php } elseif ($_smarty_tpl->tpl_vars['CRON_RECORD_MODEL']->value->getLastEndDateTime() != '') {
echo vtranslate('LBL_LAST_SCAN_AT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE_NAME']->value);
echo $_smarty_tpl->tpl_vars['CRON_RECORD_MODEL']->value->getLastEndDateTime();?>
<br /><?php echo vtranslate('LBL_FOLDERS_SCANNED',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE_NAME']->value);?>
&nbsp;:&nbsp;<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FOLDERS_SCANNED']->value, 'FOLDER');
$_smarty_tpl->tpl_vars['FOLDER']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['FOLDER']->value) {
$_smarty_tpl->tpl_vars['FOLDER']->do_else = false;
?><strong><?php echo $_smarty_tpl->tpl_vars['FOLDER']->value;?>
&nbsp;&nbsp;</strong><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}?></div><div class="col-lg-4" style="padding-right: 0px;"><div class="btn-group pull-right"><button class="btn btn-default addButton" id="addRuleButton" title="<?php echo vtranslate('LBL_DRAG_AND_DROP_BLOCK_TO_PRIORITISE_THE_RULE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"<?php if (stripos($_smarty_tpl->tpl_vars['SCANNER_MODEL']->value->getCreateRuleRecordUrl(),'javascript:') === 0) {?>onclick='<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'substr' ][ 0 ], array( $_smarty_tpl->tpl_vars['SCANNER_MODEL']->value->getCreateRuleRecordUrl(),strlen("javascript:") ));?>
'<?php } else { ?>onclick='window.location.href="<?php echo $_smarty_tpl->tpl_vars['SCANNER_MODEL']->value->getCreateRuleRecordUrl();?>
"'<?php }?>><i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo vtranslate('LBL_ADD_RULE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button><button href="javascript:void(0);" data-toggle="dropdown" class="btn btn-default" style="margin-left: 4px;"><?php echo vtranslate('LBL_ACTIONS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE_NAME']->value);?>
&nbsp;<i class="caret"></i></button><ul class="dropdown-menu pull-right"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RECORD']->value->getRecordLinks(), 'LINK');
$_smarty_tpl->tpl_vars['LINK']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['LINK']->value) {
$_smarty_tpl->tpl_vars['LINK']->do_else = false;
?><li><a <?php if (strpos($_smarty_tpl->tpl_vars['LINK']->value->getUrl(),'javascript:') === 0) {?> href='javascript:void(0);' onclick='<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'substr' ][ 0 ], array( $_smarty_tpl->tpl_vars['LINK']->value->getUrl(),strlen("javascript:") ));?>
;'<?php } else { ?>href=<?php echo $_smarty_tpl->tpl_vars['LINK']->value->getUrl();
}?>><?php echo vtranslate($_smarty_tpl->tpl_vars['LINK']->value->getLabel(),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a></li><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></ul></div></div></div><br><div id="mailConverterBody" class="col-lg-12"><br><div id="rulesList"><?php if (php7_count($_smarty_tpl->tpl_vars['RULE_MODELS_LIST']->value)) {
$_smarty_tpl->_assignInScope('RULE_COUNT', 1);
$_smarty_tpl->_assignInScope('FIELDS', $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getSetupRuleFields());
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['RULE_MODELS_LIST']->value, 'RULE_MODEL');
$_smarty_tpl->tpl_vars['RULE_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['RULE_MODEL']->value) {
$_smarty_tpl->tpl_vars['RULE_MODEL']->do_else = false;
?><div class="row-fluid padding-bottom1per rule" data-id="<?php echo $_smarty_tpl->tpl_vars['RULE_MODEL']->value->get('ruleid');?>
" data-blockid="block_<?php echo $_smarty_tpl->tpl_vars['RULE_MODEL']->value->get('ruleid');?>
"><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "Rule.tpl",$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('RULE_COUNT'=>$_smarty_tpl->tpl_vars['RULE_COUNT']->value), 0, true);
?></div><?php $_smarty_tpl->_assignInScope('RULE_COUNT', $_smarty_tpl->tpl_vars['RULE_COUNT']->value+1);
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
} else { ?><div class="details border1px" style="text-align: center; min-height: 200px; padding-top: 100px;"><?php echo vtranslate('LBL_NO_RULES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><?php }?></div></div><?php }
}
}
