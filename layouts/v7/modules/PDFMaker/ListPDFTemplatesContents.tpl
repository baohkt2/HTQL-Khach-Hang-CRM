{* ********************************************************************************
* The content of this file is subject to the PDF Maker Free license.
* ("License"); You may not use this file except in compliance with the License
* The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
* Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
* All Rights Reserved.
* ****************************************************************************** *}

<div class="col-sm-12 col-xs-12 ">

    <input type="hidden" name="idlist" >
    <input type="hidden" name="module" value="PDFMaker">
    <input type="hidden" name="parenttab" value="Tools">
    <input type="hidden" name="view" value="List">
    <div id="table-content" class="table-container">

        <form name='list' id='listedit' action='' onsubmit="return false;">
            <table id="listview-table" class="table {if $LISTVIEW_ENTRIES_COUNT eq '0'}listview-table-norecords {/if} listview-table">
                <thead>
                <tr class="listViewContentHeader">
                    <th></th>
                    <th nowrap="nowrap"><a href="#" data-columnname="module" data-nextsortorderval="{$module_dir}" class="listViewContentHeaderValues">&nbsp;{vtranslate("LBL_MODULENAMES",$MODULE)}&nbsp;</a></th>
                    <th nowrap="nowrap"><a href="#" data-columnname="description" data-nextsortorderval="{$description_dir}" class="listViewContentHeaderValues">{vtranslate("LBL_DESCRIPTION",$MODULE)}&nbsp;</a></th>
                </tr>
                </thead>
                <tbody>
                {foreach item=template name=mailmerge from=$PDFTEMPLATES}
                    <tr class="listViewEntries" data-id="{$template.templateid}" data-recordurl="index.php?module=PDFMaker&view=DetailFree&templateid={$template.templateid}" id="PDFMaker_listView_row_{$template.templateid}">
                        <td class="listViewRecordActions">
                            <div class="table-actions">
                                   <span class="more dropdown action">
                                            <span href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa fa-ellipsis-v icon"></i></span>
                                                <ul class="dropdown-menu">
                                                    <li><a data-id="{$template.templateid}" href="index.php?module=PDFMaker&view=DetailFree&templateid={$template.templateid}&app={$SELECTED_MENU_CATEGORY}">{vtranslate('LBL_DETAILS', $MODULE)}</a></li>
                                                    {$template.edit}
                                                </ul>
                                        </span>
                            </div>
                        </td>
                        <td class="listViewEntryValue">{$template.module}</a></td>
                        <td class="listViewEntryValue">{$template.description}&nbsp;</td>
                    </tr>
                {/foreach}
                </tbody>
            </table>
        </form>
    </div>
</div>
<br>
<div align="center" class="small" style="color: rgb(153, 153, 153);">{vtranslate("PDF_MAKER",$MODULE)} {$VERSION} {vtranslate("COPYRIGHT",$MODULE)}</div>