{*+**********************************************************************************
* The contents of this file are subject to the vtiger CRM Public License Version 1.1
* ("License"); You may not use this file except in compliance with the License
* The Original Code is: vtiger CRM Open Source
* The Initial Developer of the Original Code is vtiger.
* Portions created by vtiger are Copyright (C) vtiger.
* All Rights Reserved.
************************************************************************************}
{strip}
<div class="recentActivitiesContainer" id="updates">
    <input type="hidden" id="updatesCurrentPage" value="{$PAGING_MODEL->get('page')}"/>
    <div class='history'>
        {if !empty($RECENT_ACTIVITIES)}
            <ul class="updates_timeline">
                {foreach item=RECENT_ACTIVITY from=$RECENT_ACTIVITIES}
                    {assign var=PROCEED value=TRUE}
                    
                    {* Kiểm tra logic Relation *}
                    {if $RECENT_ACTIVITY->isRelationLink() or $RECENT_ACTIVITY->isRelationUnLink()}
                        {assign var=RELATION value=$RECENT_ACTIVITY->getRelationInstance()}
                        {if !($RELATION->getLinkedRecord())}
                            {assign var=PROCEED value=FALSE}
                        {/if}
                    {/if}

                    {if $PROCEED}
                        {if $RECENT_ACTIVITY->isCreate() or $RECENT_ACTIVITY->isUpdate()}
                            <li>
                                {* Xử lý Thời gian *}
                                {if $RECENT_ACTIVITY->isCreate()}
                                    {assign var=TIME_DB value=$RECENT_ACTIVITY->getParent()->get('createdtime')}
                                {else}
                                    {assign var=TIME_DB value=$RECENT_ACTIVITY->getActivityTime()}
                                {/if}
                                
                                <time class="update_time cursorDefault">
                                    <small title="{Vtiger_Util_Helper::formatDateTimeIntoDayString($TIME_DB)}">
                                        {Vtiger_Datetime_UIType::getDisplayDateTimeValue($TIME_DB)}
                                    </small>
                                </time>

                                {* Xử lý Avatar/Icon người dùng *}
                                {assign var=USER_MODEL value=$RECENT_ACTIVITY->getModifiedBy()}
                                {assign var=IMAGE_DETAILS value=$USER_MODEL->getImageDetails()}
                                
                                <div class="update_icon {if empty($IMAGE_DETAILS) || empty($IMAGE_DETAILS[0].url)}bg-info{/if}">
                                    {if !empty($IMAGE_DETAILS) && !empty($IMAGE_DETAILS[0].url)}
                                        <img class="update_image" src="{$IMAGE_DETAILS[0].url}">
                                    {else}
                                        <i class='update_image vicon-vtigeruser'></i>
                                    {/if}
                                </div>

                                <div class="update_info">
                                    <h5>
                                        <span class="field-name">{$USER_MODEL->getDisplayName()}</span> 
                                        {if $RECENT_ACTIVITY->isCreate()}
                                            {vtranslate('LBL_CREATED', $MODULE_NAME)}
                                        {else}
                                            {vtranslate('LBL_UPDATED', $MODULE_NAME)}
                                        {/if}
                                    </h5>

                                    {* Chi tiết thay đổi trường (Chỉ dành cho Update) *}
                                    {if $RECENT_ACTIVITY->isUpdate()}
                                        {foreach item=FIELDMODEL from=$RECENT_ACTIVITY->getFieldInstances()}
                                            {assign var=F_INSTANCE value=$FIELDMODEL->getFieldInstance()}
                                            {if $F_INSTANCE && $F_INSTANCE->isViewable() && $F_INSTANCE->getDisplayType() neq '5'}
                                                
                                                {assign var=F_FIELD_NAME value=$F_INSTANCE->getName()}
                                                {assign var=F_NAME value=$FIELDMODEL->getName()}
                                                {if empty($F_NAME)}
                                                    {assign var=F_NAME value=$F_FIELD_NAME}
                                                {/if}
                                                {assign var=PRE_VAL value=$FIELDMODEL->getDisplayValue(decode_html($FIELDMODEL->get('prevalue')))}
                                                {assign var=POST_VAL value=$FIELDMODEL->getDisplayValue(decode_html($FIELDMODEL->get('postvalue')))}

                                                {* Logic đặc biệt cho Calendar Time *}
                                                {if in_array($F_FIELD_NAME, ['time_start','time_end']) && in_array($MODULE_NAME, ['Events','Calendar'])}
                                                    {assign var=CAL_REC value=Vtiger_Record_Model::getInstanceById($RECORD_ID)}
                                                    {assign var=PRE_VAL value=Calendar_Time_UIType::getModTrackerDisplayValue($F_FIELD_NAME, $FIELDMODEL->get('prevalue'), $CAL_REC)}
                                                    {assign var=POST_VAL value=Calendar_Time_UIType::getModTrackerDisplayValue($F_FIELD_NAME, $FIELDMODEL->get('postvalue'), $CAL_REC)}
                                                {/if}

                                                <div class='font-x-small updateInfoContainer textOverflowEllipsis'>
                                                    <div class='update-name'>
                                                        <span class="field-name">{vtranslate($F_NAME, $MODULE_NAME)}</span>
                                                        
                                                        {if $FIELDMODEL->get('prevalue') neq '' && $FIELDMODEL->get('postvalue') neq ''}
                                                            <span> &nbsp;{vtranslate('LBL_CHANGED')}</span>
                                                            </div> {* Đóng update-name *}
                                                            <div class='update-from'>
                                                                <span class="field-name">{vtranslate('LBL_FROM')}</span>&nbsp;
                                                                <em style="white-space:pre-line;" title="{strip_tags($PRE_VAL)}">{$PRE_VAL}</em>
                                                            </div>
                                                        {elseif $FIELDMODEL->get('postvalue') eq ''}
                                                            &nbsp;(<del>{$PRE_VAL}</del>) {vtranslate('LBL_IS_REMOVED')}</div>
                                                        {else}
                                                            &nbsp;{vtranslate('LBL_UPDATED')}</div>
                                                        {/if}

                                                        {if $FIELDMODEL->get('postvalue') neq ''}
                                                            <div class="update-to">
                                                                <span class="field-name">{vtranslate('LBL_TO')}</span>&nbsp;
                                                                <em style="white-space:pre-line;">{$POST_VAL}</em>
                                                            </div>
                                                        {/if}
                                                </div>
                                            {/if}
                                        {/foreach}
                                    {/if}
                                </div>
                            </li>

                        {elseif $RECENT_ACTIVITY->isRelationLink() || $RECENT_ACTIVITY->isRelationUnLink()}
                            {assign var=RELATED_MODULE value=$RELATION->getLinkedRecord()->getModuleName()}
                            <li>
                                <time class="update_time cursorDefault">
                                    {assign var=CHANGE_TIME_DB value=$RELATION->get('changedon')}
                                    <small title="{Vtiger_Util_Helper::formatDateTimeIntoDayString($CHANGE_TIME_DB)}">
                                        {Vtiger_Datetime_UIType::getDisplayDateTimeValue($CHANGE_TIME_DB)}
                                    </small>
                                </time>

                                <div class="update_icon bg-info-{$RELATED_MODULE|strtolower}">
                                    {if $RELATED_MODULE|strtolower eq 'modcomments'}
                                        <i class="update_image vicon-chat"></i>
                                    {else}
                                        <span class="update_image">{Vtiger_Module_Model::getModuleIconPath($RELATED_MODULE)}</span>
                                    {/if}
                                </div>

                                <div class="update_info">
                                    <h5>
                                        <span class="field-name">{vtranslate($RELATED_MODULE, $RELATED_MODULE)}</span>&nbsp;
                                        <span>
                                            {if $RECENT_ACTIVITY->isRelationLink()}
                                                {vtranslate('LBL_LINKED', $MODULE_NAME)}
                                            {else}
                                                {vtranslate('LBL_UNLINKED', $MODULE_NAME)}
                                            {/if}
                                        </span>
                                    </h5>
                                    <div class='font-x-small updateInfoContainer textOverflowEllipsis'>
                                        {assign var=PERMITTED value=1}
                                        {if $RELATED_MODULE eq 'Calendar' && isPermitted('Calendar', 'DetailView', $RELATION->getLinkedRecord()->getId()) neq 'yes'}
                                            {assign var=PERMITTED value=0}
                                        {/if}

                                        {if $PERMITTED}
                                            {if $RELATED_MODULE eq 'ModComments'}
                                                {$RELATION->getLinkedRecord()->getName()}
                                            {else}
                                                {assign var=URL value=$RELATION->getRecordDetailViewUrl()}
                                                {if $URL}<a {if stripos($URL, 'javascript:') === 0}onclick{else}href{/if}='{$URL}'>{/if}
                                                    <strong>{$RELATION->getLinkedRecord()->getName()}</strong>
                                                {if $URL}</a>{/if}
                                            {/if}
                                        {/if}
                                    </div>
                                </div>
                            </li>
                        {/if}
                    {/if}
                {/foreach}

                {if $PAGING_MODEL->isNextPageExists()}
                    <li id='more_button'>
                        <div class='update_icon' id="moreLink">
                            <button type="button" class="btn btn-success moreRecentUpdates">{vtranslate('LBL_MORE',$MODULE_NAME)}..</button>
                        </div>
                    </li>
                {/if}
            </ul>
        {else}
            <div class="summaryWidgetContainer">
                <p class="textAlignCenter">{vtranslate('LBL_NO_RECENT_UPDATES')}</p>
            </div>
        {/if}
    </div>
</div>
{/strip}