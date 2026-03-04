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
                    <div class="requirements-container">
                    {if $REQUIREMENTS}
                        <h5><b>{vtranslate('LBL_REQUIREMENTS_FOR', $QUALIFIED_MODULE)} {$REQUIREMENTS->getModuleLabel()}</b></h5>
                        <hr>
                        {foreach from=$REQUIREMENT_VALIDATIONS item=VALIDATION}
                            <div>
                                {assign var=HEADERS value=$REQUIREMENTS->getHeaders($VALIDATION['type'])}
                                <h5>{vtranslate($VALIDATION['label'], $QUALIFIED_MODULE)}</h5>
                                <table class="table border1px requirements-table">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        {foreach from=$HEADERS key=HEADER_LABEL item=HEADER_NAME}
                                            <th class="header-{$HEADER_NAME}">{vtranslate($HEADER_LABEL, $QUALIFIED_MODULE)}</th>
                                        {/foreach}
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {foreach from=$REQUIREMENTS->getDataFromFunction($VALIDATION['function']) item=REQUIREMENTS_DATA}
                                        <tr class="{if $REQUIREMENTS_DATA['validate']} noError {else} yesError {/if}">
                                            <td>
                                                {if $REQUIREMENTS_DATA['validate']}
                                                    <i class="fa fa-check"></i>
                                                {else}
                                                    <i class="fa fa-times"></i>
                                                {/if}
                                            </td>
                                            {foreach from=$HEADERS key=HEADER_LABEL item=HEADER_NAME}
                                                <td class="custom-link-{$HEADER_NAME}">{$REQUIREMENTS_DATA[$HEADER_NAME]}</td>
                                            {/foreach}
                                            <td>
                                                {vtranslate($REQUIREMENTS_DATA['validate_message'], $QUALIFIED_MODULE)}
                                            </td>
                                        </tr>
                                        {foreachelse}
                                        <tr>
                                            <td colspan="{count($HEADERS) + 2}">
                                                {vtranslate('LBL_NO_RECORDS', $QUALIFIED_MODULE)}
                                            </td>
                                        </tr>
                                    {/foreach}
                                    </tbody>
                                </table>
                            </div>
                        {/foreach}
                    {/if}
                    </div>
                </div>
            </div>
        </div>
    </div>
{/strip}
