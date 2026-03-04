{*<!--
/*********************************************************************************
* The content of this file is subject to the ITS4YouInstaller
* ("License"); You may not use this file except in compliance with the License
* The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
* Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
* All Rights Reserved.
********************************************************************************/
-->*}
{strip}
    <div class="uninstallContainer" id="Uninstall_{$MODULE}_Container" style="padding: 15px; background: #fff;">
        <form name="profiles_privilegies" action="index.php" method="post" class="form-horizontal">
            <input type="hidden" name="module" value="ITS4YouInstaller" />
            <input type="hidden" name="view" value="Uninstall" />
            <input type="hidden" name="license_key_val" id="license_key_val" value="{$LICENSE}" />
            <input type="hidden" id="sourceModule" name="source_module" value="{$MODULE}">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <h3>{vtranslate($MODULE, $MODULE)} {vtranslate('LBL_UNINSTALL',$QUALIFIED_MODULE)}</h3>
                    <hr>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <table class="table table-bordered table-condensed themeTableColor">
                        <thead>
                        <tr class="blockHeader">
                            <th class="mediumWidthType" colspan="2">
                                <span class="alignMiddle">{vtranslate($MODULE, $MODULE)} {vtranslate('LBL_UNINSTALL', $QUALIFIED_MODULE)}</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <label class="muted pull-right marginRight10px">
                                    {vtranslate('LBL_MODULE', $MODULE)}
                                </label>
                            </td>
                            <td>{vtranslate($MODULE, $MODULE)}</td>
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
                                <div class="pull-left" id="vatid_label">{vglobal('site_URL')}</div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="muted pull-right marginRight10px">
                                    {vtranslate('LBL_DESCRIPTION', $MODULE)}
                                </label>
                            </td>
                            <td>
                                <div class="clearfix">
                                    <div class="alert alert-danger displayInlineBlock">
                                        {vtranslate('LBL_UNINSTALL_DESC',$QUALIFIED_MODULE)}
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="textAlignCenter">
                        <button id="ITS4YouUninstall_btn" type="button" class="btn btn-danger marginLeftZero">{vtranslate('LBL_UNINSTALL',$QUALIFIED_MODULE)}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
{/strip}