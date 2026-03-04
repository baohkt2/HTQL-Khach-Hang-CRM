{* ********************************************************************************
 * The content of this file is subject to the ITS4YouInstaller license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** *}
{strip}
    <div class="listViewPageDiv detailViewContainer" id="requirementsContents">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
            <div id="listview-actions" class="listview-actions-container">
                <div class="contents">
                    <br>
                    <div>
                        <h4>{vtranslate('LBL_PHP_REQUIREMENTS', $QUALIFIED_MODULE)}:</h4>
                        <table class="table border1px reqTable">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>{vtranslate('LBL_CURRENT_VALUE', $QUALIFIED_MODULE)}</th>
                                    <th>{vtranslate('LBL_MINIMUM_REQ', $QUALIFIED_MODULE)}</th>
                                    <th>{vtranslate('LBL_RECOMMENDED_REQ', $QUALIFIED_MODULE)}</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach from=$REQUIREMENTS->getPHPSettings() key=NAME item=DATA}
                                    <tr class="{$DATA['error']}Error {$DATA['warning']}Warning">
                                        <td><b>{vtranslate($NAME, $QUALIFIED_MODULE)}</b> {if $DATA['info']}({vtranslate($DATA['info'], $QUALIFIED_MODULE)}){/if}</td>
                                        <td>{$DATA['current']}</td>
                                        <td>{$DATA['minimum']}</td>
                                        <td>{$DATA['recommended']}</td>
                                    </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div>
                        <h4>{vtranslate('LBL_DB_REQUIREMENTS', $QUALIFIED_MODULE)}:</h4>
                        <table class="table border1px reqTable">
                            <thead>
                            <tr>
                                <th></th>
                                <th>{vtranslate('LBL_CURRENT_VALUE', $QUALIFIED_MODULE)}</th>
                                <th>{vtranslate('LBL_RECOMMENDED_DESCRIPTION', $QUALIFIED_MODULE)}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                {foreach from=$REQUIREMENTS->getDBSettings() key=NAME item=DATA}
                                    <tr class="{$DATA['error']}Error {$DATA['warning']}Warning">
                                        <td><b>{vtranslate($NAME, $QUALIFIED_MODULE)}</b> {if $DATA['info']}({vtranslate($DATA['info'], $QUALIFIED_MODULE)}){/if}</td>
                                        <td>{$DATA['current']}</td>
                                        <td>
                                            {vtranslate($DATA['recommended_description'], $QUALIFIED_MODULE)}
                                        </td>
                                        <td></td>
                                    </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div>
                        <h4>{vtranslate('LBL_FILE_REQUIREMENTS', $QUALIFIED_MODULE)}:</h4>
                        <div class="clearfix">
                            <a class="btn btn-default" href="index.php?module=ITS4YouInstaller&parent=Settings&view=Requirements&scan=SubFolders">
                                {vtranslate('LBL_SCAN_SUB_FOLDERS', $QUALIFIED_MODULE)}
                            </a>
                        </div>
                        <br>
                        <table class="table border1px reqTable">
                            <thead>
                            <tr>
                                <th>{vtranslate('LBL_FILE_FOLDER', $QUALIFIED_MODULE)}</th>
                                <th>{vtranslate('LBL_CURRENT_VALUE_WRITABLE', $QUALIFIED_MODULE)}</th>
                            </tr>
                            </thead>
                            <tbody>
                            {foreach from=$REQUIREMENTS->getFilePermissions() key=NAME item=DATA}
                                <tr class="{$DATA['error']}Error {$DATA['warning']}Warning">
                                    <td><b>{vtranslate($NAME, $QUALIFIED_MODULE)}</b> {if $DATA['info']}({vtranslate($DATA['info'], $QUALIFIED_MODULE)}){/if}</td>
                                    <td>{$DATA['current']}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            {/foreach}
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div>
                        <h4>{vtranslate('LBL_USER_REQUIREMENTS', $QUALIFIED_MODULE)}:</h4>
                        <table class="table border1px reqTable">
                            <thead>
                            <tr>
                                <th></th>
                                <th>{vtranslate('LBL_CURRENT_VALUE_ERROR', $QUALIFIED_MODULE)}</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                {foreach from=$REQUIREMENTS->getUserSettings() key=NAME item=DATA}
                                    <tr class="{$DATA['error']}Error {$DATA['warning']}Warning">
                                        <td><b>{vtranslate($NAME, $QUALIFIED_MODULE)}</b> {if $DATA['info']}({vtranslate($DATA['info'], $QUALIFIED_MODULE)}){/if}</td>
                                        <td>{$DATA['current']}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
{/strip}
