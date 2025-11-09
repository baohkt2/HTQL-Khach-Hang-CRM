<?php
/* Smarty version 4.5.5, created on 2025-10-30 07:03:02
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\CTFacebookMessengerIntegration\License.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_69030da6a44827_27099468',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a8f78917ef390c8475a4374aa8043d921d96fd8b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\CTFacebookMessengerIntegration\\License.tpl',
      1 => 1761802269,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69030da6a44827_27099468 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="container-fluid" id="LicenseSetting"><div class="widget_header row-fluid"><div class=""><h3><?php echo vtranslate('LBL_LICENCE_SETTINGS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 </h3></div></div><hr><div class="editContent"><table class="table table-bordered equalSplit"><thead></thead><tr><td class="fieldLabel alignMiddle"><label class="pull-right"><span class="redColor">*</span> <?php echo vtranslate('LBL_VALIDATE_LICENSE_KEY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></td><td class="fieldValue"><input type="text" class="inputElement" name="licence" id="licence" data-validation-engine='validate[required]' value="" style="width: 40%;"/></td></tr></table><br><div class="row-fluid"><div class="pull-right"><button class="btn btn-success" id="saveLicense"><strong> <?php echo vtranslate('LBL_SUBMIT_LICENSE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></button></div></div></div></div>
<?php }
}
