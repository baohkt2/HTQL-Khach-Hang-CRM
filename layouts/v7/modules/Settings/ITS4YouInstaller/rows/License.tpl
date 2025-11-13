{*/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouInstaller license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */*}
<tr class="{$LICENSE->getParentClass()}">
    <td style="border-left:none;border-right:none;">
        <a class="licenseColors" href="#{if $LICENSE->get('service_usageunit') neq 'Package'}{$LICENSE->get('cf_identifier')}{/if}">
            {$LICENSE_KEY}
        </a>
    </td>
    <td style="border-left:none;border-right:none;">
        {$LICENSE->get('servicename')}
    </td>
    {if $LICENSE->isHostingLicense()}
        <td colspan="3" style="border-left:none;">
            {vtranslate('LBL_HOSTING_LICENSE', $QUALIFIED_MODULE)}
        </td>
    {else}
        <td style="border-left:none;border-right:none;">
            {if $LICENSE->get('due_date') neq ""}
                {Vtiger_Util_Helper::formatDateIntoStrings($LICENSE->get('due_date'))}
            {/if}
        </td>
        <td style="border-left:none;border-right:none;">
            {if $LICENSE->hasParentLicense()}
                {vtranslate('LBL_SUBLICENSE',$QUALIFIED_MODULE)}
            {elseif $LICENSE->get('subscription') eq "1"}
                {vtranslate('LBL_SUBSCRIPTION',$QUALIFIED_MODULE)}
            {elseif $LICENSE->get('demo_free') eq "1"}
                {vtranslate('LBL_DEMO_FREE',$QUALIFIED_MODULE)}
            {else}
                {vtranslate('LBL_FULL',$QUALIFIED_MODULE)}
            {/if}
        </td>
        {if $LICENSE->hasParentLicense()}
            <td style="border-left:none;border-right:none;"></td>
        {else}
            <td style="border-left:none;border-right:none;">
                {if $LICENSE->isRenewReady() and $EXTENSION_MODEL->isAllowedBuyLicense()}
                    {if $LICENSE->get('subscription') eq "1"}
                        <a class="btn btn-info" target="_blank" href="{$LICENSE->getRenewUrl()}">{vtranslate('LBL_PROLONG_LICENSE',$QUALIFIED_MODULE)}</a>
                    {elseif $LICENSE->get('demo_free') eq true}
                        <a class="btn btn-success" target="_blank" href="{$LICENSE->getConvertUrl()}">{vtranslate('LBL_BUY_LICENSE',$QUALIFIED_MODULE)}</a>
                    {else}
                        <a class="btn btn-primary" target="_blank" href="{$LICENSE->getRenewUrl()}">{vtranslate('LBL_RENEW_LICENSE',$QUALIFIED_MODULE)}</a>
                    {/if}
                    &nbsp;&nbsp;
                {/if}
                <button class="btn btn-danger actionLicenses" type="button" data-mode="deactivate" data-license="{$LICENSE_KEY}">{vtranslate('LBL_DEACTIVATE_LICENSES', $QUALIFIED_MODULE)}</button>
                <div class="pull-right">
                    {if $LICENSE->isExpired()}
                        <div class="alert alert-danger displayInlineBlock" style="margin:0;">{if $LICENSE->isTrial()}{vtranslate('LBL_TRIAL_INACTIVE', $QUALIFIED_MODULE)}{else}{vtranslate('LBL_MEMBERSHIP_INACTIVE', $QUALIFIED_MODULE)}{/if}{$LICENSE->getExpireString()}</div>
                    {else}
                        <div class="alert alert-{if $LICENSE->isRenewReady()}warning{else}info{/if} displayInlineBlock" style="margin:0;">{if $LICENSE->isTrial()}{vtranslate('LBL_TRIAL_ACTIVE', $QUALIFIED_MODULE)}{else}{vtranslate('LBL_MEMBERSHIP_ACTIVE', $QUALIFIED_MODULE)}{/if}{$LICENSE->getExpireString()}</div>
                    {/if}
                </div>
            </td>
        {/if}
    {/if}
</tr>