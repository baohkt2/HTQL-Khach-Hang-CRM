{*<!--
/*+**********************************************************************************
 * Advanced Funnel Charts by SalesPlatform
 * Copyright (C) 2011-2016 SalesPlatform Ltd
 * All Rights Reserved.
 * This extension is licensed to be used within one instance of Vtiger CRM.
 * Source code or binaries may not be redistributed unless expressly permitted by SalesPlatform Ltd.
 * If you have any questions or comments, please email: extensions@salesplatform.ru
 ************************************************************************************/
-->*}
{strip}
    <div class="editContainer" style="padding-left: 2%;padding-right: 2%">
        <br>
        <h3>
            {if $MODEL->getId() eq '' || $IS_DUPLICATE}
                {vtranslate('LBL_CREATE_FUNNEL', $MODULE)}
            {else}
                {vtranslate('LBL_EDIT_FUNNEL', $MODULE)} : «{vtranslate($MODEL->getName(), $MODULE)}»
            {/if}
        </h3>
        <hr>
        <div class="clearfix"></div>
    </div>
{/strip}