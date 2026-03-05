{*+**********************************************************************************
* The contents of this file are subject to the vtiger CRM Public License Version 1.1
* ("License"); You may not use this file except in compliance with the License
* The Original Code is: vtiger CRM Open Source
* The Initial Developer of the Original Code is vtiger.
* Portions created by vtiger are Copyright (C) vtiger.
* All Rights Reserved.
************************************************************************************}

{strip}
	{assign var=SELECTED_FIELDS value=$CUSTOMVIEW_MODEL->getSelectedFields()}
	{assign var=SELECTED_FIELD_NAMES value=array()}
	{foreach from=$SELECTED_FIELDS item=FIELD_INFO}
		{append var='SELECTED_FIELD_NAMES' value=$FIELD_INFO.columnname}
	{/foreach}
	{assign var=MODULE_FIELDS value=$MODULE_MODEL->getFields()}
	<div id="filterContainer" style="height:100%">
		<form id="CustomView" style="height:100%">
			<div class="modal-content" style="height:100%">
				<div class="overlayHeader">
					{if $RECORD_ID}
						{assign var="TITLE" value={vtranslate('LBL_EDIT_CUSTOM',$MODULE)}}
					{else}
						{assign var="TITLE" value={vtranslate('LBL_CREATE_LIST',$MODULE)}}
					{/if}
					{include file="ModalHeader.tpl"|vtemplate_path:$MODULE TITLE=$TITLE}
				</div>
				<div class="modal-body" style="height:100%">
					<div class="customview-content row" style="height:90%">
						<input type=hidden name="record" id="record" value="{$RECORD_ID}" />
						<input type="hidden" name="module" value="{$MODULE}" />
						<input type="hidden" name="action" value="Save" />
						<input type="hidden" id="sourceModule" name="source_module" value="{$SOURCE_MODULE}"/>
						<input type="hidden" id="stdfilterlist" name="stdfilterlist" value=""/>
						<input type="hidden" id="advfilterlist" name="advfilterlist" value=""/>
						<input type="hidden" name="status" value="{$CV_PRIVATE_VALUE}"/>
						{if $RECORD_ID}
							<input type="hidden" name="status" value="{$CUSTOMVIEW_MODEL->get('status')}" />
						{/if}
						<input type="hidden" name="date_filters" data-value='{Vtiger_Util_Helper::toSafeHTML(ZEND_JSON::encode($DATE_FILTERS))}' />
						<div class="form-group">
							<label>{vtranslate('LBL_VIEW_NAME',$MODULE)}&nbsp;<span class="redColor">*</span> </label>
							<div class="row">
								<div class="col-lg-5 col-md-5 col-sm-5">
									<input class="form-control" type="text" data-record-id="{$RECORD_ID}" id="viewname" name="viewname" value="{$CUSTOMVIEW_MODEL->get('viewname')}" data-rule-required="true" data-rule-maxsize="100" data-rule-check-filter-duplicate='{Vtiger_Util_Helper::toSafeHTML(Zend_JSON::encode($CUSTOM_VIEWS_LIST))}'>
								</div>
								<div class="col-lg-5 col-md-5 col-sm-5">
									<label class="checkbox-inline">
										<input type="checkbox" name="setdefault" value="1" {if $CUSTOMVIEW_MODEL->isDefault()} checked="checked"{/if}> &nbsp;&nbsp;{vtranslate('LBL_SET_AS_DEFAULT',$MODULE)}
									</label>
									<label class="checkbox-inline">
										<input id="setmetrics" name="setmetrics" type="checkbox" value="1" {if $CUSTOMVIEW_MODEL->get('setmetrics') eq '1'} checked="checked"{/if}> &nbsp;&nbsp;{vtranslate('LBL_LIST_IN_METRICS',$MODULE)}</label>
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>
								{vtranslate('LBL_CHOOSE_COLUMNS',$MODULE)} ({vtranslate('LBL_MAX_NUMBER_FILTER_COLUMNS')})
							</label>
						<div class="columnsSelectDiv clearfix">
							{assign var=MANDATORY_FIELDS value=array()}
							{assign var=NUMBER_OF_COLUMNS_SELECTED value=0}
							{assign var=MAX_ALLOWED_COLUMNS value=100}
							<select name="selectColumns" data-placeholder="{vtranslate('LBL_ADD_MORE_COLUMNS',$MODULE)}" multiple class="select2 columnsSelect col-lg-10" id="viewColumnsSelect" >
									{foreach key=BLOCK_LABEL item=BLOCK_FIELDS from=$RECORD_STRUCTURE}
										<optgroup label='{vtranslate($BLOCK_LABEL, $SOURCE_MODULE)}'>
											{foreach key=FIELD_NAME item=FIELD_MODEL from=$BLOCK_FIELDS}
												{* To not show star field in filter select view*}
												{if $FIELD_MODEL->getDisplayType() == '6'}
													{continue}
												{/if}
												{if $FIELD_MODEL->isMandatory()}
													{array_push($MANDATORY_FIELDS, $FIELD_MODEL->getCustomViewColumnName())}
												{/if}
												{assign var=FIELD_MODULE_NAME value=$FIELD_MODEL->getModule()->getName()}
												<option value="{$FIELD_MODEL->getCustomViewColumnName()}" data-field-name="{$FIELD_NAME}"
													{if in_array(decode_html($FIELD_MODEL->getCustomViewColumnName()), $SELECTED_FIELD_NAMES)}
														selected
													{elseif (!$RECORD_ID) && ($FIELD_MODEL->isSummaryField() || $FIELD_MODEL->isHeaderField()) && ($FIELD_MODULE_NAME eq $SOURCE_MODULE) && (!(preg_match("/\([A-Za-z_0-9]* \; \([A-Za-z_0-9]*\) [A-Za-z_0-9]*\)/", $FIELD_NAME))) && $NUMBER_OF_COLUMNS_SELECTED < $MAX_ALLOWED_COLUMNS}
														selected
														{assign var=NUMBER_OF_COLUMNS_SELECTED value=$NUMBER_OF_COLUMNS_SELECTED + 1}
													{/if}
													>{Vtiger_Util_Helper::toSafeHTML(vtranslate($FIELD_MODEL->get('label'), $SOURCE_MODULE))}
													{if $FIELD_MODEL->isMandatory() eq true} <span>*</span> {/if}
												</option>
											{/foreach}
										</optgroup>
									{/foreach}
									{*Required to include event fields for columns in calendar module advanced filter*}
									{if isset($EVENT_RECORD_STRUCTURE) && is_array($EVENT_RECORD_STRUCTURE)}
									{foreach key=BLOCK_LABEL item=BLOCK_FIELDS from=$EVENT_RECORD_STRUCTURE}
										<optgroup label='{vtranslate($BLOCK_LABEL, 'Events')}'>
											{foreach key=FIELD_NAME item=FIELD_MODEL from=$BLOCK_FIELDS}
												{* To not show starred field in custom view select *}
												{if $FIELD_MODEL->getDisplayType() == '6'}
													{continue}
												{/if}
												{if $FIELD_MODEL->isMandatory()}
													{array_push($MANDATORY_FIELDS, $FIELD_MODEL->getCustomViewColumnName())}
												{/if}
												<option value="{$FIELD_MODEL->getCustomViewColumnName()}" data-field-name="{$FIELD_NAME}"
													{if in_array(decode_html($FIELD_MODEL->getCustomViewColumnName()), $SELECTED_FIELD_NAMES)}
														selected
													{/if}
													>{Vtiger_Util_Helper::toSafeHTML(vtranslate($FIELD_MODEL->get('label'), $SOURCE_MODULE))}
													{if $FIELD_MODEL->isMandatory() eq true} <span>*</span> {/if}
												</option>
											{/foreach}
										</optgroup>
									{/foreach}
									{/if}
								</select>
								<input type="hidden" name="columnslist" value='{Vtiger_Functions::jsonEncode($SELECTED_FIELD_NAMES)}' />
								<input id="mandatoryFieldsList" type="hidden" value='{Vtiger_Util_Helper::toSafeHTML(ZEND_JSON::encode($MANDATORY_FIELDS))}' />
							</div>
							<div class="col-lg-2 col-md-2 col-sm-2"></div>
						</div>
						<div>
							<label class="filterHeaders">{vtranslate('LBL_CHOOSE_FILTER_CONDITIONS', $MODULE)} :</label>
							<div class="filterElements well filterConditionContainer filterConditionsDiv">
								{include file='AdvanceFilter.tpl'|@vtemplate_path}
							</div>
						</div>
						<div class="checkbox">
						<label>
							<input type="hidden" name="sharelist" value="0" />
							<input type="checkbox" data-toogle-members="true" name="sharelist" value="1" {if $LIST_SHARED} checked="checked"{/if}> &nbsp;&nbsp;{vtranslate('LBL_SHARE_THIS_LIST',$MODULE)}
						</label>
					</div>

					{* Hidden original memberList - kept for backward compatibility with save logic *}
					<select id="memberList" class="members" multiple="true" name="members[]" style="display:none !important;" data-placeholder="{vtranslate('LBL_ADD_USERS_ROLES', $MODULE)}">
						<optgroup label="{vtranslate('LBL_ALL',$MODULE)}">
							<option value="All::Users" data-member-type="{vtranslate('LBL_ALL',$MODULE)}" 
									{if ($CUSTOMVIEW_MODEL->get('status') == $CV_PUBLIC_VALUE)} selected="selected"{/if}>
								{vtranslate('LBL_ALL_USERS',$MODULE)}
							</option>
						</optgroup>
						{foreach from=$MEMBER_GROUPS key=GROUP_LABEL item=ALL_GROUP_MEMBERS}
							{assign var=TRANS_GROUP_LABEL value=$GROUP_LABEL}
							{if $GROUP_LABEL eq 'RoleAndSubordinates'}
								{assign var=TRANS_GROUP_LABEL value='LBL_ROLEANDSUBORDINATE'}
							{/if}
							{assign var=TRANS_GROUP_LABEL value={vtranslate($TRANS_GROUP_LABEL)}}
							<optgroup label="{$TRANS_GROUP_LABEL}">
								{foreach from=$ALL_GROUP_MEMBERS item=MEMBER}
									<option value="{$MEMBER->getId()}" data-member-type="{$GROUP_LABEL}" {if isset($SELECTED_MEMBERS_GROUP[$GROUP_LABEL][$MEMBER->getId()])}selected="true"{/if}>{$MEMBER->getName()}</option>
								{/foreach}
							</optgroup>
						{/foreach}
					</select>
					<input type="hidden" name="status" id="allUsersStatusValue" value=""
						data-public="{$CV_PUBLIC_VALUE}" data-private="{$CV_PRIVATE_VALUE}"/>

					{* === SHARE TASKS CONTAINER === *}
					<div id="shareTasksContainer" class="op0{if $LIST_SHARED} fadeInx{/if}" style="margin-top: 10px; padding: 12px; border: 1px solid #ddd; border-radius: 4px; background: #fcfcfc;">
						<input type="hidden" name="share_tasks" id="shareTasksInput" value="" />
						
						<div id="shareTaskRows">
							{if !empty($CV_SHARE_TASKS)}
								{foreach from=$CV_SHARE_TASKS item=SHARE_TASK name=shareTasks}
									<div class="share-task-row" style="margin-bottom: 12px; padding: 10px; border: 1px solid #e0e0e0; border-radius: 4px; background: #fff; position: relative;">
										<button type="button" class="btn btn-xs btn-danger removeShareRow" style="position: absolute; top: 6px; right: 6px; font-size: 11px; padding: 2px 6px; z-index: 1;">&times;</button>
										<div style="margin-bottom: 8px;">
											<label style="font-weight: 600; font-size: 12px; color: #555; margin-bottom: 4px; display: block;">
												<i class="fa fa-users" style="margin-right: 4px;"></i> {vtranslate('LBL_ADD_USERS_ROLES', $MODULE)}
											</label>
											<input type="hidden" class="share-task-saved-members" value="{','|implode:$SHARE_TASK.members}" />
											<select class="share-task-members" multiple="true" style="width: 100%;" data-placeholder="{vtranslate('LBL_ADD_USERS_ROLES', $MODULE)}">
												<optgroup label="{vtranslate('LBL_ALL',$MODULE)}">
													<option value="All::Users" data-member-type="{vtranslate('LBL_ALL',$MODULE)}"
														{foreach from=$SHARE_TASK.members item=SMEMBER}
															{if $SMEMBER eq 'All::Users'} selected="selected"{/if}
														{/foreach}>
														{vtranslate('LBL_ALL_USERS',$MODULE)}
													</option>
												</optgroup>
												{foreach from=$MEMBER_GROUPS key=GROUP_LABEL item=ALL_GROUP_MEMBERS}
													{assign var=TRANS_GROUP_LABEL value=$GROUP_LABEL}
													{if $GROUP_LABEL eq 'RoleAndSubordinates'}
														{assign var=TRANS_GROUP_LABEL value='LBL_ROLEANDSUBORDINATE'}
													{/if}
													{assign var=TRANS_GROUP_LABEL value={vtranslate($TRANS_GROUP_LABEL)}}
													<optgroup label="{$TRANS_GROUP_LABEL}">
														{foreach from=$ALL_GROUP_MEMBERS item=MEMBER}
															<option value="{$MEMBER->getId()}" data-member-type="{$GROUP_LABEL}"
																{foreach from=$SHARE_TASK.members item=SMEMBER}
																	{if $SMEMBER eq $MEMBER->getId()} selected="selected"{/if}
																{/foreach}>{$MEMBER->getName()}</option>
														{/foreach}
													</optgroup>
												{/foreach}
											</select>
										</div>
										<div>
											<label style="font-weight: 600; font-size: 12px; color: #555; margin-bottom: 4px; display: block;">
												<i class="fa fa-pencil" style="margin-right: 4px;"></i> Mô tả công việc
											</label>
											<textarea class="share-task-description form-control" rows="2" placeholder="Nhập mô tả công việc cho nhóm users này..." style="font-size: 13px; resize: vertical;">{$SHARE_TASK.task_description}</textarea>
										</div>
									</div>
								{/foreach}
							{else}
								{* Default first row when no share tasks exist *}
								<div class="share-task-row" style="margin-bottom: 12px; padding: 10px; border: 1px solid #e0e0e0; border-radius: 4px; background: #fff; position: relative;">
									<button type="button" class="btn btn-xs btn-danger removeShareRow" style="position: absolute; top: 6px; right: 6px; font-size: 11px; padding: 2px 6px; z-index: 1;">&times;</button>
									<div style="margin-bottom: 8px;">
										<label style="font-weight: 600; font-size: 12px; color: #555; margin-bottom: 4px; display: block;">
											<i class="fa fa-users" style="margin-right: 4px;"></i> {vtranslate('LBL_ADD_USERS_ROLES', $MODULE)}
										</label>
										<select class="share-task-members" multiple="true" style="width: 100%;" data-placeholder="{vtranslate('LBL_ADD_USERS_ROLES', $MODULE)}">
											<optgroup label="{vtranslate('LBL_ALL',$MODULE)}">
												<option value="All::Users" data-member-type="{vtranslate('LBL_ALL',$MODULE)}">{vtranslate('LBL_ALL_USERS',$MODULE)}</option>
											</optgroup>
											{foreach from=$MEMBER_GROUPS key=GROUP_LABEL item=ALL_GROUP_MEMBERS}
												{assign var=TRANS_GROUP_LABEL value=$GROUP_LABEL}
												{if $GROUP_LABEL eq 'RoleAndSubordinates'}
													{assign var=TRANS_GROUP_LABEL value='LBL_ROLEANDSUBORDINATE'}
												{/if}
												{assign var=TRANS_GROUP_LABEL value={vtranslate($TRANS_GROUP_LABEL)}}
												<optgroup label="{$TRANS_GROUP_LABEL}">
													{foreach from=$ALL_GROUP_MEMBERS item=MEMBER}
														<option value="{$MEMBER->getId()}" data-member-type="{$GROUP_LABEL}">{$MEMBER->getName()}</option>
													{/foreach}
												</optgroup>
											{/foreach}
										</select>
									</div>
									<div>
										<label style="font-weight: 600; font-size: 12px; color: #555; margin-bottom: 4px; display: block;">
											<i class="fa fa-pencil" style="margin-right: 4px;"></i> Mô tả công việc
										</label>
										<textarea class="share-task-description form-control" rows="2" placeholder="Nhập mô tả công việc cho nhóm users này..." style="font-size: 13px; resize: vertical;"></textarea>
									</div>
								</div>
							{/if}
						</div>

						<button type="button" id="addShareTaskRow" class="btn btn-sm btn-default" style="margin-top: 4px;">
							<i class="fa fa-plus"></i> Thêm phân công
						</button>
					</div>

					{* === SHARE TASK ROW TEMPLATE (hidden, cloned by JS) === *}
					<div id="shareTaskRowTemplate" style="display: none;">
						<div class="share-task-row" style="margin-bottom: 12px; padding: 10px; border: 1px solid #e0e0e0; border-radius: 4px; background: #fff; position: relative;">
							<button type="button" class="btn btn-xs btn-danger removeShareRow" style="position: absolute; top: 6px; right: 6px; font-size: 11px; padding: 2px 6px; z-index: 1;">&times;</button>
							<div style="margin-bottom: 8px;">
								<label style="font-weight: 600; font-size: 12px; color: #555; margin-bottom: 4px; display: block;">
									<i class="fa fa-users" style="margin-right: 4px;"></i> {vtranslate('LBL_ADD_USERS_ROLES', $MODULE)}
								</label>
								<select class="share-task-members" multiple="true" style="width: 100%;" data-placeholder="{vtranslate('LBL_ADD_USERS_ROLES', $MODULE)}">
									<optgroup label="{vtranslate('LBL_ALL',$MODULE)}">
										<option value="All::Users" data-member-type="{vtranslate('LBL_ALL',$MODULE)}">{vtranslate('LBL_ALL_USERS',$MODULE)}</option>
									</optgroup>
									{foreach from=$MEMBER_GROUPS key=GROUP_LABEL item=ALL_GROUP_MEMBERS}
										{assign var=TRANS_GROUP_LABEL value=$GROUP_LABEL}
										{if $GROUP_LABEL eq 'RoleAndSubordinates'}
											{assign var=TRANS_GROUP_LABEL value='LBL_ROLEANDSUBORDINATE'}
										{/if}
										{assign var=TRANS_GROUP_LABEL value={vtranslate($TRANS_GROUP_LABEL)}}
										<optgroup label="{$TRANS_GROUP_LABEL}">
											{foreach from=$ALL_GROUP_MEMBERS item=MEMBER}
												<option value="{$MEMBER->getId()}" data-member-type="{$GROUP_LABEL}">{$MEMBER->getName()}</option>
											{/foreach}
										</optgroup>
									{/foreach}
								</select>
							</div>
							<div>
								<label style="font-weight: 600; font-size: 12px; color: #555; margin-bottom: 4px; display: block;">
									<i class="fa fa-pencil" style="margin-right: 4px;"></i> Mô tả công việc
								</label>
								<textarea class="share-task-description form-control" rows="2" placeholder="Nhập mô tả công việc cho nhóm users này..." style="font-size: 13px; resize: vertical;"></textarea>
							</div>
						</div>
					</div>

					{* === LIST HISTORY === *}
					{if $RECORD_ID && !empty($CV_HISTORY)}
					<div style="margin-top: 20px; padding-top: 15px; border-top: 2px solid #e0e0e0;">
						<label class="filterHeaders">{vtranslate('LBL_LIST_HISTORY', $MODULE)} :</label>
						<div class="well" style="max-height: 250px; overflow-y: auto; padding: 10px;">
							{foreach from=$CV_HISTORY item=HISTORY_ENTRY}
								<div style="border-left: 3px solid #f0ad4e; padding: 8px 12px; margin-bottom: 10px; background: #fafafa; border-radius: 0 4px 4px 0;">
									<div style="margin-bottom: 4px;">
										<span style="color: #888; font-size: 12px;">
											{$HISTORY_ENTRY.action_time}
										</span>
									</div>
									<div>
										<strong style="color: #e6a317;">
											{if $HISTORY_ENTRY.full_name}{$HISTORY_ENTRY.full_name}{else}{$HISTORY_ENTRY.user_name}{/if}
										</strong>
										<span>
											{if $HISTORY_ENTRY.action_type == 'created'}
												{vtranslate('LBL_CREATED_LIST', $MODULE)}
											{else}
												{vtranslate('LBL_UPDATED_LIST', $MODULE)}
											{/if}
										</span>
									</div>
									{if !empty($HISTORY_ENTRY.details_data)}
										{assign var=DETAIL_DATA value=$HISTORY_ENTRY.details_data}
											<div style="margin-top: 4px; font-size: 12px; color: #666;">
												{if isset($DETAIL_DATA.viewname)}
													<span style="color: #5bc0de;">{vtranslate('LBL_VIEW_NAME', $MODULE)}:</span>
													<em>{$DETAIL_DATA.viewname}</em>
												{/if}
												{if isset($DETAIL_DATA.columns_count)}
													&nbsp;|&nbsp;
													<span style="color: #5bc0de;">{vtranslate('LBL_COLUMNS', $MODULE)}:</span>
													<em>{$DETAIL_DATA.columns_count}</em>
												{/if}
											</div>
											{* Show share tasks in history *}
											{if isset($DETAIL_DATA.share_tasks) && !empty($DETAIL_DATA.share_tasks)}
												<div style="margin-top: 8px; padding: 8px; background: #f0f7ff; border-radius: 4px; border-left: 3px solid #5bc0de;">
													<div style="font-weight: 600; font-size: 12px; color: #31708f; margin-bottom: 6px;">
														<i class="fa fa-tasks" style="margin-right: 4px;"></i> {vtranslate('LBL_SHARE_TASK_ASSIGNMENT', $MODULE)}
													</div>
													{foreach from=$DETAIL_DATA.share_tasks item=SHARE_TASK_HIST}
														<div style="margin-bottom: 6px; padding: 4px 8px; background: #fff; border-radius: 3px; border: 1px solid #d9edf7;">
															<div style="font-size: 12px;">
																<i class="fa fa-user" style="color: #5bc0de; margin-right: 3px;"></i>
																<strong>{', '|implode:$SHARE_TASK_HIST.members}</strong>
															</div>
															{if !empty($SHARE_TASK_HIST.task_description)}
																<div style="font-size: 11px; color: #555; margin-top: 3px; padding-left: 18px;">
																	<i class="fa fa-pencil" style="color: #999; margin-right: 3px;"></i>
																	{$SHARE_TASK_HIST.task_description}
																</div>
															{/if}
														</div>
													{/foreach}
												</div>
											{/if}
									{/if}
								</div>
							{/foreach}
						</div>
					</div>
					{/if}

					</div>
				</div>
				<div class='modal-overlay-footer clearfix border1px'>
					<div class="row clearfix">
						<div class=' textAlignCenter col-lg-12 col-md-12 col-sm-12 '>
							<button type='submit' class='btn btn-success saveButton' id="customViewSubmit">{vtranslate('LBL_SAVE', $MODULE)}</button>&nbsp;&nbsp;
							<a class='cancelLink' href="javascript:void(0);" type="reset" data-dismiss="modal">{vtranslate('LBL_CANCEL', $MODULE)}</a>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
{/strip}
