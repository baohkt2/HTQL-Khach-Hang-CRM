<?php
/* Smarty version 4.5.5, created on 2025-11-05 17:03:58
  from 'C:\xampp\htdocs\HTQL-Khach-Hang-CRM-vvan\layouts\v7\modules\Settings\ITS4YouInstaller\Reminder.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690b837e0c8b13_88036057',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2d09d4fe01e2f345786fd80154fd02f452bc0f98' => 
    array (
      0 => 'C:\\xampp\\htdocs\\HTQL-Khach-Hang-CRM-vvan\\layouts\\v7\\modules\\Settings\\ITS4YouInstaller\\Reminder.tpl',
      1 => 1762352656,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690b837e0c8b13_88036057 (Smarty_Internal_Template $_smarty_tpl) {
?><li class="its4you_installer_menu"><div class="dropdown pull-left"><div class="dropdown-toggle displayInlineBlock" data-toggle="dropdown" aria-expanded="true"><a href="#" class="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_menu_icon fa installer_icon"><div class="its4you_installer_badge numberCircle hide"></div></a></div><ul class="dropdown-menu its4you_installer_dropdown"><div id="its4you_installer_title"><div class="its4you_installer_icon"></div><div class="its4you_installer_text"><b><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate('LBL_ALERTS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</b></div></div><hr><div style="padding:5px 15px"><div class="its4you_installer_alerts"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ALERTS']->value, 'ALERT');
$_smarty_tpl->tpl_vars['ALERT']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ALERT']->value) {
$_smarty_tpl->tpl_vars['ALERT']->do_else = false;
?><div class="its4you_installer_alert clearfix <?php if ($_smarty_tpl->tpl_vars['ALERT']->value['status'] != 1) {?>installer_new_alert<?php }?>"><div class="pull-left installer_alert_icon"><i class="fa fa-<?php echo $_smarty_tpl->tpl_vars['ALERT']->value['icon'];?>
"></i></div><div class="pull-left" style="max-width: 300px;"><div><b><?php echo vtranslate($_smarty_tpl->tpl_vars['ALERT']->value['alert_type'],$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</b>&nbsp;<a style="padding: 0" href="<?php if ($_smarty_tpl->tpl_vars['ALERT']->value['link'] != '') {
echo $_smarty_tpl->tpl_vars['ALERT']->value['link'];
} else { ?>#<?php }?>"><span><?php echo $_smarty_tpl->tpl_vars['ALERT']->value['message'];?>
</span></a></div><div style="color: #888"><?php if (!empty($_smarty_tpl->tpl_vars['ALERT']->value['createdtime'])) {?><span><?php echo Vtiger_Util_Helper::formatDateIntoStrings($_smarty_tpl->tpl_vars['ALERT']->value['createdtime']);?>
</span>&nbsp;&nbsp;<?php }?></div></div></div><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></div><br><div style="text-align:center;"><a style="padding: 5px 12px;" href="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getDefaultUrl();?>
" class="btn btn-primary"><?php echo vtranslate('LBL_MANAGE_MODULES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a></div></div></ul></div><style>.<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_menu_icon {height: 37px;vertical-align: top;display: inline-block;line-height: 15px;}.installer_icon:after {content: ' ';display: inline-block;height: 15px;width: 15px;background: no-repeat url('layouts/v7/modules/Settings/ITS4YouInstaller/images/ITS4YouIcon.png') center center / 15px 15px;}.its4you_installer_alerts {/*max-height: 500px;overflow: auto;*/width: 400px;}.its4you_installer_alert {padding: 0 0 10px 0;}#its4you_installer_title {display: block;position: relative;line-height: 50px;vertical-align: top;height: 50px;margin: 4px 10px;background: #EFEFEF;}.its4you_installer_text {line-height: 48px;display: inline-block;padding: 0 15px;font-size: 15px;margin: 0 0 0 50px;}.its4you_installer_icon {background: no-repeat url("layouts/v7/modules/Settings/ITS4YouInstaller/images/ITS4YouIcon50x50.png") center center / 50px 50px;color: #fff;text-align: center;vertical-align: middle;display: inline-block;line-height: 50px;width: 50px;height: 50px;position: absolute;}.installer_alert_icon .fa-warning{color: #ff0000;}.installer_alert_icon .fa-info-circle{color: #0088ff;}.installer_alert_icon .fa-refresh{color: #00aa00;}.installer_alert_icon .fa-question{color: #ffaa00;}.installer_alert_icon .fa-bell{color: #fd7e14;}.installer_alert_icon {width: 24px;height: 24px;margin: 12px 22px 12px 12px;}.installer_alert_icon .fa {font-size: 24px;}.its4you_installer_badge {position: absolute;right: 0;bottom: 0;border-radius: 10px;font: bold 10px Arial;padding: 3px 5px;background: #0088cc none repeat scroll 0 0;margin-bottom: 5px;}</style></li><?php }
}
