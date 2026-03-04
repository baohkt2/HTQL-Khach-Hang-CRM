    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header contentsBackground">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h3>{vtranslate('LBL_FORGOT_PASSWORD', 'VTEStore')}</h3>
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
                                <div style="text-align: center;"><span>{vtranslate('Please enter your email', 'VTEStore')}</span></div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="control-group">
                                <label class="span3 control-label"><span class="redColor">*</span>&nbsp;{vtranslate('LBL_EMAIL', 'VTEStore')}</label>
                                <div class="span5"><input type="text" class="inputElement" style="max-width: 210px;" name="email" aria-required="true" data-rule-required="true" /></div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="control-group">
                                <label class="span3 control-label"></label>
                                <div id='captcha_container_1' class="span5">{$CAPTCHADATA}</div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="control-group">
                                <label class="span3 control-label"></label>
                                <div class="span5 redColor error_content"></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row-fluid">
                            <div class="span6"><div class="row-fluid"></div></div>
                            <div class="span6">
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