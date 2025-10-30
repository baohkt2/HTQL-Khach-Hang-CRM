<?php
/* Smarty version 4.5.5, created on 2025-10-09 08:09:02
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Reports\ChartReportContents.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e76d9eeb5766_33803812',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1f5d0a8ecc5f0df7ebc182dd713e22e55eb16d2d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Reports\\ChartReportContents.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e76d9eeb5766_33803812 (Smarty_Internal_Template $_smarty_tpl) {
?>
<input type='hidden' name='charttype' value="<?php echo $_smarty_tpl->tpl_vars['CHART_TYPE']->value;?>
" />
<input type='hidden' name='data' value='<?php echo Vtiger_Functions::jsonEncode($_smarty_tpl->tpl_vars['DATA']->value);?>
' />
<input type='hidden' name='clickthrough' value="<?php if ((isset($_smarty_tpl->tpl_vars['CLICK_THROUGH']->value))) {
echo $_smarty_tpl->tpl_vars['CLICK_THROUGH']->value;
}?>" />

<br>
<div class="dashboardWidgetContent">
    <input type="hidden" class="yAxisFieldType" value="<?php echo $_smarty_tpl->tpl_vars['YAXIS_FIELD_TYPE']->value;?>
" />
    <div class='border1px filterConditionContainer' style="padding:30px;">
    <div id='chartcontent' name='chartcontent' style="min-height:500px overflowY:'auto';" data-mode='Reports'></div>
        <br>
        <?php if (!(isset($_smarty_tpl->tpl_vars['CLICK_THROUGH']->value)) || $_smarty_tpl->tpl_vars['CLICK_THROUGH']->value != 'true') {?>
            <div class='row-fluid alert-info'>
                <span class='span alert-info' style="padding:10px;text-align:center">
                    <i class="icon-info-sign"></i>
                    <?php echo vtranslate('LBL_CLICK_THROUGH_NOT_AVAILABLE',$_smarty_tpl->tpl_vars['MODULE']->value);?>

                </span>
            </div>
            <br>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['REPORT_MODEL']->value->isInventoryModuleSelected()) {?>
            <div class="alert alert-info">
                <?php $_smarty_tpl->_assignInScope('BASE_CURRENCY_INFO', Vtiger_Util_Helper::getUserCurrencyInfo());?>
                <i class="icon-info-sign" style="margin-top: 1px;"></i>&nbsp;&nbsp;
                <?php echo vtranslate('LBL_CALCULATION_CONVERSION_MESSAGE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 - <?php echo $_smarty_tpl->tpl_vars['BASE_CURRENCY_INFO']->value['currency_name'];?>
 (<?php echo $_smarty_tpl->tpl_vars['BASE_CURRENCY_INFO']->value['currency_code'];?>
)
            </div>
        <?php }?>
    </div>
</div>
<br>

<?php }
}
