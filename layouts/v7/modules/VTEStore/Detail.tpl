{*<!--
* 
* Copyright (C) www.vtiger.com. All rights reserved.
* @license Proprietary
*
-->*}
{strip}
<script src="layouts/v7/modules/VTEStore/resources/jquery.bxslider.min.js"></script>
    <script type="text/javascript" src="layouts/v7/modules/VTEStore/resources/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="layouts/v7/modules/VTEStore/resources/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<link rel="stylesheet" type="text/css" href="libraries/bootstrap/css/jqueryBxslider.css" media="screen" />
<script type="text/javascript">
$(document).ready(function() {
    $('.fancybox').fancybox();
});
</script>
<style>
    .bx-wrapper .bx-controls-direction a {
        z-index: 100;
    }
    .control-group{
        margin-bottom: 10px !important;
    }
    .nav-tabs li.active, .nav-tabs li:hover{
        border: 1px solid #ddd;
        border-bottom: 0;
    }
    body{
        background:#eeeff2 !important;
    }
     p.UpgradeTooltip {
         text-align:left;
     }
</style>
<div class="container-fluid">
<div class="widget_header row-fluid">
    <table width="100%">
        <tr>
        <td><h3 style="margin: 0px 0px 10px 0px;"><a href="index.php?module=VTEStore&parent=Settings&view=Settings" class="btn btn-success">{vtranslate('LBL_BACK_TO_EXTENSION_LIST', 'VTEStore')}</a></h3></td>
        {if $USE_CUSTOM_HEADER>0}
            <td style="float: right">{include file='HeaderStoreCustom.tpl'|@vtemplate_path:'VTEStore'}</td>
        {else}
            <td style="float: right">{include file='HeaderStore.tpl'|@vtemplate_path:'VTEStore'}</td>
        {/if}
        </tr>
    </table>
