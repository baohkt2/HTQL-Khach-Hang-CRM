<?php
/* Smarty version 4.5.5, created on 2025-10-30 05:35:13
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Leads\dashboards\LeadsByStatus.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_6902f911822419_00838986',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b6e924fd496e431a354cf83731082d0dba75bb44' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Leads\\dashboards\\LeadsByStatus.tpl',
      1 => 1761802268,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6902f911822419_00838986 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/javascript">
	Vtiger_Barchat_Widget_Js('Vtiger_LeadsByStatus_Widget_Js',{},{});
<?php echo '</script'; ?>
>


<div class="dashboardWidgetHeader">
	<?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "dashboards/WidgetHeader.tpl",$_smarty_tpl->tpl_vars['MODULE_NAME']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('SETTING_EXIST'=>true), 0, true);
?>
</div>
<div class="dashboardWidgetContent">
	<?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "dashboards/DashBoardWidgetContents.tpl",$_smarty_tpl->tpl_vars['MODULE_NAME']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</div>

<div class="widgeticons dashBoardWidgetFooter">
    <div class="filterContainer">
        <div class="row">
            <div class="col-sm-12">
                <span class="col-lg-4">
                        <span>
                            <strong><?php echo vtranslate('Created Time',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 &nbsp; <?php echo vtranslate('LBL_BETWEEN',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong>
                        </span>
                </span>
                <div class="col-lg-7">
                    <div class="input-daterange input-group dateRange widgetFilter" id="datepicker" name="createdtime">
                       <input type="text" class="input-sm form-control" name="start" style="height:30px;"/>
                       <span class="input-group-addon">to</span>
                       <input type="text" class="input-sm form-control" name="end" style="height:30px;"/>
                   </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12">
                <span class="col-lg-4">
                        <span>
                            <strong><?php echo vtranslate('Assigned To',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong>
                        </span>
                </span>
                <span class="col-lg-7">
                        <?php $_smarty_tpl->_assignInScope('CURRENT_USER_ID', $_smarty_tpl->tpl_vars['CURRENTUSER']->value->getId());?>
                        <select class="select2 col-sm-12 widgetFilter reloadOnChange" name="smownerid">
                            <option value="<?php echo $_smarty_tpl->tpl_vars['CURRENT_USER_ID']->value;?>
"><?php echo vtranslate('LBL_MINE');?>
</option>
                            <option value=""><?php echo vtranslate('LBL_ALL',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</option>
                            <?php $_smarty_tpl->_assignInScope('ALL_ACTIVEUSER_LIST', $_smarty_tpl->tpl_vars['CURRENTUSER']->value->getAccessibleUsers());?>
                            <?php if (php7_count($_smarty_tpl->tpl_vars['ALL_ACTIVEUSER_LIST']->value) > 1) {?>
                                <optgroup label="<?php echo vtranslate('LBL_USERS');?>
">
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ALL_ACTIVEUSER_LIST']->value, 'OWNER_NAME', false, 'OWNER_ID');
$_smarty_tpl->tpl_vars['OWNER_NAME']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['OWNER_ID']->value => $_smarty_tpl->tpl_vars['OWNER_NAME']->value) {
$_smarty_tpl->tpl_vars['OWNER_NAME']->do_else = false;
?>
                                        <?php if ($_smarty_tpl->tpl_vars['OWNER_ID']->value != $_smarty_tpl->tpl_vars['CURRENT_USER_ID']->value) {?>
                                            <option value="<?php echo $_smarty_tpl->tpl_vars['OWNER_ID']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['OWNER_NAME']->value;?>
</option>
                                        <?php }?>
                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                </optgroup>
                            <?php }?>
                            <?php $_smarty_tpl->_assignInScope('ALL_ACTIVEGROUP_LIST', $_smarty_tpl->tpl_vars['CURRENTUSER']->value->getAccessibleGroups());?>
                            <?php if (!empty($_smarty_tpl->tpl_vars['ALL_ACTIVEGROUP_LIST']->value)) {?>
                                <optgroup label="<?php echo vtranslate('LBL_GROUPS');?>
">
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ALL_ACTIVEGROUP_LIST']->value, 'OWNER_NAME', false, 'OWNER_ID');
$_smarty_tpl->tpl_vars['OWNER_NAME']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['OWNER_ID']->value => $_smarty_tpl->tpl_vars['OWNER_NAME']->value) {
$_smarty_tpl->tpl_vars['OWNER_NAME']->do_else = false;
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['OWNER_ID']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['OWNER_NAME']->value;?>
</option>
                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                </optgroup>
                            <?php }?>
                        </select>
                </span>
            </div>
        </div>
    </div>
    <div class="footerIcons pull-right">
        <?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "dashboards/DashboardFooterIcons.tpl",$_smarty_tpl->tpl_vars['MODULE_NAME']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('SETTING_EXIST'=>true), 0, true);
?>
    </div>
</div><?php }
}
