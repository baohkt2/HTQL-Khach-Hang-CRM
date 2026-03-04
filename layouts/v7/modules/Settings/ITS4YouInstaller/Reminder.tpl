{*/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouInstaller license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */*}
{strip}
    <li class="its4you_installer_menu">
        <div class="dropdown pull-left">
            <div class="dropdown-toggle displayInlineBlock" data-toggle="dropdown" aria-expanded="true">
                <a href="#" class="{$MODULE}_menu_icon fa installer_icon">
                    <div class="its4you_installer_badge numberCircle hide"></div>
                </a>
            </div>
            <ul class="dropdown-menu its4you_installer_dropdown">
                <div id="its4you_installer_title">
                    <div class="its4you_installer_icon"></div>
                    <div class="its4you_installer_text"><b>{vtranslate($MODULE, $MODULE)} {vtranslate('LBL_ALERTS', $QUALIFIED_MODULE)}</b></div>
                </div>
                <hr>
                <div style="padding:5px 15px">
                    <div class="its4you_installer_alerts">
                        {foreach item=ALERT from=$ALERTS}
                            <div class="its4you_installer_alert clearfix {if $ALERT['status'] neq 1}installer_new_alert{/if}">
                                <div class="pull-left installer_alert_icon">
                                    <i class="fa fa-{$ALERT['icon']}"></i>
                                </div>
                                <div class="pull-left" style="max-width: 300px;">
                                    <div>
                                        <b>{vtranslate($ALERT['alert_type'], $QUALIFIED_MODULE)}</b>&nbsp;
                                        <a style="padding: 0" href="{if $ALERT['link'] neq ''}{$ALERT['link']}{else}#{/if}"><span>{$ALERT['message']}</span></a>
                                    </div>
                                    <div style="color: #888">
                                        {if !empty($ALERT['createdtime'])}<span>{Vtiger_Util_Helper::formatDateIntoStrings($ALERT['createdtime'])}</span>&nbsp;&nbsp;{/if}
                                    </div>
                                </div>
                            </div>
                        {/foreach}
                    </div>
                    <br>
                    <div style="text-align:center;">
                        <a style="padding: 5px 12px;" href="{$MODULE_MODEL->getDefaultUrl()}" class="btn btn-primary">{vtranslate('LBL_MANAGE_MODULES', $QUALIFIED_MODULE)}</a>
                    </div>
                </div>
            </ul>
        </div>
        <style>
            .{$MODULE}_menu_icon {
                height: 37px;
                vertical-align: top;
                display: inline-block;
                line-height: 15px;
            }
            .installer_icon:after {
                content: ' ';
                display: inline-block;
                height: 15px;
                width: 15px;
                background: no-repeat url('layouts/v7/modules/Settings/ITS4YouInstaller/images/ITS4YouIcon.png') center center / 15px 15px;
            }
            .its4you_installer_alerts {
                /*max-height: 500px;
                overflow: auto;*/
                width: 400px;
            }
            .its4you_installer_alert {
                padding: 0 0 10px 0;
            }
            #its4you_installer_title {
                display: block;
                position: relative;
                line-height: 50px;
                vertical-align: top;
                height: 50px;
                margin: 4px 10px;
                background: #EFEFEF;
            }
            .its4you_installer_text {
                line-height: 48px;
                display: inline-block;
                padding: 0 15px;
                font-size: 15px;
                margin: 0 0 0 50px;
            }
            .its4you_installer_icon {
                background: no-repeat url("layouts/v7/modules/Settings/ITS4YouInstaller/images/ITS4YouIcon50x50.png") center center / 50px 50px;
                color: #fff;
                text-align: center;
                vertical-align: middle;
                display: inline-block;
                line-height: 50px;
                width: 50px;
                height: 50px;
                position: absolute;
            }
            .installer_alert_icon .fa-warning{
                color: #ff0000;
            }
            .installer_alert_icon .fa-info-circle{
                color: #0088ff;
            }
            .installer_alert_icon .fa-refresh{
                color: #00aa00;
            }
            .installer_alert_icon .fa-question{
                color: #ffaa00;
            }
            .installer_alert_icon .fa-bell{
                color: #fd7e14;
            }
            .installer_alert_icon {
                width: 24px;
                height: 24px;
                margin: 12px 22px 12px 12px;
            }
            .installer_alert_icon .fa {
                font-size: 24px;
            }
            .its4you_installer_badge {
                position: absolute;
                right: 0;
                bottom: 0;
                border-radius: 10px;
                font: bold 10px Arial;
                padding: 3px 5px;
                background: #0088cc none repeat scroll 0 0;
                margin-bottom: 5px;
            }
        </style>
    </li>
{/strip}