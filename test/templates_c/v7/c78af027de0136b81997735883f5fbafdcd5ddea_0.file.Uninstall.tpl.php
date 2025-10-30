<?php
/* Smarty version 4.5.5, created on 2025-10-23 08:04:44
  from 'C:\xampp\htdocs\vtigercrm\layouts\v7\modules\ModuleBuilder\Uninstall.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68f9e19c573426_24271846',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c78af027de0136b81997735883f5fbafdcd5ddea' => 
    array (
      0 => 'C:\\xampp\\htdocs\\vtigercrm\\layouts\\v7\\modules\\ModuleBuilder\\Uninstall.tpl',
      1 => 1761206564,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68f9e19c573426_24271846 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="editViewPageDiv editViewContainer" id="EditViewOutgoing" style="padding-top:0px;"><div class="col-lg-12 col-md-12 col-sm-12"><div><img src="modules/ModuleBuilder/images/ModuleBuilderBig.png" alt="" title="" border="0" height="70" width="70" style="margin-top:10px;margin-left:5px;"/></br></br><h3 style="margin-top: 0px;"><?php echo vtranslate('LBL_UNINSTALLATION_WIZARD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 </h3>&nbsp;</div><div style="margin-left:15px;margin-top:6px" class="row-fluid" align="center"><form name="docusignuninstall" action="index.php" ><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
" /><input type="hidden" name="view" value="Uninstall" /><input type="hidden" name="parent" value="Tools" /><input type="hidden" name="step2" value="step2" /><input type="hidden" name="step2" value="step2" /><button class="btn btn-danger" type="submit" style="height:50px; width:250px"><strong><?php echo vtranslate('LBL_CLICK_TO_UNINSTALL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $_smarty_tpl->tpl_vars['CANCEL_URL']->value;?>
" title="<?php echo vtranslate('LBL_BACKTO',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><button class="btn btn-success" type="button" style="height:50px; width:250px"><strong><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button></a></form></div><!--class="row-fluid"--><br /><div class="gridster ready" align="center"><ul style="position: relative; height: 100px; width:600px;"><li class="new dashboardWidget gs_w" style="display: list-item;"><div class="dashboardWidgetHeader"><table width="100%" cellspacing="0" cellpadding="0"><tbody><tr><td class="span5"><div class="dashboardTitle textOverflowEllipsis" title="Sales Pipeline" style="width: 15em;"><b>&nbsp;&nbsp;<?php echo vtranslate('LBL_NOTES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</b></div><!--class="dashboardTitle textOverflowEllipsis"--></td></tr></tbody></table></div><!--class="dashboardWidgetHeader"--><div class="slimScrollDiv" style="position: relative; overflow: hidden; height: 100px;"><div class="dashboardWidgetContent" style="overflow: hidden; width: auto; height: 250px;"><div class="padding10 row-fluid" align="left"><i style="margin-left:20px" class="fa fa-info-circle"></i><span style="margin-left:26px" class="span10"><?php echo vtranslate('LBL_MODULE_PERMANANT_DELETE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span><br /><i style="margin-left:20px" class="fa fa-info-circle"></i><span style="margin-left:26px" class="span10"><?php echo vtranslate('LBL_BACKUP_REQUEST',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span><br /><i style="margin-left:20px" class="fa fa-info-circle"></i><span style="margin-left:26px" class="span10"><?php echo vtranslate('LBL_TKS_HELP',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span></div><!--class="padding10 row-fluid"--></div><!--class="dashboardWidgetContent"--></div><!--class="slimScrollDiv"--></li><!--class="new dashboardWidget gs_w"--></ul></div></div><!--class="gridster ready"--></div><?php }
}
