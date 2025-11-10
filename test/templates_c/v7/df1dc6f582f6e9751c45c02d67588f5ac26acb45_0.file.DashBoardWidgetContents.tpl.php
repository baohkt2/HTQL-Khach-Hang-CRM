<?php
/* Smarty version 4.5.5, created on 2025-11-09 19:02:13
  from 'C:\xampp\htdocs\cusc\layouts\v7\modules\Vtiger\dashboards\DashBoardWidgetContents.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_6910e535bb7ab3_31000745',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'df1dc6f582f6e9751c45c02d67588f5ac26acb45' => 
    array (
      0 => 'C:\\xampp\\htdocs\\cusc\\layouts\\v7\\modules\\Vtiger\\dashboards\\DashBoardWidgetContents.tpl',
      1 => 1762713639,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6910e535bb7ab3_31000745 (Smarty_Internal_Template $_smarty_tpl) {
if (php7_count($_smarty_tpl->tpl_vars['DATA']->value) > 0) {?><input class="widgetData" type=hidden value='<?php echo Vtiger_Util_Helper::toSafeHTML(ZEND_JSON::encode($_smarty_tpl->tpl_vars['DATA']->value));?>
' /><input class="yAxisFieldType" type="hidden" value="<?php if ((isset($_smarty_tpl->tpl_vars['YAXIS_FIELD_TYPE']->value))) {?>$YAXIS_FIELD_TYPE<?php }?>" /><div class="row" style="margin:0px 10px;"><div class="col-lg-11"><div class="widgetChartContainer" name='chartcontent' style="height:220px;min-width:300px; margin: 0 auto"></div><br></div><div class="col-lg-1"></div></div><?php } else { ?><span class="noDataMsg"><?php echo vtranslate('LBL_NO');?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 <?php echo vtranslate('LBL_MATCHED_THIS_CRITERIA');?>
</span><?php }
}
}
