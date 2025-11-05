<?php
/* Smarty version 4.5.5, created on 2025-11-05 03:49:48
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\VTEStore\ManageSubscription.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690ac95c8bde33_01853134',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '249ccd5f841da816b2363c9544a7b44fc279d0f3' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\VTEStore\\ManageSubscription.tpl',
      1 => 1762118939,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690ac95c8bde33_01853134 (Smarty_Internal_Template $_smarty_tpl) {
?><div class='modal-dialog'>
    <div class='modal-content'>
        <div class="modal-header contentsBackground">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" <?php if ($_smarty_tpl->tpl_vars['CHARGIFY_CUSTOMER_ID']->value == 0 || $_smarty_tpl->tpl_vars['CHARGIFY_CUSTOMER_ID']->value == '') {?>onclick="app.helper.showSuccessNotification({message: app.vtranslate('JS_PLEASE_WAIT')}); reloadCurrentPage();"<?php }?>><span aria-hidden="true" class='fa fa-close'></span></button>
            <h3><?php echo vtranslate('LBL_MY_ACCOUNT','VTEStore');?>
</h3>
            <input type="hidden" id="vtiger_url" name="vtiger_url" value="">
        </div>
        <div align="center">
        <?php if ($_smarty_tpl->tpl_vars['CHARGIFY_CUSTOMER_ID']->value > 0) {?>
            <div align="left" style="padding: 20px;">
                <br>For security purposes subscription & payment details reside on another secure portal. Subscription portal will allow you to:<br><br>
                <ul>
                    <li>Update payment method.</li>
                    <li>Download invoices & statements.</li>
                    <li>View payment history.</li>
                    <li>Update billing information.</li>
                    <li>Cancel or adjust subscription.</li>
                </ul>
                <br><h3><u><a href="<?php echo $_smarty_tpl->tpl_vars['PORTALURL']->value;?>
" target="_blank">Please click here to manage subscription</a></u></h3>
                <br><br><i> If it's your first time accessing the portal - you will be asked to set a password. Note, this is a password to manage your subscription. </i>
                <br><br>For any questions please call us at +1 (818) 495-5557 or send us an email at support@vtexperts.com
            </div>
        <?php } else { ?>
                    <?php }?>
        </div>
        <div class="modal-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <a class="cancelLink" type="reset" data-dismiss="modal" <?php if ($_smarty_tpl->tpl_vars['CHARGIFY_CUSTOMER_ID']->value == 0 || $_smarty_tpl->tpl_vars['CHARGIFY_CUSTOMER_ID']->value == '') {?>onclick="app.helper.showSuccessNotification({message: app.vtranslate('JS_PLEASE_WAIT')}); reloadCurrentPage();"<?php }?>><strong><?php echo vtranslate('LBL_CLOSE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></a>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

<?php echo '<script'; ?>
>
    function reloadCurrentPage(){
        var url = window.location.href;
        if(url.indexOf('getChargifyInfo')!=-1){
            var urlReload=url;
        }else{
            var urlReload=url+'&getChargifyInfo=1';
        }

        window.location.href = urlReload;
    }
<?php echo '</script'; ?>
>

<?php }
}
