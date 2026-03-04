<div class="modal-header contentsBackground">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h3>{vtranslate('LBL_MY_ACCOUNT', 'VTEStore')}</h3>
</div>
<form class="form-horizontal MyAccountForm">
    <input type="hidden" name="module" value="VTEStore"/>
    <input type="hidden" name="parent" value="Settings"/>
    <input type="hidden" name="action" value="ActionAjax"/>
    <input type="hidden" name="mode" value="updateMyAccount"/>
    <input type="hidden" name="customerid" value="{$CUSTOMERDATA.id}"/>
    <div class="control-group">
        <span class="control-label">&nbsp;<strong>{vtranslate('LBL_ACCOUNT_DETAILS', 'VTEStore')}</strong></span>
    </div>
    <div class="control-group">
        <span class="control-label"><span class="redColor">*</span>&nbsp;{vtranslate('LBL_USERNAME', 'VTEStore')}</span>
        <div class="controls"><input type="text" name="username" value="{$CUSTOMERDATA.username}" data-validation-engine="validate[required, funcCall[Vtiger_Base_Validator_Js.invokeValidation]]" disabled/></div>
    </div>
    <div class="control-group">
        <span class="control-label"><span class="redColor">*</span>&nbsp;{vtranslate('LBL_EMAIL_ADDRESS', 'VTEStore')}</span>
        <div class="controls"><input type="text" name="emailAddress" value="{$CUSTOMERDATA.email}" data-validation-engine="validate[required, funcCall[Vtiger_Base_Validator_Js.invokeValidation]]"/></div>
    </div>
    <div class="control-group">
        <span class="control-label"><span class="redColor">*</span>&nbsp;{vtranslate('LBL_FIRST_NAME', 'VTEStore')}</span>
        <div class="controls"><input type="text" name="firstName" value="{$CUSTOMERDATA.firstname}" data-validation-engine="validate[required, funcCall[Vtiger_Base_Validator_Js.invokeValidation]]"/></div>
    </div>
    <div class="control-group">
        <span class="control-label"><span class="redColor">*</span>&nbsp;{vtranslate('LBL_LAST_NAME', 'VTEStore')}</span>
        <div class="controls"><input type="text" name="lastName" value="{$CUSTOMERDATA.lastname}" data-validation-engine="validate[required, funcCall[Vtiger_Base_Validator_Js.invokeValidation]]"/></div>
    </div>
    <div class="control-group">
        <span class="control-label"><span class="redColor">*</span>&nbsp;{vtranslate('LBL_PHONE', 'VTEStore')}</span>
        <div class="controls"><input type="text" name="phone" value="{$CUSTOMERDATA.phone}" data-validation-engine="validate[required, funcCall[Vtiger_Base_Validator_Js.invokeValidation]]"/></div>
    </div>
    <div class="control-group">
        <span class="control-label"><span class="redColor">*</span>&nbsp;{vtranslate('LBL_COMPANY_NAME', 'VTEStore')}</span>
        <div class="controls"><input type="text" name="companyName" value="{$CUSTOMERDATA.companyname}" data-validation-engine="validate[required, funcCall[Vtiger_Base_Validator_Js.invokeValidation]]"/></div>
    </div>
    <div class="control-group">
        <span class="control-label">&nbsp;<strong>{vtranslate('LBL_SUBCRIPTION', 'VTEStore')}</strong></span>
    </div>
    <div class="control-group">
        <span class="control-label">&nbsp;{vtranslate('LBL_URL', 'VTEStore')}: </span>
        <div class="controls" style="padding-top: 5px;">{$CUSTOMERDATA.vtiger_url}</div>
    </div>
    <div class="control-group">
        <span class="control-label">&nbsp;{vtranslate('LBL_STATUS', 'VTEStore')}: </span>
        <div class="controls" style="padding-top: 5px;">
            {if $CUSTOMER_STATUS=='ok'}
                <a href="https://www.vtexperts.com/subscription-status/" target="_blank"> {vtranslate('LBL_ACTIVE', 'VTEStore')} - {vtranslate('Expires in', 'VTEStore')} {$CUSTOMERDATA.remain_date} {vtranslate('days', 'VTEStore')} <img width="12" height="12" border="0" alt="{vtranslate('has_subscription_tooltip', 'VTEStore')}" title="{vtranslate('has_subscription_tooltip', 'VTEStore')}" src="layouts/vlayout/modules/VTEStore/resources/images/tooltip.png"></a>
            {else}
                <a href="https://www.vtexperts.com/subscription-status/" target="_blank">{vtranslate('LBL_TRIAL', 'VTEStore')} <img width="12" height="12" border="0" alt="{vtranslate('no_subscription_tooltip', 'VTEStore')}" title="{vtranslate('no_subscription_tooltip', 'VTEStore')}"src="layouts/vlayout/modules/VTEStore/resources/images/tooltip.png"></a>
            {/if}
            &nbsp;<button class="btn btn-success" type="button" id="btnRefresh" name="btnRefresh"><strong>{vtranslate('LBL_REFRESH', 'VTEStore')}</strong></button>
        </div>
    </div>
    <div class="control-group">
        <div class="controls" style="padding-top: 5px;"><button id="ManageSubscription" name="ManageSubscription" class="btn btn-warning ManageSubscription" type="button">{vtranslate('LBL_MANAGE_SUBSCRIPTION', 'VTEStore')}</button> </div>
    </div>
    <div class="modal-footer">
        <div class="row-fluid">
            <div class="span6"></div>
            <div class="span6">
                <div class="pull-right">
                    <div class="pull-right cancelLinkContainer" style="margin-top:0px;">
                        <a class="cancelLink" type="reset" data-dismiss="modal">{vtranslate('LBL_CANCEL', $MODULE)}</a>
                    </div>
                    <button class="btn btn-success" type="submit" name="saveButton"><strong>{vtranslate('LBL_SAVE', 'VTEStore')}</strong></button>
                </div>
            </div>
        </div>
    </div>
</form>