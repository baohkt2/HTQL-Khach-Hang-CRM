{*/* * *******************************************************************************
* The content of this file is subject to the VTE_MODULE_LBL ("License");
* You may not use this file except in compliance with the License
* The Initial Developer of the Original Code is VTExperts.com
* Portions created by VTExperts.com. are Copyright(C)VTExperts.com.
* All Rights Reserved.
* ****************************************************************************** */*}
{strip}
    <div class="editContainer container-fluid" style="padding-left: 3%;padding-right: 3%; margin-top: 20px;">
        <h3>
            {vtranslate('MODULE_LBL',$QUALIFIED_MODULE)}
        </h3>
        <hr>
        <div id="breadcrumb">
            <ul class="crumbs marginLeftZero">
                <li class="first step active"  style="z-index:9" id="step1">
                    <a>
                        <span class="stepNum">&nbsp;</span>
                        <span class="stepText">{vtranslate('LBL_LICENSE_UPGRADE',$QUALIFIED_MODULE)}</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="installationContents" style="padding-left: 3%;padding-right: 3%">
        <div class="padding1per" style="border:1px solid #ccc;">
            <div class="row-fluid" style="margin-bottom:10px;">
                <span class="span2" style="text-align: right"><strong>{vtranslate('LBL_VTIGER_URL',$QUALIFIED_MODULE)}</strong></span>
                <span class="span6">{$LICENSE_INFO['site_url']}</span>
            </div>
            <div class="row-fluid" style="margin-bottom:10px;">
                <span class="span2" style="text-align: right"><strong>{vtranslate('LBL_LICENSE_KEY',$QUALIFIED_MODULE)}</strong></span>
                <span class="span6">{$LICENSE_INFO['license']}</span>
            </div>
            <div class="row-fluid" style="margin-bottom:10px;">
                <span class="span2" style="text-align: right"><strong>{vtranslate('LBL_LICENSE_EXPIRES',$QUALIFIED_MODULE)}</strong></span>
                <span class="span6">{$LICENSE_EXPIRES}</span>
            </div>
            <div class="row-fluid" style="margin-bottom:10px;">
                <span class="span2" style="text-align: right"><strong>{vtranslate('LBL_SUPPORT_EXPIRES',$QUALIFIED_MODULE)}</strong></span>
                <span class="span6">{$SUPPORT_EXPIRES}</span>
            </div>
            <div class="control-group" style="text-align: center;">
                <button class="btn btn-info" name="btnRelease" type="button" style="margin-right: 15px;"><strong>{vtranslate('LBL_RELEASE_LICENSE', $QUALIFIED_MODULE)}</strong></button>
                {if $IS_SUPPORT}
                    <button class="btn btn-success" name="btnUpgrade" type="button" style="margin-left: 15px;"><strong>{vtranslate('LBL_UPGRADE', $QUALIFIED_MODULE)}</strong></button>
                {/if}
            </div>
            <div class="control-group">
                <div><span>{vtranslate('LBL_HAVING_TROUBLE',$QUALIFIED_MODULE)}</span></div>
            </div>
            <div class="control-group">
                <ul style="padding-left: 10px;">
                    <li>{vtranslate('LBL_EMAIL',$QUALIFIED_MODULE)}: &nbsp;&nbsp;<a style="color: #0088cc; text-decoration:none;" href="mailto:Support@VTExperts.com">Support@VTExperts.com</a></li>
                    <li>{vtranslate('LBL_PHONE',$QUALIFIED_MODULE)}: &nbsp;&nbsp;<span>+1 (818) 495-5557</span></li>
                    <li>{vtranslate('LBL_CHAT',$QUALIFIED_MODULE)}: &nbsp;&nbsp;{vtranslate('LBL_AVAILABLE_ON',$QUALIFIED_MODULE)} <a style="color: #0088cc; text-decoration:none;" href="http://www.vtexperts.com" target="_blank">http://www.VTExperts.com</a></li>
                </ul>
            </div>
        </div>
    </div>
{/strip}