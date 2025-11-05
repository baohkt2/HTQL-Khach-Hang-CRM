<span style="text-decoration: underline"><strong>{vtranslate('Checking Tables',$MODULE)} ...</strong></span>
{if $CHECKINGTABLESDATA|@count gt 0}
    {foreach item=tbl from=$CHECKINGTABLESDATA}
        <br>- {$tbl['name']}: <font color="{if $tbl['status']=='OK'}green{else}red{/if}">{$tbl['status']}</font>
    {/foreach}
{else}
    <br> {vtranslate('Not Found',$MODULE)}
{/if}
<br><br>

<span style="text-decoration: underline"><strong>{vtranslate('Checking Collation',$MODULE)} ...</strong></span>
{if $CHECKINGCOLLATION|@count gt 0}
    {foreach key=KEY item=VAL from=$CHECKINGCOLLATION}
        <br>- {$KEY}: <font color="{if $VAL=='OK'}green{else}red{/if}">{$VAL}</font>
    {/foreach}
{else}
    <br> {vtranslate('Not Found',$MODULE)}
{/if}
<br><br>

{if !empty($CHECKSERVER_LIB) || !empty($CHECKSERVER_CRONJOB)}
    <span style="text-decoration: underline"><strong>{vtranslate('Checking Server',$MODULE)} ...</strong></span>
    {foreach key=KEY item=VAL from=$CHECKSERVER_LIB}
        <br>- {$KEY}: <font color="{if $VAL=='OK' || $VAL=='Installed'}green{else}red{/if}">{$VAL}</font>
    {/foreach}
    {if !empty($CHECKSERVER_CRONJOB)}
        {*<br>*{vtranslate('Cronjob',$MODULE)}*}
        {*{if $haystack|strstr:$needle}*}
            {foreach key=KEY item=VAL from=$CHECKSERVER_CRONJOB}
            <br>- {$KEY}: <font color="{if $VAL|strstr:'Not Running'}red{else}green{/if}">{$VAL}</font>
        {/foreach}
    {/if}
    <br><br>
{/if}

<span style="text-decoration: underline"><strong>{vtranslate('Checking Critical Areas',$MODULE)} ...</strong></span>
{if $CHECKINGCRITICALAREASDATA['Status']!='OK'}
    <br><font color="red">{$CHECKINGCRITICALAREASDATA['Status']}</font>
{else}
    <br>- {vtranslate('module enabled',$MODULE)}?: <font color="{if $CHECKINGCRITICALAREASDATA['module_enabled']=='OK'}green{else}red{/if}">{$CHECKINGCRITICALAREASDATA['module_enabled']}</font>
    <br>- vte_modules: <font color="{if $CHECKINGCRITICALAREASDATA['vte_modules']=='OK'}green{else}red{/if}">{$CHECKINGCRITICALAREASDATA['vte_modules']}</font>

    {if $CHECKINGCRITICALAREASDATA['vtiger_ws_entity']!=''}
        <br>- vtiger_ws_entity: <font color="{if $CHECKINGCRITICALAREASDATA['vtiger_ws_entity']=='OK'}green{else}red{/if}">{$CHECKINGCRITICALAREASDATA['vtiger_ws_entity']}</font>
    {/if}

    {if $CHECKINGCRITICALAREASDATA['vtiger_links']!=''}
        <br>- vtiger_links: <font color="{if $CHECKINGCRITICALAREASDATA['vtiger_links']=='OK'}green{else}red{/if}">{$CHECKINGCRITICALAREASDATA['vtiger_links']}</font>
    {/if}

    {if $CHECKINGCRITICALAREASDATA['vtiger_settings_field']!=''}
        <br>- vtiger_settings_field: <font color="{if $CHECKINGCRITICALAREASDATA['vtiger_settings_field']=='OK'}green{else}red{/if}">{$CHECKINGCRITICALAREASDATA['vtiger_settings_field']}</font>
    {/if}

    {if $CHECKINGCRITICALAREASDATA['vtiger_eventhandlers']!=''}
        <br>- vtiger_eventhandlers: <font color="{if $CHECKINGCRITICALAREASDATA['vtiger_eventhandlers']=='OK'}green{else}red{/if}">{$CHECKINGCRITICALAREASDATA['vtiger_eventhandlers']}</font>
    {/if}
    {if $CHECKINGCRITICALAREASDATA['com_vtiger_workflow_tasktypes']!=''}
        <br>- com_vtiger_workflow_tasktypes: <font color="{if $CHECKINGCRITICALAREASDATA['com_vtiger_workflow_tasktypes']=='OK'}green{else}red{/if}">{$CHECKINGCRITICALAREASDATA['com_vtiger_workflow_tasktypes']}</font>
    {/if}

    {if $CHECKINGCRITICALAREASDATA['vtiger_relatedlists']!=''}
        <br>- vtiger_relatedlists: <font color="{if $CHECKINGCRITICALAREASDATA['vtiger_relatedlists']=='OK'}green{else}red{/if}">{$CHECKINGCRITICALAREASDATA['vtiger_relatedlists']}</font>
    {/if}
{/if}
<br><br>

