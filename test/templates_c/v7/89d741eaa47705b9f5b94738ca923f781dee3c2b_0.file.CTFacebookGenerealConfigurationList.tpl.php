<?php
/* Smarty version 4.5.5, created on 2025-10-30 08:02:33
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\CTFacebookMessengerIntegration\CTFacebookGenerealConfigurationList.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_69031b9917a425_01639913',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '89d741eaa47705b9f5b94738ca923f781dee3c2b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\CTFacebookMessengerIntegration\\CTFacebookGenerealConfigurationList.tpl',
      1 => 1761802269,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69031b9917a425_01639913 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\vtigercrm\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
?>
<div class="detailViewContainer" id="WhatsappConfiguration" style="margin-top: 20px;"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div style="float:right;"><input type="hidden" name="accessToken" id="accessToken" value="<?php echo $_smarty_tpl->tpl_vars['ACCESSTOKEN']->value;?>
"><?php echo vtranslate('LBL_LOGGED_IN_WITH',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 <?php echo $_smarty_tpl->tpl_vars['USER_NAME']->value;?>
 <a onclick="return javascript:void(0);" id="logoutLink"><?php echo vtranslate('LBL_LOGOUT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a></div><div class="clearfix"><div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><h3><?php echo vtranslate('LBL_FACEBOOK_MESSENGER_INTEGRATION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h3></div></div><div class="block"><div class="clearfix"><div class="col-lg-6 col-md-6 col-sm-6"><h4><?php echo vtranslate('LBL_ADD_FACEBOOK_PAGE_CONFIGURATION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4></div><div class="col-lg-2 col-md-2 col-sm-2"><button class="btn addRecords" id="addRecords" type="button" style="margin-top: 10px;"><i class="fa fa-plus" id="plusIcon" aria-hidden="true"></i></button></div></div><hr><table class="table editview-table no-border facebookPageData"><thead><tr><th><?php echo vtranslate('LBL_CTFACEBOOK_PAGE_SELECTION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><th><?php echo vtranslate('LBL_USERS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><th><?php echo vtranslate('LBL_STATUS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><th><?php echo vtranslate('LBL_ACTIONS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th></tr></thead><tbody><?php if (empty($_smarty_tpl->tpl_vars['FACEBOOK_INTEGRATION_CONFIG_DATA']->value)) {?><tr><td colspan="4"><center><b><?php echo vtranslate('LBL_NO_RECORD_FOUND',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</b></center></td></tr><?php } else {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FACEBOOK_INTEGRATION_CONFIG_DATA']->value, 'value', false, 'key');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?><tr><td><?php echo $_smarty_tpl->tpl_vars['value']->value['facebookPageName'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['value']->value['userGroupNames'];?>
</td><td><?php if ($_smarty_tpl->tpl_vars['value']->value['active'] == '1') {
echo vtranslate('LBL_ACTIVE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
} else {
echo vtranslate('LBL_INACTIVE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
}?></td><td><a class="editFacebookPageConfig" data-id="<?php echo $_smarty_tpl->tpl_vars['value']->value['configId'];?>
"><i class="fa fa-pencil" title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i></a>&nbsp;&nbsp;<span class="deleteFacebookPageConfig" data-id="<?php echo $_smarty_tpl->tpl_vars['value']->value['configId'];?>
" title="<?php echo vtranslate('LBL_DELETE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"><i class="fa fa-trash"></i></span>&nbsp;&nbsp;</td></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?></tbody></table><div class="clearfix"><div class="col-lg-6 col-md-6 col-sm-6"><h4><?php echo vtranslate('LBL_CHOOSE_MODULES_FIELDS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4></div><div class="col-lg-2 col-md-2 col-sm-2"><button class="btn addNewFBField" type="button" style="margin-top: 10px;"><i class="fa fa-plus" id="plusIcon" aria-hidden="true"></i></button></div></div><hr><div id="facebookGeneralSettingsDiv"><form id="generalSettingsForm" name="generalSettingsForm"><div><table class="table editview-table no-border moduleMappingTable"><?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['ALLLOWMODULES']->value) == 0) {?><span><b><?php echo vtranslate('LBL_ATLEAST_SELECT_ONE_MODULE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</b></span><?php } else { ?><thead><tr><th class="fieldLabel alignMiddle"><?php echo vtranslate('LBL_MODULE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><th class="fieldLabel alignMiddle"><?php echo vtranslate('LBL_ACTIVE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><th class="fieldLabel alignMiddle"><?php echo vtranslate('LBL_ACTIONS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th></tr></thead><?php }?><tbody><input type="hidden" name="whatsappModuleRow" value="<?php echo smarty_modifier_count($_smarty_tpl->tpl_vars['ALLLOWMODULES']->value);?>
"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ALLLOWMODULES']->value, 'ALLLOWMODULES_VALUE', false, 'ALLLOWMODULES_KEY');
$_smarty_tpl->tpl_vars['ALLLOWMODULES_VALUE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ALLLOWMODULES_KEY']->value => $_smarty_tpl->tpl_vars['ALLLOWMODULES_VALUE']->value) {
$_smarty_tpl->tpl_vars['ALLLOWMODULES_VALUE']->do_else = false;
?><tr><td class="fieldLabel alignMiddle" style="width: 200px;"><?php echo vtranslate($_smarty_tpl->tpl_vars['ALLLOWMODULES_KEY']->value,$_smarty_tpl->tpl_vars['ALLLOWMODULES_KEY']->value);?>
</td><td class="fieldLabel alignMiddle" style="width: 200px;"><?php if ($_smarty_tpl->tpl_vars['ALLLOWMODULES_VALUE']->value['active'] == 1) {
echo vtranslate('LBL_ACTIVE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
} else {
echo vtranslate('LBL_INACTIVE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);
}?>											</td><td class="fieldLabel alignMiddle" style="width:200px;"><a id="editFacebookModule" data-facebookmodulename="<?php echo $_smarty_tpl->tpl_vars['ALLLOWMODULES_KEY']->value;?>
" data-facebookmodulestatus="<?php echo $_smarty_tpl->tpl_vars['ALLLOWMODULES_VALUE']->value['active'];?>
"><i class="fa fa-pencil" title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i></a>&nbsp;&nbsp;<a id="deletedFacebookModule" data-facebookmodulename="<?php echo $_smarty_tpl->tpl_vars['ALLLOWMODULES_KEY']->value;?>
"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tbody></table></div><br></form></div></div></div><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;"><div class="block"><div id="facebookGeneralSettingsDiv"><form id="generalSettingsForm" name="generalSettingsForm"><input type="hidden" name="recordId" id="recordId" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
"><input type="hidden" name="chatTypeId" id="chatTypeId" value="<?php echo $_smarty_tpl->tpl_vars['CHATTYPEID']->value;?>
"><div><h4><?php echo vtranslate('LBL_GENERAL_SETTINGS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4></div><hr><div><table class="table editview-table no-border"><tbody><tr><td class="fieldLabel"><label><?php echo vtranslate('LBL_FACEBOOK_WINDOW_VIEW',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></td><td><select class="select2 inputElement col-lg-12 col-md-12 col-lg-12" name="facebookWindowView" id="facebookWindowView"><?php echo $_smarty_tpl->tpl_vars['THEME_HTML']->value;?>
</select></td></tr><tr><td class="fieldLabel"><label><?php echo vtranslate('LBL_ACTIVE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></td><td><input type="checkbox" name="facebookGeneralSettingActive" id="facebookGeneralSettingActive" value="<?php echo $_smarty_tpl->tpl_vars['GENERALSETTINGSDATA']->value['active'];?>
" <?php if (!empty($_smarty_tpl->tpl_vars['GENERALSETTINGSDATA']->value) && $_smarty_tpl->tpl_vars['GENERALSETTINGSDATA']->value['active'] == 1) {?> checked="checked" <?php }?>></td></tr><tr class=""><td class="fieldLabel"><label><?php echo vtranslate('LBL_NOTIFICATION_TONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></td><td class="fieldValue"><select class="inputElement select2 col-lg-12 col-md-12 col-lg-12" id="notificationtone" name="notificationtone"><option value=""><?php echo vtranslate('LBL_SELECT_AN_OPTION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><option <?php if ($_smarty_tpl->tpl_vars['GENERALSETTINGSDATA']->value['fieldNameValue']['notificationtone'] == 'layouts/v7/modules/CTChatLog/CTChatLog Default.mp3') {?> selected <?php }?> value="layouts/v7/modules/CTChatLog/CTChatLog Default.mp3"><?php echo vtranslate('LBL_Facebook_Messanger_Default',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><option <?php if ($_smarty_tpl->tpl_vars['GENERALSETTINGSDATA']->value['fieldNameValue']['notificationtone'] == 'layouts/v7/modules/CTChatLog/Hangout Message.mp3') {?> selected <?php }?> value="layouts/v7/modules/CTChatLog/Hangout Message.mp3"><?php echo vtranslate('LBL_Hangout_Message',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><option<?php if ($_smarty_tpl->tpl_vars['GENERALSETTINGSDATA']->value['fieldNameValue']['notificationtone'] == 'silent') {?> selected <?php }?> value="silent"><?php echo vtranslate('LBL_SILENT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option></select></td></tr><tr><td class="fieldLabel"><label><?php echo vtranslate('LBL_AUTO_RESPONDER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></td><td><input type="checkbox" name="autoResponder" id="autoResponder" value="<?php echo $_smarty_tpl->tpl_vars['GENERALSETTINGSDATA']->value['fieldNameValue']['autoResponder'];?>
" <?php if (!empty($_smarty_tpl->tpl_vars['GENERALSETTINGSDATA']->value) && $_smarty_tpl->tpl_vars['GENERALSETTINGSDATA']->value['fieldNameValue']['autoResponder'] == 1) {?> checked="checked" <?php }?>></td></tr><tr><td class="fieldLabel"><label><?php echo vtranslate('LBL_AUTO_RESPONDER_TEXT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></td><td><textarea name="autoResponderText" id="autoResponderText" value="$GENERALSETTINGSDATA['fieldNameValue']['autoResponderText']"><?php echo $_smarty_tpl->tpl_vars['GENERALSETTINGSDATA']->value['fieldNameValue']['autoResponderText'];?>
</textarea><label><?php echo vtranslate('LBL_AUTO_RESPONDER_TEXT_MESSAGE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></td></tr></tbody></table></div><br></form><div class='modal-overlay-footer clearfix'><div class='textAlignCenter col-lg-12 col-md-12 col-sm-12'><button class='btn btn-success' id='saveFacebookGeneralSetting'><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button>&nbsp;&nbsp;<a class='cancelLink' id='cancelLink' href="index.php?parent=Settings&module=CTFacebookMessengerIntegration&view=CTGeneralConfiguration"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a></div></div></div></div></div></div><?php }
}
