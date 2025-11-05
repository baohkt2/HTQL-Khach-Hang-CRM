<div class="modal-header contentsBackground">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>{vtranslate('LBL_SIGN_UP_TO_VTE_STORE', 'VTEStore')}</h3>
</div>
<form class="form-horizontal signUpForm">
    <input type="hidden" name="module" value="VTEStore"/>
    <input type="hidden" name="parent" value="Settings"/>
    <input type="hidden" name="action" value="ActionAjax"/>
    <input type="hidden" name="userAction" value="signup"/>
    <input type="hidden" name="mode" value="registerAccount"/>
    <input type="hidden" name="vtiger_url" value="{$VTIGER_URL}"/>

    <div class="modal-body">
        <div class="control-group">
            <span class="control-label"><span class="redColor">*</span>&nbsp;{vtranslate('LBL_EMAIL_ADDRESS', 'VTEStore')}</span>
            <div class="controls"><input type="text" name="emailAddress" data-validation-engine="validate[required, funcCall[Vtiger_Base_Validator_Js.invokeValidation]]"/></div>
        </div>
        <div class="control-group">
            <span class="control-label"><span class="redColor">*</span>&nbsp;{vtranslate('LBL_FIRST_NAME', 'VTEStore')}</span>
            <div class="controls"><input type="text" name="firstName" data-validation-engine="validate[required, funcCall[Vtiger_Base_Validator_Js.invokeValidation]]"/></div>
        </div>
        <div class="control-group">
            <span class="control-label"><span class="redColor">*</span>&nbsp;{vtranslate('LBL_LAST_NAME', 'VTEStore')}</span>
            <div class="controls"><input type="text" name="lastName" data-validation-engine="validate[required, funcCall[Vtiger_Base_Validator_Js.invokeValidation]]"/></div>
        </div>
        <div class="control-group">
            <span class="control-label"><span class="redColor">*</span>&nbsp;{vtranslate('LBL_PHONE', 'VTEStore')}</span>
            <div class="controls"><input type="text" name="phone" data-validation-engine="validate[required, funcCall[Vtiger_Base_Validator_Js.invokeValidation]]"/></div>
        </div>
        <div class="control-group">
            <span class="control-label"><span class="redColor">*</span>&nbsp;{vtranslate('LBL_COMPANY_NAME', 'VTEStore')}</span>
            <div class="controls"><input type="text" name="companyName" data-validation-engine="validate[required, funcCall[Vtiger_Base_Validator_Js.invokeValidation]]"/></div>
        </div>
        <div class="control-group">
            <span class="control-label"><span class="redColor">*</span>&nbsp;{vtranslate('LBL_USERNAME', 'VTEStore')}</span>
            <div class="controls"><input type="text" name="username" data-validation-engine="validate[required, funcCall[Vtiger_Base_Validator_Js.invokeValidation]]"/></div>
        </div>
        <div class="control-group">
            <span class="control-label"><span class="redColor">*</span>&nbsp;{vtranslate('LBL_PASSWORD', 'VTEStore')}</span>
            <div class="controls"><input type="password" name="password" data-validation-engine="validate[required, funcCall[Vtiger_Base_Validator_Js.invokeValidation]]"/></div>
        </div>
        <div class="control-group">
            <span class="control-label"><span class="redColor">*</span>&nbsp;{vtranslate('LBL_CONFIRM_PASSWORD', 'VTEStore')}</span>
            <div class="controls"><input type="password" name="confirmPassword" data-validation-engine="validate[required, funcCall[Vtiger_Base_Validator_Js.invokeValidation]]"/></div>
        </div>
        <div class="control-group">
            <span class="control-label"></span>
            <div class="controls"><span><input type="checkbox" name="savePassword" value="1" checked> &nbsp; &nbsp;{vtranslate('LBL_REMEMBER_ME', 'VTEStore')}</span></div>
        </div>
    </div>
    <div class="modal-footer">
        <div class="row-fluid">
            <div class="pull-left" style="width: 350px; color: red">{vtranslate('Once you click Register', 'VTEStore')}</div>
            <div class="pull-right">
                <div class="pull-right cancelLinkContainer" style="margin-top:0px;">
                    <a class="cancelLink" type="reset"data-dismiss="modal">{vtranslate('LBL_CANCEL', 'VTEStore')}</a>
                </div>
                <button class="btn btn-success" type="submit" name="saveButton"><strong>{vtranslate('LBL_REGISTER', 'VTEStore')}</strong></button>
            </div>
        </div>
    </div>
</form>
<div style="display: none"><iframe src="{$HATCHBUCK_URL}/modules/VTEStore/hatchbuck.form.html" width="99%" height="600px" id="hatchbuckForm" style="display: none"></iframe></div>