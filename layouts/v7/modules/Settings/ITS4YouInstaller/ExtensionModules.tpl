{*/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouInstaller license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */*}
{strip}
    {assign var=IS_AUTH value=($REGISTRATION_STATUS and $PASSWORD_STATUS)}
    <div class="col-lg-12">
        <br>
        <ul class="nav nav-tabs layoutTabs massEditTabs">
            <li class="tab-item taxesTab active"><a data-toggle="tab" href="#installedModules"><strong>{vtranslate('LBL_INSTALLED_AND_AVAILABLE_MODULES', $QUALIFIED_MODULE)}</strong></a></li>
            {if !$IS_HOSTING_LICENSE}
                <li class="tab-item chargesTab"><a data-toggle="tab" href="#modulesShop"><strong>{vtranslate('LBL_MODULES_SHOP', $QUALIFIED_MODULE)}</strong></a></li>
            {/if}
        </ul>
        <br>
    </div>
    <div class="tab-content layoutContent overflowVisible" style="height:100%">
        {include file="InstalledModules.tpl"|vtemplate_path:$QUALIFIED_MODULE}
        {if !$IS_HOSTING_LICENSE}
            {include file="ModulesShop.tpl"|vtemplate_path:$QUALIFIED_MODULE}
        {/if}
    </div>
{/strip}