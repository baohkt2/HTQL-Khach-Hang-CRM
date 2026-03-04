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
        <div class="span4">
            <a href="index.php?module=VTEStore&parent=Settings&view=Settings&reset=1"><h3>Back to {vtranslate('MODULE_LBL', 'VTEStore')}</h3></a>
            <a href="index.php?module=VTEStore&parent=Settings&view=DebugCurl" class="btn btn-success">Check again</a>
        </div>

    </div>
    <hr>
    <div class="summaryWidgetContainer">
        {if $CURL_ERROR !='OK'}
            <h4>Check CURL: <span style="color: red">FAIL</span></h4><br>
            <br><strong>CURL_ERROR:</strong> {$CURL_ERROR}
            <br><strong>CURL_INFO:</strong> <pre>{print_r($CURL_INFO,1)}</pre>
            <br><strong>CURL_RESPONSE:</strong> {$CURL_RESPONSE}
        {else}
            <h4>Check CURL: <span style="color: green">OK</span></h4><br>
        {/if}
        {if $opensslStatus !='OK'}
            <h4>Check OpenSSL: <span style="color: red">FAIL</span></h4><br>
        {else}
            <h4>Check OpenSSL: <span style="color: green">OK</span></h4><br>
        {/if}
    </div>
</div>