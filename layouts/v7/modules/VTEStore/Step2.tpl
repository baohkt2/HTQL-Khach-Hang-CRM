{*/* * *******************************************************************************
* The content of this file is subject to the VTiger Premium ("License");
* You may not use this file except in compliance with the License
* The Initial Developer of the Original Code is VTExperts.com
* Portions created by VTExperts.com. are Copyright(C)VTExperts.com.
* All Rights Reserved.
* ****************************************************************************** */*}
{strip}
    <div class="installationContents" style="padding-left: 3%;padding-right: 3%">
        <form name="EditWorkflow" action="index.php" method="post" id="installation_step2" class="form-horizontal">
            <input type="hidden" class="step" value="2" />


            <div class="padding1per" style="border:1px solid #ccc; padding: 1%;">
                <label>
                    <strong>{vtranslate('LBL_WELCOME',$QUALIFIED_MODULE)} {vtranslate('MODULE_LBL',$QUALIFIED_MODULE)} {vtranslate('LBL_INSTALLATION_WIZARD',$QUALIFIED_MODULE)}</strong>
                </label>
                <br>
                <div class="control-group">
                    <div>
                        <span>
                            {vtranslate('LBL_YOU_ARE_REQUIRED_VALIDATE',$QUALIFIED_MODULE)}
                        </span>
                    </div>
                </div>
                <div class="control-group" style="margin-bottom:10px;">
                    <div class="control-label"><strong>{vtranslate('LBL_VTIGER_URL',$QUALIFIED_MODULE)}</strong></div>
                    <div class="controls" style="margin-top: 5px;">
                        <span>
                            {$SITE_URL}
                        </span>
                    </div>
                </div>
                <div class="control-group" style="margin-bottom:10px;">
                    <div class="control-label"><strong>{vtranslate('LBL_LICENSE_KEY',$QUALIFIED_MODULE)}</strong></div>
                    <div class="controls"><input type="text" id="license_key" name="license_key" value="" data-validation-engine="validate[required]" class="col-md-4" name="summary"></div>
                </div>
                {if $VTELICENSE->result eq 'bad' || $VTELICENSE->result eq 'invalid'}
                    <div class="alert alert-error" id="error_message">
                        {$VTELICENSE->message}
                    </div>
                {/if}


                <div class="control-group">
                    <div><span>{vtranslate('LBL_HAVE_TROUBLE',$QUALIFIED_MODULE)} {vtranslate('LBL_CONTACT_US',$QUALIFIED_MODULE)}</span></div>
                </div>
                <div class="control-group">
                    <ul style="padding-left: 10px;">
                        <li>{vtranslate('LBL_EMAIL',$QUALIFIED_MODULE)}: &nbsp;&nbsp;<a href="mailto:Support@VTExperts.com">Support@VTExperts.com</a></li>
                        <li>{vtranslate('LBL_PHONE',$QUALIFIED_MODULE)}: &nbsp;&nbsp;<span>+1 (818) 495-5557</span></li>
                        <li>{vtranslate('LBL_CHAT',$QUALIFIED_MODULE)}: &nbsp;&nbsp;{vtranslate('LBL_AVAILABLE_ON',$QUALIFIED_MODULE)} <a href="http://www.vtexperts.com" target="_blank">http://www.VTExperts.com</a></li>
                    </ul>
                </div>

                <div class="control-group" style="text-align: center;">
                    <button class="btn btn-success" name="btnActivate" type="button"><strong>{vtranslate('LBL_ACTIVATE', $QUALIFIED_MODULE)}</strong></button>
                    <button class="btn btn-info" name="btnOrder" type="button" onclick="window.open('http://www.vtexperts.com/extension/vtiger-global-search/')"><strong>{vtranslate('LBL_ORDER_NOW', $QUALIFIED_MODULE)}</strong></button>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </form>
</div>
{/strip}