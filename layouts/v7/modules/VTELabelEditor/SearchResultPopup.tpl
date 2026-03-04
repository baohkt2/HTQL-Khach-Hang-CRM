{*+***********************************************************************************
* The contents of this file are subject to the vtiger CRM Public License Version 1.0
* ("License"); You may not use this file except in compliance with the License
* The Original Code is: vtiger CRM Open Source
* The Initial Developer of the Original Code is vtiger.
* Portions created by vtiger are Copyright (C) vtiger.
* All Rights Reserved.
*************************************************************************************}
{strip}
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="clearfix">
                    <div class="pull-right " >
                        <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                            <span aria-hidden="true" class='fa fa-close'></span>
                        </button>
                    </div>
                    <h4 class="pull-left">
                        Search Result
                    </h4>
                </div>
            </div>
            <div class="modal-body">
                <div class="search-content" style="padding: 0px 0px 5px 20px; max-height: 500px; height: 500px;">
                    {if !is_array($SEARCH_RESULT)}
                        {assign var=SEARCH_RESULT value=array()}
                    {/if}
                    {assign var=COUNT value=count($SEARCH_RESULT)}
                    {assign var=INDEX value=0}
                    {foreach key=FILE_INFO item=VALUES from=$SEARCH_RESULT}
                        <div class="row">
                            <div class="col-lg-12"><b>{$FILE_INFO}</b></div>
                        </div>
                        {foreach key=LABEL item=VALUE from=$VALUES}
                            <div class="row">
                                <div class="col-lg-12" style="margin-top: 10px; padding-left: 40px;">'{$LABEL}' => '{$VALUE}'</div>
                            </div>
                        {/foreach}
                        {if $INDEX < ($COUNT - 1)}
                            <hr>
                        {/if}
                        {assign var=INDEX value=$INDEX + 1}
                    {/foreach}
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var popupContainer = jQuery('.search-content');
        var Options= {
            axis:"y",
            scrollInertia: 200,
            mouseWheel:{ enable: true }
        };
        app.helper.showVerticalScroll(popupContainer, Options);
    </script>
{/strip}