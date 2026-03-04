{*/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouInstaller license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */*}
{strip}
<div class="modal-dialog modal-lg installationLog">
    <div class='modal-content'>
        <div class="modal-header" style="background: #596875;color:white;">
            <div class="pull-right " >
                <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                    <span aria-hidden="true" class='fa fa-close'></span>
                </button>
            </div>
            <div class="row">
                <div class="col-lg-11 col-md-11">
                    {if $ERROR}
                        <input type="hidden" name="installationStatus" value="error" />
                        <h3 class="modal-title" style="color: red">
                            {if $MODULE_ACTION eq "Upgrade"}
                                {vtranslate('LBL_UPGRADE_FAILED', $QUALIFIED_MODULE)}
                            {else}
                                {vtranslate('LBL_INSTALLATION_FAILED', $QUALIFIED_MODULE)}
                            {/if}
                        </h3>
                    {else}
                        <input type="hidden" name="installationStatus" value="success" />
                        <h3 class="modal-title">
                            {if 'Upgrade' eq $MODULE_ACTION}
                                {vtranslate('LBL_UPGRADE_INFORMATION', $QUALIFIED_MODULE)}
                            {else}
                                {vtranslate('LBL_INSTALL_INFORMATION', $QUALIFIED_MODULE)}
                            {/if}
                        </h3>
                    {/if}
                </div>
            </div>
        </div>
        <div class="modal-body" id="installationLog">
            <h3>
                {if $MODULE_ACTION eq "Upgrade"}
                    {vtranslate('LBL_UPGRADE_LOG', $QUALIFIED_MODULE)}
                {else}
                    {vtranslate('LBL_INSTALLATION_LOG', $QUALIFIED_MODULE)}
                {/if}
            </h3>
            <div id="extensionInstallationInfo" class="backgroundImageNone" style="background-color: white;">
                {foreach from=$ERRORS item=ERROR}
                    <h4>{vtranslate($ERROR['EXTENSION'], $ERROR['EXTENSION'])}</h4>
                    <p style="color:red;">{vtranslate($ERROR['message'], $QUALIFIED_MODULE)}</p>
                {/foreach}
                {foreach from=$EXTENSIONS item=EXTENSION}
                    <h4>{vtranslate($EXTENSION->getName(), $EXTENSION->getName())}</h4>
                    {$EXTENSION->installExtension()}
                {/foreach}
            </div>
        </div>
        <div class="modal-footer">
            <span class="pull-right">
                <button class="btn btn-success" id="importCompleted" onclick="location.reload()">{vtranslate('LBL_OK', $QUALIFIED_MODULE)}</button>
            </span>
        </div>
    </div>
</div>
{/strip}