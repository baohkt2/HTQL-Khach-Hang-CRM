{*/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouInstaller license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */*}
{strip}
    <div id="choseLicense" class='modal-dialog'>
        <div class="modal-content">
            <style>
                .choseLicense:hover {
                    background: #eee;
                }
            </style>
            {assign var=HEADER_TITLE value={vtranslate('LBL_CHOSE_LICENSE', $QUALIFIED_MODULE)}}
            {include file="ModalHeader.tpl"|vtemplate_path:$MODULE TITLE=$HEADER_TITLE}
            <form method="POST">
                <input type="hidden" name="sourceModule" value="{$SOURCE_MODULE}">
                <input type="hidden" name="service" value="{$SERVICE}">
                <div class="modal-body">
                <table class="table border1px">
                    <thead>
                        <tr>
                            <th>{vtranslate('LBL_LICENSE', $QUALIFIED_MODULE)}</th>
                            <th>{vtranslate('LBL_LICENSE_TYPE', $QUALIFIED_MODULE)}</th>
                            <th>{vtranslate('LBL_LICENSE_DEMO', $QUALIFIED_MODULE)}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach from=$LICENSES item=LICENSE}
                            <tr class="choseLicense pointerCursorOnHover" data-license="{$LICENSE.licence}">
                                <td>{$LICENSE.licence}</td>
                                <td>{vtranslate($LICENSE.service_usageunit, $QUALIFIED_MODULE)}</td>
                                <td>{if $LICENSE.demo_free}Yes{else}No{/if}</td>
                                <td>
                                    <div class="pull-right">
                                        <a class="btn btn-success" href="#">{vtranslate('Select', $QUALIFIED_MODULE)}</a>
                                    </div>
                                </td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
                </div>
                <div class="modal-footer">
                    <div style="text-align: center;">
                        <a href="#" class="cancelLink" type="reset" data-dismiss="modal">{vtranslate('LBL_CANCEL', $QUALIFIED_MODULE)}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
{/strip}