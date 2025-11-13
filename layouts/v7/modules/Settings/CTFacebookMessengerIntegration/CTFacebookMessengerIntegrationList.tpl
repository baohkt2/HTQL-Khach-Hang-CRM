{***********************************************************************************
* The content of this file is subject to the CRMTiger Pro license.
* ("License"); You may not use this file except in compliance with the License
* The Initial Developer of the Original Code is vTiger
* The Modified Code of the Original Code owned by https://crmtiger.com/
* Portions created by CRMTiger.com are Copyright(C) CRMTiger.com
* All Rights Reserved.
************************************************************************************}
<div class="main" id="facebookIntegrationListPageDiv">
    <div class="main">
        <div class="header">
            <h4>{vtranslate('LBL_CTFACEBOOK_MESSENGER_INTEGRATION_CONFIGURATION', $QUALIFIED_MODULE)}</h4><br>
        </div>		
		{if $ACCESSTOKEN eq ''}
            <button id="loginWithFacebook" class="btn btn-sm">{vtranslate('LBL_CTFACEBOOK_LOGIN_WITH_FACEBOOK', $QUALIFIED_MODULE)}</b></button>
        {/if}
    </div>
</div>