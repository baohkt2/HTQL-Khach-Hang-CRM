{***********************************************************************************
* The content of this file is subject to the CRMTiger Pro license.
* ("License"); You may not use this file except in compliance with the License
* The Initial Developer of the Original Code is vTiger
* The Modified Code of the Original Code owned by https://crmtiger.com/
* Portions created by CRMTiger.com are Copyright(C) CRMTiger.com
* All Rights Reserved.
************************************************************************************}
{strip}
<div class="container-fluid" id="LicenseSetting">
	<div class="widget_header row-fluid">
		<div class=""><h3>{vtranslate('LBL_LICENCE_SETTINGS',$QUALIFIED_MODULE)} </h3></div>
	</div>
	<hr>
	<div class="editContent">
		<table class="table table-bordered equalSplit">
			<thead></thead>
			<tr>
				<td class="fieldLabel alignMiddle">
					<label class="pull-right"><span class="redColor">*</span> {vtranslate('LBL_VALIDATE_LICENSE_KEY',$QUALIFIED_MODULE)}</label>
				</td>
				<td class="fieldValue">
					<input type="text" class="inputElement" name="licence" id="licence" data-validation-engine='validate[required]' value="" style="width: 40%;"/>
				</td>
			</tr>
		</table><br>
		<div class="row-fluid">
			<div class="pull-right">
				<button class="btn btn-success" id="saveLicense"><strong> {vtranslate('LBL_SUBMIT_LICENSE',$QUALIFIED_MODULE)}</strong></button>
			</div>
		</div>
	</div>
</div>
{/strip}