</div>
<hr style="border-bottom: 1px solid #fff;">
<div class="container-fluid detailViewInfo extensionDetails" style='margin-top:0px;'>
    {*// Module Detail BEGIN*}
    {if $ERROR !='yes'}
        <div class="row-fluid contentHeader extension_container">
            <div class="col-lg-6">
                <div style="margin-bottom: 5px;">
                    <h4>{$MODULE_DETAIL->module_label}</h4>
                    <br><span>{$MODULE_DETAIL->brief}</span>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="pull-right extensionDetailActions">
                    <input type="hidden" name="mode" value="{$smarty.request.mode}" />
                    <input type="hidden" name="extensionId" value="{$MODULE_DETAIL->id}" />
                    <input type="hidden" name="extensionName" value="{$MODULE_DETAIL->module_name}" />
                    <input type="hidden" name="moduleAction" value="{if in_array($MODULE_DETAIL->module_name,$VTMODULES)}Upgrade{else}Install{/if}">
                    {if in_array($MODULE_DETAIL->module_name,$VTMODULES)}
                        <div class="vte-btn btn-group">
                            <a href="javascript: void(0);" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                {vtranslate('LBL_OPTIONS', $MODULE)}
                                <span style="margin-left: 10px;" class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{$MODULE_DETAIL->setting_url}" target="_blank" title="{vtranslate('Extension settings', $MODULE)}">{vtranslate('LBL_CONFIG', $MODULE)}</a></li>
                                <div class="divider"></div>
                                <li>
                                    <a href="javascript: void(0);" class="HealthCheck" data-url="index.php?module=VTEStore&parent=Settings&view=HealthCheck&extensionId={$MODULE_DETAIL->id}&extensionName={$MODULE_DETAIL->module_name}">{vtranslate('LBL_INTEGRITY_CHECK', $MODULE)}
                                        <span class="btnTooltip" title="{vtranslate('LBL_TOOLTIP_INTEGRITY_CHECK', $MODULE)}">
                                            <i class="fa fa-info-circle"></i>
                                        </span>
                                    </a>
                                </li>
                                <div class="divider"></div>
                                <li class="oneclickInstallFree" data-message="{vtranslate('LBL_MESSAGE_INSTALLED_UPGRAGE_TO_STABLE', $MODULE)}" data-svn="stable"><a href="javascript: void(0);" id="UpgradeStable{$MODULE_DETAIL->module_name}">{vtranslate('LBL_INSTALLED_UPGRAGE_TO_STABLE', $MODULE)}
                                        <span class="btnTooltip" title="{vtranslate('LBL_TOOLTIP_UPGRAGE_TO_STABLE', $MODULE)}">
                                            <i class="fa fa-info-circle"></i>
                                        </span>
                                    </a>
                                </li>
                                <li class="oneclickInstallFree" data-message="{vtranslate('LBL_MESSAGE_INSTALLED_UPGRAGE_TO_LASTEST', $MODULE)}" data-svn="lastest"><a href="javascript: void(0);" id="UpgradeAlpha{$MODULE_DETAIL->module_name}">{vtranslate('LBL_INSTALLED_UPGRAGE_TO_LASTEST_ONLIST', $MODULE)}
                                        <span class="btnTooltip" title="{vtranslate('LBL_TOOLTIP_UPGRAGE_TO_LASTEST', $MODULE)}">
                                            <i class="fa fa-info-circle"></i>
                                        </span>
                                    </a>
                                </li>
                                {if $SHOW_TRUNK_DEV eq 'true'}
                                <li class="oneclickInstallFree" data-message="{vtranslate('LBL_MESSAGE_INSTALLED_UPGRAGE_TO_DEV', $MODULE)}" data-svn="trunk_dev"><a href="javascript: void(0);" id="UpgradeAlpha{$MODULE_DETAIL->module_name}">{vtranslate('LBL_INSTALLED_UPGRAGE_TO_DEV_ONLIST', $MODULE)}
                                        <span class="btnTooltip" title="{vtranslate('LBL_TOOLTIP_UPGRAGE_TO_DEV', $MODULE)}">
                                            <i class="fa fa-info-circle"></i>
                                        </span>
                                    </a>
                                </li>
                                {/if}
                                <div class="divider"></div>
                                <li class="oneclickRegenerateLicense" data-message="{vtranslate('LBL_MESSAGE_REGENERATE_LICENSE', $MODULE)}"><a href="javascript: void(0);" id="RegenerateLicense{$MODULE_DETAIL->module_name}">{vtranslate('LBL_REGENERATE_LICENSE', $MODULE)}
                                        <span class="btnTooltip" title="{vtranslate('LBL_TOOLTIP_REGENERATE_LICENSE', $MODULE)}">
                                            <i class="fa fa-info-circle"></i>
                                        </span>
                                    </a>
                                </li>
                                <div class="divider"></div>
                                <li class="uninstallExtension" data-message="{vtranslate('LBL_UNINSTALL', $MODULE)}" data-svn="stable"><a href="javascript: void(0);" id="UNINSTALL{$MODULE_DETAIL->module_name}">{vtranslate('LBL_UNINSTALL', $MODULE)}
                                        <span class="btnTooltip" title="{vtranslate('LBL_TOOLTIP_UNINSTALL', $MODULE)}">
                                            <i class="fa fa-info-circle"></i>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    {else}
                        <button id="Install{$MODULE_DETAIL->module_name}" class="oneclickInstallFree btn btn-success {if $CUSTOMERLOGINED>0}btn-success authenticated{else}loginRequired{/if}" data-svn="stable">{vtranslate('LBL_INSTALL', $MODULE)}</button>
                    {/if}
                    
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="tabbable margin0px" style="padding-bottom: 20px;">
            <ul id="extensionTab" class="nav nav-tabs" style="margin-bottom: 0px; padding-bottom: 0px;">
                <li {if $CURRENT_TAB eq 'Overview'} class="active" {/if}><a href="#Overview" data-toggle="tab1" onclick="location.href='index.php?module=VTEStore&parent=Settings&view=Settings&mode=getModuleDetail&extensionId={$MODULE_DETAIL->id}&extensionName={$MODULE_DETAIL->module_name}'"><strong>{vtranslate('LBL_OVERVIEW', $MODULE)}</strong></a></li>
                <li {if $CURRENT_TAB eq 'Features'} class="active" {/if}><a href="#Features" data-toggle="tab"><strong>{vtranslate('LBL_FEATURES', $MODULE)}</strong></a></li>
                <li {if $CURRENT_TAB eq 'LiveDemo'} class="active" {/if}><a href="#LiveDemo" data-toggle="tab"><strong>{vtranslate('LBL_LIVE_DEMO', $MODULE)}</strong></a></li>
                <li {if $CURRENT_TAB eq 'Documentation'} class="active" {/if}><a href="#Documentation" data-toggle="tab"><strong>{vtranslate('LBL_DOCUMENTATION', $MODULE)}</strong></a></li>
            </ul>
            <div class="tab-content row-fluid boxSizingBorderBox" style="background-color: #fff; padding: 20px; border: 3px solid #eeeff2; border-top-width: 0px; margin-left: 1px;">
                <div class="tab-pane {if $CURRENT_TAB eq 'Overview'} active {/if}" id="Overview">
                    <div class="col-lg-4" style="text-align: justify;">
                        <span>{$MODULE_DETAIL->short_description}</span>
                        <br><br><a class="btn btn-warning various iframe" href="{$MODULE_DETAIL->extvideolink}"><span class="glyphicon glyphicon-eye-open"></span>{vtranslate('LBL_WATCH_A_DEMO', $MODULE)}</a>
                        <hr><span>{vtranslate('LBL_CATEGORY', $MODULE)}</span><br><span><strong>{$MODULE_DETAIL->category_name}</strong></span>
                    </div>
                    <div class="col-lg-8" style="padding-top: 0px; padding-right: 20px;">
                        {assign var=previewImages value="||"|explode:$MODULE_DETAIL->preview_image}
                        <ul class="bxslider">
                            {foreach item=previewImage from=$previewImages}
                                <li>
                                    <a class="fancybox" rel="example_group" title="" href="{$previewImage}" data-fancybox-group="gallery">
                                        <img src="{$previewImage}" style="width: 100%; height: auto;"/>
                                    </a>
                                </li>
                            {/foreach}
                        </ul>
                        <div id="bx-pager">
                            {foreach item=previewImage from=$previewImages key=k}
                                <a data-slide-index="{$k}" href=""><img src="{$previewImage}" style="width: 60px; height: 50px"/></a>&nbsp;
                            {/foreach}
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="tab-pane row-fluid {if $CURRENT_TAB eq 'Features'} active {/if}" id="Features">{$MODULE_DETAIL->features}</div>
                <div class="tab-pane row-fluid {if $CURRENT_TAB eq 'LiveDemo'} active {/if}" id="LiveDemo">{$MODULE_DETAIL->live_demo}</div>
                <div class="tab-pane row-fluid {if $CURRENT_TAB eq 'Documentation'} active {/if}" id="Documentation">{$MODULE_DETAIL->userguide_link}</div>
            </div>
        </div>
    {else}
        <div class="row-fluid" style="padding: 10px;"><h3>{$MESSAGE}</h3></div>
    {/if}
    {*// Module Detail END*}

    <!-- My Account start-->
    <div class="modal-dialog MyAccount hide">
        {include file='MyAccount.tpl'|@vtemplate_path:$MODULE}
    </div>
    <!-- My Account end -->

    <!-- Login form  start-->
    <div class="modal-dialog loginAccount hide">
        {include file='Login.tpl'|@vtemplate_path:$MODULE}
    </div>
    <!-- Login form end -->

    <!-- Signup form  start-->
    <div class="modal-dialog signUpAccount hide">
        {include file='SignUp.tpl'|@vtemplate_path:$MODULE}
    </div>
    <!-- Signup form  end-->

    <!-- My Account start-->
    <div class="modal-dialog ManageSubscription hide">
        {include file='ManageSubscription.tpl'|@vtemplate_path:$MODULE}
    </div>
    <!-- My Account end -->
    <!-- My FAQ start-->
    {*<div class="modal-dialog Faq hide">
        {include file='Faq.tpl'|@vtemplate_path:$MODULE}
    </div>*}
    <!-- My FAQ end -->
</div>
{/strip}
{literal}
<script>
    jQuery(document).ready(function() {
        $('.bxslider').bxSlider({
            pagerCustom: '#bx-pager',
            auto: true,
            autoControls: true
        });
        $('.bx-controls-auto').hide();

        //Watch video demo
        $(".various").fancybox({
            width    : 1280,
            height   : 720,
            fitToView   : false,
            autoSize    : false,
            closeClick  : false,
            openEffect  : 'elastic',
            closeEffect : 'none'
        });

        // Tooltip
        $("#UpgradeTooltip").tooltip({
            html: true,
            position: {
                my: "center bottom", // the "anchor point" in the tooltip element
                at: "center bottom" // the position of that anchor point relative to selected element
            }
        });
    });
</script>
{/literal}