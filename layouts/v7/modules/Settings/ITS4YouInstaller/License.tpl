{*<!--
/*********************************************************************************
 * The content of this file is subject to the ITS4YouInstaller license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
********************************************************************************/
-->*}
{strip}
    <div id="licenseContainer" style="padding: 15px; background: #fff;">
        <div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <h3>{vtranslate('LBL_MODULE_NAME', $QUALIFIED_MODULE)} {vtranslate('LBL_LICENSE', $QUALIFIED_MODULE)}</h3>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <br>
                    <table class="table table-bordered table-condensed themeTableColor">
                        <thead>
                            <tr class="blockHeader">
                                <th colspan="2" class="mediumWidthType">
                                    <span class="alignMiddle">{vtranslate('LBL_MODULE_NAME', $QUALIFIED_MODULE)} {vtranslate('LBL_LICENSE', $QUALIFIED_MODULE)}</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 25%"><label class="muted pull-right marginRight10px">{vtranslate('LBL_MODULE', $QUALIFIED_MODULE)}</label></td>
                                <td style="border-left: none;">
                                    <div class="pull-left" id="vatid_label">
                                        <a href="{$MODULE_MODEL->getDefaultUrl()}">{vtranslate('LBL_MODULE_NAME', $QUALIFIED_MODULE)}</a>
                                    </div>
                                </td>
                            </tr>
                            {if $VERSION}
                                <tr>
                                    <td>
                                        <label class="muted pull-right marginRight10px">
                                            {vtranslate('LBL_MODULE', $MODULE)} {vtranslate('LBL_VERSION', $MODULE)}
                                        </label>
                                    </td>
                                    <td>{$VERSION}</td>
                                </tr>
                            {/if}
                            <tr>
                                <td>
                                    <label class="muted pull-right marginRight10px">
                                        {vtranslate('Vtiger', $MODULE)} {vtranslate('LBL_VERSION', $MODULE)}
                                    </label>
                                </td>
                                <td>{Vtiger_Version::current()}</td>
                            </tr>
                            <tr>
                                <td style="width: 25%"><label class="muted pull-right marginRight10px">{vtranslate('LBL_URL', $QUALIFIED_MODULE)}</label></td>
                                <td style="border-left: none;">
                                    <div class="pull-left" id="vatid_label">{$URL}</div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%"><label class="muted pull-right marginRight10px">{vtranslate('LBL_DESCRIPTION',$QUALIFIED_MODULE)}</label></td>
                                <td style="border-left: none;">
                                    <div class="clearfix">
                                        {foreach item=ERROR from=$ERRORS}
                                            <div>
                                                <div class="alert alert-danger displayInlineBlock">{vtranslate($ERROR, $QUALIFIED_MODULE)}</div>
                                            </div>
                                        {/foreach}
                                        {foreach item=I from=$INFO}
                                            <div>
                                                <div class="alert alert-warning displayInlineBlock">
                                                    {vtranslate($I, 'Settings:ITS4YouInstaller')}
                                                </div>
                                            </div>
                                        {/foreach}
                                        {if empty($INFO) && empty($ERRORS)}
                                            {if $IS_ALLOWED}
                                                <div class="alert alert-info displayInlineBlock">
                                                    {vtranslate('LBL_LICENSE_ACTIVE',$QUALIFIED_MODULE)}
                                                </div>
                                            {else}
                                                <div class="alert alert-danger displayInlineBlock">
                                                    {vtranslate('LBL_LICENSE_INACTIVE',$QUALIFIED_MODULE)}
                                                </div>
                                            {/if}
                                        {/if}
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div style="text-align: center">
                        {if $INSTALLER_MODEL}
                            <a href="{$INSTALLER_MODEL->getDefaultUrl()}" target="_blank" class="btn btn-primary">
                                {vtranslate('LBL_LICENSE_MANAGE','Settings:ITS4YouInstaller')}
                            </a>
                        {else}
                            <a target="_blank" href="https://www.its4you.sk/en/vtiger-shop" class="btn btn-danger" type="button">{vtranslate('LBL_DOWNLOAD_INSTALLER', $QUALIFIED_MODULE)}</a>
                        {/if}
                    </div>
                </div>
            </div>
        </div>
    </div>
{/strip}