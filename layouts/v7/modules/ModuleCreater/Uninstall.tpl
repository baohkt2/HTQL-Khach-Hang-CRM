{*<!--
/* * *******************************************************************************
 * The content of this file is subject to the CRMTiger Pro license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is https://crmtiger.com/
 * Portions created by CRMTiger.com are Copyright(C) CRMTiger.com
 * All Rights Reserved.
 * ****************************************************************************** */
-->*}

{strip}

<div class="editViewPageDiv editViewContainer" id="EditViewOutgoing" style="padding-top:0px;">
	<div class="col-lg-12 col-md-12 col-sm-12">
			<div>
				<img src="modules/ModuleCreater/images/ModuleCreaterBig.png" alt="" title="" border="0" height="70" width="70" style="margin-top:10px;margin-left:5px;"/>
				</br>
				</br>
				<h3 style="margin-top: 0px;">{vtranslate('LBL_UNINSTALLATION_WIZARD', $MODULE)} </h3>&nbsp;
			</div>


<div style="margin-left:15px;margin-top:6px" class="row-fluid" align="center">
	<form name="docusignuninstall" action="index.php" >
		<input type="hidden" name="module" value="{$MODULE}" />
		<input type="hidden" name="view" value="Uninstall" />
		<input type="hidden" name="parent" value="Tools" />
		<input type="hidden" name="step2" value="step2" />
		<input type="hidden" name="step2" value="step2" />
		<button class="btn btn-danger" type="submit" style="height:50px; width:250px">
			<strong>{vtranslate('LBL_CLICK_TO_UNINSTALL', $MODULE)}</strong>
		</button>&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="{$CANCEL_URL}" title="{vtranslate('LBL_BACKTO', $MODULE)}">
		<button class="btn btn-success" type="button" style="height:50px; width:250px">
			<strong>{vtranslate('LBL_CANCEL', $MODULE)}</strong>
		</button>
		</a>
	</form>
</div><!--class="row-fluid"-->
<br />
<div class="gridster ready" align="center">
	<ul style="position: relative; height: 100px; width:600px;">
		<li class="new dashboardWidget gs_w" style="display: list-item;">
			<div class="dashboardWidgetHeader">
				<table width="100%" cellspacing="0" cellpadding="0">
					<tbody>
						<tr>
							<td class="span5">
								<div class="dashboardTitle textOverflowEllipsis" title="Sales Pipeline" style="width: 15em;">
									<b>&nbsp;&nbsp;{vtranslate('LBL_NOTES', $MODULE)}</b>
								</div><!--class="dashboardTitle textOverflowEllipsis"-->	
							</td>
						</tr>
					</tbody>
				</table>
			</div><!--class="dashboardWidgetHeader"-->	
			<div class="slimScrollDiv" style="position: relative; overflow: hidden; height: 100px;">
				<div class="dashboardWidgetContent" style="overflow: hidden; width: auto; height: 250px;">
					<div class="padding10 row-fluid" align="left">
						<i style="margin-left:20px" class="fa fa-info-circle"></i> 
						<span style="margin-left:26px" class="span10">{vtranslate('LBL_MODULE_PERMANANT_DELETE', $MODULE)}</span>
						<br />
						<i style="margin-left:20px" class="fa fa-info-circle"></i> 
						<span style="margin-left:26px" class="span10">{vtranslate('LBL_BACKUP_REQUEST', $MODULE)}</span>
						<br />
						<i style="margin-left:20px" class="fa fa-info-circle"></i> 
						<span style="margin-left:26px" class="span10">{vtranslate('LBL_TKS_HELP', $MODULE)}</span>
					</div><!--class="padding10 row-fluid"-->	
				</div><!--class="dashboardWidgetContent"-->	
			</div><!--class="slimScrollDiv"-->	
		</li><!--class="new dashboardWidget gs_w"-->
		
	</ul>
	
	</div>
</div><!--class="gridster ready"-->
</div>
{/strip}