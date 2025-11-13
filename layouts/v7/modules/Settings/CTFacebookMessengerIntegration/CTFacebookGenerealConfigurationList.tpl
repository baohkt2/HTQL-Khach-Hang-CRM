{*+**********************************************************************************
* The content of this file is subject to the CRMTiger Pro license.
* ("License"); You may not use this file except in compliance with the License
* The Initial Developer of the Original Code is vTiger
* The Modified Code of the Original Code owned by https://crmtiger.com/
* Portions created by CRMTiger.com are Copyright(C) CRMTiger.com
* All Rights Reserved.
************************************************************************************}
{strip}
<div class="detailViewContainer" id="WhatsappConfiguration" style="margin-top: 20px;">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div style="float:right;">
			<input type="hidden" name="accessToken" id="accessToken" value="{$ACCESSTOKEN}">
			{vtranslate('LBL_LOGGED_IN_WITH', $QUALIFIED_MODULE)} {$USER_NAME} <a onclick="return javascript:void(0);" id="logoutLink">{vtranslate('LBL_LOGOUT', $QUALIFIED_MODULE)}</a>
		</div>
		<div class="clearfix">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
				<h3>{vtranslate('LBL_FACEBOOK_MESSENGER_INTEGRATION', $QUALIFIED_MODULE)}</h3>
			</div>
		</div>
		<div class="block">
			<div class="clearfix">
				<div class="col-lg-6 col-md-6 col-sm-6">
					<h4>{vtranslate('LBL_ADD_FACEBOOK_PAGE_CONFIGURATION', $QUALIFIED_MODULE)}</h4>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-2">
					<button class="btn addRecords" id="addRecords" type="button" style="margin-top: 10px;"><i class="fa fa-plus" id="plusIcon" aria-hidden="true"></i></button>
				</div>
			</div>
			<hr>
			<table class="table editview-table no-border facebookPageData">
                <thead>
                    <tr>
                        <th>{vtranslate('LBL_CTFACEBOOK_PAGE_SELECTION', $QUALIFIED_MODULE)}</th>
                        <th>{vtranslate('LBL_USERS', $QUALIFIED_MODULE)}</th>
                        <th>{vtranslate('LBL_STATUS', $QUALIFIED_MODULE)}</th>
                        <th>{vtranslate('LBL_ACTIONS', $QUALIFIED_MODULE)}</th>
                    </tr>
                </thead>
                <tbody>
                    {if empty($FACEBOOK_INTEGRATION_CONFIG_DATA)}
                        <tr>
                            <td colspan="4">
                                <center><b>{vtranslate('LBL_NO_RECORD_FOUND',$QUALIFIED_MODULE)}</b></center>
                            </td>
                        </tr>       
                    {else}
                    	{foreach from=$FACEBOOK_INTEGRATION_CONFIG_DATA key=key item=value}
                    		<tr>
                                <td>{$value['facebookPageName']}</td>
                                <td>{$value['userGroupNames']}</td>
                                <td>
                                	{if $value['active'] eq '1'}
                                		{vtranslate('LBL_ACTIVE', $QUALIFIED_MODULE)}
                                	{else}
                                		{vtranslate('LBL_INACTIVE', $QUALIFIED_MODULE)}
                                	{/if}
                                </td>
                                <td>
                                    <a class="editFacebookPageConfig" data-id="{$value['configId']}">
                                        <i class="fa fa-pencil" title="{vtranslate('LBL_EDIT',$QUALIFIED_MODULE)}"></i>
                                    </a>&nbsp;&nbsp;
                                    <span class="deleteFacebookPageConfig" data-id="{$value['configId']}" title="{vtranslate('LBL_DELETE',$QUALIFIED_MODULE)}"><i class="fa fa-trash"></i></span>&nbsp;&nbsp;
                                </td>
                            </tr>
                        {/foreach}
                   	{/if}
                </tbody>
            </table>
			<div class="clearfix">
				<div class="col-lg-6 col-md-6 col-sm-6">
					<h4>{vtranslate('LBL_CHOOSE_MODULES_FIELDS', $QUALIFIED_MODULE)}</h4>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-2">
					<button class="btn addNewFBField" type="button" style="margin-top: 10px;"><i class="fa fa-plus" id="plusIcon" aria-hidden="true"></i></button>
				</div>
			</div>
			<hr>
			<div id="facebookGeneralSettingsDiv">
				<form id="generalSettingsForm" name="generalSettingsForm">
					<div>
						<table class="table editview-table no-border moduleMappingTable">
							{if $ALLLOWMODULES|count eq 0}
								<span><b>{vtranslate('LBL_ATLEAST_SELECT_ONE_MODULE', $QUALIFIED_MODULE)}</b></span>
							{else}
							<thead>
								<tr>
									<th class="fieldLabel alignMiddle">{vtranslate('LBL_MODULE', $QUALIFIED_MODULE)}</th>
									<th class="fieldLabel alignMiddle">{vtranslate('LBL_ACTIVE', $QUALIFIED_MODULE)}</th>
									<th class="fieldLabel alignMiddle">{vtranslate('LBL_ACTIONS', $QUALIFIED_MODULE)}</th>
								</tr>
							</thead>
							{/if}
							<tbody>
								<input type="hidden" name="whatsappModuleRow" value="{$ALLLOWMODULES|count}">
								{foreach from=$ALLLOWMODULES key=ALLLOWMODULES_KEY item=ALLLOWMODULES_VALUE}
										<tr>
											<td class="fieldLabel alignMiddle" style="width: 200px;">{vtranslate($ALLLOWMODULES_KEY, $ALLLOWMODULES_KEY)}</td>
											<td class="fieldLabel alignMiddle" style="width: 200px;">
												{if $ALLLOWMODULES_VALUE['active'] eq 1}
													{vtranslate('LBL_ACTIVE', $QUALIFIED_MODULE)}
												{else}
													{vtranslate('LBL_INACTIVE', $QUALIFIED_MODULE)}
												{/if}											</td>
											<td class="fieldLabel alignMiddle" style="width:200px;">
												<a id="editFacebookModule" data-facebookmodulename="{$ALLLOWMODULES_KEY}" data-facebookmodulestatus="{$ALLLOWMODULES_VALUE['active']}">
													<i class="fa fa-pencil" title="{vtranslate('LBL_EDIT',$QUALIFIED_MODULE)}"></i>
												</a>
												&nbsp;&nbsp;
												<a id="deletedFacebookModule" data-facebookmodulename="{$ALLLOWMODULES_KEY}">
													<i class="fa fa-trash" aria-hidden="true"></i>
												</a>
											</td>
										</tr>
									{/foreach}
							</tbody>
						</table>
					</div>
					<br>	
				</form>
			</div>
		</div>
	</div>
	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
		<div class="block">
			<div id="facebookGeneralSettingsDiv">
				<form id="generalSettingsForm" name="generalSettingsForm">
					<input type="hidden" name="recordId" id="recordId" value="{$RECORD_ID}">
	    			<input type="hidden" name="chatTypeId" id="chatTypeId" value="{$CHATTYPEID}">
					
					<div>
						<h4>{vtranslate('LBL_GENERAL_SETTINGS', $QUALIFIED_MODULE)}</h4>
					</div>
					<hr>
					<div>
						<table class="table editview-table no-border">
							<tbody>
								<tr>
									<td class="fieldLabel"><label>{vtranslate('LBL_FACEBOOK_WINDOW_VIEW', $QUALIFIED_MODULE)}</label></td>
									<td>
										<select class="select2 inputElement col-lg-12 col-md-12 col-lg-12" name="facebookWindowView" id="facebookWindowView">
											{$THEME_HTML}
										</select>
									</td>
								</tr>
								<tr>
									<td class="fieldLabel"><label>{vtranslate('LBL_ACTIVE', $QUALIFIED_MODULE)}</label></td>
									<td>
										<input type="checkbox" name="facebookGeneralSettingActive" id="facebookGeneralSettingActive" value="{$GENERALSETTINGSDATA['active']}" {if !empty($GENERALSETTINGSDATA) && $GENERALSETTINGSDATA['active'] eq 1} checked="checked" {/if}>
									</td>
								</tr>

								<tr class="">
										<td class="fieldLabel"><label>{vtranslate('LBL_NOTIFICATION_TONE', $QUALIFIED_MODULE)}</label></td>
										<td class="fieldValue">
											<select class="inputElement select2 col-lg-12 col-md-12 col-lg-12" id="notificationtone" name="notificationtone">
		                                        <option value="">{vtranslate('LBL_SELECT_AN_OPTION', $QUALIFIED_MODULE)}</option>
		                                        <option {if $GENERALSETTINGSDATA['fieldNameValue']['notificationtone'] eq 'layouts/v7/modules/CTChatLog/CTChatLog Default.mp3'} selected {/if} value="layouts/v7/modules/CTChatLog/CTChatLog Default.mp3">{vtranslate('LBL_Facebook_Messanger_Default',$QUALIFIED_MODULE)}</option>
		                                        <option {if $GENERALSETTINGSDATA['fieldNameValue']['notificationtone'] eq 'layouts/v7/modules/CTChatLog/Hangout Message.mp3'} selected {/if} value="layouts/v7/modules/CTChatLog/Hangout Message.mp3">{vtranslate('LBL_Hangout_Message',$QUALIFIED_MODULE)}</option>
		                                        <option{if $GENERALSETTINGSDATA['fieldNameValue']['notificationtone'] eq 'silent'} selected {/if} value="silent">{vtranslate('LBL_SILENT', $QUALIFIED_MODULE)}</option>
		                                    </select>
										</td>
									</tr>

								<tr>
									<td class="fieldLabel"><label>{vtranslate('LBL_AUTO_RESPONDER', $QUALIFIED_MODULE)}</label></td>
									<td>
										<input type="checkbox" name="autoResponder" id="autoResponder" value="{$GENERALSETTINGSDATA['fieldNameValue']['autoResponder']}" {if !empty($GENERALSETTINGSDATA) && $GENERALSETTINGSDATA['fieldNameValue']['autoResponder'] eq 1} checked="checked" {/if}>
									</td>
								</tr>	
								<tr>
									<td class="fieldLabel"><label>{vtranslate('LBL_AUTO_RESPONDER_TEXT', $QUALIFIED_MODULE)}</label></td>
									<td>
										<textarea name="autoResponderText" id="autoResponderText" value="$GENERALSETTINGSDATA['fieldNameValue']['autoResponderText']">{$GENERALSETTINGSDATA['fieldNameValue']['autoResponderText']}</textarea>
										<label>{vtranslate('LBL_AUTO_RESPONDER_TEXT_MESSAGE', $QUALIFIED_MODULE)}</label>
									</td>
								</tr>					
							</tbody>
						</table>
					</div>
					<br>	
				</form>
				<div class='modal-overlay-footer clearfix'>
					<div class='textAlignCenter col-lg-12 col-md-12 col-sm-12'>
						<button class='btn btn-success' id='saveFacebookGeneralSetting'>{vtranslate('LBL_SAVE', $QUALIFIED_MODULE)}</button>&nbsp;&nbsp;
						<a class='cancelLink' id='cancelLink' href="index.php?parent=Settings&module=CTFacebookMessengerIntegration&view=CTGeneralConfiguration">{vtranslate('LBL_CANCEL', $QUALIFIED_MODULE)}</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
{/strip}