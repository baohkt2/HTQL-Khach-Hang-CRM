<?php
/* Smarty version 4.5.5, created on 2025-11-05 03:51:18
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\VTEStore\HealthCheckData.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690ac9b621a2b9_36644041',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2230094481a19864408cecb975cd275268a65599' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\VTEStore\\HealthCheckData.tpl',
      1 => 1762118939,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690ac9b621a2b9_36644041 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\vtigercrm\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
?>
<span style="text-decoration: underline"><strong><?php echo vtranslate('Checking Tables',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 ...</strong></span>
<?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['CHECKINGTABLESDATA']->value) > 0) {?>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['CHECKINGTABLESDATA']->value, 'tbl');
$_smarty_tpl->tpl_vars['tbl']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['tbl']->value) {
$_smarty_tpl->tpl_vars['tbl']->do_else = false;
?>
        <br>- <?php echo $_smarty_tpl->tpl_vars['tbl']->value['name'];?>
: <font color="<?php if ($_smarty_tpl->tpl_vars['tbl']->value['status'] == 'OK') {?>green<?php } else { ?>red<?php }?>"><?php echo $_smarty_tpl->tpl_vars['tbl']->value['status'];?>
</font>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
} else { ?>
    <br> <?php echo vtranslate('Not Found',$_smarty_tpl->tpl_vars['MODULE']->value);?>

<?php }?>
<br><br>

<span style="text-decoration: underline"><strong><?php echo vtranslate('Checking Collation',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 ...</strong></span>
<?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['CHECKINGCOLLATION']->value) > 0) {?>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['CHECKINGCOLLATION']->value, 'VAL', false, 'KEY');
$_smarty_tpl->tpl_vars['VAL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['KEY']->value => $_smarty_tpl->tpl_vars['VAL']->value) {
$_smarty_tpl->tpl_vars['VAL']->do_else = false;
?>
        <br>- <?php echo $_smarty_tpl->tpl_vars['KEY']->value;?>
: <font color="<?php if ($_smarty_tpl->tpl_vars['VAL']->value == 'OK') {?>green<?php } else { ?>red<?php }?>"><?php echo $_smarty_tpl->tpl_vars['VAL']->value;?>
</font>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
} else { ?>
    <br> <?php echo vtranslate('Not Found',$_smarty_tpl->tpl_vars['MODULE']->value);?>

<?php }?>
<br><br>

<?php if (!empty($_smarty_tpl->tpl_vars['CHECKSERVER_LIB']->value) || !empty($_smarty_tpl->tpl_vars['CHECKSERVER_CRONJOB']->value)) {?>
    <span style="text-decoration: underline"><strong><?php echo vtranslate('Checking Server',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 ...</strong></span>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['CHECKSERVER_LIB']->value, 'VAL', false, 'KEY');
$_smarty_tpl->tpl_vars['VAL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['KEY']->value => $_smarty_tpl->tpl_vars['VAL']->value) {
$_smarty_tpl->tpl_vars['VAL']->do_else = false;
?>
        <br>- <?php echo $_smarty_tpl->tpl_vars['KEY']->value;?>
: <font color="<?php if ($_smarty_tpl->tpl_vars['VAL']->value == 'OK' || $_smarty_tpl->tpl_vars['VAL']->value == 'Installed') {?>green<?php } else { ?>red<?php }?>"><?php echo $_smarty_tpl->tpl_vars['VAL']->value;?>
</font>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php if (!empty($_smarty_tpl->tpl_vars['CHECKSERVER_CRONJOB']->value)) {?>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['CHECKSERVER_CRONJOB']->value, 'VAL', false, 'KEY');
$_smarty_tpl->tpl_vars['VAL']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['KEY']->value => $_smarty_tpl->tpl_vars['VAL']->value) {
$_smarty_tpl->tpl_vars['VAL']->do_else = false;
?>
            <br>- <?php echo $_smarty_tpl->tpl_vars['KEY']->value;?>
: <font color="<?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'strstr' ][ 0 ], array( $_smarty_tpl->tpl_vars['VAL']->value,'Not Running' ))) {?>red<?php } else { ?>green<?php }?>"><?php echo $_smarty_tpl->tpl_vars['VAL']->value;?>
</font>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php }?>
    <br><br>
<?php }?>

<span style="text-decoration: underline"><strong><?php echo vtranslate('Checking Critical Areas',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 ...</strong></span>
<?php if ($_smarty_tpl->tpl_vars['CHECKINGCRITICALAREASDATA']->value['Status'] != 'OK') {?>
    <br><font color="red"><?php echo $_smarty_tpl->tpl_vars['CHECKINGCRITICALAREASDATA']->value['Status'];?>
</font>
<?php } else { ?>
    <br>- <?php echo vtranslate('module enabled',$_smarty_tpl->tpl_vars['MODULE']->value);?>
?: <font color="<?php if ($_smarty_tpl->tpl_vars['CHECKINGCRITICALAREASDATA']->value['module_enabled'] == 'OK') {?>green<?php } else { ?>red<?php }?>"><?php echo $_smarty_tpl->tpl_vars['CHECKINGCRITICALAREASDATA']->value['module_enabled'];?>
</font>
    <br>- vte_modules: <font color="<?php if ($_smarty_tpl->tpl_vars['CHECKINGCRITICALAREASDATA']->value['vte_modules'] == 'OK') {?>green<?php } else { ?>red<?php }?>"><?php echo $_smarty_tpl->tpl_vars['CHECKINGCRITICALAREASDATA']->value['vte_modules'];?>
</font>

    <?php if ($_smarty_tpl->tpl_vars['CHECKINGCRITICALAREASDATA']->value['vtiger_ws_entity'] != '') {?>
        <br>- vtiger_ws_entity: <font color="<?php if ($_smarty_tpl->tpl_vars['CHECKINGCRITICALAREASDATA']->value['vtiger_ws_entity'] == 'OK') {?>green<?php } else { ?>red<?php }?>"><?php echo $_smarty_tpl->tpl_vars['CHECKINGCRITICALAREASDATA']->value['vtiger_ws_entity'];?>
</font>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['CHECKINGCRITICALAREASDATA']->value['vtiger_links'] != '') {?>
        <br>- vtiger_links: <font color="<?php if ($_smarty_tpl->tpl_vars['CHECKINGCRITICALAREASDATA']->value['vtiger_links'] == 'OK') {?>green<?php } else { ?>red<?php }?>"><?php echo $_smarty_tpl->tpl_vars['CHECKINGCRITICALAREASDATA']->value['vtiger_links'];?>
</font>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['CHECKINGCRITICALAREASDATA']->value['vtiger_settings_field'] != '') {?>
        <br>- vtiger_settings_field: <font color="<?php if ($_smarty_tpl->tpl_vars['CHECKINGCRITICALAREASDATA']->value['vtiger_settings_field'] == 'OK') {?>green<?php } else { ?>red<?php }?>"><?php echo $_smarty_tpl->tpl_vars['CHECKINGCRITICALAREASDATA']->value['vtiger_settings_field'];?>
</font>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['CHECKINGCRITICALAREASDATA']->value['vtiger_eventhandlers'] != '') {?>
        <br>- vtiger_eventhandlers: <font color="<?php if ($_smarty_tpl->tpl_vars['CHECKINGCRITICALAREASDATA']->value['vtiger_eventhandlers'] == 'OK') {?>green<?php } else { ?>red<?php }?>"><?php echo $_smarty_tpl->tpl_vars['CHECKINGCRITICALAREASDATA']->value['vtiger_eventhandlers'];?>
</font>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['CHECKINGCRITICALAREASDATA']->value['com_vtiger_workflow_tasktypes'] != '') {?>
        <br>- com_vtiger_workflow_tasktypes: <font color="<?php if ($_smarty_tpl->tpl_vars['CHECKINGCRITICALAREASDATA']->value['com_vtiger_workflow_tasktypes'] == 'OK') {?>green<?php } else { ?>red<?php }?>"><?php echo $_smarty_tpl->tpl_vars['CHECKINGCRITICALAREASDATA']->value['com_vtiger_workflow_tasktypes'];?>
</font>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['CHECKINGCRITICALAREASDATA']->value['vtiger_relatedlists'] != '') {?>
        <br>- vtiger_relatedlists: <font color="<?php if ($_smarty_tpl->tpl_vars['CHECKINGCRITICALAREASDATA']->value['vtiger_relatedlists'] == 'OK') {?>green<?php } else { ?>red<?php }?>"><?php echo $_smarty_tpl->tpl_vars['CHECKINGCRITICALAREASDATA']->value['vtiger_relatedlists'];?>
</font>
    <?php }
}?>
<br><br>

<span style="text-decoration: underline"><strong><?php echo vtranslate('Checking Permissions',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 ...</strong></span>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['CHECKINGPERMISSIONSDATA']->value, 'permissiondata');
$_smarty_tpl->tpl_vars['permissiondata']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['permissiondata']->value) {
$_smarty_tpl->tpl_vars['permissiondata']->do_else = false;
?>
    <br>- (<?php echo $_smarty_tpl->tpl_vars['permissiondata']->value['id'];?>
) <?php echo $_smarty_tpl->tpl_vars['permissiondata']->value['first_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['permissiondata']->value['last_name'];?>
: <font color="<?php if ($_smarty_tpl->tpl_vars['permissiondata']->value['health_status'] == 'OK') {?>green<?php } else { ?>red<?php }?>"><?php echo $_smarty_tpl->tpl_vars['permissiondata']->value['health_status'];?>
</font>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
<br><br>

<span style="text-decoration: underline"><strong><?php echo vtranslate('Checking Files',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 ...</strong></span>
<br>## <?php echo vtranslate('Files Missing',$_smarty_tpl->tpl_vars['MODULE']->value);?>

<span style="color:red">
    <?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['CHECKINGFILESDATA']->value['files_missing']) > 0) {?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['CHECKINGFILESDATA']->value['files_missing'], 'files_missing', false, 'KEY');
$_smarty_tpl->tpl_vars['files_missing']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['KEY']->value => $_smarty_tpl->tpl_vars['files_missing']->value) {
$_smarty_tpl->tpl_vars['files_missing']->do_else = false;
?>
            <br> <?php echo $_smarty_tpl->tpl_vars['KEY']->value;?>

        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php } else { ?>
    <br> <font color="green"><?php echo vtranslate('OK',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</font>
    <?php }?>
    </span>
<br>------------------------------------------------------------------------------------------
<br>## <?php echo vtranslate('Files Modified or Outdated (non .php)',$_smarty_tpl->tpl_vars['MODULE']->value);?>

<span style="color:#FF0066">
    <?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['CHECKINGFILESDATA']->value['files_difference']) > 0) {?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['CHECKINGFILESDATA']->value['files_difference'], 'files_difference', false, 'KEY');
$_smarty_tpl->tpl_vars['files_difference']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['KEY']->value => $_smarty_tpl->tpl_vars['files_difference']->value) {
$_smarty_tpl->tpl_vars['files_difference']->do_else = false;
?>
            <br> <?php echo $_smarty_tpl->tpl_vars['KEY']->value;?>

        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php } else { ?>
        <br> <font color="green"><?php echo vtranslate('OK',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</font>
    <?php }?>
</span>
<br>------------------------------------------------------------------------------------------
<br>## <?php echo vtranslate('Files and Folders Insufficient Permissions',$_smarty_tpl->tpl_vars['MODULE']->value);?>

<span style="color:#FF0066">
    <?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['CHECKINGFILESDATA']->value['files_insufficient_permissions']) > 0) {?>
        <br><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'implode' ][ 0 ], array( '<br>',$_smarty_tpl->tpl_vars['CHECKINGFILESDATA']->value['files_insufficient_permissions'] ));?>

            <?php } else { ?>
        <br> <font color="green"><?php echo vtranslate('OK',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</font>
    <?php }?>
</span>
<br><br><?php }
}
