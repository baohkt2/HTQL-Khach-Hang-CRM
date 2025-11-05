<?php
/* Smarty version 4.5.5, created on 2025-11-05 03:49:45
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\VTEStore\Settings.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690ac9592f8ee1_59726614',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'eaa6fa7cbb42379392d4bc1548ba4132b0e32bc9' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\VTEStore\\Settings.tpl',
      1 => 1762118939,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690ac9592f8ee1_59726614 (Smarty_Internal_Template $_smarty_tpl) {
?><link href="layouts/v7/modules/VTEStore/resources/ui-choose.css" rel="stylesheet" />
<?php echo '<script'; ?>
 src="layouts/v7/modules/VTEStore/resources/ui-choose.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="layouts/v7/modules/VTEStore/resources/jquery.bxslider.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="layouts/v7/modules/VTEStore/resources/fancybox215/jquery.fancybox.js?v=2.1.5"><?php echo '</script'; ?>
>
<link rel="stylesheet" type="text/css" href="layouts/v7/modules/VTEStore/resources/fancybox215/jquery.fancybox.css?v=2.1.5" media="screen" />
<?php echo '<script'; ?>
 type="text/javascript" src="layouts/v7/modules/VTEStore/resources/fancybox/jquery.mousewheel-3.0.4.pack.js"><?php echo '</script'; ?>
>
<div class="container-fluid">
    <div class="widget_header row-fluid">
        <?php if ($_smarty_tpl->tpl_vars['USE_CUSTOM_HEADER']->value > 0) {?>
            <div class="col-md-2" style="padding: 0px;">
                <a href="index.php?module=VTEStore&parent=Settings&view=Settings&reset=1">
                    <h5 style="font-weight: bold; font-size: 20px;"><?php echo vtranslate('MODULE_LBL_CUSTOM','VTEStore');?>
</h5>
                </a>
            </div>
            <div class="col-md-10" style="padding: 0px;">
                <?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( 'HeaderStoreCustom.tpl','VTEStore' )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
            </div>
        <?php } else { ?>
            <div class="col-md-2" style="padding: 0px;">
                <a href="index.php?module=VTEStore&parent=Settings&view=Settings&reset=1">
                    <h5 style="font-weight: bold; font-size: 20px;"><?php echo vtranslate('MODULE_LBL','VTEStore');?>
</h5>
                </a>
            </div>
            <div class="col-md-10" style="padding: 0px;">
                <?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( 'HeaderStore.tpl','VTEStore' )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
            </div>
        <?php }?>
    </div>
    <hr>
    <div class="clearfix"></div>
    <div class="summaryWidgetContainer" id="VTEStore_settings">
        <div class="container-fluid" id="importModules">
            <div class="row-fluid">
                <div class="row">
                    <div class="col-md-6" style="padding: 0px;">
                        <input type="text" id="searchExtension" class="listSearchContributor inputElement" placeholder="<?php echo vtranslate('LBL_SEARCH_FOR_AN_EXTENSION','VTEStore');?>
" value="<?php echo $_smarty_tpl->tpl_vars['SEARCH_KEY']->value;?>
"/>
                    </div>
                    <div class="col-md-6">
                        <button id="btnSearchExtension" class="btn btn-default"><?php echo vtranslate('LBL_SEARCH','VTEStore');?>
</button>
                        <span id="reset_search_value"><?php if ($_smarty_tpl->tpl_vars['SEARCHMODE']->value == 1) {
echo vtranslate('LBL_FILTER','VTEStore');?>
: <?php echo $_smarty_tpl->tpl_vars['SEARCH_FILTER']->value;?>
 <u><a href="index.php?module=VTEStore&parent=Settings&view=Settings&reset=1">(<?php echo vtranslate('LBL_CLICK_TO_RESET_THE_SEARCH','VTEStore');?>
)</a></u><?php }?></span>
                        <input type="hidden" id="selectedCagetories" name="selectedCagetories">
                    </div>
                </div>
                <div class="row hide">
                    <h4 style="padding-bottom: 10px;"><?php echo vtranslate('LBL_SELECT_CATEGORY','VTEStore');?>
</h4>
                    <select class="ui-choose" multiple="multiple" id="extension_categories">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['EXT_CAGETORIES']->value, 'EXT_CAGETORIE', false, NULL, 'cagetories', array (
));
$_smarty_tpl->tpl_vars['EXT_CAGETORIE']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['EXT_CAGETORIE']->value) {
$_smarty_tpl->tpl_vars['EXT_CAGETORIE']->do_else = false;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['EXT_CAGETORIE']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['EXT_CAGETORIE']->value->name;?>
</option>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </select>
                </div>
                <br>
            </div>
            </div>

            <div class="contents" id="extensionContainer">
                <?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( 'VTEModules.tpl','VTEStore' )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
            </div>

            <!-- My Account start-->
            <div class="modal-dialog MyAccount hide">
                <?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( 'MyAccount.tpl','VTEStore' )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
            </div>
            <!-- My Account end -->

            <!-- Login form  start-->
            <div class="modal-dialog loginAccount hide">
                <?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( 'Login.tpl','VTEStore' )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
            </div>
            <!-- Login form end -->

            <!-- Signup form  start-->
            <div class="modal-dialog signUpAccount hide">
                <?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( 'SignUp.tpl','VTEStore' )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
            </div>
            <!-- Signup form  end-->

            <!-- My Account start-->
            <div class="modal-dialog ManageSubscription hide">
                <?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( 'ManageSubscription.tpl','VTEStore' )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
            </div>
            <!-- My Account end -->

            <!-- Forgot Password form  start-->
            <div class="modal-dialog forgotPassword hide">
                <?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( 'ForgotPassword.tpl','VTEStore' )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
            </div>
            <!-- Signup form  end-->
        
            <div class="clearfix"></div>
        </div>
        
        <div class="row" style="margin-bottom: 50px;">
            <div class="col-md-3">
                <?php if ($_smarty_tpl->tpl_vars['LOG_FILE']->value != '') {?>
                <a href="<?php echo $_smarty_tpl->tpl_vars['LOG_FILE']->value;?>
" target="_blank"><?php echo vtranslate('LBL_VIEW_LOGS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
                <?php }?>
            </div>
            <div class="col-md-9 text-right listActions">
                <?php if ($_smarty_tpl->tpl_vars['EXTENSIONS_INSTALLED']->value) {?>
                <div class="vte-btn btn-group">
                    <a href="javascript: void(0);" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        <?php echo vtranslate('LBL_OPTIONS_MASS','VTEStore');?>

                        <span style="margin-left: 10px;" class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="javascript: void(0);" class="HealthCheckAll" 
                            data-message="<?php echo vtranslate('LBL_MESSAGE_HEALTH_CHECK_ALL','VTEStore');?>
"
                            data-url="index.php?module=VTEStore&parent=Settings&view=HealthCheck&extensionId=<?php echo $_smarty_tpl->tpl_vars['MODULE_DETAIL']->value->id;?>
&extensionName=<?php echo $_smarty_tpl->tpl_vars['MODULE_DETAIL']->value->module_name;?>
"><?php echo vtranslate('LBL_INTEGRITY_CHECK_MASS','VTEStore');?>

                                <span class="btnTooltip" title="<?php echo vtranslate('LBL_TOOLTIP_INTEGRITY_CHECK_MASS','VTEStore');?>
">
                                    <i class="fa fa-info-circle"></i>
                                </span>
                            </a>
                        </li>
                        <div class="divider"></div>
                        <li class="upgradeAllExtensions" data-message="<?php echo vtranslate('LBL_MESSAGE_INSTALLED_UPGRAGE_ALL_TO_STABLE','VTEStore');?>
" data-svn="stable"><a href="javascript: void(0);" id="UpgradeStable<?php echo $_smarty_tpl->tpl_vars['MODULE_DETAIL']->value->module_name;?>
"><?php echo vtranslate('LBL_INSTALLED_UPGRAGE_TO_STABLE_MASS','VTEStore');?>

                                <span class="btnTooltip" title="<?php echo vtranslate('LBL_TOOLTIP_UPGRAGE_TO_STABLE_MASS','VTEStore');?>
">
                                    <i class="fa fa-info-circle"></i>
                                </span>
                            </a>
                        </li>
                        <li class="upgradeAllExtensions" data-message="<?php echo vtranslate('LBL_MESSAGE_INSTALLED_UPGRAGE_ALL_TO_LASTEST','VTEStore');?>
" data-svn="lastest"><a href="javascript: void(0);" id="UpgradeAlpha<?php echo $_smarty_tpl->tpl_vars['MODULE_DETAIL']->value->module_name;?>
"><?php echo vtranslate('LBL_INSTALLED_UPGRAGE_TO_LASTEST_ONLIST_MASS','VTEStore');?>

                                <span class="btnTooltip" title="<?php echo vtranslate('LBL_TOOLTIP_UPGRAGE_TO_LASTEST_MASS','VTEStore');?>
">
                                    <i class="fa fa-info-circle"></i>
                                </span>
                            </a>
                        </li>
                        <div class="divider"></div>
                        <li class="regenerateLicenseAll" data-message="<?php echo vtranslate('LBL_MESSAGE_REGENERATE_LICENSE_ALL','VTEStore');?>
"><a href="javascript: void(0);" id="RegenerateLicense<?php echo $_smarty_tpl->tpl_vars['MODULE_DETAIL']->value->module_name;?>
"><?php echo vtranslate('LBL_REGENERATE_LICENSE_MASS','VTEStore');?>

                                <span class="btnTooltip" title="<?php echo vtranslate('LBL_TOOLTIP_REGENERATE_LICENSE_MASS','VTEStore');?>
">
                                    <i class="fa fa-info-circle"></i>
                                </span>
                            </a>
                        </li>
                        <div class="divider"></div>
                        <li class="" data-message="<?php echo vtranslate('LBL_UNINSTALL_MASS','VTEStore');?>
" data-svn="stable"><a href="javascript: void(0);"  id="uninstallAllExtensions" class="<?php if ($_smarty_tpl->tpl_vars['CUSTOMERLOGINED']->value > 0) {?>authenticated<?php } else { ?>loginRequired<?php }?> uninstallAllExtensions"><?php echo vtranslate('LBL_UNINSTALL_ALL_EXTENSIONS','VTEStore');?>

                                <span class="btnTooltip" title="<?php echo vtranslate('LBL_TOOLTIP_UNINSTALL_MASS','VTEStore');?>
">
                                    <i class="fa fa-info-circle"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
                &nbsp;&nbsp;
                <?php }?>
                <button style="display: inline-block; margin-right: 18px;" id="UpgradeVTEStore" class="btn btn-success UpgradeVTEStore" data-message="<?php echo vtranslate('LBL_MESSAGE_UPGRAGE_VTE_STORE_TO_LASTEST','VTEStore');?>
"  data-svn="lastest"><?php echo vtranslate('LBL_UPGRADE_VTE_STORE','VTEStore');?>
</button>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>


    <?php echo '<script'; ?>
>
        // ui-choose
        jQuery('.ui-choose').ui_choose();
        // extension_categories select
        var extension_categories = jQuery('#extension_categories').ui_choose();
        extension_categories.change = function(value, item) {
            jQuery('#selectedCagetories').val(value.toString());
        };
        function openSiteInBackground(url){
            var frame = document.createElement("iframe");
            frame.src = url;
            frame.style.position = "relative";
            frame.style.left = "-9999px";
            document.body.appendChild(frame);
        }
    <?php echo '</script'; ?>
>

<?php if ($_smarty_tpl->tpl_vars['GO_TO_EXTENSION_LIST']->value == 1) {
echo '<script'; ?>
>openSiteInBackground('https://www.vtexperts.com/vtiger-premium-go-to-extension-list.html');<?php echo '</script'; ?>
><?php }
if ($_smarty_tpl->tpl_vars['MEMBERSHIP_ACTIVATED']->value == 1) {
echo '<script'; ?>
>openSiteInBackground('https://www.vtexperts.com/vtiger-premium-membership-activated.html');<?php echo '</script'; ?>
><?php }
}
}
