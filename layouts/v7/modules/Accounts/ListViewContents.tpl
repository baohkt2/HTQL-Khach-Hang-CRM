{*+**********************************************************************************
* The contents of this file are subject to the vtiger CRM Public License Version 1.1
* ("License"); You may not use this file except in compliance with the License
* The Original Code is: vtiger CRM Open Source
* The Initial Developer of the Original Code is vtiger.
* Portions created by vtiger are Copyright (C) vtiger.
* All Rights Reserved.
************************************************************************************}
{* modules/Accounts/views/List.php *}

{* Custom template for Accounts to show contacts count *}

<style>
.contacts-count-text {
    color: #999;
    font-weight: normal;
    margin-left: 3px;
}
</style>

{* Store contacts count for JavaScript *}
<script type="text/javascript">
    var accountsContactsCount = {ldelim}
    {foreach item=LISTVIEW_ENTRY from=$LISTVIEW_ENTRIES}
        {assign var=ACCOUNT_ID value=$LISTVIEW_ENTRY->getId()}
        {assign var=CONTACTS_COUNT value=$LISTVIEW_ENTRY->get('contacts_count')}
        '{$ACCOUNT_ID}': {if $CONTACTS_COUNT}{$CONTACTS_COUNT}{else}0{/if}{if !$LISTVIEW_ENTRY@last},{/if}
    {/foreach}
    {rdelim};
</script>

{* Include the parent template *}
{include file=vtemplate_path('ListViewContents.tpl', 'Vtiger')}
