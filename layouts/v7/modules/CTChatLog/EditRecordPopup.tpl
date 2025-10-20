{*+**********************************************************************************
* The content of this file is subject to the CRMTiger Pro license.
* ("License"); You may not use this file except in compliance with the License
* The Initial Developer of the Original Code is vTiger
* The Modified Code of the Original Code owned by https://crmtiger.com/
* Portions created by CRMTiger.com are Copyright(C) CRMTiger.com
* All Rights Reserved.
************************************************************************************}
<div class="modal-xs modal-dialog" style="width: 750px;">
	<div class="modal-header" style="height: 50px;">
        <button type="button" class="close " data-dismiss="modal" aria-hidden="true" style="float: right;">&times;</button>
       	<h4>{vtranslate('LBL_QUICK_EDIT', $MODULE)} {vtranslate($SOURCEMODULENAME, $SOURCEMODULENAME)}</h4>&nbsp;
    </div>
    <div class ="modal-content" style="border-radius: 0px 0px 0px 0px;">
    <form class="form-horizontal" name="newrecord" id="newrecord" method="post" action="index.php" enctype="multipart/form-data">
		<table class="massEditTable table no-border">
				<br>
				<tbody>
					{foreach item=MODUELFIELDSVALUE key=MODUELFIELDSKEY from=$MODUELFIELDS}
						{if $MODUELFIELDSKEY neq 'Assigned To'}
							<tr>
								<td class="fieldLabel alignMiddle">
									{vtranslate($MODUELFIELDSKEY, $SOURCEMODULENAME)}
								</td>
								<td class="fieldValue">
									<input type="text" class="inputElement" name="{$MODUELFIELDSVALUE['fieldName']}" style="width: 240px;" value="{$MODUELFIELDSVALUE['fieldValue']}">
								</td>
							</tr>
						{/if}
					{/foreach}
					<tr>
						<td class="fieldLabel alignMiddle">
							{vtranslate('Assigned To', $SOURCEMODULENAME)}
						</td>
						<td>
							{assign var=ALL_ACTIVEUSER_LIST value=$USER_MODEL->getAccessibleUsers()}
							{assign var=ALL_ACTIVEGROUP_LIST value=$USER_MODEL->getAccessibleGroups()}
							<select name="assigned_user_id" style="width: 45%;" class="inputElement select2">
								<optgroup label="{vtranslate('LBL_USERS')}">
									{foreach key=OWNER_ID item=OWNER_NAME from=$ALL_ACTIVEUSER_LIST}
					                    <option value="{$OWNER_ID}" {if $OWNER_ID eq $ASSIGNTO} selected {/if}>
					                    	{$OWNER_NAME}
					                    </option>
									{/foreach}
								</optgroup>
								<optgroup label="{vtranslate('LBL_GROUPS')}">
									{foreach key=OWNER_ID item=OWNER_NAME from=$ALL_ACTIVEGROUP_LIST}
										<option value="{$OWNER_ID}" {if $OWNER_ID eq $ASSIGNTO} selected {/if}>
											{$OWNER_NAME}
										</option>
									{/foreach}
								</optgroup>
							</select>
						</td>
					</tr>
				</tbody>
		</table>
		</form>
		<br>
		{vtranslate('LBL_QUICKUPDATENOTES', $MODULE)}
		<br>
		<div class="modal-footer">
			<center>
				<button class="btn btn-success" id="saveModuleRecord">{vtranslate('LBL_SAVE', $MODULE)}</button>
				<a class="cancelLink" type="reset" data-dismiss="modal">{vtranslate('LBL_CANCEL', $MODULE)}</a>
			</center>
		</div>
    </div>
</div>
