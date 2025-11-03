<?php
/* Smarty version 4.5.5, created on 2025-10-30 05:57:36
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Settings\ModuleManager\ListContents.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_6902fe50594553_88444817',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '813ed1cfc504db1100244c83293a29cfa24f8769' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Settings\\ModuleManager\\ListContents.tpl',
      1 => 1761802269,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6902fe50594553_88444817 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="listViewPageDiv detailViewContainer" id="moduleManagerContents"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 "><div id="listview-actions" class="listview-actions-container"><div class="clearfix"><h4 class="pull-left"><?php echo vtranslate('LBL_MODULE_MANAGER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4><div class="pull-right"><div class="btn-group"><button class="btn btn-default" type="button" onclick='window.location.href="<?php echo $_smarty_tpl->tpl_vars['IMPORT_USER_MODULE_FROM_FILE_URL']->value;?>
"'><?php echo vtranslate('LBL_IMPORT_MODULE_FROM_ZIP',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button></div>&nbsp;<div class="btn-group"><button class="btn btn-default" type="button" onclick='window.location.href = "<?php echo $_smarty_tpl->tpl_vars['IMPORT_MODULE_URL']->value;?>
"'><?php echo vtranslate('LBL_EXTENSION_STORE','Settings:ExtensionStore');?>
</button></div></div></div><br><div class="contents"><?php $_smarty_tpl->_assignInScope('COUNTER', 0);?><table class="table table-bordered modulesTable"><tr><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ALL_MODULES']->value, 'MODULE_MODEL', false, 'MODULE_ID');
$_smarty_tpl->tpl_vars['MODULE_MODEL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['MODULE_ID']->value => $_smarty_tpl->tpl_vars['MODULE_MODEL']->value) {
$_smarty_tpl->tpl_vars['MODULE_MODEL']->do_else = false;
$_smarty_tpl->_assignInScope('MODULE_NAME', $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name'));
$_smarty_tpl->_assignInScope('MODULE_ACTIVE', $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->isActive());
$_smarty_tpl->_assignInScope('MODULE_LABEL', vtranslate($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name')));
if ($_smarty_tpl->tpl_vars['COUNTER']->value == 2) {?></tr><tr><?php $_smarty_tpl->_assignInScope('COUNTER', 0);
}?><td class="ModulemanagerSettings"><div class="moduleManagerBlock"><span class="col-lg-1" style="line-height: 2.5;"><input type="checkbox" value="" name="moduleStatus" data-module="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
" data-module-translation="<?php echo $_smarty_tpl->tpl_vars['MODULE_LABEL']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->isActive()) {?>checked<?php }?> /></span><span class="col-lg-1 moduleImage <?php if (!$_smarty_tpl->tpl_vars['MODULE_ACTIVE']->value) {?>dull <?php }?>"><?php if (vimage_path(($_smarty_tpl->tpl_vars['MODULE_NAME']->value).('.png')) != false) {?><img class="alignMiddle" src="<?php echo vimage_path(($_smarty_tpl->tpl_vars['MODULE_NAME']->value).('.png'));?>
" alt="<?php echo $_smarty_tpl->tpl_vars['MODULE_LABEL']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['MODULE_LABEL']->value;?>
"/><?php } else { ?><img class="alignMiddle" src="<?php echo vimage_path('DefaultModule.png');?>
" alt="<?php echo $_smarty_tpl->tpl_vars['MODULE_LABEL']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['MODULE_LABEL']->value;?>
"/><?php }?></span><span class="col-lg-7 moduleName <?php if (!$_smarty_tpl->tpl_vars['MODULE_ACTIVE']->value) {?> dull <?php }?>"><h5 style="line-height: 0.5;"><?php echo $_smarty_tpl->tpl_vars['MODULE_LABEL']->value;?>
</h5></span><?php $_smarty_tpl->_assignInScope('SETTINGS_LINKS', $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getSettingLinks());
if (!in_array($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['RESTRICTED_MODULES_LIST']->value) && (php7_count($_smarty_tpl->tpl_vars['SETTINGS_LINKS']->value) > 0)) {?><span class="col-lg-3 moduleblock"><span class="btn-group pull-right actions <?php if (!$_smarty_tpl->tpl_vars['MODULE_ACTIVE']->value) {?>hide<?php }?>"><button class="btn btn-default btn-sm dropdown-toggle unpin hiden " data-toggle="dropdown"><?php echo vtranslate('LBL_SETTINGS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<i class="caret"></i></button><ul class="dropdown-menu pull-right dropdownfields"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['SETTINGS_LINKS']->value, 'SETTINGS_LINK');
$_smarty_tpl->tpl_vars['SETTINGS_LINK']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['SETTINGS_LINK']->value) {
$_smarty_tpl->tpl_vars['SETTINGS_LINK']->do_else = false;
if ($_smarty_tpl->tpl_vars['MODULE_NAME']->value == 'Calendar') {
if ($_smarty_tpl->tpl_vars['SETTINGS_LINK']->value['linklabel'] == 'LBL_EDIT_FIELDS') {?><li><a href="<?php echo $_smarty_tpl->tpl_vars['SETTINGS_LINK']->value['linkurl'];?>
&sourceModule=Events"><?php echo vtranslate($_smarty_tpl->tpl_vars['SETTINGS_LINK']->value['linklabel'],$_smarty_tpl->tpl_vars['MODULE_NAME']->value,vtranslate('LBL_EVENTS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value));?>
</a></li><li><a href="<?php echo $_smarty_tpl->tpl_vars['SETTINGS_LINK']->value['linkurl'];?>
&sourceModule=Calendar"><?php echo vtranslate($_smarty_tpl->tpl_vars['SETTINGS_LINK']->value['linklabel'],$_smarty_tpl->tpl_vars['MODULE_NAME']->value,vtranslate('LBL_TASKS','Calendar'));?>
</a></li><?php } elseif ($_smarty_tpl->tpl_vars['SETTINGS_LINK']->value['linklabel'] == 'LBL_EDIT_WORKFLOWS') {?><li><a href="<?php echo $_smarty_tpl->tpl_vars['SETTINGS_LINK']->value['linkurl'];?>
&sourceModule=Events"><?php echo vtranslate('LBL_EVENTS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 <?php echo vtranslate('LBL_WORKFLOWS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</a></li><li><a href="<?php echo $_smarty_tpl->tpl_vars['SETTINGS_LINK']->value['linkurl'];?>
&sourceModule=Calendar"><?php echo vtranslate('LBL_TASKS','Calendar');?>
 <?php echo vtranslate('LBL_WORKFLOWS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</a></li><?php } else { ?><li><a href=<?php echo $_smarty_tpl->tpl_vars['SETTINGS_LINK']->value['linkurl'];?>
><?php echo vtranslate($_smarty_tpl->tpl_vars['SETTINGS_LINK']->value['linklabel'],$_smarty_tpl->tpl_vars['MODULE_NAME']->value,vtranslate($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value));?>
</a></li><?php }
} else { ?><li><a	<?php if (stripos($_smarty_tpl->tpl_vars['SETTINGS_LINK']->value['linkurl'],'javascript:') === 0) {?>onclick='<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'substr' ][ 0 ], array( $_smarty_tpl->tpl_vars['SETTINGS_LINK']->value['linkurl'],strlen("javascript:") ));?>
;'<?php } else { ?>onclick='window.location.href = "<?php echo $_smarty_tpl->tpl_vars['SETTINGS_LINK']->value['linkurl'];?>
"'<?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['SETTINGS_LINK']->value['linklabel'],$_smarty_tpl->tpl_vars['MODULE_NAME']->value,vtranslate("SINGLE_".((string)$_smarty_tpl->tpl_vars['MODULE_NAME']->value),$_smarty_tpl->tpl_vars['MODULE_NAME']->value));?>
</a></li><?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></ul></span></span><?php }?></div><?php $_smarty_tpl->_assignInScope('COUNTER', $_smarty_tpl->tpl_vars['COUNTER']->value+1);?></td><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tr></table></div></div></div></div>
<?php }
}
