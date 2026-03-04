    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header contentsBackground">
                <button aria-hidden="true" class="close " data-dismiss="modal" type="button"><span aria-hidden="true" class='fa fa-close'></span></button>
                <h4>{vtranslate('LBL_FORGOT_PASSWORD', 'VTEStore')}</h4>
            </div>
            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: auto;">
                <form class="form-horizontal forgotPasswordForm">
                    <input type="hidden" name="module" value="VTEStore"/>
                    <input type="hidden" name="parent" value="Settings"/>
                    <input type="hidden" name="action" value="ActionAjax"/>
                    <input type="hidden" name="mode" value="forgotPassword"/>

                    <div class="modal-body">
                        <div class="row">
                            <div class="control-group">
                                <div class="col-md-2"></div>
                                <div class="col-md-8" style="text-align: center;"><span>{vtranslate('Please enter your email', 'VTEStore')}</span></div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="control-group">
                                <label class="col-md-3 control-label"><span class="redColor">*</span>&nbsp;{vtranslate('LBL_EMAIL', 'VTEStore')}</label>
                                <div class="col-md-9"><input type="text" class="inputElement" style="max-width: 210px;" name="email" aria-required="true" data-rule-required="true" /></div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="control-group">
                                <label class="col-md-3 control-label"></label>
                                <div id='captcha_container_1' class="col-md-9">{$CAPTCHADATA}</div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="control-group">
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-9 redColor error_content"></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row-fluid">
                            <div class="col-lg-6"><div class="row-fluid"></div></div>
                            <div class="col-lg-6">
                                <div class="pull-right">
                                    <div class="pull-right cancelLinkContainer" style="margin-top:0px;">
                                        <a class="cancelLink" type="reset" data-dismiss="modal">{vtranslate('LBL_CANCEL', 'VTEStore')}</a>
                                    </div>
                                    <button class="btn btn-success" type="submit" name="btnForgotPassword" id="btnForgotPassword" {if $GREATERFIVE == true} disabled='true' {/if}><strong>{vtranslate('LBL_SUBMIT', 'VTEStore')}</strong></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>