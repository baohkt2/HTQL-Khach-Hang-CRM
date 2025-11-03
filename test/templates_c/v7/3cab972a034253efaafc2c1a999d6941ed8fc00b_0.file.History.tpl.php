<?php
/* Smarty version 4.5.5, created on 2025-10-30 05:35:18
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Vtiger\dashboards\History.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_6902f9162baa48_48860591',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3cab972a034253efaafc2c1a999d6941ed8fc00b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Vtiger\\dashboards\\History.tpl',
      1 => 1761802269,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6902f9162baa48_48860591 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\vtigercrm\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
?>
<div class="dashboardWidgetHeader clearfix">
    <div class="title">
        <div class="dashboardTitle" title="<?php echo vtranslate($_smarty_tpl->tpl_vars['WIDGET']->value->getTitle(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
"><b>&nbsp;&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['WIDGET']->value->getTitle());?>
</b></div>
    </div>
    <div class="userList">
        <?php $_smarty_tpl->_assignInScope('CURRENT_USER_ID', $_smarty_tpl->tpl_vars['CURRENT_USER']->value->getId());?>
        <?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['ACCESSIBLE_USERS']->value) > 1) {?>
            <select class="select2 widgetFilter col-lg-3 reloadOnChange" name="type">
                <option value="all"  selected><?php echo vtranslate('All',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</option>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ACCESSIBLE_USERS']->value, 'USER_NAME', false, 'USER_ID');
$_smarty_tpl->tpl_vars['USER_NAME']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['USER_ID']->value => $_smarty_tpl->tpl_vars['USER_NAME']->value) {
$_smarty_tpl->tpl_vars['USER_NAME']->do_else = false;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['USER_ID']->value;?>
">
                    <?php if ($_smarty_tpl->tpl_vars['USER_ID']->value == $_smarty_tpl->tpl_vars['CURRENT_USER_ID']->value) {?> 
                        <?php echo vtranslate('LBL_MINE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>

                    <?php } else { ?>
                        <?php echo $_smarty_tpl->tpl_vars['USER_NAME']->value;?>

                    <?php }?>
                    </option>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </select>
            <?php } else { ?>
                <center><?php echo vtranslate('LBL_MY',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 <?php echo vtranslate('History',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</center>
        <?php }?>
    </div>
</div>
<div class="dashboardWidgetContent" style="padding-top:15px;">
	<?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "dashboards/HistoryContents.tpl",$_smarty_tpl->tpl_vars['MODULE_NAME']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</div>

<div class="widgeticons dashBoardWidgetFooter">
    <div class="filterContainer boxSizingBorderBox">
        <div class="row" style="margin-bottom: 10px;">
            <div class="col-sm-12">
                <div class="col-lg-4">
                    <span><strong><?php echo vtranslate('LBL_SHOW',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong></span>
                </div>
                <div class="col-lg-7">
                        <?php if ($_smarty_tpl->tpl_vars['COMMENTS_MODULE_MODEL']->value->isPermitted('DetailView')) {?>
                            <label class="radio-group cursorPointer">
                                <input type="radio" name="historyType" class="widgetFilter reloadOnChange cursorPointer" value="comments" /> <?php echo vtranslate('LBL_COMMENTS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>

                            </label><br>
                        <?php }?>
                        <label class="radio-group cursorPointer">
                            <input type="radio" name="historyType" class="widgetFilter reloadOnChange cursorPointer" value="updates" /> 
                            <span><?php echo vtranslate('LBL_UPDATES',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</span>
                        </label><br>
                        <label class="radio-group cursorPointer">
                            <input type="radio" name="historyType" class="widgetFilter reloadOnChange cursorPointer" value="all" checked="" /> <?php echo vtranslate('LBL_BOTH',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>

                        </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <span class="col-lg-4">
                        <span>
                            <strong><?php echo vtranslate('LBL_SELECT_DATE_RANGE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong>
                        </span>
                </span>
                <span class="col-lg-7">
                    <div class="input-daterange input-group dateRange widgetFilter" id="datepicker" name="modifiedtime">
                        <input type="text" class="input-sm form-control" name="start" style="height:30px;"/>
                        <span class="input-group-addon">to</span>
                        <input type="text" class="input-sm form-control" name="end" style="height:30px;"/>
                    </div>
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
