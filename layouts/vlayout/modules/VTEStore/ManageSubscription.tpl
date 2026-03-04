<div class="modal-header contentsBackground">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" {if $CHARGIFY_CUSTOMER_ID==0 || $CHARGIFY_CUSTOMER_ID==''}onclick="Vtiger_Helper_Js.showMessage(app.vtranslate('JS_PLEASE_WAIT'));reloadCurrentPage();"{/if}>&times;</button>
    <h3>{vtranslate('LBL_MY_ACCOUNT', 'VTEStore')}</h3>
    <input type="hidden" id="vtiger_url" name="vtiger_url" value="">
</div>
<div align="center">
{if $CHARGIFY_CUSTOMER_ID>0}
    <div align="left" style="padding: 20px;">
        <br>For security purposes subscription & payment details reside on another secure portal. Subscription portal will allow you to:<br><br>
        <ul>
            <li>Update payment method.</li>
            <li>Download invoices & statements.</li>
            <li>View payment history.</li>
            <li>Update billing information.</li>
            <li>Cancel or adjust subscription.</li>
        </ul>
        <br><a href="{$PORTALURL}" target="_blank" data-dismiss="modal" aria-hidden="true"><h3><u>Please click here to manage subscription</u></h3></a>
        <br><br><i> If it's your first time accessing the portal - you will be asked to set a password. Note, this is a password to manage your subscription. </i>
        <br><br>For any questions please call us at +1 (818) 495-5557 or send us an email at support@vtexperts.com
    </div>
{else}
    {*<iframe src="https://vte-sandbox.chargifypay.com/subscribe/zc5436yw28g8/extensions{$CUSTOMER_DATA}" width="99%" height="600px" id="ifchargify"></iframe>*}
{/if}
</div>
<div class="modal-footer">
    <div class="row-fluid">
        <div class="span6"></div>
        <div class="span6">
            <div class="pull-right">
                <div class="pull-right cancelLinkContainer" style="margin-top:0px;">
                    <a class="cancelLink" type="reset" data-dismiss="modal" {if $CHARGIFY_CUSTOMER_ID==0 || $CHARGIFY_CUSTOMER_ID==''}onclick="Vtiger_Helper_Js.showMessage(app.vtranslate('JS_PLEASE_WAIT')); reloadCurrentPage();"{/if}><strong>{vtranslate('LBL_CLOSE', $MODULE)}</strong></a>
                </div>
            </div>
        </div>
    </div>
</div>
{literal}
<script>
    function reloadCurrentPage(){
        var url = window.location.href;
        if(url.indexOf('getChargifyInfo')!=-1){
            var urlReload=url;
        }else{
            var urlReload=url+'&getChargifyInfo=1';
        }

        window.location.href = urlReload;
    }
</script>
{/literal}
