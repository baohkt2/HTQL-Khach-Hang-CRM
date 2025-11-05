{* *********************************************************************************
 * The content of this file is subject to the ITS4YouInstaller license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ******************************************************************************* *}
<div class="col-lg-12">
    <div class="clearfix">
        <h4>
            {vtranslate('LBL_INSTALLER_LOGIN', $QUALIFIED_MODULE)}
        </h4>
        <hr>
    </div>
    <div class="row">
        <div class="col-lg-6" style="border-right: 1px solid #ddd;">
            <form class="form-horizontal loginForm" method="post" action="index.php">
                <input type="hidden" name="module" value="ITS4YouInstaller"/>
                <input type="hidden" name="parent" value="Settings"/>
                <input type="hidden" name="action" value="Basic"/>
                <input type="hidden" name="userAction" value="login"/>
                <input type="hidden" name="mode" value="registerAccount"/>
                <div class="form-group">
                    <span class="control-label col-sm-3 fieldLabel"></span>
                    <div class="controls col-sm-5">
                        <h5><b>{vtranslate('LBL_USERLOGIN_TAB',$QUALIFIED_MODULE)}</b></h5>
                    </div>
                </div>
                <div class="form-group">
                    <span class="control-label col-sm-3 fieldLabel">{vtranslate('LBL_EMAIL', $QUALIFIED_MODULE)}</span>
                    <div class="controls col-sm-5">
                        <input type="text" id="emailAddress" name="emailAddress" data-rule-required="true"
                               data-rule-email="true" class="inputElement" placeholder="@">
                    </div>
                </div>
                <div class="form-group">
                    <span class="control-label fieldLabel col-sm-3">{vtranslate('LBL_PASSWORD', $QUALIFIED_MODULE)}</span>
                    <div class="controls col-sm-5">
                        <input type="password" id="password" name="password" data-rule-required="true"
                               class="inputElement" placeholder="******">
                    </div>
                </div>
                <div class="form-group">
                    <span class="control-label fieldLabel col-sm-3">&nbsp;</span>
                    <div class="controls col-sm-5">
                        <a href="{$SHOP_LINK}" target="_blank">{vtranslate('LBL_REGISTER', $QUALIFIED_MODULE)}</a>
                        {vtranslate('LBL_OR', 'Vtiger')}
                        <a href="{$SHOP_LINK}"
                           target="_blank">{vtranslate('LBL_FORGOT_PASSWORD', $QUALIFIED_MODULE)}</a>
                    </div>
                </div>
                <div class="form-group">
                    <span class="control-label fieldLabel col-sm-3">&nbsp;</span>
                    <div class="controls col-sm-5">
                        <button class="btn btn-success" name="userLogin" type="submit">
                            <strong>{vtranslate('LBL_LOGIN', $QUALIFIED_MODULE)}</strong>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-6">
            <form class="form-horizontal loginKeyForm" method="post" action="index.php">
                <input type="hidden" name="module" value="ITS4YouInstaller">
                <input type="hidden" name="parent" value="Settings">
                <input type="hidden" name="action" value="Basic">
                <input type="hidden" name="userAction" value="login">
                <input type="hidden" name="mode" value="registerAccount">
                <input type="hidden" name="emailAddress" value="accesskey">
                <div class="form-group">
                    <span class="control-label col-sm-3 fieldLabel"></span>
                    <div class="controls col-sm-5">
                        <h5><b>{vtranslate('LBL_KEYLOGIN_TAB',$QUALIFIED_MODULE)}</b></h5>
                    </div>
                </div>
                <div class="form-group">
                    <span class="control-label col-sm-3 fieldLabel">{vtranslate('LBL_PACKAGE_KEY', $QUALIFIED_MODULE)}</span>
                    <div class="controls col-sm-5">
                        <input type="text" id="password" name="password" data-rule-required="true"
                               class="inputElement" placeholder="******">
                    </div>
                </div>
                <div class="form-group">
                    <span class="control-label fieldLabel col-sm-3">&nbsp;</span>
                    <div class="controls col-sm-5">
                        <button class="btn btn-success" name="userLogin" type="submit">
                            <strong>{vtranslate('LBL_LOGIN', $QUALIFIED_MODULE)}</strong>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
