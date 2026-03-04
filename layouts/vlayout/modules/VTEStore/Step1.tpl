{*+***********************************************************************************
* The contents of this file are subject to the vtiger CRM Public License Version 1.0
* ("License"); You may not use this file except in compliance with the License
* The Original Code is:  vtiger CRM Open Source
* The Initial Developer of the Original Code is vtiger.
* Portions created by vtiger are Copyright (C) vtiger.
* All Rights Reserved.
*************************************************************************************}
{strip}
    {include file='InstallerHeader.tpl'|@vtemplate_path:'VTEStore'}
    <div class="workFlowContents" style="padding-left: 3%;padding-right: 3%">
            <div class="padding1per" style="border:1px solid #ccc;">
                <label>
                    <strong>{vtranslate('LBL_WELCOME',$QUALIFIED_MODULE)} {vtranslate('MODULE_LBL',$QUALIFIED_MODULE)} {vtranslate('LBL_INSTALLATION_WIZARD',$QUALIFIED_MODULE)}</strong>
                </label>
                <br>
                <div class="control-group">
                    <div><span>{vtranslate('LBL_THANK',$QUALIFIED_MODULE)} {vtranslate('MODULE_LBL',$QUALIFIED_MODULE)} {vtranslate('LBL_VTIGER_EXTENSION',$QUALIFIED_MODULE)}</span></div>
                </div>
                <div class="control-group">
                    <div><span>{vtranslate('LBL_PRODUCT_REQUIRES',$QUALIFIED_MODULE)} </span></div>
                    <div style="padding-left: 90px;padding-top: 10px;">
                        {if $SOAPENABLE eq '1'}
                            <img style="width: 26px; margin-left: -29px; margin-top: -5px; position: absolute;" src="layouts/vlayout/modules/{$QUALIFIED_MODULE}/resources/images/icon-ok.png" />
                        {else}
                            <img style="width: 18px; margin-left: -25px; margin-top: -2px; position: absolute;" src="layouts/vlayout/modules/{$QUALIFIED_MODULE}/resources/images/icon-remove.png" />
                        {/if}
                        <span style="font-weight: bold;color: {if $SOAPENABLE eq '1'}green{else}red{/if};">{vtranslate('LBL_PHPSOAP',$QUALIFIED_MODULE)} </span>
                        {if $SOAPENABLE neq '1'}&nbsp;&nbsp;(<a target="_blank" href="https://www.vtexperts.com/enable-php-soap/">{vtranslate('LBL_INSTALLATION_INSTRUCTIONS',$QUALIFIED_MODULE)}</a>){/if}
                    </div>
                    <div style="padding-left: 90px;padding-top: 10px;">
                        {if $IONCUBELOADED eq '1'}
                            <img style="width: 26px; margin-left: -29px; margin-top: -5px; position: absolute;" src="layouts/vlayout/modules/{$QUALIFIED_MODULE}/resources/images/icon-ok.png" />
                        {else}
                            <img style="width: 18px; margin-left: -25px; margin-top: -2px; position: absolute;" src="layouts/vlayout/modules/{$QUALIFIED_MODULE}/resources/images/icon-remove.png" />
                        {/if}
                        <span style="font-weight: bold;color: {if $IONCUBELOADED eq '1'}green{else}red{/if};">{vtranslate('LBL_IONCUDE',$QUALIFIED_MODULE)} </span>
                        {if $IONCUBELOADED neq '1'}&nbsp;&nbsp;
                            {if $IONCUBE_VERSION<5}
                                (<a target="_blank" href="https://www.vtexperts.com/install-ioncube-loader/">{vtranslate('Current Version is',$QUALIFIED_MODULE)} {$IONCUBE_VERSION_STR}. {vtranslate('LBL_IONCUBE_VERSION_INVALID',$QUALIFIED_MODULE)}</a>)
                            {else}
                                (<a target="_blank" href="https://www.vtexperts.com/install-ioncube-loader/">{vtranslate('LBL_INSTALLATION_INSTRUCTIONS',$QUALIFIED_MODULE)}</a>)
                            {/if}
                        {/if}
                    </div>
                </div>

                <div class="control-group">
                    <div><span>{vtranslate('LBL_BOTH_PHP_EXT',$QUALIFIED_MODULE)} - {vtranslate('LBL_YOU_WILL_NOT',$QUALIFIED_MODULE)} {vtranslate('MODULE_LBL',$QUALIFIED_MODULE)} {vtranslate('LBL_EXT_INSTALLATION',$QUALIFIED_MODULE)}</span></div>
                </div>

                <div class="control-group">
                    <div><span>{vtranslate('LBL_HAVE_TROUBLE',$QUALIFIED_MODULE)} {vtranslate('LBL_CONTACT_US',$QUALIFIED_MODULE)}</span></div>
                </div>
                <div class="control-group">
                    <ul style="padding-left: 10px;">
                        <li>{vtranslate('LBL_EMAIL',$QUALIFIED_MODULE)}: &nbsp;&nbsp;<a href="mailto:Support@VTExperts.com">Support@VTExperts.com</a></li>
                        <li>{vtranslate('LBL_PHONE',$QUALIFIED_MODULE)}: &nbsp;&nbsp;<span>+1 (818) 495-5557</span></li>
                        <li>{vtranslate('LBL_CHAT',$QUALIFIED_MODULE)}: &nbsp;&nbsp;{vtranslate('LBL_AVAILABLE_ON',$QUALIFIED_MODULE)} <a href="http://www.vtexperts.com" target="_blank">http://www.VTExperts.com</a></li>
                    </ul>
                </div>
            </div>
    </div>
    <div class="clearfix"></div>
</div>
{/strip}