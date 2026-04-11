{*+**********************************************************************************
* The contents of this file are subject to the vtiger CRM Public License Version 1.1
* ("License"); You may not use this file except in compliance with the License
* The Original Code is: vtiger CRM Open Source
* The Initial Developer of the Original Code is vtiger.
* Portions created by vtiger are Copyright (C) vtiger.
* All Rights Reserved.
************************************************************************************}
<style>
#module-filters .listViewFilter .filterName.listHoverExpand {
    display: inline-block;
    max-width: calc(100% - 38px);
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    line-height: 18px;
    vertical-align: top;
    transform: none !important;
}

#module-filters .listViewFilter:hover,
#module-filters .listViewFilter .filterName.listHoverExpand:hover {
    background: transparent !important;
    box-shadow: none !important;
    text-decoration: none;
}

#sidebar-resize-handle {
    position: absolute;
    top: 0;
    bottom: 0;
    width: 8px;
    cursor: col-resize;
    z-index: 1094;
    background: transparent;
}

#sidebar-resize-handle:before {
    content: '';
    position: absolute;
    top: 0;
    bottom: 0;
    left: 3px;
    width: 1px;
    background: #d7d7d7;
}

#sidebar-resize-handle:hover {
    background: rgba(44, 62, 80, 0.12);
}

body.sidebar-resizing,
body.sidebar-resizing * {
    cursor: col-resize !important;
    user-select: none !important;
}

