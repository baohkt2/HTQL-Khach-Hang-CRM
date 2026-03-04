<div class="modal-content">
    <div class="modal-header contentsBackground">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span aria-hidden="true" class='fa fa-close'></span></button><h4>{vtranslate('LBL_MY_ACCOUNT', 'VTEStore')}</h4>
    </div>
    <form class="form-horizontal MyAccountForm">
        <input type="hidden" name="module" value="VTEStore"/>
        <input type="hidden" name="parent" value="Settings"/>
        <input type="hidden" name="action" value="ActionAjax"/>
        <input type="hidden" name="mode" value="updateMyAccount"/>
        <input type="hidden" name="customerid" value="{$CUSTOMERDATA.id}"/>
        <div class="modal-body">
            <div class="control-group">
                <span><strong>{vtranslate('LBL_ACCOUNT_DETAILS', 'VTEStore')}</strong></span>
            </div>
            <div class="control-group">
                <label class="col-md-4 control-label"><span class="redColor">*</span>&nbsp;{vtranslate('LBL_USERNAME', 'VTEStore')}</label>
                <div class="col-md-8"><input disabled="disabled" type="text" class="inputElement" value="{$CUSTOMERDATA.username}" style="max-width: 400px;" name="username" aria-required="true" data-rule-required="true" /></div>
                <div class="clearfix"></div>
            </div>
            <div class="control-group">
                <label class="col-md-4 control-label"><span class="redColor">*</span>&nbsp;{vtranslate('LBL_EMAIL_ADDRESS', 'VTEStore')}</label>
                <div class="col-md-8"><input type="text" class="inputElement" value="{$CUSTOMERDATA.email}" style="max-width: 400px;" name="emailAddress" aria-required="true" data-rule-required="true" /></div>
                <div class="clearfix"></div>
            </div>
            <div class="control-group">
                <label class="col-md-4 control-label"><span class="redColor">*</span>&nbsp;{vtranslate('LBL_FIRST_NAME', 'VTEStore')}</label>
                <div class="col-md-8"><input type="text" class="inputElement" value="{$CUSTOMERDATA.firstname}" style="max-width: 400px;" name="firstName" aria-required="true" data-rule-required="true" /></div>
                <div class="clearfix"></div>
            </div>
            <div class="control-group">
                <label class="col-md-4 control-label"><span class="redColor">*</span>&nbsp;{vtranslate('LBL_LAST_NAME', 'VTEStore')}</label>
                <div class="col-md-8"><input type="text" class="inputElement" value="{$CUSTOMERDATA.lastname}" style="max-width: 400px;" name="lastName" aria-required="true" data-rule-required="true" /></div>
                <div class="clearfix"></div>
            </div>
            <div class="control-group">
                <label class="col-md-4 control-label"><span class="redColor">*</span>&nbsp;{vtranslate('LBL_PHONE', 'VTEStore')}</label>
                <div class="col-md-8"><input type="text" class="inputElement" value="{$CUSTOMERDATA.phone}" style="max-width: 400px;" name="phone" aria-required="true" data-rule-required="true" /></div>
                <div class="clearfix"></div>
            </div>
            <div class="control-group">
                <label class="col-md-4 control-label"><span class="redColor">*</span>&nbsp;{vtranslate('LBL_COMPANY_NAME', 'VTEStore')}</label>
                <div class="col-md-8"><input type="text" class="inputElement" value="{$CUSTOMERDATA.companyname}" style="max-width: 400px;" name="companyName" aria-required="true" data-rule-required="true" /></div>
                <div class="clearfix"></div>
            </div>
            <div class="control-group">
                <div class="col-md-12">
                    <hr />
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="control-group">
                <div class="col-md-12"><span><strong>{vtranslate('LBL_SUBCRIPTION', 'VTEStore')}</strong></span></div>
                <div class="clearfix"></div>
            </div>
            <div class="control-group">
                <label class="col-md-4 control-label">{vtranslate('LBL_URL', 'VTEStore')}</label>
                <div class="col-md-8"><input disabled="disabled" type="text" class="inputElement" value="{$CUSTOMERDATA.vtiger_url}" style="max-width: 400px;" name="vtiger_url" aria-required="true" data-rule-required="true" /></div>
                <div class="clearfix"></div>
            </div>
            <div class="control-group">
                <label class="col-md-4 control-label">{vtranslate('LBL_STATUS', 'VTEStore')}</label>
                <div class="col-md-8">
                    {if $CUSTOMER_STATUS=='ok'}
                        <a href="https://www.vtexperts.com/subscription-status/" target="_blank"> {vtranslate($CUSTOMER_STATUS, 'VTEStore')} - {vtranslate('Expires in', 'VTEStore')} {$CUSTOMERDATA.remain_date} {vtranslate('days', 'VTEStore')} <img width="12" height="12" border="0" alt="{vtranslate('has_subscription_tooltip', 'VTEStore')}" title="{vtranslate('has_subscription_tooltip', 'VTEStore')}" src="layouts/v7/modules/VTEStore/resources/images/tooltip.png"></a>
                    {else}
                        <a href="https://www.vtexperts.com/subscription-status/" target="_blank">{vtranslate($CUSTOMER_STATUS, 'VTEStore')} <img width="12" height="12" border="0" alt="{vtranslate('no_subscription_tooltip', 'VTEStore')}" title="{vtranslate('no_subscription_tooltip', 'VTEStore')}"src="layouts/v7/modules/VTEStore/resources/images/tooltip.png"></a>
                    {/if}
                    &nbsp;<button class="btn btn-success" type="button" id="btnRefresh" name="btnRefresh"><strong>{vtranslate('LBL_REFRESH', 'VTEStore')}</strong></button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="control-group">
                <div class="col-md-4"></div>
                <div class="col-md-8">
                    <button id="ManageSubscription" name="ManageSubscription" class="btn btn-warning ManageSubscription" type="button">{vtranslate('LBL_MANAGE_SUBSCRIPTION', 'VTEStore')}</button>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="modal-footer">
            <div class="row">
                <div class="col-md-2 pull-left">
                    <a id="logoutVTEStore" class="btn btn-primary">{vtranslate('LBL_LOGOUT', 'VTEStore')}</a>
                </div>
                <div class="col-md-10 text-right">
                    <button class="btn btn-success" type="submit" name="saveButton"><strong>{vtranslate('LBL_SAVE', 'VTEStore')}</strong></button>
                    <a class="cancelLink" type="reset" data-dismiss="modal">{vtranslate('LBL_CANCEL', $MODULE)}</a>
                </div>
            </div>
        </div>
    </form>
</div>