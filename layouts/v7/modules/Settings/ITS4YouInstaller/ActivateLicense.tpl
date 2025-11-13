{*/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouInstaller license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */*}
{strip}
    <div id="activateLicenseModal" class="modal-dialog" style="width: 800px">
        <div class="modal-content">
            <div class="modal-header">
                <div class="clearfix">
                    <div class="pull-right " >
                        <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                            <span aria-hidden="true" class='fa fa-close'></span>
                        </button>
                    </div>
                    <h4 class="pull-left">
                        {vtranslate('LBL_MODULE_NAME',$QUALIFIED_MODULE)} {vtranslate('LBL_INSTALL',$QUALIFIED_MODULE)}
                    </h4>
                </div>
            </div>
            <div class="modal-body">
                <div class="editContainer">
                    <div class="clearfix"></div>
                    <div class="installationContents">
                        <div id="stepContent1">
                            <form id="activateLicense" method="POST" action="index.php" class="form-horizontal">
                                <input type="hidden" name="module" value="{$MODULE}"/>
                                <input type="hidden" name="view" value="List"/>
                                <input type="hidden" name="parent" value="Settings">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <h4><strong>{vtranslate('LBL_WELCOME',$QUALIFIED_MODULE)}</strong></h4>
                                        <br>
                                        <p>
                                            {vtranslate('LBL_WELCOME_DESC',$QUALIFIED_MODULE)}<br>
                                            {vtranslate('LBL_WELCOME_FINISH',$QUALIFIED_MODULE)}
                                        </p>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <label><strong>{vtranslate('LBL_INSERT_KEY',$QUALIFIED_MODULE)}</strong></label>
                                        <br>
                                        <p>
                                            {vtranslate('LBL_ONLINE_ASSURE',$QUALIFIED_MODULE)}
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        {include file='LicenseDetails.tpl'|@vtemplate_path:'Settings:ITS4YouInstaller'}
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{/strip}