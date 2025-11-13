{*+**********************************************************************************
* The content of this file is subject to the CRMTiger Pro license.
* ("License"); You may not use this file except in compliance with the License
* The Initial Developer of the Original Code is vTiger
* The Modified Code of the Original Code owned by https://crmtiger.com/
* Portions created by CRMTiger.com are Copyright(C) CRMTiger.com
* All Rights Reserved.
************************************************************************************}
<div class='modal-xs modal-dialog' style="width: 435px;">
	<div class="modal-header" style="height: 50px;">
        <button type="button" class="close " data-dismiss="modal" aria-hidden="true" style="float: right;">&times;</button>
       	<h4>{vtranslate('Assigned To', $MODULE)}</h4>&nbsp;
    </div>
    <div class ="modal-content" style="border-radius: 0px 0px 0px 0px;">
		<table class="massEditTable table no-border"><br>
			<tbody>
				<input type="hidden" name="sourceModule" id="sourceModule" value="{$SOURCEMODULENAME}">
				<input type="hidden" name="senderId" id="senderId" value="{$SENDER_ID}">
				<tr>
					<td class="fieldLabel alignMiddle">
						{vtranslate('LBL_MERGE_SELECTED_RECORDS', $MODULE)}
					</td>
					<td class="fieldValue moduleRecord">
						<input id="moduleRecordSearch" placeholder="{vtranslate('LBL_TYPE_SEARCH',$MODULE)}" class="inputElement">
						<input type="hidden" id="moduleRecordId" class="inputElement" value="">
						<input type="hidden" id="moduleRecordLabel" class="inputElement" value="">
						<div id="suggestionsList" style="width:100%; background-color:;"> &nbsp; </div>
					</td> 
				</tr>
			</tbody>
		</table>
		<div class="modal-footer">
			<center>
				<button class="btn btn-success" id="saveAssignRecord"><b>{vtranslate('LBL_UPDATETO', $MODULE)} {vtranslate({$SOURCEMODULENAME}, {$SOURCEMODULENAME})}</b></button>
				<a class="cancelLink" type="reset" data-dismiss="modal">{vtranslate('LBL_CANCEL', $MODULE)}</a>
			</center>
		</div>
    </div>
</div>