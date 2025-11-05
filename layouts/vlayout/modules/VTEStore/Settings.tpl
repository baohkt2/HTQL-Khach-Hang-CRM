{*<!--
/* ********************************************************************************
* The content of this file is subject to the VTE_MODULE_LBL ("License");
* You may not use this file except in compliance with the License
* The Initial Developer of the Original Code is VTExperts.com
* Portions created by VTExperts.com. are Copyright(C) VTExperts.com.
* All Rights Reserved.
* ****************************************************************************** */
-->*}
<link href="layouts/vlayout/modules/VTEStore/resources/ui-choose.css" rel="stylesheet" />
<script src="layouts/vlayout/modules/VTEStore/resources/ui-choose.js"></script>
<script src="layouts/vlayout/modules/VTEStore/resources/jquery.bxslider.min.js"></script>
<script type="text/javascript" src="layouts/vlayout/modules/VTEStore/resources/fancybox215/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="layouts/vlayout/modules/VTEStore/resources/fancybox215/jquery.fancybox.css?v=2.1.5" media="screen" />
<style>
    #MyAccountLink {
        margin-top: 5px;
    }
    .control-group{
        margin-bottom: 10px !important;
    }
</style>
<div class="container-fluid">
    <div class="widget_header row-fluid">
        {if $USE_CUSTOM_HEADER>0}
            <div class="span2"><a href="index.php?module=VTEStore&parent=Settings&view=Settings&reset=1"><h3>{vtranslate('MODULE_LBL_CUSTOM', 'VTEStore')}</h3></a></div>
            {include file='HeaderStoreCustom.tpl'|@vtemplate_path:'VTEStore'}
        {else}
            <div class="span2"><a href="index.php?module=VTEStore&parent=Settings&view=Settings&reset=1"><h3>{vtranslate('MODULE_LBL', 'VTEStore')}</h3></a></div>
            {include file='HeaderStore.tpl'|@vtemplate_path:'VTEStore'}
        {/if}
    </div>
    <hr>
    <div class="clearfix"></div>
    <div class="summaryWidgetContainer" id="VTEStore_settings">
        <div class="container-fluid" id="importModules">
            <div class="row-fluid">
                <table>
                    <tr>
                        <td>
                            <input type="text" id="searchExtension" class="span7 extensionSearch" placeholder="{vtranslate('LBL_SEARCH_FOR_AN_EXTENSION', 'VTEStore')}" style="height: 13px;width:550px;" value="{$SEARCH_KEY}"/>&nbsp;
                            <button id="btnSearchExtension" class="btn btn" style="height: 28px; margin-bottom: 7px">{vtranslate('LBL_SEARCH', 'VTEStore')}</button>
                            <span id="reset_search_value">{if $SEARCHMODE==1}{vtranslate('LBL_FILTER', 'VTEStore')}: {$SEARCH_FILTER} <u><a href="index.php?module=VTEStore&parent=Settings&view=Settings&reset=1">({vtranslate('LBL_CLICK_TO_RESET_THE_SEARCH', 'VTEStore')})</a></u>{/if}</span>
                            <input type="hidden" id="selectedCagetories" name="selectedCagetories">
                        </td>
                    </tr>
                    <tr style="display: none">
                        <td>
                            <h4 style="padding-bottom: 10px;">{vtranslate('LBL_SELECT_CATEGORY', 'VTEStore')}</h4>
                            <select class="ui-choose" multiple="multiple" id="extension_categories">
                                {foreach item=EXT_CAGETORIE from=$EXT_CAGETORIES name=cagetories}
                                    <option value="{$EXT_CAGETORIE->id}">{$EXT_CAGETORIE->name}</option>
                                {/foreach}
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                    </tr>
                </table>
                <br>
            </div>

            <div class="contents" id="extensionContainer">
                {include file='VTEModules.tpl'|@vtemplate_path:'VTEStore'}
            </div>

            <!-- My Account start-->
            <div class="modal MyAccount hide">
                {include file='MyAccount.tpl'|@vtemplate_path:'VTEStore'}
            </div>
            <!-- My Account end -->

            <!-- Login form  start-->
            <div class="modal loginAccount hide">
                {include file='Login.tpl'|@vtemplate_path:'VTEStore'}
            </div>
            <!-- Login form end -->

            <!-- Signup form  start-->
            <div class="modal signUpAccount hide">
                {include file='SignUp.tpl'|@vtemplate_path:'VTEStore'}
            </div>
            <!-- Signup form  end-->

            <!-- My Account start-->
            <div class="modal ManageSubscription hide">
                {include file='ManageSubscription.tpl'|@vtemplate_path:'VTEStore'}
            </div>
            <!-- My Account end -->
            <div class="clearfix"></div>
            <div class="pagination-right listActions" style="margin-top: -50px;">
                <button style="display: inline-block; margin-left: 18px; float: right;" id="UpgradeVTEStore" class="btn btn-success UpgradeVTEStore" data-message="{vtranslate('LBL_MESSAGE_UPGRAGE_VTE_STORE_TO_LASTEST', 'VTEStore')}"  data-svn="lastest">{vtranslate('LBL_UPGRADE_VTE_STORE', 'VTEStore')}</button>
                {if $EXTENSIONS_INSTALLED}
                    <div class="vte-btn btn-group">
                        <a href="javascript: void(0);" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            {vtranslate('LBL_OPTIONS_MASS', 'VTEStore')}
                            <span style="margin-left: 10px;" class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                        <!--
                            <li>
                                <a href="javascript: void(0);" class="HealthCheck" data-url="index.php?module=VTEStore&parent=Settings&view=HealthCheck&extensionId={$MODULE_DETAIL->id}&extensionName={$MODULE_DETAIL->module_name}">{vtranslate('LBL_INTEGRITY_CHECK_MASS', 'VTEStore')}
                                    <span class="btnTooltip" title="{vtranslate('LBL_TOOLTIP_INTEGRITY_CHECK_MASS', 'VTEStore')}">
                                        <i class="fa fa-info-circle"></i>
                                    </span>
                                </a>
                            </li>
                            <div class="divider"></div>
                            -->
                            <li class="upgradeAllExtensions" data-message="{vtranslate('LBL_MESSAGE_INSTALLED_UPGRAGE_ALL_TO_STABLE', 'VTEStore')}" data-svn="stable"><a href="javascript: void(0);" id="UpgradeStable{$MODULE_DETAIL->module_name}">{vtranslate('LBL_INSTALLED_UPGRAGE_TO_STABLE_MASS', 'VTEStore')}
                                    <span class="btnTooltip" title="{vtranslate('LBL_TOOLTIP_UPGRAGE_TO_STABLE_MASS', 'VTEStore')}">
                                        <i class="fa fa-info-circle"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="upgradeAllExtensions" data-message="{vtranslate('LBL_MESSAGE_INSTALLED_UPGRAGE_ALL_TO_LASTEST', 'VTEStore')}" data-svn="lastest"><a href="javascript: void(0);" id="UpgradeAlpha{$MODULE_DETAIL->module_name}">{vtranslate('LBL_INSTALLED_UPGRAGE_TO_LASTEST_ONLIST_MASS', 'VTEStore')}
                                    <span class="btnTooltip" title="{vtranslate('LBL_TOOLTIP_UPGRAGE_TO_LASTEST_MASS', 'VTEStore')}">
                                        <i class="fa fa-info-circle"></i>
                                    </span>
                                </a>
                            </li>
                            <div class="divider"></div>
                            <li class="regenerateLicenseAll" data-message="{vtranslate('LBL_MESSAGE_REGENERATE_LICENSE_ALL', 'VTEStore')}"><a href="javascript: void(0);" id="RegenerateLicense{$MODULE_DETAIL->module_name}">{vtranslate('LBL_REGENERATE_LICENSE_MASS', 'VTEStore')}
                                    <span class="btnTooltip" title="{vtranslate('LBL_TOOLTIP_REGENERATE_LICENSE_MASS', 'VTEStore')}">
                                        <i class="fa fa-info-circle"></i>
                                    </span>
                                </a>
                            </li>
                            <div class="divider"></div>
                            <li class="" data-message="{vtranslate('LBL_UNINSTALL_MASS', 'VTEStore')}" data-svn="stable"><a href="javascript: void(0);"  id="uninstallAllExtensions" class="{if $CUSTOMERLOGINED>0}authenticated{else}loginRequired{/if} uninstallAllExtensions">{vtranslate('LBL_UNINSTALL_ALL_EXTENSIONS', 'VTEStore')}
                                    <span class="btnTooltip" title="{vtranslate('LBL_TOOLTIP_UNINSTALL_MASS', 'VTEStore')}">
                                        <i class="fa fa-info-circle"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                {/if}
            </div>
        </div>
    </div>
</div>

{literal}
    <script>
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
    </script>
{/literal}
{if $GO_TO_EXTENSION_LIST==1}{literal}<script>openSiteInBackground('https://www.vtexperts.com/vtiger-premium-go-to-extension-list.html');</script>{/literal}{/if}
{if $MEMBERSHIP_ACTIVATED==1}{literal}<script>openSiteInBackground('https://www.vtexperts.com/vtiger-premium-membership-activated.html');</script>{/literal}{/if}