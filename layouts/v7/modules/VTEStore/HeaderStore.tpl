{*<!--
/* ********************************************************************************
* The content of this file is subject to the VTE_MODULE_LBL ("License");
* You may not use this file except in compliance with the License
* The Initial Developer of the Original Code is VTExperts.com
* Portions created by VTExperts.com. are Copyright(C) VTExperts.com.
* All Rights Reserved.
* ****************************************************************************** */
-->*}

<table style="float: right;">
    <tr>
        {if $CUSTOMERLOGINED>0}
            <td style="padding-left: 5px;">
                <input type="hidden" id="customer_status" name="customer_status" value="{$CUSTOMER_STATUS}">
                <input type="hidden" id="customer_data" name="customer_data" value="{$CUSTOMER_DATA}">
                <input type="hidden" id="getChargifyInfo" name="getChargifyInfo" value="">
                {if $CUSTOMER_STATUS=='trial_expired'}
                    <a href="javascript:void(0)" class="ManageSubscription"><font color="red"><strong>{vtranslate('TRIAL_EXPIRED', 'VTEStore')}</strong></font></a>
                {elseif $CUSTOMER_STATUS=='no_subscription'}
                    <a href="javascript:void(0)" class="ManageSubscription"><font color="red"><strong>{vtranslate('NO_SUBSCRIPTION', 'VTEStore')} {$CUSTOMERDATA['remain_date']} {vtranslate('days', 'VTEStore')}. {vtranslate('Please click here to sign up', 'VTEStore')}</strong></font> </a>
                {elseif $CUSTOMER_STATUS=='subscription_expired'}
                    <a href="javascript:void(0)" class="ManageSubscription"><font color="red"><strong>{vtranslate('SUBSCRIPTION_EXPIRED', 'VTEStore')}</strong></font></a>
                {/if}
            </td>
        {/if}
        <td style="padding-left: 5px;">
            <a href="javascript:void(0);" onclick="window.open('https://v2.zopim.com/widget/livechat.html?&key=1P1qFzYLykyIVMZJPNrXdyBilLpj662a=en', '_blank', 'location=yes,height=600,width=500,scrollbars=yes,status=yes');"> <img src="layouts/v7/modules/VTEStore/resources/images/livechat.png"/></a>
        </td>

        {if $WARNINGS>0 && $ERROR_NUM==0}
            <td style="padding-left: 5px;"><button id="phpiniWarnings" name="phpiniWarnings" class="btn btn-danger" style="margin-right:5px;">{vtranslate('Warnings', 'VTEStore')} ({$WARNINGS})</button></td>
        {elseif $WARNINGS==0 && $ERROR_NUM>0}
            <td style="padding-left: 5px;"><button id="phpiniWarnings" name="phpiniWarnings" class="btn btn-danger" style="margin-right:5px;">{vtranslate('Errors', 'VTEStore')} ({$ERROR_NUM})</button></td>
        {elseif $WARNINGS>0 && $ERROR_NUM>0}
            <td style="padding-left: 5px;"><button id="phpiniWarnings" name="phpiniWarnings" class="btn btn-danger" style="margin-right:5px;">{vtranslate('Warnings', 'VTEStore')} ({$WARNINGS}) {vtranslate('Errors', 'VTEStore')} ({$ERROR_NUM})</button></td>
        {/if}
        
        <td style="padding-left: 5px;"><button id="FaqLink" name="FaqLink" class="btn btn-warning VTEStoreFAQ">{vtranslate('FAQ', 'VTEStore')}</button></td>
        {if $CUSTOMERLOGINED>0}
            <td style="padding-left: 5px;"><button id="MyAccountLink" name="MyAccountLink" class="btn btn-success">{vtranslate('LBL_MY_ACCOUNT', 'VTEStore')}</button></td>
            {*<td style="padding-left: 5px;"><button id="logoutVTEStore" class="btn btn-primary">{vtranslate('LBL_LOGOUT', 'VTEStore')}</button></td>*}
        {else}
            <td style="padding-left: 5px;"><button id="logintoVTEStore" class="btn btn-primary">{vtranslate('LBL_LOGIN_TO_VTE_STORE', 'VTEStore')}</button></td>
        {/if}
    </tr>
</table>