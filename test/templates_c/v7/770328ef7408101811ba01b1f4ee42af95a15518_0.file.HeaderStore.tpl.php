<?php
/* Smarty version 4.5.5, created on 2025-11-05 03:49:46
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\VTEStore\HeaderStore.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_690ac95a052ae7_03408807',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '770328ef7408101811ba01b1f4ee42af95a15518' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\VTEStore\\HeaderStore.tpl',
      1 => 1762118939,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690ac95a052ae7_03408807 (Smarty_Internal_Template $_smarty_tpl) {
?>
<table style="float: right;">
    <tr>
        <?php if ($_smarty_tpl->tpl_vars['CUSTOMERLOGINED']->value > 0) {?>
            <td style="padding-left: 5px;">
                <input type="hidden" id="customer_status" name="customer_status" value="<?php echo $_smarty_tpl->tpl_vars['CUSTOMER_STATUS']->value;?>
">
                <input type="hidden" id="customer_data" name="customer_data" value="<?php echo $_smarty_tpl->tpl_vars['CUSTOMER_DATA']->value;?>
">
                <input type="hidden" id="getChargifyInfo" name="getChargifyInfo" value="">
                <?php if ($_smarty_tpl->tpl_vars['CUSTOMER_STATUS']->value == 'trial_expired') {?>
                    <a href="javascript:void(0)" class="ManageSubscription"><font color="red"><strong><?php echo vtranslate('TRIAL_EXPIRED','VTEStore');?>
</strong></font></a>
                <?php } elseif ($_smarty_tpl->tpl_vars['CUSTOMER_STATUS']->value == 'no_subscription') {?>
                    <a href="javascript:void(0)" class="ManageSubscription"><font color="red"><strong><?php echo vtranslate('NO_SUBSCRIPTION','VTEStore');?>
 <?php echo $_smarty_tpl->tpl_vars['CUSTOMERDATA']->value['remain_date'];?>
 <?php echo vtranslate('days','VTEStore');?>
. <?php echo vtranslate('Please click here to sign up','VTEStore');?>
</strong></font> </a>
                <?php } elseif ($_smarty_tpl->tpl_vars['CUSTOMER_STATUS']->value == 'subscription_expired') {?>
                    <a href="javascript:void(0)" class="ManageSubscription"><font color="red"><strong><?php echo vtranslate('SUBSCRIPTION_EXPIRED','VTEStore');?>
</strong></font></a>
                <?php }?>
            </td>
        <?php }?>
        <td style="padding-left: 5px;">
            <a href="javascript:void(0);" onclick="window.open('https://v2.zopim.com/widget/livechat.html?&key=1P1qFzYLykyIVMZJPNrXdyBilLpj662a=en', '_blank', 'location=yes,height=600,width=500,scrollbars=yes,status=yes');"> <img src="layouts/v7/modules/VTEStore/resources/images/livechat.png"/></a>
        </td>

        <?php if ($_smarty_tpl->tpl_vars['WARNINGS']->value > 0 && $_smarty_tpl->tpl_vars['ERROR_NUM']->value == 0) {?>
            <td style="padding-left: 5px;"><button id="phpiniWarnings" name="phpiniWarnings" class="btn btn-danger" style="margin-right:5px;"><?php echo vtranslate('Warnings','VTEStore');?>
 (<?php echo $_smarty_tpl->tpl_vars['WARNINGS']->value;?>
)</button></td>
        <?php } elseif ($_smarty_tpl->tpl_vars['WARNINGS']->value == 0 && $_smarty_tpl->tpl_vars['ERROR_NUM']->value > 0) {?>
            <td style="padding-left: 5px;"><button id="phpiniWarnings" name="phpiniWarnings" class="btn btn-danger" style="margin-right:5px;"><?php echo vtranslate('Errors','VTEStore');?>
 (<?php echo $_smarty_tpl->tpl_vars['ERROR_NUM']->value;?>
)</button></td>
        <?php } elseif ($_smarty_tpl->tpl_vars['WARNINGS']->value > 0 && $_smarty_tpl->tpl_vars['ERROR_NUM']->value > 0) {?>
            <td style="padding-left: 5px;"><button id="phpiniWarnings" name="phpiniWarnings" class="btn btn-danger" style="margin-right:5px;"><?php echo vtranslate('Warnings','VTEStore');?>
 (<?php echo $_smarty_tpl->tpl_vars['WARNINGS']->value;?>
) <?php echo vtranslate('Errors','VTEStore');?>
 (<?php echo $_smarty_tpl->tpl_vars['ERROR_NUM']->value;?>
)</button></td>
        <?php }?>
        
        <td style="padding-left: 5px;"><button id="FaqLink" name="FaqLink" class="btn btn-warning VTEStoreFAQ"><?php echo vtranslate('FAQ','VTEStore');?>
</button></td>
        <?php if ($_smarty_tpl->tpl_vars['CUSTOMERLOGINED']->value > 0) {?>
            <td style="padding-left: 5px;"><button id="MyAccountLink" name="MyAccountLink" class="btn btn-success"><?php echo vtranslate('LBL_MY_ACCOUNT','VTEStore');?>
</button></td>
                    <?php } else { ?>
            <td style="padding-left: 5px;"><button id="logintoVTEStore" class="btn btn-primary"><?php echo vtranslate('LBL_LOGIN_TO_VTE_STORE','VTEStore');?>
</button></td>
        <?php }?>
    </tr>
</table><?php }
}
