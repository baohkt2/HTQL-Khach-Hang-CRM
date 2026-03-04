{*+***********************************************************************************
* The contents of this file are subject to the vtiger CRM Public License Version 1.0
* ("License"); You may not use this file except in compliance with the License
* The Original Code is:  vtiger CRM Open Source
* The Initial Developer of the Original Code is vtiger.
* Portions created by vtiger are Copyright (C) vtiger.
* All Rights Reserved.
*************************************************************************************}
{strip}
    <div class="editContainer" style="padding-left: 3%;padding-right: 3%; text-align: center;">
        <h3>
            {vtranslate('Extension Pack Engine Update Required',$QUALIFIED_MODULE)}
        </h3>
        <hr>
        <div class="clearfix"></div>
    </div>
    <div class="workFlowContents" style="padding-left: 3%;padding-right: 3%">
        <div class="padding1per" style="padding: 1% 10% 1% 10%;">
            <div class="control-group">
                <div><span>{vtranslate('Update_Text',$QUALIFIED_MODULE)}</span></div>
            </div>

            <br><br><br>
            <table style="width: 100%">
                <tr>
                    <td></td>
                    <td style="width: 350px;">
                        <div style=""><button style="text-align: center; width: 250px;" id="UpgradeVTEStore" class="btn btn-success UpgradeVTEStore" data-message="{vtranslate('LBL_MESSAGE_UPGRAGE_VTE_STORE_TO_LASTEST', 'VTEStore')}" data-svn="lastest"><strong>{vtranslate('Continue', 'VTEStore')}</strong></button></span></div>
                        <br><br>
                        <div><span>{vtranslate('LBL_HAVE_TROUBLE',$QUALIFIED_MODULE)} {vtranslate('LBL_CONTACT_US',$QUALIFIED_MODULE)}</span></div>
                        <ul style="padding-left: 10px;">
                            <li>{vtranslate('LBL_EMAIL',$QUALIFIED_MODULE)}: &nbsp;&nbsp;<a href="mailto:help@vtexperts.com">help@vtexperts.com</a></li>
                            <li>{vtranslate('LBL_PHONE',$QUALIFIED_MODULE)}: &nbsp;&nbsp;<span>+1 (818) 495-5557</span></li>
                            <li>{vtranslate('LBL_CHAT',$QUALIFIED_MODULE)}: &nbsp;&nbsp;{vtranslate('LBL_AVAILABLE_ON',$QUALIFIED_MODULE)} <a href="https://www.vtexperts.com" target="_blank">https://www.vtexperts.com</a></li>
                        </ul>
                    </td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
{/strip}