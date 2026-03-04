{*<!--
* 
* Copyright (C) www.vtiger.com. All rights reserved.
* @license Proprietary
*
-->*}
{strip}
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header contentsBackground">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <span aria-hidden="true" class='fa fa-close'></span>
            </button>
            <h4 style="color:white;">{vtranslate('Integrity Check', 'VTEStore')}</h4>
        </div>
            <div class="modal-body" id="installationLog">
                <div class="row-fluid" style="overflow: auto; max-height: 550px;">
                    {foreach key=EXTENSIONNAME item=HEALTHCHECKALLDATA from=$HEALTHCHECKALLDATAS}
                        {if $HEALTHCHECKALLDATA['CheckingStatus']!='OK'}
                            <div style="background-color:pink">
                                <h3>{$EXTENSIONNAME} <font color="red">- {$HEALTHCHECKALLDATA['CheckingStatus']}</font></h3>
                                <div>
                        {else}
                            <div>
                                <h3>
                                    {$EXTENSIONNAME} <font color="green">- {$HEALTHCHECKALLDATA['CheckingStatus']}</font>
                                    &nbsp;&nbsp;<button class="btn btn-primary btnExpandHealthCheck">Show</button>
                                </h3>

                                <div style="display: none" id="Expand{$HEALTHCHECKALLDATA['ExtensionName']}">
                        {/if}


                        {include file='HealthCheckData.tpl'|@vtemplate_path:VTEStore
                        CHECKSERVER_LIB=$HEALTHCHECKALLDATA['checkserver_lib']
                        CHECKSERVER_CRONJOB=$HEALTHCHECKALLDATA['checkserver_cronjob']
                        CHECKINGTABLESDATA=$HEALTHCHECKALLDATA['CheckingTablesData']
                        CHECKINGCOLLATION=$HEALTHCHECKALLDATA['CheckingCollation']
                        CHECKINGPERMISSIONSDATA=$HEALTHCHECKALLDATA['CheckingPermissionsData']
                        CHECKINGFILESDATA=$HEALTHCHECKALLDATA['CheckingFilesData']
                        CHECKINGCRITICALAREASDATA=$HEALTHCHECKALLDATA['CheckingCriticalAreasData']}
                        <br>==================================================================
                        </div></div>
                    {/foreach}
                </div>
            </div>
        <div class="modal-footer">
            <span class="pull-right">
                <button class="btn btn-success" id="importCompleted" onclick="app.hideModalWindow();">{vtranslate('LBL_OK', 'VTEStore')}</button>
            </span>
        </div>
    </div>
</div>
{/strip}