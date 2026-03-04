{*<!--
/* ********************************************************************************
* The content of this file is subject to the VTE_MODULE_LBL ("License");
* You may not use this file except in compliance with the License
* The Initial Developer of the Original Code is VTExperts.com
* Portions created by VTExperts.com. are Copyright(C) VTExperts.com.
* All Rights Reserved.
* ****************************************************************************** */
-->*}

<div class="container-fluid">
    <div class="widget_header row-fluid">
        <div class="span4"><a href="index.php?module=VTEStore&parent=Settings&view=Settings&reset=1"><h3>{vtranslate('MODULE_LBL', 'VTEStore')}</h3></a></div>

    </div>
    <hr>
    <div class="summaryWidgetContainer">
        <h3>Check System Information:</h3><br>

        <strong>Files permission:</strong>
        <br>Folder layouts/vlayout/modules: {if $MESSAGES.layouts_vlayout_modules==1}<font color="green">OK</font>{else}<font color="red">Have not write permission</font>{/if}
        {if $VTVERSION=='vt7'}<br>Folder layouts/v7/modules: {if $MESSAGES.layouts_v7_modules==1}<font color="green">OK</font>{else}<font color="red">Have not write permission</font>{/if}{/if}
        <br>Folder modules: {if $MESSAGES.modules==1}<font color="green">OK</font>{else}<font color="red">Have not write permission</font>{/if}
        <br>Folder user_privileges: {if $MESSAGES.user_privileges==1}<font color="green">OK</font>{else}<font color="red">Have not write permission</font>{/if}
        <br>Folder test: {if $MESSAGES.test==1}<font color="green">OK</font>{else}<font color="red">Have not write permission</font>{/if}
        <br>Folder {if $VTVERSION=='vt6'}test/templates_c/vlayout{else}test/templates_c/v7{/if}: {if $MESSAGES.test_templates_c_vlayout==1}<font color="green">OK</font>{else}<font color="red">Have not write permission</font>{/if}
        <br>Folder test/vtlib: {if $MESSAGES.test_vtlib==1}<font color="green">OK</font>{else}<font color="red">Have not write permission</font>{/if}
        <br>Folder storage: {if $MESSAGES.storage==1}<font color="green">OK</font>{else}<font color="red">Have not write permission</font>{/if}
        <br>File tabdata.php: {if $MESSAGES.tabdata==1}<font color="green">OK</font>{else}<font color="red">Have not write permission</font>{/if}
        <br>File config.inc.php: {if $MESSAGES.config==1}<font color="green">OK</font>{else}<font color="red">$root_directory missing '/' at the end</font>{/if}

        <strong><br><br>Users and Roles:</strong>
        <br>User Ids Invalid Ids: {if !empty($MESSAGES.user_ids_invalid)}<font color="red">{', '|implode:$MESSAGES.user_ids_invalid} </font>{else}<font color="green">0</font>{/if}
        <br>User Ids Invalid Role: {if !empty($MESSAGES.user_ids_invalid_role)}<font color="red">{', '|implode:$MESSAGES.user_ids_invalid_role} </font>{else}<font color="green">0</font>{/if}
        <br>User Ids Missing sharing_file: {if !empty($MESSAGES.user_ids_missing_sharing_file)}<font color="red">{', '|implode:$MESSAGES.user_ids_missing_sharing_file} </font>{else}<font color="green">0</font>{/if}
        <br>User Ids Missing privileges_file: {if !empty($MESSAGES.user_ids_missing_privileges_file)}<font color="red">{', '|implode:$MESSAGES.user_ids_missing_privileges_file} </font>{else}<font color="green">0</font>{/if}
    </div>
</div>