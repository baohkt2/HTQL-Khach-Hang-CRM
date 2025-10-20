{*+**********************************************************************************
* The content of this file is subject to the CRMTiger Pro license.
* ("License"); You may not use this file except in compliance with the License
* The Initial Developer of the Original Code is vTiger
* The Modified Code of the Original Code owned by https://crmtiger.com/
* Portions created by CRMTiger.com are Copyright(C) CRMTiger.com
* All Rights Reserved.
************************************************************************************}
<div id="sendWhatsappSmsContainer" class='modal-xs modal-dialog'>
   <div class="modal-header" style="height: 50px;">
		<button type="button" class="close " data-dismiss="modal" aria-hidden="true" style="float: right;">&times;</button>
		<h4 style="font-size: 15px;">{vtranslate('LBL_ADD_DELETE_FACEBOOK_PAGE',$MODULE)}</h4>&nbsp;
   </div>
   {assign var=ALL_ACTIVEUSER_LIST value=$USER_MODEL->getAccessibleUsers()}
  	{assign var=ALL_ACTIVEGROUP_LIST value=$USER_MODEL->getAccessibleGroups()}
  	<div class="modal-body">
    	<div class="clearfix"></div>
    	<form name="facebookPageConfig" id="facebookPageConfig">
    		<input type="hidden" name="recordId" id="recordId" value="{$RECORD_ID}">
    		<input type="hidden" name="chatTypeId" id="chatTypeId" value="{$CHATTYPEID}">
    		
			<table class="table editview-table no-border">
				<tbody>
					<tr>
						<td class="fieldLabel alignMiddle">{vtranslate('LBL_SELECT_FACEBOOK_PAGE', $MODULE)}<span class="redColor">*</span></td>
						<td class="fieldValue optionsWidth" >
							<select name="pageId" id="pageId" class="inputElement select2 row select2-offscreen" {if $RECORD_ID neq ''} disabled='true'{/if}>
								<option value="">{vtranslate('LBL_SELECT_AN_OPTION', $MODULE)}</option>
								{foreach from=$FACEBOOK_PAGE_LIST key=key  item=pageData}
									{if !empty($FACEBOOK_PAGE_DATA) && $FACEBOOK_PAGE_DATA['facebookPageId'] eq $key}
										<option value="{$key}" selected>{$pageData}</option>
									{else}
										<option value="{$key}">{$pageData}</option>
									{/if}
								{/foreach}
							</select>
							{if $RECORD_ID eq ''}
							<span id="syncFBPages" title="{vtranslate('LBL_SYNC_FACEBOOK_PAGES', $MODULE)}" style="height: 31px;cursor:pointer;"><img src="layouts/v7/modules/CTChatLog/image/sync.png" style="width: 24px;"></span>
							{/if}
						</td>
					</tr>
					<tr>
						<td class="fieldLabel alignMiddle">{vtranslate('LBL_SELECT_USERS_GROUPS', $MODULE)}<span class="redColor">*</span></td>
						<td class="fieldValue">
							<select name="facebookUsersGroups[]" id="facebookUsersGroups" class="inputElement select2 row select2-offscreen"  multiple="">
								<optgroup label="{vtranslate('LBL_USERS')}">
									{foreach key=OWNER_ID item=OWNER_NAME from=$ALL_ACTIVEUSER_LIST}
			                  	<option value="{$OWNER_ID}"  {if !empty($FACEBOOK_PAGE_DATA) && in_array($OWNER_ID, $FACEBOOK_PAGE_DATA['allowUsersGroups'])} selected="" {/if}>
			                    		{$OWNER_NAME}
			                    	</option>
									{/foreach}
								</optgroup>
								<optgroup label="{vtranslate('LBL_GROUPS')}">
									{foreach key=OWNER_ID item=OWNER_NAME from=$ALL_ACTIVEGROUP_LIST}
										<option value="{$OWNER_ID}"  {if !empty($FACEBOOK_PAGE_DATA) && in_array($OWNER_ID, $FACEBOOK_PAGE_DATA['allowUsersGroups'])} selected="" {/if}>
					               	{$OWNER_NAME}
					               </option>
									{/foreach}
								</optgroup>
							</select>
						</td>
					</tr>
					<tr>
						<td class="fieldLabel alignMiddle">{vtranslate(LBL_ACTIVE, $MODULE)}</td>
						<td class="fieldValue">
							<input type="checkbox" name="facebookConfigActive" id="facebookConfigActive" value="{$FACEBOOK_PAGE_DATA['active']}" {if !empty($FACEBOOK_PAGE_DATA) && $FACEBOOK_PAGE_DATA['active'] eq 1} checked="checked" {/if}>
						</td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
	<div class="modal-footer">
		<center>
			<button id="saveFacebookPageConfig" class="btn btn-success" style="background-color:#1877f2;">{vtranslate('LBL_SAVE',$MODULE)}</button>&nbsp;&nbsp;
			<a type="reset" data-dismiss="modal" class="cancelLink cursorPointer">{vtranslate('LBL_CANCEL',$MODULE)}</a>
		</center>
    </div>    
</div>