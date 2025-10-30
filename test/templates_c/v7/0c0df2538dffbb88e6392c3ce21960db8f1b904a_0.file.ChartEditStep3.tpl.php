<?php
/* Smarty version 4.5.5, created on 2025-09-30 08:55:01
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\Reports\ChartEditStep3.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68db9ae57c8278_75315852',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0c0df2538dffbb88e6392c3ce21960db8f1b904a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\Reports\\ChartEditStep3.tpl',
      1 => 1752039682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68db9ae57c8278_75315852 (Smarty_Internal_Template $_smarty_tpl) {
?><form class="form-horizontal recordEditView padding1per" id="chart_report_step3" method="post" action="index.php"><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
" ><input type="hidden" name="action" value="ChartSave" ><input type="hidden" name="record" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
" ><input type="hidden" name="reportname" value="<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('reportname'));?>
" ><?php if ($_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('members')) {?><input type="hidden" name="members" value=<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('members'));?>
 /><?php }?><input type="hidden" name="reportfolderid" value="<?php echo $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('reportfolderid');?>
" ><input type="hidden" name="reports_description" value="<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('reports_description'));?>
" ><input type="hidden" name="primary_module" value="<?php echo $_smarty_tpl->tpl_vars['PRIMARY_MODULE']->value;?>
" ><input type="hidden" name="secondary_modules" value=<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['SECONDARY_MODULES']->value);?>
 ><input type="hidden" name="isDuplicate" value="<?php echo $_smarty_tpl->tpl_vars['IS_DUPLICATE']->value;?>
" ><input type="hidden" name="advanced_filter" id="advanced_filter" value="" ><input type="hidden" class="step" value="3" ><input type="hidden" name='groupbyfield' value=<?php echo $_smarty_tpl->tpl_vars['CHART_MODEL']->value->getGroupByField();?>
 ><input type="hidden" name='datafields' value=<?php echo Zend_JSON::encode($_smarty_tpl->tpl_vars['CHART_MODEL']->value->getDataFields());?>
><input type="hidden" name='charttype' value=<?php echo $_smarty_tpl->tpl_vars['CHART_MODEL']->value->getChartType();?>
><input type="hidden" name="enable_schedule" value="<?php echo $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('enable_schedule');?>
"><input type="hidden" name="schtime" value="<?php echo $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('schtime');?>
"><input type="hidden" name="schdate" value="<?php echo $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('schdate');?>
"><input type="hidden" name="schdayoftheweek" value=<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('schdayoftheweek'));?>
><input type="hidden" name="schdayofthemonth" value=<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('schdayofthemonth'));?>
><input type="hidden" name="schannualdates" value=<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('schannualdates'));?>
><input type="hidden" name="recipients" value=<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('recipients'));?>
><input type="hidden" name="specificemails" value=<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('specificemails'));?>
><input type="hidden" name="schtypeid" value="<?php echo $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('schtypeid');?>
"><div style="border:1px solid #ccc;padding:1%;"><div><h4><strong><?php echo vtranslate('LBL_SELECT_CHART_TYPE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></h4></div><br><div><ul class="nav nav-tabs charttabs" name="charttab" style="text-align:center;font-size:14px;font-weight: bold;margin:0 3%;border:0px"><li class="active marginRight5px" ><a data-type="pieChart" data-toggle="tab"><div><img src="layouts/v7/skins/images/pie.PNG" style="border:1px solid #ccc;"/></div><div class="chartname"><?php echo vtranslate('LBL_PIE_CHART',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</div></a></li><li class="marginRight5px"><a data-type="verticalbarChart" data-toggle="tab"><div><img src="layouts/v7/skins/images/vbar.PNG" style="border:1px solid #ccc;"/></div><div class="chartname"><?php echo vtranslate('LBL_VERTICAL_BAR_CHART',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</div></a></li><li class="marginRight5px"><a data-type="horizontalbarChart" data-toggle="tab"><div><img src="layouts/v7/skins/images/hbar.PNG" style="border:1px solid #ccc;"/></div><div class="chartname"><?php echo vtranslate('LBL_HORIZONTAL_BAR_CHART',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</div></a></li><li class="marginRight5px" ><a data-type="lineChart" data-toggle="tab"><div><img src="layouts/v7/skins/images/line.PNG" style="border:1px solid #ccc;"/></div><div class="chartname"><?php echo vtranslate('LBL_LINE_CHART',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</div></a></li></ul><div class='tab-content contentsBackground' style="height:auto;padding:4%;border:1px solid #ccc; background-color: white;"><br><div class="row tab-pane active"><div><span class="col-lg-4"><div><span><?php echo vtranslate('LBL_SELECT_GROUP_BY_FIELD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span><span class="redColor">*</span></div><br><div class="row"><select id='groupbyfield' name='groupbyfield' class="validate[required]" data-validation-engine="validate[required]" style='min-width:300px;'></select></div></span><span class="col-lg-2">&nbsp;</span><span class="col-lg-4"><div><span><?php echo vtranslate('LBL_SELECT_DATA_FIELD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span><span class="redColor">*</span></div><br><div class="row"><select id='datafields' name='datafields[]' class="validate[required]" data-validation-engine="validate[required]" style='min-width:300px;'></select></div></span></div></div><br><br><div class='row alert-info' style="padding: 20px;"><span class='span alert-info'><span><i class="fa fa-info-circle"></i>&nbsp;&nbsp;&nbsp;<?php echo vtranslate('LBL_PLEASE_SELECT_ATLEAST_ONE_GROUP_FIELD_AND_DATA_FIELD',$_smarty_tpl->tpl_vars['MODULE']->value);
echo vtranslate('LBL_FOR_BAR_GRAPH_AND_LINE_GRAPH_SELECT_3_MAX_DATA_FIELDS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span></div></div></div><div class='hide'><?php $_smarty_tpl->_subTemplateRender(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'vtemplate_path' ][ 0 ], array( "chartReportHiddenContents.tpl",$_smarty_tpl->tpl_vars['MODULE']->value )), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></div></div><br><div class="modal-overlay-footer border1px clearfix"><div class="row clearfix"><div class="textAlignCenter col-lg-12 col-md-12 col-sm-12 "><button type="button" class="btn btn-danger backStep"><strong><?php echo vtranslate('LBL_BACK',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button>&nbsp;&nbsp;<button type="submit" class="btn btn-success" id="generateReport"><strong><?php echo vtranslate('LBL_GENERATE_REPORT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button>&nbsp;&nbsp;<a class="cancelLink" onclick="window.history.back()"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div></div></div></form><?php }
}
