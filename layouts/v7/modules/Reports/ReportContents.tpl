{*+**********************************************************************************
* The contents of this file are subject to the vtiger CRM Public License Version 1.1
* ("License"); You may not use this file except in compliance with the License
* The Original Code is: vtiger CRM Open Source
* The Initial Developer of the Original Code is vtiger.
* Portions created by vtiger are Copyright (C) vtiger.
* All Rights Reserved.
************************************************************************************}
{strip}
    <div class="contents-topscroll">
        <div class="topscroll-div"></div>
    </div>
    <div id="reportDetails" class="contents-bottomscroll">
        <div class="bottomscroll-div">
            <input type="hidden" id="updatedCount" value="{if isset($NEW_COUNT)}{$NEW_COUNT}{else}''{/if}" />
            {if $DATA neq ''}
                {assign var=HEADERS value=$DATA[0]}
                <table class="table table-bordered">
                    <thead>
                        <tr class="blockHeader">
                            {foreach from=$HEADERS item=HEADER key=NAME}
                                <th nowrap>{$NAME}</th>
                            {/foreach}
                        </tr>
                    </thead>
                    {assign var=REPORTRUN value=$REPORT_RUN_INSTANCE}
                    {assign var=GROUPBYFIELDS value=array_keys($REPORTRUN->getGroupingList($RECORD_ID))}
                    {assign var=GROUPBYFIELDSCOUNT value=php7_count($GROUPBYFIELDS)}
                    {if $GROUPBYFIELDSCOUNT > 0}
                        {assign var=FIELDNAMES value=array()}
                        {for $i=0 to $GROUPBYFIELDSCOUNT-1}
                            {assign var=FIELD value=explode(':',$GROUPBYFIELDS[$i])}
                            {assign var=FIELD_EXPLODE value=explode('_',$FIELD[2])}
                            {for $j=1 to php7_count($FIELD_EXPLODE)-1}
                                {$FIELDNAMES.$i = $FIELDNAMES.$i|cat:$FIELD_EXPLODE[$j]|cat:" "}
                            {/for}
                        {/for}

                        {if $GROUPBYFIELDSCOUNT eq 1}
                            {assign var=FIRST_FIELD value=vtranslate(trim($FIELDNAMES[0]), $MODULE)}
                        {else if $GROUPBYFIELDSCOUNT eq 2}    
                            {assign var=FIRST_FIELD value=vtranslate(trim($FIELDNAMES[0]),$MODULE)}
                            {assign var=SECOND_FIELD value=vtranslate(trim($FIELDNAMES[1]),$MODULE)}
                        {else if $GROUPBYFIELDSCOUNT eq 3}    
                            {assign var=FIRST_FIELD value=vtranslate(trim($FIELDNAMES[0]),$MODULE)}
                            {assign var=SECOND_FIELD value=vtranslate(trim($FIELDNAMES[1]),$MODULE)}
                            {assign var=THIRD_FIELD value=vtranslate(trim($FIELDNAMES[2]),$MODULE)}
                        {/if}    

                        {assign var=FIRST_VALUE value=" "}
                        {assign var=SECOND_VALUE value=" "}
                        {assign var=THIRD_VALUE value=" "}
                        {foreach from=$DATA item=VALUES}
                            <tr>
                                {foreach from=$VALUES item=VALUE key=NAME}
                                    {if ($NAME eq $FIRST_FIELD || $NAME|strstr:{$FIRST_FIELD}) && ($FIRST_VALUE eq $VALUE || $FIRST_VALUE eq " ")}
                                        {if $FIRST_VALUE eq " " || $VALUE eq "-"}
                                            <td class="summary">{$VALUE}</td>
                                        {else}    
                                            <td class="summary">{" "}</td>
                                        {/if}   
                                        {if $VALUE neq " " }
                                            {$FIRST_VALUE = $VALUE}
                                        {/if}   
                                    {else if ( $NAME eq $SECOND_FIELD || $NAME|strstr:$SECOND_FIELD) && ($SECOND_VALUE eq $VALUE || $SECOND_VALUE eq " ")}
                                        {if $SECOND_VALUE eq " " || $VALUE eq "-"}
                                            <td class="summary">{$VALUE}</td>
                                        {else}    
                                            <td class="summary">{" "}</td>
                                        {/if}   
                                        {if $VALUE neq " " }
                                            {$SECOND_VALUE = $VALUE}
                                        {/if}   
                                    {else if ($NAME eq $THIRD_FIELD || $NAME|strstr:$THIRD_FIELD) && ($THIRD_VALUE eq $VALUE || $THIRD_VALUE eq " ")}
                                        {if $THIRD_VALUE eq " " || $VALUE eq "-"}
                                            <td class="summary">{$VALUE}</td>
                                        {else}    
                                            <td class="summary">{" "}</td>
                                        {/if}   
                                        {if $VALUE neq " " }
                                            {$THIRD_VALUE = $VALUE}
                                        {/if}
                                    {else}
                                        <td>{$VALUE}</td>
                                        {if $NAME eq $FIRST_FIELD || $NAME|strstr:$FIRST_FIELD}
                                            {$FIRST_VALUE = $VALUE}
                                        {else if $NAME eq $SECOND_FIELD || $NAME|strstr:$SECOND_FIELD}
                                            {$SECOND_VALUE = $VALUE}
                                        {else if $NAME eq $THIRD_FIELD || $NAME|strstr:$THIRD_FIELD}
                                            {$THIRD_VALUE = $VALUE}
                                        {/if}    
                                    {/if}   
                                {/foreach}
                            </tr>
                        {/foreach}
                    {else}    
                        {foreach from=$DATA item=VALUES}
                            <tr>
                                {foreach from=$VALUES item=VALUE key=NAME}
                                    <td>{$VALUE}</td>
                                {/foreach}
                            </tr>
                        {/foreach}
                    {/if}
                </table>
                {if isset($LIMIT_EXCEEDED) && $LIMIT_EXCEEDED}
                    <center>{vtranslate('LBL_LIMIT_EXCEEDED',$MODULE)} <span class="pull-right"><a href="#top" >{vtranslate('LBL_TOP',$MODULE)}</a></span></center>
                        {/if}
                    {else}
                <div style="text-align: center; border: 1px solid #DDD; padding: 20px; font-size: 15px;">{vtranslate('LBL_NO_DATA_AVAILABLE',$MODULE)}</div>
            {/if}
        </div>
    </div>
    <br>
{/strip}

