{*/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouInstaller license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */*}
{strip}
    <div class="tab-pane active" id="installedModules">
        {if $ERROR_MESSAGES}
            <div class="col-md-12">
                {foreach from=$ERROR_MESSAGES item=ERROR_MESSAGE}
                    <div>
                        <div class="displayInlineBlock alert alert-danger">{vtranslate($ERROR_MESSAGE, $QUALIFIED_MODULE)}</div>
                    </div>
                {/foreach}
            </div>
        {elseif !$IS_AUTH}
            <div style="text-align: center;">
                <a href="index.php?module=ITS4YouInstaller&parent=Settings&view=Login">
                    <div class="alert alert-danger displayInlineBlock extensionLoginAlert">{vtranslate('LBL_LOGIN_TO_INSTALLER', $QUALIFIED_MODULE)}</div>
                </a>
                <br>
            </div>
        {else}
            <div class="col-md-12">
                <h4>{vtranslate('LBL_ACTIVATED_LICENSES', $QUALIFIED_MODULE)}</h4>
                <hr>
                <div>
                    <button class="btn btn-primary activateButton" type="button">
                    <i class="fa fa-plus"></i>&nbsp;&nbsp;
                    <div class="displayInlineBlock">{vtranslate('LBL_ACTIVATE',$QUALIFIED_MODULE)} {vtranslate('LBL_LICENSE_KEY',$QUALIFIED_MODULE)}</div>
                </button>
                &nbsp;&nbsp;
                <button class="btn btn-default updateButton" type="button">
                    <i class="fa fa-refresh"></i>&nbsp;&nbsp;
                    <div class="displayInlineBlock">{vtranslate('LBL_UPDATE_LICENSES',$QUALIFIED_MODULE)}</div>
                </button>
            </div>
            <br>
            <table class="table table-bordered licenseTable">
                <thead>
                <tr>
                    <th>{vtranslate('LBL_LICENSE_KEY', $QUALIFIED_MODULE)}</th>
                    <th>{vtranslate('LBL_LICENSE_NAME', $QUALIFIED_MODULE)}</th>
                    <th>{vtranslate('LBL_LICENSE_DUE_DATE', $QUALIFIED_MODULE)}</th>
                    <th>{vtranslate('LBL_LICENSE_TYPE', $QUALIFIED_MODULE)}</th>
                    <th>{vtranslate('LBL_ACTION', $QUALIFIED_MODULE)}</th>
                </tr>
                </thead>
                <tbody>
                {foreach key=LICENSE_KEY item=LICENSE from=$LICENSES_LIST}
                    {if !$LICENSE}{continue}{/if}
                    {include file="rows/License.tpl"|vtemplate_path:$QUALIFIED_MODULE}
                {/foreach}
                {if !empty($EMPTY_LICENSES)}
                    <tr>
                        <td style="border-left:none;border-right:none;" colspan="4">
                            {foreach item=EMPTY_LICENSE from=$EMPTY_LICENSES}
                                <div>{$EMPTY_LICENSE}</div>
                                <br>
                            {/foreach}
                        </td>
                        <td style="border-left:none;border-right:none;" title="{vtranslate('LBL_EMPTY_LICENSES_MESSAGE', $QUALIFIED_MODULE)}">
                            <form action="index.php" method="post">
                                <input type="hidden" name="module" value="{$MODULE}">
                                <input type="hidden" name="parent" value="Settings">
                                <input type="hidden" name="action" value="Basic">
                                <input type="hidden" name="mode" value="clearEmptyLicenses">
                                <button class="btn btn-warning">{vtranslate('LBL_EMPTY_LICENSES_BUTTON', $QUALIFIED_MODULE)}</>
                            </form>
                        </td>
                    </tr>
                {/if}
                </tbody>
            </table>
        </div>
            {if $HOSTING_MODEL}
                <div class="col-md-12">
                    <h4>{vtranslate('LBL_HOSTING', $QUALIFIED_MODULE)}</h4>
                    <hr>
                    <table class="table table-bordered hostingTable">
                        <thead>
                        <tr>
                            {foreach from=$HOSTING_MODEL->getHeaders() key=HOSTING_FIELD item=HOSTING_HEADER}
                                <th>{vtranslate($HOSTING_HEADER, $QUALIFIED_MODULE)}</th>
                            {/foreach}
                            <th>{vtranslate('LBL_ACTION', $QUALIFIED_MODULE)}</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                {foreach from=$HOSTING_MODEL->getHeaders() key=HOSTING_FIELD item=HOSTING_HEADER}
                                    <td>{$HOSTING_MODEL->get($HOSTING_FIELD)}</td>
                                {/foreach}
                                <td>
                                    <div class="pull-right">
                                        {if $HOSTING_MODEL->isExpired()}
                                            <div class="alert alert-danger displayInlineBlock" style="margin:0;">{vtranslate('LBL_HOSTING_INACTIVE', $QUALIFIED_MODULE)}</div>
                                        {else}
                                            <div class="alert alert-info displayInlineBlock" style="margin:0;">{vtranslate('LBL_HOSTING_ACTIVE', $QUALIFIED_MODULE)}{$HOSTING_MODEL->getExpireString()}</div>
                                        {/if}
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            {/if}
        {/if}
        <div class="col-md-12">
            <div>
                <h4>{vtranslate('LBL_MODULES', $QUALIFIED_MODULE)}</h4>
                <hr>
                <div class="clearfix">
                    <label class="pull-left searchModuleContainer">
                        <i class="fa fa-search"></i>
                        <input type="text" class="inputElement searchModule" placeholder="{vtranslate('LBL_SEARCH_MODULES', $QUALIFIED_MODULE)}">
                    </label>
                </div>
                <table class="table table-bordered extensionsTable">
                    <thead>
                    <tr>
                        <th style="width: 30%;">{vtranslate('Name', $QUALIFIED_MODULE)}</th>
                        <th style="width: 10%;">{vtranslate('LBL_INSTALLED_VERSION', $QUALIFIED_MODULE)}</th>
                        <th style="width: 10%;">{vtranslate('LBL_UPDATE_DATETIME', $QUALIFIED_MODULE)}</th>
                        <th style="width: 10%;">{vtranslate('LBL_NEWEST_VERSION', $QUALIFIED_MODULE)}</th>
                        <th>{vtranslate('LBL_ACTION', $QUALIFIED_MODULE)}</th>
                    </tr>
                    </thead>
                    <tbody>
                        {foreach item=EXTENSION from=$EXTENSIONS_LIST}
                            {if !$EXTENSION->isVisible()}{continue}{/if}
                            {if $EXTENSION->isMultiPackage()}
                                {include file="rows/Package.tpl"|vtemplate_path:$QUALIFIED_MODULE}
                            {else}
                                {include file="rows/Extension.tpl"|vtemplate_path:$QUALIFIED_MODULE}
                            {/if}
                        {/foreach}
                    </tbody>
                </table>
            </div>
            <div>
                <h4>{vtranslate('LBL_AVAILABLE_LANGUAGES', $QUALIFIED_MODULE)}</h4>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 30%;">{vtranslate('LBL_LANGUAGE_NAME', $QUALIFIED_MODULE)}</th>
                        <th style="width: 30%;" colspan="2">{vtranslate('LBL_DESCRIPTION', $QUALIFIED_MODULE)}</th>
                        <th>{vtranslate('LBL_ACTION', $QUALIFIED_MODULE)}</th>
                    </tr>
                    </thead>
                    <tbody>
                        {foreach item=LANGUAGE from=$LANGUAGES_LIST name=languages}
                            {include file="rows/Language.tpl"|vtemplate_path:$QUALIFIED_MODULE}
                        {/foreach}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
{/strip}