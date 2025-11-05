{*<!--
* 
* Copyright (C) www.vtiger.com. All rights reserved.
* @license Proprietary
*
-->*}
{strip}
    <script type="text/javascript" src="layouts/vlayout/modules/VTEStore/resources/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
    <script type="text/javascript" src="layouts/vlayout/modules/VTEStore/resources/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <link rel="stylesheet" type="text/css" href="layouts/vlayout/modules/VTEStore/resources/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
    <input type="hidden" name="searchmode" id="searchmode" value="{$SEARCHMODE}"/>
    <input type="hidden" name="search_key" id="search_key" value="{$SEARCH_KEY}"/>
    <div class="row-fluid">
        {if empty($STORECATS)}
            <table class="emptyRecordsDiv">
                <tbody>
                <tr>
                    <td>
                        {vtranslate('LBL_NO_EXTENSIONS_FOUND', 'VTEStore')}
                    </td>
                </tr>
                </tbody>
            </table>
        {else}
            {foreach item=STORECAT from=$STORECATS name=storecatgory}
                <div ><h2 style="margin-top: 60px; margin-bottom: 15px; font-size: 34px; font-weight: 900;"><u>{$STORECAT.store_category_name}</u></h2>{$STORECAT.store_category_desc}<br><br></div>
                <div class="clearfix"></div>
                <div class="row-fluid">
                {assign var=VTEMODULES value=$STORECAT.extensions}
                {foreach item=VTEMODULE from=$VTEMODULES name=extensions}
                    <div class="vtestore-module">
                        <div class="extension_container extensionWidgetContainer">
                            <input type="hidden" value="{$VTEMODULE->module_name}" name="extensionName">
                            <input type="hidden" value="{$VTEMODULE->id}" name="extensionId">
                            <input type="hidden" value="{if in_array($VTEMODULE->module_name,$VTMODULES)}Upgrade{else}Install{/if}" name="moduleAction">
                            <a href="index.php?module=VTEStore&parent=Settings&view=Settings&mode=getModuleDetail&extensionId={$VTEMODULE->id}&extensionName={$VTEMODULE->module_name}" class="module_wrapper">
                                {if $VTEMODULE->primary_image!=''}
                                    {assign var=imageSource value=$VTEMODULE->primary_image}
                                {else}
                                    {assign var=imageSource value='layouts/vlayout/modules/VTEStore/resources/images/unavailable.png'}
                                {/if}
                                <img class="module-image" src="{$imageSource}" />
                                <span class="hide">{$VTEMODULE->module_label}</span>
                            </a>
                            <div class="module_short_description" id="short_description_{$VTEMODULE->id}" style="">
                                {$VTEMODULE->preview_description|strip_tags}
                            </div>
                            <div class="all-function">
                                {assign var=previewImages value="||"|explode:$VTEMODULE->preview_image}
                                {assign var=FIRST_IMAGE value=''}
                                {foreach item=previewImage from=$previewImages}
                                    {if $previewImage}
                                        {assign var=FIRST_IMAGE value=$previewImage}
                                        {break}
                                    {/if}
                                {/foreach}
                                <a href="{$FIRST_IMAGE}" rel="group{$VTEMODULE->id}" id="Preview{$VTEMODULE->module_name}" class="vte-btn btn btn-default grouped_elements">
                                    <i class="icon-preview"></i>&nbsp;{vtranslate('LBL_PREVIEW', 'VTEStore')}
                                </a>
                                <div style="display: none">
                                    {foreach item=previewImage from=$previewImages}
                                        {if $previewImage@iteration > 1}
                                            <a class="grouped_elements" rel="group{$VTEMODULE->id}" href="{$previewImage}"></a>
                                        {/if}
                                    {/foreach}
                                </div>
                                <a id="VideoDemo{$VTEMODULE->module_name}" href="{$VTEMODULE->extvideolink}" class="vte-btn btn btn-default iframe">
                                    <i class="icon-video"></i>&nbsp;{vtranslate('LBL_VIDEO', 'VTEStore')}
                                </a>
                                <a href="javascript: void(0);" id="Preview{$VTEMODULE->module_name}" class="vte-btn btn btn-default btnMoreDetail">
                                    <i class="icon-detail"></i>&nbsp;{vtranslate('LBL_DETAILS', 'VTEStore')}
                                </a>
                                {if in_array($VTEMODULE->module_name,$VTMODULES)}
                                    <div class="vte-btn btn-group">
                                        <a href="javascript: void(0);" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                            {vtranslate('LBL_OPTIONS', 'VTEStore')}
                                            <span style="margin-left: 5px;" class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{$VTEMODULE->setting_url}" target="_blank" title="{vtranslate('Extension settings', 'VTEStore')}">{vtranslate('LBL_CONFIG', 'VTEStore')}</a></li>
                                            <div class="divider"></div>
                                            <!-- <li>
                                                <a href="javascript: void(0);" class="HealthCheck" data-url="index.php?module=VTEStore&parent=Settings&view=HealthCheck&extensionId={$VTEMODULE->id}&extensionName={$VTEMODULE->module_name}">{vtranslate('LBL_INTEGRITY_CHECK', 'VTEStore')}
                                                    <span class="btnTooltip" title="{vtranslate('LBL_TOOLTIP_INTEGRITY_CHECK', 'VTEStore')}">
                                                        <i class="icon-info"></i>
                                                    </span>
                                                </a>
                                            </li>
                                            <div class="divider"></div> -->
                                            <li class="oneclickInstallFree" data-message="{vtranslate('LBL_MESSAGE_INSTALLED_UPGRAGE_TO_STABLE', 'VTEStore')}" data-svn="stable"><a href="javascript: void(0);" id="UpgradeStable{$VTEMODULE->module_name}">{vtranslate('LBL_INSTALLED_UPGRAGE_TO_STABLE', 'VTEStore')}
                                                    <span class="btnTooltip" title="{vtranslate('LBL_TOOLTIP_UPGRAGE_TO_STABLE', 'VTEStore')}">
                                                        <i class="icon-info"></i>
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="oneclickInstallFree" data-message="{vtranslate('LBL_MESSAGE_INSTALLED_UPGRAGE_TO_LASTEST', 'VTEStore')}" data-svn="lastest"><a href="javascript: void(0);" id="UpgradeAlpha{$VTEMODULE->module_name}">{vtranslate('LBL_INSTALLED_UPGRAGE_TO_LASTEST_ONLIST', 'VTEStore')}
                                                    <span class="btnTooltip" title="{vtranslate('LBL_TOOLTIP_UPGRAGE_TO_LASTEST', 'VTEStore')}">
                                                        <i class="icon-info"></i>
                                                    </span>
                                                </a>
                                            </li>
                                            <div class="divider"></div>
                                            <li class="oneclickRegenerateLicense" data-message="{vtranslate('LBL_MESSAGE_REGENERATE_LICENSE', 'VTEStore')}"><a href="javascript: void(0);" id="RegenerateLicense{$VTEMODULE->module_name}">{vtranslate('LBL_REGENERATE_LICENSE', 'VTEStore')}
                                                    <span class="btnTooltip" title="{vtranslate('LBL_TOOLTIP_REGENERATE_LICENSE', 'VTEStore')}">
                                                        <i class="icon-info"></i>
                                                    </span>
                                                </a>
                                            </li>
                                            <div class="divider"></div>
                                            <li class="uninstallExtension" data-message="{vtranslate('LBL_UNINSTALL', 'VTEStore')}" data-svn="stable"><a href="javascript: void(0);" id="UNINSTALL{$VTEMODULE->module_name}">{vtranslate('LBL_UNINSTALL', 'VTEStore')}
                                                    <span class="btnTooltip" title="{vtranslate('LBL_TOOLTIP_UNINSTALL', 'VTEStore')}">
                                                        <i class="icon-info"></i>
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                {else}
                                    <a href="javascript: void(0);" id="Install{$VTEMODULE->module_name}" class="oneclickInstallFree btn btn-success vte-btn {if $CUSTOMERLOGINED>0}btn-success authenticated{else}loginRequired{/if}" data-svn="stable">{vtranslate('LBL_INSTALL', 'VTEStore')}</a>
                                {/if}
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                {/foreach}
                </div>
            {/foreach}
        {/if}
    </div>
{/strip}

{literal}
    <script>
        jQuery(document).ready(function() {
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
        });
    </script>
{/literal}