{*<!--
/*********************************************************************************
** The contents of this file are subject to the vtiger CRM Public License Version 1.0
* ("License"); You may not use this file except in compliance with the License
* The Original Code is: vtiger CRM Open Source
* The Initial Developer of the Original Code is vtiger.
* Portions created by vtiger are Copyright (C) vtiger.
* All Rights Reserved.
*
********************************************************************************/
-->*}
{strip}
   <input type="hidden" id="pageStartRange" value="{$PAGING_MODEL->getRecordStartRange()}" />
   <input type="hidden" id="pageEndRange" value="{$PAGING_MODEL->getRecordEndRange()}" />
   <input type="hidden" id="previousPageExist" value="{$PAGING_MODEL->isPrevPageExists()}" />
   <input type="hidden" id="nextPageExist" value="{$PAGING_MODEL->isNextPageExists()}" />
   <input type="hidden" id="totalCount" value="{$LISTVIEW_COUNT}" />
   <input type="hidden" value="{$ORDER_BY}" id="orderBy">
   <input type="hidden" value="{$SORT_ORDER}" id="sortOrder">
   <input type="hidden" id="totalCount" value="{$LISTVIEW_COUNT}" />
   <input type='hidden' value="{$PAGE_NUMBER}" id='pageNumber'>
   <input type='hidden' value="{$PAGING_MODEL->getPageLimit()}" id='pageLimit'>
   <input type="hidden" value="{$LISTVIEW_ENTRIES_COUNT}" id="noOfEntries">

   <div class="col-sm-12 col-xs-12 ">
        <div id="listview-actions" class="listview-actions-container">
            <div class = "row">
                <div class='col-md-8 usersListDiv'>
                    <select class="select2 col-md-4" id="usersFilter" >
                        <option value="">{vtranslate('LBL_ALL', $QUALIFIED_MODULE)}</option>
                        {foreach item=USERNAME key=USER from=$USERSLIST}
                            <option value="{$USER}" name="{$USERNAME}" {if isset($SELECTED_USER ) && $USERNAME eq $SELECTED_USER} selected {/if}>{$USERNAME}</option>
                        {/foreach}
                    </select>
                    <div class="input-group input-group-sm" style="display: inline-table; width: 180px; margin-left: 10px; vertical-align: middle;">
                        <span class="input-group-addon">{vtranslate('LBL_FROM_DATE', $QUALIFIED_MODULE)}</span>
                        <input type="date" class="form-control" id="exportDateStart" value="{$SELECTED_DATE_START|escape:'html'}" />
                    </div>
                    <div class="input-group input-group-sm" style="display: inline-table; width: 180px; margin-left: 10px; vertical-align: middle;">
                        <span class="input-group-addon">{vtranslate('LBL_TO_DATE', $QUALIFIED_MODULE)}</span>
                        <input type="date" class="form-control" id="exportDateEnd" value="{$SELECTED_DATE_END|escape:'html'}" />
                    </div>
                    <button class="btn btn-default" id="applyLoginHistoryFilterBtn" style="margin-left: 10px;">
                        <i class="fa fa-filter"></i>&nbsp;&nbsp;{vtranslate('LBL_APPLY_FILTER', $QUALIFIED_MODULE)}
                    </button>
                    <button class="btn btn-default" id="exportLoginHistoryBtn" style="margin-left: 10px;">
                        <i class="fa fa-download"></i>&nbsp;&nbsp;{vtranslate('LBL_EXPORT', $QUALIFIED_MODULE)}
                    </button>
                </div>
                <div class="col-md-4 pull-right">
                    {assign var=RECORD_COUNT value=$LISTVIEW_ENTRIES_COUNT}
                    {include file="Pagination.tpl"|vtemplate_path:$MODULE SHOWPAGEJUMP=true}
                </div>
            </div>
            <div class="list-content row">
                <div class="col-sm-12 col-xs-12 ">
                 <div id="table-content" class="table-container" style="padding-top:0px !important;">
                    <table id="listview-table"  class="table listview-table">
                       {assign var="NAME_FIELDS" value=$MODULE_MODEL->getNameFields()}
                       {assign var=WIDTHTYPE value=$CURRENT_USER_MODEL->get('rowheight')}
                       <thead>
                          <tr class="listViewContentHeader">
                            {foreach item=LISTVIEW_HEADER from=$LISTVIEW_HEADERS}
                                 <th nowrap width="16.66%">
                                    <a  {if !($LISTVIEW_HEADER->has('sort'))} class="listViewHeaderValues" style="cursor:text;" data-nextsortorderval="{if $COLUMN_NAME eq $LISTVIEW_HEADER->get('name')}{$NEXT_SORT_ORDER}{else}ASC{/if}" data-columnname="{$LISTVIEW_HEADER->get('name')}" {/if}>{vtranslate($LISTVIEW_HEADER->get('label'), $QUALIFIED_MODULE)}
                                       &nbsp;{if $COLUMN_NAME eq $LISTVIEW_HEADER->get('name')}<img class="{$SORT_IMAGE} icon-white">{/if}</a>&nbsp;
                                 </th>
                             {/foreach}
                          </tr>
                       </thead>
                       <tbody class="overflow-y">
                          {foreach item=LISTVIEW_ENTRY from=$LISTVIEW_ENTRIES}
                             <tr class="listViewEntries" data-id="{$LISTVIEW_ENTRY->getId()}" 
                                 {if method_exists($LISTVIEW_ENTRY,'getDetailViewUrl')}data-recordurl="{$LISTVIEW_ENTRY->getDetailViewUrl()}"{/if}
                                 {if method_exists($LISTVIEW_ENTRY,'getRowInfo')}data-info="{Vtiger_Util_Helper::toSafeHTML(ZEND_JSON::Encode($LISTVIEW_ENTRY->getRowInfo()))}"{/if}>
                                 {foreach item=LISTVIEW_HEADER from=$LISTVIEW_HEADERS}
                                     {assign var=LISTVIEW_HEADERNAME value=$LISTVIEW_HEADER->get('name')}
                                     {assign var=LAST_COLUMN value=$LISTVIEW_HEADER@last}
                                     <td class="listViewEntryValue {$WIDTHTYPE}" width="16.66%" nowrap style='cursor:text;'>
                                        {$LISTVIEW_ENTRY->getDisplayValue($LISTVIEW_HEADERNAME)}
                                        {if $LAST_COLUMN && $LISTVIEW_ENTRY->getRecordLinks()}
                                           <!-- Actions could go here -->
                                        {/if}
                                     </td>
                                 {/foreach}
                             </tr>
                          {/foreach}
                       </tbody>
                    </table>

                    <!--added this div for Temporarily -->
                    {if $LISTVIEW_ENTRIES_COUNT eq '0'}
                       <table class="emptyRecordsDiv">
                          <tbody>
                             <tr>
                                <td>
                                   {vtranslate('LBL_NO')} {vtranslate($MODULE, $QUALIFIED_MODULE)} {vtranslate('LBL_FOUND')}
                                </td>
                             </tr>
                          </tbody>
                       </table>
                    {/if}
                 </div>
                 <div id="scroller_wrapper" class="bottom-fixed-scroll">
                    <div id="scroller" class="scroller-div"></div>
                </div>
                </div>
              </div>
        </div>
    </div>
{/strip}
