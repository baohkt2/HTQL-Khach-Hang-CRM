{*/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouInstaller license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */*}
{strip}
    <div class="modal-dialog modal-lg changeLog">
        <div class='modal-content'>
            <div class="modal-header">
                <div class="clearfix">
                    <div class="pull-right " >
                        <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                            <span aria-hidden="true" class='fa fa-close'></span>
                        </button>
                    </div>
                    <h4 class="pull-left">
                        {vtranslate('LBL_CHANGELOG_INFORMATION', $QUALIFIED_MODULE)}
                    </h4>
                </div>
            </div>
            <div class="modal-body" id="changeLog">
                <h4>
                    <b>{$EXTENSION->getExtensionLabel()}&nbsp;
                        {if 'Upgrade' eq $MODULE_ACTION}
                            {$EXTENSION->getVersion()}&nbsp;{vtranslate('LBL_UPDATE_TO', $QUALIFIED_MODULE)}&nbsp;{$EXTENSION->getPackageVersion()}
                        {else}
                            {vtranslate('LBL_INSTALL_TO', $QUALIFIED_MODULE)}&nbsp;{$EXTENSION->getPackageVersion()}
                        {/if}
                    </b>
                </h4>
                <br>
                {if empty($MODULE_CHANGES)}
                    <div class="alert alert-warning">
                        {vtranslate('LBL_MISSING_CHANGELOG', $QUALIFIED_MODULE)}
                    </div>
                {else}
                    {foreach from=$MODULE_CHANGES item=MODULE_CHANGE}
                        <div>
                            <h4>{$MODULE_CHANGE['version']}</h4>
                            <hr>
                            <div style="white-space: pre-line;">{decode_html($MODULE_CHANGE['description'])}</div>
                            <br>
                        </div>
                    {/foreach}
                {/if}
            </div>
            <div class="modal-footer">
                <span class="extension_container">
                    {if $EXTENSION->isVtigerCompatible()}
                        <input type="hidden" name="extensionName" value="{$EXTENSION->get('name')}"/>
                        <input type="hidden" name="extensionUrl" value="{$EXTENSION->get('downloadURL')}"/>
                        <input type="hidden" name="extensionId" value="{$EXTENSION->get('id')}"/>
                        <input type="hidden" name="extensionType" value="{$EXTENSION_TYPE}"/>
                        <input type="hidden" name="moduleMode" value="oneClickInstall"/>

                        {if !$EXTENSION->isAlreadyExists()}
                            <input type="hidden" name="moduleAction" value="Install"/>
                            <button class="oneClickInstall btn btn-primary {if $IS_AUTH}authenticated {else} loginRequired{/if}">
                                {vtranslate('LBL_INSTALL', $QUALIFIED_MODULE)}
                            </button>
                        {elseif $EXTENSION->isUpgradable() or $EXTENSION->isUpgradableMulti()}
                            <input type="hidden" name="moduleAction" value="Upgrade"/>
                            <button class="oneClickInstall isUpdateBtn btn btn-success margin0px {if $IS_AUTH}authenticated {else} loginRequired{/if}">
                                {vtranslate('LBL_UPDATE', $QUALIFIED_MODULE)}
                            </button>
                        {/if}
                    {/if}
                </span>
            </div>
        </div>
    </div>
{/strip}