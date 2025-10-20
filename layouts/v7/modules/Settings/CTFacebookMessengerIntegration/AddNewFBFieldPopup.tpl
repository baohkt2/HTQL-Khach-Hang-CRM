{*+**********************************************************************************
* The content of this file is subject to the CRMTiger Pro license.
* ("License"); You may not use this file except in compliance with the License
* The Initial Developer of the Original Code is vTiger
* The Modified Code of the Original Code owned by https://crmtiger.com/
* Portions created by CRMTiger.com are Copyright(C) CRMTiger.com
* All Rights Reserved.
************************************************************************************}
<div class="modal-xs modal-dialog">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">{vtranslate('LBL_CHOOSE_MODULES_FIELDS', $QUALIFIED_MODULE)}</h4>
	</div>
	<div class="modal-body">
		<div class="clearfix">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
				<h4 style="margin-top: 0px;">{vtranslate('LBL_CHOOSE_MODULES_FIELDS', $QUALIFIED_MODULE)}</h4>
			</div>
		</div><hr>
		
		<input type="hidden" name="chatTypeId" id="chatTypeId" value="{$CHATTYPEID}">

		<table class="table editview-table no-border">
			<tbody>
				<tr>
					<td class="fieldLabel alignMiddle" style="width: 300px;">{vtranslate('LBL_ALLOW_SELECTED_SELECTED_MODULE', $QUALIFIED_MODULE)}<span class="redColor">*</span></td>
					<td class="fieldValue">
						<select class="inputElement select2  select2-offscreen" id="select_module" name="select_module" style="width: 50%;">
							<option value="">{vtranslate('LBL_SELECT_AN_OPTION',$QUALIFIED_MODULE)}</option>
							{foreach from=$ALLOW_FACEBOOK_MODULES key=key  item=value}
								<option value="{$value}">{vtranslate($value, $value)}</option>
							{/foreach}
						</select>
					</td>
				</tr>
			<tr>
				<td class="fieldLabel alignMiddle" style="width: 300px;">{vtranslate('LBL_ACTIVE', $QUALIFIED_MODULE)}</td>
				<td class="fieldValue">
					<input type="checkbox" class="inputElement" name="active" id="active" value="">
				</td>
			</tr>
			</tbody>
		</table>
	</div>
	<div class="modal-footer">
		<center><button class="btn btn-success" id="submitbutton" type="button"><strong>{vtranslate('LBL_SAVE', $MODULE)}</strong></button><a class="cancelLink" data-dismiss="modal"  href="#" type="reset">{vtranslate('LBL_CANCEL',$QUALIFIED_MODULE)}</a></center>
	</div>
</div>