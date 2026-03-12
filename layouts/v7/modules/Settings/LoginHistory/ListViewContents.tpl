{strip}
   {* Giữ nguyên các input hidden để không hỏng Logic JS *}
   <input type="hidden" id="pageStartRange" value="{$PAGING_MODEL->getRecordStartRange()}" />
   <input type="hidden" id="pageEndRange" value="{$PAGING_MODEL->getRecordEndRange()}" />
   <input type="hidden" id="previousPageExist" value="{$PAGING_MODEL->isPrevPageExists()}" />
   <input type="hidden" id="nextPageExist" value="{$PAGING_MODEL->isNextPageExists()}" />
   <input type="hidden" id="totalCount" value="{$LISTVIEW_COUNT}" />
   <input type="hidden" value="{$ORDER_BY}" id="orderBy">
   <input type="hidden" value="{$SORT_ORDER}" id="sortOrder">
   <input type='hidden' value="{$PAGE_NUMBER}" id='pageNumber'>
   <input type='hidden' value="{$PAGING_MODEL->getPageLimit()}" id='pageLimit'>
   <input type="hidden" value="{$LISTVIEW_ENTRIES_COUNT}" id="noOfEntries">

   <div class="col-sm-12 col-xs-12">
        <div id="listview-actions" class="listview-actions-container" style="margin-bottom: 15px;">
            <div class="row">
                <div class="col-md-9 usersListDiv form-inline">
                    <div class="form-group">
                        <select class="select2" id="usersFilter" style="min-width: 200px;">
                            <option value="">{vtranslate('LBL_ALL', $QUALIFIED_MODULE)}</option>
                            {foreach item=USERNAME key=USER from=$USERSLIST}
                                <option value="{$USER}" name="{$USERNAME}" {if isset($SELECTED_USER ) && $USERNAME eq $SELECTED_USER} selected {/if}>{$USERNAME}</option>
                            {/foreach}
                        </select>
                    </div>

                    <div class="input-group input-group-sm" style="margin-left: 5px;">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i> {vtranslate('LBL_FROM_DATE', $QUALIFIED_MODULE)}</span>
                        <input type="date" class="form-control" id="exportDateStart" value="{$SELECTED_DATE_START|escape:'html'}" />
                    </div>

                    <div class="input-group input-group-sm" style="margin-left: 5px;">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i> {vtranslate('LBL_TO_DATE', $QUALIFIED_MODULE)}</span>
                        <input type="date" class="form-control" id="exportDateEnd" value="{$SELECTED_DATE_END|escape:'html'}" />
                    </div>

                    <div class="btn-group" style="margin-left: 10px;">
                        <button class="btn btn-primary btn-sm" id="applyLoginHistoryFilterBtn">
                            <i class="fa fa-filter"></i>&nbsp;&nbsp;{vtranslate('LBL_APPLY_FILTER', $QUALIFIED_MODULE)}
                        </button>
                        <button class="btn btn-success btn-sm" id="exportLoginHistoryBtn">
                            <i class="fa fa-download"></i>&nbsp;&nbsp;{vtranslate('LBL_EXPORT', $QUALIFIED_MODULE)}
                        </button>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="pull-right">
                        {assign var=RECORD_COUNT value=$LISTVIEW_ENTRIES_COUNT}
                        {include file="Pagination.tpl"|vtemplate_path:$MODULE SHOWPAGEJUMP=true}
                    </div>
                </div>
            </div>

            <div class="list-content row" style="margin-top: 15px;">
                <div class="col-sm-12">
                    <div id="table-content" class="table-container shadow-sm">
                        <table id="listview-table" class="table table-hover listview-table">
                           {assign var="NAME_FIELDS" value=$MODULE_MODEL->getNameFields()}
                           {assign var=WIDTHTYPE value=$CURRENT_USER_MODEL->get('rowheight')}
                           <thead>
                              <tr class="listViewContentHeader">
                                {foreach item=LISTVIEW_HEADER from=$LISTVIEW_HEADERS}
                                     <th nowrap class="{$WIDTHTYPE}" style="background-color: #f9f9f9; border-bottom: 2px solid #ddd;">
                                        <a {if !($LISTVIEW_HEADER->has('sort'))} class="listViewHeaderValues" style="text-decoration: none; color: #333;" data-nextsortorderval="{if $COLUMN_NAME eq $LISTVIEW_HEADER->get('name')}{$NEXT_SORT_ORDER}{else}ASC{/if}" data-columnname="{$LISTVIEW_HEADER->get('name')}" {/if}>
                                            {vtranslate($LISTVIEW_HEADER->get('label'), $QUALIFIED_MODULE)}
                                            {if $COLUMN_NAME eq $LISTVIEW_HEADER->get('name')}
                                                <i class="fa {if $SORT_ORDER eq 'ASC'}fa-chevron-up{else}fa-chevron-down{/if}"></i>
                                            {/if}
                                        </a>
                                     </th>
                                 {/foreach}
                              </tr>
                           </thead>
                           <tbody>
                              {foreach item=LISTVIEW_ENTRY from=$LISTVIEW_ENTRIES}
                                 <tr class="listViewEntries" data-id="{$LISTVIEW_ENTRY->getId()}" 
                                     {if method_exists($LISTVIEW_ENTRY,'getDetailViewUrl')}data-recordurl="{$LISTVIEW_ENTRY->getDetailViewUrl()}"{/if}>
                                     {foreach item=LISTVIEW_HEADER from=$LISTVIEW_HEADERS}
                                         {assign var=LISTVIEW_HEADERNAME value=$LISTVIEW_HEADER->get('name')}
                                         <td class="listViewEntryValue {$WIDTHTYPE}" nowrap>
                                            <span class="value">{$LISTVIEW_ENTRY->getDisplayValue($LISTVIEW_HEADERNAME)}</span>
                                         </td>
                                     {/foreach}
                                 </tr>
                              {/foreach}
                           </tbody>
                        </table>

                        {if $LISTVIEW_ENTRIES_COUNT eq '0'}
                           <div class="alert alert-info text-center" style="margin: 20px;">
                                <i class="fa fa-info-circle"></i> {vtranslate('LBL_NO')} {vtranslate($MODULE, $QUALIFIED_MODULE)} {vtranslate('LBL_FOUND')}
                           </div>
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