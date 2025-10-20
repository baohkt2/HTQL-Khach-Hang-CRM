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
       	<h4>{vtranslate('LBL_EDITFIELD', $MODULE)} {vtranslate($SOURCEMODULENAME, $SOURCEMODULENAME)}</h4>&nbsp;
    </div>
    <div class ="modal-content" style="border-radius: 0px 0px 0px 0px;">
		<table class="massEditTable table no-border"><br>
			<tbody>
				<tr>
					<td class="fieldLabel alignMiddle">
						{vtranslate('LBL_SELECTFIELDS', $MODULE)}
					</td>
					<td class="fieldValue">
						<select class="select2" id="fieldname" name="fieldname" style="width: 200px;">
							<option value="">{vtranslate('LBL_SELECTANOPTION', $MODULE)}</option>
							{foreach item=ALLFIELDSVALUE key=ALLFIELDSKEY from=$ALLFIELDS}
								<option value="{$ALLFIELDSVALUE['fieldname']}">{vtranslate($ALLFIELDSVALUE['fieldlabel'], $SOURCEMODULENAME)}</option>
							{/foreach}
						</select>	
					</td> 
				</tr>
			</tbody>
		</table>
		<div class="modal-footer">
			<center>
				<button class="btn btn-success" id="saveEditRecord">{vtranslate('LBL_SAVE', $MODULE)}</button>
				<a class="cancelLink" type="reset" data-dismiss="modal">{vtranslate('LBL_CANCEL', $MODULE)}</a>
			</center>
		</div>
    </div>
</div>
