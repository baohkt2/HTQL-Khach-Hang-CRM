<div class="modal-header contentsBackground">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h3>{vtranslate('LBL_LOGIN_TO_VTE_STORE', 'VTEStore')}</h3>
</div>
<form class="form-horizontal loginForm">
    <input type="hidden" name="module" value="VTEStore"/>
    <input type="hidden" name="parent" value="Settings"/>
    <input type="hidden" name="action" value="ActionAjax"/>
    <input type="hidden" name="userAction" value="login"/>
    <input type="hidden" name="mode" value="registerAccount"/>
    <input type="hidden" name="vtiger_url" value="{$VTIGER_URL}"/>

    <div class="modal-body">
        <div class="control-group">
            <span class="control-label"><span class="redColor">*</span>&nbsp;{vtranslate('LBL_USERNAME', 'VTEStore')}</span>
            <div class="controls"><input type="text" name="username" data-validation-engine="validate[required, funcCall[Vtiger_Base_Validator_Js.invokeValidation]]"/></div>
        </div>
        <div class="control-group">
            <span class="control-label"><span class="redColor">*</span>&nbsp;{vtranslate('LBL_PASSWORD', 'VTEStore')}</span>
            <div class="controls"><input type="password" name="password" data-validation-engine="validate[required, funcCall[Vtiger_Base_Validator_Js.invokeValidation]]"/></div>
        </div>
        <div class="control-group">
            <span class="control-label"></span>
            <div class="controls"><span><input type="checkbox" name="savePassword" value="1" checked> &nbsp; &nbsp;{vtranslate('LBL_REMEMBER_ME', 'VTEStore')}</span></div>
        </div>
        <div class="control-group">
            <span class="control-label"></span>
            <div class="controls"><a href="javascript:void(0);" style="text-decoration: underline;" id="forgotPassword" name="forgotPassword"><u>{vtranslate('Forgot Password', 'VTEStore')}</u></a></div>
        </div>
    </div>
    <div class="modal-footer">
        <div class="row-fluid">
            <div class="span6"><div class="row-fluid"><a href="#" name="signUp">{vtranslate('LBL_CREATE_AN_ACCOUNT', 'VTEStore')}</a></div></div>
            <div class="span6">
                <div class="pull-right">
                    <div class="pull-right cancelLinkContainer" style="margin-top:0px;">
                        <a class="cancelLink" type="reset" data-dismiss="modal">{vtranslate('LBL_CANCEL', 'VTEStore')}</a>
                    </div>
                    <button class="btn btn-success" type="submit" name="saveButton"><strong>{vtranslate('LBL_LOGIN', 'VTEStore')}</strong></button>
                </div>
            </div>
        </div>
    </div>
</form>