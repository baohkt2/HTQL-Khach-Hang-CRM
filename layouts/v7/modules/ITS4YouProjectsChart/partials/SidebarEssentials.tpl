{*/* * *******************************************************************************
 * The content of this file is subject to the ITS4YouProjectsChart license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */*}

<div class="sidebar-menu">
    <div class="module-filters" id="module-filters">
        <div class="sidebar-container lists-menu-container">
            <div class="sidebar-header clearfix">
                <h5 class="pull-left">{vtranslate('LBL_LISTS',$SOURCE_MODULE_NAME)}</h5>
                <button id="createFilter" data-url="{CustomView_Record_Model::getCreateViewUrl($SOURCE_MODULE_NAME)}" class="btn btn-sm btn-default pull-right sidebar-btn"
                        title="{vtranslate('LBL_CREATE_LIST',$SOURCE_MODULE_NAME)}">
                    <div class="fa fa-plus" aria-hidden="true"></div>
                </button>
            </div>
            <hr>
            <div>
                <input class="search-list" type="text" placeholder="{vtranslate('LBL_SEARCH_FOR_LIST',$SOURCE_MODULE_NAME)}">
            </div>
            <div class="menu-scroller scrollContainer" style="position:relative; top:0; left:0;">
                <div class="list-menu-content">
                    {assign var="CUSTOM_VIEW_NAMES" value=array()}
                    {if $SOURCE_CUSTOM_VIEWS && count($SOURCE_CUSTOM_VIEWS) > 0}
                        {foreach key=GROUP_LABEL item=GROUP_CUSTOM_VIEWS from=$SOURCE_CUSTOM_VIEWS}
                            {if $GROUP_LABEL neq 'Mine' && $GROUP_LABEL neq 'Shared'}
                                {continue}
                            {/if}
                            <div class="list-group" id="{if $GROUP_LABEL eq 'Mine'}myList{else}sharedList{/if}">
                                <h6 class="lists-header {if count($GROUP_CUSTOM_VIEWS) <=0} hide {/if}">
                                    {if $GROUP_LABEL eq 'Mine'}
                                        {vtranslate('LBL_MY_LIST',$SOURCE_MODULE_NAME)}
                                    {else}
                                        {vtranslate('LBL_SHARED_LIST',$SOURCE_MODULE_NAME)}
                                    {/if}
                                </h6>
                                <input type="hidden" name="allCvId" value="{CustomView_Record_Model::getAllFilterByModule($SOURCE_MODULE_NAME)->get('cvid')}"/>
                                <ul class="lists-menu">
                                    {assign var=count value=0}
                                    {assign var=LISTVIEW_URL value=$SOURCE_MODULE_MODEL->getListViewUrl()}
                                    {foreach item=CUSTOM_VIEW from=$GROUP_CUSTOM_VIEWS name=customView}
                                        {assign var=IS_DEFAULT value=$CUSTOM_VIEW->isDefault()}
                                        {assign var=CUSTOM_VIEW_ID value=$CUSTOM_VIEW->getId()}
                                        {assign var=CUSTOM_VIEW_RECORD_MODEL value=CustomView_Record_Model::getInstanceById($CUSTOM_VIEW_ID)}
                                        {assign var=MEMBERS value=$CUSTOM_VIEW_RECORD_MODEL->getMembers()}
                                        {assign var=LIST_STATUS value=$CUSTOM_VIEW_RECORD_MODEL->get('status')}
                                        {foreach key=GROUP_LABEL item="MEMBER_LIST" from=$MEMBERS}
                                            {if $MEMBER_LIST|@count gt 0}
                                                {assign var=SHARED_MEMBER_COUNT value=1}
                                            {/if}
                                        {/foreach}
                                        <li style="font-size:12px;"
                                            class='listViewFilter {if $VIEWID eq $CUSTOM_VIEW_ID && ($CURRENT_TAG eq '')} active {if $smarty.foreach.customView.iteration gt 10} {assign var=count value=1} {/if} {elseif $smarty.foreach.customView.iteration gt 10} filterHidden hide{/if} '>
                                            {assign var=VIEWNAME value={vtranslate($CUSTOM_VIEW->get('viewname'), $SOURCE_MODULE_NAME)}}
                                            {append var="CUSTOM_VIEW_NAMES" value=$VIEWNAME}
                                            <a class="filterName listViewFilterElipsis" href="{$MODULE_MODEL->getViewUrl($SOURCE_MODULE_NAME, $CUSTOM_VIEW_ID)}"
                                               data-filter-id="{$CUSTOM_VIEW_ID}" title="{$VIEWNAME|@escape:'html'}">{$VIEWNAME|@escape:'html'}</a>
                                            <div class="pull-right">
                                                <span class="js-popover-container" style="cursor:pointer;">
                                                    <span class="fa fa-angle-down" rel="popover" data-toggle="popover" aria-expanded="true"
                                                    {if $CUSTOM_VIEW->isMine() and $CUSTOM_VIEW->get('viewname') neq 'All'}
                                                        data-deletable="{if $CUSTOM_VIEW->isDeletable()}true{else}false{/if}" data-editable="{if $CUSTOM_VIEW->isEditable()}true{else}false{/if}"
                                                        {if $CUSTOM_VIEW->isEditable()} data-editurl="{$CUSTOM_VIEW->getEditUrl()}{/if}" {if $CUSTOM_VIEW->isDeletable()} {if $SHARED_MEMBER_COUNT eq 1 or $LIST_STATUS eq 3} data-shared="1"{/if} data-deleteurl="{$CUSTOM_VIEW->getDeleteUrl()}"{/if}
                                                    {/if}
                                                          toggleClass="fa {if $IS_DEFAULT}fa-check-square-o{else}fa-square-o{/if}" data-filter-id="{$CUSTOM_VIEW_ID}"
                                                          data-is-default="{$IS_DEFAULT}" data-defaulttoggle="{$CUSTOM_VIEW->getToggleDefaultUrl()}"
                                                          data-default="{$CUSTOM_VIEW->getDuplicateUrl()}" data-isMine="{if $CUSTOM_VIEW->isMine()}true{else}false{/if}">
                                                    </span>
                                                 </span>
                                            </div>
                                        </li>
                                    {/foreach}
                                </ul>
                                <div class='clearfix'>
                                    {if $smarty.foreach.customView.iteration - 10 - $count}
                                    <a class="toggleFilterSize" data-more-text=" {$smarty.foreach.customView.iteration - 10 - $count} {vtranslate('LBL_MORE',Vtiger)|@strtolower}"
                                       data-less-text="Show less">
                                        {if $smarty.foreach.customView.iteration gt 10}
                                            {$smarty.foreach.customView.iteration - 10 - $count} {vtranslate('LBL_MORE',Vtiger)|@strtolower}
                                        {/if}
                                        </a>{/if}
                                </div>
                            </div>
                        {/foreach}
                        <input type="hidden" id='allFilterNames' value='{Vtiger_Util_Helper::toSafeHTML(Zend_JSON::encode($CUSTOM_VIEWS_NAMES))}'/>
                        <div id="filterActionPopoverHtml">
                            <ul class="listmenu hide" role="menu">
                                <li role="presentation" class="editFilter">
                                    <a role="menuitem"><i class="fa fa-pencil"></i>&nbsp;{vtranslate('LBL_EDIT',$SOURCE_MODULE_NAME)}</a>
                                </li>
                                <li role="presentation" class="deleteFilter">
                                    <a role="menuitem"><i class="fa fa-trash"></i>&nbsp;{vtranslate('LBL_DELETE',$SOURCE_MODULE_NAME)}</a>
                                </li>
                                <li role="presentation" class="duplicateFilter">
                                    <a role="menuitem"><i class="fa fa-files-o"></i>&nbsp;{vtranslate('LBL_DUPLICATE',$SOURCE_MODULE_NAME)}</a>
                                </li>
                                <li role="presentation" class="toggleDefault">
                                    <a role="menuitem">
                                        <i data-check-icon="fa-check-square-o" data-uncheck-icon="fa-square-o"></i>&nbsp;{vtranslate('LBL_DEFAULT',$SOURCE_MODULE_NAME)}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    {/if}
                    <div class="list-group hide noLists">
                        <h6 class="lists-header">
                            <center> {vtranslate('LBL_NO')} {vtranslate('LBL_LISTS')} {vtranslate('LBL_FOUND')} ...</center>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {assign var=EXTENSION_LINKS value=Vtiger_Extension_View::getExtensionLinks($SOURCE_MODULE_NAME)}
    {if !empty($EXTENSION_LINKS)}
        <div class="module-filters module-extensions">
            <div class="sidebar-container lists-menu-container">
                <h5 class="sidebar-header">{vtranslate('LBL_EXTENSIONS',$SOURCE_MODULE_NAME)}</h5>
                <hr>
                <div class="menu-scroller scrollContainer" style="position:relative; top:0; left:0;">
                    <div class="list-menu-content">
                        <ul class="lists-menu">
                            {foreach from=$EXTENSION_LINKS item=LINK}
                                {if $LINK->isExtensionAccessible()}
                                    <li style="font-size:12px;" class="listViewFilter {if $EXTENSION_MODULE eq $LINK->get('linklabel')} active {/if}">
                                        <a href="{$LINK->get('linkurl')}&app={$SELECTED_MENU_CATEGORY}">{vtranslate($LINK->get('linklabel'), $SOURCE_MODULE_NAME)}</a>
                                    </li>
                                {/if}
                            {/foreach}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    {/if}
</div>
