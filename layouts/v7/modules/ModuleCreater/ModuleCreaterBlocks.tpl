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
	<div class="main-container clearfix">
		<div id="modnavigator" class="module-nav editViewModNavigator">
			<div class="hidden-xs hidden-sm mod-switcher-container">
				{include file="partials/Menubar.tpl"|vtemplate_path:$MODULE}
			</div>
		</div>
		<div class="editViewPageDiv viewContent">
			<div class="col-sm-12 col-xs-12 content-area {if $LEFTPANELHIDE eq '1'} full-width {/if}">
				<form class="tks_modulevalidate" name="tks_modulevalidate" id="tks_modulevalidate" novalidate="novalidate" method="post">
				<input type="hidden" name="module" value="{$MODULE}" />
				<input type="hidden" name="action" value="InitModuleCreater" />
				<input type="hidden" name="mode" value="initMB" />
				<input type="hidden" id="noofblocks" name="noofblocks" value="{$NOOFBLOCK}" />
				<input type="hidden" id="tkssequence" name="tkssequence" value="" />
				<input type="hidden" id="token" name="token" value="{$TOKEN}" />
				<input type="hidden" id="selectedModuleName" name="selectedModuleName" value="{$MODULE_LABEL}" />
					<div class="editViewHeader">
						<div class='row'>
							<div class="col-lg-12 col-md-12 col-lg-pull-0">
								<h4 class="editHeader" style="margin-top:5px;">{vtranslate('LBL_CREATING_NEW', $MODULE)}</h4>
							</div>
						</div>
					</div>
					<div class="editViewBody">
						<div class="editViewContents">
						<div name="editContent">
							<div class='fieldBlockContainer'>
								<h4 class='fieldBlockHeader'>{vtranslate('LBL_BASIC_INFORMATION', $MODULE)}</h4>
								<hr>
								<table class="table table-borderless">
								<tr>
								<td class="fieldLabel alignMiddle">{vtranslate('MODULE_NAME', $MODULE)}<span class="redColor">*</span></td>
								<td class="fieldValue"><input type="text" name="tks_modulename" id="tks_modulename" class="inputElement" data-fieldname="tks_modulename" value="">
								&nbsp;<a href="#" rel="tooltip" title="" data-original-title="{vtranslate('LBL_ENTER_MODULENAME', $MODULE)}"><i class="fa fa-info-circle"></i></a>
</td>
								<td class="fieldLabel alignMiddle">{vtranslate('MODULE_LABEL', $MODULE)}<span class="redColor">*</span></td>
								<td class="fieldValue"><input type="text" name="tks_modulelabel" id="tks_modulelabel" class="inputElement" data-fieldname="tks_modulelabel" value="" data-fieldtype="string"  data-rule-required="true">
								&nbsp;<a href="#" rel="tooltip" title="" data-original-title="{vtranslate('LBL_ENTER_MODULELABEL', $MODULE)}"><i class="fa fa-info-circle"></i></a>
</td>
								</tr>
								<tr>
								<td class="fieldLabel alignMiddle">{vtranslate('PARENT_TAB_NAME', $MODULE)}<span class="redColor">*</span></td>
								<td class="fieldValue"><select class="inputElement select2 select2-offscreen" data-fieldtype="picklist" name="tks_parent" id="tks_parent" >
									  {foreach item="PARENTTAB" from=$TKS_PARENT_MODULE }
                                                                                <option value="{$PARENTTAB}" {if $PARENTTABNAME neq '' and $PARENTTABNAME eq $PARENTTAB} selected='selected' {/if}>{vtranslate($PARENTTAB,$MODULE)}</option>
									  {/foreach}
							</select> &nbsp;<a href="#" rel="tooltip" title="" data-original-title="{vtranslate('SELECT_PARENT_TAB', $MODULE)}"><i class="fa fa-info-circle"></i></a></td>
								
								</tr>
								</table>
							</div>
						</div>
							
						</div>
					</div>
					<div class='modal-overlay-footer clearfix'>
						<div class="row clearfix">
							<div class='textAlignCenter col-lg-12 col-md-12 col-sm-12 '>
								<button type='button' id='nextStep' class='btn btn-success saveButton' >{vtranslate('LBL_NEXT', $MODULE)}</button>&nbsp;&nbsp;
								<a class='cancelLink' href="javascript:history.back()" type="reset">{vtranslate('LBL_CANCEL', $MODULE)}</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
{/strip}