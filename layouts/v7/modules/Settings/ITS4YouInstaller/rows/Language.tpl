{*/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouInstaller license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */*}
{if $LANGUAGE->isVtigerCompatible() && !$LANGUAGE->isAlreadyExists() && ($LANGUAGE->get('price') eq 'Free' or $LANGUAGE->get('price') eq 0 or $LANGUAGE->get('available') eq 1)}
    <tr class="" data-cfmid="1">
        <td style="border-left:none;border-right:none;">{vtranslate($LANGUAGE->get('label'), $QUALIFIED_MODULE)}</td>
        <td colspan="2" style="border-left:none;border-right:none;">{vtranslate($LANGUAGE->get('description'), $QUALIFIED_MODULE)}</td>
        <td style="border-left:none;border-right:none;">
            <span class="extension_container">
                <input type="hidden" name="extensionName" value="{$LANGUAGE->get('name')}"/>
                <input type="hidden" name="extensionUrl" value="{$LANGUAGE->get('downloadURL')}"/>
                <input type="hidden" name="extensionId" value="{$LANGUAGE->get('id')}"/>
                <input type="hidden" name="moduleMode" value="oneClickInstall"/>
                <span class="pull-left">
                    {if $LANGUAGE->get('website') neq ""}
                        <button class="btn installExtension addButton" style="margin-right:5px;" data-url="{$LANGUAGE->get('website')}">{vtranslate('LBL_MORE_DETAILS', $QUALIFIED_MODULE)}</button>
                    {/if}
                    {assign var=LANG_KEY value=$LANGUAGE->get('name')}

                    {if $ALL_LANGUAGES[$LANG_KEY] neq ""}
                        {if $LANGUAGE->isUpgradableLanguage()}
                            <input type="hidden" name="moduleAction" value="Update"/>
                            <input type="hidden" name="moduleMessage" value="{$EXTENSION->getUpdateMessage()}"/>
                            <button class="oneClickInstall isUpdateBtn btn btn-success {if $IS_AUTH}authenticated {else} loginRequired{/if}">{vtranslate('LBL_UPDATE', $QUALIFIED_MODULE)}</button>
                        {/if}
                    {else}
                        <input type="hidden" name="moduleAction" value="Install"/>
                        <button class="oneClickInstall btn btn-primary {if $IS_AUTH}authenticated {else} loginRequired{/if}">{vtranslate('LBL_INSTALL', $QUALIFIED_MODULE)}</button>
                    {/if}
                </span>
            </span>
        </td>
    </tr>
{/if}