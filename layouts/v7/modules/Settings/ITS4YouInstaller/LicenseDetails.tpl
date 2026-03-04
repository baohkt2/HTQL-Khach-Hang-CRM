{*/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouInstaller license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */*}
{strip}
    <table class="table table-bordered table-condensed themeTableColor">
        <thead>
        <tr class="blockHeader">
            <th class="mediumWidthType" colspan="2">
                <span class="alignMiddle">{vtranslate('LBL_COMPANY_LICENSE_INFO', $QUALIFIED_MODULE)}</span>
            </th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td width="25%"><label class="muted pull-right marginRight10px">{vtranslate('organizationname', 'Settings:Vtiger')}:</label></td>
            <td style="border-left: none;">
                <div class="pull-left" id="organizationname_label">{$COMPANY_DETAILS->get("organizationname")}</div>
            </td>
        </tr>
        <tr>
            <td width="25%"><label class="muted pull-right marginRight10px">{vtranslate('address', 'Settings:Vtiger')}:</label></td>
            <td style="border-left: none;">
                <div class="pull-left" id="address_label">{$COMPANY_DETAILS->get("address")}</div>
            </td>
        </tr>
        <tr>
            <td width="25%"><label class="muted pull-right marginRight10px">{vtranslate('city', 'Settings:Vtiger')}:</label></td>
            <td style="border-left: none;">
                <div class="pull-left" id="city_label">{$COMPANY_DETAILS->get("city")}</div>
            </td>
        </tr>
        <tr>
            <td width="25%"><label class="muted pull-right marginRight10px">{vtranslate('state', 'Settings:Vtiger')}:</label></td>
            <td style="border-left: none;">
                <div class="pull-left" id="state_label">{$COMPANY_DETAILS->get("state")}</div>
            </td>
        </tr>
        <tr>
            <td width="25%"><label class="muted pull-right marginRight10px">{vtranslate('country', 'Settings:Vtiger')}:</label></td>
            <td style="border-left: none;">
                <div class="pull-left" id="country_label">{$COMPANY_DETAILS->get("country")}</div>
            </td>
        </tr>
        <tr>
            <td width="25%"><label class="muted pull-right marginRight10px">{vtranslate('code', 'Settings:Vtiger')}:</label></td>
            <td style="border-left: none;">
                <div class="pull-left" id="code_label">{$COMPANY_DETAILS->get("code")}</div>
            </td>
        </tr>
        <tr>
            <td width="25%"><label class="muted pull-right marginRight10px">{vtranslate('vatid', 'Settings:Vtiger')}:</label></td>
            <td style="border-left: none;">
                <div class="pull-left" id="vatid_label">{$COMPANY_DETAILS->get("vatid")}</div>
            </td>
        </tr>
        </tbody>
    </table>
    <button type="button" id="company_button" class="btn btn-info" onclick="window.location.href='index.php?module=Vtiger&parent=Settings&view=CompanyDetails'">
        {vtranslate('LBL_CHANGE_COMPANY_INFORMATION',$QUALIFIED_MODULE)}
    </button>
    <br>
    <br>
    {if $STEP eq ""}<label class="fieldLabel"><strong>{vtranslate('LBL_LICENSE_SETTINGS_INFO',$QUALIFIED_MODULE)}:</strong></label><br>{/if}
    <table class="table table-bordered table-condensed themeTableColor">
        <thead>
        <tr class="blockHeader">
            <th colspan="2" class="mediumWidthType">
                <span class="alignMiddle">{vtranslate('LBL_LICENSE', $QUALIFIED_MODULE)}</span>
            </th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td width="25%"><label class="muted pull-right marginRight10px">{vtranslate('LBL_URL', $QUALIFIED_MODULE)}:</label></td>
            <td style="border-left: none;">
                <div class="pull-left" id="vatid_label">{$URL}</div>
            </td>
        </tr>
        <tr class="license_due_date_tr" {if $LICENSE_DUE_DATE eq "" || $LICENSE eq ""}style="display: none"{/if}>
            <td width="25%"><label class="muted pull-right marginRight10px">{vtranslate('LBL_LICENSE_DUE_DATE', $QUALIFIED_MODULE)}:</label></td>
            <td style="border-left: none;">
                <div class="pull-left license_due_date_val" id="vatid_label">{$LICENSE_DUE_DATE}</div>
            </td>
        </tr>
        <tr>
            <td width="25%"><label class="muted pull-right marginRight10px">{vtranslate('LBL_LICENSE_KEY', $QUALIFIED_MODULE)}:</label></td>
            <td style="border-left: none;">
                {if $STEP neq ""}
                    <span class="displayInlineBlock">
                        <input type="text" class="input-large inputElement" value="{$LICENSE_KEY}" id="licensekey" name="licensekey" data-validation-engine="validate[required]"/>
                    </span>
                    &nbsp;&nbsp;
                    <button type="subbmit" id="validate_button" class="btn btn-success">
                        <strong>{vtranslate('LBL_VALIDATE',$QUALIFIED_MODULE)}</strong>
                    </button>&nbsp;&nbsp;
                    <button type="button" id="order_button" class="btn btn-info" onclick="window.location.href='http://www.its4you.sk/en/vtiger-shop.html'">
                        {vtranslate('LBL_ORDER_NOW',$QUALIFIED_MODULE)}
                    </button>
                {else}
                    <div class="pull-left" id="license_key_label">{$LICENSE}&nbsp;&nbsp;</div>
                    <div id="divgroup1" class="btn-group pull-left paddingLeft10px" {if $VERSION_TYPE eq "activated"}style="display:none"{/if}>
                        <button id="activate_license_btn" class="btn btn-success" title="{vtranslate('LBL_ACTIVATE_KEY_TITLE',$QUALIFIED_MODULE)}" type="button">
                            <strong>{vtranslate('LBL_ACTIVATE_KEY',$QUALIFIED_MODULE)}</strong></button>
                    </div>
                    <div id="divgroup2" class="pull-left paddingLeft10px" {if $VERSION_TYPE neq "activated"}style="display:none"{/if}>
                        <button id="deactivate_license_btn" type="button" class="btn btn-danger marginLeftZero">{vtranslate('LBL_DEACTIVATE',$QUALIFIED_MODULE)}</button>
                    </div>
                {/if}
            </td>
        </tr>
        </tbody>
    </table>
{/strip}