#module-filters .lists-menu > .listViewFilter {
    margin-bottom: 6px;
}
</style>
<div class="sidebar-menu">
    <div class="module-filters" id="module-filters">
        <div class="sidebar-container lists-menu-container">
            <div class="sidebar-header clearfix">
                <h5 class="pull-left">{vtranslate('LBL_LISTS',$MODULE)}</h5>
                <button id="createFilter" data-url="{CustomView_Record_Model::getCreateViewUrl($MODULE)}" class="btn btn-sm btn-default pull-right sidebar-btn" title="{vtranslate('LBL_CREATE_LIST',$MODULE)}">
                    <div class="fa fa-plus" aria-hidden="true"></div>
                </button> 
                <button id="quickEditFilters" class="btn btn-sm btn-default pull-right sidebar-btn" style="margin-right:6px;" title="Sửa nhanh">Sửa nhanh</button>
                <button id="cancelQuickEditFilters" class="btn btn-sm btn-warning pull-right sidebar-btn hide" style="margin-right:6px;" title="Hủy sửa">Hủy sửa</button>
                <button id="toggleSelectAllQuickFilters" class="btn btn-sm btn-default pull-right sidebar-btn hide" style="margin-right:6px;" title="Chọn tất cả list" disabled="disabled">Chọn tất cả</button>
                <button id="applyQuickEditFilters" class="btn btn-sm btn-success pull-right sidebar-btn hide" style="margin-right:6px;" title="Sửa" disabled="disabled">Sửa</button>
                <button id="clearQuickFilters" class="btn btn-sm btn-danger pull-right sidebar-btn hide" style="margin-right:6px;" title="Xóa lọc nhanh" disabled="disabled">Xóa lọc nhanh</button>
            </div>
            <hr>
            <div>
                <input class="search-list" type="text" placeholder="{vtranslate('LBL_SEARCH_FOR_LIST',$MODULE)}">
            </div>
            <div class="menu-scroller scrollContainer" style="position:relative; top:0; left:0;">
				<div class="list-menu-content">
						{assign var="CUSTOM_VIEW_NAMES" value=array()}
                        {if $CUSTOM_VIEWS && php7_count($CUSTOM_VIEWS) > 0}
                            {assign var="IS_ADMIN" value=$CURRENT_USER_MODEL->isAdminUser()} <!-- Libertus Mod -->
                            {foreach key=GROUP_LABEL item=GROUP_CUSTOM_VIEWS from=$CUSTOM_VIEWS}
                            {if $GROUP_LABEL neq 'Mine' && $GROUP_LABEL neq 'Shared'}
                                {continue}
                             {/if}
                            <div class="list-group" id="{if $GROUP_LABEL eq 'Mine'}myList{else}sharedList{/if}">   
                                <h6 class="lists-header {if php7_count($GROUP_CUSTOM_VIEWS) <=0} hide {/if}" >
                                    {if $GROUP_LABEL eq 'Mine'}
                                        {vtranslate('LBL_MY_LIST',$MODULE)}
                                    {else}
                                        {vtranslate('LBL_SHARED_LIST',$MODULE)}
                                    {/if}
                                </h6>
                                <input type="hidden" name="allCvId" value="{CustomView_Record_Model::getAllFilterByModule($MODULE)->get('cvid')}" />
                                <ul class="lists-menu">
								{assign var=shown_count value=0}
								{assign var=hidden_count value=0}
								{assign var=LISTVIEW_URL value=$MODULE_MODEL->getListViewUrl()}
                                {assign var="CV_SECTION" value=$GROUP_LABEL}
                                {foreach item="CUSTOM_VIEW" from=$GROUP_CUSTOM_VIEWS name="customView"}
                                    {assign var="IS_DEFAULT" value=$CUSTOM_VIEW->isDefault()}
									{assign var="CUSTOME_VIEW_RECORD_MODEL" value=CustomView_Record_Model::getInstanceById($CUSTOM_VIEW->getId())}
									{assign var="MEMBERS" value=$CUSTOME_VIEW_RECORD_MODEL->getMembers()}
									{assign var="LIST_STATUS" value=$CUSTOME_VIEW_RECORD_MODEL->get('status')}
									{foreach key=GROUP_LABEL item="MEMBER_LIST" from=$MEMBERS}
										{if $MEMBER_LIST|@count gt 0}
										{assign var="SHARED_MEMBER_COUNT" value=1}
										{/if}
									{/foreach}
                                    {if $smarty.foreach.customView.iteration lte 10} 
                                        {assign var=shown_count value=$shown_count+1}
                                    {else} 
                                        {assign var=hidden_count value=$hidden_count+1} 
                                    {/if}
                                    <li style="font-size:12px; {if $CV_SECTION eq 'Shared'}position:relative; padding-left:20px;{/if}" class='listViewFilter {if $VIEWID eq $CUSTOM_VIEW->getId() && (isset($CURRENT_TAG) && $CURRENT_TAG eq '')} active{else if $smarty.foreach.customView.iteration gt 10} filterHidden hide{/if}' data-filter-id="{$CUSTOM_VIEW->getId()}" data-edit-url="{if $CUSTOM_VIEW->isEditable()}{$CUSTOM_VIEW->getEditUrl()}{/if}" data-is-editable="{if $CUSTOM_VIEW->isEditable()}1{else}0{/if}"> 
                                        {assign var=VIEWNAME value={vtranslate($CUSTOM_VIEW->get('viewname'), $MODULE)}}
										{append var="CUSTOM_VIEW_NAMES" value=$VIEWNAME}
                                        <input type="checkbox" class="quick-edit-check hide" value="{$CUSTOM_VIEW->getId()}" style="margin-right:6px; vertical-align:middle;" {if !$CUSTOM_VIEW->isEditable()}disabled="disabled"{/if}>
                                         {if $CV_SECTION eq 'Shared'}<span class="shareTaskInfoBtn" data-cvid="{$CUSTOM_VIEW->getId()}" title="Xem phân công" style="cursor:pointer; color:#888; font-size:13px; position:absolute; left:4px; top:50%; transform:translateY(-55%); margin-top:-1px; z-index:5;"><i class="fa fa-info-circle"></i></span>{/if}<a class="filterName listViewFilterElipsis listHoverExpand" href="{$LISTVIEW_URL|cat:'&viewname='|cat:$CUSTOM_VIEW->getId()|cat:'&app='|cat:$SELECTED_MENU_CATEGORY}" oncontextmenu="return false;" data-filter-id="{$CUSTOM_VIEW->getId()}" title="{$VIEWNAME|@escape:'html'}">{$VIEWNAME|@escape:'html'}</a> 
                                            <div class="pull-right">
                                                <span class="js-popover-container" style="cursor:pointer;">
                                                    <span  class="fa fa-angle-down" rel="popover" data-toggle="popover" aria-expanded="true" 
                                                            {if ($CUSTOM_VIEW->isMine() || $IS_ADMIN) && ($CUSTOM_VIEW->get('viewname') neq 'All' || $IS_ADMIN)}
                                                            data-deletable="{if $CUSTOM_VIEW->isDeletable()}true{else}false{/if}" 
                                                            data-editable="{if $CUSTOM_VIEW->isEditable()}true{else}false{/if}" 
                                                            {if $CUSTOM_VIEW->isEditable()} data-editurl="{$CUSTOM_VIEW->getEditUrl()}{/if}" 
                                                            {if $CUSTOM_VIEW->isDeletable()} 
                                                                {if $SHARED_MEMBER_COUNT eq 1 or $LIST_STATUS eq 3} data-shared="1"{/if} 
                                                                data-deleteurl="{$CUSTOM_VIEW->getDeleteUrl()}"
                                                            {/if}
                                                        {/if}
                                                        toggleClass="fa {if $IS_DEFAULT}fa-check-square-o{else}fa-square-o{/if}" 
                                                        data-filter-id="{$CUSTOM_VIEW->getId()}" 
                                                        data-is-default="{$IS_DEFAULT}" 
                                                        data-defaulttoggle="{$CUSTOM_VIEW->getToggleDefaultUrl()}" 
                                                        data-default="{$CUSTOM_VIEW->getDuplicateUrl()}" 
                                                        data-isMine="{if $CUSTOM_VIEW->isMine()}true{else}false{/if}" 
                                                        data-isadmin="{if $IS_ADMIN}true{else}false{/if}">
                                                    </span>
                                                     </span>
                                                </div>
                                            </li>
                                        {/foreach}
                                    </ul>
								<div class='clearfix'> 
									{if $hidden_count} 
										<a class="toggleFilterSize" data-more-text="{$hidden_count} {vtranslate('LBL_MORE',Vtiger)|@strtolower}" data-less-text="Show less">
												{$hidden_count} {vtranslate('LBL_MORE',Vtiger)|@strtolower} 
										</a>{/if} 
									</div>
                             </div>
					{/foreach}
								
							<input type="hidden" id='allFilterNames'  value='{Vtiger_Util_Helper::toSafeHTML(Zend_JSON::encode($CUSTOM_VIEWS_NAMES))}'/>
                            <div id="filterActionPopoverHtml">
                                <ul class="listmenu hide" role="menu">
                                    <li role="presentation" class="editFilter">
                                            <a role="menuitem"><i class="fa fa-pencil"></i>&nbsp;{vtranslate('LBL_EDIT',$MODULE)}</a>
                                        </li>
                                    <li role="presentation" class="deleteFilter">
                                            <a role="menuitem"><i class="fa fa-trash"></i>&nbsp;{vtranslate('LBL_DELETE',$MODULE)}</a>
                                    </li>
                                    <li role="presentation" class="duplicateFilter">
                                                <a role="menuitem" ><i class="fa fa-files-o"></i>&nbsp;{vtranslate('LBL_DUPLICATE',$MODULE)}</a>
                                            </li>
                                    <li role="presentation" class="toggleDefault">
                                                <a role="menuitem" >
                                            <i data-check-icon="fa-check-square-o" data-uncheck-icon="fa-square-o"></i>&nbsp;{vtranslate('LBL_DEFAULT',$MODULE)}
                                                </a>
                                            </li>
                                        </ul>
                            </div>

                        {/if}
                        <div class="list-group hide noLists">
                            <h6 class="lists-header"><center> {vtranslate('LBL_NO')} {vtranslate('LBL_LISTS')} {vtranslate('LBL_FOUND')} ... </center></h6>
                        </div>
                </div>
            </div>
        </div>
    </div>
    {assign var=EXTENSION_LINKS value=Vtiger_Extension_View::getExtensionLinks($MODULE)}
    {if !empty($EXTENSION_LINKS)}
        <div class="module-filters module-extensions">
            <div class="sidebar-container lists-menu-container">
                <h5 class="sidebar-header">{vtranslate('LBL_EXTENSIONS',$MODULE)}</h5>
                <hr>
                <div class="menu-scroller scrollContainer" style="position:relative; top:0; left:0;">
                    <div class="list-menu-content">
                        <ul class="lists-menu"> 
                            {foreach from=$EXTENSION_LINKS item=LINK}
                                {if $LINK->isExtensionAccessible()}
                                    <li style="font-size:12px;" class="listViewFilter {if $EXTENSION_MODULE eq $LINK->get('linklabel')} active {/if}">
                                        <a href="{$LINK->get('linkurl')}&app={$SELECTED_MENU_CATEGORY}">{vtranslate($LINK->get('linklabel'), $MODULE)}</a>
                                    </li>
                                {/if}
                            {/foreach}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    {/if}
    <div class="module-filters">
        <div class="sidebar-container lists-menu-container">
            <h5 class="lists-header">
                {vtranslate('LBL_TAGS', $MODULE)}
            </h5>
            <hr>
            <div class="menu-scroller scrollContainer" style="position:relative; top:0; left:0;">
                <div class="list-menu-content">
                    <div id="listViewTagContainer" class="multiLevelTagList" 
                    {if isset($ALL_CUSTOMVIEW_MODEL) && $ALL_CUSTOMVIEW_MODEL} data-view-id="{$ALL_CUSTOMVIEW_MODEL->getId()}" {/if}
                    data-list-tag-count="{Vtiger_Tag_Model::NUM_OF_TAGS_LIST}">
                    {if isset($TAGS)}
                        {foreach item=TAG_MODEL from=$TAGS name=tagCounter}
                            {assign var=TAG_LABEL value=$TAG_MODEL->getName()}
                            {assign var=TAG_ID value=$TAG_MODEL->getId()}
                            {if $smarty.foreach.tagCounter.iteration gt Vtiger_Tag_Model::NUM_OF_TAGS_LIST}
                                {break}
                            {/if}
                            {include file="Tag.tpl"|vtemplate_path:$MODULE NO_DELETE=true ACTIVE= $CURRENT_TAG eq $TAG_ID}
                        {/foreach}
                        <div> 
                            <a class="moreTags {if (php7_count($TAGS) - Vtiger_Tag_Model::NUM_OF_TAGS_LIST) le 0} hide {/if}">
                                <span class="moreTagCount">{php7_count($TAGS) - Vtiger_Tag_Model::NUM_OF_TAGS_LIST}</span>
                                &nbsp;{vtranslate('LBL_MORE',$MODULE)|strtolower}
                            </a>
                            <div class="moreListTags hide">
                        {foreach item=TAG_MODEL from=$TAGS name=tagCounter}
                            {if $smarty.foreach.tagCounter.iteration le Vtiger_Tag_Model::NUM_OF_TAGS_LIST}
                                {continue}
                            {/if}
                            {include file="Tag.tpl"|vtemplate_path:$MODULE NO_DELETE=true ACTIVE= $CURRENT_TAG eq $TAG_ID}
                        {/foreach}
                             </div>
                        </div>
                    {/if}
                    </div>
                    {include file="AddTagUI.tpl"|vtemplate_path:$MODULE RECORD_NAME="" TAGS_LIST=array()}
                </div>
                <div id="dummyTagElement" class="hide">
                    {assign var=TAG_MODEL value=Vtiger_Tag_Model::getCleanInstance()}
                    {include file="Tag.tpl"|vtemplate_path:$MODULE NO_DELETE=true}
                </div>
                <div>
                    <div class="editTagContainer hide">
                        <input type="hidden" name="id" value="" />
                        <div class="editTagContents">
                            <div>
                                <input type="text" name="tagName" value="" style="width:100%" maxlength="25"/>
                            </div>
                            <div>
                                <div class="checkbox">
                                    <label>
                                        <input type="hidden" name="visibility" value="{Vtiger_Tag_Model::PRIVATE_TYPE}"/>
                                        <input type="checkbox" name="visibility" value="{Vtiger_Tag_Model::PUBLIC_TYPE}" />
                                        &nbsp; {vtranslate('LBL_SHARE_TAG',$MODULE)}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-mini btn-success saveTag" type="button" style="width:50%;float:left">
                                <center> <i class="fa fa-check"></i> </center>
                            </button>
                            <button class="btn btn-mini btn-danger cancelSaveTag" type="button" style="width:50%">
                                <center> <i class="fa fa-close"></i> </center>
                            </button>
                        </div>
                    </div>
                </div>
           </div>
        </div>
     </div>
