{* *********************************************************************************
 * The content of this file is subject to the ITS4YouInstaller license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ******************************************************************************* *}
{strip}
    <div class="tab-pane col-lg-12" id="modulesShop">
        <div class="clearfix">
            <div class="grid-container-block-3">
            <div class="grid-container-3">
            {foreach item=PACKAGE from=$PACKAGES_LIST name=packages}
                {if $PACKAGE->get('inshop') neq "1"}{continue}{/if}
                <div class="grid-container-div-3">
                    <div class="thumbnail extension_container extensionWidgetContainer padding10">
                        <div class="contentHeader">
                            <div style="margin-bottom: 5px;">
                                <div class="extension_header">
                                    <div class="font-x-x-large boxSizingBorderBox" style="text-align: center;">{vtranslate($PACKAGE->get('label'), $QUALIFIED_MODULE)}</div>
                                </div>
                            </div>
                        </div>
                        {if $PACKAGE->get('thumbnailURLTop') neq NULL}
                            {assign var=imageSource value=$PACKAGE->get('thumbnailURLTop')}
                            <img src="{$imageSource}" class="thumbnailImage"/>
                        {/if}
                        {if $PACKAGE->get('description') neq ""}
                            <div class="caption">
                                <div class="font-x-x-large boxSizingBorderBox">
                                    <div style="text-align: center;"><strong>{$PACKAGE->get('description')}</strong></div>
                                </div>
                            </div>
                        {/if}
                        {if $PACKAGE->get('thumbnailURLCenterA') neq NULL}
                            {assign var=imageSource value=$PACKAGE->get('thumbnailURLCenterA')}
                            <img src="{$imageSource}" class="thumbnailImage"/>
                        {/if}
                        <div>
                            <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: center;">
                                <a href="{$SHOP_LINK}?q=true&addidtob={$PACKAGE->get('bid')}">
                                    <h2 class="summaryCount" style="padding:0px;margin:0px">{$PACKAGE->get('price')}{$PACKAGE->get('currency_symbol')}</h2>
                                </a>
                            </div>
                        </div>
                        <br>
                        {if $PACKAGE->get('thumbnailURLCenterB') neq NULL}
                            {assign var=imageSource value=$PACKAGE->get('thumbnailURLCenterB')}
                            <img src="{$imageSource}" class="thumbnailImage"/>
                        {/if}
                        <div class="caption">
                            <hr>
                            <div class="font-x-x-large boxSizingBorderBox">
                                {$PACKAGE->getMoreInfo()}
                            </div>
                            {if $PACKAGE->get('thumbnailURLBottom') neq NULL}
                                {assign var=imageSource value=$PACKAGE->get('thumbnailURLBottom')}
                                <div style="text-align: center;"><img src="{$imageSource}" class="thumbnailImage"/></div>
                            {/if}
                            <br>
                            <div class="row" style="padding: 10px 0 5px 0">
                                <div class="col-md-12" style="text-align: right;">
                                    <span>
                                        {if !$PACKAGE->isRegisteredUser()}
                                            <button class="m0550 btn btn-secondary logintoInstaller" type="button">{vtranslate('LBL_TRIAL', $QUALIFIED_MODULE)}</button>
                                        {elseif $PACKAGE->isTrialReady()}
                                            <button class="m0550 btn btn-warning trialButton" data-trial="{$PACKAGE->get('id')}">{vtranslate('LBL_TRIAL', $QUALIFIED_MODULE)}</button>
                                        {else}
                                            <button class="m0550 btn btn-warning" disabled type="button">{vtranslate('LBL_TRIAL', $QUALIFIED_MODULE)}</button>
                                        {/if}
                                        {if $PACKAGE->get('price') neq 'Free' AND $PACKAGE->get('price') neq 0 AND $PACKAGE->get('bid') neq ""}
                                            <button class="m0550 btn btn-success {*installExtension*} buyButton" data-url="{$SHOP_LINK}?q=true&addidtob={$PACKAGE->get('bid')}" data-trial=false>{vtranslate('LBL_BUY',$QUALIFIED_MODULE)}{$PACKAGE->get('price')}{$PACKAGE->get('currency_symbol')}</button>
                                        {/if}
                                        {if $PACKAGE->get('website') neq ""}
                                            <button class="m0550 btn installExtension addButton" style="margin-right:5px;" data-url="{$PACKAGE->get('website')}">{vtranslate('LBL_MORE_DETAILS', $QUALIFIED_MODULE)}</button>
                                        {/if}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div class="grid-container-div">
            {/foreach}
            </div>
            </div>
        </div>
        <div class="clearfix">
            <div class="grid-container-block">
            <div class="grid-container grid-columns-4">
            {foreach item=EXTENSION from=$EXTENSIONS_LIST name=extensions}
                {if !$EXTENSION->isVtigerCompatible() or $EXTENSION->get('inshop') neq '1'}{continue}{/if}
                <div class="grid-container-div">
                    <div class="thumbnail extension_container extensionWidgetContainer">
                        <div class="contentHeader" style="margin-bottom: 10px;">
                            <div class="col-sm-12 col-xs-12" style="margin-bottom: 5px;">
                                <div style="margin-bottom: 5px;">
                                    <div class="extension_header">
                                        <div class="font-x-x-large boxSizingBorderBox">{vtranslate($EXTENSION->get('label'), $QUALIFIED_MODULE)}</div>
                                        <input type="hidden" name="extensionName" value="{$EXTENSION->get('name')}" />
                                        <input type="hidden" name="extensionUrl" value="{$EXTENSION->get('downloadURL')}" />
                                        <input type="hidden" name="moduleAction" value="{if ($EXTENSION->isAlreadyExists())}{if $EXTENSION->isUpgradable()}Upgrade{else}Installed{/if}{else}Install{/if}" />
                                        <input type="hidden" name="extensionId" value="{$EXTENSION->get('id')}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        {if NULL neq $EXTENSION->get('thumbnailURL')}
                            {assign var=imageSource value=$EXTENSION->get('thumbnailURL')}
                            <img src="{$imageSource}" class="thumbnailImage"/>
                        {/if}
                        <div class="caption extensionDescription" >
                            <div class="font-x-x-large boxSizingBorderBox">
                                {if "" neq $EXTENSION->get('description')}
                                    {$EXTENSION->get('description')}
                                {/if}
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12" style="text-align: right">
                                    <span>
                                        {if $EXTENSION->isExtensionTrialReady()}
                                            <button class="m0550 btn btn-warning trialButton" data-trial="{$EXTENSION->get('id')}">{vtranslate('LBL_TRIAL', $QUALIFIED_MODULE)}</button>
                                        {/if}
                                        {if 'Free' neq $EXTENSION->get('price') or 0 neq $EXTENSION->get('price')}
                                            <button class="m0550 btn btn-success {*installExtension*} buyButton" data-url="{$SHOP_LINK}?addidtob={$EXTENSION->get('bid')}" data-trial=false>{vtranslate('LBL_BUY',$QUALIFIED_MODULE)}{$EXTENSION->get('currency_symbol')}{$EXTENSION->get('price')}</button>
                                        {/if}
                                        {if "" neq $EXTENSION->get('website')}
                                            <button class="m0550 btn installExtension addButton" style="margin-right:5px;" data-url="{$EXTENSION->get('website')}">{vtranslate('LBL_MORE_DETAILS', $QUALIFIED_MODULE)}</button>
                                        {/if}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {/foreach}
            </div>
            </div>
        </div>
    </div>
{/strip}