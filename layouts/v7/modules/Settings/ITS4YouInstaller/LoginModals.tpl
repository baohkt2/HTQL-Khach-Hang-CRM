{* *********************************************************************************
 * The content of this file is subject to the ITS4YouInstaller license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ******************************************************************************* *}
<div class="modal-dialog loginAccount hide">
    <div class="modal-content" data-actual-tab="useraccessDiv">
        <div class="modal-header">
            <div class="clearfix">
                <div class="pull-right " >
                    <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                        <span aria-hidden="true" class='fa fa-close'></span>
                    </button>
                </div>
                <h4 class="pull-left">
                    {vtranslate('LBL_INSTALLER_LOGIN', $QUALIFIED_MODULE)}
                </h4>
            </div>
        </div>
        <div class="modal-body tabbable" style="padding:0">
            <ul class="nav nav-pills" style="padding:5px;">
                <li class="active">
                    <a href="" data-toggle="tab" data-target="useraccessDiv" data-tab-name="useraccessDiv">{vtranslate('LBL_USERLOGIN_TAB',$QUALIFIED_MODULE)}</a>
                </li>
                <li class="">
                    <a href="" data-toggle="tab" data-target="accesskeyDiv" data-tab-name="accesskeyDiv">{vtranslate('LBL_KEYLOGIN_TAB',$QUALIFIED_MODULE)}</a>
                </li>
            </ul>

            <div style="padding-top:2%;margin-top:5px;">
                <div class="tab-pane active" id="useraccessDiv">
                    <form class="form-horizontal loginForm">
                        <input type="hidden" name="module" value="ITS4YouInstaller" />
                        <input type="hidden" name="parent" value="Settings" />
                        <input type="hidden" name="action" value="Basic" />
                        <input type="hidden" name="userAction" value="login" />
                        <input type="hidden" name="mode" value="registerAccount" />

                        <div class="form-group">
                            <span class="control-label col-sm-3 fieldLabel">
                                {vtranslate('LBL_EMAIL', $QUALIFIED_MODULE)}
                            </span>
                            <div class="controls col-sm-5">
                                <input type="text" id="emailAddress" name="emailAddress" data-rule-required="true" data-rule-email="true" class="inputElement" placeholder="@">
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="control-label fieldLabel col-sm-3">
                                {vtranslate('LBL_PASSWORD', $QUALIFIED_MODULE)}
                            </span>
                            <div class="controls col-sm-5">
                                <input type="password" id="password" name="password" data-rule-required="true" class="inputElement" placeholder="******">
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="control-label fieldLabel col-sm-3">
                                &nbsp;
                            </span>
                            <div class="controls col-sm-5">
                                <a href="{$SHOP_LINK}" target="_blank">{vtranslate('LBL_REGISTER', $QUALIFIED_MODULE)}</a>
                                {vtranslate('LBL_OR', 'Vtiger')}
                                <a href="{$SHOP_LINK}" target="_blank">{vtranslate('LBL_FORGOT_PASSWORD', $QUALIFIED_MODULE)}</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane hide" id="accesskeyDiv">
                    <form class="form-horizontal loginKeyForm">
                        <input type="hidden" name="module" value="ITS4YouInstaller">
                        <input type="hidden" name="parent" value="Settings" >
                        <input type="hidden" name="action" value="Basic" >
                        <input type="hidden" name="userAction" value="login" >
                        <input type="hidden" name="mode" value="registerAccount" >
                        <input type="hidden" name="emailAddress" value="accesskey" >
                        <div class="form-group">
                            <span class="control-label col-sm-3 fieldLabel">
                                {vtranslate('LBL_KEY', $QUALIFIED_MODULE)}
                            </span>
                            <div class="controls col-sm-5">
                                <input type="text" id="password" name="password" data-rule-required="true" class="inputElement">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <div class="row-fluid">
                <span class="col-sm-12">
                    <div class="pull-right">
                        <div class="pull-right cancelLinkContainer" style="margin-top:0;">
                            <a class="cancelLink" type="reset" data-dismiss="modal">{vtranslate('LBL_CANCEL', $MODULE)}</a>
                        </div>
                        <button class="btn btn-success" id="saveButton" name="saveButton" type="button"><strong>{vtranslate('LBL_LOGIN', $QUALIFIED_MODULE)}</strong></button>
                    </div>
                </span>
            </div>
        </div>

    </div>                
</div>
<!-- Login form end -->

{if $LOADER_REQUIRED}
    <div class="modal extensionLoader hide">
        <div class="modal-header contentsBackground">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>{vtranslate('LBL_INSTALL_EXTENSION_LOADER', $QUALIFIED_MODULE)}</h3>
        </div>
        <div class="modal-body">
            <div class="row-fluid">
                <p>{vtranslate('LBL_TO_CONTINUE_USING_EXTENSION_STORE', $QUALIFIED_MODULE)}<a href="https://marketplace.vtiger.com/loaderfiles/{$LOADER_INFO['loader_file']}">{vtranslate('LBL_DOWNLOAD', $QUALIFIED_MODULE)}</a>{vtranslate('LBL_COMPATIABLE_EXTENSION', $QUALIFIED_MODULE)}</p>
            </div>
            <div class="row-fluid">
                <p>{vtranslate('LBL_MORE_DETAILS_ON_INSTALLATION', $QUALIFIED_MODULE)}<a onclick=window.open("http://community.vtiger.com/help/vtigercrm/php/extension-loader.html")>{vtranslate('LBL_READ_HERE', $QUALIFIED_MODULE)}</a></p>
            </div>
        </div>
        <div class="modal-footer">
            <div class="row-fluid">
                <div class="pull-right">
                    <div class="pull-right cancelLinkContainer" style="margin-top:0;">
                        <button class="btn btn-success" data-dismiss="modal">{vtranslate('LBL_OK', $QUALIFIED_MODULE)}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
{/if}