</div>

{* Share Task Info Modal *}
<div class="modal fade" id="shareTaskInfoModal" tabindex="-1" role="dialog" style="z-index: 99999;">
	<div class="modal-dialog" role="document" style="width: 480px;">
		<div class="modal-content" style="border-radius: 6px; overflow: hidden;">
			<div class="modal-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #fff; border-bottom: none; padding: 14px 20px;">
				<button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 0.8; text-shadow: none;">&times;</button>
				<h4 class="modal-title" style="font-size: 15px; font-weight: 600;">
					<i class="fa fa-tasks" style="margin-right: 6px;"></i>
					<span id="shareTaskInfoTitle">Thông tin phân công</span>
				</h4>
			</div>
			<div class="modal-body" id="shareTaskInfoBody" style="padding: 18px 20px; max-height: 400px; overflow-y: auto;">
				<div class="text-center" style="padding: 30px 0; color: #999;">
					<i class="fa fa-spinner fa-spin fa-2x"></i>
					<p style="margin-top: 10px;">Đang tải...</p>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
jQuery(document).ready(function() {
	// Bind directly to the element to stop propagation before it reaches Vtiger's list handler
	jQuery('.shareTaskInfoBtn').on('click', function(e) {
		e.preventDefault();
		e.stopPropagation();
		e.stopImmediatePropagation();

		var cvid = jQuery(this).data('cvid');
		var modal = jQuery('#shareTaskInfoModal');
		var body = jQuery('#shareTaskInfoBody');

		// Di chuyển modal ra ngoài sidebar, đẩy thẳng vào body để tránh z-index conflict
		if(modal.parent().get(0) !== document.body) {
			modal.appendTo('body');
		}

		// Show loading
		body.html('<div class="text-center" style="padding:30px 0;color:#999;"><i class="fa fa-spinner fa-spin fa-2x"></i><p style="margin-top:10px;">Đang tải...</p></div>');
		modal.modal('show');

		// AJAX call
		var params = {
			module: 'CustomView',
			action: 'GetShareTaskInfo',
			cvid: cvid
		};
		AppConnector.request(params).then(function(data) {
			var result = data.result || data;
			if (result && result.success) {
				var html = '';
				html += '<div style="margin-bottom:14px; padding:10px 14px; background:#f8f9fa; border-radius:5px; border-left:4px solid #667eea;">';
				html += '<div style="font-size:12px; color:#888; margin-bottom:2px;">Người chia sẻ</div>';
				html += '<div style="font-size:14px; font-weight:600; color:#333;"><i class="fa fa-user" style="margin-right:6px; color:#667eea;"></i>' + result.owner + '</div>';
				html += '</div>';

				if (result.tasks && result.tasks.length > 0) {
					for (var i = 0; i < result.tasks.length; i++) {
						var task = result.tasks[i];
						html += '<div style="margin-bottom:10px; padding:10px 14px; background:#fff; border:1px solid #e8e8e8; border-radius:5px;">';
						html += '<div style="font-size:12px; color:#888; margin-bottom:4px;"><i class="fa fa-users" style="margin-right:4px;"></i>Thành viên</div>';
						html += '<div style="font-size:13px; font-weight:500; color:#333; margin-bottom:8px;">' + task.members + '</div>';
						if (task.task_description) {
							html += '<div style="font-size:12px; color:#888; margin-bottom:4px;"><i class="fa fa-file-text-o" style="margin-right:4px;"></i>Mô tả công việc</div>';
							html += '<div style="font-size:13px; color:#555; white-space:pre-wrap; background:#fafafa; padding:8px 10px; border-radius:4px; border:1px solid #f0f0f0;">' + task.task_description + '</div>';
						}
						html += '</div>';
					}
				} else {
					html += '<div style="text-align:center; color:#999; padding:20px 0;"><i class="fa fa-info-circle" style="margin-right:6px;"></i>Không có phân công cụ thể cho bạn</div>';
				}
				body.html(html);
			} else {
				body.html('<div style="text-align:center;color:#e74c3c;padding:20px 0;"><i class="fa fa-exclamation-circle" style="margin-right:6px;"></i>Không thể tải thông tin</div>');
			}
		});

		return false;
	});
});
</script>
