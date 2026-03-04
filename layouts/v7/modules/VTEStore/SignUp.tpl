<div class="modal-content">
    <div class="modal-header contentsBackground">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span aria-hidden="true" class='fa fa-close'></span></button>
        <h4>{vtranslate('LBL_SIGN_UP_TO_VTE_STORE', 'VTEStore')}</h4>
    </div>
    <form class="form-horizontal signUpForm">
        <input type="hidden" name="module" value="VTEStore"/>
        <input type="hidden" name="parent" value="Settings"/>
        <input type="hidden" name="action" value="ActionAjax"/>
        <input type="hidden" name="userAction" value="signup"/>
        <input type="hidden" name="mode" value="registerAccount"/>
        <input type="hidden" name="vtiger_url" value="{$VTIGER_URL}"/>

        <div class="modal-body">
            <div class="row">
                <div class="control-group">
                    <label class="col-md-3 control-label"><span class="redColor">*</span>&nbsp;{vtranslate('LBL_EMAIL_ADDRESS', 'VTEStore')}</label>
                    <div class="col-md-9"><input type="text" class="inputElement" style="max-width: 210px;" name="emailAddress" aria-required="true" data-rule-required="true" /></div>
                    <div class="clearfix"></div>
                </div>
                <div class="control-group">
                    <label class="col-md-3 control-label"><span class="redColor">*</span>&nbsp;{vtranslate('LBL_FIRST_NAME', 'VTEStore')}</label>
                    <div class="col-md-9"><input type="text" class="inputElement" style="max-width: 210px;" name="firstName" aria-required="true" data-rule-required="true" /></div>
                    <div class="clearfix"></div>
                </div>
                <div class="control-group">
                    <label class="col-md-3 control-label"><span class="redColor">*</span>&nbsp;{vtranslate('LBL_LAST_NAME', 'VTEStore')}</label>
                    <div class="col-md-9"><input type="text" class="inputElement" style="max-width: 210px;" name="lastName" aria-required="true" data-rule-required="true" /></div>
                    <div class="clearfix"></div>
                </div>
                <div class="control-group">
                    <label class="col-md-3 control-label"><span class="redColor">*</span>&nbsp;{vtranslate('LBL_PHONE', 'VTEStore')}</label>
                    <div class="col-md-9"><input type="text" class="inputElement" style="max-width: 210px;" name="phone" aria-required="true" data-rule-required="true" /></div>
                    <div class="clearfix"></div>
                </div>
                <div class="control-group">
                    <label class="col-md-3 control-label"><span class="redColor">*</span>&nbsp;{vtranslate('LBL_COMPANY_NAME', 'VTEStore')}</label>
                    <div class="col-md-9"><input type="text" class="inputElement" style="max-width: 210px;" name="companyName" aria-required="true" data-rule-required="true" /></div>
                    <div class="clearfix"></div>
                </div>
                <div class="control-group">
                    <label class="col-md-3 control-label"><span class="redColor">*</span>&nbsp;{vtranslate('LBL_USERNAME', 'VTEStore')}</label>
                    <div class="col-md-9"><input type="text" class="inputElement" style="max-width: 210px;" id="signupUsername" name="signupUsername" aria-required="true" data-rule-required="true" /><span id="UsernameAlreadyExists" style="display: none; color: red; ">&nbsp;&nbsp;{vtranslate('Username already exists!', 'VTEStore')}</span></div>
                    <div class="clearfix"></div>
                </div>
                <div class="control-group">
                    <label class="col-md-3 control-label"><span class="redColor">*</span>&nbsp;{vtranslate('LBL_PASSWORD', 'VTEStore')}</label>
                    <div class="col-md-9"><input type="password" class="inputElement" style="max-width: 210px;" name="password" aria-required="true" data-rule-required="true" /></div>
                    <div class="clearfix"></div>
                </div>
                <div class="control-group">
                    <label class="col-md-3 control-label"><span class="redColor">*</span>&nbsp;{vtranslate('LBL_CONFIRM_PASSWORD', 'VTEStore')}</label>
                    <div class="col-md-9"><input type="password" class="inputElement" style="max-width: 210px;" name="confirmPassword" aria-required="true" data-rule-required="true" /></div>
                    <div class="clearfix"></div>
                </div>
                <div class="control-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-9"><span><input type="checkbox" name="savePassword" value="1" checked> &nbsp; &nbsp;{vtranslate('LBL_REMEMBER_ME', 'VTEStore')}</span></div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <div class="row-fluid">
                <div class="pull-left" style="width: 350px; color: red">{vtranslate('Once you click Register', 'VTEStore')}</div>
                <div class="pull-right">
                    <div class="pull-right cancelLinkContainer" style="margin-top:0px;">
                        <a class="cancelLink" type="reset"data-dismiss="modal">{vtranslate('LBL_CANCEL', 'VTEStore')}</a>
                    </div>
                    <button class="btn btn-success" type="submit" id="btnSaveButton" name="saveButton" disabled><strong>{vtranslate('LBL_REGISTER', 'VTEStore')}</strong></button>
                </div>
            </div>
        </div>
    </form>
    <div style="display: none"><iframe src="{$HATCHBUCK_URL}/modules/VTEStore/hatchbuck.form.html" width="99%" height="600px" id="hatchbuckForm" style="display: none"></iframe></div>
</div>