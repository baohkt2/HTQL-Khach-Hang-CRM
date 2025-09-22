<?php
/* Smarty version 4.5.5, created on 2025-09-16 07:14:35
  from 'D:\ThucTapThucTe\wamp64\www\vtigercrm\layouts\v7\modules\Vtiger\dashboards\DashboardFooterIcons.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68c90e5b2819b0_96391478',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6b5fde6e55aafe45cea85d98ed053258526c2974' => 
    array (
      0 => 'D:\\ThucTapThucTe\\wamp64\\www\\vtigercrm\\layouts\\v7\\modules\\Vtiger\\dashboards\\DashboardFooterIcons.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68c90e5b2819b0_96391478 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['SETTING_EXIST']->value) {?>
<a name="dfilter">
	<i class='fa fa-cog' border='0' align="absmiddle" title="<?php echo vtranslate('LBL_FILTER');?>
" alt="<?php echo vtranslate('LBL_FILTER');?>
"/>
</a>
<?php }
if (!empty($_smarty_tpl->tpl_vars['CHART_TYPE']->value)) {?>
    <?php $_smarty_tpl->_assignInScope('CHART_DATA', ZEND_JSON::decode($_smarty_tpl->tpl_vars['DATA']->value));?>
    <?php $_smarty_tpl->_assignInScope('CHART_VALUES', $_smarty_tpl->tpl_vars['CHART_DATA']->value['values']);
}
if ((!empty($_smarty_tpl->tpl_vars['DATA']->value) && empty($_smarty_tpl->tpl_vars['CHART_TYPE']->value)) || !empty($_smarty_tpl->tpl_vars['CHART_VALUES']->value)) {?>
<a href="javascript:void(0);" name="widgetFullScreen">
	<i class="fa fa-arrows-alt" hspace="2" border="0" align="absmiddle" title="<?php echo vtranslate('LBL_FULLSCREEN');?>
" alt="<?php echo vtranslate('LBL_FULLSCREEN');?>
"></i>
</a>
<?php }
if (!empty($_smarty_tpl->tpl_vars['CHART_TYPE']->value) && $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->isEditable() == true) {?>
<a href="<?php echo $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->getEditViewUrl();?>
" name="customizeChartReportWidget">
	<i class="fa fa-edit" hspace="2" border="0" align="absmiddle" title="<?php echo vtranslate('LBL_CUSTOMIZE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" alt="<?php echo vtranslate('LBL_CUSTOMIZE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"></i>
</a>
<?php }?>
<a href="javascript:void(0);" name="drefresh" data-url="<?php echo $_smarty_tpl->tpl_vars['WIDGET']->value->getUrl();?>
&linkid=<?php echo $_smarty_tpl->tpl_vars['WIDGET']->value->get('linkid');?>
&content=data">
	<i class="fa fa-refresh" hspace="2" border="0" align="absmiddle" title="<?php echo vtranslate('LBL_REFRESH');?>
" alt="<?php echo vtranslate('LBL_REFRESH');?>
"></i>
</a>
<?php if (!$_smarty_tpl->tpl_vars['WIDGET']->value->isDefault()) {?>
	<a name="dclose" class="widget" data-url="<?php echo $_smarty_tpl->tpl_vars['WIDGET']->value->getDeleteUrl();?>
">
		<i class="fa fa-remove" hspace="2" border="0" align="absmiddle" title="<?php echo vtranslate('LBL_REMOVE');?>
" alt="<?php echo vtranslate('LBL_REMOVE');?>
"></i>
	</a>
<?php }
}
}