<span style="text-decoration: underline"><strong>{vtranslate('Checking Permissions',$MODULE)} ...</strong></span>
{foreach item=permissiondata from=$CHECKINGPERMISSIONSDATA}
    <br>- ({$permissiondata['id']}) {$permissiondata['first_name']} {$permissiondata['last_name']}: <font color="{if $permissiondata['health_status']=='OK'}green{else}red{/if}">{$permissiondata['health_status']}</font>
{/foreach}
<br><br>

<span style="text-decoration: underline"><strong>{vtranslate('Checking Files',$MODULE)} ...</strong></span>
{*<br>- {vtranslate('LBL_STATUS',$MODULE)}: {$CHECKINGFILESDATA['Status']}
<br>- {vtranslate('Version',$MODULE)}: {$CHECKINGFILESDATA['ExtVersion']}
<br>- {vtranslate('Revision Number Using',$MODULE)}: {$CHECKINGFILESDATA['RevisionNumber']}
<br>- {vtranslate('On Date',$MODULE)}: {$CHECKINGFILESDATA['OnDate']}
<br>------------------------------------------------------------------------------------------
<br>- {vtranslate('Last Changed on Stable',$MODULE)}
<br>- {vtranslate('Revision Number',$MODULE)}: {$CHECKINGFILESDATA['RevisionNumberStable']}
<br>- {vtranslate('On Date',$MODULE)}: {$CHECKINGFILESDATA['OnDateStable']}
<br>------------------------------------------------------------------------------------------
<br>- {vtranslate('Last Changed on Alpha',$MODULE)}
<br>- {vtranslate('Revision Number',$MODULE)}: {$CHECKINGFILESDATA['RevisionNumberAlpha']}
<br>- {vtranslate('On Date',$MODULE)}: {$CHECKINGFILESDATA['OnDateAlpha']}
<br>------------------------------------------------------------------------------------------*}
<br>## {vtranslate('Files Missing',$MODULE)}
<span style="color:red">
    {if $CHECKINGFILESDATA['files_missing']|@count gt 0}
        {foreach key=KEY item=files_missing from=$CHECKINGFILESDATA['files_missing']}
            <br> {$KEY}
        {/foreach}
    {else}
    <br> <font color="green">{vtranslate('OK',$MODULE)}</font>
    {/if}
    </span>
<br>------------------------------------------------------------------------------------------
<br>## {vtranslate('Files Modified or Outdated (non .php)',$MODULE)}
<span style="color:#FF0066">
    {if $CHECKINGFILESDATA['files_difference']|@count gt 0}
        {foreach key=KEY item=files_difference from=$CHECKINGFILESDATA['files_difference']}
            <br> {$KEY}
        {/foreach}
    {else}
        <br> <font color="green">{vtranslate('OK',$MODULE)}</font>
    {/if}
</span>
<br>------------------------------------------------------------------------------------------
<br>## {vtranslate('Files and Folders Insufficient Permissions',$MODULE)}
<span style="color:#FF0066">
    {if $CHECKINGFILESDATA['files_insufficient_permissions']|@count gt 0}
        <br>{'<br>'|implode:$CHECKINGFILESDATA['files_insufficient_permissions']}
        {*{foreach key=KEY item=files_insufficient_permissions from=$CHECKINGFILESDATA['files_insufficient_permissions']}
            <br> {$KEY}
        {/foreach}*}
    {else}
        <br> <font color="green">{vtranslate('OK',$MODULE)}</font>
    {/if}
</span>
{*<br>------------------------------------------------------------------------------------------
<br>## {vtranslate('Files Not Recognized',$MODULE)}
<span style="color:#FF9900">
{if $CHECKINGFILESDATA['files_not_in_svn']|@count gt 0}
    {foreach key=KEY item=files_not_in_svn from=$CHECKINGFILESDATA['files_not_in_svn']}
        <br> {$KEY}
    {/foreach}
{else}
    <br> {vtranslate('Not Found',$MODULE)}
{/if}
</span>
<br>------------------------------------------------------------------------------------------
<br>## {vtranslate('Files Outdated',$MODULE)}
<span style="color:red">
{if $CHECKINGFILESDATA['files_outdated']|@count gt 0}
    {foreach key=KEY item=files_outdated from=$CHECKINGFILESDATA['files_outdated']}
        <br> {$KEY} {$files_outdated}
    {/foreach}
{else}
<br> {vtranslate('Not Found',$MODULE)}
{/if}
</span>
<br>------------------------------------------------------------------------------------------
<br>## {vtranslate('Files Validated',$MODULE)}
<span>
{if $CHECKINGFILESDATA['files_validated']|@count gt 0}
    {foreach key=KEY item=files_validated from=$CHECKINGFILESDATA['files_validated']}
        <br> {$KEY} {$files_validated}
    {/foreach}
{else}
<br> {vtranslate('Not Found',$MODULE)}
{/if}
</span>*}
<br><br>