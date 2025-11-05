{if $SHOWHTML}
<div id="globalmodal">
    <div id="massEditContainer" class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header contentsBackground">
                <button aria-hidden="true" class="close " data-dismiss="modal" type="button"><span aria-hidden="true" class='fa fa-close'></span></button>
                <h4>{vtranslate('LBL_LOGIN_TO_VTE_STORE', 'VTEStore')}</h4>
            </div>
            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: auto;">
                <form class="form-horizontal" id="frmChangeUrl">
                    <input type="hidden" name="module" value="VTEStore">
                    <input type="hidden" name="parent" value="Settings">
                    <input type="hidden" name="action" value="ActionAjax">
                    <input type="hidden" name="mode" value="changeUrl">
                    <input type="hidden" name="c_id" value="{$C_ID}">
                    <input type="hidden" name="old_url" value="{$OLD_URL}">
                    <input type="hidden" name="new_url" value="{$SITE_URL}">
                    <div name="massEditContent" style="overflow: hidden; width: auto; height: auto;">
                        <div class="modal-body">
                            <p>{vtranslate('TXT_CHANGE_URL_OUR_RECORD_INDICATE', 'VTEStore')}</p>
                            <ul>
                                <li>{vtranslate('TXT_CHANGE_URL_VTIGER_WAS_MOVED', 'VTEStore')}</li>
                                <li>{vtranslate('TXT_CHANGE_URL_CHANGED_IN_CONFIG', 'VTEStore')}</li>
                                <li>{vtranslate('TXT_CHANGE_URL_ACCOUNT_IS_BEING_TRANSFERRED', 'VTEStore')}</li>
                            </ul>
                            <p>
                                {vtranslate('TXT_CHANGE_URL_IN_ORDER_TO_LOGIN', 'VTEStore')}
                                <br />
                                <ul>
                                    <li>{vtranslate('TXT_CHANGE_URL_ACCOUNT_CURRENTLY_ASSOCIATED_WITH', 'VTEStore')}: {$OLD_URL}</li>
                                    <li>{vtranslate('TXT_CHANGE_URL_ACCOUNT_WILL_BE_MOVED', 'VTEStore')}: <b>{$SITE_URL}</b></li>
                                </ul>
                                {vtranslate('TXT_CHANGE_URL_PLEASE_AGREE', 'VTEStore')}
                            </p>
                            
                            <div class="text-center">
                                <label>
                                    <span style="color: red">*&nbsp;</span>
                                    <input type="checkbox" name="confirm" id="chkConfirm" />
                                    <b>{vtranslate('TXT_CHANGE_URL_PLEASE_MOVE_MY_ACCOUNT', 'VTEStore')}</b>
                                </label><br />
                                <div style="width: 200px;display: inline-block;">
                                    {$CAPTCHADATA}
                                </div><br />
                                <div class="redColor error_content"></div>
                                <br />
                                <button class="btn btn-success" type="submit" id="btnChangeUrl" name="btnChangeUrl"><strong>{vtranslate('LBL_SUBMIT', 'VTEStore')}</strong></button>
                            </div>
                            <br />
                            <ul>
                                <li>{vtranslate('TXT_CHANGE_URL_YOU_CAN_ONLY_MOVE', 'VTEStore')}</li>
                                <li>{vtranslate('TXT_CHANGE_URL_ONCE_THE_ACCOUNT_IS_MOVED', 'VTEStore')}</li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{/if}