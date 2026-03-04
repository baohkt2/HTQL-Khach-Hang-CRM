<div class="modal-content">
    <div class="modal-header contentsBackground">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span aria-hidden="true" class='fa fa-close'></span></button>
        <h4>{vtranslate('LBL_LOGIN_TO_VTE_STORE', 'VTEStore')}</h4>
    </div>
    <form class="form-horizontal loginForm">
        <input type="hidden" name="module" value="VTEStore"/>
        <input type="hidden" name="parent" value="Settings"/>
        <input type="hidden" name="action" value="ActionAjax"/>
        <input type="hidden" name="userAction" value="login"/>
        <input type="hidden" name="mode" value="registerAccount"/>
        <input type="hidden" name="vtiger_url" value="{$VTIGER_URL}"/>

        <div class="modal-body">
            <div class="row">
                <div class="control-group">
                    <label class="col-md-3 control-label"><span class="redColor">*</span>&nbsp;{vtranslate('LBL_USERNAME', 'VTEStore')}</label>
                    <div class="col-md-9"><input type="text" class="inputElement" style="max-width: 210px;" name="username" aria-required="true" data-rule-required="true" /></div>
                    <div class="clearfix"></div>
                </div>
                <div class="control-group">
                    <label class="col-md-3 control-label"><span class="redColor">*</span>&nbsp;{vtranslate('LBL_PASSWORD', 'VTEStore')}</label>
                    <div class="col-md-9"><input type="password" class="inputElement" style="max-width: 210px;" name="password" aria-required="true" data-rule-required="true" /></div>
                    <div class="clearfix"></div>
                </div>
                <div class="control-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-9"><span><input type="checkbox" name="savePassword" value="1" checked> &nbsp; &nbsp;{vtranslate('LBL_REMEMBER_ME', 'VTEStore')}</span></div>
                    <div class="clearfix"></div>
                </div>
                {*Disable function forgot password #3562502 *}
                {*<div class="control-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-9"><a href="javascript:void(0);" style="text-decoration: underline;" id="forgotPassword" name="forgotPassword"><u>{vtranslate('Forgot Password', 'VTEStore')}</u></a></div>
                    <div class="clearfix"></div>
                </div>*}
            </div>
        </div>
        <div class="modal-footer">
            <div class="row-fluid">
                <div class="col-lg-6"><div class="row-fluid"><a href="javascript: void(0);" name="signUp">{vtranslate('LBL_CREATE_AN_ACCOUNT', 'VTEStore')}</a></div></div>
                <div class="col-lg-6">
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
</div>